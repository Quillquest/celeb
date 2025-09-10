<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Rescheduled</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            line-height: 1.6;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #3b82f6;
            padding: 20px;
            color: white;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            padding: 20px;
            background-color: #f9fafb;
            border: 1px solid #e5e7eb;
            border-top: none;
            border-radius: 0 0 5px 5px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #6b7280;
        }
        .booking-info {
            background-color: white;
            padding: 15px;
            border: 1px solid #e5e7eb;
            border-radius: 5px;
            margin-top: 20px;
        }
        .comparison {
            display: flex;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .comparison-column {
            flex: 1;
            padding: 15px;
        }
        .old-info {
            background-color: #fee2e2;
            border-radius: 5px 0 0 5px;
        }
        .new-info {
            background-color: #e0f2fe;
            border-radius: 0 5px 5px 0;
        }
        .button {
            display: inline-block;
            padding: 10px 15px;
            background-color: #3b82f6;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .details-row {
            padding: 8px 0;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
        }
        .details-row:last-child {
            border-bottom: none;
        }
        .details-label {
            width: 40%;
            font-weight: 600;
            color: #4b5563;
        }
        .details-value {
            width: 60%;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Booking Rescheduled</h1>
        </div>
        <div class="content">
            <p>Dear {{ $name }},</p>
            
            <p>Your booking with {{ $celebrity_name }} has been successfully rescheduled.</p>
            
            <div class="booking-info">
                <div class="details-row">
                    <div class="details-label">Booking Reference:</div>
                    <div class="details-value">{{ $booking_reference }}</div>
                </div>
                <div class="details-row">
                    <div class="details-label">Celebrity:</div>
                    <div class="details-value">{{ $celebrity_name }}</div>
                </div>
                <div class="details-row">
                    <div class="details-label">New Date:</div>
                    <div class="details-value">{{ $event_date }}</div>
                </div>
                <div class="details-row">
                    <div class="details-label">New Time:</div>
                    <div class="details-value">{{ $event_time }}</div>
                </div>
                <div class="details-row">
                    <div class="details-label">Duration:</div>
                    <div class="details-value">{{ $duration }} minutes</div>
                </div>
                <div class="details-row">
                    <div class="details-label">Location:</div>
                    <div class="details-value">{{ $event_location }}</div>
                </div>
            </div>
            
            <p>Please make sure to note the new event date and time in your calendar. If you need to make any further changes, please contact our support team at least 72 hours before the event.</p>
            
            <p style="text-align: center;">
                <a href="{{ url('/booking/' . $booking_reference) }}" class="button">View Booking Details</a>
            </p>
            
            <p>If you have any questions or need assistance, please don't hesitate to contact us.</p>
            
            <p>Thank you for choosing our service!</p>
            
            <p>Best regards,<br>{{ config('app.name') }} Team</p>
        </div>
        <div class="footer">
            <p>© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            <p>If you have any questions, please contact our support team.</p>
        </div>
    </div>
</body>
</html>