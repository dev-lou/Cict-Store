<x-auth-layout :title="'Register - CICT Merch'">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: #f8fafc;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .auth-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: 100vh;
            width: 100%;
        }

        /* Left Side - Branding */
        .auth-brand-side {
            background: linear-gradient(135deg, #8B0000 0%, #5C0000 100%);
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }

        .auth-brand-side::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            border-radius: 50%;
        }

        .auth-brand-side::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -15%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.08) 0%, transparent 70%);
            border-radius: 50%;
        }

        .brand-content {
            position: relative;
            z-index: 2;
        }

        .brand-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 60px;
        }

        .logo-icon {
            width: 56px;
            height: 56px;
            background: white;
            border-radius: 12px;
            object-fit: cover;
            padding: 8px;
        }

        .logo-text {
            font-size: 24px;
            font-weight: 800;
            color: white;
            letter-spacing: -0.5px;
        }

        .brand-headline {
            font-size: 48px;
            font-weight: 900;
            color: white;
            line-height: 1.2;
            margin-bottom: 24px;
            letter-spacing: -1px;
        }

        .brand-description {
            font-size: 18px;
            color: rgba(255, 255, 255, 0.9);
            line-height: 1.6;
            margin-bottom: 40px;
        }

        .brand-features {
            display: grid;
            gap: 20px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 16px;
            color: white;
        }

        .feature-icon {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            backdrop-filter: blur(10px);
        }

        .feature-text {
            font-size: 15px;
            font-weight: 500;
            opacity: 0.95;
        }

        .brand-footer {
            position: relative;
            z-index: 2;
            color: rgba(255, 255, 255, 0.7);
            font-size: 14px;
        }

        /* Right Side - Form */
        .auth-form-side {
            background: white;
            padding: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-wrapper {
            width: 100%;
            max-width: 460px;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #64748b;
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            margin-bottom: 32px;
            padding: 10px 16px;
            border-radius: 10px;
            transition: all 0.2s;
        }

        .back-link:hover {
            color: #8B0000;
            border-color: #8B0000;
            background: rgba(139, 0, 0, 0.04);
            transform: translateX(-4px);
        }

        .back-link svg {
            flex-shrink: 0;
        }

        .form-header {
            margin-bottom: 40px;
        }

        .form-title {
            font-size: 36px;
            font-weight: 900;
            color: #0f172a;
            margin-bottom: 12px;
            letter-spacing: -1px;
        }

        .form-subtitle {
            font-size: 16px;
            color: #64748b;
            font-weight: 500;
        }

        /* Google Button */
        .google-btn-wrapper {
            margin-bottom: 32px;
        }

        .google-btn {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            padding: 16px;
            border: 2px solid #e2e8f0;
            border-radius: 14px;
            background: white;
            font-size: 15px;
            font-weight: 600;
            color: #1e293b;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
        }

        .google-btn:hover {
            border-color: #cbd5e1;
            background: #f8fafc;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
        }

        .google-btn svg {
            width: 20px;
            height: 20px;
        }

        /* Divider */
        .divider {
            display: flex;
            align-items: center;
            margin: 32px 0;
            color: #94a3b8;
            font-size: 14px;
            font-weight: 500;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #e2e8f0;
        }

        .divider span {
            padding: 0 20px;
        }

        /* Form Fields */
        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #334155;
            margin-bottom: 10px;
        }

        .form-input {
            width: 100%;
            padding: 16px 18px;
            border: 2px solid #e2e8f0;
            border-radius: 14px;
            font-size: 15px;
            transition: all 0.2s;
            background: white;
            color: #0f172a;
            font-weight: 500;
        }

        .form-input:focus {
            outline: none;
            border-color: #8B0000;
            box-shadow: 0 0 0 4px rgba(139, 0, 0, 0.08);
        }

        .form-input::placeholder {
            color: #94a3b8;
            font-weight: 400;
        }

        /* Hide browser's default password reveal button */
        .form-input::-ms-reveal,
        .form-input::-ms-clear {
            display: none;
        }

        .password-wrapper {
            position: relative;
        }

        .password-wrapper .form-input {
            padding-right: 50px;
        }

        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px;
            color: #64748b;
            transition: color 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .password-toggle:hover {
            color: #8B0000;
        }

        .password-toggle svg {
            width: 20px;
            height: 20px;
        }

        /* Submit Button */
        .submit-btn {
            width: 100%;
            padding: 18px;
            background: linear-gradient(135deg, #8B0000 0%, #B00000 100%);
            color: white;
            border: none;
            border-radius: 14px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 16px rgba(139, 0, 0, 0.3);
            margin-top: 8px;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(139, 0, 0, 0.4);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        /* Footer */
        .form-footer {
            margin-top: 32px;
            text-align: center;
            font-size: 15px;
            color: #64748b;
        }

        .form-footer a {
            color: #8B0000;
            font-weight: 700;
            text-decoration: none;
            transition: color 0.2s;
        }

        .form-footer a:hover {
            color: #B00000;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .auth-container {
                grid-template-columns: 1fr;
            }

            .auth-brand-side {
                display: none;
            }

            .auth-form-side {
                padding: 40px 24px;
            }

            .form-title {
                font-size: 32px;
            }
        }

        @media (max-width: 640px) {
            .auth-form-side {
                padding: 20px 20px 24px;
                overflow-y: auto;
            }

            .form-wrapper {
                min-height: auto;
            }

            .form-title {
                font-size: 26px;
            }

            .brand-headline {
                font-size: 36px;
            }

            .form-input {
                font-size: 16px; /* Prevent iOS zoom */
                padding: 14px 16px;
            }

            .back-link {
                margin-bottom: 20px;
            }

            .form-header {
                margin-bottom: 28px;
            }

            .google-btn-wrapper {
                margin-bottom: 20px;
            }

            .google-btn {
                padding: 14px;
            }

            .divider {
                margin: 20px 0;
            }

            .form-group {
                margin-bottom: 16px;
            }

            .submit-btn {
                padding: 16px;
                margin-top: 4px;
            }

            .form-footer {
                margin-top: 24px;
                padding-bottom: 8px;
            }
        }

        /* Animation */
        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .brand-content {
            animation: slideInLeft 0.6s ease;
        }

        .form-wrapper {
            animation: slideInRight 0.6s ease;
        }
    </style>

    <div class="auth-container">
        <!-- Left Side - Branding -->
        <div class="auth-brand-side">
            <div class="brand-content">
                <div class="brand-logo">
                    @php
                        $logoSetting = \App\Models\Setting::where('key', 'site_logo')->first();
                        $logoUrl = $logoSetting && $logoSetting->value 
                            ? \Storage::disk('supabase')->url($logoSetting->value) 
                            : asset('images/ctrlp-logo.png');
                    @endphp
                    <img src="{{ $logoUrl }}" alt="Logo" class="logo-icon">
                    <span class="logo-text">{{ config('app.name') }}</span>
                </div>

                <h1 class="brand-headline">
                    Join the<br>
                    Community
                </h1>

                <p class="brand-description">
                    Create your account and get access to exclusive CICT merchandise, special offers, and more.
                </p>

                <div class="brand-features">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <span class="feature-text">Free account creation</span>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <span class="feature-text">Track your orders easily</span>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon">
                            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <span class="feature-text">Exclusive member benefits</span>
                    </div>
                </div>
            </div>

            <div class="brand-footer">
                © 2026 CICT Dingle. All rights reserved.
            </div>
        </div>

        <!-- Right Side - Form -->
        <div class="auth-form-side">
            <div class="form-wrapper">
                <a href="{{ route('home') }}" class="back-link">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M10 14L4 8l6-6"/>
                    </svg>
                    Back to Home
                </a>

                <div class="form-header">
                    <h2 class="form-title">Create Account</h2>
                    <p class="form-subtitle">Sign up to start shopping</p>
                </div>

                <!-- Google OAuth -->
                <div class="google-btn-wrapper">
                    <a href="{{ route('oauth.redirect', ['provider' => 'google']) }}" class="google-btn">
                        <svg viewBox="0 0 24 24" width="20" height="20">
                            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                        </svg>
                        Continue with Google
                    </a>
                </div>

                <!-- Divider -->
                <div class="divider">
                    <span>or continue with email</span>
                </div>

                <!-- Register Form -->
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group">
                        <label class="form-label" for="name">Full Name</label>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            class="form-input" 
                            placeholder="Juan Dela Cruz"
                            value="{{ old('name') }}"
                            required 
                            autofocus
                        >
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="email">Email Address</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            class="form-input" 
                            placeholder="you@example.com"
                            value="{{ old('email') }}"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password">Password</label>
                        <div class="password-wrapper">
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                class="form-input" 
                                placeholder="Create a strong password"
                                required
                            >
                            <button type="button" class="password-toggle" onclick="togglePassword('password')">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password_confirmation">Confirm Password</label>
                        <div class="password-wrapper">
                            <input 
                                type="password" 
                                id="password_confirmation" 
                                name="password_confirmation" 
                                class="form-input" 
                                placeholder="Re-enter your password"
                                required
                            >
                            <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation')">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="submit-btn">
                        Create Account
                    </button>
                </form>

                <div class="form-footer">
                    Already have an account? <a href="{{ route('login') }}">Sign in</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const button = field.nextElementSibling;
            const svg = button.querySelector('svg');
            
            if (field.type === 'password') {
                field.type = 'text';
                svg.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line>';
            } else {
                field.type = 'password';
                svg.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle>';
            }
        }
    </script>
</x-auth-layout>
