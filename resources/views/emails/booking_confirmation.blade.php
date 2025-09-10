<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation - {{ $site_name }}</title>
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
            max-width: 650px;
            margin: 0 auto;
            background-color: #ffffff;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 40px 30px;
            color: white;
            text-align: center;
        }
        .header h1 {
            margin: 0 0 10px 0;
            font-size: 28px;
            font-weight: 700;
        }
        .header p {
            margin: 0;
            font-size: 16px;
            opacity: 0.9;
        }
        .content {
            padding: 40px 30px;
        }
        .greeting {
            font-size: 18px;
            margin-bottom: 25px;
            color: #1f2937;
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
            background: linear-gradient(90deg, #667eea, #764ba2);
        }
        .booking-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }
        .booking-reference {
            font-size: 20px;
            font-weight: 700;
            color: #1f2937;
            background: #ffffff;
            padding: 8px 16px;
            border-radius: 25px;
            border: 2px solid #667eea;
        }
        .status-badge {
            background: #fef3c7;
            color: #92400e;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .celebrity-info {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #667eea;
        }
        .celebrity-name {
            font-size: 24px;
            font-weight: 700;
            color: #1f2937;
            margin: 0 0 5px 0;
        }
        .event-type {
            color: #6b7280;
            font-size: 14px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin: 25px 0;
        }
        .detail-item {
            background: white;
            padding: 18px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
        }
        .detail-label {
            font-size: 12px;
            color: #6b7280;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
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
            padding: 20px;
            margin: 25px 0;
        }
        .pricing-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 0;
            border-bottom: 1px solid #e5e7eb;
        }
        .pricing-row:last-child {
            border-bottom: none;
            font-weight: 700;
            font-size: 18px;
            color: #1f2937;
            padding-top: 15px;
            margin-top: 10px;
            border-top: 2px solid #667eea;
        }
        .pricing-label {
            color: #6b7280;
        }
        .pricing-value {
            color: #1f2937;
            font-weight: 600;
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
        .next-steps {
            background: #ecfdf5;
            border: 1px solid #10b981;
            border-radius: 8px;
            padding: 20px;
            margin: 25px 0;
        }
        .next-steps h3 {
            margin: 0 0 15px 0;
            color: #047857;
            font-size: 18px;
        }
        .next-steps ul {
            margin: 0;
            padding-left: 20px;
        }
        .next-steps li {
            margin-bottom: 8px;
            color: #065f46;
        }
        .footer {
            background: #f9fafb;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
        }
        .footer-text {
            color: #6b7280;
            font-size: 14px;
            margin: 5px 0;
        }
        .company-name {
            color: #667eea;
            font-weight: 600;
        }
        .contact-info {
            background: #f3f4f6;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            text-align: center;
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
                gap: 10px;
            }
            .details-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>🎭 Booking Confirmed!</h1>
            <p>Your celebrity booking request has been successfully received</p>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="greeting">
                Hello <strong>{{ $name }}</strong>,
            </div>

            <p>Thank you for choosing <span class="company-name">{{ $site_name }}</span> for your celebrity booking needs! We're excited to confirm that your booking request has been successfully submitted and is now being processed by our team.</p>

            <!-- Booking Information Card -->
            <div class="booking-card">
                <div class="booking-header">
                    <div class="booking-reference">{{ $booking_reference }}</div>
                    <div class="status-badge">{{ $booking_status }}</div>
                </div>

                <!-- Celebrity Information -->
                <div class="celebrity-info">
                    <div class="celebrity-name">🌟 {{ $celebrity_name }}</div>
                    <div class="event-type">{{ $event_type }}</div>
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
                        <div class="detail-value">{{ $duration }} minutes</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">📍 Location</div>
                        <div class="detail-value">{{ $event_location }}</div>
                    </div>
                </div>

                <!-- Pricing Information -->
                <div class="pricing-section">
                    <div class="pricing-row">
                        <span class="pricing-label">Booking Fee:</span>
                        <span class="pricing-value">${{ $booking_fee }}</span>
                    </div>
                    <div class="pricing-row">
                        <span class="pricing-label">Service Fee:</span>
                        <span class="pricing-value">${{ $service_fee }}</span>
                    </div>
                    <div class="pricing-row">
                        <span class="pricing-label">Total Amount:</span>
                        <span class="pricing-value">${{ $total_amount }}</span>
                    </div>
                </div>

                @if($special_requests)
                <!-- Special Requests -->
                <div class="special-requests">
                    <h4>✨ Special Requests</h4>
                    <p>{{ $special_requests }}</p>
                </div>
                @endif
            </div>

            <!-- Next Steps -->
            <div class="next-steps">
                <h3>🚀 What Happens Next?</h3>
                <ul>
                    <li><strong>Review Process:</strong> Our team will review your booking request within 24 hours</li>
                    <li><strong>Confirmation:</strong> You'll receive an email update once your booking is approved</li>
                    <li><strong>Payment:</strong> Payment instructions will be provided upon approval</li>
                    <li><strong>Final Details:</strong> Event coordination details will be shared closer to your event date</li>
                </ul>
            </div>

            <!-- Contact Information -->
            <div class="contact-info">
                <p><strong>Need Help?</strong></p>
                <p>If you have any questions about your booking, please contact us:</p>
                <p>📧 Email: {{ config('mail.from.address') }}</p>
                <p>📱 Reference: <strong>{{ $booking_reference }}</strong></p>
            </div>

            <p>We appreciate your business and look forward to making your event memorable!</p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p class="footer-text">This email was sent by <span class="company-name">{{ $site_name }}</span></p>
            <p class="footer-text">Booking submitted on {{ $created_at }}</p>
            <p class="footer-text">© {{ date('Y') }} {{ $site_name }}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
