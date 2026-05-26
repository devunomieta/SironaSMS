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
            <span class="badge mb-4 py-2 px-3 rounded-pill" style="background: rgba(37, 99, 235, 0.12); color: #60a5fa; font-weight: 600; font-size: 13px; letter-spacing: 0.5px; border: 1px solid rgba(37, 99, 235, 0.25);"><i class="bi bi-key-fill me-2"></i>Account Recovery</span>
            <h1 class="display-5 fw-bold text-white mb-3" style="letter-spacing: -1px; line-height: 1.15;">
                Recover Your<br>Sirona Account.
            </h1>
            <p class="fs-6 text-white-50 mb-5" style="max-width: 480px; color: #94a3b8 !important; line-height: 1.6;">
                Don't worry, it happens to the best of us. Enter your registered email address and we'll send you instructions to safely reset your password.
            </p>
        </div>

        <!-- Footer section -->
        <div class="auth-left-footer">
            <p class="m-0 text-muted-light small" style="color: #64748b;">&copy; {{ date('Y') }} Sirona. Developed by CortDevs.</p>
        </div>
    </div>

    <!-- Right Panel (Password Reset Form) -->
    <div class="col-lg-6 auth-right-panel">
        <div class="auth-form-container">
            <!-- Mobile Logo -->
            <div class="d-block d-lg-none mb-4 text-center">
                <img height="48px" src="{{ asset('assets/uploads/logo/'.get_settings('dark_logo')) }}" alt="Logo">
            </div>

            <h2 class="auth-title">Forgot Password?</h2>
            <p class="auth-subtitle">Enter your email address below to receive a password reset link.</p>

            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                
                <!-- Email Field -->
                <div class="auth-input-group">
                    <label for="email">{{ get_phrase('Email Address') }}</label>
                    <div class="auth-input-wrapper">
                        <span class="input-icon"><i class="bi bi-envelope"></i></span>
                        <input type="email" name="email" class="auth-field @error('email') is-invalid @enderror" id="email" 
                               value="{{ old('email') }}" placeholder="name@school.com" required autocomplete="email" autofocus>
                        
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- Submit and Back Buttons -->
                <button type="submit" class="auth-btn-primary mb-3">{{ get_phrase('Send Reset Link') }}</button>
                <a href="{{ route('login') }}" class="auth-btn-secondary w-100">
                    <i class="bi bi-arrow-left"></i> {{ get_phrase('Back to Login') }}
                </a>
            </form>
        </div>
    </div>
</div>
@endsection
