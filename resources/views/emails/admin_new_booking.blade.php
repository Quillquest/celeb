<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Booking Received - {{ $site_name }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8fafc;
            color: #374151;
            line-height: 1.6;
        }
        .container {
            max-width: 700px;
            margin: 0 auto;
            background-color: #ffffff;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            padding: 30px;
            color: white;
            text-align: center;
        }
        .header h1 {
            margin: 0 0 10px 0;
            font-size: 26px;
            font-weight: 700;
        }
        .header p {
            margin: 0;
            font-size: 16px;
            opacity: 0.9;
        }
        .urgent-badge {
            background: #ef4444;
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            display: inline-block;
            margin-top: 15px;
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { opacity: 1; }
            50% { opacity: 0.7; }
            100% { opacity: 1; }
        }
        .content {
            padding: 35px;
        }
        .alert-message {
            background: #fef3c7;
            border: 2px solid #f59e0b;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 25px;
            text-align: center;
        }
        .alert-message h3 {
            margin: 0 0 10px 0;
            color: #92400e;
            font-size: 18px;
        }
        .booking-card {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 25px;
            margin: 25px 0;
            position: relative;
            overflow: hidden;
        }
        .booking-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #f59e0b, #d97706);
        }
        .booking-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
        }
        .booking-reference {
            font-size: 22px;
            font-weight: 700;
            color: #1f2937;
            background: #ffffff;
            padding: 10px 20px;
            border-radius: 25px;
            border: 2px solid #f59e0b;
        }
        .status-badge {
            background: #fef3c7;
            color: #92400e;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .celebrity-section {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #f59e0b;
        }
        .celebrity-name {
            font-size: 26px;
            font-weight: 700;
            color: #1f2937;
            margin: 0 0 5px 0;
        }
        .event-type {
            color: #6b7280;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .customer-info {
            background: #ecfdf5;
            border: 1px solid #10b981;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        .customer-info h4 {
            margin: 0 0 15px 0;
            color: #047857;
            font-size: 16px;
        }
        .customer-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }
        .customer-item {
            color: #065f46;
        }
        .customer-label {
            font-weight: 600;
            color: #047857;
        }
        .details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 20px;
            margin: 25px 0;
        }
        .detail-item {
            background: white;
            padding: 18px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            text-align: center;
        }
        .detail-label {
            font-size: 12px;
            color: #6b7280;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }
        .detail-value {
            font-size: 16px;
            color: #1f2937;
            font-weight: 600;
        }
        .pricing-section {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 25px;
            margin: 25px 0;
        }
        .pricing-title {
            font-size: 18px;
            font-weight: 700;
            color: #1f2937;
            margin: 0 0 20px 0;
            text-align: center;
        }
        .pricing-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #e5e7eb;
        }
        .pricing-row:last-child {
            border-bottom: none;
            font-weight: 700;
            font-size: 20px;
            color: #1f2937;
            padding-top: 20px;
            margin-top: 15px;
            border-top: 3px solid #f59e0b;
        }
        .pricing-label {
            color: #6b7280;
            font-size: 16px;
        }
        .pricing-value {
            color: #1f2937;
            font-weight: 600;
            font-size: 16px;
        }
        .special-requests {
            background: #fef7ff;
            border: 1px solid #e879f9;
            border-radius: 8px;
            padding: 20px;
            margin: 25px 0;
        }
        .special-requests h4 {
            margin: 0 0 10px 0;
            color: #86198f;
        }
        .action-buttons {
            background: #f3f4f6;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            padding: 25px;
            margin: 25px 0;
            text-align: center;
        }
        .action-buttons h3 {
            margin: 0 0 20px 0;
            color: #1f2937;
        }
        .btn {
            display: inline-block;
            padding: 12px 24px;
            margin: 0 10px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }
        .btn-approve {
            background: #10b981;
            color: white;
        }
        .btn-approve:hover {
            background: #059669;
        }
        .btn-reject {
            background: #ef4444;
            color: white;
        }
        .btn-reject:hover {
            background: #dc2626;
        }
        .btn-view {
            background: #6366f1;
            color: white;
        }
        .btn-view:hover {
            background: #4f46e5;
        }
        .timestamp {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 15px;
            margin: 20px 0;
            text-align: center;
            font-size: 14px;
            color: #6b7280;
        }
        .footer {
            background: #f9fafb;
            padding: 25px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
        }
        .footer-text {
            color: #6b7280;
            font-size: 14px;
            margin: 5px 0;
        }
        .company-name {
            color: #f59e0b;
            font-weight: 600;
        }
        @media (max-width: 600px) {
            .container {
                margin: 10px;
                border-radius: 8px;
            }
            .header, .content, .footer {
                padding: 20px;
            }
            .booking-header {
                flex-direction: column;
                gap: 15px;
            }
            .details-grid {
                grid-template-columns: 1fr;
            }
            .customer-details {
                grid-template-columns: 1fr;
            }
            .btn {
                display: block;
                margin: 10px 0;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>🚨 New Booking Alert!</h1>
            <p>A new celebrity booking request requires your attention</p>
            <div class="urgent-badge">Action Required</div>
        </div>

        <!-- Content -->
        <div class="content">
            <!-- Alert Message -->
            <div class="alert-message">
                <h3>⚡ Urgent Admin Action Required</h3>
                <p>A new celebrity booking has been submitted and is waiting for your review and approval. Please process this request as soon as possible.</p>
            </div>

            <!-- Booking Information Card -->
            <div class="booking-card">
                <div class="booking-header">
                    <div class="booking-reference">{{ $booking_reference }}</div>
                    <div class="status-badge">{{ $booking_status }}</div>
                </div>

                <!-- Celebrity Information -->
                <div class="celebrity-section">
                    <div class="celebrity-name">🌟 {{ $celebrity_name }}</div>
                    <div class="event-type">{{ $event_type }}</div>
                </div>

                <!-- Customer Information -->
                <div class="customer-info">
                    <h4>👤 Customer Information</h4>
                    <div class="customer-details">
                        <div class="customer-item">
                            <span class="customer-label">Name:</span> {{ $name }}
                        </div>
                        <div class="customer-item">
                            <span class="customer-label">Email:</span> {{ $email }}
                        </div>
                        <div class="customer-item">
                            <span class="customer-label">Phone:</span> {{ $phone }}
                        </div>
                    </div>
                </div>

                <!-- Event Details Grid -->
                <div class="details-grid">
                    <div class="detail-item">
                        <div class="detail-label">📅 Event Date</div>
                        <div class="detail-value">{{ $event_date }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">🕒 Event Time</div>
                        <div class="detail-value">{{ $event_time }}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">⏱️ Duration</div>
                        <div class="detail-value">{{ $duration }} min</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">📍 Location</div>
                        <div class="detail-value">{{ $event_location }}</div>
                    </div>
                </div>

                <!-- Pricing Information -->
                <div class="pricing-section">
                    <div class="pricing-title">💰 Booking Financial Details</div>
                    <div class="pricing-row">
                        <span class="pricing-label">Booking Fee:</span>
                        <span class="pricing-value">${{ $booking_fee }}</span>
                    </div>
                    <div class="pricing-row">
                        <span class="pricing-label">Service Fee:</span>
                        <span class="pricing-value">${{ $service_fee }}</span>
                    </div>
                    <div class="pricing-row">
                        <span class="pricing-label">Total Revenue:</span>
                        <span class="pricing-value">${{ $total_amount }}</span>
                    </div>
                </div>

                @if($special_requests)
                <!-- Special Requests -->
                <div class="special-requests">
                    <h4>✨ Special Requests from Customer</h4>
                    <p>{{ $special_requests }}</p>
                </div>
                @endif
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <h3>🎯 Quick Actions</h3>
                <p>Choose an action to process this booking:</p>
                <a href="{{ url('/admin/dashboard/bookings/' . $booking_reference . '/approve') }}" class="btn btn-approve">✅ Approve Booking</a>
                <a href="{{ url('/admin/dashboard/bookings/' . $booking_reference . '/reject') }}" class="btn btn-reject">❌ Reject Booking</a>
                <a href="{{ url('/admin/dashboard/bookings/' . $booking_reference) }}" class="btn btn-view">👁️ View Full Details</a>
            </div>

            <!-- Booking Timestamp -->
            <div class="timestamp">
                <strong>📅 Booking Submitted:</strong> {{ $created_at }}
            </div>

            <!-- Admin Instructions -->
            <div style="background: #eff6ff; border: 1px solid #3b82f6; border-radius: 8px; padding: 20px; margin: 25px 0;">
                <h4 style="margin: 0 0 15px 0; color: #1e40af;">📋 Admin Instructions</h4>
                <ul style="margin: 0; color: #1e3a8a;">
                    <li><strong>Review:</strong> Check celebrity availability and event details</li>
                    <li><strong>Verify:</strong> Confirm customer information and special requests</li>
                    <li><strong>Process:</strong> Approve or reject the booking with appropriate notes</li>
                    <li><strong>Follow-up:</strong> Customer will be automatically notified of your decision</li>
                </ul>
            </div>

            <p style="text-align: center; font-weight: 600; color: #374151;">
                ⏰ <strong>Response Time Target:</strong> 24 hours or less<br>
                🎭 <strong>Priority Level:</strong> High - Customer is waiting for confirmation
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p class="footer-text">This admin notification was sent by <span class="company-name">{{ $site_name }}</span></p>
            <p class="footer-text">Booking Reference: <strong>{{ $booking_reference }}</strong></p>
            <p class="footer-text">© {{ date('Y') }} {{ $site_name }} - Admin Dashboard</p>
        </div>
    </div>
</body>
</html>
