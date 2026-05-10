@extends('layouts.app', ['title' => 'Liên hệ · LegalEase'])

@section('content')
    <section class="container-page pt-24 pb-24">
        <div class="max-w-[720px]">
            <p class="text-eyebrow">Liên hệ</p>

            <h1 class="mt-6 font-display text-[48px] font-medium leading-snug tracking-tight md:text-[56px]">
                Chúng tôi luôn ở đây khi bạn cần.
            </h1>

            <p class="text-body-intro mt-6 max-w-[600px]">
                Dù bạn có câu hỏi về nền tảng, yêu cầu hợp tác hay phản hồi cần chúng tôi lắng nghe, chúng tôi đọc mọi tin nhắn.
            </p>
        </div>

        <div class="mt-16 grid gap-16 lg:grid-cols-[5fr_7fr]">
            <div class="space-y-10">
                <div>
                    <p class="text-eyebrow">Email</p>
                    <ul class="text-body mt-3 space-y-1 text-text">
                        <li>Câu hỏi chung: <a href="mailto:hello@legalease.vn" class="transition-colors hover:text-accent">hello@legalease.vn</a></li>
                        <li>Đăng ký luật sư: <a href="mailto:lawyers@legalease.vn" class="transition-colors hover:text-accent">lawyers@legalease.vn</a></li>
                    </ul>
                </div>

                <div>
                    <p class="text-eyebrow">Điện thoại</p>
                    <ul class="text-body mt-3 space-y-1 text-text">
                        <li>Hỗ trợ khách hàng: <a href="tel:+842473001234" class="transition-colors hover:text-accent">+84 24 7300 1234</a></li>
                        <li>Giờ làm việc: Thứ Hai đến Thứ Sáu, 9:00 đến 18:00 ICT</li>
                    </ul>
                </div>

                <div>
                    <p class="text-eyebrow">Văn phòng</p>
                    <div class="mt-3 overflow-hidden rounded-xl border border-text/20">
                        <iframe
                            src="https://www.openstreetmap.org/export/embed.html?bbox=105.8423%2C21.0205%2C105.8503%2C21.0285&amp;layer=mapnik&amp;marker=21.0245%2C105.8463"
                            class="aspect-[4/3] w-full border-0"
                            loading="lazy"
                            title="Map showing LegalEase office at 109 Trần Hưng Đạo, Hoàn Kiếm, Hanoi"></iframe>
                    </div>
                    <address class="text-body mt-4 not-italic text-text">
                        Tầng 8, Tòa nhà Capital Tower<br>
                        109 Trần Hưng Đạo, Hoàn Kiếm<br>
                        Hà Nội, Việt Nam
                    </address>
                    <p class="text-caption mt-3">
                        <a href="https://www.openstreetmap.org/?mlat=21.0245&mlon=105.8463#map=17/21.0245/105.8463"
                           target="_blank" rel="noopener"
                           class="transition-colors hover:text-accent">
                            Xem bản đồ lớn →
                        </a>
                    </p>
                </div>
            </div>

            <div>
                <form x-data='{
                        name: "",
                        email: "",
                        subject: "Câu hỏi chung",
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
                            this.subject = "Câu hỏi chung";
                            this.message = "";
                        }
                    }'
                      @submit.prevent="send"
                      class="card-base-lg flex h-full flex-col">

                    <h3 class="text-card-h3">Gửi tin nhắn cho chúng tôi</h3>

                    <div class="mt-6 flex flex-1 flex-col gap-5">
                        <div>
                            <label for="name" class="mb-2 block text-[14px]">Họ và tên</label>
                            <input id="name" type="text" x-model="name" required
                                   placeholder="Nguyễn Văn A"
                                   class="block w-full rounded-xl border border-text/15 bg-text/5 px-4 py-3.5 text-[16px] text-text placeholder:text-text/60 transition-colors focus:border-accent focus:outline-none">
                        </div>

                        <div>
                            <label for="email" class="mb-2 block text-[14px]">Địa chỉ email</label>
                            <input id="email" type="email" x-model="email" required
                                   placeholder="you@example.com"
                                   class="block w-full rounded-xl border border-text/15 bg-text/5 px-4 py-3.5 text-[16px] text-text placeholder:text-text/60 transition-colors focus:border-accent focus:outline-none">
                        </div>

                        <div>
                            <label for="subject" class="mb-2 block text-[14px]">Chủ đề</label>
                            <div class="relative">
                                <select id="subject" x-model="subject"
                                        class="block w-full appearance-none rounded-xl border border-text/15 bg-text/5 px-4 py-3.5 pr-11 text-[16px] text-text transition-colors focus:border-accent focus:outline-none">
                                    <option>Câu hỏi chung</option>
                                    <option>Đăng ký làm luật sư</option>
                                    <option>Báo chí hoặc hợp tác</option>
                                    <option>Phản hồi hoặc đề xuất</option>
                                    <option>Khác</option>
                                </select>
                                <span class="pointer-events-none absolute inset-y-0 right-4 flex items-center">
                                    <x-icon name="chevron-down" :size="16" />
                                </span>
                            </div>
                        </div>

                        <div class="flex min-h-0 flex-1 flex-col">
                            <label for="message" class="mb-2 block text-[14px]">Tin nhắn</label>
                            <textarea id="message" x-model="message" required
                                      placeholder="Hãy cho chúng tôi biết bạn cần gì."
                                      class="block w-full flex-1 min-h-[140px] resize-y rounded-xl border border-text/15 bg-text/5 px-4 py-3.5 text-[16px] leading-relaxed text-text placeholder:text-text/60 transition-colors focus:border-accent focus:outline-none"></textarea>
                        </div>

                        <x-button variant="primary" type="submit" class="w-full">
                            Gửi tin nhắn →
                        </x-button>

                        <p x-show="submitted" x-cloak class="text-[14px] text-success">
                            Cảm ơn. Chúng tôi sẽ liên hệ trong vòng 1-2 ngày làm việc.
                        </p>
                    </div>
                </form>
            </div>
        </div>

        <p class="mt-16 text-center text-[14px]">
            Mọi tin nhắn đều được đọc bởi người thật. Chúng tôi cố gắng phản hồi trong vòng một ngày làm việc.
        </p>
    </section>
@endsection
