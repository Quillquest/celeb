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
                            <i class="fas fa-eye text-primary"></i> Celebrity Booking Details
                        </h1>
                        <p class="mb-0 text-muted">Reference: <strong>{{ $booking->booking_reference }}</strong></p>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary btn-sm shadow-sm">
                            <i class="fas fa-home fa-sm text-white-50"></i> Back to Home
                        </a>
                        <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="btn btn-primary btn-sm shadow-sm">
                            <i class="fas fa-edit fa-sm text-white-50"></i> Edit Booking
                        </a>
                        <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary btn-sm shadow-sm">
                            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to List
                        </a>
                        <div class="dropdown">
                            <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button"
                                data-bs-toggle="dropdown">
                                <i class="fas fa-cog"></i> Actions
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#" onclick="printBooking()">
                                    <i class="fas fa-print fa-sm fa-fw mr-2"></i> Print Details
                                </a>
                                <a class="dropdown-item" href="#" onclick="emailCustomer()">
                                    <i class="fas fa-envelope fa-sm fa-fw mr-2"></i> Email Customer
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                    data-bs-target="#addNoteModal">
                                    <i class="fas fa-sticky-note fa-sm fa-fw mr-2"></i> Add Note
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <x-danger-alert />

                <!-- Status Messages -->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                        <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Overview Status Cards -->
                <div class="row mb-4">
                    <!-- Booking Status Card -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div
                            class="card border-left-{{ $booking->booking_status == 'pending'
                                ? 'warning'
                                : ($booking->booking_status == 'approved'
                                    ? 'primary'
                                    : ($booking->booking_status == 'completed'
                                        ? 'success'
                                        : ($booking->booking_status == 'cancelled'
                                            ? 'danger'
                                            : 'secondary'))) }} shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div
                                            class="text-xs font-weight-bold text-{{ $booking->booking_status == 'pending'
                                                ? 'warning'
                                                : ($booking->booking_status == 'approved'
                                                    ? 'primary'
                                                    : ($booking->booking_status == 'completed'
                                                        ? 'success'
                                                        : ($booking->booking_status == 'cancelled'
                                                            ? 'danger'
                                                            : 'secondary'))) }} text-uppercase mb-1">
                                            Booking Status</div>
                                        <div class="h6 mb-0 font-weight-bold text-{{ $text }}">
                                            {{ ucfirst($booking->booking_status) }}
                                        </div>
                                        <small class="text-muted">{{ $booking->created_at->format('M j, Y') }}</small>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-flag fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Status Card -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div
                            class="card border-left-{{ $booking->payment_status == 'pending'
                                ? 'warning'
                                : ($booking->payment_status == 'paid'
                                    ? 'success'
                                    : 'danger') }} shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div
                                            class="text-xs font-weight-bold text-{{ $booking->payment_status == 'pending'
                                                ? 'warning'
                                                : ($booking->payment_status == 'paid'
                                                    ? 'success'
                                                    : 'danger') }} text-uppercase mb-1">
                                            Payment Status</div>
                                        <div class="h6 mb-0 font-weight-bold text-{{ $text }}">
                                            {{ ucfirst($booking->payment_status) }}
                                        </div>
                                        @if ($booking->payment_date)
                                            <small
                                                class="text-muted">{{ $booking->payment_date->format('M j, Y') }}</small>
                                        @endif
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-credit-card fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Amount Card -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Amount
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-{{ $text }}">
                                            ${{ number_format($booking->total_amount, 2) }}
                                        </div>
                                        @if ($booking->booking_fee > 0 && $booking->service_fee > 0)
                                            <small class="text-muted">Fee: ${{ number_format($booking->booking_fee, 2) }} +
                                                Service: ${{ number_format($booking->service_fee, 2) }}</small>
                                        @endif
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Booking Type Card -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Booking Type
                                        </div>
                                        <div class="h6 mb-0 font-weight-bold text-{{ $text }}">
                                            {{ ucfirst(str_replace('_', ' ', $booking->booking_type)) }}
                                        </div>
                                        <small class="text-muted">
                                            @if ($booking->user_id)
                                                Registered User
                                            @else
                                                Guest Booking
                                            @endif
                                        </small>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-tag fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Main Booking Details -->
                    <div class="col-lg-8">
                        <!-- Celebrity & Event Information -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">
                                    <i class="fas fa-star"></i> Celebrity & Event Information
                                </h6>
                                <div class="dropdown no-arrow">
                                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right shadow">
                                        <a class="dropdown-item" href="#" onclick="copyEventDetails()">
                                            <i class="fas fa-copy fa-sm fa-fw mr-2"></i> Copy Event Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6 class="font-weight-bold text-primary border-bottom pb-2">Celebrity Information
                                        </h6>
                                        <div class="d-flex align-items-center mb-3">
                                            @if ($booking->celebrity && $booking->celebrity->photo)
                                                <img src="{{ asset('storage/' . $booking->celebrity->photo) }}"
                                                    alt="{{ $booking->celebrity->name }}"
                                                    class="img-profile rounded-circle mr-3"
                                                    style="width: 60px; height: 60px; object-fit: cover;">
                                            @else
                                                <div class="bg-primary rounded-circle mr-3 d-flex align-items-center justify-content-center"
                                                    style="width: 60px; height: 60px;">
                                                    <i class="fas fa-user fa-2x text-white"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <h5 class="mb-0">{{ $booking->celebrity->name ?? 'N/A' }}</h5>
                                                <p class="mb-0 text-muted">{{ $booking->celebrity->known_for ?? '' }}</p>
                                                @if ($booking->celebrity && $booking->celebrity->booking_fee)
                                                    <small class="text-success">Base Fee:
                                                        ${{ number_format($booking->celebrity->booking_fee, 2) }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="font-weight-bold text-success border-bottom pb-2">Event Details</h6>
                                        <div class="row">
                                            <div class="col-12 mb-2">
                                                <strong><i class="fas fa-clipboard-list text-primary"></i> Event
                                                    Type:</strong>
                                                <span class="ml-2">{{ $booking->event_type }}</span>
                                            </div>
                                            <div class="col-12 mb-2">
                                                <strong><i class="fas fa-map-marker-alt text-danger"></i>
                                                    Location:</strong>
                                                <span class="ml-2">{{ $booking->event_location }}</span>
                                            </div>
                                            <div class="col-6 mb-2">
                                                <strong><i class="fas fa-calendar text-info"></i> Date:</strong>
                                                <br><span
                                                    class="ml-4">{{ $booking->event_date->format('M j, Y') }}</span>
                                            </div>
                                            <div class="col-6 mb-2">
                                                <strong><i class="fas fa-clock text-warning"></i> Time:</strong>
                                                <br><span
                                                    class="ml-4">{{ \Carbon\Carbon::parse($booking->event_time)->format('g:i A') }}</span>
                                            </div>
                                            @if ($booking->duration > 0)
                                                <div class="col-12 mb-2">
                                                    <strong><i class="fas fa-hourglass-half text-secondary"></i>
                                                        Duration:</strong>
                                                    <span class="ml-2">{{ $booking->duration }} minutes</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                @if ($booking->special_requests)
                                    <div class="mt-4">
                                        <h6 class="font-weight-bold text-warning border-bottom pb-2">
                                            <i class="fas fa-star"></i> Special Requests
                                        </h6>
                                        <div class="bg-light p-3 rounded">
                                            {{ $booking->special_requests }}
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Payment Information -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">
                                    <i class="fas fa-credit-card"></i> Payment Information
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6 class="font-weight-bold text-success border-bottom pb-2">Payment Breakdown</h6>
                                        <div class="table-responsive">
                                            <table class="table table-sm">
                                                <tbody>
                                                    @if ($booking->booking_fee > 0)
                                                        <tr>
                                                            <td><strong>Booking Fee:</strong></td>
                                                            <td class="text-right">
                                                                ${{ number_format($booking->booking_fee, 2) }}</td>
                                                        </tr>
                                                    @endif
                                                    @if ($booking->service_fee > 0)
                                                        <tr>
                                                            <td><strong>Service Fee:</strong></td>
                                                            <td class="text-right">
                                                                ${{ number_format($booking->service_fee, 2) }}</td>
                                                        </tr>
                                                    @endif
                                                    <tr class="border-top">
                                                        <td><strong>Total Amount:</strong></td>
                                                        <td class="text-right"><strong
                                                                class="text-success">${{ number_format($booking->total_amount, 2) }}</strong>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h6 class="font-weight-bold text-info border-bottom pb-2">Payment Details</h6>
                                        <div class="mb-2">
                                            <strong>Payment Method:</strong>
                                            <span class="ml-2">{{ $booking->payment_method ?? 'Not specified' }}</span>
                                        </div>
                                        <div class="mb-2">
                                            <strong>Payment Status:</strong>
                                            <span class="ml-2">
                                                <span
                                                    class="badge badge-{{ $booking->payment_status == 'pending'
                                                        ? 'warning'
                                                        : ($booking->payment_status == 'paid'
                                                            ? 'success'
                                                            : 'danger') }}">
                                                    {{ ucfirst($booking->payment_status) }}
                                                </span>
                                            </span>
                                        </div>
                                        @if ($booking->payment_date)
                                            <div class="mb-2">
                                                <strong>Payment Date:</strong>
                                                <span
                                                    class="ml-2">{{ $booking->payment_date->format('M j, Y g:i A') }}</span>
                                            </div>
                                        @endif
                                        @if ($booking->payment_proof)
                                            <div class="mb-2">
                                                <strong>Payment Proof:</strong>
                                                <a href="{{ $payment_proof_url ?? '#' }}" target="_blank"
                                                    class="btn btn-sm btn-outline-primary ml-2">
                                                    <i class="fas fa-eye"></i> View Proof
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Admin Notes -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">s
                                    <i class="fas fa-sticky-note"></i> Admin Notes & History
                                </h6>
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addNoteModal">
                                    <i class="fas fa-plus"></i> Add Note
                                </button>
                            </div>
                            <div class="card-body">
                                @if ($booking->admin_notes)
                                    <div class="bg-gray-100 p-3 rounded mb-3">
                                        <h6 class="font-weight-bold mb-2">Admin Notes:</h6>
                                        <div class="whitespace-pre-line">{{ $booking->admin_notes }}</div>
                                    </div>
                                @endif

                                @if ($booking->cancellation_reason)
                                    <div class="alert alert-warning">
                                        <h6 class="font-weight-bold mb-2">
                                            <i class="fas fa-ban"></i> Cancellation Reason:
                                        </h6>
                                        {{ $booking->cancellation_reason }}
                                    </div>
                                @endif

                                @if ($booking->notes)
                                    @php
                                        $notes = json_decode($booking->notes, true);
                                    @endphp
                                    @if ($notes && is_array($notes))
                                        <div class="bg-info text-white p-3 rounded">
                                            <h6 class="font-weight-bold mb-2">Additional Information:</h6>
                                            @foreach ($notes as $key => $value)
                                                @if ($key != 'type')
                                                    <div><strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong>
                                                        {{ $value }}</div>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif
                                @endif

                                @if (!$booking->admin_notes && !$booking->cancellation_reason)
                                    <p class="text-center text-gray-500">No notes have been added to this booking yet.</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar Information -->
                    <div class="col-lg-4">
                        <!-- Customer Information -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">
                                    <i class="fas fa-user"></i> Customer Information
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="text-center mb-3">
                                    <div class="bg-primary rounded-circle mx-auto d-flex align-items-center justify-content-center"
                                        style="width: 60px; height: 60px;">
                                        <i class="fas fa-user fa-2x text-white"></i>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">Full Name</label>
                                    <p class="mb-0">{{ $booking->full_name }}</p>
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">Email Address</label>
                                    <p class="mb-0">
                                        <a href="mailto:{{ $booking->email }}">{{ $booking->email }}</a>
                                    </p>
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold">Phone Number</label>
                                    <p class="mb-0">
                                        <a href="tel:{{ $booking->phone }}">{{ $booking->phone }}</a>
                                    </p>
                                </div>

                                @if ($booking->gender)
                                    <div class="form-group">
                                        <label class="font-weight-bold">Gender</label>
                                        <p class="mb-0">{{ ucfirst($booking->gender) }}</p>
                                    </div>
                                @endif

                                @if ($booking->address)
                                    <div class="form-group">
                                        <label class="font-weight-bold">Address</label>
                                        <p class="mb-0">{{ $booking->address }}</p>
                                    </div>
                                @endif

                                @if ($booking->user_id)
                                    <div class="form-group">
                                        <label class="font-weight-bold">User Account</label>
                                        <p class="mb-0">
                                            <a href="#" class="text-primary">
                                                <i class="fas fa-user-check"></i> View User Profile
                                            </a>
                                        </p>
                                    </div>
                                @else
                                    <div class="alert alert-info mb-0">
                                        <i class="fas fa-info-circle"></i> This booking was made without a user account.
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">
                                    <i class="fas fa-bolt"></i> Quick Actions
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <button class="btn btn-block btn-outline-primary" onclick="printBooking()">
                                            <i class="fas fa-print"></i> Print Booking Details
                                        </button>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-12">
                                        <button class="btn btn-block btn-outline-info" onclick="emailCustomer()">
                                            <i class="fas fa-envelope"></i> Email Customer
                                        </button>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-12">
                                        <button class="btn btn-block btn-outline-secondary" data-bs-toggle="modal"
                                            data-bs-target="#addNoteModal">
                                            <i class="fas fa-sticky-note"></i> Add Admin Note
                                        </button>
                                    </div>
                                </div>

                                <!-- Status Update Buttons -->
                                @if ($booking->booking_status == 'pending')
                                    <div class="row mb-3">
                                        <div class="col-6">
                                            <button class="btn btn-block btn-success btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#approveModal">
                                                <i class="fas fa-check"></i> Approve
                                            </button>
                                        </div>
                                        <div class="col-6">
                                            <button class="btn btn-block btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#rejectModal">
                                                <i class="fas fa-times"></i> Reject
                                            </button>
                                        </div>
                                    </div>
                                @endif

                                @if ($booking->booking_status == 'approved')
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <button class="btn btn-block btn-success" data-bs-toggle="modal"
                                                data-bs-target="#completeModal">
                                                <i class="fas fa-check-double"></i> Mark as Completed
                                            </button>
                                        </div>
                                    </div>
                                @endif

                                @if ($booking->booking_status != 'cancelled' && $booking->booking_status != 'completed')
                                    <div class="row">
                                        <div class="col-12">
                                            <button class="btn btn-block btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#cancelModal">
                                                <i class="fas fa-ban"></i> Cancel Booking
                                            </button>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Timeline -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">
                                    <i class="fas fa-history"></i> Booking Timeline
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="timeline">
                                    <div class="timeline-item">
                                        <div class="timeline-marker bg-primary"></div>
                                        <div class="timeline-content">
                                            <h6 class="mb-0">Booking Created</h6>
                                            <small
                                                class="text-muted">{{ $booking->created_at->format('M j, Y g:i A') }}</small>
                                        </div>
                                    </div>

                                    @if ($booking->payment_date)
                                        <div class="timeline-item">
                                            <div class="timeline-marker bg-success"></div>
                                            <div class="timeline-content">
                                                <h6 class="mb-0">Payment {{ ucfirst($booking->payment_status) }}</h6>
                                                <small
                                                    class="text-muted">{{ $booking->payment_date->format('M j, Y g:i A') }}</small>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="timeline-item">
                                        <div class="timeline-marker bg-info"></div>
                                        <div class="timeline-content">
                                            <h6 class="mb-0">Last Updated</h6>
                                            <small
                                                class="text-muted">{{ $booking->updated_at->format('M j, Y g:i A') }}</small>
                                        </div>
                                    </div>

                                    @if ($booking->event_date->isFuture())
                                        <div class="timeline-item">
                                            <div class="timeline-marker bg-warning"></div>
                                            <div class="timeline-content">
                                                <h6 class="mb-0">Scheduled Event</h6>
                                                <small class="text-muted">{{ $booking->event_date->format('M j, Y') }} at
                                                    {{ \Carbon\Carbon::parse($booking->event_time)->format('g:i A') }}</small>
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
    </div>

    <!-- Approve Modal -->
    <div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-labelledby="approveModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.bookings.updateStatus', $booking->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="booking_status" value="approved">
                    <div class="modal-header">
                        <h5 class="modal-title" id="approveModalLabel">
                            <i class="fas fa-check-circle text-success"></i> Approve Booking
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i>
                            This will approve the booking and send a confirmation email to the customer.
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="admin_notes">Approval Notes (Optional)</label>
                                    <textarea class="form-control" id="admin_notes" name="admin_notes" rows="3"
                                        placeholder="Add any notes or special instructions..."></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="payment_status_approve">Payment Status (Optional Override)</label>
                                    <select class="form-control" id="payment_status_approve" name="payment_status">
                                        <option value="">Auto (Recommended)</option>
                                        <option value="pending">Pending</option>
                                        <option value="paid">Paid</option>
                                        <option value="cancelled">Cancelled</option>
                                        <option value="refunded">Refunded</option>
                                    </select>
                                    <small class="form-text text-muted">Leave as "Auto" for intelligent payment status
                                        handling</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-check"></i> Approve Booking
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Reject Modal -->
    <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.bookings.updateStatus', $booking->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="booking_status" value="rejected">
                    <div class="modal-header">
                        <h5 class="modal-title" id="rejectModalLabel">
                            <i class="fas fa-times-circle text-danger"></i> Reject Booking
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle"></i>
                            This will reject the booking and notify the customer with the reason provided.
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="rejection_reason">Rejection Reason <span
                                            class="text-danger">*</span></label>
                                    <textarea class="form-control" id="rejection_reason" name="admin_notes" rows="3"
                                        placeholder="Provide a clear reason for rejection..." required></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="payment_status_reject">Payment Status (Optional Override)</label>
                                    <select class="form-control" id="payment_status_reject" name="payment_status">
                                        <option value="">Auto (Recommended)</option>
                                        <option value="pending">Pending</option>
                                        <option value="paid">Paid</option>
                                        <option value="cancelled">Cancelled</option>
                                        <option value="refunded">Refunded</option>
                                    </select>
                                    <small class="form-text text-muted">Auto will set to "refunded" if paid, "cancelled" if
                                        pending</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-times"></i> Reject Booking
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Complete Modal -->
    <div class="modal fade" id="completeModal" tabindex="-1" role="dialog" aria-labelledby="completeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.bookings.updateStatus', $booking->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="booking_status" value="completed">
                    <div class="modal-header">
                        <h5 class="modal-title" id="completeModalLabel">
                            <i class="fas fa-trophy text-success"></i> Mark Booking as Completed
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-success">
                            <i class="fas fa-check-double"></i>
                            This will mark the booking as completed and finalize the transaction.
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="completion_notes">Completion Notes (Optional)</label>
                                    <textarea class="form-control" id="completion_notes" name="admin_notes" rows="3"
                                        placeholder="Add any feedback or notes about the completed event..."></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="payment_status_complete">Payment Status (Optional Override)</label>
                                    <select class="form-control" id="payment_status_complete" name="payment_status">
                                        <option value="">Auto (Recommended)</option>
                                        <option value="pending">Pending</option>
                                        <option value="paid">Paid</option>
                                        <option value="cancelled">Cancelled</option>
                                        <option value="refunded">Refunded</option>
                                    </select>
                                    <small class="form-text text-muted">Auto will set payment status to "paid"</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-check-double"></i> Mark Completed
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Cancel Modal -->
    <div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.bookings.cancel', $booking->id) }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="cancelModalLabel">
                            <i class="fas fa-ban text-warning"></i> Cancel Booking
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle"></i>
                            This will cancel the booking and may trigger refund processes if payment has been made.
                        </div>
                        <div class="form-group">
                            <label for="cancellation_reason">Cancellation Reason <span
                                    class="text-danger">*</span></label>
                            <textarea class="form-control" id="cancellation_reason" name="cancellation_reason" rows="3"
                                placeholder="Provide a detailed reason for cancellation..." required></textarea>
                            <small class="form-text text-muted">This reason will be shared with the customer via email
                                notification.</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-ban"></i> Cancel Booking
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add Note Modal -->
    <div class="modal fade" id="addNoteModal" tabindex="-1" role="dialog" aria-labelledby="addNoteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.bookings.addNote', $booking->id) }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addNoteModalLabel">
                            <i class="fas fa-sticky-note text-primary"></i> Add Admin Note
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="note_content">Note Content <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="note_content" name="note" rows="4"
                                placeholder="Add your admin note here..." required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Add Note
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <style>
        .timeline {
            position: relative;
            padding-left: 30px;
        }

        .timeline-item {
            position: relative;
            margin-bottom: 20px;
        }

        .timeline-marker {
            position: absolute;
            left: -35px;
            top: 5px;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            border: 2px solid #fff;
            box-shadow: 0 0 0 2px #dee2e6;
        }

        .timeline::before {
            content: '';
            position: absolute;
            left: -29px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #dee2e6;
        }

        .timeline-content h6 {
            color: #495057;
            font-size: 0.875rem;
        }
    </style>

    <script>
        $(document).ready(function() {
            // Initialize tooltips
            $('[data-toggle="tooltip"]').tooltip();
        });

        // Print booking details
        function printBooking() {
            window.print();
        }

        // Email customer
        function emailCustomer() {
            // You can implement email functionality here
            const email = '{{ $booking->email }}';
            const subject = 'Regarding your booking {{ $booking->booking_reference }}';
            window.location.href = `mailto:${email}?subject=${encodeURIComponent(subject)}`;
        }

        // Copy event details
        function copyEventDetails() {
            const eventDetails = `
Event Type: {{ $booking->event_type }}
Location: {{ $booking->event_location }}
Date: {{ $booking->event_date->format('M j, Y') }}
Time: {{ \Carbon\Carbon::parse($booking->event_time)->format('g:i A') }}
Duration: {{ $booking->duration }} minutes
Celebrity: {{ $booking->celebrity->name ?? 'N/A' }}
Customer: {{ $booking->full_name }}
Reference: {{ $booking->booking_reference }}
    `.trim();

            navigator.clipboard.writeText(eventDetails).then(function() {
                // Show success message
                const toast = $(
                    '<div class="alert alert-success alert-dismissible fade show position-fixed" style="top: 20px; right: 20px; z-index: 9999;">' +
                    '<i class="fas fa-check"></i> Event details copied to clipboard!' +
                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>'
                    );
                $('body').append(toast);
                setTimeout(() => toast.alert('close'), 3000);
            });
        }
    </script>
@endsection
