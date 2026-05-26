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
            <span class="badge mb-4 py-2 px-3 rounded-pill" style="background: rgba(37, 99, 235, 0.12); color: #60a5fa; font-weight: 600; font-size: 13px; letter-spacing: 0.5px; border: 1px solid rgba(37, 99, 235, 0.25);"><i class="bi bi-shield-lock-fill me-2"></i>Security Check</span>
            <h1 class="display-5 fw-bold text-white mb-3" style="letter-spacing: -1px; line-height: 1.15;">
                Verify Your<br>Email Address.
            </h1>
            <p class="fs-6 text-white-50 mb-5" style="max-width: 480px; color: #94a3b8 !important; line-height: 1.6;">
                We take security seriously. Please verify your email address to confirm your administrative credentials and activate your Sirona portal.
            </p>
        </div>

        <!-- Footer section -->
        <div class="auth-left-footer">
            <p class="m-0 text-muted-light small" style="color: #64748b;">&copy; {{ date('Y') }} Sirona. Developed by CortDevs.</p>
        </div>
    </div>

    <!-- Right Panel (Email Verification Form) -->
    <div class="col-lg-6 auth-right-panel">
        <div class="auth-form-container">
            <!-- Mobile Logo -->
            <div class="d-block d-lg-none mb-4 text-center">
                <img height="48px" src="{{ asset('assets/uploads/logo/'.get_settings('dark_logo')) }}" alt="Logo">
            </div>

            <h2 class="auth-title">Verify Email</h2>
            <p class="auth-subtitle">Before proceeding, please check your email for a verification link.</p>

            @if (session('resent'))
                <div class="alert alert-success d-flex align-items-center gap-2 mb-4" role="alert" style="border-radius: 12px; font-size: 14px;">
                    <i class="bi bi-check-circle-fill"></i>
                    <div>{{ get_phrase('A fresh verification link has been sent to your email address.') }}</div>
                </div>
            @endif

            <p class="text-muted mb-4" style="font-size: 14px; line-height: 1.6;">
                {{ get_phrase('If you did not receive the verification email, click the button below to request another.') }}
            </p>

            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="auth-btn-primary mb-3">{{ get_phrase('Request Another Link') }}</button>
            </form>
            
            <a href="{{ route('login') }}" class="auth-btn-secondary w-100">
                <i class="bi bi-arrow-left"></i> {{ get_phrase('Back to Login') }}
            </a>
        </div>
    </div>
</div>
@endsection
