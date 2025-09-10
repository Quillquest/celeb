@extends('layouts.base1')
@section('title', 'Admin Access - Celebrity Booking Portal')
@section('content')

    <div class="min-h-screen bg-gradient-to-br from-gray-50 via-white to-blue-50 dark:from-gray-900 dark:via-gray-800 dark:to-blue-900 flex items-center justify-center p-4"
        x-data="adminLogin()" x-init="init()">

        <!-- Background Elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-blue-400/10 rounded-full blur-3xl animate-pulse"></div>
            <div
                class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-purple-400/10 rounded-full blur-3xl animate-pulse animation-delay-2000">
            </div>
            <div
                class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-gradient-to-r from-blue-400/5 to-purple-400/5 rounded-full blur-3xl">
            </div>
        </div>

        <!-- Login Container -->
        <div class="relative w-full max-w-md" x-show="mounted" x-transition:enter="transition ease-out duration-700 transform"
            x-transition:enter-startthe form is not submiting , it keeps wire:loading="opacity-0 scale-95 translate-y-4"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0">

            <!-- Glowing Border Effect -->
            <div class="absolute inset-0 bg-gradient-to-r from-blue-500/20 to-purple-500/20 rounded-2xl blur-xl"></div>

            <!-- Main Card -->
            <div
                class="relative bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl border border-gray-200/50 dark:border-gray-700/50 rounded-2xl p-8 shadow-2xl">

                <!-- Header Section -->
                <div class="text-center mb-8">
                    <!-- Logo with Premium Glow Effect -->
                    <div class="mb-6 relative inline-block">
                        <div class="absolute inset-0 bg-blue-500/30 rounded-full blur-lg"></div>
                        <img src="{{ asset('storage/' . $settings->logo) }}" alt="{{ $settings->site_name }}"
                            class="relative h-16 w-16 mx-auto rounded-full border-2 border-white/30 shadow-xl">
                    </div>

                    <!-- Admin Badge -->
                    <div
                        class="inline-flex items-center px-3 py-1 rounded-full bg-gradient-to-r from-blue-100 to-purple-100 dark:from-blue-900/30 dark:to-purple-900/30 text-blue-800 dark:text-blue-300 text-xs font-medium mb-4">
                        <i data-lucide="shield-check" class="w-3 h-3 mr-1"></i>
                        Admin Portal
                    </div>

                    <!-- Welcome Text -->
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">
                        Welcome Back
                    </h1>
                    <p class="text-gray-600 dark:text-gray-300 text-sm">
                        Access your Celebrity Booking admin dashboard
                    </p>
                </div>

                <!-- Status Messages -->
                @if (Session::has('status'))
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 6000)"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform scale-95"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 transform scale-100"
                        x-transition:leave-end="opacity-0 transform scale-95"
                        class="mb-6 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800/30 backdrop-blur-sm rounded-xl p-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i data-lucide="info" class="h-5 w-5 text-blue-600 dark:text-blue-400"></i>
                            </div>
                            <div class="ml-3 flex-1">
                                <p class="text-sm text-blue-800 dark:text-blue-200">{{ session('status') }}</p>
                            </div>
                            <button @click="show = false"
                                class="ml-4 text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-200 transition-colors">
                                <i data-lucide="x" class="h-4 w-4"></i>
                            </button>
                        </div>
                    </div>
                @endif

                @if (session('message'))
                    <div x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform scale-95"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800/30 backdrop-blur-sm rounded-xl p-4">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <i data-lucide="alert-circle" class="h-5 w-5 text-red-600 dark:text-red-400 mt-0.5"></i>
                            </div>
                            <div class="ml-3 flex-1">
                                <h3 class="text-sm font-medium text-red-800 dark:text-red-200 mb-1">Authentication Error
                                </h3>
                                <p class="text-sm text-red-700 dark:text-red-300">{{ session('message') }}</p>
                            </div>
                            <button @click="show = false"
                                class="ml-4 text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-200 transition-colors">
                                <i data-lucide="x" class="h-4 w-4"></i>
                            </button>
                        </div>
                    </div>
                @endif

                @if (session('success'))
                    <div x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 transform scale-95"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        class="mb-6 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800/30 backdrop-blur-sm rounded-xl p-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i data-lucide="check-circle" class="h-5 w-5 text-green-600 dark:text-green-400"></i>
                            </div>
                            <div class="ml-3 flex-1">
                                <p class="text-sm text-green-800 dark:text-green-200">{{ session('success') }}</p>
                            </div>
                            <button @click="show = false"
                                class="ml-4 text-green-600 dark:text-green-400 hover:text-green-800 dark:hover:text-green-200 transition-colors">
                                <i data-lucide="x" class="h-4 w-4"></i>
                            </button>
                        </div>
                    </div>
                @endif

                <!-- Login Form -->
                <form class="space-y-6" action="{{ route('adminlogin') }}" method="POST" @submit="isSubmitting = true">
                    @csrf

                    <!-- Email Field -->
                    <div class="space-y-2">
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            <i data-lucide="mail" class="w-4 h-4 inline mr-1"></i>
                            Admin Email Address
                        </label>
                        <div class="relative group">
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-blue-500/10 to-purple-500/10 rounded-xl blur-sm group-focus-within:blur-md transition-all duration-300">
                            </div>
                            <div class="relative flex items-center">
                                <div class="absolute left-4 flex items-center pointer-events-none">
                                    <i data-lucide="user-check"
                                        class="h-5 w-5 text-gray-400 dark:text-gray-500 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-400 transition-colors"></i>
                                </div>
                                <input id="email" name="email" type="email" autocomplete="email" required
                                    value="{{ old('email') }}" x-model="form.email"
                                    class="relative w-full pl-12 pr-4 py-4 bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-blue-500 dark:focus:border-blue-400 backdrop-blur-sm transition-all duration-300"
                                    placeholder="Enter your admin email">
                            </div>
                        </div>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1 flex items-center">
                                <i data-lucide="alert-triangle" class="w-3 h-3 mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                <i data-lucide="lock" class="w-4 h-4 inline mr-1"></i>
                                Password
                            </label>
                            <a href="{{ route('admin.forgetpassword') }}"
                                class="text-sm font-medium text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 transition-colors">
                                Forgot password?
                            </a>
                        </div>
                        <div class="relative group">
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-blue-500/10 to-purple-500/10 rounded-xl blur-sm group-focus-within:blur-md transition-all duration-300">
                            </div>
                            <div class="relative flex items-center">
                                <div class="absolute left-4 flex items-center pointer-events-none">
                                    <i data-lucide="shield"
                                        class="h-5 w-5 text-gray-400 dark:text-gray-500 group-focus-within:text-blue-600 dark:group-focus-within:text-blue-400 transition-colors"></i>
                                </div>
                                <input :type="showPassword ? 'text' : 'password'" id="password" name="password" required
                                    x-model="form.password"
                                    class="relative w-full pl-12 pr-12 py-4 bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 rounded-xl text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400 focus:border-blue-500 dark:focus:border-blue-400 backdrop-blur-sm transition-all duration-300"
                                    placeholder="Enter your password">
                                <button type="button" @click="showPassword = !showPassword"
                                    class="absolute right-4 text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 transition-colors focus:outline-none">
                                    <i data-lucide="eye" x-show="!showPassword" class="h-5 w-5"></i>
                                    <i data-lucide="eye-off" x-show="showPassword" class="h-5 w-5"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center group cursor-pointer">
                            <input type="checkbox" id="remember" name="remember" x-model="form.remember"
                                class="w-4 h-4 text-blue-600 bg-gray-100 dark:bg-gray-600 border-gray-300 dark:border-gray-500 rounded focus:ring-blue-500 dark:focus:ring-blue-400 focus:ring-2">
                            <span
                                class="ml-2 text-sm text-gray-600 dark:text-gray-300 group-hover:text-gray-800 dark:group-hover:text-gray-100 transition-colors">
                                Keep me signed in
                            </span>
                        </label>

                        <!-- Security Badge -->
                        <div class="flex items-center text-xs text-gray-500 dark:text-gray-400">
                            <i data-lucide="shield-check" class="w-3 h-3 mr-1"></i>
                            Secure Login
                        </div>
                    </div>

                    <!-- Sign In Button -->
                    <button type="submit" :disabled="isSubmitting" class="relative w-full group overflow-hidden">
                        <!-- Button Glow Effect -->
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl blur-sm group-hover:blur-md transition-all duration-300">
                        </div>

                        <!-- Button Content -->
                        <div
                            class="relative bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold py-4 px-6 rounded-xl flex items-center justify-center space-x-2 transform group-hover:scale-[1.02] group-active:scale-[0.98] transition-all duration-200">
                            <i data-lucide="log-in" class="h-5 w-5" x-show="!isSubmitting"></i>
                            <div x-show="isSubmitting"
                                class="w-5 h-5 border-2 border-white/30 border-t-white rounded-full animate-spin"></div>
                            <span x-text="isSubmitting ? 'Signing In...' : 'Access Admin Portal'"></span>
                        </div>
                    </button>

                    <!-- Security Notice -->
                    <div
                        class="bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800/30 rounded-lg p-3">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <i data-lucide="shield-alert"
                                    class="h-4 w-4 text-amber-600 dark:text-amber-400 mt-0.5"></i>
                            </div>
                            <div class="ml-2">
                                <p class="text-xs text-amber-800 dark:text-amber-200">
                                    This is a secure admin area. All login attempts are monitored and logged for security
                                    purposes.
                                </p>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- Footer Links -->
                <div class="mt-8 text-center space-y-2">
                    <p class="text-gray-600 dark:text-gray-300 text-sm">
                        Need help?
                        <a href="#"
                            class="font-medium text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 transition-colors">
                            Contact Support
                        </a>
                    </p>
                    <p class="text-gray-500 dark:text-gray-400 text-xs">
                        <i data-lucide="arrow-left" class="w-3 h-3 inline mr-1"></i>
                        Back to
                        <a href="{{ route('home') }}"
                            class="text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 transition-colors">
                            Celebrity Booking Portal
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function adminLogin() {
            return {
                mounted: false,
                showPassword: false,
                isSubmitting: false,
                form: {
                    email: '',
                    password: '',
                    remember: false
                },

                init() {
                    setTimeout(() => this.mounted = true, 100);
                    lucide.createIcons();
                }
            }
        }
    </script>

    <style>
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            33% {
                transform: translateY(-10px) rotate(1deg);
            }

            66% {
                transform: translateY(5px) rotate(-1deg);
            }
        }

        .animation-delay-2000 {
            animation-delay: 2s;
        }

        /* Custom scrollbar for better aesthetics */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }
    </style>

@endsection
