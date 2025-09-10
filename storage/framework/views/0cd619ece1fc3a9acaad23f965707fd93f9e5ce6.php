<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>

    <!-- Hero Section -->
    <section
        class="relative pt-24 pb-16 bg-gradient-to-br from-gray-900 via-<?php echo e($formConfig['primaryColor'] ?? 'primary'); ?>-900 to-gray-900 overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div
                class="absolute -top-20 -right-20 w-96 h-96 bg-<?php echo e($formConfig['primaryColor'] ?? 'primary'); ?>-400 rounded-full mix-blend-overlay filter blur-3xl opacity-20 animate-float">
            </div>
            <div
                class="absolute -bottom-20 -left-20 w-96 h-96 bg-<?php echo e($bookingType == 'donation' ? 'accent' : $formConfig['primaryColor'] ?? 'primary'); ?>-500 rounded-full mix-blend-overlay filter blur-3xl opacity-20 animate-float animation-delay-2000">
            </div>
            <div class="absolute inset-0 bg-grid-white/[0.03] bg-[length:30px_30px]" aria-hidden="true"></div>
        </div>

        <!-- Content -->
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Celebrity Profile Header -->
            <div class="flex flex-col md:flex-row items-center md:items-start gap-6 md:gap-10">
                <!-- Celebrity Image -->
                <div
                    class="relative rounded-xl overflow-hidden shadow-2xl w-40 h-40 md:w-56 md:h-56 lg:w-64 lg:h-64 flex-shrink-0 border-4 border-white/20">
                    <img src="<?php echo e(asset('storage/' . $celebrity->photo)); ?>" alt="<?php echo e($celebrity->name); ?>"
                        class="w-full h-full object-cover object-center">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                </div>

                <!-- Celebrity Info -->
                <div class="text-center md:text-left">
                    <div class="flex flex-col md:flex-row md:items-center gap-3 mb-3">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-12 h-12 rounded-full bg-<?php echo e($formConfig['primaryColor'] ?? 'primary'); ?>-500/20 border border-<?php echo e($formConfig['primaryColor'] ?? 'primary'); ?>-500/30 flex items-center justify-center">
                                <i data-lucide="<?php echo e($formConfig['icon'] ?? 'calendar'); ?>"
                                    class="w-6 h-6 text-<?php echo e($formConfig['primaryColor'] ?? 'primary'); ?>-300"></i>
                            </div>
                            <div>
                                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white">
                                    <?php if($bookingType == 'donation'): ?>
                                        <span class="text-accent-400">Donate</span> with <?php echo e($celebrity->name); ?>

                                    <?php elseif($bookingType == 'fan_card'): ?>
                                        <span class="text-primary-400">VIP Fan Card</span> - <?php echo e($celebrity->name); ?>

                                    <?php else: ?>
                                        <span class="text-primary-400">Book</span> <?php echo e($celebrity->name); ?>

                                    <?php endif; ?>
                                </h1>
                                <p class="text-lg text-white/80 mt-2">
                                    <?php echo e($formConfig['subtitle'] ?? 'Professional booking service'); ?></p>
                            </div>
                        </div>

                        <?php if(isset($celebrity->featured) && $celebrity->featured == 'featured'): ?>
                            <span
                                class="px-3 py-1 bg-accent-500 text-white text-xs font-bold rounded-full uppercase tracking-wider inline-flex items-center gap-1 self-center md:self-start">
                                <i data-lucide="star" class="w-3 h-3"></i>
                                Featured
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="flex flex-wrap gap-3 justify-center md:justify-start mb-6">
                        <?php if(isset($celebrity->country)): ?>
                            <div
                                class="inline-flex items-center px-3 py-1.5 bg-white/10 backdrop-blur-sm rounded-lg text-white text-sm">
                                <i data-lucide="map-pin" class="w-4 h-4 mr-2"></i>
                                <?php echo e(ucfirst($celebrity->country)); ?>

                            </div>
                        <?php endif; ?>

                        <?php if(isset($celebrity->known_for)): ?>
                            <div
                                class="inline-flex items-center px-3 py-1.5 bg-white/10 backdrop-blur-sm rounded-lg text-white text-sm">
                                <i data-lucide="briefcase" class="w-4 h-4 mr-2"></i>
                                <?php echo e($celebrity->known_for); ?>

                            </div>
                        <?php endif; ?>

                        <?php if(isset($celebrity->years_active)): ?>
                            <div
                                class="inline-flex items-center px-3 py-1.5 bg-white/10 backdrop-blur-sm rounded-lg text-white text-sm">
                                <i data-lucide="calendar" class="w-4 h-4 mr-2"></i>
                                <?php echo e($celebrity->years_active); ?> Years Active
                            </div>
                        <?php endif; ?>

                        <div
                            class="inline-flex items-center px-3 py-1.5 bg-white/10 backdrop-blur-sm rounded-lg text-white text-sm">
                            <i data-lucide="star" class="w-4 h-4 mr-2 text-yellow-400 fill-yellow-400"></i>
                            4.9 (120 reviews)
                        </div>
                    </div>

                    <p class="text-white/80 text-lg max-w-2xl mb-6">
                        <?php echo e($formConfig['description'] ?? 'Book ' . $celebrity->name . ' for your next event and create unforgettable memories with one of the most sought-after talents in the industry.'); ?>

                    </p>

                    <?php if(isset($celebrity->booking_fee)): ?>
                        <div
                            class="inline-flex items-center px-4 py-2 bg-<?php echo e($formConfig['primaryColor'] ?? 'primary'); ?>-500/20 border border-<?php echo e($formConfig['primaryColor'] ?? 'primary'); ?>-500/30 rounded-lg text-<?php echo e($formConfig['primaryColor'] ?? 'primary'); ?>-300">
                            <i data-lucide="tag" class="w-5 h-5 mr-2"></i>
                            <span class="text-lg font-semibold">
                                <?php if($bookingType == 'donation'): ?>
                                    Suggested donation:
                                    $<?php echo e(is_numeric($celebrity->booking_fee) ? number_format((float) $celebrity->booking_fee / 10, 0) : '50'); ?>+
                                <?php elseif($bookingType == 'fan_card'): ?>
                                    Fan Card:
                                    $<?php echo e(is_numeric($celebrity->booking_fee) ? number_format((float) $celebrity->booking_fee / 5, 0) : '200'); ?>

                                <?php else: ?>
                                    $<?php echo e(is_numeric($celebrity->booking_fee) ? number_format((float) $celebrity->booking_fee, 0) : $celebrity->booking_fee); ?>

                                <?php endif; ?>
                            </span>
                            <span class="ml-1 text-<?php echo e($formConfig['primaryColor'] ?? 'primary'); ?>-300/80">
                                <?php if($bookingType == 'donation'): ?>
                                    minimum
                                <?php elseif($bookingType == 'fan_card'): ?>
                                    annual membership
                                <?php else: ?>
                                    booking fee
                                <?php endif; ?>
                            </span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Booking Form Section -->
    <section class="py-12 bg-gray-50 dark:bg-gray-800">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <!-- Alerts -->
                <div class="space-y-4 mb-6">
                    <?php if(session('success')): ?>
                        <div class="bg-green-50 dark:bg-green-900/30 border-l-4 border-green-400 p-4 mb-6">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i data-lucide="check-circle" class="h-5 w-5 text-green-400"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-green-700 dark:text-green-400"><?php echo e(session('success')); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if(session('error')): ?>
                        <div class="bg-red-50 dark:bg-red-900/30 border-l-4 border-red-400 p-4 mb-6">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i data-lucide="alert-circle" class="h-5 w-5 text-red-400"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-red-700 dark:text-red-400"><?php echo e(session('error')); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if($errors->any()): ?>
                        <div class="bg-red-50 dark:bg-red-900/30 border-l-4 border-red-400 p-4 mb-6">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i data-lucide="alert-circle" class="h-5 w-5 text-red-400"></i>
                                </div>
                                <div class="ml-3">
                                    <ul class="list-disc pl-5 space-y-1">
                                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="text-sm text-red-700 dark:text-red-400"><?php echo e($error); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Booking Form Card -->
                <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden"
                    x-data="bookingForm()" x-init="init()">
                    <!-- Form Header with Dynamic Tabs -->
                    <div class="bg-gray-50 dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 px-6 py-4">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-full bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center">
                                    <i data-lucide="<?php echo e($formConfig['icon'] ?? 'calendar'); ?>"
                                        class="w-5 h-5 text-primary-600 dark:text-primary-400"></i>
                                </div>
                                <div>
                                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                                        <?php echo e($formConfig['title'] ?? 'Book Celebrity'); ?></h2>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                        <?php echo e($formConfig['subtitle'] ?? 'Complete the form below'); ?></p>
                                </div>
                            </div>
                            <?php if($bookingType == 'donation'): ?>
                                <span class="px-3 py-1 bg-red-100 text-red-800 text-xs font-semibold rounded-full">
                                    <i data-lucide="heart" class="w-3 h-3 inline mr-1"></i>
                                    Charity Donation
                                </span>
                            <?php elseif($bookingType == 'fan_card'): ?>
                                <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded-full">
                                    <i data-lucide="star" class="w-3 h-3 inline mr-1"></i>
                                    VIP Membership
                                </span>
                            <?php else: ?>
                                <span class="px-3 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded-full">
                                    <i data-lucide="calendar" class="w-3 h-3 inline mr-1"></i>
                                    Professional Booking
                                </span>
                            <?php endif; ?>
                        </div>

                        <div class="flex overflow-x-auto scrollbar-hide">
                            <?php if($bookingType == 'donation'): ?>
                                <button @click="switchTab('details')"
                                    :class="{ 'text-red-600 border-red-600': tab === 'details', 'text-gray-500 dark:text-gray-400 border-transparent': tab !== 'details' }"
                                    class="flex items-center px-4 py-2 font-medium text-sm border-b-2 transition-colors whitespace-nowrap">
                                    <i data-lucide="heart" class="w-4 h-4 mr-2"></i>
                                    Donation Details
                                </button>
                                <button @click="switchTab('charity')"
                                    :class="{ 'text-red-600 border-red-600': tab === 'charity', 'text-gray-500 dark:text-gray-400 border-transparent': tab !== 'charity' }"
                                    class="flex items-center px-4 py-2 font-medium text-sm border-b-2 transition-colors whitespace-nowrap">
                                    <i data-lucide="users" class="w-4 h-4 mr-2"></i>
                                    Charity Info
                                </button>
                                <button @click="switchTab('payment')"
                                    :class="{ 'text-red-600 border-red-600': tab === 'payment', 'text-gray-500 dark:text-gray-400 border-transparent': tab !== 'payment' }"
                                    class="flex items-center px-4 py-2 font-medium text-sm border-b-2 transition-colors whitespace-nowrap">
                                    <i data-lucide="credit-card" class="w-4 h-4 mr-2"></i>
                                    Complete Donation
                                </button>
                            <?php elseif($bookingType == 'fan_card'): ?>
                                <button @click="switchTab('details')"
                                    :class="{ 'text-blue-600 border-blue-600': tab === 'details', 'text-gray-500 dark:text-gray-400 border-transparent': tab !== 'details' }"
                                    class="flex items-center px-4 py-2 font-medium text-sm border-b-2 transition-colors whitespace-nowrap">
                                    <i data-lucide="user" class="w-4 h-4 mr-2"></i>
                                    Membership Details
                                </button>
                                <button @click="switchTab('benefits')"
                                    :class="{ 'text-blue-600 border-blue-600': tab === 'benefits', 'text-gray-500 dark:text-gray-400 border-transparent': tab !== 'benefits' }"
                                    class="flex items-center px-4 py-2 font-medium text-sm border-b-2 transition-colors whitespace-nowrap">
                                    <i data-lucide="star" class="w-4 h-4 mr-2"></i>
                                    VIP Benefits
                                </button>
                                <button @click="switchTab('payment')"
                                    :class="{ 'text-blue-600 border-blue-600': tab === 'payment', 'text-gray-500 dark:text-gray-400 border-transparent': tab !== 'payment' }"
                                    class="flex items-center px-4 py-2 font-medium text-sm border-b-2 transition-colors whitespace-nowrap">
                                    <i data-lucide="credit-card" class="w-4 h-4 mr-2"></i>
                                    Purchase Card
                                </button>
                            <?php else: ?>
                                <button @click="switchTab('details')"
                                    :class="{ 'text-blue-600 border-blue-600': tab === 'details', 'text-gray-500 dark:text-gray-400 border-transparent': tab !== 'details' }"
                                    class="flex items-center px-4 py-2 font-medium text-sm border-b-2 transition-colors whitespace-nowrap">
                                    <i data-lucide="clipboard" class="w-4 h-4 mr-2"></i>
                                    Event Details
                                </button>
                                <button @click="switchTab('requirements')"
                                    :class="{ 'text-blue-600 border-blue-600': tab === 'requirements', 'text-gray-500 dark:text-gray-400 border-transparent': tab !== 'requirements' }"
                                    class="flex items-center px-4 py-2 font-medium text-sm border-b-2 transition-colors whitespace-nowrap">
                                    <i data-lucide="list-checks" class="w-4 h-4 mr-2"></i>
                                    Requirements
                                </button>
                                <button @click="switchTab('payment')"
                                    :class="{ 'text-blue-600 border-blue-600': tab === 'payment', 'text-gray-500 dark:text-gray-400 border-transparent': tab !== 'payment' }"
                                    class="flex items-center px-4 py-2 font-medium text-sm border-b-2 transition-colors whitespace-nowrap">
                                    <i data-lucide="credit-card" class="w-4 h-4 mr-2"></i>
                                    Payment
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Form Content -->
                    <div class="p-6">
                        <form action="<?php echo e(route('processBooking')); ?>" method="POST" class="space-y-8" id="booking-form"
                            x-ref="bookingForm">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="celebrity_id" value="<?php echo e($celebrity->id); ?>">
                            <input type="hidden" name="booking_type" value="<?php echo e($bookingType); ?>">
                            <input type="hidden" name="amount"
                                value="<?php echo e(is_numeric($celebrity->booking_fee) ? (float) $celebrity->booking_fee : 1000); ?>">

                            <!-- Hidden fields to ensure core data is always submitted -->
                            <input type="hidden" name="backup_full_name"
                                x-bind:value="$refs.full_name ? $refs.full_name.value : ''">
                            <input type="hidden" name="backup_email"
                                x-bind:value="$refs.email ? $refs.email.value : ''">
                            <input type="hidden" name="backup_phone"
                                x-bind:value="$refs.phone ? $refs.phone.value : ''">

                            <!-- Ensure proper Alpine.js functionality -->
                            <style>
                                /* Remove any conflicting styles that might interfere with Alpine.js */
                                [x-cloak] {
                                    display: none !important;
                                }
                            </style>

                            <!-- Tab Content -->
                            <?php if($bookingType == 'donation'): ?>
                                <!-- DONATION SPECIFIC CONTENT -->
                                <div x-show="tab === 'details'" x-cloak class="space-y-6">
                                    <div
                                        class="bg-red-50 dark:bg-red-900/20 p-4 rounded-lg border border-red-200 dark:border-red-800/30 mb-6">
                                        <div class="flex items-center mb-2">
                                            <i data-lucide="heart" class="w-5 h-5 text-red-600 mr-2"></i>
                                            <h3 class="text-lg font-semibold text-red-900 dark:text-red-100">Make a
                                                Meaningful Donation</h3>
                                        </div>
                                        <p class="text-red-700 dark:text-red-300">Your donation will support
                                            <?php echo e($celebrity->name); ?>'s chosen charitable causes and make a real difference in
                                            the world.</p>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <!-- Donation Amount -->
                                        <div class="md:col-span-2">
                                            <label for="donation_amount"
                                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                                Donation Amount <span class="text-red-500">*</span>
                                            </label>
                                            <div class="grid grid-cols-4 gap-2 mb-3">
                                                <button type="button" onclick="setDonationAmount(50)"
                                                    class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-accent-50 hover:border-accent-500 transition-colors text-sm">$50</button>
                                                <button type="button" onclick="setDonationAmount(100)"
                                                    class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-accent-50 hover:border-accent-500 transition-colors text-sm">$100</button>
                                                <button type="button" onclick="setDonationAmount(250)"
                                                    class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-accent-50 hover:border-accent-500 transition-colors text-sm">$250</button>
                                                <button type="button" onclick="setDonationAmount(500)"
                                                    class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-accent-50 hover:border-accent-500 transition-colors text-sm">$500</button>
                                            </div>
                                            <input type="number" id="donation_amount" name="donation_amount" required
                                                min="10" placeholder="Enter custom amount"
                                                data-label="Donation Amount"
                                                :class="hasFieldError('donation_amount') ? 'border-red-500 ring-red-500' : ''"
                                                class="block w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring focus:ring-red-500/20 focus:border-red-500 transition-colors text-gray-900 dark:text-white">
                                            <div x-show="hasFieldError('donation_amount')"
                                                class="mt-1 text-sm text-red-600"
                                                x-text="getFieldError('donation_amount')"></div>
                                        </div>

                                        <!-- Personal Message -->
                                        <div class="md:col-span-2">
                                            <label for="personal_message"
                                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                                Personal Message (Optional)
                                            </label>
                                            <textarea id="personal_message" name="personal_message" rows="3"
                                                placeholder="Share why you're making this donation or a message for <?php echo e($celebrity->name); ?>..."
                                                class="block w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring focus:ring-red-500/20 focus:border-red-500 transition-colors text-gray-900 dark:text-white"></textarea>
                                        </div>

                                        <!-- Contact Information -->
                                        <div>
                                            <label for="full_name"
                                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                                Full Name <span class="text-red-500">*</span>
                                            </label>
                                            <input type="text" id="full_name" name="full_name" required
                                                value="<?php echo e(Auth::check() ? Auth::user()->name : old('full_name')); ?>"
                                                data-label="Full Name"
                                                :class="hasFieldError('full_name') ? 'border-red-500 ring-red-500' : ''"
                                                class="block w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring focus:ring-red-500/20 focus:border-red-500 transition-colors text-gray-900 dark:text-white">
                                            <div x-show="hasFieldError('full_name')" class="mt-1 text-sm text-red-600"
                                                x-text="getFieldError('full_name')"></div>
                                        </div>

                                        <div>
                                            <label for="email"
                                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                                Email <span class="text-red-500">*</span>
                                            </label>
                                            <input type="email" id="email" name="email" required
                                                value="<?php echo e(Auth::check() ? Auth::user()->email : old('email')); ?>"
                                                data-label="Email Address"
                                                :class="hasFieldError('email') ? 'border-red-500 ring-red-500' : ''"
                                                class="block w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring focus:ring-red-500/20 focus:border-red-500 transition-colors text-gray-900 dark:text-white">
                                            <div x-show="hasFieldError('email')" class="mt-1 text-sm text-red-600"
                                                x-text="getFieldError('email')"></div>
                                        </div>
                                    </div>

                                    <div class="flex justify-end">
                                        <button type="button" @click="switchTab('charity')"
                                            class="inline-flex items-center px-6 py-3 bg-accent-600 hover:bg-accent-700 text-white font-medium rounded-lg transition-colors">
                                            Next: Charity Info
                                            <i data-lucide="arrow-right" class="w-4 h-4 ml-2"></i>
                                        </button>
                                    </div>
                                </div>

                                <div x-show="tab === 'charity'" class="space-y-6" x-cloak>
                                    <div
                                        class="bg-green-50 dark:bg-green-900/20 p-4 rounded-lg border border-green-200 dark:border-green-800/30">
                                        <h3
                                            class="text-lg font-semibold text-green-900 dark:text-green-100 mb-3 flex items-center">
                                            <i data-lucide="users" class="w-5 h-5 text-green-600 mr-2"></i>
                                            <?php echo e($celebrity->name); ?>'s Supported Charities
                                        </h3>
                                        <div class="space-y-3">
                                            <label
                                                class="flex items-center p-3 border border-green-200 dark:border-green-700 rounded-lg hover:bg-green-100 dark:hover:bg-green-800/30 cursor-pointer">
                                                <input type="radio" name="charity_preference"
                                                    value="children_education" required data-label="Charity Preference"
                                                    class="w-4 h-4 text-accent-600">
                                                <div class="ml-3">
                                                    <div class="font-medium text-gray-900 dark:text-white">Children's
                                                        Education Foundation</div>
                                                    <div class="text-sm text-gray-600 dark:text-gray-400">Supporting
                                                        education for underprivileged children worldwide</div>
                                                </div>
                                            </label>
                                            <label
                                                class="flex items-center p-3 border border-green-200 dark:border-green-700 rounded-lg hover:bg-green-100 dark:hover:bg-green-800/30 cursor-pointer">
                                                <input type="radio" name="charity_preference" value="environmental"
                                                    class="w-4 h-4 text-accent-600">
                                                <div class="ml-3">
                                                    <div class="font-medium text-gray-900 dark:text-white">Environmental
                                                        Conservation</div>
                                                    <div class="text-sm text-gray-600 dark:text-gray-400">Climate change
                                                        and environmental protection initiatives</div>
                                                </div>
                                            </label>
                                            <label
                                                class="flex items-center p-3 border border-green-200 dark:border-green-700 rounded-lg hover:bg-green-100 dark:hover:bg-green-800/30 cursor-pointer">
                                                <input type="radio" name="charity_preference" value="healthcare"
                                                    class="w-4 h-4 text-accent-600">
                                                <div class="ml-3">
                                                    <div class="font-medium text-gray-900 dark:text-white">Healthcare
                                                        Access</div>
                                                    <div class="text-sm text-gray-600 dark:text-gray-400">Providing medical
                                                        care to communities in need</div>
                                                </div>
                                            </label>
                                        </div>
                                        <div x-show="hasFieldError('charity_preference')"
                                            class="mt-3 text-sm text-red-600"
                                            x-text="getFieldError('charity_preference')"></div>
                                    </div>

                                    <div class="flex justify-between">
                                        <button type="button" @click="tab = 'details'"
                                            class="inline-flex items-center px-6 py-3 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-white font-medium rounded-lg transition-colors">
                                            <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
                                            Back: Details
                                        </button>
                                        <button type="button" @click="switchTab('payment')"
                                            class="inline-flex items-center px-6 py-3 bg-accent-600 hover:bg-accent-700 text-white font-medium rounded-lg transition-colors">
                                            Next: Complete Donation
                                            <i data-lucide="arrow-right" class="w-4 h-4 ml-2"></i>
                                        </button>
                                    </div>
                                </div>
                            <?php elseif($bookingType == 'fan_card'): ?>
                                <!-- FAN CARD SPECIFIC CONTENT -->
                                <div x-show="tab === 'details'" class="space-y-6">
                                    <div
                                        class="bg-primary-50 dark:bg-primary-900/20 p-4 rounded-lg border border-primary-200 dark:border-primary-800/30 mb-6">
                                        <div class="flex items-center mb-2">
                                            <i data-lucide="star" class="w-5 h-5 text-primary-600 mr-2"></i>
                                            <h3 class="text-lg font-semibold text-primary-900 dark:text-primary-100">
                                                <?php echo e($celebrity->name); ?> VIP Fan Card</h3>
                                        </div>
                                        <p class="text-primary-700 dark:text-primary-300">Join the exclusive fan community
                                            and get special privileges, early access, and personalized content.</p>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <!-- Membership Tier -->
                                        <div class="md:col-span-2">
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">
                                                Select Membership Tier <span class="text-red-500">*</span>
                                            </label>
                                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                                <label
                                                    class="relative p-4 border-2 border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:border-primary-500 transition-colors">
                                                    <input type="radio" name="membership_tier" value="silver"
                                                        class="sr-only">
                                                    <div class="text-center">
                                                        <div
                                                            class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-2">
                                                            <i data-lucide="star" class="w-6 h-6 text-gray-600"></i>
                                                        </div>
                                                        <h4 class="font-semibold text-gray-900 dark:text-white">Silver</h4>
                                                        <p class="text-lg font-bold text-primary-600">$99/year</p>
                                                        <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Basic
                                                            benefits</p>
                                                    </div>
                                                </label>
                                                <label
                                                    class="relative p-4 border-2 border-primary-500 bg-primary-50 dark:bg-primary-900/20 rounded-lg cursor-pointer">
                                                    <input type="radio" name="membership_tier" value="gold" checked
                                                        class="sr-only">
                                                    <div class="text-center">
                                                        <div
                                                            class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-2">
                                                            <i data-lucide="star" class="w-6 h-6 text-yellow-600"></i>
                                                        </div>
                                                        <h4 class="font-semibold text-gray-900 dark:text-white">Gold</h4>
                                                        <p class="text-lg font-bold text-primary-600">$199/year</p>
                                                        <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">
                                                            Recommended</p>
                                                    </div>
                                                </label>
                                                <label
                                                    class="relative p-4 border-2 border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:border-primary-500 transition-colors">
                                                    <input type="radio" name="membership_tier" value="platinum"
                                                        class="sr-only">
                                                    <div class="text-center">
                                                        <div
                                                            class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-2">
                                                            <i data-lucide="crown" class="w-6 h-6 text-purple-600"></i>
                                                        </div>
                                                        <h4 class="font-semibold text-gray-900 dark:text-white">Platinum
                                                        </h4>
                                                        <p class="text-lg font-bold text-primary-600">$399/year</p>
                                                        <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">All
                                                            benefits</p>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>

                                        <!-- Personal Information -->
                                        <div>
                                            <label for="full_name"
                                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                                Full Name <span class="text-red-500">*</span>
                                            </label>
                                            <input type="text" id="full_name" name="full_name" required
                                                value="<?php echo e(Auth::check() ? Auth::user()->name : old('full_name')); ?>"
                                                class="block w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring focus:ring-primary-500/20 focus:border-primary-500 transition-colors text-gray-900 dark:text-white">
                                        </div>

                                        <div>
                                            <label for="email"
                                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                                Email <span class="text-red-500">*</span>
                                            </label>
                                            <input type="email" id="email" name="email" required
                                                value="<?php echo e(Auth::check() ? Auth::user()->email : old('email')); ?>"
                                                class="block w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring focus:ring-primary-500/20 focus:border-primary-500 transition-colors text-gray-900 dark:text-white">
                                        </div>

                                        <div>
                                            <label for="phone"
                                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                                Phone Number <span class="text-red-500">*</span>
                                            </label>
                                            <input type="tel" id="phone" name="phone" required
                                                class="block w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring focus:ring-primary-500/20 focus:border-primary-500 transition-colors text-gray-900 dark:text-white">
                                        </div>

                                        <div>
                                            <label for="date_of_birth"
                                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                                Date of Birth
                                            </label>
                                            <input type="date" id="date_of_birth" name="date_of_birth"
                                                class="block w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring focus:ring-primary-500/20 focus:border-primary-500 transition-colors text-gray-900 dark:text-white">
                                        </div>
                                    </div>

                                    <div class="flex justify-end">
                                        <button type="button" @click="switchTab('benefits')"
                                            class="inline-flex items-center px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-colors">
                                            Next: VIP Benefits
                                            <i data-lucide="arrow-right" class="w-4 h-4 ml-2"></i>
                                        </button>
                                    </div>
                                </div>

                                <div x-show="tab === 'benefits'" class="space-y-6" x-cloak>
                                    <div
                                        class="bg-gradient-to-r from-primary-50 to-purple-50 dark:from-primary-900/20 dark:to-purple-900/20 p-6 rounded-lg border border-primary-200 dark:border-primary-800/30">
                                        <h3
                                            class="text-xl font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                                            <i data-lucide="gift" class="w-6 h-6 text-primary-600 mr-2"></i>
                                            VIP Fan Card Benefits
                                        </h3>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div class="flex items-center p-3 bg-white dark:bg-gray-800 rounded-lg">
                                                <div
                                                    class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                                    <i data-lucide="check" class="w-4 h-4 text-green-600"></i>
                                                </div>
                                                <span class="text-sm font-medium text-gray-800 dark:text-gray-200">Priority
                                                    booking access</span>
                                            </div>
                                            <div class="flex items-center p-3 bg-white dark:bg-gray-800 rounded-lg">
                                                <div
                                                    class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                                    <i data-lucide="percent" class="w-4 h-4 text-blue-600"></i>
                                                </div>
                                                <span class="text-sm font-medium text-gray-800 dark:text-gray-200">15%
                                                    discount on all bookings</span>
                                            </div>
                                            <div class="flex items-center p-3 bg-white dark:bg-gray-800 rounded-lg">
                                                <div
                                                    class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                                                    <i data-lucide="mail" class="w-4 h-4 text-purple-600"></i>
                                                </div>
                                                <span
                                                    class="text-sm font-medium text-gray-800 dark:text-gray-200">Exclusive
                                                    content & updates</span>
                                            </div>
                                            <div class="flex items-center p-3 bg-white dark:bg-gray-800 rounded-lg">
                                                <div
                                                    class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center mr-3">
                                                    <i data-lucide="cake" class="w-4 h-4 text-yellow-600"></i>
                                                </div>
                                                <span class="text-sm font-medium text-gray-800 dark:text-gray-200">Birthday
                                                    messages</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <label for="shipping_address"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                            Shipping Address (for physical fan card)
                                        </label>
                                        <textarea id="shipping_address" name="shipping_address" rows="3"
                                            placeholder="Enter your full shipping address..."
                                            class="block w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring focus:ring-primary-500/20 focus:border-primary-500 transition-colors text-gray-900 dark:text-white"></textarea>
                                    </div>

                                    <div class="flex justify-between">
                                        <button type="button" @click="tab = 'details'"
                                            class="inline-flex items-center px-6 py-3 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-white font-medium rounded-lg transition-colors">
                                            <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
                                            Back: Details
                                        </button>
                                        <button type="button" @click="switchTab('payment')"
                                            class="inline-flex items-center px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-colors">
                                            Next: Purchase Card
                                            <i data-lucide="arrow-right" class="w-4 h-4 ml-2"></i>
                                        </button>
                                    </div>
                                </div>
                            <?php else: ?>
                                <!-- DEFAULT BOOKING CONTENT -->
                                <div x-show="tab === 'details'" x-cloak class="space-y-6">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <!-- Event Type -->
                                        <div>
                                            <label for="event_type"
                                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                                Event Type <span class="text-red-500">*</span>
                                            </label>
                                            <select id="event_type" name="event_type" required data-label="Event Type"
                                                :class="hasFieldError('event_type') ?
                                                    'error-field border-red-500 bg-red-50 dark:bg-red-900/20' : ''"
                                                class="block w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring focus:ring-primary-500/20 focus:border-primary-500 transition-colors text-gray-900 dark:text-white">
                                                <option value="">Select event type</option>
                                                <option value="Corporate Event">Corporate Event</option>
                                                <option value="Birthday Party">Birthday Party</option>
                                                <option value="Wedding">Wedding</option>
                                                <option value="Concert">Concert</option>
                                                <option value="Meet and Greet">Meet and Greet</option>
                                                <option value="Private Performance">Private Performance</option>
                                                <option value="Brand Promotion">Brand Promotion</option>
                                                <option value="Charity Event">Charity Event</option>
                                                <option value="Product Launch">Product Launch</option>
                                                <option value="Other">Other</option>
                                            </select>
                                            <div x-show="hasFieldError('event_type')" x-text="getFieldError('event_type')"
                                                class="mt-1 text-sm text-red-600 dark:text-red-400"></div>
                                        </div>

                                        <!-- Event Location -->
                                        <div>
                                            <label for="event_location"
                                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                                Event Location <span class="text-red-500">*</span>
                                            </label>
                                            <input type="text" id="event_location" name="event_location" required
                                                placeholder="City, State, Country"
                                                class="block w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring focus:ring-primary-500/20 focus:border-primary-500 transition-colors text-gray-900 dark:text-white">
                                        </div>

                                        <!-- Event Date -->
                                        <div>
                                            <label for="event_date"
                                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                                Event Date <span class="text-red-500">*</span>
                                            </label>
                                            <input type="date" id="event_date" name="event_date" required
                                                data-label="Event Date" min="<?php echo e(date('Y-m-d', strtotime('+1 day'))); ?>"
                                                :class="hasFieldError('event_date') ?
                                                    'error-field border-red-500 bg-red-50 dark:bg-red-900/20' : ''"
                                                class="block w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring focus:ring-primary-500/20 focus:border-primary-500 transition-colors text-gray-900 dark:text-white">
                                            <div x-show="hasFieldError('event_date')" x-text="getFieldError('event_date')"
                                                class="mt-1 text-sm text-red-600 dark:text-red-400"></div>
                                        </div>

                                        <!-- Event Time -->
                                        <div>
                                            <label for="event_time"
                                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                                Event Time <span class="text-red-500">*</span>
                                            </label>
                                            <input type="time" id="event_time" name="event_time" required
                                                class="block w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring focus:ring-primary-500/20 focus:border-primary-500 transition-colors text-gray-900 dark:text-white">
                                        </div>

                                        <!-- Full Name -->
                                        <div>
                                            <label for="full_name"
                                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                                Full Name <span class="text-red-500">*</span>
                                            </label>
                                            <input type="text" id="full_name" name="full_name" x-ref="full_name"
                                                data-label="Full Name" placeholder="Your full name" required
                                                value="<?php echo e(Auth::check() ? Auth::user()->name : old('full_name')); ?>"
                                                :class="hasFieldError('full_name') ?
                                                    'error-field border-red-500 bg-red-50 dark:bg-red-900/20' : ''"
                                                class="block w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring focus:ring-red-500/20 focus:border-red-500 transition-colors text-gray-900 dark:text-white">
                                            <div x-show="hasFieldError('full_name')" x-text="getFieldError('full_name')"
                                                class="mt-1 text-sm text-red-600 dark:text-red-400"></div>
                                        </div>

                                        <!-- Email -->
                                        <div>
                                            <label for="email"
                                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                                Email <span class="text-red-500">*</span>
                                            </label>
                                            <input type="email" id="email" name="email" x-ref="email"
                                                data-label="Email Address" placeholder="Your email address" required
                                                value="<?php echo e(Auth::check() ? Auth::user()->email : old('email')); ?>"
                                                :class="hasFieldError('email') ?
                                                    'error-field border-red-500 bg-red-50 dark:bg-red-900/20' : ''"
                                                class="block w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring focus:ring-red-500/20 focus:border-red-500 transition-colors text-gray-900 dark:text-white">
                                            <div x-show="hasFieldError('email')" x-text="getFieldError('email')"
                                                class="mt-1 text-sm text-red-600 dark:text-red-400"></div>
                                        </div>

                                        <!-- Phone -->
                                        <div>
                                            <label for="phone"
                                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                                Phone Number <span class="text-red-500">*</span>
                                            </label>
                                            <input type="tel" id="phone" name="phone" x-ref="phone"
                                                data-label="Phone Number" placeholder="Your phone number" required
                                                value="<?php echo e(old('phone')); ?>"
                                                :class="hasFieldError('phone') ?
                                                    'error-field border-red-500 bg-red-50 dark:bg-red-900/20' : ''"
                                                class="block w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring focus:ring-red-500/20 focus:border-red-500 transition-colors text-gray-900 dark:text-white">
                                            <div x-show="hasFieldError('phone')" x-text="getFieldError('phone')"
                                                class="mt-1 text-sm text-red-600 dark:text-red-400"></div>
                                        </div>

                                        <!-- Gender -->
                                        <div>
                                            <label for="gender"
                                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                                Gender
                                            </label>
                                            <select id="gender" name="gender"
                                                class="block w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring focus:ring-primary-500/20 focus:border-primary-500 transition-colors text-gray-900 dark:text-white">
                                                <option value="">Select gender (optional)</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>

                                        <!-- Duration -->
                                        <div class="md:col-span-2">
                                            <label for="duration"
                                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                                Duration (minutes) <span class="text-red-500">*</span>
                                            </label>
                                            <div class="flex items-center">
                                                <input type="range" id="duration" name="duration" min="30"
                                                    max="480" step="30" value="60"
                                                    class="w-full h-2 bg-gray-200 dark:bg-gray-700 rounded-lg appearance-none cursor-pointer"
                                                    oninput="this.nextElementSibling.value = this.value + ' minutes'">
                                                <output class="w-32 text-sm text-gray-700 dark:text-gray-300 ml-4">60
                                                    minutes</output>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex justify-end">
                                        <button type="button" @click="switchTab('requirements')"
                                            class="inline-flex items-center px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-colors">
                                            Next: Requirements
                                            <i data-lucide="arrow-right" class="w-4 h-4 ml-2"></i>
                                        </button>
                                    </div>
                                </div>




                                <div x-show="tab === 'requirements'" class="space-y-6" x-cloak>
                                    <!-- Special Requirements -->
                                    <div>
                                        <label for="special_requests"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                            Special Requests or Requirements
                                        </label>
                                        <textarea id="special_requests" name="special_requests" rows="4"
                                            placeholder="Please specify any special requirements, equipment needs, or specific requests for the celebrity..."
                                            class="block w-full px-4 py-3 bg-gray-50 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg focus:ring focus:ring-primary-500/20 focus:border-primary-500 transition-colors text-gray-900 dark:text-white"></textarea>
                                    </div>

                                    <!-- Celebrity Requirements Info -->
                                    <div
                                        class="bg-gray-50 dark:bg-gray-800 p-4 rounded-lg border border-gray-200 dark:border-gray-700">
                                        <h3
                                            class="text-lg font-medium text-gray-900 dark:text-white mb-3 flex items-center">
                                            <i data-lucide="info" class="w-5 h-5 text-primary-600 mr-2"></i>
                                            Celebrity Requirements
                                        </h3>
                                        <ul class="space-y-2 pl-8 list-disc">
                                            <li class="text-gray-600 dark:text-gray-400">Professional sound system required
                                                for performances</li>
                                            <li class="text-gray-600 dark:text-gray-400">Private green room with
                                                refreshments</li>
                                            <li class="text-gray-600 dark:text-gray-400">Security personnel must be
                                                provided</li>
                                            <li class="text-gray-600 dark:text-gray-400">Transportation from local
                                                airport/hotel</li>
                                            <li class="text-gray-600 dark:text-gray-400"><?php echo e($celebrity->name); ?> requires
                                                approval of any recording or photography</li>
                                        </ul>
                                    </div>

                                    <div class="flex justify-between">
                                        <button type="button" @click="tab = 'details'"
                                            class="inline-flex items-center px-6 py-3 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-white font-medium rounded-lg transition-colors">
                                            <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
                                            Back: Details
                                        </button>
                                        <button type="button" @click="switchTab('payment')"
                                            class="inline-flex items-center px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-colors">
                                            Next: Payment
                                            <i data-lucide="arrow-right" class="w-4 h-4 ml-2"></i>
                                        </button>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div x-show="tab === 'payment'" class="space-y-6" x-cloak>
                                <!-- Payment Summary -->
                                <div
                                    class="bg-gray-50 dark:bg-gray-800 p-6 rounded-lg border border-gray-200 dark:border-gray-700">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                                        <i data-lucide="<?php echo e($formConfig['icon'] ?? 'calendar'); ?>"
                                            class="w-6 h-6 text-<?php echo e($formConfig['primaryColor'] ?? 'primary'); ?>-600 mr-2"></i>
                                        <?php if($bookingType == 'donation'): ?>
                                            Donation Summary
                                        <?php elseif($bookingType == 'fan_card'): ?>
                                            Membership Summary
                                        <?php else: ?>
                                            Booking Summary
                                        <?php endif; ?>
                                    </h3>
                                    <div class="space-y-3">
                                        <div class="flex justify-between">
                                            <span class="text-gray-600 dark:text-gray-400">Celebrity:</span>
                                            <span
                                                class="font-medium text-gray-900 dark:text-white"><?php echo e($celebrity->name); ?></span>
                                        </div>
                                        <?php if($bookingType == 'donation'): ?>
                                            <div class="flex justify-between">
                                                <span class="text-gray-600 dark:text-gray-400">Donation Amount:</span>
                                                <span class="font-medium text-gray-900 dark:text-white"
                                                    id="donation-display">$50.00</span>
                                            </div>
                                            <div class="flex justify-between">
                                                <span class="text-gray-600 dark:text-gray-400">Processing Fee (3%):</span>
                                                <span class="font-medium text-gray-900 dark:text-white"
                                                    id="donation-fee-display">$1.50</span>
                                            </div>
                                            <div
                                                class="border-t border-gray-200 dark:border-gray-700 pt-3 flex justify-between">
                                                <span class="font-semibold text-gray-900 dark:text-white">Total
                                                    Amount:</span>
                                                <span class="font-bold text-lg text-accent-600"
                                                    id="donation-total-display">$51.50</span>
                                            </div>
                                        <?php elseif($bookingType == 'fan_card'): ?>
                                            <div class="flex justify-between">
                                                <span class="text-gray-600 dark:text-gray-400">Membership Tier:</span>
                                                <span class="font-medium text-gray-900 dark:text-white"
                                                    id="tier-display">Gold</span>
                                            </div>
                                            <div class="flex justify-between">
                                                <span class="text-gray-600 dark:text-gray-400">Annual Fee:</span>
                                                <span class="font-medium text-gray-900 dark:text-white"
                                                    id="tier-price-display">$199.00</span>
                                            </div>
                                            <div class="flex justify-between">
                                                <span class="text-gray-600 dark:text-gray-400">Processing Fee:</span>
                                                <span class="font-medium text-gray-900 dark:text-white">$9.95</span>
                                            </div>
                                            <div
                                                class="border-t border-gray-200 dark:border-gray-700 pt-3 flex justify-between">
                                                <span class="font-semibold text-gray-900 dark:text-white">Total
                                                    Amount:</span>
                                                <span class="font-bold text-lg text-primary-600"
                                                    id="fancard-total-display">$208.95</span>
                                            </div>
                                        <?php else: ?>
                                            <div class="flex justify-between">
                                                <span class="text-gray-600 dark:text-gray-400">Base Booking Fee:</span>
                                                <span
                                                    class="font-medium text-gray-900 dark:text-white">$<?php echo e(is_numeric($celebrity->booking_fee) ? number_format((float) $celebrity->booking_fee, 2) : $celebrity->booking_fee); ?></span>
                                            </div>
                                            <div class="flex justify-between">
                                                <span class="text-gray-600 dark:text-gray-400">Service Fee:</span>
                                                <span
                                                    class="font-medium text-gray-900 dark:text-white">$<?php echo e(is_numeric($celebrity->booking_fee) ? number_format((float) $celebrity->booking_fee * 0.05, 2) : '50.00'); ?></span>
                                            </div>
                                            <div
                                                class="border-t border-gray-200 dark:border-gray-700 pt-3 flex justify-between">
                                                <span class="font-semibold text-gray-900 dark:text-white">Total
                                                    Amount:</span>
                                                <span class="font-bold text-lg text-primary-600">
                                                    $<?php echo e(is_numeric($celebrity->booking_fee) ? number_format((float) $celebrity->booking_fee * 1.05, 2) : number_format(1050, 2)); ?>

                                                </span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <!-- Payment Method Selection -->
                                <div
                                    class="bg-white dark:bg-gray-900 p-6 rounded-lg border border-gray-200 dark:border-gray-800">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                                        <i data-lucide="credit-card" class="w-5 h-5 text-blue-600 mr-2"></i>
                                        Select Payment Method
                                    </h3>
                                    <select x-model="selectedPaymentMethod" @change="updatePaymentDetails()"
                                        name="payment_method" required
                                        class="block w-full px-3 py-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700
                                               rounded-lg text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        <option value="">Choose a payment method...</option>
                                        <?php if(isset($paymentMethods) && $paymentMethods->count() > 0): ?>
                                            <?php $__currentLoopData = $paymentMethods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($method->id); ?>"><?php echo e($method->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <option value="bitcoin">Bitcoin (BTC)</option>
                                            <option value="ethereum">Ethereum (ETH)</option>
                                            <option value="usdt">Tether (USDT)</option>
                                        <?php endif; ?>
                                    </select>
                                </div>

                                <!-- Payment Details (shown when method is selected) -->
                                <div x-show="selectedPaymentMethod"
                                    class="bg-white dark:bg-gray-900 p-6 rounded-lg border border-gray-200 dark:border-gray-800">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                                        <i data-lucide="wallet" class="w-5 h-5 text-green-600 mr-2"></i>
                                        Payment Details
                                    </h3>

                                    <!-- Payment Instructions -->
                                    <div
                                        class="bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 rounded-lg p-4 mb-6">
                                        <div class="flex items-start gap-3">
                                            <i data-lucide="info"
                                                class="w-5 h-5 text-amber-600 dark:text-amber-400 mt-0.5"></i>
                                            <div>
                                                <h4 class="font-medium text-amber-800 dark:text-amber-200 mb-2">Payment
                                                    Instructions</h4>

                                                <!-- Crypto Payment Instructions -->
                                                <div x-show="selectedPaymentData && selectedPaymentData.wallet_address">
                                                    <ol
                                                        class="list-decimal list-inside space-y-1 text-sm text-amber-700 dark:text-amber-300">
                                                        <li>Send the exact amount to the wallet address below</li>
                                                        <li>Upload a screenshot of your transaction as proof</li>
                                                        <li>Submit the form and wait for confirmation</li>
                                                    </ol>
                                                </div>

                                                <!-- Bank Transfer Instructions -->
                                                <div x-show="selectedPaymentData && !selectedPaymentData.wallet_address">
                                                    <ol
                                                        class="list-decimal list-inside space-y-1 text-sm text-amber-700 dark:text-amber-300">
                                                        <li>Transfer the exact amount to the bank account details below</li>
                                                        <li>Include your booking reference in the transfer description</li>
                                                        <li>Upload a copy of the transfer receipt or confirmation</li>
                                                        <li>Allow 1-3 business days for bank transfer processing</li>
                                                        <li>Submit the form and wait for confirmation</li>
                                                    </ol>
                                                </div>

                                                <!-- Default instructions when no method selected -->
                                                <div x-show="!selectedPaymentData">
                                                    <ol
                                                        class="list-decimal list-inside space-y-1 text-sm text-amber-700 dark:text-amber-300">
                                                        <li>Select a payment method from the dropdown above</li>
                                                        <li>Follow the specific payment instructions</li>
                                                        <li>Upload proof of payment</li>
                                                    </ol>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="grid lg:grid-cols-2 gap-6">
                                        <!-- Crypto Payment Section (QR Code & Wallet) - Show for crypto methods -->
                                        <div x-show="selectedPaymentData && selectedPaymentData.wallet_address"
                                            class="space-y-4">
                                            <h4 class="font-medium text-gray-900 dark:text-white flex items-center gap-2">
                                                <i data-lucide="qr-code" class="w-4 h-4 text-blue-600"></i>
                                                QR Code Payment
                                            </h4>
                                            <div class="relative group">
                                                <div
                                                    class="bg-white p-4 rounded-lg border border-gray-200 dark:border-gray-700 text-center">
                                                    <img x-show="selectedPaymentData && selectedPaymentData.wallet_address"
                                                        x-bind:src="'https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=' +
                                                        (selectedPaymentData ? selectedPaymentData.wallet_address : '')"
                                                        alt="Payment QR Code"
                                                        class="w-full h-auto max-w-[200px] mx-auto rounded-lg">
                                                    <div x-show="!selectedPaymentData || !selectedPaymentData.wallet_address"
                                                        class="w-48 h-48 mx-auto bg-gray-100 dark:bg-gray-800 rounded-lg flex items-center justify-center">
                                                        <span class="text-gray-500 dark:text-gray-400 text-sm">Select
                                                            payment method</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 text-center">
                                                Scan with your wallet app to send payment
                                            </p>
                                        </div>

                                        <!-- Wallet Address Section - Show for crypto methods -->
                                        <div x-show="selectedPaymentData && selectedPaymentData.wallet_address"
                                            class="space-y-4">
                                            <!-- Wallet Address -->
                                            <div>
                                                <label
                                                    class="block font-medium text-gray-900 dark:text-white mb-2 flex items-center gap-2">
                                                    <i data-lucide="copy" class="w-4 h-4 text-blue-600"></i>
                                                    <span
                                                        x-text="selectedPaymentData ? selectedPaymentData.name + ' Address' : 'Wallet Address'"></span>
                                                </label>
                                                <div class="relative">
                                                    <input type="text"
                                                        x-bind:value="selectedPaymentData ? selectedPaymentData.wallet_address : ''"
                                                        readonly placeholder="Select a payment method first"
                                                        class="w-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg px-3 py-3 text-sm text-gray-900 dark:text-white break-all">
                                                    <button type="button"
                                                        x-show="selectedPaymentData && selectedPaymentData.wallet_address"
                                                        @click="copyToClipboard(selectedPaymentData.wallet_address)"
                                                        class="absolute right-2 top-1/2 transform -translate-y-1/2 px-3 py-1 bg-blue-600 hover:bg-blue-700 text-white text-xs rounded transition-colors">
                                                        <span x-text="copied ? 'Copied!' : 'Copy'"></span>
                                                    </button>
                                                </div>
                                            </div>

                                            <!-- File Upload for Crypto -->
                                            <div>
                                                <label
                                                    class="block font-medium text-gray-900 dark:text-white mb-2 flex items-center gap-2">
                                                    <i data-lucide="upload" class="w-4 h-4 text-green-600"></i>
                                                    Upload Payment Proof <span class="text-red-500">*</span>
                                                </label>

                                                <input type="file" id="payment_proof" name="payment_proof"
                                                    accept="image/*" required class="hidden"
                                                    @change="handleFileUpload($event)">

                                                <label for="payment_proof"
                                                    class="relative block w-full border-2 border-dashed border-gray-300 dark:border-gray-600 hover:border-blue-500 dark:hover:border-blue-400 rounded-lg p-6 text-center cursor-pointer transition-all duration-200"
                                                    :class="{ 'border-blue-500 bg-blue-50 dark:bg-blue-900/20': isDragOver }"
                                                    @dragover.prevent="isDragOver = true"
                                                    @dragleave.prevent="isDragOver = false"
                                                    @drop.prevent="handleFileDrop($event)">

                                                    <div class="space-y-3">
                                                        <div
                                                            class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center mx-auto">
                                                            <i data-lucide="upload-cloud"
                                                                class="w-6 h-6 text-blue-600 dark:text-blue-400"></i>
                                                        </div>

                                                        <div x-show="!fileName">
                                                            <p class="text-sm font-medium text-gray-900 dark:text-white">
                                                                Choose file or drag & drop</p>
                                                            <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG,
                                                                GIF up to 10MB</p>
                                                        </div>

                                                        <div x-show="fileName" class="text-center">
                                                            <p class="text-sm font-medium text-gray-900 dark:text-white break-all"
                                                                x-text="fileName"></p>
                                                            <p class="text-xs text-gray-500 dark:text-gray-400"
                                                                x-text="fileSize"></p>
                                                            <button type="button" @click.stop="removeFile()"
                                                                class="mt-2 text-red-600 hover:text-red-500 text-xs">
                                                                Remove file
                                                            </button>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>

                                        <!-- Bank Details Section - Show for bank transfer methods -->
                                        <div x-show="selectedPaymentData && !selectedPaymentData.wallet_address"
                                            class="lg:col-span-2 space-y-4">
                                            <h4 class="font-medium text-gray-900 dark:text-white flex items-center gap-2">
                                                <i data-lucide="building-2" class="w-4 h-4 text-green-600"></i>
                                                Bank Transfer Details
                                            </h4>

                                            <div
                                                class="grid md:grid-cols-2 gap-6 bg-gray-50 dark:bg-gray-800 p-6 rounded-lg border border-gray-200 dark:border-gray-700">
                                                <!-- Bank Name -->
                                                <div>
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Bank
                                                        Name</label>
                                                    <div class="flex items-center gap-2">
                                                        <input type="text" readonly
                                                            x-bind:value="selectedPaymentData && selectedPaymentData.bank_name ?
                                                                selectedPaymentData.bank_name : 'Not provided'"
                                                            class="block w-full px-3 py-2 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-600 rounded-md text-gray-900 dark:text-white text-sm">
                                                        <button type="button"
                                                            x-show="selectedPaymentData && selectedPaymentData.bank_name"
                                                            @click="copyToClipboard(selectedPaymentData.bank_name)"
                                                            class="p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                                                            <i data-lucide="copy" class="w-4 h-4"></i>
                                                        </button>
                                                    </div>
                                                </div>

                                                <!-- Account Name -->
                                                <div>
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Account
                                                        Name</label>
                                                    <div class="flex items-center gap-2">
                                                        <input type="text" readonly
                                                            x-bind:value="selectedPaymentData && selectedPaymentData.account_name ?
                                                                selectedPaymentData.account_name : 'Not provided'"
                                                            class="block w-full px-3 py-2 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-600 rounded-md text-gray-900 dark:text-white text-sm">
                                                        <button type="button"
                                                            x-show="selectedPaymentData && selectedPaymentData.account_name"
                                                            @click="copyToClipboard(selectedPaymentData.account_name)"
                                                            class="p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                                                            <i data-lucide="copy" class="w-4 h-4"></i>
                                                        </button>
                                                    </div>
                                                </div>

                                                <!-- Account Number -->
                                                <div>
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Account
                                                        Number</label>
                                                    <div class="flex items-center gap-2">
                                                        <input type="text" readonly
                                                            x-bind:value="selectedPaymentData && selectedPaymentData.account_number ?
                                                                selectedPaymentData.account_number : 'Not provided'"
                                                            class="block w-full px-3 py-2 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-600 rounded-md text-gray-900 dark:text-white text-sm font-mono">
                                                        <button type="button"
                                                            x-show="selectedPaymentData && selectedPaymentData.account_number"
                                                            @click="copyToClipboard(selectedPaymentData.account_number)"
                                                            class="p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                                                            <i data-lucide="copy" class="w-4 h-4"></i>
                                                        </button>
                                                    </div>
                                                </div>

                                                <!-- Swift Code -->
                                                <div x-show="selectedPaymentData && selectedPaymentData.swift_code">
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">SWIFT
                                                        Code</label>
                                                    <div class="flex items-center gap-2">
                                                        <input type="text" readonly
                                                            x-bind:value="selectedPaymentData ? selectedPaymentData.swift_code : ''"
                                                            class="block w-full px-3 py-2 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-600 rounded-md text-gray-900 dark:text-white text-sm font-mono">
                                                        <button type="button"
                                                            @click="copyToClipboard(selectedPaymentData.swift_code)"
                                                            class="p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                                                            <i data-lucide="copy" class="w-4 h-4"></i>
                                                        </button>
                                                    </div>
                                                </div>

                                                <!-- Routing Number -->
                                                <div x-show="selectedPaymentData && selectedPaymentData.routing_number"
                                                    class="md:col-span-2">
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Routing
                                                        Number</label>
                                                    <div class="flex items-center gap-2">
                                                        <input type="text" readonly
                                                            x-bind:value="selectedPaymentData ? selectedPaymentData.routing_number :
                                                                ''"
                                                            class="block w-full px-3 py-2 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-600 rounded-md text-gray-900 dark:text-white text-sm font-mono">
                                                        <button type="button"
                                                            @click="copyToClipboard(selectedPaymentData.routing_number)"
                                                            class="p-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                                                            <i data-lucide="copy" class="w-4 h-4"></i>
                                                        </button>
                                                    </div>
                                                </div>

                                                <!-- Bank Address -->
                                                <div x-show="selectedPaymentData && selectedPaymentData.bank_address"
                                                    class="md:col-span-2">
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Bank
                                                        Address</label>
                                                    <textarea readonly x-bind:value="selectedPaymentData ? selectedPaymentData.bank_address : ''" rows="2"
                                                        class="block w-full px-3 py-2 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-600 rounded-md text-gray-900 dark:text-white text-sm"></textarea>
                                                </div>

                                                <!-- Additional Details -->
                                                <div x-show="selectedPaymentData && selectedPaymentData.details"
                                                    class="md:col-span-2">
                                                    <label
                                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Additional
                                                        Instructions</label>
                                                    <textarea readonly x-bind:value="selectedPaymentData ? selectedPaymentData.details : ''" rows="3"
                                                        class="block w-full px-3 py-2 bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-600 rounded-md text-gray-900 dark:text-white text-sm"></textarea>
                                                </div>
                                            </div>

                                            <!-- Bank Transfer File Upload -->
                                            <div>
                                                <label
                                                    class="block font-medium text-gray-900 dark:text-white mb-2 flex items-center gap-2">
                                                    <i data-lucide="upload" class="w-4 h-4 text-green-600"></i>
                                                    Upload Transfer Receipt <span class="text-red-500">*</span>
                                                </label>

                                                <input type="file" id="payment_proof_bank" name="payment_proof"
                                                    accept="image/*,application/pdf" required class="hidden"
                                                    @change="handleFileUpload($event)">

                                                <label for="payment_proof_bank"
                                                    class="relative block w-full border-2 border-dashed border-gray-300 dark:border-gray-600 hover:border-green-500 dark:hover:border-green-400 rounded-lg p-6 text-center cursor-pointer transition-all duration-200"
                                                    :class="{ 'border-green-500 bg-green-50 dark:bg-green-900/20': isDragOver }"
                                                    @dragover.prevent="isDragOver = true"
                                                    @dragleave.prevent="isDragOver = false"
                                                    @drop.prevent="handleFileDrop($event)">

                                                    <div class="space-y-3">
                                                        <div
                                                            class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center mx-auto">
                                                            <i data-lucide="upload-cloud"
                                                                class="w-6 h-6 text-green-600 dark:text-green-400"></i>
                                                        </div>

                                                        <div x-show="!fileName">
                                                            <p class="text-sm font-medium text-gray-900 dark:text-white">
                                                                Choose file or drag & drop</p>
                                                            <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG,
                                                                PDF up to 10MB</p>
                                                        </div>

                                                        <div x-show="fileName" class="text-center">
                                                            <p class="text-sm font-medium text-gray-900 dark:text-white break-all"
                                                                x-text="fileName"></p>
                                                            <p class="text-xs text-gray-500 dark:text-gray-400"
                                                                x-text="fileSize"></p>
                                                            <button type="button" @click.stop="removeFile()"
                                                                class="mt-2 text-red-600 hover:text-red-500 text-xs">
                                                                Remove file
                                                            </button>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Terms and Conditions -->
                                <div class="flex items-start">
                                    <div class="flex items-center h-5">
                                        <input id="terms" name="terms" type="checkbox" required
                                            class="w-4 h-4 text-<?php echo e($formConfig['primaryColor'] ?? 'primary'); ?>-600 bg-gray-100 dark:bg-gray-800 rounded border-gray-300 dark:border-gray-700 focus:ring-<?php echo e($formConfig['primaryColor'] ?? 'primary'); ?>-500">
                                    </div>
                                    <label for="terms" class="ml-3 text-sm text-gray-600 dark:text-gray-400">
                                        I agree to the <a href="#"
                                            class="text-<?php echo e($formConfig['primaryColor'] ?? 'primary'); ?>-600 hover:underline">Terms
                                            and Conditions</a> and
                                        <?php if($bookingType == 'donation'): ?>
                                            <a href="#"
                                                class="text-<?php echo e($formConfig['primaryColor'] ?? 'primary'); ?>-600 hover:underline">Donation
                                                Policy</a>
                                        <?php elseif($bookingType == 'fan_card'): ?>
                                            <a href="#"
                                                class="text-<?php echo e($formConfig['primaryColor'] ?? 'primary'); ?>-600 hover:underline">Membership
                                                Agreement</a>
                                        <?php else: ?>
                                            <a href="#"
                                                class="text-<?php echo e($formConfig['primaryColor'] ?? 'primary'); ?>-600 hover:underline">Cancellation
                                                Policy</a>
                                        <?php endif; ?>
                                    </label>
                                </div>

                                <div class="flex justify-between">
                                    <button type="button"
                                        @click="tab = '<?php echo e($bookingType == 'donation' ? 'charity' : ($bookingType == 'fan_card' ? 'benefits' : 'requirements')); ?>'"
                                        class="inline-flex items-center px-6 py-3 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-white font-medium rounded-lg transition-colors">
                                        <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
                                        Back
                                    </button>
                                    <button type="button" @click="submitForm()" id="complete-booking-btn"
                                        :disabled="!selectedPaymentMethod || !fileName"
                                        :class="(!selectedPaymentMethod || !fileName) ? 'opacity-50 cursor-not-allowed' :
                                        'hover:bg-<?php echo e($formConfig['primaryColor'] ?? 'primary'); ?>-700'"
                                        class="inline-flex items-center px-8 py-3 bg-<?php echo e($formConfig['primaryColor'] ?? 'primary'); ?>-600 text-white font-medium rounded-lg transition-colors">
                                        <i data-lucide="<?php echo e($formConfig['icon'] ?? 'check-circle'); ?>"
                                            class="w-5 h-5 mr-2"></i>
                                        <?php echo e($formConfig['buttonText'] ?? 'Complete Booking'); ?>

                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Additional Information -->
                <div class="mt-8 space-y-8">
                    <!-- FAQ Section -->
                    <div class="bg-white dark:bg-gray-900 rounded-xl p-6 shadow-lg border border-gray-200 dark:border-gray-700"
                        x-data="{ activeAccordion: null }">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                            <i data-lucide="help-circle" class="w-5 h-5 text-primary-600 mr-2"></i>
                            Frequently Asked Questions
                        </h3>

                        <div class="space-y-3">
                            <!-- FAQ Item 1 -->
                            <div class="border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden">
                                <button @click="activeAccordion = activeAccordion === 1 ? null : 1"
                                    class="flex items-center justify-between w-full px-4 py-3 text-left bg-white dark:bg-gray-900 hover:bg-gray-50 dark:hover:bg-gray-800">
                                    <span class="font-medium text-gray-900 dark:text-white">What happens after I
                                        book?</span>
                                    <i data-lucide="chevron-down"
                                        class="w-5 h-5 text-gray-500 dark:text-gray-400 transition-transform"
                                        :class="{ 'transform rotate-180': activeAccordion === 1 }"></i>
                                </button>
                                <div x-show="activeAccordion === 1" x-collapse>
                                    <div
                                        class="px-4 py-3 bg-gray-50 dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
                                        <p class="text-gray-600 dark:text-gray-400">
                                            After booking, you'll receive a confirmation email with your booking details.
                                            Our team will review your request and reach out within 24-48 hours to confirm
                                            availability and discuss further details.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- FAQ Item 2 -->
                            <div class="border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden">
                                <button @click="activeAccordion = activeAccordion === 2 ? null : 2"
                                    class="flex items-center justify-between w-full px-4 py-3 text-left bg-white dark:bg-gray-900 hover:bg-gray-50 dark:hover:bg-gray-800">
                                    <span class="font-medium text-gray-900 dark:text-white">What is the cancellation
                                        policy?</span>
                                    <i data-lucide="chevron-down"
                                        class="w-5 h-5 text-gray-500 dark:text-gray-400 transition-transform"
                                        :class="{ 'transform rotate-180': activeAccordion === 2 }"></i>
                                </button>
                                <div x-show="activeAccordion === 2" x-collapse>
                                    <div
                                        class="px-4 py-3 bg-gray-50 dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
                                        <p class="text-gray-600 dark:text-gray-400">
                                            Cancellations made 30+ days before the event will receive a full refund minus a
                                            10% processing fee. Cancellations 15-29 days prior will receive a 50% refund. No
                                            refunds for cancellations made 14 days or less before the event.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- FAQ Item 3 -->
                            <div class="border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden">
                                <button @click="activeAccordion = activeAccordion === 3 ? null : 3"
                                    class="flex items-center justify-between w-full px-4 py-3 text-left bg-white dark:bg-gray-900 hover:bg-gray-50 dark:hover:bg-gray-800">
                                    <span class="font-medium text-gray-900 dark:text-white">Can I change my booking details
                                        after submitting?</span>
                                    <i data-lucide="chevron-down"
                                        class="w-5 h-5 text-gray-500 dark:text-gray-400 transition-transform"
                                        :class="{ 'transform rotate-180': activeAccordion === 3 }"></i>
                                </button>
                                <div x-show="activeAccordion === 3" x-collapse>
                                    <div
                                        class="px-4 py-3 bg-gray-50 dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
                                        <p class="text-gray-600 dark:text-gray-400">
                                            Yes, you can request changes to your booking up to 14 days before your event.
                                            Please contact our customer support team with your booking reference to request
                                            any changes. Note that changes are subject to availability and may incur
                                            additional fees.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Support Contact -->
                    <div
                        class="bg-primary-50 dark:bg-primary-900/20 rounded-xl p-6 border border-primary-100 dark:border-primary-800/30">
                        <div class="flex flex-col md:flex-row md:items-center gap-6">
                            <div
                                class="w-16 h-16 rounded-full bg-primary-100 dark:bg-primary-800/30 flex items-center justify-center flex-shrink-0 mx-auto md:mx-0">
                                <i data-lucide="headphones" class="w-8 h-8 text-primary-600 dark:text-primary-400"></i>
                            </div>
                            <div class="flex-1 text-center md:text-left">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Need Help with Your
                                    Booking?</h3>
                                <p class="text-gray-600 dark:text-gray-400 mb-4">Our booking specialists are available 24/7
                                    to assist with any questions</p>
                                <div class="flex flex-wrap gap-3 justify-center md:justify-start">
                                    <a href="#"
                                        class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg transition-colors">
                                        <i data-lucide="message-circle" class="w-4 h-4 mr-2"></i>
                                        Chat with Support
                                    </a>
                                    <a href="#"
                                        class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg transition-colors">
                                        <i data-lucide="phone" class="w-4 h-4 mr-2"></i>
                                        Call Us
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Lucide icons
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }

            // Ensure form tabs are visible even if Alpine.js fails
            const tabContent = document.querySelectorAll('[x-show]');
            tabContent.forEach(element => {
                if (element.getAttribute('x-show').includes("tab === 'details'")) {
                    element.style.display = 'block';
                }
            });

            // Initialize dynamic pricing based on booking type
            const bookingType = '<?php echo e($bookingType); ?>';

            if (bookingType === 'donation') {
                updateDonationSummary();
            } else if (bookingType === 'fan_card') {
                updateFanCardSummary();
            }

            // Ensure form submission works properly
            const form = document.querySelector('form[action="<?php echo e(route('processBooking')); ?>"]');
            const completeBookingBtn = document.getElementById('complete-booking-btn');

            if (form && completeBookingBtn) {
                completeBookingBtn.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Validate required fields
                    const requiredFields = form.querySelectorAll('[required]');
                    let isValid = true;

                    requiredFields.forEach(field => {
                        if (!field.value.trim()) {
                            isValid = false;
                            field.classList.add('border-red-500');

                            // Switch to the tab containing this field
                            if (field.closest('[x-show]')) {
                                const tabId = field.closest('[x-show]').getAttribute('x-show')
                                    .replace("tab === '", "").replace("'", "");
                                if (window.Alpine) {
                                    const alpineComponent = Alpine.closestRoot(form);
                                    if (alpineComponent) {
                                        alpineComponent.$data.tab = tabId;
                                    }
                                }
                            }
                        } else {
                            field.classList.remove('border-red-500');
                        }
                    });

                    if (isValid) {
                        form.submit();
                    } else {
                        // Show error message
                        alert('Please fill in all required fields');
                    }
                });
            }
        });

        // Function to set donation amount
        function setDonationAmount(amount) {
            const donationInput = document.getElementById('donation_amount');
            if (donationInput) {
                donationInput.value = amount;
                updateDonationSummary();
            }
        }

        // Function to update donation summary
        function updateDonationSummary() {
            const donationInput = document.getElementById('donation_amount');
            const donationDisplay = document.getElementById('donation-display');
            const feeDisplay = document.getElementById('donation-fee-display');
            const totalDisplay = document.getElementById('donation-total-display');

            if (donationInput && donationDisplay && feeDisplay && totalDisplay) {
                const amount = parseFloat(donationInput.value) || 50;
                const fee = amount * 0.03; // 3% processing fee
                const total = amount + fee;

                donationDisplay.textContent = '$' + amount.toFixed(2);
                feeDisplay.textContent = '$' + fee.toFixed(2);
                totalDisplay.textContent = '$' + total.toFixed(2);
            }
        }

        // Function to update fan card summary
        function updateFanCardSummary() {
            const tierInputs = document.querySelectorAll('input[name="membership_tier"]');
            const tierDisplay = document.getElementById('tier-display');
            const priceDisplay = document.getElementById('tier-price-display');
            const totalDisplay = document.getElementById('fancard-total-display');

            tierInputs.forEach(input => {
                input.addEventListener('change', function() {
                    const tier = this.value;
                    let price = 199; // Default gold price

                    switch (tier) {
                        case 'silver':
                            price = 99;
                            break;
                        case 'gold':
                            price = 199;
                            break;
                        case 'platinum':
                            price = 399;
                            break;
                    }

                    const processingFee = 9.95;
                    const total = price + processingFee;

                    if (tierDisplay) tierDisplay.textContent = tier.charAt(0).toUpperCase() + tier.slice(1);
                    if (priceDisplay) priceDisplay.textContent = '$' + price.toFixed(2);
                    if (totalDisplay) totalDisplay.textContent = '$' + total.toFixed(2);
                });
            });
        }

        // Add event listener for donation amount input
        document.addEventListener('DOMContentLoaded', function() {
            const donationInput = document.getElementById('donation_amount');
            if (donationInput) {
                donationInput.addEventListener('input', updateDonationSummary);
            }
        });

        // Alpine.js booking form component
        function bookingForm() {
            return {
                tab: 'details',
                errors: {},
                // Payment related properties
                selectedPaymentMethod: '',
                selectedPaymentData: null,
                paymentWalletAddress: '',
                fileName: '',
                fileSize: '',
                isDragOver: false,
                copied: false,

                init() {
                    this.$nextTick(() => {
                        if (typeof lucide !== 'undefined') {
                            lucide.createIcons();
                        }
                    });
                },

                submitForm() {
                    document.getElementById('booking-form').submit();
                },

                // Payment method update handler
                updatePaymentDetails() {
                    // Get payment methods from backend data
                    <?php if(isset($paymentMethods) && $paymentMethods->count() > 0): ?>
                        const paymentMethods = {
                            <?php $__currentLoopData = $paymentMethods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                '<?php echo e($method->id); ?>': {
                                    name: '<?php echo e($method->name); ?>',
                                    type: '<?php echo e(strtolower($method->name)); ?>',
                                    wallet_address: '<?php echo e($method->wallet_address ?? ''); ?>',
                                    bank_name: '<?php echo e($method->bankname ?? ''); ?>',
                                    account_name: '<?php echo e($method->account_name ?? ''); ?>',
                                    account_number: '<?php echo e($method->account_number ?? ''); ?>',
                                    swift_code: '<?php echo e($method->swift_code ?? ''); ?>',
                                    routing_number: '<?php echo e($method->routing_number ?? ''); ?>',
                                    bank_address: '<?php echo e($method->bank_address ?? ''); ?>',
                                    details: '<?php echo e($method->details ?? ''); ?>'
                                },
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        };
                    <?php else: ?>
                        // Fallback payment addresses for demo
                        const paymentMethods = {
                            'bitcoin': {
                                name: 'Bitcoin',
                                type: 'bitcoin',
                                wallet_address: 'bc1qxy2kgdygjrsqtzq2n0yrf2493p83kkfjhx0wlh'
                            },
                            'ethereum': {
                                name: 'Ethereum',
                                type: 'ethereum',
                                wallet_address: '0x742D35CC6634C0532925a3b8d404fAdCe2F38Dd9'
                            },
                            'usdt': {
                                name: 'Tether',
                                type: 'usdt',
                                wallet_address: 'THPVDdJJ5L85yNLp4F5RtNUBjSjm4FhP8v'
                            }
                        };
                    <?php endif; ?>

                    if (this.selectedPaymentMethod && paymentMethods[this.selectedPaymentMethod]) {
                        this.selectedPaymentData = paymentMethods[this.selectedPaymentMethod];

                        // For backward compatibility
                        this.paymentWalletAddress = this.selectedPaymentData.wallet_address || '';
                    } else {
                        this.selectedPaymentData = null;
                        this.paymentWalletAddress = '';
                    }
                },

                // Copy to clipboard functionality
                copyToClipboard(text) {
                    navigator.clipboard.writeText(text).then(() => {
                        this.copied = true;
                        setTimeout(() => {
                            this.copied = false;
                        }, 2000);
                    }).catch(err => {
                        console.error('Failed to copy: ', err);
                    });
                },

                // File upload handlers
                handleFileUpload(event) {
                    const file = event.target.files[0];
                    if (file) {
                        this.processFile(file);

                        // Sync both file inputs for bank transfer and crypto
                        const cryptoInput = document.getElementById('payment_proof');
                        const bankInput = document.getElementById('payment_proof_bank');

                        if (event.target.id === 'payment_proof' && bankInput) {
                            bankInput.files = event.target.files;
                        } else if (event.target.id === 'payment_proof_bank' && cryptoInput) {
                            cryptoInput.files = event.target.files;
                        }
                    }
                },

                handleFileDrop(event) {
                    this.isDragOver = false;
                    const file = event.dataTransfer.files[0];
                    if (file && (file.type.startsWith('image/') || file.type === 'application/pdf')) {
                        this.processFile(file);

                        // Update both file inputs
                        const dt = new DataTransfer();
                        dt.items.add(file);

                        const cryptoInput = document.getElementById('payment_proof');
                        const bankInput = document.getElementById('payment_proof_bank');

                        if (cryptoInput) cryptoInput.files = dt.files;
                        if (bankInput) bankInput.files = dt.files;
                    }
                },

                processFile(file) {
                    if (file.size > 10 * 1024 * 1024) { // 10MB limit
                        alert('File size must be less than 10MB');
                        return;
                    }

                    this.fileName = file.name;
                    this.fileSize = this.formatFileSize(file.size);
                },

                removeFile() {
                    const cryptoInput = document.getElementById('payment_proof');
                    const bankInput = document.getElementById('payment_proof_bank');

                    if (cryptoInput) cryptoInput.value = '';
                    if (bankInput) bankInput.value = '';

                    this.fileName = '';
                    this.fileSize = '';
                },

                formatFileSize(bytes) {
                    if (bytes === 0) return '0 Bytes';
                    const k = 1024;
                    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                    const i = Math.floor(Math.log(bytes) / Math.log(k));
                    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
                },

                validateCurrentTab() {
                    this.errors = {};
                    let isValid = true;

                    // Get current tab required fields
                    const currentTabElement = document.querySelector(`[x-show="tab === '${this.tab}'"]`);
                    if (currentTabElement) {
                        const requiredFields = currentTabElement.querySelectorAll('[required]');

                        requiredFields.forEach(field => {
                            if (field.type === 'radio') {
                                // Check if any radio button with the same name is selected
                                const radioGroup = currentTabElement.querySelectorAll(`[name="${field.name}"]`);
                                const isChecked = Array.from(radioGroup).some(radio => radio.checked);
                                if (!isChecked) {
                                    this.errors[field.name] =
                                        `${field.getAttribute('data-label') || field.name} is required`;
                                    isValid = false;
                                }
                            } else if (field.type === 'file') {
                                // File field validation
                                if (!field.files || field.files.length === 0) {
                                    this.errors[field.name] = 'Payment proof is required';
                                    isValid = false;
                                }
                            } else if (!field.value.trim()) {
                                this.errors[field.name] =
                                    `${field.getAttribute('data-label') || field.name} is required`;
                                isValid = false;
                            }

                            // Email validation
                            if (field.type === 'email' && field.value && !this.isValidEmail(field.value)) {
                                this.errors[field.name] = 'Please enter a valid email address';
                                isValid = false;
                            }

                            // Date validation (must be future date)
                            if (field.type === 'date' && field.value) {
                                const selectedDate = new Date(field.value);
                                const today = new Date();
                                today.setHours(0, 0, 0, 0);

                                if (selectedDate <= today) {
                                    this.errors[field.name] = 'Please select a future date';
                                    isValid = false;
                                }
                            }
                        });
                    }

                    // Additional payment tab validation
                    if (this.tab === 'payment') {
                        if (!this.selectedPaymentMethod) {
                            this.errors['payment_method'] = 'Please select a payment method';
                            isValid = false;
                        }
                        if (!this.fileName) {
                            this.errors['payment_proof'] = 'Please upload payment proof';
                            isValid = false;
                        }
                    }

                    return isValid;
                },

                canProceedToTab(targetTab) {
                    // Define tab order for different booking types
                    const tabOrder = {
                        'details': 0,
                        'charity': 1,
                        'benefits': 1,
                        'requirements': 1,
                        'payment': 2
                    };

                    const currentOrder = tabOrder[this.tab] || 0;
                    const targetOrder = tabOrder[targetTab] || 0;

                    // Can always go back
                    if (targetOrder <= currentOrder) return true;

                    // Must validate current tab before proceeding
                    return this.validateCurrentTab();
                },

                switchTab(targetTab) {
                    if (this.canProceedToTab(targetTab)) {
                        this.tab = targetTab;
                        // Clear errors when successfully moving to next tab
                        this.errors = {};
                    } else {
                        // Show validation errors and prevent tab change
                        this.$nextTick(() => {
                            // Scroll to first error
                            const firstError = document.querySelector('.error-field');
                            if (firstError) {
                                firstError.scrollIntoView({
                                    behavior: 'smooth',
                                    block: 'center'
                                });
                                firstError.focus();
                            }
                        });
                    }
                },

                isValidEmail(email) {
                    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
                },

                getFieldError(fieldName) {
                    return this.errors[fieldName] || '';
                },

                hasFieldError(fieldName) {
                    return !!this.errors[fieldName];
                }
            }
        }
    </script>

    <style>
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.base1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/user/Desktop/Websites/Broker/Celebrity/Celebrity/resources/views/home/booking.blade.php ENDPATH**/ ?>