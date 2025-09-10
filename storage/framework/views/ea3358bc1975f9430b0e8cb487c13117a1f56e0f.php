
<?php $__env->startSection('title', 'User Dashboard'); ?>
<?php $__env->startSection('content'); ?>

    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 pt-16 pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Page Header -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between py-6">
                <div class="flex-1 min-w-0">
                    <h1 class="text-3xl font-bold leading-tight text-gray-900 dark:text-white sm:text-4xl">
                        Welcome, <?php echo e(Auth::user()->name); ?>

                    </h1>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                        Manage your bookings and account details from your personal dashboard
                    </p>
                </div>
                <div class="mt-4 flex md:mt-0 md:ml-4">
                    <a href="<?php echo e(route('celebrities.index')); ?>"
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        <i data-lucide="plus" class="h-4 w-4 mr-2"></i>
                        Browse Celebrities
                    </a>
                </div>
            </div>

            <!-- Status Messages -->
            <?php if(session('success')): ?>
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 6000)"
                    class="rounded-md bg-green-50 p-4 mb-6 animate-fade-in">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i data-lucide="check-circle" class="h-5 w-5 text-green-400"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-green-800">
                                <?php echo e(session('success')); ?>

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
            <?php endif; ?>

            <?php if(session('error')): ?>
                <div x-data="{ show: true }" x-show="show" class="rounded-md bg-red-50 p-4 mb-6 animate-fade-in">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i data-lucide="alert-circle" class="h-5 w-5 text-red-400"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-red-800">
                                <?php echo e(session('error')); ?>

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
            <?php endif; ?>

            <!-- Dashboard Content -->
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3 mt-6">
                <!-- Left Sidebar - User Profile -->
                <div class="lg:col-span-1">
                    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                        <!-- User Profile Card -->
                        <div class="bg-gradient-to-r from-primary-600 to-primary-800 px-6 py-8 text-center">
                            <div class="inline-block relative">
                                <div
                                    class="w-24 h-24 rounded-full bg-white dark:bg-gray-700 mx-auto overflow-hidden border-4 border-white shadow-lg">
                                    <?php if(Auth::user()->profile_photo_path): ?>
                                        <img src="<?php echo e(asset('storage/' . Auth::user()->profile_photo_path)); ?>" alt="Profile"
                                            class="h-full w-full object-cover">
                                    <?php else: ?>
                                        <div
                                            class="w-full h-full flex items-center justify-center bg-gray-100 dark:bg-gray-700 text-primary-600">
                                            <i data-lucide="user" class="h-12 w-12"></i>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <a href="<?php echo e(route('profile.show')); ?>"
                                    class="absolute bottom-0 right-0 bg-white dark:bg-gray-700 rounded-full p-1 shadow-md hover:bg-gray-100 dark:hover:bg-gray-600 transition">
                                    <i data-lucide="edit-3" class="h-4 w-4 text-primary-600"></i>
                                </a>
                            </div>
                            <h3 class="mt-4 text-xl font-semibold text-white"><?php echo e(Auth::user()->name); ?></h3>
                            <p class="text-primary-200"><?php echo e(Auth::user()->email); ?></p>
                        </div>

                        <!-- User Menu -->
                        <nav class="py-3" x-data="{ activeTab: 'dashboard' }">
                            <a href="<?php echo e(route('user.dashboard')); ?>" @click="activeTab = 'dashboard'"
                                :class="{ 'bg-gray-100 dark:bg-gray-700 border-l-4 border-primary-500': activeTab === 'dashboard' }"
                                class="flex items-center px-6 py-3 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                <i data-lucide="layout-dashboard" class="h-5 w-5 mr-3 text-gray-500 dark:text-gray-400"></i>
                                Dashboard
                            </a>
                            <a href="<?php echo e(route('booking.history')); ?>" @click="activeTab = 'bookings'"
                                :class="{ 'bg-gray-100 dark:bg-gray-700 border-l-4 border-primary-500': activeTab === 'bookings' }"
                                class="flex items-center px-6 py-3 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                <i data-lucide="calendar" class="h-5 w-5 mr-3 text-gray-500 dark:text-gray-400"></i>
                                My Bookings
                            </a>
                            <a href="<?php echo e(route('notifications.index')); ?>" @click="activeTab = 'notifications'"
                                :class="{ 'bg-gray-100 dark:bg-gray-700 border-l-4 border-primary-500': activeTab === 'notifications' }"
                                class="flex items-center px-6 py-3 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                <i data-lucide="bell" class="h-5 w-5 mr-3 text-gray-500 dark:text-gray-400"></i>
                                Notifications
                            </a>
                            <a href="<?php echo e(route('profile.show')); ?>" @click="activeTab = 'profile'"
                                :class="{ 'bg-gray-100 dark:bg-gray-700 border-l-4 border-primary-500': activeTab === 'profile' }"
                                class="flex items-center px-6 py-3 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                <i data-lucide="user" class="h-5 w-5 mr-3 text-gray-500 dark:text-gray-400"></i>
                                My Profile
                            </a>
                            <a href="<?php echo e(route('profile.show')); ?>#password" @click="activeTab = 'security'"
                                :class="{ 'bg-gray-100 dark:bg-gray-700 border-l-4 border-primary-500': activeTab === 'security' }"
                                class="flex items-center px-6 py-3 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                <i data-lucide="shield" class="h-5 w-5 mr-3 text-gray-500 dark:text-gray-400"></i>
                                Security
                            </a>
                            <form method="POST" action="<?php echo e(route('logout')); ?>"
                                class="border-t border-gray-200 dark:border-gray-700 mt-2 pt-2">
                                <?php echo csrf_field(); ?>
                                <button type="submit"
                                    class="flex w-full items-center px-6 py-3 text-sm font-medium text-red-600 dark:text-red-400 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    <i data-lucide="log-out" class="h-5 w-5 mr-3"></i>
                                    Log Out
                                </button>
                            </form>
                        </nav>
                    </div>

                    <!-- Account Stats -->
                    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden mt-6">
                        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Account Info</h3>
                        </div>
                        <div class="px-6 py-4 space-y-4">
                            <div class="flex justify-between">
                                <span class="text-gray-500 dark:text-gray-400">Member Since</span>
                                <span
                                    class="text-gray-900 dark:text-white font-medium"><?php echo e(Auth::user()->created_at->format('M j, Y')); ?></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500 dark:text-gray-400">Total Bookings</span>
                                <span class="text-gray-900 dark:text-white font-medium"><?php echo e($bookings->count()); ?></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500 dark:text-gray-400">Upcoming Events</span>
                                <span class="text-gray-900 dark:text-white font-medium"><?php echo e($upcomingBookings); ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                            <div class="px-6 py-5">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-primary-100 dark:bg-primary-900/50 rounded-md p-3">
                                        <i data-lucide="calendar"
                                            class="h-6 w-6 text-primary-600 dark:text-primary-400"></i>
                                    </div>
                                    <div class="ml-5 w-0 flex-1">
                                        <dl>
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">
                                                Upcoming Bookings</dt>
                                            <dd>
                                                <span
                                                    class="text-lg font-semibold text-gray-900 dark:text-white"><?php echo e($upcomingBookings); ?></span>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="bg-gray-50 dark:bg-gray-700 px-5 py-3 border-t border-gray-200 dark:border-gray-600">
                                <div class="text-sm">
                                    <a href="<?php echo e(route('booking.history')); ?>"
                                        class="font-medium text-primary-600 hover:text-primary-500">View all<span
                                            class="sr-only"> bookings</span></a>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                            <div class="px-6 py-5">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-amber-100 dark:bg-amber-900/50 rounded-md p-3">
                                        <i data-lucide="hourglass" class="h-6 w-6 text-amber-600 dark:text-amber-400"></i>
                                    </div>
                                    <div class="ml-5 w-0 flex-1">
                                        <dl>
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">
                                                Pending Bookings</dt>
                                            <dd>
                                                <span
                                                    class="text-lg font-semibold text-gray-900 dark:text-white"><?php echo e($pendingBookings); ?></span>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="bg-gray-50 dark:bg-gray-700 px-5 py-3 border-t border-gray-200 dark:border-gray-600">
                                <div class="text-sm">
                                    <a href="<?php echo e(route('booking.history')); ?>"
                                        class="font-medium text-primary-600 hover:text-primary-500">View all<span
                                            class="sr-only"> pending</span></a>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                            <div class="px-6 py-5">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 bg-green-100 dark:bg-green-900/50 rounded-md p-3">
                                        <i data-lucide="check-circle"
                                            class="h-6 w-6 text-green-600 dark:text-green-400"></i>
                                    </div>
                                    <div class="ml-5 w-0 flex-1">
                                        <dl>
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">
                                                Completed Bookings</dt>
                                            <dd>
                                                <span
                                                    class="text-lg font-semibold text-gray-900 dark:text-white"><?php echo e($completedBookings); ?></span>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="bg-gray-50 dark:bg-gray-700 px-5 py-3 border-t border-gray-200 dark:border-gray-600">
                                <div class="text-sm">
                                    <a href="<?php echo e(route('booking.history')); ?>"
                                        class="font-medium text-primary-600 hover:text-primary-500">View all<span
                                            class="sr-only"> completed</span></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Bookings -->
                    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                        <div
                            class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Recent Bookings</h3>
                            <a href="<?php echo e(route('booking.history')); ?>"
                                class="text-sm font-medium text-primary-600 hover:text-primary-500">View all</a>
                        </div>
                        <div class="divide-y divide-gray-200 dark:divide-gray-700">
                            <?php $__empty_1 = true; $__currentLoopData = $bookings->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <div class="px-6 py-4 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-12 w-12 rounded-md overflow-hidden">
                                                <?php if($booking->celebrity->photo): ?>
                                                    <img src="<?php echo e(asset('storage/' . $booking->celebrity->photo)); ?>"
                                                        alt="<?php echo e($booking->celebrity->name); ?>"
                                                        class="h-full w-full object-cover">
                                                <?php else: ?>
                                                    <div
                                                        class="h-full w-full bg-gray-200 dark:bg-gray-600 flex items-center justify-center">
                                                        <i data-lucide="user"
                                                            class="h-6 w-6 text-gray-500 dark:text-gray-400"></i>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="ml-4">
                                                <div class="flex items-center space-x-2">
                                                    <h4 class="text-sm font-medium text-gray-900 dark:text-white">
                                                        <?php echo e($booking->celebrity->name); ?></h4>
                                                    <!-- Enhanced Booking Type Badge -->
                                                    <?php if($booking->booking_type == 'donation'): ?>
                                                        <span
                                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-red-100 to-pink-100 text-red-800 dark:from-red-900/40 dark:to-pink-900/40 dark:text-red-300 border border-red-200 dark:border-red-700/50">
                                                            <i data-lucide="heart" class="w-3 h-3 mr-1"></i>
                                                            💝 Donation
                                                        </span>
                                                    <?php elseif($booking->booking_type == 'fan_card'): ?>
                                                        <span
                                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-purple-100 to-indigo-100 text-purple-800 dark:from-purple-900/40 dark:to-indigo-900/40 dark:text-purple-300 border border-purple-200 dark:border-purple-700/50">
                                                            <i data-lucide="credit-card" class="w-3 h-3 mr-1"></i>
                                                            🎫 Fan Card
                                                        </span>
                                                    <?php else: ?>
                                                        <span
                                                            class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-blue-100 to-cyan-100 text-blue-800 dark:from-blue-900/40 dark:to-cyan-900/40 dark:text-blue-300 border border-blue-200 dark:border-blue-700/50">
                                                            <i data-lucide="calendar" class="w-3 h-3 mr-1"></i>
                                                            📅 Event Booking
                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="mt-2 flex items-center">
                                                    <?php if($booking->booking_type == 'donation'): ?>
                                                        <i data-lucide="dollar-sign"
                                                            class="h-4 w-4 text-red-500 dark:text-red-400 mr-1.5"></i>
                                                        <span class="text-xs text-gray-700 dark:text-gray-300 font-medium">
                                                            Donation Amount: $<?php echo e(number_format($booking->booking_fee, 2)); ?>

                                                        </span>
                                                    <?php elseif($booking->booking_type == 'fan_card'): ?>
                                                        <i data-lucide="star"
                                                            class="h-4 w-4 text-purple-500 dark:text-purple-400 mr-1.5"></i>
                                                        <span class="text-xs text-gray-700 dark:text-gray-300 font-medium">
                                                            <?php echo e(ucfirst(json_decode($booking->notes)->membership_tier ?? 'Gold')); ?>

                                                            VIP Membership
                                                        </span>
                                                    <?php else: ?>
                                                        <i data-lucide="calendar"
                                                            class="h-4 w-4 text-gray-400 mr-1.5"></i>
                                                        <span class="text-xs text-gray-500 dark:text-gray-400">
                                                            <?php echo e($booking->event_date->format('M j, Y')); ?> at
                                                            <?php echo e(\Carbon\Carbon::parse($booking->event_time)->format('g:i A')); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="mt-1 flex items-center">
                                                    <?php if($booking->booking_type == 'donation'): ?>
                                                        <i data-lucide="heart-handshake"
                                                            class="h-4 w-4 text-red-400 mr-1.5"></i>
                                                        <span
                                                            class="text-xs text-gray-500 dark:text-gray-400 truncate max-w-xs">
                                                            Supporting:
                                                            <?php echo e(json_decode($booking->notes)->charity_preference ?? 'Charity & Community Causes'); ?>

                                                        </span>
                                                    <?php elseif($booking->booking_type == 'fan_card'): ?>
                                                        <i data-lucide="gift" class="h-4 w-4 text-purple-400 mr-1.5"></i>
                                                        <span
                                                            class="text-xs text-gray-500 dark:text-gray-400 truncate max-w-xs">
                                                            VIP Benefits & Exclusive Access
                                                        </span>
                                                    <?php else: ?>
                                                        <i data-lucide="map-pin" class="h-4 w-4 text-gray-400 mr-1.5"></i>
                                                        <span
                                                            class="text-xs text-gray-500 dark:text-gray-400 truncate max-w-xs">
                                                            <?php echo e($booking->event_location); ?>

                                                        </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex flex-col items-end">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                        <?php if($booking->booking_status == 'pending'): ?> bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400 <?php endif; ?>
                                        <?php if($booking->booking_status == 'approved'): ?> bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400 <?php endif; ?>
                                        <?php if($booking->booking_status == 'completed'): ?> bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400 <?php endif; ?>
                                        <?php if($booking->booking_status == 'cancelled'): ?> bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400 <?php endif; ?>">
                                                <?php echo e(ucfirst($booking->booking_status)); ?>

                                            </span>
                                            <div class="mt-2 text-xs text-gray-500 dark:text-gray-400 text-right">
                                                $<?php echo e(number_format($booking->total_amount, 2)); ?>

                                            </div>
                                            <a href="<?php echo e(route('booking.show', $booking->booking_reference)); ?>"
                                                class="mt-2 inline-flex items-center px-3 py-1.5 border border-gray-300 dark:border-gray-600 shadow-sm text-xs font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                                View Details
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="px-6 py-8 text-center">
                                    <i data-lucide="calendar-x" class="h-12 w-12 text-gray-400 mx-auto"></i>
                                    <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">No bookings yet</h3>
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Get started by booking your
                                        favorite celebrity.</p>
                                    <div class="mt-6">
                                        <a href="<?php echo e(route('celebrities.index')); ?>"
                                            class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                            <i data-lucide="plus" class="h-4 w-4 mr-2"></i>
                                            Browse Celebrities
                                        </a>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Featured Celebrities -->
                    <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Featured Celebrities</h3>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                                <?php $__currentLoopData = $featuredCelebrities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $celebrity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div
                                        class="bg-gray-50 dark:bg-gray-700 rounded-lg overflow-hidden shadow-sm hover:shadow-md transition">
                                        <div class="h-36 w-full overflow-hidden">
                                            <?php if($celebrity->photo): ?>
                                                <img src="<?php echo e(asset('storage/' . $celebrity->photo)); ?>"
                                                    alt="<?php echo e($celebrity->name); ?>" class="h-full w-full object-cover">
                                            <?php else: ?>
                                                <div
                                                    class="h-full w-full bg-gray-200 dark:bg-gray-600 flex items-center justify-center">
                                                    <i data-lucide="user" class="h-12 w-12 text-gray-400"></i>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="p-4">
                                            <h4 class="text-sm font-medium text-gray-900 dark:text-white">
                                                <?php echo e($celebrity->name); ?></h4>
                                            <?php if($celebrity->known_for): ?>
                                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                                    <?php echo e($celebrity->known_for); ?></p>
                                            <?php endif; ?>
                                            <div class="mt-3 flex flex-col space-y-2">
                                                <div class="flex justify-between items-center">
                                                    <span
                                                        class="text-xs font-medium text-primary-600">$<?php echo e(number_format($celebrity->booking_fee, 0)); ?></span>
                                                </div>

                                                <!-- Action Buttons Grid -->
                                                <div class="grid grid-cols-2 gap-1.5">
                                                    <a href="<?php echo e(route('booking.form', $celebrity->id)); ?>"
                                                        class="inline-flex items-center justify-center px-2 py-1.5 border border-transparent text-xs font-medium rounded text-white bg-primary-600 hover:bg-primary-700 transition-all duration-300">
                                                        <i data-lucide="calendar" class="w-3 h-3 mr-1"></i>
                                                        Book
                                                    </a>
                                                    <a href="<?php echo e(route('book_celebrity_now', ['id' => $celebrity->id, 'type' => 'donation'])); ?>"
                                                        class="inline-flex items-center justify-center px-2 py-1.5 border border-transparent text-xs font-medium rounded text-white bg-red-500 hover:bg-red-600 transition-all duration-300">
                                                        <i data-lucide="heart" class="w-3 h-3 mr-1"></i>
                                                        Donate
                                                    </a>
                                                </div>

                                                <!-- Fan Card Button -->
                                                <div>
                                                    <a href="<?php echo e(route('book_celebrity_now', ['id' => $celebrity->id, 'type' => 'fan_card'])); ?>"
                                                        class="w-full inline-flex items-center justify-center px-2 py-1.5 border border-primary-600 dark:border-primary-400 text-xs font-medium rounded text-primary-600 dark:text-primary-400 bg-white dark:bg-gray-800 hover:bg-primary-50 dark:hover:bg-primary-900/20 transition-all duration-300">
                                                        <i data-lucide="credit-card" class="w-3 h-3 mr-1"></i>
                                                        Fan Card
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>

                    <!-- Guest Booking Lookup -->
                    <div
                        class="relative bg-gradient-to-br from-white via-blue-50/30 to-indigo-50/50 dark:from-gray-800 dark:via-slate-800/50 dark:to-gray-900 shadow-xl rounded-2xl overflow-hidden border border-gray-100/50 dark:border-gray-700/50 backdrop-blur-sm">
                        <!-- Decorative gradient overlay -->
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-primary-500/5 via-transparent to-purple-500/5 pointer-events-none">
                        </div>

                        <!-- Header with futuristic styling -->
                        <div
                            class="relative px-6 lg:px-8 py-6 border-b border-gray-100/50 dark:border-gray-700/50 bg-white/30 dark:bg-gray-800/30 backdrop-blur-sm">
                            <div class="flex items-center space-x-3">
                                <div
                                    class="w-10 h-10 bg-gradient-to-br from-primary-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <i data-lucide="search" class="w-5 h-5 text-white"></i>
                                </div>
                                <div>
                                    <h3
                                        class="text-xl font-bold bg-gradient-to-r from-gray-900 via-primary-700 to-purple-800 dark:from-white dark:via-primary-400 dark:to-purple-400 bg-clip-text text-transparent">
                                        Find Guest Booking
                                    </h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                        Locate your previous bookings instantly
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Form content -->
                        <div class="relative p-6 lg:p-8" x-data="{ isLoading: false, formValid: false }" x-init="$watch('formValid', value => {
                            const form = $el.querySelector('form');
                            const inputs = form.querySelectorAll('input[required]');
                            formValid = Array.from(inputs).every(input => input.value.trim() !== '');
                        })">
                            <!-- Description with enhanced typography -->
                            <div
                                class="mb-8 p-4 bg-gradient-to-r from-blue-50/80 to-indigo-50/80 dark:from-blue-900/20 dark:to-indigo-900/20 rounded-xl border border-blue-100/50 dark:border-blue-800/30">
                                <div class="flex items-start space-x-3">
                                    <div
                                        class="w-6 h-6 bg-blue-100 dark:bg-blue-800/30 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5">
                                        <i data-lucide="info" class="w-3.5 h-3.5 text-blue-600 dark:text-blue-400"></i>
                                    </div>
                                    <p class="text-sm leading-relaxed text-blue-800 dark:text-blue-200">
                                        Link your previous guest bookings to your account using your email and booking
                                        reference number.
                                    </p>
                                </div>
                            </div>

                            <form action="<?php echo e(route('booking.guest.find')); ?>" method="POST" @submit="isLoading = true"
                                class="space-y-6" x-data="{
                                    bookingRef: '',
                                    email: '',
                                    validateForm() {
                                        this.formValid = this.bookingRef.trim() !== '' && this.email.trim() !== '' && this.email.includes('@');
                                    }
                                }">
                                <?php echo csrf_field(); ?>

                                <!-- Booking Reference Field -->
                                <div class="space-y-2" x-data="{ focused: false }">
                                    <label for="booking_reference"
                                        class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        Booking Reference <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative group">
                                        <div
                                            class="absolute inset-0 bg-gradient-to-r from-primary-500/20 to-purple-500/20 rounded-xl blur opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        </div>
                                        <div class="relative">
                                            <div
                                                class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none z-10">
                                                <div
                                                    class="w-5 h-5 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center">
                                                    <i data-lucide="hash"
                                                        class="w-3 h-3 text-gray-500 dark:text-gray-400"></i>
                                                </div>
                                            </div>
                                            <input type="text" name="booking_reference" id="booking_reference"
                                                x-model="bookingRef" @input="validateForm()" @focus="focused = true"
                                                @blur="focused = false"
                                                :class="{
                                                    'ring-2 ring-primary-500 border-primary-500': focused,
                                                    'border-gray-200 dark:border-gray-600': !focused
                                                }"
                                                class="w-full pl-14 pr-4 py-4 bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm border rounded-xl text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none transition-all duration-300 text-sm font-medium"
                                                placeholder="CBK-ABC12345" required>
                                        </div>
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 flex items-center">
                                        <i data-lucide="help-circle" class="w-3 h-3 mr-1"></i>
                                        Format: CBK-XXXXXXXX (found in your booking confirmation)
                                    </p>
                                </div>

                                <!-- Email Field -->
                                <div class="space-y-2" x-data="{ focused: false, isValid: false }" x-init="$watch('email', value => {
                                    isValid = value.includes('@') && value.includes('.') && value.length > 5;
                                })">
                                    <label for="email"
                                        class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        Email Address <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative group">
                                        <div
                                            class="absolute inset-0 bg-gradient-to-r from-primary-500/20 to-purple-500/20 rounded-xl blur opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        </div>
                                        <div class="relative">
                                            <div
                                                class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none z-10">
                                                <div
                                                    class="w-5 h-5 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center">
                                                    <i data-lucide="mail"
                                                        class="w-3 h-3 text-gray-500 dark:text-gray-400"></i>
                                                </div>
                                            </div>
                                            <input type="email" name="email" id="email" x-model="email"
                                                @input="validateForm()" @focus="focused = true" @blur="focused = false"
                                                :class="{
                                                    'ring-2 ring-primary-500 border-primary-500': focused,
                                                    'border-gray-200 dark:border-gray-600': !focused,
                                                    'ring-2 ring-green-500 border-green-500': isValid && !focused,
                                                    'ring-2 ring-red-500 border-red-500': email.length > 0 && !
                                                        isValid && !focused
                                                }"
                                                class="w-full pl-14 pr-12 py-4 bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm border rounded-xl text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none transition-all duration-300 text-sm font-medium"
                                                placeholder="your.email@example.com" required>
                                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center z-10">
                                                <div x-show="isValid" x-transition
                                                    class="w-5 h-5 bg-green-100 dark:bg-green-800/30 rounded-full flex items-center justify-center">
                                                    <i data-lucide="check"
                                                        class="w-3 h-3 text-green-600 dark:text-green-400"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 flex items-center">
                                        <i data-lucide="shield-check" class="w-3 h-3 mr-1"></i>
                                        The email address used during booking
                                    </p>
                                </div>

                                <!-- Submit Button -->
                                <div class="pt-4">
                                    <button type="submit" :disabled="!formValid || isLoading"
                                        :class="{
                                            'opacity-50 cursor-not-allowed': !formValid || isLoading,
                                            'hover:scale-105 hover:shadow-2xl': formValid && !isLoading
                                        }"
                                        class="group relative w-full flex items-center justify-center px-6 py-4 bg-gradient-to-r from-primary-600 via-primary-700 to-purple-700 hover:from-primary-700 hover:via-primary-800 hover:to-purple-800 text-white font-semibold rounded-xl shadow-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-all duration-300 overflow-hidden">

                                        <!-- Button background animation -->
                                        <div
                                            class="absolute inset-0 bg-gradient-to-r from-primary-400 via-primary-500 to-purple-500 opacity-0 group-hover:opacity-20 transition-opacity duration-300">
                                        </div>

                                        <!-- Loading state -->
                                        <div x-show="isLoading"
                                            class="absolute inset-0 bg-gradient-to-r from-primary-600 to-purple-600 flex items-center justify-center">
                                            <div class="flex items-center space-x-2">
                                                <div class="w-4 h-4 bg-white rounded-full animate-pulse"></div>
                                                <div class="w-4 h-4 bg-white rounded-full animate-pulse"
                                                    style="animation-delay: 0.1s"></div>
                                                <div class="w-4 h-4 bg-white rounded-full animate-pulse"
                                                    style="animation-delay: 0.2s"></div>
                                            </div>
                                        </div>

                                        <!-- Button content -->
                                        <div x-show="!isLoading" class="relative flex items-center space-x-3">
                                            <i data-lucide="search" class="w-5 h-5"></i>
                                            <span class="font-semibold">Find My Booking</span>
                                            <i data-lucide="arrow-right"
                                                class="w-4 h-4 group-hover:translate-x-1 transition-transform duration-200"></i>
                                        </div>
                                    </button>
                                </div>

                                <!-- Additional Help -->
                                <div class="mt-6 pt-6 border-t border-gray-100 dark:border-gray-700">
                                    <div
                                        class="flex items-center justify-center space-x-6 text-xs text-gray-500 dark:text-gray-400">
                                        <div class="flex items-center space-x-1">
                                            <i data-lucide="shield" class="w-3 h-3"></i>
                                            <span>Secure Search</span>
                                        </div>
                                        <div class="flex items-center space-x-1">
                                            <i data-lucide="zap" class="w-3 h-3"></i>
                                            <span>Instant Results</span>
                                        </div>
                                        <div class="flex items-center space-x-1">
                                            <i data-lucide="link-2" class="w-3 h-3"></i>
                                            <span>Auto-Link Account</span>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.modern', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/user/Desktop/Websites/Broker/Celebrity/Celebrity/resources/views/user/dashboard.blade.php ENDPATH**/ ?>