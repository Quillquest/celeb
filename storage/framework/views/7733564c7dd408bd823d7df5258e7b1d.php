<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>

    <!-- Hero Section -->
    <section
        class="relative min-h-screen flex items-center justify-center overflow-hidden bg-gradient-to-br from-primary-900 via-primary-700 to-primary-500">

        <!-- Animated Background Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <!-- Animated gradient circles -->
            <div
                class="absolute top-1/4 -left-20 w-96 h-96 bg-primary-400 rounded-full mix-blend-overlay filter blur-3xl opacity-20 animate-float">
            </div>
            <div
                class="absolute top-1/3 -right-20 w-96 h-96 bg-accent-500 rounded-full mix-blend-overlay filter blur-3xl opacity-20 animate-float animation-delay-2000">
            </div>
            <div
                class="absolute -bottom-40 left-1/2 w-96 h-96 bg-primary-300 rounded-full mix-blend-overlay filter blur-3xl opacity-20 animate-float animation-delay-4000">
            </div>

            <!-- Subtle grid pattern -->
            <div class="absolute inset-0 bg-grid-white/[0.03] bg-[length:30px_30px]" aria-hidden="true"></div>

            <!-- Light streaks -->
            <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-white/20 to-transparent">
            </div>
            <div class="absolute bottom-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-white/20 to-transparent">
            </div>
        </div>

        <!-- Hero Content -->
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10 pt-20">
            <div class="text-center max-w-5xl mx-auto">
                <!-- Hero Badge -->
                <div class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-md border border-white/20 rounded-full text-white text-sm font-medium mb-8 animate-slide-up shadow-lg"
                    role="status">
                    <i data-lucide="sparkles" class="w-4 h-4 mr-2"></i>
                    <span>Welcome to <?php echo e($settings->site_name); ?></span>
                </div>

                <!-- Main Heading -->
                <h1 class="text-4xl sm:text-5xl lg:text-7xl font-display font-bold text-white mb-6 leading-tight animate-slide-up"
                    style="animation-delay: 0.2s;" aria-label="Book Your Favorite Celebrity">
                    Book Your
                    <span class="inline-block relative">
                        <span class="gradient-text">Favorite</span>
                        <svg aria-hidden="true" class="absolute -bottom-2 left-0 w-full" viewBox="0 0 300 12"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 5.5C32 0.5 96 0.5 150 5.5C204 10.5 268 10.5 299 5.5" stroke="url(#paint0_linear)"
                                stroke-width="8" stroke-linecap="round" />
                            <defs>
                                <linearGradient id="paint0_linear" x1="1" y1="6" x2="299"
                                    y2="6" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#0ea5e9" />
                                    <stop offset="1" stop-color="#f59e0b" />
                                </linearGradient>
                            </defs>
                        </svg>
                    </span>
                    Celebrity
                </h1>

                <!-- Subtitle -->
                <p class="text-xl sm:text-2xl text-white/90 mb-8 max-w-3xl mx-auto leading-relaxed animate-slide-up"
                    style="animation-delay: 0.4s;">
                    Connect with the stars you love. Get exclusive access to meet & greets, VIP experiences, and
                    unforgettable moments with your favorite celebrities.
                </p>

                <!-- Celebrity Search Bar -->
                <div class="max-w-2xl mx-auto mb-8 animate-slide-up" style="animation-delay: 0.5s;" x-data="{ searchFocus: false }">
                    <div class="relative"
                        :class="{ 'ring-2 ring-primary-400 ring-offset-2 ring-offset-primary-900': searchFocus }">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                            <i data-lucide="search" class="w-5 h-5 text-gray-400"></i>
                        </div>
                        <input type="text"
                            class="block w-full p-4 pl-12 bg-white/10 backdrop-blur-md border border-white/20 rounded-full text-white placeholder-white/60 focus:outline-none transition duration-300"
                            placeholder="Search for your favorite celebrity..." aria-label="Search for celebrity"
                            @focus="searchFocus = true" @blur="searchFocus = false">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                            <button type="button"
                                class="p-2 bg-white/10 rounded-full hover:bg-white/20 transition-colors duration-300">
                                <i data-lucide="mic" class="w-4 h-4 text-white/80"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center animate-slide-up"
                    style="animation-delay: 0.6s;">
                    <a href="book_celebrity"
                        class="group inline-flex items-center px-8 py-4 bg-gradient-to-r from-accent-500 to-accent-600 text-white rounded-full font-semibold text-lg hover:from-accent-600 hover:to-accent-700 transition-all duration-300 hover:scale-105 shadow-xl hover:shadow-2xl hover:shadow-accent-500/20"
                        aria-label="Book Celebrity Now">
                        <i data-lucide="star"
                            class="w-5 h-5 mr-3 group-hover:rotate-12 transition-transform duration-300"></i>
                        <span>Book Celebrity Now</span>
                        <i data-lucide="arrow-right"
                            class="w-5 h-5 ml-3 group-hover:translate-x-1 transition-transform duration-300"></i>
                    </a>
                    <a href="#categories"
                        class="group inline-flex items-center px-8 py-4 bg-white/10 backdrop-blur-md border border-white/20 text-white rounded-full font-semibold text-lg hover:bg-white/20 transition-all duration-300"
                        aria-label="Browse Categories">
                        <i data-lucide="grid"
                            class="w-5 h-5 mr-3 group-hover:scale-110 transition-transform duration-300"></i>
                        <span>Browse Categories</span>
                    </a>
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 mt-16 animate-slide-up" style="animation-delay: 0.8s;">
                    <div class="relative group">
                        <div
                            class="absolute -inset-0.5 bg-gradient-to-r from-primary-400 to-accent-400 rounded-xl blur opacity-30 group-hover:opacity-70 transition duration-300">
                        </div>
                        <div class="relative px-4 py-5 bg-white/10 backdrop-blur-md border border-white/20 rounded-xl">
                            <div class="text-3xl lg:text-4xl font-bold text-white mb-1">50+</div>
                            <div class="text-white/80 font-medium">Celebrity Events</div>
                        </div>
                    </div>
                    <div class="relative group">
                        <div
                            class="absolute -inset-0.5 bg-gradient-to-r from-primary-400 to-accent-400 rounded-xl blur opacity-30 group-hover:opacity-70 transition duration-300">
                        </div>
                        <div class="relative px-4 py-5 bg-white/10 backdrop-blur-md border border-white/20 rounded-xl">
                            <div class="text-3xl lg:text-4xl font-bold text-white mb-1">100K+</div>
                            <div class="text-white/80 font-medium">Happy Clients</div>
                        </div>
                    </div>
                    <div class="relative group">
                        <div
                            class="absolute -inset-0.5 bg-gradient-to-r from-primary-400 to-accent-400 rounded-xl blur opacity-30 group-hover:opacity-70 transition duration-300">
                        </div>
                        <div class="relative px-4 py-5 bg-white/10 backdrop-blur-md border border-white/20 rounded-xl">
                            <div class="text-3xl lg:text-4xl font-bold text-white mb-1">10+</div>
                            <div class="text-white/80 font-medium">Years Experience</div>
                        </div>
                    </div>
                    <div class="relative group">
                        <div
                            class="absolute -inset-0.5 bg-gradient-to-r from-primary-400 to-accent-400 rounded-xl blur opacity-30 group-hover:opacity-70 transition duration-300">
                        </div>
                        <div class="relative px-4 py-5 bg-white/10 backdrop-blur-md border border-white/20 rounded-xl">
                            <div class="text-3xl lg:text-4xl font-bold text-white mb-1">24/7</div>
                            <div class="text-white/80 font-medium">Support</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <a href="#categories"
                class="flex flex-col items-center text-white/80 hover:text-white transition-colors duration-300"
                aria-label="Scroll down">
                <span class="text-sm font-medium mb-2">Scroll Down</span>
                <i data-lucide="chevron-down" class="w-6 h-6"></i>
            </a>
        </div>
    </section>


    <!-- Featured Celebrities Section -->
    <?php if(isset($featuredCelebrities) && $featuredCelebrities->count() > 0): ?>
        <section class="py-12 lg:py-20 bg-white relative overflow-hidden">
            <!-- Background Elements -->
            <div class="absolute inset-0 pointer-events-none">
                <div class="absolute top-0 left-0 w-1/3 h-1/3 bg-gradient-to-br from-primary-50 to-transparent opacity-70">
                </div>
                <div
                    class="absolute bottom-0 right-0 w-1/3 h-1/3 bg-gradient-to-tl from-accent-50 to-transparent opacity-70">
                </div>
            </div>

            <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <!-- Section Header -->
                <div class="max-w-3xl mx-auto text-center mb-12">
                    <span
                        class="inline-block px-4 py-2 bg-primary-100 text-primary-700 rounded-full text-sm font-semibold mb-4">
                        <i data-lucide="star" class="w-4 h-4 inline mr-1"></i>
                        Featured Celebrities
                    </span>
                    <h2 class="text-3xl lg:text-5xl font-display font-bold text-gray-900 mb-6 leading-tight">
                        Meet Our <span class="gradient-text">Top Stars</span>
                    </h2>
                    <p class="text-lg text-gray-600 leading-relaxed">
                        Discover our most popular and highly requested celebrities. Book directly from here or explore more
                        options in our full catalog.
                    </p>
                </div>

                <!-- Featured Celebrities Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                    <?php $__currentLoopData = $featuredCelebrities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $celebrity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="group bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-1"
                            x-data="{ showModal: false }">
                            <!-- Card Image Container -->
                            <div class="relative h-80 overflow-hidden">
                                <!-- Celebrity Image -->
                                <img src="<?php echo e(asset('storage/' . $celebrity->photo)); ?>" alt="<?php echo e($celebrity->name); ?>"
                                    class="w-full h-full object-cover object-center transition-transform duration-700 group-hover:scale-110">
                                <!-- Gradient Overlay -->
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent opacity-60 group-hover:opacity-80 transition-opacity duration-300">
                                </div>

                                <!-- Quick Actions Overlay (appears on hover) -->
                                <div
                                    class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <div class="flex space-x-3">
                                        <button @click="showModal = true"
                                            class="w-12 h-12 flex items-center justify-center rounded-full bg-white/20 backdrop-blur-sm text-white hover:bg-white/40 transition-colors duration-300">
                                            <i data-lucide="info" class="w-6 h-6"></i>
                                        </button>
                                        <a href="<?php echo e(route('book_celebrity_now', ['id' => $celebrity->id, 'type' => 'booking'])); ?>"
                                            class="w-12 h-12 flex items-center justify-center rounded-full bg-primary-600/90 backdrop-blur-sm text-white hover:bg-primary-700 transition-colors duration-300">
                                            <i data-lucide="calendar" class="w-6 h-6"></i>
                                        </a>
                                    </div>
                                </div>

                                <!-- Featured Badge -->
                                <div class="absolute top-4 left-4">
                                    <span
                                        class="px-3 py-1 bg-accent-500 text-white text-xs font-bold rounded-full uppercase tracking-wider">
                                        Featured
                                    </span>
                                </div>
                            </div>

                            <!-- Card Content -->
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <h3
                                        class="text-xl font-bold text-gray-900 group-hover:text-primary-600 transition-colors duration-300">
                                        <?php echo e($celebrity->name); ?></h3>

                                    <!-- Rating -->
                                    <div class="flex items-center">
                                        <i data-lucide="star" class="w-4 h-4 text-accent-500 fill-accent-500"></i>
                                        <span class="ml-1 text-sm text-gray-600">4.9</span>
                                    </div>
                                </div>

                                <!-- Celebrity Details -->
                                <div class="space-y-2 mb-6">
                                    <div class="flex items-center text-gray-600">
                                        <i data-lucide="map-pin" class="w-4 h-4 mr-2 flex-shrink-0"></i>
                                        <span class="text-sm"><?php echo e(ucfirst($celebrity->country ?? 'International')); ?></span>
                                    </div>
                                    <?php if(isset($celebrity->profession)): ?>
                                        <div class="flex items-center text-gray-600">
                                            <i data-lucide="briefcase" class="w-4 h-4 mr-2 flex-shrink-0"></i>
                                            <span class="text-sm"><?php echo e($celebrity->profession); ?></span>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(isset($celebrity->booking_fee)): ?>
                                        <div class="flex items-center text-primary-600 font-medium">
                                            <i data-lucide="tag" class="w-4 h-4 mr-2 flex-shrink-0"></i>
                                            <span
                                                class="text-sm">$<?php echo e(is_numeric($celebrity->booking_fee) ? number_format((float) $celebrity->booking_fee, 0) : $celebrity->booking_fee); ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- Action Buttons -->
                                <div class="grid grid-cols-2 gap-2 mb-2">
                                    <a href="<?php echo e(route('book_celebrity_now', ['id' => $celebrity->id, 'type' => 'booking'])); ?>"
                                        class="inline-flex items-center justify-center px-4 py-2 bg-primary-600 text-white rounded-lg font-medium hover:bg-primary-700 transition-all duration-300 text-sm">
                                        <i data-lucide="calendar" class="w-4 h-4 mr-2"></i>
                                        Book Now
                                    </a>
                                    <a href="<?php echo e(route('book_celebrity_now', ['id' => $celebrity->id, 'type' => 'donation'])); ?>"
                                        class="inline-flex items-center justify-center px-4 py-2 bg-accent-500 text-white rounded-lg font-medium hover:bg-accent-600 transition-all duration-300 text-sm">
                                        <i data-lucide="heart" class="w-4 h-4 mr-2"></i>
                                        Donate
                                    </a>
                                </div>
                                <div>
                                    <a href="<?php echo e(route('book_celebrity_now', ['id' => $celebrity->id, 'type' => 'fan_card'])); ?>"
                                        class="w-full inline-flex items-center justify-center px-4 py-2 border border-primary-600 text-primary-600 rounded-lg font-medium hover:bg-primary-50 transition-all duration-300 text-sm">
                                        <i data-lucide="credit-card" class="w-4 h-4 mr-2"></i>
                                        Fan Card
                                    </a>
                                </div>
                            </div>

                            <!-- Modal for Celebrity Details -->
                            <div x-show="showModal" x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                @keydown.escape.window="showModal = false"
                                class="fixed inset-0 z-50 flex items-center justify-center bg-black/80" x-cloak>
                                <div @click.away="showModal = false" x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="opacity-0 scale-95"
                                    x-transition:enter-end="opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-200"
                                    x-transition:leave-start="opacity-100 scale-100"
                                    x-transition:leave-end="opacity-0 scale-95"
                                    class="relative bg-white rounded-xl overflow-hidden shadow-2xl max-w-2xl w-full mx-4">
                                    <!-- Modal Header -->
                                    <div class="relative h-80 overflow-hidden">
                                        <img src="<?php echo e(asset('storage/' . $celebrity->photo)); ?>"
                                            alt="<?php echo e($celebrity->name); ?>"
                                            class="w-full h-full object-cover object-center">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                                        <div class="absolute bottom-6 left-6 right-6">
                                            <h3 class="text-2xl font-bold text-white mb-2"><?php echo e($celebrity->name); ?></h3>
                                            <p class="text-white/80"><?php echo e($celebrity->profession ?? 'Celebrity'); ?></p>
                                        </div>
                                        <button @click="showModal = false"
                                            class="absolute top-4 right-4 w-10 h-10 flex items-center justify-center rounded-full bg-black/50 text-white hover:bg-black/70 transition-colors duration-300">
                                            <i data-lucide="x" class="w-5 h-5"></i>
                                        </button>
                                    </div>

                                    <!-- Modal Content -->
                                    <div class="p-6">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                            <div class="flex items-center text-gray-600">
                                                <i data-lucide="map-pin" class="w-5 h-5 mr-3 text-primary-600"></i>
                                                <span><?php echo e($celebrity->country ?? 'International'); ?></span>
                                            </div>
                                            <?php if($celebrity->booking_fee): ?>
                                                <div class="flex items-center text-gray-600">
                                                    <i data-lucide="tag" class="w-5 h-5 mr-3 text-primary-600"></i>
                                                    <span>$<?php echo e(is_numeric($celebrity->booking_fee) ? number_format((float) $celebrity->booking_fee, 0) : $celebrity->booking_fee); ?>

                                                        booking fee</span>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <?php if($celebrity->bio): ?>
                                            <div class="mb-6">
                                                <h4 class="text-lg font-semibold text-gray-900 mb-2">About</h4>
                                                <p class="text-gray-600 leading-relaxed"><?php echo e($celebrity->bio); ?></p>
                                            </div>
                                        <?php endif; ?>

                                        <!-- Modal Action Buttons -->
                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                            <a href="<?php echo e(route('book_celebrity_now', ['id' => $celebrity->id, 'type' => 'booking'])); ?>"
                                                class="inline-flex items-center justify-center px-4 py-3 bg-primary-600 text-white rounded-lg font-medium hover:bg-primary-700 transition-all duration-300">
                                                <i data-lucide="calendar" class="w-5 h-5 mr-2"></i>
                                                Book Now
                                            </a>
                                            <a href="<?php echo e(route('book_celebrity_now', ['id' => $celebrity->id, 'type' => 'donation'])); ?>"
                                                class="inline-flex items-center justify-center px-4 py-3 bg-accent-500 text-white rounded-lg font-medium hover:bg-accent-600 transition-all duration-300">
                                                <i data-lucide="heart" class="w-5 h-5 mr-2"></i>
                                                Donate
                                            </a>
                                            <a href="<?php echo e(route('membership_card', ['id' => $celebrity->id])); ?>"
                                                class="inline-flex items-center justify-center px-4 py-3 border border-primary-600 text-primary-600 rounded-lg font-medium hover:bg-primary-50 transition-all duration-300">
                                                <i data-lucide="credit-card" class="w-5 h-5 mr-2"></i>
                                                Fan Card
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <!-- View All Celebrities Button -->
                <div class="mt-12 text-center">
                    <a href="book_celebrity"
                        class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-lg font-medium hover:from-primary-700 hover:to-primary-800 transition-all duration-300 hover:scale-105 shadow-lg">
                        <i data-lucide="users" class="w-5 h-5 mr-2"></i>
                        View All Celebrities
                        <i data-lucide="arrow-right" class="w-5 h-5 ml-2"></i>
                    </a>
                </div>
            </div>
        </section>
    <?php endif; ?>


    <!-- Categories Section -->
    <section id="categories" class="py-12 bg-gray-50 relative overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute inset-0">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-primary-100 rounded-full opacity-70 blur-3xl"></div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-accent-100 rounded-full opacity-70 blur-3xl"></div>
        </div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Section Header -->
            <div class="max-w-3xl mx-auto text-center mb-10">
                <span
                    class="inline-block px-4 py-2 bg-primary-100 text-primary-700 rounded-full text-sm font-semibold mb-4">
                    <i data-lucide="grid" class="w-4 h-4 inline mr-1"></i>
                    Categories
                </span>
                <h2 class="text-3xl lg:text-5xl font-display font-bold text-gray-900 mb-6 leading-tight">
                    Browse Celebrity <span class="gradient-text">Categories</span>
                </h2>
                <p class="text-lg text-gray-600 leading-relaxed">
                    Explore our diverse range of celebrities from different industries and backgrounds. Find the perfect
                    match for your event or experience.
                </p>
            </div>

            <!-- Categories Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6" x-data="{ activeCategory: null }">
                <!-- Category 1 - Actors -->
                <div class="group relative overflow-hidden rounded-2xl transition-all duration-500 hover:shadow-2xl cursor-pointer"
                    @mouseenter="activeCategory = 'actors'" @mouseleave="activeCategory = null" x-data="{ isHovered: false }"
                    @mouseenter="isHovered = true" @mouseleave="isHovered = false">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/80 to-black/10 opacity-60 group-hover:opacity-80 transition-opacity duration-300">
                    </div>
                    <img src="<?php echo e(asset('temp/assets/img/home-2/img/portfolio/1.jpg')); ?>" alt="Actors & Actresses"
                        class="w-full h-80 object-cover object-center transition-transform duration-700"
                        :class="isHovered ? 'scale-110' : ''">
                    <div class="absolute inset-0 flex flex-col justify-end p-6">
                        <div class="mb-2">
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full bg-primary-500 text-xs text-white font-medium">
                                <i data-lucide="video" class="w-3 h-3 mr-1"></i>
                                200+ Celebs
                            </span>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">Actors & Actresses</h3>
                        <p class="text-white/80 text-sm mb-4 max-w-xs" x-show="isHovered" x-transition>
                            Book Hollywood stars, TV personalities, and award-winning performers for your events.
                        </p>
                        <a href="book_celebrity?category=actors"
                            class="inline-flex items-center text-white font-medium group/link" x-show="isHovered"
                            x-transition>
                            <span>Explore Actors</span>
                            <i data-lucide="arrow-right"
                                class="w-4 h-4 ml-2 group-hover/link:translate-x-1 transition-transform duration-300"></i>
                        </a>
                    </div>
                </div>

                <!-- Category 2 - Musicians -->
                <div class="group relative overflow-hidden rounded-2xl transition-all duration-500 hover:shadow-2xl cursor-pointer"
                    @mouseenter="activeCategory = 'musicians'" @mouseleave="activeCategory = null"
                    x-data="{ isHovered: false }" @mouseenter="isHovered = true" @mouseleave="isHovered = false">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/80 to-black/10 opacity-60 group-hover:opacity-80 transition-opacity duration-300">
                    </div>
                    <img src="temp/assets/img/home-2/img/portfolio/2.jpg" alt="Musicians & Artists"
                        class="w-full h-80 object-cover object-center transition-transform duration-700"
                        :class="isHovered ? 'scale-110' : ''">
                    <div class="absolute inset-0 flex flex-col justify-end p-6">
                        <div class="mb-2">
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full bg-accent-500 text-xs text-white font-medium">
                                <i data-lucide="music" class="w-3 h-3 mr-1"></i>
                                180+ Celebs
                            </span>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">Musicians & Artists</h3>
                        <p class="text-white/80 text-sm mb-4 max-w-xs" x-show="isHovered" x-transition>
                            Book chart-topping singers, bands, and music artists for concerts and private performances.
                        </p>
                        <a href="book_celebrity?category=musicians"
                            class="inline-flex items-center text-white font-medium group/link" x-show="isHovered"
                            x-transition>
                            <span>Explore Musicians</span>
                            <i data-lucide="arrow-right"
                                class="w-4 h-4 ml-2 group-hover/link:translate-x-1 transition-transform duration-300"></i>
                        </a>
                    </div>
                </div>

                <!-- Category 3 - Athletes -->
                <div class="group relative overflow-hidden rounded-2xl transition-all duration-500 hover:shadow-2xl cursor-pointer"
                    @mouseenter="activeCategory = 'athletes'" @mouseleave="activeCategory = null" x-data="{ isHovered: false }"
                    @mouseenter="isHovered = true" @mouseleave="isHovered = false">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/80 to-black/10 opacity-60 group-hover:opacity-80 transition-opacity duration-300">
                    </div>
                    <img src="temp/assets/img/home-2/img/portfolio/3.jpg" alt="Sports Stars"
                        class="w-full h-80 object-cover object-center transition-transform duration-700"
                        :class="isHovered ? 'scale-110' : ''">
                    <div class="absolute inset-0 flex flex-col justify-end p-6">
                        <div class="mb-2">
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full bg-primary-500 text-xs text-white font-medium">
                                <i data-lucide="trophy" class="w-3 h-3 mr-1"></i>
                                150+ Celebs
                            </span>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">Sports Stars</h3>
                        <p class="text-white/80 text-sm mb-4 max-w-xs" x-show="isHovered" x-transition>
                            Book renowned athletes, Olympians, and sports legends for motivational talks and appearances.
                        </p>
                        <a href="book_celebrity?category=athletes"
                            class="inline-flex items-center text-white font-medium group/link" x-show="isHovered"
                            x-transition>
                            <span>Explore Athletes</span>
                            <i data-lucide="arrow-right"
                                class="w-4 h-4 ml-2 group-hover/link:translate-x-1 transition-transform duration-300"></i>
                        </a>
                    </div>
                </div>

                <!-- Category 4 - Influencers -->
                <div class="group relative overflow-hidden rounded-2xl transition-all duration-500 hover:shadow-2xl cursor-pointer"
                    @mouseenter="activeCategory = 'influencers'" @mouseleave="activeCategory = null"
                    x-data="{ isHovered: false }" @mouseenter="isHovered = true" @mouseleave="isHovered = false">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/80 to-black/10 opacity-60 group-hover:opacity-80 transition-opacity duration-300">
                    </div>
                    <img src="temp/assets/img/home-2/img/portfolio/4.jpg" alt="Digital Influencers"
                        class="w-full h-80 object-cover object-center transition-transform duration-700"
                        :class="isHovered ? 'scale-110' : ''">
                    <div class="absolute inset-0 flex flex-col justify-end p-6">
                        <div class="mb-2">
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full bg-accent-500 text-xs text-white font-medium">
                                <i data-lucide="trending-up" class="w-3 h-3 mr-1"></i>
                                250+ Celebs
                            </span>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-2">Digital Influencers</h3>
                        <p class="text-white/80 text-sm mb-4 max-w-xs" x-show="isHovered" x-transition>
                            Book social media stars, content creators, and digital personalities for promotions.
                        </p>
                        <a href="book_celebrity?category=influencers"
                            class="inline-flex items-center text-white font-medium group/link" x-show="isHovered"
                            x-transition>
                            <span>Explore Influencers</span>
                            <i data-lucide="arrow-right"
                                class="w-4 h-4 ml-2 group-hover/link:translate-x-1 transition-transform duration-300"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- View All Button -->
            <div class="mt-8 text-center">
                <a href="book_celebrity"
                    class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-lg font-medium hover:from-primary-700 hover:to-primary-800 transition-all duration-300 hover:scale-105 shadow-lg">
                    <i data-lucide="list" class="w-5 h-5 mr-2"></i>
                    View All Categories
                </a>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-12 lg:py-20 bg-white relative overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-0 right-0 w-1/2 h-1/2 bg-gradient-to-bl from-primary-50 to-transparent opacity-70">
            </div>
            <div class="absolute bottom-0 left-0 w-1/2 h-1/2 bg-gradient-to-tr from-accent-50 to-transparent opacity-70">
            </div>
            <div class="absolute top-1/4 left-0 w-24 h-24 border-2 border-primary-200 rounded-full opacity-30"></div>
            <div class="absolute bottom-1/4 right-10 w-40 h-40 border-2 border-accent-200 rounded-full opacity-30"></div>
        </div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <!-- Image Side with Split Images -->
                <div class="relative" x-data="{ inView: false }" x-intersect="inView = true">
                    <div class="grid grid-cols-2 gap-4 relative">
                        <!-- Main Image -->
                        <div class="col-span-2" x-show="inView" x-transition:enter="transition ease-out duration-1000"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
                            <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                                <img src="temp/assets/img/home-2/img/about/ab1.jpg" alt="About Us - Celebrity Experience"
                                    class="w-full h-auto object-cover object-center">
                                <div class="absolute inset-0 bg-gradient-to-t from-primary-900/60 to-transparent"></div>

                                <!-- Play Button Overlay -->
                                <button class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 group"
                                    aria-label="Play video">
                                    <div class="relative">
                                        <div
                                            class="absolute inset-0 rounded-full bg-white/20 animate-ping opacity-75 group-hover:opacity-100">
                                        </div>
                                        <div
                                            class="relative flex items-center justify-center w-16 h-16 bg-white rounded-full shadow-lg group-hover:scale-110 transition-transform duration-300">
                                            <i data-lucide="play"
                                                class="w-6 h-6 text-primary-600 group-hover:text-accent-500 transition-colors duration-300"></i>
                                        </div>
                                    </div>
                                </button>
                            </div>
                        </div>

                        <!-- Smaller Image 1 -->
                        <div class="relative" x-show="inView"
                            x-transition:enter="transition ease-out duration-1000 delay-200"
                            x-transition:enter-start="opacity-0 scale-95 translate-y-8"
                            x-transition:enter-end="opacity-100 scale-100 translate-y-0">
                            <div class="rounded-2xl overflow-hidden shadow-lg">
                                <img src="temp/assets/img/home-2/img/portfolio/2.jpg" alt="Celebrity Meet & Greet"
                                    class="w-full h-40 object-cover object-center">
                            </div>
                        </div>

                        <!-- Smaller Image 2 -->
                        <div class="relative" x-show="inView"
                            x-transition:enter="transition ease-out duration-1000 delay-400"
                            x-transition:enter-start="opacity-0 scale-95 translate-y-8"
                            x-transition:enter-end="opacity-100 scale-100 translate-y-0">
                            <div class="rounded-2xl overflow-hidden shadow-lg">
                                <img src="temp/assets/img/home-2/img/portfolio/3.jpg" alt="Celebrity Events"
                                    class="w-full h-40 object-cover object-center">
                            </div>
                        </div>

                        <!-- Experience Badge -->
                        <div class="absolute -bottom-6 left-1/2 transform -translate-x-1/2 bg-white rounded-xl p-5 shadow-2xl border border-gray-100"
                            x-show="inView" x-transition:enter="transition ease-out duration-1000 delay-600"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
                            <div class="text-center">
                                <div class="text-3xl font-bold text-primary-600 mb-1">10+</div>
                                <div class="text-sm text-gray-600 font-medium whitespace-nowrap">Years of Experience</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content Side -->
                <div x-data="{ inView: false, activeTab: 'overview' }" x-intersect="inView = true">
                    <div x-show="inView" x-transition:enter="transition ease-out duration-1000"
                        x-transition:enter-start="opacity-0 translate-x-8"
                        x-transition:enter-end="opacity-100 translate-x-0">
                        <!-- Section Header -->
                        <div class="mb-8">
                            <span
                                class="inline-flex items-center px-4 py-2 bg-primary-100 text-primary-700 rounded-full text-sm font-semibold mb-4">
                                <i data-lucide="info" class="w-4 h-4 mr-2"></i>
                                About Us
                            </span>
                            <h2 class="text-3xl lg:text-5xl font-display font-bold text-gray-900 mb-6 leading-tight">
                                Welcome to <span class="gradient-text"><?php echo e($settings->site_name); ?></span>
                            </h2>
                            <p class="text-lg text-gray-600 leading-relaxed">
                                Your ultimate destination for connecting with your favorite stars! We provide unparalleled
                                access to the glamorous world of celebrities through innovative technology and personalized
                                experiences.
                            </p>
                        </div>

                        <!-- Tabbed Content -->
                        <div class="mb-8">
                            <div class="flex border-b border-gray-200 mb-6">
                                <button @click="activeTab = 'overview'"
                                    class="px-6 py-3 font-medium text-sm transition-colors duration-300"
                                    :class="activeTab === 'overview' ? 'text-primary-600 border-b-2 border-primary-600' :
                                        'text-gray-500 hover:text-gray-800'">
                                    Overview
                                </button>
                                <button @click="activeTab = 'mission'"
                                    class="px-6 py-3 font-medium text-sm transition-colors duration-300"
                                    :class="activeTab === 'mission' ? 'text-primary-600 border-b-2 border-primary-600' :
                                        'text-gray-500 hover:text-gray-800'">
                                    Our Mission
                                </button>
                                <button @click="activeTab = 'benefits'"
                                    class="px-6 py-3 font-medium text-sm transition-colors duration-300"
                                    :class="activeTab === 'benefits' ? 'text-primary-600 border-b-2 border-primary-600' :
                                        'text-gray-500 hover:text-gray-800'">
                                    Benefits
                                </button>
                            </div>

                            <!-- Overview Tab -->
                            <div x-show="activeTab === 'overview'" x-transition>
                                <p class="text-gray-600 mb-6">
                                    Founded in 2014, <?php echo e($settings->site_name); ?> has become the premier platform for
                                    celebrity bookings and fan experiences. Our team of dedicated professionals works
                                    tirelessly to create unforgettable moments between celebrities and their fans.
                                </p>

                                <!-- Features List -->
                                <div class="space-y-4 mb-6">
                                    <div class="flex items-start">
                                        <div
                                            class="flex-shrink-0 w-10 h-10 bg-primary-100 rounded-full flex items-center justify-center mr-4 mt-1">
                                            <i data-lucide="users" class="w-5 h-5 text-primary-600"></i>
                                        </div>
                                        <div>
                                            <h4 class="text-lg font-semibold text-gray-900 mb-1">Global Network</h4>
                                            <p class="text-gray-600">Access to thousands of celebrities worldwide across
                                                various industries and fields.</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start">
                                        <div
                                            class="flex-shrink-0 w-10 h-10 bg-primary-100 rounded-full flex items-center justify-center mr-4 mt-1">
                                            <i data-lucide="shield" class="w-5 h-5 text-primary-600"></i>
                                        </div>
                                        <div>
                                            <h4 class="text-lg font-semibold text-gray-900 mb-1">Secure Bookings</h4>
                                            <p class="text-gray-600">Safe, transparent booking process with guaranteed
                                                authenticity and verification.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Mission Tab -->
                            <div x-show="activeTab === 'mission'" x-transition>
                                <p class="text-gray-600 mb-6">
                                    Our mission is to democratize access to celebrity experiences, making it possible for
                                    fans everywhere to connect meaningfully with the stars they admire while ensuring fair
                                    compensation and respect for celebrities' time.
                                </p>
                                <div class="bg-primary-50 p-6 rounded-xl mb-6">
                                    <h4 class="text-lg font-semibold text-primary-700 mb-3">Our Core Values</h4>
                                    <ul class="space-y-3">
                                        <li class="flex items-center">
                                            <i data-lucide="check-circle" class="w-5 h-5 text-primary-600 mr-3"></i>
                                            <span class="text-gray-700">Transparency in all our dealings</span>
                                        </li>
                                        <li class="flex items-center">
                                            <i data-lucide="check-circle" class="w-5 h-5 text-primary-600 mr-3"></i>
                                            <span class="text-gray-700">Respect for both fans and celebrities</span>
                                        </li>
                                        <li class="flex items-center">
                                            <i data-lucide="check-circle" class="w-5 h-5 text-primary-600 mr-3"></i>
                                            <span class="text-gray-700">Innovation in fan-celebrity connections</span>
                                        </li>
                                        <li class="flex items-center">
                                            <i data-lucide="check-circle" class="w-5 h-5 text-primary-600 mr-3"></i>
                                            <span class="text-gray-700">Support for charitable initiatives</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Benefits Tab -->
                            <div x-show="activeTab === 'benefits'" x-transition>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-6">
                                    <div
                                        class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                                        <i data-lucide="star" class="w-8 h-8 text-accent-500 mb-4"></i>
                                        <h4 class="text-lg font-semibold text-gray-900 mb-2">VIP Fan Membership</h4>
                                        <p class="text-gray-600">Exclusive benefits, early access to bookings, and special
                                            discounts.</p>
                                    </div>
                                    <div
                                        class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                                        <i data-lucide="video" class="w-8 h-8 text-accent-500 mb-4"></i>
                                        <h4 class="text-lg font-semibold text-gray-900 mb-2">Virtual Meet & Greets</h4>
                                        <p class="text-gray-600">Connect with celebrities from anywhere in the world.</p>
                                    </div>
                                    <div
                                        class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                                        <i data-lucide="gift" class="w-8 h-8 text-accent-500 mb-4"></i>
                                        <h4 class="text-lg font-semibold text-gray-900 mb-2">Personalized Experiences</h4>
                                        <p class="text-gray-600">Custom-tailored interactions based on your preferences.
                                        </p>
                                    </div>
                                    <div
                                        class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                                        <i data-lucide="heart" class="w-8 h-8 text-accent-500 mb-4"></i>
                                        <h4 class="text-lg font-semibold text-gray-900 mb-2">Charity Support</h4>
                                        <p class="text-gray-600">Portion of proceeds goes to causes supported by
                                            celebrities.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- CTA Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="#contact"
                                class="inline-flex items-center px-6 py-3 bg-primary-600 text-white rounded-lg font-medium hover:bg-primary-700 transition-all duration-300 hover:scale-105 shadow-lg">
                                <i data-lucide="mail" class="w-5 h-5 mr-2"></i>
                                Contact Our Team
                            </a>
                            <a href="book_celebrity"
                                class="inline-flex items-center px-6 py-3 bg-white border border-primary-600 text-primary-600 rounded-lg font-medium hover:bg-primary-50 transition-all duration-300">
                                <i data-lucide="calendar" class="w-5 h-5 mr-2"></i>
                                Book a Celebrity
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services"
        class="py-12 lg:py-20 relative overflow-hidden bg-gradient-to-br from-gray-50 via-white to-gray-50">
        <!-- Background Elements -->
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-20 right-10 w-64 h-64 bg-primary-50 rounded-full filter blur-3xl opacity-60"></div>
            <div class="absolute bottom-20 left-10 w-64 h-64 bg-accent-50 rounded-full filter blur-3xl opacity-60"></div>
            <div
                class="absolute top-1/3 left-1/3 transform -translate-x-1/2 w-32 h-32 border border-dashed border-primary-200 rounded-full opacity-60 animate-spin-slow">
            </div>
        </div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative">
            <!-- Section Header -->
            <div class="max-w-3xl mx-auto text-center mb-12">
                <span
                    class="inline-block px-4 py-2 bg-primary-100 text-primary-700 rounded-full text-sm font-semibold mb-4">
                    <i data-lucide="sparkles" class="w-4 h-4 inline mr-1"></i>
                    Our Services
                </span>
                <h2 class="text-3xl lg:text-5xl font-display font-bold text-gray-900 mb-6 leading-tight">
                    Special <span class="gradient-text">Features</span> For You
                </h2>
                <p class="text-lg text-gray-600 leading-relaxed">
                    Discover our unique range of services designed to create unforgettable experiences with your favorite
                    celebrities.
                </p>
            </div>

            <!-- Features Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8" x-data="{ activeFeature: null }">
                <!-- Feature 1 - Online Bookings -->
                <div class="bg-white rounded-2xl p-8 transition-all duration-500 hover:shadow-xl relative overflow-hidden group z-10"
                    x-data="{ isHovered: false }" @mouseenter="isHovered = true; activeFeature = 'bookings'"
                    @mouseleave="isHovered = false; activeFeature = null">
                    <!-- Background Pattern -->
                    <div class="absolute inset-0 bg-gradient-to-br from-primary-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"
                        :class="isHovered ? 'opacity-100' : 'opacity-0'"></div>

                    <!-- Decorative Circles -->
                    <div
                        class="absolute -right-5 -bottom-5 w-24 h-24 bg-primary-100 rounded-full opacity-0 group-hover:opacity-30 transition-all duration-500 transform group-hover:scale-125">
                    </div>

                    <!-- Icon with circular background -->
                    <div class="relative z-10 mb-6">
                        <div
                            class="w-16 h-16 flex items-center justify-center rounded-full bg-primary-100 text-primary-600 mb-6 transition-all duration-500 group-hover:bg-primary-600 group-hover:text-white">
                            <i data-lucide="calendar" class="w-7 h-7"></i>
                        </div>
                        <h3
                            class="text-xl font-bold text-gray-900 mb-4 group-hover:text-primary-700 transition-colors duration-300">
                            Online Celebrity Bookings</h3>
                        <p class="text-gray-600 group-hover:text-gray-700 transition-colors duration-300">
                            Book celebrities online for your event with ease. Our platform provides a seamless and
                            transparent booking experience.
                        </p>
                    </div>

                    <!-- Feature Highlights (shows on hover) -->
                    <div class="mt-6 space-y-3 opacity-0 transform translate-y-4 transition-all duration-500"
                        :class="isHovered ? 'opacity-100 translate-y-0' : ''">
                        <div class="flex items-center text-sm text-gray-700">
                            <i data-lucide="check-circle" class="w-4 h-4 text-primary-600 mr-2"></i>
                            <span>Transparent pricing</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-700">
                            <i data-lucide="check-circle" class="w-4 h-4 text-primary-600 mr-2"></i>
                            <span>Availability calendar</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-700">
                            <i data-lucide="check-circle" class="w-4 h-4 text-primary-600 mr-2"></i>
                            <span>Secure payment gateway</span>
                        </div>
                    </div>

                    <!-- Action Button (shows on hover) -->
                    <div class="mt-8 opacity-0 transform translate-y-4 transition-all duration-500"
                        :class="isHovered ? 'opacity-100 translate-y-0' : ''">
                        <a href="book_celebrity"
                            class="inline-flex items-center text-primary-600 font-medium hover:text-primary-700 transition-colors duration-300">
                            <span>Book Now</span>
                            <i data-lucide="arrow-right"
                                class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform duration-300"></i>
                        </a>
                    </div>
                </div>

                <!-- Feature 2 - Video Messages -->
                <div class="bg-white rounded-2xl p-8 transition-all duration-500 hover:shadow-xl relative overflow-hidden group z-10"
                    x-data="{ isHovered: false }" @mouseenter="isHovered = true; activeFeature = 'videos'"
                    @mouseleave="isHovered = false; activeFeature = null">
                    <!-- Background Pattern -->
                    <div class="absolute inset-0 bg-gradient-to-br from-accent-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"
                        :class="isHovered ? 'opacity-100' : 'opacity-0'"></div>

                    <!-- Decorative Circles -->
                    <div
                        class="absolute -right-5 -bottom-5 w-24 h-24 bg-accent-100 rounded-full opacity-0 group-hover:opacity-30 transition-all duration-500 transform group-hover:scale-125">
                    </div>

                    <!-- Icon with circular background -->
                    <div class="relative z-10 mb-6">
                        <div
                            class="w-16 h-16 flex items-center justify-center rounded-full bg-accent-100 text-accent-600 mb-6 transition-all duration-500 group-hover:bg-accent-600 group-hover:text-white">
                            <i data-lucide="video" class="w-7 h-7"></i>
                        </div>
                        <h3
                            class="text-xl font-bold text-gray-900 mb-4 group-hover:text-accent-700 transition-colors duration-300">
                            Video Messages</h3>
                        <p class="text-gray-600 group-hover:text-gray-700 transition-colors duration-300">
                            Purchase personalized video messages from your favorite celebrities for birthdays,
                            anniversaries, or any special occasion.
                        </p>
                    </div>

                    <!-- Feature Highlights (shows on hover) -->
                    <div class="mt-6 space-y-3 opacity-0 transform translate-y-4 transition-all duration-500"
                        :class="isHovered ? 'opacity-100 translate-y-0' : ''">
                        <div class="flex items-center text-sm text-gray-700">
                            <i data-lucide="check-circle" class="w-4 h-4 text-accent-600 mr-2"></i>
                            <span>HD quality videos</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-700">
                            <i data-lucide="check-circle" class="w-4 h-4 text-accent-600 mr-2"></i>
                            <span>Quick turnaround time</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-700">
                            <i data-lucide="check-circle" class="w-4 h-4 text-accent-600 mr-2"></i>
                            <span>Customized messages</span>
                        </div>
                    </div>

                    <!-- Action Button (shows on hover) -->
                    <div class="mt-8 opacity-0 transform translate-y-4 transition-all duration-500"
                        :class="isHovered ? 'opacity-100 translate-y-0' : ''">
                        <a href="video_messages"
                            class="inline-flex items-center text-accent-600 font-medium hover:text-accent-700 transition-colors duration-300">
                            <span>Request Video</span>
                            <i data-lucide="arrow-right"
                                class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform duration-300"></i>
                        </a>
                    </div>
                </div>

                <!-- Feature 3 - Meet & Greet -->
                <div class="bg-white rounded-2xl p-8 transition-all duration-500 hover:shadow-xl relative overflow-hidden group z-10"
                    x-data="{ isHovered: false }" @mouseenter="isHovered = true; activeFeature = 'meetgreet'"
                    @mouseleave="isHovered = false; activeFeature = null">
                    <!-- Background Pattern -->
                    <div class="absolute inset-0 bg-gradient-to-br from-primary-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"
                        :class="isHovered ? 'opacity-100' : 'opacity-0'"></div>

                    <!-- Decorative Circles -->
                    <div
                        class="absolute -right-5 -bottom-5 w-24 h-24 bg-primary-100 rounded-full opacity-0 group-hover:opacity-30 transition-all duration-500 transform group-hover:scale-125">
                    </div>

                    <!-- Icon with circular background -->
                    <div class="relative z-10 mb-6">
                        <div
                            class="w-16 h-16 flex items-center justify-center rounded-full bg-primary-100 text-primary-600 mb-6 transition-all duration-500 group-hover:bg-primary-600 group-hover:text-white">
                            <i data-lucide="users" class="w-7 h-7"></i>
                        </div>
                        <h3
                            class="text-xl font-bold text-gray-900 mb-4 group-hover:text-primary-700 transition-colors duration-300">
                            Meet & Greet</h3>
                        <p class="text-gray-600 group-hover:text-gray-700 transition-colors duration-300">
                            Meet your favorite celebrities in person with our exclusive meet & greet packages and VIP
                            experiences.
                        </p>
                    </div>

                    <!-- Feature Highlights (shows on hover) -->
                    <div class="mt-6 space-y-3 opacity-0 transform translate-y-4 transition-all duration-500"
                        :class="isHovered ? 'opacity-100 translate-y-0' : ''">
                        <div class="flex items-center text-sm text-gray-700">
                            <i data-lucide="check-circle" class="w-4 h-4 text-primary-600 mr-2"></i>
                            <span>Photo opportunities</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-700">
                            <i data-lucide="check-circle" class="w-4 h-4 text-primary-600 mr-2"></i>
                            <span>Autograph sessions</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-700">
                            <i data-lucide="check-circle" class="w-4 h-4 text-primary-600 mr-2"></i>
                            <span>VIP access options</span>
                        </div>
                    </div>

                    <!-- Action Button (shows on hover) -->
                    <div class="mt-8 opacity-0 transform translate-y-4 transition-all duration-500"
                        :class="isHovered ? 'opacity-100 translate-y-0' : ''">
                        <a href="meet_greet"
                            class="inline-flex items-center text-primary-600 font-medium hover:text-primary-700 transition-colors duration-300">
                            <span>Reserve Now</span>
                            <i data-lucide="arrow-right"
                                class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform duration-300"></i>
                        </a>
                    </div>
                </div>

                <!-- Feature 4 - Fan Membership -->
                <div class="bg-white rounded-2xl p-8 transition-all duration-500 hover:shadow-xl relative overflow-hidden group z-10"
                    x-data="{ isHovered: false }" @mouseenter="isHovered = true; activeFeature = 'membership'"
                    @mouseleave="isHovered = false; activeFeature = null">
                    <!-- Background Pattern -->
                    <div class="absolute inset-0 bg-gradient-to-br from-accent-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"
                        :class="isHovered ? 'opacity-100' : 'opacity-0'"></div>

                    <!-- Decorative Circles -->
                    <div
                        class="absolute -right-5 -bottom-5 w-24 h-24 bg-accent-100 rounded-full opacity-0 group-hover:opacity-30 transition-all duration-500 transform group-hover:scale-125">
                    </div>

                    <!-- Icon with circular background -->
                    <div class="relative z-10 mb-6">
                        <div
                            class="w-16 h-16 flex items-center justify-center rounded-full bg-accent-100 text-accent-600 mb-6 transition-all duration-500 group-hover:bg-accent-600 group-hover:text-white">
                            <i data-lucide="credit-card" class="w-7 h-7"></i>
                        </div>
                        <h3
                            class="text-xl font-bold text-gray-900 mb-4 group-hover:text-accent-700 transition-colors duration-300">
                            Fan Membership Card</h3>
                        <p class="text-gray-600 group-hover:text-gray-700 transition-colors duration-300">
                            Apply for a fan membership card to unlock exclusive benefits, discounts, and priority access to
                            celebrity events.
                        </p>
                    </div>

                    <!-- Feature Highlights (shows on hover) -->
                    <div class="mt-6 space-y-3 opacity-0 transform translate-y-4 transition-all duration-500"
                        :class="isHovered ? 'opacity-100 translate-y-0' : ''">
                        <div class="flex items-center text-sm text-gray-700">
                            <i data-lucide="check-circle" class="w-4 h-4 text-accent-600 mr-2"></i>
                            <span>Priority booking access</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-700">
                            <i data-lucide="check-circle" class="w-4 h-4 text-accent-600 mr-2"></i>
                            <span>Exclusive content access</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-700">
                            <i data-lucide="check-circle" class="w-4 h-4 text-accent-600 mr-2"></i>
                            <span>Special member discounts</span>
                        </div>
                    </div>

                    <!-- Action Button (shows on hover) -->
                    <div class="mt-8 opacity-0 transform translate-y-4 transition-all duration-500"
                        :class="isHovered ? 'opacity-100 translate-y-0' : ''">
                        <a href="fan_membership"
                            class="inline-flex items-center text-accent-600 font-medium hover:text-accent-700 transition-colors duration-300">
                            <span>Apply Now</span>
                            <i data-lucide="arrow-right"
                                class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform duration-300"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Additional Services -->
            <div class="mt-16 bg-gradient-to-r from-primary-600 to-accent-600 rounded-2xl overflow-hidden shadow-xl">
                <div class="grid grid-cols-1 lg:grid-cols-2">
                    <!-- Content Side -->
                    <div class="p-8 lg:p-12">
                        <h3 class="text-2xl lg:text-3xl font-bold text-white mb-6">Need a Custom Celebrity Experience?</h3>
                        <p class="text-white/80 mb-8">
                            Our team specializes in creating bespoke celebrity experiences tailored to your specific needs.
                            Whether you're planning a corporate event, private party, or special occasion, we can help you
                            create unforgettable memories.
                        </p>
                        <a href="custom_experience"
                            class="inline-flex items-center px-6 py-3 bg-white text-primary-600 rounded-lg font-medium hover:bg-gray-100 transition-all duration-300">
                            <i data-lucide="sparkles" class="w-5 h-5 mr-2"></i>
                            Request Custom Experience
                        </a>
                    </div>
                    <!-- Image Side -->
                    <div class="relative h-64 lg:h-auto">
                        <img src="temp/assets/img/home-2/img/about/ab1.jpg" alt="Custom Celebrity Experience"
                            class="absolute inset-0 w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/20"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section id="gallery" class="py-12 lg:py-20 bg-gray-900 relative overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute inset-0">
            <!-- Dark overlay with texture -->
            <div class="absolute inset-0 bg-black/50"></div>
            <!-- Gradient overlay -->
            <div class="absolute inset-0 bg-gradient-to-b from-transparent via-primary-900/20 to-black/70"></div>
            <!-- Background image with reduced opacity -->
            <img src="temp/assets/img/home-2/img/slider/fm-bg.jpg" alt="Celebrity Background"
                class="absolute inset-0 w-full h-full object-cover opacity-40">
        </div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Section Header -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12 items-center">
                <div>
                    <span
                        class="inline-block px-4 py-2 bg-white/10 backdrop-blur-sm border border-white/20 rounded-full text-white text-sm font-semibold mb-4">
                        <i data-lucide="image" class="w-4 h-4 inline mr-1"></i>
                        Gallery
                    </span>
                    <h2 class="text-3xl lg:text-5xl font-display font-bold text-white mb-2 leading-tight">
                        <?php echo e($settings->site_name); ?> <span class="text-primary-400">Gallery</span>
                    </h2>
                </div>
                <div>
                    <p class="text-lg text-white/80 leading-relaxed">
                        We curate a diverse selection of celebrities from various fields, including movies, music,
                        sports, fashion, and more. Explore their profiles, discover their upcoming projects, and stay
                        updated with their latest news.
                    </p>
                </div>
            </div>

            <!-- Gallery Filter -->
            <div class="mb-8" x-data="{ activeFilter: 'all' }">
                <div class="flex flex-wrap items-center justify-center gap-4">
                    <button @click="activeFilter = 'all'"
                        class="px-5 py-2 rounded-full text-sm font-medium transition-all duration-300"
                        :class="activeFilter === 'all' ? 'bg-primary-600 text-white' :
                            'bg-white/10 text-white/80 hover:bg-white/20'">
                        All
                    </button>
                    <button @click="activeFilter = 'events'"
                        class="px-5 py-2 rounded-full text-sm font-medium transition-all duration-300"
                        :class="activeFilter === 'events' ? 'bg-primary-600 text-white' :
                            'bg-white/10 text-white/80 hover:bg-white/20'">
                        Events
                    </button>
                    <button @click="activeFilter = 'meetgreet'"
                        class="px-5 py-2 rounded-full text-sm font-medium transition-all duration-300"
                        :class="activeFilter === 'meetgreet' ? 'bg-primary-600 text-white' :
                            'bg-white/10 text-white/80 hover:bg-white/20'">
                        Meet & Greet
                    </button>
                    <button @click="activeFilter = 'shows'"
                        class="px-5 py-2 rounded-full text-sm font-medium transition-all duration-300"
                        :class="activeFilter === 'shows' ? 'bg-primary-600 text-white' :
                            'bg-white/10 text-white/80 hover:bg-white/20'">
                        Shows
                    </button>
                </div>
            </div>

            <!-- Gallery Grid -->
            <div x-data="{
                lightbox: false,
                imgModal: '',
                imgTitle: '',
                imgCategory: '',
                currentIndex: 0,
                images: [
                    { src: 'temp/assets/img/home-2/img/portfolio/1.jpg', title: 'Celebrity Gala Night', category: 'events', description: 'Annual charity gala featuring top celebrities from film and music.' },
                    { src: 'temp/assets/img/home-2/img/portfolio/2.jpg', title: 'Exclusive Interview Session', category: 'meetgreet', description: 'One-on-one interview sessions with your favorite stars.' },
                    { src: 'temp/assets/img/home-2/img/portfolio/3.jpg', title: 'Concert Backstage Access', category: 'shows', description: 'VIP backstage access to major concert events.' },
                    { src: 'temp/assets/img/home-2/img/portfolio/4.jpg', title: 'Fan Meet & Greet', category: 'meetgreet', description: 'Special fan meetings with celebrity signings and photo opportunities.' },
                    { src: 'temp/assets/img/home-2/img/portfolio/6.jpg', title: 'Red Carpet Event', category: 'events', description: 'Exclusive red carpet celebrity appearances and media coverage.' },
                    { src: 'temp/assets/img/home-2/img/portfolio/2.jpg', title: 'Award Show Experience', category: 'shows', description: 'Premium seating at major award shows with after-party access.' }
                ],
                showImage(index) {
                    this.lightbox = true;
                    this.currentIndex = index;
                    this.imgModal = this.images[index].src;
                    this.imgTitle = this.images[index].title;
                    this.imgCategory = this.images[index].category;
                    this.imgDescription = this.images[index].description;
                },
                nextImage() {
                    this.currentIndex = (this.currentIndex + 1) % this.images.length;
                    this.imgModal = this.images[this.currentIndex].src;
                    this.imgTitle = this.images[this.currentIndex].title;
                    this.imgCategory = this.images[this.currentIndex].category;
                    this.imgDescription = this.images[this.currentIndex].description;
                },
                prevImage() {
                    this.currentIndex = (this.currentIndex - 1 + this.images.length) % this.images.length;
                    this.imgModal = this.images[this.currentIndex].src;
                    this.imgTitle = this.images[this.currentIndex].title;
                    this.imgCategory = this.images[this.currentIndex].category;
                    this.imgDescription = this.images[this.currentIndex].description;
                }
            }" class="relative">
                <!-- Gallery Images -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <template x-for="(image, index) in images" :key="index">
                        <div x-show="activeFilter === 'all' || activeFilter === image.category"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            class="group relative overflow-hidden rounded-xl cursor-pointer" @click="showImage(index)">
                            <div class="aspect-w-4 aspect-h-3">
                                <img :src="image.src" :alt="image.title"
                                    class="w-full h-full object-cover object-center transition-transform duration-700 group-hover:scale-110">
                            </div>
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent opacity-80 transition-opacity duration-300 group-hover:opacity-90">
                            </div>

                            <!-- Overlay Content -->
                            <div
                                class="absolute bottom-0 left-0 right-0 p-6 transform transition-transform duration-300 group-hover:translate-y-0">
                                <span
                                    class="inline-block px-3 py-1 rounded-full bg-primary-500 text-xs text-white font-medium mb-3"
                                    x-text="image.category.charAt(0).toUpperCase() + image.category.slice(1)"></span>
                                <h3 class="text-xl font-bold text-white mb-1" x-text="image.title"></h3>
                                <p class="text-white/70 text-sm" x-text="image.description"></p>
                            </div>

                            <!-- Zoom Icon -->
                            <div
                                class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <div
                                    class="w-10 h-10 flex items-center justify-center rounded-full bg-white/20 backdrop-blur-sm text-white hover:bg-white/40 transition-colors duration-300">
                                    <i data-lucide="zoom-in" class="w-5 h-5"></i>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>

                <!-- Lightbox -->
                <div x-show="lightbox" x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0" @keydown.escape.window="lightbox = false"
                    class="fixed inset-0 z-50 flex items-center justify-center bg-black/90">
                    <!-- Close button -->
                    <button @click="lightbox = false" class="absolute top-5 right-5 text-white hover:text-gray-300 z-20">
                        <i data-lucide="x" class="w-8 h-8"></i>
                    </button>

                    <!-- Navigation arrows -->
                    <button @click="prevImage"
                        class="absolute left-5 top-1/2 -translate-y-1/2 text-white hover:text-gray-300 z-20">
                        <i data-lucide="chevron-left" class="w-12 h-12"></i>
                    </button>
                    <button @click="nextImage"
                        class="absolute right-5 top-1/2 -translate-y-1/2 text-white hover:text-gray-300 z-20">
                        <i data-lucide="chevron-right" class="w-12 h-12"></i>
                    </button>

                    <!-- Image and caption -->
                    <div class="max-w-5xl w-full px-4">
                        <img :src="imgModal" class="mx-auto max-h-[75vh] object-contain rounded-lg"
                            :alt="imgTitle">
                        <div class="text-white text-center mt-4">
                            <span x-text="imgCategory.charAt(0).toUpperCase() + imgCategory.slice(1)"
                                class="text-primary-400 text-sm"></span>
                            <h3 class="text-xl font-bold mt-1" x-text="imgTitle"></h3>
                            <p class="text-white/70 mt-2" x-text="imgDescription"></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- View All Button -->
            <div class="mt-12 text-center">
                <a href="gallery"
                    class="inline-flex items-center px-6 py-3 bg-white/10 backdrop-blur-sm border border-white/20 text-white rounded-lg font-medium hover:bg-white/20 transition-all duration-300">
                    <i data-lucide="image-plus" class="w-5 h-5 mr-2"></i>
                    View Full Gallery
                </a>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section id="why-choose-us" class="py-12 lg:py-20 bg-white relative overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-0 right-0 w-64 h-64 bg-primary-50 rounded-full filter blur-3xl opacity-60"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-accent-50 rounded-full filter blur-3xl opacity-60"></div>
            <div
                class="absolute -top-20 left-1/2 transform -translate-x-1/2 w-[800px] h-[800px] border border-gray-200 rounded-full opacity-20">
            </div>
        </div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <!-- Image Side with Interactive Image -->
                <div class="relative order-2 lg:order-1" x-data="{ inView: false, activeTab: null }" x-intersect="inView = true">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl" x-show="inView"
                        x-transition:enter="transition ease-out duration-1000"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
                        <!-- Main Image -->
                        <img src="temp/assets/img/home-2/img/about/wh1.jpg" alt="Why Choose <?php echo e($settings->site_name); ?>"
                            class="w-full h-auto object-cover">

                        <!-- Image Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-primary-900/80 to-transparent"></div>

                        <!-- Interactive Hotspots -->
                        <div class="absolute inset-0">
                            <!-- Hotspot 1 - Top Left -->
                            <div class="absolute top-[20%] left-[25%] group cursor-pointer"
                                @mouseenter="activeTab = 'priority'" @mouseleave="activeTab = null">
                                <div class="relative">
                                    <span
                                        class="absolute animate-ping inline-flex h-full w-full rounded-full bg-primary-400 opacity-75"></span>
                                    <span
                                        class="relative inline-flex items-center justify-center w-8 h-8 bg-primary-500 text-white rounded-full shadow-lg group-hover:bg-primary-600 transition-colors duration-300 z-10">
                                        <i data-lucide="star" class="w-4 h-4"></i>
                                    </span>
                                </div>
                                <div x-show="activeTab === 'priority'"
                                    x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="opacity-0 transform translate-y-2"
                                    x-transition:enter-end="opacity-100 transform translate-y-0"
                                    class="absolute top-full left-1/2 transform -translate-x-1/2 mt-2 w-48 p-3 bg-white rounded-lg shadow-lg z-20">
                                    <h4 class="text-sm font-semibold text-gray-900">Priority Access</h4>
                                    <p class="text-xs text-gray-600 mt-1">Skip the queue for virtual meet-and-greet
                                        sessions</p>
                                </div>
                            </div>

                            <!-- Hotspot 2 - Bottom Right -->
                            <div class="absolute top-[40%] right-[20%] group cursor-pointer"
                                @mouseenter="activeTab = 'exclusive'" @mouseleave="activeTab = null">
                                <div class="relative">
                                    <span
                                        class="absolute animate-ping inline-flex h-full w-full rounded-full bg-accent-400 opacity-75"></span>
                                    <span
                                        class="relative inline-flex items-center justify-center w-8 h-8 bg-accent-500 text-white rounded-full shadow-lg group-hover:bg-accent-600 transition-colors duration-300 z-10">
                                        <i data-lucide="film" class="w-4 h-4"></i>
                                    </span>
                                </div>
                                <div x-show="activeTab === 'exclusive'"
                                    x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="opacity-0 transform translate-y-2"
                                    x-transition:enter-end="opacity-100 transform translate-y-0"
                                    class="absolute top-full left-1/2 transform -translate-x-1/2 mt-2 w-48 p-3 bg-white rounded-lg shadow-lg z-20">
                                    <h4 class="text-sm font-semibold text-gray-900">Exclusive Content</h4>
                                    <p class="text-xs text-gray-600 mt-1">Behind-the-scenes content and interviews</p>
                                </div>
                            </div>

                            <!-- Hotspot 3 - Bottom Left -->
                            <div class="absolute bottom-[25%] left-[30%] group cursor-pointer"
                                @mouseenter="activeTab = 'donation'" @mouseleave="activeTab = null">
                                <div class="relative">
                                    <span
                                        class="absolute animate-ping inline-flex h-full w-full rounded-full bg-primary-400 opacity-75"></span>
                                    <span
                                        class="relative inline-flex items-center justify-center w-8 h-8 bg-primary-500 text-white rounded-full shadow-lg group-hover:bg-primary-600 transition-colors duration-300 z-10">
                                        <i data-lucide="heart" class="w-4 h-4"></i>
                                    </span>
                                </div>
                                <div x-show="activeTab === 'donation'"
                                    x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="opacity-0 transform translate-y-2"
                                    x-transition:enter-end="opacity-100 transform translate-y-0"
                                    class="absolute top-full left-1/2 transform -translate-x-1/2 mt-2 w-48 p-3 bg-white rounded-lg shadow-lg z-20">
                                    <h4 class="text-sm font-semibold text-gray-900">Charity Donations</h4>
                                    <p class="text-xs text-gray-600 mt-1">Support celebrity-initiated charity projects</p>
                                </div>
                            </div>

                            <!-- Hotspot 4 - Center Right -->
                            <div class="absolute bottom-[30%] right-[25%] group cursor-pointer"
                                @mouseenter="activeTab = 'vip'" @mouseleave="activeTab = null">
                                <div class="relative">
                                    <span
                                        class="absolute animate-ping inline-flex h-full w-full rounded-full bg-accent-400 opacity-75"></span>
                                    <span
                                        class="relative inline-flex items-center justify-center w-8 h-8 bg-accent-500 text-white rounded-full shadow-lg group-hover:bg-accent-600 transition-colors duration-300 z-10">
                                        <i data-lucide="crown" class="w-4 h-4"></i>
                                    </span>
                                </div>
                                <div x-show="activeTab === 'vip'" x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="opacity-0 transform translate-y-2"
                                    x-transition:enter-end="opacity-100 transform translate-y-0"
                                    class="absolute top-full left-1/2 transform -translate-x-1/2 mt-2 w-48 p-3 bg-white rounded-lg shadow-lg z-20">
                                    <h4 class="text-sm font-semibold text-gray-900">VIP Offers</h4>
                                    <p class="text-xs text-gray-600 mt-1">Special deals and perks for VIP members</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Stats at bottom -->
                    <div class="grid grid-cols-2 gap-4 mt-8" x-show="inView"
                        x-transition:enter="transition ease-out duration-1000 delay-300"
                        x-transition:enter-start="opacity-0 translate-y-10"
                        x-transition:enter-end="opacity-100 translate-y-0">
                        <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100 text-center">
                            <div class="text-3xl font-bold text-primary-600 mb-2">10,000+</div>
                            <div class="text-sm text-gray-600">Happy Clients</div>
                        </div>
                        <div class="bg-white rounded-xl p-6 shadow-lg border border-gray-100 text-center">
                            <div class="text-3xl font-bold text-accent-600 mb-2">500+</div>
                            <div class="text-sm text-gray-600">Celebrity Partners</div>
                        </div>
                    </div>
                </div>

                <!-- Content Side -->
                <div class="order-1 lg:order-2" x-data="{ inView: false, activeFeature: 'priority' }" x-intersect="inView = true">
                    <div x-show="inView" x-transition:enter="transition ease-out duration-1000"
                        x-transition:enter-start="opacity-0 translate-x-8"
                        x-transition:enter-end="opacity-100 translate-x-0">
                        <!-- Section Header -->
                        <div class="mb-8">
                            <span
                                class="inline-block px-4 py-2 bg-primary-100 text-primary-700 rounded-full text-sm font-semibold mb-4">
                                <i data-lucide="check-circle" class="w-4 h-4 mr-2 inline"></i>
                                Why Choose Us
                            </span>
                            <h2 class="text-3xl lg:text-5xl font-display font-bold text-gray-900 mb-6 leading-tight">
                                <?php echo e($settings->site_name); ?> <span class="gradient-text">Special Services</span>
                            </h2>
                            <p class="text-lg text-gray-600 leading-relaxed">
                                Join the ever-growing community of celebrity enthusiasts and embark on an extraordinary
                                journey of fandom. Create unforgettable memories and make connections that will last a
                                lifetime.
                            </p>
                        </div>

                        <!-- Feature Tabs -->
                        <div class="mb-8">
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                                <button @click="activeFeature = 'priority'"
                                    class="flex flex-col items-center p-4 rounded-xl transition-all duration-300"
                                    :class="activeFeature === 'priority' ? 'bg-primary-50 text-primary-700' :
                                        'bg-gray-50 text-gray-700 hover:bg-gray-100'">
                                    <div class="w-12 h-12 flex items-center justify-center rounded-full mb-3"
                                        :class="activeFeature === 'priority' ? 'bg-primary-100 text-primary-700' :
                                            'bg-gray-100 text-gray-600'">
                                        <i data-lucide="star" class="w-6 h-6"></i>
                                    </div>
                                    <span class="text-sm font-medium">Priority Access</span>
                                </button>
                                <button @click="activeFeature = 'exclusive'"
                                    class="flex flex-col items-center p-4 rounded-xl transition-all duration-300"
                                    :class="activeFeature === 'exclusive' ? 'bg-primary-50 text-primary-700' :
                                        'bg-gray-50 text-gray-700 hover:bg-gray-100'">
                                    <div class="w-12 h-12 flex items-center justify-center rounded-full mb-3"
                                        :class="activeFeature === 'exclusive' ? 'bg-primary-100 text-primary-700' :
                                            'bg-gray-100 text-gray-600'">
                                        <i data-lucide="film" class="w-6 h-6"></i>
                                    </div>
                                    <span class="text-sm font-medium">Exclusive Content</span>
                                </button>
                                <button @click="activeFeature = 'donation'"
                                    class="flex flex-col items-center p-4 rounded-xl transition-all duration-300"
                                    :class="activeFeature === 'donation' ? 'bg-primary-50 text-primary-700' :
                                        'bg-gray-50 text-gray-700 hover:bg-gray-100'">
                                    <div class="w-12 h-12 flex items-center justify-center rounded-full mb-3"
                                        :class="activeFeature === 'donation' ? 'bg-primary-100 text-primary-700' :
                                            'bg-gray-100 text-gray-600'">
                                        <i data-lucide="heart" class="w-6 h-6"></i>
                                    </div>
                                    <span class="text-sm font-medium">Charity Support</span>
                                </button>
                                <button @click="activeFeature = 'vip'"
                                    class="flex flex-col items-center p-4 rounded-xl transition-all duration-300"
                                    :class="activeFeature === 'vip' ? 'bg-primary-50 text-primary-700' :
                                        'bg-gray-50 text-gray-700 hover:bg-gray-100'">
                                    <div class="w-12 h-12 flex items-center justify-center rounded-full mb-3"
                                        :class="activeFeature === 'vip' ? 'bg-primary-100 text-primary-700' :
                                            'bg-gray-100 text-gray-600'">
                                        <i data-lucide="crown" class="w-6 h-6"></i>
                                    </div>
                                    <span class="text-sm font-medium">VIP Offers</span>
                                </button>
                            </div>

                            <!-- Feature Content -->
                            <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                                <!-- Priority Access Feature -->
                                <div x-show="activeFeature === 'priority'" x-transition>
                                    <h3 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                                        <i data-lucide="star" class="w-6 h-6 text-primary-600 mr-3"></i>
                                        Priority Access
                                    </h3>
                                    <p class="text-gray-600 mb-6 leading-relaxed">
                                        Skip the queue and enjoy priority access to virtual meet-and-greet sessions,
                                        ensuring that you get a chance to connect with your favorite stars before anyone
                                        else. Our priority access ensures you're always at the front of the line.
                                    </p>
                                    <ul class="space-y-3 mb-6">
                                        <li class="flex items-start">
                                            <i data-lucide="check"
                                                class="w-5 h-5 text-primary-600 mr-3 mt-0.5 flex-shrink-0"></i>
                                            <span class="text-gray-700">Early access to booking windows</span>
                                        </li>
                                        <li class="flex items-start">
                                            <i data-lucide="check"
                                                class="w-5 h-5 text-primary-600 mr-3 mt-0.5 flex-shrink-0"></i>
                                            <span class="text-gray-700">Reserved spots for limited events</span>
                                        </li>
                                        <li class="flex items-start">
                                            <i data-lucide="check"
                                                class="w-5 h-5 text-primary-600 mr-3 mt-0.5 flex-shrink-0"></i>
                                            <span class="text-gray-700">Dedicated concierge for bookings</span>
                                        </li>
                                    </ul>
                                    <a href="membership"
                                        class="inline-flex items-center text-primary-600 font-medium hover:text-primary-700 transition-colors duration-300">
                                        <span>Learn more about priority access</span>
                                        <i data-lucide="arrow-right" class="w-4 h-4 ml-2"></i>
                                    </a>
                                </div>

                                <!-- Exclusive Content Feature -->
                                <div x-show="activeFeature === 'exclusive'" x-transition>
                                    <h3 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                                        <i data-lucide="film" class="w-6 h-6 text-primary-600 mr-3"></i>
                                        Exclusive Content
                                    </h3>
                                    <p class="text-gray-600 mb-6 leading-relaxed">
                                        Gain access to exclusive behind-the-scenes content, including interviews, photo
                                        galleries, and sneak peeks into upcoming projects. We provide content that can't be
                                        found anywhere else.
                                    </p>
                                    <ul class="space-y-3 mb-6">
                                        <li class="flex items-start">
                                            <i data-lucide="check"
                                                class="w-5 h-5 text-primary-600 mr-3 mt-0.5 flex-shrink-0"></i>
                                            <span class="text-gray-700">Unreleased interview footage</span>
                                        </li>
                                        <li class="flex items-start">
                                            <i data-lucide="check"
                                                class="w-5 h-5 text-primary-600 mr-3 mt-0.5 flex-shrink-0"></i>
                                            <span class="text-gray-700">Behind-the-scenes photoshoots</span>
                                        </li>
                                        <li class="flex items-start">
                                            <i data-lucide="check"
                                                class="w-5 h-5 text-primary-600 mr-3 mt-0.5 flex-shrink-0"></i>
                                            <span class="text-gray-700">Celebrity lifestyle content</span>
                                        </li>
                                    </ul>
                                    <a href="exclusive_content"
                                        class="inline-flex items-center text-primary-600 font-medium hover:text-primary-700 transition-colors duration-300">
                                        <span>Browse exclusive content</span>
                                        <i data-lucide="arrow-right" class="w-4 h-4 ml-2"></i>
                                    </a>
                                </div>

                                <!-- Donation Feature -->
                                <div x-show="activeFeature === 'donation'" x-transition>
                                    <h3 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                                        <i data-lucide="heart" class="w-6 h-6 text-primary-600 mr-3"></i>
                                        Charity Support
                                    </h3>
                                    <p class="text-gray-600 mb-6 leading-relaxed">
                                        Donate to charity schemes initiated by celebrities from around the world. Make a
                                        difference while connecting with your favorite stars through causes that matter.
                                    </p>
                                    <ul class="space-y-3 mb-6">
                                        <li class="flex items-start">
                                            <i data-lucide="check"
                                                class="w-5 h-5 text-primary-600 mr-3 mt-0.5 flex-shrink-0"></i>
                                            <span class="text-gray-700">100% transparent donation process</span>
                                        </li>
                                        <li class="flex items-start">
                                            <i data-lucide="check"
                                                class="w-5 h-5 text-primary-600 mr-3 mt-0.5 flex-shrink-0"></i>
                                            <span class="text-gray-700">Celebrity-backed charitable initiatives</span>
                                        </li>
                                        <li class="flex items-start">
                                            <i data-lucide="check"
                                                class="w-5 h-5 text-primary-600 mr-3 mt-0.5 flex-shrink-0"></i>
                                            <span class="text-gray-700">Regular impact reports from charities</span>
                                        </li>
                                    </ul>
                                    <a href="charity"
                                        class="inline-flex items-center text-primary-600 font-medium hover:text-primary-700 transition-colors duration-300">
                                        <span>Support a cause</span>
                                        <i data-lucide="arrow-right" class="w-4 h-4 ml-2"></i>
                                    </a>
                                </div>

                                <!-- VIP Feature -->
                                <div x-show="activeFeature === 'vip'" x-transition>
                                    <h3 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                                        <i data-lucide="crown" class="w-6 h-6 text-primary-600 mr-3"></i>
                                        VIP Offers
                                    </h3>
                                    <p class="text-gray-600 mb-6 leading-relaxed">
                                        Enjoy the perks of being a VIP member with exciting offers and deals tailored just
                                        for you. Get access to premium experiences that regular users don't see.
                                    </p>
                                    <ul class="space-y-3 mb-6">
                                        <li class="flex items-start">
                                            <i data-lucide="check"
                                                class="w-5 h-5 text-primary-600 mr-3 mt-0.5 flex-shrink-0"></i>
                                            <span class="text-gray-700">Special discounts on bookings</span>
                                        </li>
                                        <li class="flex items-start">
                                            <i data-lucide="check"
                                                class="w-5 h-5 text-primary-600 mr-3 mt-0.5 flex-shrink-0"></i>
                                            <span class="text-gray-700">Invitation to exclusive VIP events</span>
                                        </li>
                                        <li class="flex items-start">
                                            <i data-lucide="check"
                                                class="w-5 h-5 text-primary-600 mr-3 mt-0.5 flex-shrink-0"></i>
                                            <span class="text-gray-700">Birthday surprises from celebrities</span>
                                        </li>
                                    </ul>
                                    <a href="vip"
                                        class="inline-flex items-center text-primary-600 font-medium hover:text-primary-700 transition-colors duration-300">
                                        <span>Become a VIP member</span>
                                        <i data-lucide="arrow-right" class="w-4 h-4 ml-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Partners/Brands Section -->
    <section id="partners" class="py-12 lg:py-20 bg-gradient-to-b from-gray-50 to-white relative overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-0 left-0 w-full h-20 bg-gradient-to-b from-white to-transparent"></div>
            <div class="absolute bottom-0 left-0 w-full h-20 bg-gradient-to-t from-white to-transparent"></div>
            <!-- Decorative Elements -->
            <div class="absolute -top-20 right-0 w-72 h-72 bg-primary-50 rounded-full opacity-60 blur-3xl"></div>
            <div class="absolute -bottom-10 -left-10 w-60 h-60 bg-accent-50 rounded-full opacity-60 blur-3xl"></div>
        </div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative" id="brands">
            <!-- Section Header -->
            <div class="max-w-3xl mx-auto text-center mb-12">
                <span
                    class="inline-block px-4 py-2 bg-primary-100 text-primary-700 rounded-full text-sm font-semibold mb-4">
                    <i data-lucide="briefcase" class="w-4 h-4 inline mr-1"></i>
                    Our Partners
                </span>
                <h2 class="text-3xl lg:text-5xl font-display font-bold text-gray-900 mb-6 leading-tight">
                    <?php echo e($settings->site_name); ?> <span class="gradient-text">Partners</span>
                </h2>
                <p class="text-lg text-gray-600 leading-relaxed">
                    We collaborate with leading entertainment brands and studios to bring you access to the best celebrity
                    talent across industries.
                </p>
            </div>

            <!-- Partners Carousel -->
            <div class="mb-16" x-data="{ activeIndex: 0 }">
                <!-- Logo Grid (animated with Alpine.js) -->
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8 items-center">
                    <!-- Partner 1 - Warner Bros -->
                    <div class="group relative aspect-w-4 aspect-h-3 p-6 bg-white rounded-xl transition-all duration-500 hover:shadow-xl border border-gray-100"
                        x-data="{ isHovered: false }" @mouseenter="isHovered = true" @mouseleave="isHovered = false">
                        <!-- Logo -->
                        <div class="flex items-center justify-center h-full">
                            <img src="temp/assets/img/home-2/img/team/1.jpg" alt="Warner Bros"
                                class="max-h-16 max-w-full object-contain transition-transform duration-500"
                                :class="isHovered ? 'scale-110' : ''">
                        </div>

                        <!-- Overlay (visible on hover) -->
                        <div class="absolute inset-0 bg-primary-900/90 rounded-xl opacity-0 transition-opacity duration-300 flex flex-col items-center justify-center p-4"
                            :class="isHovered ? 'opacity-100' : 'opacity-0'">
                            <h4 class="text-white font-bold text-lg mb-2">Warner Bros</h4>
                            <div class="flex space-x-3 mb-3">
                                <a href="#" class="text-white/80 hover:text-white transition-colors duration-300">
                                    <i data-lucide="instagram" class="w-5 h-5"></i>
                                </a>
                                <a href="#" class="text-white/80 hover:text-white transition-colors duration-300">
                                    <i data-lucide="twitter" class="w-5 h-5"></i>
                                </a>
                                <a href="#" class="text-white/80 hover:text-white transition-colors duration-300">
                                    <i data-lucide="facebook" class="w-5 h-5"></i>
                                </a>
                            </div>
                            <a href="#" class="text-xs text-white/80 hover:text-white underline">Visit Website</a>
                        </div>
                    </div>

                    <!-- Partner 2 - Disney -->
                    <div class="group relative aspect-w-4 aspect-h-3 p-6 bg-white rounded-xl transition-all duration-500 hover:shadow-xl border border-gray-100"
                        x-data="{ isHovered: false }" @mouseenter="isHovered = true" @mouseleave="isHovered = false">
                        <!-- Logo -->
                        <div class="flex items-center justify-center h-full">
                            <img src="temp/assets/img/home-2/img/team/2.jpg" alt="Walt Disney"
                                class="max-h-16 max-w-full object-contain transition-transform duration-500"
                                :class="isHovered ? 'scale-110' : ''">
                        </div>

                        <!-- Overlay (visible on hover) -->
                        <div class="absolute inset-0 bg-primary-900/90 rounded-xl opacity-0 transition-opacity duration-300 flex flex-col items-center justify-center p-4"
                            :class="isHovered ? 'opacity-100' : 'opacity-0'">
                            <h4 class="text-white font-bold text-lg mb-2">Walt Disney</h4>
                            <div class="flex space-x-3 mb-3">
                                <a href="#" class="text-white/80 hover:text-white transition-colors duration-300">
                                    <i data-lucide="instagram" class="w-5 h-5"></i>
                                </a>
                                <a href="#" class="text-white/80 hover:text-white transition-colors duration-300">
                                    <i data-lucide="twitter" class="w-5 h-5"></i>
                                </a>
                                <a href="#" class="text-white/80 hover:text-white transition-colors duration-300">
                                    <i data-lucide="facebook" class="w-5 h-5"></i>
                                </a>
                            </div>
                            <a href="#" class="text-xs text-white/80 hover:text-white underline">Visit Website</a>
                        </div>
                    </div>

                    <!-- Partner 3 - Gaumont -->
                    <div class="group relative aspect-w-4 aspect-h-3 p-6 bg-white rounded-xl transition-all duration-500 hover:shadow-xl border border-gray-100"
                        x-data="{ isHovered: false }" @mouseenter="isHovered = true" @mouseleave="isHovered = false">
                        <!-- Logo -->
                        <div class="flex items-center justify-center h-full">
                            <img src="temp/assets/img/home-2/img/team/3.jpg" alt="Gaumont"
                                class="max-h-16 max-w-full object-contain transition-transform duration-500"
                                :class="isHovered ? 'scale-110' : ''">
                        </div>

                        <!-- Overlay (visible on hover) -->
                        <div class="absolute inset-0 bg-primary-900/90 rounded-xl opacity-0 transition-opacity duration-300 flex flex-col items-center justify-center p-4"
                            :class="isHovered ? 'opacity-100' : 'opacity-0'">
                            <h4 class="text-white font-bold text-lg mb-2">Gaumont</h4>
                            <div class="flex space-x-3 mb-3">
                                <a href="#" class="text-white/80 hover:text-white transition-colors duration-300">
                                    <i data-lucide="instagram" class="w-5 h-5"></i>
                                </a>
                                <a href="#" class="text-white/80 hover:text-white transition-colors duration-300">
                                    <i data-lucide="twitter" class="w-5 h-5"></i>
                                </a>
                                <a href="#" class="text-white/80 hover:text-white transition-colors duration-300">
                                    <i data-lucide="facebook" class="w-5 h-5"></i>
                                </a>
                            </div>
                            <a href="#" class="text-xs text-white/80 hover:text-white underline">Visit Website</a>
                        </div>
                    </div>

                    <!-- Partner 4 - Fox -->
                    <div class="group relative aspect-w-4 aspect-h-3 p-6 bg-white rounded-xl transition-all duration-500 hover:shadow-xl border border-gray-100"
                        x-data="{ isHovered: false }" @mouseenter="isHovered = true" @mouseleave="isHovered = false">
                        <!-- Logo -->
                        <div class="flex items-center justify-center h-full">
                            <img src="temp/assets/img/home-2/img/team/4.jpg" alt="Fox"
                                class="max-h-16 max-w-full object-contain transition-transform duration-500"
                                :class="isHovered ? 'scale-110' : ''">
                        </div>

                        <!-- Overlay (visible on hover) -->
                        <div class="absolute inset-0 bg-primary-900/90 rounded-xl opacity-0 transition-opacity duration-300 flex flex-col items-center justify-center p-4"
                            :class="isHovered ? 'opacity-100' : 'opacity-0'">
                            <h4 class="text-white font-bold text-lg mb-2">Fox</h4>
                            <div class="flex space-x-3 mb-3">
                                <a href="#" class="text-white/80 hover:text-white transition-colors duration-300">
                                    <i data-lucide="instagram" class="w-5 h-5"></i>
                                </a>
                                <a href="#" class="text-white/80 hover:text-white transition-colors duration-300">
                                    <i data-lucide="twitter" class="w-5 h-5"></i>
                                </a>
                                <a href="#" class="text-white/80 hover:text-white transition-colors duration-300">
                                    <i data-lucide="facebook" class="w-5 h-5"></i>
                                </a>
                            </div>
                            <a href="#" class="text-xs text-white/80 hover:text-white underline">Visit Website</a>
                        </div>
                    </div>

                    <!-- Partner 5 - Paramount -->
                    <div class="group relative aspect-w-4 aspect-h-3 p-6 bg-white rounded-xl transition-all duration-500 hover:shadow-xl border border-gray-100"
                        x-data="{ isHovered: false }" @mouseenter="isHovered = true" @mouseleave="isHovered = false">
                        <!-- Logo -->
                        <div class="flex items-center justify-center h-full">
                            <img src="temp/assets/img/home-2/img/team/5.jpg" alt="Paramount"
                                class="max-h-16 max-w-full object-contain transition-transform duration-500"
                                :class="isHovered ? 'scale-110' : ''">
                        </div>

                        <!-- Overlay (visible on hover) -->
                        <div class="absolute inset-0 bg-primary-900/90 rounded-xl opacity-0 transition-opacity duration-300 flex flex-col items-center justify-center p-4"
                            :class="isHovered ? 'opacity-100' : 'opacity-0'">
                            <h4 class="text-white font-bold text-lg mb-2">Paramount</h4>
                            <div class="flex space-x-3 mb-3">
                                <a href="#" class="text-white/80 hover:text-white transition-colors duration-300">
                                    <i data-lucide="instagram" class="w-5 h-5"></i>
                                </a>
                                <a href="#" class="text-white/80 hover:text-white transition-colors duration-300">
                                    <i data-lucide="twitter" class="w-5 h-5"></i>
                                </a>
                                <a href="#" class="text-white/80 hover:text-white transition-colors duration-300">
                                    <i data-lucide="facebook" class="w-5 h-5"></i>
                                </a>
                            </div>
                            <a href="#" class="text-xs text-white/80 hover:text-white underline">Visit Website</a>
                        </div>
                    </div>
                </div>

                <!-- Second Row -->
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-8 items-center mt-8 max-w-3xl mx-auto">
                    <!-- Partner 6 - C&B -->
                    <div class="group relative aspect-w-4 aspect-h-3 p-6 bg-white rounded-xl transition-all duration-500 hover:shadow-xl border border-gray-100"
                        x-data="{ isHovered: false }" @mouseenter="isHovered = true" @mouseleave="isHovered = false">
                        <!-- Logo -->
                        <div class="flex items-center justify-center h-full">
                            <img src="temp/assets/img/home-2/img/team/6.jpg" alt="C&B"
                                class="max-h-16 max-w-full object-contain transition-transform duration-500"
                                :class="isHovered ? 'scale-110' : ''">
                        </div>

                        <!-- Overlay (visible on hover) -->
                        <div class="absolute inset-0 bg-primary-900/90 rounded-xl opacity-0 transition-opacity duration-300 flex flex-col items-center justify-center p-4"
                            :class="isHovered ? 'opacity-100' : 'opacity-0'">
                            <h4 class="text-white font-bold text-lg mb-2">C & B</h4>
                            <div class="flex space-x-3 mb-3">
                                <a href="#" class="text-white/80 hover:text-white transition-colors duration-300">
                                    <i data-lucide="instagram" class="w-5 h-5"></i>
                                </a>
                                <a href="#" class="text-white/80 hover:text-white transition-colors duration-300">
                                    <i data-lucide="twitter" class="w-5 h-5"></i>
                                </a>
                                <a href="#" class="text-white/80 hover:text-white transition-colors duration-300">
                                    <i data-lucide="facebook" class="w-5 h-5"></i>
                                </a>
                            </div>
                            <a href="#" class="text-xs text-white/80 hover:text-white underline">Visit Website</a>
                        </div>
                    </div>

                    <!-- Partner 7 - Tommy -->
                    <div class="group relative aspect-w-4 aspect-h-3 p-6 bg-white rounded-xl transition-all duration-500 hover:shadow-xl border border-gray-100"
                        x-data="{ isHovered: false }" @mouseenter="isHovered = true" @mouseleave="isHovered = false">
                        <!-- Logo -->
                        <div class="flex items-center justify-center h-full">
                            <img src="temp/assets/img/home-2/img/team/7.jpg" alt="Tommy"
                                class="max-h-16 max-w-full object-contain transition-transform duration-500"
                                :class="isHovered ? 'scale-110' : ''">
                        </div>

                        <!-- Overlay (visible on hover) -->
                        <div class="absolute inset-0 bg-primary-900/90 rounded-xl opacity-0 transition-opacity duration-300 flex flex-col items-center justify-center p-4"
                            :class="isHovered ? 'opacity-100' : 'opacity-0'">
                            <h4 class="text-white font-bold text-lg mb-2">Tommy</h4>
                            <div class="flex space-x-3 mb-3">
                                <a href="#" class="text-white/80 hover:text-white transition-colors duration-300">
                                    <i data-lucide="instagram" class="w-5 h-5"></i>
                                </a>
                                <a href="#" class="text-white/80 hover:text-white transition-colors duration-300">
                                    <i data-lucide="twitter" class="w-5 h-5"></i>
                                </a>
                                <a href="#" class="text-white/80 hover:text-white transition-colors duration-300">
                                    <i data-lucide="facebook" class="w-5 h-5"></i>
                                </a>
                            </div>
                            <a href="#" class="text-xs text-white/80 hover:text-white underline">Visit Website</a>
                        </div>
                    </div>

                    <!-- Partner 8 - New Partner -->
                    <div class="group relative aspect-w-4 aspect-h-3 p-6 bg-white rounded-xl transition-all duration-500 hover:shadow-xl border border-gray-100"
                        x-data="{ isHovered: false }" @mouseenter="isHovered = true" @mouseleave="isHovered = false">
                        <!-- Logo -->
                        <div class="flex items-center justify-center h-full">
                            <img src="temp/assets/img/home-2/img/team/1.jpg" alt="Universal"
                                class="max-h-16 max-w-full object-contain transition-transform duration-500"
                                :class="isHovered ? 'scale-110' : ''">
                        </div>

                        <!-- Overlay (visible on hover) -->
                        <div class="absolute inset-0 bg-primary-900/90 rounded-xl opacity-0 transition-opacity duration-300 flex flex-col items-center justify-center p-4"
                            :class="isHovered ? 'opacity-100' : 'opacity-0'">
                            <h4 class="text-white font-bold text-lg mb-2">Universal</h4>
                            <div class="flex space-x-3 mb-3">
                                <a href="#" class="text-white/80 hover:text-white transition-colors duration-300">
                                    <i data-lucide="instagram" class="w-5 h-5"></i>
                                </a>
                                <a href="#" class="text-white/80 hover:text-white transition-colors duration-300">
                                    <i data-lucide="twitter" class="w-5 h-5"></i>
                                </a>
                                <a href="#" class="text-white/80 hover:text-white transition-colors duration-300">
                                    <i data-lucide="facebook" class="w-5 h-5"></i>
                                </a>
                            </div>
                            <a href="#" class="text-xs text-white/80 hover:text-white underline">Visit Website</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Partnership Benefits -->
            <div class="max-w-4xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Benefit 1 -->
                    <div
                        class="bg-white rounded-xl p-6 shadow-md border border-gray-100 hover:shadow-lg transition-shadow duration-300">
                        <div
                            class="w-12 h-12 flex items-center justify-center rounded-full bg-primary-100 text-primary-600 mb-4">
                            <i data-lucide="handshake" class="w-6 h-6"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Strategic Partnerships</h3>
                        <p class="text-gray-600">
                            We form strategic alliances with leading entertainment companies to provide premium celebrity
                            experiences.
                        </p>
                    </div>

                    <!-- Benefit 2 -->
                    <div
                        class="bg-white rounded-xl p-6 shadow-md border border-gray-100 hover:shadow-lg transition-shadow duration-300">
                        <div
                            class="w-12 h-12 flex items-center justify-center rounded-full bg-accent-100 text-accent-600 mb-4">
                            <i data-lucide="badge-check" class="w-6 h-6"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Verified Authenticity</h3>
                        <p class="text-gray-600">
                            All our celebrity partnerships are verified and authenticated to ensure genuine experiences.
                        </p>
                    </div>

                    <!-- Benefit 3 -->
                    <div
                        class="bg-white rounded-xl p-6 shadow-md border border-gray-100 hover:shadow-lg transition-shadow duration-300">
                        <div
                            class="w-12 h-12 flex items-center justify-center rounded-full bg-primary-100 text-primary-600 mb-4">
                            <i data-lucide="users" class="w-6 h-6"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Exclusive Network</h3>
                        <p class="text-gray-600">
                            Access our exclusive network of industry professionals and get connected with top-tier talent.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Partner CTA -->
            <div class="mt-12 text-center">
                <a href="#"
                    class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-lg font-medium hover:from-primary-700 hover:to-primary-800 transition-all duration-300 hover:scale-105 shadow-lg">
                    <i data-lucide="briefcase" class="w-5 h-5 mr-2"></i>
                    Become a Partner
                </a>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section id="cta" class="py-16 lg:py-24 relative overflow-hidden bg-cover bg-center"
        style="background-image: url('temp/assets/img/home-2/img/slider/fm-bg.jpg');">
        <!-- Dark Overlay -->
        <div class="absolute inset-0 bg-primary-900/80 backdrop-blur-sm"></div>

        <!-- Glass Card -->
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="bg-white/10 backdrop-blur-md rounded-3xl overflow-hidden shadow-2xl border border-white/20">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Content Side -->
                    <div class="p-8 lg:p-12">
                        <span
                            class="inline-block px-4 py-2 bg-white/20 backdrop-blur-sm border border-white/30 rounded-full text-white text-sm font-semibold mb-6">Get
                            Started Today</span>
                        <h2 class="text-3xl lg:text-5xl font-display font-bold text-white mb-6 leading-tight">
                            Become a Part of <span class="text-accent-400">Success</span>
                        </h2>
                        <p class="text-white/80 text-lg mb-8 leading-relaxed">
                            Join <?php echo e($settings->site_name); ?> today and unlock exclusive access to your favorite celebrities.
                            We're here to create unforgettable experiences and connect you with the stars you admire.
                        </p>

                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="#contact"
                                class="inline-flex items-center justify-center px-6 py-4 bg-white text-primary-700 rounded-xl font-semibold text-lg hover:bg-white/90 transition-all duration-300 hover:scale-105 shadow-xl">
                                <i data-lucide="mail" class="w-5 h-5 mr-2"></i>
                                Contact Us Now
                            </a>
                            <a href="register"
                                class="inline-flex items-center justify-center px-6 py-4 bg-accent-500 text-white rounded-xl font-semibold text-lg hover:bg-accent-600 transition-all duration-300 hover:scale-105 shadow-xl">
                                <i data-lucide="user-plus" class="w-5 h-5 mr-2"></i>
                                Create Account
                            </a>
                        </div>
                    </div>

                    <!-- Form Side -->
                    <div class="relative">
                        <!-- Contact Form -->
                        <div class="bg-white/10 backdrop-blur-md h-full p-8 lg:p-12">
                            <h3 class="text-2xl font-bold text-white mb-6">Stay Updated</h3>
                            <p class="text-white/70 mb-8">
                                Subscribe to our newsletter for the latest updates on celebrity events, exclusive offers,
                                and more.
                            </p>

                            <!-- Success/Error Messages -->
                            <?php if(session('success')): ?>
                                <div
                                    class="mb-6 p-4 bg-green-500/20 border border-green-500/30 rounded-lg text-green-100 flex items-center">
                                    <i data-lucide="check-circle" class="w-5 h-5 mr-2"></i>
                                    <?php echo e(session('success')); ?>

                                </div>
                            <?php endif; ?>

                            <?php if(session('error')): ?>
                                <div
                                    class="mb-6 p-4 bg-red-500/20 border border-red-500/30 rounded-lg text-red-100 flex items-center">
                                    <i data-lucide="alert-circle" class="w-5 h-5 mr-2"></i>
                                    <?php echo e(session('error')); ?>

                                </div>
                            <?php endif; ?>

                            <form class="space-y-6" action="<?php echo e(route('newsletter.subscribe')); ?>" method="POST"
                                id="newsletterForm">
                                <?php echo csrf_field(); ?>
                                <div>
                                    <label for="newsletter_name"
                                        class="block text-sm font-medium text-white/80 mb-2">Name</label>
                                    <input type="text" id="newsletter_name" name="name"
                                        value="<?php echo e(old('name')); ?>"
                                        class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-accent-400 focus:border-transparent transition-colors"
                                        placeholder="Your Name" required>
                                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="text-red-300 text-xs mt-1"><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div>
                                    <label for="newsletter_email"
                                        class="block text-sm font-medium text-white/80 mb-2">Email</label>
                                    <input type="email" id="newsletter_email" name="email"
                                        value="<?php echo e(old('email')); ?>"
                                        class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-lg text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-accent-400 focus:border-transparent transition-colors"
                                        placeholder="Your Email" required>
                                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="text-red-300 text-xs mt-1"><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="marketing_consent" value="1"
                                            class="form-checkbox h-5 w-5 text-accent-500"
                                            <?php echo e(old('marketing_consent') ? 'checked' : ''); ?>>
                                        <span class="ml-2 text-sm text-white/80">I agree to receive marketing
                                            communications</span>
                                    </label>
                                </div>

                                <button type="submit"
                                    class="w-full inline-flex items-center justify-center px-6 py-3 bg-accent-500 text-white rounded-lg font-medium hover:bg-accent-600 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed"
                                    id="subscribeBtn">
                                    <i data-lucide="send" class="w-5 h-5 mr-2"></i>
                                    <span class="btn-text">Subscribe Now</span>
                                </button>
                            </form>

                            <div class="mt-6 text-center">
                                <p class="text-sm text-white/60">
                                    By subscribing, you agree to our
                                    <a href="#"
                                        class="underline text-white/80 hover:text-white transition-colors">Privacy
                                        Policy</a>
                                    and
                                    <a href="#"
                                        class="underline text-white/80 hover:text-white transition-colors">Terms of
                                        Service</a>.
                                </p>
                            </div>
                        </div>

                        <!-- Decorative Elements -->
                        <div class="absolute top-0 right-0 w-24 h-24 bg-accent-500/30 rounded-full filter blur-2xl"></div>
                        <div class="absolute bottom-0 left-0 w-32 h-32 bg-primary-500/30 rounded-full filter blur-2xl">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Trust Badges -->
            <div class="mt-12 grid grid-cols-2 md:grid-cols-4 gap-8 items-center justify-center">
                <div class="flex flex-col items-center text-center">
                    <div
                        class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center mb-3">
                        <i data-lucide="shield" class="w-6 h-6 text-white"></i>
                    </div>
                    <span class="text-white/80 text-sm">Secure Payments</span>
                </div>
                <div class="flex flex-col items-center text-center">
                    <div
                        class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center mb-3">
                        <i data-lucide="check-circle" class="w-6 h-6 text-white"></i>
                    </div>
                    <span class="text-white/80 text-sm">Verified Celebrities</span>
                </div>
                <div class="flex flex-col items-center text-center">
                    <div
                        class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center mb-3">
                        <i data-lucide="headphones" class="w-6 h-6 text-white"></i>
                    </div>
                    <span class="text-white/80 text-sm">24/7 Support</span>
                </div>
                <div class="flex flex-col items-center text-center">
                    <div
                        class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center mb-3">
                        <i data-lucide="thumbs-up" class="w-6 h-6 text-white"></i>
                    </div>
                    <span class="text-white/80 text-sm">100% Satisfaction</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="py-16 lg:py-24 bg-gray-50 relative overflow-hidden">
        <!-- Decorative Elements -->
        <div
            class="absolute top-0 right-0 w-64 h-64 bg-primary-100 rounded-full opacity-70 -translate-y-1/2 translate-x-1/4">
        </div>
        <div
            class="absolute bottom-0 left-0 w-96 h-96 bg-accent-100 rounded-full opacity-70 translate-y-1/2 -translate-x-1/4">
        </div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Section Header -->
            <div class="max-w-3xl mx-auto text-center mb-16">
                <span
                    class="bg-gradient-to-r from-primary-500 to-accent-500 bg-clip-text text-transparent text-sm font-bold tracking-wider uppercase mb-2 inline-block">TESTIMONIALS</span>
                <h2 class="text-4xl lg:text-5xl font-display font-bold text-gray-900 mb-4">What Our Clients Say</h2>
                <p class="text-lg text-gray-600">Discover inspiring testimonials from our satisfied clients who have
                    created memorable experiences with celebrities through our platform.</p>
            </div>

            <!-- Testimonials Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8" x-data="{ activeTestimonial: null }">
                <!-- Testimonial 1 -->
                <div class="relative rounded-2xl shadow-xl overflow-hidden transition-all duration-300 group hover:-translate-y-2"
                    x-on:mouseenter="activeTestimonial = 1" x-on:mouseleave="activeTestimonial = null">
                    <!-- Card Content -->
                    <div class="bg-white p-8 relative z-10 h-full flex flex-col">
                        <!-- Quote Icon -->
                        <div class="text-primary-100 mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M3 21c3 0 7-1 7-8V5c0-1.25-.756-2.017-2-2H4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2 1 0 1 0 1 1v1c0 1-1 2-2 2s-1 .008-1 1.031V20c0 1 0 1 1 1z">
                                </path>
                                <path
                                    d="M15 21c3 0 7-1 7-8V5c0-1.25-.757-2.017-2-2h-4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2h.75c0 2.25.25 4-2.75 4v3c0 1 0 1 1 1z">
                                </path>
                            </svg>
                        </div>

                        <!-- Rating -->
                        <div class="flex mb-4">
                            <i data-lucide="star" class="w-5 h-5 text-yellow-500 fill-current"></i>
                            <i data-lucide="star" class="w-5 h-5 text-yellow-500 fill-current"></i>
                            <i data-lucide="star" class="w-5 h-5 text-yellow-500 fill-current"></i>
                            <i data-lucide="star" class="w-5 h-5 text-yellow-500 fill-current"></i>
                            <i data-lucide="star" class="w-5 h-5 text-yellow-500 fill-current"></i>
                        </div>

                        <!-- Testimonial Text -->
                        <p class="text-gray-600 italic mb-6 flex-grow">
                            They possess great flexibility and approachability, and can adapt to my schedule, emphasizing
                            the importance of trust.
                        </p>

                        <!-- Author Info -->
                        <div class="flex items-center">
                            <div
                                class="w-12 h-12 rounded-full overflow-hidden border-2 border-primary-500 mr-4 flex-shrink-0">
                                <img src="temp/assets/img/home-2/img/about/tst1.jpg" alt="James"
                                    class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-gray-900">James</h4>
                                <p class="text-gray-500 text-sm">Satisfied Client</p>
                            </div>
                        </div>
                    </div>

                    <!-- Background Gradient -->
                    <div class="absolute inset-0 bg-gradient-to-r from-primary-500/5 to-accent-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                        :class="{ 'opacity-100': activeTestimonial === 1 }"></div>

                    <!-- Border Gradient -->
                    <div class="absolute inset-x-0 bottom-0 h-1 bg-gradient-to-r from-primary-500 to-accent-500 transform origin-left scale-x-0 group-hover:scale-x-100 transition-transform duration-300"
                        :class="{ 'scale-x-100': activeTestimonial === 1 }"></div>
                </div>

                <!-- Testimonial 2 -->
                <div class="relative rounded-2xl shadow-xl overflow-hidden transition-all duration-300 group hover:-translate-y-2"
                    x-on:mouseenter="activeTestimonial = 2" x-on:mouseleave="activeTestimonial = null">
                    <!-- Card Content -->
                    <div class="bg-white p-8 relative z-10 h-full flex flex-col">
                        <!-- Quote Icon -->
                        <div class="text-primary-100 mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M3 21c3 0 7-1 7-8V5c0-1.25-.756-2.017-2-2H4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2 1 0 1 0 1 1v1c0 1-1 2-2 2s-1 .008-1 1.031V20c0 1 0 1 1 1z">
                                </path>
                                <path
                                    d="M15 21c3 0 7-1 7-8V5c0-1.25-.757-2.017-2-2h-4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2h.75c0 2.25.25 4-2.75 4v3c0 1 0 1 1 1z">
                                </path>
                            </svg>
                        </div>

                        <!-- Rating -->
                        <div class="flex mb-4">
                            <i data-lucide="star" class="w-5 h-5 text-yellow-500 fill-current"></i>
                            <i data-lucide="star" class="w-5 h-5 text-yellow-500 fill-current"></i>
                            <i data-lucide="star" class="w-5 h-5 text-yellow-500 fill-current"></i>
                            <i data-lucide="star" class="w-5 h-5 text-yellow-500 fill-current"></i>
                            <i data-lucide="star" class="w-5 h-5 text-yellow-500 fill-current"></i>
                        </div>

                        <!-- Testimonial Text -->
                        <p class="text-gray-600 italic mb-6 flex-grow">
                            I've used this platform multiple times, and it never disappoints! The user interface is easy to
                            navigate, and the search results are always accurate. Plus, their customer service is top-notch,
                            always ready to assist me with any questions or concerns.
                        </p>

                        <!-- Author Info -->
                        <div class="flex items-center">
                            <div
                                class="w-12 h-12 rounded-full overflow-hidden border-2 border-primary-500 mr-4 flex-shrink-0">
                                <img src="temp/assets/img/home-2/img/about/tst2.jpg" alt="Mirabel"
                                    class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-gray-900">Mirabel</h4>
                                <p class="text-gray-500 text-sm">Repeat Customer</p>
                            </div>
                        </div>
                    </div>

                    <!-- Background Gradient -->
                    <div class="absolute inset-0 bg-gradient-to-r from-primary-500/5 to-accent-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                        :class="{ 'opacity-100': activeTestimonial === 2 }"></div>

                    <!-- Border Gradient -->
                    <div class="absolute inset-x-0 bottom-0 h-1 bg-gradient-to-r from-primary-500 to-accent-500 transform origin-left scale-x-0 group-hover:scale-x-100 transition-transform duration-300"
                        :class="{ 'scale-x-100': activeTestimonial === 2 }"></div>
                </div>

                <!-- Testimonial 3 -->
                <div class="relative rounded-2xl shadow-xl overflow-hidden transition-all duration-300 group hover:-translate-y-2"
                    x-on:mouseenter="activeTestimonial = 3" x-on:mouseleave="activeTestimonial = null">
                    <!-- Card Content -->
                    <div class="bg-white p-8 relative z-10 h-full flex flex-col">
                        <!-- Quote Icon -->
                        <div class="text-primary-100 mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path
                                    d="M3 21c3 0 7-1 7-8V5c0-1.25-.756-2.017-2-2H4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2 1 0 1 0 1 1v1c0 1-1 2-2 2s-1 .008-1 1.031V20c0 1 0 1 1 1z">
                                </path>
                                <path
                                    d="M15 21c3 0 7-1 7-8V5c0-1.25-.757-2.017-2-2h-4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2h.75c0 2.25.25 4-2.75 4v3c0 1 0 1 1 1z">
                                </path>
                            </svg>
                        </div>

                        <!-- Rating -->
                        <div class="flex mb-4">
                            <i data-lucide="star" class="w-5 h-5 text-yellow-500 fill-current"></i>
                            <i data-lucide="star" class="w-5 h-5 text-yellow-500 fill-current"></i>
                            <i data-lucide="star" class="w-5 h-5 text-yellow-500 fill-current"></i>
                            <i data-lucide="star" class="w-5 h-5 text-yellow-500 fill-current"></i>
                            <i data-lucide="star" class="w-5 h-5 text-yellow-500 fill-current"></i>
                        </div>

                        <!-- Testimonial Text -->
                        <p class="text-gray-600 italic mb-6 flex-grow">
                            I can't say enough good things about this website. From the moment I landed on their site, I was
                            impressed by how easy it was to use it. Good job!
                        </p>

                        <!-- Author Info -->
                        <div class="flex items-center">
                            <div
                                class="w-12 h-12 rounded-full overflow-hidden border-2 border-primary-500 mr-4 flex-shrink-0">
                                <img src="temp/assets/img/home-2/img/about/tst3.jpg" alt="Felix"
                                    class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-gray-900">Felix</h4>
                                <p class="text-gray-500 text-sm">Event Organizer</p>
                            </div>
                        </div>
                    </div>

                    <!-- Background Gradient -->
                    <div class="absolute inset-0 bg-gradient-to-r from-primary-500/5 to-accent-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                        :class="{ 'opacity-100': activeTestimonial === 3 }"></div>

                    <!-- Border Gradient -->
                    <div class="absolute inset-x-0 bottom-0 h-1 bg-gradient-to-r from-primary-500 to-accent-500 transform origin-left scale-x-0 group-hover:scale-x-100 transition-transform duration-300"
                        :class="{ 'scale-x-100': activeTestimonial === 3 }"></div>
                </div>
            </div>

            <!-- Add Testimonial Section -->
            <div class="mt-16 text-center">
                <a href="#"
                    class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-white border border-gray-300 rounded-lg text-primary-700 font-medium hover:bg-gray-50 transition-colors">
                    <i data-lucide="message-square" class="w-5 h-5"></i>
                    <span>Share Your Experience</span>
                </a>
                <p class="mt-4 text-sm text-gray-500">Have you worked with us? We'd love to hear your story!</p>
            </div>

            <!-- Ratings Overview -->
            <div class="mt-20 bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="grid grid-cols-1 md:grid-cols-4">
                    <!-- Rating Metric 1 -->
                    <div class="p-8 text-center border-b md:border-b-0 md:border-r border-gray-200">
                        <div class="text-5xl font-bold text-primary-600 mb-2">4.9</div>
                        <div class="flex justify-center mb-3">
                            <i data-lucide="star" class="w-5 h-5 text-yellow-500 fill-current"></i>
                            <i data-lucide="star" class="w-5 h-5 text-yellow-500 fill-current"></i>
                            <i data-lucide="star" class="w-5 h-5 text-yellow-500 fill-current"></i>
                            <i data-lucide="star" class="w-5 h-5 text-yellow-500 fill-current"></i>
                            <i data-lucide="star" class="w-5 h-5 text-yellow-500 fill-current"></i>
                        </div>
                        <p class="text-gray-500 text-sm">Average Rating</p>
                    </div>

                    <!-- Rating Metric 2 -->
                    <div class="p-8 text-center border-b md:border-b-0 md:border-r border-gray-200">
                        <div class="text-5xl font-bold text-primary-600 mb-2">500+</div>
                        <div class="flex justify-center mb-3">
                            <i data-lucide="users" class="w-6 h-6 text-primary-500"></i>
                        </div>
                        <p class="text-gray-500 text-sm">Happy Clients</p>
                    </div>

                    <!-- Rating Metric 3 -->
                    <div class="p-8 text-center border-b md:border-b-0 md:border-r border-gray-200">
                        <div class="text-5xl font-bold text-primary-600 mb-2">95%</div>
                        <div class="flex justify-center mb-3">
                            <i data-lucide="repeat" class="w-6 h-6 text-primary-500"></i>
                        </div>
                        <p class="text-gray-500 text-sm">Repeat Bookings</p>
                    </div>

                    <!-- Rating Metric 4 -->
                    <div class="p-8 text-center">
                        <div class="text-5xl font-bold text-primary-600 mb-2">100%</div>
                        <div class="flex justify-center mb-3">
                            <i data-lucide="shield-check" class="w-6 h-6 text-primary-500"></i>
                        </div>
                        <p class="text-gray-500 text-sm">Satisfaction Guaranteed</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const newsletterForm = document.getElementById('newsletterForm');
        const subscribeBtn = document.getElementById('subscribeBtn');

        if (newsletterForm && subscribeBtn) {
            const btnText = subscribeBtn.querySelector('.btn-text');

            newsletterForm.addEventListener('submit', function(e) {
                // Disable button to prevent double submission
                subscribeBtn.disabled = true;
                if (btnText) btnText.textContent = 'Subscribing...';

                // Re-enable after 3 seconds in case of slow response
                setTimeout(() => {
                    if (subscribeBtn.disabled) {
                        subscribeBtn.disabled = false;
                        if (btnText) btnText.textContent = 'Subscribe Now';
                    }
                }, 3000);
            });
        }
    });
</script><?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.base1', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/user/Desktop/Websites/Broker/Celebrity/Celebrity/resources/views/home/index.blade.php ENDPATH**/ ?>