@extends('layouts.base1')
@section('title', $title)
@section('content')

    <!-- Back to Home Button -->
    <div class="fixed top-4 left-4 z-50">
        <a href="{{ route('home') }}"
            class="inline-flex items-center gap-2 bg-white/90 backdrop-blur-sm hover:bg-white text-gray-800 px-4 py-2 rounded-lg font-medium shadow-lg transition-all duration-200 border border-gray-200">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            Back to Home
        </a>
    </div>

    <!-- Hero Section -->
    <section class="relative pt-24 pb-16 bg-gradient-to-br from-gray-900 via-primary-900 to-gray-900 overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div
                class="absolute -top-20 -right-20 w-96 h-96 bg-primary-400 rounded-full mix-blend-overlay filter blur-3xl opacity-20 animate-float">
            </div>
            <div
                class="absolute -bottom-20 -left-20 w-96 h-96 bg-accent-500 rounded-full mix-blend-overlay filter blur-3xl opacity-20 animate-float animation-delay-2000">
            </div>
            <div class="absolute inset-0 bg-grid-white/[0.03] bg-[length:30px_30px]" aria-hidden="true"></div>
        </div>

        <!-- Content -->
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center">
                <div class="inline-flex items-center gap-3 mb-6">
                    <div
                        class="w-12 h-12 rounded-full bg-primary-500/20 border border-primary-500/30 flex items-center justify-center">
                        <i data-lucide="star" class="w-6 h-6 text-primary-300"></i>
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white">
                        Book a <span class="text-primary-400">Celebrity</span>
                    </h1>
                </div>
                <p class="text-xl text-white/80 max-w-2xl mx-auto mb-8">
                    Choose from our exclusive roster of featured celebrities and book your perfect event experience
                </p>
            </div>
        </div>
    </section>

    <!-- Celebrity Selection Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">

            @if ($celebrities && count($celebrities) > 0)
                <!-- Section Header -->
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                        Featured Celebrities
                    </h2>
                    <p class="text-lg text-gray-600 max-w-2xl mx-auto mb-2">
                        Book any of our premium celebrities for your special events, appearances, and occasions
                    </p>
                    @if ($celebrities->hasPages())
                        <p class="text-sm text-gray-500">
                            Page {{ $celebrities->currentPage() }} of {{ $celebrities->lastPage() }} •
                            {{ $celebrities->total() }} total celebrities
                        </p>
                    @endif
                </div>

                <!-- Celebrity Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach ($celebrities as $celebrity)
                        <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden group"
                            x-data="{ showModal: false }">
                            <!-- Celebrity Image -->
                            <div class="relative h-64 overflow-hidden cursor-pointer" @click="showModal = true">
                                <img src="{{ asset('storage/' . $celebrity->photo) }}" alt="{{ $celebrity->name }}"
                                    class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-300">

                                <!-- Featured Badge -->
                                @if ($celebrity->featured == 'featured')
                                    <div class="absolute top-3 right-3">
                                        <span
                                            class="px-2 py-1 bg-accent-500 text-white text-xs font-bold rounded-full uppercase tracking-wider inline-flex items-center gap-1">
                                            <i data-lucide="star" class="w-3 h-3"></i>
                                            Featured
                                        </span>
                                    </div>
                                @endif

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
                                        <a href="{{ route('book_celebrity_now', ['id' => $celebrity->id, 'type' => 'booking']) }}"
                                            class="w-12 h-12 flex items-center justify-center rounded-full bg-primary-600/90 backdrop-blur-sm text-white hover:bg-primary-700 transition-colors duration-300">
                                            <i data-lucide="calendar" class="w-6 h-6"></i>
                                        </a>
                                    </div>
                                </div>
                            </div> <!-- Celebrity Info -->
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $celebrity->name }}</h3>

                                @if ($celebrity->known_for)
                                    <p class="text-gray-600 text-sm mb-3">{{ $celebrity->known_for }}</p>
                                @endif

                                @if ($celebrity->profession)
                                    <p class="text-primary-600 text-sm font-medium mb-4">{{ $celebrity->profession }}</p>
                                @endif

                                <!-- Booking Options -->
                                <div class="space-y-2">
                                    <!-- Action Buttons -->
                                    <div class="grid grid-cols-2 gap-2 mb-2">
                                        <a href="{{ route('book_celebrity_now', ['id' => $celebrity->id, 'type' => 'booking']) }}"
                                            class="inline-flex items-center justify-center px-4 py-2 bg-primary-600 text-white rounded-lg font-medium hover:bg-primary-700 transition-all duration-300 text-sm">
                                            <i data-lucide="calendar" class="w-4 h-4 mr-2"></i>
                                            Book Now
                                        </a>
                                        <a href="{{ route('book_celebrity_now', ['id' => $celebrity->id, 'type' => 'donation']) }}"
                                            class="inline-flex items-center justify-center px-4 py-2 bg-accent-500 text-white rounded-lg font-medium hover:bg-accent-600 transition-all duration-300 text-sm">
                                            <i data-lucide="heart" class="w-4 h-4 mr-2"></i>
                                            Donate
                                        </a>
                                    </div>
                                    <div>
                                        <a href="{{ route('book_celebrity_now', ['id' => $celebrity->id, 'type' => 'fan_card']) }}"
                                            class="w-full inline-flex items-center justify-center px-4 py-2 border border-primary-600 text-primary-600 rounded-lg font-medium hover:bg-primary-50 transition-all duration-300 text-sm">
                                            <i data-lucide="credit-card" class="w-4 h-4 mr-2"></i>
                                            Fan Card
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal for Celebrity Details -->
                            <div x-show="showModal" x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
                                x-transition:leave-end="opacity-0" @keydown.escape.window="showModal = false"
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
                                        <img src="{{ asset('storage/' . $celebrity->photo) }}"
                                            alt="{{ $celebrity->name }}" class="w-full h-full object-cover object-center">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                                        <div class="absolute bottom-6 left-6 right-6">
                                            <h3 class="text-2xl font-bold text-white mb-2">{{ $celebrity->name }}</h3>
                                            <p class="text-white/80">{{ $celebrity->profession ?? 'Celebrity' }}</p>
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
                                                <span>{{ $celebrity->country ?? 'International' }}</span>
                                            </div>
                                            @if ($celebrity->booking_fee)
                                                <div class="flex items-center text-gray-600">
                                                    <i data-lucide="tag" class="w-5 h-5 mr-3 text-primary-600"></i>
                                                    <span>${{ is_numeric($celebrity->booking_fee) ? number_format((float) $celebrity->booking_fee, 0) : $celebrity->booking_fee }}
                                                        booking fee</span>
                                                </div>
                                            @endif
                                            @if ($celebrity->known_for)
                                                <div class="flex items-center text-gray-600 md:col-span-2">
                                                    <i data-lucide="star" class="w-5 h-5 mr-3 text-primary-600"></i>
                                                    <span>Known for: {{ $celebrity->known_for }}</span>
                                                </div>
                                            @endif
                                        </div>

                                        @if ($celebrity->bio)
                                            <div class="mb-6">
                                                <h4 class="text-lg font-semibold text-gray-900 mb-2">About</h4>
                                                <p class="text-gray-600 leading-relaxed">{{ $celebrity->bio }}</p>
                                            </div>
                                        @endif

                                        <!-- Modal Action Buttons -->
                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                            <a href="{{ route('book_celebrity_now', ['id' => $celebrity->id, 'type' => 'booking']) }}"
                                                class="inline-flex items-center justify-center px-4 py-3 bg-primary-600 text-white rounded-lg font-medium hover:bg-primary-700 transition-all duration-300">
                                                <i data-lucide="calendar" class="w-5 h-5 mr-2"></i>
                                                Book Now
                                            </a>
                                            <a href="{{ route('book_celebrity_now', ['id' => $celebrity->id, 'type' => 'donation']) }}"
                                                class="inline-flex items-center justify-center px-4 py-3 bg-accent-500 text-white rounded-lg font-medium hover:bg-accent-600 transition-all duration-300">
                                                <i data-lucide="heart" class="w-5 h-5 mr-2"></i>
                                                Donate
                                            </a>
                                            <a href="{{ route('book_celebrity_now', ['id' => $celebrity->id, 'type' => 'fan_card']) }}"
                                                class="inline-flex items-center justify-center px-4 py-3 border border-primary-600 text-primary-600 rounded-lg font-medium hover:bg-primary-50 transition-all duration-300">
                                                <i data-lucide="credit-card" class="w-5 h-5 mr-2"></i>
                                                Fan Card
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination Links -->
                @if ($celebrities->hasPages())
                    <div class="flex justify-center mt-12">
                        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                            {{-- Previous Page Link --}}
                            @if ($celebrities->onFirstPage())
                                <span
                                    class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 cursor-not-allowed">
                                    <span class="sr-only">Previous</span>
                                    <i data-lucide="chevron-left" class="w-5 h-5"></i>
                                </span>
                            @else
                                <a href="{{ $celebrities->previousPageUrl() }}"
                                    class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 transition-colors duration-200">
                                    <span class="sr-only">Previous</span>
                                    <i data-lucide="chevron-left" class="w-5 h-5"></i>
                                </a>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach ($celebrities->getUrlRange(1, $celebrities->lastPage()) as $page => $url)
                                @if ($page == $celebrities->currentPage())
                                    <span
                                        class="relative inline-flex items-center px-4 py-2 border border-primary-500 bg-primary-50 text-sm font-medium text-primary-600">
                                        {{ $page }}
                                    </span>
                                @else
                                    <a href="{{ $url }}"
                                        class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach

                            {{-- Next Page Link --}}
                            @if ($celebrities->hasMorePages())
                                <a href="{{ $celebrities->nextPageUrl() }}"
                                    class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50 transition-colors duration-200">
                                    <span class="sr-only">Next</span>
                                    <i data-lucide="chevron-right" class="w-5 h-5"></i>
                                </a>
                            @else
                                <span
                                    class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 cursor-not-allowed">
                                    <span class="sr-only">Next</span>
                                    <i data-lucide="chevron-right" class="w-5 h-5"></i>
                                </span>
                            @endif
                        </nav>
                    </div>

                    <!-- Pagination Info -->
                    <div class="text-center mt-6">
                        <p class="text-sm text-gray-700">
                            Showing {{ $celebrities->firstItem() }} to {{ $celebrities->lastItem() }} of
                            {{ $celebrities->total() }} celebrities
                        </p>
                    </div>
                @endif
            @else
                <!-- No Celebrities Available -->
                <div class="text-center py-16">
                    <div class="w-24 h-24 mx-auto mb-6 bg-gray-200 rounded-full flex items-center justify-center">
                        <i data-lucide="users" class="w-12 h-12 text-gray-400"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">No Celebrities Available</h3>
                    <p class="text-gray-600 max-w-md mx-auto mb-6">
                        We're currently updating our celebrity roster. Please check back soon for exciting booking
                        opportunities!
                    </p>
                    <a href="{{ route('home') }}"
                        class="inline-flex items-center gap-2 bg-primary-600 hover:bg-primary-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200">
                        <i data-lucide="arrow-left" class="w-4 h-4"></i>
                        Back to Home
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="py-16 bg-primary-600">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                    Ready to Book Your Celebrity?
                </h2>
                <p class="text-xl text-primary-100 max-w-2xl mx-auto mb-8">
                    Get in touch with our booking specialists for personalized assistance and exclusive packages
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="#contact"
                        class="inline-flex items-center gap-2 bg-white text-primary-600 hover:bg-gray-100 px-8 py-3 rounded-lg font-medium transition-colors duration-200">
                        <i data-lucide="phone" class="w-5 h-5"></i>
                        Contact Us
                    </a>
                    <a href="#"
                        class="inline-flex items-center gap-2 border-2 border-white text-white hover:bg-white hover:text-primary-600 px-8 py-3 rounded-lg font-medium transition-colors duration-200">
                        <i data-lucide="help-circle" class="w-5 h-5"></i>
                        Booking FAQ
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Lucide icons
            lucide.createIcons();

            // Add smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });
    </script>
@endsection

@section('styles')
    <style>
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        .bg-grid-white\/\[0\.03\] {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32' width='32' height='32' fill='none' stroke='rgb(255 255 255 / 0.03)'%3e%3cpath d='m0 .5h32m-32 32v-32'/%3e%3c/svg%3e");
        }
    </style>
@endsection
