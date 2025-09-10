@extends('layouts.base1')

@section('title', $title)

@section('content')
    <!-- Futuristic Booking Edit Interface with Light/Dark Mode Support -->
    <div
        class="min-h-screen bg-gradient-to-br from-gray-100 via-white to-gray-100 dark:from-gray-900 dark:via-slate-800 dark:to-gray-900 relative overflow-hidden transition-all duration-300">
        <!-- Background Pattern -->
        <div class="absolute inset-0 bg-grid-gray-300/[0.02] dark:bg-grid-white/[0.02] bg-[length:50px_50px]"
            aria-hidden="true"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-white/50 dark:from-gray-900/50 to-transparent" aria-hidden="true">
        </div>

        <!-- Floating Orbs -->
        <div
            class="absolute top-20 right-20 w-64 h-64 bg-primary-400/10 dark:bg-primary-400/10 rounded-full blur-3xl animate-pulse">
        </div>
        <div
            class="absolute bottom-20 left-20 w-96 h-96 bg-accent-400/10 dark:bg-accent-400/10 rounded-full blur-3xl animate-pulse animation-delay-2000">
        </div>

        <div class="relative z-10 pt-24 pb-20 px-4 sm:px-6 lg:px-8" x-data="bookingEditForm()">
            <div class="max-w-5xl mx-auto">
                <!-- Header Section -->
                <div class="mb-12 text-center">
                    <div
                        class="inline-flex items-center px-4 py-2 rounded-full bg-primary-500/10 border border-primary-500/20 backdrop-blur-sm mb-6">
                        @if (isset($booking->booking_type) && in_array($booking->booking_type, ['donation', 'fan_card']))
                            <i data-lucide="info" class="w-4 h-4 text-primary-500 dark:text-primary-400 mr-2"></i>
                            <span class="text-primary-600 dark:text-primary-300 text-sm font-medium">Booking
                                Information</span>
                        @else
                            <i data-lucide="edit-3" class="w-4 h-4 text-primary-500 dark:text-primary-400 mr-2"></i>
                            <span class="text-primary-600 dark:text-primary-300 text-sm font-medium">Booking
                                Modification</span>
                        @endif
                    </div>

                    @if (isset($booking->booking_type) && in_array($booking->booking_type, ['donation', 'fan_card']))
                        <h1
                            class="text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-4 bg-gradient-to-r from-gray-900 via-primary-600 to-accent-600 dark:from-white dark:via-primary-200 dark:to-accent-200 bg-clip-text text-transparent">
                            @if ($booking->booking_type == 'donation')
                                Your Donation Details
                            @else
                                Your Fan Card Details
                            @endif
                        </h1>

                        <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto mb-6">
                            @if ($booking->booking_type == 'donation')
                                Thank you for your generous donation to <span
                                    class="text-primary-600 dark:text-primary-400 font-semibold">{{ $celebrity->name }}</span>
                            @else
                                Your VIP Fan Card for <span
                                    class="text-primary-600 dark:text-primary-400 font-semibold">{{ $celebrity->name }}</span>
                            @endif
                        </p>
                    @else
                        <h1
                            class="text-4xl lg:text-5xl font-bold text-gray-900 dark:text-white mb-4 bg-gradient-to-r from-gray-900 via-primary-600 to-accent-600 dark:from-white dark:via-primary-200 dark:to-accent-200 bg-clip-text text-transparent">
                            Reschedule Your Event
                        </h1>

                        <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto mb-6">
                            Modify your booking details with <span
                                class="text-primary-600 dark:text-primary-400 font-semibold">{{ $celebrity->name }}</span>
                        </p>
                    @endif

                    <div
                        class="inline-flex items-center px-4 py-2 rounded-lg bg-gray-200/50 dark:bg-gray-800/50 border border-gray-300/50 dark:border-gray-700/50 backdrop-blur-sm">
                        <i data-lucide="hash" class="w-4 h-4 text-gray-500 dark:text-gray-400 mr-2"></i>
                        <span class="text-gray-600 dark:text-gray-300 text-sm">Reference: </span>
                        <span
                            class="text-primary-600 dark:text-primary-400 font-mono ml-1">{{ $booking->booking_reference }}</span>
                    </div>
                </div>

                <!-- Error Alerts with Modern Design -->
                @if ($errors->any())
                    <div class="mb-8 transform transition-all duration-300" x-data="{ show: true }" x-show="show"
                        x-transition>
                        <div
                            class="bg-red-50/80 dark:bg-red-500/10 border border-red-200 dark:border-red-500/20 rounded-2xl p-6 backdrop-blur-sm">
                            <div class="flex items-start">
                                <div class="flex-shrink-0">
                                    <div
                                        class="w-10 h-10 rounded-full bg-red-100 dark:bg-red-500/20 flex items-center justify-center">
                                        <i data-lucide="alert-circle" class="w-5 h-5 text-red-600 dark:text-red-400"></i>
                                    </div>
                                </div>
                                <div class="ml-4 flex-1">
                                    <h3 class="text-lg font-semibold text-red-800 dark:text-red-300 mb-2">Validation Errors
                                    </h3>
                                    <div class="space-y-1">
                                        @foreach ($errors->all() as $error)
                                            <p class="text-red-700 dark:text-red-200 text-sm flex items-center">
                                                <i data-lucide="x" class="w-3 h-3 mr-2"></i>
                                                {{ $error }}
                                            </p>
                                        @endforeach
                                    </div>
                                </div>
                                <button @click="show = false"
                                    class="flex-shrink-0 text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 transition-colors">
                                    <i data-lucide="x" class="w-5 h-5"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Current Booking Info Card -->
                <div class="mb-8" x-data="{ expanded: false }">
                    <div
                        class="bg-white/80 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-2xl backdrop-blur-lg p-6 shadow-lg">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white flex items-center">
                                @if (isset($booking->booking_type) && in_array($booking->booking_type, ['donation', 'fan_card']))
                                    <div
                                        class="w-8 h-8 rounded-lg bg-{{ $booking->booking_type == 'donation' ? 'red' : 'purple' }}-100 dark:bg-{{ $booking->booking_type == 'donation' ? 'red' : 'purple' }}-500/20 flex items-center justify-center mr-3">
                                        <i data-lucide="{{ $booking->booking_type == 'donation' ? 'heart' : 'credit-card' }}"
                                            class="w-4 h-4 text-{{ $booking->booking_type == 'donation' ? 'red' : 'purple' }}-600 dark:text-{{ $booking->booking_type == 'donation' ? 'red' : 'purple' }}-400"></i>
                                    </div>
                                    {{ $booking->booking_type == 'donation' ? 'Donation Details' : 'Fan Card Details' }}
                                @else
                                    <div
                                        class="w-8 h-8 rounded-lg bg-blue-100 dark:bg-blue-500/20 flex items-center justify-center mr-3">
                                        <i data-lucide="calendar-check"
                                            class="w-4 h-4 text-blue-600 dark:text-blue-400"></i>
                                    </div>
                                    Current Schedule
                                @endif
                            </h3>
                            <button @click="expanded = !expanded"
                                class="text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 transition-colors">
                                <i data-lucide="chevron-down" class="w-5 h-5 transform transition-transform"
                                    :class="expanded ? 'rotate-180' : ''"></i>
                            </button>
                        </div>

                        @if (isset($booking->booking_type) && in_array($booking->booking_type, ['donation', 'fan_card']))
                            <!-- Donation/Fan Card Details -->
                            <div class="space-y-4" x-show="expanded" x-collapse>
                                @if ($booking->booking_type == 'donation')
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div
                                            class="text-center p-4 rounded-lg bg-red-50 dark:bg-red-500/10 border border-red-200 dark:border-red-500/20">
                                            <i data-lucide="dollar-sign"
                                                class="w-6 h-6 text-red-600 dark:text-red-400 mx-auto mb-2"></i>
                                            <p class="text-xs text-red-600 dark:text-red-300 mb-1">Donation Amount</p>
                                            <p class="text-lg font-semibold text-gray-900 dark:text-white">
                                                ${{ number_format($booking->total_amount ?? ($booking->booking_fee ?? 0), 2) }}
                                            </p>
                                        </div>
                                        <div
                                            class="text-center p-4 rounded-lg bg-red-50 dark:bg-red-500/10 border border-red-200 dark:border-red-500/20">
                                            <i data-lucide="calendar"
                                                class="w-6 h-6 text-red-600 dark:text-red-400 mx-auto mb-2"></i>
                                            <p class="text-xs text-red-600 dark:text-red-300 mb-1">Date</p>
                                            <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                                {{ $booking->created_at->format('M j, Y') }}</p>
                                        </div>
                                    </div>
                                @else
                                    <!-- Fan Card Details -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div
                                            class="text-center p-4 rounded-lg bg-purple-50 dark:bg-purple-500/10 border border-purple-200 dark:border-purple-500/20">
                                            <i data-lucide="credit-card"
                                                class="w-6 h-6 text-purple-600 dark:text-purple-400 mx-auto mb-2"></i>
                                            <p class="text-xs text-purple-600 dark:text-purple-300 mb-1">Card Type</p>
                                            <p class="text-sm font-semibold text-gray-900 dark:text-white">VIP Fan Card</p>
                                        </div>
                                        <div
                                            class="text-center p-4 rounded-lg bg-purple-50 dark:bg-purple-500/10 border border-purple-200 dark:border-purple-500/20">
                                            <i data-lucide="calendar"
                                                class="w-6 h-6 text-purple-600 dark:text-purple-400 mx-auto mb-2"></i>
                                            <p class="text-xs text-purple-600 dark:text-purple-300 mb-1">Issued</p>
                                            <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                                {{ $booking->created_at->format('M j, Y') }}</p>
                                        </div>
                                    </div>
                                @endif

                                <!-- Status and Payment Info -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                                    <div
                                        class="text-center p-4 rounded-lg bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600">
                                        <i data-lucide="check-circle"
                                            class="w-6 h-6 text-green-600 dark:text-green-400 mx-auto mb-2"></i>
                                        <p class="text-xs text-gray-600 dark:text-gray-300 mb-1">Status</p>
                                        <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                            {{ ucfirst($booking->booking_status ?? 'Processed') }}</p>
                                    </div>
                                    <div
                                        class="text-center p-4 rounded-lg bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600">
                                        <i data-lucide="credit-card"
                                            class="w-6 h-6 text-blue-600 dark:text-blue-400 mx-auto mb-2"></i>
                                        <p class="text-xs text-gray-600 dark:text-gray-300 mb-1">Payment</p>
                                        <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                            {{ ucfirst($booking->payment_status ?? 'Completed') }}</p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <!-- Event Booking Details -->
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4" x-show="expanded" x-collapse>
                                <div
                                    class="text-center p-3 rounded-lg bg-blue-50 dark:bg-blue-500/10 border border-blue-200 dark:border-blue-500/20">
                                    <i data-lucide="calendar"
                                        class="w-6 h-6 text-blue-600 dark:text-blue-400 mx-auto mb-2"></i>
                                    <p class="text-xs text-blue-600 dark:text-blue-300 mb-1">Date</p>
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                        {{ $booking->event_date->format('M j, Y') }}</p>
                                </div>
                                <div
                                    class="text-center p-3 rounded-lg bg-blue-50 dark:bg-blue-500/10 border border-blue-200 dark:border-blue-500/20">
                                    <i data-lucide="clock"
                                        class="w-6 h-6 text-blue-600 dark:text-blue-400 mx-auto mb-2"></i>
                                    <p class="text-xs text-blue-600 dark:text-blue-300 mb-1">Time</p>
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                        {{ \Carbon\Carbon::parse($booking->event_time)->format('g:i A') }}</p>
                                </div>
                                <div
                                    class="text-center p-3 rounded-lg bg-blue-50 dark:bg-blue-500/10 border border-blue-200 dark:border-blue-500/20">
                                    <i data-lucide="map-pin"
                                        class="w-6 h-6 text-blue-600 dark:text-blue-400 mx-auto mb-2"></i>
                                    <p class="text-xs text-blue-600 dark:text-blue-300 mb-1">Location</p>
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                        {{ Str::limit($booking->event_location, 15) }}</p>
                                </div>
                                <div
                                    class="text-center p-3 rounded-lg bg-blue-50 dark:bg-blue-500/10 border border-blue-200 dark:border-blue-500/20">
                                    <i data-lucide="timer"
                                        class="w-6 h-6 text-blue-600 dark:text-blue-400 mx-auto mb-2"></i>
                                    <p class="text-xs text-blue-600 dark:text-blue-300 mb-1">Duration</p>
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                        {{ $booking->duration }}min</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                @if (!isset($booking->booking_type) || !in_array($booking->booking_type, ['donation', 'fan_card']))
                    <!-- Main Edit Form -->
                    <form action="{{ route('booking.update', $booking->booking_reference) }}" method="POST"
                        @submit="submitForm" class="space-y-8">
                        @csrf
                        @method('PUT')

                        <!-- New Event Details Card -->
                        <div
                            class="bg-white/80 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-2xl backdrop-blur-lg overflow-hidden shadow-lg">
                            <div class="p-6 border-b border-gray-200 dark:border-white/10">
                                <h3 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center">
                                    <div
                                        class="w-10 h-10 rounded-xl bg-gradient-to-br from-primary-500 to-accent-500 flex items-center justify-center mr-4">
                                        <i data-lucide="calendar-plus" class="w-5 h-5 text-white"></i>
                                    </div>
                                    New Event Details
                                </h3>
                                <p class="text-gray-600 dark:text-gray-300 mt-2">Specify your new preferred date, time, and
                                    requirements</p>
                            </div>

                            <div class="p-6 space-y-6">
                                <!-- Date and Time Row -->
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                    <!-- Event Date -->
                                    <div class="group">
                                        <label for="event_date"
                                            class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-3 flex items-center">
                                            <i data-lucide="calendar"
                                                class="w-4 h-4 mr-2 text-primary-600 dark:text-primary-400"></i>
                                            Event Date
                                            <span class="text-red-500 dark:text-red-400 ml-1">*</span>
                                        </label>
                                        <div class="relative">
                                            <input type="date" name="event_date" id="event_date"
                                                value="{{ old('event_date', $booking->event_date->format('Y-m-d')) }}"
                                                min="{{ now()->addDay()->format('Y-m-d') }}" required
                                                x-model="formData.event_date"
                                                class="w-full px-4 py-4 pl-12 bg-white dark:bg-gray-800 border-2 border-gray-300 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all duration-300 shadow-sm hover:shadow-md">
                                            <div
                                                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <i data-lucide="calendar"
                                                    class="w-5 h-5 text-gray-500 dark:text-gray-400"></i>
                                            </div>
                                        </div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-2 flex items-center">
                                            <i data-lucide="info" class="w-3 h-3 mr-1"></i>
                                            Must be at least 24 hours in advance
                                        </p>
                                    </div>

                                    <!-- Event Time -->
                                    <div class="group">
                                        <label for="event_time"
                                            class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-3 flex items-center">
                                            <i data-lucide="clock"
                                                class="w-4 h-4 mr-2 text-primary-600 dark:text-primary-400"></i>
                                            Event Time
                                            <span class="text-red-500 dark:text-red-400 ml-1">*</span>
                                        </label>
                                        <div class="relative">
                                            <input type="time" name="event_time" id="event_time"
                                                value="{{ old('event_time', \Carbon\Carbon::parse($booking->event_time)->format('H:i')) }}"
                                                required x-model="formData.event_time"
                                                class="w-full px-4 py-4 pl-12 bg-white dark:bg-gray-800 border-2 border-gray-300 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all duration-300 shadow-sm hover:shadow-md">
                                            <div
                                                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <i data-lucide="clock"
                                                    class="w-5 h-5 text-gray-500 dark:text-gray-400"></i>
                                            </div>
                                        </div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-2 flex items-center">
                                            <i data-lucide="info" class="w-3 h-3 mr-1"></i>
                                            Local time in 24-hour format
                                        </p>
                                    </div>
                                </div>

                                <!-- Duration and Location Row -->
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                    <!-- Duration -->
                                    <div class="group">
                                        <label for="duration"
                                            class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-3 flex items-center">
                                            <i data-lucide="timer"
                                                class="w-4 h-4 mr-2 text-primary-600 dark:text-primary-400"></i>
                                            Duration
                                            <span class="text-red-500 dark:text-red-400 ml-1">*</span>
                                        </label>
                                        <div class="relative">
                                            <select name="duration" id="duration" required x-model="formData.duration"
                                                class="w-full px-4 py-4 pl-12 bg-white dark:bg-gray-800 border-2 border-gray-300 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all duration-300 shadow-sm hover:shadow-md appearance-none">
                                                @foreach ([30, 60, 90, 120, 150, 180, 210, 240, 300, 360] as $mins)
                                                    <option value="{{ $mins }}"
                                                        {{ old('duration', $booking->duration) == $mins ? 'selected' : '' }}
                                                        class="bg-white dark:bg-gray-800 text-gray-900 dark:text-white">
                                                        {{ $mins }} minutes
                                                        @if ($mins >= 60)
                                                            ({{ floor($mins / 60) }}h{{ $mins % 60 ? ' ' . $mins % 60 . 'm' : '' }})
                                                        @endif
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div
                                                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <i data-lucide="timer"
                                                    class="w-5 h-5 text-gray-500 dark:text-gray-400"></i>
                                            </div>
                                            <div
                                                class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                                <i data-lucide="chevron-down"
                                                    class="w-5 h-5 text-gray-500 dark:text-gray-400"></i>
                                            </div>
                                        </div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-2 flex items-center">
                                            <i data-lucide="info" class="w-3 h-3 mr-1"></i>
                                            How long you need the celebrity
                                        </p>
                                    </div>

                                    <!-- Celebrity Preview -->
                                    <div class="flex items-center justify-center lg:justify-start">
                                        <div
                                            class="flex items-center p-4 rounded-xl bg-gradient-to-r from-primary-100 to-accent-100 dark:from-primary-500/10 dark:to-accent-500/10 border border-primary-200 dark:border-primary-500/20">
                                            @if ($celebrity->photo)
                                                <img src="{{ asset('storage/' . $celebrity->photo) }}"
                                                    alt="{{ $celebrity->name }}"
                                                    class="w-12 h-12 rounded-full object-cover border-2 border-primary-400/50">
                                            @else
                                                <div
                                                    class="w-12 h-12 rounded-full bg-primary-100 dark:bg-primary-500/20 flex items-center justify-center border-2 border-primary-400/50">
                                                    <i data-lucide="user"
                                                        class="w-6 h-6 text-primary-600 dark:text-primary-400"></i>
                                                </div>
                                            @endif
                                            <div class="ml-3">
                                                <p class="font-semibold text-gray-900 dark:text-white">
                                                    {{ $celebrity->name }}</p>
                                                <p class="text-sm text-gray-600 dark:text-gray-300">Celebrity</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Event Location -->
                                <div class="group">
                                    <label for="event_location"
                                        class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-3 flex items-center">
                                        <i data-lucide="map-pin"
                                            class="w-4 h-4 mr-2 text-primary-600 dark:text-primary-400"></i>
                                        Event Location
                                        <span class="text-red-500 dark:text-red-400 ml-1">*</span>
                                    </label>
                                    <div class="relative">
                                        <input type="text" name="event_location" id="event_location"
                                            value="{{ old('event_location', $booking->event_location) }}" required
                                            x-model="formData.event_location"
                                            placeholder="Enter full address or virtual event platform details"
                                            class="w-full px-4 py-4 pl-12 bg-white dark:bg-gray-800 border-2 border-gray-300 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all duration-300 shadow-sm hover:shadow-md">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i data-lucide="map-pin" class="w-5 h-5 text-gray-500 dark:text-gray-400"></i>
                                        </div>
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-2 flex items-center">
                                        <i data-lucide="info" class="w-3 h-3 mr-1"></i>
                                        Physical address, venue name, or online platform details
                                    </p>
                                </div>

                                <!-- Special Requests -->
                                <div class="group">
                                    <label for="special_requests"
                                        class="block text-sm font-semibold text-gray-800 dark:text-gray-200 mb-3 flex items-center">
                                        <i data-lucide="message-square"
                                            class="w-4 h-4 mr-2 text-primary-600 dark:text-primary-400"></i>
                                        Special Requests
                                        <span class="text-gray-500 dark:text-gray-400 text-xs ml-2">(Optional)</span>
                                    </label>
                                    <div class="relative">
                                        <textarea id="special_requests" name="special_requests" rows="4" x-model="formData.special_requests"
                                            placeholder="Any special requirements, outfit preferences, topics to discuss, etc."
                                            class="w-full px-4 py-4 pl-12 pt-4 bg-white dark:bg-gray-800 border-2 border-gray-300 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:border-primary-500 focus:ring-2 focus:ring-primary-500/20 transition-all duration-300 shadow-sm hover:shadow-md resize-none">{{ old('special_requests', $booking->special_requests) }}</textarea>
                                        <div class="absolute top-4 left-3 pointer-events-none">
                                            <i data-lucide="edit-3" class="w-4 h-4 text-gray-500 dark:text-gray-400"></i>
                                        </div>
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-2 flex items-center">
                                        <i data-lucide="lightbulb" class="w-3 h-3 mr-1"></i>
                                        Help us make your event perfect
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Policy Agreement -->
                        <div
                            class="bg-amber-50 dark:bg-amber-500/10 border border-amber-200 dark:border-amber-500/20 rounded-2xl p-6 backdrop-blur-sm">
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0 mt-1">
                                    <input id="policy" name="policy" type="checkbox" required
                                        x-model="formData.policy"
                                        class="w-5 h-5 text-primary-600 bg-white dark:bg-gray-800 border-amber-300 dark:border-amber-400 rounded focus:ring-primary-500 focus:ring-2 focus:ring-offset-0 transition-all duration-200">
                                </div>
                                <div class="flex-1">
                                    <label for="policy"
                                        class="text-gray-900 dark:text-white font-semibold cursor-pointer block">
                                        I understand and agree to the rescheduling policy
                                    </label>
                                    <p class="text-amber-800 dark:text-amber-200 text-sm mt-2 leading-relaxed">
                                        Rescheduling requests are subject to celebrity availability and may incur additional
                                        fees.
                                        Changes must be made at least 72 hours before the original event time.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4 justify-end pt-8">
                            <a href="{{ route('booking.show', $booking->booking_reference) }}"
                                class="order-2 sm:order-1 inline-flex items-center justify-center px-6 py-4 border border-gray-300 dark:border-gray-600 rounded-xl text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:ring-2 focus:ring-gray-300 dark:focus:ring-gray-500 transition-all duration-300 font-medium shadow-sm">
                                <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
                                Cancel Changes
                            </a>

                            <button type="submit" :disabled="!isFormValid"
                                :class="isFormValid ?
                                    'bg-gradient-to-r from-primary-600 to-accent-600 hover:from-primary-700 hover:to-accent-700 shadow-lg hover:shadow-xl' :
                                    'bg-gray-400 dark:bg-gray-600 cursor-not-allowed'"
                                class="order-1 sm:order-2 inline-flex items-center justify-center px-8 py-4 rounded-xl text-white font-semibold focus:ring-2 focus:ring-primary-500/50 transition-all duration-300 transform hover:scale-105 disabled:hover:scale-100 disabled:opacity-50">
                                <div x-show="!submitting" class="flex items-center">
                                    <i data-lucide="check" class="w-4 h-4 mr-2"></i>
                                    Update Booking
                                </div>
                                <div x-show="submitting" class="flex items-center">
                                    <div
                                        class="w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin mr-2">
                                    </div>
                                    Processing...
                                </div>
                            </button>
                        </div>
                    </form>

                    <!-- Process Timeline -->
                    <div
                        class="mt-12 bg-white/80 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-2xl backdrop-blur-lg overflow-hidden shadow-lg">
                        <div class="p-6 border-b border-gray-200 dark:border-white/10">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white flex items-center">
                                <div
                                    class="w-8 h-8 rounded-lg bg-green-100 dark:bg-green-500/20 flex items-center justify-center mr-3">
                                    <i data-lucide="workflow" class="w-4 h-4 text-green-600 dark:text-green-400"></i>
                                </div>
                                What Happens Next?
                            </h3>
                        </div>

                        <div class="p-6">
                            <div class="space-y-4">
                                <div
                                    class="flex items-center p-4 rounded-xl bg-primary-50 dark:bg-primary-500/10 border border-primary-200 dark:border-primary-500/20">
                                    <div
                                        class="w-10 h-10 rounded-full bg-primary-500 flex items-center justify-center mr-4">
                                        <i data-lucide="send" class="w-5 h-5 text-white"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900 dark:text-white">Request Submitted</h4>
                                        <p class="text-gray-600 dark:text-gray-300 text-sm">Your rescheduling request is
                                            sent for review</p>
                                    </div>
                                </div>

                                <div
                                    class="flex items-center p-4 rounded-xl bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10">
                                    <div
                                        class="w-10 h-10 rounded-full bg-gray-500 dark:bg-gray-600 flex items-center justify-center mr-4">
                                        <i data-lucide="user-check" class="w-5 h-5 text-white"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-700 dark:text-gray-300">Availability Check</h4>
                                        <p class="text-gray-600 dark:text-gray-400 text-sm">We verify celebrity
                                            availability for your new date</p>
                                    </div>
                                </div>

                                <div
                                    class="flex items-center p-4 rounded-xl bg-gray-50 dark:bg-white/5 border border-gray-200 dark:border-white/10">
                                    <div
                                        class="w-10 h-10 rounded-full bg-gray-500 dark:bg-gray-600 flex items-center justify-center mr-4">
                                        <i data-lucide="mail-check" class="w-5 h-5 text-white"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-700 dark:text-gray-300">Confirmation</h4>
                                        <p class="text-gray-600 dark:text-gray-400 text-sm">You'll receive email
                                            confirmation within 24 hours</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Donation/Fan Card Info Display -->
                    <div class="mt-8">
                        <div
                            class="bg-white/80 dark:bg-white/5 border border-gray-200 dark:border-white/10 rounded-2xl backdrop-blur-lg p-8 shadow-lg">
                            <div class="text-center py-12">
                                @if ($booking->booking_type == 'donation')
                                    <div
                                        class="w-20 h-20 rounded-full bg-red-100 dark:bg-red-500/20 flex items-center justify-center mx-auto mb-6">
                                        <i data-lucide="heart" class="w-10 h-10 text-red-600 dark:text-red-400"></i>
                                    </div>
                                    <h3 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">Thank You for Your
                                        Donation!</h3>
                                    <p class="text-gray-600 dark:text-gray-300 mb-8 max-w-md mx-auto">Your generous
                                        contribution has been processed successfully and helps support our celebrity
                                        community.</p>

                                    <div
                                        class="max-w-lg mx-auto bg-red-50 dark:bg-red-500/10 border border-red-200 dark:border-red-500/20 rounded-xl p-6 mb-8">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div class="text-center">
                                                <div class="text-sm text-red-600 dark:text-red-300 mb-1">Donation Amount
                                                </div>
                                                <div class="text-2xl font-bold text-gray-900 dark:text-white">
                                                    ${{ number_format($booking->total_amount ?? ($booking->booking_fee ?? 0), 2) }}
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <div class="text-sm text-red-600 dark:text-red-300 mb-1">Transaction ID
                                                </div>
                                                <div class="text-lg font-mono text-gray-900 dark:text-white">
                                                    {{ str_pad($booking->id ?? '0', 8, '0', STR_PAD_LEFT) }}</div>
                                            </div>
                                            <div class="text-center">
                                                <div class="text-sm text-red-600 dark:text-red-300 mb-1">Date</div>
                                                <div class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    {{ $booking->created_at->format('M j, Y') }}</div>
                                            </div>
                                            <div class="text-center">
                                                <div class="text-sm text-red-600 dark:text-red-300 mb-1">Status</div>
                                                <div class="text-lg font-semibold text-green-600 dark:text-green-400">
                                                    {{ ucfirst($booking->payment_status ?? 'Completed') }}</div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div
                                        class="w-20 h-20 rounded-full bg-purple-100 dark:bg-purple-500/20 flex items-center justify-center mx-auto mb-6">
                                        <i data-lucide="credit-card"
                                            class="w-10 h-10 text-purple-600 dark:text-purple-400"></i>
                                    </div>
                                    <h3 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">Your VIP Fan Card
                                    </h3>
                                    <p class="text-gray-600 dark:text-gray-300 mb-8 max-w-md mx-auto">Your VIP Fan Card has
                                        been activated and provides exclusive access to premium content and benefits.</p>

                                    <div
                                        class="max-w-lg mx-auto bg-purple-50 dark:bg-purple-500/10 border border-purple-200 dark:border-purple-500/20 rounded-xl p-6 mb-8">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div class="text-center">
                                                <div class="text-sm text-purple-600 dark:text-purple-300 mb-1">Card Number
                                                </div>
                                                <div class="text-2xl font-bold font-mono text-gray-900 dark:text-white">
                                                    {{ str_pad($booking->id ?? '0', 8, '0', STR_PAD_LEFT) }}</div>
                                            </div>
                                            <div class="text-center">
                                                <div class="text-sm text-purple-600 dark:text-purple-300 mb-1">Card Type
                                                </div>
                                                <div class="text-lg font-semibold text-gray-900 dark:text-white">VIP Access
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <div class="text-sm text-purple-600 dark:text-purple-300 mb-1">Activated
                                                </div>
                                                <div class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    {{ $booking->created_at->format('M j, Y') }}</div>
                                            </div>
                                            <div class="text-center">
                                                <div class="text-sm text-purple-600 dark:text-purple-300 mb-1">Status</div>
                                                <div class="text-lg font-semibold text-green-600 dark:text-green-400">
                                                    Active</div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- Action Buttons -->
                                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                                    <a href="{{ route('user.dashboard') }}"
                                        class="inline-flex items-center justify-center px-8 py-4 border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 transition-all duration-300">
                                        <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
                                        Back to Dashboard
                                    </a>

                                    <button type="button" onclick="window.print()"
                                        class="inline-flex items-center justify-center px-8 py-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 transition-all duration-300">
                                        <i data-lucide="printer" class="w-4 h-4 mr-2"></i>
                                        Print Receipt
                                    </button>

                                    @if ($booking->booking_type == 'fan_card')
                                        <a href="#"
                                            class="inline-flex items-center justify-center px-8 py-4 border border-transparent rounded-xl shadow-sm text-sm font-medium text-white bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 transition-all duration-300">
                                            <i data-lucide="download" class="w-4 h-4 mr-2"></i>
                                            Download Card
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        function bookingEditForm() {
            return {
                submitting: false,
                formData: {
                    event_date: '{{ old('event_date', $booking->event_date->format('Y-m-d')) }}',
                    event_time: '{{ old('event_time', \Carbon\Carbon::parse($booking->event_time)->format('H:i')) }}',
                    duration: '{{ old('duration', $booking->duration) }}',
                    event_location: '{{ old('event_location', $booking->event_location) }}',
                    special_requests: '{{ old('special_requests', $booking->special_requests) }}',
                    policy: false
                },

                get isFormValid() {
                    return this.formData.event_date &&
                        this.formData.event_time &&
                        this.formData.duration &&
                        this.formData.event_location &&
                        this.formData.policy;
                },

                submitForm() {
                    if (this.isFormValid && !this.submitting) {
                        this.submitting = true;
                    }
                }
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons();
        });
    </script>
@endsection
