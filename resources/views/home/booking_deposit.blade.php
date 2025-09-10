@extends('layouts.base1')
@section('title', $title)
@section('content')

<!-- Main Payment Container -->
<div class="min-h-screen bg-gray-50 dark:bg-gray-900 pt-24 sm:pt-28 pb-20" x-data="paymentHandler()">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="space-y-4 mb-6">
            @if(session('success'))
                <div class="bg-green-50 dark:bg-green-900/30 border-l-4 border-green-400 p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i data-lucide="check-circle" class="h-5 w-5 text-green-400"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-green-700 dark:text-green-400">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-50 dark:bg-red-900/30 border-l-4 border-red-400 p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i data-lucide="alert-circle" class="h-5 w-5 text-red-400"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700 dark:text-red-400">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-50 dark:bg-red-900/30 border-l-4 border-red-400 p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i data-lucide="alert-circle" class="h-5 w-5 text-red-400"></i>
                        </div>
                        <div class="ml-3">
                            <ul class="list-disc pl-5 space-y-1">
                                @foreach($errors->all() as $error)
                                    <li class="text-sm text-red-700 dark:text-red-400">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Header Section -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center gap-3 px-4 py-2 bg-blue-500/10 dark:bg-blue-500/5 rounded-full border border-blue-500/20 mb-6">
                <i data-lucide="shield-check" class="w-5 h-5 text-blue-400"></i>
                <span class="text-sm font-medium text-blue-600 dark:text-blue-400">Secure Payment</span>
            </div>
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                Complete Your Booking Payment
            </h1>
            <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                Make a secure payment to confirm your booking with
                <span class="text-primary-600 dark:text-primary-400 font-semibold">{{ $celebrity->name }}</span>
            </p>
        </div>

        <!-- Progress Steps -->
        <div class="flex items-center justify-center mt-6 mb-12 overflow-x-auto pb-4">
            <div class="flex items-center space-x-2 sm:space-x-4 lg:space-x-8 min-w-max">
                <div class="flex items-center">
                    <div class="w-8 h-8 sm:w-10 sm:h-10 bg-primary-500 rounded-full flex items-center justify-center">
                        <i data-lucide="check" class="w-4 h-4 sm:w-5 sm:h-5 text-white"></i>
                    </div>
                    <span class="ml-2 sm:ml-3 text-xs sm:text-sm font-medium text-primary-600 dark:text-primary-400 hidden sm:inline">Booking Details</span>
                    <span class="ml-2 text-xs font-medium text-primary-600 dark:text-primary-400 sm:hidden">Details</span>
                </div>
                <div class="w-4 sm:w-8 h-0.5 bg-primary-500"></div>
                <div class="flex items-center">
                    <div class="w-8 h-8 sm:w-10 sm:h-10 bg-primary-500/20 border-2 border-primary-500 rounded-full flex items-center justify-center">
                        <span class="text-xs sm:text-sm font-bold text-primary-600 dark:text-primary-400">2</span>
                    </div>
                    <span class="ml-2 sm:ml-3 text-xs sm:text-sm font-medium text-gray-900 dark:text-white hidden sm:inline">Payment</span>
                    <span class="ml-2 text-xs font-medium text-gray-900 dark:text-white sm:hidden">Payment</span>
                </div>
                <div class="w-4 sm:w-8 h-0.5 bg-gray-300 dark:bg-gray-700"></div>
                <div class="flex items-center">
                    <div class="w-8 h-8 sm:w-10 sm:h-10 bg-gray-200 dark:bg-gray-800 rounded-full flex items-center justify-center">
                        <span class="text-xs sm:text-sm font-bold text-gray-500 dark:text-gray-400">3</span>
                    </div>
                    <span class="ml-2 sm:ml-3 text-xs sm:text-sm font-medium text-gray-500 dark:text-gray-400 hidden sm:inline">Confirmation</span>
                    <span class="ml-2 text-xs font-medium text-gray-500 dark:text-gray-400 sm:hidden">Confirm</span>
                </div>
            </div>
        </div>

        <!-- Main Payment Card -->
        <div class="bg-white dark:bg-gray-900 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
            <!-- Card Header -->
            <div class="bg-gradient-to-r from-blue-600/5 dark:from-blue-600/10 to-purple-600/5 dark:to-purple-600/10 border-b border-gray-200 dark:border-gray-700 p-6">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-blue-500/10 dark:bg-blue-500/20 rounded-xl flex items-center justify-center">
                            <i data-lucide="credit-card" class="w-6 h-6 text-blue-500 dark:text-blue-400"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-gray-900 dark:text-white">Payment Details</h2>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Booking Reference: {{ $booking->booking_reference }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-500/10 dark:bg-green-500/20 text-green-600 dark:text-green-400 border border-green-500/20">
                            <i data-lucide="shield" class="w-3 h-3 mr-1"></i>
                            SSL Secured
                        </span>
                    </div>
                </div>
            </div>

            <!-- Card Content -->
            <div class="p-6 space-y-6">
                <!-- Booking Summary -->
                <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700">
                    <div class="flex flex-wrap items-center justify-between mb-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Booking Summary</h3>
                        <button
                            type="button"
                            onclick="printReceipt()"
                            class="inline-flex items-center px-3 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-lg transition-colors"
                        >
                            <i data-lucide="printer" class="w-4 h-4 mr-1.5"></i>
                            Print Receipt
                        </button>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-500 dark:text-gray-400">Celebrity:</span>
                                <span class="font-medium text-gray-900 dark:text-white">{{ $celebrity->name }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500 dark:text-gray-400">Event Type:</span>
                                <span class="font-medium text-gray-900 dark:text-white">{{ $booking->event_type }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500 dark:text-gray-400">Event Date:</span>
                                <span class="font-medium text-gray-900 dark:text-white">{{ $booking->event_date->format('F j, Y') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500 dark:text-gray-400">Event Time:</span>
                                <span class="font-medium text-gray-900 dark:text-white">{{ \Carbon\Carbon::parse($booking->event_time)->format('g:i A') }}</span>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-500 dark:text-gray-400">Booking Fee:</span>
                                <span class="font-medium text-gray-900 dark:text-white">${{ number_format($booking->booking_fee, 2) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500 dark:text-gray-400">Service Fee:</span>
                                <span class="font-medium text-gray-900 dark:text-white">${{ number_format($booking->service_fee, 2) }}</span>
                            </div>
                            <div class="border-t border-gray-200 dark:border-gray-700 pt-3 flex justify-between">
                                <span class="font-semibold text-gray-900 dark:text-white">Total Amount:</span>
                                <span class="font-bold text-lg text-primary-600 dark:text-primary-400">
                                    ${{ number_format($booking->total_amount, 2) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Method Selection -->
                <div x-data="{ selectedMethod: '{{ $payment_methods[0]->name }}' }">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Select Payment Method</h3>

                    <!-- Payment Method Tabs -->
                    <div class="flex flex-wrap gap-2 mb-6">
                        @foreach($payment_methods as $method)
                        <button
                            type="button"
                            @click="selectedMethod = '{{ $method->name }}'"
                            :class="selectedMethod === '{{ $method->name }}' ?
                                'bg-primary-50 dark:bg-primary-900/20 text-primary-700 dark:text-primary-300 border-primary-500' :
                                'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700'"
                            class="flex items-center gap-2 px-4 py-2.5 border-2 rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900"
                        >
                            @if(isset($method->img_url) && $method->img_url)
                            <img src="{{ $method->img_url }}" alt="{{ $method->name }}" class="w-6 h-6 object-contain" />
                            @else
                            <i data-lucide="{{ isset($method->methodtype) && $method->methodtype == 'crypto' ? 'bitcoin' : 'credit-card' }}" class="w-5 h-5"></i>
                            @endif
                            <span class="font-medium">{{ $method->name }}</span>
                        </button>
                        @endforeach
                    </div>

                    <!-- Payment Method Details -->
                    <div class="bg-gradient-to-r from-gray-50 to-white dark:from-gray-800 dark:to-gray-850 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                        @foreach($payment_methods as $method)
                        <div
                            x-show="selectedMethod === '{{ $method->name }}'"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            class="p-5"
                        >
                            <!-- Payment Method Header -->
                            <div class="flex items-center gap-3 pb-4 mb-4 border-b border-gray-200 dark:border-gray-700">
                                @if(isset($method->img_url) && $method->img_url)
                                <div class="w-12 h-12 rounded-lg flex items-center justify-center bg-white dark:bg-gray-800 p-2 shadow-sm">
                                    <img src="{{ $method->img_url }}" alt="{{ $method->name }}" class="max-w-full max-h-full object-contain" />
                                </div>
                                @else
                                <div class="w-12 h-12 rounded-lg flex items-center justify-center bg-primary-50 dark:bg-primary-900/20">
                                    <i data-lucide="{{ isset($method->methodtype) && $method->methodtype == 'crypto' ? 'bitcoin' : 'credit-card' }}" class="w-6 h-6 text-primary-500"></i>
                                </div>
                                @endif
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $method->name }}</h4>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        @if(isset($method->duration))
                                        {{ $method->duration }}
                                        @else
                                        Payment Details
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <div class="space-y-6">
                                <!-- Crypto Details -->
                                @if(isset($method->methodtype) && $method->methodtype == 'crypto')
                                    @if(isset($method->wallet_address) && $method->wallet_address)
                                    <div class="space-y-2">
                                        <div class="flex items-center justify-between">
                                            <label class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                                Wallet Address @if(isset($method->network) && $method->network)<span class="text-primary-600 dark:text-primary-400">({{ $method->network }})</span>@endif
                                            </label>
                                            <button
                                                type="button"
                                                onclick="copyToClipboard('{{ $method->wallet_address }}')"
                                                class="inline-flex items-center gap-1 text-xs font-medium text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300"
                                            >
                                                <i data-lucide="copy" class="w-3.5 h-3.5"></i>
                                                Copy
                                            </button>
                                        </div>
                                        <div class="relative">
                                            <div class="p-3 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg text-sm break-all font-mono">
                                               {{ $method->wallet_address }}
                                            </div>
                                        </div>
                                    </div>
                                    @endif


                                    <div class="flex flex-col items-center justify-center py-4 space-y-3">
                                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Scan QR Code to Pay</span>
                                        <div class="p-2 bg-white rounded-lg shadow-sm">
                                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=180x180&data={{ $method->wallet_address }}" alt="QR Code for {{ $method->name }}" class="w-40 h-40 object-contain" />
                                        </div>
                                    </div>


                                    @if(isset($method->network) && $method->network)
                                    <div class="bg-yellow-50 dark:bg-yellow-900/30 border-l-4 border-yellow-500 p-4">
                                        <div class="flex">
                                            <div class="flex-shrink-0">
                                                <i data-lucide="alert-triangle" class="h-5 w-5 text-yellow-500"></i>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm text-yellow-700 dark:text-yellow-400">
                                                    <strong>Important:</strong> Send only via <span class="font-bold">{{ $method->network }}</span> network. Using other networks may result in lost funds.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                <!-- Bank/Currency Details -->
                                @else
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                        <!-- Bank Info Column -->
                                        <div class="space-y-4">
                                            @if(isset($method->bankname) && $method->bankname)
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Bank Name</label>
                                                <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-3">
                                                    <p class="font-medium text-gray-900 dark:text-white">{{ $method->bankname }}</p>
                                                </div>
                                            </div>
                                            @endif

                                            @if(isset($method->account_name) && $method->account_name)
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Account Name</label>
                                                <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-3">
                                                    <p class="font-medium text-gray-900 dark:text-white">{{ $method->account_name }}</p>
                                                </div>
                                            </div>
                                            @endif

                                            @if(isset($method->swift_code) && $method->swift_code)
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">SWIFT/BIC Code</label>
                                                <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-3">
                                                    <p class="font-medium text-gray-900 dark:text-white">{{ $method->swift_code }}</p>
                                                </div>
                                            </div>
                                            @endif
                                        </div>

                                        <!-- Account Number Column -->
                                        <div class="space-y-4">
                                            @if(isset($method->account_number) && $method->account_number)
                                            <div>
                                                <div class="flex items-center justify-between">
                                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Account Number</label>
                                                    <button
                                                        type="button"
                                                        onclick="copyToClipboard('{{ $method->account_number }}')"
                                                        class="inline-flex items-center gap-1 text-xs font-medium text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300"
                                                    >
                                                        <i data-lucide="copy" class="w-3.5 h-3.5"></i>
                                                        Copy
                                                    </button>
                                                </div>
                                                <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-3">
                                                    <p class="font-mono font-medium text-gray-900 dark:text-white">{{ $method->account_number }}</p>
                                                </div>
                                            </div>
                                            @endif

                                            <div class="mt-auto pt-4">
                                                <div class="bg-blue-50 dark:bg-blue-900/30 border border-blue-100 dark:border-blue-800 rounded-lg p-4">
                                                    <h5 class="font-medium text-blue-800 dark:text-blue-300 flex items-center gap-2 mb-2">
                                                        <i data-lucide="info" class="w-4 h-4"></i>
                                                        Payment Amount
                                                    </h5>
                                                    <div class="flex items-center justify-between">
                                                        <span class="text-gray-700 dark:text-gray-300">Total to Pay:</span>
                                                        <span class="text-xl font-bold text-gray-900 dark:text-white">${{ number_format($booking->total_amount, 2) }}</span>
                                                    </div>
                                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">Please transfer the exact amount shown above</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- Payment Instructions -->
                                <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                                    <h5 class="font-medium text-gray-900 dark:text-white flex items-center gap-2 mb-3">
                                        <i data-lucide="list-checks" class="w-5 h-5 text-primary-500"></i>
                                        Payment Instructions
                                    </h5>
                                    <ol class="list-decimal pl-5 space-y-2 text-sm text-gray-600 dark:text-gray-400">
                                        <li>
                                            @if(isset($method->methodtype) && $method->methodtype == 'crypto')
                                            Send exactly ${{ number_format($booking->total_amount, 2) }} worth of {{ $method->name }} to the wallet address above
                                            @else
                                            Transfer exactly ${{ number_format($booking->total_amount, 2) }} to the account details provided
                                            @endif
                                        </li>
                                        <li>Use your booking reference ({{ $booking->booking_reference }}) as the payment description/memo</li>
                                        <li>Take a screenshot of your payment confirmation</li>
                                        <li>Upload the screenshot below and submit this form</li>
                                        <li>Our team will verify your payment and send you a confirmation email</li>
                                    </ol>
                                </div>

                                <!-- Payment Meta Info (Limits, Fees, etc) -->
                                @if(isset($method->minimum) || isset($method->maximum) || isset($method->charges_amount))
                                <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                                    <div class="grid grid-cols-1 sm:grid-cols-4 gap-3 text-center">
                                        <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-3 flex flex-col items-center justify-center sm:col-span-4">
                                            <button
                                                type="button"
                                                onclick="printReceipt()"
                                                class="inline-flex items-center gap-2 px-4 py-2.5 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-all duration-200"
                                            >
                                                <i data-lucide="printer" class="w-5 h-5"></i>
                                                <span>Print Payment Receipt</span>
                                            </button>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">
                                                Print a detailed receipt for your booking payment
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Payment Upload Form -->
                <div class="mt-8 pt-8 border-t border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                        <i data-lucide="file-up" class="w-5 h-5 text-primary-500"></i>
                        Upload Payment Proof
                    </h3>

                    <form action="{{ route('processPayment') }}" method="POST" enctype="multipart/form-data" class="space-y-6" x-data="{ selectedPaymentMethod: '{{ $payment_methods[0]->name }}' }">
                        @csrf
                        <input type="hidden" name="booking_reference" value="{{ $booking->booking_reference }}">
                        <input type="hidden" id="payment_method" name="payment_method" x-model="selectedPaymentMethod">

                        <div class="space-y-6">
                            <!-- Confirmation Banner -->
                            <div class="bg-blue-50 dark:bg-blue-900/30 border border-blue-200 dark:border-blue-800 rounded-lg p-4 flex items-start gap-3">
                                <div class="text-blue-500 mt-0.5">
                                    <i data-lucide="info" class="w-5 h-5"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-blue-800 dark:text-blue-300 mb-1">Payment Confirmation</h4>
                                    <p class="text-sm text-blue-700 dark:text-blue-400">
                                        After sending your payment using <span class="font-semibold" x-text="selectedPaymentMethod"></span>,
                                        upload a screenshot of your transaction confirmation below.
                                    </p>
                                </div>
                            </div>

                            <!-- File Upload -->
                            <div>
                                <div class="relative">
                                    <input type="file"
                                           id="proof"
                                           name="proof"
                                           accept="image/*"
                                           required
                                           class="hidden"
                                           @change="handleFileUpload($event)">

                                    <label for="proof"
                                           class="relative block w-full border-2 border-dashed border-gray-300 dark:border-gray-700 hover:border-primary-500 dark:hover:border-primary-500 rounded-xl p-8 text-center cursor-pointer transition-all duration-200"
                                           :class="{ 'border-primary-500 bg-primary-500/5 dark:bg-primary-500/10': isDragOver || fileName }"
                                           @dragover.prevent="isDragOver = true"
                                           @dragleave.prevent="isDragOver = false"
                                           @drop.prevent="handleFileDrop($event)">

                                        <div class="space-y-4">
                                            <div class="w-16 h-16 bg-primary-500/10 dark:bg-primary-500/20 rounded-full flex items-center justify-center mx-auto">
                                                <template x-if="!fileName">
                                                    <i data-lucide="upload-cloud" class="w-8 h-8 text-primary-500"></i>
                                                </template>
                                                <template x-if="fileName">
                                                    <i data-lucide="check-circle" class="w-8 h-8 text-primary-500"></i>
                                                </template>
                                            </div>

                                            <div x-show="!fileName">
                                                <p class="text-lg font-medium text-gray-900 dark:text-white">Drag and drop your payment proof</p>
                                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">or click to browse files (PNG, JPG, JPEG)</p>
                                            </div>

                                            <div x-show="fileName" class="space-y-2">
                                                <p class="text-lg font-medium text-gray-900 dark:text-white">File selected</p>
                                                <div class="flex items-center justify-center gap-2">
                                                    <i data-lucide="file" class="w-5 h-5 text-gray-500 dark:text-gray-400"></i>
                                                    <span x-text="fileName" class="text-sm text-gray-500 dark:text-gray-400 truncate max-w-xs"></span>
                                                    <span x-text="fileSize" class="text-xs text-gray-400 dark:text-gray-500"></span>
                                                </div>
                                                <button type="button" @click.prevent="removeFile" class="inline-flex items-center text-sm text-red-500 hover:text-red-600">
                                                    <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i>
                                                    Remove
                                                </button>
                                            </div>
                                        </div>
                                    </label>
                                </div>

                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                    The screenshot should clearly show the transaction details, including amount and destination
                                </p>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-6">
                            <button type="submit"
                                    :disabled="!fileName"
                                    class="w-full relative"
                                    :class="!fileName ? 'opacity-50 cursor-not-allowed' : 'hover:scale-[1.01] active:scale-[0.99]'">
                                <div class="relative bg-primary-600 text-white px-8 py-4 rounded-xl flex items-center justify-center gap-3 transition-all duration-200"
                                     :class="!fileName ? 'bg-primary-600/70' : 'bg-primary-600 hover:bg-primary-700'">
                                    <i data-lucide="send" class="w-5 h-5"></i>
                                    <span class="text-lg font-semibold">Submit Payment Proof</span>
                                </div>
                            </button>

                            <!-- Security Notice -->
                            <div class="mt-4 flex flex-col sm:flex-row items-center justify-center gap-2 text-sm text-gray-500 dark:text-gray-400">
                                <div class="flex items-center">
                                    <i data-lucide="shield-check" class="w-4 h-4 text-green-500 mr-1"></i>
                                    <span>Secure 256-bit encrypted connection</span>
                                </div>
                                <span class="hidden sm:inline">•</span>
                                <div class="flex items-center">
                                    <i data-lucide="lock" class="w-4 h-4 text-green-500 mr-1"></i>
                                    <span>Your payment information is protected</span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Help & Support -->
        <div class="mt-8 text-center">
            <p class="text-sm text-gray-500 dark:text-gray-400">
                Need help with your payment? <a href="#" class="text-primary-600 dark:text-primary-400 hover:underline">Contact our support team</a>
            </p>
        </div>
    </div>
</div>

<script>
    function paymentHandler() {
        return {
            fileName: '',
            fileSize: '',
            isDragOver: false,

            handleFileUpload(event) {
                const file = event.target.files[0];
                if (file) {
                    this.fileName = file.name;
                    this.fileSize = `${(file.size / 1024 / 1024).toFixed(2)}MB`;
                }
            },

            handleFileDrop(event) {
                this.isDragOver = false;
                const file = event.dataTransfer.files[0];
                if (file && file.type.startsWith('image/')) {
                    document.getElementById('proof').files = event.dataTransfer.files;
                    this.fileName = file.name;
                    this.fileSize = `${(file.size / 1024 / 1024).toFixed(2)}MB`;
                }
            },

            removeFile() {
                document.getElementById('proof').value = '';
                this.fileName = '';
                this.fileSize = '';
            }
        }
    }

    // Copy to clipboard function for payment details
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            // Show a temporary tooltip or notification
            const tooltip = document.createElement('div');
            tooltip.textContent = 'Copied to clipboard!';
            tooltip.style.position = 'fixed';
            tooltip.style.top = '50%';
            tooltip.style.left = '50%';
            tooltip.style.transform = 'translate(-50%, -50%)';
            tooltip.style.padding = '10px 20px';
            tooltip.style.backgroundColor = 'rgba(0,0,0,0.8)';
            tooltip.style.color = 'white';
            tooltip.style.borderRadius = '5px';
            tooltip.style.zIndex = '9999';
            tooltip.style.opacity = '0';
            tooltip.style.transition = 'opacity 0.3s ease';

            document.body.appendChild(tooltip);

            // Fade in
            setTimeout(() => {
                tooltip.style.opacity = '1';
            }, 10);

            // Remove after 2 seconds
            setTimeout(() => {
                tooltip.style.opacity = '0';
                setTimeout(() => {
                    document.body.removeChild(tooltip);
                }, 300);
            }, 2000);

        }).catch(function(err) {
            console.error('Could not copy text: ', err);
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        lucide.createIcons();
    });

    // Print receipt function
    function printReceipt() {
        // Create a new window for printing
        const printWindow = window.open('', '_blank', 'width=800,height=800');
        if (!printWindow) {
            alert("Please allow pop-ups to print the receipt.");
            return;
        }

        // Get the current date and time
        const now = new Date();
        const formattedDate = now.toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });

        const formattedTime = now.toLocaleTimeString('en-US', {
            hour: '2-digit',
            minute: '2-digit'
        });

        // Get selected payment method
        let selectedMethod = '{{ $payment_methods[0]->name }}';

        try {
            // First method: check for active buttons with the primary background
            const activeButtons = document.querySelectorAll('button[class*="bg-primary-50"], button[class*="dark:bg-primary-900"]');
            for (let btn of activeButtons) {
                const span = btn.querySelector('span');
                if (span && span.textContent) {
                    selectedMethod = span.textContent.trim();
                    break;
                }
            }

            // Second method: try Alpine.js data if first method fails
            if (!selectedMethod) {
                // Look for elements with x-data containing selectedMethod
                const alpineElements = document.querySelectorAll('[x-data*="selectedMethod"]');
                if (alpineElements.length > 0) {
                    // This is a hack to access Alpine.js data
                    const alpine = window.Alpine;
                    if (alpine) {
                        for (let el of alpineElements) {
                            const data = alpine.$data(el);
                            if (data && data.selectedMethod) {
                                selectedMethod = data.selectedMethod;
                                break;
                            }
                        }
                    }
                }
            }
        } catch (e) {
            console.error("Error getting selected payment method:", e);
        }

        // Create simplified receipt HTML
        printWindow.document.open();
        printWindow.document.write(`
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Payment Receipt - {{ $booking->booking_reference }}</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    line-height: 1.6;
                    color: #333;
                    max-width: 800px;
                    margin: 0 auto;
                    padding: 20px;
                }
                h1 {
                    color: #4f46e5;
                    text-align: center;
                }
                h2 {
                    color: #4f46e5;
                    border-bottom: 1px solid #eee;
                    padding-bottom: 5px;
                    margin-top: 25px;
                }
                .header {
                    text-align: center;
                    margin-bottom: 30px;
                    padding-bottom: 20px;
                    border-bottom: 2px solid #eee;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-bottom: 15px;
                }
                table td {
                    padding: 8px;
                }
                .label {
                    font-weight: bold;
                    width: 40%;
                }
                .total {
                    border-top: 2px solid #eee;
                    font-weight: bold;
                    font-size: 18px;
                }
                .notes {
                    background-color: #f9f9f9;
                    padding: 15px;
                    border-radius: 5px;
                    margin: 20px 0;
                }
                .footer {
                    text-align: center;
                    margin-top: 30px;
                    color: #777;
                    font-size: 14px;
                }
                @media print {
                    .no-print {
                        display: none;
                    }
                    button {
                        display: none;
                    }
                }
            </style>
        </head>
        <body>
            <div class="header">
                <h1>Celebrity Booking Payment Receipt</h1>
                <p>Receipt generated on ${formattedDate} at ${formattedTime}</p>
                <p><strong>Booking Reference:</strong> {{ $booking->booking_reference }}</p>
            </div>

            <h2>Customer Details</h2>
            <table>
                <tr>
                    <td class="label">Name:</td>
                    <td>{{ $booking->full_name }}</td>
                </tr>
                <tr>
                    <td class="label">Email:</td>
                    <td>{{ $booking->email }}</td>
                </tr>
                <tr>
                    <td class="label">Phone:</td>
                    <td>{{ $booking->phone }}</td>
                </tr>
            </table>

            <h2>Event Details</h2>
            <table>
                <tr>
                    <td class="label">Celebrity:</td>
                    <td>{{ $celebrity->name }}</td>
                </tr>
                <tr>
                    <td class="label">Event Type:</td>
                    <td>{{ $booking->event_type }}</td>
                </tr>
                <tr>
                    <td class="label">Event Date:</td>
                    <td>{{ $booking->event_date->format('F j, Y') }}</td>
                </tr>
                <tr>
                    <td class="label">Event Time:</td>
                    <td>{{ \Carbon\Carbon::parse($booking->event_time)->format('g:i A') }}</td>
                </tr>
                <tr>
                    <td class="label">Event Location:</td>
                    <td>{{ $booking->event_location }}</td>
                </tr>
            </table>

            <h2>Payment Details</h2>
            <table>
                <tr>
                    <td class="label">Payment Method:</td>
                    <td>${selectedMethod}</td>
                </tr>
                <tr>
                    <td class="label">Booking Fee:</td>
                    <td>${{ number_format($booking->booking_fee, 2) }}</td>
                </tr>
                <tr>
                    <td class="label">Service Fee:</td>
                    <td>${{ number_format($booking->service_fee, 2) }}</td>
                </tr>
                <tr class="total">
                    <td class="label">Total Amount:</td>
                    <td>${{ number_format($booking->total_amount, 2) }}</td>
                </tr>
            </table>

            <div class="notes">
                <p><strong>Note:</strong> This is a receipt for your booking payment. Please keep this receipt for your records.</p>
                <p>For any questions or concerns regarding your booking, please contact our support team.</p>
            </div>

            <div class="footer">
                <p>Thank you for your booking!</p>
                <p>&copy; ${new Date().getFullYear()} Celebrity Booking Platform. All rights reserved.</p>
            </div>

            <div class="no-print" style="text-align: center; margin-top: 30px;">
                <button onclick="window.print();" style="padding: 12px 24px; background-color: #4f46e5; color: white; border: none; border-radius: 5px; font-size: 16px; cursor: pointer;">
                    Print Receipt
                </button>
            </div>

            <script>
                // Auto print after a delay to ensure everything is loaded
                window.onload = function() {
                    setTimeout(function() {
                        window.print();
                    }, 1000);
                };
            </script>
        </body>
        </html>
        `);

        printWindow.document.close();
    }
    }
</script>

@endsection
