@extends('layouts.modern')

@section('title', $title)

@section('content')
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 pt-16 pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Booking Details Header -->
            <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-8 mt-5">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Booking Details</h1>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                        Reference: <span
                            class="font-medium text-gray-800 dark:text-gray-300">{{ $booking->booking_reference }}</span>
                    </p>
                </div>
                <div class="mt-4 md:mt-0 flex flex-wrap gap-3">
                    @if (in_array($booking->booking_status, ['pending', 'approved']))
                        <a href="{{ route('booking.edit', $booking->booking_reference) }}"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                            <i data-lucide="calendar" class="h-4 w-4 mr-2 text-gray-500 dark:text-gray-400"></i>
                            Reschedule
                        </a>
                    @endif

                    @if ($booking->booking_status != 'cancelled' && $booking->booking_status != 'completed')
                        <button type="button" @click="$dispatch('open-modal')" x-data
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            <i data-lucide="x-circle" class="h-4 w-4 mr-2"></i>
                            Cancel Booking
                        </button>
                    @endif

                    <a href="{{ route('booking.history') }}"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        <i data-lucide="arrow-left" class="h-4 w-4 mr-2 text-gray-500 dark:text-gray-400"></i>
                        Back to Bookings
                    </a>
                </div>
            </div>

            <!-- Status Banner -->
            <div
                class="rounded-md mb-8
            @if ($booking->booking_status == 'pending') bg-yellow-50 dark:bg-yellow-900/30 border border-yellow-200 dark:border-yellow-800 @endif
            @if ($booking->booking_status == 'approved') bg-blue-50 dark:bg-blue-900/30 border border-blue-200 dark:border-blue-800 @endif
            @if ($booking->booking_status == 'completed') bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 @endif
            @if ($booking->booking_status == 'cancelled') bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 @endif
            @if ($booking->booking_status == 'rejected') bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 @endif
            p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        @if ($booking->booking_status == 'pending')
                            <i data-lucide="alert-circle" class="h-5 w-5 text-yellow-400"></i>
                        @elseif($booking->booking_status == 'approved')
                            <i data-lucide="check-circle" class="h-5 w-5 text-blue-400"></i>
                        @elseif($booking->booking_status == 'completed')
                            <i data-lucide="check-circle" class="h-5 w-5 text-green-400"></i>
                        @elseif($booking->booking_status == 'cancelled')
                            <i data-lucide="x-circle" class="h-5 w-5 text-red-400"></i>
                        @else
                            <i data-lucide="slash" class="h-5 w-5 text-gray-400"></i>
                        @endif
                    </div>
                    <div class="ml-3">
                        <h3
                            class="text-sm font-medium
                        @if ($booking->booking_status == 'pending') text-yellow-800 dark:text-yellow-400 @endif
                        @if ($booking->booking_status == 'approved') text-blue-800 dark:text-blue-400 @endif
                        @if ($booking->booking_status == 'completed') text-green-800 dark:text-green-400 @endif
                        @if ($booking->booking_status == 'cancelled') text-red-800 dark:text-red-400 @endif
                        @if ($booking->booking_status == 'rejected') text-gray-800 dark:text-gray-300 @endif">
                            Booking Status: {{ ucfirst($booking->booking_status) }}
                        </h3>
                        <div
                            class="mt-2 text-sm
                        @if ($booking->booking_status == 'pending') text-yellow-700 dark:text-yellow-300 @endif
                        @if ($booking->booking_status == 'approved') text-blue-700 dark:text-blue-300 @endif
                        @if ($booking->booking_status == 'completed') text-green-700 dark:text-green-300 @endif
                        @if ($booking->booking_status == 'cancelled') text-red-700 dark:text-red-300 @endif
                        @if ($booking->booking_status == 'rejected') text-gray-700 dark:text-gray-300 @endif">
                            @if ($booking->booking_status == 'pending')
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

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left Column: Main Booking Info -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Main Content -->
                    <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg">
                        <div
                            class="px-4 py-5 sm:px-6 flex justify-between items-center border-b border-gray-200 dark:border-gray-700">
                            <div>
                                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">Booking Information
                                </h3>
                                <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400">Details about your
                                    celebrity booking.</p>
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-gray-500 dark:text-gray-400">Created on</p>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">
                                    {{ $booking->created_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                        <div class="divide-y divide-gray-200 dark:divide-gray-700">
                            <!-- Celebrity Info -->
                            <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Celebrity</dt>
                                <dd
                                    class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2 flex items-center">
                                    @if ($celebrity->photo)
                                        <img src="{{ asset('storage/' . $celebrity->photo) }}" alt="{{ $celebrity->name }}"
                                            class="h-10 w-10 rounded-full object-cover mr-3">
                                    @else
                                        <div
                                            class="h-10 w-10 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                            <i data-lucide="user" class="h-6 w-6 text-gray-400"></i>
                                        </div>
                                    @endif
                                    <span>{{ $celebrity->name }}</span>
                                </dd>
                            </div>

                            <!-- Event Details -->
                            <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 bg-gray-50 dark:bg-gray-700/50">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 flex items-center">
                                    <i data-lucide="calendar" class="h-4 w-4 mr-2"></i>
                                    Event Date & Time
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white font-medium sm:mt-0 sm:col-span-2">
                                    {{ $booking->event_date->format('F j, Y') }} at
                                    {{ \Carbon\Carbon::parse($booking->event_time)->format('g:i A') }}
                                </dd>
                            </div>

                            <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 flex items-center">
                                    <i data-lucide="clock" class="h-4 w-4 mr-2"></i>
                                    Event Duration
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">
                                    {{ $booking->duration }} minutes
                                </dd>
                            </div>

                            <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 bg-gray-50 dark:bg-gray-700/50">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 flex items-center">
                                    <i data-lucide="bookmark" class="h-4 w-4 mr-2"></i>
                                    Event Type
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">
                                    {{ $booking->event_type }}
                                </dd>
                            </div>

                            <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 flex items-center">
                                    <i data-lucide="map-pin" class="h-4 w-4 mr-2"></i>
                                    Event Location
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">
                                    {{ $booking->event_location }}
                                </dd>
                            </div>

                            <!-- Payment Info -->
                            <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 bg-gray-50 dark:bg-gray-700/50">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 flex items-center">
                                    <i data-lucide="credit-card" class="h-4 w-4 mr-2"></i>
                                    Payment Status
                                </dt>
                                <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if ($booking->payment_status == 'pending') bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400 @endif
                                    @if ($booking->payment_status == 'paid') bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400 @endif
                                    @if ($booking->payment_status == 'refunded') bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400 @endif
                                    @if ($booking->payment_status == 'cancelled') bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400 @endif">
                                        {{ ucfirst($booking->payment_status) }}
                                    </span>
                                </dd>
                            </div>

                            <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 flex items-center">
                                    <i data-lucide="dollar-sign" class="h-4 w-4 mr-2"></i>
                                    Total Amount
                                </dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white font-medium sm:mt-0 sm:col-span-2">
                                    ${{ number_format($booking->total_amount, 2) }}
                                    <span class="text-xs text-gray-500 dark:text-gray-400 ml-1">(Booking Fee:
                                        ${{ number_format($booking->booking_fee, 2) }} + Service Fee:
                                        ${{ number_format($booking->service_fee, 2) }})</span>
                                </dd>
                            </div>

                            @if ($booking->payment_method)
                                <div
                                    class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 bg-gray-50 dark:bg-gray-700/50">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 flex items-center">
                                        <i data-lucide="credit-card" class="h-4 w-4 mr-2"></i>
                                        Payment Method
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2">
                                        {{ ucfirst($booking->payment_method) }}
                                        @if ($booking->payment_date)
                                            <span class="text-xs text-gray-500 dark:text-gray-400 block mt-1">
                                                Paid on: {{ $booking->payment_date->format('M j, Y g:i A') }}
                                            </span>
                                        @endif
                                    </dd>
                                </div>
                            @endif

                            @if ($booking->payment_proof)
                                <div class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 flex items-center">
                                        <i data-lucide="file" class="h-4 w-4 mr-2"></i>
                                        Payment Proof
                                    </dt>
                                    <dd class="mt-1 text-sm sm:mt-0 sm:col-span-2">
                                        <a href="{{ asset('storage/payment_proofs/' . $booking->payment_proof) }}"
                                            target="_blank"
                                            class="inline-flex items-center text-primary-600 hover:text-primary-700 dark:text-primary-400 dark:hover:text-primary-300">
                                            <i data-lucide="external-link" class="h-4 w-4 mr-1"></i>
                                            View Payment Proof
                                        </a>
                                    </dd>
                                </div>
                            @endif

                            <!-- Special Requests -->
                            @if ($booking->special_requests)
                                <div
                                    class="px-4 py-4 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6 bg-gray-50 dark:bg-gray-700/50">
                                    <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 flex items-center">
                                        <i data-lucide="message-square" class="h-4 w-4 mr-2"></i>
                                        Special Requests
                                    </dt>
                                    <dd
                                        class="mt-1 text-sm text-gray-900 dark:text-white sm:mt-0 sm:col-span-2 whitespace-pre-line">
                                        {{ $booking->special_requests }}
                                    </dd>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Timeline -->
                    <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6 border-b border-gray-200 dark:border-gray-700">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">Booking Timeline</h3>
                            <p class="mt-1 max-w-2xl text-sm text-gray-500 dark:text-gray-400">Track the progress of your
                                booking.</p>
                        </div>
                        <div class="px-4 py-5 sm:p-6">
                            <div class="flow-root">
                                <ul role="list" class="-mb-8">
                                    <!-- Created -->
                                    <li>
                                        <div class="relative pb-8">
                                            <span
                                                class="absolute top-5 left-5 -ml-px h-full w-0.5 bg-gray-200 dark:bg-gray-700"
                                                aria-hidden="true"></span>
                                            <div class="relative flex items-start space-x-3">
                                                <div class="relative">
                                                    <div
                                                        class="h-10 w-10 rounded-full bg-primary-500 dark:bg-primary-700 flex items-center justify-center ring-8 ring-white dark:ring-gray-800">
                                                        <i data-lucide="file-plus" class="h-5 w-5 text-white"></i>
                                                    </div>
                                                </div>
                                                <div class="min-w-0 flex-1">
                                                    <div>
                                                        <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                            Booking Created</div>
                                                        <p class="mt-0.5 text-sm text-gray-500 dark:text-gray-400">
                                                            {{ $booking->created_at->format('F j, Y g:i A') }}
                                                        </p>
                                                    </div>
                                                    <div class="mt-2 text-sm text-gray-700 dark:text-gray-300">
                                                        <p>Your booking request was submitted successfully with reference
                                                            <span
                                                                class="font-medium">{{ $booking->booking_reference }}</span>.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                    <!-- Payment -->
                                    <li>
                                        <div class="relative pb-8">
                                            <span
                                                class="absolute top-5 left-5 -ml-px h-full w-0.5 bg-gray-200 dark:bg-gray-700"
                                                aria-hidden="true"></span>
                                            <div class="relative flex items-start space-x-3">
                                                <div class="relative">
                                                    <div
                                                        class="h-10 w-10 rounded-full bg-blue-500 dark:bg-blue-700 flex items-center justify-center ring-8 ring-white dark:ring-gray-800">
                                                        <i data-lucide="credit-card" class="h-5 w-5 text-white"></i>
                                                    </div>
                                                </div>
                                                <div class="min-w-0 flex-1">
                                                    <div>
                                                        <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                            Payment {{ ucfirst($booking->payment_status) }}</div>
                                                        <p class="mt-0.5 text-sm text-gray-500 dark:text-gray-400">
                                                            {{ $booking->payment_date ? $booking->payment_date->format('F j, Y g:i A') : $booking->created_at->format('F j, Y g:i A') }}
                                                        </p>
                                                    </div>
                                                    <div class="mt-2 text-sm text-gray-700 dark:text-gray-300">
                                                        <p>Payment of ${{ number_format($booking->total_amount, 2) }} was
                                                            submitted via
                                                            {{ $booking->payment_method ? ucfirst($booking->payment_method) : 'the payment gateway' }}.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                    <!-- Status Update -->
                                    @if ($booking->booking_status != 'pending')
                                        <li>
                                            <div class="relative pb-8">
                                                @if ($booking->booking_status != 'completed' && $booking->booking_status != 'cancelled')
                                                    <span
                                                        class="absolute top-5 left-5 -ml-px h-full w-0.5 bg-gray-200 dark:bg-gray-700"
                                                        aria-hidden="true"></span>
                                                @endif
                                                <div class="relative flex items-start space-x-3">
                                                    <div class="relative">
                                                        <div
                                                            class="h-10 w-10 rounded-full
                                                    @if ($booking->booking_status == 'approved') bg-green-500 dark:bg-green-700
                                                    @elseif($booking->booking_status == 'completed') bg-green-500 dark:bg-green-700
                                                    @elseif($booking->booking_status == 'cancelled') bg-red-500 dark:bg-red-700
                                                    @else bg-gray-500 dark:bg-gray-700 @endif
                                                    flex items-center justify-center ring-8 ring-white dark:ring-gray-800">
                                                            @if ($booking->booking_status == 'approved')
                                                                <i data-lucide="check" class="h-5 w-5 text-white"></i>
                                                            @elseif($booking->booking_status == 'completed')
                                                                <i data-lucide="check-circle"
                                                                    class="h-5 w-5 text-white"></i>
                                                            @elseif($booking->booking_status == 'cancelled')
                                                                <i data-lucide="x" class="h-5 w-5 text-white"></i>
                                                            @else
                                                                <i data-lucide="x-circle" class="h-5 w-5 text-white"></i>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="min-w-0 flex-1">
                                                        <div>
                                                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                                Booking {{ ucfirst($booking->booking_status) }}</div>
                                                            <p class="mt-0.5 text-sm text-gray-500 dark:text-gray-400">
                                                                {{ $booking->updated_at->format('F j, Y g:i A') }}
                                                            </p>
                                                        </div>
                                                        <div class="mt-2 text-sm text-gray-700 dark:text-gray-300">
                                                            @if ($booking->booking_status == 'approved')
                                                                <p>Your booking has been approved. You're all set for your
                                                                    event with {{ $celebrity->name }}!</p>
                                                            @elseif($booking->booking_status == 'completed')
                                                                <p>Your booking has been marked as completed. Thank you for
                                                                    using our service!</p>
                                                            @elseif($booking->booking_status == 'cancelled')
                                                                <p>Your booking was cancelled. If you made a payment, our
                                                                    team will contact you regarding a refund.</p>
                                                            @else
                                                                <p>Your booking was rejected. Please contact our support
                                                                    team for more information.</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endif

                                    <!-- Event Date (if future) -->
                                    @if ($booking->event_date >= \Carbon\Carbon::today() && in_array($booking->booking_status, ['approved', 'pending']))
                                        <li>
                                            <div class="relative">
                                                <div class="relative flex items-start space-x-3">
                                                    <div class="relative">
                                                        <div
                                                            class="h-10 w-10 rounded-full bg-gray-300 dark:bg-gray-600 flex items-center justify-center ring-8 ring-white dark:ring-gray-800">
                                                            <i data-lucide="calendar"
                                                                class="h-5 w-5 text-gray-600 dark:text-gray-300"></i>
                                                        </div>
                                                    </div>
                                                    <div class="min-w-0 flex-1">
                                                        <div>
                                                            <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                                Upcoming Event</div>
                                                            <p class="mt-0.5 text-sm text-gray-500 dark:text-gray-400">
                                                                {{ $booking->event_date->format('F j, Y') }} at
                                                                {{ \Carbon\Carbon::parse($booking->event_time)->format('g:i A') }}
                                                            </p>
                                                        </div>
                                                        <div class="mt-2 text-sm text-gray-700 dark:text-gray-300">
                                                            <p>Your scheduled event with {{ $celebrity->name }} is coming
                                                                up.</p>
                                                            <div class="mt-2">
                                                                <span
                                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400">
                                                                    <i data-lucide="clock" class="h-3 w-3 mr-1"></i>
                                                                    {{ $booking->event_date->diffForHumans() }}
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Sidebar Info -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Contact Info Card -->
                    <div class=" mb-2 bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg ">
                        <div class="px-4 py-5 sm:px-6 border-b border-gray-200 dark:border-gray-700">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">Contact Information
                            </h3>
                        </div>
                        <div class="px-4 py-5 sm:p-6 space-y-4">
                            <div>
                                <label class="block text-xs font-medium text-gray-500 dark:text-gray-400">Full Name</label>
                                <div class="mt-1 flex items-center">
                                    <i data-lucide="user" class="h-5 w-5 text-gray-400 mr-2"></i>
                                    <span
                                        class="text-sm font-medium text-gray-900 dark:text-white">{{ $booking->full_name }}</span>
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-500 dark:text-gray-400">Email</label>
                                <div class="mt-1 flex items-center">
                                    <i data-lucide="mail" class="h-5 w-5 text-gray-400 mr-2"></i>
                                    <span
                                        class="text-sm font-medium text-gray-900 dark:text-white">{{ $booking->email }}</span>
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-500 dark:text-gray-400">Phone</label>
                                <div class="mt-1 flex items-center">
                                    <i data-lucide="phone" class="h-5 w-5 text-gray-400 mr-2"></i>
                                    <span
                                        class="text-sm font-medium text-gray-900 dark:text-white">{{ $booking->phone }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Next Steps Card -->
                    <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6 border-b border-gray-200 dark:border-gray-700">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">What's Next?</h3>
                        </div>
                        <div class="px-4 py-5 sm:p-6">
                            @if ($booking->booking_status == 'pending')
                                <div class="space-y-4">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0">
                                            <span
                                                class="flex h-6 w-6 items-center justify-center rounded-full bg-primary-100 dark:bg-primary-900/30 text-primary-600 dark:text-primary-400 ring-8 ring-white dark:ring-gray-800">
                                                <i data-lucide="check" class="h-4 w-4"></i>
                                            </span>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900 dark:text-white">Booking Submitted
                                            </p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">Completed</p>
                                        </div>
                                    </div>

                                    <div class="flex items-start">
                                        <div class="flex-shrink-0">
                                            <span
                                                class="flex h-6 w-6 items-center justify-center rounded-full bg-yellow-100 dark:bg-yellow-900/30 text-yellow-600 dark:text-yellow-400 ring-8 ring-white dark:ring-gray-800">
                                                <i data-lucide="clock" class="h-4 w-4"></i>
                                            </span>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900 dark:text-white">Payment Review</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">In Progress</p>
                                        </div>
                                    </div>

                                    <div class="flex items-start opacity-50">
                                        <div class="flex-shrink-0">
                                            <span
                                                class="flex h-6 w-6 items-center justify-center rounded-full bg-gray-200 dark:bg-gray-700 text-gray-500 dark:text-gray-400 ring-8 ring-white dark:ring-gray-800">
                                                <i data-lucide="shield" class="h-4 w-4"></i>
                                            </span>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Booking
                                                Approval</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">Pending</p>
                                        </div>
                                    </div>

                                    <div class="flex items-start opacity-50">
                                        <div class="flex-shrink-0">
                                            <span
                                                class="flex h-6 w-6 items-center justify-center rounded-full bg-gray-200 dark:bg-gray-700 text-gray-500 dark:text-gray-400 ring-8 ring-white dark:ring-gray-800">
                                                <i data-lucide="star" class="h-4 w-4"></i>
                                            </span>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Event Day</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">Upcoming</p>
                                        </div>
                                    </div>

                                    <div class="mt-6 text-sm text-gray-700 dark:text-gray-300">
                                        <p>Most bookings are reviewed within 24-48 hours. We'll notify you once your booking
                                            is approved.</p>
                                    </div>
                                </div>
                            @elseif($booking->booking_status == 'approved')
                                <div class="space-y-4">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0">
                                            <span
                                                class="flex h-6 w-6 items-center justify-center rounded-full bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400 ring-8 ring-white dark:ring-gray-800">
                                                <i data-lucide="check" class="h-4 w-4"></i>
                                            </span>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900 dark:text-white">Booking Approved
                                            </p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">Confirmed</p>
                                        </div>
                                    </div>

                                    <div class="flex items-start">
                                        <div class="flex-shrink-0">
                                            <span
                                                class="flex h-6 w-6 items-center justify-center rounded-full bg-primary-100 dark:bg-primary-900/30 text-primary-600 dark:text-primary-400 ring-8 ring-white dark:ring-gray-800">
                                                <i data-lucide="clock" class="h-4 w-4"></i>
                                            </span>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900 dark:text-white">Event Preparation
                                            </p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">In Progress</p>
                                        </div>
                                    </div>

                                    <div class="mt-6 text-sm text-gray-700 dark:text-gray-300">
                                        <p>Your booking is confirmed! Our team will coordinate with {{ $celebrity->name }}
                                            and send you final instructions before the event date.</p>
                                        <p class="mt-2">If you need to make changes to your booking, please do so at
                                            least 72 hours before the scheduled time.</p>
                                    </div>
                                </div>
                            @elseif($booking->booking_status == 'completed')
                                <div class="text-sm text-gray-700 dark:text-gray-300">
                                    <p>Your event with {{ $celebrity->name }} has been completed. Thank you for choosing
                                        our services!</p>
                                    <div class="mt-4 flex justify-center">
                                        <div
                                            class="flex h-16 w-16 items-center justify-center rounded-full bg-green-100 dark:bg-green-900/30">
                                            <i data-lucide="check-circle"
                                                class="h-10 w-10 text-green-600 dark:text-green-400"></i>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <p class="font-medium text-center">We hope you had a great experience!</p>
                                        <p class="mt-2">If you enjoyed your booking, we would appreciate if you could:
                                        </p>
                                        <ul class="mt-2 list-disc list-inside space-y-1">
                                            <li>Leave a review on our platform</li>
                                            <li>Share your experience on social media</li>
                                            <li>Consider booking again for future events</li>
                                        </ul>
                                    </div>
                                </div>
                            @elseif($booking->booking_status == 'cancelled')
                                <div class="text-sm text-gray-700 dark:text-gray-300">
                                    <p>This booking has been cancelled.</p>
                                    <div class="mt-4 flex justify-center">
                                        <div
                                            class="flex h-16 w-16 items-center justify-center rounded-full bg-red-100 dark:bg-red-900/30">
                                            <i data-lucide="x-circle"
                                                class="h-10 w-10 text-red-600 dark:text-red-400"></i>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <p>If you have any questions regarding refunds or rebooking, please contact our
                                            customer support team.</p>
                                    </div>
                                </div>
                            @else
                                <div class="text-sm text-gray-700 dark:text-gray-300">
                                    <p>This booking was rejected. This could be due to scheduling conflicts, unavailability,
                                        or other reasons.</p>
                                    <p class="mt-4">For more information or to discuss alternatives, please contact our
                                        customer support team.</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Support Card -->
                    <div class="bg-white dark:bg-gray-800 shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6 border-b border-gray-200 dark:border-gray-700">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white">Need Help?</h3>
                        </div>
                        <div class="px-4 py-5 sm:p-6">
                            <p class="text-sm text-gray-700 dark:text-gray-300">If you have questions about this booking,
                                our support team is here to help.</p>
                            <div class="mt-6 space-y-3">
                                <a href="{{ route('contact') }}"
                                    class="inline-flex w-full items-center px-3 py-2 border border-gray-300 dark:border-gray-600 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 justify-center transition-colors duration-150">
                                    <i data-lucide="message-square"
                                        class="h-4 w-4 mr-2 text-gray-500 dark:text-gray-400"></i>
                                    Live Chat
                                </a>
                                <a href="{{ route('contact') }}"
                                    class="inline-flex w-full items-center px-3 py-2 border border-gray-300 dark:border-gray-600 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 justify-center transition-colors duration-150">
                                    <i data-lucide="mail" class="h-4 w-4 mr-2 text-gray-500 dark:text-gray-400"></i>
                                    Email Support
                                </a>
                                <a href="#"
                                    class="inline-flex w-full items-center px-3 py-2 border border-gray-300 dark:border-gray-600 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 justify-center transition-colors duration-150">
                                    <i data-lucide="phone" class="h-4 w-4 mr-2 text-gray-500 dark:text-gray-400"></i>
                                    Call Us
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cancel Modal -->
    <div x-data="{ open: false }" @open-modal.window="open = true" @keydown.escape.window="open = false" x-show="open"
        class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true"
        x-cloak>
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Background overlay -->
            <div x-show="open" @click="open = false" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-gray-500 dark:bg-gray-900 bg-opacity-75 dark:bg-opacity-75 transition-opacity"
                aria-hidden="true"></div>

            <!-- Modal panel -->
            <div x-show="open" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                <div class="sm:flex sm:items-start">
                    <div
                        class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 dark:bg-red-900/30 sm:mx-0 sm:h-10 sm:w-10">
                        <i data-lucide="alert-triangle" class="h-6 w-6 text-red-600 dark:text-red-400"></i>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white" id="modal-title">
                            Cancel Booking
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Are you sure you want to cancel this booking? This action cannot be undone.
                                <br><br>Please provide a reason for cancellation:
                            </p>
                        </div>

                        <form action="{{ route('booking.cancel', $booking->booking_reference) }}" method="POST"
                            class="mt-3">
                            @csrf
                            <div>
                                <label for="cancellation_reason" class="sr-only">Cancellation Reason</label>
                                <textarea id="cancellation_reason" name="cancellation_reason" rows="3"
                                    class="shadow-sm block w-full focus:ring-red-500 focus:border-red-500 sm:text-sm border border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white rounded-md"
                                    placeholder="Please explain why you're cancelling this booking..." required></textarea>
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Minimum 10 characters required</p>
                            </div>

                            <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                                <button type="submit"
                                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                                    Confirm Cancellation
                                </button>
                                <button type="button" @click="open = false"
                                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 bg-white dark:bg-gray-700 text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 sm:mt-0 sm:w-auto sm:text-sm">
                                    Go Back
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons();
        });
    </script>
@endsection
