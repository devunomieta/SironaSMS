@extends('frontend.index')
@section('content')
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
                        <a class="signUp-btn" href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop">{{ get_phrase('Register') }}</a>
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
            <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-center" id="staticBackdropLabel">{{ get_phrase('School Register Form') }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="schoolReg" enctype="multipart/form-data" class="d-block ajaxForm" action="{{ route('school.create') }}">
                    	@csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="reg-modal-form">
                                    <h4>{{ get_phrase('SCHOOL INFO') }}</h4>
                                    <div class="reg-form-group">
                                        <div class="single-form">
                                            <label for="school_name">{{ get_phrase('School Name') }}</label>
                                            <input id="school_name" name="school_name" type="text" class="form-control" required>
                                        </div>
                                        <div class="single-form">
                                            <label for="school_address">{{ get_phrase('School Address') }}</label>
                                            <input id="school_address" name="school_address" type="text" class="form-control" required>
                                        </div>
                                        <div class="single-form">
                                            <label for="school_email">{{ get_phrase('School Email') }}</label>
                                            <input id="school_email" name="school_email" type="email" class="form-control" required>
                                        </div>
                                        <div class="single-form">
                                            <label for="school_phone">{{ get_phrase('School Phone') }}</label>
                                            <input id="school_phone" name="school_phone" type="tel" class="form-control" required>
                                        </div>
                                        <div class="single-form">
                                            <label for="school_info">{{ get_phrase('School info') }}</label>
                                           <textarea name="school_info" id="school_info" class="form-control" required></textarea>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            <div class="col-lg-6">
                                <div class="reg-modal-form">
                                    <h4>{{ get_phrase('ADMIN INFO') }}</h4>
                                    <div class="reg-form-group">
                                        <div class="single-form">
                                            <label for="admin_name">{{ get_phrase('Admin Name') }}</label>
                                            <input id="admin_name" name="admin_name" type="text" class="form-control" required>
                                        </div>
                                        <div class="single-form">
                                            <label for="gender">{{ get_phrase('Gender') }}</label>
                                            <select class="form-select" id="gender" name="gender" required>
                                                <option value="">{{ get_phrase('Select a gender') }}</option>
                                                <option value="Male">{{ get_phrase('Male') }}</option>
                                                <option value="Female">{{ get_phrase('Female') }}</option>
                                              </select>
                                        </div>
                                        <div class="single-form">
                                            <label for="blood_group">{{ get_phrase('Blood group') }}</label>
                                            <select class="form-select"  id="blood_group" name="blood_group" required>
                                                <option value="">{{ get_phrase('Select a blood group') }}</option>
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
                                        <div class="single-form">
                                            <label for="admin_address">{{ get_phrase('Admin Address') }}</label>
                                            <input id="admin_address" name="admin_address" type="text" class="form-control" required>
                                        </div>
                                        <div class="single-form">
                                            <label for="admin_phone">{{ get_phrase('Admin Phone Number') }}</label>
                                            <input id="admin_phone" name="admin_phone" type="tel" class="form-control" required>
                                        </div>
                                        <div class="single-form">
                                            <label for="photo">{{ get_phrase('Photo') }}</label>
                                            <input class="form-control" type="file" accept="image/*" id="photo" name="photo" >
                                        </div>
                                        <div class="single-form">
                                            <label for="admin_email">{{ get_phrase('Admin Email') }}</label>
                                            <input id="admin_email" name="admin_email" type="email" class="form-control" required>
                                        </div>
                                        <div class="single-form">
                                            <label for="admin_password">{{ get_phrase('Admin Password') }}</label>
                                            <input id="admin_password" name="admin_password" type="password" class="form-control" required>
                                        </div>
                                    </div>
                                </div> 
                                @if (get_settings('recaptcha_switch_value') == 'Yes')
                                    <button class="g-recaptcha m-submit-btn" 
                                    data-sitekey="{{ get_settings('recaptcha_site_key') }}" 
                                    data-callback='onSubmit' 
                                    data-action='submit' type="submit">{{ get_phrase('Submit') }}</button>
                                @else
                                <button class=" m-submit-btn" type="submit">{{ get_phrase('Submit') }}</button>
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
<!--  Bannar Area Start  -->
<section class="bannar-area">
    <div class="hero-bg-glow-radial"></div>
    <div class="container-xl">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <!-- Bannar Content -->
                <div class="bannar-content">
                    <span class="hero-subtitle-pill">{{ get_settings('system_title') }}</span>
                    <h2>{{ get_settings('banner_title') }}</h2>
                    <p class="hero-description">{{ get_settings('banner_subtitle') }}</p>
                    
                    <div class="hero-cta-buttons mt-5 d-flex justify-content-center align-items-center gap-3">
                        <a href="{{ route('login') }}" class="hero-btn-primary">{{ get_phrase('Get Started') }} <i class="fa-solid fa-arrow-right ms-2"></i></a>
                        <a href="#feature" class="hero-btn-secondary">{{ get_phrase('Explore Features') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--  Bannar Area End   -->
<!--  Service Area Start  -->
<section class="service-area section-padding" id="feature">
    <div class="container">
        <!-- Title  -->
        <div class="title-area">
            <h1>{{ get_phrase('Our Features') }}</h1>
            <h3>{{ get_settings('features_title')  }}</h3>
            <p>{{ get_settings('features_subtitle') }}</p>
        </div>
      
        <div class="row mt-5 pt-3">
            @foreach ($frontendFeatures as $frontendFeature)
            <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-60 fade-in-up">
                <div class="service-items">
                    <div class="service-icon">
                        <i class="{{$frontendFeature->icon }}"></i>
                    </div>
                    <div class="service-text">
                        <h3>{{$frontendFeature->title }}</h3>
                        <p>{{$frontendFeature->description }}</p>
                    </div>
                </div>
            </div>
            @endforeach
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
                <a href="{{ route('login') }}" class="mid-cta-btn-primary">Get Started Free <i class="fa-solid fa-arrow-right ms-2"></i></a>
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
            <a href="{{ route('login') }}" class="hero-btn-primary">Experience It Now <i class="fa-solid fa-arrow-right ms-2"></i></a>
        </div>
    </div>
</section>
<!-- ===== WHY CHOOSE US END ===== -->

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
                <a href="{{ route('login') }}" class="final-cta-primary">Get Started Now <i class="fa-solid fa-arrow-right ms-2"></i></a>
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
        document.querySelectorAll('.fade-in-up, .why-us-card, .testimonial-card, .stat-item, .accordion-item').forEach(function (el) {
            io.observe(el);
        });
    })();

    function onSubmit(token) {
      document.getElementById("schoolReg").submit();
    }
    
  </script>
 
    <script src="https://www.google.com/recaptcha/api.js"></script>

@endsection