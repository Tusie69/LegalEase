<footer class="border-t border-text/10 bg-bg">
    <div class="mx-auto max-w-[1280px] px-8 py-20">
        <div class="grid gap-12 md:grid-cols-[2fr_1fr_1fr_1fr]">
            <div>
                <a href="/" class="font-display text-2xl font-medium tracking-tight text-text">LegalEase</a>
                <p class="mt-4 max-w-sm text-[15px] leading-relaxed text-muted">
                    Connecting Vietnam with trusted legal expertise, one consultation at a time.
                </p>
            </div>

            <div>
                <h4 class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Company</h4>
                <ul class="mt-4 space-y-3 text-[14px]">
                    <li><a href="/about" class="text-text transition-colors hover:text-accent">About Us</a></li>
                    <li><a href="/careers" class="text-text transition-colors hover:text-accent">Careers</a></li>
                    <li><a href="{{ route('press') }}" class="text-text transition-colors hover:text-accent">Press</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">For Lawyers</h4>
                <ul class="mt-4 space-y-3 text-[14px]">
                    <li><a href="{{ route('for-lawyers') }}" class="text-text transition-colors hover:text-accent">Join the platform</a></li>
                    <li><a href="{{ route('lawyer.resources') }}" class="text-text transition-colors hover:text-accent">Resources</a></li>
                    <li><a href="{{ route('lawyer.login') }}" class="text-text transition-colors hover:text-accent">Lawyer login</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Support</h4>
                <ul class="mt-4 space-y-3 text-[14px]">
                    <li><a href="{{ route('contact') }}" class="text-text transition-colors hover:text-accent">Contact</a></li>
                    <li><a href="{{ route('faq') }}" class="text-text transition-colors hover:text-accent">FAQ</a></li>
                    <li><a href="{{ route('terms') }}" class="text-text transition-colors hover:text-accent">Terms</a></li>
                    <li><a href="{{ route('privacy') }}" class="text-text transition-colors hover:text-accent">Privacy</a></li>
                </ul>
            </div>
        </div>

        <div class="mt-16 flex flex-col items-start justify-between gap-4 border-t border-text/10 pt-8 md:flex-row md:items-center">
            <p class="text-[13px] text-muted">© 2026 LegalEase. All rights reserved.</p>

            <div class="flex items-center gap-4">
                <a href="#" aria-label="Facebook" class="text-muted transition-colors hover:text-accent">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M22 12a10 10 0 1 0-11.56 9.88v-6.99H7.9V12h2.54V9.8c0-2.5 1.49-3.89 3.77-3.89 1.09 0 2.23.2 2.23.2v2.46h-1.26c-1.24 0-1.62.77-1.62 1.56V12h2.76l-.44 2.89h-2.32v6.99A10 10 0 0 0 22 12z"/></svg>
                </a>
                <a href="#" aria-label="LinkedIn" class="text-muted transition-colors hover:text-accent">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M20.45 20.45h-3.56v-5.57c0-1.33-.02-3.04-1.85-3.04-1.85 0-2.14 1.45-2.14 2.94v5.67H9.35V9h3.41v1.56h.05a3.74 3.74 0 0 1 3.37-1.85c3.6 0 4.27 2.37 4.27 5.45v6.29zM5.34 7.44a2.07 2.07 0 1 1 0-4.13 2.07 2.07 0 0 1 0 4.13zM7.12 20.45H3.55V9h3.57v11.45zM22.23 0H1.77C.79 0 0 .77 0 1.72v20.56C0 23.23.79 24 1.77 24h20.46c.98 0 1.77-.77 1.77-1.72V1.72C24 .77 23.21 0 22.23 0z"/></svg>
                </a>
                <a href="#" aria-label="Zalo" class="text-muted transition-colors hover:text-accent">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 5.93 2 10.8c0 2.76 1.47 5.22 3.75 6.83-.18.88-.56 2.24-.75 2.74-.24.64.24.73.49.54.2-.15 2.53-1.72 3.57-2.42 1 .2 2.02.32 2.94.32 5.52 0 10-3.93 10-8.8S17.52 2 12 2zM7.46 12.66a.6.6 0 0 1-.6-.6v-3.6a.6.6 0 0 1 1.2 0v3h1.8a.6.6 0 0 1 0 1.2H7.46zm4.34 0a.6.6 0 0 1-.6-.6V8.46a.6.6 0 0 1 1.2 0v3.6a.6.6 0 0 1-.6.6zm4.74-.6a.6.6 0 0 1-.6.6h-2.4a.6.6 0 0 1-.48-.96l1.74-2.44h-1.26a.6.6 0 0 1 0-1.2h2.4a.6.6 0 0 1 .48.96l-1.74 2.44h1.26a.6.6 0 0 1 .6.6z"/></svg>
                </a>
            </div>
        </div>
    </div>
</footer>
