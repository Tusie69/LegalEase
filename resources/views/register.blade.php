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
<section class="relative -mt-18 flex min-h-screen flex-col lg:landscape:flex-row">
    {{-- Photo --}}
    <div class="relative h-[55vh] overflow-hidden lg:landscape:sticky lg:landscape:top-0 lg:landscape:h-screen lg:landscape:flex-1">
        <x-responsive-img src="https://images.unsplash.com/photo-1698047682091-782b1e5c6536"
                          alt=""
                          loading="eager"
                          sizes="(min-width: 1024px) 50vw, 100vw"
                          :widths="[600, 900, 1200, 1600]"
                          class="absolute inset-0 h-full w-full object-cover" />
    </div>

    {{-- Form --}}
    <div class="flex flex-1 items-center justify-center px-6 py-16 md:py-20">
        <div class="w-full max-w-[440px]">
            <h1 class="text-flow-h1">Đăng ký</h1>
            <p class="text-body mt-2">Tiếp cận kiến thức chuyên môn pháp lý đáng tin cậy, đặt lịch tư vấn và quản lý các vấn đề của bạn ở một nơi.</p>

            <form method="POST" action="{{ route('register.store') }}" class="mt-8 space-y-5" novalidate
                  x-data="customerSignupValidation({{ json_encode($initialState) }})"
                  @submit="markAllTouched()">
                @csrf

                <div class="grid gap-5 md:grid-cols-2">
                    <div>
                        <label for="first_name" class="block text-form-label">
                            Tên <span x-show="!isFirstNameValid && !touched.firstName" class="text-gold">*</span>
                            <svg x-show="firstNameError" x-cloak class="inline-block h-3 w-3 align-middle text-error" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                            <svg x-show="isFirstNameValid" x-cloak class="inline-block h-3 w-3 align-middle text-success" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        </label>
                        <input id="first_name" type="text" name="first_name" x-model="firstName" @blur="touched.firstName = true" required minlength="2" maxlength="20"
                               placeholder="Lan"
                               class="mt-2 block w-full rounded-xl border border-text/20 bg-bg px-4 py-3 text-body text-text placeholder:text-text/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                        @unless ($errors->has('first_name'))
                            <p x-show="firstNameError" x-cloak x-text="firstNameError" class="mt-2 text-caption text-error"></p>
                        @endunless
                        @error('first_name') <p class="mt-2 text-caption text-error">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="last_name" class="block text-form-label">
                            Họ <span x-show="!isLastNameValid && !touched.lastName" class="text-gold">*</span>
                            <svg x-show="lastNameError" x-cloak class="inline-block h-3 w-3 align-middle text-error" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                            <svg x-show="isLastNameValid" x-cloak class="inline-block h-3 w-3 align-middle text-success" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        </label>
                        <input id="last_name" type="text" name="last_name" x-model="lastName" @blur="touched.lastName = true" required minlength="2" maxlength="20"
                               placeholder="Nguyễn"
                               class="mt-2 block w-full rounded-xl border border-text/20 bg-bg px-4 py-3 text-body text-text placeholder:text-text/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                        @unless ($errors->has('last_name'))
                            <p x-show="lastNameError" x-cloak x-text="lastNameError" class="mt-2 text-caption text-error"></p>
                        @endunless
                        @error('last_name') <p class="mt-2 text-caption text-error">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-form-label">
                        Email
                        <span x-show="!isEmailValid && !touched.email" class="text-gold">*</span>
                        <svg x-show="emailError" x-cloak class="inline-block h-3 w-3 align-middle text-error" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                        <svg x-show="isEmailValid" x-cloak class="inline-block h-3 w-3 align-middle text-success" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    </label>
                    <input id="email" type="email" name="email" x-model="email" @blur="touched.email = true" required
                           placeholder="you@example.com"
                           class="mt-2 block w-full rounded-xl border border-text/20 bg-bg px-4 py-3 text-body text-text placeholder:text-text/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                    @unless ($errors->has('email'))
                        <p x-show="emailError" x-cloak x-text="emailError" class="mt-2 text-caption text-error"></p>
                    @endunless
                    @error('email') <p class="mt-2 text-caption text-error">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="phone" class="block text-form-label">
                        Điện thoại <span x-show="!isPhoneValid && !touched.phone" class="text-gold">*</span>
                        <svg x-show="phoneError" x-cloak class="inline-block h-3 w-3 align-middle text-error" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                        <svg x-show="isPhoneValid" x-cloak class="inline-block h-3 w-3 align-middle text-success" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    </label>
                    <input id="phone" type="tel" name="phone" x-model="phone" @blur="touched.phone = true" required
                           placeholder="09xxxxxxxx"
                           pattern="[\d\+\s\-\(\)]{9,15}"
                           title="Digits, spaces, dashes, parentheses, and a leading + are allowed."
                           class="mt-2 block w-full rounded-xl border border-text/20 bg-bg px-4 py-3 text-body text-text placeholder:text-text/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                    @unless ($errors->has('phone'))
                        <p x-show="phoneError" x-cloak x-text="phoneError" class="mt-2 text-caption text-error"></p>
                    @endunless
                    @error('phone') <p class="mt-2 text-caption text-error">{{ $message }}</p> @enderror
                </div>

                <div class="grid gap-5 md:grid-cols-2">
                    <div @keydown.escape.window="dobPickerOpen = false">
                        <label for="date_of_birth" class="block text-form-label">
                            Ngày sinh <span x-show="!isDobValid && !touched.dob" class="text-gold">*</span>
                            <svg x-show="dobError" x-cloak class="inline-block h-3 w-3 align-middle text-error" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                            <svg x-show="isDobValid" x-cloak class="inline-block h-3 w-3 align-middle text-success" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        </label>
                        <div class="relative mt-2" @click.outside="dobPickerOpen = false">
                            <input type="hidden" name="date_of_birth" :value="dob">
                            <input id="date_of_birth" type="text" readonly
                                   :value="dobDisplay"
                                   placeholder="DD/MM/YYYY"
                                   @click="dobPickerOpen = !dobPickerOpen"
                                   @blur="touched.dob = true"
                                   class="block w-full cursor-pointer rounded-xl border border-text/20 bg-bg px-4 py-3 pr-11 text-body text-text placeholder:text-text/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                            <button type="button"
                                    @click.stop="dobPickerOpen = !dobPickerOpen"
                                    :aria-expanded="dobPickerOpen"
                                    aria-label="Mở lịch chọn ngày"
                                    class="absolute inset-y-0 right-0 flex w-11 items-center justify-center text-text/60 transition-colors hover:text-text">
                                <x-icon name="calendar" :size="16" />
                            </button>

                            <div x-show="dobPickerOpen" x-cloak
                                 x-transition:enter="transition ease-out duration-150"
                                 x-transition:enter-start="opacity-0 -translate-y-1"
                                 x-transition:enter-end="opacity-100 translate-y-0"
                                 class="absolute left-0 right-0 top-full z-30 mt-2 rounded-xl border border-text/15 bg-bg p-4 sm:right-auto sm:w-[320px]">
                                <div class="flex gap-2">
                                    <div class="relative flex-1">
                                        <select x-model.number="dobPickerMonth"
                                                class="block w-full appearance-none rounded-lg border border-text/15 bg-bg px-3 py-2 pr-8 text-caption text-text focus:border-accent focus:outline-none">
                                            <template x-for="(name, i) in dobMonths" :key="i">
                                                <option :value="i" x-text="name"></option>
                                            </template>
                                        </select>
                                        <span class="pointer-events-none absolute inset-y-0 right-2 flex items-center text-text/60">
                                            <x-icon name="chevron-down" :size="14" />
                                        </span>
                                    </div>
                                    <div class="relative flex-1">
                                        <select x-model.number="dobPickerYear"
                                                class="block w-full appearance-none rounded-lg border border-text/15 bg-bg px-3 py-2 pr-8 text-caption text-text focus:border-accent focus:outline-none">
                                            <template x-for="y in dobYears" :key="y">
                                                <option :value="y" x-text="y"></option>
                                            </template>
                                        </select>
                                        <span class="pointer-events-none absolute inset-y-0 right-2 flex items-center text-text/60">
                                            <x-icon name="chevron-down" :size="14" />
                                        </span>
                                    </div>
                                </div>

                                <div class="mt-3 grid grid-cols-7 gap-0.5">
                                    <template x-for="d in ['T2','T3','T4','T5','T6','T7','CN']" :key="d">
                                        <span class="text-form-hint text-center font-medium uppercase tracking-wide text-text/50" x-text="d"></span>
                                    </template>
                                </div>
                                <div class="mt-1 grid grid-cols-7 gap-0.5">
                                    <template x-for="cell in dobCells" :key="cell.key">
                                        <button type="button"
                                                :disabled="!cell.day"
                                                @click="cell.day && selectDobDay(cell.day)"
                                                :class="
                                                    !cell.day ? 'invisible' :
                                                    cell.selected ? 'bg-accent text-bg font-semibold' :
                                                    'text-text hover:bg-text/5'
                                                "
                                                class="aspect-square rounded-md text-caption transition-colors"
                                                x-text="cell.day"></button>
                                    </template>
                                </div>
                            </div>
                        </div>
                        @unless ($errors->has('date_of_birth'))
                            <p x-show="dobError" x-cloak x-text="dobError" class="mt-2 text-caption text-error"></p>
                        @endunless
                        @error('date_of_birth') <p class="mt-2 text-caption text-error">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="gender" class="block text-form-label">
                            Giới tính <span x-show="!isGenderValid && !touched.gender" class="text-gold">*</span>
                            <svg x-show="genderError" x-cloak class="inline-block h-3 w-3 align-middle text-error" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                            <svg x-show="isGenderValid" x-cloak class="inline-block h-3 w-3 align-middle text-success" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        </label>
                        <div class="relative mt-2">
                            <select id="gender" name="gender" x-model="gender" @blur="touched.gender = true" required
                                    class="block w-full appearance-none rounded-xl border border-text/20 bg-bg px-4 py-3 pr-11 text-body text-text focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                                <option value="">Chọn</option>
                                <option value="female">Nữ</option>
                                <option value="male">Nam</option>
                                <option value="other">Khác</option>
                                <option value="undisclosed">Không muốn nói</option>
                            </select>
                            <span class="pointer-events-none absolute inset-y-0 right-4 flex items-center">
                                <x-icon name="chevron-down" :size="16" />
                            </span>
                        </div>
                        @unless ($errors->has('gender'))
                            <p x-show="genderError" x-cloak x-text="genderError" class="mt-2 text-caption text-error"></p>
                        @endunless
                        @error('gender') <p class="mt-2 text-caption text-error">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div x-data="{ show: false }">
                    <label for="password" class="block text-form-label">
                        Mật khẩu <span x-show="!isPasswordValid && !touched.password" class="text-gold">*</span>
                        <svg x-show="passwordError" x-cloak class="inline-block h-3 w-3 align-middle text-error" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                        <svg x-show="isPasswordValid" x-cloak class="inline-block h-3 w-3 align-middle text-success" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    </label>
                    <div class="relative mt-2">
                        <input id="password" name="password" x-model="password" @blur="touched.password = true" required
                               :type="show ? 'text' : 'password'"
                               placeholder="••••••••••••"
                               class="block w-full rounded-xl border border-text/20 bg-bg px-4 py-3 pr-11 text-body text-text placeholder:text-text/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                        <button type="button" @click="show = !show" aria-label="Toggle password"
                                class="absolute inset-y-0 right-0 flex items-center pr-3 hover:text-text/60">
                            <svg x-show="!show" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/></svg>
                            <svg x-show="show" x-cloak class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M3 3l18 18M10.5 10.7A2 2 0 0012 14a2 2 0 001.3-.5M6.7 6.7C4.1 8.3 2 12 2 12s3.5 7 10 7a9.8 9.8 0 004.3-.9M9.9 5.1A10 10 0 0112 5c6.5 0 10 7 10 7a17 17 0 01-2.2 2.9"/></svg>
                        </button>
                    </div>
                    <p class="mt-2 text-form-hint">Ít nhất 8 ký tự, bao gồm một chữ cái và một số.</p>
                    @unless ($errors->has('password'))
                        <p x-show="passwordError" x-cloak x-text="passwordError" class="mt-2 text-caption text-error"></p>
                    @endunless
                    @error('password') <p class="mt-2 text-caption text-error">{{ $message }}</p> @enderror
                </div>

                <div x-data="{ show: false }">
                    <label for="password_confirmation" class="block text-form-label">
                        Xác nhận mật khẩu <span x-show="!isPasswordConfirmValid && !touched.passwordConfirm" class="text-gold">*</span>
                        <svg x-show="passwordConfirmError" x-cloak class="inline-block h-3 w-3 align-middle text-error" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                        <svg x-show="isPasswordConfirmValid" x-cloak class="inline-block h-3 w-3 align-middle text-success" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    </label>
                    <div class="relative mt-2">
                        <input id="password_confirmation" name="password_confirmation" x-model="passwordConfirm" @blur="touched.passwordConfirm = true" required
                               :type="show ? 'text' : 'password'"
                               placeholder="••••••••••••"
                               class="block w-full rounded-xl border border-text/20 bg-bg px-4 py-3 pr-11 text-body text-text placeholder:text-text/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                        <button type="button" @click="show = !show" aria-label="Toggle password"
                                class="absolute inset-y-0 right-0 flex items-center pr-3 hover:text-text/60">
                            <svg x-show="!show" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/></svg>
                            <svg x-show="show" x-cloak class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M3 3l18 18M10.5 10.7A2 2 0 0012 14a2 2 0 001.3-.5M6.7 6.7C4.1 8.3 2 12 2 12s3.5 7 10 7a9.8 9.8 0 004.3-.9M9.9 5.1A10 10 0 0112 5c6.5 0 10 7 10 7a17 17 0 01-2.2 2.9"/></svg>
                        </button>
                    </div>
                    <p x-show="passwordConfirmError" x-cloak x-text="passwordConfirmError" class="mt-2 text-caption text-error"></p>
                </div>

                <div>
                    <label class="flex items-start gap-2 text-caption">
                        <input type="checkbox" name="agreed_terms" value="1" x-model="termsAgreed" @change="touched.termsAgreed = true" required class="mt-0.5 h-4 w-4 rounded border-text/20 bg-bg text-accent focus:ring-accent">
                        <span>
                            Tôi đồng ý với
                            <a href="{{ route('terms') }}" class="text-text underline underline-offset-4 decoration-text/30 transition-colors hover:decoration-accent">Điều khoản dịch vụ</a>
                            và
                            <a href="{{ route('privacy') }}" class="text-text underline underline-offset-4 decoration-text/30 transition-colors hover:decoration-accent">Chính sách bảo mật</a>.
                            <span x-show="!isTermsValid && !touched.termsAgreed" class="text-gold">*</span>
                            <svg x-show="termsError" x-cloak class="inline-block h-3 w-3 align-middle text-error" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                            <svg x-show="isTermsValid" x-cloak class="inline-block h-3 w-3 align-middle text-success" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        </span>
                    </label>
                    @unless ($errors->has('agreed_terms'))
                        <p x-show="termsError" x-cloak x-text="termsError" class="mt-2 text-caption text-error"></p>
                    @endunless
                    @error('agreed_terms') <p class="mt-2 text-caption text-error">{{ $message }}</p> @enderror
                </div>

                <x-button variant="primary" type="submit" class="w-full">Tạo tài khoản</x-button>

                <p class="text-center text-caption">
                    Đã có tài khoản? <a href="{{ route('login') }}" class="text-text underline underline-offset-4 decoration-text/30 transition-colors hover:decoration-accent">Đăng nhập</a>
                </p>
            </form>
        </div>
    </div>
</section>

<script>
    function customerSignupValidation(initial) {
        const today = new Date();
        const maxDobYear = today.getFullYear() - 18;
        let initPickerYear = maxDobYear - 12;
        let initPickerMonth = 0;
        if (initial.dob) {
            const [y, m] = initial.dob.split('-').map(Number);
            if (y && m) { initPickerYear = y; initPickerMonth = m - 1; }
        }

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

            // DOB picker state
            dobPickerOpen: false,
            dobPickerYear: initPickerYear,
            dobPickerMonth: initPickerMonth,
            dobMonths: ['Tháng 1','Tháng 2','Tháng 3','Tháng 4','Tháng 5','Tháng 6','Tháng 7','Tháng 8','Tháng 9','Tháng 10','Tháng 11','Tháng 12'],

            get dobYears() {
                return Array.from({ length: 100 }, (_, i) => maxDobYear - i);
            },

            get dobCells() {
                const firstDay = new Date(this.dobPickerYear, this.dobPickerMonth, 1);
                const firstWeekday = (firstDay.getDay() + 6) % 7;
                const daysInMonth = new Date(this.dobPickerYear, this.dobPickerMonth + 1, 0).getDate();
                const cells = [];
                for (let i = 0; i < firstWeekday; i++) {
                    cells.push({ key: 'empty-' + i, day: null, selected: false });
                }
                const [selY, selM, selD] = this.dob
                    ? this.dob.split('-').map(Number)
                    : [null, null, null];
                for (let d = 1; d <= daysInMonth; d++) {
                    const isSelected = selY === this.dobPickerYear && (selM - 1) === this.dobPickerMonth && selD === d;
                    cells.push({ key: 'd-' + d, day: d, selected: isSelected });
                }
                return cells;
            },

            get dobDisplay() {
                if (!this.dob) return '';
                const [y, m, d] = this.dob.split('-');
                return `${d}/${m}/${y}`;
            },

            selectDobDay(d) {
                const m = String(this.dobPickerMonth + 1).padStart(2, '0');
                const dd = String(d).padStart(2, '0');
                this.dob = `${this.dobPickerYear}-${m}-${dd}`;
                this.touched.dob = true;
                this.dobPickerOpen = false;
            },

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
                if (trimmed.length === 0) return `Vui lòng nhập ${label}.`;
                if (trimmed.length < 2) return 'Vui lòng dùng ít nhất 2 ký tự.';
                return 'Vui lòng dùng không quá 20 ký tự.';
            },

            get firstNameError() {
                if (!this.touched.firstName || this.isFirstNameValid) return '';
                return this.nameError(this.firstName, 'tên');
            },
            get lastNameError() {
                if (!this.touched.lastName || this.isLastNameValid) return '';
                return this.nameError(this.lastName, 'họ');
            },
            get emailError() {
                if (!this.touched.email || this.isEmailValid) return '';
                if (this.email.length === 0) return 'Vui lòng nhập địa chỉ email.';
                return 'Vui lòng nhập địa chỉ email hợp lệ.';
            },
            get phoneError() {
                if (!this.touched.phone || this.isPhoneValid) return '';
                if (this.phone.length === 0) return 'Vui lòng nhập số điện thoại.';
                return 'Dùng 9 đến 15 chữ số, có thể kèm + - ( ) và khoảng trắng.';
            },
            get dobError() {
                if (!this.touched.dob || this.isDobValid) return '';
                if (!this.dob) return 'Vui lòng chọn ngày sinh.';
                const [y, m, d] = this.dob.split('-').map(Number);
                if (!y || !m || !d) return 'Vui lòng nhập ngày hợp lệ.';
                const dob = new Date(y, m - 1, d);
                const today = new Date();
                if (dob > today) return "Ngày sinh không thể ở tương lai.";
                return 'Bạn phải đủ 18 tuổi để tạo tài khoản.';
            },
            get genderError() {
                if (!this.touched.gender || this.isGenderValid) return '';
                return 'Vui lòng chọn một tùy chọn.';
            },
            get passwordError() {
                if (!this.touched.password || this.isPasswordValid) return '';
                if (this.password.length === 0) return 'Vui lòng nhập mật khẩu.';
                if (this.password.length < 8) return 'Dùng ít nhất 8 ký tự.';
                if (!/[a-zA-Z]/.test(this.password)) return 'Phải có ít nhất một chữ cái.';
                if (!/\d/.test(this.password)) return 'Phải có ít nhất một chữ số.';
                return '';
            },
            get passwordConfirmError() {
                if (!this.touched.passwordConfirm || this.isPasswordConfirmValid) return '';
                if (this.passwordConfirm.length === 0) return 'Vui lòng xác nhận mật khẩu.';
                return "Mật khẩu không khớp.";
            },
            get termsError() {
                if (!this.touched.termsAgreed || this.isTermsValid) return '';
                return 'Vui lòng đồng ý với Điều khoản và Chính sách quyền riêng tư.';
            },
        };
    }
</script>
@endsection
