<?php
if (Auth('admin')->User()->dashboard_style == 'light') {
    $text = 'dark';
} else {
    $text = 'light';
}
?>
@extends('layouts.app1')

@section('content')
    @include('admin.topmenu')
    @include('admin.sidebar')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <div>
                        <h1 class="h3 mb-0 text-{{ $text }}">
                            <i class="fas fa-comment-dots text-primary"></i> Contact Message Details
                        </h1>
                        <p class="mb-0 text-muted">{{ str_replace('Contact Message: ', '', $message->title) }}</p>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-home"></i> Back to Home
                        </a>
                        <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Back to Messages
                        </a>
                        <a href="{{ route('admin.contact-messages.reply', $message->id) }}" class="btn btn-success btn-sm">
                            <i class="fas fa-reply"></i> Reply
                        </a>
                        <a href="{{ route('admin.contact-messages.toggle-read', $message->id) }}" class="btn btn-info btn-sm">
                            <i class="fas fa-{{ $message->is_read ? 'envelope' : 'envelope-open' }}"></i>
                            {{ $message->is_read ? 'Mark Unread' : 'Mark Read' }}
                        </a>
                    </div>
                </div>

                <x-danger-alert />

                <!-- Status Messages -->
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                    <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <!-- Message Status Overview Cards -->
                <div class="row mb-4">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-{{ $message->is_read ? 'success' : 'warning' }} shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-{{ $message->is_read ? 'success' : 'warning' }} text-uppercase mb-1">Message Status</div>
                                        <div class="h5 mb-0 font-weight-bold text-{{ $text }}">
                                            {{ $message->is_read ? 'Read' : 'Unread' }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-{{ $message->is_read ? 'envelope-open' : 'envelope' }} fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">User Type</div>
                                        <div class="h5 mb-0 font-weight-bold text-{{ $text }}">
                                            {{ $message->user_id ? 'Registered' : 'Guest' }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-{{ $message->user_id ? 'user' : 'user-slash' }} fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-{{ isset($messageData['priority']) && $messageData['priority'] === 'High' ? 'danger' : (isset($messageData['priority']) && $messageData['priority'] === 'Normal' ? 'warning' : 'success') }} shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-{{ isset($messageData['priority']) && $messageData['priority'] === 'High' ? 'danger' : (isset($messageData['priority']) && $messageData['priority'] === 'Normal' ? 'warning' : 'success') }} text-uppercase mb-1">Priority Level</div>
                                        <div class="h5 mb-0 font-weight-bold text-{{ $text }}">
                                            {{ $messageData['priority'] ?? 'Low' }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-{{ isset($messageData['priority']) && $messageData['priority'] === 'High' ? 'exclamation-triangle' : 'info-circle' }} fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Received</div>
                                        <div class="h5 mb-0 font-weight-bold text-{{ $text }}">
                                            {{ $message->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-clock fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Message Content -->
                    <div class="col-lg-8">
                        <!-- Message Details Card -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">
                                    <i class="fas fa-comment-alt"></i> Message Content
                                </h6>
                                <div class="dropdown no-arrow">
                                    <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right shadow">
                                        <div class="dropdown-header">Message Actions:</div>
                                        <a class="dropdown-item" href="{{ route('admin.contact-messages.reply', $message->id) }}">
                                            <i class="fas fa-reply fa-sm fa-fw mr-2"></i> Reply to Message
                                        </a>
                                        @if(isset($messageData['email']))
                                            <a class="dropdown-item" href="mailto:{{ $messageData['email'] }}?subject=Re: {{ str_replace('Contact Message: ', '', $message->title) }}">
                                                <i class="fas fa-envelope fa-sm fa-fw mr-2"></i> Send Email
                                            </a>
                                        @endif
                                        <div class="dropdown-divider"></div>
                                        <form action="{{ route('admin.contact-messages.destroy', $message->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger"
                                                    onclick="return confirm('Are you sure you want to delete this message?')">
                                                <i class="fas fa-trash fa-sm fa-fw mr-2"></i> Delete Message
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Priority and Status Badges -->
                                <div class="mb-4">
                                    @if(isset($messageData['priority']))
                                        @if($messageData['priority'] === 'High')
                                            <span class="badge badge-danger badge-pill">
                                                <i class="fas fa-exclamation-triangle"></i> High Priority
                                            </span>
                                        @elseif($messageData['priority'] === 'Normal')
                                            <span class="badge badge-warning badge-pill">
                                                <i class="fas fa-exclamation-circle"></i> Normal Priority
                                            </span>
                                        @else
                                            <span class="badge badge-success badge-pill">
                                                <i class="fas fa-info-circle"></i> Low Priority
                                            </span>
                                        @endif
                                    @endif

                                    @if($message->is_read)
                                        <span class="badge badge-success badge-pill ml-2">
                                            <i class="fas fa-check-circle"></i> Read
                                        </span>
                                    @else
                                        <span class="badge badge-warning badge-pill ml-2">
                                            <i class="fas fa-envelope"></i> Unread
                                        </span>
                                    @endif
                                </div>

                                <!-- Message Subject -->
                                <div class="border-left-primary border-left-4 bg-light p-3 mb-4">
                                    <h5 class="mb-0 text-primary">{{ str_replace('Contact Message: ', '', $message->title) }}</h5>
                                </div>

                                <!-- Message Content -->
                                <div class="card bg-light border-0">
                                    <div class="card-body">
                                        <div class="message-content" style="white-space: pre-line; line-height: 1.8; font-size: 15px;">
                                            {{ $messageData['message'] ?? 'No message content available.' }}
                                        </div>
                                    </div>
                                </div>

                                <!-- Quick Actions -->
                                <div class="mt-4">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.contact-messages.reply', $message->id) }}" class="btn btn-success">
                                            <i class="fas fa-reply"></i> Reply to Customer
                                        </a>
                                        <a href="{{ route('admin.contact-messages.toggle-read', $message->id) }}" class="btn btn-info">
                                            <i class="fas fa-{{ $message->is_read ? 'envelope' : 'envelope-open' }}"></i>
                                            Mark as {{ $message->is_read ? 'Unread' : 'Read' }}
                                        </a>
                                        @if(isset($messageData['email']))
                                            <a href="mailto:{{ $messageData['email'] }}?subject=Re: {{ str_replace('Contact Message: ', '', $message->title) }}" class="btn btn-primary">
                                                <i class="fas fa-envelope"></i> Send Email
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Customer Information Sidebar -->
                    <div class="col-lg-4">
                        <!-- Customer Details Card -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">
                                    <i class="fas fa-user"></i> Customer Information
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <h6 class="text-gray-900 font-weight-bold mb-1">Full Name</h6>
                                            <p class="text-gray-600 mb-2">{{ $messageData['name'] ?? 'Not provided' }}</p>
                                        </div>

                                        <div class="mb-3">
                                            <h6 class="text-gray-900 font-weight-bold mb-1">Email Address</h6>
                                            <p class="text-gray-600 mb-2">
                                                @if(isset($messageData['email']))
                                                    <a href="mailto:{{ $messageData['email'] }}" class="text-primary">
                                                        {{ $messageData['email'] }}
                                                    </a>
                                                @else
                                                    Not provided
                                                @endif
                                            </p>
                                        </div>

                                        <div class="mb-3">
                                            <h6 class="text-gray-900 font-weight-bold mb-1">Phone Number</h6>
                                            <p class="text-gray-600 mb-2">
                                                @if(isset($messageData['phone']) && $messageData['phone'] !== 'Not provided')
                                                    <a href="tel:{{ $messageData['phone'] }}" class="text-primary">
                                                        {{ $messageData['phone'] }}
                                                    </a>
                                                @else
                                                    Not provided
                                                @endif
                                            </p>
                                        </div>

                                        <div class="mb-3">
                                            <h6 class="text-gray-900 font-weight-bold mb-1">Account Status</h6>
                                            <p class="text-gray-600 mb-2">
                                                @if($message->user_id)
                                                    <span class="badge badge-info">Registered User</span>
                                                    @if($message->user)
                                                        <br><small class="text-muted mt-1">Account: {{ $message->user->name }}</small>
                                                    @endif
                                                @else
                                                    <span class="badge badge-secondary">Guest User</span>
                                                @endif
                                            </p>
                                        </div>

                                        <div class="mb-3">
                                            <h6 class="text-gray-900 font-weight-bold mb-1">Message Category</h6>
                                            <p class="text-gray-600 mb-2">{{ str_replace('Contact Message: ', '', $message->title) }}</p>
                                        </div>

                                        <div class="mb-3">
                                            <h6 class="text-gray-900 font-weight-bold mb-1">Received Date</h6>
                                            <p class="text-gray-600 mb-0">
                                                {{ $message->created_at->format('M j, Y') }}<br>
                                                <small class="text-muted">{{ $message->created_at->format('g:i A') }} ({{ $message->created_at->diffForHumans() }})</small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Actions Card -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">
                                    <i class="fas fa-bolt"></i> Quick Actions
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="d-grid gap-2">
                                    @if(isset($messageData['email']))
                                        <a href="mailto:{{ $messageData['email'] }}?subject=Re: {{ str_replace('Contact Message: ', '', $message->title) }}"
                                           class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-envelope"></i> Send Email Reply
                                        </a>
                                    @endif

                                    @if(isset($messageData['phone']) && $messageData['phone'] !== 'Not provided')
                                        <a href="tel:{{ $messageData['phone'] }}" class="btn btn-outline-success btn-sm">
                                            <i class="fas fa-phone"></i> Call Customer
                                        </a>
                                    @endif

                                    <a href="{{ route('admin.contact-messages.reply', $message->id) }}" class="btn btn-outline-info btn-sm">
                                        <i class="fas fa-reply"></i> Send Formal Reply
                                    </a>

                                    @if($message->user)
                                        <a href="#" class="btn btn-outline-secondary btn-sm">
                                            <i class="fas fa-user"></i> View User Profile
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Message Timeline Card -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">
                                    <i class="fas fa-history"></i> Message Timeline
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="timeline">
                                    <div class="timeline-item">
                                        <div class="timeline-marker bg-primary"></div>
                                        <div class="timeline-content">
                                            <h6 class="timeline-title">Message Received</h6>
                                            <p class="timeline-description">
                                                Customer submitted their inquiry via contact form
                                            </p>
                                            <span class="timeline-date">{{ $message->created_at->format('M j, Y g:i A') }}</span>
                                        </div>
                                    </div>

                                    @if($message->is_read)
                                        <div class="timeline-item">
                                            <div class="timeline-marker bg-success"></div>
                                            <div class="timeline-content">
                                                <h6 class="timeline-title">Message Reviewed</h6>
                                                <p class="timeline-description">
                                                    Admin marked message as read
                                                </p>
                                                <span class="timeline-date">{{ $message->updated_at->format('M j, Y g:i A') }}</span>
                                            </div>
                                        </div>
                                    @else
                                        <div class="timeline-item">
                                            <div class="timeline-marker bg-warning"></div>
                                            <div class="timeline-content">
                                                <h6 class="timeline-title">Awaiting Review</h6>
                                                <p class="timeline-description">
                                                    Message is waiting for admin response
                                                </p>
                                                <span class="timeline-date">Pending</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @section('scripts')
        <script>
        $(document).ready(function() {
            // Initialize Bootstrap dropdowns
            $('.dropdown-toggle').dropdown();

            // Fix dropdown positioning issues
            $(document).on('click', '.dropdown-toggle', function(e) {
                e.preventDefault();
                e.stopPropagation();

                // Close all other dropdowns
                $('.dropdown-menu').removeClass('show');

                // Toggle current dropdown
                const $dropdown = $(this).next('.dropdown-menu');
                $dropdown.toggleClass('show');

                // Position dropdown correctly
                const buttonOffset = $(this).offset();
                const buttonHeight = $(this).outerHeight();
                const buttonWidth = $(this).outerWidth();

                $dropdown.css({
                    'position': 'absolute',
                    'top': buttonOffset.top + buttonHeight + 'px',
                    'left': (buttonOffset.left + buttonWidth - $dropdown.outerWidth()) + 'px',
                    'z-index': '1050'
                });
            });

            // Close dropdowns when clicking outside
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.dropdown').length) {
                    $('.dropdown-menu').removeClass('show');
                }
            });
        });
        </script>

        <style>
        /* Dropdown fixes */
        .dropdown {
            position: relative;
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 1000;
            display: none;
            float: left;
            min-width: 10rem;
            padding: 0.5rem 0;
            margin: 0.125rem 0 0;
            font-size: 0.875rem;
            color: #212529;
            text-align: left;
            list-style: none;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid rgba(0, 0, 0, 0.15);
            border-radius: 0.25rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.175);
        }

        .dropdown-menu.show {
            display: block;
        }

        .dropdown-menu-right {
            right: 0;
            left: auto;
        }

        .dropdown-item {
            display: block;
            width: 100%;
            padding: 0.25rem 1.5rem;
            clear: both;
            font-weight: 400;
            color: #212529;
            text-align: inherit;
            white-space: nowrap;
            background-color: transparent;
            border: 0;
            text-decoration: none;
        }

        .dropdown-item:hover,
        .dropdown-item:focus {
            color: #16181b;
            text-decoration: none;
            background-color: #f8f9fa;
        }

        .dropdown-divider {
            height: 0;
            margin: 0.5rem 0;
            overflow: hidden;
            border-top: 1px solid #e9ecef;
        }

        /* Timeline Styles */
        .timeline {
            position: relative;
            padding-left: 30px;
        }

        .timeline:before {
            content: '';
            position: absolute;
            left: 12px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #e9ecef;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 30px;
        }

        .timeline-item:last-child {
            margin-bottom: 0;
        }

        .timeline-marker {
            position: absolute;
            left: -42px;
            top: 0;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            border: 3px solid #fff;
            box-shadow: 0 0 0 3px #e9ecef;
        }

        .timeline-title {
            margin-bottom: 5px;
            font-size: 14px;
            font-weight: 600;
            color: #495057;
        }

        .timeline-description {
            margin-bottom: 5px;
            font-size: 13px;
            color: #6c757d;
            line-height: 1.4;
        }

        .timeline-date {
            font-size: 12px;
            color: #868e96;
            font-weight: 500;
        }

        .message-content {
            font-size: 15px;
            color: #495057;
            line-height: 1.8;
        }

        .border-left-4 {
            border-left-width: 4px !important;
        }

        .badge-pill {
            padding: 0.5rem 0.75rem;
            font-size: 0.875rem;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .d-flex.gap-2 > * {
                margin-bottom: 0.5rem;
            }

            .btn-group {
                flex-direction: column;
            }

            .btn-group .btn {
                border-radius: 0.25rem !important;
                margin-bottom: 0.25rem;
            }
        }
        </style>
        @endsection
    </div>
@endsection
