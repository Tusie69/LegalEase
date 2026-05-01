@extends('layouts.app', ['title' => 'Contact · LegalEase'])

@section('content')
    {{-- Hero --}}
    <section class="mx-auto flex min-h-[320px] max-w-[1280px] items-center px-8 pt-32 pb-12">
        <div class="max-w-[720px]">
            <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">
                Get in touch
            </p>

            <h1 class="mt-6 font-display text-[48px] font-medium leading-[1.05] tracking-[-0.02em] md:text-[60px]">
                We're here when you need us.
            </h1>

            <p class="mt-6 max-w-[600px] text-[18px] leading-relaxed text-secondary">
                Whether you have a question about the platform, a partnership inquiry, or feedback we should hear, we read every message.
            </p>
        </div>
    </section>

    {{-- Contact details + form --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-12">
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
                        <li class="text-muted">Hours: Monday to Friday, 9:00 AM to 6:00 PM ICT</li>
                    </ul>
                </div>

                {{-- Office --}}
                <div>
                    <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Office</p>
                    <div class="mt-3 overflow-hidden rounded-xl border border-text/10">
                        <iframe
                            src="https://www.openstreetmap.org/export/embed.html?bbox=105.8423%2C21.0205%2C105.8503%2C21.0285&amp;layer=mapnik&amp;marker=21.0245%2C105.8463"
                            class="aspect-[4/3] w-full border-0 grayscale"
                            loading="lazy"
                            title="Map showing LegalEase office at 109 Trần Hưng Đạo, Hoàn Kiếm, Hanoi"></iframe>
                    </div>
                    <address class="mt-4 not-italic text-[15px] text-text">
                        Tầng 8, Tòa nhà Capital Tower<br>
                        109 Trần Hưng Đạo, Hoàn Kiếm<br>
                        Hà Nội, Việt Nam
                    </address>
                    <p class="mt-3 text-[13px]">
                        <a href="https://www.openstreetmap.org/?mlat=21.0245&mlon=105.8463#map=17/21.0245/105.8463"
                           target="_blank" rel="noopener"
                           class="text-muted transition-colors hover:text-accent">
                            View larger map →
                        </a>
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
                      class="flex h-full flex-col rounded-2xl border border-text/10 bg-surface p-8">

                    <h2 class="font-display text-[28px] font-medium tracking-tight">
                        Send us a message
                    </h2>

                    <div class="mt-6 flex flex-1 flex-col gap-5">
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

                        <div class="flex min-h-0 flex-1 flex-col">
                            <label for="message" class="mb-2 block text-[14px] text-muted">Your message</label>
                            <textarea id="message" x-model="message" required
                                      placeholder="Tell us a little about what you need."
                                      class="block w-full flex-1 min-h-[140px] resize-y rounded-xl border border-muted/30 bg-text/5 px-4 py-3.5 text-[15px] leading-relaxed text-text placeholder:text-muted/60 transition-colors focus:border-accent focus:outline-none"></textarea>
                        </div>

                        <x-button variant="primary" type="submit" class="w-full">
                            Send message →
                        </x-button>

                        <p x-show="submitted" x-cloak
                           class="text-[14px] text-success">
                            Thanks. We'll be in touch within 1 to 2 business days.
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </section>

    {{-- Reassurance line --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-32 pb-24 text-center">
        <p class="text-[14px] text-muted">
            All messages are read by a real person. We aim to respond within one business day.
        </p>
    </section>
@endsection
