@extends('layouts.app', ['title' => 'Hồ sơ luật sư · LegalEase'])

@php
    $user = auth()->user();

    // Demo prototype: use the first verified lawyer as the authed lawyer's listing.
    $lawyer = \App\Data\Lawyers::all()[0];

    $fullName = trim($user->name ?? $lawyer['name']);
    $tokens = array_values(array_filter(preg_split('/\s+/', $fullName)));
    $familyName = $tokens[0] ?? '';
    $givenName = count($tokens) > 1 ? implode(' ', array_slice($tokens, 1)) : '';

    $initials = mb_strtoupper(
        mb_substr($tokens[0] ?? '?', 0, 1) . mb_substr($tokens[count($tokens) - 1] ?? '', 0, 1)
    );

    $allSpecialties = [
        'Bào chữa hình sự',
        'Bất động sản',
        'Luật Doanh nghiệp',
        'Luật Hôn nhân & Gia đình',
        'Luật Lao động',
        'Tố tụng dân sự',
    ];

    $allLanguages = ['Tiếng Việt', 'Tiếng Anh'];

    $provinces = ['Hà Nội', 'TP.HCM', 'Đà Nẵng', 'Hải Phòng', 'Cần Thơ', 'Bình Dương', 'Đồng Nai'];

    $tagsForJs = $lawyer['specialty_tags'] ?? [];
@endphp

@section('content')
<section class="container-narrow pt-24 pb-24">
    {{-- Header --}}
    <h1 class="text-page-h1">Hồ sơ của bạn.</h1>
    <p class="text-body-prose mt-6 max-w-[560px]">
        Cập nhật những gì khách hàng tiềm năng nhìn thấy trên LegalEase, đổi mật khẩu và quản lý thông báo.
    </p>

    <p class="mt-6">
        <a href="{{ route('lawyers.show', $lawyer['slug']) }}" target="_blank"
           class="text-link-action text-text transition-colors hover:text-gold">
            Xem hồ sơ công khai →
        </a>
    </p>

    {{-- Public profile --}}
    <div class="mt-16 border-t border-text/15 pt-12">
        <div class="grid gap-8 lg:grid-cols-[1fr_2fr] lg:gap-16">
            <div>
                <h2 class="text-section-h2">Hồ sơ công khai</h2>
                <p class="text-body mt-4 text-text/70">
                    Khách hàng đánh giá luật sư qua những gì bạn chia sẻ ở đây. Hồ sơ đầy đủ thu hút nhiều đặt lịch hơn.
                </p>
                <p class="text-form-hint mt-6 text-text/60">
                    Các trường có dấu <span class="text-gold">*</span> là bắt buộc.
                </p>
            </div>

            <form x-data="{
                      submitted: false,
                      portraitUrl: '{{ $lawyer['portrait_url'] }}',
                      portraitError: '',
                      specialtyTags: {{ \Illuminate\Support\Js::from($tagsForJs) }},
                      handlePortrait(e) {
                          const file = e.target.files[0];
                          if (!file) return;
                          if (file.size > 4 * 1024 * 1024) {
                              this.portraitError = 'Ảnh quá lớn. Tối đa 4 MB.';
                              e.target.value = '';
                              return;
                          }
                          this.portraitError = '';
                          this.portraitUrl = URL.createObjectURL(file);
                      },
                      clearPortrait() {
                          this.portraitUrl = null;
                          this.portraitError = '';
                          this.$refs.portraitInput.value = '';
                      },
                  }"
                  @submit.prevent="submitted = true; setTimeout(() => submitted = false, 4000)"
                  class="flex flex-col gap-6">
                {{-- Portrait --}}
                <div class="flex items-start gap-6">
                    <div class="relative flex h-28 w-28 flex-none items-center justify-center overflow-hidden rounded-2xl bg-accent/10">
                        <template x-if="portraitUrl">
                            <img :src="portraitUrl" alt="" class="absolute inset-0 h-full w-full object-cover object-top">
                        </template>
                        <span class="text-card-h3 text-accent" x-show="!portraitUrl">{{ $initials }}</span>
                    </div>
                    <div class="min-w-0 pt-1">
                        <p class="text-eyebrow">Ảnh đại diện</p>
                        <input type="file" accept="image/jpeg,image/png" class="hidden"
                               x-ref="portraitInput" @change="handlePortrait($event)">
                        <div class="mt-3 flex flex-wrap items-center gap-x-4 gap-y-1">
                            <button type="button" @click="$refs.portraitInput.click()"
                                    class="text-link-action text-text transition-colors hover:text-gold">
                                <span x-text="portraitUrl ? 'Đổi ảnh' : 'Tải ảnh chân dung'"></span>
                            </button>
                            <button type="button" x-show="portraitUrl" x-cloak @click="clearPortrait()"
                                    class="text-caption text-text/60 transition-colors hover:text-error">
                                Xóa
                            </button>
                        </div>
                        <p class="text-form-hint mt-2 text-text/60">
                            Ảnh chân dung dọc, JPG hoặc PNG. Tối thiểu 800 × 1000 px, tối đa 4 MB.
                        </p>
                        <p x-show="portraitError" x-cloak x-text="portraitError" class="text-form-hint mt-1 text-error"></p>
                    </div>
                </div>

                {{-- Name --}}
                <div class="grid gap-5 sm:grid-cols-2">
                    <div>
                        <label for="lawyer-first-name" class="mb-2 block text-caption">Tên <span class="text-gold">*</span></label>
                        <input id="lawyer-first-name" name="first_name" type="text" required value="{{ $givenName }}"
                               class="block w-full rounded-xl border border-text/20 bg-bg px-4 py-3 text-body text-text placeholder:text-text/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                    </div>
                    <div>
                        <label for="lawyer-last-name" class="mb-2 block text-caption">Họ <span class="text-gold">*</span></label>
                        <input id="lawyer-last-name" name="last_name" type="text" required value="{{ $familyName }}"
                               class="block w-full rounded-xl border border-text/20 bg-bg px-4 py-3 text-body text-text placeholder:text-text/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                    </div>
                </div>

                {{-- Contact --}}
                <div class="grid gap-5 sm:grid-cols-2">
                    <div>
                        <label for="lawyer-email" class="mb-2 block text-caption">Email <span class="text-gold">*</span></label>
                        <input id="lawyer-email" type="email" required value="{{ $user->email ?? '' }}"
                               class="block w-full rounded-xl border border-text/20 bg-bg px-4 py-3 text-body text-text placeholder:text-text/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                    </div>
                    <div>
                        <label for="lawyer-phone" class="mb-2 block text-caption">Số điện thoại</label>
                        <input id="lawyer-phone" type="tel" placeholder="+84 90 123 4567"
                               class="block w-full rounded-xl border border-text/20 bg-bg px-4 py-3 text-body text-text placeholder:text-text/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                    </div>
                </div>

                {{-- Specialties --}}
                <div>
                    <p class="mb-3 block text-caption">Chuyên môn <span class="text-gold">*</span></p>
                    <div class="grid grid-cols-1 gap-2 sm:grid-cols-2">
                        @foreach ($allSpecialties as $spec)
                            <label class="flex items-center gap-3 text-caption text-text">
                                <input type="checkbox" name="specialties[]" value="{{ $spec }}" x-model="specialtyTags" class="custom-check">
                                <span>{{ $spec }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- Languages --}}
                <div>
                    <p class="mb-2 block text-caption">Ngôn ngữ tư vấn <span class="text-gold">*</span></p>
                    <div class="grid grid-cols-2 gap-2">
                        @foreach ($allLanguages as $lang)
                            <label class="flex items-center gap-3 text-caption text-text">
                                <input type="checkbox" name="languages[]" value="{{ $lang }}"
                                       @checked(in_array($lang, $lawyer['languages']))
                                       class="custom-check">
                                <span>{{ $lang }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                {{-- Bar + experience --}}
                <div class="grid gap-5 sm:grid-cols-2">
                    <div>
                        <label for="lawyer-bar" class="mb-2 block text-caption">Đoàn luật sư <span class="text-gold">*</span></label>
                        <input id="lawyer-bar" type="text" required value="{{ $lawyer['bar_association'] }}"
                               class="block w-full rounded-xl border border-text/20 bg-bg px-4 py-3 text-body text-text placeholder:text-text/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                    </div>
                    <div>
                        <label for="lawyer-experience" class="mb-2 block text-caption">Số năm kinh nghiệm</label>
                        <input id="lawyer-experience" type="number" min="0" max="60" value="{{ $lawyer['years_of_experience'] }}"
                               class="block w-full rounded-xl border border-text/20 bg-bg px-4 py-3 text-body text-text focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                    </div>
                </div>

                {{-- Fee --}}
                <div>
                    <label for="lawyer-fee" class="mb-2 block text-caption">Phí tư vấn mỗi giờ (VND) <span class="text-gold">*</span></label>
                    <input id="lawyer-fee" type="number" min="0" step="50000" required value="{{ $lawyer['price_per_hour'] }}"
                           class="block w-full rounded-xl border border-text/20 bg-bg px-4 py-3 text-body text-text focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                    <p class="text-form-hint mt-2 text-text/60">
                        Giá trung bình cho luật sư cùng chuyên môn dao động từ 1.200.000 đến 2.500.000 VND.
                    </p>
                </div>

                {{-- Address --}}
                <div class="grid gap-5 sm:grid-cols-[200px_1fr]">
                    <div>
                        <label for="lawyer-province" class="mb-2 block text-caption">Tỉnh / Thành phố <span class="text-gold">*</span></label>
                        <div class="relative">
                            <select id="lawyer-province" name="province" required
                                    class="block w-full appearance-none rounded-xl border border-text/20 bg-bg px-4 py-3 pr-11 text-body text-text focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                                @foreach ($provinces as $p)
                                    <option value="{{ $p }}" @selected($p === ($lawyer['address']['province'] ?? ''))>{{ $p }}</option>
                                @endforeach
                            </select>
                            <span class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-text/60">
                                <x-icon name="chevron-down" :size="16" />
                            </span>
                        </div>
                    </div>
                    <div>
                        <label for="lawyer-street" class="mb-2 block text-caption">Địa chỉ văn phòng <span class="text-gold">*</span></label>
                        <input id="lawyer-street" name="street_address" type="text" required
                               value="{{ $lawyer['address']['street_address'] ?? '' }}"
                               class="block w-full rounded-xl border border-text/20 bg-bg px-4 py-3 text-body text-text placeholder:text-text/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                    </div>
                </div>

                {{-- Bio --}}
                <div>
                    <label for="lawyer-bio" class="mb-2 block text-caption">Giới thiệu bản thân <span class="text-gold">*</span></label>
                    <textarea id="lawyer-bio" name="bio" rows="8" required
                              placeholder="Hành trình, lĩnh vực bạn đam mê và cách bạn làm việc với khách hàng."
                              class="block w-full resize-y rounded-xl border border-text/20 bg-bg px-4 py-3 text-body text-text placeholder:text-text/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">{{ implode("\n\n", $lawyer['bio'] ?? []) }}</textarea>
                    <p class="text-form-hint mt-2 text-text/60">
                        Để khoảng trắng một dòng giữa các đoạn. Khoảng 150 đến 300 từ thường vừa đẹp.
                    </p>
                </div>

                <div class="mt-2 flex items-center gap-4">
                    <x-button variant="primary" type="submit">Lưu thay đổi</x-button>
                    <p x-show="submitted" x-cloak class="text-caption text-success">Đã cập nhật hồ sơ.</p>
                </div>
            </form>
        </div>
    </div>

    {{-- Password --}}
    <div class="mt-16 border-t border-text/15 pt-12">
        <div class="grid gap-8 lg:grid-cols-[1fr_2fr] lg:gap-16">
            <div>
                <h2 class="text-section-h2">Mật khẩu</h2>
                <p class="text-body mt-4 text-text/70">
                    Đổi mật khẩu định kỳ giúp bảo vệ tài khoản hành nghề của bạn.
                </p>
            </div>

            <form x-data="{ submitted: false }"
                  @submit.prevent="submitted = true; setTimeout(() => { submitted = false; $el.reset(); }, 4000)"
                  class="flex flex-col gap-5">
                <div>
                    <label for="lawyer-current-password" class="mb-2 block text-caption">Mật khẩu hiện tại <span class="text-gold">*</span></label>
                    <input id="lawyer-current-password" type="password" required autocomplete="current-password"
                           class="block w-full rounded-xl border border-text/20 bg-bg px-4 py-3 text-body text-text focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                </div>
                <div>
                    <label for="lawyer-new-password" class="mb-2 block text-caption">Mật khẩu mới <span class="text-gold">*</span></label>
                    <input id="lawyer-new-password" type="password" required autocomplete="new-password"
                           class="block w-full rounded-xl border border-text/20 bg-bg px-4 py-3 text-body text-text focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                    <p class="text-form-hint mt-2 text-text/60">Tối thiểu 8 ký tự, gồm cả chữ và số.</p>
                </div>
                <div>
                    <label for="lawyer-confirm-password" class="mb-2 block text-caption">Xác nhận mật khẩu mới <span class="text-gold">*</span></label>
                    <input id="lawyer-confirm-password" type="password" required autocomplete="new-password"
                           class="block w-full rounded-xl border border-text/20 bg-bg px-4 py-3 text-body text-text focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                </div>

                <div class="mt-2 flex items-center gap-4">
                    <x-button variant="secondary" type="submit">Cập nhật mật khẩu</x-button>
                    <p x-show="submitted" x-cloak class="text-caption text-success">Đã cập nhật mật khẩu.</p>
                </div>
            </form>
        </div>
    </div>

    {{-- Notifications --}}
    <div class="mt-16 border-t border-text/15 pt-12"
         x-data="{
             prefs: { booking: true, cancellation: true, review: true, newsletter: false },
             submitted: false,
             save() { this.submitted = true; setTimeout(() => this.submitted = false, 4000); }
         }">
        <div class="grid gap-8 lg:grid-cols-[1fr_2fr] lg:gap-16">
            <div>
                <h2 class="text-section-h2">Thông báo</h2>
                <p class="text-body mt-4 text-text/70">
                    Chọn cách LegalEase báo cho bạn về hoạt động liên quan đến hồ sơ. Email xác nhận đặt lịch và biên lai luôn được gửi.
                </p>
            </div>

            <div class="flex flex-col gap-1">
                {{-- New booking --}}
                <label class="flex cursor-pointer items-start justify-between gap-6 border-b border-text/10 py-5">
                    <span class="min-w-0">
                        <span class="block text-body font-medium text-text">Đặt lịch mới</span>
                        <span class="text-caption mt-1 block text-text/70">Thông báo khi khách hàng đặt buổi tư vấn với bạn.</span>
                    </span>
                    <button type="button"
                            role="switch"
                            @click="prefs.booking = !prefs.booking"
                            :aria-checked="prefs.booking"
                            :class="prefs.booking ? 'bg-accent' : 'bg-text/20'"
                            class="relative inline-flex h-6 w-11 flex-none items-center rounded-full transition-colors">
                        <span :class="prefs.booking ? 'translate-x-6' : 'translate-x-1'"
                              class="inline-block h-4 w-4 transform rounded-full bg-bg transition-transform"></span>
                    </button>
                </label>

                {{-- Cancellation --}}
                <label class="flex cursor-pointer items-start justify-between gap-6 border-b border-text/10 py-5">
                    <span class="min-w-0">
                        <span class="block text-body font-medium text-text">Hủy lịch</span>
                        <span class="text-caption mt-1 block text-text/70">Khi khách hàng hủy hoặc dời cuộc hẹn đã xác nhận.</span>
                    </span>
                    <button type="button"
                            role="switch"
                            @click="prefs.cancellation = !prefs.cancellation"
                            :aria-checked="prefs.cancellation"
                            :class="prefs.cancellation ? 'bg-accent' : 'bg-text/20'"
                            class="relative inline-flex h-6 w-11 flex-none items-center rounded-full transition-colors">
                        <span :class="prefs.cancellation ? 'translate-x-6' : 'translate-x-1'"
                              class="inline-block h-4 w-4 transform rounded-full bg-bg transition-transform"></span>
                    </button>
                </label>

                {{-- Reviews --}}
                <label class="flex cursor-pointer items-start justify-between gap-6 border-b border-text/10 py-5">
                    <span class="min-w-0">
                        <span class="block text-body font-medium text-text">Đánh giá mới</span>
                        <span class="text-caption mt-1 block text-text/70">Khi khách hàng để lại đánh giá sau buổi tư vấn.</span>
                    </span>
                    <button type="button"
                            role="switch"
                            @click="prefs.review = !prefs.review"
                            :aria-checked="prefs.review"
                            :class="prefs.review ? 'bg-accent' : 'bg-text/20'"
                            class="relative inline-flex h-6 w-11 flex-none items-center rounded-full transition-colors">
                        <span :class="prefs.review ? 'translate-x-6' : 'translate-x-1'"
                              class="inline-block h-4 w-4 transform rounded-full bg-bg transition-transform"></span>
                    </button>
                </label>

                {{-- Newsletter --}}
                <label class="flex cursor-pointer items-start justify-between gap-6 py-5">
                    <span class="min-w-0">
                        <span class="block text-body font-medium text-text">Bản tin dành cho luật sư</span>
                        <span class="text-caption mt-1 block text-text/70">Cập nhật hàng tháng về nền tảng, tài nguyên và xu hướng ngành.</span>
                    </span>
                    <button type="button"
                            role="switch"
                            @click="prefs.newsletter = !prefs.newsletter"
                            :aria-checked="prefs.newsletter"
                            :class="prefs.newsletter ? 'bg-accent' : 'bg-text/20'"
                            class="relative inline-flex h-6 w-11 flex-none items-center rounded-full transition-colors">
                        <span :class="prefs.newsletter ? 'translate-x-6' : 'translate-x-1'"
                              class="inline-block h-4 w-4 transform rounded-full bg-bg transition-transform"></span>
                    </button>
                </label>

                <div class="mt-6 flex items-center gap-4">
                    <x-button variant="secondary" type="button" @click="save()">Lưu tùy chọn</x-button>
                    <p x-show="submitted" x-cloak class="text-caption text-success">Đã lưu tùy chọn thông báo.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
