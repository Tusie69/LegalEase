@extends('layouts.app', ['title' => 'Contact · LegalEase'])

@section('content')
    {{-- Hero --}}
    <section class="mx-auto flex min-h-[320px] max-w-[1280px] items-center px-8 py-20">
        <div class="max-w-[720px]">
            <p class="animate-fade-up text-[12px] font-medium uppercase tracking-[0.1em] text-muted"
               style="animation-delay: 0ms">
                Get in touch
            </p>

            <h1 class="animate-fade-up mt-6 font-display text-[48px] font-medium leading-[1.05] tracking-[-0.02em] md:text-[60px]"
                style="animation-delay: 100ms">
                We're here when you need us.
            </h1>

            <p class="animate-fade-up mt-6 max-w-[600px] text-[18px] leading-relaxed text-secondary"
               style="animation-delay: 200ms">
                Whether you have a question about the platform, a partnership inquiry, or feedback we should hear, we read every message.
            </p>
        </div>
    </section>

    {{-- Contact details (left column — form will be added in next step) --}}
    <section class="mx-auto max-w-[1280px] px-8 py-20">
        <div class="grid gap-16 md:grid-cols-[2fr_3fr]">
            <div class="space-y-10">
                {{-- Email --}}
                <div>
                    <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Email</p>
                    <ul class="mt-3 space-y-1 text-[15px] text-text">
                        <li>General inquiries: <a href="mailto:hello@legalease.vn" class="transition-colors hover:text-accent">hello@legalease.vn</a></li>
                        <li>Lawyer applications: <a href="mailto:lawyers@legalease.vn" class="transition-colors hover:text-accent">lawyers@legalease.vn</a></li>
                    </ul>
                </div>

                {{-- Phone --}}
                <div>
                    <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Phone</p>
                    <ul class="mt-3 space-y-1 text-[15px] text-text">
                        <li>Customer support: <a href="tel:+842473001234" class="transition-colors hover:text-accent">+84 24 7300 1234</a></li>
                        <li class="text-muted">Hours: Monday — Friday, 9:00 AM — 6:00 PM ICT</li>
                    </ul>
                </div>

                {{-- Office --}}
                <div>
                    <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Office</p>
                    <address class="mt-3 not-italic text-[15px] text-text">
                        Tầng 8, Tòa nhà Capital Tower<br>
                        109 Trần Hưng Đạo, Hoàn Kiếm<br>
                        Hà Nội, Việt Nam
                    </address>
                </div>

                {{-- Social --}}
                <div>
                    <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Follow</p>
                    <p class="mt-3 text-[15px] text-text">
                        <a href="#" class="transition-colors hover:text-accent">LinkedIn</a>
                        <span class="mx-2 text-muted">·</span>
                        <a href="#" class="transition-colors hover:text-accent">Facebook</a>
                        <span class="mx-2 text-muted">·</span>
                        <a href="#" class="transition-colors hover:text-accent">Zalo</a>
                    </p>
                </div>
            </div>

            {{-- Right column (form) --}}
            <div>
                <form x-data='{
                        name: "",
                        email: "",
                        subject: "General question",
                        message: "",
                        submitted: false,
                        send() {
                            console.log("Contact form submitted:", {
                                name: this.name,
                                email: this.email,
                                subject: this.subject,
                                message: this.message,
                            });
                            this.submitted = true;
                            this.name = "";
                            this.email = "";
                            this.subject = "General question";
                            this.message = "";
                        }
                    }'
                      @submit.prevent="send"
                      class="rounded-2xl border border-text/10 bg-surface p-8">

                    <h2 class="font-display text-[28px] font-medium tracking-tight">
                        Send us a message
                    </h2>

                    <div class="mt-6 space-y-5">
                        <div>
                            <label for="name" class="mb-2 block text-[14px] text-muted">Your name</label>
                            <input id="name" type="text" x-model="name" required
                                   placeholder="Nguyễn Văn A"
                                   class="block w-full rounded-xl border border-muted/30 bg-text/5 px-4 py-3.5 text-[15px] text-text placeholder:text-muted/60 transition-colors focus:border-accent focus:outline-none">
                        </div>

                        <div>
                            <label for="email" class="mb-2 block text-[14px] text-muted">Email address</label>
                            <input id="email" type="email" x-model="email" required
                                   placeholder="you@example.com"
                                   class="block w-full rounded-xl border border-muted/30 bg-text/5 px-4 py-3.5 text-[15px] text-text placeholder:text-muted/60 transition-colors focus:border-accent focus:outline-none">
                        </div>

                        <div>
                            <label for="subject" class="mb-2 block text-[14px] text-muted">What's this about?</label>
                            <div class="relative">
                                <select id="subject" x-model="subject"
                                        class="block w-full appearance-none rounded-xl border border-muted/30 bg-text/5 px-4 py-3.5 pr-11 text-[15px] text-text transition-colors focus:border-accent focus:outline-none">
                                    <option>General question</option>
                                    <option>I'd like to join as a lawyer</option>
                                    <option>Press or partnership</option>
                                    <option>Feedback or suggestion</option>
                                    <option>Something else</option>
                                </select>
                                <span class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-muted">
                                    <x-icon name="chevron-down" :size="16" />
                                </span>
                            </div>
                        </div>

                        <div>
                            <label for="message" class="mb-2 block text-[14px] text-muted">Your message</label>
                            <textarea id="message" rows="5" x-model="message" required
                                      placeholder="Tell us a little about what you need."
                                      class="block w-full resize-y rounded-xl border border-muted/30 bg-text/5 px-4 py-3.5 text-[15px] leading-relaxed text-text placeholder:text-muted/60 transition-colors focus:border-accent focus:outline-none"></textarea>
                        </div>

                        <x-button variant="primary" type="submit" class="w-full">
                            Send message →
                        </x-button>

                        <p x-show="submitted" x-cloak
                           class="text-[14px] text-muted">
                            Thanks — we'll be in touch within 1–2 business days.
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </section>

    {{-- Reassurance line --}}
    <section class="mx-auto max-w-[1280px] px-8 pb-16 text-center">
        <p class="text-[14px] text-muted">
            All messages are read by a real person. We aim to respond within one business day.
        </p>
    </section>
@endsection
