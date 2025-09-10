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
                            <i class="fas fa-reply text-success"></i> Reply to Contact Message
                        </h1>
                        <p class="mb-0 text-muted">Responding to: {{ $messageData['name'] ?? 'Customer' }} ({{ $messageData['email'] ?? 'No email' }})</p>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-home"></i> Back to Home
                        </a>
                        <a href="{{ route('admin.contact-messages.show', $message->id) }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Back to Message
                        </a>
                        <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-list"></i> All Messages
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

                <!-- Message Overview Cards -->
                <div class="row mb-4">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Customer Type</div>
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
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Message Status</div>
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
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Received</div>
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
                    <!-- Reply Form -->
                    <div class="col-lg-8">
                        <!-- Compose Reply Card -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">
                                    <i class="fas fa-edit"></i> Compose Reply
                                </h6>
                                <div class="dropdown no-arrow">
                                    <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right shadow">
                                        <div class="dropdown-header">Reply Options:</div>
                                        <a class="dropdown-item" href="#" onclick="clearForm()">
                                            <i class="fas fa-eraser fa-sm fa-fw mr-2"></i> Clear Form
                                        </a>
                                        <a class="dropdown-item" href="#" onclick="saveAsDraft()">
                                            <i class="fas fa-save fa-sm fa-fw mr-2"></i> Save as Draft
                                        </a>
                                        @if(isset($messageData['email']))
                                            <a class="dropdown-item" href="mailto:{{ $messageData['email'] }}?subject=Re: {{ str_replace('Contact Message: ', '', $message->title) }}">
                                                <i class="fas fa-external-link-alt fa-sm fa-fw mr-2"></i> Open Email Client
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.contact-messages.send-reply', $message->id) }}" method="POST" id="replyForm">
                                    @csrf

                                    <!-- Reply To Information -->
                                    <div class="alert alert-info border-left-4 border-left-info">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-info-circle mr-2"></i>
                                            <div>
                                                <strong>Replying to:</strong> {{ $messageData['name'] ?? 'Customer' }}
                                                <span class="text-muted">({{ $messageData['email'] ?? 'No email provided' }})</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Reply Subject -->
                                    <div class="form-group">
                                        <label for="reply_subject" class="font-weight-bold">Subject <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                            </div>
                                            <input type="text"
                                                   class="form-control @error('reply_subject') is-invalid @enderror"
                                                   id="reply_subject"
                                                   name="reply_subject"
                                                   value="{{ old('reply_subject', 'Re: ' . str_replace('Contact Message: ', '', $message->title)) }}"
                                                   required
                                                   placeholder="Enter reply subject">
                                        </div>
                                        @error('reply_subject')
                                            <div class="invalid-feedback">{{ $errors->first('reply_subject') }}</div>
                                        @enderror
                                    </div>

                                    <!-- Reply Message -->
                                    <div class="form-group">
                                        <label for="reply_message" class="font-weight-bold">Message <span class="text-danger">*</span></label>
                                        <textarea class="form-control @error('reply_message') is-invalid @enderror"
                                                  id="reply_message"
                                                  name="reply_message"
                                                  rows="15"
                                                  required
                                                  placeholder="Type your reply message here..."
                                                  style="resize: vertical;">{{ old('reply_message', "Dear " . ($messageData['name'] ?? 'Customer') . ",\n\nThank you for contacting us. ") }}</textarea>
                                        @error('reply_message')
                                            <div class="invalid-feedback">{{ $errors->first('reply_message') }}</div>
                                        @enderror
                                        <div class="d-flex justify-content-between align-items-center mt-2">
                                            <small class="text-muted">
                                                <span id="charCount">0</span>/5000 characters
                                            </small>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <button type="button" class="btn btn-outline-secondary" onclick="formatText('bold')" title="Bold">
                                                    <i class="fas fa-bold"></i>
                                                </button>
                                                <button type="button" class="btn btn-outline-secondary" onclick="formatText('italic')" title="Italic">
                                                    <i class="fas fa-italic"></i>
                                                </button>
                                                <button type="button" class="btn btn-outline-secondary" onclick="formatText('underline')" title="Underline">
                                                    <i class="fas fa-underline"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="form-group d-flex justify-content-between align-items-center">
                                        <div>
                                            <button type="submit" class="btn btn-success">
                                                <i class="fas fa-paper-plane"></i> Send Reply
                                            </button>
                                            <button type="button" class="btn btn-info ml-2" onclick="saveAsDraft()">
                                                <i class="fas fa-save"></i> Save Draft
                                            </button>
                                        </div>
                                        <div>
                                            <a href="{{ route('admin.contact-messages.show', $message->id) }}" class="btn btn-outline-secondary">
                                                <i class="fas fa-times"></i> Cancel
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Quick Reply Templates -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">
                                    <i class="fas fa-templates"></i> Quick Reply Templates
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="card border-left-4 border-left-primary h-100">
                                            <div class="card-body">
                                                <h6 class="card-title text-primary font-weight-bold">
                                                    <i class="fas fa-comment-dots"></i> General Inquiry Response
                                                </h6>
                                                <p class="card-text small text-muted">Standard response for general questions and inquiries</p>
                                                <button type="button" class="btn btn-sm btn-outline-primary" onclick="insertTemplate('general')">
                                                    <i class="fas fa-plus-circle"></i> Insert Template
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="card border-left-4 border-left-success h-100">
                                            <div class="card-body">
                                                <h6 class="card-title text-success font-weight-bold">
                                                    <i class="fas fa-star"></i> Booking Information
                                                </h6>
                                                <p class="card-text small text-muted">Response about celebrity booking process and requirements</p>
                                                <button type="button" class="btn btn-sm btn-outline-success" onclick="insertTemplate('booking')">
                                                    <i class="fas fa-plus-circle"></i> Insert Template
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="card border-left-4 border-left-warning h-100">
                                            <div class="card-body">
                                                <h6 class="card-title text-warning font-weight-bold">
                                                    <i class="fas fa-dollar-sign"></i> Pricing Information
                                                </h6>
                                                <p class="card-text small text-muted">Response about pricing, packages, and cost estimates</p>
                                                <button type="button" class="btn btn-sm btn-outline-warning" onclick="insertTemplate('pricing')">
                                                    <i class="fas fa-plus-circle"></i> Insert Template
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="card border-left-4 border-left-info h-100">
                                            <div class="card-body">
                                                <h6 class="card-title text-info font-weight-bold">
                                                    <i class="fas fa-tools"></i> Technical Support
                                                </h6>
                                                <p class="card-text small text-muted">Response for technical issues and support requests</p>
                                                <button type="button" class="btn btn-sm btn-outline-info" onclick="insertTemplate('support')">
                                                    <i class="fas fa-plus-circle"></i> Insert Template
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Customer Information Sidebar -->
                    <div class="col-lg-4">
                        <!-- Customer Info -->
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
                                            <p class="text-gray-600 mb-0">{{ $messageData['name'] ?? 'Not provided' }}</p>
                                        </div>

                                        <div class="mb-3">
                                            <h6 class="text-gray-900 font-weight-bold mb-1">Email Address</h6>
                                            <p class="text-gray-600 mb-0">
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
                                            <p class="text-gray-600 mb-0">
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
                                            <h6 class="text-gray-900 font-weight-bold mb-1">Priority Level</h6>
                                            <p class="text-gray-600 mb-0">
                                                @if(isset($messageData['priority']))
                                                    @if($messageData['priority'] === 'High')
                                                        <span class="badge badge-danger">High Priority</span>
                                                    @elseif($messageData['priority'] === 'Normal')
                                                        <span class="badge badge-warning">Normal Priority</span>
                                                    @else
                                                        <span class="badge badge-success">Low Priority</span>
                                                    @endif
                                                @else
                                                    <span class="badge badge-light">Not specified</span>
                                                @endif
                                            </p>
                                        </div>

                                        <div class="mb-3">
                                            <h6 class="text-gray-900 font-weight-bold mb-1">Account Status</h6>
                                            <p class="text-gray-600 mb-0">
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
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Original Message -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">
                                    <i class="fas fa-envelope"></i> Original Message
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <h6 class="text-gray-900 font-weight-bold mb-1">Received</h6>
                                    <p class="text-gray-600 mb-0">
                                        {{ $message->created_at->format('M j, Y') }}<br>
                                        <small class="text-muted">{{ $message->created_at->format('g:i A') }} ({{ $message->created_at->diffForHumans() }})</small>
                                    </p>
                                </div>

                                <div class="mb-3">
                                    <h6 class="text-gray-900 font-weight-bold mb-1">Subject</h6>
                                    <p class="text-gray-600 mb-0">{{ str_replace('Contact Message: ', '', $message->title) }}</p>
                                </div>

                                <div class="mb-0">
                                    <h6 class="text-gray-900 font-weight-bold mb-2">Message Content</h6>
                                    <div class="card bg-light border-0">
                                        <div class="card-body" style="max-height: 300px; overflow-y: auto;">
                                            <div style="white-space: pre-line; font-size: 14px; line-height: 1.6; color: #495057;">
                                                {{ $messageData['message'] ?? 'No message content available.' }}
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

            // Initialize character count on page load
            const textarea = document.getElementById('reply_message');
            const event = new Event('input');
            textarea.dispatchEvent(event);

            // Auto-save draft functionality
            let autoSaveTimer;
            $('#reply_message, #reply_subject').on('input', function() {
                clearTimeout(autoSaveTimer);
                autoSaveTimer = setTimeout(function() {
                    // Auto-save logic can be implemented here
                    console.log('Auto-saving draft...');
                }, 30000); // Auto-save every 30 seconds
            });
        });

        // Character counter
        document.getElementById('reply_message').addEventListener('input', function() {
            const charCount = this.value.length;
            const charCountElement = document.getElementById('charCount');
            charCountElement.textContent = charCount;

            if (charCount > 5000) {
                charCountElement.style.color = 'red';
                charCountElement.parentElement.classList.add('text-danger');
            } else if (charCount > 4500) {
                charCountElement.style.color = 'orange';
                charCountElement.parentElement.classList.remove('text-danger');
            } else {
                charCountElement.style.color = 'inherit';
                charCountElement.parentElement.classList.remove('text-danger');
            }
        });

        // Text formatting functions
        function formatText(format) {
            const textarea = document.getElementById('reply_message');
            const start = textarea.selectionStart;
            const end = textarea.selectionEnd;
            const selectedText = textarea.value.substring(start, end);

            if (selectedText) {
                let formattedText = selectedText;
                switch(format) {
                    case 'bold':
                        formattedText = `**${selectedText}**`;
                        break;
                    case 'italic':
                        formattedText = `*${selectedText}*`;
                        break;
                    case 'underline':
                        formattedText = `__${selectedText}__`;
                        break;
                }

                textarea.value = textarea.value.substring(0, start) + formattedText + textarea.value.substring(end);
                textarea.focus();
                textarea.setSelectionRange(start, start + formattedText.length);
            }
        }

        // Clear form function
        function clearForm() {
            if (confirm('Are you sure you want to clear the form? All unsaved changes will be lost.')) {
                document.getElementById('reply_subject').value = 'Re: {{ str_replace("Contact Message: ", "", $message->title ?? "") }}';
                document.getElementById('reply_message').value = 'Dear {{ $messageData["name"] ?? "Customer" }},\n\nThank you for contacting us. ';

                // Update character count
                const event = new Event('input');
                document.getElementById('reply_message').dispatchEvent(event);
            }
        }

        // Save as draft function
        function saveAsDraft() {
            const formData = new FormData(document.getElementById('replyForm'));
            formData.append('save_as_draft', '1');

            // Here you would implement the AJAX call to save as draft
            alert('Draft saved successfully! (Note: This is a placeholder - actual implementation needed)');
        }

        // Quick reply templates
        function insertTemplate(type) {
            const textarea = document.getElementById('reply_message');
            const customerName = '{{ $messageData["name"] ?? "Customer" }}';
            let template = '';

            switch(type) {
                case 'general':
                    template = `Dear ${customerName},

Thank you for contacting us. We have received your inquiry and appreciate you taking the time to reach out.

We will review your message and get back to you with a detailed response within 24 hours. If you have any urgent questions in the meantime, please don't hesitate to call us directly.

Best regards,
Customer Support Team
{{$settings->site_name}}`;
                    break;

                case 'booking':
                    template = `Dear ${customerName},

Thank you for your interest in our celebrity booking services. We're excited to help you make your event unforgettable.

Our booking process typically involves:
1. Initial consultation to understand your requirements
2. Celebrity availability check and scheduling
3. Quote preparation and contract negotiation
4. Booking confirmation and event coordination

We will review the details of your request and provide you with available options and pricing within 24-48 hours.

Best regards,
Booking Department
{{$settings->site_name}}`;
                    break;

                case 'pricing':
                    template = `Dear ${customerName},

Thank you for your inquiry about our pricing and packages.

Our pricing varies based on several factors including:
- Celebrity selection and availability
- Event type and duration
- Location and travel requirements
- Additional services requested

We will prepare a customized quote based on your specific requirements and send it to you within 24 hours. Our pricing is competitive and transparent, with no hidden fees.

Best regards,
Sales Team
{{$settings->site_name}}`;
                    break;

                case 'support':
                    template = `Dear ${customerName},

Thank you for contacting our technical support team. We understand how important it is to resolve technical issues quickly.

We have received your support request and our technical team is reviewing the details. We will:
1. Investigate the issue you're experiencing
2. Identify the root cause and potential solutions
3. Provide you with step-by-step resolution instructions

You can expect a response from our technical team within 4-6 hours during business hours (Monday-Friday, 9 AM - 6 PM).

Best regards,
Technical Support Team
{{$settings->site_name}}`;
                    break;
            }

            if (confirm('This will replace the current message content. Do you want to continue?')) {
                textarea.value = template;
                textarea.focus();

                // Update character count
                const event = new Event('input');
                textarea.dispatchEvent(event);
            }
        }
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

        /* Enhanced styling */
        .border-left-4 {
            border-left-width: 4px !important;
        }

        .form-control:focus {
            border-color: #4e73df;
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
        }

        .btn-group-sm > .btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
        }

        .card {
            transition: all 0.15s ease-in-out;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        }

        .template-card {
            cursor: pointer;
            transition: all 0.15s ease-in-out;
        }

        .template-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.1);
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

            .form-group .d-flex {
                flex-direction: column;
            }

            .form-group .d-flex > div {
                margin-bottom: 1rem;
            }
        }
        </style>
        @endsection
    </div>
@endsection
