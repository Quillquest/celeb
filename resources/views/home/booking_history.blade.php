@extends('home.base1')

@section('title', 'My Bookings')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <!-- Header -->
    <div class="md:flex md:items-center md:justify-between mb-8">
        <div class="flex-1 min-w-0">
            <h1 class="text-3xl font-extrabold text-gray-900 sm:tracking-tight">
                My Bookings
            </h1>
            <p class="mt-2 text-sm text-gray-500">
                View and manage all your celebrity bookings
            </p>
        </div>
        <div class="mt-4 flex md:mt-0">
            <a href="{{ route('booking.form', 1) }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                Book a Celebrity
            </a>
        </div>
    </div>

    <!-- Status Messages -->
    @if (session('success'))
    <div class="rounded-md bg-green-50 p-4 mb-6">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
            </div>
            <div class="ml-auto pl-3">
                <div class="-mx-1.5 -my-1.5">
                    <button type="button" onclick="this.parentElement.parentElement.parentElement.style.display = 'none'" class="inline-flex bg-green-50 rounded-md p-1.5 text-green-500 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-green-50 focus:ring-green-600">
                        <span class="sr-only">Dismiss</span>
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
    
    @if (session('error'))
    <div class="rounded-md bg-red-50 p-4 mb-6">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
            </div>
            <div class="ml-auto pl-3">
                <div class="-mx-1.5 -my-1.5">
                    <button type="button" onclick="this.parentElement.parentElement.parentElement.style.display = 'none'" class="inline-flex bg-red-50 rounded-md p-1.5 text-red-500 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-red-50 focus:ring-red-600">
                        <span class="sr-only">Dismiss</span>
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Tabs -->
    <div x-data="{ activeTab: 'all' }">
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                <button @click="activeTab = 'all'" 
                        :class="{ 'border-indigo-500 text-indigo-600': activeTab === 'all', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'all' }"
                        class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    All Bookings
                </button>
                <button @click="activeTab = 'upcoming'" 
                        :class="{ 'border-indigo-500 text-indigo-600': activeTab === 'upcoming', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'upcoming' }"
                        class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    Upcoming
                </button>
                <button @click="activeTab = 'past'" 
                        :class="{ 'border-indigo-500 text-indigo-600': activeTab === 'past', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'past' }"
                        class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    Past
                </button>
                <button @click="activeTab = 'cancelled'" 
                        :class="{ 'border-indigo-500 text-indigo-600': activeTab === 'cancelled', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'cancelled' }"
                        class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    Cancelled
                </button>
            </nav>
        </div>

        @if(count($bookings) > 0)
        <!-- Booking Cards -->
        <div class="mt-6 grid gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
            @foreach($bookings as $booking)
            <!-- Booking Card -->
            <div x-show="activeTab === 'all' || 
                        (activeTab === 'upcoming' && ['pending', 'approved'].includes('{{ $booking->booking_status }}') && new Date('{{ $booking->event_date->format('Y-m-d') }}') >= new Date()) || 
                        (activeTab === 'past' && (new Date('{{ $booking->event_date->format('Y-m-d') }}') < new Date() || '{{ $booking->booking_status }}' === 'completed')) || 
                        (activeTab === 'cancelled' && '{{ $booking->booking_status }}' === 'cancelled')"
                 class="bg-white overflow-hidden shadow rounded-lg flex flex-col transition duration-150 ease-in-out transform hover:-translate-y-1 hover:shadow-md">
                <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
                    <div class="flex items-center">
                        @if($booking->celebrity->profile_picture)
                            <img src="{{ asset('storage/' . $booking->celebrity->profile_picture) }}" alt="{{ $booking->celebrity->name }}" class="h-10 w-10 rounded-full object-cover">
                        @else
                            <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-500">
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                            </div>
                        @endif
                        <h3 class="ml-3 text-lg leading-6 font-medium text-gray-900 truncate" title="{{ $booking->celebrity->name }}">
                            {{ $booking->celebrity->name }}
                        </h3>
                    </div>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-sm font-medium 
                            @if($booking->booking_status == 'pending') bg-yellow-100 text-yellow-800 @endif
                            @if($booking->booking_status == 'approved') bg-blue-100 text-blue-800 @endif
                            @if($booking->booking_status == 'completed') bg-green-100 text-green-800 @endif
                            @if($booking->booking_status == 'cancelled') bg-red-100 text-red-800 @endif
                            @if($booking->booking_status == 'rejected') bg-gray-100 text-gray-800 @endif">
                        {{ ucfirst($booking->booking_status) }}
                    </span>
                </div>
                <div class="border-t border-gray-200 px-4 py-3 sm:px-6">
                    <dl class="space-y-2">
                        <div class="flex justify-between">
                            <dt class="text-sm font-medium text-gray-500">Date:</dt>
                            <dd class="text-sm text-gray-900">{{ $booking->event_date->format('M j, Y') }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-sm font-medium text-gray-500">Time:</dt>
                            <dd class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($booking->event_time)->format('g:i A') }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-sm font-medium text-gray-500">Event:</dt>
                            <dd class="text-sm text-gray-900">{{ $booking->event_type }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-sm font-medium text-gray-500">Reference:</dt>
                            <dd class="text-sm text-gray-900">{{ $booking->booking_reference }}</dd>
                        </div>
                    </dl>
                </div>
                <div class="border-t border-gray-200 px-4 py-4 sm:px-6 mt-auto">
                    <a href="{{ route('booking.show', $booking->booking_reference) }}" class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        View Details
                    </a>
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
        <div class="text-center py-12 px-4 sm:px-6 lg:px-8">
            <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">No bookings</h3>
            <p class="mt-1 text-sm text-gray-500">Get started by booking your favorite celebrity.</p>
            <div class="mt-6">
                <a href="{{ route('booking.form', 1) }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    Book a Celebrity
                </a>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection