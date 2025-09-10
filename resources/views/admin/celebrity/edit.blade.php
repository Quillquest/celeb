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
                            <i class="fas fa-edit text-primary"></i> Edit Celebrity Booking
                        </h1>
                        <p class="mb-0 text-muted">Reference: <strong>{{ $booking->booking_reference }}</strong></p>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary btn-sm shadow-sm">
                            <i class="fas fa-home fa-sm text-white-50"></i> Back to Home
                        </a>
                        <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn btn-info btn-sm shadow-sm">
                            <i class="fas fa-eye fa-sm text-white-50"></i> View Details
                        </a>
                        <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary btn-sm shadow-sm">
                            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to List
                        </a>
                        <div class="dropdown">
                            <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
                                <i class="fas fa-cog"></i> Actions
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#" onclick="previewChanges()">
                                    <i class="fas fa-eye fa-sm fa-fw mr-2"></i> Preview Changes
                                </a>
                                <a class="dropdown-item" href="#" onclick="resetForm()">
                                    <i class="fas fa-undo fa-sm fa-fw mr-2"></i> Reset Form
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" onclick="printBooking()">
                                    <i class="fas fa-print fa-sm fa-fw mr-2"></i> Print Form
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
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                    <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                    <i class="fas fa-exclamation-triangle"></i> Please fix the following errors:
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif

                <!-- Overview Status Cards -->
                <div class="row mb-4">
                    <!-- Booking Status Card -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-{{
                            $booking->booking_status == 'pending' ? 'warning' :
                            ($booking->booking_status == 'approved' ? 'primary' :
                            ($booking->booking_status == 'completed' ? 'success' :
                            ($booking->booking_status == 'cancelled' ? 'danger' : 'secondary')))
                        }} shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-{{
                                            $booking->booking_status == 'pending' ? 'warning' :
                                            ($booking->booking_status == 'approved' ? 'primary' :
                                            ($booking->booking_status == 'completed' ? 'success' :
                                            ($booking->booking_status == 'cancelled' ? 'danger' : 'secondary')))
                                        }} text-uppercase mb-1">Booking Status</div>
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
                        <div class="card border-left-{{
                            $booking->payment_status == 'pending' ? 'warning' :
                            ($booking->payment_status == 'paid' ? 'success' : 'danger')
                        }} shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-{{
                                            $booking->payment_status == 'pending' ? 'warning' :
                                            ($booking->payment_status == 'paid' ? 'success' : 'danger')
                                        }} text-uppercase mb-1">Payment Status</div>
                                        <div class="h6 mb-0 font-weight-bold text-{{ $text }}">
                                            {{ ucfirst($booking->payment_status) }}
                                        </div>
                                        @if($booking->payment_date)
                                            <small class="text-muted">{{ $booking->payment_date->format('M j, Y') }}</small>
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
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Amount</div>
                                        <div class="h5 mb-0 font-weight-bold text-{{ $text }}">
                                            ${{ number_format($booking->total_amount, 2) }}
                                        </div>
                                        @if($booking->booking_fee > 0 && $booking->service_fee > 0)
                                            <small class="text-muted">Fee: ${{ number_format($booking->booking_fee, 2) }} + Service: ${{ number_format($booking->service_fee, 2) }}</small>
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
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Booking Type</div>
                                        <div class="h6 mb-0 font-weight-bold text-{{ $text }}">
                                            {{ ucfirst(str_replace('_', ' ', $booking->booking_type)) }}
                                        </div>
                                        <small class="text-muted">
                                            @if($booking->user_id)
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

                <!-- Edit Form -->
                <form action="{{ route('admin.bookings.updateStatus', $booking->id) }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <!-- Main Form Content -->
                        <div class="col-lg-8">
                            <!-- Customer Information -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        <i class="fas fa-user"></i> Customer Information
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="full_name" class="form-label font-weight-bold">
                                                    <i class="fas fa-id-card text-primary"></i> Full Name <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" class="form-control @error('full_name') is-invalid @enderror"
                                                       name="full_name" id="full_name" value="{{ old('full_name', $booking->full_name) }}" required>
                                                @error('full_name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email" class="form-label font-weight-bold">
                                                    <i class="fas fa-envelope text-info"></i> Email Address <span class="text-danger">*</span>
                                                </label>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                       name="email" id="email" value="{{ old('email', $booking->email) }}" required>
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="phone" class="form-label font-weight-bold">
                                                    <i class="fas fa-phone text-success"></i> Phone Number <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                                       name="phone" id="phone" value="{{ old('phone', $booking->phone) }}" required>
                                                @error('phone')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="gender" class="form-label font-weight-bold">
                                                    <i class="fas fa-venus-mars text-secondary"></i> Gender
                                                </label>
                                                <select class="form-control @error('gender') is-invalid @enderror" name="gender" id="gender">
                                                    <option value="">Select Gender</option>
                                                    <option value="male" {{ old('gender', $booking->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                                    <option value="female" {{ old('gender', $booking->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                                    <option value="other" {{ old('gender', $booking->gender) == 'other' ? 'selected' : '' }}>Other</option>
                                                </select>
                                                @error('gender')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="address" class="form-label font-weight-bold">
                                            <i class="fas fa-map-marker-alt text-warning"></i> Address
                                        </label>
                                        <textarea class="form-control @error('address') is-invalid @enderror"
                                                  name="address" id="address" rows="3">{{ old('address', $booking->address) }}</textarea>
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- Event Information -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        <i class="fas fa-calendar-alt"></i> Event Information
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="celebrity_id" class="form-label font-weight-bold">
                                                    <i class="fas fa-star text-warning"></i> Celebrity <span class="text-danger">*</span>
                                                </label>
                                                <select class="form-control select2 @error('celebrity_id') is-invalid @enderror"
                                                        name="celebrity_id" id="celebrity_id" required>
                                                    <option value="">Select Celebrity</option>
                                                    @foreach($celebrities as $celebrity)
                                                        <option value="{{ $celebrity->id }}" {{ old('celebrity_id', $booking->celebrity_id) == $celebrity->id ? 'selected' : '' }}>
                                                            {{ $celebrity->name }} - {{ $celebrity->known_for }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('celebrity_id')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="booking_type" class="form-label font-weight-bold">
                                                    <i class="fas fa-tag text-info"></i> Booking Type <span class="text-danger">*</span>
                                                </label>
                                                <select class="form-control @error('booking_type') is-invalid @enderror"
                                                        name="booking_type" id="booking_type" required>
                                                    <option value="booking" {{ old('booking_type', $booking->booking_type) == 'booking' ? 'selected' : '' }}>Standard Booking</option>
                                                    <option value="donation" {{ old('booking_type', $booking->booking_type) == 'donation' ? 'selected' : '' }}>Donation</option>
                                                    <option value="fan_card" {{ old('booking_type', $booking->booking_type) == 'fan_card' ? 'selected' : '' }}>VIP Fan Card</option>
                                                </select>
                                                @error('booking_type')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="event_type" class="form-label font-weight-bold">
                                                    <i class="fas fa-clipboard-list text-primary"></i> Event Type <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" class="form-control @error('event_type') is-invalid @enderror"
                                                       name="event_type" id="event_type" value="{{ old('event_type', $booking->event_type) }}" required>
                                                @error('event_type')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="event_location" class="form-label font-weight-bold">
                                                    <i class="fas fa-map-pin text-danger"></i> Event Location <span class="text-danger">*</span>
                                                </label>
                                                <input type="text" class="form-control @error('event_location') is-invalid @enderror"
                                                       name="event_location" id="event_location" value="{{ old('event_location', $booking->event_location) }}" required>
                                                @error('event_location')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="event_date" class="form-label font-weight-bold">
                                                    <i class="fas fa-calendar text-info"></i> Event Date <span class="text-danger">*</span>
                                                </label>
                                                <input type="date" class="form-control @error('event_date') is-invalid @enderror"
                                                       name="event_date" id="event_date" value="{{ old('event_date', $booking->event_date->format('Y-m-d')) }}" required>
                                                @error('event_date')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="event_time" class="form-label font-weight-bold">
                                                    <i class="fas fa-clock text-warning"></i> Event Time <span class="text-danger">*</span>
                                                </label>
                                                <input type="time" class="form-control @error('event_time') is-invalid @enderror"
                                                       name="event_time" id="event_time" value="{{ old('event_time', \Carbon\Carbon::parse($booking->event_time)->format('H:i')) }}" required>
                                                @error('event_time')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="duration" class="form-label font-weight-bold">
                                                    <i class="fas fa-hourglass-half text-secondary"></i> Duration (minutes) <span class="text-danger">*</span>
                                                </label>
                                                <input type="number" class="form-control @error('duration') is-invalid @enderror"
                                                       name="duration" id="duration" value="{{ old('duration', $booking->duration) }}" min="15" max="480" required>
                                                @error('duration')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    @if($booking->special_requests)
                                    <div class="form-group">
                                        <label for="special_requests" class="form-label font-weight-bold">
                                            <i class="fas fa-star text-warning"></i> Special Requests
                                        </label>
                                        <textarea class="form-control @error('special_requests') is-invalid @enderror"
                                                  name="special_requests" id="special_requests" rows="3">{{ old('special_requests', $booking->special_requests) }}</textarea>
                                        @error('special_requests')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Sidebar -->
                        <div class="col-lg-4">
                            <!-- Payment Information -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        <i class="fas fa-credit-card"></i> Payment Information
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="booking_fee" class="form-label font-weight-bold">
                                            Booking Fee <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input type="number" class="form-control @error('booking_fee') is-invalid @enderror"
                                                   name="booking_fee" id="booking_fee" step="0.01" min="0"
                                                   value="{{ old('booking_fee', $booking->booking_fee) }}" required>
                                            @error('booking_fee')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="service_fee" class="form-label font-weight-bold">
                                            Service Fee
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input type="number" class="form-control @error('service_fee') is-invalid @enderror"
                                                   name="service_fee" id="service_fee" step="0.01" min="0"
                                                   value="{{ old('service_fee', $booking->service_fee) }}" required>
                                            @error('service_fee')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="total_amount" class="form-label font-weight-bold">
                                            Total Amount <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
                                            </div>
                                            <input type="number" class="form-control @error('total_amount') is-invalid @enderror"
                                                   name="total_amount" id="total_amount" step="0.01" min="0"
                                                   value="{{ old('total_amount', $booking->total_amount) }}" readonly>
                                            @error('total_amount')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <small class="form-text text-muted">Auto-calculated from booking fee + service fee</small>
                                    </div>

                                    <div class="form-group">
                                        <label for="payment_method" class="form-label font-weight-bold">
                                            Payment Method
                                        </label>
                                        <select class="form-control @error('payment_method') is-invalid @enderror" name="payment_method" id="payment_method">
                                            <option value="">Select Payment Method</option>
                                            <option value="Bitcoin" {{ old('payment_method', $booking->payment_method) == 'Bitcoin' ? 'selected' : '' }}>Bitcoin</option>
                                            <option value="Bank Transfer" {{ old('payment_method', $booking->payment_method) == 'Bank Transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                            <option value="PayPal" {{ old('payment_method', $booking->payment_method) == 'PayPal' ? 'selected' : '' }}>PayPal</option>
                                            <option value="Stripe" {{ old('payment_method', $booking->payment_method) == 'Stripe' ? 'selected' : '' }}>Stripe</option>
                                            <option value="Cash" {{ old('payment_method', $booking->payment_method) == 'Cash' ? 'selected' : '' }}>Cash</option>
                                            <option value="Other" {{ old('payment_method', $booking->payment_method) == 'Other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                        @error('payment_method')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="payment_status" class="form-label font-weight-bold">
                                            Payment Status <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-control @error('payment_status') is-invalid @enderror"
                                                name="payment_status" id="payment_status" required>
                                            <option value="pending" {{ old('payment_status', $booking->payment_status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="paid" {{ old('payment_status', $booking->payment_status) == 'paid' ? 'selected' : '' }}>Paid</option>
                                            <option value="refunded" {{ old('payment_status', $booking->payment_status) == 'refunded' ? 'selected' : '' }}>Refunded</option>
                                            <option value="cancelled" {{ old('payment_status', $booking->payment_status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                        @error('payment_status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    @if($booking->payment_date)
                                    <div class="form-group">
                                        <label class="form-label font-weight-bold">
                                            Payment Date
                                        </label>
                                        <input type="text" class="form-control"
                                               value="{{ $booking->payment_date->format('M j, Y g:i A') }}" readonly>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Status & Notes -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        <i class="fas fa-flag"></i> Status & Notes
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="booking_status" class="form-label font-weight-bold">
                                            Booking Status <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-control @error('booking_status') is-invalid @enderror"
                                                name="booking_status" id="booking_status" required>
                                            <option value="pending" {{ old('booking_status', $booking->booking_status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="approved" {{ old('booking_status', $booking->booking_status) == 'approved' ? 'selected' : '' }}>Approved</option>
                                            <option value="rejected" {{ old('booking_status', $booking->booking_status) == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                            <option value="completed" {{ old('booking_status', $booking->booking_status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="cancelled" {{ old('booking_status', $booking->booking_status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                        @error('booking_status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="admin_notes" class="form-label font-weight-bold">
                                            Admin Notes
                                        </label>
                                        <textarea class="form-control @error('admin_notes') is-invalid @enderror"
                                                  name="admin_notes" id="admin_notes" rows="5">{{ old('admin_notes', $booking->admin_notes) }}</textarea>
                                        <small class="form-text text-muted">Add new notes here. Previous notes will be preserved.</small>
                                        @error('admin_notes')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    @if($booking->cancellation_reason)
                                    <div class="form-group">
                                        <label class="form-label font-weight-bold">
                                            Cancellation Reason
                                        </label>
                                        <div class="alert alert-warning">
                                            {{ $booking->cancellation_reason }}
                                        </div>
                                    </div>
                                    @endif

                                    <div class="form-group">
                                        <label class="form-label font-weight-bold">
                                            Last Updated
                                        </label>
                                        <input type="text" class="form-control"
                                               value="{{ $booking->updated_at->format('M j, Y g:i A') }}" readonly>
                                    </div>
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
                                            <button type="button" class="btn btn-block btn-outline-primary" onclick="previewChanges()">
                                                <i class="fas fa-eye"></i> Preview Changes
                                            </button>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-block btn-success">
                                                <i class="fas fa-save"></i> Save Changes
                                            </button>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <button type="button" class="btn btn-block btn-warning" onclick="resetForm()">
                                                <i class="fas fa-undo"></i> Reset Form
                                            </button>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn btn-block btn-outline-info">
                                                <i class="fas fa-eye"></i> View Details
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<!-- Preview Changes Modal -->
<div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="previewModalLabel">
                    <i class="fas fa-eye"></i> Preview Changes
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="previewContent">
                    <!-- Preview content will be populated by JavaScript -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" onclick="$('#previewModal').modal('hide'); $('form').submit();">
                    <i class="fas fa-save"></i> Confirm & Save
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Initialize Select2
    $('.select2').select2({
        placeholder: 'Select Celebrity',
        width: '100%'
    });

    // Auto-calculate total amount
    $('#booking_fee, #service_fee').on('input change', function() {
        calculateTotal();
    });

    // Form validation
    $('form').on('submit', function(e) {
        if (!this.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
        }
        $(this).addClass('was-validated');
    });

    // Initialize tooltips
    $('[data-toggle="tooltip"]').tooltip();
});

// Calculate total amount
function calculateTotal() {
    const bookingFee = parseFloat($('#booking_fee').val()) || 0;
    const serviceFee = parseFloat($('#service_fee').val()) || 0;
    const totalAmount = bookingFee + serviceFee;

    $('#total_amount').val(totalAmount.toFixed(2));
}

// Print booking form
function printBooking() {
    window.print();
}

// Preview changes
function previewChanges() {
    const formData = new FormData($('form')[0]);
    let previewContent = '<div class="row">';

    // Customer Info
    previewContent += '<div class="col-md-6"><h6 class="font-weight-bold text-primary border-bottom pb-2">Customer Information</h6>';
    previewContent += '<p><strong><i class="fas fa-user text-primary"></i> Name:</strong> ' + formData.get('full_name') + '</p>';
    previewContent += '<p><strong><i class="fas fa-envelope text-info"></i> Email:</strong> ' + formData.get('email') + '</p>';
    previewContent += '<p><strong><i class="fas fa-phone text-success"></i> Phone:</strong> ' + formData.get('phone') + '</p>';
    previewContent += '<p><strong><i class="fas fa-venus-mars text-secondary"></i> Gender:</strong> ' + (formData.get('gender') || 'Not specified') + '</p>';
    if (formData.get('address')) {
        previewContent += '<p><strong><i class="fas fa-map-marker-alt text-warning"></i> Address:</strong> ' + formData.get('address') + '</p>';
    }
    previewContent += '</div>';

    // Event Info
    previewContent += '<div class="col-md-6"><h6 class="font-weight-bold text-success border-bottom pb-2">Event Information</h6>';
    previewContent += '<p><strong><i class="fas fa-clipboard-list text-primary"></i> Event Type:</strong> ' + formData.get('event_type') + '</p>';
    previewContent += '<p><strong><i class="fas fa-map-pin text-danger"></i> Location:</strong> ' + formData.get('event_location') + '</p>';
    previewContent += '<p><strong><i class="fas fa-calendar text-info"></i> Date:</strong> ' + formData.get('event_date') + '</p>';
    previewContent += '<p><strong><i class="fas fa-clock text-warning"></i> Time:</strong> ' + formData.get('event_time') + '</p>';
    previewContent += '<p><strong><i class="fas fa-hourglass-half text-secondary"></i> Duration:</strong> ' + formData.get('duration') + ' minutes</p>';
    previewContent += '</div>';

    previewContent += '</div><hr><div class="row">';

    // Payment Info
    previewContent += '<div class="col-md-6"><h6 class="font-weight-bold text-warning border-bottom pb-2">Payment Information</h6>';
    previewContent += '<p><strong>Booking Fee:</strong> $' + parseFloat(formData.get('booking_fee')).toFixed(2) + '</p>';
    previewContent += '<p><strong>Service Fee:</strong> $' + parseFloat(formData.get('service_fee')).toFixed(2) + '</p>';
    previewContent += '<p><strong>Total Amount:</strong> <span class="text-success">$' + parseFloat(formData.get('total_amount')).toFixed(2) + '</span></p>';
    previewContent += '<p><strong>Payment Status:</strong> <span class="badge badge-' +
        (formData.get('payment_status') == 'paid' ? 'success' :
         formData.get('payment_status') == 'pending' ? 'warning' : 'danger') + '">' +
        formData.get('payment_status') + '</span></p>';
    if (formData.get('payment_method')) {
        previewContent += '<p><strong>Payment Method:</strong> ' + formData.get('payment_method') + '</p>';
    }
    previewContent += '</div>';

    // Status Info
    previewContent += '<div class="col-md-6"><h6 class="font-weight-bold text-info border-bottom pb-2">Status Information</h6>';
    previewContent += '<p><strong>Booking Status:</strong> <span class="badge badge-' +
        (formData.get('booking_status') == 'completed' ? 'success' :
         formData.get('booking_status') == 'approved' ? 'primary' :
         formData.get('booking_status') == 'pending' ? 'warning' : 'danger') + '">' +
        formData.get('booking_status') + '</span></p>';
    if (formData.get('admin_notes')) {
        previewContent += '<p><strong>Admin Notes:</strong></p><div class="bg-light p-2 rounded small">' + formData.get('admin_notes').replace(/\n/g, '<br>') + '</div>';
    }
    previewContent += '</div>';

    previewContent += '</div>';

    $('#previewContent').html(previewContent);
    $('#previewModal').modal('show');
}

// Reset form
function resetForm() {
    if (confirm('Are you sure you want to reset all changes? This will reload the original data.')) {
        location.reload();
    }
}

// Status change warnings
$('#booking_status').on('change', function() {
    const status = $(this).val();
    const warnings = {
        'rejected': 'This will reject the booking and notify the customer.',
        'cancelled': 'This will cancel the booking and may trigger refund processes.',
        'completed': 'This will mark the booking as completed and finalize the transaction.'
    };

    $('.status-warning').remove();
    if (warnings[status]) {
        $(this).after('<small class="text-warning mt-1 d-block status-warning"><i class="fas fa-exclamation-triangle"></i> ' + warnings[status] + '</small>');
    }
});

// Payment status change warnings
$('#payment_status').on('change', function() {
    const status = $(this).val();
    const warnings = {
        'paid': 'This will mark the payment as received.',
        'refunded': 'This indicates the payment has been refunded to the customer.',
        'cancelled': 'This will mark the payment as cancelled.'
    };

    $('.payment-warning').remove();
    if (warnings[status]) {
        $(this).after('<small class="text-info mt-1 d-block payment-warning"><i class="fas fa-info-circle"></i> ' + warnings[status] + '</small>');
    }
});
</script>
@endsection
