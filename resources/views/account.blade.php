@extends('layouts.app', ['title' => 'Tài khoản · LegalEase'])

@php
    $user = auth()->user();
    $fullName = trim($user->name ?? '');
    $tokens = array_values(array_filter(preg_split('/\s+/', $fullName)));

    // Vietnamese name convention: family name (Họ) first, given name (Tên) last.
    $familyName = $tokens[0] ?? '';
    $givenName = count($tokens) > 1 ? implode(' ', array_slice($tokens, 1)) : '';

    $initials = mb_strtoupper(
        mb_substr($tokens[0] ?? '?', 0, 1) . mb_substr($tokens[count($tokens) - 1] ?? '', 0, 1)
    );
@endphp

@section('content')
    <section class="container-narrow pt-24 pb-24">
        {{-- Header --}}
        <h1 class="text-page-h1">Quản lý tài khoản của bạn.</h1>
        <p class="text-body-prose mt-6 max-w-[560px]">
            Cập nhật thông tin cá nhân, đổi mật khẩu và quản lý cách chúng tôi liên hệ với bạn.
        </p>

        {{-- Personal information --}}
        <div class="mt-16 border-t border-text/15 pt-12">
            <div class="grid gap-8 lg:grid-cols-[1fr_2fr] lg:gap-16">
                <div>
                    <h2 class="text-section-h2">Thông tin cá nhân</h2>
                    <p class="text-body mt-4 text-text/70">
                        Đây là thông tin chúng tôi dùng để xác nhận đặt chỗ và liên hệ với bạn.
                    </p>
                </div>

                <form x-data="{
                          submitted: false,
                          avatarUrl: null,
                          avatarError: '',
                          handleAvatar(e) {
                              const file = e.target.files[0];
                              if (!file) return;
                              if (file.size > 2 * 1024 * 1024) {
                                  this.avatarError = 'Ảnh quá lớn. Tối đa 2 MB.';
                                  e.target.value = '';
                                  return;
                              }
                              this.avatarError = '';
                              this.avatarUrl = URL.createObjectURL(file);
                          },
                          clearAvatar() {
                              this.avatarUrl = null;
                              this.avatarError = '';
                              this.$refs.avatarInput.value = '';
                          },
                      }"
                      @submit.prevent="submitted = true; setTimeout(() => submitted = false, 4000)"
                      class="flex flex-col gap-5">
                    {{-- Avatar --}}
                    <div class="flex items-center gap-5">
                        <div class="relative flex h-20 w-20 flex-none items-center justify-center overflow-hidden rounded-full bg-accent/10">
                            <template x-if="avatarUrl">
                                <img :src="avatarUrl" alt="" class="absolute inset-0 h-full w-full object-cover">
                            </template>
                            <span class="text-card-h4 text-accent" x-show="!avatarUrl">{{ $initials }}</span>
                        </div>
                        <div class="min-w-0">
                            <input type="file" accept="image/jpeg,image/png" class="hidden"
                                   x-ref="avatarInput" @change="handleAvatar($event)">
                            <div class="flex flex-wrap items-center gap-x-4 gap-y-1">
                                <button type="button" @click="$refs.avatarInput.click()"
                                        class="text-link-action text-text transition-colors hover:text-gold">
                                    <span x-text="avatarUrl ? 'Đổi ảnh' : 'Tải ảnh đại diện'"></span>
                                </button>
                                <button type="button" x-show="avatarUrl" x-cloak @click="clearAvatar()"
                                        class="text-caption text-text/60 transition-colors hover:text-error">
                                    Xóa
                                </button>
                            </div>
                            <p class="text-form-hint mt-1 text-text/60">JPG hoặc PNG. Tối đa 2 MB.</p>
                            <p x-show="avatarError" x-cloak x-text="avatarError" class="text-form-hint mt-1 text-error"></p>
                        </div>
                    </div>

                    <div class="grid gap-5 sm:grid-cols-2">
                        <div>
                            <label for="first-name" class="mb-2 block text-caption">Tên <span class="text-gold">*</span></label>
                            <input id="first-name" name="first_name" type="text" required value="{{ $givenName }}"
                                   class="block w-full rounded-xl border border-text/20 bg-bg px-4 py-3 text-body text-text placeholder:text-text/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                        </div>
                        <div>
                            <label for="last-name" class="mb-2 block text-caption">Họ <span class="text-gold">*</span></label>
                            <input id="last-name" name="last_name" type="text" required value="{{ $familyName }}"
                                   class="block w-full rounded-xl border border-text/20 bg-bg px-4 py-3 text-body text-text placeholder:text-text/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                        </div>
                    </div>

                    <div>
                        <label for="account-email" class="mb-2 block text-caption">Email <span class="text-gold">*</span></label>
                        <input id="account-email" type="email" required value="{{ $user->email ?? '' }}"
                               class="block w-full rounded-xl border border-text/20 bg-bg px-4 py-3 text-body text-text placeholder:text-text/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                    </div>

                    <div>
                        <label for="account-phone" class="mb-2 block text-caption">Số điện thoại</label>
                        <input id="account-phone" type="tel" placeholder="+84 90 123 4567"
                               class="block w-full rounded-xl border border-text/20 bg-bg px-4 py-3 text-body text-text placeholder:text-text/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                    </div>

                    <div class="grid gap-5 sm:grid-cols-2">
                        <div x-data="dobPicker()" @keydown.escape.window="open = false" class="relative">
                            <label for="account-dob" class="mb-2 block text-caption">Ngày sinh</label>
                            <div class="relative" @click.outside="open = false">
                                <input id="account-dob" type="text" readonly
                                       :value="display"
                                       placeholder="DD/MM/YYYY"
                                       @click="open = !open"
                                       class="block w-full cursor-pointer rounded-xl border border-text/20 bg-bg px-4 py-3 pr-11 text-body text-text placeholder:text-text/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                                <button type="button"
                                        @click.stop="open = !open"
                                        :aria-expanded="open"
                                        aria-label="Mở lịch chọn ngày"
                                        class="absolute inset-y-0 right-0 flex w-11 items-center justify-center text-text/60 transition-colors hover:text-text">
                                    <x-icon name="calendar" :size="16" />
                                </button>

                                <div x-show="open" x-cloak
                                     x-transition:enter="transition ease-out duration-150"
                                     x-transition:enter-start="opacity-0 -translate-y-1"
                                     x-transition:enter-end="opacity-100 translate-y-0"
                                     class="absolute left-0 right-0 top-full z-30 mt-2 rounded-xl border border-text/15 bg-bg p-4 sm:right-auto sm:w-[320px]">
                                    <div class="flex gap-2">
                                        <div class="relative flex-1">
                                            <select x-model.number="month"
                                                    class="block w-full appearance-none rounded-lg border border-text/15 bg-bg px-3 py-2 pr-8 text-caption text-text focus:border-accent focus:outline-none">
                                                <template x-for="(name, i) in months" :key="i">
                                                    <option :value="i" x-text="name"></option>
                                                </template>
                                            </select>
                                            <span class="pointer-events-none absolute inset-y-0 right-2 flex items-center text-text/60">
                                                <x-icon name="chevron-down" :size="14" />
                                            </span>
                                        </div>
                                        <div class="relative flex-1">
                                            <select x-model.number="year"
                                                    class="block w-full appearance-none rounded-lg border border-text/15 bg-bg px-3 py-2 pr-8 text-caption text-text focus:border-accent focus:outline-none">
                                                <template x-for="y in years" :key="y">
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
                                        <template x-for="cell in cells" :key="cell.key">
                                            <button type="button"
                                                    :disabled="!cell.day"
                                                    @click="cell.day && selectDay(cell.day)"
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
                        </div>
                        <div>
                            <label for="account-gender" class="mb-2 block text-caption">Giới tính</label>
                            <div class="relative">
                                <select id="account-gender" name="gender"
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
                        </div>
                    </div>

                    <div class="mt-2 flex items-center gap-4">
                        <x-button variant="primary" type="submit">Lưu thay đổi</x-button>
                        <p x-show="submitted" x-cloak class="text-caption text-success">Đã lưu thông tin của bạn.</p>
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
                        Đổi mật khẩu định kỳ giúp bảo vệ tài khoản của bạn.
                    </p>
                </div>

                <form x-data="{ submitted: false }"
                      @submit.prevent="submitted = true; setTimeout(() => { submitted = false; $el.reset(); }, 4000)"
                      class="flex flex-col gap-5">
                    <div>
                        <label for="current-password" class="mb-2 block text-caption">Mật khẩu hiện tại <span class="text-gold">*</span></label>
                        <input id="current-password" type="password" required autocomplete="current-password"
                               class="block w-full rounded-xl border border-text/20 bg-bg px-4 py-3 text-body text-text focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                    </div>
                    <div>
                        <label for="new-password" class="mb-2 block text-caption">Mật khẩu mới <span class="text-gold">*</span></label>
                        <input id="new-password" type="password" required autocomplete="new-password"
                               class="block w-full rounded-xl border border-text/20 bg-bg px-4 py-3 text-body text-text focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                        <p class="text-form-hint mt-2 text-text/60">Tối thiểu 8 ký tự, gồm cả chữ và số.</p>
                    </div>
                    <div>
                        <label for="confirm-password" class="mb-2 block text-caption">Xác nhận mật khẩu mới <span class="text-gold">*</span></label>
                        <input id="confirm-password" type="password" required autocomplete="new-password"
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
                 prefs: { reminders: true, marketing: false, news: false },
                 submitted: false,
                 save() { this.submitted = true; setTimeout(() => this.submitted = false, 4000); }
             }">
            <div class="grid gap-8 lg:grid-cols-[1fr_2fr] lg:gap-16">
                <div>
                    <h2 class="text-section-h2">Thông báo</h2>
                    <p class="text-body mt-4 text-text/70">
                        Chọn loại thông báo bạn muốn nhận. Xác nhận đặt chỗ và biên lai luôn được gửi qua email.
                    </p>
                </div>

                <div class="flex flex-col gap-1">
                    {{-- Toggle: reminders --}}
                    <label class="flex items-start justify-between gap-6 border-b border-text/10 py-5 cursor-pointer">
                        <span class="min-w-0">
                            <span class="block text-body font-medium text-text">Nhắc lịch hẹn</span>
                            <span class="text-caption mt-1 block text-text/70">Email nhắc 24 giờ trước buổi tư vấn.</span>
                        </span>
                        <button type="button"
                                role="switch"
                                @click="prefs.reminders = !prefs.reminders"
                                :aria-checked="prefs.reminders"
                                :class="prefs.reminders ? 'bg-accent' : 'bg-text/20'"
                                class="relative inline-flex h-6 w-11 flex-none items-center rounded-full transition-colors">
                            <span :class="prefs.reminders ? 'translate-x-6' : 'translate-x-1'"
                                  class="inline-block h-4 w-4 transform rounded-full bg-bg transition-transform"></span>
                        </button>
                    </label>

                    {{-- Toggle: marketing --}}
                    <label class="flex items-start justify-between gap-6 border-b border-text/10 py-5 cursor-pointer">
                        <span class="min-w-0">
                            <span class="block text-body font-medium text-text">Khuyến mãi và ưu đãi</span>
                            <span class="text-caption mt-1 block text-text/70">Thỉnh thoảng gửi mã giảm giá và chương trình ưu đãi.</span>
                        </span>
                        <button type="button"
                                role="switch"
                                @click="prefs.marketing = !prefs.marketing"
                                :aria-checked="prefs.marketing"
                                :class="prefs.marketing ? 'bg-accent' : 'bg-text/20'"
                                class="relative inline-flex h-6 w-11 flex-none items-center rounded-full transition-colors">
                            <span :class="prefs.marketing ? 'translate-x-6' : 'translate-x-1'"
                                  class="inline-block h-4 w-4 transform rounded-full bg-bg transition-transform"></span>
                        </button>
                    </label>

                    {{-- Toggle: news --}}
                    <label class="flex items-start justify-between gap-6 py-5 cursor-pointer">
                        <span class="min-w-0">
                            <span class="block text-body font-medium text-text">Tin tức pháp lý</span>
                            <span class="text-caption mt-1 block text-text/70">Bản tin định kỳ về các thay đổi pháp luật.</span>
                        </span>
                        <button type="button"
                                role="switch"
                                @click="prefs.news = !prefs.news"
                                :aria-checked="prefs.news"
                                :class="prefs.news ? 'bg-accent' : 'bg-text/20'"
                                class="relative inline-flex h-6 w-11 flex-none items-center rounded-full transition-colors">
                            <span :class="prefs.news ? 'translate-x-6' : 'translate-x-1'"
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

    <script>
        function dobPicker() {
            const today = new Date();
            return {
                open: false,
                value: '', // YYYY-MM-DD
                year: today.getFullYear() - 30,
                month: 0, // 0-11

                months: ['Tháng 1','Tháng 2','Tháng 3','Tháng 4','Tháng 5','Tháng 6','Tháng 7','Tháng 8','Tháng 9','Tháng 10','Tháng 11','Tháng 12'],

                get years() {
                    const now = today.getFullYear();
                    return Array.from({ length: 100 }, (_, i) => now - i);
                },

                get cells() {
                    const firstDay = new Date(this.year, this.month, 1);
                    const firstWeekday = (firstDay.getDay() + 6) % 7; // Monday = 0
                    const daysInMonth = new Date(this.year, this.month + 1, 0).getDate();
                    const cells = [];
                    for (let i = 0; i < firstWeekday; i++) {
                        cells.push({ key: 'empty-' + i, day: null, selected: false });
                    }
                    const [selY, selM, selD] = this.value
                        ? this.value.split('-').map(Number)
                        : [null, null, null];
                    for (let d = 1; d <= daysInMonth; d++) {
                        const isSelected = selY === this.year && (selM - 1) === this.month && selD === d;
                        cells.push({ key: 'd-' + d, day: d, selected: isSelected });
                    }
                    return cells;
                },

                get display() {
                    if (!this.value) return '';
                    const [y, m, d] = this.value.split('-');
                    return `${d}/${m}/${y}`;
                },

                selectDay(d) {
                    const m = String(this.month + 1).padStart(2, '0');
                    const dd = String(d).padStart(2, '0');
                    this.value = `${this.year}-${m}-${dd}`;
                    this.open = false;
                },
            };
        }
    </script>
@endsection
