@extends('layouts.app')
@section('title', 'Manage Celebrity Bookings')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-calendar-check text-primary"></i> Celebrity Bookings Management
            </h1>
            <p class="mb-0 text-gray-600">Manage and track all celebrity booking requests</p>
        </div>
        <div class="d-flex gap-2">
            <a href="#" class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#bulkActionModal">
                <i class="fas fa-tasks"></i> Bulk Actions
            </a>
            <a href="#" class="btn btn-success btn-sm" onclick="window.print()">
                <i class="fas fa-print"></i> Print Report
            </a>
        </div>
    </div>

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

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Bookings</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $bookings->where('booking_status', 'pending')->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
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
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Approved Bookings</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $bookings->where('booking_status', 'approved')->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Completed Bookings</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $bookings->where('booking_status', 'completed')->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-trophy fa-2x text-gray-300"></i>
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
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Revenue</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                ${{ number_format($bookings->where('payment_status', 'paid')->sum('total_amount'), 2) }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Advanced Filters -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-filter"></i> Advanced Filters & Search
            </h6>
            <div class="dropdown no-arrow">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                    <div class="dropdown-header">Quick Actions:</div>
                    <a class="dropdown-item" href="{{ route('admin.bookings.index') }}?status=pending">
                        <i class="fas fa-clock fa-sm fa-fw mr-2 text-gray-400"></i> View Pending
                    </a>
                    <a class="dropdown-item" href="{{ route('admin.bookings.index') }}?status=approved">
                        <i class="fas fa-check fa-sm fa-fw mr-2 text-gray-400"></i> View Approved
                    </a>
                    <div class="dropdown-divider"></div>
                    <div class="dropdown-header">Export Options:</div>
                    <a class="dropdown-item" href="#" onclick="exportData('csv')">
                        <i class="fas fa-file-csv fa-sm fa-fw mr-2 text-gray-400"></i> Export CSV
                    </a>
                    <a class="dropdown-item" href="#" onclick="exportData('excel')">
                        <i class="fas fa-file-excel fa-sm fa-fw mr-2 text-gray-400"></i> Export Excel
                    </a>
                    <a class="dropdown-item" href="#" onclick="exportData('pdf')">
                        <i class="fas fa-file-pdf fa-sm fa-fw mr-2 text-gray-400"></i> Export PDF
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.bookings.index') }}" class="needs-validation" novalidate>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="status" class="form-label font-weight-bold">
                            <i class="fas fa-flag"></i> Booking Status
                        </label>
                        <select class="form-control" id="status" name="status">
                            <option value="">All Statuses</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>
                                <i class="fas fa-clock"></i> Pending
                            </option>
                            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>
                                <i class="fas fa-check-circle"></i> Approved
                            </option>
                            <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>
                                <i class="fas fa-trophy"></i> Completed
                            </option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>
                                <i class="fas fa-times-circle"></i> Cancelled
                            </option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>
                                <i class="fas fa-ban"></i> Rejected
                            </option>
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="payment_status" class="form-label font-weight-bold">
                            <i class="fas fa-credit-card"></i> Payment Status
                        </label>
                        <select class="form-control" id="payment_status" name="payment_status">
                            <option value="">All Payment Status</option>
                            <option value="pending" {{ request('payment_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="paid" {{ request('payment_status') == 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="refunded" {{ request('payment_status') == 'refunded' ? 'selected' : '' }}>Refunded</option>
                            <option value="cancelled" {{ request('payment_status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="celebrity" class="form-label font-weight-bold">
                            <i class="fas fa-star"></i> Celebrity
                        </label>
                        <select class="form-control select2" id="celebrity" name="celebrity_id">
                            <option value="">All Celebrities</option>
                            @foreach($celebrities as $celebrity)
                                <option value="{{ $celebrity->id }}" {{ request('celebrity_id') == $celebrity->id ? 'selected' : '' }}>
                                    {{ $celebrity->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="booking_type" class="form-label font-weight-bold">
                            <i class="fas fa-tag"></i> Booking Type
                        </label>
                        <select class="form-control" id="booking_type" name="booking_type">
                            <option value="">All Types</option>
                            <option value="booking" {{ request('booking_type') == 'booking' ? 'selected' : '' }}>Standard Booking</option>
                            <option value="donation" {{ request('booking_type') == 'donation' ? 'selected' : '' }}>Donation</option>
                            <option value="fan_card" {{ request('booking_type') == 'fan_card' ? 'selected' : '' }}>Fan Card</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="date_from" class="form-label font-weight-bold">
                            <i class="fas fa-calendar-alt"></i> Event Date From
                        </label>
                        <input type="date" class="form-control" id="date_from" name="date_from" value="{{ request('date_from') }}">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="date_to" class="form-label font-weight-bold">
                            <i class="fas fa-calendar-alt"></i> Event Date To
                        </label>
                        <input type="date" class="form-control" id="date_to" name="date_to" value="{{ request('date_to') }}">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label for="search" class="form-label font-weight-bold">
                            <i class="fas fa-search"></i> Search
                        </label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="search" name="search"
                                   placeholder="Search by reference, name, email..." value="{{ request('search') }}">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2 mb-3">
                        <label for="per_page" class="form-label font-weight-bold">
                            <i class="fas fa-list"></i> Per Page
                        </label>
                        <select class="form-control" id="per_page" name="per_page">
                            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="sort" class="form-label font-weight-bold">
                            <i class="fas fa-sort"></i> Sort By
                        </label>
                        <div class="row">
                            <div class="col-8">
                                <select class="form-control" id="sort" name="sort">
                                    <option value="created_at" {{ request('sort', 'created_at') == 'created_at' ? 'selected' : '' }}>Date Created</option>
                                    <option value="event_date" {{ request('sort') == 'event_date' ? 'selected' : '' }}>Event Date</option>
                                    <option value="booking_fee" {{ request('sort') == 'booking_fee' ? 'selected' : '' }}>Booking Fee</option>
                                    <option value="total_amount" {{ request('sort') == 'total_amount' ? 'selected' : '' }}>Total Amount</option>
                                    <option value="booking_status" {{ request('sort') == 'booking_status' ? 'selected' : '' }}>Status</option>
                                </select>
                            </div>
                            <div class="col-4">
                                <select class="form-control" id="direction" name="direction">
                                    <option value="desc" {{ request('direction', 'desc') == 'desc' ? 'selected' : '' }}>Descending</option>
                                    <option value="asc" {{ request('direction') == 'asc' ? 'selected' : '' }}>Ascending</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3 d-flex align-items-end">
                        <div class="btn-group w-100" role="group">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-filter"></i> Apply Filters
                            </button>
                            <a href="{{ route('admin.bookings.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-undo"></i> Reset
                            </a>
                            <button class="btn btn-info" type="button" onclick="toggleAdvancedFilters()">
                                <i class="fas fa-cog"></i> Advanced
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Enhanced Bookings Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-table"></i> All Celebrity Bookings
                <span class="badge badge-secondary">{{ $bookings->total() }} Total</span>
            </h6>
            <div class="d-flex">
                <div class="form-check mr-3">
                    <input class="form-check-input" type="checkbox" id="selectAll">
                    <label class="form-check-label" for="selectAll">
                        Select All
                    </label>
                </div>
                <button class="btn btn-sm btn-outline-primary" onclick="refreshTable()">
                    <i class="fas fa-sync"></i> Refresh
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="bookingsTable" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="3%">
                                <input type="checkbox" id="selectAllHeader" onchange="toggleSelectAll()">
                            </th>
                            <th width="8%">
                                <i class="fas fa-hashtag"></i> Reference
                            </th>
                            <th width="10%">
                                <i class="fas fa-tag"></i> Type
                            </th>
                            <th width="15%">
                                <i class="fas fa-star"></i> Celebrity
                            </th>
                            <th width="15%">
                                <i class="fas fa-user"></i> Customer
                            </th>
                            <th width="12%">
                                <i class="fas fa-calendar"></i> Event Date
                            </th>
                            <th width="10%">
                                <i class="fas fa-clipboard-list"></i> Event Type
                            </th>
                            <th width="8%">
                                <i class="fas fa-dollar-sign"></i> Amount
                            </th>
                            <th width="8%">
                                <i class="fas fa-flag"></i> Status
                            </th>
                            <th width="8%">
                                <i class="fas fa-credit-card"></i> Payment
                            </th>
                            <th width="12%">
                                <i class="fas fa-cogs"></i> Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $booking)
                        <tr class="booking-row" data-booking-id="{{ $booking->id }}"
                            data-status="{{ $booking->booking_status }}"
                            onclick="highlightRow(this)">
                            <td>
                                <input type="checkbox" class="booking-checkbox" value="{{ $booking->id }}"
                                       onclick="event.stopPropagation()">
                            </td>
                            <td>
                                <div class="d-flex flex-column">
                                    <span class="font-weight-bold text-primary">{{ $booking->booking_reference }}</span>
                                    <small class="text-muted">{{ $booking->created_at->format('M j, Y') }}</small>
                                </div>
                            </td>
                            <td>
                                <span class="badge badge-{{
                                    $booking->booking_type == 'booking' ? 'primary' :
                                    ($booking->booking_type == 'donation' ? 'success' : 'warning')
                                }} badge-pill">
                                    @if($booking->booking_type == 'booking')
                                        <i class="fas fa-calendar-check"></i> Booking
                                    @elseif($booking->booking_type == 'donation')
                                        <i class="fas fa-heart"></i> Donation
                                    @else
                                        <i class="fas fa-id-card"></i> Fan Card
                                    @endif
                                </span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($booking->celebrity && $booking->celebrity->photo)
                                        <img src="{{ asset('storage/' . $booking->celebrity->photo) }}"
                                             alt="{{ $booking->celebrity->name }}"
                                             class="img-profile rounded-circle mr-2"
                                             style="width: 35px; height: 35px; object-fit: cover;">
                                    @else
                                        <div class="bg-primary rounded-circle mr-2 d-flex align-items-center justify-content-center"
                                             style="width: 35px; height: 35px;">
                                            <i class="fas fa-user text-white"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="font-weight-bold">{{ $booking->celebrity->name ?? 'N/A' }}</div>
                                        <small class="text-muted">{{ $booking->celebrity->known_for ?? '' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column">
                                    <span class="font-weight-bold">{{ $booking->full_name }}</span>
                                    <small class="text-muted">
                                        <i class="fas fa-envelope"></i> {{ $booking->email }}
                                    </small>
                                    <small class="text-muted">
                                        <i class="fas fa-phone"></i> {{ $booking->phone }}
                                    </small>
                                    @if($booking->user_id)
                                        <small class="text-info">
                                            <i class="fas fa-user-check"></i> Registered User
                                        </small>
                                    @else
                                        <small class="text-warning">
                                            <i class="fas fa-user-times"></i> Guest Booking
                                        </small>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column">
                                    <span class="font-weight-bold">
                                        <i class="fas fa-calendar-day"></i> {{ $booking->event_date->format('M j, Y') }}
                                    </span>
                                    <small class="text-muted">
                                        <i class="fas fa-clock"></i> {{ \Carbon\Carbon::parse($booking->event_time)->format('g:i A') }}
                                    </small>
                                    @if($booking->duration > 0)
                                        <small class="text-muted">
                                            <i class="fas fa-hourglass-half"></i> {{ $booking->duration }} mins
                                        </small>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column">
                                    <span class="font-weight-bold">{{ $booking->event_type }}</span>
                                    @if($booking->event_location)
                                        <small class="text-muted">
                                            <i class="fas fa-map-marker-alt"></i> {{ Str::limit($booking->event_location, 20) }}
                                        </small>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column">
                                    <span class="font-weight-bold text-success">
                                        ${{ number_format($booking->total_amount, 2) }}
                                    </span>
                                    @if($booking->booking_fee > 0)
                                        <small class="text-muted">
                                            Fee: ${{ number_format($booking->booking_fee, 2) }}
                                        </small>
                                    @endif
                                    @if($booking->service_fee > 0)
                                        <small class="text-muted">
                                            Service: ${{ number_format($booking->service_fee, 2) }}
                                        </small>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <span class="badge badge-{{
                                    $booking->booking_status == 'pending' ? 'warning' :
                                    ($booking->booking_status == 'approved' ? 'primary' :
                                    ($booking->booking_status == 'completed' ? 'success' :
                                    ($booking->booking_status == 'cancelled' ? 'danger' : 'secondary')))
                                }} badge-pill">
                                    @switch($booking->booking_status)
                                        @case('pending')
                                            <i class="fas fa-clock"></i> Pending
                                            @break
                                        @case('approved')
                                            <i class="fas fa-check-circle"></i> Approved
                                            @break
                                        @case('completed')
                                            <i class="fas fa-trophy"></i> Completed
                                            @break
                                        @case('cancelled')
                                            <i class="fas fa-times-circle"></i> Cancelled
                                            @break
                                        @case('rejected')
                                            <i class="fas fa-ban"></i> Rejected
                                            @break
                                        @default
                                            {{ ucfirst($booking->booking_status) }}
                                    @endswitch
                                </span>
                            </td>
                            <td>
                                <span class="badge badge-{{
                                    $booking->payment_status == 'pending' ? 'warning' :
                                    ($booking->payment_status == 'paid' ? 'success' :
                                    ($booking->payment_status == 'refunded' ? 'info' : 'danger'))
                                }} badge-pill">
                                    @switch($booking->payment_status)
                                        @case('pending')
                                            <i class="fas fa-hourglass-half"></i> Pending
                                            @break
                                        @case('paid')
                                            <i class="fas fa-check-double"></i> Paid
                                            @break
                                        @case('refunded')
                                            <i class="fas fa-undo"></i> Refunded
                                            @break
                                        @case('cancelled')
                                            <i class="fas fa-times"></i> Cancelled
                                            @break
                                        @default
                                            {{ ucfirst($booking->payment_status) }}
                                    @endswitch
                                </span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <!-- View Button -->
                                    <a href="{{ route('admin.bookings.show', $booking->id) }}"
                                       class="btn btn-sm btn-outline-info"
                                       title="View Details"
                                       data-toggle="tooltip">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <!-- Edit Button -->
                                    <a href="{{ route('admin.bookings.edit', $booking->id) }}"
                                       class="btn btn-sm btn-outline-primary"
                                       title="Edit Booking"
                                       data-toggle="tooltip">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <!-- Quick Actions Dropdown -->
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                title="Quick Actions" data-toggle="tooltip">
                                            <i class="fas fa-cog"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @if($booking->booking_status == 'pending')
                                                <a class="dropdown-item text-success" href="#"
                                                   onclick="quickStatusUpdate({{ $booking->id }}, 'approved')">
                                                    <i class="fas fa-check fa-sm fa-fw mr-2"></i> Quick Approve
                                                </a>
                                                <a class="dropdown-item text-danger" href="#"
                                                   onclick="quickStatusUpdate({{ $booking->id }}, 'rejected')">
                                                    <i class="fas fa-times fa-sm fa-fw mr-2"></i> Quick Reject
                                                </a>
                                                <div class="dropdown-divider"></div>
                                            @endif

                                            @if($booking->booking_status == 'approved')
                                                <a class="dropdown-item text-success" href="#"
                                                   onclick="quickStatusUpdate({{ $booking->id }}, 'completed')">
                                                    <i class="fas fa-check-double fa-sm fa-fw mr-2"></i> Mark Complete
                                                </a>
                                            @endif

                                            @if($booking->booking_status != 'cancelled' && $booking->booking_status != 'completed')
                                                <a class="dropdown-item text-warning" href="#"
                                                   onclick="quickStatusUpdate({{ $booking->id }}, 'cancelled')">
                                                    <i class="fas fa-ban fa-sm fa-fw mr-2"></i> Cancel
                                                </a>
                                            @endif

                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#" onclick="sendEmail({{ $booking->id }})">
                                                <i class="fas fa-envelope fa-sm fa-fw mr-2"></i> Email Customer
                                            </a>
                                            <a class="dropdown-item" href="#" onclick="addNote({{ $booking->id }})">
                                                <i class="fas fa-sticky-note fa-sm fa-fw mr-2"></i> Add Note
                                            </a>

                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-danger" href="#"
                                               onclick="confirmDelete({{ $booking->id }}, '{{ $booking->booking_reference }}')">
                                                <i class="fas fa-trash fa-sm fa-fw mr-2"></i> Delete
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="11" class="text-center py-4">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="fas fa-inbox fa-3x text-gray-300 mb-3"></i>
                                    <h5 class="text-gray-500">No bookings found</h5>
                                    <p class="text-gray-400">Try adjusting your filters or search criteria</p>
                                    <a href="{{ route('admin.bookings.index') }}" class="btn btn-outline-primary">
                                        <i class="fas fa-refresh"></i> Clear Filters
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Enhanced Pagination -->
            @if($bookings->hasPages())
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="showing-info">
                    <span class="text-muted">
                        Showing {{ $bookings->firstItem() }} to {{ $bookings->lastItem() }} of {{ $bookings->total() }} results
                    </span>
                </div>
                <div class="pagination-wrapper">
                    {{ $bookings->appends(request()->query())->links() }}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
<!-- Bulk Action Modal -->
<div class="modal fade" id="bulkActionModal" tabindex="-1" role="dialog" aria-labelledby="bulkActionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bulkActionModalLabel">Bulk Actions</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="bulkActionForm">
                    <div class="form-group">
                        <label for="bulkAction">Select Action</label>
                        <select class="form-control" id="bulkAction" name="action" required>
                            <option value="">Choose an action...</option>
                            <option value="approve">Approve Selected Bookings</option>
                            <option value="reject">Reject Selected Bookings</option>
                            <option value="cancel">Cancel Selected Bookings</option>
                            <option value="delete">Delete Selected Bookings</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="bulkNotes">Notes (Optional)</label>
                        <textarea class="form-control" id="bulkNotes" name="notes" rows="3" placeholder="Add notes for this bulk action..."></textarea>
                    </div>
                    <div class="selected-count">
                        <span class="badge badge-info">0 bookings selected</span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="executeBulkAction()">Execute Action</button>
            </div>
        </div>
    </div>
</div>

<!-- Quick Status Update Modal -->
<div class="modal fade" id="quickStatusModal" tabindex="-1" role="dialog" aria-labelledby="quickStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="quickStatusModalLabel">Update Booking Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="quickStatusForm">
                    <input type="hidden" id="quickBookingId" name="booking_id">
                    <input type="hidden" id="quickStatus" name="status">
                    <div class="form-group">
                        <label for="quickNotes">Notes</label>
                        <textarea class="form-control" id="quickNotes" name="admin_notes" rows="3" placeholder="Add notes for this status update..."></textarea>
                    </div>
                </form>
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i>
                    <span id="quickStatusMessage"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="executeQuickStatus()">Update Status</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmModalLabel">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle"></i>
                    <strong>Warning!</strong> This action cannot be undone.
                </div>
                <p>Are you sure you want to permanently delete booking <strong id="deleteBookingRef"></strong>?</p>
                <p class="text-muted">This will remove all associated records and cannot be recovered.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete Permanently</button>
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
        placeholder: 'All Celebrities',
        width: '100%'
    });

    // Initialize tooltips
    $('[data-toggle="tooltip"]').tooltip();

    // Auto-refresh every 30 seconds
    setInterval(function() {
        updateBookingCounts();
    }, 30000);
});

// Toggle select all checkboxes
function toggleSelectAll() {
    const selectAllHeader = document.getElementById('selectAllHeader');
    const checkboxes = document.querySelectorAll('.booking-checkbox');

    checkboxes.forEach(checkbox => {
        checkbox.checked = selectAllHeader.checked;
    });

    updateSelectedCount();
}

// Update selected count
function updateSelectedCount() {
    const selectedCount = document.querySelectorAll('.booking-checkbox:checked').length;
    document.querySelector('.selected-count .badge').textContent = `${selectedCount} bookings selected`;
}

// Highlight table row on click
function highlightRow(row) {
    // Remove previous highlights
    document.querySelectorAll('.booking-row').forEach(r => r.classList.remove('table-active'));
    // Add highlight to clicked row
    row.classList.add('table-active');
}

// Quick status update
function quickStatusUpdate(bookingId, status) {
    document.getElementById('quickBookingId').value = bookingId;
    document.getElementById('quickStatus').value = status;

    const messages = {
        'approved': 'This will approve the booking and notify the customer.',
        'rejected': 'This will reject the booking and notify the customer.',
        'completed': 'This will mark the booking as completed.',
        'cancelled': 'This will cancel the booking and notify the customer.'
    };

    document.getElementById('quickStatusMessage').textContent = messages[status];
    $('#quickStatusModal').modal('show');
}

// Execute quick status update
function executeQuickStatus() {
    const form = document.getElementById('quickStatusForm');
    const formData = new FormData(form);
    const bookingId = formData.get('booking_id');

    // Create and submit form
    const submitForm = document.createElement('form');
    submitForm.method = 'POST';
    submitForm.action = `/admin/dashboard/bookings/${bookingId}/status`;

    // Add CSRF token
    const csrfToken = document.createElement('input');
    csrfToken.type = 'hidden';
    csrfToken.name = '_token';
    csrfToken.value = '{{ csrf_token() }}';
    submitForm.appendChild(csrfToken);

    // Add method
    const methodInput = document.createElement('input');
    methodInput.type = 'hidden';
    methodInput.name = '_method';
    methodInput.value = 'PUT';
    submitForm.appendChild(methodInput);

    // Add booking status
    const statusInput = document.createElement('input');
    statusInput.type = 'hidden';
    statusInput.name = 'booking_status';
    statusInput.value = formData.get('status');
    submitForm.appendChild(statusInput);

    // Add admin notes
    const notesInput = document.createElement('input');
    notesInput.type = 'hidden';
    notesInput.name = 'admin_notes';
    notesInput.value = formData.get('admin_notes');
    submitForm.appendChild(notesInput);

    document.body.appendChild(submitForm);
    submitForm.submit();
}

// Confirm delete
function confirmDelete(bookingId, bookingRef) {
    document.getElementById('deleteBookingRef').textContent = bookingRef;
    document.getElementById('confirmDeleteBtn').onclick = function() {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/dashboard/bookings/${bookingId}`;

        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        form.appendChild(csrfToken);

        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';
        form.appendChild(methodInput);

        document.body.appendChild(form);
        form.submit();
    };

    $('#deleteConfirmModal').modal('show');
}

// Send email to customer
function sendEmail(bookingId) {
    // Implement email functionality
    alert('Email functionality will be implemented');
}

// Add note to booking
function addNote(bookingId) {
    // Implement add note functionality
    alert('Add note functionality will be implemented');
}

// Execute bulk action
function executeBulkAction() {
    const selectedCheckboxes = document.querySelectorAll('.booking-checkbox:checked');
    const action = document.getElementById('bulkAction').value;

    if (selectedCheckboxes.length === 0) {
        alert('Please select at least one booking');
        return;
    }

    if (!action) {
        alert('Please select an action');
        return;
    }

    // Implement bulk action logic
    alert(`Bulk action "${action}" will be implemented for ${selectedCheckboxes.length} bookings`);
}

// Refresh table
function refreshTable() {
    location.reload();
}

// Export data
function exportData(format) {
    const currentUrl = new URL(window.location);
    currentUrl.searchParams.set('export', format);
    window.open(currentUrl.href, '_blank');
}

// Update booking counts (for real-time updates)
function updateBookingCounts() {
    // Implement AJAX call to update counts
    console.log('Updating booking counts...');
}

// Advanced filters toggle
function toggleAdvancedFilters() {
    // Implement advanced filters toggle
    console.log('Advanced filters toggled');
}

// Listen for checkbox changes
document.addEventListener('change', function(e) {
    if (e.target.classList.contains('booking-checkbox')) {
        updateSelectedCount();
    }
});
</script>
@endsection
