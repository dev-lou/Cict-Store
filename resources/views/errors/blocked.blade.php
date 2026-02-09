<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Blocked | {{ config('app.name') }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Inter', 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .error-container {
            background: white;
            border-radius: 24px;
            padding: 60px 40px;
            max-width: 600px;
            width: 100%;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            text-align: center;
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .error-icon {
            width: 120px;
            height: 120px;
            margin: 0 auto 30px;
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: shake 0.6s ease-in-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-8px) rotate(-5deg); }
            75% { transform: translateX(8px) rotate(5deg); }
        }

        .error-icon svg {
            width: 60px;
            height: 60px;
            color: white;
        }

        .error-title {
            font-size: 32px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 16px;
        }

        .error-message {
            font-size: 16px;
            color: #6b7280;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .time-block {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
            padding: 30px;
            border-radius: 16px;
            margin-bottom: 30px;
            box-shadow: 0 10px 25px -5px rgba(239, 68, 68, 0.3);
        }

        .time-number {
            font-size: 48px;
            font-weight: 900;
            display: block;
            margin-bottom: 8px;
            line-height: 1;
        }

        .time-label {
            font-size: 16px;
            font-weight: 600;
            opacity: 0.9;
        }

        .info-box {
            background: #fef2f2;
            border-left: 4px solid #ef4444;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
            text-align: left;
        }

        .info-box h3 {
            font-size: 14px;
            font-weight: 600;
            color: #991b1b;
            margin-bottom: 12px;
        }

        .info-box p {
            color: #7f1d1d;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 12px;
        }

        .info-box p:last-child {
            margin-bottom: 0;
        }

        .info-box ul {
            list-style: none;
            padding: 0;
            margin-top: 8px;
        }

        .info-box li {
            color: #7f1d1d;
            font-size: 14px;
            padding: 4px 0;
            display: flex;
            align-items: center;
        }

        .info-box li:before {
            content: "•";
            margin-right: 10px;
            color: #ef4444;
            font-weight: bold;
            font-size: 18px;
        }

        .btn {
            padding: 14px 32px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 10px 25px -5px rgba(102, 126, 234, 0.3);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px -5px rgba(102, 126, 234, 0.4);
        }

        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            color: #9ca3af;
            font-size: 13px;
            line-height: 1.6;
        }

        @media (max-width: 640px) {
            .error-container {
                padding: 40px 24px;
            }

            .error-title {
                font-size: 24px;
            }

            .error-message {
                font-size: 14px;
            }

            .time-number {
                font-size: 36px;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-icon">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
            </svg>
        </div>

        <h1 class="error-title">Access Temporarily Blocked</h1>
        <p class="error-message">
            Too many failed login attempts detected from your IP address. For security reasons, access has been temporarily restricted.
        </p>

        <div class="time-block">
            <span class="time-number">{{ $minutesLeft }}</span>
            <span class="time-label">minute{{ $minutesLeft != 1 ? 's' : '' }} remaining</span>
        </div>

        <div class="info-box">
            <h3>🔒 Security Information</h3>
            <p><strong>Why was I blocked?</strong></p>
            <p>After 10 failed login attempts within 30 minutes, we temporarily block the IP address to prevent unauthorized access attempts.</p>
            
            <p style="margin-top: 16px;"><strong>What should I do?</strong></p>
            <ul>
                <li>Wait {{ $minutesLeft }} minute{{ $minutesLeft != 1 ? 's' : '' }} and try again</li>
                <li>Verify you're using the correct email and password</li>
                <li>Use the "Forgot Password" link if needed</li>
                <li>Contact support if you believe this is an error</li>
            </ul>
        </div>

        <a href="{{ route('home') }}" class="btn">
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            Return to Homepage
        </a>

        <div class="footer">
            Block expires at: <strong>{{ $blockedUntil?->format('h:i A') }}</strong><br>
            {{ config('app.name') }} Security System
        </div>
    </div>
</body>
</html>
