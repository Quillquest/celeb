@extends('layouts.modern-base')
@section('title', $title)
@section('content')

<!-- Hero Section -->
<section class="relative min-h-screen flex items-center justify-center overflow-hidden hero-bg">
    <!-- Animated Background -->
    <div class="absolute inset-0">
        <div class="absolute top-20 left-20 w-72 h-72 bg-primary-400 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float"></div>
        <div class="absolute top-40 right-20 w-72 h-72 bg-accent-500 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float animation-delay-2000"></div>
        <div class="absolute -bottom-8 left-1/2 w-72 h-72 bg-primary-300 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-float animation-delay-4000"></div>
    </div>
    
    <!-- Hero Content -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center max-w-5xl mx-auto">
            <!-- Hero Badge -->
            <div class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-sm border border-white/20 rounded-full text-white text-sm font-medium mb-8 animate-slide-up">
                <i data-lucide="sparkles" class="w-4 h-4 mr-2"></i>
                Welcome to {{ $settings->site_name }}
            </div>
            
            <!-- Main Heading -->
            <h1 class="text-4xl sm:text-5xl lg:text-7xl font-display font-bold text-white mb-6 leading-tight animate-slide-up" style="animation-delay: 0.2s;">
                Book Your 
                <span class="gradient-text">Favorite</span> 
                Celebrity
            </h1>
            
            <!-- Subtitle -->
            <p class="text-xl sm:text-2xl text-white/90 mb-12 max-w-3xl mx-auto leading-relaxed animate-slide-up" style="animation-delay: 0.4s;">
                Connect with the stars you love. Get exclusive access to meet & greets, VIP experiences, and unforgettable moments with your favorite celebrities.
            </p>
            
            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center animate-slide-up" style="animation-delay: 0.6s;">
                <a href="book_celebrity" class="group inline-flex items-center px-8 py-4 bg-accent-500 text-white rounded-full font-semibold text-lg hover:bg-accent-600 transition-all duration-300 hover:scale-105 shadow-2xl">
                    <i data-lucide="star" class="w-5 h-5 mr-3 group-hover:rotate-12 transition-transform duration-300"></i>
                    Book Celebrity Now
                    <i data-lucide="arrow-right" class="w-5 h-5 ml-3 group-hover:translate-x-1 transition-transform duration-300"></i>
                </a>
                <a href="#about" class="group inline-flex items-center px-8 py-4 glass-effect text-white rounded-full font-semibold text-lg hover:bg-white/20 transition-all duration-300">
                    <i data-lucide="play" class="w-5 h-5 mr-3"></i>
                    Learn More
                </a>
            </div>
            
            <!-- Stats -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 mt-20 animate-slide-up" style="animation-delay: 0.8s;">
                <div class="text-center">
                    <div class="text-3xl lg:text-4xl font-bold text-white mb-2">50+</div>
                    <div class="text-white/80">Celebrity Events</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl lg:text-4xl font-bold text-white mb-2">100K+</div>
                    <div class="text-white/80">Happy Clients</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl lg:text-4xl font-bold text-white mb-2">10+</div>
                    <div class="text-white/80">Years Experience</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl lg:text-4xl font-bold text-white mb-2">24/7</div>
                    <div class="text-white/80">Support</div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
        <a href="#about" class="text-white/80 hover:text-white transition-colors duration-300">
            <i data-lucide="chevron-down" class="w-6 h-6"></i>
        </a>
    </div>
</section>

<!-- About Section -->
<section id="about" class="py-20 lg:py-32 bg-gray-50 relative overflow-hidden">
    <!-- Background Decoration -->
    <div class="absolute top-0 right-0 w-1/3 h-full bg-gradient-to-l from-primary-50 to-transparent opacity-50"></div>
    
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <!-- Image Side -->
            <div class="relative" x-data="{ inView: false }" x-intersect="inView = true">
                <div class="relative group" x-show="inView" x-transition:enter="transition ease-out duration-1000" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
                    <img src="temp/assets/img/home-2/img/about/ab1.jpg" alt="About Us" class="rounded-2xl shadow-2xl w-full h-auto">
                    <div class="absolute inset-0 bg-gradient-to-t from-primary-900/50 to-transparent rounded-2xl"></div>
                    
                    <!-- Experience Badge -->
                    <div class="absolute bottom-6 left-6 bg-white rounded-xl p-4 shadow-xl">
                        <div class="text-3xl font-bold text-primary-600 mb-1">10+</div>
                        <div class="text-sm text-gray-600 font-medium">Years of Experience</div>
                    </div>
                </div>
                
                <!-- Floating Elements -->
                <div class="absolute -top-4 -right-4 w-20 h-20 bg-accent-500 rounded-full opacity-20 animate-float" x-show="inView" x-transition:enter="transition ease-out duration-1000 delay-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"></div>
                <div class="absolute -bottom-4 -left-4 w-16 h-16 bg-primary-500 rounded-full opacity-20 animate-float animation-delay-2000" x-show="inView" x-transition:enter="transition ease-out duration-1000 delay-500" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"></div>
            </div>
            
            <!-- Content Side -->
            <div x-data="{ inView: false }" x-intersect="inView = true">
                <div x-show="inView" x-transition:enter="transition ease-out duration-1000" x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0">
                    <!-- Section Header -->
                    <div class="mb-8">
                        <span class="inline-block px-4 py-2 bg-primary-100 text-primary-700 rounded-full text-sm font-semibold mb-4">About Us</span>
                        <h2 class="text-3xl lg:text-5xl font-display font-bold text-gray-900 mb-6 leading-tight">
                            Welcome to <span class="gradient-text">{{ $settings->site_name }}</span>
                        </h2>
                        <p class="text-lg text-gray-600 leading-relaxed">
                            Your ultimate destination for connecting with your favorite stars! We provide unparalleled access to the glamorous world of celebrities through innovative technology and personalized experiences.
                        </p>
                    </div>
                    
                    <!-- Features List -->
                    <div class="space-y-4 mb-8">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 w-6 h-6 bg-primary-100 rounded-full flex items-center justify-center mr-4">
                                <i data-lucide="check" class="w-4 h-4 text-primary-600"></i>
                            </div>
                            <span class="text-gray-700">Direct connection with your favorite celebrities</span>
                        </div>
                        <div class="flex items-center">
                            <div class="flex-shrink-0 w-6 h-6 bg-primary-100 rounded-full flex items-center justify-center mr-4">
                                <i data-lucide="check" class="w-4 h-4 text-primary-600"></i>
                            </div>
                            <span class="text-gray-700">Exclusive VIP fan membership benefits</span>
                        </div>
                        <div class="flex items-center">
                            <div class="flex-shrink-0 w-6 h-6 bg-primary-100 rounded-full flex items-center justify-center mr-4">
                                <i data-lucide="check" class="w-4 h-4 text-primary-600"></i>
                            </div>
                            <span class="text-gray-700">Support charitable causes worldwide</span>
                        </div>
                        <div class="flex items-center">
                            <div class="flex-shrink-0 w-6 h-6 bg-primary-100 rounded-full flex items-center justify-center mr-4">
                                <i data-lucide="check" class="w-4 h-4 text-primary-600"></i>
                            </div>
                            <span class="text-gray-700">Unforgettable meet & greet experiences</span>
                        </div>
                    </div>
                    
                    <!-- Stats -->
                    <div class="grid grid-cols-2 gap-6 mb-8">
                        <div class="text-center p-4 bg-white rounded-xl shadow-sm border border-gray-100">
                            <div class="text-2xl font-bold text-primary-600 mb-1">50+</div>
                            <div class="text-sm text-gray-600">Celebrity Events</div>
                        </div>
                        <div class="text-center p-4 bg-white rounded-xl shadow-sm border border-gray-100">
                            <div class="text-2xl font-bold text-primary-600 mb-1">100K</div>
                            <div class="text-sm text-gray-600">Individual Clients</div>
                        </div>
                    </div>
                    
                    <!-- CTA Button -->
                    <a href="#contact" class="inline-flex items-center px-6 py-3 bg-primary-600 text-white rounded-lg font-semibold hover:bg-primary-700 transition-all duration-300 hover:scale-105 shadow-lg">
                        <i data-lucide="arrow-right" class="w-4 h-4 mr-2"></i>
                        Learn More About Us
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="py-20 lg:py-32 bg-white relative overflow-hidden">
    <!-- Background Decoration -->
    <div class="absolute inset-0">
        <div class="absolute top-20 left-10 w-64 h-64 bg-primary-100 rounded-full opacity-30 blur-3xl"></div>
        <div class="absolute bottom-20 right-10 w-64 h-64 bg-accent-100 rounded-full opacity-30 blur-3xl"></div>
    </div>
    
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative">
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16" x-data="{ inView: false }" x-intersect="inView = true">
            <div x-show="inView" x-transition:enter="transition ease-out duration-1000" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
                <span class="inline-block px-4 py-2 bg-primary-100 text-primary-700 rounded-full text-sm font-semibold mb-4">Our Services</span>
                <h2 class="text-3xl lg:text-5xl font-display font-bold text-gray-900 mb-6 leading-tight">
                    Exclusive Celebrity <span class="gradient-text">Experiences</span>
                </h2>
                <p class="text-lg text-gray-600 leading-relaxed">
                    Discover our premium services designed to bring you closer to your favorite celebrities through unique and unforgettable experiences.
                </p>
            </div>
        </div>
        
        <!-- Services Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" x-data="{ inView: false }" x-intersect="inView = true">
            <!-- Service 1 -->
            <div class="group" x-show="inView" x-transition:enter="transition ease-out duration-1000" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
                <div class="relative p-8 bg-white rounded-2xl shadow-lg border border-gray-100 hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
                    <div class="w-16 h-16 bg-primary-100 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i data-lucide="star" class="w-8 h-8 text-primary-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Book Celebrities</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        Book your favorite celebrities for personal events, brand endorsements, or special occasions through our seamless booking platform.
                    </p>
                    <a href="book_celebrity" class="inline-flex items-center text-primary-600 font-semibold hover:text-primary-700 transition-colors duration-300 group">
                        Learn More
                        <i data-lucide="arrow-right" class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform duration-300"></i>
                    </a>
                </div>
            </div>
            
            <!-- Service 2 -->
            <div class="group" x-show="inView" x-transition:enter="transition ease-out duration-1000 delay-200" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
                <div class="relative p-8 bg-white rounded-2xl shadow-lg border border-gray-100 hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
                    <div class="w-16 h-16 bg-accent-100 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i data-lucide="users" class="w-8 h-8 text-accent-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Meet & Greet Vacations</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        Experience ultimate celebrity encounters with exclusive vacation packages that include personal meet & greets and luxury accommodations.
                    </p>
                    <a href="book_celebrity" class="inline-flex items-center text-primary-600 font-semibold hover:text-primary-700 transition-colors duration-300 group">
                        Learn More
                        <i data-lucide="arrow-right" class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform duration-300"></i>
                    </a>
                </div>
            </div>
            
            <!-- Service 3 -->
            <div class="group" x-show="inView" x-transition:enter="transition ease-out duration-1000 delay-400" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
                <div class="relative p-8 bg-white rounded-2xl shadow-lg border border-gray-100 hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
                    <div class="w-16 h-16 bg-primary-100 rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i data-lucide="credit-card" class="w-8 h-8 text-primary-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">VIP Fan Membership</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        Get exclusive access to celebrity content, priority booking, special discounts, and insider information with our VIP membership program.
                    </p>
                    <a href="book_celebrity" class="inline-flex items-center text-primary-600 font-semibold hover:text-primary-700 transition-colors duration-300 group">
                        Learn More
                        <i data-lucide="arrow-right" class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform duration-300"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-20 lg:py-32 bg-gradient-to-br from-primary-600 via-primary-700 to-primary-800 relative overflow-hidden">
    <!-- Animated Background -->
    <div class="absolute inset-0">
        <div class="absolute top-0 left-0 w-full h-full opacity-10">
            <div class="absolute top-20 left-20 w-32 h-32 bg-white rounded-full animate-float"></div>
            <div class="absolute top-40 right-20 w-24 h-24 bg-accent-300 rounded-full animate-float animation-delay-2000"></div>
            <div class="absolute bottom-20 left-1/3 w-40 h-40 bg-white rounded-full animate-float animation-delay-4000"></div>
            <div class="absolute bottom-40 right-1/3 w-28 h-28 bg-accent-300 rounded-full animate-float animation-delay-1000"></div>
        </div>
    </div>
    
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <!-- Content Side -->
            <div x-data="{ inView: false }" x-intersect="inView = true">
                <div x-show="inView" x-transition:enter="transition ease-out duration-1000" x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0">
                    <span class="inline-block px-4 py-2 bg-white/20 backdrop-blur-sm border border-white/30 rounded-full text-white text-sm font-semibold mb-6">Special Features</span>
                    <h2 class="text-3xl lg:text-5xl font-display font-bold text-white mb-6 leading-tight">
                        {{ $settings->site_name }} <span class="text-accent-300">Premium</span> Services
                    </h2>
                    <p class="text-xl text-white/90 mb-8 leading-relaxed">
                        Join our growing community of celebrity enthusiasts and embark on an extraordinary journey of fandom with exclusive features and benefits.
                    </p>
                    
                    <!-- Features Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                                <i data-lucide="zap" class="w-6 h-6 text-accent-300"></i>
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold text-white mb-2">Priority Access</h4>
                                <p class="text-white/80 text-sm leading-relaxed">Skip the queue with priority access to virtual meet-and-greet sessions and exclusive events.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                                <i data-lucide="lock" class="w-6 h-6 text-accent-300"></i>
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold text-white mb-2">Exclusive Content</h4>
                                <p class="text-white/80 text-sm leading-relaxed">Access behind-the-scenes content, exclusive interviews, and sneak peeks into upcoming projects.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                                <i data-lucide="heart" class="w-6 h-6 text-accent-300"></i>
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold text-white mb-2">Charity Support</h4>
                                <p class="text-white/80 text-sm leading-relaxed">Donate to charity initiatives supported by celebrities worldwide and make a difference.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0 w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                                <i data-lucide="gift" class="w-6 h-6 text-accent-300"></i>
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold text-white mb-2">VIP Offers</h4>
                                <p class="text-white/80 text-sm leading-relaxed">Enjoy exclusive VIP member benefits with special offers and deals tailored just for you.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Image Side -->
            <div class="relative" x-data="{ inView: false }" x-intersect="inView = true">
                <div x-show="inView" x-transition:enter="transition ease-out duration-1000" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
                    <div class="relative group">
                        <img src="temp/assets/img/home-2/img/about/wh1.jpg" alt="VIP Features" class="rounded-2xl shadow-2xl w-full h-auto">
                        <div class="absolute inset-0 bg-gradient-to-t from-primary-900/30 to-transparent rounded-2xl"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Section -->
<section class="py-20 lg:py-32 bg-gray-50 relative overflow-hidden">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16" x-data="{ inView: false }" x-intersect="inView = true">
            <div x-show="inView" x-transition:enter="transition ease-out duration-1000" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
                <span class="inline-block px-4 py-2 bg-primary-100 text-primary-700 rounded-full text-sm font-semibold mb-4">Gallery</span>
                <h2 class="text-3xl lg:text-5xl font-display font-bold text-gray-900 mb-6 leading-tight">
                    {{ $settings->site_name }} <span class="gradient-text">Experience</span> Gallery
                </h2>
                <p class="text-lg text-gray-600 leading-relaxed">
                    Explore our diverse collection of celebrity experiences from various fields including movies, music, sports, fashion, and more.
                </p>
            </div>
        </div>
        
        <!-- Gallery Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" x-data="{ inView: false }" x-intersect="inView = true">
            <!-- Gallery Item 1 -->
            <div class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500" x-show="inView" x-transition:enter="transition ease-out duration-1000" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
                <img src="temp/assets/img/home-2/img/portfolio/1.jpg" alt="Celebrity Experience" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                <div class="absolute bottom-0 left-0 right-0 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-white/80 text-sm mb-1">{{ $settings->site_name }}</p>
                            <h3 class="text-white text-xl font-bold">Classy Events</h3>
                        </div>
                        <button class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center text-white hover:bg-white/30 transition-colors duration-300">
                            <i data-lucide="external-link" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Gallery Item 2 -->
            <div class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500" x-show="inView" x-transition:enter="transition ease-out duration-1000 delay-200" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
                <img src="temp/assets/img/home-2/img/portfolio/2.jpg" alt="Celebrity Experience" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                <div class="absolute bottom-0 left-0 right-0 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-white/80 text-sm mb-1">{{ $settings->site_name }}</p>
                            <h3 class="text-white text-xl font-bold">Relaxed Sessions</h3>
                        </div>
                        <button class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center text-white hover:bg-white/30 transition-colors duration-300">
                            <i data-lucide="external-link" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Gallery Item 3 -->
            <div class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500" x-show="inView" x-transition:enter="transition ease-out duration-1000 delay-400" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
                <img src="temp/assets/img/home-2/img/portfolio/3.jpg" alt="Celebrity Experience" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                <div class="absolute bottom-0 left-0 right-0 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-white/80 text-sm mb-1">{{ $settings->site_name }}</p>
                            <h3 class="text-white text-xl font-bold">Thrilling Adventures</h3>
                        </div>
                        <button class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center text-white hover:bg-white/30 transition-colors duration-300">
                            <i data-lucide="external-link" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Gallery Item 4 -->
            <div class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500" x-show="inView" x-transition:enter="transition ease-out duration-1000 delay-600" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
                <img src="temp/assets/img/home-2/img/portfolio/4.jpg" alt="Celebrity Experience" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                <div class="absolute bottom-0 left-0 right-0 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-white/80 text-sm mb-1">{{ $settings->site_name }}</p>
                            <h3 class="text-white text-xl font-bold">Meet & Greet</h3>
                        </div>
                        <button class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center text-white hover:bg-white/30 transition-colors duration-300">
                            <i data-lucide="external-link" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Gallery Item 5 -->
            <div class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500" x-show="inView" x-transition:enter="transition ease-out duration-1000 delay-800" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
                <img src="temp/assets/img/home-2/img/portfolio/6.jpg" alt="Celebrity Experience" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                <div class="absolute bottom-0 left-0 right-0 p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-white/80 text-sm mb-1">{{ $settings->site_name }}</p>
                            <h3 class="text-white text-xl font-bold">VIP Showcase</h3>
                        </div>
                        <button class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center text-white hover:bg-white/30 transition-colors duration-300">
                            <i data-lucide="external-link" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Gallery Item 6 - CTA Card -->
            <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-primary-600 to-primary-800 shadow-lg hover:shadow-2xl transition-all duration-500 flex items-center justify-center min-h-64" x-show="inView" x-transition:enter="transition ease-out duration-1000 delay-1000" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
                <div class="text-center p-8">
                    <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="plus" class="w-8 h-8 text-white"></i>
                    </div>
                    <h3 class="text-white text-xl font-bold mb-2">View All Experiences</h3>
                    <p class="text-white/80 text-sm mb-4">Discover more celebrity experiences</p>
                    <a href="book_celebrity" class="inline-flex items-center px-4 py-2 bg-white text-primary-600 rounded-lg font-semibold hover:bg-gray-100 transition-colors duration-300">
                        Explore More
                        <i data-lucide="arrow-right" class="w-4 h-4 ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Brands Section -->
<section id="brands" class="py-20 lg:py-32 bg-white relative overflow-hidden">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16" x-data="{ inView: false }" x-intersect="inView = true">
            <div x-show="inView" x-transition:enter="transition ease-out duration-1000" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
                <span class="inline-block px-4 py-2 bg-primary-100 text-primary-700 rounded-full text-sm font-semibold mb-4">Our Partners</span>
                <h2 class="text-3xl lg:text-5xl font-display font-bold text-gray-900 mb-6 leading-tight">
                    Trusted by <span class="gradient-text">Industry Leaders</span>
                </h2>
                <p class="text-lg text-gray-600 leading-relaxed">
                    These are some of the noteworthy brands and entertainment companies that collaborate with us to bring you the best celebrity experiences.
                </p>
            </div>
        </div>
        
        <!-- Brands Grid -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-7 gap-8" x-data="{ inView: false }" x-intersect="inView = true">
            <!-- Brand 1 -->
            <div class="group text-center" x-show="inView" x-transition:enter="transition ease-out duration-1000" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
                <div class="relative overflow-hidden rounded-2xl bg-gray-50 p-6 hover:bg-gray-100 transition-all duration-300 hover:scale-105 shadow-sm hover:shadow-lg">
                    <img src="temp/assets/img/home-2/img/team/1.jpg" alt="Warner Bros" class="w-16 h-16 rounded-xl mx-auto mb-4 object-cover">
                    <h3 class="text-sm font-semibold text-gray-900 group-hover:text-primary-600 transition-colors duration-300">Warner Bros</h3>
                </div>
            </div>
            
            <!-- Brand 2 -->
            <div class="group text-center" x-show="inView" x-transition:enter="transition ease-out duration-1000 delay-100" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
                <div class="relative overflow-hidden rounded-2xl bg-gray-50 p-6 hover:bg-gray-100 transition-all duration-300 hover:scale-105 shadow-sm hover:shadow-lg">
                    <img src="temp/assets/img/home-2/img/team/2.jpg" alt="Walt Disney" class="w-16 h-16 rounded-xl mx-auto mb-4 object-cover">
                    <h3 class="text-sm font-semibold text-gray-900 group-hover:text-primary-600 transition-colors duration-300">Walt Disney</h3>
                </div>
            </div>
            
            <!-- Brand 3 -->
            <div class="group text-center" x-show="inView" x-transition:enter="transition ease-out duration-1000 delay-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
                <div class="relative overflow-hidden rounded-2xl bg-gray-50 p-6 hover:bg-gray-100 transition-all duration-300 hover:scale-105 shadow-sm hover:shadow-lg">
                    <img src="temp/assets/img/home-2/img/team/3.jpg" alt="Gaumont" class="w-16 h-16 rounded-xl mx-auto mb-4 object-cover">
                    <h3 class="text-sm font-semibold text-gray-900 group-hover:text-primary-600 transition-colors duration-300">Gaumont</h3>
                </div>
            </div>
            
            <!-- Brand 4 -->
            <div class="group text-center" x-show="inView" x-transition:enter="transition ease-out duration-1000 delay-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
                <div class="relative overflow-hidden rounded-2xl bg-gray-50 p-6 hover:bg-gray-100 transition-all duration-300 hover:scale-105 shadow-sm hover:shadow-lg">
                    <img src="temp/assets/img/home-2/img/team/4.jpg" alt="20th Century Fox" class="w-16 h-16 rounded-xl mx-auto mb-4 object-cover">
                    <h3 class="text-sm font-semibold text-gray-900 group-hover:text-primary-600 transition-colors duration-300">20th Century Fox</h3>
                </div>
            </div>
            
            <!-- Brand 5 -->
            <div class="group text-center" x-show="inView" x-transition:enter="transition ease-out duration-1000 delay-400" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
                <div class="relative overflow-hidden rounded-2xl bg-gray-50 p-6 hover:bg-gray-100 transition-all duration-300 hover:scale-105 shadow-sm hover:shadow-lg">
                    <img src="temp/assets/img/home-2/img/team/5.jpg" alt="Paramount" class="w-16 h-16 rounded-xl mx-auto mb-4 object-cover">
                    <h3 class="text-sm font-semibold text-gray-900 group-hover:text-primary-600 transition-colors duration-300">Paramount</h3>
                </div>
            </div>
            
            <!-- Brand 6 -->
            <div class="group text-center" x-show="inView" x-transition:enter="transition ease-out duration-1000 delay-500" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
                <div class="relative overflow-hidden rounded-2xl bg-gray-50 p-6 hover:bg-gray-100 transition-all duration-300 hover:scale-105 shadow-sm hover:shadow-lg">
                    <img src="temp/assets/img/home-2/img/team/6.jpg" alt="Columbia & BBC" class="w-16 h-16 rounded-xl mx-auto mb-4 object-cover">
                    <h3 class="text-sm font-semibold text-gray-900 group-hover:text-primary-600 transition-colors duration-300">Columbia & BBC</h3>
                </div>
            </div>
            
            <!-- Brand 7 -->
            <div class="group text-center" x-show="inView" x-transition:enter="transition ease-out duration-1000 delay-600" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100">
                <div class="relative overflow-hidden rounded-2xl bg-gray-50 p-6 hover:bg-gray-100 transition-all duration-300 hover:scale-105 shadow-sm hover:shadow-lg">
                    <img src="temp/assets/img/home-2/img/team/7.jpg" alt="Tommy Productions" class="w-16 h-16 rounded-xl mx-auto mb-4 object-cover">
                    <h3 class="text-sm font-semibold text-gray-900 group-hover:text-primary-600 transition-colors duration-300">Tommy Productions</h3>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 lg:py-32 bg-gradient-to-br from-primary-600 via-primary-700 to-primary-800 relative overflow-hidden">
    <!-- Animated Background -->
    <div class="absolute inset-0">
        <div class="absolute top-0 left-0 w-full h-full opacity-10">
            <div class="absolute top-20 left-20 w-32 h-32 bg-white rounded-full animate-float"></div>
            <div class="absolute top-40 right-20 w-24 h-24 bg-accent-300 rounded-full animate-float animation-delay-2000"></div>
            <div class="absolute bottom-20 left-1/3 w-40 h-40 bg-white rounded-full animate-float animation-delay-4000"></div>
        </div>
    </div>
    
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="text-center max-w-4xl mx-auto" x-data="{ inView: false }" x-intersect="inView = true">
            <div x-show="inView" x-transition:enter="transition ease-out duration-1000" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
                <span class="inline-block px-4 py-2 bg-white/20 backdrop-blur-sm border border-white/30 rounded-full text-white text-sm font-semibold mb-6">Ready to Start?</span>
                <h2 class="text-3xl lg:text-5xl font-display font-bold text-white mb-6 leading-tight">
                    Become Part of Our <span class="text-accent-300">Success Story</span>
                </h2>
                <p class="text-xl text-white/90 mb-12 leading-relaxed max-w-2xl mx-auto">
                    Join thousands of satisfied customers who have connected with their favorite celebrities through {{ $settings->site_name }}. We're here to serve you better.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a href="book_celebrity" class="group inline-flex items-center px-8 py-4 bg-accent-500 text-white rounded-full font-semibold text-lg hover:bg-accent-600 transition-all duration-300 hover:scale-105 shadow-2xl">
                        <i data-lucide="star" class="w-5 h-5 mr-3 group-hover:rotate-12 transition-transform duration-300"></i>
                        Book Celebrity Now
                        <i data-lucide="arrow-right" class="w-5 h-5 ml-3 group-hover:translate-x-1 transition-transform duration-300"></i>
                    </a>
                    <a href="#contact" class="group inline-flex items-center px-8 py-4 glass-effect text-white rounded-full font-semibold text-lg hover:bg-white/20 transition-all duration-300">
                        <i data-lucide="phone" class="w-5 h-5 mr-3"></i>
                        Contact Us Now
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-20 lg:py-32 bg-gray-50 relative overflow-hidden">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16" x-data="{ inView: false }" x-intersect="inView = true">
            <div x-show="inView" x-transition:enter="transition ease-out duration-1000" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
                <span class="inline-block px-4 py-2 bg-primary-100 text-primary-700 rounded-full text-sm font-semibold mb-4">Testimonials</span>
                <h2 class="text-3xl lg:text-5xl font-display font-bold text-gray-900 mb-6 leading-tight">
                    What Our <span class="gradient-text">Customers Say</span>
                </h2>
                <p class="text-lg text-gray-600 leading-relaxed">
                    Hear from our satisfied customers about their incredible celebrity experiences and how we've helped make their dreams come true.
                </p>
            </div>
        </div>
        
        <!-- Testimonials Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" x-data="{ inView: false }" x-intersect="inView = true">
            <!-- Testimonial 1 -->
            <div class="group" x-show="inView" x-transition:enter="transition ease-out duration-1000" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
                <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100 hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
                    <div class="flex items-center mb-6">
                        <img src="temp/assets/img/home-2/img/about/tst1.jpg" alt="James" class="w-16 h-16 rounded-full object-cover mr-4">
                        <div>
                            <h4 class="text-lg font-bold text-gray-900">James</h4>
                            <div class="flex text-accent-500">
                                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <i data-lucide="quote" class="w-8 h-8 text-primary-200"></i>
                    </div>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        They possess great flexibility and approachability, and can adapt to my schedule, emphasizing the importance of trust. The experience was absolutely phenomenal!
                    </p>
                </div>
            </div>
            
            <!-- Testimonial 2 -->
            <div class="group" x-show="inView" x-transition:enter="transition ease-out duration-1000 delay-200" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
                <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100 hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
                    <div class="flex items-center mb-6">
                        <img src="temp/assets/img/home-2/img/about/tst2.jpg" alt="Mirabel" class="w-16 h-16 rounded-full object-cover mr-4">
                        <div>
                            <h4 class="text-lg font-bold text-gray-900">Mirabel</h4>
                            <div class="flex text-accent-500">
                                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <i data-lucide="quote" class="w-8 h-8 text-primary-200"></i>
                    </div>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        I've used this platform multiple times, and it never disappoints! The user interface is easy to navigate, and their customer service is top-notch.
                    </p>
                </div>
            </div>
            
            <!-- Testimonial 3 -->
            <div class="group" x-show="inView" x-transition:enter="transition ease-out duration-1000 delay-400" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
                <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100 hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
                    <div class="flex items-center mb-6">
                        <img src="temp/assets/img/home-2/img/about/tst3.jpg" alt="Felix" class="w-16 h-16 rounded-full object-cover mr-4">
                        <div>
                            <h4 class="text-lg font-bold text-gray-900">Felix</h4>
                            <div class="flex text-accent-500">
                                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <i data-lucide="quote" class="w-8 h-8 text-primary-200"></i>
                    </div>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        I can't say enough good things about this website. From the moment I landed on their site, I was impressed by how easy it was to use. Good job!
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection