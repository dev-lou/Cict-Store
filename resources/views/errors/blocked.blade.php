<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Blocked - CICT Store</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            padding: 60px 40px;
            max-width: 500px;
            width: 100%;
            text-align: center;
        }

        .icon {
            font-size: 80px;
            margin-bottom: 30px;
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }

        h1 {
            color: #1a202c;
            font-size: 32px;
            font-weight: 800;
            margin-bottom: 20px;
        }

        .message {
            color: #4a5568;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .time-left {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            padding: 20px;
            border-radius: 12px;
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 30px;
        }

        .time-left .number {
            font-size: 36px;
            font-weight: 800;
            display: block;
            margin-bottom: 5px;
        }

        .info-box {
            background: #f7fafc;
            border-left: 4px solid #4299e1;
            padding: 15px;
            border-radius: 8px;
            text-align: left;
            margin-bottom: 30px;
        }

        .info-box p {
            color: #2d3748;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 8px;
        }

        .info-box p:last-child {
            margin-bottom: 0;
        }

        .btn {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 40px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            font-size: 16px;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }

        .footer {
            margin-top: 30px;
            color: #718096;
            font-size: 13px;
        }

        @media (max-width: 600px) {
            .container {
                padding: 40px 30px;
            }

            h1 {
                font-size: 24px;
            }

            .icon {
                font-size: 60px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="icon">🚫</div>
        
        <h1>Access Temporarily Blocked</h1>
        
        <p class="message">
            Too many failed login attempts have been detected from your IP address. 
            For security reasons, access to the login page has been temporarily restricted.
        </p>

        <div class="time-left">
            <span class="number">{{ $minutesLeft }}</span>
            minute{{ $minutesLeft != 1 ? 's' : '' }} remaining
        </div>

        <div class="info-box">
            <p><strong>Why was I blocked?</strong></p>
            <p>After 10 failed login attempts within 30 minutes, we temporarily block the IP address to prevent unauthorized access attempts.</p>
            <p style="margin-top: 10px;"><strong>What should I do?</strong></p>
            <p>• Wait {{ $minutesLeft }} minutes and try again</p>
            <p>• Make sure you're using the correct email and password</p>
            <p>• Contact support if you believe this is an error</p>
        </div>

        <a href="{{ route('home') }}" class="btn">Go to Homepage</a>

        <div class="footer">
            Block expires at: {{ $blockedUntil?->format('h:i A') }}<br>
            CICT Store Security System
        </div>
    </div>
</body>
</html>
