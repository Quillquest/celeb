@extends('home.base1')

@section('title', $title)

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <!-- Booking Details Header -->
    <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-8">
        <div>
            <h1 class="text-3xl font-extrabold text-gray-900">Booking Details</h1>
            <p class="mt-2 text-sm text-gray-500">
                Reference: <span class="font-medium text-gray-800">{{ $booking->booking_reference }}</span>
            </p>
        </div>
        <div class="mt-4 md:mt-0 flex flex-wrap gap-3">
            @if(in_array($booking->booking_status, ['pending', 'approved']))
                <a href="{{ route('booking.edit', $booking->booking_reference) }}" 
                   class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    Reschedule
                </a>
            @endif
            
            @if($booking->booking_status != 'cancelled' && $booking->booking_status != 'completed')
                <button type="button" 
                        onclick="document.getElementById('cancel-modal').classList.remove('hidden')" 
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    Cancel Booking
                </button>
            @endif
            
            <a href="{{ route('booking.history') }}" 
               class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                Back to Bookings
            </a>
        </div>
    </div>

    <!-- Status Banner -->
    <div class="rounded-md mb-8 
        @if($booking->booking_status == 'pending') bg-yellow-50 @endif
        @if($booking->booking_status == 'approved') bg-blue-50 @endif
        @if($booking->booking_status == 'completed') bg-green-50 @endif
        @if($booking->booking_status == 'cancelled') bg-red-50 @endif
        @if($booking->booking_status == 'rejected') bg-gray-50 @endif
        p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                @if($booking->booking_status == 'pending')
                    <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                @elseif($booking->booking_status == 'approved')
                    <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                @elseif($booking->booking_status == 'completed')
                    <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                @elseif($booking->booking_status == 'cancelled')
                    <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                @else
                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                @endif
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium 
                    @if($booking->booking_status == 'pending') text-yellow-800 @endif
                    @if($booking->booking_status == 'approved') text-blue-800 @endif
                    @if($booking->booking_status == 'completed') text-green-800 @endif
                    @if($booking->booking_status == 'cancelled') text-red-800 @endif
                    @if($booking->booking_status == 'rejected') text-gray-800 @endif">
                    Booking Status: {{ ucfirst($booking->booking_status) }}
                </h3>
                <div class="mt-2 text-sm 
                    @if($booking->booking_status == 'pending') text-yellow-700 @endif
                    @if($booking->booking_status == 'approved') text-blue-700 @endif
                    @if($booking->booking_status == 'completed') text-green-700 @endif
                    @if($booking->booking_status == 'cancelled') text-red-700 @endif
                    @if($booking->booking_status == 'rejected') text-gray-700 @endif">
                    @if($booking->booking_status == 'pending')
                        <p>Your booking is currently under review. You'll be notified once it's approved.</p>
                    @elseif($booking->booking_status == 'approved')
                        <p>Your booking has been approved. Please note the event date and time.</p>
                    @elseif($booking->booking_status == 'completed')
                        <p>This booking has been successfully completed. Thank you for using our service!</p>
                    @elseif($booking->booking_status == 'cancelled')
                        <p>This booking has been cancelled. See details below.</p>
                    @else
                        <p>This booking was rejected. Please contact our support for more information.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
            <div>
                <h3 class="text-lg leading-6 font-medium text-gray-900">Booking Information</h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">Details about your celebrity booking.</p>
            </div>
            <div class="text-right">
                <p class="text-sm text-gray-500">Created on</p>
                <p class="text-sm font-medium text-gray-900">{{ $booking->created_at->format('M d, Y') }}</p>
            </div>
        </div>
        <div class="border-t border-gray-200">
            <!-- Celebrity Info -->
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">Celebrity</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 flex items-center">
                    @if($celebrity->profile_picture)
                        <img src="{{ asset('storage/' . $celebrity->profile_picture) }}" alt="{{ $celebrity->name }}" class="h-10 w-10 rounded-full object-cover mr-3">
                    @endif
                    <span>{{ $celebrity->name }}</span>
                </dd>
            </div>
            
            <!-- Event Details -->
            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">Event Date & Time</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{ $booking->event_date->format('F j, Y') }} at {{ \Carbon\Carbon::parse($booking->event_time)->format('g:i A') }}
                </dd>
            </div>
            
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">Event Duration</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{ $booking->duration }} minutes
                </dd>
            </div>
            
            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">Event Type</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{ $booking->event_type }}
                </dd>
            </div>
            
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">Event Location</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{ $booking->event_location }}
                </dd>
            </div>
            
            <!-- Contact Info -->
            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">Full Name</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{ $booking->full_name }}
                </dd>
            </div>
            
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">Contact Email</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{ $booking->email }}
                </dd>
            </div>
            
            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">Contact Phone</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{ $booking->phone }}
                </dd>
            </div>
            
            <!-- Payment Info -->
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">Booking Fee</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    ${{ number_format($booking->booking_fee, 2) }}
                </dd>
            </div>
            
            @if($booking->payment_method)
            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">Payment Method</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    {{ ucfirst($booking->payment_method) }}
                </dd>
            </div>
            @endif
            
            @if($booking->payment_proof)
            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">Payment Proof</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                    <a href="{{ asset('storage/' . $booking->payment_proof) }}" target="_blank" class="text-indigo-600 hover:text-indigo-900">
                        View Payment Proof <span class="text-xs">(opens in new window)</span>
                    </a>
                </dd>
            </div>
            @endif
            
            <!-- Special Requests -->
            @if($booking->special_requests)
            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                <dt class="text-sm font-medium text-gray-500">Special Requests</dt>
                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 whitespace-pre-line">
                    {{ $booking->special_requests }}
                </dd>
            </div>
            @endif
        </div>
    </div>

    <!-- Next Steps or Additional Info -->
    <div class="mt-8 bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">What's Next?</h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">Follow these steps based on your booking status.</p>
        </div>
        <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
            @if($booking->booking_status == 'pending')
                <div class="prose prose-sm text-gray-900">
                    <p>Your booking is currently under review. Here's what happens next:</p>
                    <ol>
                        <li>Our team will review your booking request and payment details.</li>
                        <li>Once approved, you'll receive a confirmation email with additional details.</li>
                        <li>If we need any additional information, we'll contact you via email or phone.</li>
                    </ol>
                    <p class="text-sm text-gray-500 mt-4">Most bookings are reviewed within 24-48 hours.</p>
                </div>
            @elseif($booking->booking_status == 'approved')
                <div class="prose prose-sm text-gray-900">
                    <p>Your booking has been approved! Here's what happens next:</p>
                    <ol>
                        <li>Our team will coordinate with {{ $celebrity->name }} regarding your event.</li>
                        <li>You'll receive an email with preparation details a few days before the event.</li>
                        <li>On the event day, our team will arrive 30 minutes before the scheduled time.</li>
                    </ol>
                    <p class="text-sm text-gray-500 mt-4">If you need to make any changes, please contact us at least 72 hours before the event.</p>
                </div>
            @elseif($booking->booking_status == 'completed')
                <div class="prose prose-sm text-gray-900">
                    <p>Your event with {{ $celebrity->name }} has been completed. Thank you for choosing our services!</p>
                    <p>If you enjoyed your experience, we would appreciate if you could:</p>
                    <ul>
                        <li>Leave a review on our platform</li>
                        <li>Share your experience on social media</li>
                        <li>Consider booking again for your next event</li>
                    </ul>
                </div>
            @elseif($booking->booking_status == 'cancelled')
                <div class="prose prose-sm text-gray-900">
                    <p>This booking has been cancelled. If you have any questions regarding refunds or rebooking, please contact our customer support team.</p>
                </div>
            @else
                <div class="prose prose-sm text-gray-900">
                    <p>This booking was rejected. This could be due to scheduling conflicts, unavailability, or other reasons.</p>
                    <p>For more information or to discuss alternatives, please contact our customer support team.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Cancel Modal -->
<div id="cancel-modal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
            <div class="sm:flex sm:items-start">
                <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                    <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                </div>
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                        Cancel Booking
                    </h3>
                    <div class="mt-2">
                        <p class="text-sm text-gray-500">
                            Are you sure you want to cancel this booking? This action cannot be undone.
                            <br><br>Please provide a reason for cancellation:
                        </p>
                    </div>
                    
                    <form action="{{ route('booking.cancel', $booking->booking_reference) }}" method="POST" class="mt-3">
                        @csrf
                        <div>
                            <label for="cancellation_reason" class="sr-only">Cancellation Reason</label>
                            <textarea id="cancellation_reason" name="cancellation_reason" rows="3" class="shadow-sm block w-full focus:ring-red-500 focus:border-red-500 sm:text-sm border border-gray-300 rounded-md" placeholder="Please explain why you're cancelling this booking..."></textarea>
                            <p class="mt-1 text-xs text-gray-500">Minimum 10 characters required</p>
                        </div>
                    
                        <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                            <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                                Confirm Cancellation
                            </button>
                            <button type="button" onclick="document.getElementById('cancel-modal').classList.add('hidden')" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm">
                                Go Back
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection