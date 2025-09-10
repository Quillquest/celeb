@extends('layouts.modern')

@section('title', 'My Bookings')

@section('content')
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 pt-16 pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between py-6">
                <div class="flex-1 min-w-0">
                    <h1 class="text-3xl font-bold leading-tight text-gray-900 dark:text-white sm:text-4xl">
                        My Bookings
                    </h1>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                        View and manage all your celebrity bookings
                    </p>
                </div>
                <div class="mt-4 flex md:mt-0 md:ml-4">
                    <a href="{{ route('book') }}"
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        <i data-lucide="plus" class="h-4 w-4 mr-2"></i>
                        Book a Celebrity
                    </a>
                </div>
            </div>

            <!-- Status Messages -->
            @if (session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 6000)"
                    class="rounded-md bg-green-50 p-4 mb-6 animate-fade-in">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i data-lucide="check-circle" class="h-5 w-5 text-green-400"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">
                                {{ session('success') }}
                            </p>
                        </div>
                        <div class="ml-auto pl-3">
                            <div class="-mx-1.5 -my-1.5">
                                <button @click="show = false" type="button"
                                    class="inline-flex rounded-md p-1.5 text-green-500 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 focus:ring-offset-green-50">
                                    <span class="sr-only">Dismiss</span>
                                    <i data-lucide="x" class="h-5 w-5"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div x-data="{ show: true }" x-show="show" class="rounded-md bg-red-50 p-4 mb-6 animate-fade-in">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i data-lucide="alert-circle" class="h-5 w-5 text-red-400"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-red-800">
                                {{ session('error') }}
                            </p>
                        </div>
                        <div class="ml-auto pl-3">
                            <div class="-mx-1.5 -my-1.5">
                                <button @click="show = false" type="button"
                                    class="inline-flex rounded-md p-1.5 text-red-500 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2 focus:ring-offset-red-50">
                                    <span class="sr-only">Dismiss</span>
                                    <i data-lucide="x" class="h-5 w-5"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Tabs -->
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden" x-data="{ activeTab: 'all' }">
                <div class="border-b border-gray-200 dark:border-gray-700">
                    <nav class="flex space-x-4 md:space-x-8 px-4 sm:px-6" aria-label="Tabs">
                        <button @click="activeTab = 'all'"
                            :class="{ 'border-primary-500 text-primary-600 dark:text-primary-400': activeTab === 'all', 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300': activeTab !== 'all' }"
                            class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            <div class="flex items-center">
                                <i data-lucide="list" class="h-4 w-4 mr-2"></i>
                                All Bookings
                            </div>
                        </button>
                        <button @click="activeTab = 'upcoming'"
                            :class="{ 'border-primary-500 text-primary-600 dark:text-primary-400': activeTab === 'upcoming', 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300': activeTab !== 'upcoming' }"
                            class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            <div class="flex items-center">
                                <i data-lucide="calendar" class="h-4 w-4 mr-2"></i>
                                Upcoming
                            </div>
                        </button>
                        <button @click="activeTab = 'past'"
                            :class="{ 'border-primary-500 text-primary-600 dark:text-primary-400': activeTab === 'past', 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300': activeTab !== 'past' }"
                            class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            <div class="flex items-center">
                                <i data-lucide="clock" class="h-4 w-4 mr-2"></i>
                                Past
                            </div>
                        </button>
                        <button @click="activeTab = 'cancelled'"
                            :class="{ 'border-primary-500 text-primary-600 dark:text-primary-400': activeTab === 'cancelled', 'border-transparent text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300': activeTab !== 'cancelled' }"
                            class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            <div class="flex items-center">
                                <i data-lucide="x-circle" class="h-4 w-4 mr-2"></i>
                                Cancelled
                            </div>
                        </button>
                    </nav>
                </div>

                <div class="p-4 sm:p-6">
                    @if (count($bookings) > 0)
                        <!-- Booking Cards -->
                        <div class="grid gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 animate-fade-in">
                            @foreach ($bookings as $booking)
                                <!-- Booking Card -->
                                <div x-show="activeTab === 'all' || 
                                (activeTab === 'upcoming' && ['pending', 'approved'].includes('{{ $booking->booking_status }}') && new Date('{{ $booking->event_date->format('Y-m-d') }}') >= new Date())
|| 
                                (activeTab === 'past' && (new Date('{{ $booking->event_date->format('Y-m-d') }}') < new Date() || '{{ $booking->booking_status }}' === 'completed')) || 
                                (activeTab === 'cancelled' && '{{ $booking->booking_status }}' === 'cancelled')"
                                    class="bg-white dark:bg-gray-700 overflow-hidden shadow-md rounded-lg flex flex-col transition duration-150 ease-in-out transform hover:-translate-y-1 hover:shadow-lg border border-gray-100 dark:border-gray-600">
                                    <div
                                        class="px-4 py-5 sm:px-6 flex justify-between items-center border-b border-gray-200 dark:border-gray-600">
                                        <div class="flex items-center">
                                            @if ($booking->celebrity->photo)
                                                <img src="{{ asset('storage/' . $booking->celebrity->photo) }}"
                                                    alt="{{ $booking->celebrity->name }}"
                                                    class="h-10 w-10 rounded-full object-cover">
                                            @else
                                                <div
                                                    class="h-10 w-10 rounded-full bg-gray-200 dark:bg-gray-600 flex items-center justify-center text-gray-500 dark:text-gray-400">
                                                    <i data-lucide="user" class="h-5 w-5"></i>
                                                </div>
                                            @endif
                                            <div class="ml-3">
                                                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white truncate max-w-[150px]"
                                                    title="{{ $booking->celebrity->name }}">
                                                    {{ $booking->celebrity->name }}
                                                </h3>
                                                <!-- Booking Type Badge -->
                                                @if ($booking->booking_type == 'donation')
                                                    <span
                                                        class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400 mt-1">
                                                        <i data-lucide="heart" class="h-3 w-3 mr-1"></i>
                                                        Donation
                                                    </span>
                                                @elseif($booking->booking_type == 'fan_card')
                                                    <span
                                                        class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-400 mt-1">
                                                        <i data-lucide="credit-card" class="h-3 w-3 mr-1"></i>
                                                        Fan Card
                                                    </span>
                                                @else
                                                    <span
                                                        class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400 mt-1">
                                                        <i data-lucide="calendar" class="h-3 w-3 mr-1"></i>
                                                        Booking
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                @if ($booking->booking_status == 'pending') bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400 @endif
                                @if ($booking->booking_status == 'approved') bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400 @endif
                                @if ($booking->booking_status == 'completed') bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400 @endif
                                @if ($booking->booking_status == 'cancelled') bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400 @endif
                                @if ($booking->booking_status == 'rejected') bg-gray-100 text-gray-800 dark:bg-gray-900/30 dark:text-gray-400 @endif">
                                            {{ ucfirst($booking->booking_status) }}
                                        </span>
                                    </div>
                                    <div class="px-4 py-4 sm:px-6 flex-grow">
                                        <dl class="space-y-2">
                                            @if ($booking->booking_type == 'donation')
                                                <!-- Donation specific information -->
                                                <div class="flex justify-between">
                                                    <dt
                                                        class="text-sm font-medium text-gray-500 dark:text-gray-400 flex items-center">
                                                        <i data-lucide="dollar-sign" class="h-4 w-4 mr-1"></i>
                                                        Amount:
                                                    </dt>
                                                    <dd class="text-sm text-gray-900 dark:text-white font-medium">
                                                        ${{ number_format($booking->total_amount, 2) }}</dd>
                                                </div>
                                                <div class="flex justify-between">
                                                    <dt
                                                        class="text-sm font-medium text-gray-500 dark:text-gray-400 flex items-center">
                                                        <i data-lucide="message-circle" class="h-4 w-4 mr-1"></i>
                                                        Message:
                                                    </dt>
                                                    <dd class="text-sm text-gray-900 dark:text-white font-medium">
                                                        {{ Str::limit($booking->notes ?? 'No message', 30) }}</dd>
                                                </div>
                                            @elseif($booking->booking_type == 'fan_card')
                                                <!-- Fan Card specific information -->
                                                @php
                                                    $fanCardData = json_decode($booking->notes, true) ?? [];
                                                    $tier = $fanCardData['membership_tier'] ?? 'N/A';
                                                    $tierColors = [
                                                        'silver' => 'text-gray-600 dark:text-gray-400',
                                                        'gold' => 'text-yellow-600 dark:text-yellow-400',
                                                        'platinum' => 'text-purple-600 dark:text-purple-400',
                                                    ];
                                                @endphp
                                                <div class="flex justify-between">
                                                    <dt
                                                        class="text-sm font-medium text-gray-500 dark:text-gray-400 flex items-center">
                                                        <i data-lucide="star" class="h-4 w-4 mr-1"></i>
                                                        Tier:
                                                    </dt>
                                                    <dd
                                                        class="text-sm font-medium {{ $tierColors[$tier] ?? 'text-gray-900 dark:text-white' }}">
                                                        {{ ucfirst($tier) }}</dd>
                                                </div>
                                                <div class="flex justify-between">
                                                    <dt
                                                        class="text-sm font-medium text-gray-500 dark:text-gray-400 flex items-center">
                                                        <i data-lucide="dollar-sign" class="h-4 w-4 mr-1"></i>
                                                        Price:
                                                    </dt>
                                                    <dd class="text-sm text-gray-900 dark:text-white font-medium">
                                                        ${{ number_format($booking->total_amount, 2) }}</dd>
                                                </div>
                                            @else
                                                <!-- Standard booking information -->
                                                <div class="flex justify-between">
                                                    <dt
                                                        class="text-sm font-medium text-gray-500 dark:text-gray-400 flex items-center">
                                                        <i data-lucide="calendar" class="h-4 w-4 mr-1"></i>
                                                        Date:
                                                    </dt>
                                                    <dd class="text-sm text-gray-900 dark:text-white font-medium">
                                                        {{ $booking->event_date->format('M j, Y') }}</dd>
                                                </div>
                                                <div class="flex justify-between">
                                                    <dt
                                                        class="text-sm font-medium text-gray-500 dark:text-gray-400 flex items-center">
                                                        <i data-lucide="clock" class="h-4 w-4 mr-1"></i>
                                                        Time:
                                                    </dt>
                                                    <dd class="text-sm text-gray-900 dark:text-white font-medium">
                                                        {{ \Carbon\Carbon::parse($booking->event_time)->format('g:i A') }}
                                                    </dd>
                                                </div>
                                                <div class="flex justify-between">
                                                    <dt
                                                        class="text-sm font-medium text-gray-500 dark:text-gray-400 flex items-center">
                                                        <i data-lucide="bookmark" class="h-4 w-4 mr-1"></i>
                                                        Event:
                                                    </dt>
                                                    <dd class="text-sm text-gray-900 dark:text-white font-medium">
                                                        {{ $booking->event_type }}</dd>
                                                </div>
                                                <div class="pt-2 mt-2 border-t border-gray-200 dark:border-gray-600">
                                                    <dt
                                                        class="text-sm font-medium text-gray-500 dark:text-gray-400 flex items-center mb-1">
                                                        <i data-lucide="map-pin" class="h-4 w-4 mr-1"></i>
                                                        Location:
                                                    </dt>
                                                    <dd
                                                        class="text-sm text-gray-900 dark:text-white font-medium break-words">
                                                        {{ Str::limit($booking->event_location, 50) }}</dd>
                                                </div>
                                            @endif

                                            <!-- Common reference for all types -->
                                            <div
                                                class="flex justify-between {{ $booking->booking_type !== 'booking' ? 'pt-2 mt-2 border-t border-gray-200 dark:border-gray-600' : '' }}">
                                                <dt
                                                    class="text-sm font-medium text-gray-500 dark:text-gray-400 flex items-center">
                                                    <i data-lucide="hash" class="h-4 w-4 mr-1"></i>
                                                    Reference:
                                                </dt>
                                                <dd class="text-sm text-gray-900 dark:text-white font-medium">
                                                    {{ $booking->booking_reference }}</dd>
                                            </div>
                                        </dl>
                                    </div>

                                    <div
                                        class="flex border-t border-gray-200 dark:border-gray-600 divide-x divide-gray-200 dark:divide-gray-600">
                                        <a href="{{ route('booking.show', $booking->booking_reference) }}"
                                            class="flex-1 flex items-center justify-center px-4 py-3 text-sm font-medium text-primary-600 dark:text-primary-400 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors duration-150 ease-in-out">
                                            <i data-lucide="eye" class="h-4 w-4 mr-2"></i>
                                            View Details
                                        </a>
                                        @if (in_array($booking->booking_status, ['pending', 'approved']) && $booking->event_date >= now())
                                            <a href="{{ route('booking.edit', $booking->booking_reference) }}"
                                                class="flex-1 flex items-center justify-center px-4 py-3 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors duration-150 ease-in-out">
                                                <i data-lucide="edit" class="h-4 w-4 mr-2"></i>
                                                Reschedule
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-6">
                            {{ $bookings->links() }}
                        </div>
                    @else
                        <!-- Empty State -->
                        <div class="text-center py-12 px-4 sm:px-6 lg:px-8 animate-fade-in">
                            <i data-lucide="calendar-x" class="mx-auto h-12 w-12 text-gray-400"></i>
                            <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No bookings</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Get started by booking your favorite
                                celebrity.</p>
                            <div class="mt-6">
                                <a href="{{ route('book') }}"
                                    class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                    <i data-lucide="plus" class="h-4 w-4 mr-2"></i>
                                    Book a Celebrity
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Recently Viewed Celebrities (if any) -->
            @if (session('recently_viewed_celebrities') && count(session('recently_viewed_celebrities')))
                <div class="mt-8">
                    <h2 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Recently Viewed Celebrities</h2>
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                        @foreach (session('recently_viewed_celebrities') as $celebrity)
                            <a href="{{ route('booking.form', $celebrity['id']) }}" class="group">
                                <div
                                    class="bg-white dark:bg-gray-800 overflow-hidden shadow rounded-lg transition duration-150 ease-in-out transform group-hover:-translate-y-1 group-hover:shadow-md">
                                    <div class="h-32 bg-gray-200 dark:bg-gray-700">
                                        @if (isset($celebrity['photo']) && $celebrity['photo'])
                                            <img src="{{ asset('storage/' . $celebrity['photo']) }}"
                                                alt="{{ $celebrity['name'] }}" class="h-full w-full object-cover">
                                        @else
                                            <div class="h-full w-full flex items-center justify-center">
                                                <i data-lucide="user" class="h-12 w-12 text-gray-400"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="px-4 py-3">
                                        <p class="text-sm font-medium text-gray-900 dark:text-white truncate">
                                            {{ $celebrity['name'] }}</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ $celebrity['known_for'] ?? 'Celebrity' }}</p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Need Help Section -->
            <div class="mt-8 bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Need Help?</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <a href="{{ route('booking.form', 1) }}"
                            class="flex items-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors duration-150">
                            <div class="flex-shrink-0 bg-primary-100 dark:bg-primary-900/30 p-3 rounded-lg">
                                <i data-lucide="calendar-plus" class="h-6 w-6 text-primary-600 dark:text-primary-400"></i>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-sm font-medium text-gray-900 dark:text-white">New Booking</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Book a new celebrity experience
                                </p>
                            </div>
                        </a>
                        <a href="#"
                            class="flex items-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors duration-150">
                            <div class="flex-shrink-0 bg-amber-100 dark:bg-amber-900/30 p-3 rounded-lg">
                                <i data-lucide="help-circle" class="h-6 w-6 text-amber-600 dark:text-amber-400"></i>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-sm font-medium text-gray-900 dark:text-white">FAQ</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Find answers to common questions
                                </p>
                            </div>
                        </a>
                        <a href="#"
                            class="flex items-center p-4 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors duration-150">
                            <div class="flex-shrink-0 bg-green-100 dark:bg-green-900/30 p-3 rounded-lg">
                                <i data-lucide="message-circle" class="h-6 w-6 text-green-600 dark:text-green-400"></i>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-sm font-medium text-gray-900 dark:text-white">Contact Support</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Get help with your booking</p>
                            </div>
                        </a>
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
