<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Email - Indsoft24.com</title>
    <style>
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
        }
        .header p {
            margin: 10px 0 0;
            opacity: 0.9;
            font-size: 16px;
        }
        .content {
            padding: 40px 30px;
        }
        .greeting {
            font-size: 18px;
            margin-bottom: 20px;
            color: #2c3e50;
        }
        .message {
            font-size: 16px;
            margin-bottom: 30px;
            color: #666;
            line-height: 1.6;
        }
        .verify-button {
            display: inline-block;
            background: linear-gradient(135deg, #3498db, #2ecc71);
            color: white;
            text-decoration: none;
            padding: 15px 30px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 16px;
            text-align: center;
            margin: 20px 0;
            transition: all 0.3s ease;
        }
        .verify-button:hover {
            background: linear-gradient(135deg, #2980b9, #27ae60);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(52, 152, 219, 0.3);
        }
        .alternative-link {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin: 30px 0;
            border-left: 4px solid #3498db;
        }
        .alternative-link p {
            margin: 0 0 10px;
            font-size: 14px;
            color: #666;
        }
        .alternative-link a {
            color: #3498db;
            word-break: break-all;
            font-size: 12px;
        }
        .footer {
            background: #f8f9fa;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #e9ecef;
        }
        .footer p {
            margin: 0;
            font-size: 14px;
            color: #666;
        }
        .logo {
            width: 60px;
            height: 60px;
            margin: 0 auto 20px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: bold;
            color: #3498db;
        }
        .expiry-notice {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            color: #856404;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">I24</div>
            <h1>Verify Your Email Address</h1>
            <p>Welcome to Indsoft24.com!</p>
        </div>
        
        <div class="content">
            <div class="greeting">Hello {{ $user->name }},</div>
            
            <div class="message">
                Thank you for registering with Indsoft24.com! To complete your registration and start using our services, please verify your email address by clicking the button below.
            </div>
            
            <div style="text-align: center;">
                <a href="{{ $verificationUrl }}" class="verify-button">
                    Verify Email Address
                </a>
            </div>
            
            <div class="expiry-notice">
                <strong>⏰ Important:</strong> This verification link will expire in 24 hours for security reasons.
            </div>
            
            <div class="alternative-link">
                <p><strong>Button not working?</strong> Copy and paste this link into your browser:</p>
                <a href="{{ $verificationUrl }}">{{ $verificationUrl }}</a>
            </div>
            
            <div class="message">
                If you didn't create an account with Indsoft24.com, please ignore this email. Your account will not be activated without email verification.
            </div>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} Indsoft24.com. All rights reserved.</p>
            <p>This is an automated message, please do not reply to this email.</p>
        </div>
    </div>
</body>
</html>
