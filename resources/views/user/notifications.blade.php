@extends('layouts.modern')
@section('title', 'Notifications')
@section('content')

<div class="min-h-screen bg-gray-50 dark:bg-gray-900 pt-16 pb-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between py-6">
            <div class="flex-1 min-w-0">
                <h1 class="text-3xl font-bold leading-tight text-gray-900 dark:text-white sm:text-4xl">
                    Notifications
                </h1>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                    Stay updated with your booking status and important updates
                </p>
            </div>
            <div class="mt-4 flex md:mt-0 md:ml-4 space-x-3">
                <button onclick="markAllAsRead()" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                    <i data-lucide="check-circle" class="h-4 w-4 mr-2"></i>
                    Mark All Read
                </button>
                <button onclick="deleteAllRead()" class="inline-flex items-center px-4 py-2 border border-red-300 dark:border-red-600 rounded-md shadow-sm text-sm font-medium text-red-700 dark:text-red-400 bg-white dark:bg-gray-800 hover:bg-red-50 dark:hover:bg-red-900/20 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    <i data-lucide="trash-2" class="h-4 w-4 mr-2"></i>
                    Clear Read
                </button>
            </div>
        </div>

        <!-- Status Messages -->
        @if (session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 6000)" class="rounded-md bg-green-50 p-4 mb-6 animate-fade-in">
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
                        <button @click="show = false" type="button" class="inline-flex rounded-md p-1.5 text-green-500 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 focus:ring-offset-green-50">
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
                        <button @click="show = false" type="button" class="inline-flex rounded-md p-1.5 text-red-500 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2 focus:ring-offset-red-50">
                            <span class="sr-only">Dismiss</span>
                            <i data-lucide="x" class="h-5 w-5"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Notifications Filter -->
        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg overflow-hidden mb-6">
            <div class="px-6 py-4">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
                    <div class="flex items-center space-x-4">
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Filter:</span>
                        <div class="flex space-x-2">
                            <button onclick="filterNotifications('all')" class="filter-btn active px-3 py-1 text-xs font-medium rounded-full bg-primary-100 text-primary-800 dark:bg-primary-900/30 dark:text-primary-400">
                                All
                            </button>
                            <button onclick="filterNotifications('unread')" class="filter-btn px-3 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600">
                                Unread
                            </button>
                            <button onclick="filterNotifications('booking')" class="filter-btn px-3 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600">
                                Bookings
                            </button>
                            <button onclick="filterNotifications('system')" class="filter-btn px-3 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600">
                                System
                            </button>
                        </div>
                    </div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        <span id="notification-count">{{ $notifications->count() }}</span> notifications
                    </div>
                </div>
            </div>
        </div>

        <!-- Notifications List -->
        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg overflow-hidden">
            <div class="divide-y divide-gray-200 dark:divide-gray-700" id="notifications-container">
                @forelse($notifications as $notification)
                <div class="notification-item {{ ($notification->is_read ?? true) ? 'read' : 'unread' }}" 
                     data-type="{{ $notification->type ?? 'general' }}" 
                     data-id="{{ $notification->id }}">
                    <div class="px-6 py-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-200 {{ !($notification->is_read ?? true) ? 'bg-blue-50/50 dark:bg-blue-900/10' : '' }}">
                        <div class="flex items-start space-x-4">
                            <!-- Notification Icon -->
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center {{ !($notification->is_read ?? true) ? 'bg-primary-100 dark:bg-primary-900/30' : 'bg-gray-100 dark:bg-gray-700' }}">
                                    @if(str_contains($notification->title ?? '', 'Booking'))
                                        <i data-lucide="calendar" class="w-5 h-5 {{ !($notification->is_read ?? true) ? 'text-primary-600 dark:text-primary-400' : 'text-gray-500 dark:text-gray-400' }}"></i>
                                    @elseif(str_contains($notification->title ?? '', 'Payment'))
                                        <i data-lucide="credit-card" class="w-5 h-5 {{ !($notification->is_read ?? true) ? 'text-green-600 dark:text-green-400' : 'text-gray-500 dark:text-gray-400' }}"></i>
                                    @elseif(str_contains($notification->title ?? '', 'Approved'))
                                        <i data-lucide="check-circle" class="w-5 h-5 {{ !($notification->is_read ?? true) ? 'text-green-600 dark:text-green-400' : 'text-gray-500 dark:text-gray-400' }}"></i>
                                    @elseif(str_contains($notification->title ?? '', 'Rejected') || str_contains($notification->title ?? '', 'Cancelled'))
                                        <i data-lucide="x-circle" class="w-5 h-5 {{ !($notification->is_read ?? true) ? 'text-red-600 dark:text-red-400' : 'text-gray-500 dark:text-gray-400' }}"></i>
                                    @else
                                        <i data-lucide="bell" class="w-5 h-5 {{ !($notification->is_read ?? true) ? 'text-blue-600 dark:text-blue-400' : 'text-gray-500 dark:text-gray-400' }}"></i>
                                    @endif
                                </div>
                            </div>

                            <!-- Notification Content -->
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <p class="text-sm font-medium text-gray-900 dark:text-white {{ !($notification->is_read ?? true) ? 'font-semibold' : '' }}">
                                            {{ $notification->title ?? 'Notification' }}
                                        </p>
                                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                            {{ $notification->message ?? 'No message content' }}
                                        </p>
                                        <div class="mt-2 flex items-center space-x-4">
                                            <span class="text-xs text-gray-500 dark:text-gray-500">
                                                <i data-lucide="clock" class="w-3 h-3 inline mr-1"></i>
                                                @if($notification->created_at)
                                                    @if(is_string($notification->created_at))
                                                        {{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}
                                                    @else
                                                        {{ $notification->created_at->diffForHumans() }}
                                                    @endif
                                                @else
                                                    Unknown time
                                                @endif
                                            </span>
                                            @if(isset($notification->action_url) && $notification->action_url)
                                            <a href="{{ $notification->action_url }}" class="text-xs text-primary-600 dark:text-primary-400 hover:text-primary-800 dark:hover:text-primary-300 font-medium">
                                                View Details
                                            </a>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <!-- Notification Actions -->
                                    <div class="flex items-center space-x-2 ml-4">
                                        @if(!($notification->is_read ?? true))
                                        <button onclick="markAsRead({{ $notification->id }})" 
                                                class="text-primary-600 dark:text-primary-400 hover:text-primary-800 dark:hover:text-primary-300" 
                                                title="Mark as read">
                                            <i data-lucide="check" class="w-4 h-4"></i>
                                        </button>
                                        @endif
                                        <button onclick="deleteNotification({{ $notification->id }})" 
                                                class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300" 
                                                title="Delete notification">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>
                                    </div>
                                </div>
                                
                                <!-- Unread Indicator -->
                                @if(!($notification->is_read ?? true))
                                <div class="absolute left-2 top-1/2 transform -translate-y-1/2">
                                    <div class="w-2 h-2 bg-primary-500 rounded-full"></div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="px-6 py-12 text-center">
                    <div class="w-16 h-16 mx-auto mb-4 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center">
                        <i data-lucide="bell-off" class="w-8 h-8 text-gray-400"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">No notifications</h3>
                    <p class="text-gray-500 dark:text-gray-400">You're all caught up! Check back later for new updates.</p>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($notifications instanceof \Illuminate\Pagination\LengthAwarePaginator && $notifications->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                {{ $notifications->links() }}
            </div>
            @endif
        </div>

        <!-- Quick Actions -->
        <div class="mt-6 bg-gradient-to-r from-primary-50 to-blue-50 dark:from-primary-900/20 dark:to-blue-900/20 rounded-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Manage Your Notifications</h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Customize your notification preferences to stay informed about what matters to you.
                    </p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('profile.show') }}#notifications" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700">
                        <i data-lucide="settings" class="w-4 h-4 mr-2"></i>
                        Preferences
                    </a>
                    <a href="{{ route('user.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-md shadow-sm text-sm font-medium text-white hover:bg-primary-700">
                        <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
                        Back to Dashboard
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

// Filter notifications
function filterNotifications(type) {
    const notifications = document.querySelectorAll('.notification-item');
    const buttons = document.querySelectorAll('.filter-btn');
    
    // Update active button
    buttons.forEach(btn => btn.classList.remove('active', 'bg-primary-100', 'text-primary-800', 'dark:bg-primary-900/30', 'dark:text-primary-400'));
    buttons.forEach(btn => btn.classList.add('bg-gray-100', 'text-gray-800', 'dark:bg-gray-700', 'dark:text-gray-300'));
    
    event.target.classList.remove('bg-gray-100', 'text-gray-800', 'dark:bg-gray-700', 'dark:text-gray-300');
    event.target.classList.add('active', 'bg-primary-100', 'text-primary-800', 'dark:bg-primary-900/30', 'dark:text-primary-400');
    
    let visibleCount = 0;
    
    notifications.forEach(notification => {
        let show = false;
        
        if (type === 'all') {
            show = true;
        } else if (type === 'unread') {
            show = notification.classList.contains('unread');
        } else if (type === 'booking') {
            show = notification.dataset.type && (notification.dataset.type.includes('booking') || notification.dataset.type.includes('Booking'));
        } else if (type === 'system') {
            show = notification.dataset.type && (notification.dataset.type.includes('system') || notification.dataset.type.includes('System') || notification.dataset.type === 'general');
        }
        
        if (show) {
            notification.style.display = 'block';
            visibleCount++;
        } else {
            notification.style.display = 'none';
        }
    });
    
    document.getElementById('notification-count').textContent = visibleCount;
}

// Mark notification as read
function markAsRead(notificationId) {
    fetch(`/user/notifications/${notificationId}/mark-read`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const notification = document.querySelector(`[data-id="${notificationId}"]`);
            if (notification) {
                notification.classList.remove('unread', 'bg-blue-50/50', 'dark:bg-blue-900/10');
                notification.classList.add('read');
                notification.querySelector('.font-semibold')?.classList.remove('font-semibold');
                notification.querySelector('button[onclick*="markAsRead"]')?.remove();
            }
        }
    })
    .catch(error => console.error('Error:', error));
}

// Mark all notifications as read
function markAllAsRead() {
    if (!confirm('Mark all notifications as read?')) return;
    
    fetch('/user/notifications/mark-all-read', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    })
    .catch(error => console.error('Error:', error));
}

// Delete notification
function deleteNotification(notificationId) {
    if (!confirm('Delete this notification?')) return;
    
    fetch(`/user/notifications/${notificationId}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const notification = document.querySelector(`[data-id="${notificationId}"]`);
            if (notification) {
                notification.remove();
                updateNotificationCount();
            }
        }
    })
    .catch(error => console.error('Error:', error));
}

// Delete all read notifications
function deleteAllRead() {
    if (!confirm('Delete all read notifications?')) return;
    
    fetch('/user/notifications/delete-read', {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    })
    .catch(error => console.error('Error:', error));
}

// Update notification count
function updateNotificationCount() {
    const visibleNotifications = document.querySelectorAll('.notification-item:not([style*="display: none"])');
    document.getElementById('notification-count').textContent = visibleNotifications.length;
}
</script>

@endsection