<!DOCTYPE html>
<html>
<head>
    <title>Message from {{ config('app.name') }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #4a5568;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }
        .logo {
            max-width: 150px;
            margin-bottom: 15px;
        }
        .content {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-top: 15px;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
            color: #718096;
        }
        h1 {
            color: #ffffff;
            margin: 0;
            font-size: 24px;
        }
        h2 {
            color: #4a5568;
            margin-top: 0;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 10px;
        }
        .booking-ref {
            background-color: #f7fafc;
            padding: 10px;
            border-radius: 5px;
            border-left: 4px solid #4a5568;
            margin: 15px 0;
        }
        .message-box {
            background-color: #f7fafc;
            padding: 15px;
            border-radius: 5px;
            border-left: 4px solid #4299e1;
            margin: 20px 0;
            white-space: pre-wrap;
        }
        .btn {
            display: inline-block;
            background-color: #4a5568;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            @if(config('app.logo'))
                <img src="{{ config('app.logo') }}" alt="{{ config('app.name') }}" class="logo">
            @endif
            <h1>{{ config('app.name') }}</h1>
        </div>
        
        <div class="content">
            <h2>Message from {{ config('app.name') }}</h2>
            
            <p>Hello {{ $name }},</p>
            
            <p>This is a message regarding your booking with {{ $celebrity_name }}.</p>
            
            <div class="booking-ref">
                <strong>Booking Reference:</strong> {{ $booking_reference }}
            </div>
            
            <div class="message-box">
{{ $custom_message }}
            </div>
            
            <p>If you have any questions, please don't hesitate to contact us.</p>
            
            <p>Best regards,<br>
            {{ $admin_name }}<br>
            {{ config('app.name') }} Team</p>
            
            <a href="{{ route('booking.show', $booking_reference) }}" class="btn">View Booking Details</a>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
            <p>This email was sent to you regarding your booking on {{ config('app.name') }}.</p>
        </div>
    </div>
</body>
</html>