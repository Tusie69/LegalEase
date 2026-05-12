@extends('layouts.app', ['title' => 'Đăng ký · LegalEase'])

@php
    $initialState = [
        'firstName'   => old('first_name', ''),
        'lastName'    => old('last_name', ''),
        'email'       => old('email', ''),
        'phone'       => old('phone', ''),
        'dob'         => old('date_of_birth', ''),
        'gender'      => old('gender', ''),
        'termsAgreed' => (bool) old('agreed_terms', false),
        'touched'     => [
            'firstName'       => old('first_name') !== null || $errors->has('first_name'),
            'lastName'        => old('last_name') !== null || $errors->has('last_name'),
            'email'           => old('email') !== null || $errors->has('email'),
            'phone'           => old('phone') !== null || $errors->has('phone'),
            'dob'             => old('date_of_birth') !== null || $errors->has('date_of_birth'),
            'gender'          => old('gender') !== null || $errors->has('gender'),
            'password'        => $errors->has('password'),
            'passwordConfirm' => $errors->has('password'),
            'termsAgreed'     => old('agreed_terms') !== null || $errors->has('agreed_terms'),
        ],
    ];
@endphp

@section('content')
<section class="relative -mt-[72px] flex min-h-screen flex-col md:flex-row">
    {{-- Photo --}}
    <div class="relative h-[35vh] overflow-hidden md:sticky md:top-0 md:h-screen md:flex-1">
        <img src="https://images.unsplash.com/photo-1698047682091-782b1e5c6536?q=80"
             alt=""
             class="absolute inset-0 h-full w-full object-cover grayscale">
    </div>

    {{-- Form --}}
    <div class="flex flex-1 items-center justify-center px-6 py-16 md:py-20">
        <div class="w-full max-w-[440px]">
            <h1 class="font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">Đăng ký</h1>
            <p class="mt-2 text-[15px] text-secondary">Tiếp cận kiến ​​thức chuyên môn pháp lý đáng tin cậy, đăng ký tư vấn và quản lý các vấn đề của bạn ở một nơi.</p>

            <form method="POST" action="{{ route('register.store') }}" class="mt-8 space-y-5" novalidate
                  x-data="customerSignupValidation({{ json_encode($initialState) }})"
                  @submit="markAllTouched()">
                @csrf

                <div class="grid gap-5 md:grid-cols-2">
                    <div>
                        <label for="first_name" class="block text-[13px] font-medium text-muted">
                            First name
                            <span x-show="!isFirstNameValid && !touched.firstName" class="text-gold">*</span>
                            <svg x-show="firstNameError" x-cloak class="inline-block h-3 w-3 align-middle text-error" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                            <svg x-show="isFirstNameValid" x-cloak class="inline-block h-3 w-3 align-middle text-success" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        </label>
                        <input id="first_name" type="text" name="first_name" x-model="firstName" @blur="touched.firstName = true" required minlength="2" maxlength="20"
                               placeholder="Lan"
                               class="mt-2 block w-full rounded-xl border border-text/10 bg-surface px-4 py-3 text-[15px] text-text placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                        @unless ($errors->has('first_name'))
                            <p x-show="firstNameError" x-cloak x-text="firstNameError" class="mt-2 text-[13px] text-error"></p>
                        @endunless
                        @error('first_name') <p class="mt-2 text-[13px] text-error">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="last_name" class="block text-[13px] font-medium text-muted">
                            Last name
                            <span x-show="!isLastNameValid && !touched.lastName" class="text-gold">*</span>
                            <svg x-show="lastNameError" x-cloak class="inline-block h-3 w-3 align-middle text-error" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                            <svg x-show="isLastNameValid" x-cloak class="inline-block h-3 w-3 align-middle text-success" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        </label>
                        <input id="last_name" type="text" name="last_name" x-model="lastName" @blur="touched.lastName = true" required minlength="2" maxlength="20"
                               placeholder="Nguyễn"
                               class="mt-2 block w-full rounded-xl border border-text/10 bg-surface px-4 py-3 text-[15px] text-text placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                        @unless ($errors->has('last_name'))
                            <p x-show="lastNameError" x-cloak x-text="lastNameError" class="mt-2 text-[13px] text-error"></p>
                        @endunless
                        @error('last_name') <p class="mt-2 text-[13px] text-error">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-[13px] font-medium text-muted">
                        Email
                        <span x-show="!isEmailValid && !touched.email" class="text-gold">*</span>
                        <svg x-show="emailError" x-cloak class="inline-block h-3 w-3 align-middle text-error" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                        <svg x-show="isEmailValid" x-cloak class="inline-block h-3 w-3 align-middle text-success" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    </label>
                    <input id="email" type="email" name="email" x-model="email" @blur="touched.email = true" required
                           placeholder="you@example.com"
                           class="mt-2 block w-full rounded-xl border border-text/10 bg-surface px-4 py-3 text-[15px] text-text placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                    @unless ($errors->has('email'))
                        <p x-show="emailError" x-cloak x-text="emailError" class="mt-2 text-[13px] text-error"></p>
                    @endunless
                    @error('email') <p class="mt-2 text-[13px] text-error">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="phone" class="block text-[13px] font-medium text-muted">
                        Phone
                        <span x-show="!isPhoneValid && !touched.phone" class="text-gold">*</span>
                        <svg x-show="phoneError" x-cloak class="inline-block h-3 w-3 align-middle text-error" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                        <svg x-show="isPhoneValid" x-cloak class="inline-block h-3 w-3 align-middle text-success" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    </label>
                    <input id="phone" type="tel" name="phone" x-model="phone" @blur="touched.phone = true" required
                           placeholder="09xxxxxxxx"
                           pattern="[\d\+\s\-\(\)]{9,15}"
                           title="Digits, spaces, dashes, parentheses, and a leading + are allowed."
                           class="mt-2 block w-full rounded-xl border border-text/10 bg-surface px-4 py-3 text-[15px] text-text placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                    @unless ($errors->has('phone'))
                        <p x-show="phoneError" x-cloak x-text="phoneError" class="mt-2 text-[13px] text-error"></p>
                    @endunless
                    @error('phone') <p class="mt-2 text-[13px] text-error">{{ $message }}</p> @enderror
                </div>

                <div class="grid gap-5 md:grid-cols-2">
                    <div>
                        <label for="date_of_birth" class="block text-[13px] font-medium text-muted">
                            Date of birth
                            <span x-show="!isDobValid && !touched.dob" class="text-gold">*</span>
                            <svg x-show="dobError" x-cloak class="inline-block h-3 w-3 align-middle text-error" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                            <svg x-show="isDobValid" x-cloak class="inline-block h-3 w-3 align-middle text-success" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        </label>
                        <input id="date_of_birth" type="date" name="date_of_birth" x-model="dob" @blur="touched.dob = true" required
                               max="{{ now()->subYears(18)->toDateString() }}"
                               class="mt-2 block w-full rounded-xl border border-text/10 bg-surface px-4 py-3 text-[15px] text-text placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                        @unless ($errors->has('date_of_birth'))
                            <p x-show="dobError" x-cloak x-text="dobError" class="mt-2 text-[13px] text-error"></p>
                        @endunless
                        @error('date_of_birth') <p class="mt-2 text-[13px] text-error">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="gender" class="block text-[13px] font-medium text-muted">
                            Gender
                            <span x-show="!isGenderValid && !touched.gender" class="text-gold">*</span>
                            <svg x-show="genderError" x-cloak class="inline-block h-3 w-3 align-middle text-error" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                            <svg x-show="isGenderValid" x-cloak class="inline-block h-3 w-3 align-middle text-success" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        </label>
                        <div class="relative mt-2">
                            <select id="gender" name="gender" x-model="gender" @blur="touched.gender = true" required
                                    class="block w-full appearance-none rounded-xl border border-text/10 bg-surface px-4 py-3 pr-11 text-[15px] text-text focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                                <option value="">Select</option>
                                <option value="female">Female</option>
                                <option value="male">Male</option>
                                <option value="other">Other</option>
                                <option value="undisclosed">Không muốn nói</option>
                            </select>
                            <span class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-muted">
                                <x-icon name="chevron-down" :size="16" />
                            </span>
                        </div>
                        @unless ($errors->has('gender'))
                            <p x-show="genderError" x-cloak x-text="genderError" class="mt-2 text-[13px] text-error"></p>
                        @endunless
                        @error('gender') <p class="mt-2 text-[13px] text-error">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div x-data="{ show: false }">
                    <label for="password" class="block text-[13px] font-medium text-muted">
                        Password
                        <span x-show="!isPasswordValid && !touched.password" class="text-gold">*</span>
                        <svg x-show="passwordError" x-cloak class="inline-block h-3 w-3 align-middle text-error" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                        <svg x-show="isPasswordValid" x-cloak class="inline-block h-3 w-3 align-middle text-success" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    </label>
                    <div class="relative mt-2">
                        <input id="password" name="password" x-model="password" @blur="touched.password = true" required
                               :type="show ? 'text' : 'password'"
                               placeholder="••••••••••••"
                               class="block w-full rounded-xl border border-text/10 bg-surface px-4 py-3 pr-11 text-[15px] text-text placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                        <button type="button" @click="show = !show" aria-label="Toggle password"
                                class="absolute inset-y-0 right-0 flex items-center pr-3 text-muted hover:text-accent">
                            <svg x-show="!show" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/></svg>
                            <svg x-show="show" x-cloak class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M3 3l18 18M10.5 10.7A2 2 0 0012 14a2 2 0 001.3-.5M6.7 6.7C4.1 8.3 2 12 2 12s3.5 7 10 7a9.8 9.8 0 004.3-.9M9.9 5.1A10 10 0 0112 5c6.5 0 10 7 10 7a17 17 0 01-2.2 2.9"/></svg>
                        </button>
                    </div>
                    <p class="mt-2 text-[12px] text-muted">Ít nhất 8 ký tự, bao gồm một chữ cái và một số.</p>
                    @unless ($errors->has('password'))
                        <p x-show="passwordError" x-cloak x-text="passwordError" class="mt-2 text-[13px] text-error"></p>
                    @endunless
                    @error('password') <p class="mt-2 text-[13px] text-error">{{ $message }}</p> @enderror
                </div>

                <div x-data="{ show: false }">
                    <label for="password_confirmation" class="block text-[13px] font-medium text-muted">
                        Confirm password
                        <span x-show="!isPasswordConfirmValid && !touched.passwordConfirm" class="text-gold">*</span>
                        <svg x-show="passwordConfirmError" x-cloak class="inline-block h-3 w-3 align-middle text-error" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                        <svg x-show="isPasswordConfirmValid" x-cloak class="inline-block h-3 w-3 align-middle text-success" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    </label>
                    <div class="relative mt-2">
                        <input id="password_confirmation" name="password_confirmation" x-model="passwordConfirm" @blur="touched.passwordConfirm = true" required
                               :type="show ? 'text' : 'password'"
                               placeholder="••••••••••••"
                               class="block w-full rounded-xl border border-text/10 bg-surface px-4 py-3 pr-11 text-[15px] text-text placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                        <button type="button" @click="show = !show" aria-label="Toggle password"
                                class="absolute inset-y-0 right-0 flex items-center pr-3 text-muted hover:text-accent">
                            <svg x-show="!show" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/></svg>
                            <svg x-show="show" x-cloak class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M3 3l18 18M10.5 10.7A2 2 0 0012 14a2 2 0 001.3-.5M6.7 6.7C4.1 8.3 2 12 2 12s3.5 7 10 7a9.8 9.8 0 004.3-.9M9.9 5.1A10 10 0 0112 5c6.5 0 10 7 10 7a17 17 0 01-2.2 2.9"/></svg>
                        </button>
                    </div>
                    <p x-show="passwordConfirmError" x-cloak x-text="passwordConfirmError" class="mt-2 text-[13px] text-error"></p>
                </div>

                <div>
                    <label class="flex items-start gap-2 text-[13px] text-muted">
                        <input type="checkbox" name="agreed_terms" value="1" x-model="termsAgreed" @change="touched.termsAgreed = true" required class="mt-0.5 h-4 w-4 rounded border-text/20 bg-surface text-accent focus:ring-accent">
                        <span>
                            I agree to the
                            <a href="{{ route('terms') }}" class="text-text transition-colors hover:text-accent">Điều khoản dịch vụ</a>
                            and
                            <a href="{{ route('privacy') }}" class="text-text transition-colors hover:text-accent">Chính sách bảo mật</a>.
                            <span x-show="!isTermsValid && !touched.termsAgreed" class="text-gold">*</span>
                            <svg x-show="termsError" x-cloak class="inline-block h-3 w-3 align-middle text-error" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                            <svg x-show="isTermsValid" x-cloak class="inline-block h-3 w-3 align-middle text-success" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        </span>
                    </label>
                    @unless ($errors->has('agreed_terms'))
                        <p x-show="termsError" x-cloak x-text="termsError" class="mt-2 text-[13px] text-error"></p>
                    @endunless
                    @error('agreed_terms') <p class="mt-2 text-[13px] text-error">{{ $message }}</p> @enderror
                </div>

                <x-button variant="primary" type="submit" class="w-full">Tạo tài khoản</x-button>

                <p class="text-center text-[14px] text-muted">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-text transition-colors hover:text-accent">Đăng nhập</a>
                </p>
            </form>
        </div>
    </div>
</section>

<script>
    function customerSignupValidation(initial) {
        return {
            firstName: initial.firstName || '',
            lastName: initial.lastName || '',
            email: initial.email || '',
            phone: initial.phone || '',
            dob: initial.dob || '',
            gender: initial.gender || '',
            password: '',
            passwordConfirm: '',
            termsAgreed: initial.termsAgreed || false,

            touched: Object.assign({
                firstName: false,
                lastName: false,
                email: false,
                phone: false,
                dob: false,
                gender: false,
                password: false,
                passwordConfirm: false,
                termsAgreed: false,
            }, initial.touched || {}),

            markAllTouched() {
                Object.keys(this.touched).forEach((k) => { this.touched[k] = true; });
            },

            get isFirstNameValid() {
                const trimmed = this.firstName.trim();
                return trimmed.length >= 2 && trimmed.length <= 20;
            },
            get isLastNameValid() {
                const trimmed = this.lastName.trim();
                return trimmed.length >= 2 && trimmed.length <= 20;
            },
            get isEmailValid() {
                return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.email);
            },
            get isPhoneValid() {
                return /^[\d\+\s\-\(\)]{9,15}$/.test(this.phone);
            },
            get isDobValid() {
                if (!this.dob) return false;
                const [y, m, d] = this.dob.split('-').map(Number);
                if (!y || !m || !d) return false;
                const dob = new Date(y, m - 1, d);
                if (isNaN(dob)) return false;
                const today = new Date();
                const cutoff = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate());
                return dob <= cutoff;
            },
            get isGenderValid() {
                return this.gender.length > 0;
            },
            get isPasswordValid() {
                return this.password.length >= 8 && /[a-zA-Z]/.test(this.password) && /\d/.test(this.password);
            },
            get isPasswordConfirmValid() {
                return this.passwordConfirm.length > 0 && this.passwordConfirm === this.password;
            },
            get isTermsValid() {
                return this.termsAgreed === true;
            },

            nameError(value, label) {
                const trimmed = value.trim();
                if (trimmed.length === 0) return `Please enter your ${label}.`;
                if (trimmed.length < 2) return 'Please use at least 2 characters.';
                return 'Please use no more than 20 characters.';
            },

            get firstNameError() {
                if (!this.touched.firstName || this.isFirstNameValid) return '';
                return this.nameError(this.firstName, 'first name');
            },
            get lastNameError() {
                if (!this.touched.lastName || this.isLastNameValid) return '';
                return this.nameError(this.lastName, 'last name');
            },
            get emailError() {
                if (!this.touched.email || this.isEmailValid) return '';
                if (this.email.length === 0) return 'Please enter your email address.';
                return 'Please enter a valid email address.';
            },
            get phoneError() {
                if (!this.touched.phone || this.isPhoneValid) return '';
                if (this.phone.length === 0) return 'Please enter your phone number.';
                return 'Use 9 to 15 digits, with optional + - ( ) and spaces.';
            },
            get dobError() {
                if (!this.touched.dob || this.isDobValid) return '';
                if (!this.dob) return 'Please select your date of birth.';
                const [y, m, d] = this.dob.split('-').map(Number);
                if (!y || !m || !d) return 'Please enter a valid date.';
                const dob = new Date(y, m - 1, d);
                const today = new Date();
                if (dob > today) return "Date of birth can't be in the future.";
                return 'You must be at least 18 to create an account.';
            },
            get genderError() {
                if (!this.touched.gender || this.isGenderValid) return '';
                return 'Please select an option.';
            },
            get passwordError() {
                if (!this.touched.password || this.isPasswordValid) return '';
                if (this.password.length === 0) return 'Please enter a password.';
                if (this.password.length < 8) return 'Use at least 8 characters.';
                if (!/[a-zA-Z]/.test(this.password)) return 'Include at least one letter.';
                if (!/\d/.test(this.password)) return 'Include at least one number.';
                return '';
            },
            get passwordConfirmError() {
                if (!this.touched.passwordConfirm || this.isPasswordConfirmValid) return '';
                if (this.passwordConfirm.length === 0) return 'Please confirm your password.';
                return "Passwords don't match.";
            },
            get termsError() {
                if (!this.touched.termsAgreed || this.isTermsValid) return '';
                return 'Please agree to the Terms and Privacy Policy.';
            },
        };
    }
</script>
@endsection
