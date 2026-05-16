<footer class="border-t border-text/15 bg-bg">
    <div class="container-page py-20 md:py-24">

        @php
            $footerSections = [
                ['Công ty', [
                    ['Về chúng tôi', '/about'],
                    ['Tuyển dụng', '/careers'],
                    ['Tin tức', route('news')],
                ]],
                ['Dành cho luật sư', [
                    ['Tham gia nền tảng', route('for-lawyers')],
                    ['Tài nguyên', route('lawyer.resources')],
                    ['Đăng nhập luật sư', route('lawyer.login')],
                ]],
                ['Hỗ trợ', [
                    ['Liên hệ', route('contact')],
                    ['FAQ', route('faq')],
                    ['Điều khoản sử dụng', route('terms')],
                    ['Chính sách bảo mật', route('privacy')],
                ]],
            ];
        @endphp

        <div class="grid gap-12 md:grid-cols-[2fr_1fr_1fr_1fr]">
            <div>
                <a href="/" class="text-card-h3 text-text transition-colors hover:text-text/60">LegalEase</a>
                <p class="text-body mt-4 max-w-sm text-text/70">
                    Kết nối người dùng tại Việt Nam với đội ngũ luật sư uy tín, từng buổi tư vấn một.
                </p>
            </div>

            @foreach ($footerSections as [$title, $items])
                <div>
                    <p class="text-eyebrow text-text/60">{{ $title }}</p>
                    <ul class="text-body-dense mt-3 space-y-3">
                        @foreach ($items as [$label, $url])
                            <li>
                                <a href="{{ $url }}" class="text-text transition-colors hover:text-text/60">{{ $label }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>

        <div class="mt-16 flex flex-col items-start justify-between gap-4 border-t border-text/15 pt-8 md:flex-row md:items-center">
            <p class="text-caption text-text/60">© 2026 LegalEase. Mọi quyền được bảo lưu.</p>

            <div class="flex items-center gap-4">
                <a href="#" aria-label="Facebook" class="text-accent transition-opacity hover:opacity-75">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M22 12a10 10 0 1 0-11.56 9.88v-6.99H7.9V12h2.54V9.8c0-2.5 1.49-3.89 3.77-3.89 1.09 0 2.23.2 2.23.2v2.46h-1.26c-1.24 0-1.62.77-1.62 1.56V12h2.76l-.44 2.89h-2.32v6.99A10 10 0 0 0 22 12z"/></svg>
                </a>
                <a href="#" aria-label="LinkedIn" class="text-accent transition-opacity hover:opacity-75">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M20.45 20.45h-3.56v-5.57c0-1.33-.02-3.04-1.85-3.04-1.85 0-2.14 1.45-2.14 2.94v5.67H9.35V9h3.41v1.56h.05a3.74 3.74 0 0 1 3.37-1.85c3.6 0 4.27 2.37 4.27 5.45v6.29zM5.34 7.44a2.07 2.07 0 1 1 0-4.13 2.07 2.07 0 0 1 0 4.13zM7.12 20.45H3.55V9h3.57v11.45zM22.23 0H1.77C.79 0 0 .77 0 1.72v20.56C0 23.23.79 24 1.77 24h20.46c.98 0 1.77-.77 1.77-1.72V1.72C24 .77 23.21 0 22.23 0z"/></svg>
                </a>
                <a href="#" aria-label="X (Twitter)" class="text-accent transition-opacity hover:opacity-75">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                </a>
            </div>
        </div>
    </div>
</footer>
