<!DOCTYPE html>
<html lang="en">

<head>
  <title>{{ get_phrase('Login').' | '.get_settings('system_title') }}</title>
  <!-- all the meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta content="Sirona School Management System" name="description" />
  <meta content="CortDevs" name="author" />
  <!-- all the css files -->
  <link rel="shortcut icon" href="{{ asset('assets/uploads/logo/'.get_settings('favicon')) }}" />
  
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/bootstrap-5.1.3/css/bootstrap.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/bootstrap-icons-1.8.1/bootstrap-icons.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/toastr.min.css') }}"/>

  <style>
    :root {
      --font-family: 'Plus Jakarta Sans', sans-serif;
      --bg-color-1: #0f172a;
      --bg-color-2: #1e293b;
      --primary-color: #2563eb;
      --primary-hover: #1d4ed8;
      --primary-light: #3b82f6;
      --text-muted: #64748b;
      --text-dark: #0f172a;
      --border-color: #e2e8f0;
      --focus-ring: rgba(37, 99, 235, 0.15);
    }

    body {
      font-family: var(--font-family);
      background-color: #f8fafc;
      color: var(--text-dark);
      min-height: 100vh;
      overflow-x: hidden;
    }

    /* Core Auth Split Layout */
    .auth-wrapper {
      min-height: 100vh;
    }

    .auth-left-panel {
      background: linear-gradient(135deg, var(--bg-color-1) 0%, var(--bg-color-2) 100%);
      position: relative;
      overflow: hidden;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      padding: 4rem;
      z-index: 1;
    }

    /* Animated Glow Elements */
    .auth-glow-1 {
      width: 350px;
      height: 350px;
      background: radial-gradient(circle, rgba(37, 99, 235, 0.18) 0%, rgba(37, 99, 235, 0) 70%);
      position: absolute;
      top: -10%;
      left: -10%;
      z-index: -1;
      animation: pulse-glow-1 8s infinite alternate;
    }

    .auth-glow-2 {
      width: 450px;
      height: 450px;
      background: radial-gradient(circle, rgba(14, 165, 233, 0.12) 0%, rgba(14, 165, 233, 0) 70%);
      position: absolute;
      bottom: -10%;
      right: -10%;
      z-index: -1;
      animation: pulse-glow-2 12s infinite alternate;
    }

    /* Grid Overlay background */
    .auth-left-panel::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-image: linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                        linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
      background-size: 32px 32px;
      z-index: -1;
      opacity: 0.8;
    }

    @keyframes pulse-glow-1 {
      0% { transform: scale(1) translate(0, 0); opacity: 0.8; }
      100% { transform: scale(1.15) translate(20px, 10px); opacity: 1; }
    }

    @keyframes pulse-glow-2 {
      0% { transform: scale(1) translate(0, 0); opacity: 0.7; }
      100% { transform: scale(1.1) translate(-20px, -10px); opacity: 0.9; }
    }

    /* Floating Promo Card */
    .auth-promo-card {
      background: rgba(255, 255, 255, 0.03);
      border: 1px solid rgba(255, 255, 255, 0.08);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
      transition: all 0.3s ease;
      animation: float-promo 6s ease-in-out infinite;
    }

    .auth-promo-card:hover {
      border-color: rgba(255, 255, 255, 0.15);
      transform: translateY(-5px);
    }

    @keyframes float-promo {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-10px); }
    }

    /* Form Panel Styles */
    .auth-right-panel {
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #ffffff;
      padding: 3rem 2rem;
    }

    .auth-form-container {
      width: 100%;
      max-width: 440px;
      animation: form-slide-up 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }

    @keyframes form-slide-up {
      0% { opacity: 0; transform: translateY(20px); }
      100% { opacity: 1; transform: translateY(0); }
    }

    /* Form Fields & Controls */
    .auth-input-group {
      position: relative;
      margin-bottom: 1.5rem;
    }

    .auth-input-group label {
      font-size: 13px;
      font-weight: 600;
      color: var(--text-dark);
      margin-bottom: 0.5rem;
      display: block;
    }

    .auth-input-wrapper {
      position: relative;
      display: flex;
      align-items: center;
    }

    .auth-input-wrapper .input-icon {
      position: absolute;
      left: 16px;
      color: var(--text-muted);
      font-size: 16px;
      transition: color 0.2s ease;
    }

    .auth-field {
      width: 100%;
      padding: 12px 16px 12px 48px;
      font-size: 14px;
      font-weight: 500;
      background-color: #f8fafc;
      border: 1px solid var(--border-color);
      border-radius: 12px;
      transition: all 0.2s ease;
      color: var(--text-dark);
    }

    .auth-field::placeholder {
      color: #94a3b8;
    }

    .auth-field:focus {
      background-color: #ffffff;
      border-color: var(--primary-color);
      box-shadow: 0 0 0 4px var(--focus-ring);
      outline: none;
    }

    .auth-field:focus + .input-icon {
      color: var(--primary-color);
    }

    /* Buttons */
    .auth-btn-primary {
      background-color: var(--primary-color);
      color: #ffffff;
      font-weight: 600;
      font-size: 15px;
      padding: 12px 24px;
      border-radius: 12px;
      border: none;
      width: 100%;
      transition: all 0.2s ease;
      box-shadow: 0 4px 12px rgba(37, 99, 235, 0.15);
    }

    .auth-btn-primary:hover {
      background-color: var(--primary-hover);
      transform: translateY(-1px);
      box-shadow: 0 6px 16px rgba(37, 99, 235, 0.25);
    }

    .auth-btn-primary:active {
      transform: translateY(0);
    }

    .auth-btn-secondary {
      background-color: #f1f5f9;
      color: var(--text-dark);
      font-weight: 600;
      font-size: 14px;
      padding: 12px 24px;
      border-radius: 12px;
      border: 1px solid var(--border-color);
      width: 100%;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      transition: all 0.2s ease;
    }

    .auth-btn-secondary:hover {
      background-color: #e2e8f0;
      color: var(--text-dark);
    }

    /* Links & Typography */
    .auth-link {
      color: var(--primary-color);
      font-weight: 600;
      font-size: 13px;
      text-decoration: none;
      transition: color 0.2s ease;
    }

    .auth-link:hover {
      color: var(--primary-hover);
      text-decoration: underline;
    }

    .auth-title {
      font-weight: 800;
      font-size: 28px;
      letter-spacing: -0.5px;
      color: var(--text-dark);
      margin-bottom: 0.5rem;
    }

    .auth-subtitle {
      color: var(--text-muted);
      font-size: 14px;
      margin-bottom: 2rem;
    }

    /* Accessibilty Preferences */
    @media (prefers-reduced-motion: reduce) {
      .auth-glow-1, .auth-glow-2, .auth-promo-card, .auth-form-container, .auth-btn-primary {
        animation: none !important;
        transition: none !important;
        transform: none !important;
      }
    }

    @media (max-width: 991.98px) {
      .auth-right-panel {
        padding: 4rem 1.5rem;
      }
    }
  </style>
</head>

<body>

  <div class="container-fluid p-0">
    @yield('content')
  </div>

  @include('external_plugin')

  <!--Main Jquery-->
  <script src="{{ asset('assets/vendors/jquery/jquery-3.6.0.min.js') }}"></script>
  <!--Bootstrap bundle with popper-->
  <script src="{{ asset('assets/vendors/bootstrap-5.1.3/js/bootstrap.bundle.min.js') }}"></script>
  <!--Toaster Script-->
  <script src="{{ asset('assets/js/toastr.min.js') }}"></script>

  <script>
    "use strict";
    @if(Session::has('message'))
      toastr.options = { "closeButton" : true, "progressBar" : true }
      toastr.success("{{ session('message') }}");
    @endif

    @if(Session::has('error'))
      toastr.options = { "closeButton" : true, "progressBar" : true }
      toastr.error("{{ session('error') }}");
    @endif

    @if(Session::has('info'))
      toastr.options = { "closeButton" : true, "progressBar" : true }
      toastr.info("{{ session('info') }}");
    @endif

    @if(Session::has('warning'))
      toastr.options = { "closeButton" : true, "progressBar" : true }
      toastr.warning("{{ session('warning') }}");
    @endif
  </script>
</body>
</html>
