@extends('layouts.modern')
@section('title', 'My Profile')
@section('content')

<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 dark:from-gray-900 dark:via-slate-900 dark:to-gray-800 py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Modern Page Header with Breadcrumb -->
        <div class="mb-8">
            <!-- Breadcrumb -->
            <nav class="flex mb-4" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('user.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-primary-600 dark:text-gray-400 dark:hover:text-primary-400 transition-colors">
                            <i data-lucide="home" class="w-4 h-4 mr-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i data-lucide="chevron-right" class="w-4 h-4 text-gray-400"></i>
                            <span class="ml-1 md:ml-3 text-sm font-medium text-gray-700 dark:text-gray-300">Profile</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Header Content -->
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                <div class="flex items-center space-x-4">
                    <!-- Profile Avatar -->
                    <div class="relative">
                        <div class="h-20 w-20 rounded-2xl overflow-hidden bg-gradient-to-br from-primary-500 to-purple-600 p-0.5 shadow-lg">
                            <div class="h-full w-full rounded-2xl overflow-hidden bg-white dark:bg-gray-800">
                                @if($user->profile_photo_path)
                                    <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="{{ $user->name }}" class="h-full w-full object-cover">
                                @else
                                    <div class="h-full w-full flex items-center justify-center bg-gradient-to-br from-primary-100 to-purple-100 dark:from-primary-900/20 dark:to-purple-900/20">
                                        <span class="text-2xl font-bold text-primary-600 dark:text-primary-400">
                                            {{ substr($user->name, 0, 1) }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="absolute -bottom-1 -right-1 h-6 w-6 bg-green-400 border-2 border-white dark:border-gray-800 rounded-full"></div>
                    </div>
                    
                    <!-- User Info -->
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                            {{ $user->name }}
                        </h1>
                        <p class="text-gray-600 dark:text-gray-400 flex items-center mt-1">
                            <i data-lucide="mail" class="w-4 h-4 mr-2"></i>
                            {{ $user->email }}
                        </p>
                        <div class="flex items-center mt-2 space-x-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                                <span class="w-1.5 h-1.5 mr-1.5 bg-green-400 rounded-full"></span>
                                Active Member
                            </span>
                            <span class="text-sm text-gray-500 dark:text-gray-400">
                                Member since {{ $user->created_at->format('M Y') }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Action Button -->
                <div class="mt-6 lg:mt-0">
                    <a href="{{ route('user.dashboard') }}" class="inline-flex items-center px-4 py-2.5 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition-all duration-200">
                        <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
                        Back to Dashboard
                    </a>
                </div>
            </div>
        </div>

        <!-- Modern Alert Messages -->
        @if (session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 6000)" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform scale-95"
             x-transition:enter-end="opacity-100 transform scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 transform scale-100"
             x-transition:leave-end="opacity-0 transform scale-95"
             class="rounded-xl bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 p-4 mb-6 shadow-sm">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-green-100 dark:bg-green-800/30 rounded-lg flex items-center justify-center">
                        <i data-lucide="check" class="w-4 h-4 text-green-600 dark:text-green-400"></i>
                    </div>
                </div>
                <div class="ml-3 flex-1">
                    <p class="text-sm font-medium text-green-800 dark:text-green-200">
                        {{ session('success') }}
                    </p>
                </div>
                <div class="ml-4">
                    <button @click="show = false" type="button" class="inline-flex text-green-400 hover:text-green-600 dark:text-green-500 dark:hover:text-green-300 focus:outline-none focus:ring-2 focus:ring-green-500 rounded-lg p-1">
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </button>
                </div>
            </div>
        </div>
        @endif

        @if ($errors->any())
        <div x-data="{ show: true }" x-show="show" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform scale-95"
             x-transition:enter-end="opacity-100 transform scale-100"
             class="rounded-xl bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 p-4 mb-6 shadow-sm">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-red-100 dark:bg-red-800/30 rounded-lg flex items-center justify-center">
                        <i data-lucide="alert-triangle" class="w-4 h-4 text-red-600 dark:text-red-400"></i>
                    </div>
                </div>
                <div class="ml-3 flex-1">
                    <h3 class="text-sm font-medium text-red-800 dark:text-red-200 mb-2">Please fix the following errors:</h3>
                    <ul class="text-sm text-red-700 dark:text-red-300 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li class="flex items-center">
                                <i data-lucide="alert-circle" class="w-3 h-3 mr-2 flex-shrink-0"></i>
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="ml-4">
                    <button @click="show = false" type="button" class="inline-flex text-red-400 hover:text-red-600 dark:text-red-500 dark:hover:text-red-300 focus:outline-none focus:ring-2 focus:ring-red-500 rounded-lg p-1">
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </button>
                </div>
            </div>
        </div>
        @endif

        <!-- Modern Tabbed Interface -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl border border-gray-100 dark:border-gray-700 overflow-hidden" x-data="{ activeTab: 'profile' }">
            <!-- Tab Navigation -->
            <div class="border-b border-gray-100 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-800/50">
                <nav class="flex" aria-label="Profile sections" role="tablist">
                    <button @click="activeTab = 'profile'" 
                            :class="{ 
                                'bg-white dark:bg-gray-800 text-primary-600 dark:text-primary-400 border-primary-500': activeTab === 'profile', 
                                'text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 bg-transparent': activeTab !== 'profile' 
                            }" 
                            class="flex-1 py-4 px-6 text-sm font-medium border-b-2 border-transparent transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-inset"
                            role="tab" aria-selected="true" aria-controls="profile-panel">
                        <div class="flex items-center justify-center space-x-2">
                            <i data-lucide="user" class="w-4 h-4"></i>
                            <span class="hidden sm:inline">Profile Information</span>
                            <span class="sm:hidden">Profile</span>
                        </div>
                    </button>
                    <button @click="activeTab = 'photo'" 
                            :class="{ 
                                'bg-white dark:bg-gray-800 text-primary-600 dark:text-primary-400 border-primary-500': activeTab === 'photo', 
                                'text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 bg-transparent': activeTab !== 'photo' 
                            }" 
                            class="flex-1 py-4 px-6 text-sm font-medium border-b-2 border-transparent transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-inset"
                            role="tab" aria-selected="false" aria-controls="photo-panel">
                        <div class="flex items-center justify-center space-x-2">
                            <i data-lucide="image" class="w-4 h-4"></i>
                            <span class="hidden sm:inline">Profile Photo</span>
                            <span class="sm:hidden">Photo</span>
                        </div>
                    </button>
                    <button @click="activeTab = 'security'" 
                            :class="{ 
                                'bg-white dark:bg-gray-800 text-primary-600 dark:text-primary-400 border-primary-500': activeTab === 'security', 
                                'text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 bg-transparent': activeTab !== 'security' 
                            }" 
                            class="flex-1 py-4 px-6 text-sm font-medium border-b-2 border-transparent transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-inset"
                            role="tab" aria-selected="false" aria-controls="security-panel">
                        <div class="flex items-center justify-center space-x-2">
                            <i data-lucide="shield" class="w-4 h-4"></i>
                            <span class="hidden sm:inline">Security</span>
                            <span class="sm:hidden">Security</span>
                        </div>
                    </button>
                </nav>
            </div>

            <!-- Tab Content -->
            <div class="p-6 lg:p-8">
                <!-- Profile Information Panel -->
                <div x-show="activeTab === 'profile'" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform translate-y-4"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     role="tabpanel" id="profile-panel" aria-labelledby="profile-tab">
                    
                    <div class="max-w-2xl">
                        <div class="mb-8">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Personal Information</h2>
                            <p class="text-gray-600 dark:text-gray-400">Update your personal details and contact information.</p>
                        </div>

                        <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
                            @csrf
                            @method('PUT')

                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label for="name" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                        Full Name <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" 
                                           class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all duration-200" 
                                           placeholder="Enter your full name" required>
                                </div>

                                <div class="space-y-2">
                                    <label for="email" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                        Email Address <span class="text-red-500">*</span>
                                    </label>
                                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" 
                                           class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all duration-200" 
                                           placeholder="Enter your email address" required>
                                </div>

                                <div class="space-y-2">
                                    <label for="phone" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                        Phone Number
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i data-lucide="phone" class="w-4 h-4 text-gray-400"></i>
                                        </div>
                                        <input type="tel" name="phone" id="phone" value="{{ old('phone', $user->phone) }}" 
                                               class="w-full pl-10 pr-4 py-3 border border-gray-200 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all duration-200" 
                                               placeholder="+1 (555) 123-4567">
                                    </div>
                                </div>

                                <div class="space-y-2">
                                    <label for="country" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                        Country
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i data-lucide="map-pin" class="w-4 h-4 text-gray-400"></i>
                                        </div>
                                        <input type="text" name="country" id="country" value="{{ old('country', $user->country) }}" 
                                               class="w-full pl-10 pr-4 py-3 border border-gray-200 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all duration-200" 
                                               placeholder="Select your country">
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label for="address" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                    Address
                                </label>
                                <textarea name="address" id="address" rows="3" 
                                          class="w-full px-4 py-3 border border-gray-200 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all duration-200" 
                                          placeholder="Enter your full address">{{ old('address', $user->address) }}</textarea>
                            </div>

                            <div class="flex justify-end pt-6 border-t border-gray-100 dark:border-gray-700">
                                <button type="submit" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-all duration-200 transform hover:scale-105">
                                    <i data-lucide="save" class="w-4 h-4 mr-2"></i>
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Profile Photo Panel -->
                <div x-show="activeTab === 'photo'" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform translate-y-4"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     role="tabpanel" id="photo-panel" aria-labelledby="photo-tab">
                    
                    <div class="max-w-2xl">
                        <div class="mb-8">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Profile Photo</h2>
                            <p class="text-gray-600 dark:text-gray-400">Upload or update your profile picture to personalize your account.</p>
                        </div>

                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-6">
                            <!-- Current Photo Display -->
                            <div class="flex flex-col sm:flex-row items-center space-y-6 sm:space-y-0 sm:space-x-8">
                                <div class="relative">
                                    <div class="h-32 w-32 rounded-2xl overflow-hidden bg-gradient-to-br from-primary-500 to-purple-600 p-1 shadow-lg">
                                        <div class="h-full w-full rounded-2xl overflow-hidden bg-white dark:bg-gray-800">
                                            @if($user->profile_photo_path)
                                                <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="{{ $user->name }}" class="h-full w-full object-cover">
                                            @else
                                                <div class="h-full w-full flex items-center justify-center bg-gradient-to-br from-primary-100 to-purple-100 dark:from-primary-900/20 dark:to-purple-900/20">
                                                    <span class="text-4xl font-bold text-primary-600 dark:text-primary-400">
                                                        {{ substr($user->name, 0, 1) }}
                                                    </span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <!-- Status indicator -->
                                    <div class="absolute -bottom-2 -right-2 h-8 w-8 bg-green-400 border-4 border-white dark:border-gray-800 rounded-full flex items-center justify-center">
                                        <i data-lucide="camera" class="w-3 h-3 text-white"></i>
                                    </div>
                                </div>

                                <div class="flex-1 text-center sm:text-left">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Current Photo</h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                                        @if($user->profile_photo_path)
                                            Photo uploaded successfully. You can update or remove it below.
                                        @else
                                            No profile photo uploaded yet. Upload one to personalize your account.
                                        @endif
                                    </p>
                                    
                                    <div class="flex flex-col sm:flex-row gap-3">
                                        <!-- Upload Form -->
                                        <form method="POST" action="{{ route('profile.photo.update') }}" enctype="multipart/form-data" class="flex-1">
                                            @csrf
                                            @method('PUT')
                                            
                                            <div class="space-y-4">
                                                <div class="relative">
                                                    <input type="file" name="photo" id="photo" accept="image/*" 
                                                           class="hidden" onchange="updateFileName(this)">
                                                    <label for="photo" class="flex items-center justify-center w-full px-4 py-3 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-600 transition-all duration-200 group">
                                                        <i data-lucide="upload" class="w-4 h-4 mr-2 text-gray-500 group-hover:text-primary-600"></i>
                                                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300 group-hover:text-primary-600" id="file-label">Choose Photo</span>
                                                    </label>
                                                    <p class="mt-2 text-xs text-gray-500 dark:text-gray-400 text-center">PNG, JPG, GIF up to 2MB</p>
                                                </div>

                                                <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-3 bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-all duration-200 transform hover:scale-105">
                                                    <i data-lucide="upload" class="w-4 h-4 mr-2"></i>
                                                    Upload New Photo
                                                </button>
                                            </div>
                                        </form>

                                        <!-- Remove Photo -->
                                        @if($user->profile_photo_path)
                                        <div class="flex-shrink-0">
                                            <form method="POST" action="{{ route('profile.photo.delete') }}" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        onclick="return confirm('Are you sure you want to remove your profile photo?')"
                                                        class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-3 bg-red-50 dark:bg-red-900/20 text-red-700 dark:text-red-400 font-semibold rounded-lg border border-red-200 dark:border-red-800 hover:bg-red-100 dark:hover:bg-red-900/30 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-all duration-200">
                                                    <i data-lucide="trash-2" class="w-4 h-4 mr-2"></i>
                                                    Remove
                                                </button>
                                            </form>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Photo Guidelines -->
                        <div class="mt-6 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl p-4">
                            <h4 class="text-sm font-semibold text-blue-900 dark:text-blue-200 mb-2 flex items-center">
                                <i data-lucide="info" class="w-4 h-4 mr-2"></i>
                                Photo Guidelines
                            </h4>
                            <ul class="text-sm text-blue-800 dark:text-blue-300 space-y-1">
                                <li>• Use a clear, recent photo of yourself</li>
                                <li>• Square images work best (1:1 aspect ratio)</li>
                                <li>• Maximum file size: 2MB</li>
                                <li>• Supported formats: JPG, PNG, GIF</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Security Panel -->
                <div x-show="activeTab === 'security'" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform translate-y-4"
                     x-transition:enter-end="opacity-100 transform translate-y-0"
                     role="tabpanel" id="security-panel" aria-labelledby="security-tab">
                    
                    <div class="max-w-2xl">
                        <div class="mb-8">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Security Settings</h2>
                            <p class="text-gray-600 dark:text-gray-400">Manage your password and account security preferences.</p>
                        </div>

                        <!-- Password Update Form -->
                        <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6 mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                                <i data-lucide="key" class="w-5 h-5 mr-2 text-primary-600"></i>
                                Change Password
                            </h3>
                            
                            <form method="POST" action="{{ route('profile.password.update') }}" class="space-y-6">
                                @csrf
                                @method('PUT')

                                <div class="space-y-2">
                                    <label for="current_password" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                        Current Password <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i data-lucide="lock" class="w-4 h-4 text-gray-400"></i>
                                        </div>
                                        <input type="password" name="current_password" id="current_password" 
                                               class="w-full pl-10 pr-4 py-3 border border-gray-200 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all duration-200" 
                                               placeholder="Enter your current password" required>
                                    </div>
                                </div>

                                <div class="space-y-2">
                                    <label for="password" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                        New Password <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i data-lucide="key" class="w-4 h-4 text-gray-400"></i>
                                        </div>
                                        <input type="password" name="password" id="password" 
                                               class="w-full pl-10 pr-4 py-3 border border-gray-200 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all duration-200" 
                                               placeholder="Enter a new strong password" required>
                                    </div>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 flex items-start">
                                        <i data-lucide="info" class="w-3 h-3 mr-1 mt-0.5 flex-shrink-0"></i>
                                        Minimum 8 characters with uppercase, lowercase, number, and special character.
                                    </p>
                                </div>

                                <div class="space-y-2">
                                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                                        Confirm New Password <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i data-lucide="check" class="w-4 h-4 text-gray-400"></i>
                                        </div>
                                        <input type="password" name="password_confirmation" id="password_confirmation" 
                                               class="w-full pl-10 pr-4 py-3 border border-gray-200 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all duration-200" 
                                               placeholder="Confirm your new password" required>
                                    </div>
                                </div>

                                <div class="flex justify-end pt-4">
                                    <button type="submit" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-all duration-200 transform hover:scale-105">
                                        <i data-lucide="shield-check" class="w-4 h-4 mr-2"></i>
                                        Update Password
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Account Information -->
                        <div class="bg-gradient-to-br from-slate-50 to-blue-50 dark:from-gray-800 dark:to-slate-800 border border-gray-200 dark:border-gray-700 rounded-xl p-6">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-6 flex items-center">
                                <i data-lucide="user-check" class="w-5 h-5 mr-2 text-primary-600"></i>
                                Account Information
                            </h3>
                            
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div class="bg-white dark:bg-gray-800 rounded-lg p-4 border border-gray-100 dark:border-gray-700">
                                    <div class="flex items-center mb-2">
                                        <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center mr-3">
                                            <i data-lucide="calendar" class="w-4 h-4 text-blue-600 dark:text-blue-400"></i>
                                        </div>
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Member Since</dt>
                                            <dd class="text-sm font-semibold text-gray-900 dark:text-white">{{ $user->created_at->format('F j, Y') }}</dd>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-white dark:bg-gray-800 rounded-lg p-4 border border-gray-100 dark:border-gray-700">
                                    <div class="flex items-center mb-2">
                                        <div class="w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center mr-3">
                                            <i data-lucide="check-circle" class="w-4 h-4 text-green-600 dark:text-green-400"></i>
                                        </div>
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Account Status</dt>
                                            <dd class="text-sm">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                                                    <span class="w-1.5 h-1.5 mr-1.5 bg-green-400 rounded-full"></span>
                                                    {{ ucfirst($user->status ?? 'active') }}
                                                </span>
                                            </dd>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-white dark:bg-gray-800 rounded-lg p-4 border border-gray-100 dark:border-gray-700">
                                    <div class="flex items-center mb-2">
                                        <div class="w-8 h-8 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center mr-3">
                                            <i data-lucide="calendar-days" class="w-4 h-4 text-purple-600 dark:text-purple-400"></i>
                                        </div>
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Bookings</dt>
                                            <dd class="text-sm font-semibold text-gray-900 dark:text-white">{{ $user->bookings->count() }}</dd>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-white dark:bg-gray-800 rounded-lg p-4 border border-gray-100 dark:border-gray-700">
                                    <div class="flex items-center mb-2">
                                        <div class="w-8 h-8 bg-orange-100 dark:bg-orange-900/30 rounded-lg flex items-center justify-center mr-3">
                                            <i data-lucide="clock" class="w-4 h-4 text-orange-600 dark:text-orange-400"></i>
                                        </div>
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Last Activity</dt>
                                            <dd class="text-sm font-semibold text-gray-900 dark:text-white">{{ $user->updated_at->format('M j, Y') }}</dd>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom Scripts -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        lucide.createIcons();
        
        // File upload preview
        window.updateFileName = function(input) {
            const label = document.getElementById('file-label');
            if (input.files && input.files[0]) {
                label.textContent = input.files[0].name;
            } else {
                label.textContent = 'Choose Photo';
            }
        };
    });
</script>

<!-- Additional Styles -->
<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .animate-fade-in {
        animation: fadeIn 0.3s ease-out;
    }
    
    /* Custom scrollbar for better UX */
    ::-webkit-scrollbar {
        width: 6px;
    }
    
    ::-webkit-scrollbar-track {
        background: transparent;
    }
    
    ::-webkit-scrollbar-thumb {
        background: rgb(156 163 175 / 0.5);
        border-radius: 3px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
        background: rgb(156 163 175 / 0.7);
    }
    
    /* Focus states for better accessibility */
    input:focus, textarea:focus, button:focus {
        box-shadow: 0 0 0 3px rgb(99 102 241 / 0.1);
    }
    
    /* Improved button hover effects */
    button:hover {
        transform: translateY(-1px);
    }
    
    button:active {
        transform: translateY(0);
    }
</style>

@endsection