<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Status Updated</title>
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
            background-color: #4f46e5;
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
        .status {
            font-weight: bold;
            color: #4f46e5;
        }
        .button {
            display: inline-block;
            padding: 10px 15px;
            background-color: #4f46e5;
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
            <h1>Booking Status Update</h1>
        </div>
        <div class="content">
            <p>Dear {{ $name }},</p>
            
            <p>Your booking status has been updated.</p>
            
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
                <div class="details-row">
                    <div class="details-label">Current Status:</div>
                    <div class="details-value status">{{ ucfirst($new_status) }}</div>
                </div>
            </div>
            
            @if($new_status == 'approved')
            <p>Great news! Your booking has been approved. Please make sure to review the event details and contact us if you have any questions.</p>
            @elseif($new_status == 'completed')
            <p>Your booking has been marked as completed. Thank you for using our service! We hope you enjoyed your time with {{ $celebrity_name }}.</p>
            @elseif($new_status == 'cancelled')
            <p>Your booking has been cancelled. If you have any questions regarding refunds or would like to discuss rebooking, please contact our customer support team.</p>
            @elseif($new_status == 'rejected')
            <p>Unfortunately, your booking has been rejected. This could be due to scheduling conflicts, unavailability, or other reasons. Please contact our customer support for more information and to discuss alternatives.</p>
            @else
            <p>Your booking is currently being reviewed. We'll notify you once a decision has been made.</p>
            @endif
            
            <p style="text-align: center;">
                <a href="{{ url('/booking/' . $booking_reference) }}" class="button">View Booking Details</a>
            </p>
            
            <p>If you have any questions or need assistance, please don't hesitate to contact our support team.</p>
            
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