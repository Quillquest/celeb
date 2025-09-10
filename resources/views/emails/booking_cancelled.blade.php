<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Cancelled</title>
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
            background-color: #ef4444;
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
        .reason-box {
            background-color: #fee2e2;
            padding: 15px;
            border: 1px solid #fca5a5;
            border-radius: 5px;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .button {
            display: inline-block;
            padding: 10px 15px;
            background-color: #4b5563;
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
            <h1>Booking Cancelled</h1>
        </div>
        <div class="content">
            <p>Dear {{ $name }},</p>
            
            <p>We're sorry to inform you that your booking with {{ $celebrity_name }} has been cancelled.</p>
            
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
                    <div class="details-label">Event Date:</div>
                    <div class="details-value">{{ $event_date }}</div>
                </div>
                <div class="details-row">
                    <div class="details-label">Event Time:</div>
                    <div class="details-value">{{ $event_time }}</div>
                </div>
            </div>
            
            <div class="reason-box">
                <h3 style="margin-top: 0;">Cancellation Reason:</h3>
                <p>{{ $cancellation_reason }}</p>
            </div>
            
            <p>If you have any questions regarding refunds or would like to discuss rebooking, please contact our customer support team.</p>
            
            <p style="text-align: center;">
                <a href="{{ url('/booking/new') }}" class="button">Book Another Celebrity</a>
            </p>
            
            <p>We apologize for any inconvenience this may have caused.</p>
            
            <p>Best regards,<br>{{ config('app.name') }} Team</p>
        </div>
        <div class="footer">
            <p>© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            <p>If you have any questions, please contact our support team.</p>
        </div>
    </div>
</body>
</html>