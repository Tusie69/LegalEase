@extends('layouts.app', ['title' => 'Tài khoản · LegalEase'])

@php
    $user = auth()->user();
    $fullName = trim((string) ($user->name ?? ''));
    $tokens = array_values(array_filter(preg_split('/\s+/', $fullName)));
    $firstName = $tokens[0] ?? 'Dianne';
    $lastName = count($tokens) > 1 ? implode(' ', array_slice($tokens, 1)) : 'Russell';
    $initials = mb_strtoupper(
        mb_substr($tokens[0] ?? 'D', 0, 1) . mb_substr($tokens[count($tokens) - 1] ?? 'R', 0, 1)
    );
@endphp

@section('content')
    <section class="min-h-screen w-full bg-bg px-8 py-8 pt-24 pb-20 font-sans antialiased"
        x-data="accountPage()">
        <div class="grid w-full grid-cols-1 items-stretch gap-8 xl:grid-cols-12">
            <aside class="h-full rounded-2xl border border-text/20 bg-bg shadow-sm xl:col-span-3 xl:min-h-225">
                    <div class="flex items-center gap-2.5 border-b border-text/15 px-4 py-3.5">
                        <span class="inline-flex h-8 w-8 items-center justify-center overflow-hidden rounded-full border border-text/20 bg-accent/10 text-form-hint font-medium text-text">{{ $initials }}</span>
                        <p class="truncate text-body font-medium text-text/80">{{ $user->name ?? 'Dianne Russell' }}</p>
                    </div>

                    <div class="px-4 py-4">
                        <p class="text-caption mb-2.5 font-medium uppercase tracking-wide text-text/60">Tài khoản của bạn</p>
                        <nav class="space-y-1">
                            <a href="#" class="flex items-center gap-2.5 rounded-[9px] bg-text/10 px-2.5 py-1.5 text-body font-medium text-text">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-3.5 w-3.5 text-text/70"><circle cx="12" cy="8" r="4"></circle><path d="M4 20a8 8 0 0 1 16 0"></path></svg>
                                <span>Hồ sơ</span>
                            </a>
                            <a href="#" class="flex items-center gap-2.5 rounded-[9px] px-2.5 py-1.5 text-body font-medium text-text/80 transition hover:bg-text/5">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-3.5 w-3.5 text-text/70"><path d="M4 7h16M4 12h16M4 17h10"></path></svg>
                                <span>Tùy chọn</span>
                            </a>
                            <a href="#" class="flex items-center gap-2.5 rounded-[9px] px-2.5 py-1.5 text-body font-medium text-text/80 transition hover:bg-text/5">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-3.5 w-3.5 text-text/70"><path d="M15 17h5l-1.4-1.4A2 2 0 0 1 18 14.2V11a6 6 0 1 0-12 0v3.2c0 .5-.2 1-.6 1.4L4 17h5"></path><path d="M9 17a3 3 0 0 0 6 0"></path></svg>
                                <span>Thông báo</span>
                            </a>
                            <a href="#" class="flex items-center gap-2.5 rounded-[9px] px-2.5 py-1.5 text-body font-medium text-text/80 transition hover:bg-text/5">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-3.5 w-3.5 text-text/70"><path d="M8 6h8M8 12h8M8 18h8"></path><circle cx="5" cy="6" r="1"></circle><circle cx="5" cy="12" r="1"></circle><circle cx="5" cy="18" r="1"></circle></svg>
                                <span>Giới thiệu</span>
                            </a>
                            <a href="#" class="flex items-center gap-2.5 rounded-[9px] px-2.5 py-1.5 text-body font-medium text-text/80 transition hover:bg-text/5">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-3.5 w-3.5 text-text/70"><circle cx="12" cy="12" r="9"></circle><path d="m9 9 6 6M15 9l-6 6"></path></svg>
                                <span>Danh sách chặn</span>
                            </a>
                        </nav>

                        <p class="text-caption mb-2.5 mt-5 font-medium uppercase tracking-wide text-text/60">Không gian làm việc</p>
                        <nav class="space-y-1">
                            <a href="#" class="flex items-center gap-2.5 rounded-[9px] px-2.5 py-1.5 text-body font-medium text-text/80 transition hover:bg-text/5"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-3.5 w-3.5 text-text/70"><path d="M3 12h18M12 3v18"></path></svg><span>Chung</span></a>
                            <a href="#" class="flex items-center gap-2.5 rounded-[9px] px-2.5 py-1.5 text-body font-medium text-text/80 transition hover:bg-text/5"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-3.5 w-3.5 text-text/70"><path d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="10" cy="7" r="4"></circle><path d="M22 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg><span>Thành viên</span></a>
                            <a href="#" class="flex items-center gap-2.5 rounded-[9px] px-2.5 py-1.5 text-body font-medium text-text/80 transition hover:bg-text/5"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-3.5 w-3.5 text-text/70"><path d="M3 7h18M6 7V5h12v2M6 12h12M6 17h12"></path></svg><span>Nhóm</span></a>
                            <a href="#" class="flex items-center gap-2.5 rounded-[9px] px-2.5 py-1.5 text-body font-medium text-text/80 transition hover:bg-text/5"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-3.5 w-3.5 text-text/70"><rect x="7" y="2" width="10" height="20" rx="2"></rect><path d="M11 18h2"></path></svg><span>Số điện thoại</span></a>
                            <a href="#" class="flex items-center gap-2.5 rounded-[9px] px-2.5 py-1.5 text-body font-medium text-text/80 transition hover:bg-text/5"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-3.5 w-3.5 text-text/70"><path d="M13 2 3 14h8l-1 8 10-12h-8l1-8Z"></path></svg><span>Tích hợp</span></a>
                            <a href="#" class="flex items-center gap-2.5 rounded-[9px] px-2.5 py-1.5 text-body font-medium text-text/80 transition hover:bg-text/5"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-3.5 w-3.5 text-text/70"><path d="M3 9h18M7 4h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2Z"></path></svg><span>Gói và thanh toán</span></a>
                            <a href="#" class="flex items-center gap-2.5 rounded-[9px] px-2.5 py-1.5 text-body font-medium text-text/80 transition hover:bg-text/5"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-3.5 w-3.5 text-text/70"><path d="M4 6h16v12H4z"></path><path d="m4 10 8 4 8-4"></path></svg><span>Liên hệ</span></a>
                        </nav>
                    </div>
                </aside>

                <div class="flex h-full min-h-225 flex-col rounded-2xl border border-text/20 bg-bg p-8 shadow-sm xl:col-span-9">
                    <header class="border-b border-text/15 pb-4">
                        <h1 class="text-body-prose font-semibold text-text">Tài khoản</h1>
                    </header>

                    <form class="flex flex-1 flex-col" @submit.prevent>
                        <div class="border-b border-text/15 py-6">
                            <div class="w-full">
                            <div class="flex items-start gap-3">
                                <div class="relative h-12.5 w-12.5 overflow-hidden rounded-full border border-text/20 bg-accent/10">
                                    <template x-if="avatarUrl">
                                        <img :src="avatarUrl" alt="Avatar" class="h-full w-full object-cover">
                                    </template>
                                    <span x-show="!avatarUrl" class="flex h-full w-full items-center justify-center text-form-hint font-medium text-accent">{{ $initials }}</span>
                                </div>

                                <div class="min-w-0 flex-1">
                                    <p class="text-body-prose font-semibold text-text">Ảnh hồ sơ</p>
                                    <div class="mt-2 flex flex-wrap items-center gap-2">
                                        <input x-ref="avatarInput" type="file" class="hidden" accept="image/png,image/jpeg,image/gif" @change="handleAvatar($event)">
                                        <button type="button" @click="$refs.avatarInput.click()" style="background:#042340;box-shadow:0 8px 18px rgba(4,35,64,0.28)" class="inline-flex items-center gap-1 rounded-lg px-3 py-1.5 text-body font-medium text-white transition hover:opacity-95">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-3.5 w-3.5"><path d="M12 5v14M5 12h14"></path></svg>
                                            Tải ảnh lên
                                        </button>
                                        <button type="button" @click="clearAvatar()" style="border-color:#042340;background:#eef3f8;color:#042340" class="inline-flex rounded-lg border px-3 py-1.5 text-body font-medium transition hover:opacity-90">
                                            Xóa
                                        </button>
                                    </div>
                                    <p class="text-form-hint mt-2 text-text/60">Hỗ trợ PNG, JPEG và GIF dưới 10MB</p>
                                </div>
                            </div>

                            <div class="mt-5 grid w-full gap-4 lg:grid-cols-2">
                                <div>
                                    <label for="last_name" class="text-body mb-1 block font-medium text-text/80">Họ</label>
                                    <input id="last_name" type="text" value="{{ $lastName }}" class="h-10 w-full rounded-xl border border-text/20 bg-bg px-3 text-body text-text outline-none transition focus:border-accent focus:ring-1 focus:ring-accent/20">
                                </div>
                                <div>
                                    <label for="first_name" class="text-body mb-1 block font-medium text-text/80">Tên</label>
                                    <input id="first_name" type="text" value="{{ $firstName }}" class="h-10 w-full rounded-xl border border-text/20 bg-bg px-3 text-body text-text outline-none transition focus:border-accent focus:ring-1 focus:ring-accent/20">
                                </div>
                            </div>

                            <div class="mt-3">
                                <label for="email" class="text-body mb-1 block font-medium text-text/80">Địa chỉ Email</label>
                                <div class="grid w-full gap-2 lg:grid-cols-2">
                                    <input id="email" type="email" value="{{ $user->email ?? '' }}" class="h-10 w-full rounded-xl border border-text/20 bg-bg px-3 text-body text-text outline-none transition focus:border-accent focus:ring-1 focus:ring-accent/20">
                                    <div class="flex lg:justify-start">
                                        <button type="button" style="border-color:#042340;background:#042340;color:#ffffff;box-shadow:0 6px 16px rgba(4,35,64,0.25)" class="inline-flex h-10 shrink-0 items-center rounded-[10px] border px-3 text-body font-medium transition hover:opacity-90">Chỉnh sửa Email</button>
                                    </div>
                                </div>
                                <p class="text-form-hint mt-2 text-text/60">Dùng để đăng nhập vào tài khoản của bạn</p>
                            </div>
                            </div>
                        </div>

                        <div class="border-b border-text/15 py-6">
                            <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                                <div>
                                    <h2 class="text-body-prose font-semibold text-text">Mật khẩu</h2>
                                    <p class="text-caption mt-1.5 text-text/60">Đăng nhập bằng mật khẩu thay vì sử dụng mã đăng nhập tạm thời</p>
                                </div>
                                <button type="button" @click="passwordModalOpen = true" style="border-color:#042340;background:#042340;color:#ffffff;box-shadow:0 6px 16px rgba(4,35,64,0.25)" class="inline-flex h-10 items-center rounded-[10px] border px-4 text-body font-medium transition hover:opacity-90">
                                    Đổi mật khẩu
                                </button>
                            </div>
                        </div>

                        <div class="flex items-center justify-end gap-2.5 pt-6">
                            <button type="button" style="border-color:#042340;background:#ffffff;color:#042340" class="inline-flex h-10 items-center rounded-[10px] border px-6 text-body font-medium transition hover:opacity-90">
                                Hủy
                            </button>
                            <button type="submit" style="background:#042340;box-shadow:0 10px 22px rgba(4,35,64,0.28)" class="inline-flex h-10 items-center rounded-lg px-8 text-body font-medium text-white transition hover:opacity-95">
                                Lưu
                            </button>
                        </div>
                    </form>
                </div>
        </div>

        {{-- Change Password Modal --}}
        <div x-show="passwordModalOpen"
             x-cloak
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 flex items-center justify-center px-4"
             style="background:rgba(0,0,0,0.55);backdrop-filter:blur(3px)"
             @click.self="passwordModalOpen = false"
             @keydown.escape.window="passwordModalOpen = false">

            <div class="w-110 rounded-3xl border border-[#dbe5ff] bg-white shadow-[0_24px_64px_rgba(15,23,42,0.20)]">

                {{-- Modal header --}}
                <div class="flex items-start gap-3 border-b border-gray-100 px-6 py-5">
                    <div class="flex h-10 w-10 flex-none items-center justify-center rounded-full border border-gray-200 bg-gray-50 text-gray-500">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5">
                            <path d="M7 11V8a5 5 0 0 1 10 0v3"></path>
                            <rect x="5" y="11" width="14" height="10" rx="2"></rect>
                            <circle cx="12" cy="16" r="1" fill="currentColor" stroke="none"></circle>
                        </svg>
                    </div>
                    <div class="min-w-0 pt-0.5">
                        <h3 class="text-[15px] font-semibold leading-tight text-gray-900">Đổi mật khẩu</h3>
                        <p class="mt-1 text-[13px] leading-normal text-gray-500">Cập nhật mật khẩu để tăng cường bảo mật tài khoản.</p>
                    </div>
                </div>

                {{-- Modal body --}}
                <div class="space-y-4 px-6 py-5">

                    {{-- Current Password --}}
                    <div>
                        <label for="cp_current" class="mb-1.5 block text-[13px] font-medium text-gray-800">
                            Mật khẩu hiện tại<span class="text-[#4169e1]">*</span>
                        </label>
                        <div class="relative">
                            <input id="cp_current"
                                   :type="currentPasswordVisible ? 'text' : 'password'"
                                   placeholder="••••••••••"
                                   style="letter-spacing:0.18em"
                                   class="h-10 w-full rounded-xl border border-gray-200 bg-white px-3.5 pr-10 text-[14px] text-gray-900 outline-none placeholder:text-gray-300 transition focus:border-blue-400 focus:ring-2 focus:ring-blue-100">
                            <button type="button"
                                    @click="currentPasswordVisible = !currentPasswordVisible"
                                    class="absolute inset-y-0 right-0 flex w-10 items-center justify-center text-gray-400 transition hover:text-gray-600">
                                <svg x-show="!currentPasswordVisible" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5">
                                    <path d="M2 12s3.636-7 10-7 10 7 10 7-3.636 7-10 7-10-7-10-7Z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                <svg x-show="currentPasswordVisible" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5">
                                    <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"></path>
                                    <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"></path>
                                    <path d="M14.12 14.12a3 3 0 1 1-4.24-4.24"></path>
                                    <line x1="1" y1="1" x2="23" y2="23"></line>
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- New Password --}}
                    <div>
                        <label for="cp_new" class="mb-1.5 block text-[13px] font-medium text-gray-800">
                            Mật khẩu mới<span class="text-[#4169e1]">*</span>
                        </label>
                        <div class="relative">
                            <input id="cp_new"
                                   x-model="newPassword"
                                   :type="newPasswordVisible ? 'text' : 'password'"
                                   placeholder="••••••••••"
                                   style="letter-spacing:0.18em"
                                   class="h-10 w-full rounded-xl border border-gray-200 bg-white px-3.5 pr-10 text-[14px] text-gray-900 outline-none placeholder:text-gray-300 transition focus:border-blue-400 focus:ring-2 focus:ring-blue-100">
                            <button type="button"
                                    @click="newPasswordVisible = !newPasswordVisible"
                                    class="absolute inset-y-0 right-0 flex w-10 items-center justify-center text-gray-400 transition hover:text-gray-600">
                                <svg x-show="!newPasswordVisible" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5">
                                    <path d="M2 12s3.636-7 10-7 10 7 10 7-3.636 7-10 7-10-7-10-7Z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                <svg x-show="newPasswordVisible" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5">
                                    <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"></path>
                                    <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"></path>
                                    <path d="M14.12 14.12a3 3 0 1 1-4.24-4.24"></path>
                                    <line x1="1" y1="1" x2="23" y2="23"></line>
                                </svg>
                            </button>
                        </div>

                    </div>

                    {{-- Confirm New Password --}}
                    <div>
                        <div class="mb-1.5 flex items-center justify-between">
                            <label for="cp_confirm" class="text-[13px] font-medium text-gray-800">
                                Xác nhận mật khẩu mới<span class="text-[#4169e1]">*</span>
                            </label>
                            <button type="button" @click="confirmPassword = ''; $refs.cpConfirm.value = ''" style="color:#042340" class="text-[12px] font-medium transition hover:opacity-80">Xóa</button>
                        </div>
                        <div class="relative">
                            <input id="cp_confirm"
                                   x-ref="cpConfirm"
                                   x-model="confirmPassword"
                                   :type="confirmPasswordVisible ? 'text' : 'password'"
                                   placeholder="••••••••••"
                                   style="letter-spacing:0.18em"
                                   class="h-10 w-full rounded-xl border border-gray-200 bg-white px-3.5 pr-10 text-[14px] text-gray-900 outline-none placeholder:text-gray-300 transition focus:border-blue-400 focus:ring-2 focus:ring-blue-100">
                            <button type="button"
                                    @click="confirmPasswordVisible = !confirmPasswordVisible"
                                    class="absolute inset-y-0 right-0 flex w-10 items-center justify-center text-gray-400 transition hover:text-gray-600">
                                <svg x-show="!confirmPasswordVisible" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5">
                                    <path d="M2 12s3.636-7 10-7 10 7 10 7-3.636 7-10 7-10-7-10-7Z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                                <svg x-show="confirmPasswordVisible" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5">
                                    <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"></path>
                                    <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"></path>
                                    <path d="M14.12 14.12a3 3 0 1 1-4.24-4.24"></path>
                                    <line x1="1" y1="1" x2="23" y2="23"></line>
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Password strength & checklist (below Confirm Password) --}}
                    <div>
                        <div class="flex gap-1">
                            <span class="h-1.5 flex-1 rounded-full transition-colors" :style="passwordScore >= 1 ? 'background-color:#ef4444' : 'background-color:#e5e7eb'"></span>
                            <span class="h-1.5 flex-1 rounded-full transition-colors" :style="passwordScore >= 2 ? 'background-color:#ef4444' : 'background-color:#e5e7eb'"></span>
                            <span class="h-1.5 flex-1 rounded-full transition-colors" :style="passwordScore >= 3 ? 'background-color:#ef4444' : 'background-color:#e5e7eb'"></span>
                        </div>
                        <p class="mt-1.5 text-[12px] text-gray-500">
                            <span x-text="passwordScore === 3 ? 'Mật khẩu mạnh' : (passwordScore === 2 ? 'Mật khẩu trung bình' : 'Mật khẩu yếu')"></span>. Phải chứa:
                        </p>
                        <ul class="mt-1.5 space-y-1">
                            <li class="flex items-center gap-2 text-[12px] text-gray-600">
                                <template x-if="passwordHasUppercase">
                                    <span class="inline-flex h-4 w-4 flex-none items-center justify-center rounded-full bg-emerald-100 text-emerald-500">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="h-2.5 w-2.5"><path d="M20 6 9 17l-5-5"></path></svg>
                                    </span>
                                </template>
                                <template x-if="!passwordHasUppercase">
                                    <span class="inline-flex h-4 w-4 flex-none items-center justify-center rounded-full border border-gray-300 text-gray-400">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="h-2.5 w-2.5"><path d="M6 6l12 12"></path><path d="M18 6 6 18"></path></svg>
                                    </span>
                                </template>
                                Ít nhất 1 chữ hoa
                            </li>
                            <li class="flex items-center gap-2 text-[12px] text-gray-500">
                                <template x-if="passwordHasNumber">
                                    <span class="inline-flex h-4 w-4 flex-none items-center justify-center rounded-full bg-emerald-100 text-emerald-500">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="h-2.5 w-2.5"><path d="M20 6 9 17l-5-5"></path></svg>
                                    </span>
                                </template>
                                <template x-if="!passwordHasNumber">
                                    <span class="inline-flex h-4 w-4 flex-none items-center justify-center rounded-full border border-gray-300 text-gray-400">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="h-2.5 w-2.5"><path d="M6 6l12 12"></path><path d="M18 6 6 18"></path></svg>
                                    </span>
                                </template>
                                Ít nhất 1 chữ số
                            </li>
                            <li class="flex items-center gap-2 text-[12px] text-gray-500">
                                <template x-if="passwordHasMinLength">
                                    <span class="inline-flex h-4 w-4 flex-none items-center justify-center rounded-full bg-emerald-100 text-emerald-500">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="h-2.5 w-2.5"><path d="M20 6 9 17l-5-5"></path></svg>
                                    </span>
                                </template>
                                <template x-if="!passwordHasMinLength">
                                    <span class="inline-flex h-4 w-4 flex-none items-center justify-center rounded-full border border-gray-300 text-gray-400">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="h-2.5 w-2.5"><path d="M6 6l12 12"></path><path d="M18 6 6 18"></path></svg>
                                    </span>
                                </template>
                                Ít nhất 8 ký tự
                            </li>
                        </ul>
                    </div>

                </div>

                {{-- Modal footer --}}
                <div class="flex items-center gap-3 border-t border-gray-100 px-6 py-4">
                    <button type="button"
                            @click="passwordModalOpen = false"
                            style="flex:1;border-color:#042340;background:#ffffff;color:#042340"
                            class="flex h-10 items-center justify-center rounded-xl border text-[14px] font-medium transition hover:opacity-90">
                        Hủy bỏ
                    </button>
                    <button type="button"
                            style="flex:1;background:#042340;box-shadow:0 4px 14px rgba(4,35,64,0.35)"
                            class="flex h-10 items-center justify-center rounded-xl text-[14px] font-medium text-white transition hover:opacity-90">
                        Áp dụng
                    </button>
                </div>

            </div>
        </div>

        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('accountPage', () => ({
                    avatarUrl: null,
                    passwordModalOpen: false,
                    currentPasswordVisible: false,
                    newPasswordVisible: false,
                    confirmPasswordVisible: false,
                    newPassword: '',
                    confirmPassword: '',
                    handleAvatar(e) {
                        const file = e.target.files[0];
                        if (!file) return;
                        this.avatarUrl = URL.createObjectURL(file);
                    },
                    clearAvatar() {
                        this.avatarUrl = null;
                        this.$refs.avatarInput.value = '';
                    },
                    get passwordHasUppercase() {
                        return /[A-Z]/.test(this.newPassword);
                    },
                    get passwordHasNumber() {
                        return /\d/.test(this.newPassword);
                    },
                    get passwordHasMinLength() {
                        return this.newPassword.length >= 8;
                    },
                    get passwordScore() {
                        return [this.passwordHasUppercase, this.passwordHasNumber, this.passwordHasMinLength].filter(Boolean).length;
                    },
                }));
            });
        </script>
    </section>
@endsection
