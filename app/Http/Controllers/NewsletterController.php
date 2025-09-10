<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsletterSubscription;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class NewsletterController extends Controller
{
    /**
     * Subscribe user to newsletter
     */
    public function subscribe(Request $request)
    {
        try {
            // Validate the request
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'marketing_consent' => 'sometimes|boolean'
            ]);

            if ($validator->fails()) {
                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Validation failed',
                        'errors' => $validator->errors()
                    ], 422);
                }

                return back()->withErrors($validator)->withInput();
            }

            // Check if email already exists
            $existingSubscription = NewsletterSubscription::where('email', $request->email)->first();

            if ($existingSubscription) {
                if ($existingSubscription->is_active) {
                    $message = 'You are already subscribed to our newsletter!';
                } else {
                    // Reactivate the subscription
                    $existingSubscription->update([
                        'name' => $request->name,
                        'marketing_consent' => $request->boolean('marketing_consent', false),
                        'is_active' => true,
                        'ip_address' => $request->ip(),
                        'user_agent' => $request->header('User-Agent'),
                        'subscribed_at' => now()
                    ]);
                    $message = 'Welcome back! Your subscription has been reactivated.';
                }
            } else {
                // Create new subscription
                NewsletterSubscription::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'marketing_consent' => $request->boolean('marketing_consent', false),
                    'ip_address' => $request->ip(),
                    'user_agent' => $request->header('User-Agent'),
                    'subscribed_at' => now()
                ]);
                $message = 'Thank you for subscribing to our newsletter!';
            }

            // Log the subscription
            Log::info('Newsletter subscription', [
                'email' => $request->email,
                'name' => $request->name,
                'ip' => $request->ip()
            ]);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => $message
                ]);
            }

            return back()->with('success', $message);

        } catch (\Exception $e) {
            Log::error('Newsletter subscription error: ' . $e->getMessage());

            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred while processing your subscription. Please try again.'
                ], 500);
            }

            return back()->with('error', 'An error occurred while processing your subscription. Please try again.');
        }
    }

    /**
     * Unsubscribe user from newsletter
     */
    public function unsubscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid email address'
                ], 422);
            }

            return back()->withErrors($validator);
        }

        $subscription = NewsletterSubscription::where('email', $request->email)->first();

        if ($subscription) {
            $subscription->unsubscribe();
            $message = 'You have been successfully unsubscribed from our newsletter.';
        } else {
            $message = 'Email address not found in our newsletter list.';
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $message
            ]);
        }

        return back()->with('success', $message);
    }

    /**
     * Get all newsletter subscriptions (admin only)
     */
    public function index()
    {
        $subscriptions = NewsletterSubscription::latest()->paginate(20);

        return view('admin.newsletter.index', compact('subscriptions'));
    }

    /**
     * Get newsletter statistics
     */
    public function stats()
    {
        $stats = [
            'total' => NewsletterSubscription::count(),
            'active' => NewsletterSubscription::active()->count(),
            'marketing_consent' => NewsletterSubscription::withMarketingConsent()->count(),
            'recent' => NewsletterSubscription::where('created_at', '>=', now()->subDays(30))->count()
        ];

        return response()->json($stats);
    }
}
