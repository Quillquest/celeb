@extends('layouts.app')
@section('title', 'Celebrity Bookings Management')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">
                <i class="fas fa-star text-warning"></i> Celebrity Bookings Management
            </h1>
            <p class="mb-0 text-gray-600">Manage celebrity bookings, donations, and fan cards</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#bulkActionModal">
                <i class="fas fa-tasks"></i> Bulk Actions
            </button>
            <button class="btn btn-success btn-sm" onclick="exportBookings()">
                <i class="fas fa-download"></i> Export
            </button>
            <button class="btn btn-info btn-sm" onclick="refreshData()">
                <i class="fas fa-sync"></i> Refresh
            </button>
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

    <!-- Statistics Overview Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Approvals</div>
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
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Revenue</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                ${{ number_format($bookings->sum('total_amount'), 2) }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
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
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Bookings</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $bookings->count() }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters & Search -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-filter"></i> Search & Filter Bookings
            </h6>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.bookings.index') }}" class="row g-3">
                <div class="col-md-3">
                    <label class="form-label font-weight-bold">Search</label>
                    <input type="text" class="form-control" name="search"
                           value="{{ request('search') }}"
                           placeholder="Reference, customer name, email...">
                </div>

                <div class="col-md-2">
                    <label class="form-label font-weight-bold">Booking Status</label>
                    <select class="form-control" name="booking_status">
                        <option value="">All Statuses</option>
                        <option value="pending" {{ request('booking_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ request('booking_status') == 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ request('booking_status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        <option value="completed" {{ request('booking_status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ request('booking_status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label font-weight-bold">Payment Status</label>
                    <select class="form-control" name="payment_status">
                        <option value="">All Payments</option>
                        <option value="pending" {{ request('payment_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="paid" {{ request('payment_status') == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="refunded" {{ request('payment_status') == 'refunded' ? 'selected' : '' }}>Refunded</option>
                        <option value="cancelled" {{ request('payment_status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label font-weight-bold">Booking Type</label>
                    <select class="form-control" name="booking_type">
                        <option value="">All Types</option>
                        <option value="booking" {{ request('booking_type') == 'booking' ? 'selected' : '' }}>Booking</option>
                        <option value="donation" {{ request('booking_type') == 'donation' ? 'selected' : '' }}>Donation</option>
                        <option value="fan_card" {{ request('booking_type') == 'fan_card' ? 'selected' : '' }}>Fan Card</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label font-weight-bold">Date Range</label>
                    <input type="date" class="form-control mb-1" name="date_from"
                           value="{{ request('date_from') }}" placeholder="From">
                    <input type="date" class="form-control" name="date_to"
                           value="{{ request('date_to') }}" placeholder="To">
                </div>

                <div class="col-md-1 d-flex align-items-end">
                    <div class="btn-group-vertical w-100">
                        <button type="submit" class="btn btn-primary mb-1">
                            <i class="fas fa-search"></i> Filter
                        </button>
                        <a href="{{ route('admin.bookings.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-undo"></i> Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Bookings Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-table"></i> Celebrity Bookings List
            </h6>
            <div class="dropdown">
                <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-toggle="dropdown">
                    <i class="fas fa-cog"></i> Actions
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#" onclick="selectAllBookings()">
                        <i class="fas fa-check-square fa-sm fa-fw mr-2"></i> Select All
                    </a>
                    <a class="dropdown-item" href="#" onclick="deselectAllBookings()">
                        <i class="fas fa-square fa-sm fa-fw mr-2"></i> Deselect All
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#bulkActionModal">
                        <i class="fas fa-tasks fa-sm fa-fw mr-2"></i> Bulk Actions
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th width="30">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="selectAll" onchange="toggleAllCheckboxes(this)">
                                    <label class="custom-control-label" for="selectAll"></label>
                                </div>
                            </th>
                            <th width="150">Reference & Type</th>
                            <th width="200">Celebrity</th>
                            <th width="200">Customer Details</th>
                            <th width="150">Event Details</th>
                            <th width="100">Amount</th>
                            <th width="100">Booking Status</th>
                            <th width="100">Payment Status</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $booking)
                        <tr class="booking-row" data-booking-id="{{ $booking->id }}">
                            <td>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input booking-checkbox"
                                           id="booking{{ $booking->id }}" value="{{ $booking->id }}">
                                    <label class="custom-control-label" for="booking{{ $booking->id }}"></label>
                                </div>
                            </td>

                            <!-- Reference & Type -->
                            <td>
                                <div class="d-flex flex-column">
                                    <span class="font-weight-bold text-primary">{{ $booking->booking_reference }}</span>
                                    <small class="text-muted">{{ $booking->created_at->format('M j, Y g:i A') }}</small>
                                    <span class="badge badge-{{
                                        $booking->booking_type == 'booking' ? 'primary' :
                                        ($booking->booking_type == 'donation' ? 'success' : 'warning')
                                    }} badge-pill mt-1">
                                        {{ ucfirst(str_replace('_', ' ', $booking->booking_type)) }}
                                    </span>
                                </div>
                            </td>

                            <!-- Celebrity -->
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($booking->celebrity && $booking->celebrity->photo)
                                        <img src="{{ asset('storage/' . $booking->celebrity->photo) }}"
                                             alt="{{ $booking->celebrity->name }}"
                                             class="img-profile rounded-circle mr-2"
                                             style="width: 40px; height: 40px; object-fit: cover;">
                                    @else
                                        <div class="bg-primary rounded-circle mr-2 d-flex align-items-center justify-content-center"
                                             style="width: 40px; height: 40px;">
                                            <i class="fas fa-user text-white"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="font-weight-bold">{{ $booking->celebrity->name ?? 'N/A' }}</div>
                                        <small class="text-muted">{{ $booking->celebrity->known_for ?? '' }}</small>
                                    </div>
                                </div>
                            </td>

                            <!-- Customer Details -->
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

                            <!-- Event Details -->
                            <td>
                                <div class="d-flex flex-column">
                                    <span class="font-weight-bold">{{ $booking->event_type }}</span>
                                    <small class="text-muted">
                                        <i class="fas fa-calendar-day"></i> {{ $booking->event_date->format('M j, Y') }}
                                    </small>
                                    <small class="text-muted">
                                        <i class="fas fa-clock"></i> {{ \Carbon\Carbon::parse($booking->event_time)->format('g:i A') }}
                                    </small>
                                    @if($booking->event_location)
                                        <small class="text-muted">
                                            <i class="fas fa-map-marker-alt"></i> {{ Str::limit($booking->event_location, 25) }}
                                        </small>
                                    @endif
                                </div>
                            </td>

                            <!-- Amount -->
                            <td>
                                <div class="d-flex flex-column">
                                    <span class="font-weight-bold text-success">
                                        ${{ number_format($booking->total_amount, 2) }}
                                    </span>
                                    @if($booking->booking_fee > 0)
                                        <small class="text-muted">
                                            Base: ${{ number_format($booking->booking_fee, 2) }}
                                        </small>
                                    @endif
                                    @if($booking->service_fee > 0)
                                        <small class="text-muted">
                                            Service: ${{ number_format($booking->service_fee, 2) }}
                                        </small>
                                    @endif
                                </div>
                            </td>

                            <!-- Booking Status -->
                            <td>
                                <span class="badge badge-{{
                                    $booking->booking_status == 'pending' ? 'warning' :
                                    ($booking->booking_status == 'approved' ? 'primary' :
                                    ($booking->booking_status == 'completed' ? 'success' :
                                    ($booking->booking_status == 'cancelled' ? 'danger' :
                                    ($booking->booking_status == 'rejected' ? 'dark' : 'secondary'))))
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

                            <!-- Payment Status -->
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
                                @if($booking->payment_proof)
                                    <br><small class="text-info">
                                        <i class="fas fa-paperclip"></i> Proof Attached
                                    </small>
                                @endif
                            </td>

                            <!-- Actions -->
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
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                                id="dropdownMenuButton{{ $booking->id }}"
                                                data-toggle="dropdown" 
                                                data-bs-toggle="dropdown"
                                                aria-haspopup="true" 
                                                aria-expanded="false"
                                                title="Quick Actions">
                                            <i class="fas fa-cog"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton{{ $booking->id }}">
                                            @if($booking->booking_status == 'pending')
                                                <a class="dropdown-item text-success" href="#"
                                                   onclick="updateBookingStatus({{ $booking->id }}, 'approved', 'Approve this booking?'); return false;">
                                                    <i class="fas fa-check fa-sm fa-fw mr-2"></i> Accept/Approve
                                                </a>
                                                <a class="dropdown-item text-danger" href="#"
                                                   onclick="updateBookingStatus({{ $booking->id }}, 'rejected', 'Reject this booking?'); return false;">
                                                    <i class="fas fa-times fa-sm fa-fw mr-2"></i> Reject
                                                </a>
                                                <div class="dropdown-divider"></div>
                                            @endif

                                            @if($booking->booking_status == 'approved')
                                                <a class="dropdown-item text-success" href="#"
                                                   onclick="updateBookingStatus({{ $booking->id }}, 'completed', 'Mark this booking as completed?'); return false;">
                                                    <i class="fas fa-check-double fa-sm fa-fw mr-2"></i> Mark Complete
                                                </a>
                                            @endif

                                            @if($booking->booking_status != 'cancelled' && $booking->booking_status != 'completed')
                                                <a class="dropdown-item text-warning" href="#"
                                                   onclick="cancelBooking({{ $booking->id }}); return false;">
                                                    <i class="fas fa-ban fa-sm fa-fw mr-2"></i> Cancel
                                                </a>
                                            @endif

                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#" onclick="emailCustomer({{ $booking->id }}); return false;">
                                                <i class="fas fa-envelope fa-sm fa-fw mr-2"></i> Email Customer
                                            </a>

                                            @if($booking->payment_proof)
                                                <a class="dropdown-item" href="{{ asset('storage/payment_proofs/' . $booking->payment_proof) }}" target="_blank">
                                                    <i class="fas fa-receipt fa-sm fa-fw mr-2"></i> View Payment Proof
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center py-4">
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

            <!-- Pagination -->
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
                <h5 class="modal-title" id="bulkActionModalLabel">
                    <i class="fas fa-tasks"></i> Bulk Actions
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="bulkAction">Select Action:</label>
                    <select class="form-control" id="bulkAction">
                        <option value="">Choose an action...</option>
                        <option value="approve">Approve Selected Bookings</option>
                        <option value="reject">Reject Selected Bookings</option>
                        <option value="cancel">Cancel Selected Bookings</option>
                        <option value="mark_paid">Mark as Paid</option>
                        <option value="export">Export Selected</option>
                    </select>
                </div>
                <div class="selected-count">
                    <span class="badge badge-info" id="selectedCount">0</span> bookings selected
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="executeBulkAction()">
                    <i class="fas fa-check"></i> Execute Action
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Status Update Modal -->
<div class="modal fade" id="statusUpdateModal" tabindex="-1" role="dialog" aria-labelledby="statusUpdateModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="statusUpdateForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="statusUpdateModalLabel">Update Booking Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="booking_status">New Status:</label>
                        <select class="form-control" name="booking_status" id="booking_status" required>
                            <option value="pending">Pending</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="admin_notes">Admin Notes (Optional):</label>
                        <textarea class="form-control" name="admin_notes" id="admin_notes" rows="3"
                                  placeholder="Add any notes or reason for this status change..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Status
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Initialize tooltips
    $('[data-toggle="tooltip"]').tooltip();

    // Ensure Bootstrap dropdowns work
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

    // Update selected count when checkboxes change
    $('.booking-checkbox').change(function() {
        updateSelectedCount();
    });

    $('#selectAll').change(function() {
        updateSelectedCount();
    });
});

// Toggle all checkboxes
function toggleAllCheckboxes(selectAllCheckbox) {
    $('.booking-checkbox').prop('checked', selectAllCheckbox.checked);
    updateSelectedCount();
}

// Update selected count
function updateSelectedCount() {
    const selectedCount = $('.booking-checkbox:checked').length;
    $('#selectedCount').text(selectedCount);
}

// Select all bookings
function selectAllBookings() {
    $('.booking-checkbox, #selectAll').prop('checked', true);
    updateSelectedCount();
}

// Deselect all bookings
function deselectAllBookings() {
    $('.booking-checkbox, #selectAll').prop('checked', false);
    updateSelectedCount();
}

// Update booking status
function updateBookingStatus(bookingId, status, confirmMessage) {
    if (confirm(confirmMessage)) {
        const form = document.getElementById('statusUpdateForm');
        form.action = `/admin/dashboard/bookings/${bookingId}/status`;
        document.getElementById('booking_status').value = status;
        $('#statusUpdateModal').modal('show');
    }
}

// Cancel booking with reason
function cancelBooking(bookingId) {
    const reason = prompt('Please provide a reason for cancellation:');
    if (reason && reason.trim()) {
        updateBookingStatusWithNotes(bookingId, 'cancelled', reason);
    }
}

// Update booking status with notes
function updateBookingStatusWithNotes(bookingId, status, notes) {
    const formData = new FormData();
    formData.append('_token', '{{ csrf_token() }}');
    formData.append('_method', 'PUT');
    formData.append('booking_status', status);
    formData.append('admin_notes', notes);

    fetch(`/admin/dashboard/bookings/${bookingId}/status`, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert('Error updating booking status');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error updating booking status');
    });
}

// Email customer
function emailCustomer(bookingId) {
    // Redirect to the booking show page where email functionality is available
    window.location.href = `/admin/dashboard/bookings/${bookingId}`;
}

// Execute bulk action
function executeBulkAction() {
    const selectedBookings = $('.booking-checkbox:checked').map(function() {
        return this.value;
    }).get();

    if (selectedBookings.length === 0) {
        alert('Please select at least one booking');
        return;
    }

    const action = $('#bulkAction').val();
    if (!action) {
        alert('Please select an action');
        return;
    }

    if (confirm(`Are you sure you want to ${action} ${selectedBookings.length} bookings?`)) {
        // Implement bulk action logic here
        console.log('Bulk action:', action, 'Bookings:', selectedBookings);
        // You can implement the actual bulk action logic based on your needs
        $('#bulkActionModal').modal('hide');
    }
}

// Export bookings
function exportBookings() {
    window.location.href = '{{ route("admin.bookings.index") }}?export=1&' + new URLSearchParams(window.location.search);
}

// Refresh data
function refreshData() {
    window.location.reload();
}

// Highlight row on click
function highlightRow(row) {
    $('.booking-row').removeClass('table-active');
    $(row).addClass('table-active');
}
</script>

<style>
.booking-row:hover {
    background-color: #f8f9fc;
    cursor: pointer;
}

.booking-row.table-active {
    background-color: #e3f2fd;
}

.img-profile {
    border: 2px solid #fff;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}

.badge-pill {
    font-size: 0.75rem;
}

.btn-group .btn {
    border-radius: 0.25rem;
    margin-right: 2px;
}

.card-header .dropdown-menu {
    min-width: 180px;
}

.showing-info {
    font-size: 0.875rem;
}

.pagination-wrapper .pagination {
    margin-bottom: 0;
}

.table th {
    border-top: none;
    font-weight: 600;
    background-color: #f8f9fc;
    color: #5a5c69;
}

.custom-control-input:checked ~ .custom-control-label::before {
    border-color: #007bff;
    background-color: #007bff;
}

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

/* Ensure table cell doesn't overflow */
.table td {
    position: relative;
    overflow: visible;
}

/* Fix z-index for dropdowns in tables */
.table .dropdown-menu {
    z-index: 1050;
}
</style>
@endsection
