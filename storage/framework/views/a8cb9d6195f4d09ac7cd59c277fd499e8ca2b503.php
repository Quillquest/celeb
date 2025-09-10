<!DOCTYPE html>
<html lang="en" class="scroll-smooth" :class="{ 'dark': darkMode }" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' || false }" x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($settings->site_name); ?> - Book Your Favorite Celebrity</title>
    <meta name="description"
        content="<?php echo e($settings->site_name); ?>, Book your favorite celebrity, make reservations, get tickets and lots more">
    <meta name="keywords"
        content="<?php echo e($settings->site_name); ?>, Book your favorite celebrity, make reservations, get tickets and lots more">

    <!-- Favicons -->
    <link href="<?php echo e(asset('storage/' . $settings->favicon)); ?>" rel="icon">
    <link href="<?php echo e(asset('storage/' . $settings->favicon)); ?>" rel="apple-touch-icon">

    <!-- TailwindCSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                        },
                        accent: {
                            500: '#f59e0b',
                            600: '#d97706',
                        }
                    },
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', 'sans-serif'],
                        'display': ['Poppins', 'system-ui', 'sans-serif'],
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'slide-up': 'slideUp 0.6s ease-out',
                        'scale-in': 'scaleIn 0.4s ease-out',
                        'float': 'float 6s ease-in-out infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': {
                                opacity: '0'
                            },
                            '100%': {
                                opacity: '1'
                            },
                        },
                        slideUp: {
                            '0%': {
                                transform: 'translateY(30px)',
                                opacity: '0'
                            },
                            '100%': {
                                transform: 'translateY(0)',
                                opacity: '1'
                            },
                        },
                        scaleIn: {
                            '0%': {
                                transform: 'scale(0.95)',
                                opacity: '0'
                            },
                            '100%': {
                                transform: 'scale(1)',
                                opacity: '1'
                            },
                        },
                        float: {
                            '0%, 100%': {
                                transform: 'translateY(0px)'
                            },
                            '50%': {
                                transform: 'translateY(-20px)'
                            },
                        }
                    }
                }
            }
        }
    </script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Atlantis / Dash styles (make available on public pages) -->
    <script src="<?php echo e(asset('dash/js/plugin/webfont/webfont.min.js')); ?>"></script>
    <link rel="stylesheet" href="<?php echo e(asset('dash/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('dash/css/fonts.min.css')); ?>">
    <?php
        $theme = $settings->website_theme == 'blue.css' ? 'atlantis.min.css' : $settings->website_theme;
    ?>
    <link rel="stylesheet" href="<?php echo e(asset('dash/css/' . $theme)); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('dash/css/customs.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('dash/css/style.css')); ?>">

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Google Translate -->
    <div class="gtranslate_wrapper"></div>
    <script>
        window.gtranslateSettings = {
            "default_language": "en",
            "detect_browser_language": true,
            "languages": ["en", "fr", "de", "it", "es", "el", "ja", "ko", "ro", "pt", "id", "tr"],
            "wrapper_selector": ".gtranslate_wrapper",
            "switcher_horizontal_position": "right",
            "switcher_vertical_position": "top"
        }
    </script>
    <script src="https://cdn.gtranslate.net/widgets/latest/float.html" defer></script>

    <!-- Custom Styles -->
    <style>
        [x-cloak] {
            display: none !important;
        }

        .glass-effect {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .gradient-text {
            background: linear-gradient(135deg, #0ea5e9 0%, #f59e0b 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-bg {
            background: linear-gradient(135deg, #0c4a6e 0%, #075985 50%, #0369a1 100%);
        }

        .scroll-smooth {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="font-sans text-gray-900 antialiased" x-data="{
    mobileMenuOpen: false,
    scrolled: false,
    init() {
        window.addEventListener('scroll', () => {
            this.scrolled = window.scrollY > 50;
        });
    }
}" x-init="init()">

    <!-- Loading Spinner -->
    <div id="loader" class="fixed inset-0 z-50 flex items-center justify-center bg-white" x-data="{ loading: true }"
        x-show="loading" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" x-init="setTimeout(() => loading = false, 1000)">
        <div class="relative">
            <div class="w-16 h-16 border-4 border-primary-200 border-t-primary-600 rounded-full animate-spin"></div>
            <div class="absolute inset-0 flex items-center justify-center">
                <i data-lucide="star" class="w-6 h-6 text-primary-600"></i>
            </div>
        </div>
    </div>

    <!-- Back to Top Button -->
    <button x-show="scrolled" @click="window.scrollTo({top: 0, behavior: 'smooth'})"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95 translate-y-2"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        class="fixed bottom-6 right-6 z-40 p-3 bg-primary-600 text-white rounded-full shadow-lg hover:bg-primary-700 transition-all duration-300 hover:scale-110"
        aria-label="Back to top">
        <i data-lucide="chevron-up" class="w-5 h-5"></i>
    </button>

    <!-- Header -->
    <header class="fixed top-0 left-0 right-0 z-40 transition-all duration-300 mb-4"
        :class="scrolled ? 'bg-white dark:bg-gray-900 shadow-lg' : 'bg-white/95 dark:bg-gray-900/95 backdrop-blur-md shadow-sm'">
        <nav class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 lg:h-20">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="<?php echo e(route('home')); ?>" class="flex items-center space-x-2">
                        <img src="<?php echo e(asset('storage/' . $settings->logo)); ?>" alt="<?php echo e($settings->site_name); ?>"
                            class="h-8 lg:h-10 w-auto">
                        <!-- <span class="text-xl lg:text-2xl font-display font-bold text-gray-900 hidden sm:block"><?php echo e($settings->site_name); ?></span> -->
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden lg:flex items-center space-x-8">
                    <a href="<?php echo e(route('home')); ?>"
                        class="text-gray-800 hover:text-primary-600 transition-colors duration-300 font-medium">Home</a>
                    <a href="#about"
                        class="text-gray-800 hover:text-primary-600 transition-colors duration-300 font-medium">About</a>

                    <!-- Services Dropdown -->
                    <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                        <button
                            class="text-gray-800 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 transition-colors duration-300 font-medium flex items-center">
                            Services
                            <i data-lucide="chevron-down" class="w-4 h-4 ml-1 transition-transform duration-200"
                                :class="open ? 'rotate-180' : ''"></i>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                            class="absolute top-full left-0 mt-2 w-56 bg-white dark:bg-gray-800 rounded-lg shadow-xl border border-gray-100 dark:border-gray-700 py-2"
                            x-cloak>
                            <a href="<?php echo e(route('book')); ?>"
                                class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                <i data-lucide="credit-card" class="w-4 h-4 mr-3 text-primary-600"></i>
                                Apply for VIP Fan Card
                            </a>
                            <a href="<?php echo e(route('book')); ?>"
                                class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                <i data-lucide="heart" class="w-4 h-4 mr-3 text-primary-600"></i>
                                Make Donations
                            </a>
                            <a href="<?php echo e(route('book')); ?>"
                                class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                <i data-lucide="calendar" class="w-4 h-4 mr-3 text-primary-600"></i>
                                Reservations
                            </a>
                            <a href="<?php echo e(route('book')); ?>"
                                class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                <i data-lucide="users" class="w-4 h-4 mr-3 text-primary-600"></i>
                                Meet & Greet
                            </a>
                        </div>
                    </div>

                    <a href="#brands"
                        class="text-gray-800 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 transition-colors duration-300 font-medium">Brands</a>
                    <a href="<?php echo e(route('contact')); ?>"
                        class="text-gray-800 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 transition-colors duration-300 font-medium">Contact</a>
                </div>

                <!-- CTA Button, Auth Links & Mobile Menu Toggle -->
                <div class="flex items-center space-x-4">
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(route('user.dashboard')); ?>"
                            class="text-gray-800 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 transition-colors duration-300 font-medium">Dashboard</a>
                        <form method="POST" action="<?php echo e(route('logout')); ?>" class="inline">
                            <?php echo csrf_field(); ?>
                            <button type="submit"
                                class="text-gray-800 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 transition-colors duration-300 font-medium">
                                Logout
                            </button>
                        </form>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>"
                            class="text-gray-800 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 transition-colors duration-300 font-medium">Login</a>
                        <a href="<?php echo e(route('register')); ?>"
                            class="text-gray-800 dark:text-gray-200 hover:text-primary-600 dark:hover:text-primary-400 transition-colors duration-300 font-medium">Register</a>
                    <?php endif; ?>

                    <!-- Dark Mode Toggle -->
                    <button @click="darkMode = !darkMode"
                        class="p-2 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors duration-300">
                        <i data-lucide="sun" class="w-5 h-5" x-show="darkMode"></i>
                        <i data-lucide="moon" class="w-5 h-5" x-show="!darkMode"></i>
                    </button>

                    <a href="<?php echo e(route('book')); ?>"
                        class="hidden sm:inline-flex items-center px-6 py-2 bg-accent-500 text-white rounded-full font-medium hover:bg-accent-600 transition-all duration-300 hover:scale-105 shadow-lg">
                        <i data-lucide="star" class="w-4 h-4 mr-2"></i>
                        Book Now
                    </a>

                    <!-- Mobile Menu Button -->
                    <button @click="mobileMenuOpen = !mobileMenuOpen"
                        class="lg:hidden p-2 text-gray-800 hover:text-accent-500 transition-colors duration-300"
                        aria-label="Toggle mobile menu">
                        <i data-lucide="menu" class="w-6 h-6" x-show="!mobileMenuOpen"></i>
                        <i data-lucide="x" class="w-6 h-6" x-show="mobileMenuOpen" x-cloak></i>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2"
                class="lg:hidden bg-white dark:bg-gray-800 rounded-lg shadow-xl border border-gray-100 dark:border-gray-700 mt-4 overflow-hidden"
                x-cloak>
                <div class="px-4 py-6 space-y-4">
                    <a href="<?php echo e(route('home')); ?>"
                        class="block text-gray-900 dark:text-gray-100 hover:text-primary-600 dark:hover:text-primary-400 font-medium transition-colors duration-300">Home</a>
                    <a href="#about"
                        class="block text-gray-900 dark:text-gray-100 hover:text-primary-600 dark:hover:text-primary-400 font-medium transition-colors duration-300">About</a>
                    <div class="space-y-2">
                        <div class="text-gray-900 dark:text-gray-100 font-medium">Services</div>
                        <div class="pl-4 space-y-2">
                            <a href="<?php echo e(route('book')); ?>"
                                class="block text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors duration-300">Apply
                                for VIP Fan Card</a>
                            <a href="<?php echo e(route('book')); ?>"
                                class="block text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors duration-300">Make
                                Donations</a>
                            <a href="<?php echo e(route('book')); ?>"
                                class="block text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors duration-300">Reservations</a>
                            <a href="<?php echo e(route('book')); ?>"
                                class="block text-gray-600 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors duration-300">Meet
                                & Greet</a>
                        </div>
                    </div>
                    <a href="#brands"
                        class="block text-gray-900 dark:text-gray-100 hover:text-primary-600 dark:hover:text-primary-400 font-medium transition-colors duration-300">Brands</a>
                    <a href="<?php echo e(route('contact')); ?>"
                        class="block text-gray-900 dark:text-gray-100 hover:text-primary-600 dark:hover:text-primary-400 font-medium transition-colors duration-300">Contact</a>

                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(route('user.dashboard')); ?>"
                            class="block text-gray-900 dark:text-gray-100 hover:text-primary-600 dark:hover:text-primary-400 font-medium transition-colors duration-300 mt-2">Dashboard</a>
                        <form method="POST" action="<?php echo e(route('logout')); ?>" class="block mt-2">
                            <?php echo csrf_field(); ?>
                            <button type="submit"
                                class="text-gray-900 dark:text-gray-100 hover:text-primary-600 dark:hover:text-primary-400 font-medium transition-colors duration-300">
                                Logout
                            </button>
                        </form>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>"
                            class="block text-gray-900 dark:text-gray-100 hover:text-primary-600 dark:hover:text-primary-400 font-medium transition-colors duration-300 mt-2">Login</a>
                        <a href="<?php echo e(route('register')); ?>"
                            class="block text-gray-900 dark:text-gray-100 hover:text-primary-600 dark:hover:text-primary-400 font-medium transition-colors duration-300 mt-1">Register</a>
                    <?php endif; ?>

                    <!-- Dark Mode Toggle for Mobile -->
                    <button @click="darkMode = !darkMode"
                        class="flex items-center gap-2 mt-4 p-3 rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors duration-300">
                        <i data-lucide="sun" class="w-5 h-5" x-show="darkMode"></i>
                        <i data-lucide="moon" class="w-5 h-5" x-show="!darkMode"></i>
                        <span x-text="darkMode ? 'Light Mode' : 'Dark Mode'"></span>
                    </button>

                    <a href="<?php echo e(route('book')); ?>"
                        class="inline-flex items-center px-6 py-3 bg-accent-500 text-white rounded-full font-medium hover:bg-accent-600 transition-all duration-300 mt-4">
                        <i data-lucide="star" class="w-4 h-4 mr-2"></i>
                        Book Now
                    </a>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <?php echo $__env->yieldContent('content'); ?>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white relative overflow-hidden">
        <!-- Decorative Background -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute top-10 left-10 w-32 h-32 bg-primary-500 rounded-full blur-3xl"></div>
            <div class="absolute bottom-10 right-10 w-40 h-40 bg-accent-500 rounded-full blur-3xl"></div>
        </div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="py-16">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Company Info -->
                    <div class="lg:col-span-2">
                        <div class="flex items-center space-x-3 mb-6">
                            <img src="<?php echo e(asset('storage/' . $settings->logo)); ?>" alt="<?php echo e($settings->site_name); ?>"
                                class="h-10 w-auto">
                            <span class="text-2xl font-display font-bold"><?php echo e($settings->site_name); ?></span>
                        </div>
                        <p class="text-gray-300 mb-6 leading-relaxed">Connect with your favorite celebrities. Book meet
                            & greets, get VIP access, and create unforgettable memories with the stars you love.</p>

                        <!-- Contact Info -->
                        <div class="space-y-3" id="contact">
                            <div class="flex items-center space-x-3 text-gray-300">
                                <i data-lucide="map-pin" class="w-5 h-5 text-primary-500 flex-shrink-0"></i>
                                <span>30 Commercial Road, Fratton, Australia</span>
                            </div>
                            <div class="flex items-center space-x-3 text-gray-300">
                                <i data-lucide="phone" class="w-5 h-5 text-primary-500 flex-shrink-0"></i>
                                <span>+1 (555) 000-0000</span>
                            </div>
                            <div class="flex items-center space-x-3 text-gray-300">
                                <i data-lucide="mail" class="w-5 h-5 text-primary-500 flex-shrink-0"></i>
                                <span><?php echo e($settings->contact_email); ?></span>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h3 class="text-lg font-semibold mb-6">Quick Links</h3>
                        <ul class="space-y-3">
                            <li><a href="<?php echo e(route('home')); ?>"
                                    class="text-gray-300 hover:text-primary-400 transition-colors duration-300 flex items-center group">
                                    <i data-lucide="chevron-right"
                                        class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform duration-300"></i>
                                    Home
                                </a></li>
                            <li><a href="#about"
                                    class="text-gray-300 hover:text-primary-400 transition-colors duration-300 flex items-center group">
                                    <i data-lucide="chevron-right"
                                        class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform duration-300"></i>
                                    About Us
                                </a></li>
                            <li><a href="#brands"
                                    class="text-gray-300 hover:text-primary-400 transition-colors duration-300 flex items-center group">
                                    <i data-lucide="chevron-right"
                                        class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform duration-300"></i>
                                    Brands
                                </a></li>
                            <li><a href="<?php echo e(route('book')); ?>"
                                    class="text-gray-300 hover:text-primary-400 transition-colors duration-300 flex items-center group">
                                    <i data-lucide="chevron-right"
                                        class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform duration-300"></i>
                                    Book Celebrity
                                </a></li>
                        </ul>
                    </div>

                    <!-- Newsletter -->
                    <div>
                        <h3 class="text-lg font-semibold mb-6">Newsletter</h3>
                        <p class="text-gray-300 mb-4">Subscribe to get the latest celebrity news and exclusive offers.
                        </p>
                        <form class="space-y-3" action="#" method="GET">
                            <div class="relative">
                                <input type="email" placeholder="Your email address"
                                    class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-white placeholder-gray-400 focus:border-primary-500 focus:ring-1 focus:ring-primary-500 transition-colors duration-300"
                                    required>
                            </div>
                            <button type="submit"
                                class="w-full px-4 py-3 bg-primary-600 text-white rounded-lg font-medium hover:bg-primary-700 transition-all duration-300 hover:scale-105 flex items-center justify-center">
                                <i data-lucide="mail" class="w-4 h-4 mr-2"></i>
                                Subscribe
                            </button>
                        </form>

                        <!-- Social Links -->
                        <div class="flex space-x-4 mt-6">
                            <a href="#"
                                class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center text-gray-300 hover:bg-primary-600 hover:text-white transition-all duration-300 hover:scale-110">
                                <i data-lucide="facebook" class="w-5 h-5"></i>
                            </a>
                            <a href="#"
                                class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center text-gray-300 hover:bg-primary-600 hover:text-white transition-all duration-300 hover:scale-110">
                                <i data-lucide="twitter" class="w-5 h-5"></i>
                            </a>
                            <a href="#"
                                class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center text-gray-300 hover:bg-primary-600 hover:text-white transition-all duration-300 hover:scale-110">
                                <i data-lucide="instagram" class="w-5 h-5"></i>
                            </a>
                            <a href="#"
                                class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center text-gray-300 hover:bg-primary-600 hover:text-white transition-all duration-300 hover:scale-110">
                                <i data-lucide="youtube" class="w-5 h-5"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="border-t border-gray-800 py-6">
                <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                    <p class="text-gray-300 text-center md:text-left">
                        © 2024 <span class="text-primary-400 font-semibold"><?php echo e($settings->site_name); ?></span>. All
                        rights reserved.
                    </p>
                    <div class="flex space-x-6 text-sm">
                        <a href="#"
                            class="text-gray-300 hover:text-primary-400 transition-colors duration-300">Terms &
                            Conditions</a>
                        <a href="#"
                            class="text-gray-300 hover:text-primary-400 transition-colors duration-300">Privacy
                            Policy</a>
                        <a href="#"
                            class="text-gray-300 hover:text-primary-400 transition-colors duration-300">Legal</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Initialize Lucide Icons -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            lucide.createIcons();
        });
    </script>
</body>

</html>
<?php /**PATH /Users/user/Desktop/Websites/Broker/Celebrity/Celebrity/resources/views/layouts/base1.blade.php ENDPATH**/ ?>