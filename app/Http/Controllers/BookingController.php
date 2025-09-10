<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Celebrity;
use App\Models\CelebrityBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Settings;
use App\Models\Wdmethod;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * Display user's booking history
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Ensure user is logged in
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to view your bookings');
        }

        $bookings = CelebrityBooking::where('user_id', Auth::id())
                                    ->with('celebrity')
                                    ->orderBy('created_at', 'desc')
                                    ->paginate(10);

        // Use the modern booking history view
        return view('home.modern_booking_history', [
            'bookings' => $bookings,
            'title' => 'My Bookings History'
        ]);
    }

    /**
     * Check celebrity availability for booking
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function checkAvailability(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'celebrity_id' => 'required|exists:celebrities,id',
            'event_date' => 'required|date|after:today',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid input data',
                'errors' => $validator->errors()
            ], 422);
        }

        // Check if celebrity has other bookings on that date
        $existingBookings = CelebrityBooking::where('celebrity_id', $request->celebrity_id)
                                           ->whereDate('event_date', $request->event_date)
                                           ->where('booking_status', '!=', 'cancelled')
                                           ->where('booking_status', '!=', 'rejected')
                                           ->get();

        // Get all time slots that are already booked
        $bookedTimeSlots = [];
        foreach ($existingBookings as $booking) {
            $startTime = Carbon::parse($booking->event_time);
            $endTime = (clone $startTime)->addMinutes($booking->duration);

            $bookedTimeSlots[] = [
                'start' => $startTime->format('H:i'),
                'end' => $endTime->format('H:i'),
            ];
        }

        return response()->json([
            'success' => true,
            'is_available' => count($bookedTimeSlots) < 3, // Assuming max 3 bookings per day
            'booked_slots' => $bookedTimeSlots,
            'message' => count($bookedTimeSlots) < 3
                ? 'Celebrity is available on this date!'
                : 'Celebrity is fully booked on this date. Please select another date.'
        ]);
    }

    /**
     * Store a new booking directly
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Similar to processBooking but with different return options
        // Validate request data
        $validator = Validator::make($request->all(), [
            'celebrity_id' => 'required|exists:celebrities,id',
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'event_type' => 'required|string|max:255',
            'event_location' => 'required|string|max:255',
            'event_date' => 'required|date|after:today',
            'event_time' => 'required',
            'duration' => 'required|integer|min:30',
            'special_requests' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Process booking logic
        $celebrity = Celebrity::findOrFail($request->celebrity_id);

        // Calculate fees
        $bookingFee = is_numeric($celebrity->booking_fee) ? (float)$celebrity->booking_fee : 1000.00;
        $serviceFee = $bookingFee * 0.05;
        $totalAmount = $bookingFee + $serviceFee;

        // Create booking record
        $booking = new CelebrityBooking();
        $booking->celebrity_id = $request->celebrity_id;
        $booking->booking_reference = CelebrityBooking::generateBookingReference();
        $booking->user_id = Auth::check() ? Auth::id() : null;

        // User provided info
        $booking->full_name = $request->full_name;
        $booking->email = $request->email;
        $booking->phone = $request->phone;
        $booking->gender = $request->gender ?? null;
        $booking->address = $request->address ?? null;

        // Event details
        $booking->event_type = $request->event_type;
        $booking->event_location = $request->event_location;
        $booking->event_date = $request->event_date;
        $booking->event_time = $request->event_time;
        $booking->duration = $request->duration;
        $booking->special_requests = $request->special_requests;

        // Payment info
        $booking->booking_fee = (float)$bookingFee;
        $booking->service_fee = (float)$serviceFee;
        $booking->total_amount = (float)$totalAmount;
        $booking->payment_status = 'pending';
        $booking->booking_status = 'pending';

        $booking->save();

        // Send email notifications for new booking
        $this->sendNewBookingEmails($booking);

        // Return success response with booking details
        return response()->json([
            'success' => true,
            'message' => 'Booking created successfully',
            'booking' => [
                'reference' => $booking->booking_reference,
                'deposit_url' => route('booking.deposit', $booking->booking_reference)
            ]
        ]);
    }

    /**
     * Display a user booking details
     *
     * @param  string  $reference
     * @return \Illuminate\Http\Response
     */
    public function show($reference)
    {
        // Find booking by reference
        $booking = CelebrityBooking::where('booking_reference', $reference)
                                   ->with('celebrity')
                                   ->firstOrFail();

        // If user is logged in, ensure they own this booking or are admin
        if (Auth::check() && $booking->user_id != Auth::id()) {
            // Check if user is admin - add fallback in case isAdmin() method doesn't exist or fails
            $isAdmin = false;
            try {
                $isAdmin = method_exists(Auth::user(), 'isAdmin') ? Auth::user()->isAdmin() : false;
            } catch (\Exception $e) {
                $isAdmin = false;
            }

            if (!$isAdmin) {
                return redirect()->route('booking.history')->with('error', 'You do not have permission to view this booking');
            }
        }

        return view('home.modern_booking_details', [
            'booking' => $booking,
            'celebrity' => $booking->celebrity,
            'title' => 'Booking Details: ' . $booking->booking_reference
        ]);
    }

    /**
     * Show form to reschedule a booking
     *
     * @param  string  $reference
     * @return \Illuminate\Http\Response
     */
    public function edit($reference)
    {
        // Find booking by reference
        $booking = CelebrityBooking::where('booking_reference', $reference)
                                  ->with('celebrity')
                                  ->firstOrFail();

        // Check if booking can be edited
        if ($booking->booking_status != 'pending' && $booking->booking_status != 'approved') {
            return redirect()->route('booking.show', $booking->booking_reference)
                             ->with('error', 'This booking cannot be rescheduled due to its current status.');
        }

        // Check if user owns this booking
        if (Auth::check() && !Auth::user()->isAdmin() && $booking->user_id != Auth::id()) {
            return redirect()->route('booking.history')
                             ->with('error', 'You do not have permission to edit this booking');
        }

        return view('home.modern_booking_edit', [
            'booking' => $booking,
            'celebrity' => $booking->celebrity,
            'title' => 'Reschedule Booking'
        ]);
    }

    /**
     * Update a booking (reschedule)
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $reference
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $reference)
    {
        // Find booking by reference
        $booking = CelebrityBooking::where('booking_reference', $reference)->firstOrFail();

        // Check if booking can be edited
        if ($booking->booking_status != 'pending' && $booking->booking_status != 'approved') {
            return redirect()->back()->with('error', 'This booking cannot be rescheduled due to its current status.');
        }

        // Check if user owns this booking
        if (Auth::check() && !Auth::user()->isAdmin() && $booking->user_id != Auth::id()) {
            return redirect()->route('booking.history')->with('error', 'You do not have permission to edit this booking');
        }

        // Validate request data
        $validator = Validator::make($request->all(), [
            'event_date' => 'required|date|after:today',
            'event_time' => 'required',
            'duration' => 'required|integer|min:30',
            'event_location' => 'required|string|max:255',
            'special_requests' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Update booking details
        $booking->event_date = $request->event_date;
        $booking->event_time = $request->event_time;
        $booking->duration = $request->duration;
        $booking->event_location = $request->event_location;
        $booking->special_requests = $request->special_requests;

        // Log the change
        $booking->admin_notes = ($booking->admin_notes ? $booking->admin_notes . "\n" : '') .
                               "Booking rescheduled on " . now()->format('Y-m-d H:i:s') .
                               " by " . (Auth::check() ? Auth::user()->name : 'Customer');

        $booking->save();

        // Send notification about reschedule
        try {
            $this->sendRescheduleNotification($booking);
        } catch (\Exception $e) {
            \Log::error('Failed to send reschedule notification: ' . $e->getMessage());
        }

        return redirect()->route('booking.show', $booking->booking_reference)
                         ->with('success', 'Booking has been rescheduled successfully');
    }

    /**
     * Cancel a booking
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $reference
     * @return \Illuminate\Http\Response
     */
    public function cancelBooking(Request $request, $reference)
    {
        // Find booking by reference
        $booking = CelebrityBooking::where('booking_reference', $reference)->firstOrFail();

        // Check if booking can be cancelled
        if ($booking->booking_status == 'completed' || $booking->booking_status == 'cancelled') {
            return redirect()->back()->with('error', 'This booking cannot be cancelled due to its current status.');
        }

        // Check if user owns this booking
        if (Auth::check() && !Auth::user()->isAdmin() && $booking->user_id != Auth::id()) {
            return redirect()->route('booking.history')->with('error', 'You do not have permission to cancel this booking');
        }

        // Validate cancellation reason
        $validator = Validator::make($request->all(), [
            'cancellation_reason' => 'required|string|min:10|max:500',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Update booking status
        $booking->booking_status = 'cancelled';
        $booking->admin_notes = ($booking->admin_notes ? $booking->admin_notes . "\n" : '') .
                               "Booking cancelled on " . now()->format('Y-m-d H:i:s') .
                               " by " . (Auth::check() ? Auth::user()->name : 'Customer') .
                               ". Reason: " . $request->cancellation_reason;

        $booking->save();

        // Send cancellation notification
        try {
            $this->sendCancellationNotification($booking, $request->cancellation_reason);
        } catch (\Exception $e) {
            \Log::error('Failed to send cancellation notification: ' . $e->getMessage());
        }

        return redirect()->route('booking.history')
                         ->with('success', 'Your booking has been cancelled successfully');
    }

    /**
     * Send notification about booking reschedule
     */
    protected function sendRescheduleNotification($booking)
    {
        // Create notification record
        if ($booking->user_id) {
            \DB::table('notifications')->insert([
                'user_id' => $booking->user_id,
                'title' => 'Booking Rescheduled',
                'message' => 'Your booking with ' . $booking->celebrity->name . ' has been rescheduled to ' .
                             $booking->event_date->format('F j, Y') . ' at ' .
                             \Carbon\Carbon::parse($booking->event_time)->format('g:i A'),
                'is_read' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Get site name from settings
        $settings = Settings::first();
        $siteName = $settings ? $settings->site_name : config('app.name');

        // Send email notification
        $emailData = [
            'name' => $booking->full_name,
            'booking_reference' => $booking->booking_reference,
            'celebrity_name' => $booking->celebrity->name,
            'event_date' => $booking->event_date->format('F j, Y'),
            'event_time' => \Carbon\Carbon::parse($booking->event_time)->format('g:i A'),
            'duration' => $booking->duration,
            'event_location' => $booking->event_location,
            'site_name' => $siteName,
        ];

        \Mail::send('emails.booking_rescheduled', $emailData, function($message) use ($booking, $siteName) {
            $message->to($booking->email, $booking->full_name)
                    ->subject('Booking Rescheduled - ' . $siteName);
        });
    }

    /**
     * Send notification about booking cancellation
     */
    protected function sendCancellationNotification($booking, $reason)
    {
        // Create notification record
        if ($booking->user_id) {
            \DB::table('notifications')->insert([
                'user_id' => $booking->user_id,
                'title' => 'Booking Cancelled',
                'message' => 'Your booking with ' . $booking->celebrity->name . ' has been cancelled.',
                'is_read' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Get site name and admin email from settings
        $settings = Settings::first();
        $siteName = $settings ? $settings->site_name : config('app.name');
        $adminEmail = $settings ? $settings->contact_email : config('mail.admin_email', 'admin@example.com');

        // Send email notification
        $emailData = [
            'name' => $booking->full_name,
            'booking_reference' => $booking->booking_reference,
            'celebrity_name' => $booking->celebrity->name,
            'event_date' => $booking->event_date->format('F j, Y'),
            'event_time' => \Carbon\Carbon::parse($booking->event_time)->format('g:i A'),
            'cancellation_reason' => $reason,
            'site_name' => $siteName,
        ];

        \Mail::send('emails.booking_cancelled', $emailData, function($message) use ($booking, $siteName) {
            $message->to($booking->email, $booking->full_name)
                    ->subject('Booking Cancelled - ' . $siteName);
        });

        // Also notify admin and celebrity management
        \Mail::send('emails.admin_booking_cancelled', $emailData, function($message) use ($adminEmail, $siteName) {
            $message->to($adminEmail, 'Admin')
                    ->subject('Booking Cancellation Alert - ' . $siteName);
        });
    }

    /**
     * Display the booking form for a specific celebrity
     */
    public function showBookingForm($id, Request $request)
    {
        $celebrity = Celebrity::findOrFail($id);
        $settings = \DB::table('settings')->where('id', 1)->first();

        // Determine the booking type (default to 'booking')
        $bookingType = $request->get('type', 'booking');

        // Validate booking type
        $allowedTypes = ['booking', 'donation', 'fan_card'];
        if (!in_array($bookingType, $allowedTypes)) {
            $bookingType = 'booking';
        }

        // Get payment methods from wdmethods table
        try {
            $paymentMethods = \DB::table('wdmethods')
                ->where('status', 'enabled')
                ->where(function($query) {
                    $query->where('type', 'both')
                          ->orWhere('type', 'deposit');
                })
                ->get();
        } catch (\Exception $e) {
            // Fallback in case the table doesn't exist or there's an error
            \Log::error('Error loading payment methods: ' . $e->getMessage());
            $paymentMethods = collect([]);
        }

        // Set appropriate title and form configuration based on type
        $formConfig = $this->getFormConfig($bookingType, $celebrity);

        return view('home.booking', [
            'celebrity' => $celebrity,
            'title' => $formConfig['title'],
            'settings' => $settings,
            'bookingType' => $bookingType,
            'formConfig' => $formConfig,
            'paymentMethods' => $paymentMethods
        ]);
    }

    /**
     * Get form configuration based on booking type
     */
    private function getFormConfig($type, $celebrity)
    {
        switch ($type) {
            case 'donation':
                return [
                    'title' => 'Make a Donation with ' . $celebrity->name,
                    'subtitle' => 'Support ' . $celebrity->name . '\'s chosen charity or cause',
                    'primaryColor' => 'accent',
                    'icon' => 'heart',
                    'buttonText' => 'Process Donation',
                    'description' => 'Your donation will be directed to ' . $celebrity->name . '\'s preferred charitable organization. You\'ll receive a confirmation and acknowledgment from both our platform and the celebrity.',
                    'fields' => [
                        'donation_amount' => true,
                        'charity_preference' => true,
                        'personal_message' => true,
                        'contact_info' => true
                    ]
                ];

            case 'fan_card':
                return [
                    'title' => 'Get ' . $celebrity->name . ' VIP Fan Card',
                    'subtitle' => 'Become a VIP fan with exclusive benefits and perks',
                    'primaryColor' => 'primary',
                    'icon' => 'credit-card',
                    'buttonText' => 'Purchase Fan Card',
                    'description' => 'Join ' . $celebrity->name . '\'s exclusive fan club and enjoy priority booking, discounted rates, special content, and personalized messages.',
                    'fields' => [
                        'membership_tier' => true,
                        'personal_info' => true,
                        'shipping_address' => true,
                        'special_requests' => true
                    ]
                ];

            default: // 'booking'
                return [
                    'title' => 'Book ' . $celebrity->name,
                    'subtitle' => 'Schedule a professional booking or appearance',
                    'primaryColor' => 'primary',
                    'icon' => 'calendar',
                    'buttonText' => 'Submit Booking Request',
                    'description' => 'Book ' . $celebrity->name . ' for your event, appearance, or professional engagement. Our team will coordinate all details for a seamless experience.',
                    'fields' => [
                        'event_details' => true,
                        'location_date' => true,
                        'duration_type' => true,
                        'contact_info' => true,
                        'special_requirements' => true
                    ]
                ];
        }
    }

    /**
     * Process a new booking request
     */
    public function processBooking(Request $request)
    {
        // Determine booking type
        $bookingType = $request->get('booking_type', 'booking');

        // Preprocess data to handle backup fields (for tabs that might be hidden)
        $processedData = $request->all();

        // Use backup fields if main fields are empty (due to hidden tabs)
        if (empty($processedData['full_name']) && !empty($processedData['backup_full_name'])) {
            $processedData['full_name'] = $processedData['backup_full_name'];
        }
        if (empty($processedData['email']) && !empty($processedData['backup_email'])) {
            $processedData['email'] = $processedData['backup_email'];
        }
        if (empty($processedData['phone']) && !empty($processedData['backup_phone'])) {
            $processedData['phone'] = $processedData['backup_phone'];
        }

        // Create new request with processed data
        $request->merge($processedData);

        // Get base validation rules
        $baseRules = [
            'celebrity_id' => 'required|exists:celebrities,id',
            'booking_type' => 'required|in:booking,donation,fan_card',
            'payment_method' => 'required|string',


        ];

        // Add type-specific validation rules
        $validationRules = array_merge($baseRules, $this->getValidationRules($bookingType));

        $validator = Validator::make($request->all(), $validationRules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Get celebrity info
        $celebrity = Celebrity::findOrFail($request->celebrity_id);

        // Process based on booking type
        switch ($bookingType) {
            case 'donation':
                return $this->processDonation($request, $celebrity);

            case 'fan_card':
                return $this->processFanCard($request, $celebrity);

            default: // 'booking'
                return $this->processStandardBooking($request, $celebrity);
        }
    }

    /**
     * Get validation rules based on booking type
     */
    private function getValidationRules($type)
    {
        switch ($type) {
            case 'donation':
                return [
                    'donation_amount' => 'required|numeric|min:1',
                    'charity_preference' => 'nullable|string|max:255',
                    'personal_message' => 'nullable|string|max:1000',
                    'full_name' => 'required|string|max:255',
                    'email' => 'required|email|max:255',
                ];

            case 'fan_card':
                return [
                    'membership_tier' => 'required|in:silver,gold,platinum',
                    'full_name' => 'required|string|max:255',
                    'email' => 'required|email|max:255',
                    'phone' => 'required|string|max:20',
                    'shipping_address' => 'nullable|string|max:500',
                ];

            default: // 'booking'
                return [
                    'event_type' => 'required|string|max:255',
                    'event_location' => 'required|string|max:255',
                    'event_date' => 'required|date|after:today',
                    'event_time' => 'required',
                    'duration' => 'required|integer|min:30',
                    'full_name' => 'required|string|max:255',
                    'email' => 'required|email|max:255',
                    'phone' => 'required|string|max:20',
                    'special_requests' => 'nullable|string',
                ];
        }
    }

    /**
     * Process donation request
     */
    private function processDonation(Request $request, Celebrity $celebrity)
    {
        // Generate booking reference
        $bookingReference = 'DON-' . strtoupper(uniqid());

        // Handle payment proof file upload
        $paymentProofFilename = null;
        if ($request->hasFile('payment_proof')) {
            $proofFile = $request->file('payment_proof');
            $paymentProofFilename = 'payment_' . $bookingReference . '_' . time() . '.' . $proofFile->getClientOriginalExtension();
            $proofFile->storeAs('public/payment_proofs', $paymentProofFilename);
        }

        // Create donation record
        $booking = CelebrityBooking::create([
            'user_id' => Auth::id(),
            'celebrity_id' => $celebrity->id,
            'booking_reference' => $bookingReference,
            'booking_type' => 'donation',
            'full_name' => $request->full_name,  // Required field
            'email' => $request->email,          // Required field
            'phone' => $request->phone ?? 'N/A',
            'client_name' => $request->full_name,
            'client_email' => $request->email,
            'client_phone' => $request->phone ?? 'N/A',
            'event_type' => 'Charitable Donation',
            'event_location' => 'Online',
            'event_date' => now()->addDay(),
            'event_time' => '12:00:00',
            'duration' => 0,
            'booking_fee' => $request->donation_amount,
            'total_amount' => $request->donation_amount * 1.03, // Add 3% processing fee
            'special_requests' => $request->personal_message,
            'booking_status' => 'pending',
            'payment_method' => $request->payment_method,
            'payment_proof' => $paymentProofFilename,
            'payment_date' => Carbon::now(),
            'payment_status' => 'pending',
            'notes' => json_encode([
                'charity_preference' => $request->charity_preference,
                'donation_amount' => $request->donation_amount,
                'processing_fee' => $request->donation_amount * 0.03,
                'type' => 'donation'
            ])
        ]);

        return redirect()->route('booking.show', $bookingReference)
                        ->with('success', 'Your donation request has been submitted successfully! You will receive confirmation details shortly.');
    }

    /**
     * Process fan card request
     */
    private function processFanCard(Request $request, Celebrity $celebrity)
    {
        // Generate booking reference
        $bookingReference = 'FAN-' . strtoupper(uniqid());

        // Calculate fan card price based on tier
        $tierPrices = [
            'silver' => 99,
            'gold' => 199,
            'platinum' => 399
        ];

        $price = $tierPrices[$request->membership_tier] ?? 199;
        $processingFee = 9.95;
        $totalAmount = $price + $processingFee;

        // Handle payment proof file upload
        $paymentProofFilename = null;
        if ($request->hasFile('payment_proof')) {
            $proofFile = $request->file('payment_proof');
            $paymentProofFilename = 'payment_' . $bookingReference . '_' . time() . '.' . $proofFile->getClientOriginalExtension();
            $proofFile->storeAs('public/payment_proofs', $paymentProofFilename);
        }

        // Create fan card record
        $booking = CelebrityBooking::create([
            'user_id' => Auth::id(),
            'celebrity_id' => $celebrity->id,
            'booking_reference' => $bookingReference,
            'booking_type' => 'fan_card',
            'full_name' => $request->full_name,  // Required field
            'email' => $request->email,          // Required field
            'phone' => $request->phone,
            'client_name' => $request->full_name,
            'client_email' => $request->email,
            'client_phone' => $request->phone,
            'event_type' => 'VIP Fan Card Membership',
            'event_location' => $request->shipping_address ?? 'Digital Delivery',
            'event_date' => now()->addDays(7), // Delivery date
            'event_time' => '12:00:00',
            'duration' => 365, // 1 year membership
            'booking_fee' => $price,
            'total_amount' => $totalAmount,
            'special_requests' => $request->special_requests,
            'booking_status' => 'pending',
            'payment_method' => $request->payment_method,
            'payment_proof' => $paymentProofFilename,
            'payment_date' => Carbon::now(),
            'payment_status' => 'pending',
            'notes' => json_encode([
                'membership_tier' => $request->membership_tier,
                'shipping_address' => $request->shipping_address,
                'processing_fee' => $processingFee,
                'type' => 'fan_card'
            ])
        ]);

        return redirect()->route('booking.show', $bookingReference)
                        ->with('success', 'Your VIP Fan Card request has been submitted successfully! Your card will be processed and shipped within 7-10 business days.');
    }

    /**
     * Process standard booking request
     */
    private function processStandardBooking(Request $request, Celebrity $celebrity)
    {
        // Generate booking reference
        $bookingReference = 'CBK-' . strtoupper(uniqid());

        // Calculate total amount (booking fee + any additional costs)
        $bookingFee = $celebrity->booking_fee ?? 0;
        $totalAmount = $bookingFee;

        // Handle payment proof file upload
        $paymentProofFilename = null;
        if ($request->hasFile('payment_proof')) {
            $proofFile = $request->file('payment_proof');
            $paymentProofFilename = 'payment_' . $bookingReference . '_' . time() . '.' . $proofFile->getClientOriginalExtension();
            $proofFile->storeAs('public/payment_proofs', $paymentProofFilename);
        }

        // Create booking record
        $booking = CelebrityBooking::create([
            'user_id' => Auth::id(),
            'celebrity_id' => $celebrity->id,
            'booking_reference' => $bookingReference,
            'booking_type' => 'booking',
            'full_name' => $request->full_name,  // Required field
            'email' => $request->email,          // Required field
            'phone' => $request->phone,
            'client_name' => $request->full_name,
            'client_email' => $request->email,
            'client_phone' => $request->phone,
            'event_type' => $request->event_type,
            'event_location' => $request->event_location,
            'event_date' => $request->event_date,
            'event_time' => $request->event_time,
            'duration' => $request->duration,
            'booking_fee' => $bookingFee,
            'total_amount' => $totalAmount,
            'special_requests' => $request->special_requests,
            'booking_status' => 'pending',
            'payment_method' => $request->payment_method,
            'payment_proof' => $paymentProofFilename,
            'payment_date' => Carbon::now(),
            'payment_status' => 'pending',
            'notes' => json_encode([
                'type' => 'booking'
            ])
        ]);

        return redirect()->route('booking.show', $bookingReference)
                        ->with('success', 'Your booking request has been submitted successfully! We will review your request and get back to you within 24 hours.');
    }

    /**
     * Show the deposit/payment page for a booking
     */
    public function showDepositPage($reference)
    {
        $booking = CelebrityBooking::where('booking_reference', $reference)->firstOrFail();
        $celebrity = $booking->celebrity;

        // Get payment methods from wdmethods table
        try {
            $paymentMethods = \DB::table('wdmethods')
                ->where('status', 'enabled')
                ->where(function($query) {
                    $query->where('type', 'both')
                          ->orWhere('type', 'deposit');
                })
                ->get();
        } catch (\Exception $e) {
            // Fallback in case the table doesn't exist or there's an error
            \Log::error('Error loading payment methods: ' . $e->getMessage());
            $paymentMethods = collect([
                (object)[
                    'id' => 1,
                    'name' => 'Bank Transfer',
                    'methodtype' => 'currency',
                    'bankname' => 'Default Bank',
                    'account_name' => 'Default Account',
                    'account_number' => '1234567890',
                    'swift_code' => 'DEFBANK',
                    'status' => 'enabled',
                ],
                (object)[
                    'id' => 2,
                    'name' => 'Bitcoin',
                    'methodtype' => 'crypto',
                    'wallet_address' => 'bc1qxy2kgdygjrsqtzq2n0yrf2493p83kkfjhx0wlh',
                    'network' => 'BTC',
                    'status' => 'enabled',
                ]
            ]);
        }

        return view('home.booking_deposit', [
            'title' => 'Complete Booking Payment',
            'booking' => $booking,
            'celebrity' => $celebrity,
            'payment_methods' => $paymentMethods
        ]);
    }

    /**
     * Process payment for a booking
     */
    public function processPayment(Request $request)
    {
        // Validate request data
        $validator = Validator::make($request->all(), [
            'booking_reference' => 'required|exists:celebrity_bookings,booking_reference',
            // 'payment_method' => 'required|string',
            'proof' => 'required|image|max:5120', // 5MB max
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Get the booking
        $booking = CelebrityBooking::where('booking_reference', $request->booking_reference)->firstOrFail();

        // Store payment proof
        if ($request->hasFile('proof')) {
            $proofFile = $request->file('proof');
            $filename = 'payment_' . $booking->booking_reference . '_' . time() . '.' . $proofFile->getClientOriginalExtension();
            $path = $proofFile->storeAs('public/payment_proofs', $filename);
            $booking->payment_proof = $filename;
        }

        // Update payment information
        $booking->payment_method = $request->payment_method;
        $booking->payment_date = Carbon::now();
        $booking->payment_status = 'pending'; // Admin needs to verify the payment
        $booking->save();

        // Redirect to receipt page
        return redirect()->route('booking.receipt', $booking->booking_reference);
    }

    /**
     * Show the receipt page after payment submission
     */
    public function showReceiptPage($reference)
    {
        $booking = CelebrityBooking::where('booking_reference', $reference)->firstOrFail();
        $celebrity = $booking->celebrity;

        return view('home.booking_receipt', [
            'title' => 'Booking Confirmation',
            'booking' => $booking,
            'celebrity' => $celebrity
        ]);
    }

    /**
     * Admin: Show list of all bookings
     */
    public function adminIndex(Request $request)
    {
        $query = CelebrityBooking::with('celebrity', 'user');

        // Filter by status
        if ($request->status) {
            $query->where('booking_status', $request->status);
        }

        // Filter by payment status
        if ($request->payment_status) {
            $query->where('payment_status', $request->payment_status);
        }

        // Filter by celebrity
        if ($request->celebrity_id) {
            $query->where('celebrity_id', $request->celebrity_id);
        }

        // Filter by date range
        if ($request->start_date) {
            $query->whereDate('event_date', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $query->whereDate('event_date', '<=', $request->end_date);
        }

        // Search by name, email, or reference
        if ($request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('booking_reference', 'like', "%{$search}%")
                  ->orWhere('full_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // Sort results
        $sortField = $request->sort_by ?? 'created_at';
        $sortDirection = $request->sort_direction ?? 'desc';
        $query->orderBy($sortField, $sortDirection);

        $bookings = $query->paginate(15)->appends($request->all());
        $celebrities = \App\Models\Celebrity::all();

        return view('admin.celebrity.booking', [
            'bookings' => $bookings,
            'celebrities' => $celebrities,
            'title' => 'Manage Celebrity Bookings',
            'filters' => $request->all()
        ]);
    }

    /**
     * Admin: Show booking details
     */
    public function adminShow($id)
    {
        $booking = CelebrityBooking::with(['celebrity', 'user'])->findOrFail($id);

        // Get payment proof URL if exists
        $paymentProofUrl = null;
        if ($booking->payment_proof) {
            $paymentProofUrl = Storage::url('public/payment_proofs/' . $booking->payment_proof);
        }

        return view('admin.celebrity.show', [
            'booking' => $booking,
            'payment_proof_url' => $paymentProofUrl,
            'title' => 'Booking Details: ' . $booking->booking_reference
        ]);
    }

    /**
     * Admin: Show edit form for a booking
     */
    public function adminEdit($id)
    {
        $booking = CelebrityBooking::with(['celebrity', 'user'])->findOrFail($id);
        $celebrities = \App\Models\Celebrity::all();

        return view('admin.celebrity.edit', [
            'booking' => $booking,
            'celebrities' => $celebrities,
            'title' => 'Edit Booking: ' . $booking->booking_reference
        ]);
    }

    /**
     * Admin: Quick status update (for AJAX calls)
     */
    public function quickStatusUpdate(Request $request, $id)
    {
        try {
            $booking = CelebrityBooking::findOrFail($id);

            // Validate input
            $validator = Validator::make($request->all(), [
                'status' => 'required|in:approved,rejected,completed,cancelled',
                'notes' => 'nullable|string'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid input data',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Store old status for comparison
            $oldStatus = $booking->booking_status;
            $oldPaymentStatus = $booking->payment_status;

            // Get admin info
            $adminName = Auth::guard('admin')->user()->name ?? Auth::user()->name ?? 'Administrator';
            $settings = Settings::first();
            $adminEmail = $settings->contact_email ?? 'admin@system.com';

            // Update booking status
            $booking->booking_status = $request->status;

            // Handle payment status based on new booking status
            $paymentStatusMessage = "";
            $refundRequired = false;

            switch ($request->status) {
                case 'approved':
                    if ($booking->payment_status === 'cancelled' || $booking->payment_status === 'refunded') {
                        $booking->payment_status = 'pending';
                        $paymentStatusMessage = " Payment status reset to pending.";
                    }
                    break;

                case 'rejected':
                case 'cancelled':
                    if ($booking->payment_status === 'paid') {
                        $booking->payment_status = 'refunded';
                        $paymentStatusMessage = " Payment refund required.";
                        $refundRequired = true;
                    } elseif ($booking->payment_status === 'pending') {
                        $booking->payment_status = 'cancelled';
                        $paymentStatusMessage = " Payment cancelled.";
                    }
                    break;

                case 'completed':
                    if ($booking->payment_status !== 'paid') {
                        $booking->payment_status = 'paid';
                        $paymentStatusMessage = " Payment marked as paid.";
                    }
                    break;
            }

            // Add admin notes
            $statusNote = "[" . now()->format('Y-m-d H:i:s') . " - {$adminName}]\n" .
                         "Quick status update: {$oldStatus} → {$request->status}" .
                         $paymentStatusMessage;

            if ($request->notes) {
                $statusNote .= "\nNotes: " . $request->notes;
            }

            if ($refundRequired) {
                $statusNote .= "\n🚨 REFUND REQUIRED: $" . number_format($booking->total_amount, 2);
            }

            $booking->admin_notes = $booking->admin_notes
                ? $booking->admin_notes . "\n\n" . $statusNote
                : $statusNote;

            $booking->save();

            // Send email notification
            if ($oldStatus !== $request->status) {
                try {
                    $this->sendStatusUpdateEmail($booking, $oldStatus);
                } catch (\Exception $e) {
                    \Log::error('Quick status update email failed: ' . $e->getMessage());
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Status updated successfully' . $paymentStatusMessage,
                'new_status' => $request->status,
                'payment_status' => $booking->payment_status,
                'refund_required' => $refundRequired
            ]);

        } catch (\Exception $e) {
            \Log::error('Quick status update failed: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to update status: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Admin: Update booking status (simplified version for modal forms)
     */
    public function adminUpdateStatus(Request $request, $id)
    {
        $booking = CelebrityBooking::findOrFail($id);

        // Validate input - allow both booking_status and optional payment_status
        $validator = Validator::make($request->all(), [
            'booking_status' => 'required|in:pending,approved,rejected,completed,cancelled',
            'payment_status' => 'nullable|in:pending,paid,cancelled,refunded',
            'admin_notes' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Store old statuses for comparison and logging
        $oldBookingStatus = $booking->booking_status;
        $oldPaymentStatus = $booking->payment_status;

        // Get admin info
        $adminName = Auth::guard('admin')->user()->name ?? Auth::user()->name ?? 'Administrator';
        $settings = Settings::first();
        $adminEmail = $settings->contact_email ?? 'admin@system.com';

        // Update booking status
        $booking->booking_status = $request->booking_status;

        // Handle payment status updates
        $paymentStatusMessage = "";
        $refundRequired = false;
        $manualPaymentOverride = false;

        // Check if payment status was manually provided
        if ($request->has('payment_status') && !empty($request->payment_status)) {
            // Manual payment status override
            $booking->payment_status = $request->payment_status;
            $manualPaymentOverride = true;
            $paymentStatusMessage = "\n🔧 Payment status manually set to '{$request->payment_status}' by admin";

            // Check if refund is required for manual override
            if ($request->payment_status === 'refunded' && $oldPaymentStatus === 'paid') {
                $refundRequired = true;
            }
        } else {
            // Smart automatic payment status handling based on new booking status
            switch ($request->booking_status) {
                case 'approved':
                    // When approving, keep payment status as is unless it was cancelled/refunded
                    if ($booking->payment_status === 'cancelled') {
                        $booking->payment_status = 'pending';
                        $paymentStatusMessage = "\n🔄 Payment status auto-changed from 'cancelled' to 'pending' - customer can now make payment";
                    } elseif ($booking->payment_status === 'refunded') {
                        $booking->payment_status = 'pending';
                        $paymentStatusMessage = "\n🔄 Payment status auto-changed from 'refunded' to 'pending' - customer can now make payment";
                    } else {
                        $paymentStatusMessage = "\n💰 Payment status remains '{$booking->payment_status}'";
                    }
                    break;

                case 'rejected':
                    // When rejecting, handle payment appropriately
                    if ($booking->payment_status === 'paid') {
                        $booking->payment_status = 'refunded';
                        $paymentStatusMessage = "\n💸 Payment status auto-changed to 'refunded' - REFUND REQUIRED";
                        $refundRequired = true;
                    } elseif ($booking->payment_status === 'pending') {
                        $booking->payment_status = 'cancelled';
                        $paymentStatusMessage = "\n❌ Payment status auto-changed to 'cancelled' - no payment required";
                    } else {
                        $paymentStatusMessage = "\n💰 Payment status remains '{$booking->payment_status}'";
                    }
                    break;

                case 'cancelled':
                    // When cancelling, handle payment appropriately
                    if ($booking->payment_status === 'paid') {
                        $booking->payment_status = 'refunded';
                        $paymentStatusMessage = "\n💸 Payment status auto-changed to 'refunded' - REFUND REQUIRED";
                        $refundRequired = true;
                    } elseif ($booking->payment_status === 'pending') {
                        $booking->payment_status = 'cancelled';
                        $paymentStatusMessage = "\n❌ Payment status auto-changed to 'cancelled' - no payment required";
                    } else {
                        $paymentStatusMessage = "\n💰 Payment status remains '{$booking->payment_status}'";
                    }
                    break;

                case 'completed':
                    // When completing, ensure payment is marked as paid
                    if ($booking->payment_status !== 'paid') {
                        $booking->payment_status = 'paid';
                        $booking->payment_date = now(); // Set payment date when marking as paid
                        $paymentStatusMessage = "\n✅ Payment status auto-changed to 'paid' - booking completed";
                    } else {
                        $paymentStatusMessage = "\n✅ Payment status confirmed as 'paid'";
                    }
                    break;

                default:
                    // For pending or any other status, keep payment status as is
                    $paymentStatusMessage = "\n💰 Payment status remains '{$booking->payment_status}'";
                    break;
            }
        }

        // Add admin notes with timestamp and admin name
        $statusChangeNote = "[" . now()->format('Y-m-d H:i:s') . " - {$adminName} ({$adminEmail})]\n" .
                           "📝 Status updated via admin panel\n" .
                           "Booking status: '{$oldBookingStatus}' → '{$request->booking_status}'\n" .
                           "Payment status: '{$oldPaymentStatus}' → '{$booking->payment_status}'" .
                           $paymentStatusMessage;

        // Add information about manual override
        if ($manualPaymentOverride) {
            $statusChangeNote .= "\n⚠️ Payment status was manually overridden by admin";
        }

        // Add custom admin notes if provided
        if ($request->admin_notes) {
            $statusChangeNote .= "\n📋 Admin notes: " . $request->admin_notes;
        }

        if ($refundRequired) {
            $statusChangeNote .= "\n🚨 ACTION REQUIRED: Process refund of $" . number_format($booking->total_amount, 2) . " to customer";
        }

        // Append to existing admin notes
        $booking->admin_notes = $booking->admin_notes
            ? $booking->admin_notes . "\n\n" . $statusChangeNote
            : $statusChangeNote;

        // Save the changes
        $booking->save();

        // Log the action for audit trail
        \Log::info('Booking status updated via admin panel', [
            'booking_id' => $booking->id,
            'booking_reference' => $booking->booking_reference,
            'admin_user' => $adminName,
            'admin_email' => $adminEmail,
            'old_booking_status' => $oldBookingStatus,
            'new_booking_status' => $request->booking_status,
            'old_payment_status' => $oldPaymentStatus,
            'new_payment_status' => $booking->payment_status,
            'payment_changed' => $oldPaymentStatus !== $booking->payment_status,
            'manual_payment_override' => $manualPaymentOverride,
            'refund_required' => $refundRequired,
            'admin_notes' => $request->admin_notes,
            'timestamp' => now()->toDateTimeString()
        ]);

        // Send notification email to customer if status changed
        if ($oldBookingStatus !== $request->booking_status) {
            try {
                $this->sendStatusUpdateEmail($booking, $oldBookingStatus);
            } catch (\Exception $e) {
                \Log::error('Failed to send booking status update email', [
                    'booking_id' => $booking->id,
                    'error' => $e->getMessage()
                ]);
                // Continue execution - email failure shouldn't stop status update
            }
        }

        // Create comprehensive success message
        $successMessage = "✅ Booking {$booking->booking_reference} status updated to: " . ucfirst($request->booking_status);

        // Add payment status information
        if ($oldPaymentStatus !== $booking->payment_status) {
            $successMessage .= " 💰 Payment status updated: {$oldPaymentStatus} → {$booking->payment_status}";

            if ($manualPaymentOverride) {
                $successMessage .= " (manually set by admin)";
            }
        }

        // Add specific warnings/notifications based on payment status
        if ($refundRequired) {
            $successMessage .= " 🚨 URGENT: Refund of $" . number_format($booking->total_amount, 2) . " required!";
        } elseif ($booking->payment_status === 'cancelled') {
            $successMessage .= " ✅ No payment processing required.";
        } elseif ($booking->payment_status === 'paid') {
            $successMessage .= " ✅ Payment confirmed.";
        }

        $successMessage .= " Customer has been notified via email.";

        return redirect()->route('admin.bookings.show', $booking->id)->with('success', $successMessage);
    }

    /**
     * Admin: Add a note to booking without changing status
     */
    public function adminAddNote(Request $request, $id)
    {
        $booking = CelebrityBooking::findOrFail($id);

        // Validate input
        $validator = Validator::make($request->all(), [
            'note' => 'required|string|min:5'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Add admin notes with timestamp and admin name
        $adminName = Auth::user()->name ?? 'Administrator';
        $booking->admin_notes = ($booking->admin_notes ? $booking->admin_notes . "\n\n" : '') .
                               "[" . now()->format('Y-m-d H:i:s') . " - {$adminName}]\n" .
                               $request->note;

        $booking->save();

        return redirect()->route('admin.bookings.show', $booking->id)->with('success', 'Note added successfully');
    }

    /**
     * Admin: Send custom email to customer
     */
    public function adminEmailCustomer(Request $request, $id)
    {
        $booking = CelebrityBooking::findOrFail($id);

        // Validate input
        $validator = Validator::make($request->all(), [
            'subject' => 'required|string|min:5|max:100',
            'message' => 'required|string|min:10'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Send email
        try {
            $emailData = [
                'name' => $booking->full_name,
                'booking_reference' => $booking->booking_reference,
                'celebrity_name' => $booking->celebrity->name,
                'custom_message' => $request->message,
                'admin_name' => Auth::user()->name ?? 'Administrator',
            ];

            \Mail::send('emails.admin_custom_message', $emailData, function($message) use ($booking, $request) {
                $message->to($booking->email, $booking->full_name)
                        ->subject($request->subject);
            });

            // Log the email in admin notes
            $adminName = Auth::user()->name ?? 'Administrator';
            $booking->admin_notes = ($booking->admin_notes ? $booking->admin_notes . "\n\n" : '') .
                                   "[" . now()->format('Y-m-d H:i:s') . " - {$adminName}]\n" .
                                   "Email sent to customer with subject: " . $request->subject;

            $booking->save();

            return redirect()->route('admin.bookings.show', $booking->id)->with('success', 'Email sent successfully');
        } catch (\Exception $e) {
            \Log::error('Failed to send custom email: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to send email: ' . $e->getMessage());
        }
    }

    /**
     * Admin: Cancel a booking with reason
     */
    public function adminCancelBooking(Request $request, $id)
    {
        $booking = CelebrityBooking::findOrFail($id);

        // Validate input
        $validator = Validator::make($request->all(), [
            'cancellation_reason' => 'required|string|min:10|max:1000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Check if booking can be cancelled
        if ($booking->booking_status == 'completed') {
            return redirect()->back()->with('error', 'Cannot cancel a completed booking.');
        }

        if ($booking->booking_status == 'cancelled') {
            return redirect()->back()->with('error', 'This booking is already cancelled.');
        }

        // Store old status for email notification
        $oldStatus = $booking->booking_status;
        $oldPaymentStatus = $booking->payment_status;

        // Update booking status to cancelled
        $booking->booking_status = 'cancelled';

        // Handle payment status based on current status
        $paymentStatusMessage = "";
        $refundRequired = false;

        if ($booking->payment_status === 'paid') {
            // Customer has paid - mark for refund
            $booking->payment_status = 'refunded';
            $paymentStatusMessage = "\n💸 Payment status changed to 'refunded' - REFUND REQUIRED";
            $refundRequired = true;
        } elseif ($booking->payment_status === 'pending') {
            // Payment pending - cancel it
            $booking->payment_status = 'cancelled';
            $paymentStatusMessage = "\n❌ Payment status changed to 'cancelled' - no payment required";
        }

        // Get admin info from settings
        $settings = Settings::first();
        $adminName = Auth::guard('admin')->user()->name ?? Auth::user()->name ?? 'Administrator';
        $adminEmail = $settings ? $settings->contact_email : 'admin@system.com';

        // Add detailed admin notes
        $newNote = "[" . now()->format('Y-m-d H:i:s') . " - {$adminName} ({$adminEmail})]\n" .
                  "❌ Booking CANCELLED by admin\n" .
                  "Status changed from '{$oldStatus}' to 'cancelled'\n" .
                  "Payment status: {$oldPaymentStatus} → {$booking->payment_status}" .
                  $paymentStatusMessage . "\n" .
                  "Cancellation reason: " . $request->cancellation_reason;

        if ($refundRequired) {
            $newNote .= "\n🚨 ACTION REQUIRED: Process refund of $" . number_format((float)$booking->total_amount, 2) . " to customer";
        }

        $booking->admin_notes = $booking->admin_notes
            ? $booking->admin_notes . "\n\n" . $newNote
            : $newNote;

        // Save the changes
        $booking->save();

        // Log the action for audit trail
        \Log::info('Booking cancelled by admin', [
            'booking_id' => $booking->id,
            'booking_reference' => $booking->booking_reference,
            'admin_user' => $adminName,
            'admin_email' => $adminEmail,
            'old_status' => $oldStatus,
            'new_status' => 'cancelled',
            'old_payment_status' => $oldPaymentStatus,
            'new_payment_status' => $booking->payment_status,
            'cancellation_reason' => $request->cancellation_reason,
            'refund_required' => $refundRequired,
            'timestamp' => now()->toDateTimeString()
        ]);

        // Send notification email to customer
        try {
            $this->sendCancellationNotification($booking, $request->cancellation_reason);
        } catch (\Exception $e) {
            \Log::error('Failed to send booking cancellation email', [
                'booking_id' => $booking->id,
                'error' => $e->getMessage()
            ]);
            // Continue execution - email failure shouldn't stop cancellation
        }

        // Create comprehensive success message
        $message = "❌ Booking {$booking->booking_reference} has been cancelled successfully. Customer has been notified via email.";

        // Add payment status information
        if ($oldPaymentStatus !== $booking->payment_status) {
            $message .= " 💰 Payment status updated: {$oldPaymentStatus} → {$booking->payment_status}";
        }

        // Add specific warnings/notifications based on payment status
        if ($refundRequired) {
            $message .= " 🚨 URGENT: Refund of $" . number_format((float)$booking->total_amount, 2) . " required!";
        } elseif ($booking->payment_status === 'cancelled') {
            $message .= " ✅ No payment processing required.";
        }

        return redirect()->route('admin.bookings.show', $booking->id)
            ->with('success', $message);
    }

    /**
     * Admin: Delete a booking
     */
    public function adminDestroy($id)
    {
        $booking = CelebrityBooking::findOrFail($id);

        // Delete payment proof file if exists
        if ($booking->payment_proof) {
            Storage::delete('public/payment_proofs/' . $booking->payment_proof);
        }

        // Delete booking
        $booking->delete();

        return redirect()->route('admin.celebrity.booking')->with('success', 'Booking deleted successfully');
    }

    /**
     * Send status update email notification to user
     *
     * @param \App\Models\CelebrityBooking $booking
     * @param string|null $oldStatus The previous status if applicable
     * @return void
     */
    /**
     * Find guest bookings and associate them with the current user account
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function findGuestBooking(Request $request)
    {
        // Validate request data
        $validator = Validator::make($request->all(), [
            'booking_reference' => 'required|exists:celebrity_bookings,booking_reference',
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Invalid booking reference or email address.');
        }

        // Find the booking
        $booking = CelebrityBooking::where('booking_reference', $request->booking_reference)
                                  ->where('email', $request->email)
                                  ->first();

        if (!$booking) {
            return redirect()->back()->with('error', 'No booking found with the provided reference and email address.');
        }

        // Check if user is logged in
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to associate this booking with your account.')
                            ->with('booking_reference', $request->booking_reference)
                            ->with('email', $request->email);
        }

        // Check if booking is already associated with another account
        if ($booking->user_id && $booking->user_id != Auth::id()) {
            return redirect()->back()->with('error', 'This booking is already associated with another user account.');
        }

        // Associate booking with current user
        $booking->user_id = Auth::id();
        $booking->save();

        return redirect()->route('booking.history')->with('success', 'The booking has been successfully linked to your account!');
    }

    protected function sendStatusUpdateEmail($booking, $oldStatus = null)
    {
        // If user has an account, send through notification system
        if ($booking->user_id) {
            // Create notification record in database
            \DB::table('notifications')->insert([
                'user_id' => $booking->user_id,
                'title' => 'Booking Status Updated',
                'message' => 'Your booking with reference ' . $booking->booking_reference . ' has been updated to: ' . ucfirst($booking->booking_status),
                'is_read' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Get site name from settings
        $settings = Settings::first();
        $siteName = $settings ? $settings->site_name : config('app.name');

        // Send email regardless if they have an account
        $emailData = [
            'name' => $booking->full_name,
            'booking_reference' => $booking->booking_reference,
            'celebrity_name' => $booking->celebrity->name,
            'event_date' => $booking->event_date->format('F j, Y'),
            'event_time' => \Carbon\Carbon::parse($booking->event_time)->format('g:i A'),
            'new_status' => $booking->booking_status, // For the template
            'old_status' => $oldStatus, // For the template
            'booking_status' => ucfirst($booking->booking_status),
            'payment_status' => ucfirst($booking->payment_status),
            'admin_notes' => $booking->admin_notes,
            'status_change_time' => now()->format('F j, Y g:i A'),
            'site_name' => $siteName,
        ];

        \Mail::send('emails.booking_status_update', $emailData, function($message) use ($booking, $siteName) {
            $message->to($booking->email, $booking->full_name)
                    ->subject('Booking Status Update - ' . $siteName);
        });
    }

    /**
     * Send email notifications for new booking
     * - Confirmation email to user
     * - Booking details to admin
     */
    protected function sendNewBookingEmails($booking)
    {
        try {
            // Get admin email and site name from settings
            $settings = Settings::first();
            $adminEmail = $settings ? $settings->contact_email : config('mail.from.address');
            $siteName = $settings ? $settings->site_name : config('app.name');

            // Prepare common email data
            $emailData = [
                'name' => $booking->full_name,
                'booking_reference' => $booking->booking_reference,
                'celebrity_name' => $booking->celebrity->name,
                'event_type' => $booking->event_type,
                'event_location' => $booking->event_location,
                'event_date' => \Carbon\Carbon::parse($booking->event_date)->format('F j, Y'),
                'event_time' => \Carbon\Carbon::parse($booking->event_time)->format('g:i A'),
                'duration' => $booking->duration,
                'booking_fee' => number_format($booking->booking_fee, 2),
                'service_fee' => number_format($booking->service_fee, 2),
                'total_amount' => number_format($booking->total_amount, 2),
                'special_requests' => $booking->special_requests,
                'phone' => $booking->phone,
                'email' => $booking->email,
                'booking_status' => ucfirst($booking->booking_status),
                'payment_status' => ucfirst($booking->payment_status),
                'created_at' => $booking->created_at->format('F j, Y g:i A'),
                'site_name' => $siteName,
            ];

            // Send confirmation email to user
            \Mail::send('emails.booking_confirmation', $emailData, function($message) use ($booking, $siteName) {
                $message->to($booking->email, $booking->full_name)
                        ->subject('Booking Confirmation - ' . $siteName);
            });

            // Send booking details to admin
            \Mail::send('emails.admin_new_booking', $emailData, function($message) use ($adminEmail, $siteName) {
                $message->to($adminEmail)
                        ->subject('New Booking Received - ' . $siteName);
            });

        } catch (\Exception $e) {
            // Log email errors but don't fail the booking process
            \Log::error('Failed to send new booking emails: ' . $e->getMessage());
        }
    }

    /**
     * Admin: Approve booking (GET route)
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function approveBooking($id)
    {
        try {
            $booking = CelebrityBooking::findOrFail($id);

            // Check if booking is still pending
            if ($booking->booking_status !== 'pending') {
                return redirect()->route('admin.bookings.index')
                    ->with('error', 'Booking is no longer pending and cannot be approved. Current status: ' . ucfirst($booking->booking_status));
            }

            // Store old status for email notification
            $oldStatus = $booking->booking_status;
            $oldPaymentStatus = $booking->payment_status;

            // Update booking status to approved
            $booking->booking_status = 'approved';

            // Smart payment status handling for approval
            $paymentStatusMessage = "";
            if ($booking->payment_status === 'pending') {
                // For pending payments, keep as pending but add note
                $paymentStatusMessage = "\n💰 Payment status remains 'pending' - awaiting customer payment";
            } elseif ($booking->payment_status === 'paid') {
                // Already paid, keep as paid
                $paymentStatusMessage = "\n✅ Payment status: Customer has already paid";
            } elseif ($booking->payment_status === 'cancelled') {
                // If payment was cancelled, reset to pending for new payment attempt
                $booking->payment_status = 'pending';
                $paymentStatusMessage = "\n🔄 Payment status changed from 'cancelled' to 'pending' - customer can now make payment";
            } elseif ($booking->payment_status === 'refunded') {
                // If previously refunded, reset to pending for new payment
                $booking->payment_status = 'pending';
                $paymentStatusMessage = "\n🔄 Payment status changed from 'refunded' to 'pending' - customer can now make payment";
            }

            // Add admin notes with timestamp and admin name
            $adminName = Auth::guard('admin')->user()->name ?? 'Administrator';
            $settings = Settings::first();
            $adminEmail = $settings->contact_email ?? 'admin@system.com';

            $newNote = "[" . now()->format('Y-m-d H:i:s') . " - {$adminName} ({$adminEmail})]\n" .
                      "✅ Booking APPROVED via quick approval\n" .
                      "Status changed from '{$oldStatus}' to 'approved'\n" .
                      "Payment status: {$oldPaymentStatus} → {$booking->payment_status}" .
                      $paymentStatusMessage;

            $booking->admin_notes = $booking->admin_notes
                ? $booking->admin_notes . "\n\n" . $newNote
                : $newNote;

            // Save the changes
            $booking->save();

            // Log the action for audit trail
            \Log::info('Booking approved', [
                'booking_id' => $booking->id,
                'booking_reference' => $booking->booking_reference,
                'admin_user' => $adminName,
                'admin_email' => $adminEmail,
                'old_status' => $oldStatus,
                'new_status' => 'approved',
                'old_payment_status' => $oldPaymentStatus,
                'new_payment_status' => $booking->payment_status,
                'payment_changed' => $oldPaymentStatus !== $booking->payment_status,
                'timestamp' => now()->toDateTimeString()
            ]);

            // Send notification email to customer
            try {
                $this->sendStatusUpdateEmail($booking, $oldStatus);
            } catch (\Exception $e) {
                \Log::error('Failed to send booking approval email', [
                    'booking_id' => $booking->id,
                    'error' => $e->getMessage()
                ]);
                // Continue execution - email failure shouldn't stop approval
            }

            // Create success message with payment status info
            $successMessage = "✅ Booking {$booking->booking_reference} has been approved successfully! Customer has been notified via email.";

            if ($oldPaymentStatus !== $booking->payment_status) {
                $successMessage .= " 💰 Payment status updated to: " . ucfirst($booking->payment_status);
            } else {
                $successMessage .= " 💰 Payment status: " . ucfirst($booking->payment_status);
            }

            return redirect()->route('admin.bookings.index')
                ->with('success', $successMessage);

        } catch (\Exception $e) {
            \Log::error('Booking approval failed', [
                'booking_id' => $id,
                'error' => $e->getMessage(),
                'admin_user' => Auth::guard('admin')->user()->name ?? 'Unknown'
            ]);

            return redirect()->route('admin.bookings.index')
                ->with('error', 'Failed to approve booking. Please try again. Error: ' . $e->getMessage());
        }
    }

    /**
     * Admin: Reject booking (GET route)
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function rejectBooking($id)
    {
        try {
            $booking = CelebrityBooking::findOrFail($id);

            // Check if booking is still pending
            if ($booking->booking_status !== 'pending') {
                return redirect()->route('admin.bookings.index')
                    ->with('error', 'Booking is no longer pending and cannot be rejected. Current status: ' . ucfirst($booking->booking_status));
            }

            // Store old status for email notification
            $oldStatus = $booking->booking_status;
            $oldPaymentStatus = $booking->payment_status;

            // Update booking status to rejected
            $booking->booking_status = 'rejected';

            // Smart payment status handling for rejection
            $paymentStatusMessage = "";
            $refundRequired = false;

            if ($booking->payment_status === 'paid') {
                // Customer has paid - mark for refund
                $booking->payment_status = 'refunded';
                $paymentStatusMessage = "\n💸 Payment status changed to 'refunded' - REFUND REQUIRED";
                $refundRequired = true;
            } elseif ($booking->payment_status === 'pending') {
                // Payment pending - cancel it
                $booking->payment_status = 'cancelled';
                $paymentStatusMessage = "\n❌ Payment status changed to 'cancelled' - no payment required";
            } elseif ($booking->payment_status === 'cancelled') {
                // Already cancelled, no change needed
                $paymentStatusMessage = "\n❌ Payment status remains 'cancelled'";
            } elseif ($booking->payment_status === 'refunded') {
                // Already refunded, no change needed
                $paymentStatusMessage = "\n💸 Payment status remains 'refunded'";
            }

            // Add admin notes with timestamp and admin name
            $adminName = Auth::guard('admin')->user()->name ?? 'Administrator';
            $settings = Settings::first();
            $adminEmail = $settings->contact_email ?? 'admin@system.com';

            $newNote = "[" . now()->format('Y-m-d H:i:s') . " - {$adminName} ({$adminEmail})]\n" .
                      "❌ Booking REJECTED via quick rejection\n" .
                      "Status changed from '{$oldStatus}' to 'rejected'\n" .
                      "Payment status: {$oldPaymentStatus} → {$booking->payment_status}" .
                      $paymentStatusMessage . "\n" .
                      "Reason: Quick rejection by admin";

            if ($refundRequired) {
                $newNote .= "\n🚨 ACTION REQUIRED: Process refund of $" . number_format($booking->total_amount, 2) . " to customer";
            }

            $booking->admin_notes = $booking->admin_notes
                ? $booking->admin_notes . "\n\n" . $newNote
                : $newNote;

            // Save the changes
            $booking->save();

            // Log the action for audit trail
            \Log::info('Booking rejected', [
                'booking_id' => $booking->id,
                'booking_reference' => $booking->booking_reference,
                'admin_user' => $adminName,
                'admin_email' => $adminEmail,
                'old_status' => $oldStatus,
                'new_status' => 'rejected',
                'old_payment_status' => $oldPaymentStatus,
                'new_payment_status' => $booking->payment_status,
                'payment_changed' => $oldPaymentStatus !== $booking->payment_status,
                'refund_required' => $refundRequired,
                'timestamp' => now()->toDateTimeString()
            ]);

            // Send notification email to customer
            try {
                $this->sendStatusUpdateEmail($booking, $oldStatus);
            } catch (\Exception $e) {
                \Log::error('Failed to send booking rejection email', [
                    'booking_id' => $booking->id,
                    'error' => $e->getMessage()
                ]);
                // Continue execution - email failure shouldn't stop rejection
            }

            // Create comprehensive success message with payment status info
            $message = "❌ Booking {$booking->booking_reference} has been rejected. Customer has been notified via email.";

            // Add payment status information
            if ($oldPaymentStatus !== $booking->payment_status) {
                $message .= " 💰 Payment status updated: {$oldPaymentStatus} → {$booking->payment_status}";
            } else {
                $message .= " 💰 Payment status: " . ucfirst($booking->payment_status);
            }

            // Add specific warnings/notifications based on payment status
            if ($refundRequired) {
                $message .= " 🚨 URGENT: Refund of $" . number_format($booking->total_amount, 2) . " required!";
            } elseif ($booking->payment_status === 'cancelled') {
                $message .= " ✅ No payment processing required.";
            }

            return redirect()->route('admin.bookings.index')
                ->with('success', $message);

        } catch (\Exception $e) {
            \Log::error('Booking rejection failed', [
                'booking_id' => $id,
                'error' => $e->getMessage(),
                'admin_user' => Auth::guard('admin')->user()->name ?? 'Unknown'
            ]);

            return redirect()->route('admin.bookings.index')
                ->with('error', 'Failed to reject booking. Please try again. Error: ' . $e->getMessage());
        }
    }
}
