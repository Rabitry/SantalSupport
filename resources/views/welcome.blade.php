<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Santal Community Directory - Official Portal</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <style>
            /* === GLOBAL STYLES === */
            :root {
                --primary-color: #1a365d;
                --primary-dark: #0f2547;
                --secondary-color: #2d3748;
                --accent-color: #2b6cb0;
                --accent-dark: #1e4e8c;
                --light-color: #f7fafc;
                --border-color: #e2e8f0;
                --success-color: #2d8c4a;
                --text-light: #718096;
            }
            
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            
            /* BODY WITH BACKGROUND IMAGE - MULTIPLE PATH OPTIONS */
            body {
                font-family: 'Figtree', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                /* Try these paths one by one: */
                
                /* Option 1: Public folder path */
                background: 
                    linear-gradient(rgba(26, 54, 93, 0.85), rgba(26, 54, 93, 0.90));
                    /*url("{{ asset('images/santal-community-welcomev.jpg') }}") center/cover fixed no-repeat;*/

                
                /* Option 2: Direct public path */
                /* background: 
                    linear-gradient(rgba(26, 54, 93, 0.85), rgba(26, 54, 93, 0.90)), 
                    url('/images/santal-community-welcomev.jpg') center/cover fixed no-repeat; */
                
                /* Option 3: Storage path */
                /* background: 
                    linear-gradient(rgba(26, 54, 93, 0.85), rgba(26, 54, 93, 0.90)), 
                    url("{{ storage_path('app/public/images/santal-community-welcomev.jpg') }}") center/cover fixed no-repeat; */
                
                color: #333;
                line-height: 1.6;
                min-height: 100vh;
            }

            /* Fallback if background image doesn't load */
            .background-fallback {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
                z-index: -1;
            }
            
            .container {
                width: 100%;
                max-width: 1200px;
                margin: 0 auto;
                padding: 0 20px;
                position: relative;
                z-index: 1;
            }
            
            /* === HEADER === */
            header {
                background: rgba(26, 54, 93, 0.95);
                backdrop-filter: blur(10px);
                color: white;
                padding: 16px 0;
                box-shadow: 0 2px 12px rgba(0, 0, 0, 0.15);
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
                position: relative;
                z-index: 2;
            }
            
            .header-content {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
            
            .logo {
                display: flex;
                align-items: center;
            }
            
            .logo h1 {
                font-size: 24px;
                color: white;
                margin: 0;
                font-weight: 600;
            }
            
            .logo-icon {
                margin-right: 12px;
                font-size: 26px;
            }
            
            .auth-links {
                display: flex;
                align-items: center;
                gap: 20px;
            }
            
            .auth-links a {
                color: white;
                text-decoration: none;
                font-weight: 500;
                transition: all 0.3s ease;
                padding: 8px 16px;
                border-radius: 4px;
                border: 1px solid rgba(255, 255, 255, 0.2);
            }
            
            .auth-links a:hover {
                background: rgba(255, 255, 255, 0.15);
                transform: translateY(-1px);
            }
            
            /* === HERO SECTION === */
            .hero-section {
                padding: 100px 0;
                background: rgba(255, 255, 255, 0.92);
                backdrop-filter: blur(15px);
                text-align: center;
                border-radius: 0;
                margin: 0;
                border-bottom: 1px solid rgba(255, 255, 255, 0.2);
                position: relative;
                z-index: 1;
            }
            
            .hero-title {
                font-size: 42px;
                font-weight: 700;
                color: var(--primary-color);
                margin-bottom: 16px;
                line-height: 1.2;
                text-shadow: 1px 1px 3px rgba(0,0,0,0.1);
            }
            
            .hero-subtitle {
                font-size: 20px;
                color: var(--text-light);
                max-width: 700px;
                margin: 0 auto 40px;
                font-weight: 400;
            }
            
            .hero-image {
                width: 100%;
                max-width: 900px;
                height: 400px;
                object-fit: cover;
                border-radius: 12px;
                box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
                margin: 0 auto;
                display: block;
                border: 1px solid rgba(255, 255, 255, 0.3);
                backdrop-filter: blur(5px);
            }
            
            /* === FEATURES SECTION === */
            .features-section {
                padding: 80px 0;
                background: rgba(255, 255, 255, 0.88);
                backdrop-filter: blur(10px);
                border-bottom: 1px solid rgba(255, 255, 255, 0.2);
                position: relative;
                z-index: 1;
            }
            
            .section-title {
                font-size: 32px;
                color: var(--primary-color);
                font-weight: 600;
                text-align: center;
                margin-bottom: 60px;
                text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
            }
            
            .features-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                gap: 30px;
            }
            
            .feature-card {
                background: rgba(255, 255, 255, 0.75);
                backdrop-filter: blur(8px);
                border-radius: 10px;
                padding: 30px;
                box-shadow: 0 8px 25px rgba(0,0,0,0.1);
                border: 1px solid rgba(255, 255, 255, 0.4);
                transition: all 0.3s ease;
                text-align: center;
            }
            
            .feature-card:hover {
                transform: translateY(-8px);
                box-shadow: 0 15px 35px rgba(0,0,0,0.15);
                background: rgba(255, 255, 255, 0.9);
            }
            
            .feature-icon {
                width: 70px;
                height: 70px;
                margin: 0 auto 20px;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                background: rgba(43, 108, 176, 0.15);
                backdrop-filter: blur(5px);
                border: 1px solid rgba(43, 108, 176, 0.2);
            }
            
            .feature-icon svg {
                width: 32px;
                height: 32px;
                color: var(--accent-color);
            }
            
            .feature-title {
                font-size: 20px;
                font-weight: 600;
                color: var(--primary-color);
                margin-bottom: 15px;
            }
            
            .feature-description {
                color: var(--text-light);
                line-height: 1.6;
            }
            
            /* === ACTIONS SECTION === */
            .actions-section {
                padding: 80px 0;
                background: rgba(255, 255, 255, 0.92);
                backdrop-filter: blur(15px);
                text-align: center;
                border-bottom: 1px solid rgba(255, 255, 255, 0.2);
                position: relative;
                z-index: 1;
            }
            
            .actions-title {
                font-size: 32px;
                color: var(--primary-color);
                font-weight: 600;
                margin-bottom: 40px;
                text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
            }
            
            .action-buttons {
                display: flex;
                justify-content: center;
                gap: 20px;
                flex-wrap: wrap;
            }
            
            .btn {
                padding: 14px 28px;
                border: none;
                border-radius: 8px;
                font-weight: 600;
                font-size: 16px;
                cursor: pointer;
                transition: all 0.3s;
                text-decoration: none;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                backdrop-filter: blur(5px);
            }
            
            .btn-primary {
                background: rgba(43, 108, 176, 0.9);
                color: white;
                border: 1px solid rgba(255, 255, 255, 0.3);
            }
            
            .btn-secondary {
                background: rgba(255, 255, 255, 0.8);
                color: var(--accent-color);
                border: 1px solid rgba(43, 108, 176, 0.3);
            }
            
            .btn-primary:hover {
                background: rgba(30, 78, 140, 0.95);
                transform: translateY(-3px);
                box-shadow: 0 8px 20px rgba(43, 108, 176, 0.3);
            }
            
            .btn-secondary:hover {
                background: rgba(43, 108, 176, 0.9);
                color: white;
                transform: translateY(-3px);
                box-shadow: 0 8px 20px rgba(43, 108, 176, 0.3);
            }
            
            /* === FOOTER === */
            footer {
                background: rgba(26, 54, 93, 0.95);
                backdrop-filter: blur(10px);
                color: white;
                padding: 40px 0;
                text-align: center;
                border-top: 1px solid rgba(255, 255, 255, 0.1);
                position: relative;
                z-index: 2;
            }
            
            .footer-content {
                display: flex;
                justify-content: space-between;
                align-items: center;
                flex-wrap: wrap;
                gap: 20px;
            }
            
            .footer-logo {
                display: flex;
                align-items: center;
                gap: 10px;
                font-weight: 600;
                font-size: 18px;
            }
            
            .footer-text {
                color: rgba(255, 255, 255, 0.8);
            }
            
            /* === RESPONSIVE DESIGN === */
            @media (max-width: 768px) {
                .header-content {
                    flex-direction: column;
                    gap: 15px;
                }
                
                .hero-title {
                    font-size: 32px;
                }
                
                .hero-section {
                    padding: 60px 0;
                }
                
                .hero-subtitle {
                    font-size: 18px;
                }
                
                .hero-image {
                    height: 250px;
                }
                
                .section-title, .actions-title {
                    font-size: 28px;
                }
                
                .feature-card {
                    padding: 25px;
                }
                
                .action-buttons {
                    flex-direction: column;
                    align-items: center;
                }
                
                .btn {
                    width: 100%;
                    max-width: 300px;
                }
                
                .footer-content {
                    flex-direction: column;
                    text-align: center;
                }
            }

            /* Debug helper */
            .debug-info {
                position: fixed;
                top: 10px;
                right: 10px;
                background: rgba(0,0,0,0.8);
                color: white;
                padding: 10px;
                border-radius: 5px;
                font-size: 12px;
                z-index: 9999;
            }
        </style>
    </head>
    <body>
        <!-- Debug Info -->
        <!-- <div class="debug-info" id="debugInfo">
            Background: Loading...
        </div> -->

        <!-- Fallback Background -->
        <div class="background-fallback" id="backgroundFallback"></div>

        <!-- Header -->
        <header>
            <div class="container">
                <div class="header-content">
                    <div class="logo">
                        <div class="logo-icon">🏛️</div>
                        <h1>Santal Community Directory</h1>
                    </div>
                    
                    <div class="auth-links">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}">Dashboard</a>
                                <a href="{{ url('/population') }}">Community Directory</a>
                            @else
                                <a href="{{ route('login') }}">Member Login</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}">Register</a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </header>

        <!-- Hero Section -->
        <section class="hero-section">
            <div class="container">
                <h1 class="hero-title">Santal Community Directory</h1>
                <p class="hero-subtitle">
                    Official digital registry connecting the Santal community. Preserving heritage, fostering connections, and building a stronger future together.
                </p>
                
                <!-- Professional Community Image -->
                <!-- <img 
                    src="{{ asset('images/santal-community-official.jpg') }}" 
                    alt="Santal Community Gathering" 
                    class="hero-image"
                    onerror="this.style.display='none'"
                > -->
            </div>
        </section>

        <!-- Features Section -->
        <section class="features-section">
            <div class="container">
                <h2 class="section-title">Platform Features</h2>
                
                <div class="features-grid">
                    <!-- Feature 1 -->
                    <div class="feature-card">
                        <div class="feature-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="feature-title">Community Registry</h3>
                        <p class="feature-description">
                            Official directory of Santal community members with verified profiles, professional networking, and secure communication channels.
                        </p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="feature-card">
                        <div class="feature-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <h3 class="feature-title">Cultural Preservation</h3>
                        <p class="feature-description">
                            Documenting and preserving Santal heritage, traditions, language, and cultural practices for future generations.
                        </p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="feature-card">
                        <div class="feature-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <h3 class="feature-title">Professional Network</h3>
                        <p class="feature-description">
                            Connect with Santal professionals across various fields, fostering mentorship, collaboration, and career development opportunities.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Actions Section -->
        <section class="actions-section">
            <div class="container">
                <h2 class="actions-title">Join Our Community</h2>
                
                <div class="action-buttons">
                    @auth
                        <a href="{{ url('/population') }}" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                            </svg>
                            Access Community Directory
                        </a>
                        <a href="{{ url('/population/create') }}" class="btn btn-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            Update Your Profile
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                            Register Account
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                            </svg>
                            Member Login
                        </a>
                    @endauth
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer>
            <div class="container">
                <div class="footer-content">
                    <div class="footer-logo">
                        <span>🏛️</span>
                        <span>Santal Community Directory</span>
                    </div>
                    <div class="footer-text">
                        Official Community Registry & Networking Platform
                    </div>
                    <div class="footer-text">
                        &copy; {{ date('Y') }} Santal Community. All rights reserved.
                    </div>
                </div>
            </div>
        </footer>

        
    </body>
</html>