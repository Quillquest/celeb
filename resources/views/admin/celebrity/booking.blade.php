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
                            <i class="fas fa-star text-warning"></i> Celebrity Bookings Management
                        </h1>
                        <p class="mb-0 text-muted">Manage celebrity bookings, donations, and fan cards</p>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-home"></i> Back to Home
                        </a>
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

                <!-- Statistics Overview Cards -->
                <div class="row mb-4">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Bookings</div>
                                        <div class="h5 mb-0 font-weight-bold text-{{ $text }}">
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
                                        <div class="h5 mb-0 font-weight-bold text-{{ $text }}">
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

                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Bookings</div>
                                        <div class="h5 mb-0 font-weight-bold text-{{ $text }}">{{ $bookings->count() }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
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
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Completed</div>
                                        <div class="h5 mb-0 font-weight-bold text-{{ $text }}">
                                            {{ $bookings->where('booking_status', 'completed')->count() }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filters and Search -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-filter"></i> Filter Bookings
                        </h6>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('admin.bookings.index') }}" class="row">
                            <div class="col-md-3 mb-3">
                                <label for="booking_status">Booking Status</label>
                                <select class="form-control" id="booking_status" name="booking_status">
                                    <option value="">All Statuses</option>
                                    <option value="pending" {{ request('booking_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="approved" {{ request('booking_status') == 'approved' ? 'selected' : '' }}>Approved</option>
                                    <option value="rejected" {{ request('booking_status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                    <option value="completed" {{ request('booking_status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="cancelled" {{ request('booking_status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="payment_status">Payment Status</label>
                                <select class="form-control" id="payment_status" name="payment_status">
                                    <option value="">All Payments</option>
                                    <option value="pending" {{ request('payment_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="paid" {{ request('payment_status') == 'paid' ? 'selected' : '' }}>Paid</option>
                                    <option value="refunded" {{ request('payment_status') == 'refunded' ? 'selected' : '' }}>Refunded</option>
                                    <option value="cancelled" {{ request('payment_status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="booking_type">Booking Type</label>
                                <select class="form-control" id="booking_type" name="booking_type">
                                    <option value="">All Types</option>
                                    <option value="booking" {{ request('booking_type') == 'booking' ? 'selected' : '' }}>Booking</option>
                                    <option value="donation" {{ request('booking_type') == 'donation' ? 'selected' : '' }}>Donation</option>
                                    <option value="fan_card" {{ request('booking_type') == 'fan_card' ? 'selected' : '' }}>Fan Card</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="search">Search</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="search" name="search"
                                           placeholder="Name, email, reference..." value="{{ request('search') }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Bookings Data Table -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-table"></i> Celebrity Bookings List
                        </h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow">
                                <div class="dropdown-header">Export Options:</div>
                                <a class="dropdown-item" href="#" onclick="exportBookings('csv')">
                                    <i class="fas fa-file-csv fa-sm fa-fw mr-2"></i> Export CSV
                                </a>
                                <a class="dropdown-item" href="#" onclick="exportBookings('excel')">
                                    <i class="fas fa-file-excel fa-sm fa-fw mr-2"></i> Export Excel
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="bookingsTable" width="100%" cellspacing="0">
                                <thead class="thead-light">
                                    <tr>
                                        <th width="3%">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="selectAll">
                                                <label class="custom-control-label" for="selectAll"></label>
                                            </div>
                                        </th>
                                        <th>Reference</th>
                                        <th>Type</th>
                                        <th>Customer</th>
                                        <th>Celebrity</th>
                                        <th>Event Details</th>
                                        <th>Amount</th>
                                        <th>Payment</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th width="12%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($bookings as $booking)
                                    <tr>
                                        <td>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input booking-checkbox"
                                                       id="booking_{{ $booking->id }}" value="{{ $booking->id }}">
                                                <label class="custom-control-label" for="booking_{{ $booking->id }}"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <small class="text-primary font-weight-bold">{{ $booking->booking_reference }}</small>
                                        </td>
                                        <td>
                                            <span class="badge badge-{{
                                                $booking->booking_type == 'booking' ? 'primary' :
                                                ($booking->booking_type == 'donation' ? 'success' : 'info')
                                            }}">
                                                {{ ucfirst($booking->booking_type) }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="mr-2">
                                                    <div class="font-weight-bold">{{ $booking->full_name }}</div>
                                                    <small class="text-muted">{{ $booking->email }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if(isset($booking->celebrity->name) && $booking->celebrity->name != null)
                                                <div class="font-weight-bold">{{ $booking->celebrity->name }}</div>
                                                @if($booking->celebrity->known_for)
                                                    <small class="text-muted">{{ $booking->celebrity->known_for }}</small>
                                                @endif
                                            @else
                                                <span class="text-danger">Celebrity deleted</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($booking->booking_type == 'booking')
                                                <div class="font-weight-bold">{{ $booking->event_type }}</div>
                                                <small class="text-muted">
                                                    <i class="fas fa-map-marker-alt"></i> {{ $booking->event_location }}<br>
                                                    <i class="fas fa-calendar"></i> {{ $booking->event_date->format('M j, Y') }}
                                                </small>
                                            @else
                                                <small class="text-muted">{{ ucfirst($booking->booking_type) }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="font-weight-bold text-success">
                                                ${{ number_format($booking->total_amount, 2) }}
                                            </div>
                                            @if($booking->service_fee > 0)
                                                <small class="text-muted">+${{ number_format($booking->service_fee, 2) }} fee</small>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge badge-{{
                                                $booking->payment_status == 'pending' ? 'warning' :
                                                ($booking->payment_status == 'paid' ? 'success' : 'danger')
                                            }}">
                                                {{ ucfirst($booking->payment_status) }}
                                            </span>
                                            @if($booking->payment_method)
                                                <br><small class="text-muted">{{ $booking->payment_method }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge badge-{{
                                                $booking->booking_status == 'pending' ? 'warning' :
                                                ($booking->booking_status == 'approved' ? 'primary' :
                                                ($booking->booking_status == 'completed' ? 'success' :
                                                ($booking->booking_status == 'cancelled' ? 'danger' : 'secondary')))
                                            }}">
                                                {{ ucfirst($booking->booking_status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <small>{{ $booking->created_at->format('M j, Y') }}</small><br>
                                            <small class="text-muted">{{ $booking->created_at->format('g:i A') }}</small>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.bookings.show', $booking->id) }}"
                                                   class="btn btn-info btn-sm" title="View Details">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.bookings.edit', $booking->id) }}"
                                                   class="btn btn-primary btn-sm" title="Edit Booking">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                @if($booking->booking_status == 'pending')

                                                <a href="{{ route('admin.bookings.approval', $booking->id) }}"
                                                   class="btn btn-success btn-sm"  title="Approve"
                                                   onclick="return confirm('Are you sure you want to approve this booking?')">
                                                   <i class="fas fa-check"></i>
                                                </a>
                                                <a href="{{ route('admin.bookings.rejection', $booking->id) }}"
                                                   class="btn btn-danger btn-sm" title="Reject"
                                                   onclick="return confirm('Are you sure you want to reject this booking?')">
                                                    <i class="fas fa-times"></i>
                                                </a>
                                                @endif
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                                            id="dropdownMenuButton{{ $booking->id }}"
                                                            data-toggle="dropdown"
                                                            data-bs-toggle="dropdown"
                                                            aria-haspopup="true"
                                                            aria-expanded="false"
                                                            title="More Actions">
                                                        <i class="fas fa-ellipsis-h"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton{{ $booking->id }}">
                                                        @if($booking->payment_proof)
                                                            <a class="dropdown-item" href="{{ asset('storage/payment_proofs/' . $booking->payment_proof) }}" target="_blank">
                                                                <i class="fas fa-file-image fa-sm fa-fw mr-2"></i> View Payment Proof
                                                            </a>
                                                        @endif
                                                        <a class="dropdown-item" href="mailto:{{ $booking->email }}">
                                                            <i class="fas fa-envelope fa-sm fa-fw mr-2"></i> Email Customer
                                                        </a>
                                                        <div class="dropdown-divider"></div>
                                                        <a class="dropdown-item text-danger" href="{{ route('deletebooking', $booking->id) }}"
                                                           onclick="return confirm('Are you sure you want to delete this booking?')">
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
                                            <div class="text-gray-500">
                                                <i class="fas fa-inbox fa-3x mb-3"></i>
                                                <h5>No bookings found</h5>
                                                <p>There are no bookings matching your current filters.</p>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        @if($bookings instanceof \Illuminate\Pagination\LengthAwarePaginator)
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <div class="text-muted">
                                Showing {{ $bookings->firstItem() }} to {{ $bookings->lastItem() }} of {{ $bookings->total() }} results
                            </div>
                            <div>
                                {{ $bookings->links() }}
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Bulk Action Modal -->
        <div class="modal fade" id="bulkActionModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Bulk Actions</h5>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="bulkActionForm">
                            <div class="form-group">
                                <label for="bulk_action">Select Action</label>
                                <select class="form-control" id="bulk_action" name="action" required>
                                    <option value="">Choose an action...</option>
                                    <option value="approve">Approve Selected</option>
                                    <option value="reject">Reject Selected</option>
                                    <option value="mark_paid">Mark as Paid</option>
                                    <option value="export">Export Selected</option>
                                    <option value="delete">Delete Selected</option>
                                </select>
                            </div>
                            <div class="form-group" id="reasonGroup" style="display: none;">
                                <label for="reason">Reason/Notes</label>
                                <textarea class="form-control" id="reason" name="reason" rows="3"></textarea>
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

        @section('scripts')
        <script>
        $(document).ready(function() {
            // Initialize DataTable if needed
            $('#bookingsTable').DataTable({
                "pageLength": 25,
                "order": [[ 9, "desc" ]],
                "columnDefs": [
                    { "orderable": false, "targets": [0, 10] }
                ]
            });

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

            // Select all checkbox functionality
            $('#selectAll').change(function() {
                $('.booking-checkbox').prop('checked', $(this).prop('checked'));
            });

            // Show/hide reason field based on bulk action
            $('#bulk_action').change(function() {
                const action = $(this).val();
                if (action === 'reject' || action === 'delete') {
                    $('#reasonGroup').show();
                    $('#reason').prop('required', true);
                } else {
                    $('#reasonGroup').hide();
                    $('#reason').prop('required', false);
                }
            });
        });

        // Quick status update function
        function quickStatusUpdate(bookingId, status) {
            console.log('=== Quick Status Update Debug ===');
            console.log('Booking ID:', bookingId);
            console.log('New Status:', status);

            if (confirm(`Are you sure you want to ${status} this booking?`)) {
                // Show loading state
                const button = event.target.closest('button');
                const originalHtml = button.innerHTML;
                button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                button.disabled = true;

                const actionUrl = '/dashboard/bookings/' + bookingId + '/quick-status';
                console.log('Action URL:', actionUrl);

                const csrfToken = $('meta[name="csrf-token"]').attr('content');
                console.log('CSRF Token available:', !!csrfToken);

                // Try AJAX first, fallback to form if needed
                $.ajax({
                    url: actionUrl,
                    method: 'POST',
                    data: {
                        _token: csrfToken,
                        status: status
                    },
                    success: function(response) {
                        console.log('AJAX Success:', response);
                        // Reload page to see changes
                        window.location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.log('AJAX Error:', xhr.status, error);
                        console.log('Response Text:', xhr.responseText);

                        // Fallback to form submission
                        console.log('Falling back to form submission...');

                        const form = $('<form>', {
                            'method': 'POST',
                            'action': actionUrl,
                            'style': 'display: none;'
                        });

                        form.append($('<input>', {
                            'type': 'hidden',
                            'name': '_token',
                            'value': csrfToken
                        }));

                        form.append($('<input>', {
                            'type': 'hidden',
                            'name': 'status',
                            'value': status
                        }));

                        $('body').append(form);
                        form.submit();
                    }
                });
            }
        }

        // Execute bulk action
        function executeBulkAction() {
            const selectedBookings = $('.booking-checkbox:checked').map(function() {
                return $(this).val();
            }).get();

            if (selectedBookings.length === 0) {
                alert('Please select at least one booking.');
                return;
            }

            const action = $('#bulk_action').val();
            if (!action) {
                alert('Please select an action.');
                return;
            }

            if (confirm(`Are you sure you want to ${action} ${selectedBookings.length} booking(s)?`)) {
                // Implement bulk action AJAX call
                console.log('Bulk action:', action, 'Bookings:', selectedBookings);
                // Add your AJAX implementation here
                $('#bulkActionModal').modal('hide');
            }
        }

        // Export bookings function
        function exportBookings(format = 'csv') {
            window.open(`/admin/bookings/export?format=${format}`, '_blank');
        }

        // Refresh data function
        function refreshData() {
            location.reload();
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

        /* Ensure table cell doesn't overflow */
        .table td {
            position: relative;
            overflow: visible;
        }

        /* Fix z-index for dropdowns in tables */
        .table .dropdown-menu {
            z-index: 1050;
        }

        /* DataTable fixes */
        .dataTables_wrapper .dropdown-menu {
            z-index: 1055 !important;
        }
        </style>
        @endsection
    </div>
@endsection
