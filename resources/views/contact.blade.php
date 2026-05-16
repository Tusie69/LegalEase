@extends('layouts.app', ['title' => 'Liên hệ · LegalEase', 'navOverlay' => true])

@php
    $googleFormAction = 'https://docs.google.com/forms/d/e/1FAIpQLSfcyLPuKwSRDy66N2YknsI59_zAKKXaUbQ32y5blk-ITNIo0Q/formResponse';
@endphp

@section('content')
    {{-- Navy hero band: full-bleed, bleeds under transparent nav. Matches the lawyer page treatment for brand consistency. --}}
    <div class="-mt-18 bg-accent text-bg">
        <div class="container-page pt-32 pb-12">
            <nav class="text-caption">
                <a href="/" class="text-bg/70 transition-colors hover:text-bg">Trang chủ</a>
                <span class="px-1 text-bg/50">/</span>
                <span class="text-bg">Liên hệ</span>
            </nav>

            <div class="mt-6 max-w-[720px]">
                <h1 class="text-page-h1 text-bg">
                    Có chuyện gì, cứ nhắn chúng tôi.
                </h1>

                <p class="text-body-intro mt-6 max-w-[600px] text-bg/80">
                    Câu hỏi, đề xuất hợp tác hay góp ý, chúng tôi đọc mọi tin nhắn, từ người thật.
                </p>
            </div>
        </div>
        {{-- Gold hairline divider for editorial finish --}}
        <div aria-hidden="true" class="h-px bg-gold/30"></div>
    </div>

    {{-- Content below: light bg. pt matches the mt-24 between form and contact cards so the form has symmetric breathing room. --}}
    <section class="container-page pt-24 pb-24">
        {{-- Photo + form: unified split block --}}
        <div class="overflow-hidden rounded-2xl border border-text/15">
            <div class="grid lg:grid-cols-2">
                {{-- Photo --}}
                <div class="aspect-[4/5] overflow-hidden lg:aspect-auto lg:min-h-[640px]">
                    <x-responsive-img src="https://images.pexels.com/photos/8111826/pexels-photo-8111826.jpeg"
                                      alt=""
                                      sizes="(min-width: 1024px) 50vw, 100vw"
                                      :widths="[600, 900, 1200, 1600]"
                                      class="h-full w-full object-cover" />
                </div>

                {{-- Form --}}
                <form action="{{ $googleFormAction }}"
                      method="POST"
                      target="contact-iframe"
                      x-data="{ submitted: false }"
                      @submit="submitted = true; setTimeout(() => $el.reset(), 200)"
                      class="flex flex-col p-8 lg:p-12">

                    <h3 class="text-card-h3">Gửi tin nhắn cho chúng tôi</h3>

                    <div class="mt-6 flex flex-1 flex-col gap-5">
                        <div>
                            <label for="contact-name" class="mb-2 block text-caption">
                                Họ và tên <span class="text-gold">*</span>
                            </label>
                            <input id="contact-name"
                                   name="entry.460376957"
                                   type="text"
                                   required
                                   placeholder="Nguyễn Văn A"
                                   class="block w-full rounded-xl border border-text/15 bg-text/5 px-4 py-3.5 text-body text-text placeholder:text-text/60 transition-colors focus:border-accent focus:outline-none">
                        </div>

                        <div>
                            <label for="contact-email" class="mb-2 block text-caption">
                                Địa chỉ email <span class="text-gold">*</span>
                            </label>
                            <input id="contact-email"
                                   name="entry.1290116336"
                                   type="email"
                                   required
                                   placeholder="you@example.com"
                                   class="block w-full rounded-xl border border-text/15 bg-text/5 px-4 py-3.5 text-body text-text placeholder:text-text/60 transition-colors focus:border-accent focus:outline-none">
                        </div>

                        <div>
                            <label for="contact-subject" class="mb-2 block text-caption">
                                Chủ đề <span class="text-gold">*</span>
                            </label>
                            <div class="relative">
                                <select id="contact-subject"
                                        name="entry.1295568160"
                                        required
                                        class="block w-full appearance-none rounded-xl border border-text/15 bg-text/5 px-4 py-3.5 pr-11 text-body text-text transition-colors focus:border-accent focus:outline-none">
                                    <option value="Câu hỏi chung">Câu hỏi chung</option>
                                    <option value="Đăng ký làm luật sư">Đăng ký làm luật sư</option>
                                    <option value="Báo chí hoặc hợp tác">Báo chí hoặc hợp tác</option>
                                    <option value="Phản hồi hoặc đề xuất">Phản hồi hoặc đề xuất</option>
                                    <option value="Khác">Khác</option>
                                </select>
                                <span class="pointer-events-none absolute inset-y-0 right-4 flex items-center">
                                    <x-icon name="chevron-down" :size="16" />
                                </span>
                            </div>
                        </div>

                        <div class="flex min-h-0 flex-1 flex-col">
                            <label for="contact-message" class="mb-2 block text-caption">
                                Tin nhắn <span class="text-gold">*</span>
                            </label>
                            <textarea id="contact-message"
                                      name="entry.117483291"
                                      required
                                      placeholder="Hãy cho chúng tôi biết bạn cần gì."
                                      class="block w-full flex-1 min-h-[160px] resize-y rounded-xl border border-text/15 bg-text/5 px-4 py-3.5 text-body text-text placeholder:text-text/60 transition-colors focus:border-accent focus:outline-none"></textarea>
                        </div>

                        <x-button variant="primary" type="submit" class="w-full">
                            Gửi cho chúng tôi →
                        </x-button>

                        <p x-show="submitted" x-cloak class="text-caption text-success">
                            Cảm ơn. Chúng tôi sẽ liên hệ trong vòng 1-2 ngày làm việc.
                        </p>
                    </div>
                </form>
            </div>
        </div>

        {{-- Hidden iframe receives Google's redirect so the user stays on this page --}}
        <iframe name="contact-iframe" title="Form submission target" tabindex="-1" aria-hidden="true" class="hidden"></iframe>

        {{-- Contact cards --}}
        <div class="mt-24 grid gap-6 md:grid-cols-3">
            {{-- Office --}}
            <div class="relative overflow-hidden rounded-2xl">
                <x-responsive-img src="https://images.pexels.com/photos/29168215/pexels-photo-29168215.jpeg"
                                  alt=""
                                  sizes="(min-width: 768px) 33vw, 100vw"
                                  :widths="[400, 600, 900]"
                                  class="aspect-[4/3] w-full object-cover" />
                <div class="absolute inset-x-3 bottom-3 flex items-start gap-3 rounded-xl border border-text/15 bg-bg p-4">
                    <div class="flex h-10 w-10 flex-none items-center justify-center rounded-full bg-accent/10">
                        <x-icon name="map-pin" :size="18" class="text-accent" />
                    </div>
                    <div class="min-w-0">
                        <p class="text-eyebrow text-text/60">Văn phòng</p>
                        <address class="text-caption mt-1 not-italic text-text">
                            Tầng 8, Capital Tower<br>
                            109 Trần Hưng Đạo, Hà Nội
                        </address>
                    </div>
                </div>
            </div>

            {{-- Phone --}}
            <div class="relative overflow-hidden rounded-2xl">
                <x-responsive-img src="https://images.pexels.com/photos/30212568/pexels-photo-30212568.jpeg"
                                  alt=""
                                  sizes="(min-width: 768px) 33vw, 100vw"
                                  :widths="[400, 600, 900]"
                                  class="aspect-[4/3] w-full object-cover" />
                <div class="absolute inset-x-3 bottom-3 flex items-start gap-3 rounded-xl border border-text/15 bg-bg p-4">
                    <div class="flex h-10 w-10 flex-none items-center justify-center rounded-full bg-accent/10">
                        <x-icon name="phone" :size="18" class="text-accent" />
                    </div>
                    <div class="min-w-0">
                        <p class="text-eyebrow text-text/60">Điện thoại</p>
                        <p class="text-caption mt-1 text-text">
                            <a href="tel:+842473001234" class="transition-colors hover:text-text/60">+84 24 7300 1234</a>
                        </p>
                        <p class="text-caption mt-1 text-text/70">
                            T2 - T6, 9:00 - 18:00 ICT
                        </p>
                    </div>
                </div>
            </div>

            {{-- Email --}}
            <div class="relative overflow-hidden rounded-2xl">
                <x-responsive-img src="https://images.pexels.com/photos/34109327/pexels-photo-34109327.jpeg"
                                  alt=""
                                  sizes="(min-width: 768px) 33vw, 100vw"
                                  :widths="[400, 600, 900]"
                                  class="aspect-[4/3] w-full object-cover" />
                <div class="absolute inset-x-3 bottom-3 flex items-start gap-3 rounded-xl border border-text/15 bg-bg p-4">
                    <div class="flex h-10 w-10 flex-none items-center justify-center rounded-full bg-accent/10">
                        <x-icon name="mail" :size="18" class="text-accent" />
                    </div>
                    <div class="min-w-0">
                        <p class="text-eyebrow text-text/60">Email</p>
                        <p class="text-caption mt-1 truncate text-text">
                            <a href="mailto:hello@legalease.vn" class="transition-colors hover:text-text/60">hello@legalease.vn</a>
                        </p>
                        <p class="text-caption mt-1 truncate text-text">
                            <a href="mailto:lawyers@legalease.vn" class="transition-colors hover:text-text/60">lawyers@legalease.vn</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Reassurance --}}
        <p class="mt-16 text-center text-caption">
            Mọi tin nhắn đều được người thật đọc. Chúng tôi cố gắng phản hồi trong vòng một ngày làm việc.
        </p>
    </section>
@endsection
