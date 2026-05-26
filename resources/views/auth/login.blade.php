@extends('layouts.signin_page')

@section('content')

<style type="text/css">

.login-image{
    width: inherit; 
    height: 100%; 
    position: fixed; 
    background-image: url('public/assets/images/login.png'); 
    background-size: cover; 
    background-position: center;
}

</style>

<div class="row h-100">
    <div class="col-lg-6 d-none d-lg-block p-0 h-100">
        <div class="bg-image login-image">
        </div>
    </div>
    <div class="col-lg-6 p-0 h-100 position-relative">
        <div class="parent-elem">
            <div class="middle-elem">
                <div class="primary-form">
                    <div class="form-logo mb-5">
                        <img height="60px" src="{{ asset('assets/uploads/logo/'.get_settings('dark_logo')) }}">
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="login-form">
                                <form method="post" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label for="email" class="form-label">{{ get_phrase('Email') }}</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                                <input type="email" name="email" class="form-control" id="email"
                                                  placeholder="Your email address">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="password" class="form-label">{{ get_phrase('Password') }}</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                                <input type="password" name="password" class="form-control border-end" id="password"
                                                  placeholder="Input your password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="w-100 d-flex justify-content-end">
                                                <a href="{{ route('password.request') }}" class="float-end">{{ get_phrase('Forgot password') }}</a>
                                                <i class="bi bi-record-fill text-5px mx-1 px-1"></i>
                                                <a href="{{ get_settings('help_link') }}" target="_blank" class="float-end me-1">{{ get_phrase('Help') }}</a>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100">{{ get_phrase('Login') }}</button>
                                    </div>
                                </form>
                            </div>

                            <div class="mt-4 pt-3 border-top text-center">
                                <p class="text-muted mb-2 small">{{ get_phrase('Interested in registering your school?') }}</p>
                                <div class="d-flex flex-wrap justify-content-center gap-2">
                                    <a href="mailto:{{ get_settings('system_email') }}" class="btn btn-sm btn-outline-secondary px-3 py-2 rounded-pill shadow-sm d-inline-flex align-items-center" style="font-size: 13px; font-weight: 500;">
                                        <i class="bi bi-envelope-fill me-2 text-primary"></i> {{ get_phrase('Contact Admin') }}
                                    </a>
                                    <a href="{{ route('landingPage') }}" class="btn btn-sm btn-outline-primary px-3 py-2 rounded-pill shadow-sm d-inline-flex align-items-center" style="font-size: 13px; font-weight: 500;">
                                        <i class="bi bi-compass-fill me-2"></i> {{ get_phrase('Explore Features') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
