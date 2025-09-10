<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\Settings;
use App\Models\Notification;
use App\Mail\ContactMessage;

class ContactController extends Controller
{
    /**
     * Show the contact page
     */
    public function index()
    {
        $settings = Settings::where('id', '=', '1')->first();

        return view('home.contact')->with([
            'settings' => $settings,
            'title' => 'Contact Us - ' . $settings->site_title,
        ]);
    }

    /**
     * Handle contact form submission
     */
    public function send(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
            'priority' => 'required|in:low,normal,high'
        ]);

        try {
            $settings = Settings::where('id', '=', '1')->first();

            // Determine user_id (null for guests, actual user ID for logged-in users)
            $userId = auth()->check() ? auth()->id() : null;

            // Create notification entry
            $notification = Notification::create([
                'user_id' => $userId,
                'title' => 'Contact Message: ' . $validatedData['subject'],
                'message' => "From: {$validatedData['name']} ({$validatedData['email']})\n" .
                           "Phone: " . ($validatedData['phone'] ?? 'Not provided') . "\n" .
                           "Priority: " . ucfirst($validatedData['priority']) . "\n\n" .
                           "Message:\n" . $validatedData['message'],
                'is_read' => false
            ]);

            // Prepare email data
            $emailData = [
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'],
                'subject' => $validatedData['subject'],
                'message' => $validatedData['message'],
                'priority' => $validatedData['priority'],
                'submitted_at' => now()->format('M j, Y \a\t g:i A'),
                'user_type' => auth()->check() ? 'Registered User' : 'Guest',
                'notification_id' => $notification->id
            ];

            // Send email to admin - Temporarily disabled for debugging
            $adminEmail = $settings->contact_email ?? 'admin@example.com';

            // Skip email sending for now to isolate the issue

            try {
                Mail::to($adminEmail)->send(new ContactMessage($emailData));

                Log::info('Contact form submitted successfully', [
                    'name' => $validatedData['name'],
                    'email' => $validatedData['email'],
                    'subject' => $validatedData['subject'],
                    'priority' => $validatedData['priority'],
                    'user_id' => $userId,
                    'notification_id' => $notification->id
                ]);

                return redirect()->back()->with('success', 'Thank you for your message! We\'ll get back to you within 24 hours.');

            } catch (\Exception $mailException) {
                Log::error('Failed to send contact email', [
                    'error' => $mailException->getMessage(),
                    'notification_id' => $notification->id
                ]);

                // Even if email fails, we still have the notification saved
                return redirect()->back()->with('success', 'Your message has been received! We\'ll get back to you soon.');
            }


            // For now, just return success after saving to database
            return redirect()->back()->with('success', 'Thank you for your message! We have received your inquiry and will get back to you within 24 hours.');

        } catch (\Exception $e) {
            // Return a more detailed error message for debugging
            return redirect()->back()
                ->with('error', 'Sorry, there was an error: ' . $e->getMessage())
                ->withInput();
        }
    }
}
