@extends('home.base1')

@section('title', $title)

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 mt-5">
    <!-- Booking Edit Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-gray-900">Reschedule Booking</h1>
        <p class="mt-2 text-sm text-gray-500">
            Reference: <span class="font-medium text-gray-800">{{ $booking->booking_reference }}</span>
        </p>
    </div>

    <!-- Alert for errors -->
    @if ($errors->any())
    <div class="rounded-md bg-red-50 p-4 mb-6">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-red-800">There were errors with your submission</h3>
                <div class="mt-2 text-sm text-red-700">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Current Info Box -->
    <div class="bg-blue-50 border border-blue-200 rounded-md p-4 mb-6">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-blue-800">Currently Scheduled</h3>
                <div class="mt-2 text-sm text-blue-700">
                    <p>Date: <strong>{{ $booking->event_date->format('F j, Y') }}</strong></p>
                    <p>Time: <strong>{{ \Carbon\Carbon::parse($booking->event_time)->format('g:i A') }}</strong></p>
                    <p>Location: <strong>{{ $booking->event_location }}</strong></p>
                    <p>Duration: <strong>{{ $booking->duration }} minutes</strong></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Form -->
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <form action="{{ route('booking.update', $booking->booking_reference) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                    <!-- Event Date -->
                    <div class="sm:col-span-3">
                        <label for="event_date" class="block text-sm font-medium text-gray-700">Event Date</label>
                        <div class="mt-1">
                            <input type="date" name="event_date" id="event_date" 
                                   value="{{ old('event_date', $booking->event_date->format('Y-m-d')) }}" 
                                   min="{{ now()->addDay()->format('Y-m-d') }}"
                                   class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Must be a future date</p>
                    </div>

                    <!-- Event Time -->
                    <div class="sm:col-span-3">
                        <label for="event_time" class="block text-sm font-medium text-gray-700">Event Time</label>
                        <div class="mt-1">
                            <input type="time" name="event_time" id="event_time" 
                                   value="{{ old('event_time', \Carbon\Carbon::parse($booking->event_time)->format('H:i')) }}" 
                                   class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </div>

                    <!-- Duration -->
                    <div class="sm:col-span-3">
                        <label for="duration" class="block text-sm font-medium text-gray-700">Duration (minutes)</label>
                        <div class="mt-1">
                            <select name="duration" id="duration" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                @foreach([30, 60, 90, 120, 150, 180, 210, 240] as $mins)
                                    <option value="{{ $mins }}" {{ old('duration', $booking->duration) == $mins ? 'selected' : '' }}>
                                        {{ $mins }} minutes {{ $mins >= 60 ? '(' . floor($mins/60) . ' hour' . (floor($mins/60) > 1 ? 's' : '') . ($mins % 60 ? ' ' . ($mins % 60) . ' minutes' : '') . ')' : '' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Event Location -->
                    <div class="sm:col-span-6">
                        <label for="event_location" class="block text-sm font-medium text-gray-700">Event Location</label>
                        <div class="mt-1">
                            <input type="text" name="event_location" id="event_location" 
                                   value="{{ old('event_location', $booking->event_location) }}" 
                                   class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>
                    </div>

                    <!-- Special Requests -->
                    <div class="sm:col-span-6">
                        <label for="special_requests" class="block text-sm font-medium text-gray-700">
                            Special Requests (Optional)
                        </label>
                        <div class="mt-1">
                            <textarea id="special_requests" name="special_requests" rows="3" 
                                     class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">{{ old('special_requests', $booking->special_requests) }}</textarea>
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Any special requests or notes for the celebrity</p>
                    </div>
                </div>

                <!-- Notice and policy -->
                <div class="mt-6 bg-gray-50 p-4 rounded-md">
                    <div class="relative flex items-start">
                        <div class="flex items-center h-5">
                            <input id="policy" name="policy" type="checkbox" required
                                   class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="policy" class="font-medium text-gray-700">I understand the rescheduling policy</label>
                            <p class="text-gray-500">Rescheduling may be subject to the celebrity's availability and our terms and conditions.</p>
                        </div>
                    </div>
                </div>

                <!-- Form buttons -->
                <div class="mt-6 flex items-center justify-end">
                    <a href="{{ route('booking.show', $booking->booking_reference) }}" 
                       class="mr-4 bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <!-- Important Note -->
    <div class="mt-8">
        <div class="rounded-md bg-yellow-50 p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-yellow-800">Important information about rescheduling</h3>
                    <div class="mt-2 text-sm text-yellow-700">
                        <ul class="list-disc pl-5 space-y-1">
                            <li>Rescheduling is subject to the celebrity's availability.</li>
                            <li>Rescheduling requests must be made at least 72 hours before the event.</li>
                            <li>You may only reschedule a booking once.</li>
                            <li>Additional fees may apply for certain changes.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection