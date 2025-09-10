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
                            <i class="fas fa-comments text-primary"></i> Contact Messages Management
                        </h1>
                        <p class="mb-0 text-muted">Manage customer inquiries and support messages</p>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-home"></i> Back to Home
                        </a>
                        <button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#bulkActionModal">
                            <i class="fas fa-tasks"></i> Bulk Actions
                        </button>
                        <button class="btn btn-success btn-sm" onclick="exportMessages()">
                            <i class="fas fa-download"></i> Export
                        </button>
                        <button class="btn btn-info btn-sm" onclick="refreshData()">
                            <i class="fas fa-sync"></i> Refresh
                        </button>
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

                <!-- Statistics Overview Cards -->
                <div class="row mb-4">
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Unread Messages</div>
                                        <div class="h5 mb-0 font-weight-bold text-{{ $text }}">
                                            {{ \App\Models\Notification::where('title', 'LIKE', 'Contact Message:%')->where('is_read', false)->count() }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-envelope fa-2x text-gray-300"></i>
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
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Messages</div>
                                        <div class="h5 mb-0 font-weight-bold text-{{ $text }}">
                                            {{ $messages->total() }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-comments fa-2x text-gray-300"></i>
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
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Registered Users</div>
                                        <div class="h5 mb-0 font-weight-bold text-{{ $text }}">
                                            {{ \App\Models\Notification::where('title', 'LIKE', 'Contact Message:%')->whereNotNull('user_id')->count() }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-user fa-2x text-gray-300"></i>
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
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Guest Users</div>
                                        <div class="h5 mb-0 font-weight-bold text-{{ $text }}">
                                            {{ \App\Models\Notification::where('title', 'LIKE', 'Contact Message:%')->whereNull('user_id')->count() }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-user-slash fa-2x text-gray-300"></i>
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
                            <i class="fas fa-filter"></i> Filter Messages
                        </h6>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('admin.contact-messages.index') }}" class="row">
                            <div class="col-md-3 mb-3">
                                <label for="status">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="">All Messages</option>
                                    <option value="unread" {{ request('status') === 'unread' ? 'selected' : '' }}>Unread</option>
                                    <option value="read" {{ request('status') === 'read' ? 'selected' : '' }}>Read</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="user_type">User Type</label>
                                <select class="form-control" id="user_type" name="user_type">
                                    <option value="">All Users</option>
                                    <option value="guest" {{ request('user_type') === 'guest' ? 'selected' : '' }}>Guest Users</option>
                                    <option value="registered" {{ request('user_type') === 'registered' ? 'selected' : '' }}>Registered Users</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="priority">Priority</label>
                                <select class="form-control" id="priority" name="priority">
                                    <option value="">All Priorities</option>
                                    <option value="low" {{ request('priority') === 'low' ? 'selected' : '' }}>Low</option>
                                    <option value="normal" {{ request('priority') === 'normal' ? 'selected' : '' }}>Normal</option>
                                    <option value="high" {{ request('priority') === 'high' ? 'selected' : '' }}>High</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="search">Search</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="search" name="search"
                                           placeholder="Search in titles and messages..." value="{{ request('search') }}">
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

                <!-- Messages Data Table -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-table"></i> Contact Messages List
                        </h6>
                        <div class="dropdown no-arrow">
                            <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow">
                                <div class="dropdown-header">Export Options:</div>
                                <a class="dropdown-item" href="#" onclick="exportMessages('csv')">
                                    <i class="fas fa-file-csv fa-sm fa-fw mr-2"></i> Export CSV
                                </a>
                                <a class="dropdown-item" href="#" onclick="exportMessages('excel')">
                                    <i class="fas fa-file-excel fa-sm fa-fw mr-2"></i> Export Excel
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="messagesTable" width="100%" cellspacing="0">
                                <thead class="thead-light">
                                    <tr>
                                        <th width="3%">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="selectAll">
                                                <label class="custom-control-label" for="selectAll"></label>
                                            </div>
                                        </th>
                                        <th>Status</th>
                                        <th>Subject</th>
                                        <th>From</th>
                                        <th>User Type</th>
                                        <th>Priority</th>
                                        <th>Date</th>
                                        <th width="12%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card card-stats card-round">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-icon">
                        <div class="icon-big text-center icon-warning bubble-shadow-small">
                            <i class="fas fa-envelope-open"></i>
                        </div>
                    </div>
                    <div class="col col-stats ml-3 ml-sm-0">
                        <div class="numbers">
                            <p class="card-category">Unread Messages</p>
                            <h4 class="card-title">{{ \App\Models\Notification::where('title', 'LIKE', 'Contact Message:%')->where('is_read', false)->count() }}</h4>
                        </div>
                    </div>
                                    @forelse($messages as $message)
                                        @php
                                            $messageData = [];
                                            $lines = explode("\n", $message->message);
                                            foreach ($lines as $line) {
                                                if (strpos($line, 'From: ') === 0) {
                                                    preg_match('/From: (.+) \((.+)\)/', $line, $matches);
                                                    $messageData['name'] = $matches[1] ?? '';
                                                    $messageData['email'] = $matches[2] ?? '';
                                                } elseif (strpos($line, 'Priority: ') === 0) {
                                                    $messageData['priority'] = trim(str_replace('Priority: ', '', $line));
                                                }
                                            }
                                        @endphp
                                        <tr class="{{ !$message->is_read ? 'table-warning' : '' }}">
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input message-checkbox"
                                                           id="message_{{ $message->id }}" value="{{ $message->id }}">
                                                    <label class="custom-control-label" for="message_{{ $message->id }}"></label>
                                                </div>
                                            </td>
                                            <td>
                                                @if($message->is_read)
                                                    <span class="badge badge-success">Read</span>
                                                @else
                                                    <span class="badge badge-warning">Unread</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.contact-messages.show', $message->id) }}" class="text-decoration-none font-weight-bold">
                                                    {{ str_replace('Contact Message: ', '', $message->title) }}
                                                </a>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="mr-2">
                                                        <div class="font-weight-bold">{{ $messageData['name'] ?? 'Unknown' }}</div>
                                                        <small class="text-muted">{{ $messageData['email'] ?? 'No email' }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if($message->user_id)
                                                    <span class="badge badge-info">Registered</span>
                                                    @if($message->user)
                                                        <br><small class="text-muted">{{ $message->user->name }}</small>
                                                    @endif
                                                @else
                                                    <span class="badge badge-secondary">Guest</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if(isset($messageData['priority']))
                                                    @if($messageData['priority'] === 'High')
                                                        <span class="badge badge-danger">High</span>
                                                    @elseif($messageData['priority'] === 'Normal')
                                                        <span class="badge badge-warning">Normal</span>
                                                    @else
                                                        <span class="badge badge-success">Low</span>
                                                    @endif
                                                @else
                                                    <span class="badge badge-light">Unknown</span>
                                                @endif
                                            </td>
                                            <td>
                                                <small>{{ $message->created_at->format('M j, Y') }}</small><br>
                                                <small class="text-muted">{{ $message->created_at->format('g:i A') }}</small>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('admin.contact-messages.show', $message->id) }}"
                                                       class="btn btn-info btn-sm" title="View">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.contact-messages.reply', $message->id) }}"
                                                       class="btn btn-success btn-sm" title="Reply">
                                                        <i class="fas fa-reply"></i>
                                                    </a>
                                                    <a href="{{ route('admin.contact-messages.toggle-read', $message->id) }}"
                                                       class="btn btn-primary btn-sm" title="Toggle Read Status">
                                                        <i class="fas fa-{{ $message->is_read ? 'envelope' : 'envelope-open' }}"></i>
                                                    </a>
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button"
                                                                id="dropdownMenuButton{{ $message->id }}"
                                                                data-toggle="dropdown"
                                                                data-bs-toggle="dropdown"
                                                                aria-haspopup="true"
                                                                aria-expanded="false"
                                                                title="More Actions">
                                                            <i class="fas fa-ellipsis-h"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton{{ $message->id }}">
                                                            @if(isset($messageData['email']))
                                                                <a class="dropdown-item" href="mailto:{{ $messageData['email'] }}?subject=Re: {{ str_replace('Contact Message: ', '', $message->title) }}">
                                                                    <i class="fas fa-envelope fa-sm fa-fw mr-2"></i> Email Customer
                                                                </a>
                                                            @endif
                                                            <a class="dropdown-item" href="{{ route('admin.contact-messages.reply', $message->id) }}">
                                                                <i class="fas fa-reply fa-sm fa-fw mr-2"></i> Send Reply
                                                            </a>
                                                            <div class="dropdown-divider"></div>
                                                            <form action="{{ route('admin.contact-messages.destroy', $message->id) }}"
                                                                  method="POST" style="display: inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item text-danger"
                                                                        onclick="return confirm('Are you sure you want to delete this message?')">
                                                                    <i class="fas fa-trash fa-sm fa-fw mr-2"></i> Delete
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-4">
                                            <div class="text-gray-500">
                                                <i class="fas fa-inbox fa-3x mb-3"></i>
                                                <h5>No contact messages found</h5>
                                                <p>Contact messages will appear here when customers send inquiries.</p>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        @if($messages instanceof \Illuminate\Pagination\LengthAwarePaginator)
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <div class="text-muted">
                                Showing {{ $messages->firstItem() }} to {{ $messages->lastItem() }} of {{ $messages->total() }} results
                            </div>
                            <div>
                                {{ $messages->links() }}
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
                        <form id="bulkActionForm" action="{{ route('admin.contact-messages.bulk-action') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="bulk_action">Select Action</label>
                                <select class="form-control" id="bulk_action" name="action" required>
                                    <option value="">Choose an action...</option>
                                    <option value="mark_read">Mark as Read</option>
                                    <option value="mark_unread">Mark as Unread</option>
                                    <option value="delete">Delete Selected</option>
                                </select>
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
            $('#messagesTable').DataTable({
                "pageLength": 25,
                "order": [[ 6, "desc" ]],
                "columnDefs": [
                    { "orderable": false, "targets": [0, 7] }
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
                $('.message-checkbox').prop('checked', $(this).prop('checked'));
            });
        });

        // Execute bulk action
        function executeBulkAction() {
            const selectedMessages = $('.message-checkbox:checked').map(function() {
                return $(this).val();
            }).get();

            if (selectedMessages.length === 0) {
                alert('Please select at least one message.');
                return;
            }

            const action = $('#bulk_action').val();
            if (!action) {
                alert('Please select an action.');
                return;
            }

            if (confirm(`Are you sure you want to ${action.replace('_', ' ')} ${selectedMessages.length} message(s)?`)) {
                // Add selected message IDs to form
                const form = $('#bulkActionForm');
                selectedMessages.forEach(function(id) {
                    form.append('<input type="hidden" name="message_ids[]" value="' + id + '">');
                });

                form.submit();
            }
        }

        // Export messages function
        function exportMessages(format = 'csv') {
            window.open(`/admin/contact-messages/export?format=${format}`, '_blank');
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

        /* Highlight unread messages */
        .table-warning {
            background-color: rgba(255, 193, 7, 0.1) !important;
        }
        </style>
        @endsection
    </div>
@endsection
