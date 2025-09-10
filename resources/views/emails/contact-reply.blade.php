<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reply to Your Message</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8f9fa;
        }
        .email-container {
            background: white;
            border-radius: 10px;
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
            font-size: 28px;
            font-weight: 600;
        }
        .header p {
            margin: 5px 0 0 0;
            opacity: 0.9;
            font-size: 16px;
        }
        .content {
            padding: 30px;
        }
        .greeting {
            font-size: 18px;
            margin-bottom: 20px;
            color: #2d3748;
        }
        .original-message {
            background: #f7fafc;
            border-left: 4px solid #4299e1;
            padding: 20px;
            margin: 20px 0;
            border-radius: 0 8px 8px 0;
        }
        .original-message h3 {
            margin: 0 0 10px 0;
            color: #2d3748;
            font-size: 16px;
        }
        .original-message p {
            margin: 5px 0;
            color: #4a5568;
        }
        .reply-content {
            background: #edf2f7;
            padding: 25px;
            border-radius: 8px;
            margin: 25px 0;
            border: 1px solid #e2e8f0;
        }
        .reply-content h3 {
            margin: 0 0 15px 0;
            color: #2d3748;
            font-size: 18px;
        }
        .reply-message {
            color: #2d3748;
            line-height: 1.7;
            white-space: pre-line;
        }
        .contact-info {
            background: #f0fff4;
            border: 1px solid #9ae6b4;
            border-radius: 8px;
            padding: 20px;
            margin: 25px 0;
        }
        .contact-info h3 {
            margin: 0 0 10px 0;
            color: #22543d;
        }
        .contact-info p {
            margin: 5px 0;
            color: #2f855a;
        }
        .footer {
            background: #2d3748;
            color: white;
            padding: 25px;
            text-align: center;
        }
        .footer p {
            margin: 5px 0;
            opacity: 0.8;
        }
        .footer a {
            color: #90cdf4;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
        .divider {
            height: 1px;
            background: #e2e8f0;
            margin: 20px 0;
        }
        .badge {
            display: inline-block;
            padding: 4px 8px;
            background: #e2e8f0;
            color: #4a5568;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <h1>{{ $data['site_name'] }}</h1>
            <p>Customer Support Response</p>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="greeting">
                Dear {{ $data['customer_name'] }},
            </div>

            <p>Thank you for contacting us. We have received your message and are pleased to provide you with the following response:</p>

            <!-- Original Message Reference -->
            <div class="original-message">
                <h3>Your Original Message <span class="badge">{{ $data['sent_at'] }}</span></h3>
                <p><strong>Subject:</strong> {{ $data['original_subject'] }}</p>
                <div class="divider"></div>
                <p style="font-style: italic; color: #4a5568;">{{ $data['original_message'] }}</p>
            </div>

            <!-- Reply Content -->
            <div class="reply-content">
                <h3>Our Response</h3>
                <div class="reply-message">{{ $data['reply_message'] }}</div>
            </div>

            <!-- Contact Information -->
            <div class="contact-info">
                <h3>Need Further Assistance?</h3>
                <p>If you have any additional questions or need further clarification, please don't hesitate to contact us.</p>
                <p><strong>Reply to this email</strong> or visit our contact page for immediate assistance.</p>
            </div>

            <p>Best regards,<br>
            <strong>{{ $data['admin_name'] }}</strong><br>
            {{ $data['site_name'] }} Customer Support Team</p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ $data['site_name'] }}. All rights reserved.</p>
            <p>This email was sent in response to your inquiry submitted on {{ $data['sent_at'] }}</p>
        </div>
    </div>
</body>
</html>
