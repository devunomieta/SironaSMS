@extends('layouts.signin_page')

@section('content')
<div class="row g-0 auth-wrapper">
    <!-- Left Panel (Decorative & Branding) -->
    <div class="col-lg-6 d-none d-lg-flex auth-left-panel">
        <div class="auth-glow-1"></div>
        <div class="auth-glow-2"></div>
        
        <!-- Logo / Top Section -->
        <div class="auth-brand">
            <a href="{{ route('landingPage') }}" class="text-decoration-none">
                <img height="48px" src="{{ asset('assets/uploads/logo/'.get_settings('white_logo')) }}" alt="Logo">
            </a>
        </div>

        <!-- Middle Pitch Section -->
        <div class="auth-pitch my-auto">
            <h1 class="display-5 fw-bold text-white mb-3" style="letter-spacing: -1px; line-height: 1.15;">
                Run a Smarter,<br>Modern School.
            </h1>
            <p class="fs-6 text-white-50 mb-5" style="max-width: 480px; color: #94a3b8 !important; line-height: 1.6;">
                Simplify student onboarding, track academics, process billing, and connect parents under one intelligent ecosystem.
            </p>

            <!-- Social Proof Card -->
            <div class="auth-promo-card p-4 rounded-4" style="max-width: 480px;">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="promo-icon-wrap" style="background: rgba(37, 99, 235, 0.15); width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #60a5fa; font-size: 18px;">
                        <i class="bi bi-heart-fill"></i>
                    </div>
                    <h5 class="m-0 text-white" style="font-size: 15px; font-weight: 600;">Trusted Worldwide</h5>
                </div>
                <p class="text-muted-light m-0" style="color: #94a3b8; font-size: 14px; line-height: 1.6;">
                    "Sirona has completely transformed how we manage student records and fees. What used to take days now takes minutes."
                </p>
                <div class="d-flex gap-4 mt-4 pt-3 border-top" style="border-color: rgba(255, 255, 255, 0.08) !important;">
                    <div>
                        <div class="text-white fw-bold fs-6">38+</div>
                        <small style="color: #64748b; font-size: 10px; text-transform: uppercase; letter-spacing: 0.5px;">Institutions</small>
                    </div>
                    <div>
                        <div class="text-white fw-bold fs-6">100%</div>
                        <small style="color: #64748b; font-size: 10px; text-transform: uppercase; letter-spacing: 0.5px;">Paperless</small>
                    </div>
                    <div>
                        <div class="text-white fw-bold fs-6">Real-Time</div>
                        <small style="color: #64748b; font-size: 10px; text-transform: uppercase; letter-spacing: 0.5px;">Dashboards</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer section -->
        <div class="auth-left-footer">
            <p class="m-0 text-muted-light small" style="color: #64748b;">&copy; {{ date('Y') }} Sirona. Developed by CortDevs.</p>
        </div>
    </div>

    <!-- Right Panel (Login Form) -->
    <div class="col-lg-6 auth-right-panel">
        <div class="auth-form-container">
            <!-- Mobile Logo -->
            <div class="d-block d-lg-none mb-4 text-center">
                <img height="48px" src="{{ asset('assets/uploads/logo/'.get_settings('dark_logo')) }}" alt="Logo">
            </div>

            <h2 class="auth-title">Welcome Back</h2>
            <p class="auth-subtitle">Please enter your credentials to access your dashboard.</p>

            <form method="post" action="{{ route('login') }}">
                @csrf
                
                <!-- Email Field -->
                <div class="auth-input-group">
                    <label for="email">{{ get_phrase('Email Address') }}</label>
                    <div class="auth-input-wrapper">
                        <span class="input-icon"><i class="bi bi-envelope"></i></span>
                        <input type="email" name="email" class="auth-field" id="email" 
                               placeholder="name@school.com" required autocomplete="username" autofocus>
                    </div>
                </div>

                <!-- Password Field -->
                <div class="auth-input-group">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <label for="password" class="m-0">{{ get_phrase('Password') }}</label>
                        <a href="{{ route('password.request') }}" class="auth-link" style="font-size: 12px;">{{ get_phrase('Forgot password?') }}</a>
                    </div>
                    <div class="auth-input-wrapper">
                        <span class="input-icon"><i class="bi bi-lock"></i></span>
                        <input type="password" name="password" class="auth-field" id="password" 
                               placeholder="••••••••" required autocomplete="current-password">
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="auth-btn-primary mb-4">{{ get_phrase('Login to Account') }}</button>
            </form>

            <!-- Links & Explore -->
            <div class="text-center pt-3 border-top" style="border-color: #f1f5f9 !important;">
                <p class="text-muted small mb-3">{{ get_phrase('Interested in registering your school?') }}</p>
                <div class="d-flex flex-wrap justify-content-center gap-2">
                    <a href="{{ route('register.page') }}" class="auth-btn-primary py-2 px-4 rounded-pill" style="font-size: 13px; width: auto; display: inline-flex; align-items: center; gap: 8px;">
                        <i class="bi bi-bank"></i> {{ get_phrase('Register School') }}
                    </a>
                    <a href="mailto:{{ get_settings('system_email') }}" class="auth-btn-secondary py-2 px-3 rounded-pill" style="font-size: 13px; width: auto;">
                        <i class="bi bi-envelope-fill text-primary"></i> {{ get_phrase('Contact Admin') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
