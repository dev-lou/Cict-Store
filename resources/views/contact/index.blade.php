<x-app-layout>
    @section('title', 'Contact - ' . config('app.name', 'CICT Dingle'))

    <style>
        /* ============ DESIGN TOKENS ============ */
        :root {
            --primary: #8B0000;
            --primary-hover: #6B0000;
            --text-primary: #111827;
            --text-secondary: #6B7280;
            --bg-primary: #FFFFFF;
            --bg-secondary: #F9FAFB;
            --border: #E5E7EB;
            --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
        }

        /* ============ HERO SECTION ============ */
        .contact-hero {
            min-height: 55vh;
            padding: 180px 24px 80px;
            background: linear-gradient(135deg, #8B0000 0%, #5C0000 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            margin-top: -72px;
            position: relative;
            overflow: hidden;
        }

        @media (max-width: 768px) {
            .contact-hero {
                min-height: 50vh;
                padding-top: 160px;
                padding-bottom: 60px;
            }

            .contact-hero-content {
                margin-top: 40px;
            }
        }

        .contact-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url('{{ asset("images/cict_hero_bg.webp") }}') center/cover;
            opacity: 0.15;
        }

        .contact-hero-content {
            position: relative;
            z-index: 10;
            max-width: 600px;
        }

        .contact-hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 999px;
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .contact-hero-title {
            font-size: clamp(32px, 5vw, 48px);
            font-weight: 800;
            color: #fff;
            line-height: 1.1;
            margin-bottom: 16px;
            letter-spacing: -1px;
        }

        .contact-hero-subtitle {
            font-size: clamp(14px, 2vw, 18px);
            color: rgba(255, 255, 255, 0.9);
            line-height: 1.5;
        }

        /* ============ MAIN CONTENT ============ */
        .contact-content {
            background: var(--bg-secondary);
            padding: 60px 24px 80px;
        }

        .contact-container {
            max-width: 1000px;
            margin: 0 auto;
        }

        /* ============ INFO BADGES ============ */
        .contact-badges {
            display: flex;
            gap: 12px;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 40px;
        }

        .contact-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            background: var(--bg-primary);
            border: 1px solid var(--border);
            border-radius: 999px;
            font-size: 13px;
            font-weight: 600;
            color: var(--primary);
        }

        /* ============ CONTACT GRID ============ */
        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1.2fr;
            gap: 32px;
            align-items: start;
        }

        @media (max-width: 768px) {
            .contact-grid {
                grid-template-columns: 1fr;
                gap: 24px;
            }
        }

        /* ============ CONTACT CARDS ============ */
        .contact-cards {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .contact-card {
            background: var(--bg-primary);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 24px;
            transition: all 0.3s ease;
        }

        .contact-card:hover {
            box-shadow: var(--shadow-lg);
        }

        .contact-card-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 12px;
        }

        .contact-card-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, rgba(139, 0, 0, 0.1), rgba(139, 0, 0, 0.05));
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        .contact-card-title {
            font-size: 12px;
            font-weight: 700;
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .contact-card-value {
            font-size: 15px;
            font-weight: 500;
            color: var(--text-primary);
            line-height: 1.6;
        }

        /* ============ SOCIAL LINKS ============ */
        .social-link {
            display: flex;
            align-items: center;
            gap: 16px;
            background: var(--bg-primary);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            padding: 20px 24px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .social-link:hover {
            box-shadow: var(--shadow-lg);
            transform: translateX(4px);
        }

        .social-link-icon {
            font-size: 28px;
        }

        .social-link-content {
            flex: 1;
        }

        .social-link-title {
            font-size: 14px;
            font-weight: 700;
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 2px;
        }

        .social-link-desc {
            font-size: 13px;
            color: var(--text-secondary);
        }

        .social-link-arrow {
            font-size: 18px;
            color: var(--primary);
            transition: transform 0.2s ease;
        }

        .social-link:hover .social-link-arrow {
            transform: translateX(4px);
        }

        /* ============ MAP ============ */
        .map-container {
            background: var(--bg-primary);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            overflow: hidden;
            height: 100%;
            min-height: 400px;
        }

        .map-container iframe {
            width: 100%;
            height: 100%;
            min-height: 400px;
            border: none;
            display: block;
        }

        /* ============ MOBILE ADJUSTMENTS ============ */
        @media (max-width: 640px) {
            .contact-hero {
                min-height: 35vh;
                padding: 120px 16px 40px;
            }

            .contact-hero-title {
                font-size: 26px;
            }

            .contact-hero-subtitle {
                font-size: 13px;
            }

            .contact-content {
                padding: 32px 12px 60px;
            }

            .contact-badges {
                gap: 8px;
                margin-bottom: 28px;
            }

            .contact-badge {
                padding: 8px 12px;
                font-size: 12px;
            }

            .contact-card {
                padding: 16px;
            }

            .contact-card-icon {
                width: 36px;
                height: 36px;
                font-size: 18px;
            }

            .contact-card-title {
                font-size: 11px;
            }

            .contact-card-value {
                font-size: 14px;
            }

            .social-link {
                padding: 16px;
                gap: 12px;
            }

            .social-icon {
                width: 44px;
                height: 44px;
                font-size: 20px;
            }

            .social-name {
                font-size: 14px;
            }

            .social-handle {
                font-size: 12px;
            }

            .form-card {
                padding: 20px;
            }

            .form-card h2 {
                font-size: 20px;
            }

            .form-label {
                font-size: 12px;
            }

            .form-input,
            .form-textarea {
                padding: 12px;
                font-size: 14px;
            }

            .submit-btn {
                padding: 14px 24px;
                font-size: 14px;
            }
        }
    </style>

    <!-- Hero Section -->
    <section class="contact-hero">
        <div class="contact-hero-content">
            <div class="contact-hero-badge">
                <span>📬</span>
                <span>Get in Touch</span>
            </div>
            <h1 class="contact-hero-title gsap-hero-title">Contact Us</h1>
            <p class="contact-hero-subtitle gsap-hero-subtitle">
                Questions about orders or services? We're here to help.
            </p>
        </div>
    </section>

    <!-- Contact Content -->
    <div class="contact-content">
        <div class="contact-container">
            <!-- Info Badges -->
            <div class="contact-badges">
                <span class="contact-badge">
                    <span>⏱️</span>
                    <span>Response in 1-2 days</span>
                </span>
                <span class="contact-badge">
                    <span>📍</span>
                    <span>ISUFST Dingle Campus</span>
                </span>
                <span class="contact-badge">
                    <span>💬</span>
                    <span>Messenger Available</span>
                </span>
            </div>

            <!-- Contact Grid -->
            <div class="contact-grid">
                <!-- Left Column: Contact Info -->
                <div class="contact-cards">
                    <!-- Office Hours -->
                    <div class="contact-card reveal-on-scroll">
                        <div class="contact-card-header">
                            <div class="contact-card-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20"
                                    height="20" viewBox="0 0 24 24" fill="none" stroke="#8B0000" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10" />
                                    <polyline points="12 6 12 12 16 14" />
                                </svg></div>
                            <span class="contact-card-title">Office Hours</span>
                        </div>
                        <div class="contact-card-value">
                            Monday – Friday: 8:00 AM – 5:00 PM<br>
                            <span style="color: var(--text-secondary); font-size: 13px;">Closed on weekends</span>
                        </div>
                    </div>

                    <!-- Facebook -->
                    <a href="https://www.facebook.com/profile.php?id=100068849010766" target="_blank"
                        class="social-link reveal-on-scroll">
                        <span class="social-link-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="#1877F2">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg></span>
                        <div class="social-link-content">
                            <div class="social-link-title">Facebook</div>
                            <div class="social-link-desc">Follow our official page</div>
                        </div>
                        <span class="social-link-arrow">→</span>
                    </a>

                    <!-- Messenger -->
                    <a href="https://www.messenger.com/e2ee/t/780806171591045" target="_blank"
                        class="social-link reveal-on-scroll">
                        <span class="social-link-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="url(#messenger-gradient)">
                                <defs>
                                    <linearGradient id="messenger-gradient" x1="0%" y1="0%" x2="0%" y2="100%">
                                        <stop offset="0%" style="stop-color:#00B2FF" />
                                        <stop offset="100%" style="stop-color:#006AFF" />
                                    </linearGradient>
                                </defs>
                                <path
                                    d="M12 0C5.373 0 0 4.975 0 11.111c0 3.497 1.745 6.616 4.472 8.652V24l4.086-2.242c1.09.301 2.246.464 3.442.464 6.627 0 12-4.975 12-11.111S18.627 0 12 0zm1.193 14.963l-3.056-3.259-5.963 3.259 6.559-6.963 3.13 3.259 5.889-3.259-6.559 6.963z" />
                            </svg></span>
                        <div class="social-link-content">
                            <div class="social-link-title">Messenger</div>
                            <div class="social-link-desc">Direct message for inquiries</div>
                        </div>
                        <span class="social-link-arrow">→</span>
                    </a>

                    <!-- Location -->
                    <div class="contact-card reveal-on-scroll">
                        <div class="contact-card-header">
                            <div class="contact-card-icon"><svg xmlns="http://www.w3.org/2000/svg" width="20"
                                    height="20" viewBox="0 0 24 24" fill="#8B0000" stroke="none">
                                    <path
                                        d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                                </svg></div>
                            <span class="contact-card-title">Location</span>
                        </div>
                        <div class="contact-card-value">
                            CICT Student Council Office<br>
                            ISUFST Dingle Campus<br>
                            Brgy. San Matias, Dingle<br>
                            Iloilo, Philippines
                        </div>
                    </div>
                </div>

                <!-- Right Column: Map -->
                <div class="map-container reveal-on-scroll">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1019.5295668491787!2d122.6630695470763!3d11.001138999855694!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33af1776ffd9b7f1%3A0x2c4663ccaaf49fa8!2sIloilo%20State%20University%20of%20Fisheries%20Science%20and%20Technology%E2%80%93%20Dingle%20Campus!5e1!3m2!1sen!2sph!4v1764327935192!5m2!1sen!2sph"
                        loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen
                        title="CICT Student Council Office - Google Maps">
                    </iframe>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>