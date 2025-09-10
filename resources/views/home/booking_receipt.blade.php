@extends('layouts.base1')
@section('title', $title)
@section('content')

    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 pt-16 pb-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mb-2">
            <!-- Progress Steps -->
            <div class="flex items-center mt-5 justify-center mb-12 overflow-x-auto pb-4">
                <div class="flex items-center space-x-2 sm:space-x-4 lg:space-x-8 min-w-max">
                    <div class="flex items-center">
                        <div class="w-8 h-8 sm:w-10 sm:h-10 bg-primary-500 rounded-full flex items-center justify-center">
                            <i data-lucide="check" class="w-4 h-4 sm:w-5 sm:h-5 text-white"></i>
                        </div>
                        <span
                            class="ml-2 sm:ml-3 text-xs sm:text-sm font-medium text-primary-600 dark:text-primary-400 hidden sm:inline">Booking
                            Details</span>
                        <span
                            class="ml-2 text-xs font-medium text-primary-600 dark:text-primary-400 sm:hidden">Details</span>
                    </div>
                    <div class="w-4 sm:w-8 h-0.5 bg-primary-500"></div>
                    <div class="flex items-center">
                        <div class="w-8 h-8 sm:w-10 sm:h-10 bg-primary-500 rounded-full flex items-center justify-center">
                            <i data-lucide="check" class="w-4 h-4 sm:w-5 sm:h-5 text-white"></i>
                        </div>
                        <span
                            class="ml-2 sm:ml-3 text-xs sm:text-sm font-medium text-primary-600 dark:text-primary-400 hidden sm:inline">Payment</span>
                        <span
                            class="ml-2 text-xs font-medium text-primary-600 dark:text-primary-400 sm:hidden">Payment</span>
                    </div>
                    <div class="w-4 sm:w-8 h-0.5 bg-primary-500"></div>
                    <div class="flex items-center">
                        <div class="w-8 h-8 sm:w-10 sm:h-10 bg-primary-500 rounded-full flex items-center justify-center">
                            <i data-lucide="check" class="w-4 h-4 sm:w-5 sm:h-5 text-white"></i>
                        </div>
                        <span
                            class="ml-2 sm:ml-3 text-xs sm:text-sm font-medium text-primary-600 dark:text-primary-400 hidden sm:inline">Confirmation</span>
                        <span
                            class="ml-2 text-xs font-medium text-primary-600 dark:text-primary-400 sm:hidden">Confirm</span>
                    </div>
                </div>
            </div>

            <!-- Success Animation -->
            <div class="text-center mb-10">
                <div
                    class="inline-flex items-center justify-center w-24 h-24 bg-green-100 dark:bg-green-900/30 rounded-full mb-6">
                    <div class="relative">
                        <svg class="w-16 h-16 text-green-500" viewBox="0 0 24 24" fill="none">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="animate-check" d="M7 13l3 3 7-7" stroke="currentColor" stroke-width="3"
                                stroke-linecap="round" stroke-linejoin="round" fill="none"></path>
                        </svg>
                    </div>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-3">Booking Complete!</h1>
                <p class="text-xl text-gray-600 dark:text-gray-400">Your booking request has been submitted successfully</p>
            </div>

            <!-- Booking Details Card -->
            <div
                class="bg-white dark:bg-gray-900 rounded-2xl shadow-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div
                    class="bg-gradient-to-r from-green-600/5 dark:from-green-600/10 to-blue-600/5 dark:to-blue-600/10 border-b border-gray-200 dark:border-gray-700 p-6">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-12 h-12 bg-primary-500/10 dark:bg-primary-500/20 rounded-xl flex items-center justify-center">
                                <i data-lucide="ticket" class="w-6 h-6 text-primary-500 dark:text-primary-400"></i>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Booking Confirmation</h2>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Reference:
                                    {{ $booking->booking_reference }}</p>
                            </div>
                        </div>
                        <div
                            class="inline-flex items-center px-4 py-2 bg-amber-100 dark:bg-amber-900/30 text-amber-800 dark:text-amber-400 rounded-full border border-amber-200 dark:border-amber-700/50">
                            <i data-lucide="clock" class="w-4 h-4 mr-2"></i>
                            <span class="text-sm font-medium">Status: Pending Approval</span>
                        </div>
                    </div>
                </div>

                <div class="p-6 space-y-6">
                    <!-- Celebrity Info -->
                    <div class="flex flex-col md:flex-row gap-6">
                        <div class="w-full md:w-1/3 lg:w-1/4">
                            <div class="relative rounded-xl overflow-hidden w-full aspect-square">
                                <img src="{{ asset('storage/' . $celebrity->photo) }}" alt="{{ $celebrity->name }}"
                                    class="w-full h-full object-cover object-center">
                            </div>
                        </div>
                        <div class="flex-1 space-y-4">
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $celebrity->name }}</h3>

                            <div class="flex flex-wrap gap-2">
                                @if (isset($celebrity->known_for))
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300">
                                        {{ $celebrity->known_for }}
                                    </span>
                                @endif

                                @if (isset($celebrity->country))
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 dark:bg-purple-900/30 text-purple-800 dark:text-purple-300">
                                        {{ $celebrity->country }}
                                    </span>
                                @endif
                            </div>

                            <div class="space-y-1">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500 dark:text-gray-400">Event Type:</span>
                                    <span
                                        class="font-medium text-gray-900 dark:text-white">{{ $booking->event_type }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500 dark:text-gray-400">Event Date:</span>
                                    <span
                                        class="font-medium text-gray-900 dark:text-white">{{ $booking->event_date->format('F j, Y') }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500 dark:text-gray-400">Event Time:</span>
                                    <span
                                        class="font-medium text-gray-900 dark:text-white">{{ \Carbon\Carbon::parse($booking->event_time)->format('g:i A') }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500 dark:text-gray-400">Duration:</span>
                                    <span class="font-medium text-gray-900 dark:text-white">{{ $booking->duration }}
                                        minutes</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500 dark:text-gray-400">Location:</span>
                                    <span
                                        class="font-medium text-gray-900 dark:text-white">{{ $booking->event_location }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="border-gray-200 dark:border-gray-700">

                    <!-- Booking & Payment Details -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Booking Details -->
                        <div class="space-y-4">
                            <h4 class="text-lg font-medium text-gray-900 dark:text-white flex items-center gap-2">
                                <i data-lucide="clipboard-list" class="w-5 h-5 text-gray-500 dark:text-gray-400"></i>
                                Booking Details
                            </h4>

                            <div class="space-y-2">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500 dark:text-gray-400">Booking Date:</span>
                                    <span
                                        class="font-medium text-gray-900 dark:text-white">{{ $booking->created_at->format('F j, Y') }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500 dark:text-gray-400">Booking Time:</span>
                                    <span
                                        class="font-medium text-gray-900 dark:text-white">{{ $booking->created_at->format('g:i A') }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500 dark:text-gray-400">Booking Status:</span>
                                    <span
                                        class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 dark:bg-amber-900/30 text-amber-800 dark:text-amber-400">
                                        Pending
                                    </span>
                                </div>

                                @if ($booking->special_requests)
                                    <div class="mt-3">
                                        <span class="text-sm text-gray-500 dark:text-gray-400">Special Requests:</span>
                                        <p
                                            class="mt-1 text-sm text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-800 p-3 rounded-lg">
                                            {{ $booking->special_requests }}
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Payment Details -->
                        <div class="space-y-4">
                            <h4 class="text-lg font-medium text-gray-900 dark:text-white flex items-center gap-2">
                                <i data-lucide="credit-card" class="w-5 h-5 text-gray-500 dark:text-gray-400"></i>
                                Payment Details
                            </h4>

                            <div class="space-y-2">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500 dark:text-gray-400">Payment Method:</span>
                                    <span
                                        class="font-medium text-gray-900 dark:text-white">{{ $booking->payment_method }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500 dark:text-gray-400">Payment Date:</span>
                                    <span
                                        class="font-medium text-gray-900 dark:text-white">{{ $booking->payment_date ? $booking->payment_date->format('F j, Y') : 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500 dark:text-gray-400">Payment Status:</span>
                                    <span
                                        class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 dark:bg-amber-900/30 text-amber-800 dark:text-amber-400">
                                        Pending Verification
                                    </span>
                                </div>
                            </div>

                            <!-- Cost Breakdown -->
                            <div
                                class="mt-4 p-4 bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">
                                <h5 class="font-medium text-sm text-gray-900 dark:text-white mb-3">Cost Breakdown</h5>
                                <div class="space-y-1 text-sm">
                                    <div class="flex justify-between">
                                        <span class="text-gray-500 dark:text-gray-400">Booking Fee:</span>
                                        <span
                                            class="text-gray-900 dark:text-white">${{ number_format($booking->booking_fee, 2) }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-500 dark:text-gray-400">Service Fee:</span>
                                        <span
                                            class="text-gray-900 dark:text-white">${{ number_format($booking->service_fee, 2) }}</span>
                                    </div>
                                    <div
                                        class="border-t border-gray-200 dark:border-gray-700 pt-2 mt-2 flex justify-between">
                                        <span class="font-medium text-gray-900 dark:text-white">Total Paid:</span>
                                        <span
                                            class="font-bold text-primary-600 dark:text-primary-400">${{ number_format($booking->total_amount, 2) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- What's Next Section -->
                    <div
                        class="bg-blue-50 dark:bg-blue-900/20 rounded-xl p-6 border border-blue-200 dark:border-blue-800/30">
                        <h4 class="text-lg font-medium text-gray-900 dark:text-white mb-3 flex items-center gap-2">
                            <i data-lucide="info" class="w-5 h-5 text-blue-500"></i>
                            What Happens Next?
                        </h4>

                        <ol class="list-decimal pl-5 space-y-3 text-gray-600 dark:text-gray-400">
                            <li>Our team will review your booking request and payment details</li>
                            <li>You will receive an email confirmation within 24-48 hours</li>
                            <li>Once approved, we will connect you with {{ $celebrity->name }}'s team to finalize
                                arrangements</li>
                            <li>A detailed itinerary will be sent to you 1 week before the event</li>
                        </ol>

                        <div class="mt-4 flex flex-wrap gap-3">
                            <a href="#"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                                <i data-lucide="mail" class="w-4 h-4 mr-2"></i>
                                Contact Support
                            </a>
                            <a href="javascript:;" data-action="print-receipt"
                                class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg transition-colors">
                                <i data-lucide="printer" class="w-4 h-4 mr-2"></i>
                                Print Receipt
                            </a>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-4">
                        <a href="{{ url('/') }}"
                            class="inline-flex items-center justify-center px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-colors flex-1">
                            <i data-lucide="home" class="w-5 h-5 mr-2"></i>
                            Return to Home
                        </a>
                        <a href="javascript:;" data-action="print-receipt"
                            class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 font-medium rounded-lg transition-colors flex-1">
                            <i data-lucide="printer" class="w-5 h-5 mr-2"></i>
                            Print Receipt
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes check {
            0% {
                stroke-dashoffset: 48;
                opacity: 0;
            }

            50% {
                opacity: 1;
            }

            100% {
                stroke-dashoffset: 0;
                opacity: 1;
            }
        }

        .animate-check {
            stroke-dasharray: 48;
            stroke-dashoffset: 48;
            animation: check 0.8s ease-in-out forwards;
            animation-delay: 0.3s;
        }
    </style>

    <script>
        /**
         * Print Receipt Functionality
         * Simple and effective receipt printing function
         */
        document.addEventListener('DOMContentLoaded', function() {
            // Set up event listeners for all print receipt buttons
            document.querySelectorAll('[data-action="print-receipt"]').forEach(function(button) {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    printReceipt();
                });
            });
        });

        // Print receipt function
        function printReceipt() {
            // Open a new window for printing
            const printWindow = window.open('', '_blank');
            if (!printWindow) {
                alert('Pop-up blocked. Please allow pop-ups for this site to print the receipt.');
                return;
            }

            // Format current date and time for the receipt
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

            // Create the receipt HTML content
            const receiptHTML = `<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt - {{ $booking->booking_reference }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        h1, h2 {
            color: #4f46e5;
        }
        h1 {
            text-align: center;
        }
        h2 {
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
        <h1>Celebrity Booking Receipt</h1>
        <p>Receipt generated on ${formattedDate} at ${formattedTime}</p>
        <p><strong>Booking Reference:</strong> {{ $booking->booking_reference }}</p>
        <p><strong>Status:</strong> Pending Approval</p>
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
            <td class="label">Duration:</td>
            <td>{{ $booking->duration }} minutes</td>
        </tr>
        <tr>
            <td class="label">Location:</td>
            <td>{{ $booking->event_location }}</td>
        </tr>
    </table>
    
    <h2>Booking Details</h2>
    <table>
        <tr>
            <td class="label">Booking Date:</td>
            <td>{{ $booking->created_at->format('F j, Y') }}</td>
        </tr>
        <tr>
            <td class="label">Booking Time:</td>
            <td>{{ $booking->created_at->format('g:i A') }}</td>
        </tr>
        <tr>
            <td class="label">Booking Status:</td>
            <td>Pending</td>
        </tr>
        @if ($booking->special_requests)
        <tr>
            <td class="label">Special Requests:</td>
            <td>{{ $booking->special_requests }}</td>
        </tr>
        @endif
    </table>
    
    <h2>Payment Details</h2>
    <table>
        <tr>
            <td class="label">Payment Method:</td>
            <td>{{ $booking->payment_method }}</td>
        </tr>
        <tr>
            <td class="label">Payment Date:</td>
            <td>{{ $booking->payment_date ? $booking->payment_date->format('F j, Y') : 'N/A' }}</td>
        </tr>
        <tr>
            <td class="label">Booking Fee:</td>
            <td>\${{ number_format($booking->booking_fee, 2) }}</td>
        </tr>
        <tr>
            <td class="label">Service Fee:</td>
            <td>\${{ number_format($booking->service_fee, 2) }}</td>
        </tr>
        <tr class="total">
            <td class="label">Total Amount:</td>
            <td>\${{ number_format($booking->total_amount, 2) }}</td>
        </tr>
    </table>
    
    <div class="notes">
        <p><strong>Note:</strong> This is a receipt for your booking. Please keep this receipt for your records.</p>
        <p>For any questions or concerns regarding your booking, please contact our support team.</p>
    </div>
    
    <div class="footer">
        <p>Thank you for your booking!</p>
        <p>&copy; ${now.getFullYear()} Celebrity Booking Platform. All rights reserved.</p>
    </div>
    
    <div class="no-print" style="text-align: center; margin-top: 30px;">
        <button onclick="window.print();" style="padding: 10px 20px; background-color: #4f46e5; color: white; border: none; border-radius: 5px; cursor: pointer;">
            Print Receipt
        </button>
    </div>
</body>
</html>`;

            // Write the content to the new window
            printWindow.document.open();
            printWindow.document.write(receiptHTML);
            printWindow.document.close();

            // Automatically trigger print when content has loaded
            printWindow.onload = function() {
                setTimeout(function() {
                    printWindow.focus();
                    printWindow.print();
                }, 500);
            };
        }
    </script>

@endsection
