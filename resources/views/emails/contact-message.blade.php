<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Message</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            background-color: #f8f9fa;
        }
        .email-container {
            background-color: #ffffff;
            margin: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .content {
            padding: 30px;
        }
        .priority-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: white;
            margin-bottom: 20px;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 25px;
        }
        .info-item {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid #667eea;
        }
        .info-label {
            font-weight: 600;
            color: #495057;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }
        .info-value {
            color: #212529;
            font-size: 14px;
        }
        .message-section {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            border-left: 4px solid #28a745;
            margin: 20px 0;
        }
        .message-label {
            font-weight: 600;
            color: #495057;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 10px;
        }
        .message-content {
            background-color: white;
            padding: 15px;
            border-radius: 6px;
            border: 1px solid #dee2e6;
            font-size: 14px;
            line-height: 1.6;
            white-space: pre-wrap;
        }
        .footer {
            background-color: #f8f9fa;
            padding: 20px 30px;
            border-top: 1px solid #dee2e6;
            font-size: 12px;
            color: #6c757d;
            text-align: center;
        }
        .action-buttons {
            text-align: center;
            margin: 25px 0;
        }
        .btn {
            display: inline-block;
            padding: 12px 24px;
            margin: 0 5px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
        }
        .btn-primary {
            background-color: #667eea;
            color: white;
        }
        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }
        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        @media (max-width: 600px) {
            .email-container {
                margin: 10px;
            }
            .info-grid {
                grid-template-columns: 1fr;
            }
            .content {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <h1>🎭 New Contact Message</h1>
            <p style="margin: 10px 0 0 0; opacity: 0.9;">Celebrity Booking Website</p>
        </div>

        <!-- Content -->
        <div class="content">
            <!-- Priority Badge -->
            <div class="priority-badge" style="background-color: {{ $priorityColor }};">
                {{ $priorityLabel }}
            </div>

            <!-- Contact Information Grid -->
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">👤 Name</div>
                    <div class="info-value">{{ $contactData['name'] }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">📧 Email</div>
                    <div class="info-value">{{ $contactData['email'] }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">📞 Phone</div>
                    <div class="info-value">{{ $contactData['phone'] ?? 'Not provided' }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">📅 Submitted</div>
                    <div class="info-value">{{ $contactData['submitted_at'] }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">🏷️ Subject</div>
                    <div class="info-value">{{ $contactData['subject'] }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">👥 User Type</div>
                    <div class="info-value">{{ $contactData['user_type'] }}</div>
                </div>
            </div>

            <!-- Message Section -->
            <div class="message-section">
                <div class="message-label">💬 Message</div>
                <div class="message-content">{{ $contactData['message'] }}</div>
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <a href="mailto:{{ $contactData['email'] }}?subject=Re: {{ $contactData['subject'] }}" class="btn btn-primary">
                    📧 Reply to Customer
                </a>
                <a href="tel:{{ $contactData['phone'] }}" class="btn btn-secondary">
                    📞 Call Customer
                </a>
            </div>

            <!-- Additional Info -->
            <div style="background-color: #e3f2fd; padding: 15px; border-radius: 8px; margin-top: 20px;">
                <p style="margin: 0; font-size: 13px; color: #1565c0;">
                    <strong>💡 Quick Actions:</strong><br>
                    • This message has been saved to your notifications dashboard<br>
                    • Notification ID: #{{ $contactData['notification_id'] }}<br>
                    • Priority Level: {{ $priorityLabel }}
                </p>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p style="margin: 0;">
                This email was automatically generated from your celebrity booking website contact form.<br>
                Please respond to the customer within 24 hours for the best experience.
            </p>
        </div>
    </div>
</body>
</html>
