@extends('layouts.signin_page')

@section('content')
<div class="row g-0 auth-wrapper">
    <!-- Left Panel (Decorative & Branding) -->
    <div class="col-lg-6 d-none d-lg-flex auth-left-panel">
        <div class="auth-glow-1"></div>
        <div class="auth-glow-2"></div>
        
        <!-- Logo / Top Section -->
        <div class="auth-brand">
            <a href="{{ route('login') }}" class="text-decoration-none">
                <img height="48px" src="{{ asset('assets/uploads/logo/'.get_settings('white_logo')) }}" alt="Logo">
            </a>
        </div>

        <!-- Middle Pitch Section -->
        <div class="auth-pitch my-auto">
            <h1 class="display-5 fw-bold text-white mb-3" style="letter-spacing: -1px; line-height: 1.15;">
                Register Your School.
            </h1>
            <p class="fs-6 text-white-50 mb-5" style="max-width: 480px; color: #94a3b8 !important; line-height: 1.6;">
                Get access to Sirona's state-of-the-art school management suite. Setup your school workspace and admin portal in minutes.
            </p>

            <!-- Testimonial / Promotion Card -->
            <div class="auth-promo-card p-4 rounded-4" style="max-width: 480px;">
                <div class="d-flex align-items-center gap-3 mb-3">
                    <div class="promo-icon-wrap" style="background: rgba(37, 99, 235, 0.15); width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #60a5fa; font-size: 18px;">
                        <i class="bi bi-rocket-takeoff-fill"></i>
                    </div>
                    <h5 class="m-0 text-white" style="font-size: 15px; font-weight: 600;">Seamless Onboarding</h5>
                </div>
                <p class="text-muted-light m-0" style="color: #94a3b8; font-size: 14px; line-height: 1.6;">
                    Setting up your institutional structure has never been this simple. Configure admins, classes, sessions, and academic calendars with intuitive guides.
                </p>
            </div>
        </div>

        <!-- Footer section -->
        <div class="auth-left-footer">
            <p class="m-0 text-muted-light small" style="color: #64748b;">&copy; {{ date('Y') }} Sirona. Developed by CortDevs.</p>
        </div>
    </div>

    <!-- Right Panel (Registration Wizard Form) -->
    <div class="col-lg-6 auth-right-panel">
        <div class="auth-form-container" style="max-width: 500px;">
            <!-- Mobile Logo -->
            <div class="d-block d-lg-none mb-4 text-center">
                <img height="48px" src="{{ asset('assets/uploads/logo/'.get_settings('dark_logo')) }}" alt="Logo">
            </div>

            <h2 class="auth-title">Register School</h2>
            <p class="auth-subtitle mb-4">Complete the fields below to register your school.</p>

            <!-- Stepper Progress -->
            <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom" style="border-color: #f1f5f9 !important;">
                <div class="d-flex align-items-center gap-2">
                    <span id="step-indicator-1" class="badge rounded-circle d-inline-flex align-items-center justify-content-center bg-primary text-white" style="width: 24px; height: 24px; font-weight: 600; font-size: 12px;">1</span>
                    <span id="step-label-1" class="fw-bold text-dark" style="font-size: 13px;">School Details</span>
                </div>
                <div class="text-muted" style="font-size: 18px;"><i class="bi bi-chevron-right"></i></div>
                <div class="d-flex align-items-center gap-2">
                    <span id="step-indicator-2" class="badge rounded-circle d-inline-flex align-items-center justify-content-center bg-light text-muted border" style="width: 24px; height: 24px; font-weight: 600; font-size: 12px;">2</span>
                    <span id="step-label-2" class="fw-medium text-muted" style="font-size: 13px;">Admin Account</span>
                </div>
            </div>

            <form id="schoolReg" method="POST" action="{{ route('school.create') }}" enctype="multipart/form-data">
                @csrf

                <!-- STEP 1: School Profile Details -->
                <div id="step-1-panel">
                    <!-- School Name -->
                    <div class="auth-input-group">
                        <label for="school_name">{{ get_phrase('School Name') }} <span class="text-danger">*</span></label>
                        <div class="auth-input-wrapper">
                            <span class="input-icon"><i class="bi bi-bank"></i></span>
                            <input type="text" name="school_name" class="auth-field" id="school_name" 
                                   placeholder="e.g. St. Mary High School" required>
                        </div>
                        <div class="invalid-feedback text-danger mt-1 small d-none" id="error-school_name">Please enter the school name.</div>
                    </div>

                    <!-- School Email -->
                    <div class="auth-input-group">
                        <label for="school_email">{{ get_phrase('School Email') }} <span class="text-danger">*</span></label>
                        <div class="auth-input-wrapper">
                            <span class="input-icon"><i class="bi bi-envelope"></i></span>
                            <input type="email" name="school_email" class="auth-field" id="school_email" 
                                   placeholder="e.g. info@school.com" required>
                        </div>
                        <div class="invalid-feedback text-danger mt-1 small d-none" id="error-school_email">Please enter a valid school email.</div>
                    </div>

                    <!-- School Phone -->
                    <div class="auth-input-group">
                        <label for="school_phone">{{ get_phrase('School Phone') }} <span class="text-danger">*</span></label>
                        <div class="auth-input-wrapper">
                            <span class="input-icon"><i class="bi bi-telephone"></i></span>
                            <input type="text" name="school_phone" class="auth-field" id="school_phone" 
                                   placeholder="e.g. +1234567890" required>
                        </div>
                        <div class="invalid-feedback text-danger mt-1 small d-none" id="error-school_phone">Please enter the school phone number.</div>
                    </div>

                    <!-- School Address -->
                    <div class="auth-input-group">
                        <label for="school_address">{{ get_phrase('School Address') }} <span class="text-danger">*</span></label>
                        <div class="auth-input-wrapper">
                            <span class="input-icon"><i class="bi bi-geo-alt"></i></span>
                            <input type="text" name="school_address" class="auth-field" id="school_address" 
                                   placeholder="e.g. 123 School Lane, Boston, MA" required>
                        </div>
                        <div class="invalid-feedback text-danger mt-1 small d-none" id="error-school_address">Please enter the school address.</div>
                    </div>

                    <!-- School Info -->
                    <div class="auth-input-group">
                        <label for="school_info">{{ get_phrase('School Description / Info') }}</label>
                        <div class="auth-input-wrapper">
                            <span class="input-icon" style="top: 15px;"><i class="bi bi-info-circle"></i></span>
                            <textarea name="school_info" class="auth-field" id="school_info" rows="3" 
                                      placeholder="A short summary of your institution..." style="padding-top: 12px; resize: none;"></textarea>
                        </div>
                    </div>

                    <!-- Next Button -->
                    <button type="button" id="btnNextStep" class="auth-btn-primary mt-3 d-flex align-items-center justify-content-center gap-2">
                        {{ get_phrase('Continue to Admin Details') }} <i class="bi bi-arrow-right"></i>
                    </button>
                </div>

                <!-- STEP 2: Administrator Profile Details -->
                <div id="step-2-panel" style="display: none;">
                    
                    <div class="row">
                        <!-- Admin Name -->
                        <div class="col-md-12">
                            <div class="auth-input-group">
                                <label for="admin_name">{{ get_phrase('Administrator Name') }} <span class="text-danger">*</span></label>
                                <div class="auth-input-wrapper">
                                    <span class="input-icon"><i class="bi bi-person"></i></span>
                                    <input type="text" name="admin_name" class="auth-field" id="admin_name" 
                                           placeholder="e.g. John Doe">
                                </div>
                                <div class="invalid-feedback text-danger mt-1 small d-none" id="error-admin_name">Please enter the administrator's name.</div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Admin Email -->
                        <div class="col-md-6">
                            <div class="auth-input-group">
                                <label for="admin_email">{{ get_phrase('Admin Email') }} <span class="text-danger">*</span></label>
                                <div class="auth-input-wrapper">
                                    <span class="input-icon"><i class="bi bi-envelope"></i></span>
                                    <input type="email" name="admin_email" class="auth-field" id="admin_email" 
                                           placeholder="e.g. admin@school.com">
                                </div>
                                <div class="invalid-feedback text-danger mt-1 small d-none" id="error-admin_email">Please enter a valid administrator email.</div>
                            </div>
                        </div>

                        <!-- Admin Password -->
                        <div class="col-md-6">
                            <div class="auth-input-group">
                                <label for="admin_password">{{ get_phrase('Password') }} <span class="text-danger">*</span></label>
                                <div class="auth-input-wrapper">
                                    <span class="input-icon"><i class="bi bi-lock"></i></span>
                                    <input type="password" name="admin_password" class="auth-field" id="admin_password" 
                                           placeholder="••••••••">
                                </div>
                                <div class="invalid-feedback text-danger mt-1 small d-none" id="error-admin_password">Please enter a password of at least 8 characters.</div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Admin Phone -->
                        <div class="col-md-6">
                            <div class="auth-input-group">
                                <label for="admin_phone">{{ get_phrase('Admin Phone') }} <span class="text-danger">*</span></label>
                                <div class="auth-input-wrapper">
                                    <span class="input-icon"><i class="bi bi-telephone"></i></span>
                                    <input type="text" name="admin_phone" class="auth-field" id="admin_phone" 
                                           placeholder="e.g. +1234567890">
                                </div>
                                <div class="invalid-feedback text-danger mt-1 small d-none" id="error-admin_phone">Please enter the phone number.</div>
                            </div>
                        </div>

                        <!-- Gender -->
                        <div class="col-md-6">
                            <div class="auth-input-group">
                                <label for="gender">{{ get_phrase('Gender') }} <span class="text-danger">*</span></label>
                                <div class="auth-input-wrapper">
                                    <span class="input-icon"><i class="bi bi-gender-ambiguous"></i></span>
                                    <select name="gender" class="auth-field" id="gender" style="appearance: none; padding-right: 32px;">
                                        <option value="">{{ get_phrase('Select Gender') }}</option>
                                        <option value="Male">{{ get_phrase('Male') }}</option>
                                        <option value="Female">{{ get_phrase('Female') }}</option>
                                    </select>
                                    <span style="position: absolute; right: 16px; pointer-events: none; color: var(--text-muted);"><i class="bi bi-chevron-down"></i></span>
                                </div>
                                <div class="invalid-feedback text-danger mt-1 small d-none" id="error-gender">Please select a gender.</div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Blood Group -->
                        <div class="col-md-12">
                            <div class="auth-input-group">
                                <label for="blood_group">{{ get_phrase('Blood Group') }}</label>
                                <div class="auth-input-wrapper">
                                    <span class="input-icon"><i class="bi bi-droplet"></i></span>
                                    <select name="blood_group" class="auth-field" id="blood_group" style="appearance: none; padding-right: 32px;">
                                        <option value="">{{ get_phrase('Select Blood Group') }}</option>
                                        <option value="a+">A+</option>
                                        <option value="a-">A-</option>
                                        <option value="b+">B+</option>
                                        <option value="b-">B-</option>
                                        <option value="ab+">AB+</option>
                                        <option value="ab-">AB-</option>
                                        <option value="o+">O+</option>
                                        <option value="o-">O-</option>
                                    </select>
                                    <span style="position: absolute; right: 16px; pointer-events: none; color: var(--text-muted);"><i class="bi bi-chevron-down"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Admin Address -->
                    <div class="auth-input-group">
                        <label for="admin_address">{{ get_phrase('Admin Address') }} <span class="text-danger">*</span></label>
                        <div class="auth-input-wrapper">
                            <span class="input-icon"><i class="bi bi-geo-alt"></i></span>
                            <input type="text" name="admin_address" class="auth-field" id="admin_address" 
                                   placeholder="e.g. 456 Admin Lane, City, State">
                        </div>
                        <div class="invalid-feedback text-danger mt-1 small d-none" id="error-admin_address">Please enter the administrator address.</div>
                    </div>

                    <!-- Buttons Row -->
                    <div class="d-flex gap-3 mt-4">
                        <button type="button" id="btnPrevStep" class="auth-btn-secondary" style="flex: 1;">
                            <i class="bi bi-arrow-left"></i> {{ get_phrase('Back') }}
                        </button>
                        <button type="submit" id="btnSubmit" class="auth-btn-primary" style="flex: 2;">
                            {{ get_phrase('Register School') }}
                        </button>
                    </div>
                </div>
            </form>

            <!-- Bottom Link -->
            <div class="text-center mt-4 pt-3 border-top" style="border-color: #f1f5f9 !important;">
                <p class="text-muted small mb-0">
                    {{ get_phrase('Already registered?') }} <a href="{{ route('login') }}" class="auth-link">{{ get_phrase('Login to your account') }}</a>
                </p>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const btnNext = document.getElementById('btnNextStep');
    const btnPrev = document.getElementById('btnPrevStep');
    const step1 = document.getElementById('step-1-panel');
    const step2 = document.getElementById('step-2-panel');
    const form = document.getElementById('schoolReg');

    const ind1 = document.getElementById('step-indicator-1');
    const lbl1 = document.getElementById('step-label-1');
    const ind2 = document.getElementById('step-indicator-2');
    const lbl2 = document.getElementById('step-label-2');

    // Fields for validation
    const fieldsStep1 = ['school_name', 'school_email', 'school_phone', 'school_address'];
    const fieldsStep2 = ['admin_name', 'admin_email', 'admin_password', 'admin_phone', 'gender', 'admin_address'];

    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }

    function validateField(fieldId) {
        const el = document.getElementById(fieldId);
        const err = document.getElementById('error-' + fieldId);
        if (!el || !err) return true;

        let valid = true;
        
        if (el.tagName === 'SELECT') {
            valid = el.value !== '';
        } else if (el.type === 'email') {
            valid = validateEmail(el.value);
        } else if (el.type === 'password') {
            valid = el.value.length >= 8;
        } else {
            valid = el.value.trim() !== '';
        }

        if (!valid) {
            el.classList.add('is-invalid');
            err.classList.remove('d-none');
        } else {
            el.classList.remove('is-invalid');
            err.classList.add('d-none');
        }

        return valid;
    }

    // Input handlers to remove invalid status on type
    [...fieldsStep1, ...fieldsStep2].forEach(fieldId => {
        const el = document.getElementById(fieldId);
        if (el) {
            const handler = () => {
                el.classList.remove('is-invalid');
                const err = document.getElementById('error-' + fieldId);
                if (err) err.classList.add('d-none');
            };
            el.addEventListener('input', handler);
            if (el.tagName === 'SELECT') {
                el.addEventListener('change', handler);
            }
        }
    });

    btnNext.addEventListener('click', function () {
        let allValid = true;
        fieldsStep1.forEach(fieldId => {
            if (!validateField(fieldId)) {
                allValid = false;
            }
        });

        if (allValid) {
            // Hide step 1, show step 2
            step1.style.display = 'none';
            step2.style.display = 'block';

            // Update indicators
            ind1.className = 'badge rounded-circle d-inline-flex align-items-center justify-content-center bg-light text-muted border';
            lbl1.className = 'fw-medium text-muted';
            ind2.className = 'badge rounded-circle d-inline-flex align-items-center justify-content-center bg-primary text-white';
            lbl2.className = 'fw-bold text-dark';

            // Focus first field
            document.getElementById('admin_name').focus();
        }
    });

    btnPrev.addEventListener('click', function () {
        // Hide step 2, show step 1
        step2.style.display = 'none';
        step1.style.display = 'block';

        // Update indicators
        ind1.className = 'badge rounded-circle d-inline-flex align-items-center justify-content-center bg-primary text-white';
        lbl1.className = 'fw-bold text-dark';
        ind2.className = 'badge rounded-circle d-inline-flex align-items-center justify-content-center bg-light text-muted border';
        lbl2.className = 'fw-medium text-muted';
    });

    form.addEventListener('submit', function (e) {
        let allValid = true;
        
        // Validate step 1 fields just in case
        fieldsStep1.forEach(fieldId => {
            if (!validateField(fieldId)) {
                allValid = false;
            }
        });

        // Validate step 2 fields
        fieldsStep2.forEach(fieldId => {
            if (!validateField(fieldId)) {
                allValid = false;
            }
        });

        if (!allValid) {
            e.preventDefault();
            // If errors are in step 1 and we are on step 2, go back
            let step1Error = false;
            fieldsStep1.forEach(fieldId => {
                const el = document.getElementById(fieldId);
                if (el.classList.contains('is-invalid')) {
                    step1Error = true;
                }
            });

            if (step1Error && step2.style.display === 'block') {
                btnPrev.click();
            }
        }
    });
});
</script>
@endsection
