@extends('frontend.index')
@section('content')
<div class="scroll-progress" id="scrollProgress"></div>
{{-- @php
 use App\Models\FrontendFeature;
 
 $frontendFeatures = FrontendFeature::take(9)->get();

@endphp --}}
<!--  Header Area Start -->
<header class="header-area">
    <div class="container-xl">
        <div class="row align-items-center">
            <div class="col-lg-2 col-md-6 col-sm-6 col-5">
                <!-- Logo  -->
                <div class="logo">
                    <a href="#"><img src="{{ asset('assets/uploads/logo/'.get_settings('front_logo')) }}"
                        alt="..."></a> 
                </div>
            </div>
            <div class="col-lg-7 col-md-6 menu-items">
                <!-- Menu -->
                <nav class="header-menu">
                    <ul class="primary-menu d-flex justify-content-center">
                        <li class="nav-item"><a class="nav-link" href="#">{{ get_phrase('Home') }}</a></li>
                        <li class="nav-item"><a class="nav-link" href="#feature">{{ get_phrase('Features') }}</a></li>
                        <li class="nav-item"><a class="nav-link" href="#why-us">{{ get_phrase('Why Us') }}</a></li>
                        <li class="nav-item"><a class="nav-link" href="#faq">{{ get_phrase('FAQ') }}</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact">{{ get_phrase('Contact') }}</a></li>
                    </ul>
                </nav>
                <a class="small-device-show" href="#"><img src="{{ asset('frontend/assets/image/logo.png') }}" alt="logo"></a>
                <span class="crose-icon"><i class="fa-solid fa-xmark"></i></span>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-7">
                <!-- Button Area -->
                <div class="header-btn">
                    @php
                    if(isset(auth()->user()->id) && auth()->user()->id != "") {
                        if (auth()->user()->role_id =='1') {
                            $panel = 'Superadmin';
                            $dashboard = route('superadmin.dashboard');
                            $user_profile = route('superadmin.profile');
                        } elseif(auth()->user()->role_id =='2'){
                            $panel = 'Administrator';
                            $dashboard = route('admin.dashboard');
                            $user_profile = route('admin.profile');
                        } elseif(auth()->user()->role_id =='3'){
                            $panel = 'Teacher';
                            $dashboard = route('teacher.dashboard');
                            $user_profile = route('teacher.profile');
                        } elseif(auth()->user()->role_id =='4'){
                            $panel = 'Accountant';
                            $dashboard = route('accountant.dashboard');
                            $user_profile = route('accountant.profile');
                        } elseif(auth()->user()->role_id =='5'){
                            $panel = 'Librarian';
                            $dashboard = route('librarian.dashboard');
                            $user_profile = route('librarian.profile');
                        } elseif(auth()->user()->role_id =='6'){
                            $panel = 'Parent';
                            $dashboard = route('parent.dashboard');
                            $user_profile = route('parent.profile');
                        } elseif(auth()->user()->role_id =='7'){
                            $panel = 'Student';
                            $dashboard = route('student.dashboard');
                            $user_profile = route('student.profile');
                        } elseif (auth()->user()->role_id == '8') {
                            $panel = 'Driver';
                            $dashboard = route('driver.dashboard');
                            $user_profile = route('driver.profile');
                        } elseif(auth()->user()->role_id =='9'){
                            $panel = 'Alumni';
                            $dashboard = route('alumni.dashboard');
                            $user_profile = route('alumni.profile');
                        }
                    }
                    @endphp
                    @if(isset(auth()->user()->id) && auth()->user()->id != "")
                        <a class="login-btn" href="{{ $dashboard }}">{{ get_phrase($panel) }}</a>
                        <!-- User Profile Start -->
                        <div class="user-profile">
                            <button class="us-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                             <img src="{{ get_user_image(auth()->user()->id) }}" alt="user-img">
                           </button>
                           <ul class="dropdown-menu dropmenu-end">
                               <li><a class="dropdown-item" href="{{ $user_profile }}"><i class="fa-solid fa-user"></i> {{ get_phrase('Profile') }}</a></li>
                               <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa-solid fa-arrow-right-from-bracket"></i>  {{ get_phrase('Log out') }}</a>
                                   <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                           </ul>
                         </div>
                        <!-- User Profile End -->
                    @else
                        <a class="login-btn" href="{{ route('login') }}">{{ get_phrase('Login') }}</a>
                        <a class="signUp-btn" href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop">{{ get_phrase('Get Started') }}</a>
                    @endif
                    <span class="hambargar-bar"><i class="fa-solid fa-bars"></i></span>
                </div>
            </div>
        </div>
    </div>
</header> 
<!--  Header Area End   -->
 <!-- Register Form Modal Start -->
    <div class="register-form-modal">
        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content custom-reg-modal">
                    <div class="modal-header custom-reg-header">
                        <h1 class="modal-title" id="staticBackdropLabel"><i class="bi bi-mortarboard-fill me-2"></i>{{ get_phrase('Register Your Institution') }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body custom-reg-body">
                        <!-- Stepper Indicator -->
                        <div class="modal-stepper">
                            <div class="step-indicator active" id="indicator-1">
                                <span class="step-number">1</span>
                                <span class="step-label">{{ get_phrase('School Info') }}</span>
                            </div>
                            <div class="step-line">
                                <div class="step-line-fill" id="stepLineFill"></div>
                            </div>
                            <div class="step-indicator" id="indicator-2">
                                <span class="step-number">2</span>
                                <span class="step-label">{{ get_phrase('Admin Account') }}</span>
                            </div>
                        </div>

                        <form method="POST" id="schoolReg" enctype="multipart/form-data" class="d-block ajaxForm" action="{{ route('school.create') }}">
                            @csrf
                            
                            <!-- STEP 1 PANEL -->
                            <div class="modal-form-step active" id="step-1-panel">
                                <h4 class="step-section-title">{{ get_phrase('SCHOOL DETAILS') }}</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="custom-form-group">
                                            <label for="school_name">{{ get_phrase('School Name') }}</label>
                                            <div class="custom-input-wrapper">
                                                <span class="input-icon"><i class="bi bi-building"></i></span>
                                                <input id="school_name" name="school_name" type="text" class="form-control" placeholder="e.g. Oakridge Academy" required>
                                            </div>
                                            <div class="invalid-feedback">{{ get_phrase('Please enter the school name.') }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="custom-form-group">
                                            <label for="school_email">{{ get_phrase('School Email') }}</label>
                                            <div class="custom-input-wrapper">
                                                <span class="input-icon"><i class="bi bi-envelope"></i></span>
                                                <input id="school_email" name="school_email" type="email" class="form-control" placeholder="info@oakridge.edu" required>
                                            </div>
                                            <div class="invalid-feedback">{{ get_phrase('Please enter a valid school email address.') }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="custom-form-group">
                                            <label for="school_phone">{{ get_phrase('School Phone') }}</label>
                                            <div class="custom-input-wrapper">
                                                <span class="input-icon"><i class="bi bi-telephone"></i></span>
                                                <input id="school_phone" name="school_phone" type="tel" class="form-control" placeholder="+1 (555) 000-0000" required>
                                            </div>
                                            <div class="invalid-feedback">{{ get_phrase('Please enter the school phone number.') }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="custom-form-group">
                                            <label for="school_address">{{ get_phrase('School Address') }}</label>
                                            <div class="custom-input-wrapper">
                                                <span class="input-icon"><i class="bi bi-geo-alt"></i></span>
                                                <input id="school_address" name="school_address" type="text" class="form-control" placeholder="123 Education Way, NY" required>
                                            </div>
                                            <div class="invalid-feedback">{{ get_phrase('Please enter the school physical address.') }}</div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="custom-form-group">
                                            <label for="school_info">{{ get_phrase('School Description') }}</label>
                                            <div class="custom-input-wrapper">
                                                <span class="input-icon"><i class="bi bi-info-circle"></i></span>
                                                <textarea name="school_info" id="school_info" class="form-control" placeholder="Describe your school's vision, curriculum, and structure..." required></textarea>
                                            </div>
                                            <div class="invalid-feedback">{{ get_phrase('Please provide a short description of the school.') }}</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="wizard-footer">
                                    <button type="button" class="btn-wizard-prev" style="visibility: hidden;">Back</button>
                                    <button type="button" class="btn-wizard-next" id="btnNextStep">
                                        {{ get_phrase('Next: Admin Account') }} <i class="bi bi-arrow-right ms-1"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- STEP 2 PANEL -->
                            <div class="modal-form-step" id="step-2-panel">
                                <h4 class="step-section-title">{{ get_phrase('ADMINISTRATOR ACCOUNT') }}</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="custom-form-group">
                                            <label for="admin_name">{{ get_phrase('Admin Name') }}</label>
                                            <div class="custom-input-wrapper">
                                                <span class="input-icon"><i class="bi bi-person"></i></span>
                                                <input id="admin_name" name="admin_name" type="text" class="form-control" placeholder="John Doe" required>
                                            </div>
                                            <div class="invalid-feedback">{{ get_phrase('Please enter the administrator name.') }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="custom-form-group">
                                            <label for="admin_email">{{ get_phrase('Admin Email') }}</label>
                                            <div class="custom-input-wrapper">
                                                <span class="input-icon"><i class="bi bi-envelope-check"></i></span>
                                                <input id="admin_email" name="admin_email" type="email" class="form-control" placeholder="admin@oakridge.edu" required>
                                            </div>
                                            <div class="invalid-feedback">{{ get_phrase('Please enter a valid administrator email.') }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="custom-form-group">
                                            <label for="admin_password">{{ get_phrase('Admin Password') }}</label>
                                            <div class="custom-input-wrapper">
                                                <span class="input-icon"><i class="bi bi-lock-fill"></i></span>
                                                <input id="admin_password" name="admin_password" type="password" class="form-control" placeholder="••••••••" required>
                                            </div>
                                            <div class="invalid-feedback">{{ get_phrase('Password must be at least 8 characters long.') }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="custom-form-group">
                                            <label for="admin_phone">{{ get_phrase('Admin Phone Number') }}</label>
                                            <div class="custom-input-wrapper">
                                                <span class="input-icon"><i class="bi bi-phone"></i></span>
                                                <input id="admin_phone" name="admin_phone" type="tel" class="form-control" placeholder="+1 (555) 000-0001" required>
                                            </div>
                                            <div class="invalid-feedback">{{ get_phrase('Please enter the administrator phone number.') }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="custom-form-group">
                                            <label for="gender">{{ get_phrase('Gender') }}</label>
                                            <div class="custom-input-wrapper">
                                                <span class="input-icon"><i class="bi bi-gender-ambiguous"></i></span>
                                                <select class="form-select" id="gender" name="gender" required>
                                                    <option value="">{{ get_phrase('Select gender') }}</option>
                                                    <option value="Male">{{ get_phrase('Male') }}</option>
                                                    <option value="Female">{{ get_phrase('Female') }}</option>
                                                </select>
                                            </div>
                                            <div class="invalid-feedback">{{ get_phrase('Please select the administrator gender.') }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="custom-form-group">
                                            <label for="blood_group">{{ get_phrase('Blood group') }}</label>
                                            <div class="custom-input-wrapper">
                                                <span class="input-icon"><i class="bi bi-droplet-fill text-danger"></i></span>
                                                <select class="form-select" id="blood_group" name="blood_group" required>
                                                    <option value="">{{ get_phrase('Select blood group') }}</option>
                                                    <option value="a+">{{ get_phrase('A+') }}</option>
                                                    <option value="a-">{{ get_phrase('A-') }}</option>
                                                    <option value="b+">{{ get_phrase('B+') }}</option>
                                                    <option value="b-">{{ get_phrase('B-') }}</option>
                                                    <option value="ab+">{{ get_phrase('AB+') }}</option>
                                                    <option value="ab-">{{ get_phrase('AB-') }}</option>
                                                    <option value="o+">{{ get_phrase('O+') }}</option>
                                                    <option value="o-">{{ get_phrase('O-') }}</option>
                                                </select>
                                            </div>
                                            <div class="invalid-feedback">{{ get_phrase('Please select blood group.') }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="custom-form-group">
                                            <label for="admin_address">{{ get_phrase('Admin Address') }}</label>
                                            <div class="custom-input-wrapper">
                                                <span class="input-icon"><i class="bi bi-geo-fill"></i></span>
                                                <input id="admin_address" name="admin_address" type="text" class="form-control" placeholder="Apartment, Street, City" required>
                                            </div>
                                            <div class="invalid-feedback">{{ get_phrase('Please enter the administrator home address.') }}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="custom-form-group">
                                            <label for="photo">{{ get_phrase('Photo') }}</label>
                                            <div class="custom-input-wrapper">
                                                <span class="input-icon"><i class="bi bi-image"></i></span>
                                                <input class="form-control" type="file" accept="image/*" id="photo" name="photo">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="wizard-footer">
                                    <button type="button" class="btn-wizard-prev" id="btnPrevStep">
                                        <i class="bi bi-arrow-left me-1"></i> {{ get_phrase('Back') }}
                                    </button>
                                    @if (get_settings('recaptcha_switch_value') == 'Yes')
                                        <button class="g-recaptcha btn-wizard-submit" 
                                        data-sitekey="{{ get_settings('recaptcha_site_key') }}" 
                                        data-callback='onSubmit' 
                                        data-action='submit' type="submit" id="btnSubmitWizard">
                                            {{ get_phrase('Register School') }} <i class="bi bi-check-lg ms-1"></i>
                                        </button>
                                    @else
                                        <button class="btn-wizard-submit" type="submit" id="btnSubmitWizard">
                                            {{ get_phrase('Register School') }} <i class="bi bi-check-lg ms-1"></i>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Register Form Modal End -->

    <!-- Schedule Demo Modal Start -->
    <div class="modal fade" id="demoScheduleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="demoScheduleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content custom-reg-modal">
                <div class="modal-header custom-reg-header">
                    <h1 class="modal-title" id="demoScheduleModalLabel"><i class="bi bi-calendar-event-fill me-2"></i>{{ get_phrase('Schedule a Free Demo') }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body custom-reg-body">
                    <p class="text-center text-muted mb-4" style="font-size:14px;">Fill out the form below and one of our education experts will reach out to schedule a live video demo tailored to your school's needs.</p>
                    
                    <form id="demoScheduleForm" onsubmit="handleDemoScheduleSubmit(event)">
                        <div class="custom-form-group mb-3">
                            <label for="demo_name">{{ get_phrase('Your Name') }}</label>
                            <div class="custom-input-wrapper">
                                <span class="input-icon"><i class="bi bi-person"></i></span>
                                <input id="demo_name" type="text" class="form-control" placeholder="e.g. Dr. Sarah Jenkins" required>
                            </div>
                        </div>
                        
                        <div class="custom-form-group mb-3">
                            <label for="demo_email">{{ get_phrase('Work Email') }}</label>
                            <div class="custom-input-wrapper">
                                <span class="input-icon"><i class="bi bi-envelope"></i></span>
                                <input id="demo_email" type="email" class="form-control" placeholder="s.jenkins@yourschool.edu" required>
                            </div>
                        </div>
                        
                        <div class="custom-form-group mb-3">
                            <label for="demo_phone">{{ get_phrase('Phone Number') }}</label>
                            <div class="custom-input-wrapper">
                                <span class="input-icon"><i class="bi bi-phone"></i></span>
                                <input id="demo_phone" type="tel" class="form-control" placeholder="e.g. +234 803 123 4567" required>
                            </div>
                        </div>
                        
                        <div class="custom-form-group mb-3">
                            <label for="demo_school">{{ get_phrase('School / Institution Name') }}</label>
                            <div class="custom-input-wrapper">
                                <span class="input-icon"><i class="bi bi-building"></i></span>
                                <input id="demo_school" type="text" class="form-control" placeholder="e.g. Landmark International School" required>
                            </div>
                        </div>
                        
                        <div class="custom-form-group mb-4">
                            <label for="demo_datetime">{{ get_phrase('Preferred Date & Time') }}</label>
                            <div class="custom-input-wrapper">
                                <span class="input-icon"><i class="bi bi-clock"></i></span>
                                <input id="demo_datetime" type="datetime-local" class="form-control" required>
                            </div>
                        </div>
                        
                        <div class="wizard-footer justify-content-end">
                            <button type="button" class="btn-wizard-prev me-2" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn-wizard-submit">
                                {{ get_phrase('Schedule Demo Call') }} <i class="bi bi-check-lg ms-1"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Schedule Demo Modal End -->
<!--  Bannar Area Start  -->
<section class="bannar-area">
    <div class="hero-shape hero-shape-1"></div>
    <div class="hero-shape hero-shape-2"></div>
    <div class="hero-shape hero-shape-3"></div>
    <div class="hero-bg-glow-radial"></div>
    <div class="container-xl">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <!-- Bannar Content -->
                <div class="bannar-content">
                    <span class="hero-subtitle-pill">{{ get_settings('system_title') }}</span>
                    <h2>{{ get_settings('banner_title') }}</h2>
                    <p class="hero-description">{{ get_settings('banner_subtitle') }}</p>
                    
                    <div class="hero-cta-buttons mt-4 d-flex justify-content-center align-items-center gap-3">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="hero-btn-primary">{{ get_phrase('Get Started') }} <i class="fa-solid fa-arrow-right ms-2"></i></a>
                        <a href="#feature" class="hero-btn-secondary">{{ get_phrase('Explore Features') }}</a>
                    </div>
                </div>

                <!-- Hero Dashboard Preview Mockup -->
                <div class="hero-dashboard-preview mt-5 fade-in-up">
                    <div class="preview-browser-header">
                        <div class="browser-dots">
                            <span class="dot dot-red"></span>
                            <span class="dot dot-yellow"></span>
                            <span class="dot dot-green"></span>
                        </div>
                        <div class="browser-address-bar">
                            <i class="bi bi-shield-fill-check text-success me-1"></i> sirona.cortdevs.com/admin/dashboard
                        </div>
                    </div>
                    <div class="preview-dashboard-body">
                        <!-- Left Sidebar mockup -->
                        <div class="mock-sidebar">
                            <div class="mock-logo">Sirona</div>
                            <div class="mock-menu-item active"><i class="bi bi-grid-1x2-fill"></i> Dashboard</div>
                            <div class="mock-menu-item"><i class="bi bi-people-fill"></i> Students</div>
                            <div class="mock-menu-item"><i class="bi bi-person-badge-fill"></i> Teachers</div>
                            <div class="mock-menu-item"><i class="bi bi-card-checklist"></i> Attendance</div>
                            <div class="mock-menu-item"><i class="bi bi-cash-stack"></i> Accounting</div>
                        </div>
                        <!-- Main Content mockup -->
                        <div class="mock-main">
                            <div class="mock-top-stats">
                                <div class="mock-stat-card">
                                    <div class="card-icon"><i class="bi bi-mortarboard-fill text-primary"></i></div>
                                    <div class="card-info">
                                        <span class="label">Total Students</span>
                                        <span class="num">1,248</span>
                                    </div>
                                </div>
                                <div class="mock-stat-card">
                                    <div class="card-icon"><i class="bi bi-person-workspace text-success"></i></div>
                                    <div class="card-info">
                                        <span class="label">Total Teachers</span>
                                        <span class="num">86</span>
                                    </div>
                                </div>
                                <div class="mock-stat-card">
                                    <div class="card-icon"><i class="bi bi-wallet2 text-warning"></i></div>
                                    <div class="card-info">
                                        <span class="label">Fees Collected</span>
                                        <span class="num">$14,250</span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Graph and Recent Alerts mockup -->
                            <div class="mock-grid mt-3">
                                <div class="mock-chart-container">
                                    <h5 class="mock-title">Attendance Overview</h5>
                                    <div class="mock-bar-chart">
                                        <div class="bar-col"><div class="bar" style="height: 70%"></div><span>Mon</span></div>
                                        <div class="bar-col"><div class="bar" style="height: 85%"></div><span>Tue</span></div>
                                        <div class="bar-col"><div class="bar" style="height: 90%"></div><span>Wed</span></div>
                                        <div class="bar-col"><div class="bar" style="height: 95%"></div><span>Thu</span></div>
                                        <div class="bar-col"><div class="bar" style="height: 80%"></div><span>Fri</span></div>
                                    </div>
                                </div>
                                <div class="mock-alerts-container">
                                    <h5 class="mock-title">Live Activities</h5>
                                    <div class="mock-alert-item">
                                        <div class="alert-badge success">Fee Paid</div>
                                        <span class="text">Grade 10 tuition payment received.</span>
                                    </div>
                                    <div class="mock-alert-item">
                                        <div class="alert-badge info">Attendance</div>
                                        <span class="text">Morning roll-call report compiled.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!--  Bannar Area End   -->

<!-- Infinite Logo Ticker Start -->
<div class="logo-ticker-section">
    <div class="container-xl">
        <p class="ticker-title">Powering smart campuses across the region</p>
        <div class="ticker-wrap">
            <div class="ticker">
                <div class="ticker-item"><i class="bi bi-gem me-2 text-primary"></i>Oakridge International</div>
                <div class="ticker-item"><i class="bi bi-award-fill me-2 text-warning"></i>Greenfield Academy</div>
                <div class="ticker-item"><i class="bi bi-lightning-charge-fill me-2 text-info"></i>Sunlight Prep</div>
                <div class="ticker-item"><i class="bi bi-shield-fill-check me-2 text-success"></i>Pinecrest High</div>
                <div class="ticker-item"><i class="bi bi-mortarboard-fill me-2 text-danger"></i>Beacon College</div>
                <div class="ticker-item"><i class="bi bi-star-fill me-2 text-warning"></i>St. Jude Academy</div>
                
                <!-- Repeat for infinite loop -->
                <div class="ticker-item"><i class="bi bi-gem me-2 text-primary"></i>Oakridge International</div>
                <div class="ticker-item"><i class="bi bi-award-fill me-2 text-warning"></i>Greenfield Academy</div>
                <div class="ticker-item"><i class="bi bi-lightning-charge-fill me-2 text-info"></i>Sunlight Prep</div>
                <div class="ticker-item"><i class="bi bi-shield-fill-check me-2 text-success"></i>Pinecrest High</div>
                <div class="ticker-item"><i class="bi bi-mortarboard-fill me-2 text-danger"></i>Beacon College</div>
                <div class="ticker-item"><i class="bi bi-star-fill me-2 text-warning"></i>St. Jude Academy</div>
            </div>
        </div>
    </div>
</div>
<!-- Infinite Logo Ticker End -->

<!--  Service Area Start  -->
<section class="service-area section-padding" id="feature">
    <div class="container">
        <!-- Title  -->
        <div class="title-area">
            <h1>{{ get_phrase('Our Features') }}</h1>
            <h3>{{ get_settings('features_title')  }}</h3>
            <p>{{ get_settings('features_subtitle') }}</p>
        </div>
      
        <!-- Role Tabs Switcher -->
        <div class="role-tabs-wrapper mt-5">
            <div class="role-tabs-container">
                <button class="role-tab active" data-target="admin-features">
                    <i class="bi bi-shield-lock-fill me-2"></i>Administrators
                </button>
                <button class="role-tab" data-target="teacher-features">
                    <i class="bi bi-person-workspace me-2"></i>Teachers
                </button>
                <button class="role-tab" data-target="parent-features">
                    <i class="bi bi-people-fill me-2"></i>Parents
                </button>
                <button class="role-tab" data-target="student-features">
                    <i class="bi bi-mortarboard-fill me-2"></i>Students
                </button>
            </div>
        </div>

        @php
            $adminFeatures = [];
            $teacherFeatures = [];
            $parentFeatures = [];
            $studentFeatures = [];

            foreach ($frontendFeatures as $feature) {
                $title = strtolower($feature->title);
                $desc = strtolower($feature->description);
                
                if (str_contains($title, 'parent') || str_contains($desc, 'parent') || str_contains($title, 'child')) {
                    $parentFeatures[] = $feature;
                } elseif (str_contains($title, 'teacher') || str_contains($desc, 'teacher') || str_contains($title, 'exam') || str_contains($title, 'grade') || str_contains($title, 'mark') || str_contains($title, 'class') || str_contains($title, 'syllabus') || str_contains($title, 'routine')) {
                    $teacherFeatures[] = $feature;
                } elseif (str_contains($title, 'student') || str_contains($desc, 'student') || str_contains($title, 'book') || str_contains($title, 'library') || str_contains($title, 'alumni')) {
                    $studentFeatures[] = $feature;
                } else {
                    $adminFeatures[] = $feature;
                }
            }

            // Fallback safety if categories are completely empty
            if (empty($parentFeatures)) $parentFeatures = $frontendFeatures->slice(0, min(3, count($frontendFeatures)));
            if (empty($teacherFeatures)) $teacherFeatures = $frontendFeatures->slice(min(3, count($frontendFeatures)), min(3, count($frontendFeatures)));
            if (empty($studentFeatures)) $studentFeatures = $frontendFeatures->slice(min(6, count($frontendFeatures)), min(3, count($frontendFeatures)));
            if (empty($adminFeatures)) $adminFeatures = $frontendFeatures;
        @endphp

        <!-- Tab Contents -->
        <div class="tab-content-wrapper mt-4">
            <!-- Admin panel -->
            <div class="role-tab-panel active" id="admin-features">
                <div class="row">
                    @foreach ($adminFeatures as $f)
                    <div class="col-lg-4 col-md-6 mb-4 fade-in-up">
                        <div class="service-items">
                            <div class="service-icon"><i class="{{ $f->icon }}"></i></div>
                            <div class="service-text">
                                <h3>{{ $f->title }}</h3>
                                <p>{{ $f->description }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Teacher panel -->
            <div class="role-tab-panel" id="teacher-features">
                <div class="row">
                    @foreach ($teacherFeatures as $f)
                    <div class="col-lg-4 col-md-6 mb-4 fade-in-up">
                        <div class="service-items">
                            <div class="service-icon"><i class="{{ $f->icon }}"></i></div>
                            <div class="service-text">
                                <h3>{{ $f->title }}</h3>
                                <p>{{ $f->description }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Parent panel -->
            <div class="role-tab-panel" id="parent-features">
                <div class="row">
                    @foreach ($parentFeatures as $f)
                    <div class="col-lg-4 col-md-6 mb-4 fade-in-up">
                        <div class="service-items">
                            <div class="service-icon"><i class="{{ $f->icon }}"></i></div>
                            <div class="service-text">
                                <h3>{{ $f->title }}</h3>
                                <p>{{ $f->description }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Student panel -->
            <div class="role-tab-panel" id="student-features">
                <div class="row">
                    @foreach ($studentFeatures as $f)
                    <div class="col-lg-4 col-md-6 mb-4 fade-in-up">
                        <div class="service-items">
                            <div class="service-icon"><i class="{{ $f->icon }}"></i></div>
                            <div class="service-text">
                                <h3>{{ $f->title }}</h3>
                                <p>{{ $f->description }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!--  Feature Area End   -->

<!-- ===== MID CTA BANNER ===== -->
<section class="mid-cta-banner">
    <div class="mid-cta-dot mid-cta-dot-1"></div>
    <div class="mid-cta-dot mid-cta-dot-2"></div>
    <div class="container">
        <div class="mid-cta-inner">
            <span class="mid-cta-eyebrow"><i class="fa-solid fa-bolt me-2"></i>Trusted by Schools Worldwide</span>
            <h2>Ready to Transform the Way<br class="d-none d-md-block"> Your School Operates?</h2>
            <p>Join hundreds of institutions already running smarter, faster, and paperless<br class="d-none d-lg-block"> with Sirona School Management System.</p>
            <div class="mid-cta-actions">
                <a href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="mid-cta-btn-primary">Get Started Free <i class="fa-solid fa-arrow-right ms-2"></i></a>
                <a href="mailto:{{ get_settings('contact_email') }}" class="mid-cta-btn-secondary"><i class="fa-solid fa-envelope me-2"></i>Talk to Us</a>
            </div>
            <p class="mid-cta-trust"><i class="fa-solid fa-circle-check me-1"></i>No credit card required &nbsp;&middot;&nbsp; <i class="fa-solid fa-circle-check me-1"></i>Quick setup &nbsp;&middot;&nbsp; <i class="fa-solid fa-circle-check me-1"></i>Dedicated support</p>
        </div>
    </div>
</section>
<!-- ===== MID CTA BANNER END ===== -->

<!-- ===== WHY CHOOSE US ===== -->
<section class="why-us-area section-padding" id="why-us">
    <div class="container">
        <div class="title-area">
            <h1>Why Us</h1>
            <h3>Built for Modern Schools</h3>
            <p>Sirona isn't just software — it's an operating system for your entire institution, engineered for reliability, speed, and simplicity.</p>
        </div>
        <div class="row g-4 mt-4">
            <div class="col-lg-4 col-md-6">
                <div class="why-us-card">
                    <div class="why-us-icon"><i class="fa-solid fa-shield-halved"></i></div>
                    <h4>Enterprise-Grade Security</h4>
                    <p>Role-based access control ensures every user — from superadmin to student — only sees what they need. Your data is always protected.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="why-us-card">
                    <div class="why-us-icon"><i class="fa-solid fa-cloud"></i></div>
                    <h4>Cloud-Ready & Scalable</h4>
                    <p>Deploy on any server or cloud infrastructure. Sirona scales effortlessly from a single campus to a multi-branch school network.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="why-us-card">
                    <div class="why-us-icon"><i class="fa-solid fa-mobile-screen-button"></i></div>
                    <h4>Fully Responsive Dashboards</h4>
                    <p>Administrators, teachers, parents, and students all get optimized, mobile-first dashboards that work beautifully on any screen size.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="why-us-card">
                    <div class="why-us-icon"><i class="fa-solid fa-chart-line"></i></div>
                    <h4>Powerful Reporting Engine</h4>
                    <p>Generate attendance reports, academic progress summaries, fee ledgers, and library records in seconds — not hours.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="why-us-card">
                    <div class="why-us-icon"><i class="fa-solid fa-users-gear"></i></div>
                    <h4>Multi-Role Management</h4>
                    <p>From superadmin to alumni — each stakeholder gets a dedicated, purpose-built portal tailored to their specific workflows.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="why-us-card">
                    <div class="why-us-icon"><i class="fa-solid fa-headset"></i></div>
                    <h4>Dedicated Onboarding Support</h4>
                    <p>Getting started is easy. Our setup process and documentation walks your team through configuration at every step of the way.</p>
                </div>
            </div>
        </div>
        <!-- CTA inside section -->
        <div class="text-center mt-5 pt-3">
            <p class="why-us-sub-cta-text">Still unsure? Let our system do the talking.</p>
            <a href="#" data-bs-toggle="modal" data-bs-target="#demoScheduleModal" class="hero-btn-primary">Schedule a Free Demo Call <i class="fa-solid fa-arrow-right ms-2"></i></a>
        </div>
    </div>
</section>
<!-- ===== WHY CHOOSE US END ===== -->

<!-- ===== INTERACTIVE DEMO & ROI CALCULATOR ===== -->
<section class="sandbox-roi-section section-padding" id="sandbox-roi">
    <div class="container">
        <div class="row g-5">
            <!-- Sandbox Demo Column -->
            <div class="col-lg-6">
                <div class="sandbox-card">
                    <span class="sandbox-badge"><i class="bi bi-calendar-event"></i> Schedule a Demo</span>
                    <h3 class="section-subtitle">Experience Sirona Live</h3>
                    <p class="section-desc">Get a personalized, guided walk-through of the Sirona platform. Choose a portal role below to schedule a live video demonstration tailored to your school.</p>
                    
                    <div class="demo-roles-grid mt-4">
                        <!-- School Admin Demo -->
                        <div class="demo-role-card" data-bs-toggle="modal" data-bs-target="#demoScheduleModal">
                            <div class="demo-role-icon admin"><i class="bi bi-shield-lock-fill"></i></div>
                            <div class="demo-role-details">
                                <h4>School Admin Portal Demo</h4>
                                <p>Learn how to manage classes, verify fee payments, control roles, and review registrations.</p>
                            </div>
                            <span class="demo-role-btn"><i class="bi bi-arrow-right-short"></i></span>
                        </div>
                        
                        <!-- Teacher Demo -->
                        <div class="demo-role-card" data-bs-toggle="modal" data-bs-target="#demoScheduleModal">
                            <div class="demo-role-icon teacher"><i class="bi bi-person-workspace"></i></div>
                            <div class="demo-role-details">
                                <h4>Academic & Teacher Portal Demo</h4>
                                <p>Discover how teachers mark attendance, manage grading sheets, and assign homework online.</p>
                            </div>
                            <span class="demo-role-btn"><i class="bi bi-arrow-right-short"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- ROI Calculator Column -->
            <div class="col-lg-6">
                <div class="roi-card">
                    <span class="roi-badge"><i class="bi bi-calculator"></i> Savings Calculator</span>
                    <h3 class="section-subtitle">Calculate Your School's Savings</h3>
                    <p class="section-desc">See how much time Sirona reclaims for your administrative staff and teachers by automating paper-based and manual tracking tasks.</p>
                    
                    <div class="calculator-inputs mt-4">
                        <!-- Student count slider -->
                        <div class="slider-group mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label for="calcStudents">Number of Enrolled Students</label>
                                <span class="slider-value" id="valStudents">450</span>
                            </div>
                            <input type="range" class="form-range" id="calcStudents" min="50" max="2500" step="50" value="450">
                        </div>
                        
                        <!-- Hours spent slider -->
                        <div class="slider-group mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label for="calcHours">Manual Admin Hours / Week (Per Staff)</label>
                                <span class="slider-value" id="valHours">15</span>
                            </div>
                            <input type="range" class="form-range" id="calcHours" min="5" max="40" step="1" value="15">
                        </div>
                    </div>
                    
                    <!-- ROI Results grid -->
                    <div class="roi-results-grid mt-4">
                        <div class="roi-result-card">
                            <span class="roi-result-num text-primary" id="resHours">112.5</span>
                            <span class="roi-result-lbl">Hours Saved / Month</span>
                        </div>
                        <div class="roi-result-card">
                            <span class="roi-result-num text-success" id="resSavings">₦1,688</span>
                            <span class="roi-result-lbl">Estimated Monthly Savings</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ===== INTERACTIVE DEMO & ROI CALCULATOR END ===== -->

<!-- ===== STATS COUNTER ===== -->
<section class="stats-area">
    <div class="container">
        <div class="stats-inner">
            <div class="stat-item fade-in-up">
                <div class="stat-number" data-target="38">0</div>
                <div class="stat-label">Schools Onboarded</div>
            </div>
            <div class="stat-divider"></div>
            <div class="stat-item fade-in-up" style="animation-delay:0.1s">
                <div class="stat-number" data-target="12">0</div>
                <div class="stat-label">Core Modules</div>
            </div>
            <div class="stat-divider"></div>
            <div class="stat-item fade-in-up" style="animation-delay:0.2s">
                <div class="stat-number" data-target="9">0</div>
                <div class="stat-label">User Role Types</div>
            </div>
            <div class="stat-divider"></div>
            <div class="stat-item fade-in-up" style="animation-delay:0.3s">
                <div class="stat-number" data-target="99">0</div>
                <div class="stat-label">% Uptime Reliability</div>
            </div>
        </div>
    </div>
</section>
<!-- ===== STATS COUNTER END ===== -->

<!-- ===== TESTIMONIALS ===== -->
<section class="testimonials-area section-padding" id="testimonials">
    <div class="container">
        <div class="title-area">
            <h1>Reviews</h1>
            <h3>What Schools Say About Us</h3>
            <p>Trusted by administrators, loved by teachers, and appreciated by parents across the globe.</p>
        </div>
        <div class="row g-4 mt-4">
            <div class="col-lg-4 col-md-6">
                <div class="testimonial-card">
                    <div class="testimonial-stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
                    <p class="testimonial-quote">"Sirona completely transformed how we manage student records and fees. What used to take days now takes minutes. Absolutely essential for any modern school."</p>
                    <div class="testimonial-author">
                        <div class="testimonial-avatar"><i class="fa-solid fa-user-tie"></i></div>
                        <div>
                            <strong>Mr. Emmanuel Adeyemi</strong>
                            <span>Principal, Sunlight International School</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="testimonial-card">
                    <div class="testimonial-stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
                    <p class="testimonial-quote">"The parent portal is a game-changer. I can check my child's attendance, grades, and fee status all in one place. I wish every school used this!"</p>
                    <div class="testimonial-author">
                        <div class="testimonial-avatar"><i class="fa-solid fa-user"></i></div>
                        <div>
                            <strong>Mrs. Fatima Hassan</strong>
                            <span>Parent, Greenfield Academy</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="testimonial-card">
                    <div class="testimonial-stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star-half-stroke"></i></div>
                    <p class="testimonial-quote">"Our accounting team saved countless hours on fee invoicing and payment tracking. The reports are clean, accurate, and ready for auditors at any time."</p>
                    <div class="testimonial-author">
                        <div class="testimonial-avatar"><i class="fa-solid fa-user-tie"></i></div>
                        <div>
                            <strong>Mr. Daniel Okonkwo</strong>
                            <span>Finance Director, Apex College</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ===== TESTIMONIALS END ===== -->

<!-- ===== FAQ ===== -->
<section class="faq-area section-padding" id="faq">
    <div class="container">
        <div class="title-area">
            <h1>FAQ</h1>
            <h3>Frequently Asked Questions</h3>
            <p>Everything you need to know before getting started. Can't find your answer? <a href="mailto:{{ get_settings('contact_email') }}" style="color:var(--secondary-color);font-weight:600;">Contact us directly.</a></p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="accordion-area">
                    <div class="accordion" id="faqAccordion">

                        @if($faqs->count() > 0)
                            @foreach($faqs as $faq)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="faqHeading{{ $loop->index + 1 }}">
                                    <button class="accordion-button {{ $loop->index > 0 ? 'collapsed' : '' }} round-bg" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse{{ $loop->index + 1 }}" aria-expanded="{{ $loop->index == 0 ? 'true' : 'false' }}">
                                        {{ $faq->title }}
                                    </button>
                                </h2>
                                <div id="faqCollapse{{ $loop->index + 1 }}" class="accordion-collapse collapse {{ $loop->index == 0 ? 'show' : '' }}" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body"><p>{{ $faq->description }}</p></div>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="faqHeading1">
                                    <button class="accordion-button round-bg" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse1">What is Sirona School Management System?</button>
                                </h2>
                                <div id="faqCollapse1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body"><p>Sirona is a comprehensive, cloud-ready school management platform that centralizes student admissions, attendance, academics, fees, library, and staff management into one unified system.</p></div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="faqHeading2">
                                    <button class="accordion-button collapsed round-bg" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse2">Who can use Sirona?</button>
                                </h2>
                                <div id="faqCollapse2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body"><p>Sirona supports nine distinct user roles: Superadmin, School Administrator, Teacher, Accountant, Librarian, Parent, Student, Driver, and Alumni — each with a fully tailored dashboard.</p></div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="faqHeading3">
                                    <button class="accordion-button collapsed round-bg" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse3">Can multiple schools use the system simultaneously?</button>
                                </h2>
                                <div id="faqCollapse3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body"><p>Yes. The Superadmin panel allows managing multiple independent school instances from a single installation, making it ideal for school chains, networks, and educational group operators.</p></div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="faqHeading4">
                                    <button class="accordion-button collapsed round-bg" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse4">Is there an online payment integration?</button>
                                </h2>
                                <div id="faqCollapse4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body"><p>Yes. Sirona supports secure online payment gateways so parents can pay school fees directly from the parent portal without any physical cash handling.</p></div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="faqHeading5">
                                    <button class="accordion-button collapsed round-bg" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse5">How do I get started?</button>
                                </h2>
                                <div id="faqCollapse5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body"><p>Simply click the <strong>"Get Started"</strong> button, register your school, and our team will verify and activate your account. The process takes minutes, not days.</p></div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="faqHeading6">
                                    <button class="accordion-button collapsed round-bg" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse6">Is data secure on Sirona?</button>
                                </h2>
                                <div id="faqCollapse6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                    <div class="accordion-body"><p>Absolutely. Sirona uses role-based access control (RBAC), encrypted credentials, and session-based authentication, ensuring that sensitive student and financial data is always protected.</p></div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <!-- FAQ bottom CTA -->
                <div class="faq-bottom-cta">
                    <p>Still have questions?</p>
                    <a href="mailto:{{ get_settings('contact_email') }}" class="hero-btn-primary"><i class="fa-solid fa-envelope me-2"></i>Email Our Team</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ===== FAQ END ===== -->

<!-- ===== FINAL CTA ===== -->
<section class="final-cta-area" id="contact">
    <div class="final-cta-glow"></div>
    <div class="container">
        <div class="final-cta-inner text-center">
            <span class="final-cta-eyebrow"><i class="fa-solid fa-graduation-cap me-2"></i>Start Your Journey Today</span>
            <h2>Your School Deserves Better Tools.</h2>
            <p>Stop managing your school with outdated spreadsheets and disconnected apps. Sirona brings every department under one intelligent roof — saving time, reducing errors, and empowering every stakeholder.</p>
            <div class="final-cta-actions">
                <a href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="final-cta-primary">Get Started Now <i class="fa-solid fa-arrow-right ms-2"></i></a>
                <a href="mailto:{{ get_settings('contact_email') }}" class="final-cta-secondary"><i class="fa-solid fa-envelope me-2"></i>Email Us</a>
            </div>
            <p class="final-cta-note"><i class="fa-solid fa-lock me-1"></i> Secure setup &nbsp;&middot;&nbsp; <i class="fa-solid fa-clock me-1"></i> Quick onboarding &nbsp;&middot;&nbsp; <i class="fa-solid fa-headset me-1"></i> Dedicated support</p>
        </div>
    </div>
</section>
<!-- ===== FINAL CTA END ===== -->
<!-- Footer Area Start -->
<footer class="footer-area">
    <div class="footer-top">
        <div class="container">
            <div class="row g-5">
                <!-- Brand column -->
                <div class="col-lg-4 col-md-12">
                    <div class="footer-brand">
                        <a href="#" class="footer-logo-link">
                            <img src="{{ asset('assets/uploads/logo/'.get_settings('light_logo')) }}" alt="{{ get_settings('system_title') }}" class="footer-logo-img">
                        </a>
                        <p class="footer-brand-desc">{{ get_settings('frontend_footer_text') ?: 'A comprehensive school management system built for modern institutions.' }}</p>
                        <ul class="footer-social">
                            <li><a href="{{ get_settings('facebook_link') }}" title="Facebook" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
                            <li><a href="{{ get_settings('twitter_link') }}" title="Twitter" target="_blank"><i class="fa-brands fa-twitter"></i></a></li>
                            <li><a href="{{ get_settings('linkedin_link') }}" title="LinkedIn" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a></li>
                            <li><a href="{{ get_settings('instagram_link') }}" title="Instagram" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
                        </ul>
                    </div>
                </div>
                <!-- Quick links -->
                <div class="col-lg-2 col-md-4 col-6">
                    <div class="footer-col">
                        <h5 class="footer-col-title">Quick Links</h5>
                        <ul class="footer-links">
                            <li><a href="#">Home</a></li>
                            <li><a href="#feature">Features</a></li>
                            <li><a href="#why-us">Why Us</a></li>
                            <li><a href="#testimonials">Reviews</a></li>
                            <li><a href="#faq">FAQ</a></li>
                        </ul>
                    </div>
                </div>
                <!-- Contact -->
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="footer-col">
                        <h5 class="footer-col-title">Contact</h5>
                        <ul class="footer-contact-list">
                            @if(get_settings('phone'))
                            <li>
                                <i class="fa-solid fa-phone"></i>
                                <a href="tel:{{ get_settings('phone') }}">{{ get_settings('phone') }}</a>
                            </li>
                            @endif
                            @if(get_settings('contact_email'))
                            <li>
                                <i class="fa-solid fa-envelope"></i>
                                <a href="mailto:{{ get_settings('contact_email') }}">{{ get_settings('contact_email') }}</a>
                            </li>
                            @endif
                            @if(get_settings('address'))
                            <li>
                                <i class="fa-solid fa-location-dot"></i>
                                <span>{{ get_settings('address') }}</span>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <!-- CTA column -->
                <div class="col-lg-3 col-md-4">
                    <div class="footer-col">
                        <h5 class="footer-col-title">Get Started</h5>
                        <p style="color:rgba(255,255,255,0.5);font-size:14px;line-height:1.6;margin-bottom:20px;">Ready to modernize your school? Register or sign in to your dashboard.</p>
                        <a href="{{ route('login') }}" class="footer-cta-btn">Login to Dashboard <i class="fa-solid fa-arrow-right ms-2"></i></a>
                        @php $all_languages = get_all_language(); @endphp
                        @auth
                        @php
                            $usersinfo = DB::table('users')->where('id', auth()->user()->id)->first();
                            $userlanguage = $usersinfo->language ?? '';
                            $langRoutes = [1=>'superadmin.language',2=>'admin.language',3=>'teacher.language',4=>'accountant.language',5=>'librarian.language',6=>'parent.language',7=>'student.language'];
                            $roleId = auth()->user()->role_id;
                            $langRoute = $langRoutes[$roleId] ?? null;
                        @endphp
                        @if($langRoute)
                        <div class="footer-lang-wrap">
                            <button type="button" class="footer-lang-btn dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="fa-solid fa-language"></i>
                                <span>{{ ucwords($userlanguage ?: get_settings('language')) }}</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <form method="post" id="languageForm" action="{{ route($langRoute) }}">
                                    @csrf
                                    @foreach($all_languages as $al)
                                        <li><a class="dropdown-item language-item" href="javascript:;" data-language-name="{{ $al->name }}">{{ ucwords($al->name) }}</a></li>
                                    @endforeach
                                    <input type="hidden" name="language" id="selectedLanguageName">
                                </form>
                            </ul>
                        </div>
                        @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="footer-bottom-inner">
                <p>© {{ get_settings('copyright_text') ?: date('Y').' '.get_settings('system_title') }}</p>
                <p class="footer-bottom-right">Built with <i class="fa-solid fa-heart" style="color:#f43f5e;"></i> for modern education</p>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Area End -->

<style>
    #toast-container > .toast-warning {
        font-size: 15px;
    }
</style>

<script type="text/javascript">

                // JavaScript to handle language selection
                document.addEventListener('DOMContentLoaded', function() {
        let languageLinks = document.querySelectorAll('.language-item');
        
        languageLinks.forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                let languageName = this.getAttribute('data-language-name');
                document.getElementById('selectedLanguageName').value = languageName;
                document.getElementById('languageForm').submit();
            });
        });
    });
    "use strict";

    function subscription_warning(roleId) {
        if(roleId == 1){
            toastr.warning("You can't subscribe as superadmin");
        } else if(roleId == 2){
            toastr.warning("Your school is already subscribed to a package.");
        } else {
            toastr.warning("You are not authorized! Please login as school admin.");
        }
    }

    // Animated stats counter
    (function () {
        function animateCount(el, target, duration) {
            var start = 0, step = target / (duration / 16);
            var timer = setInterval(function () {
                start += step;
                if (start >= target) { start = target; clearInterval(timer); }
                el.textContent = Math.floor(start).toLocaleString();
            }, 16);
        }
        var observed = false;
        var statEls = document.querySelectorAll('.stat-number');
        if (statEls.length && 'IntersectionObserver' in window) {
            var observer = new IntersectionObserver(function(entries) {
                if (entries[0].isIntersecting && !observed) {
                    observed = true;
                    statEls.forEach(function(el) {
                        animateCount(el, parseInt(el.getAttribute('data-target'), 10), 1800);
                    });
                }
            }, { threshold: 0.3 });
            observer.observe(document.querySelector('.stats-area'));
        }
    })();

    // Scroll reveal animations
    (function () {
        if (!('IntersectionObserver' in window)) return;
        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    io.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12 });
        document.querySelectorAll('.fade-in-up, .why-us-card, .testimonial-card, .stat-item, .accordion-item, .hero-dashboard-preview, .sandbox-card, .roi-card, .demo-role-card').forEach(function (el) {
            io.observe(el);
        });
    })();

    // Scroll progress indicator
    (function () {
        var progressEl = document.getElementById('scrollProgress');
        if (!progressEl) return;
        window.addEventListener('scroll', function () {
            var scrollTop = window.scrollY || document.documentElement.scrollTop;
            var docHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            var scrollPercent = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;
            progressEl.style.width = scrollPercent + '%';
        });
    })();

    // Scroll Header Sticky state
    (function () {
        var header = document.querySelector('.header-area');
        if (!header) return;
        window.addEventListener('scroll', function () {
            if (window.scrollY > 50) {
                header.classList.add('sticky');
            } else {
                header.classList.remove('sticky');
            }
        });
    })();

    // Interactive Feature Tabs Switcher
    (function () {
        var tabs = document.querySelectorAll('.role-tab');
        var panels = document.querySelectorAll('.role-tab-panel');
        if (!tabs.length) return;
        tabs.forEach(function (tab) {
            tab.addEventListener('click', function () {
                tabs.forEach(function (t) { t.classList.remove('active'); });
                panels.forEach(function (p) { p.classList.remove('active'); });
                
                tab.classList.add('active');
                var target = document.getElementById(tab.getAttribute('data-target'));
                if (target) {
                    target.classList.add('active');
                }
            });
        });
    })();

    // ROI Calculator Logic (Nigerian Naira ₦)
    (function () {
        var sliderStudents = document.getElementById('calcStudents');
        var sliderHours = document.getElementById('calcHours');
        var valStudents = document.getElementById('valStudents');
        var valHours = document.getElementById('valHours');
        var resHours = document.getElementById('resHours');
        var resSavings = document.getElementById('resSavings');

        if (!sliderStudents || !sliderHours) return;

        function updateROI() {
            var students = parseInt(sliderStudents.value);
            var hours = parseInt(sliderHours.value);

            // Display slider values
            valStudents.textContent = students.toLocaleString();
            valHours.textContent = hours;

            // ROI calculations
            var hoursSavedPerWeek = (students / 50) * 3.5 + (hours * 0.4);
            var totalHoursSavedMonth = hoursSavedPerWeek * 4.3; // 4.3 weeks in a month
            
            // Assume ₦3,000 per hour cost for staff in Nigeria
            var estimatedSavingsMonth = totalHoursSavedMonth * 3000;

            // Update UI
            resHours.textContent = totalHoursSavedMonth.toFixed(1);
            resSavings.textContent = '₦' + Math.floor(estimatedSavingsMonth).toLocaleString();
        }

        sliderStudents.addEventListener('input', updateROI);
        sliderHours.addEventListener('input', updateROI);
        updateROI(); // Init values
    })();

    // Handle Schedule Demo form submission via AJAX/Toastr
    window.handleDemoScheduleSubmit = function (e) {
        e.preventDefault();
        
        // Show success Toastr alert
        toastr.success("Thank you! Your demo call has been scheduled. Our education expert will reach out to you shortly at the provided details.");
        
        // Hide Bootstrap modal
        var modalEl = document.getElementById('demoScheduleModal');
        if (modalEl) {
            var modal = bootstrap.Modal.getInstance(modalEl);
            if (modal) {
                modal.hide();
            }
        }
        
        // Reset form inputs
        document.getElementById('demoScheduleForm').reset();
    };

    // Dashboard Preview Interactive Menu Click Handler
    (function () {
        var menuItems = document.querySelectorAll('.mock-sidebar .mock-menu-item');
        var addressBar = document.querySelector('.browser-address-bar');
        var statsContainer = document.querySelector('.mock-top-stats');
        var chartTitle = document.querySelector('.mock-chart-container .mock-title');
        var chartBars = document.querySelector('.mock-bar-chart');
        var alertsContainer = document.querySelector('.mock-alerts-container');

        if (!menuItems.length || !statsContainer) return;

        var mockData = {
            'dashboard': {
                url: 'sirona.cortdevs.com/admin/dashboard',
                stats: [
                    { icon: 'bi-mortarboard-fill text-primary', label: 'Total Students', num: '1,248' },
                    { icon: 'bi-person-workspace text-success', label: 'Total Teachers', num: '86' },
                    { icon: 'bi-wallet2 text-warning', label: 'Fees Collected', num: '₦14.2M' }
                ],
                chartTitle: 'Attendance Overview',
                chartBars: [
                    { height: '70%', label: 'Mon' },
                    { height: '85%', label: 'Tue' },
                    { height: '90%', label: 'Wed' },
                    { height: '95%', label: 'Thu' },
                    { height: '80%', label: 'Fri' }
                ],
                alertsTitle: 'Live Activities',
                alerts: [
                    { badge: 'Fee Paid', badgeClass: 'success', text: 'Grade 10 tuition payment received.' },
                    { badge: 'Attendance', badgeClass: 'info', text: 'Morning roll-call report compiled.' }
                ]
            },
            'students': {
                url: 'sirona.cortdevs.com/admin/students',
                stats: [
                    { icon: 'bi-people-fill text-primary', label: 'Enrolled Students', num: '1,248' },
                    { icon: 'bi-plus-circle-fill text-success', label: 'New This Month', num: '+42' },
                    { icon: 'bi-check2-circle text-warning', label: 'Avg Attendance', num: '96.2%' }
                ],
                chartTitle: 'Enrollment by Class Level',
                chartBars: [
                    { height: '95%', label: 'JSS1' },
                    { height: '80%', label: 'JSS2' },
                    { height: '88%', label: 'JSS3' },
                    { height: '75%', label: 'SSS1' },
                    { height: '60%', label: 'SSS2' }
                ],
                alertsTitle: 'Student Updates',
                alerts: [
                    { badge: 'Admission', badgeClass: 'success', text: 'Kola Obi registered in JSS 1.' },
                    { badge: 'Leave Req', badgeClass: 'info', text: 'Fatima Ali requested 2 days leave.' }
                ]
            },
            'teachers': {
                url: 'sirona.cortdevs.com/admin/teachers',
                stats: [
                    { icon: 'bi-person-badge-fill text-success', label: 'Active Teachers', num: '86' },
                    { icon: 'bi-house-door-fill text-primary', label: 'On Leave Today', num: '3' },
                    { icon: 'bi-award-fill text-warning', label: 'Avg Rating', num: '4.8/5' }
                ],
                chartTitle: 'Teacher Distribution by Dept',
                chartBars: [
                    { height: '90%', label: 'Sci' },
                    { height: '80%', label: 'Math' },
                    { height: '85%', label: 'Eng' },
                    { height: '60%', label: 'Hist' },
                    { height: '50%', label: 'Arts' }
                ],
                alertsTitle: 'Staff Bulletins',
                alerts: [
                    { badge: 'Lesson Plan', badgeClass: 'success', text: 'Chemistry Term 2 plan submitted.' },
                    { badge: 'Meeting', badgeClass: 'info', text: 'Staff meeting scheduled for 3:00 PM.' }
                ]
            },
            'attendance': {
                url: 'sirona.cortdevs.com/admin/attendance',
                stats: [
                    { icon: 'bi-calendar-check-fill text-warning', label: 'Today Present', num: '94.8%' },
                    { icon: 'bi-calendar-x-fill text-danger', label: 'Today Absent', num: '5.2%' },
                    { icon: 'bi-clock-history text-primary', label: 'Late Arrival', num: '14' }
                ],
                chartTitle: 'Monthly Attendance Rate',
                chartBars: [
                    { height: '96%', label: 'Jan' },
                    { height: '94%', label: 'Feb' },
                    { height: '97%', label: 'Mar' },
                    { height: '95%', label: 'Apr' },
                    { height: '93%', label: 'May' }
                ],
                alertsTitle: 'Attendance Alerts',
                alerts: [
                    { badge: 'Absent Notification', badgeClass: 'info', text: 'SMS sent to parent of Tunde Alao.' },
                    { badge: 'Report Generated', badgeClass: 'success', text: 'Weekly attendance PDF compiled.' }
                ]
            },
            'accounting': {
                url: 'sirona.cortdevs.com/admin/accounting',
                stats: [
                    { icon: 'bi-cash-stack text-success', label: 'Total Invoiced', num: '₦24.8M' },
                    { icon: 'bi-wallet2 text-primary', label: 'Paid Invoices', num: '₦18.2M' },
                    { icon: 'bi-exclamation-triangle-fill text-danger', label: 'Outstanding Balance', num: '₦6.6M' }
                ],
                chartTitle: 'Fee Collection Progress',
                chartBars: [
                    { height: '50%', label: 'JSS' },
                    { height: '70%', label: 'SSS' },
                    { height: '80%', label: 'Term1' },
                    { height: '90%', label: 'Term2' },
                    { height: '65%', label: 'Term3' }
                ],
                alertsTitle: 'Financial Ledger',
                alerts: [
                    { badge: 'Gateway Settled', badgeClass: 'success', text: '₦1.2M online payments cleared.' },
                    { badge: 'Invoice Sent', badgeClass: 'info', text: 'Outstanding fee reminders dispatched.' }
                ]
            }
        };

        menuItems.forEach(function (item) {
            item.addEventListener('click', function () {
                menuItems.forEach(function (mi) { mi.classList.remove('active'); });
                item.classList.add('active');

                // Get key from text content or matching
                var text = item.textContent.trim().toLowerCase();
                var dataKey = 'dashboard';
                if (text.indexOf('students') > -1) dataKey = 'students';
                else if (text.indexOf('teachers') > -1) dataKey = 'teachers';
                else if (text.indexOf('attendance') > -1) dataKey = 'attendance';
                else if (text.indexOf('accounting') > -1) dataKey = 'accounting';

                var data = mockData[dataKey];
                if (!data) return;

                // Update address bar
                if (addressBar) {
                    addressBar.innerHTML = '<i class="bi bi-shield-fill-check text-success me-1"></i> ' + data.url;
                }

                // Update Stats
                statsContainer.innerHTML = '';
                data.stats.forEach(function (stat) {
                    var card = document.createElement('div');
                    card.className = 'mock-stat-card';
                    card.innerHTML = 
                        '<div class="card-icon"><i class="bi ' + stat.icon + '"></i></div>' +
                        '<div class="card-info">' +
                            '<span class="label">' + stat.label + '</span>' +
                            '<span class="num">' + stat.num + '</span>' +
                        '</div>';
                    statsContainer.appendChild(card);
                });

                // Update Chart Title
                if (chartTitle) chartTitle.textContent = data.chartTitle;

                // Update Chart Bars
                if (chartBars) {
                    chartBars.innerHTML = '';
                    data.chartBars.forEach(function (bar) {
                        var col = document.createElement('div');
                        col.className = 'bar-col';
                        col.innerHTML = '<div class="bar" style="height: 0px"></div><span>' + bar.label + '</span>';
                        chartBars.appendChild(col);
                        // Trigger smooth height animation
                        setTimeout(function () {
                            var barEl = col.querySelector('.bar');
                            if (barEl) barEl.style.height = bar.height;
                        }, 50);
                    });
                }

                // Update Alerts
                if (alertsContainer) {
                    alertsContainer.innerHTML = '<h5 class="mock-title">' + data.alertsTitle + '</h5>';
                    data.alerts.forEach(function (alert) {
                        var alertEl = document.createElement('div');
                        alertEl.className = 'mock-alert-item';
                        alertEl.innerHTML = 
                            '<div class="alert-badge ' + alert.badgeClass + '">' + alert.badge + '</div>' +
                            '<span class="text">' + alert.text + '</span>';
                        alertsContainer.appendChild(alertEl);
                    });
                }
            });
        });
    })();

    // Multi-Step Registration Wizard
    (function () {
        var btnNext = document.getElementById('btnNextStep');
        var btnPrev = document.getElementById('btnPrevStep');
        var step1 = document.getElementById('step-1-panel');
        var step2 = document.getElementById('step-2-panel');
        var indicator1 = document.getElementById('indicator-1');
        var indicator2 = document.getElementById('indicator-2');
        var stepLineFill = document.getElementById('stepLineFill');
        var form = document.getElementById('schoolReg');

        if (!btnNext || !btnPrev || !step1 || !step2 || !form) return;

        function validateEmail(email) {
            var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }

        function validateField(input) {
            var group = input.closest('.custom-form-group');
            if (!group) return true;

            var isValid = true;
            if (input.required && !input.value.trim()) {
                isValid = false;
            } else if (input.type === 'email' && input.value.trim() && !validateEmail(input.value)) {
                isValid = false;
            } else if (input.id === 'admin_password' && input.value && input.value.length < 8) {
                isValid = false;
            }

            if (!isValid) {
                group.classList.add('has-error');
            } else {
                group.classList.remove('has-error');
            }
            return isValid;
        }

        // Real-time input validation on change/input
        form.querySelectorAll('.form-control, .form-select').forEach(function (input) {
            input.addEventListener('input', function () {
                validateField(input);
            });
            input.addEventListener('change', function () {
                validateField(input);
            });
        });

        function validateStep1() {
            var inputs = step1.querySelectorAll('.form-control, .form-select');
            var isValid = true;
            inputs.forEach(function (input) {
                if (!validateField(input)) {
                    isValid = false;
                }
            });
            return isValid;
        }

        function validateStep2() {
            var inputs = step2.querySelectorAll('.form-control, .form-select');
            var isValid = true;
            inputs.forEach(function (input) {
                if (!validateField(input)) {
                    isValid = false;
                }
            });
            return isValid;
        }

        btnNext.addEventListener('click', function () {
            if (validateStep1()) {
                step1.classList.remove('active');
                step2.classList.add('active');
                indicator1.classList.add('completed');
                indicator2.classList.add('active');
                if (stepLineFill) {
                    stepLineFill.style.width = '100%';
                }
            }
        });

        btnPrev.addEventListener('click', function () {
            step2.classList.remove('active');
            step1.classList.add('active');
            indicator1.classList.remove('completed');
            indicator2.classList.remove('active');
            if (stepLineFill) {
                stepLineFill.style.width = '0%';
            }
        });

        form.addEventListener('submit', function (e) {
            var step1Valid = validateStep1();
            var step2Valid = validateStep2();
            if (!step1Valid || !step2Valid) {
                e.preventDefault();
                e.stopPropagation();
                if (!step1Valid) {
                    // Go back to step 1
                    step2.classList.remove('active');
                    step1.classList.add('active');
                    indicator1.classList.remove('completed');
                    indicator2.classList.remove('active');
                    if (stepLineFill) {
                        stepLineFill.style.width = '0%';
                    }
                }
                return false;
            }
        });
    })();

    function onSubmit(token) {
      document.getElementById("schoolReg").submit();
    }
    
  </script>
 
    <script src="https://www.google.com/recaptcha/api.js"></script>

@endsection