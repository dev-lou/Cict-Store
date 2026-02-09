<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Unavailable | {{ config('app.name') }}</title>
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
            background: linear-gradient(135deg, #f59e0b 0%, #ef4444 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(245, 158, 11, 0.4);
            }
            50% {
                transform: scale(1.05);
                box-shadow: 0 0 0 20px rgba(245, 158, 11, 0);
            }
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

        .error-details {
            background: #fef3c7;
            border-left: 4px solid #f59e0b;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
            text-align: left;
        }

        .error-details h3 {
            font-size: 14px;
            font-weight: 600;
            color: #92400e;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .error-details ul {
            list-style: none;
            padding: 0;
        }

        .error-details li {
            font-size: 14px;
            color: #78350f;
            padding: 6px 0;
            display: flex;
            align-items: center;
        }

        .error-details li:before {
            content: "→";
            margin-right: 10px;
            color: #f59e0b;
            font-weight: bold;
        }

        .button-group {
            display: flex;
            gap: 16px;
            justify-content: center;
            flex-wrap: wrap;
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
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 10px 25px -5px rgba(102, 126, 234, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px -5px rgba(102, 126, 234, 0.4);
        }

        .btn-secondary {
            background: #f3f4f6;
            color: #374151;
        }

        .btn-secondary:hover {
            background: #e5e7eb;
            transform: translateY(-2px);
        }

        .status-indicator {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 20px;
            padding: 10px 20px;
            background: #fee2e2;
            border-radius: 20px;
            font-size: 14px;
            color: #991b1b;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            background: #ef4444;
            border-radius: 50%;
            animation: blink 1.5s ease-in-out infinite;
        }

        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.3; }
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

            .button-group {
                flex-direction: column;
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
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path>
            </svg>
        </div>

        <h1 class="error-title">Database Connection Failed</h1>
        <p class="error-message">
            We're unable to connect to our database at the moment. Our technical team has been notified and is working to restore the connection.
        </p>

        <div class="error-details">
            <h3>
                <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                For Site Administrators
            </h3>
            <ul>
                <li>Check database server status and connectivity</li>
                <li>Verify database credentials in .env file</li>
                <li>Review application logs for detailed error messages</li>
                <li>Ensure database service is running</li>
            </ul>
        </div>

        <div class="button-group">
            <a href="{{ url('/') }}" class="btn btn-primary">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                Return to Homepage
            </a>
            <button onclick="window.location.reload()" class="btn btn-secondary">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
                Retry Connection
            </button>
        </div>

        <div class="status-indicator">
            <span class="status-dot"></span>
            Database Status: Unavailable
        </div>
    </div>
</body>
</html>
