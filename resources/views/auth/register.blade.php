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
            <span class="badge mb-4 py-2 px-3 rounded-pill" style="background: rgba(37, 99, 235, 0.12); color: #60a5fa; font-weight: 600; font-size: 13px; letter-spacing: 0.5px; border: 1px solid rgba(37, 99, 235, 0.25);"><i class="bi bi-person-plus-fill me-2"></i>User Onboarding</span>
            <h1 class="display-5 fw-bold text-white mb-3" style="letter-spacing: -1px; line-height: 1.15;">
                Start Your Journey<br>With Sirona.
            </h1>
            <p class="fs-6 text-white-50 mb-5" style="max-width: 480px; color: #94a3b8 !important; line-height: 1.6;">
                Create your Sirona administrator account to start configuring your school modules, adding teachers, and managing student databases.
            </p>
        </div>

        <!-- Footer section -->
        <div class="auth-left-footer">
            <p class="m-0 text-muted-light small" style="color: #64748b;">&copy; {{ date('Y') }} Sirona. Developed by CortDevs.</p>
        </div>
    </div>

    <!-- Right Panel (Registration Form) -->
    <div class="col-lg-6 auth-right-panel">
        <div class="auth-form-container">
            <!-- Mobile Logo -->
            <div class="d-block d-lg-none mb-4 text-center">
                <img height="48px" src="{{ asset('assets/uploads/logo/'.get_settings('dark_logo')) }}" alt="Logo">
            </div>

            <h2 class="auth-title">Create Account</h2>
            <p class="auth-subtitle">Register a new administrator account to get started.</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf
                
                <!-- Name Field -->
                <div class="auth-input-group">
                    <label for="name">{{ get_phrase('Full Name') }}</label>
                    <div class="auth-input-wrapper">
                        <span class="input-icon"><i class="bi bi-person"></i></span>
                        <input id="name" type="text" class="auth-field @error('name') is-invalid @enderror" name="name" 
                               value="{{ old('name') }}" placeholder="John Doe" required autocomplete="name" autofocus>
                        
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- Email Field -->
                <div class="auth-input-group">
                    <label for="email">{{ get_phrase('Email Address') }}</label>
                    <div class="auth-input-wrapper">
                        <span class="input-icon"><i class="bi bi-envelope"></i></span>
                        <input id="email" type="email" class="auth-field @error('email') is-invalid @enderror" name="email" 
                               value="{{ old('email') }}" placeholder="name@school.com" required autocomplete="email">
                        
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- Password Field -->
                <div class="auth-input-group">
                    <label for="password">{{ get_phrase('Password') }}</label>
                    <div class="auth-input-wrapper">
                        <span class="input-icon"><i class="bi bi-lock"></i></span>
                        <input id="password" type="password" class="auth-field @error('password') is-invalid @enderror" name="password" 
                               placeholder="••••••••" required autocomplete="new-password">
                        
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- Confirm Password Field -->
                <div class="auth-input-group">
                    <label for="password-confirm">{{ get_phrase('Confirm Password') }}</label>
                    <div class="auth-input-wrapper">
                        <span class="input-icon"><i class="bi bi-lock-check"></i></span>
                        <input id="password-confirm" type="password" class="auth-field" name="password_confirmation" 
                               placeholder="••••••••" required autocomplete="new-password">
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="auth-btn-primary mb-3">{{ get_phrase('Register Account') }}</button>
                <div class="text-center mt-3">
                    <span class="text-muted small">{{ get_phrase('Already have an account?') }}</span>
                    <a href="{{ route('login') }}" class="auth-link ms-1">{{ get_phrase('Login here') }}</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
