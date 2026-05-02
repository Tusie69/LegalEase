@extends('layouts.app', ['title' => 'Giới thiệu về Â · LegalEase'])

@section('content')
    {{-- Hero: full-bleed photo with overlay --}}
    <section class="relative -mt-[72px] flex min-h-screen items-center overflow-hidden">
        <img src="https://images.unsplash.com/photo-1610374792793-f016b77ca51a?q=80"
             alt=""
             class="absolute inset-0 h-full w-full object-cover grayscale">
        <div class="absolute inset-0 bg-gradient-to-b from-bg/70 via-bg/50 to-bg"></div>

        <div class="relative mx-auto max-w-[1280px] px-8 pt-24 text-center">
            <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">
                Our story
            </p>

            <h1 class="mx-auto mt-6 max-w-[900px] font-display text-[56px] font-medium leading-[1.05] tracking-[-0.02em] md:text-[88px]">
                Legal help, without the guesswork.
            </h1>

            <p class="mx-auto mt-8 max-w-[560px] text-[18px] leading-relaxed text-secondary">
                Chúng tôi kết nối người dùng tại Việt Nam với các luật sư đã được xác minh một cách nhanh chóng.
            </p>
        </div>
    </section>

    {{-- Problem block: image left, text right --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-32">
        <div class="grid items-center gap-12 md:grid-cols-2">
            <div class="overflow-hidden rounded-2xl">
                <img src="https://images.unsplash.com/photo-1726649339367-c2577a28881b?q=80"
                     alt=""
                     loading="lazy"
                     class="aspect-square w-full object-cover grayscale">
            </div>
            <div>
                <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">The problem</p>
                <h3 class="mt-4 font-display text-[36px] font-medium leading-[1.1] tracking-[-0.01em] md:text-[44px]">
                    Asking around isn't a strategy.
                </h3>
                <p class="mt-6 max-w-[480px] text-[17px] leading-relaxed text-secondary">
                    For most people in Vietnam, finding a lawyer means asking a friend and hoping for the best. Prices vary wildly. Credentials are hard to verify.
                </p>
            </div>
        </div>
    </section>

    {{-- Solution block: text left, image right --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-32">
        <div class="grid items-center gap-12 md:grid-cols-2">
            <div class="md:order-2 overflow-hidden rounded-2xl">
                <img src="https://images.unsplash.com/photo-1758518726775-70e538b0d46e?q=80"
                     alt=""
                     loading="lazy"
                     class="aspect-square w-full object-cover grayscale">
            </div>
            <div class="md:order-1">
                <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Những gì chúng tôi đã xây dựng</p>
                <h3 class="mt-4 font-display text-[36px] font-medium leading-[1.1] tracking-[-0.01em] md:text-[44px]">
                    Verified, transparent, ready.
                </h3>
                <p class="mt-6 max-w-[480px] text-[17px] leading-relaxed text-secondary">
                    Every lawyer is reviewed by our team before they list. Hourly rates are public. Booking takes minutes.
                </p>
            </div>
        </div>
    </section>

    {{-- Stat moment --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-32">
        <div class="grid items-center gap-12 md:grid-cols-2">
            <div class="overflow-hidden rounded-2xl">
                <img src="https://images.unsplash.com/photo-1758518731722-320023fb8e66?q=80"
                     alt=""
                     loading="lazy"
                     class="aspect-square w-full object-cover grayscale">
            </div>
            <div>
                <p class="font-display text-[56px] font-medium leading-none tracking-[-0.03em] md:text-[72px]">
                    500+
                </p>
                <h3 class="mt-5 font-display text-[28px] font-medium tracking-tight md:text-[32px]">
                    Verified lawyers across Vietnam.
                </h3>
                <p class="mt-4 max-w-[420px] text-[16px] leading-relaxed text-secondary">
                    Across 12 cities, with bar membership and credentials checked before they go live.
                </p>
            </div>
        </div>
    </section>

    {{-- Testimonial --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-32">
        <div class="border-y border-text/10 py-20 md:py-24">
            <blockquote class="mx-auto max-w-[900px] text-center font-display text-[32px] font-medium italic leading-[1.2] tracking-[-0.01em] md:text-[44px]">
                <span class="text-muted">â€œ</span>Cảm giác như có một người bạn tình cờ trở thành luật sư.<span class="text-muted">â€</span>
            </blockquote>
            <p class="mt-8 text-center text-[12px] font-medium uppercase tracking-[0.1em] text-muted">
                A client, divorce case in Hanoi
            </p>
        </div>
    </section>

    {{-- Team --}}
    @php
        $team = [
            [
                'name' => 'Äá»— Thá»‹ Lan',
                'role' => 'Đồng sáng lập, CEO',
                'bio'  => "Eight years as a litigator at a top Hanoi firm. Left to build something simpler.",
                'portrait' => 'https://images.unsplash.com/photo-1714974528915-4c74c4c0bb27?q=80',
            ],
            [
                'name' => 'Tráº§n Quá»‘c Viá»‡t',
                'role' => 'Đồng sáng lập, Xác minh',
                'bio'  => "Six years at the Vietnam Bar Federation handling licensing and ethics.",
                'portrait' => 'https://images.unsplash.com/photo-1591702694482-ecc51ff9642e?q=80',
            ],
            [
                'name' => 'Nguyá»…n HÃ  My',
                'role' => 'Đồng sáng lập, Sản phẩm',
                'bio'  => "Built consumer fintech products used by millions of Vietnamese.",
                'portrait' => 'https://images.unsplash.com/photo-1733348137479-2e726d326d9b?q=80',
            ],
        ];
    @endphp

    <section class="mx-auto max-w-[1280px] px-8 pt-32">
        <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">The team</p>
        <h2 class="mt-4 font-display text-[36px] font-medium tracking-[-0.01em] md:text-[44px]">
            Three people, one shared frustration.
        </h2>

        <div class="mt-12 grid gap-10 md:grid-cols-3">
            @foreach ($team as $member)
                <div>
                    <div class="overflow-hidden rounded-2xl bg-surface">
                        <img src="{{ $member['portrait'] }}"
                             alt="{{ $member['name'] }}"
                             loading="lazy"
                             class="aspect-[4/5] w-full object-cover object-top grayscale">
                    </div>
                    <h3 class="mt-5 font-display text-[24px] font-medium tracking-tight">{{ $member['name'] }}</h3>
                    <p class="mt-1 text-[12px] uppercase tracking-[0.1em] text-muted">{{ $member['role'] }}</p>
                    <p class="mt-3 text-[15px] leading-relaxed text-secondary">{{ $member['bio'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Values --}}
    @php
        $values = [
            ['title' => 'Giá cả minh bạch',     'desc' => 'Giá theo giờ được đăng trước khi bạn đặt.'],
            ['title' => "We don't pick favorites", 'desc' => 'Không có phí giới thiệu. Không có bảng xếp hạng trả phí.'],
            ['title' => 'Thông tin xác thực đã được xác minh',    'desc' => 'Mọi luật sư đều xem xét trước khi niêm yết.'],
            ['title' => 'Không có nghĩa vụ',           'desc' => 'Sau khi tư vấn, bước tiếp theo là của bạn.'],
        ];
    @endphp

    <section class="mx-auto max-w-[1280px] px-8 pt-32">
        <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Cách chúng tôi làm việc</p>
        <h2 class="mt-4 font-display text-[36px] font-medium tracking-[-0.01em] md:text-[44px]">
            Four commitments.
        </h2>

        <div class="mt-12 grid gap-6 md:grid-cols-2">
            @foreach ($values as $v)
                <div class="rounded-2xl border border-text/10 bg-surface p-8">
                    <h3 class="font-display text-[24px] font-medium leading-tight tracking-tight">{{ $v['title'] }}</h3>
                    <p class="mt-3 text-[15px] leading-relaxed text-secondary">{{ $v['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- CTA --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-32 pb-24 text-center">
        <h2 class="font-display text-[40px] font-medium leading-[1.05] tracking-[-0.02em] md:text-[52px]">
            Ready to find your lawyer?
        </h2>
        <div class="mt-10 flex justify-center">
            <x-button variant="primary" href="/lawyers">Tìm kiếm luật sư â†’</x-button>
        </div>
    </section>
@endsection

<!doctype html>

<html
  lang="en"
  class="light-style layout-menu-fixed layout-compact"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{ asset('admin_view/assets') }}/"
  data-template="horizontal-menu-template"
  data-style="light">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Admin B?ng ?i?u khi?n | LegalEase</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('admin_view/assets') }}/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap"
      rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('admin_view/assets/vendor/fonts/remixicon/remixicon.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin_view/assets/vendor/fonts/flag-icons.css') }}" />

    <!-- Menu waves for no-customizer fix -->
    <link rel="stylesheet" href="{{ asset('admin_view/assets/vendor/libs/node-waves/node-waves.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('admin_view/assets/vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('admin_view/assets/vendor/css/rtl/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('admin_view/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('admin_view/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin_view/assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin_view/assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('admin_view/assets/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{ asset('admin_view/assets/vendor/js/template-customizer.js') }}"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('admin_view/assets/js/config.js') }}"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-navbar-full layout-horizontal layout-without-menu">
      <div class="layout-container">
        <!-- Navbar -->

        <nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
          <div class="container-xxl">
            <div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-6">
              <a href="javascript:void(0);" class="app-brand-link gap-2">
                <span class="app-brand-logo demo">
                  <img
                    src="{{ asset('images/logo.png') }}"
                    alt="LegalEase Logo"
                    style="height: 28px; width: auto;" />
                </span>
                <span class="app-brand-text demo menu-text fw-semibold ms-2">LEGAL EASE</span>
              </a>

              <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-xl-none">
                <i class="ri-close-fill align-middle"></i>
              </a>
            </div>

            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
                <i class="ri-menu-fill ri-24px"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- T?m ki?m -->
                <li class="nav-item navbar-search-wrapper me-1 me-xl-0">
                  <a class="nav-link search-toggler" href="javascript:void(0);">
                    <i class="ri-search-line ri-22px scaleX-n1-rtl me-2"></i>
                  </a>
                </li>
                <!-- /T?m ki?m -->
<!-- Style Switcher -->
                <li class="nav-item dropdown-style-switcher dropdown">
                  <a
                    class="nav-link btn btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow"
                    href="javascript:void(0);"
                    data-bs-toggle="dropdown">
                    <i class="ri-22px"></i>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
                    <li>
                      <a class="dropdown-item" href="javascript:void(0);" data-theme="light">
                        <span class="align-middle"><i class="ri-sun-line ri-22px me-3"></i>Ông</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="javascript:void(0);" data-theme="dark">
                        <span class="align-middle"><i class="ri-moon-clear-line ri-22px me-3"></i>T?i</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="javascript:void(0);" data-theme="system">
                        <span class="align-middle"><i class="ri-computer-line ri-22px me-3"></i>H? th?ng</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!-- / Style Switcher-->
<!-- Th?ng b?o -->
 
                <!--/ Th?ng b?o -->

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a
                    class="nav-link dropdown-toggle hide-arrow p-0"
                    href="javascript:void(0);"
                    data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="{{ asset('admin_view/assets') }}/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end mt-3 py-2">
                    <li>
                      <a class="dropdown-item" href="javascript:void(0);">
                        <div class="d-flex align-items-center">
                          <div class="flex-shrink-0 me-2">
                            <div class="avatar avatar-online">
                              <img src="{{ asset('admin_view/assets') }}/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <h6 class="mb-0 small">John Doe</h6>
                            <small class="text-muted">Admin</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="javascript:void(0);">
                        <i class="ri-user-3-line ri-22px me-2"></i>
                        <span class="align-middle">H của tôi? S?</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="javascript:void(0);">
                        <i class="ri-settings-4-line ri-22px me-2"></i>
                        <span class="align-middle">C?i ??t</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="javascript:void(0);">
                        <span class="d-flex align-items-center align-middle">
                          <i class="flex-shrink-0 ri-file-text-line ri-22px me-2"></i>
                          <span class="flex-grow-1 align-middle">Billing</span>
                          <span
                            class="flex-shrink-0 badge badge-center rounded-pill bg-danger h-px-20 d-flex align-items-center justify-content-center"
                            >4</span
                          >
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="javascript:void(0);">
                        <i class="ri-money-dollar-circle-line ri-22px me-2"></i>
                        <span class="align-middle">Pricing</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="javascript:void(0);">
                        <i class="ri-question-line ri-22px me-2"></i>
                        <span class="align-middle">FAQ</span>
                      </a>
                    </li>
                    <li>
                      <div class="d-grid px-4 pt-2 pb-1">
                        <a class="btn btn-danger d-flex" href="javascript:void(0);">
                          <small class="align-middle">Logout</small>
                          <i class="ri-logout-box-r-line ms-2 ri-16px"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>

            <!-- T?m ki?m Small Screens -->
            <div class="navbar-search-wrapper search-input-wrapper container-xxl d-none">
              <input
                type="text"
                class="form-control search-input border-0"
                placeholder="T?m ki?m..."
                aria-label="T?m ki?m..." />
              <i class="ri-close-fill search-toggler cursor-pointer"></i>
            </div>
          </div>
        </nav>

        <!-- / Navbar -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Menu -->
            <aside id="layout-menu" class="layout-menu-horizontal menu-horizontal menu bg-menu-theme flex-grow-0">
              <div class="container-xxl d-flex h-100">
                <ul class="menu-inner">
                  <li class="menu-item active">
                    <a href="javascript:void(0);" class="menu-link">
                      <i class="menu-icon tf-icons ri-home-4-line"></i>
                      <div>B?ng ?i?u khi?n</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link">
                      <i class="menu-icon tf-icons ri-scales-3-line"></i>
                      <div>Lu?t s?</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link">
                      <i class="menu-icon tf-icons ri-user-3-line"></i>
                      <div>Customers</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link">
                      <i class="menu-icon tf-icons ri-calendar-check-line"></i>
                      <div>L?ch h?ns</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link">
                      <i class="menu-icon tf-icons ri-bank-card-line"></i>
                      <div>Payments</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link">
                      <i class="menu-icon tf-icons ri-file-list-3-line"></i>
                      <div>Content</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link">
                      <i class="menu-icon tf-icons ri-notification-3-line"></i>
                      <div>Th?ng?bos?</div>
                    </a>
                  </li>
                </ul>
              </div>
            </aside>
            <!-- / Menu -->
<!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row gy-4">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <h5 class="card-title mb-1">LegalEase Admin B?ng ?i?u khi?n</h5>
                      <p class="mb-0 text-muted">Tong quan van hanh he thong tu du lieu thuc te.</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-xl-3">
                  <div class="card h-100"><div class="card-body"><span class="text-muted">Tông đứng dậy</span><h3 class="mb-0">{{ number_format($stats['total_lawyers']) }}</h3></div></div>
                </div>
                <div class="col-md-6 col-xl-3">
                  <div class="card h-100"><div class="card-body"><span class="text-muted">Tong khach hang</span><h3 class="mb-0">{{ number_format($stats['total_customers']) }}</h3></div></div>
                </div>
                <div class="col-md-6 col-xl-3">
                  <div class="card h-100"><div class="card-body"><span class="text-muted">Tống Lịch Hến</span><h3 class="mb-0">{{ number_format($stats['total_appointments']) }}</h3></div></div>
                </div>
                <div class="col-md-6 col-xl-3">
                  <div class="card h-100"><div class="card-body"><span class="text-muted">Doanh thu (VND)</span><h3 class="mb-0">{{ number_format($stats['revenue_vnd'], 0, '.', ',') }}</h3></div></div>
                </div>
                <div class="col-md-6 col-xl-3">
                  <div class="card h-100"><div class="card-body"><span class="text-muted">Lich hen dang cho</span><h4 class="mb-0">{{ number_format($stats['pending_appointments']) }}</h4></div></div>
                </div>
                <div class="col-md-6 col-xl-3">
                  <div class="card h-100"><div class="card-body"><span class="text-muted">Lịch Hến Hoàn đã làm</span><h4 class="mb-0">{{ number_format($stats['completed_appointments']) }}</h4></div></div>
                </div>
                <div class="col-md-6 col-xl-3">
                  <div class="card h-100"><div class="card-body"><span class="text-muted">Lịch hến dạ huy</span><h4 class="mb-0">{{ number_format($stats['cancelled_appointments']) }}</h4></div></div>
                </div>
                <div class="col-md-6 col-xl-3">
                  <div class="card h-100"><div class="card-body"><span class="text-muted">Thong bao chua doc</span><h4 class="mb-0">{{ number_format($stats['unread_notifications']) }}</h4></div></div>
                </div>
                <div class="col-12">
                  <div class="card">
                    <div class="card-body d-flex flex-column flex-md-row justify-content-between gap-3">
                      <div><h6 class="mb-1">Thanh toan thanh cong</h6><p class="mb-0 text-muted">So giao dich da doi soat thanh cong.</p></div>
                      <h3 class="mb-0">{{ number_format($stats['paid_payments']) }}</h3>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!--/ Content -->

            <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl">
                <div
                  class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
                  <div class="text-body mb-2 mb-md-0">
                    Made with <span class="text-danger"><i class="tf-icons ri-heart-fill"></i></span> by
                    <a href="javascript:void(0)" class="footer-link">LegalEase Team</a>
                  </div>
</div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!--/ Content wrapper -->
        </div>

        <!--/ Layout container -->
      </div>
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>

    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>

    <!--/ Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('admin_view/assets') }}/vendor/libs/jquery/jquery.js"></script>
    <script src="{{ asset('admin_view/assets') }}/vendor/libs/popper/popper.js"></script>
    <script src="{{ asset('admin_view/assets') }}/vendor/js/bootstrap.js"></script>
    <script src="{{ asset('admin_view/assets') }}/vendor/libs/node-waves/node-waves.js"></script>
    <script src="{{ asset('admin_view/assets') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="{{ asset('admin_view/assets') }}/vendor/libs/hammer/hammer.js"></script>
    <script src="{{ asset('admin_view/assets') }}/vendor/libs/i18n/i18n.js"></script>
    <script src="{{ asset('admin_view/assets') }}/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="{{ asset('admin_view/assets') }}/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Main JS -->
    <script src="{{ asset('admin_view/assets') }}/js/main.js"></script>
  </body>
</html>











@extends('layouts.app', ['title' => 'Nghề nghiệp · LegalEase'])

@php
    $values = [
        ['title' => 'Định hướng theo sứ mệnh',  'desc' => "Work that reaches users this week."],
        ['title' => 'lai ở Hà Nội', 'desc' => "Three days office, two days remote."],
        ['title' => 'Tác động thực sự',     'desc' => "Small team. Your work ships fast."],
        ['title' => 'Ngân sách học tập', 'desc' => "Annual stipend for what sharpens your craft."],
    ];

    $roles = [
        [
            'title'     => 'Senior Quay l?iend Engineer',
            'meta'      => 'Kỹ thuật Â · Hà Nội Â · Toàn thời gian',
            'desc'      => "Laravel and MySQL. Scale the platform that powers 500+ lawyer profiles.",
            'salary'    => '50-80M',
            'image_url' => 'https://images.unsplash.com/photo-1631624222568-6619ce21a683?q=80',
        ],
        [
            'title'     => 'Nhà thiết kế sản phẩm',
            'meta'      => 'Sản phẩm Â · Hà Nội Â · Toàn thời gian',
            'desc'      => "Lead the customer flow from search to consultation.",
            'salary'    => '40-65M',
            'image_url' => 'https://images.unsplash.com/photo-1600697394936-59934aa5951f?q=80',
        ],
        [
            'title'     => 'Chuyên gia xác minh luật sư',
            'meta'      => 'Hoạt động Â · Hà Nội Â · Toàn thời gian',
            'desc'      => "Vet every lawyer before they list. Quay l?iground in law preferred.",
            'salary'    => '25-40M',
            'image_url' => 'https://images.unsplash.com/photo-1688828792704-4218151b5d97?q=80',
        ],
        [
            'title'     => 'Trưởng nhóm vận hành khách hàng',
            'meta'      => 'Hoạt động Â · Hà Nội hoặc Thành phố Hồ Chí Minh Â · Toàn thời gian',
            'desc'      => "First responder for clients. Build the playbooks that scale support.",
            'salary'    => '30-45M',
            'image_url' => 'https://images.unsplash.com/photo-1554774853-719586f82d77?q=80',
        ],
        [
            'title'     => 'Giám đốc tiếp thị',
            'meta'      => 'Tiếp thị Â · Hà Nội Â · Toàn thời gian',
            'desc'      => "Brand, content, and growth across Vietnam.",
            'salary'    => '35-55M',
            'image_url' => 'https://images.unsplash.com/photo-1758873268131-a2636b120d81?q=80',
        ],
    ];

    $hiring = [
        ['n' => '01', 'title' => 'Áp dụng',          'desc' => "No cover letter."],
        ['n' => '02', 'title' => 'Hai cuộc phỏng vấn', 'desc' => "Hiring manager, then team."],
        ['n' => '03', 'title' => 'Phán quyết',       'desc' => "Within ten days."],
    ];
@endphp

@section('content')
    {{-- Hero: full-bleed photo --}}
    <section class="relative -mt-[72px] flex min-h-screen items-center overflow-hidden">
        <img src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?q=80"
             alt=""
             class="absolute inset-0 h-full w-full object-cover grayscale">
        <div class="absolute inset-0 bg-gradient-to-b from-bg/70 via-bg/55 to-bg"></div>

        <div class="relative mx-auto max-w-[1280px] px-8 pt-24 text-center">
            <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Chúng tôi đang tuyển dụng</p>

            <h1 class="mx-auto mt-6 max-w-[920px] font-display text-[52px] font-medium leading-[1.05] tracking-[-0.02em] md:text-[80px]">
                Build the legal layer for Vietnam.
            </h1>
        </div>
    </section>

    {{-- 01 / What it's like --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-24">
        <div class="flex items-baseline gap-5">
            <p class="font-display text-[28px] font-medium text-muted md:text-[32px]">01</p>
            <h2 class="font-display text-[28px] font-medium tracking-[-0.01em] md:text-[32px]">Nó như thế nào</h2>
        </div>

        <div class="mt-12 grid gap-6 md:grid-cols-2 lg:grid-cols-4">
            @foreach ($values as $v)
                <div class="rounded-2xl border border-text/10 bg-surface p-6">
                    <h3 class="font-display text-[24px] font-medium tracking-tight">{{ $v['title'] }}</h3>
                    <p class="mt-2 text-[14px] leading-relaxed text-muted">{{ $v['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- 02 / Open positions --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-24">
        <div class="flex items-baseline gap-5">
            <p class="font-display text-[28px] font-medium text-muted md:text-[32px]">02</p>
            <h2 class="font-display text-[28px] font-medium tracking-[-0.01em] md:text-[32px]">Open positions</h2>
        </div>

        <div class="mt-12">
            @foreach ($roles as $i => $role)
                <article class="{{ $i > 0 ? 'pt-20' : '' }} grid grid-cols-1 gap-6 md:grid-cols-[100px_1fr_auto] md:gap-10">
                    {{-- Role image --}}
                    <div class="aspect-square w-[100px] overflow-hidden rounded-2xl bg-surface">
                        <img src="{{ $role['image_url'] }}"
                             alt=""
                             loading="lazy"
                             class="h-full w-full object-cover object-top grayscale">
                    </div>

                    {{-- Title, meta, description --}}
                    <div>
                        <h3 class="font-display text-[26px] font-medium leading-tight tracking-[-0.01em] md:text-[30px]">
                            {{ $role['title'] }}
                        </h3>
                        <p class="mt-2 text-[12px] uppercase tracking-[0.1em] text-muted">
                            {{ $role['meta'] }}
                        </p>
                        <p class="mt-4 max-w-[560px] text-[15px] leading-relaxed text-secondary">
                            {{ $role['desc'] }}
                        </p>
                    </div>

                    {{-- Salary --}}
                    <div class="md:text-right">
                        <p class="font-display text-[28px] font-medium tracking-tight md:text-[32px]">
                            {{ $role['salary'] }}
                        </p>
                        <p class="mt-1 text-[12px] uppercase tracking-[0.1em] text-muted">
                            VND / month
                        </p>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    {{-- 03 / How we hire --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-24">
        <div class="flex items-baseline gap-5">
            <p class="font-display text-[28px] font-medium text-muted md:text-[32px]">03</p>
            <h2 class="font-display text-[28px] font-medium tracking-[-0.01em] md:text-[32px]">Chúng tôi tuyển dụng như thế nào</h2>
        </div>

        <div class="relative mt-12 grid gap-12 md:grid-cols-3">
            <div aria-hidden="true"
                 class="pointer-events-none absolute left-0 right-0 top-6 hidden h-px bg-text/10 md:block"></div>

            @foreach ($hiring as $step)
                <div class="relative">
                    <div class="flex h-12 w-12 items-center justify-center rounded-full border border-accent bg-bg text-[14px] font-medium text-accent">
                        {{ $step['n'] }}
                    </div>
                    <h3 class="mt-6 font-display text-[24px] font-medium tracking-tight">{{ $step['title'] }}</h3>
                    <p class="mt-2 max-w-sm text-[15px] leading-relaxed text-secondary">{{ $step['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Closing CTA --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-32 pb-24 text-center">
        <h2 class="font-display text-[40px] font-medium leading-[1.05] tracking-[-0.02em] md:text-[52px]">
            Ready to apply?
        </h2>
        <div class="mt-8 flex justify-center">
            <x-button variant="primary" href="{{ route('contact') }}">Hãy liên lạc †'</x-button>
        </div>
    </section>
@endsection

@extends('layouts.app', ['title' => 'Lý?n h? · Dễ dàng pháp lý'])

@section('content')
    {{-- Header + contact details + form --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-24 pb-24">
        <div class="max-w-[720px]">
            <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">
                Get in touch
            </p>

            <h1 class="mt-6 font-display text-[48px] font-medium leading-[1.05] tracking-[-0.02em] md:text-[56px]">
                We're here when you need us.
            </h1>

            <p class="mt-6 max-w-[600px] text-[18px] leading-relaxed text-secondary">
                Whether you have a question about the platform, a partnership inquiry, or feedback we should hear, we read every message.
            </p>
        </div>

        <div class="mt-16 grid gap-16 md:grid-cols-[2fr_3fr]">
            <div class="space-y-10">
                {{-- Email --}}
                <div>
                    <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Email</p>
                    <ul class="mt-3 space-y-1 text-[15px] text-text">
                        <li>General inquiries: <a href="mailto:hello@legalease.vn" class="transition-colors hover:text-accent">hello@legalease.vn</a></li>
                        <li>Lawyer applications: <a href="mailto:lawyers@legalease.vn" class="transition-colors hover:text-accent">lawyers@legalease.vn</a></li>
                    </ul>
                </div>

                {{-- ?i?n tho?i --}}
                <div>
                    <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">?i?n tho?i</p>
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
                            title="Map showing LegalEase office at 109 Tráº§n HÆ°ng Äáº¡o, HoÃ n Kiáº¿m, Hanoi"></iframe>
                    </div>
                    <address class="mt-4 not-italic text-[15px] text-text">
                        Táº§ng 8, TÃ²a nhÃ  Capital Tower<br>
                        109 Tráº§n HÆ°ng Äáº¡o, HoÃ n Kiáº¿m<br>
                        HÃ  Ná»™i, Viá»‡t Nam
                    </address>
                    <p class="mt-3 text-[13px]">
                        <a href="https://www.openstreetmap.org/?mlat=21.0245&mlon=105.8463#map=17/21.0245/105.8463"
                           target="_blank" rel="noopener"
                           class="text-muted transition-colors hover:text-accent">
                            View larger map â†’
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
                            console.log("Li?n h? form submitted:", {
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

                    <h3 class="font-display text-[24px] font-medium tracking-tight">
                        Send us a message
                    </h3>

                    <div class="mt-6 flex flex-1 flex-col gap-5">
                        <div>
                            <label for="name" class="mb-2 block text-[14px] text-muted">Your name</label>
                            <input id="name" type="text" x-model="name" required
                                   placeholder="Nguyá»…n VÄƒn A"
                                   class="block w-full rounded-xl border border-muted/30 bg-text/5 px-4 py-3.5 text-[15px] text-text placeholder:text-muted/60 transition-colors focus:border-accent focus:outline-none">
                        </div>

                        <div>
                            <label for="email" class="mb-2 block text-[14px] text-muted">Email address</label>
                            <input id="email" type="email" x-model="email" required
                                   placeholder="you@example.com"
                                   class="block w-full rounded-xl border border-muted/30 bg-text/5 px-4 py-3.5 text-[15px] text-text placeholder:text-muted/60 transition-colors focus:border-accent focus:outline-none">
                        </div>

                        <div>
                            <label for="subject" class="mb-2 block text-[14px] text-muted">Chuyện này là về cái gì vậy?</label>
                            <div class="relative">
                                <select id="subject" x-model="subject"
                                        class="block w-full appearance-none rounded-xl border border-muted/30 bg-text/5 px-4 py-3.5 pr-11 text-[15px] text-text transition-colors focus:border-accent focus:outline-none">
                                    <option>General question</option>
                                    <option>Tôi muốn tham gia với tư cách là luật sư</option>
                                    <option>Báo chí hoặc hợp tác</option>
                                    <option>Phản hồi hoặc đề xuất</option>
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
                            Send message â†’
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

@extends('layouts.app', ['title' => 'B?ng ?i?u khi?n Â· LegalEase'])

@php
    $user = auth()->user();
    $firstH? t?n = explode(' ', trim($user->name))[0];
    $completed = session('completed_booking');
    $lawyer = $completed ? \App\Data\Lu?t s?::findBySlug($completed['lawyer_slug']) : null;
    $hasS?p t?i = $completed && $lawyer;
    $featuredLu?t s? = \App\Data\Lu?t s?::featured(3);

    $past = collect(\App\Data\?? quaConsultations::withSession??nh gi?s())
        ->map(fn ($c) => $c + ['status' => 'past']);

    $cancelled = collect(session('cancelled_consultations', []))
        ->map(fn ($c, $code) => $c + ['booking_code' => $code, 'status' => 'cancelled', 'rated' => false])
        ->values();

    $pastConsultations = $past
        ->concat($cancelled)
        ->map(fn ($c) => $c + ['lawyer' => \App\Data\Lu?t s?::findBySlug($c['lawyer_slug'])])
        ->sortByDesc('date')
        ->values()
        ->all();
@endphp

@section('content')
<section class="mx-auto max-w-[1280px] px-8 pt-24 pb-24">
    @if (session('status'))
        <div class="mb-12 rounded-2xl border border-success/40 bg-surface px-6 py-4">
            <p class="text-[14px] text-success">{{ session('status') }}</p>
        </div>
    @endif

    {{-- Header --}}
    <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Welcome back</p>
    <h1 class="mt-3 font-display text-[48px] font-medium tracking-[-0.02em] md:text-[56px]">
        Hi, {{ $firstH? t?n }}.
    </h1>
    @unless ($hasS?p t?i)
        <p class="mt-4 max-w-[560px] text-[17px] text-secondary">
            Pick a lawyer below to book a consultation.
        </p>
    @endunless

    {{-- S?p t?i consultations --}}
    @if ($hasS?p t?i)
        <div class="mt-16">
            <h2 class="font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">Tư vấn S?p t?i</h2>

            <a href="{{ route('consultations.show', $completed['booking_code']) }}"
               class="group mt-8 block rounded-2xl border border-text/10 bg-surface p-8 transition-colors hover:border-accent">
                <div class="grid gap-8 md:grid-cols-[260px_1fr_auto] md:items-center">
                    {{-- Lawyer --}}
                    <div class="flex items-center gap-4">
                        <img src="{{ $lawyer['portrait_url'] }}" alt=""
                             class="h-16 w-16 flex-none rounded-full object-cover object-top grayscale">
                        <div class="min-w-0">
                            <p class="font-display text-[20px] font-medium tracking-tight">{{ $lawyer['name'] }}</p>
                            <p class="text-[13px] text-muted">{{ $lawyer['primary_specialty'] }}</p>
                        </div>
                    </div>

                    {{-- When + Where --}}
                    <div class="md:flex md:h-32 md:flex-col md:justify-center md:border-l md:border-text/10 md:pl-8">
                        <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">When</p>
                        <p class="mt-2 font-display text-[18px] font-medium tracking-tight">
                            {{ \Carbon\Carbon::parse($completed['date'])->format('M j, Y') }}
                        </p>
                        <p class="text-[14px] text-secondary">
                            {{ \Carbon\Carbon::createFromFormat('H:i', $completed['time'])->format('g:i A') }}
                        </p>
                        <p class="mt-3 text-[13px] text-muted">
                            {{ $lawyer['address']['street_address'] ?? '' }}, {{ $lawyer['address']['province'] ?? '' }}
                        </p>
                    </div>

                    {{-- Booking code --}}
                    <div class="md:text-right">
                        <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Booking code</p>
                        <p class="mt-2 font-display text-[18px] font-medium tracking-tight">{{ $completed['booking_code'] }}</p>
                    </div>
                </div>
            </a>
        </div>
    @endif

    {{-- Recent consultations --}}
    <div class="mt-24">
        <h2 class="font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">Recent consultations</h2>

        <div class="mt-12 space-y-4">
            @foreach ($pastConsultations as $past)
                <a href="{{ route('consultations.show', $past['booking_code']) }}"
                   class="group block rounded-2xl border border-text/10 bg-surface p-6 transition-colors hover:border-accent">
                    <div class="grid gap-6 md:grid-cols-[260px_1fr_auto] md:items-center">
                        {{-- Lawyer --}}
                        <div class="flex items-center gap-4">
                            <img src="{{ $past['lawyer']['portrait_url'] }}" alt=""
                                 class="h-14 w-14 flex-none rounded-full object-cover object-top grayscale">
                            <div class="min-w-0">
                                <p class="font-display text-[18px] font-medium tracking-tight">{{ $past['lawyer']['name'] }}</p>
                                <p class="text-[13px] text-muted">{{ $past['lawyer']['primary_specialty'] }}</p>
                            </div>
                        </div>

                        {{-- Date + booking code --}}
                        <div class="md:flex md:h-24 md:flex-col md:justify-center md:border-l md:border-text/10 md:pl-6">
                            <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Consultation</p>
                            <p class="mt-1 font-display text-[16px] font-medium tracking-tight">
                                {{ \Carbon\Carbon::parse($past['date'])->format('M j, Y') }}
                            </p>
                            <p class="text-[12px] text-muted">{{ $past['booking_code'] }}</p>
                        </div>

                        {{-- Status --}}
                        <div class="md:text-right">
                            @if ($past['status'] === 'cancelled')
                                <div class="inline-flex items-center gap-2 rounded-full border border-error/40 bg-error/10 px-3 py-1">
                                    <span class="block h-1.5 w-1.5 rounded-full bg-error"></span>
                                    <span class="text-[12px] font-medium text-error">h?yled</span>
                                </div>
                            @elseif ($past['rated'])
                                <div class="md:inline-flex md:flex-col md:items-end">
                                    <x-rating-stars :rating="$past['stars']" size="sm" />
                                    <p class="mt-2 text-[12px] text-muted">??nh gi?ed</p>
                                </div>
                            @else
                                <p class="text-[14px] font-medium text-text transition-colors group-hover:text-accent">
                                    Leave a review â†’
                                </p>
                            @endif
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    {{-- Lu?t s? we recommend --}}
    <div class="mt-24">
        <div class="flex items-end justify-between">
            <h2 class="font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">Lu?t s? chúng tôi khuyên bạn nên</h2>
            <x-button variant="ghost" href="{{ route('lawyers.index') }}">Xem tất cả luật sư â†’</x-button>
        </div>

        <div class="mt-12 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($featuredLu?t s? as $featured)
                <x-lawyer-card :lawyer="$featured" />
            @endforeach
        </div>
    </div>
</section>
@endsection

@extends('layouts.app', ['title' => 'Câu hỏi thường gặp · LegalEase'])

@php
    $sections = [
        [
            'title' => 'Đặt chỗ và thanh toán',
            'items' => [
                [
                    'q' => 'Làm thế nào để đặt lịch tư vấn?',
                    'a' => "Browse lawyers by specialty, location, and price. Pick a lawyer, choose a time slot on their profile, then confirm your details. We'll hold a 20% deposit at booking.",
                ],
                [
                    'q' => "What's the deposit?",
                    'a' => 'Khi bạn xác nhận đặt phòng, chúng tôi giữ 20% phí tư vấn làm tiền đặt cọc. 80% còn lại được thanh toán trực tiếp cho luật sư tại thời điểm bổ nhiệm.',
                ],
                [
                    'q' => 'Khi nào tôi thanh toán phần còn lại?',
                    'a' => 'Tại cuộc hẹn. Nền tảng chỉ giữ tiền gửi; số dư được giải quyết trực tiếp giữa bạn và luật sư.',
                ],
                [
                    'q' => 'Những phương thức thanh toán nào bạn chấp nhận?',
                    'a' => 'Các loại thẻ tín dụng và thẻ ghi nợ phổ biến, cộng với các phương thức thanh toán địa phương của Việt Nam bao gồm chuyển khoản ngân hàng và ví điện tử phổ biến.',
                ],
            ],
        ],
        [
            'title' => 'H?ylations và hoàn lại tiền',
            'items' => [
                [
                    'q' => 'Làm cách nào để hủy đặt chỗ?',
                    'a' => "From your dashboard, open the booking and click cancel. We'll process the cancellation according to our refund policy.",
                ],
                [
                    'q' => 'Tôi có lấy lại được tiền đặt cọc không?',
                    'a' => 'H?y hơn 24 giờ trước cuộc hẹn và bạn sẽ được hoàn lại toàn bộ số tiền. H?y trong vòng 24 giờ và tiền đặt cọc sẽ bị mất (với một số trường hợp ngoại lệ).',
                ],
                [
                    'q' => 'Nếu luật sư của tôi hủy bỏ thì sao?',
                    'a' => "You'll receive a full refund of the deposit and we'll help you find an alternative lawyer if you'd like.",
                ],
                [
                    'q' => "What if I don't show up?",
                    'a' => 'Tiền đặt cọc bị mất. Nền tảng giữ lại 75% và luật sư nhận được 25% dưới dạng bồi thường cho thời gian dành riêng.',
                ],
            ],
        ],
        [
            'title' => 'Dành cho luật sư',
            'items' => [
                [
                    'q' => 'Làm cách nào để đăng ký tham gia?',
                    'a' => "Visit our For Lu?t s? page and submit an application. We'll review your bar credentials and respond within a few business days.",
                ],
                [
                    'q' => 'Quá trình xác minh mất bao lâu?',
                    'a' => "Usually 2 to 3 business days. Complex cases may take longer; we'll update you if we need more time.",
                ],
                [
                    'q' => 'Khi nào tôi được trả tiền?',
                    'a' => 'Phần lớn phí của bạn (80%) được khách hàng thanh toán trực tiếp tại cuộc hẹn. Tiền gửi nền tảng được thanh toán vào tài khoản của bạn hàng tuần.',
                ],
                [
                    'q' => 'Tôi có thể đặt mức giá của riêng mình không?',
                    'a' => "Yes. You set your hourly rate when you list and can update it any time, though changes don't affect existing bookings.",
                ],
            ],
        ],
        [
            'title' => 'Sự tin cậy và an toàn',
            'items' => [
                [
                    'q' => 'Luật sư được xác minh như thế nào?',
                    'a' => "Every lawyer on the platform has had their bar membership and credentials reviewed by our team before being listed. We re-verify periodically.",
                ],
                [
                    'q' => 'Việc tư vấn của tôi có được bảo mật không?',
                    'a' => 'Đúng. Việc tư vấn là giữa bạn và luật sư của bạn, được bảo vệ bởi đặc quyền của luật sư-khách hàng theo luật pháp Việt Nam.',
                ],
                [
                    'q' => 'Đánh giá hoạt động như thế nào?',
                    'a' => 'Sau khi tư vấn xong, khách hàng có thể để lại đánh giá bằng văn bản và xếp hạng từ 1 đến 5 sao. ??nh gi?s phải trung thực và dựa trên kinh nghiệm trực tiếp. Lu?t s? có thể gắn cờ các đánh giá không phù hợp để nhóm của chúng tôi xem xét.',
                ],
            ],
        ],
    ];
@endphp

@section('content')
    {{-- Hero --}}
    <section class="relative -mt-[72px] flex min-h-[64vh] items-center overflow-hidden">
        <img src="https://images.unsplash.com/photo-1501504905252-473c47e087f8?q=80"
             alt=""
             class="absolute inset-0 h-full w-full object-cover grayscale">
        <div class="absolute inset-0 bg-gradient-to-b from-bg/70 via-bg/55 to-bg"></div>

        <div class="relative mx-auto max-w-[1280px] px-8 pt-24 text-center">
            <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">FAQ</p>
            <h1 class="mx-auto mt-6 max-w-[920px] font-display text-[52px] font-medium leading-[1.05] tracking-[-0.02em] md:text-[80px]">
                Common questions.
            </h1>
        </div>
    </section>

    {{-- Sections --}}
    @foreach ($sections as $i => $section)
        <section class="mx-auto max-w-[760px] px-8 pt-24">
            <h2 class="font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">{{ $section['title'] }}</h2>
            <div class="mt-12 border-t border-text/10">
                @foreach ($section['items'] as $item)
                    <div x-data="{ open: false }" class="border-b border-text/10">
                        <button type="button" @click="open = !open"
                                class="flex w-full items-baseline justify-between gap-6 py-6 text-left transition-colors hover:text-accent">
                            <span class="font-display text-[18px] font-medium tracking-tight md:text-[20px]">{{ $item['q'] }}</span>
                            <svg x-show="!open" class="h-5 w-5 flex-none text-muted"
                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round">
                                <line x1="12" y1="5" x2="12" y2="19"/>
                                <line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                            <svg x-show="open" x-cloak class="h-5 w-5 flex-none text-muted"
                                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round">
                                <line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                        </button>
                        <div x-show="open" x-cloak class="pb-6">
                            <p class="max-w-[640px] text-[15px] leading-relaxed text-secondary">{{ $item['a'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endforeach

    {{-- Closing CTA --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-32 pb-24 text-center">
        <h2 class="font-display text-[40px] font-medium leading-[1.05] tracking-[-0.02em] md:text-[52px]">
            Still have questions?
        </h2>
        <div class="mt-10 flex justify-center">
            <x-button variant="primary" href="{{ route('contact') }}">Lý?n h? hỗ trợ †'</x-button>
        </div>
    </section>
@endsection

@extends('layouts.app', ['title' => 'Vì Lu?t s? Â · Dễ dàng pháp lý'])

@php
    $valueProps = [
        [
            'title' => 'Chỉ khách hàng đã được xác minh',
            'desc'  => 'Mọi khách hàng đều được xem xét trước khi họ có thể đặt chỗ. Không có thư rác, không lãng phí thời gian.',
        ],
        [
            'title' => 'Đặt tỷ lệ của riêng bạn',
            'desc'  => "Choose your hourly fee. We don't take a cut of your consultation fee.",
        ],
        [
            'title' => 'Tính khả dụng theo thời gian thực',
            'desc'  => 'Quản lý thời điểm của bạn từ một lịch. Khách hàng chỉ nhìn thấy những gì bạn xuất bản.',
        ],
        [
            'title' => 'Không có độc quyền',
            'desc'  => 'Liệt kê với LegalEase cùng với hoạt động hiện tại của bạn. Không có cam kết về số lượng.',
        ],
    ];

    $steps = [
        [
            'n'     => '01',
            'title' => 'Áp dụng',
            'desc'  => 'G?i thông tin xác thực thanh và thông tin cơ bản của bạn.',
        ],
        [
            'n'     => '02',
            'title' => 'Xác minh',
            'desc'  => 'Nhóm của chúng tôi xem xét và phê duyệt trong vòng vài ngày làm việc.',
        ],
        [
            'n'     => '03',
            'title' => 'Liệt kê và kiếm tiền',
            'desc'  => 'Đặt phòng trống, phí và bắt đầu nhận đặt chỗ.',
        ],
    ];
@endphp

@section('content')
    {{-- Hero: full-bleed photo --}}
    <section class="relative -mt-[72px] flex min-h-screen items-center overflow-hidden">
        <img src="https://images.unsplash.com/photo-1668239596261-62f94059533e?q=80&w=2671&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
             alt=""
             class="absolute inset-0 h-full w-full object-cover grayscale">
        <div class="absolute inset-0 bg-gradient-to-b from-bg/70 via-bg/55 to-bg"></div>

        <div class="relative mx-auto max-w-[1280px] px-8 pt-24 text-center">
            <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">For lawyers</p>

            <h1 class="mx-auto mt-6 max-w-[920px] font-display text-[52px] font-medium leading-[1.05] tracking-[-0.02em] md:text-[80px]">
                Build your practice on LegalEase.
            </h1>
        </div>
    </section>

    {{-- Trust strip --}}
    <section class="bg-surface">
        <div class="mx-auto flex h-24 max-w-[1280px] items-center justify-center px-8">
            <div class="grid w-full grid-cols-1 divide-y divide-text/10 md:grid-cols-3 md:divide-x md:divide-y-0">
                <div class="flex flex-col items-center px-6 py-4 md:py-0">
                    <p class="font-display text-[36px] font-medium leading-none tracking-tight">500+</p>
                    <p class="mt-2 text-[14px] text-muted">Lu?t s? trên nền tảng</p>
                </div>
                <div class="flex flex-col items-center px-6 py-4 md:py-0">
                    <p class="font-display text-[36px] font-medium leading-none tracking-tight">12</p>
                    <p class="mt-2 text-[14px] text-muted">Các thành phố trên khắp Việt Nam</p>
                </div>
                <div class="flex flex-col items-center px-6 py-4 md:py-0">
                    <p class="font-display text-[36px] font-medium leading-none tracking-tight">10,000+</p>
                    <p class="mt-2 text-[14px] text-muted">Consultations completed</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Why list with us --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-24">
        <h2 class="font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">Tại sao liệt kê với chúng tôi</h2>

        <div class="mt-12 grid gap-6 md:grid-cols-2 lg:grid-cols-4">
            @foreach ($valueProps as $v)
                <div class="rounded-2xl border border-text/10 bg-surface p-6">
                    <h3 class="font-display text-[24px] font-medium tracking-tight">{{ $v['title'] }}</h3>
                    <p class="mt-2 text-[14px] leading-relaxed text-muted">{{ $v['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Lawyer testimonial --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-24">
        <div class="border-y border-text/10 py-20 md:py-24">
            <blockquote class="mx-auto max-w-[900px] text-center font-display text-[32px] font-medium italic leading-[1.2] tracking-[-0.01em] md:text-[44px]">
                <span class="text-muted">â€œ</span>Sáu tháng sau, một nửa số khách hàng mới của tôi đến từ LegalEase. Việc xác minh đã cho tôi sự tin cậy mà tôi không thể mua được.<span class="text-muted">â€</span>
            </blockquote>
            <p class="mt-8 text-center text-[12px] font-medium uppercase tracking-[0.1em] text-muted">
                LÃª VÄƒn Thanh, Civil Litigation, Ho Chi Minh City
            </p>
        </div>
    </section>

    {{-- How it works --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-24">
        <h2 class="font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">Nó hoạt động như thế nào</h2>

        <div class="relative mt-12 grid gap-12 md:grid-cols-3">
            <div aria-hidden="true"
                 class="pointer-events-none absolute left-0 right-0 top-6 hidden h-px bg-text/10 md:block"></div>

            @foreach ($steps as $step)
                <div class="relative">
                    <div class="flex h-12 w-12 items-center justify-center rounded-full border border-accent bg-bg text-[14px] font-medium text-accent">
                        {{ $step['n'] }}
                    </div>
                    <h3 class="mt-6 font-display text-[24px] font-medium tracking-tight">{{ $step['title'] }}</h3>
                    <p class="mt-2 max-w-sm text-[15px] leading-relaxed text-secondary">{{ $step['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Closing CTA --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-32 pb-24 text-center">
        <h2 class="font-display text-[40px] font-medium leading-[1.05] tracking-[-0.02em] md:text-[52px]">
            Ready to grow your practice?
        </h2>
        <div class="mt-10 flex justify-center">
            <x-button variant="primary" href="{{ route('lawyer.register') }}">Đăng ký tham gia †'</x-button>
        </div>
    </section>
@endsection

@extends('layouts.app', ['title' => 'Qu?n m?t kh?u Â · LegalEase'])

@php
    $initialState = [
        'email'   => old('email', ''),
        'touched' => [
            'email' => old('email') !== null || $errors->has('email'),
        ],
    ];
@endphp

@section('content')
<section class="relative -mt-[72px] flex min-h-screen flex-col md:flex-row">
    {{-- Photo --}}
    <div class="relative h-[35vh] overflow-hidden md:sticky md:top-0 md:h-screen md:flex-1">
        <img src="https://images.unsplash.com/photo-1724832228136-6ddd51037827?q=80"
             alt=""
             class="absolute inset-0 h-full w-full object-cover grayscale">
    </div>

    {{-- Form --}}
    <div class="flex flex-1 items-center justify-center px-6 py-16 md:py-20">
        <div class="w-full max-w-[440px]">
            @if (session('reset_link_sent'))
                <h1 class="font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">Kiểm tra email của bạn</h1>
                <p class="mt-4 text-[15px] text-secondary">
                    If an account exists for <span class="text-text">{{ session('reset_link_sent') }}</span>, chúng tôi đã gửi liên kết để đặt lại mật khẩu của bạn. Liên kết sẽ hết hạn sau 60 phút.
                </p>
                <p class="mt-3 text-[14px] text-muted">
                    Didn't get it? Check your spam folder, or
                    <a href="{{ route('password.request') }}" class="text-text transition-colors hover:text-accent">try again</a>.
                </p>

                <div class="mt-10">
                    <a href="{{ route('login') }}" class="text-[14px] text-muted transition-colors hover:text-accent">
                        â† Quay l?i to login
                    </a>
                </div>
            @else
                <h1 class="font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">Qu?n m?t kh?u?</h1>
                <p class="mt-2 text-[15px] text-secondary">Nhập email liên kết với tài khoản của bạn và chúng tôi sẽ gửi liên kết để thiết lập một liên kết mới.</p>

                <form method="POST" action="{{ route('password.email') }}" class="mt-8 space-y-5" novalidate
                      x-data="forgotM?t kh?uValidation({{ json_encode($initialState) }})"
                      @submit="markAllTouched()">
                    @csrf

                    <div>
                        <label for="email" class="block text-[13px] font-medium text-muted">
                            Email
                            <span x-show="!isEmailValid && !touched.email" class="text-gold">*</span>
                            <svg x-show="emailL?i" x-cloak class="inline-block h-3 w-3 align-middle text-error" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                            <svg x-show="isEmailValid" x-cloak class="inline-block h-3 w-3 align-middle text-success" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        </label>
                        <input id="email" type="email" name="email" x-model="email" @blur="touched.email = true" required
                               placeholder="you@example.com"
                               class="mt-2 block w-full rounded-xl border border-text/10 bg-surface px-4 py-3 text-[15px] text-text placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                        @unless ($errors->có('email'))
                            <p x-show="emailL?i" x-cloak x-text="emailL?i" class="mt-2 text-[13px] text-error"></p>
                        @endunless
                        @error('email') <p class="mt-2 text-[13px] text-error">{{ $message }}</p> @enderror
                    </div>

                    <x-button variant="primary" type="submit" class="w-full">Gửi liên kết đặt lại</x-button>

                    <p class="text-center text-[14px] text-muted">
                        Remembered it?
                        <a href="{{ route('login') }}" class="text-text transition-colors hover:text-accent">Log in</a>
                    </p>
                </form>
            @endif
        </div>
    </div>
</section>

<script>
    function forgotM?t kh?uValidation(initial) {
        return {
            email: initial.email || '',

            touched: Object.assign({ email: false }, initial.touched || {}),

            markAllTouched() {
                Object.keys(this.touched).forEach((k) => { this.touched[k] = true; });
            },

            get isEmailValid() {
                return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.email);
            },
            get emailL?i() {
                if (!this.touched.email || this.isEmailValid) return '';
                if (this.email.length === 0) return 'Vui l?ng nh?p ??a ch? email.';
                return 'Vui l?ng nh?p ??a ch? email h?p l?.';
            },
        };
    }
</script>
@endsection

@extends('layouts.app')

@php
    $practiceAreas = \App\Data\PracticeAreas::all();
    $featuredLu?t s? = \App\Data\Lu?t s?::featured(3);
@endphp

@section('content')
    {{-- Hero --}}
    <section class="relative mx-auto flex min-h-[85vh] max-w-[1280px] items-center px-8 py-20">
        <div class="grid w-full items-center gap-12 md:grid-cols-5">
            <div class="md:col-span-3">
                <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">
                    Trusted legal consultation
                </p>

                <h1 class="mt-6 font-display text-[64px] font-medium leading-[1.02] tracking-[-0.03em] md:text-[80px]">
                    Find the right lawyer, for the moment that matters.
                </h1>

                <p class="mt-6 max-w-xl text-[18px] leading-relaxed text-secondary">
                    Transparent pricing. Verified credentials. Real-time availability. Meet Vietnam's most trusted legal professionals on your terms.
                </p>

                <div class="mt-10 flex flex-wrap items-center gap-4">
                    <x-button variant="primary" href="/lawyers">Tìm kiếm luật sư â†’</x-button>
                    <x-button variant="ghost" href="#how-it-works">Nó hoạt động như thế nào</x-button>
                </div>
            </div>

            <div class="md:col-span-2">
                <div class="relative">
                    <div aria-hidden="true"
                         class="pointer-events-none absolute -inset-10 rounded-full bg-gradient-to-br from-muted to-accent opacity-15 blur-3xl"></div>
                    <img src="https://images.unsplash.com/photo-1758518727600-2c5f48419eac?q=80"
                         alt=""
                         class="relative aspect-[3/4] w-full rounded-2xl object-cover grayscale">
                </div>
            </div>
        </div>
    </section>

    {{-- Trust strip --}}
    <section class="bg-surface">
        <div class="mx-auto flex h-24 max-w-[1280px] items-center justify-center px-8">
            <div class="grid w-full grid-cols-1 divide-y divide-text/10 md:grid-cols-3 md:divide-x md:divide-y-0">
                <div class="flex flex-col items-center px-6 py-4 md:py-0">
                    <p class="font-display text-[36px] font-medium leading-none tracking-tight">500+</p>
                    <p class="mt-2 text-[14px] text-muted">Verified lawyers</p>
                </div>
                <div class="flex flex-col items-center px-6 py-4 md:py-0">
                    <p class="font-display text-[36px] font-medium leading-none tracking-tight">4.8</p>
                    <p class="mt-2 text-[14px] text-muted">Average rating</p>
                </div>
                <div class="flex flex-col items-center px-6 py-4 md:py-0">
                    <p class="font-display text-[36px] font-medium leading-none tracking-tight">10,000+</p>
                    <p class="mt-2 text-[14px] text-muted">Consultations completed</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Practice areas --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-24">
        <div class="flex items-end justify-between">
            <h2 class="font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">Các lĩnh vực chúng tôi đảm nhiệm</h2>
            <x-button variant="ghost" href="/legal-services">Xem tất cả các lĩnh vực †'</x-button>
        </div>

        <div class="mt-12 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($practiceAreas as $area)
                <div class="rounded-2xl border border-text/10 bg-surface p-8">
                    <x-icon :name="$area['icon']" :size="32" class="text-accent" />
                    <h3 class="mt-6 font-display text-[24px] font-medium tracking-tight">{{ $area['name'] }}</h3>
                    <p class="mt-2 text-[14px] text-muted">{{ $area['description'] }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Featured lawyers --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-24">
        <div class="flex items-end justify-between">
            <h2 class="font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">Featured lawyers</h2>
            <x-button variant="ghost" href="/lawyers">Xem tất cả luật sư â†’</x-button>
        </div>

        <div class="mt-12 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($featuredLu?t s? as $lawyer)
                <x-lawyer-card :lawyer="$lawyer" />
            @endforeach
        </div>
    </section>

    {{-- How it works --}}
    <section id="how-it-works" class="mx-auto max-w-[1280px] px-8 py-24">
        <h2 class="font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">Nó hoạt động như thế nào</h2>

        @php
            $steps = [
                ['n' => '01', 'title' => 'T?m ki?m',  'text' => 'Hãy cho chúng tôi biết khu vực pháp lý và thời gian ưa thích của bạn.'],
                ['n' => '02', 'title' => 'Chọn',  'text' => '??nh gi? hồ sơ, xếp hạng và tính khả dụng theo thời gian thực.'],
                ['n' => '03', 'title' => 'Gặp',    'text' => 'Xác nhận tư vấn 60 phút của bạn.'],
            ];
        @endphp

        <div class="relative mt-12 grid gap-12 md:grid-cols-3">
            <div aria-hidden="true"
                 class="pointer-events-none absolute left-0 right-0 top-6 hidden h-px bg-text/10 md:block"></div>

            @foreach ($steps as $step)
                <div class="relative">
                    <div class="flex h-12 w-12 items-center justify-center rounded-full border border-accent bg-bg text-[14px] font-medium text-accent">
                        {{ $step['n'] }}
                    </div>
                    <h3 class="mt-6 font-display text-[24px] font-medium tracking-tight">{{ $step['title'] }}</h3>
                    <p class="mt-2 max-w-sm text-[15px] leading-relaxed text-secondary">{{ $step['text'] }}</p>
                </div>
            @endforeach
        </div>
    </section>
@endsection

@extends('layouts.app', ['title' => 'Xác minh thông tin đăng nhập của bạn · LegalEase'])

@php
    $documents = [
        [
            'id'    => 'bar_card',
            'name'  => 'bar_card',
            'label' => 'Quét thẻ thanh',
            'desc'  => 'Bản scan hoặc ảnh rõ ràng về thẻ thành viên quán bar hiện tại của bạn.',
        ],
        [
            'id'    => 'identity_document',
            'name'  => 'identity_document',
            'label' => 'Giấy tờ tùy thân',
            'desc'  => 'CMND hoặc hộ chiếu Việt Nam. Ảnh hoặc PDF.',
        ],
        [
            'id'    => 'education_certificate',
            'name'  => 'education_certificate',
            'label' => 'Chứng chỉ giáo dục',
            'desc'  => 'Bằng cấp trường luật của bạn hoặc bằng cấp tương đương.',
        ],
    ];
@endphp

@section('content')
{{-- Visual strip --}}
<div class="relative -mt-[72px] h-[280px] overflow-hidden">
    <img src="https://images.unsplash.com/photo-1450101499163-c8848c66ca85?q=80"
         alt=""
         class="absolute inset-0 h-full w-full object-cover grayscale brightness-[0.55]">
    <div class="absolute inset-0 bg-gradient-to-b from-bg/40 via-bg/20 to-bg"></div>
</div>

<section class="mx-auto max-w-[760px] px-8 pt-24 pb-24">
    <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Lawyer onboarding</p>
    <h1 class="mt-3 font-display text-[40px] font-medium tracking-[-0.02em] md:text-[48px]">
        G?i your documents
    </h1>
    <p class="mt-4 max-w-[560px] text-[17px] text-secondary">
        We need three documents to verify your bar membership and identity. ??nh gi?ed within 2 to 3 business days. Your information is held securely and only seen by our verification team.
    </p>

    <form method="POST" action="{{ route('lawyer.credentials.store') }}" enctype="multipart/form-data" class="mt-12 space-y-6" novalidate>
        @csrf

        @foreach ($documents as $doc)
            <div class="rounded-2xl border border-text/10 bg-surface p-6" x-data="{ filename: '' }">
                <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                    <div class="min-w-0">
                        <label for="{{ $doc['id'] }}" class="block text-[15px] font-medium text-text">
                            {{ $doc['label'] }} <span class="text-gold">*</span>
                        </label>
                        <p class="mt-1 text-[13px] text-muted">{{ $doc['desc'] }}</p>
                        <p class="mt-2 truncate text-[13px] text-secondary" x-show="filename" x-cloak>
                            <span x-text="filename"></span>
                        </p>
                    </div>
                    <div class="flex-none">
                        <input id="{{ $doc['id'] }}" type="file" name="{{ $doc['name'] }}"
                               accept="image/*,.pdf" required
                               class="hidden"
                               x-on:change="filename = $event.target.files[0]?.name || ''">
                        <label for="{{ $doc['id'] }}"
                               class="inline-flex cursor-pointer items-center rounded-full border border-muted px-6 py-3 text-[14px] font-medium text-text transition-colors hover:border-accent hover:text-accent">
                            <span x-text="filename ? 'Change file' : 'Choose file'">Choose file</span>
                        </label>
                    </div>
                </div>
                <p class="mt-3 text-[12px] text-muted">PDF, JPG hoặc PNG. Tối đa 10 MB.</p>
            </div>
        @endforeach

        <div class="pt-4">
            <x-button variant="primary" type="submit" class="w-full">G?i để xem xét</x-button>
        </div>

        <p class="text-center text-[14px]">
            <a href="{{ route('lawyer.dashboard') }}" class="text-muted transition-colors hover:text-accent">
                Quay l?i to dashboard
            </a>
        </p>
    </form>
</section>
@endsection

@extends('layouts.app', ['title' => 'Bảng thông tin luật sư Â · LegalEase'])

@php
    $user = auth()->user();
    $firstH? t?n = explode(' ', trim($user->name))[0];

    $appointments = collect(\App\Data\LawyerL?ch h?ns::withSessionOutcomes());

    $upcoming = $appointments->filter(function ($a) {
        $start = \Carbon\Carbon::parse($a['date'] . ' ' . $a['time']);
        return $a['status'] === 'CONFIRMED' && $start->isFuture();
    })->sortBy('date')->values();

    $awaitingOutcome = $appointments->filter(function ($a) {
        $start = \Carbon\Carbon::parse($a['date'] . ' ' . $a['time']);
        return $a['status'] === 'CONFIRMED' && $start->is?? qua();
    })->sortByDesc('date')->values();

    $reported = $appointments->filter(function ($a) {
        return in_array($a['status'], ['COMPLETED', 'NO_SHOW_BY_CUSTOMER'], true);
    })->sortByDesc('date')->values();
@endphp

@section('content')
{{-- Visual strip --}}
<div class="relative -mt-[72px] h-[280px] overflow-hidden">
    <img src="https://images.unsplash.com/photo-1714974528749-fc028e54feb9?q=80"
         alt=""
         class="absolute inset-0 h-full w-full object-cover grayscale brightness-[0.55]">
    <div class="absolute inset-0 bg-gradient-to-b from-bg/40 via-bg/20 to-bg"></div>
</div>

<section class="mx-auto max-w-[1280px] px-8 pt-24 pb-24">
    @if (session('status'))
        <div class="mb-12 rounded-2xl border border-success/40 bg-surface px-6 py-4">
            <p class="text-[14px] text-success">{{ session('status') }}</p>
        </div>
    @endif

    {{-- Header --}}
    <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Welcome back</p>
    <h1 class="mt-3 font-display text-[48px] font-medium tracking-[-0.02em] md:text-[56px]">
        Hi, {{ $firstH? t?n }}.
    </h1>
    <p class="mt-4 max-w-[560px] text-[17px] text-secondary">
        @if ($upcoming->isEmpty() && $awaitingOutcome->isEmpty())
            No appointments on the books right now. Open up more time to receive new bookings.
        @else
            Here's what's on your schedule.
        @endif
    </p>

    {{-- Awaiting outcome --}}
    @if ($awaitingOutcome->isNotEmpty())
        <div class="mt-16">
            <h2 class="font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">Đang chờ kết quả của bạn</h2>
            <p class="mt-3 max-w-[560px] text-[15px] text-secondary">
                These appointments have passed. Report whether each one took place so the customer can leave a review.
            </p>

            <div class="mt-12 space-y-4">
                @foreach ($awaitingOutcome as $appt)
                    <a href="{{ route('lawyer.appointments.show', $appt['booking_code']) }}"
                       class="group block rounded-2xl border border-gold/40 bg-surface p-6 transition-colors hover:border-gold ">
                        <div class="grid gap-6 md:grid-cols-[260px_1fr_auto] md:items-center">
                            {{-- Customer --}}
                            <div class="flex items-center gap-4">
                                <div class="flex h-14 w-14 flex-none items-center justify-center rounded-full bg-avatar">
                                    <span class="font-display text-[15px] font-medium text-text">{{ $appt['customer_initials'] }}</span>
                                </div>
                                <div class="min-w-0">
                                    <p class="font-display text-[18px] font-medium tracking-tight">{{ $appt['customer_name'] }}</p>
                                    <p class="text-[13px] text-muted">{{ $appt['customer_phone'] }}</p>
                                </div>
                            </div>

                            {{-- When --}}
                            <div class="md:flex md:h-24 md:flex-col md:justify-center md:border-l md:border-text/10 md:pl-6">
                                <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">L?ch h?n</p>
                                <p class="mt-1 font-display text-[16px] font-medium tracking-tight">
                                    {{ \Carbon\Carbon::parse($appt['date'])->format('M j, Y') }} Â· {{ \Carbon\Carbon::createFromFormat('H:i', $appt['time'])->format('g:i A') }}
                                </p>
                                <p class="text-[12px] text-muted">{{ $appt['booking_code'] }}</p>
                            </div>

                            {{-- Action --}}
                            <div class="md:text-right">
                                <p class="text-[14px] font-medium text-gold transition-colors group-hover:text-text">
                                    Report outcome â†’
                                </p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

    {{-- S?p t?i --}}
    <div class="mt-24">
        <h2 class="font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">S?p t?i cuộc hẹn</h2>

        @if ($upcoming->isEmpty())
            <p class="mt-12 text-[15px] text-muted">Không có cuộc hẹn sắp tới.</p>
        @else
            <div class="mt-12 space-y-4">
                @foreach ($upcoming as $appt)
                    <a href="{{ route('lawyer.appointments.show', $appt['booking_code']) }}"
                       class="group block rounded-2xl border border-text/10 bg-surface p-6 transition-colors hover:border-accent ">
                        <div class="grid gap-6 md:grid-cols-[260px_1fr_auto] md:items-center">
                            {{-- Customer --}}
                            <div class="flex items-center gap-4">
                                <div class="flex h-14 w-14 flex-none items-center justify-center rounded-full bg-avatar">
                                    <span class="font-display text-[15px] font-medium text-text">{{ $appt['customer_initials'] }}</span>
                                </div>
                                <div class="min-w-0">
                                    <p class="font-display text-[18px] font-medium tracking-tight">{{ $appt['customer_name'] }}</p>
                                    <p class="text-[13px] text-muted">{{ $appt['customer_phone'] }}</p>
                                </div>
                            </div>

                            {{-- When --}}
                            <div class="md:flex md:h-24 md:flex-col md:justify-center md:border-l md:border-text/10 md:pl-6">
                                <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">L?ch h?n</p>
                                <p class="mt-1 font-display text-[16px] font-medium tracking-tight">
                                    {{ \Carbon\Carbon::parse($appt['date'])->format('M j, Y') }} Â· {{ \Carbon\Carbon::createFromFormat('H:i', $appt['time'])->format('g:i A') }}
                                </p>
                                <p class="text-[12px] text-muted">{{ $appt['booking_code'] }}</p>
                            </div>

                            {{-- Status --}}
                            <div class="md:text-right">
                                <div class="inline-flex items-center gap-2 rounded-full border border-success/40 bg-success/10 px-3 py-1">
                                    <span class="block h-1.5 w-1.5 rounded-full bg-success"></span>
                                    <span class="text-[12px] font-medium text-success">?? x?c nh?n</span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>

    {{-- ?? qua --}}
    <div class="mt-24">
        <h2 class="font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">?? qua các cuộc hẹn</h2>

        @if ($reported->isEmpty())
            <p class="mt-12 text-[15px] text-muted">Chưa có cuộc hẹn nào trước đây.</p>
        @else
            <div class="mt-12 space-y-4">
                @foreach ($reported as $appt)
                    <a href="{{ route('lawyer.appointments.show', $appt['booking_code']) }}"
                       class="group block rounded-2xl border border-text/10 bg-surface p-6 transition-colors hover:border-accent ">
                        <div class="grid gap-6 md:grid-cols-[260px_1fr_auto] md:items-center">
                            {{-- Customer --}}
                            <div class="flex items-center gap-4">
                                <div class="flex h-14 w-14 flex-none items-center justify-center rounded-full bg-avatar">
                                    <span class="font-display text-[15px] font-medium text-text">{{ $appt['customer_initials'] }}</span>
                                </div>
                                <div class="min-w-0">
                                    <p class="font-display text-[18px] font-medium tracking-tight">{{ $appt['customer_name'] }}</p>
                                    <p class="text-[13px] text-muted">{{ $appt['customer_phone'] }}</p>
                                </div>
                            </div>

                            {{-- When --}}
                            <div class="md:flex md:h-24 md:flex-col md:justify-center md:border-l md:border-text/10 md:pl-6">
                                <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">L?ch h?n</p>
                                <p class="mt-1 font-display text-[16px] font-medium tracking-tight">
                                    {{ \Carbon\Carbon::parse($appt['date'])->format('M j, Y') }} Â· {{ \Carbon\Carbon::createFromFormat('H:i', $appt['time'])->format('g:i A') }}
                                </p>
                                <p class="text-[12px] text-muted">{{ $appt['booking_code'] }}</p>
                            </div>

                            {{-- Status --}}
                            <div class="md:text-right">
                                @if ($appt['status'] === 'COMPLETED')
                                    <div class="inline-flex items-center gap-2 rounded-full border border-success/40 bg-success/10 px-3 py-1">
                                        <span class="block h-1.5 w-1.5 rounded-full bg-success"></span>
                                        <span class="text-[12px] font-medium text-success">Ho?n t?t</span>
                                    </div>
                                @else
                                    <div class="inline-flex items-center gap-2 rounded-full border border-error/40 bg-error/10 px-3 py-1">
                                        <span class="block h-1.5 w-1.5 rounded-full bg-error"></span>
                                        <span class="text-[12px] font-medium text-error">Customer no-show</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection

@extends('layouts.app', ['title' => 'Luật sư đăng nhập Â · LegalEase'])

@section('content')
<section class="relative -mt-[72px] flex min-h-screen flex-col md:flex-row">
    {{-- Photo --}}
    <div class="relative h-[35vh] overflow-hidden md:sticky md:top-0 md:h-screen md:flex-1">
        <img src="https://images.unsplash.com/photo-1483600516620-7254872369ae?q=80"
             alt=""
             class="absolute inset-0 h-full w-full object-cover grayscale">
    </div>

    {{-- Form --}}
    <div class="flex flex-1 items-center justify-center px-6 py-16 md:py-20">
        <div class="w-full max-w-[440px]">
            <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">For lawyers</p>
            <h1 class="mt-3 font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">Log in</h1>
            <p class="mt-2 text-[15px] text-secondary">Quản lý các cuộc hẹn và tính khả dụng của bạn.</p>

            <form method="POST" action="{{ route('lawyer.login.store') }}" class="mt-8 space-y-5" novalidate>
                @csrf

                <div>
                    <label for="email" class="block text-[13px] font-medium text-muted">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                           placeholder="you@example.com"
                           class="mt-2 block w-full rounded-xl border border-text/10 bg-surface px-4 py-3 text-[15px] text-text placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                    @error('email') <p class="mt-2 text-[13px] text-error">{{ $message }}</p> @enderror
                </div>

                <div x-data="{ show: false }">
                    <label for="password" class="block text-[13px] font-medium text-muted">M?t kh?u</label>
                    <div class="relative mt-2">
                        <input id="password" name="password"
                               :type="show ? 'text' : 'password'"
                               placeholder="â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢"
                               class="block w-full rounded-xl border border-text/10 bg-surface px-4 py-3 pr-11 text-[15px] text-text placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                        <button type="button" @click="show = !show" aria-label="Toggle password"
                                class="absolute inset-y-0 right-0 flex items-center pr-3 text-muted hover:text-accent">
                            <svg x-show="!show" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/></svg>
                            <svg x-show="show" x-cloak class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M3 3l18 18M10.5 10.7A2 2 0 0012 14a2 2 0 001.3-.5M6.7 6.7C4.1 8.3 2 12 2 12s3.5 7 10 7a9.8 9.8 0 004.3-.9M9.9 5.1A10 10 0 0112 5c6.5 0 10 7 10 7a17 17 0 01-2.2 2.9"/></svg>
                        </button>
                    </div>
                    @error('password') <p class="mt-2 text-[13px] text-error">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center justify-between">
                    <label class="inline-flex items-center gap-2 text-[14px] text-muted">
                        <input type="checkbox" name="remember" value="1" class="h-4 w-4 rounded border-text/20 bg-surface text-accent focus:ring-accent">
                        <span>Remember me</span>
                    </label>
                    <a href="{{ route('password.request') }}" class="text-[14px] text-muted transition-colors hover:text-accent">Qu?n m?t kh?u?</a>
                </div>

                <x-button variant="primary" type="submit" class="w-full">Log in</x-button>

                <p class="text-center text-[14px] text-muted">
                    Don't have a lawyer account?
                    <a href="{{ route('lawyer.register') }}" class="text-text transition-colors hover:text-accent">Đăng ký tham gia</a>
                </p>
            </form>
        </div>
    </div>
</section>
@endsection

@extends('layouts.app', ['title' => 'Đăng ký tham gia Â · LegalEase'])

@php
    $initialState = [
        'firstH? t?n'     => old('first_name', ''),
        'lastH? t?n'      => old('last_name', ''),
        'email'         => old('email', ''),
        'phone'         => old('phone', ''),
        'barAssoc'      => old('bar_association', ''),
        'barCardNumber' => old('bar_card_number', ''),
        'termsAgreed'   => (bool) old('agreed_terms', false),
        'touched'       => [
            'firstH? t?n'       => old('first_name') !== null || $errors->has('first_name'),
            'lastH? t?n'        => old('last_name') !== null || $errors->has('last_name'),
            'email'           => old('email') !== null || $errors->has('email'),
            'phone'           => old('phone') !== null || $errors->has('phone'),
            'barAssoc'        => old('bar_association') !== null || $errors->has('bar_association'),
            'barCardNumber'   => old('bar_card_number') !== null || $errors->has('bar_card_number'),
            'password'        => $errors->has('password'),
            'passwordConfirm' => $errors->has('password'),
            'termsAgreed'     => old('agreed_terms') !== null || $errors->has('agreed_terms'),
        ],
    ];
@endphp

@section('content')
<section class="relative -mt-[72px] flex min-h-screen flex-col md:flex-row">
    {{-- Photo --}}
    <div class="relative h-[35vh] overflow-hidden md:sticky md:top-0 md:h-screen md:flex-1">
        <img src="https://images.unsplash.com/photo-1547179660-453ec5367aa3?q=80"
             alt=""
             class="absolute inset-0 h-full w-full object-cover grayscale">
    </div>

    {{-- Form --}}
    <div class="flex flex-1 items-center justify-center px-6 py-16 md:py-20">
        <div class="w-full max-w-[440px]">
            <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">For lawyers</p>
            <h1 class="mt-3 font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">Đăng ký tham gia</h1>
            <p class="mt-2 text-[15px] text-secondary">H? s?s được xem xét trước khi đi vào hoạt động. Chúng tôi sẽ liên lạc trong vòng vài ngày làm việc.</p>

            <form method="POST" action="{{ route('lawyer.register.store') }}" class="mt-8 space-y-5" novalidate
                  x-data="lawyerSignupValidation({{ json_encode($initialState) }})"
                  @submit="markAllTouched()">
                @csrf

                <div class="grid gap-5 md:grid-cols-2">
                    <div>
                        <label for="first_name" class="block text-[13px] font-medium text-muted">
                            T?n
                            <span x-show="!isFirstH? t?nValid && !touched.firstH? t?n" class="text-gold">*</span>
                            <svg x-show="firstH? t?nL?i" x-cloak class="inline-block h-3 w-3 align-middle text-error" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                            <svg x-show="isFirstH? t?nValid" x-cloak class="inline-block h-3 w-3 align-middle text-success" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        </label>
                        <input id="first_name" type="text" name="first_name" x-model="firstH? t?n" @blur="touched.firstH? t?n = true" required minlength="2" maxlength="20"
                               placeholder="Lan"
                               class="mt-2 block w-full rounded-xl border border-text/10 bg-surface px-4 py-3 text-[15px] text-text placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                        @unless ($errors->có('first_name'))
                            <p x-show="firstH? t?nL?i" x-cloak x-text="firstH? t?nL?i" class="mt-2 text-[13px] text-error"></p>
                        @endunless
                        @error('first_name') <p class="mt-2 text-[13px] text-error">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="last_name" class="block text-[13px] font-medium text-muted">
                            H?
                            <span x-show="!isLastH? t?nValid && !touched.lastH? t?n" class="text-gold">*</span>
                            <svg x-show="lastH? t?nL?i" x-cloak class="inline-block h-3 w-3 align-middle text-error" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                            <svg x-show="isLastH? t?nValid" x-cloak class="inline-block h-3 w-3 align-middle text-success" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        </label>
                        <input id="last_name" type="text" name="last_name" x-model="lastH? t?n" @blur="touched.lastH? t?n = true" required minlength="2" maxlength="20"
                               placeholder="Nguyá»…n"
                               class="mt-2 block w-full rounded-xl border border-text/10 bg-surface px-4 py-3 text-[15px] text-text placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                        @unless ($errors->có('last_name'))
                            <p x-show="lastH? t?nL?i" x-cloak x-text="lastH? t?nL?i" class="mt-2 text-[13px] text-error"></p>
                        @endunless
                        @error('last_name') <p class="mt-2 text-[13px] text-error">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-[13px] font-medium text-muted">
                        Email
                        <span x-show="!isEmailValid && !touched.email" class="text-gold">*</span>
                        <svg x-show="emailL?i" x-cloak class="inline-block h-3 w-3 align-middle text-error" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                        <svg x-show="isEmailValid" x-cloak class="inline-block h-3 w-3 align-middle text-success" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    </label>
                    <input id="email" type="email" name="email" x-model="email" @blur="touched.email = true" required
                           placeholder="you@example.com"
                           class="mt-2 block w-full rounded-xl border border-text/10 bg-surface px-4 py-3 text-[15px] text-text placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                    @unless ($errors->có('email'))
                        <p x-show="emailL?i" x-cloak x-text="emailL?i" class="mt-2 text-[13px] text-error"></p>
                    @endunless
                    @error('email') <p class="mt-2 text-[13px] text-error">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="phone" class="block text-[13px] font-medium text-muted">
                        ?i?n tho?i
                        <span x-show="!is?i?n tho?iValid && !touched.phone" class="text-gold">*</span>
                        <svg x-show="phoneL?i" x-cloak class="inline-block h-3 w-3 align-middle text-error" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                        <svg x-show="is?i?n tho?iValid" x-cloak class="inline-block h-3 w-3 align-middle text-success" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    </label>
                    <input id="phone" type="tel" name="phone" x-model="phone" @blur="touched.phone = true" required
                           placeholder="09xxxxxxxx"
                           pattern="[\d\+\s\-\(\)]{9,15}"
                           title="Digits, spaces, dashes, parentheses, and a leading + are allowed."
                           class="mt-2 block w-full rounded-xl border border-text/10 bg-surface px-4 py-3 text-[15px] text-text placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                    @unless ($errors->có('điện thoại'))
                        <p x-show="phoneL?i" x-cloak x-text="phoneL?i" class="mt-2 text-[13px] text-error"></p>
                    @endunless
                    @error('phone') <p class="mt-2 text-[13px] text-error">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="bar_association" class="block text-[13px] font-medium text-muted">
                        Bar association
                        <span x-show="!isBarAssocValid && !touched.barAssoc" class="text-gold">*</span>
                        <svg x-show="barAssocL?i" x-cloak class="inline-block h-3 w-3 align-middle text-error" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                        <svg x-show="isBarAssocValid" x-cloak class="inline-block h-3 w-3 align-middle text-success" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    </label>
                    <div class="relative mt-2">
                        <select id="bar_association" name="bar_association" x-model="barAssoc" @blur="touched.barAssoc = true" required
                                class="block w-full appearance-none rounded-xl border border-text/10 bg-surface px-4 py-3 pr-11 text-[15px] text-text focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                            <option value="">Select</option>
                            <option value="?o?n Lu?t s? H? N?i">?o?n L?t s? H? Bạn?</option>
                            <option value="?o?n Lu?t s? TP.HCM">?o?n Lu?t s? TP.HCM</option>
                        </select>
                        <span class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-muted">
                            <x-icon name="chevron-down" :size="16" />
                        </span>
                    </div>
                    @unless ($errors->có('bar_assocation'))
                        <p x-show="barAssocL?i" x-cloak x-text="barAssocL?i" class="mt-2 text-[13px] text-error"></p>
                    @endunless
                    @error('bar_association') <p class="mt-2 text-[13px] text-error">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="bar_card_number" class="block text-[13px] font-medium text-muted">
                        Bar card number
                        <span x-show="!isBarCardValid && !touched.barCardNumber" class="text-gold">*</span>
                        <svg x-show="barCardL?i" x-cloak class="inline-block h-3 w-3 align-middle text-error" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                        <svg x-show="isBarCardValid" x-cloak class="inline-block h-3 w-3 align-middle text-success" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    </label>
                    <input id="bar_card_number" type="text" name="bar_card_number" x-model="barCardNumber" @blur="touched.barCardNumber = true" required
                           placeholder="e.g. 12345/HN"
                           class="mt-2 block w-full rounded-xl border border-text/10 bg-surface px-4 py-3 text-[15px] text-text placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                    @unless ($errors->có('bar_card_number'))
                        <p x-show="barCardL?i" x-cloak x-text="barCardL?i" class="mt-2 text-[13px] text-error"></p>
                    @endunless
                    @error('bar_card_number') <p class="mt-2 text-[13px] text-error">{{ $message }}</p> @enderror
                </div>

                <div x-data="{ show: false }">
                    <label for="password" class="block text-[13px] font-medium text-muted">
                        M?t kh?u
                        <span x-show="!isM?t kh?uValid && !touched.password" class="text-gold">*</span>
                        <svg x-show="passwordL?i" x-cloak class="inline-block h-3 w-3 align-middle text-error" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                        <svg x-show="isM?t kh?uValid" x-cloak class="inline-block h-3 w-3 align-middle text-success" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    </label>
                    <div class="relative mt-2">
                        <input id="password" name="password" x-model="password" @blur="touched.password = true" required
                               :type="show ? 'text' : 'password'"
                               placeholder="â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢"
                               class="block w-full rounded-xl border border-text/10 bg-surface px-4 py-3 pr-11 text-[15px] text-text placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                        <button type="button" @click="show = !show" aria-label="Toggle password"
                                class="absolute inset-y-0 right-0 flex items-center pr-3 text-muted hover:text-accent">
                            <svg x-show="!show" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/></svg>
                            <svg x-show="show" x-cloak class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M3 3l18 18M10.5 10.7A2 2 0 0012 14a2 2 0 001.3-.5M6.7 6.7C4.1 8.3 2 12 2 12s3.5 7 10 7a9.8 9.8 0 004.3-.9M9.9 5.1A10 10 0 0112 5c6.5 0 10 7 10 7a17 17 0 01-2.2 2.9"/></svg>
                        </button>
                    </div>
                    <p class="mt-2 text-[12px] text-muted">Ít nhất 8 ký tự, bao gồm một chữ cái và một số.</p>
                    @unless ($errors->có('mật khẩu'))
                        <p x-show="passwordL?i" x-cloak x-text="passwordL?i" class="mt-2 text-[13px] text-error"></p>
                    @endunless
                    @error('password') <p class="mt-2 text-[13px] text-error">{{ $message }}</p> @enderror
                </div>

                <div x-data="{ show: false }">
                    <label for="password_confirmation" class="block text-[13px] font-medium text-muted">
                        X?c nh?n m?t kh?u
                        <span x-show="!isM?t kh?uConfirmValid && !touched.passwordConfirm" class="text-gold">*</span>
                        <svg x-show="passwordConfirmL?i" x-cloak class="inline-block h-3 w-3 align-middle text-error" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                        <svg x-show="isM?t kh?uConfirmValid" x-cloak class="inline-block h-3 w-3 align-middle text-success" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    </label>
                    <div class="relative mt-2">
                        <input id="password_confirmation" name="password_confirmation" x-model="passwordConfirm" @blur="touched.passwordConfirm = true" required
                               :type="show ? 'text' : 'password'"
                               placeholder="â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢"
                               class="block w-full rounded-xl border border-text/10 bg-surface px-4 py-3 pr-11 text-[15px] text-text placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                        <button type="button" @click="show = !show" aria-label="Toggle password"
                                class="absolute inset-y-0 right-0 flex items-center pr-3 text-muted hover:text-accent">
                            <svg x-show="!show" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/></svg>
                            <svg x-show="show" x-cloak class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M3 3l18 18M10.5 10.7A2 2 0 0012 14a2 2 0 001.3-.5M6.7 6.7C4.1 8.3 2 12 2 12s3.5 7 10 7a9.8 9.8 0 004.3-.9M9.9 5.1A10 10 0 0112 5c6.5 0 10 7 10 7a17 17 0 01-2.2 2.9"/></svg>
                        </button>
                    </div>
                    <p x-show="passwordConfirmL?i" x-cloak x-text="passwordConfirmL?i" class="mt-2 text-[13px] text-error"></p>
                </div>

                <div>
                    <label class="flex items-start gap-2 text-[13px] text-muted">
                        <input type="checkbox" name="agreed_terms" value="1" x-model="termsAgreed" @change="touched.termsAgreed = true" required class="mt-0.5 h-4 w-4 rounded border-text/20 bg-surface text-accent focus:ring-accent">
                        <span>
                            I agree to the
                            <a href="{{ route('terms') }}" class="text-text transition-colors hover:text-accent">?i?u kho?n d?ch v?</a>
                            and
                            <a href="{{ route('privacy') }}" class="text-text transition-colors hover:text-accent">Ch?nh s?ch b?o m?t</a>.
                            <span x-show="!isTermsValid && !touched.termsAgreed" class="text-gold">*</span>
                            <svg x-show="termsL?i" x-cloak class="inline-block h-3 w-3 align-middle text-error" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                            <svg x-show="isTermsValid" x-cloak class="inline-block h-3 w-3 align-middle text-success" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        </span>
                    </label>
                    @unless ($errors->đã ('đồng ý_terms'))
                        <p x-show="termsL?i" x-cloak x-text="termsL?i" class="mt-2 text-[13px] text-error"></p>
                    @endunless
                    @error('agreed_terms') <p class="mt-2 text-[13px] text-error">{{ $message }}</p> @enderror
                </div>

                <x-button variant="primary" type="submit" class="w-full">ứng dụng G?i</x-button>

                <p class="text-center text-[14px] text-muted">
                    Already have a lawyer account?
                    <a href="{{ route('lawyer.login') }}" class="text-text transition-colors hover:text-accent">Log in</a>
                </p>
            </form>
        </div>
    </div>
</section>

<script>
    function lawyerSignupValidation(initial) {
        return {
            firstH? t?n: initial.firstH? t?n || '',
            lastH? t?n: initial.lastH? t?n || '',
            email: initial.email || '',
            phone: initial.phone || '',
            barAssoc: initial.barAssoc || '',
            barCardNumber: initial.barCardNumber || '',
            password: '',
            passwordConfirm: '',
            termsAgreed: initial.termsAgreed || false,

            touched: Object.assign({
                firstH? t?n: false,
                lastH? t?n: false,
                email: false,
                phone: false,
                barAssoc: false,
                barCardNumber: false,
                password: false,
                passwordConfirm: false,
                termsAgreed: false,
            }, initial.touched || {}),

            markAllTouched() {
                Object.keys(this.touched).forEach((k) => { this.touched[k] = true; });
            },

            get isFirstH? t?nValid() {
                const trimmed = this.firstH? t?n.trim();
                return trimmed.length >= 2 && đã cắt.length <= 20;
            },
            get isLastH? t?nValid() {
                const trimmed = this.lastH? t?n.trim();
                return trimmed.length >= 2 && đã cắt.length <= 20;
            },
            get isEmailValid() {
                return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.email);
            },
            get is?i?n tho?iValid() {
                return /^[\d\+\s\-\(\)]{9,15}$/.test(this.phone);
            },
            get isBarAssocValid() {
                return this.barAssoc.trim().length > 0;
            },
            get isBarCardValid() {
                return this.barCardNumber.trim().length > 0;
            },
            get isM?t kh?uValid() {
                return this.password.length >= 8 && /[a-zA-Z]/.test(this.password) && /\d/.test(this.password);
            },
            get isM?t kh?uConfirmValid() {
                return this.passwordConfirm.length > 0 && this.passwordConfirm === this.password;
            },
            get isTermsValid() {
                return this.termsAgreed === true;
            },

            nameL?i(value, label) {
                const trimmed = value.trim();
                if (trimmed.length === 0) return `Please enter your ${label}.`;
                if (trimmed.length < 2) return 'Please use at least 2 characters.';
                return 'Please use no more than 20 characters.';
            },

            get firstH? t?nL?i() {
                if (!this.touched.firstH? t?n || this.isFirstH? t?nValid) return '';
                return this.nameL?i(this.firstH? t?n, 'first name');
            },
            get lastH? t?nL?i() {
                if (!this.touched.lastH? t?n || this.isLastH? t?nValid) return '';
                return this.nameL?i(this.lastH? t?n, 'last name');
            },
            get emailL?i() {
                if (!this.touched.email || this.isEmailValid) return '';
                if (this.email.length === 0) return 'Vui l?ng nh?p ??a ch? email.';
                return 'Vui l?ng nh?p ??a ch? email h?p l?.';
            },
            get phoneL?i() {
                if (!this.touched.phone || this.is?i?n tho?iValid) return '';
                if (this.phone.length === 0) return 'Please enter your phone number.';
                return 'Use 9 to 15 digits, with optional + - ( ) and spaces.';
            },
            get barAssocL?i() {
                if (!this.touched.barAssoc || this.isBarAssocValid) return '';
                return 'Vui l?ng ch?n ?o?n lu?t s? c?a b?n.';
            },
            get barCardL?i() {
                if (!this.touched.barCardNumber || this.isBarCardValid) return '';
                return 'Please enter your bar card number.';
            },
            get passwordL?i() {
                if (!this.touched.password || this.isM?t kh?uValid) return '';
                if (this.password.length === 0) return 'Please enter a password.';
                if (this.password.length < 8) return 'Use at least 8 characters.';
                if (!/[a-zA-Z]/.test(this.password)) return 'Include at least one letter.';
                if (!/\d/.test(this.password)) return 'Include at least one number.';
                return '';
            },
            get passwordConfirmL?i() {
                if (!this.touched.passwordConfirm || this.isM?t kh?uConfirmValid) return '';
                if (this.passwordConfirm.length === 0) return 'Please confirm your password.';
                return "M?t kh?us don't match.";
            },
            get termsL?i() {
                if (!this.touched.termsAgreed || this.isTermsValid) return '';
                return 'Please agree to the Terms and Ch?nh s?ch b?o m?t.';
            },
        };
    }
</script>
@endsection

@extends('layouts.app', ['title' => 'Tài nguyên · LegalEase'])

@php
    $featured = [
        'category'  => 'Phát triển thực hành của bạn',
        'title'     => 'Các luật sư hàng đầu trên LegalEase lấp đầy tuần của họ như thế nào',
        'lead'      => 'Hãy xem cách các luật sư được đặt nhiều nhất trên nền tảng sắp xếp tính khả dụng của họ, đặt ra mức giá và biến những cuộc tư vấn đầu tiên thành khách hàng lâu dài.',
        'read_time' => '8 min read',
        'image_url' => 'https://images.unsplash.com/photo-1758519291932-6263fc870e01?q=80',
    ];

    $articles = [
        [
            'category'  => 'Bắt đầu',
            'title'     => 'Thiết lập hồ sơ của bạn trong 30 phút',
            'desc'      => 'Hướng dẫn chi tiết về tiểu sử, hình ảnh, chuyên môn và cấu hình vị trí.',
            'read_time' => '5 min read',
            'image_url' => 'https://images.unsplash.com/photo-1515378960530-7c0da6231fb1?q=80',
        ],
        [
            'category'  => 'Bắt đầu',
            'title'     => 'Chọn mức lương theo giờ đầu tiên của bạn',
            'desc'      => 'Kinh nghiệm, chuyên môn và vị trí sẽ định hình mức phí bạn tính như thế nào.',
            'read_time' => '4 min read',
            'image_url' => 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=800&h=600&fit=crop&q=80',
        ],
        [
            'category'  => 'Phát triển thực hành của bạn',
            'title'     => 'Ba cách để khuyến khích tham vấn lặp lại',
            'desc'      => 'Luật sư giàu kinh nghiệm làm gì trong buổi gặp đầu tiên để tạo dựng niềm tin',
            'read_time' => '6 min read',
            'image_url' => 'https://images.unsplash.com/photo-1521791136064-7986c2920216?q=80',
        ],
        [
            'category'  => 'Phát triển thực hành của bạn',
            'title'     => 'Viết tiểu sử tạo dựng niềm tin',
            'desc'      => 'Chi tiết cụ thể, ngôn ngữ đơn giản và những gì cần bỏ qua.',
            'read_time' => '3 min read',
            'image_url' => 'https://images.unsplash.com/photo-1542435503-956c469947f6?q=80',
        ],
        [
            'category'  => 'Cập nhật nền tảng',
            'title'     => 'Điều gì đã thay đổi trong quy trình xác minh của chúng tôi trong năm nay',
            'desc'      => 'Đánh giá nhanh hơn, kiểm tra tài liệu mới và những gì người đánh giá tìm kiếm.',
            'read_time' => '4 min read',
            'image_url' => 'https://images.unsplash.com/photo-1624555130882-dcfa8ecb17ce?q=80',
        ],
        [
            'category'  => 'Thu nhập và thanh toán',
            'title'     => 'Cách thức gửi tiền và thanh toán',
            'desc'      => 'Nền tảng chứa đựng những gì, những gì sẽ đến với bạn và khi nào.',
            'read_time' => '5 min read',
            'image_url' => 'https://images.unsplash.com/photo-1633158829585-23ba8f7c8caf?q=80',
        ],
    ];
@endphp

@section('content')
    {{-- Hero: full-bleed photo --}}
    <section class="relative -mt-[72px] flex min-h-[64vh] items-center overflow-hidden">
        <img src="https://images.unsplash.com/photo-1755675672853-9108c92fbc14?q=80"
             alt=""
             class="absolute inset-0 h-full w-full object-cover grayscale">
        <div class="absolute inset-0 bg-gradient-to-b from-bg/70 via-bg/55 to-bg"></div>

        <div class="relative mx-auto max-w-[1280px] px-8 pt-24 text-center">
            <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Resources</p>
            <h1 class="mx-auto mt-6 max-w-[920px] font-display text-[52px] font-medium leading-[1.05] tracking-[-0.02em] md:text-[80px]">
                Run a better practice.
            </h1>
        </div>
    </section>

    {{-- Featured article --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-24">
        <h2 class="font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">Featured</h2>

        <a href="#" class="mt-12 block group">
            <article class="grid gap-8 md:grid-cols-2 md:items-center md:gap-12">
                <div class="overflow-hidden rounded-2xl">
                    <img src="{{ $featured['image_url'] }}"
                         alt=""
                         loading="lazy"
                         class="aspect-[4/3] w-full object-cover grayscale transition-transform duration-500 group-hover:scale-[1.02]">
                </div>
                <div>
                    <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">{{ $featured['category'] }}</p>
                    <h2 class="mt-4 font-display text-[32px] font-medium leading-[1.1] tracking-[-0.02em] md:text-[40px] group-hover:text-accent">
                        {{ $featured['title'] }}
                    </h2>
                    <p class="mt-5 max-w-[520px] text-[16px] leading-relaxed text-secondary">
                        {{ $featured['lead'] }}
                    </p>
                    <p class="mt-6 inline-flex items-center gap-2 text-[14px] font-medium text-text">
                        {{ $featured['read_time'] }}
                        <span class="mx-1 text-muted/40">Â·</span>
                        <span class="transition-colors group-hover:text-accent">Đọc â†'</span>
                    </p>
                </div>
            </article>
        </a>
    </section>

    {{-- All resources --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-24">
        <h2 class="font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">All resources</h2>

        <div class="mt-12 grid gap-10 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($articles as $article)
                <a href="#" class="group flex flex-col">
                    <div class="overflow-hidden rounded-xl">
                        <img src="{{ $article['image_url'] }}"
                             alt=""
                             loading="lazy"
                             class="aspect-[4/3] w-full object-cover grayscale transition-transform duration-500 group-hover:scale-[1.02]">
                    </div>
                    <p class="mt-5 text-[12px] font-medium uppercase tracking-[0.1em] text-muted">{{ $article['category'] }}</p>
                    <h3 class="mt-2 font-display text-[24px] font-medium leading-tight tracking-tight transition-colors group-hover:text-accent">
                        {{ $article['title'] }}
                    </h3>
                    <p class="mt-2 text-[14px] leading-relaxed text-secondary">
                        {{ $article['desc'] }}
                    </p>
                    <p class="mt-4 text-[13px] text-muted">{{ $article['read_time'] }}</p>
                </a>
            @endforeach
        </div>
    </section>

    {{-- Closing CTA --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-32 pb-24 text-center">
        <h2 class="font-display text-[40px] font-medium leading-[1.05] tracking-[-0.02em] md:text-[52px]">
            Can't find what you need?
        </h2>
        <p class="mx-auto mt-6 max-w-[520px] text-[17px] text-secondary">
            Our support team responds within one business day.
        </p>
        <div class="mt-10 flex justify-center">
            <x-button variant="primary" href="{{ route('contact') }}">Lý?n h? hỗ trợ †'</x-button>
        </div>
    </section>
@endsection

@extends('layouts.app', ['title' => 'D?ch v? ph?p l? Â · Dễ dàng pháp lý'])

@php
    $practiceAreas = \App\Data\PracticeAreas::all();
    $firstHalf  = array_slice($practiceAreas, 0, 3);
    $secondHalf = array_slice($practiceAreas, 3);
@endphp

@section('content')
    {{-- Hero: full-bleed photo with overlay --}}
    <section class="relative -mt-[72px] flex min-h-[64vh] items-center overflow-hidden">
        <img src="https://images.unsplash.com/photo-1758518731706-be5d5230e5a5?q=80"
             alt=""
             class="absolute inset-0 h-full w-full object-cover grayscale">
        <div class="absolute inset-0 bg-gradient-to-b from-bg/70 via-bg/55 to-bg"></div>

        <div class="relative mx-auto max-w-[1280px] px-8 pt-24 text-center">
            <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">
                Browse by need
            </p>

            <h1 class="mx-auto mt-6 max-w-[920px] font-display text-[52px] font-medium leading-[1.05] tracking-[-0.02em] md:text-[80px]">
                Not sure where to start?
            </h1>

            <p class="mx-auto mt-8 max-w-[600px] text-[18px] leading-relaxed text-secondary">
                Most people don't know what kind of lawyer they need until someone explains it. This page does that.
            </p>
        </div>
    </section>

    {{-- Practice areas grid: first half --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-24">
        <div class="grid gap-6 md:grid-cols-3">
            @foreach ($firstHalf as $i => $area)
                @include('partials.legal-services-card', ['area' => $area, 'number' => $i + 1])
            @endforeach
        </div>
    </section>

    {{-- Pull quote --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-24">
        <div class="border-y border-text/10 py-16 md:py-20">
            <blockquote class="mx-auto max-w-[900px] text-center font-display text-[32px] font-medium italic leading-[1.2] tracking-[-0.01em] md:text-[44px]">
                <span class="text-muted">â€œ</span>Bạn sắp ly hôn và cần tranh chấp quyền nuôi con.<span class="text-muted">â€</span>
            </blockquote>
            <p class="mt-8 text-center text-[12px] font-medium uppercase tracking-[0.1em] text-muted">
                The kind of sentence that brings someone here
            </p>
        </div>
    </section>

    {{-- Practice areas grid: second half --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-24">
        <div class="grid gap-6 md:grid-cols-3">
            @foreach ($secondHalf as $i => $area)
                @include('partials.legal-services-card', ['area' => $area, 'number' => $i + 4])
            @endforeach
        </div>
    </section>

    {{-- Closing CTA --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-32 pb-24 text-center">
        <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Vẫn chưa chắc chắn?</p>
        <h2 class="mt-6 font-display text-[40px] font-medium leading-[1.05] tracking-[-0.02em] md:text-[52px]">
            Browse all lawyers and filter as you go.
        </h2>
        <p class="mx-auto mt-6 max-w-[520px] text-[17px] text-secondary">
            500+ verified lawyers across 12 cities, with rates and credentials posted upfront.
        </p>
        <div class="mt-10 flex justify-center">
            <x-button variant="primary" href="/lawyers">Duyệt qua tất cả các luật sư â†'</x-button>
        </div>
    </section>
@endsection

@extends('layouts.app', ['title' => 'Đăng nhập · LegalEase'])

@section('content')
<section class="relative -mt-[72px] flex min-h-screen flex-col md:flex-row">
    {{-- Photo --}}
    <div class="relative h-[35vh] overflow-hidden md:sticky md:top-0 md:h-screen md:flex-1">
        <img src="https://images.unsplash.com/photo-1524508762098-fd966ffb6ef9?q=80"
             alt=""
             class="absolute inset-0 h-full w-full object-cover grayscale">
    </div>

    {{-- Form --}}
    <div class="flex flex-1 items-center justify-center px-6 py-16 md:py-20">
        <div class="w-full max-w-[440px]">
            <h1 class="font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">Log in</h1>
            <p class="mt-2 text-[15px] text-secondary">Chào mừng trở lại. Đăng nhập để truy cập tài khoản của bạn.</p>

            @if (session('status'))
                <p class="mt-4 rounded-xl border border-success/40 bg-success/10 px-4 py-3 text-[14px] text-success">
                    {{ session('status') }}
                </p>
            @endif

            <form method="POST" action="{{ route('login.store') }}" class="mt-8 space-y-5" novalidate>
                @csrf

                <div>
                    <label for="email" class="block text-[13px] font-medium text-muted">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                           placeholder="you@example.com"
                           class="mt-2 block w-full rounded-xl border border-text/10 bg-surface px-4 py-3 text-[15px] text-text placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                    @error('email') <p class="mt-2 text-[13px] text-error">{{ $message }}</p> @enderror
                </div>

                <div x-data="{ show: false }">
                    <label for="password" class="block text-[13px] font-medium text-muted">M?t kh?u</label>
                    <div class="relative mt-2">
                        <input id="password" name="password"
                               :type="show ? 'text' : 'password'"
                               placeholder="â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢"
                               class="block w-full rounded-xl border border-text/10 bg-surface px-4 py-3 pr-11 text-[15px] text-text placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                        <button type="button" @click="show = !show" aria-label="Toggle password"
                                class="absolute inset-y-0 right-0 flex items-center pr-3 text-muted hover:text-accent">
                            <svg x-show="!show" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/></svg>
                            <svg x-show="show" x-cloak class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M3 3l18 18M10.5 10.7A2 2 0 0012 14a2 2 0 001.3-.5M6.7 6.7C4.1 8.3 2 12 2 12s3.5 7 10 7a9.8 9.8 0 004.3-.9M9.9 5.1A10 10 0 0112 5c6.5 0 10 7 10 7a17 17 0 01-2.2 2.9"/></svg>
                        </button>
                    </div>
                    @error('password') <p class="mt-2 text-[13px] text-error">{{ $message }}</p> @enderror
                </div>

                <div class="flex items-center justify-between">
                    <label class="inline-flex items-center gap-2 text-[14px] text-muted">
                        <input type="checkbox" name="remember" value="1" class="h-4 w-4 rounded border-text/20 bg-surface text-accent focus:ring-accent">
                        <span>Remember me</span>
                    </label>
                    <a href="{{ route('password.request') }}" class="text-[14px] text-muted transition-colors hover:text-accent">Qu?n m?t kh?u?</a>
                </div>

                <x-button variant="primary" type="submit" class="w-full">Log in</x-button>

                <p class="text-center text-[14px] text-muted">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="text-text transition-colors hover:text-accent">Sign up</a>
                </p>
            </form>
        </div>
    </div>
</section>
@endsection

@extends('layouts.app', ['title' => 'Nhấn Â · LegalEase'])

@php
    $coverage = [
        [
            'publication' => 'Forbes Việt Nam',
            'date'        => 'Ngày 28 tháng 3 năm 2026',
            'headline'    => 'Ba luật sư bước vào trong tâm trạng thất vọng. Họ đã xây dựng một khu chợ.',
            'url'         => '#',
        ],
        [
            'publication' => 'VnExpress',
            'date'        => 'Ngày 12 tháng 3 năm 2026',
            'headline'    => 'LegalEase Ä‘áº·t cÆ°á»£c vÃ o tÆ° váº¥n luáº­t minh báº¡ch táº¡i Viá»‡t Nam',
            'url'         => '#',
        ],
        [
            'publication' => 'Vietcetera',
            'date'        => 'Ngày 14 tháng 2 năm 2026',
            'headline'    => 'LegalEase đang tách rời hoạt động pháp lý của Việt Nam như thế nào',
            'url'         => '#',
        ],
        [
            'publication' => 'Tuá»•i Tráº»',
            'date'        => 'Ngày 5 tháng 2 năm 2026',
            'headline'    => 'HÃ  Ná»™i startup má»Ÿ cá»­a cho hÆ¡n 500 luáº­t sÆ°',
            'url'         => '#',
        ],
        [
            'publication' => 'Công nghệ ở Châu Á',
            'date'        => 'Ngày 22 tháng 1 năm 2026',
            'headline'    => "Vietnam's legal-tech wave finds its first consumer brand",
            'url'         => '#',
        ],
        [
            'publication' => 'Thời báo Sài Gòn',
            'date'        => 'Ngày 18 tháng 12 năm 2025',
            'headline'    => "Booking a lawyer used to mean asking around. Now there's an app.",
            'url'         => '#',
        ],
        [
            'publication' => 'e27',
            'date'        => 'Ngày 30 tháng 11 năm 2025',
            'headline'    => "Inside LegalEase's seed round and the team behind it",
            'url'         => '#',
        ],
        [
            'publication' => 'Tin tức CNTT',
            'date'        => 'Ngày 14 tháng 10 năm 2025',
            'headline'    => 'Khá»Ÿi nghiá»‡p cÃ´ng nghá»‡ phÃ¡p lÃ½: LegalEase Ä‘i Ä‘Æ°á»ng dÃ i',
            'url'         => '#',
        ],
    ];

    $contact = [
        'name'  => 'Äá»— Thá»‹ Lan',
        'role'  => 'Đồng sáng lập, CEO',
        'email' => 'press@legalease.vn',
    ];
@endphp

@section('content')
    {{-- Hero: full-bleed photo --}}
    <section class="relative -mt-[72px] flex min-h-[64vh] items-center overflow-hidden">
        <img src="https://images.unsplash.com/photo-1504711434969-e33886168f5c?w=2000&h=1200&fit=crop&q=80"
             alt=""
             class="absolute inset-0 h-full w-full object-cover grayscale">
        <div class="absolute inset-0 bg-gradient-to-b from-bg/70 via-bg/55 to-bg"></div>

        <div class="relative mx-auto max-w-[1280px] px-8 pt-24 text-center">
            <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Press</p>

            <h1 class="mx-auto mt-6 max-w-[920px] font-display text-[52px] font-medium leading-[1.05] tracking-[-0.02em] md:text-[80px]">
                What people are saying.
            </h1>
        </div>
    </section>

    {{-- 01 / In the news --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-24">
        <div class="flex items-baseline gap-5">
            <p class="font-display text-[28px] font-medium text-muted md:text-[32px]">01</p>
            <h2 class="font-display text-[28px] font-medium tracking-[-0.01em] md:text-[32px]">Trong tin tức</h2>
        </div>

        <div class="mt-12">
            @foreach ($coverage as $i => $item)
                <article class="grid grid-cols-1 gap-4 border-b border-text/10 py-16 first:pt-0 last:border-b-0 md:grid-cols-[1fr_auto] md:items-center md:gap-12">
                    <div>
                        <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">
                            {{ $item['publication'] }}
                        </p>
                        <h3 class="mt-3 max-w-[760px] font-display text-[24px] font-medium leading-tight tracking-[-0.01em] md:text-[28px]">
                            {{ $item['headline'] }}
                        </h3>
                        <p class="mt-3 text-[13px] text-muted">{{ $item['date'] }}</p>
                    </div>
                    <a href="{{ $item['url'] }}" target="_blank" rel="noopener"
                       class="inline-flex items-center gap-2 text-[14px] font-medium text-text transition-colors hover:text-secondary md:justify-self-end">
                        Read
                        <span aria-hidden="true">â†’</span>
                    </a>
                </article>
            @endforeach
        </div>
    </section>

    {{-- 02 / For journalists --}}
    <section class="mx-auto max-w-[1280px] px-8 pt-24 pb-24">
        <div class="flex items-baseline gap-5">
            <p class="font-display text-[28px] font-medium text-muted md:text-[32px]">02</p>
            <h2 class="font-display text-[28px] font-medium tracking-[-0.01em] md:text-[32px]">For journalists</h2>
        </div>

        <div class="mt-12 grid gap-12 md:grid-cols-2 md:gap-20">
            <div>
                <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Press contact</p>
                <p class="mt-5 font-display text-[26px] font-medium tracking-tight md:text-[28px]">
                    {{ $contact['name'] }}
                </p>
                <p class="mt-1 text-[14px] text-muted">{{ $contact['role'] }}</p>
                <a href="mailto:{{ $contact['email'] }}"
                   class="mt-5 inline-flex items-center gap-2 text-[15px] text-text transition-colors hover:text-secondary">
                    {{ $contact['email'] }}
                    <span aria-hidden="true">â†’</span>
                </a>
            </div>

            <div>
                <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Boilerplate</p>
                <div class="mt-5 space-y-4 text-[15px] leading-relaxed text-secondary">
                    <p>
                        LegalEase is a verified marketplace for legal consultations in Vietnam. Founded in Hanoi in 2024, we connect individuals and businesses with 500+ vetted lawyers across 12 cities.
                    </p>
                    <p>
                        Every lawyer's credentials are reviewed before they list. Hourly rates are public. No referral fees, no paid rankings.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection

@extends('layouts.app', ['title' => 'Ch?nh s?ch b?o m?t Â · LegalEase'])

@php
    $lastUpdated = 'May 1, 2026';

    $sections = [
        [
            'n'     => 1,
            'title' => 'Thông tin chúng tôi thu thập',
            'paras' => [
                "We collect information you provide directly when you create an account, book consultations, or contact us. This includes your name, email, phone number, date of birth, gender, and (for lawyers) bar credentials and professional details.",
                "We also collect technical information automatically as you use the platform: device type, IP address, browser, and pages visited. This helps us keep the service running and improve the experience.",
            ],
        ],
        [
            'n'     => 2,
            'title' => 'Cách chúng tôi sử dụng thông tin của bạn',
            'paras' => [
                "We use your information to operate the platform: matching clients with lawyers, processing deposits, sending booking confirmations and reminders, and providing customer support.",
                "We use technical information to monitor performance, detect abuse, and analyze how the platform is used so we can improve it. We do not sell personal information to third parties.",
            ],
        ],
        [
            'n'     => 3,
            'title' => 'Chia sẻ thông tin',
            'paras' => [
                "When you book a consultation, we share necessary details with the lawyer (your name, phone, email, and the time of the appointment). When a lawyer accepts a booking, we share their office address and contact details with you.",
                "We may share information with service providers who help us operate the platform (payment processors, hosting, analytics) under strict confidentiality. We may also disclose information when required by Vietnamese law or to protect the rights and safety of users.",
            ],
        ],
        [
            'n'     => 4,
            'title' => 'Cookie và theo dõi',
            'paras' => [
                "We use cookies and similar technologies to keep you signed in, remember your preferences, and understand how the platform is used. You can disable cookies in your browser, though some features may not work as expected.",
                "We do not use third-party advertising trackers. Our analytics are limited to first-party measurements that help us improve the service.",
            ],
        ],
        [
            'n'     => 5,
            'title' => 'Bảo mật dữ liệu',
            'paras' => [
                "We use industry-standard security practices to protect your data, including encryption in transit, encrypted storage of sensitive fields, and access controls for our team.",
                "No system is perfectly secure. If we become aware of a breach affecting your information, we will notify you without undue delay.",
            ],
        ],
        [
            'n'     => 6,
            'title' => 'Quyền của bạn',
            'paras' => [
                "You have the right to access, correct, or delete the personal information we hold about you. Most of this can be done directly from your account settings; for anything more, contact us at privacy@legalease.vn.",
                "You can also request a copy of your data or ask us to stop processing it for certain purposes. We will respond within a reasonable timeframe consistent with Vietnamese data protection law.",
            ],
        ],
        [
            'n'     => 7,
            'title' => 'Lưu giữ dữ liệu',
            'paras' => [
                "We retain your account information for as long as your account is active. After account deletion, we may keep limited records for legal, tax, or fraud-prevention purposes for up to seven years.",
                "Booking and consultation records are retained for the periods required by Vietnamese law and our financial reporting obligations.",
            ],
        ],
        [
            'n'     => 8,
            'title' => 'Những đứa trẻ\'s privacy',
            'paras' => [
                "LegalEase is not directed to children under 18. We do not knowingly collect personal information from children. If you believe we have collected information from a minor, contact us and we will delete it promptly.",
            ],
        ],
        [
            'n'     => 9,
            'title' => 'Những thay đổi đối với chính sách này',
            'paras' => [
                "We may update this Ch?nh s?ch b?o m?t from time to time. Material changes will be communicated through the platform. The \"Last updated\" date at the top reflects the most recent revision.",
            ],
        ],
        [
            'n'     => 10,
            'title' => 'Li?n h?',
            'paras' => [
                'Các câu hỏi về chính sách này hoặc cách chúng tôi xử lý dữ liệu của bạn? E-mail <a href="mailto:privacy@legalease.vn" class="text-text underline underline-offset-4 decoration-muted/60 transition-colors hover:decoration-accent">privacy@legalease.vn</a> hoặc sử dụng <a href="' . route('contact') . '" class="text-text underline underline-offset-4 decoration-muted/60 transition-colors hover:decoration-accent">contact page</a>.',
            ],
        ],
    ];
@endphp

@section('content')
    {{-- Hero --}}
    <section class="relative -mt-[72px] flex min-h-[64vh] items-center overflow-hidden">
        <img src="https://images.unsplash.com/photo-1615985250204-b48c0936d4fc?q=80"
             alt=""
             class="absolute inset-0 h-full w-full object-cover grayscale">
        <div class="absolute inset-0 bg-gradient-to-b from-bg/70 via-bg/55 to-bg"></div>

        <div class="relative mx-auto max-w-[1280px] px-8 pt-24 text-center">
            <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Last updated {{ $lastUpdated }}</p>
            <h1 class="mx-auto mt-6 max-w-[920px] font-display text-[52px] font-medium leading-[1.05] tracking-[-0.02em] md:text-[80px]">
                Ch?nh s?ch b?o m?t
            </h1>
        </div>
    </section>

    {{-- Contents --}}
    <section class="mx-auto max-w-[760px] px-8 pt-24">
        <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Contents</p>
        <ol class="mt-6 grid gap-2 text-[14px] sm:grid-cols-2">
            @foreach ($sections as $section)
                <li>
                    <a href="#section-{{ $section['n'] }}" class="text-text transition-colors hover:text-accent">
                        {{ $section['n'] }}. {{ $section['title'] }}
                    </a>
                </li>
            @endforeach
        </ol>
    </section>

    {{-- Sections --}}
    <section class="mx-auto max-w-[760px] px-8 pt-24">
        @foreach ($sections as $section)
            <div id="section-{{ $section['n'] }}" class="{{ $loop->first ? '' : 'mt-16' }}">
                <h2 class="font-display text-[28px] font-medium tracking-tight md:text-[32px]">
                    {{ $section['n'] }}. {{ $section['title'] }}
                </h2>
                <div class="mt-5 space-y-4 text-[16px] leading-relaxed text-secondary">
                    @foreach ($section['paras'] as $para)
                        <p>{!! $para !!}</p>
                    @endforeach
                </div>
            </div>
        @endforeach
    </section>

    <div class="pb-24"></div>
@endsection

@extends('layouts.app', ['title' => 'Đăng ký · LegalEase'])

@php
    $initialState = [
        'firstH? t?n'   => old('first_name', ''),
        'lastH? t?n'    => old('last_name', ''),
        'email'       => old('email', ''),
        'phone'       => old('phone', ''),
        'dob'         => old('date_of_birth', ''),
        'gender'      => old('gender', ''),
        'termsAgreed' => (bool) old('agreed_terms', false),
        'touched'     => [
            'firstH? t?n'       => old('first_name') !== null || $errors->has('first_name'),
            'lastH? t?n'        => old('last_name') !== null || $errors->has('last_name'),
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
<section class="relative -mt-[72px] flex min-h-screen flex-col md:flex-row">
    {{-- Photo --}}
    <div class="relative h-[35vh] overflow-hidden md:sticky md:top-0 md:h-screen md:flex-1">
        <img src="https://images.unsplash.com/photo-1698047682091-782b1e5c6536?q=80"
             alt=""
             class="absolute inset-0 h-full w-full object-cover grayscale">
    </div>

    {{-- Form --}}
    <div class="flex flex-1 items-center justify-center px-6 py-16 md:py-20">
        <div class="w-full max-w-[440px]">
            <h1 class="font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">Sign up</h1>
            <p class="mt-2 text-[15px] text-secondary">Tiếp cận kiến ​​thức chuyên môn pháp lý đáng tin cậy, đăng ký tư vấn và quản lý các vấn đề của bạn ở một nơi.</p>

            <form method="POST" action="{{ route('register.store') }}" class="mt-8 space-y-5" novalidate
                  x-data="customerSignupValidation({{ json_encode($initialState) }})"
                  @submit="markAllTouched()">
                @csrf

                <div class="grid gap-5 md:grid-cols-2">
                    <div>
                        <label for="first_name" class="block text-[13px] font-medium text-muted">
                            T?n
                            <span x-show="!isFirstH? t?nValid && !touched.firstH? t?n" class="text-gold">*</span>
                            <svg x-show="firstH? t?nL?i" x-cloak class="inline-block h-3 w-3 align-middle text-error" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                            <svg x-show="isFirstH? t?nValid" x-cloak class="inline-block h-3 w-3 align-middle text-success" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        </label>
                        <input id="first_name" type="text" name="first_name" x-model="firstH? t?n" @blur="touched.firstH? t?n = true" required minlength="2" maxlength="20"
                               placeholder="Lan"
                               class="mt-2 block w-full rounded-xl border border-text/10 bg-surface px-4 py-3 text-[15px] text-text placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                        @unless ($errors->có('first_name'))
                            <p x-show="firstH? t?nL?i" x-cloak x-text="firstH? t?nL?i" class="mt-2 text-[13px] text-error"></p>
                        @endunless
                        @error('first_name') <p class="mt-2 text-[13px] text-error">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="last_name" class="block text-[13px] font-medium text-muted">
                            H?
                            <span x-show="!isLastH? t?nValid && !touched.lastH? t?n" class="text-gold">*</span>
                            <svg x-show="lastH? t?nL?i" x-cloak class="inline-block h-3 w-3 align-middle text-error" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                            <svg x-show="isLastH? t?nValid" x-cloak class="inline-block h-3 w-3 align-middle text-success" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        </label>
                        <input id="last_name" type="text" name="last_name" x-model="lastH? t?n" @blur="touched.lastH? t?n = true" required minlength="2" maxlength="20"
                               placeholder="Nguyá»…n"
                               class="mt-2 block w-full rounded-xl border border-text/10 bg-surface px-4 py-3 text-[15px] text-text placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                        @unless ($errors->có('last_name'))
                            <p x-show="lastH? t?nL?i" x-cloak x-text="lastH? t?nL?i" class="mt-2 text-[13px] text-error"></p>
                        @endunless
                        @error('last_name') <p class="mt-2 text-[13px] text-error">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label for="email" class="block text-[13px] font-medium text-muted">
                        Email
                        <span x-show="!isEmailValid && !touched.email" class="text-gold">*</span>
                        <svg x-show="emailL?i" x-cloak class="inline-block h-3 w-3 align-middle text-error" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                        <svg x-show="isEmailValid" x-cloak class="inline-block h-3 w-3 align-middle text-success" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    </label>
                    <input id="email" type="email" name="email" x-model="email" @blur="touched.email = true" required
                           placeholder="you@example.com"
                           class="mt-2 block w-full rounded-xl border border-text/10 bg-surface px-4 py-3 text-[15px] text-text placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                    @unless ($errors->có('email'))
                        <p x-show="emailL?i" x-cloak x-text="emailL?i" class="mt-2 text-[13px] text-error"></p>
                    @endunless
                    @error('email') <p class="mt-2 text-[13px] text-error">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="phone" class="block text-[13px] font-medium text-muted">
                        ?i?n tho?i
                        <span x-show="!is?i?n tho?iValid && !touched.phone" class="text-gold">*</span>
                        <svg x-show="phoneL?i" x-cloak class="inline-block h-3 w-3 align-middle text-error" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                        <svg x-show="is?i?n tho?iValid" x-cloak class="inline-block h-3 w-3 align-middle text-success" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    </label>
                    <input id="phone" type="tel" name="phone" x-model="phone" @blur="touched.phone = true" required
                           placeholder="09xxxxxxxx"
                           pattern="[\d\+\s\-\(\)]{9,15}"
                           title="Digits, spaces, dashes, parentheses, and a leading + are allowed."
                           class="mt-2 block w-full rounded-xl border border-text/10 bg-surface px-4 py-3 text-[15px] text-text placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                    @unless ($errors->có('điện thoại'))
                        <p x-show="phoneL?i" x-cloak x-text="phoneL?i" class="mt-2 text-[13px] text-error"></p>
                    @endunless
                    @error('phone') <p class="mt-2 text-[13px] text-error">{{ $message }}</p> @enderror
                </div>

                <div class="grid gap-5 md:grid-cols-2">
                    <div>
                        <label for="date_of_birth" class="block text-[13px] font-medium text-muted">
                            Ng?y sinh
                            <span x-show="!isDobValid && !touched.dob" class="text-gold">*</span>
                            <svg x-show="dobL?i" x-cloak class="inline-block h-3 w-3 align-middle text-error" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                            <svg x-show="isDobValid" x-cloak class="inline-block h-3 w-3 align-middle text-success" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        </label>
                        <input id="date_of_birth" type="date" name="date_of_birth" x-model="dob" @blur="touched.dob = true" required
                               max="{{ now()->subYears(18)->toDateString() }}"
                               class="mt-2 block w-full rounded-xl border border-text/10 bg-surface px-4 py-3 text-[15px] text-text placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                        @unless ($errors->có('ngày_sinh'))
                            <p x-show="dobL?i" x-cloak x-text="dobL?i" class="mt-2 text-[13px] text-error"></p>
                        @endunless
                        @error('date_of_birth') <p class="mt-2 text-[13px] text-error">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="gender" class="block text-[13px] font-medium text-muted">
                            Gi?i t?nh
                            <span x-show="!isGi?i t?nhValid && !touched.gender" class="text-gold">*</span>
                            <svg x-show="genderL?i" x-cloak class="inline-block h-3 w-3 align-middle text-error" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                            <svg x-show="isGi?i t?nhValid" x-cloak class="inline-block h-3 w-3 align-middle text-success" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        </label>
                        <div class="relative mt-2">
                            <select id="gender" name="gender" x-model="gender" @blur="touched.gender = true" required
                                    class="block w-full appearance-none rounded-xl border border-text/10 bg-surface px-4 py-3 pr-11 text-[15px] text-text focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                                <option value="">Select</option>
                                <option value="female">N?</option>
                                <option value="male">Nam</option>
                                <option value="other">Kh?c</option>
                                <option value="undisclosed">Không muốn nói</option>
                            </select>
                            <span class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-muted">
                                <x-icon name="chevron-down" :size="16" />
                            </span>
                        </div>
                        @unless ($errors->có ('giới tính'))
                            <p x-show="genderL?i" x-cloak x-text="genderL?i" class="mt-2 text-[13px] text-error"></p>
                        @endunless
                        @error('gender') <p class="mt-2 text-[13px] text-error">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div x-data="{ show: false }">
                    <label for="password" class="block text-[13px] font-medium text-muted">
                        M?t kh?u
                        <span x-show="!isM?t kh?uValid && !touched.password" class="text-gold">*</span>
                        <svg x-show="passwordL?i" x-cloak class="inline-block h-3 w-3 align-middle text-error" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                        <svg x-show="isM?t kh?uValid" x-cloak class="inline-block h-3 w-3 align-middle text-success" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    </label>
                    <div class="relative mt-2">
                        <input id="password" name="password" x-model="password" @blur="touched.password = true" required
                               :type="show ? 'text' : 'password'"
                               placeholder="â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢"
                               class="block w-full rounded-xl border border-text/10 bg-surface px-4 py-3 pr-11 text-[15px] text-text placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                        <button type="button" @click="show = !show" aria-label="Toggle password"
                                class="absolute inset-y-0 right-0 flex items-center pr-3 text-muted hover:text-accent">
                            <svg x-show="!show" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/></svg>
                            <svg x-show="show" x-cloak class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M3 3l18 18M10.5 10.7A2 2 0 0012 14a2 2 0 001.3-.5M6.7 6.7C4.1 8.3 2 12 2 12s3.5 7 10 7a9.8 9.8 0 004.3-.9M9.9 5.1A10 10 0 0112 5c6.5 0 10 7 10 7a17 17 0 01-2.2 2.9"/></svg>
                        </button>
                    </div>
                    <p class="mt-2 text-[12px] text-muted">Ít nhất 8 ký tự, bao gồm một chữ cái và một số.</p>
                    @unless ($errors->có('mật khẩu'))
                        <p x-show="passwordL?i" x-cloak x-text="passwordL?i" class="mt-2 text-[13px] text-error"></p>
                    @endunless
                    @error('password') <p class="mt-2 text-[13px] text-error">{{ $message }}</p> @enderror
                </div>

                <div x-data="{ show: false }">
                    <label for="password_confirmation" class="block text-[13px] font-medium text-muted">
                        X?c nh?n m?t kh?u
                        <span x-show="!isM?t kh?uConfirmValid && !touched.passwordConfirm" class="text-gold">*</span>
                        <svg x-show="passwordConfirmL?i" x-cloak class="inline-block h-3 w-3 align-middle text-error" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                        <svg x-show="isM?t kh?uConfirmValid" x-cloak class="inline-block h-3 w-3 align-middle text-success" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    </label>
                    <div class="relative mt-2">
                        <input id="password_confirmation" name="password_confirmation" x-model="passwordConfirm" @blur="touched.passwordConfirm = true" required
                               :type="show ? 'text' : 'password'"
                               placeholder="â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢"
                               class="block w-full rounded-xl border border-text/10 bg-surface px-4 py-3 pr-11 text-[15px] text-text placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                        <button type="button" @click="show = !show" aria-label="Toggle password"
                                class="absolute inset-y-0 right-0 flex items-center pr-3 text-muted hover:text-accent">
                            <svg x-show="!show" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/></svg>
                            <svg x-show="show" x-cloak class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M3 3l18 18M10.5 10.7A2 2 0 0012 14a2 2 0 001.3-.5M6.7 6.7C4.1 8.3 2 12 2 12s3.5 7 10 7a9.8 9.8 0 004.3-.9M9.9 5.1A10 10 0 0112 5c6.5 0 10 7 10 7a17 17 0 01-2.2 2.9"/></svg>
                        </button>
                    </div>
                    <p x-show="passwordConfirmL?i" x-cloak x-text="passwordConfirmL?i" class="mt-2 text-[13px] text-error"></p>
                </div>

                <div>
                    <label class="flex items-start gap-2 text-[13px] text-muted">
                        <input type="checkbox" name="agreed_terms" value="1" x-model="termsAgreed" @change="touched.termsAgreed = true" required class="mt-0.5 h-4 w-4 rounded border-text/20 bg-surface text-accent focus:ring-accent">
                        <span>
                            I agree to the
                            <a href="{{ route('terms') }}" class="text-text transition-colors hover:text-accent">?i?u kho?n d?ch v?</a>
                            and
                            <a href="{{ route('privacy') }}" class="text-text transition-colors hover:text-accent">Ch?nh s?ch b?o m?t</a>.
                            <span x-show="!isTermsValid && !touched.termsAgreed" class="text-gold">*</span>
                            <svg x-show="termsL?i" x-cloak class="inline-block h-3 w-3 align-middle text-error" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                            <svg x-show="isTermsValid" x-cloak class="inline-block h-3 w-3 align-middle text-success" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                        </span>
                    </label>
                    @unless ($errors->đã ('đồng ý_terms'))
                        <p x-show="termsL?i" x-cloak x-text="termsL?i" class="mt-2 text-[13px] text-error"></p>
                    @endunless
                    @error('agreed_terms') <p class="mt-2 text-[13px] text-error">{{ $message }}</p> @enderror
                </div>

                <x-button variant="primary" type="submit" class="w-full">Create account</x-button>

                <p class="text-center text-[14px] text-muted">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-text transition-colors hover:text-accent">Log in</a>
                </p>
            </form>
        </div>
    </div>
</section>

<script>
    function customerSignupValidation(initial) {
        return {
            firstH? t?n: initial.firstH? t?n || '',
            lastH? t?n: initial.lastH? t?n || '',
            email: initial.email || '',
            phone: initial.phone || '',
            dob: initial.dob || '',
            gender: initial.gender || '',
            password: '',
            passwordConfirm: '',
            termsAgreed: initial.termsAgreed || false,

            touched: Object.assign({
                firstH? t?n: false,
                lastH? t?n: false,
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

            get isFirstH? t?nValid() {
                const trimmed = this.firstH? t?n.trim();
                return trimmed.length >= 2 && đã cắt.length <= 20;
            },
            get isLastH? t?nValid() {
                const trimmed = this.lastH? t?n.trim();
                return trimmed.length >= 2 && đã cắt.length <= 20;
            },
            get isEmailValid() {
                return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.email);
            },
            get is?i?n tho?iValid() {
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
            get isGi?i t?nhValid() {
                return this.gender.length > 0;
            },
            get isM?t kh?uValid() {
                return this.password.length >= 8 && /[a-zA-Z]/.test(this.password) && /\d/.test(this.password);
            },
            get isM?t kh?uConfirmValid() {
                return this.passwordConfirm.length > 0 && this.passwordConfirm === this.password;
            },
            get isTermsValid() {
                return this.termsAgreed === true;
            },

            nameL?i(value, label) {
                const trimmed = value.trim();
                if (trimmed.length === 0) return `Please enter your ${label}.`;
                if (trimmed.length < 2) return 'Please use at least 2 characters.';
                return 'Please use no more than 20 characters.';
            },

            get firstH? t?nL?i() {
                if (!this.touched.firstH? t?n || this.isFirstH? t?nValid) return '';
                return this.nameL?i(this.firstH? t?n, 'first name');
            },
            get lastH? t?nL?i() {
                if (!this.touched.lastH? t?n || this.isLastH? t?nValid) return '';
                return this.nameL?i(this.lastH? t?n, 'last name');
            },
            get emailL?i() {
                if (!this.touched.email || this.isEmailValid) return '';
                if (this.email.length === 0) return 'Vui l?ng nh?p ??a ch? email.';
                return 'Vui l?ng nh?p ??a ch? email h?p l?.';
            },
            get phoneL?i() {
                if (!this.touched.phone || this.is?i?n tho?iValid) return '';
                if (this.phone.length === 0) return 'Please enter your phone number.';
                return 'Use 9 to 15 digits, with optional + - ( ) and spaces.';
            },
            get dobL?i() {
                if (!this.touched.dob || this.isDobValid) return '';
                if (!this.dob) return 'Please select your date of birth.';
                const [y, m, d] = this.dob.split('-').map(Number);
                if (!y || !m || !d) return 'Please enter a valid date.';
                const dob = new Date(y, m - 1, d);
                const today = new Date();
                if (dob > today) return "Ng?y sinh can't be in the future.";
                return 'B?n ph?i t? 18 tu?i tr? l?n ?? t?o t?i kho?n.';
            },
            get genderL?i() {
                if (!this.touched.gender || this.isGi?i t?nhValid) return '';
                return 'Please select an option.';
            },
            get passwordL?i() {
                if (!this.touched.password || this.isM?t kh?uValid) return '';
                if (this.password.length === 0) return 'Please enter a password.';
                if (this.password.length < 8) return 'Use at least 8 characters.';
                if (!/[a-zA-Z]/.test(this.password)) return 'Include at least one letter.';
                if (!/\d/.test(this.password)) return 'Include at least one number.';
                return '';
            },
            get passwordConfirmL?i() {
                if (!this.touched.passwordConfirm || this.isM?t kh?uConfirmValid) return '';
                if (this.passwordConfirm.length === 0) return 'Please confirm your password.';
                return "M?t kh?us don't match.";
            },
            get termsL?i() {
                if (!this.touched.termsAgreed || this.isTermsValid) return '';
                return 'Please agree to the Terms and Ch?nh s?ch b?o m?t.';
            },
        };
    }
</script>
@endsection

@extends('layouts.app', ['title' => '??t l?i m?t kh?u Â · LegalEase'])

@php
    $initialState = [
        'email'   => old('email', $email ?? ''),
        'touched' => [
            'email'           => old('email') !== null || !empty($email) || $errors->has('email'),
            'password'        => $errors->has('password'),
            'passwordConfirm' => $errors->has('password'),
        ],
    ];
@endphp

@section('content')
<section class="relative -mt-[72px] flex min-h-screen flex-col md:flex-row">
    {{-- Photo --}}
    <div class="relative h-[35vh] overflow-hidden md:sticky md:top-0 md:h-screen md:flex-1">
        <img src="https://images.unsplash.com/photo-1518770660439-4636190af475?q=80"
             alt=""
             class="absolute inset-0 h-full w-full object-cover grayscale">
    </div>

    {{-- Form --}}
    <div class="flex flex-1 items-center justify-center px-6 py-16 md:py-20">
        <div class="w-full max-w-[440px]">
            <h1 class="font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">Đặt mật khẩu mới</h1>
            <p class="mt-2 text-[15px] text-secondary">Chọn một mật khẩu bạn không sử dụng ở bất kỳ nơi nào khác. Bạn sẽ đăng nhập sau khi nó được lưu.</p>

            <form method="POST" action="{{ route('password.update') }}" class="mt-8 space-y-5" novalidate
                  x-data="resetM?t kh?uValidation({{ json_encode($initialState) }})"
                  @submit="markAllTouched()">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div>
                    <label for="email" class="block text-[13px] font-medium text-muted">
                        Email
                        <span x-show="!isEmailValid && !touched.email" class="text-gold">*</span>
                        <svg x-show="emailL?i" x-cloak class="inline-block h-3 w-3 align-middle text-error" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                        <svg x-show="isEmailValid" x-cloak class="inline-block h-3 w-3 align-middle text-success" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    </label>
                    <input id="email" type="email" name="email" x-model="email" @blur="touched.email = true" required
                           placeholder="you@example.com"
                           class="mt-2 block w-full rounded-xl border border-text/10 bg-surface px-4 py-3 text-[15px] text-text placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                    @unless ($errors->có('email'))
                        <p x-show="emailL?i" x-cloak x-text="emailL?i" class="mt-2 text-[13px] text-error"></p>
                    @endunless
                    @error('email') <p class="mt-2 text-[13px] text-error">{{ $message }}</p> @enderror
                </div>

                <div x-data="{ show: false }">
                    <label for="password" class="block text-[13px] font-medium text-muted">
                        New password
                        <span x-show="!isM?t kh?uValid && !touched.password" class="text-gold">*</span>
                        <svg x-show="passwordL?i" x-cloak class="inline-block h-3 w-3 align-middle text-error" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                        <svg x-show="isM?t kh?uValid" x-cloak class="inline-block h-3 w-3 align-middle text-success" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    </label>
                    <div class="relative mt-2">
                        <input id="password" name="password" x-model="password" @blur="touched.password = true" required
                               :type="show ? 'text' : 'password'"
                               placeholder="â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢"
                               class="block w-full rounded-xl border border-text/10 bg-surface px-4 py-3 pr-11 text-[15px] text-text placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                        <button type="button" @click="show = !show" aria-label="Toggle password"
                                class="absolute inset-y-0 right-0 flex items-center pr-3 text-muted hover:text-accent">
                            <svg x-show="!show" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/></svg>
                            <svg x-show="show" x-cloak class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M3 3l18 18M10.5 10.7A2 2 0 0012 14a2 2 0 001.3-.5M6.7 6.7C4.1 8.3 2 12 2 12s3.5 7 10 7a9.8 9.8 0 004.3-.9M9.9 5.1A10 10 0 0112 5c6.5 0 10 7 10 7a17 17 0 01-2.2 2.9"/></svg>
                        </button>
                    </div>
                    <p class="mt-2 text-[12px] text-muted">Ít nhất 8 ký tự, bao gồm một chữ cái và một số.</p>
                    @unless ($errors->có('mật khẩu'))
                        <p x-show="passwordL?i" x-cloak x-text="passwordL?i" class="mt-2 text-[13px] text-error"></p>
                    @endunless
                    @error('password') <p class="mt-2 text-[13px] text-error">{{ $message }}</p> @enderror
                </div>

                <div x-data="{ show: false }">
                    <label for="password_confirmation" class="block text-[13px] font-medium text-muted">
                        Confirm new password
                        <span x-show="!isM?t kh?uConfirmValid && !touched.passwordConfirm" class="text-gold">*</span>
                        <svg x-show="passwordConfirmL?i" x-cloak class="inline-block h-3 w-3 align-middle text-error" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                        <svg x-show="isM?t kh?uConfirmValid" x-cloak class="inline-block h-3 w-3 align-middle text-success" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    </label>
                    <div class="relative mt-2">
                        <input id="password_confirmation" name="password_confirmation" x-model="passwordConfirm" @blur="touched.passwordConfirm = true" required
                               :type="show ? 'text' : 'password'"
                               placeholder="â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢â€¢"
                               class="block w-full rounded-xl border border-text/10 bg-surface px-4 py-3 pr-11 text-[15px] text-text placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                        <button type="button" @click="show = !show" aria-label="Toggle password"
                                class="absolute inset-y-0 right-0 flex items-center pr-3 text-muted hover:text-accent">
                            <svg x-show="!show" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/></svg>
                            <svg x-show="show" x-cloak class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M3 3l18 18M10.5 10.7A2 2 0 0012 14a2 2 0 001.3-.5M6.7 6.7C4.1 8.3 2 12 2 12s3.5 7 10 7a9.8 9.8 0 004.3-.9M9.9 5.1A10 10 0 0112 5c6.5 0 10 7 10 7a17 17 0 01-2.2 2.9"/></svg>
                        </button>
                    </div>
                    <p x-show="passwordConfirmL?i" x-cloak x-text="passwordConfirmL?i" class="mt-2 text-[13px] text-error"></p>
                </div>

                <x-button variant="primary" type="submit" class="w-full">L?u mật khẩu mới</x-button>

                <p class="text-center text-[14px] text-muted">
                    <a href="{{ route('login') }}" class="text-text transition-colors hover:text-accent">Quay l?i để đăng nhập</a>
                </p>
            </form>
        </div>
    </div>
</section>

<script>
    function resetM?t kh?uValidation(initial) {
        return {
            email: initial.email || '',
            password: '',
            passwordConfirm: '',

            touched: Object.assign({
                email: false,
                password: false,
                passwordConfirm: false,
            }, initial.touched || {}),

            markAllTouched() {
                Object.keys(this.touched).forEach((k) => { this.touched[k] = true; });
            },

            get isEmailValid() {
                return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(this.email);
            },
            get isM?t kh?uValid() {
                return this.password.length >= 8 && /[a-zA-Z]/.test(this.password) && /\d/.test(this.password);
            },
            get isM?t kh?uConfirmValid() {
                return this.passwordConfirm.length > 0 && this.passwordConfirm === this.password;
            },

            get emailL?i() {
                if (!this.touched.email || this.isEmailValid) return '';
                if (this.email.length === 0) return 'Vui l?ng nh?p ??a ch? email.';
                return 'Vui l?ng nh?p ??a ch? email h?p l?.';
            },
            get passwordL?i() {
                if (!this.touched.password || this.isM?t kh?uValid) return '';
                if (this.password.length === 0) return 'Please enter a password.';
                if (this.password.length < 8) return 'Use at least 8 characters.';
                if (!/[a-zA-Z]/.test(this.password)) return 'Include at least one letter.';
                if (!/\d/.test(this.password)) return 'Include at least one number.';
                return '';
            },
            get passwordConfirmL?i() {
                if (!this.touched.passwordConfirm || this.isM?t kh?uConfirmValid) return '';
                if (this.passwordConfirm.length === 0) return 'Please confirm your password.';
                return "M?t kh?us don't match.";
            },
        };
    }
</script>
@endsection

@extends('layouts.app', ['title' => '?i?u kho?n d?ch v? Â · Dễ dàng pháp lý'])

@php
    $lastUpdated = 'May 1, 2026';

    $sections = [
        [
            'n'     => 1,
            'title' => 'Chấp nhận các điều khoản',
            'paras' => [
                "By creating an account or using LegalEase, you agree to these ?i?u kho?n d?ch v?. If you don't agree, please don't use the platform.",
                "These terms apply to both clients seeking legal consultations and lawyers offering services through LegalEase. We may update these terms occasionally and will notify users of material changes through the platform or by email.",
            ],
        ],
        [
            'n'     => 2,
            'title' => 'Đủ điều kiện',
            'paras' => [
                "To use LegalEase as a client, you must be at least 18 years old and able to enter into binding contracts under Vietnamese law. To list as a lawyer, you must hold a current bar membership in Vietnam and pass our verification process.",
                "We reserve the right to refuse service or terminate accounts that don't meet our eligibility requirements.",
            ],
        ],
        [
            'n'     => 3,
            'title' => 'Tài khoản và bảo mật',
            'paras' => [
                "You're responsible for keeping your account credentials secure and for all activity under your account. Notify us immediately if you suspect unauthorized access.",
                "You agree to provide accurate information during signup and to keep your profile up to date. Misrepresentation may result in suspension.",
            ],
        ],
        [
            'n'     => 4,
            'title' => 'Đặt chỗ và đặt cọc',
            'paras' => [
                "LegalEase facilitates the booking of legal consultations between clients and verified lawyers. When a booking is confirmed, the platform holds a deposit equal to 20% of the consultation fee. The remaining 80% is paid directly to the lawyer at the time of the appointment.",
                "Deposits are non-refundable except in the cases set out in our cancellation policy.",
            ],
        ],
        [
            'n'     => 5,
            'title' => 'H?ylation và hoàn tiền',
            'paras' => [
                "H?ylations made more than 24 hours before the scheduled appointment are eligible for a full refund of the deposit. H?ylations within 24 hours forfeit the deposit unless the lawyer also cancels or fails to attend.",
                "If a lawyer cancels at any time, the client receives a full refund. If a client doesn't attend, the lawyer retains a portion of the deposit per our policy.",
            ],
        ],
        [
            'n'     => 6,
            'title' => 'Trách nhiệm của luật sư',
            'paras' => [
                "Lu?t s? listed on LegalEase must hold valid bar credentials, accurately represent their experience and specializations, and conduct consultations professionally.",
                "Lu?t s? are independent practitioners. LegalEase does not employ lawyers and is not responsible for the legal advice they provide. Lu?t s? agree to honor confirmed bookings and update their availability promptly to prevent conflicts.",
            ],
        ],
        [
            'n'     => 7,
            'title' => 'Trách nhiệm của khách hàng',
            'paras' => [
                "Clients are expected to attend booked consultations on time, treat lawyers professionally, and provide accurate information about their legal matter. The deposit policy is intended to protect both parties from no-shows.",
                "Clients agree not to use the platform to harass lawyers or share confidential information outside appropriate channels.",
            ],
        ],
        [
            'n'     => 8,
            'title' => '??nh gi?s và xếp hạng',
            'paras' => [
                "Clients may leave honest reviews after a completed consultation. ??nh gi?s must be based on direct experience and may not contain personal attacks, confidential information, or content that violates Vietnamese law.",
                "We reserve the right to remove reviews that violate these guidelines. Lu?t s? may not request, incentivize, or retaliate against reviews.",
            ],
        ],
        [
            'n'     => 9,
            'title' => 'Sở hữu trí tuệ',
            'paras' => [
                "All content provided by LegalEase, including platform design, brand assets, and editorial content, is owned by LegalEase or licensed to us. You may not copy, modify, or distribute our content without permission.",
                "User-generated content (profiles, reviews) remains owned by the user, but you grant us a license to display and distribute it on the platform.",
            ],
        ],
        [
            'n'     => 10,
            'title' => 'Giới hạn trách nhiệm pháp lý',
            'paras' => [
                "LegalEase is a marketplace platform. We do not provide legal advice and are not responsible for the outcomes of consultations conducted through the platform.",
                "To the fullest extent permitted by law, our liability is limited to the platform fees paid in the previous 12 months. We do not warrant that the platform will be error-free or always available.",
            ],
        ],
        [
            'n'     => 11,
            'title' => 'Những thay đổi đối với các điều khoản này',
            'paras' => [
                "We may update these ?i?u kho?n d?ch v? from time to time. Material changes will be communicated through the platform. Ti?p t?cd use after a change constitutes acceptance of the updated terms.",
            ],
        ],
        [
            'n'     => 12,
            'title' => 'Li?n h?',
            'paras' => [
                'Câu hỏi về các điều khoản này? E-mail <a href="mailto:legal@legalease.vn" class="text-text underline underline-offset-4 decoration-muted/60 transition-colors hover:decoration-accent">legal@legalease.vn</a> hoặc sử dụng <a href="' . route('contact') . '" class="text-text underline underline-offset-4 decoration-muted/60 transition-colors hover:decoration-accent">contact page</a>.',
            ],
        ],
    ];
@endphp

@section('content')
    {{-- Hero --}}
    <section class="relative -mt-[72px] flex min-h-[64vh] items-center overflow-hidden">
        <img src="https://images.unsplash.com/photo-1593115057322-e94b77572f20?q=80"
             alt=""
             class="absolute inset-0 h-full w-full object-cover grayscale">
        <div class="absolute inset-0 bg-gradient-to-b from-bg/70 via-bg/55 to-bg"></div>

        <div class="relative mx-auto max-w-[1280px] px-8 pt-24 text-center">
            <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Last updated {{ $lastUpdated }}</p>
            <h1 class="mx-auto mt-6 max-w-[920px] font-display text-[52px] font-medium leading-[1.05] tracking-[-0.02em] md:text-[80px]">
                ?i?u kho?n d?ch v?
            </h1>
        </div>
    </section>

    {{-- Contents --}}
    <section class="mx-auto max-w-[760px] px-8 pt-24">
        <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Contents</p>
        <ol class="mt-6 grid gap-2 text-[14px] sm:grid-cols-2">
            @foreach ($sections as $section)
                <li>
                    <a href="#section-{{ $section['n'] }}" class="text-text transition-colors hover:text-accent">
                        {{ $section['n'] }}. {{ $section['title'] }}
                    </a>
                </li>
            @endforeach
        </ol>
    </section>

    {{-- Sections --}}
    <section class="mx-auto max-w-[760px] px-8 pt-24">
        @foreach ($sections as $section)
            <div id="section-{{ $section['n'] }}" class="{{ $loop->first ? '' : 'mt-16' }}">
                <h2 class="font-display text-[28px] font-medium tracking-tight md:text-[32px]">
                    {{ $section['n'] }}. {{ $section['title'] }}
                </h2>
                <div class="mt-5 space-y-4 text-[16px] leading-relaxed text-secondary">
                    @foreach ($section['paras'] as $para)
                        <p>{!! $para !!}</p>
                    @endforeach
                </div>
            </div>
        @endforeach
    </section>

    <div class="pb-24"></div>
@endsection

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang giới thiệu phong cách Zocdoc</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Space+Grotesk:wght@500;600;700&display=swap');

        :root {
            --bg: #f5f9ff;
            --surface: #ffffff;
            --ink: #10325d;
            --muted: #4a6588;
            --brand: #2d7ff9;
            --brand-strong: #145fd1;
            --lime: #d6fa5d;
            --border: #d8e5ff;
            --shadow: 0 18px 40px rgba(24, 70, 138, 0.12);
            --radius-lg: 26px;
            --radius-md: 16px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: "Manrope", "Segoe UI", sans-serif;
            background: radial-gradient(circle at 85% 10%, #e2efff 0%, var(--bg) 45%, #f7fbff 100%);
            color: var(--ink);
            line-height: 1.5;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        .wrapper {
            width: min(1120px, 92vw);
            margin: 0 auto;
        }

        .nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 22px 0;
            gap: 20px;
        }

        .brand {
            font-family: "Space Grotesk", sans-serif;
            font-size: 1.55rem;
            font-weight: 700;
            letter-spacing: -0.03em;
        }

        .brand span {
            color: var(--brand);
        }

        .nav-links {
            display: flex;
            gap: 22px;
            color: var(--muted);
            font-weight: 600;
            font-size: 0.95rem;
        }

        .nav-actions {
            display: flex;
            gap: 12px;
        }

        .btn {
            border-radius: 999px;
            border: 1.5px solid transparent;
            padding: 11px 18px;
            font-weight: 700;
            font-size: 0.92rem;
            transition: transform .22s ease, box-shadow .22s ease, background-color .22s ease;
            display: inline-block;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .btn-light {
            border-color: var(--border);
            background: var(--surface);
            color: var(--ink);
        }

        .btn-brand {
            background: var(--brand);
            color: #fff;
            box-shadow: 0 10px 24px rgba(45, 127, 249, 0.3);
        }

        .hero {
            background: linear-gradient(135deg, #3188ff 0%, #2b6ce8 58%, #1c58c8 100%);
            border-radius: var(--radius-lg);
            padding: clamp(32px, 6vw, 56px);
            color: #f4f8ff;
            box-shadow: var(--shadow);
            overflow: hidden;
            position: relative;
            margin-top: 12px;
        }

        .hero::before,
        .hero::after {
            content: "";
            position: absolute;
            border-radius: 50%;
            opacity: .16;
            pointer-events: none;
        }

        .hero::before {
            width: 390px;
            height: 390px;
            background: #dce8ff;
            top: -160px;
            right: -130px;
        }

        .hero::after {
            width: 260px;
            height: 260px;
            background: #8ce5ff;
            left: -100px;
            bottom: -130px;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 1.15fr .85fr;
            gap: 24px;
            position: relative;
            z-index: 1;
        }

        h1 {
            font-family: "Space Grotesk", sans-serif;
            font-size: clamp(2rem, 5vw, 3.2rem);
            line-height: 1.08;
            letter-spacing: -0.02em;
            margin-bottom: 14px;
        }

        .hero p {
            color: #e4eeff;
            max-width: 48ch;
            margin-bottom: 26px;
        }

        .search-box {
            background: #fff;
            border-radius: 20px;
            padding: 10px;
            display: grid;
            grid-template-columns: 1fr 1fr auto;
            gap: 9px;
            max-width: 740px;
        }

        .search-box input {
            border: 1.5px solid #dde8fb;
            border-radius: 14px;
            padding: 13px 14px;
            font-family: inherit;
            outline: none;
            color: #12305b;
            font-weight: 600;
        }

        .search-box input:focus {
            border-color: #8cb7ff;
        }

        .search-box button {
            border: 0;
            border-radius: 14px;
            background: var(--lime);
            padding: 0 20px;
            font-weight: 800;
            color: #12325c;
            cursor: pointer;
        }

        .status-card {
            align-self: center;
            background: rgba(8, 37, 93, 0.33);
            backdrop-filter: blur(4px);
            border: 1px solid rgba(196, 222, 255, 0.35);
            border-radius: 22px;
            padding: 20px;
        }

        .status-title {
            font-size: 0.82rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            color: #c8ddff;
            margin-bottom: 10px;
        }

        .stat-line {
            display: flex;
            justify-content: space-between;
            font-weight: 700;
            margin: 7px 0;
            border-bottom: 1px dashed rgba(206, 222, 255, 0.35);
            padding-bottom: 8px;
            color: #f6fbff;
        }

        .section {
            margin-top: 34px;
        }

        .section-head {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 14px;
            gap: 20px;
        }

        .section-title {
            font-family: "Space Grotesk", sans-serif;
            font-size: clamp(1.35rem, 2.8vw, 2rem);
            letter-spacing: -0.02em;
        }

        .subtle {
            color: var(--muted);
            font-weight: 600;
        }

        .chips {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .chip {
            border: 1.5px solid var(--border);
            background: var(--surface);
            border-radius: 999px;
            padding: 8px 13px;
            font-size: 0.88rem;
            font-weight: 700;
            color: #214c7f;
        }

        .grid {
            display: grid;
            gap: 16px;
        }

        .grid-4 {
            grid-template-columns: repeat(4, minmax(0, 1fr));
        }

        .grid-3 {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

        .card {
            background: var(--surface);
            border: 1.5px solid var(--border);
            border-radius: var(--radius-md);
            padding: 18px;
            box-shadow: 0 8px 24px rgba(24, 70, 138, 0.06);
            transition: transform .22s ease, box-shadow .22s ease;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 30px rgba(24, 70, 138, 0.12);
        }

        .specialty-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: #eaf2ff;
            display: grid;
            place-items: center;
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        .card h3 {
            font-size: 1rem;
            margin-bottom: 6px;
        }

        .doctor-top {
            display: flex;
            gap: 11px;
            margin-bottom: 12px;
        }

        .avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            font-weight: 800;
            color: #fff;
            background: linear-gradient(135deg, #3e90ff, #1d59cc);
            flex: 0 0 auto;
        }

        .doctor-meta {
            font-size: 0.88rem;
            color: var(--muted);
        }

        .doctor-meta strong {
            display: block;
            color: var(--ink);
            font-size: 1rem;
            margin-bottom: 2px;
        }

        .rating {
            font-weight: 800;
            color: #153a69;
            margin-bottom: 9px;
            font-size: 0.9rem;
        }

        .slot {
            border: 1.4px solid #bfdaff;
            background: #f4f8ff;
            color: #1c4b84;
            border-radius: 10px;
            padding: 8px 10px;
            font-size: 0.84rem;
            font-weight: 700;
            margin: 4px 0;
            display: inline-block;
        }

        .quote {
            font-size: 0.95rem;
            color: #204a7c;
            margin-bottom: 12px;
        }

        .author {
            font-size: 0.87rem;
            color: var(--muted);
            font-weight: 700;
        }

        .cta {
            margin: 34px 0 30px;
            background: linear-gradient(125deg, #0f3664 0%, #0a2c56 100%);
            color: #f2f8ff;
            border-radius: var(--radius-lg);
            padding: clamp(24px, 4vw, 38px);
            display: flex;
            justify-content: space-between;
            gap: 18px;
            align-items: center;
        }

        .cta h2 {
            font-family: "Space Grotesk", sans-serif;
            font-size: clamp(1.3rem, 3vw, 2rem);
            margin-bottom: 6px;
        }

        footer {
            padding: 8px 0 24px;
            color: #55739a;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .fade-up {
            animation: fadeUp .65s ease both;
        }

        .fade-up.delay {
            animation-delay: .14s;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(18px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 960px) {
            .nav-links {
                display: none;
            }

            .hero-grid {
                grid-template-columns: 1fr;
            }

            .search-box {
                grid-template-columns: 1fr;
            }

            .grid-4 {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .grid-3 {
                grid-template-columns: 1fr 1fr;
            }

            .cta {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        @media (max-width: 620px) {
            .nav-actions {
                display: none;
            }

            .grid-4,
            .grid-3 {
                grid-template-columns: 1fr;
            }

            .hero {
                border-radius: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <header class="nav fade-up">
            <a href="#" class="brand">zoc<span>doc</span></a>
            <nav class="nav-links">
                <a href="#">Tìm bác sĩ</a>
                <a href="#">Chuyên khoa</a>
                <a href="#">Khám trực tuyến</a>
                <a href="#">Bảo hiểm</a>
            </nav>
            <div class="nav-actions">
                <a class="btn btn-light" href="#">Đăng nhập</a>
                <a class="btn btn-brand" href="#">Đăng ký</a>
            </div>
        </header>

        <section class="hero fade-up delay">
            <div class="hero-grid">
                <div>
                    <h1>Đặt lịch bác sĩ uy tín trực tuyến ngay lập tức</h1>
                    <p>Tìm theo chuyên khoa, bảo hiểm và khu vực để chọn lịch hẹn phù hợp với thời gian của bạn. Không cần chờ máy, không rườm rà giấy tờ.</p>
                    <form class="search-box">
                        <input type="text" placeholder="Chuyên khoa, triệu chứng, dịch vụ">
                        <input type="text" placeholder="Thành phố hoặc mã ZIP">
                        <button type="button">Tìm khám</button>
                    </form>
                </div>

                <aside class="status-card">
                    <div class="status-title">Hôm nay trên nền tảng</div>
                    <div class="stat-line"><span>Bác sĩ đang trực</span><span>12,300+</span></div>
                    <div class="stat-line"><span>Lịch đã đặt</span><span>48,901</span></div>
                    <div class="stat-line"><span>Thời gian chờ trung bình</span><span>&lt; 24 giờ</span></div>
                    <div class="stat-line" style="border-bottom:0;padding-bottom:0;"><span>Mức hài lòng bệnh nhân</span><span>4.8/5</span></div>
                </aside>
            </div>
        </section>

        <section class="section">
            <div class="section-head">
                <h2 class="section-title">Chuyên khoa phổ biến</h2>
                <p class="subtle">Duyệt bác sĩ theo nhóm chăm sóc được tìm nhiều</p>
            </div>
            <div class="grid grid-4">
                <article class="card">
                    <div class="specialty-icon">NK</div>
                    <h3>Nha khoa</h3>
                    <p class="subtle">2,100+ bác sĩ đã xác minh</p>
                </article>
                <article class="card">
                    <div class="specialty-icon">QT</div>
                    <h3>Nội tổng quát</h3>
                    <p class="subtle">Khám trong ngày và cuối tuần</p>
                </article>
                <article class="card">
                    <div class="specialty-icon">MT</div>
                    <h3>Mắt</h3>
                    <p class="subtle">Khám thị lực và tư vấn kính áp tròng</p>
                </article>
                <article class="card">
                    <div class="specialty-icon">TL</div>
                    <h3>Tâm lý trị liệu</h3>
                    <p class="subtle">Tư vấn trực tiếp hoặc qua video</p>
                </article>
            </div>
        </section>

        <section class="section">
            <div class="section-head">
                <h2 class="section-title">Lịch trống trong tuần</h2>
                <div class="chips">
                    <span class="chip">Aetna</span>
                    <span class="chip">Blue Cross</span>
                    <span class="chip">Cigna</span>
                </div>
            </div>

            <div class="grid grid-3">
                <article class="card">
                    <div class="doctor-top">
                        <div class="avatar">AS</div>
                        <div class="doctor-meta">
                            <strong>Tiến sĩ Amy Stone</strong>
                            Y học gia đình
                        </div>
                    </div>
                    <div class="rating">★ 4.9 · 320 đánh giá</div>
                    <span class="slot">Hôm nay · 3:15 PM</span>
                    <span class="slot">Ngày mai · 10:30 AM</span>
                </article>
                <article class="card">
                    <div class="doctor-top">
                        <div class="avatar">JR</div>
                        <div class="doctor-meta">
                            <strong>Tiến sĩ John Reed</strong>
                            Da liễu
                        </div>
                    </div>
                    <div class="rating">★ 4.8 · 281 đánh giá</div>
                    <span class="slot">Hôm nay · 5:00 PM</span>
                    <span class="slot">Thứ 6 · 9:40 AM</span>
                </article>
                <article class="card">
                    <div class="doctor-top">
                        <div class="avatar">LM</div>
                        <div class="doctor-meta">
                            <strong>Tiến sĩ Lila Monroe</strong>
                            Tâm thần học
                        </div>
                    </div>
                    <div class="rating">★ 4.9 · 410 đánh giá</div>
                    <span class="slot">Ngày mai · 11:20 AM</span>
                    <span class="slot">Thứ 7 · 1:00 PM</span>
                </article>
            </div>
        </section>

        <section class="section">
            <div class="section-head">
                <h2 class="section-title">Khách hàng nói gì</h2>
            </div>
            <div class="grid grid-3">
                <article class="card">
                    <p class="quote">"Tôi đặt lịch chưa tới hai phút và được khám ngay trong chiều."</p>
                    <p class="author">- Melissa, New York</p>
                </article>
                <article class="card">
                    <p class="quote">"Bộ lọc bảo hiểm giúp tôi không phải gọi cho 6 phòng khám khác nhau."</p>
                    <p class="author">- David, Austin</p>
                </article>
                <article class="card">
                    <p class="quote">"Từ lúc đặt lịch tới khi check-in đều mượt mà và rõ ràng."</p>
                    <p class="author">- Alina, Seattle</p>
                </article>
            </div>
        </section>

        <section class="cta">
            <div>
                <h2>Hành trình chăm sóc sức khỏe bắt đầu từ đây</h2>
                <p>Tìm bác sĩ bạn tin tưởng và đặt lịch bất cứ lúc nào thuận tiện cho bạn.</p>
            </div>
            <a class="btn btn-brand" href="#">Bắt đầu ngay</a>
        </section>

        <footer>
            Lấy cảm hứng từ phong cách giao diện zocdoc.com, dựng lại bằng HTML/CSS thuần cho mục đích demo.
        </footer>
    </div>
</body>
</html>


@include('admin_view')

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt lịch hẹn</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('css/booking.css') }}">
</head>
<body>
    <div class="page">
        <header class="nav">
            <a href="{{ route('dashboard') }}" class="brand">legal<span>ease</span></a>
            <div class="nav-right">
                <a class="btn light" href="{{ route('dashboard') }}">Quay lại trang chính</a>
                <a class="btn light" href="{{ route('appointments.index') }}">Lịch hẹn của tôi</a>
            </div>
        </header>

        <section class="section">
            <div class="panel">
                <div class="lawyer-top">
                    <div class="avatar">{{ $lawyer->avatar_initials ?: 'LS' }}</div>
                    <div>
                        <h2 style="margin:0;">{{ $lawyer->display_name }}</h2>
                        <p class="muted" style="margin:4px 0;">{{ $lawyer->specialty }} - {{ $lawyer->location }}</p>
                        <p class="muted" style="margin:0;">
                            {{ $lawyer->experience_years }} năm kinh nghiệm |
                            {{ number_format((float) $lawyer->consultation_fee, 0, ',', '.') }} VND/buổi
                        </p>
                    </div>
                </div>

                <p class="lawyer-bio">{{ $lawyer->bio }}</p>
            </div>
        </section>

        <section class="section">
            <form class="panel" method="POST" action="{{ route('appointments.store', $lawyer) }}">
                @csrf
                <h2>Hoàn tất đặt lịch</h2>

                @if($errors->bất kì())
                    <div class="alert error">Vui lòng kiểm tra lại thông tin và thử lại.</div>
                @endif

                <div class="field">
                    <label>Chọn khung giờ</label>
                    @if($availableSlots->isEmpty())
                        <div class="empty">Luật sư này hiện chưa có khung giờ trống trong vài ngày tới.</div>
                    @else
                        <div class="slot-grid">
                            @foreach($availableSlots as $slot)
                                <label class="slot-radio">
                                    <input type="radio" name="slot_id" value="{{ $slot->id }}" @checked((int) old('slot_id') === $slot->id)>
                                    <span>
                                        {{ $slot->start_at->format('d/m H:i') }}<br>
                                        <small>đến {{ $slot->end_at->format('H:i') }}</small>
                                    </span>
                                </label>
                            @endforeach
                        </div>
                    @endif
                    @error('slot_id')
                        <p class="error-text">{{ $message }}</p>
                    @enderror
                </div>

                <div class="field-grid">
                    <div class="field">
                        <label>Họ và tên</label>
                        <input
                            type="text"
                            name="customer_name"
                            value="{{ old('customer_name', $user->name ?? '') }}"
                            placeholder="Nhập họ và tên"
                        >
                        @error('customer_name')
                            <p class="error-text">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field">
                        <label>Email</label>
                        <input
                            type="email"
                            name="customer_email"
                            value="{{ old('customer_email', $user->email ?? '') }}"
                            placeholder="tenban@example.com"
                        >
                        @error('customer_email')
                            <p class="error-text">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="field">
                    <label>Số điện thoại</label>
                    <input type="text" name="customer_phone" value="{{ old('customer_phone') }}" placeholder="09xxxxxxxx">
                    @error('customer_phone')
                        <p class="error-text">{{ $message }}</p>
                    @enderror
                </div>

                <div class="field">
                    <label>Tóm tắt vấn đề (không bắt buộc)</label>
                    <textarea name="issue_summary" placeholder="Mô tả ngắn gọn vấn đề pháp lý của bạn...">{{ old('issue_summary') }}</textarea>
                    @error('issue_summary')
                        <p class="error-text">{{ $message }}</p>
                    @enderror
                </div>

                <div class="actions">
                    <button
                        class="btn brand"
                        type="submit"
                        @disabled($availableSlots->isEmpty())
                    >
                        Xác nhận đặt lịch
                    </button>
                    <a class="btn light" href="{{ route('dashboard') }}">Hủy</a>
                </div>
            </form>
        </section>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác nhận lịch hẹn</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('css/booking.css') }}">
</head>
<body>
    <div class="page">
        <header class="nav">
            <a href="{{ route('dashboard') }}" class="brand">legal<span>ease</span></a>
            <div class="nav-right">
                <a class="btn light" href="{{ route('appointments.index') }}">Lịch hẹn của tôi</a>
                <a class="btn light" href="{{ route('dashboard') }}">Đặt lịch khác</a>
            </div>
        </header>

        @if(session('status'))
            <div class="alert success">{{ session('status') }}</div>
        @endif

        <section class="panel">
            <h2>Lịch hẹn đã được xác nhận</h2>
            <p class="muted">Lịch của bạn đã được ghi nhận. Vui lòng lưu mã lịch hẹn để tiện hỗ trợ khi cần.</p>

            <div class="appointment-list">
                <article class="appointment-item">
                    <div>
                        <strong>Mã lịch hẹn</strong>
                        <div>{{ $appointment->booking_code }}</div>
                    </div>
                    <span class="status-pill status-confirmed">{{ $appointment->status_label }}</span>
                </article>
                <article class="appointment-item">
                    <div>
                        <strong>Luật sư</strong>
                        <div>{{ $appointment->lawyer->display_name }} - {{ $appointment->lawyer->specialty }}</div>
                    </div>
                </article>
                <article class="appointment-item">
                    <div>
                        <strong>Thời gian hẹn</strong>
                        <div>
                            {{ $appointment->appointment_start_at->format('d/m/Y H:i') }}
                            -
                            {{ $appointment->appointment_end_at->format('H:i') }}
                        </div>
                    </div>
                </article>
                <article class="appointment-item">
                    <div>
                        <strong>Thông tin liên hệ</strong>
                        <div>{{ $appointment->customer_name }} - {{ $appointment->customer_phone }}</div>
                        <div>{{ $appointment->customer_email }}</div>
                    </div>
                </article>
                <article class="appointment-item">
                    <div>
                        <strong>Tóm tắt vấn đề</strong>
                        <div>{{ $appointment->issue_summary ?: 'Không có ghi chú bổ sung.' }}</div>
                    </div>
                </article>
            </div>

            <div class="actions" style="margin-top: 14px;">
                <a class="btn brand" href="{{ route('appointments.index') }}">Quản lý lịch hẹn</a>
                <a class="btn light" href="{{ route('dashboard') }}">Về trang chính</a>
            </div>
        </section>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch hẹn của tôi</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('css/booking.css') }}">
</head>
<body>
    <div class="page">
        <header class="nav">
            <a href="{{ route('dashboard') }}" class="brand">legal<span>ease</span></a>
            <div class="nav-right">
                <a class="btn brand" href="{{ route('dashboard') }}">Đặt lịch mới</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn light" type="submit">Đăng xuất</button>
                </form>
            </div>
        </header>

        @if(session('status'))
            <div class="alert success">{{ session('status') }}</div>
        @endif

        <section class="section">
            <div class="section-head">
                <h2>Lịch hẹn của tôi</h2>
                <span class="muted">Tổng: {{ $appointments->total() }}</span>
            </div>

            @if($appointments->isEmpty())
                <div class="empty">Bạn chưa có lịch hẹn nào. Quay lại trang chính để đặt lịch đầu tiên.</div>
            @else
                <div class="appointment-list">
                    @foreach($appointments as $appointment)
                        <article class="appointment-item">
                            <div>
                                <strong>{{ $appointment->lawyer->display_name }}</strong>
                                <div class="muted">{{ $appointment->lawyer->specialty }} - {{ $appointment->lawyer->location }}</div>
                                <div>
                                    {{ $appointment->appointment_start_at->format('d/m/Y H:i') }}
                                    -
                                    {{ $appointment->appointment_end_at->format('H:i') }}
                                </div>
                                <div class="muted">Mã lịch hẹn: {{ $appointment->booking_code }}</div>
                            </div>

                            <div class="actions">
                                <span class="status-pill {{ $appointment->status === 'CANCELLED' ? 'status-cancelled' : 'status-confirmed' }}">
                                    {{ $appointment->status_label }}
                                </span>

                                <a class="btn light" href="{{ route('appointments.confirmation', $appointment) }}">Chi tiết</a>

                                @if($appointment->status !== 'CANCELLED' && $appointment->appointment_start_at->là Tương lai())
                                    <form method="POST" action="{{ route('appointments.cancel', $appointment) }}" onsubmit="return confirm('Bạn có chắc muốn hủy lịch hẹn này?')">
                                        @csrf
                                        <button class="btn danger" type="submit">Hủy lịch</button>
                                    </form>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="pagination">{{ $appointments->links() }}</div>
            @endif
        </section>
    </div>
</body>
</html>

@extends('layouts.app', ['title' => 'Một vài chi tiết cuối cùng · LegalEase'])

@php
    $booking = session('booking');
    $lawyer = $booking ? \App\Data\Lu?t s?::findBySlug($booking['lawyer_slug']) : null;
@endphp

@section('content')
<section class="mx-auto max-w-[1280px] px-8 py-20">
    @if (!$booking || !$lawyer)
        <div class="rounded-2xl border border-text/10 bg-surface p-8 max-w-[560px]">
            <p class="text-[15px] text-muted">Không tìm thấy bối cảnh đặt phòng. Chọn một luật sư và thời gian đầu tiên.</p>
            <a href="{{ route('lawyers.index') }}" class="mt-4 inline-flex items-center gap-2 text-[14px] font-medium text-text transition-colors hover:text-secondary">
                Browse lawyers
                <span aria-hidden="true">â†’</span>
            </a>
        </div>
    @else
        <div class="max-w-[760px]">
            <h1 class="font-display text-[40px] font-medium tracking-[-0.02em] md:text-[48px]">
                A few last details
            </h1>
            <p class="mt-3 text-[17px] text-secondary">
                We'll use these to confirm your booking.
            </p>
        </div>

        <div class="mt-12 grid gap-10 md:grid-cols-[1fr_320px] md:gap-12">
            {{-- Form --}}
            <div class="order-2 md:order-1">
                <form method="POST" action="{{ route('book.details.store') }}" class="space-y-8" novalidate>
                    @csrf

                    {{-- Meeting language --}}
                    <div>
                        <p class="text-[13px] font-medium text-muted">Meeting language</p>
                        <div class="mt-3 grid grid-cols-2 gap-3">
                            <label class="flex cursor-pointer items-center justify-center gap-3 rounded-xl border border-text/10 bg-surface px-4 py-3 text-[14px] text-text transition-colors hover:border-accent">
                                <input type="radio" name="meeting_language" value="vi"
                                       @checked(old('meeting_language') === 'vi')
                                       class="h-4 w-4 border-muted/60 bg-bg text-accent focus:ring-0">
                                <span>Vietnamese</span>
                            </label>
                            <label class="flex cursor-pointer items-center justify-center gap-3 rounded-xl border border-text/10 bg-surface px-4 py-3 text-[14px] text-text transition-colors hover:border-accent">
                                <input type="radio" name="meeting_language" value="en"
                                       @checked(old('meeting_language') === 'en')
                                       class="h-4 w-4 border-muted/60 bg-bg text-accent focus:ring-0">
                                <span>Ti?ng Anh</span>
                            </label>
                        </div>
                        @error('meeting_language') <p class="mt-2 text-[13px] text-error">{{ $message }}</p> @enderror
                    </div>

                    {{-- Li?n h? preference --}}
                    <div>
                        <p class="text-[13px] font-medium text-muted">Liên hệ ưu tiên để xác nhận và nhắc nhở</p>
                        <div class="mt-3 grid grid-cols-2 gap-3">
                            <label class="flex cursor-pointer items-center justify-center gap-3 rounded-xl border border-text/10 bg-surface px-4 py-3 text-[14px] text-text transition-colors hover:border-accent">
                                <input type="radio" name="contact_preference" value="phone"
                                       @checked(old('contact_preference') === 'phone')
                                       class="h-4 w-4 border-muted/60 bg-bg text-accent focus:ring-0">
                                <span>?i?n tho?i</span>
                            </label>
                            <label class="flex cursor-pointer items-center justify-center gap-3 rounded-xl border border-text/10 bg-surface px-4 py-3 text-[14px] text-text transition-colors hover:border-accent">
                                <input type="radio" name="contact_preference" value="email"
                                       @checked(old('contact_preference') === 'email')
                                       class="h-4 w-4 border-muted/60 bg-bg text-accent focus:ring-0">
                                <span>Email</span>
                            </label>
                        </div>
                        @error('contact_preference') <p class="mt-2 text-[13px] text-error">{{ $message }}</p> @enderror
                    </div>

                    {{-- Terms --}}
                    <label class="flex items-start gap-3 text-[13px] text-muted">
                        <input type="checkbox" name="agreed_terms" value="1"
                               @checked(old('agreed_terms'))
                               class="mt-0.5 h-4 w-4 flex-none rounded border-text/20 bg-surface text-accent focus:ring-accent">
                        <span class="leading-relaxed">
                            I agree to the
                            <a href="#" class="text-text transition-colors hover:text-accent">cancellation policy</a>
                            and consultation terms. H?ylations more than 24 hours before the appointment are eligible for a full refund.
                        </span>
                    </label>
                    @error('agreed_terms') <p class="text-[13px] text-error">{{ $message }}</p> @enderror

                    <div class="pt-2">
                        <x-button variant="primary" type="submit" class="w-full">Mẹo?p t?c để xem xét</x-button>
                    </div>
                </form>
            </div>

            {{-- Booking summary --}}
            <aside class="order-1 md:order-2 md:sticky md:top-[88px] md:self-start">
                <div class="rounded-2xl border border-text/10 bg-surface p-6">
                    <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Your booking</p>

                    <div class="mt-5 flex items-center gap-3">
                        <img src="{{ $lawyer['portrait_url'] }}" alt=""
                             loading="lazy"
                             class="h-14 w-14 flex-none rounded-full object-cover object-top grayscale">
                        <div class="min-w-0">
                            <p class="font-display text-[18px] font-medium tracking-tight">{{ $lawyer['name'] }}</p>
                            <p class="truncate text-[13px] text-muted">{{ $lawyer['primary_specialty'] }}</p>
                        </div>
                    </div>

                    <div class="mt-5 space-y-3 border-t border-text/10 pt-5 text-[14px]">
                        <div class="flex items-baseline justify-between gap-2">
                            <span class="text-muted">Date</span>
                            <span class="text-text">{{ \Carbon\Carbon::parse($booking['date'])->format('M j, Y') }}</span>
                        </div>
                        <div class="flex items-baseline justify-between gap-2">
                            <span class="text-muted">Time</span>
                            <span class="text-text">{{ \Carbon\Carbon::createFromFormat('H:i', $booking['time'])->format('g:i A') }}</span>
                        </div>
                        <div class="flex items-baseline justify-between gap-2">
                            <span class="text-muted">Fee</span>
                            <span class="text-text">{{ number_format($lawyer['price_per_hour']) }} VND</span>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    @endif
</section>
@endsection

@extends('layouts.app', ['title' => 'Trả tiền đặt cọc Â · LegalEase'])

@php
    use Carbon\Carbon;

    $booking = session('booking');
    $lawyer = $booking ? \App\Data\Lu?t s?::findBySlug($booking['lawyer_slug']) : null;
    $fee = $lawyer['price_per_hour'] ?? 0;
    $deposit = (int) round($fee * 0.20);
@endphp

@section('content')
<section class="mx-auto max-w-[720px] px-8 py-20">
    @if (!$booking || !$lawyer)
        <div class="rounded-2xl border border-text/10 bg-surface p-8">
            <p class="text-[15px] text-muted">Không có đặt phòng nào đang diễn ra. Chọn một luật sư và thời gian đầu tiên.</p>
            <a href="{{ route('lawyers.index') }}" class="mt-4 inline-flex items-center gap-2 text-[14px] font-medium text-text transition-colors hover:text-secondary">
                Browse lawyers
                <span aria-hidden="true">â†’</span>
            </a>
        </div>
    @else
        <h1 class="font-display text-[40px] font-medium tracking-[-0.02em] md:text-[48px]">
            Pay your deposit
        </h1>
        <p class="mt-3 text-[17px] text-secondary">
            We collect 20% of the consultation fee now to secure your booking. The remaining 80% is paid directly to the lawyer at the appointment.
        </p>

        {{-- Booking summary --}}
        <div class="mt-12 rounded-2xl border border-text/10 bg-surface p-8">
            <div class="flex items-center gap-4">
                <img src="{{ $lawyer['portrait_url'] }}" alt=""
                     class="h-14 w-14 flex-none rounded-full object-cover object-top grayscale">
                <div class="min-w-0">
                    <p class="font-display text-[18px] font-medium tracking-tight">{{ $lawyer['name'] }}</p>
                    <p class="text-[13px] text-muted">
                        {{ Carbon::parse($booking['date'])->format('M j, Y') }} Â· {{ Carbon::createFromFormat('H:i', $booking['time'])->format('g:i A') }}
                    </p>
                </div>
            </div>

            <div class="my-6 h-px bg-text/10"></div>

            <div class="space-y-3 text-[14px]">
                <div class="flex items-baseline justify-between gap-4">
                    <span class="text-muted">Consultation fee</span>
                    <span class="text-text">{{ number_format($fee) }} VND</span>
                </div>
                <div class="flex items-baseline justify-between gap-4">
                    <span class="text-muted">Đặt cọc (20%)</span>
                    <span class="text-text">{{ number_format($deposit) }} VND</span>
                </div>
                <div class="flex items-baseline justify-between gap-4">
                    <span class="text-muted">Số dư đến hạn tại cuộc hẹn</span>
                    <span class="text-text">{{ number_format($fee - $deposit) }} VND</span>
                </div>
            </div>

            <div class="my-6 h-px bg-text/10"></div>

            <div class="flex items-baseline justify-between gap-4">
                <span class="text-[15px] font-medium text-text">Pay today</span>
                <span class="font-display text-[24px] font-medium tracking-tight text-accent">{{ number_format($deposit) }} VND</span>
            </div>
        </div>

        {{-- Payment form --}}
        <form method="POST" action="{{ route('book.payment.store') }}" class="mt-10" novalidate
              x-data="{ method: 'card' }">
            @csrf
            <input type="hidden" name="method" :value="method">

            <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Pay with</p>

            {{-- Method tabs --}}
            <div class="mt-3 grid grid-cols-3 gap-2">
                <button type="button" @click="method = 'card'"
                        :class="method === 'card' ? 'border-accent bg-accent/5' : 'border-text/10 hover:border-text/30'"
                        class="rounded-xl border px-4 py-3 text-[13px] font-medium text-text transition-colors">
                    Card
                </button>
                <button type="button" @click="method = 'qr'"
                        :class="method === 'qr' ? 'border-accent bg-accent/5' : 'border-text/10 hover:border-text/30'"
                        class="rounded-xl border px-4 py-3 text-[13px] font-medium text-text transition-colors">
                    VietQR
                </button>
                <button type="button" @click="method = 'transfer'"
                        :class="method === 'transfer' ? 'border-accent bg-accent/5' : 'border-text/10 hover:border-text/30'"
                        class="rounded-xl border px-4 py-3 text-[13px] font-medium text-text transition-colors">
                    Bank transfer
                </button>
            </div>

            {{-- Card form --}}
            <div x-show="method === 'card'" class="mt-6 space-y-4">
                <div>
                    <label for="card_number" class="block text-[13px] font-medium text-muted">Card number</label>
                    <input id="card_number" type="text" inputmode="numeric" maxlength="19"
                           placeholder="1234 5678 9012 3456"
                           class="mt-2 block w-full rounded-xl border border-text/10 bg-surface px-4 py-3 text-[15px] text-text placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                </div>
                <div>
                    <label for="card_name" class="block text-[13px] font-medium text-muted">H? t?n trên thẻ</label>
                    <input id="card_name" type="text"
                           placeholder="NGUYEN VAN A"
                           class="mt-2 block w-full rounded-xl border border-text/10 bg-surface px-4 py-3 text-[15px] text-text placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="card_expiry" class="block text-[13px] font-medium text-muted">Expiry</label>
                        <input id="card_expiry" type="text" inputmode="numeric" maxlength="5"
                               placeholder="MM/YY"
                               class="mt-2 block w-full rounded-xl border border-text/10 bg-surface px-4 py-3 text-[15px] text-text placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                    </div>
                    <div>
                        <label for="card_cvv" class="block text-[13px] font-medium text-muted">CVV</label>
                        <input id="card_cvv" type="text" inputmode="numeric" maxlength="4"
                               placeholder="123"
                               class="mt-2 block w-full rounded-xl border border-text/10 bg-surface px-4 py-3 text-[15px] text-text placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">
                    </div>
                </div>
            </div>

            {{-- VietQR --}}
            <div x-show="method === 'qr'" x-cloak class="mt-6 rounded-2xl border border-text/10 bg-surface p-6 text-center">
                <div class="mx-auto flex h-48 w-48 items-center justify-center rounded-xl bg-text">
                    <svg class="h-32 w-32 text-bg" viewBox="0 0 100 100" fill="currentColor">
                        <rect x="0" y="0" width="30" height="30"/>
                        <rect x="35" y="0" width="10" height="10"/>
                        <rect x="55" y="0" width="10" height="10"/>
                        <rect x="70" y="0" width="30" height="30"/>
                        <rect x="40" y="15" width="20" height="10"/>
                        <rect x="0" y="35" width="10" height="10"/>
                        <rect x="20" y="35" width="15" height="10"/>
                        <rect x="45" y="35" width="10" height="20"/>
                        <rect x="65" y="35" width="20" height="10"/>
                        <rect x="90" y="35" width="10" height="15"/>
                        <rect x="10" y="50" width="20" height="10"/>
                        <rect x="55" y="55" width="15" height="10"/>
                        <rect x="80" y="60" width="20" height="10"/>
                        <rect x="0" y="70" width="30" height="30"/>
                        <rect x="35" y="70" width="10" height="20"/>
                        <rect x="55" y="80" width="20" height="10"/>
                        <rect x="80" y="80" width="20" height="20"/>
                    </svg>
                </div>
                <p class="mt-5 text-[13px] text-secondary">
                    Scan with any VietQR-compatible bank app to pay {{ number_format($deposit) }} VND.
                </p>
                <p class="mt-2 text-[12px] text-muted">Đặt phòng sẽ tự động xác nhận sau khi chúng tôi nhận được thanh toán.</p>
            </div>

            {{-- Bank transfer --}}
            <div x-show="method === 'transfer'" x-cloak class="mt-6 rounded-2xl border border-text/10 bg-surface p-6">
                <p class="text-[13px] text-muted">Transfer the deposit to:</p>
                <dl class="mt-4 space-y-3 text-[14px]">
                    <div class="flex items-baseline justify-between gap-4">
                        <dt class="text-muted">Bank</dt>
                        <dd class="text-text">Vietcombank</dd>
                    </div>
                    <div class="flex items-baseline justify-between gap-4">
                        <dt class="text-muted">Account name</dt>
                        <dd class="text-text">PHÁP LUẬT CỘNG Tý</dd>
                    </div>
                    <div class="flex items-baseline justify-between gap-4">
                        <dt class="text-muted">Account number</dt>
                        <dd class="font-display text-text">0011 0000 1234 5678</dd>
                    </div>
                    <div class="flex items-baseline justify-between gap-4">
                        <dt class="text-muted">Reference</dt>
                        <dd class="text-text">Mã đặt phòng của bạn (được gửi khi xác nhận)</dd>
                    </div>
                </dl>
                <p class="mt-5 text-[12px] text-muted">
                    Most transfers clear within minutes. We'll email you once the deposit lands.
                </p>
            </div>

            <div class="mt-8">
                <x-button variant="primary" type="submit" class="w-full">
                    Pay {{ number_format($deposit) }} VND
                </x-button>
            </div>

            <p class="mt-4 text-center text-[14px]">
                <a href="{{ route('book.review') }}" class="text-muted transition-colors hover:text-accent">
                    â† Quay l?i to review
                </a>
            </p>

            <p class="mt-6 text-center text-[12px] text-muted">
                Payments are processed securely. We never store full card numbers.
            </p>
        </form>
    @endif
</section>
@endsection

@extends('layouts.app', ['title' => '??nh gi? đặt phòng của bạn · LegalEase'])

@php
    $booking = session('booking');
    $bookingDetails = session('booking_details');
    $lawyer = $booking ? \App\Data\Lu?t s?::findBySlug($booking['lawyer_slug']) : null;
@endphp

@section('content')
<section class="mx-auto max-w-[720px] px-8 py-20">
    @if (!$booking || !$lawyer || !$bookingDetails)
        <div class="rounded-2xl border border-text/10 bg-surface p-8">
            <p class="text-[15px] text-muted">Không có đặt phòng nào đang diễn ra. Chọn một luật sư và thời gian đầu tiên.</p>
            <a href="{{ route('lawyers.index') }}" class="mt-4 inline-flex items-center gap-2 text-[14px] font-medium text-text transition-colors hover:text-secondary">
                Browse lawyers
                <span aria-hidden="true">â†’</span>
            </a>
        </div>
    @else
        <h1 class="font-display text-[40px] font-medium tracking-[-0.02em] md:text-[48px]">
            ??nh gi? your booking
        </h1>
        <p class="mt-3 text-[17px] text-secondary">
            Confirm the details below.
        </p>

        <div class="mt-12 rounded-2xl border border-text/10 bg-surface p-8">
            {{-- Lawyer --}}
            <div>
                <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Lawyer</p>
                <div class="mt-4 flex items-center gap-4">
                    <img src="{{ $lawyer['portrait_url'] }}" alt=""
                         class="h-16 w-16 flex-none rounded-full object-cover object-top grayscale">
                    <div class="min-w-0">
                        <p class="font-display text-[22px] font-medium tracking-tight">{{ $lawyer['name'] }}</p>
                        <p class="text-[13px] text-muted">
                            {{ $lawyer['primary_specialty'] }}@if (!empty($lawyer['bar_association'])) Â· {{ $lawyer['bar_association'] }}@endif
                        </p>
                    </div>
                </div>
            </div>

            <div class="my-6 h-px bg-text/10"></div>

            {{-- When --}}
            <div>
                <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">When</p>
                <p class="mt-3 text-[18px] text-text">
                    {{ \Carbon\Carbon::parse($booking['date'])->format('l, F j, Y') }}
                </p>
                <p class="mt-1 text-[15px] text-secondary">
                    {{ \Carbon\Carbon::createFromFormat('H:i', $booking['time'])->format('g:i A') }} Â· 60-minute consultation
                </p>
            </div>

            <div class="my-6 h-px bg-text/10"></div>

            {{-- Where --}}
            <div>
                <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Where</p>
                <p class="mt-3 text-[15px] text-text">
                    {{ $lawyer['address']['street_address'] ?? '' }}
                </p>
                <p class="text-[15px] text-secondary">
                    {{ $lawyer['address']['province'] ?? '' }}
                </p>
            </div>

            <div class="my-6 h-px bg-text/10"></div>

            {{-- Preferences --}}
            <div>
                <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Preferences</p>
                <div class="mt-3 grid grid-cols-2 gap-4 text-[14px]">
                    <div>
                        <p class="text-muted">Meeting language</p>
                        <p class="mt-1 text-text">{{ $bookingDetails['meeting_language'] === 'vi' ? 'Vietnamese' : 'Ti?ng Anh' }}</p>
                    </div>
                    <div>
                        <p class="text-muted">Lý?n h? để xác nhận</p>
                        <p class="mt-1 text-text">{{ ucfirst($bookingDetails['contact_preference']) }}</p>
                    </div>
                </div>
            </div>

            <div class="my-6 h-px bg-text/10"></div>

            {{-- Payment --}}
            <div>
                <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Payment</p>
                <div class="mt-3 flex items-baseline justify-between gap-4">
                    <p class="text-[15px] text-text">Consultation fee</p>
                    <p class="font-display text-[22px] font-medium tracking-tight">
                        {{ number_format($lawyer['price_per_hour']) }} VND
                    </p>
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="mt-10">
            <x-button variant="primary" :href="route('book.payment')" class="w-full">Tip?p t?c để thanh toán</x-button>
        </div>

        <p class="mt-4 text-center text-[14px]">
            <a href="{{ route('book.details') }}" class="text-muted transition-colors hover:text-accent">
                Edit preferences
            </a>
            <span class="mx-2 text-muted/40">Â·</span>
            <a href="{{ route('lawyers.show', ['slug' => $booking['lawyer_slug']]) }}" class="text-muted transition-colors hover:text-accent">
                Change slot
            </a>
        </p>
    @endif
</section>
@endsection

@extends('layouts.app', ['title' => 'Đã xác nhận đặt phòng · LegalEase'])

@php
    $completed = session('completed_booking');
    $lawyer = $completed ? \App\Data\Lu?t s?::findBySlug($completed['lawyer_slug']) : null;
    $user = auth()->user();
    $firstH? t?n = $user ? explode(' ', trim($user->name))[0] : null;
@endphp

@section('content')
<section class="mx-auto max-w-[720px] px-8 py-20">
    @if (!$completed || !$lawyer)
        <div class="rounded-2xl border border-text/10 bg-surface p-8">
            <p class="text-[15px] text-muted">Không tìm thấy đặt phòng. Duyệt luật sư để làm một cái mới.</p>
            <a href="{{ route('lawyers.index') }}" class="mt-4 inline-flex items-center gap-2 text-[14px] font-medium text-text transition-colors hover:text-secondary">
                Browse lawyers
                <span aria-hidden="true">â†’</span>
            </a>
        </div>
    @else
        <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Booking confirmed</p>
        <h1 class="mt-3 font-display text-[48px] font-medium leading-[1.05] tracking-[-0.02em] md:text-[60px]">
            You're all set{{ $firstH? t?n ? ', ' . $firstH? t?n : '' }}.
        </h1>
        <p class="mt-4 text-[17px] text-secondary">
            We've sent the details to your email. {{ $lawyer['name'] }} has been notified.
        </p>

        {{-- Booking card --}}
        <div class="mt-12 rounded-2xl border border-text/10 bg-surface p-8">
            <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Booking code</p>
            <p class="mt-2 font-display text-[28px] font-medium tracking-tight">{{ $completed['booking_code'] }}</p>

            <div class="my-6 h-px bg-text/10"></div>

            <div class="flex items-center gap-4">
                <img src="{{ $lawyer['portrait_url'] }}" alt=""
                     class="h-16 w-16 flex-none rounded-full object-cover object-top grayscale">
                <div class="min-w-0">
                    <p class="font-display text-[20px] font-medium tracking-tight">{{ $lawyer['name'] }}</p>
                    <p class="text-[13px] text-muted">{{ $lawyer['primary_specialty'] }}</p>
                </div>
            </div>

            <div class="my-6 h-px bg-text/10"></div>

            <div class="space-y-3 text-[14px]">
                <div class="flex items-baseline justify-between gap-4">
                    <span class="text-muted">Date</span>
                    <span class="text-right text-text">{{ \Carbon\Carbon::parse($completed['date'])->format('l, F j, Y') }}</span>
                </div>
                <div class="flex items-baseline justify-between gap-4">
                    <span class="text-muted">Time</span>
                    <span class="text-text">{{ \Carbon\Carbon::createFromFormat('H:i', $completed['time'])->format('g:i A') }}</span>
                </div>
                <div class="flex items-baseline justify-between gap-4">
                    <span class="flex-none text-muted">??ch?</span>
                    <span class="text-right text-text">
                        {{ $lawyer['address']['street_address'] ?? '' }}<br>
                        {{ $lawyer['address']['province'] ?? '' }}
                    </span>
                </div>
            </div>
        </div>

        {{-- What happens next --}}
        <div class="mt-12">
            <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Điều gì xảy ra tiếp theo</p>
            <ul class="mt-6 space-y-4 text-[15px] leading-relaxed text-secondary">
                <li>You'll get a reminder via {{ $completed['contact_preference'] === 'phone' ? 'phone' : 'email' }} 24 hours before your appointment.</li>
                <li>Đến văn phòng sớm vài phút. Mang theo bất kỳ tài liệu nào bạn muốn luật sư xem xét.</li>
                <li>Cần hủy bỏ? H?ylation trước hơn 24 giờ sẽ được hoàn lại toàn bộ số tiền.</li>
            </ul>
        </div>

        {{-- Actions --}}
        <div class="mt-12">
            <x-button variant="primary" href="{{ route('lawyers.index') }}" class="w-full">
                Browse more lawyers
            </x-button>
            <p class="mt-4 text-center text-[14px]">
                <a href="/" class="text-muted transition-colors hover:text-accent">Đưa tôi về nhà</a>
            </p>
        </div>
    @endif
</section>
@endsection

@props([
    'variant' => 'primary',
    'href' => null,
    'type' => 'button',
])

@php
    $base = 'inline-flex items-center justify-center rounded-full px-6 py-3 text-[14px] font-medium transition-all duration-200';

    $styles = match ($variant) {
        'primary'   => 'bg-gold text-bg bóng-[0_0_0_0_rgba(212,162,76,0)] di chuột:shadow-[0_0_18px_1px_rgba(212,162,76,0.22)]',
        'secondary' => 'đường viền tắt tiếng văn bản-văn bản di chuột:di chuột dấu đường viền:dấu văn bản',
        'ghost'     => 'di chuột bị tắt tiếng văn bản: di chuột bằng dấu văn bản: gạch chân gạch dưới-offset-4',
        default     => '',
    };

    $classes = trim($base . ' ' . $styles);
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->class($classes) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->class($classes) }}>
        {{ $slot }}
    </button>
@endif

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
                <h4 class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Vì Lu?t s?</h4>
                <ul class="mt-4 space-y-3 text-[14px]">
                    <li><a href="{{ route('for-lawyers') }}" class="text-text transition-colors hover:text-accent">Tham gia nền tảng</a></li>
                    <li><a href="{{ route('lawyer.resources') }}" class="text-text transition-colors hover:text-accent">Resources</a></li>
                    <li><a href="{{ route('lawyer.login') }}" class="text-text transition-colors hover:text-accent">Lawyer login</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Support</h4>
                <ul class="mt-4 space-y-3 text-[14px]">
                    <li><a href="{{ route('contact') }}" class="text-text transition-colors hover:text-accent">Li?n h?</a></li>
                    <li><a href="{{ route('faq') }}" class="text-text transition-colors hover:text-accent">FAQ</a></li>
                    <li><a href="{{ route('terms') }}" class="text-text transition-colors hover:text-accent">Điều khoản sử dụng</a></li>
                    <li><a href="{{ route('privacy') }}" class="text-text transition-colors hover:text-accent">Ch?nh s?ch b?o m?t</a></li>
                </ul>
            </div>
        </div>

        <div class="mt-16 flex flex-col items-start justify-between gap-4 border-t border-text/10 pt-8 md:flex-row md:items-center">
            <p class="text-[13px] text-muted">© 2026 LegalEase. Mọi quyền được bảo lưu.</p>

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

@props(['name', 'size' => 32])

@php
    $paths = [
        'users'     => '<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7,75"/>',
        'briefcase' => '<orth x="2" y="7" width="20" Height="14" rx="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>',
        'home'      => '<path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline point="9 22 9 12 15 12 15 22"/>',
        'shield'    => '<đường dẫn d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>',
        'hard-hat'  => '<path d="M2 18h20v2a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/><path d="M10 10V5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v5"/><path d="M4 18v-4a8 8 0 0 1 16 0v4"/>',
        'scale'     => '<path d="M16 16l3-8 3 8c-.87.65-1.92 1-3 1s-2.13-.35-3-1z"/><path d="M2 16l3-8 3 8c-.87.65-1.92 1-3 1s-2.13-.35-3-1z"/><path d="M7 21h10"/><path d="M12 3v18"/><path d="M3 7h2c2 0 5-1 7-2 2 1 5 2 7 2h2"/>',
        'search'        => '<circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/>',
        'chevron-down'  => '<điểm đa tuyến="6 9 12 15 18 9"/>',
        'map-pin'       => '<path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>',
    ];
@endphp

<svg xmlns="http://www.w3.org/2000/svg"
     width="{{ $size }}" height="{{ $size }}"
     viewBox="0 0 24 24"
     fill="none"
     stroke="currentColor"
     stroke-width="1.5"
     stroke-linecap="round"
     stroke-linejoin="round"
     {{ $attributes }}>
    {!! $paths[$name] ?? '' !!}
</svg>

@props(['lawyer'])

<a href="/lawyers/{{ $lawyer['slug'] }}"
   class="group flex flex-col overflow-hidden rounded-2xl border border-text/10 bg-surface p-6 transition-all duration-200 hover:-translate-y-0.5 hover:border-accent">
    <div class="overflow-hidden rounded-xl">
        <img src="{{ $lawyer['portrait_url'] }}"
             alt="{{ $lawyer['name'] }}"
             loading="lazy"
             class="aspect-square w-full object-cover object-top grayscale">
    </div>

    @php
        $shortProvince = match ($lawyer['address']['province'] ?? null) {
            'Ho Chi Minh City' => 'TP.HCM',
            default            => $lawyer['address']['province'] ?? null,
        };
    @endphp

    <div class="mt-5 flex items-center gap-2">
        <h3 class="font-display text-2xl font-medium tracking-tight text-text">
            {{ $lawyer['name'] }}
        </h3>
        @if (($lawyer['verification_status'] ?? null) === 'VERIFIED')
            <span title="Verified" class="inline-flex h-5 w-5 flex-none items-center justify-center rounded-full bg-gold/15 text-gold">
                <svg class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
            </span>
        @endif
    </div>

    <div class="mt-3 flex items-center justify-between gap-3">
        <span class="inline-flex items-center rounded-full border border-muted/60 px-3 py-1 text-[12px] font-medium text-muted">
            {{ $lawyer['primary_specialty'] }}
        </span>
        @if ($shortProvince)
            <span class="inline-flex items-center gap-1 text-[13px] text-muted">
                <x-icon name="map-pin" :size="14" />
                {{ $shortProvince }}
            </span>
        @endif
    </div>

    <p class="mt-3 text-[14px] text-muted">
        {{ $lawyer['years_of_experience'] }} years experience Â· {{ number_format($lawyer['price_per_hour']) }} VND/hr
    </p>

    <div class="mt-3">
        <x-rating-stars :rating="$lawyer['rating']" :review-count="$lawyer['review_count']" />
    </div>

    <div class="mt-5">
        <x-button variant="secondary" class="w-full group-hover:border-accent group-hover:text-accent">
            View profile
        </x-button>
    </div>
</a>

@php
    $links = [
        ['label' => 'Trang ch?', 'url' => '/'],
        ['label' => 'Lu?t s?', 'url' => '/lawyers'],
        ['label' => 'D?ch v? ph?p l?', 'url' => '/legal-services'],
        ['label' => 'Li?n h?', 'url' => '/contact'],
    ];
@endphp

<nav class="fixed inset-x-0 top-0 z-50 h-[72px] border-b border-text/10 bg-bg/80 backdrop-blur-md">
    <div class="mx-auto flex h-full max-w-[1280px] items-center justify-between px-8">
        <a href="/" class="inline-flex items-center gap-2 font-display text-xl font-medium tracking-tight text-text">
            <img src="{{ asset('images/logo2.png') }}" alt="LegalEase Logo" class="h-9 w-auto object-contain">
            <span>LegalEase</span>
        </a>

        <div class="hidden items-center gap-8 md:flex">
            @foreach ($links as $link)
                @php $active = request()->path() === ltrim($link['url'], '/'); @endphp
                <a href="{{ $link['url'] }}"
                   class="text-[15px] font-medium text-muted transition-colors duration-250 hover:text-text
                          {{ $active ? 'text-text underline decoration-accent underline-offset-8' : '' }}">
                    {{ $link['label'] }}
                </a>
            @endforeach
        </div>

        @auth
            @php $firstH? t?n = explode(' ', trim(auth()->user()->name))[0]; @endphp
            <div x-data="{ open: false }" @click.outside="open = false" class="relative">
                <button type="button" @click="open = !open"
                        class="inline-flex items-center gap-2 rounded-full border border-muted px-5 py-3 text-[14px] font-medium text-text transition-colors duration-200 hover:border-accent hover:text-accent">
                    <span>{{ $firstH? t?n }}</span>
                    <svg class="h-4 w-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''"
                         viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <polyline points="6 9 12 15 18 9"/>
                    </svg>
                </button>
                <div x-show="open" x-transition x-cloak
                     class="absolute right-0 mt-2 w-52 origin-top-right rounded-2xl border border-text/10 bg-surface py-2 shadow-lg">
                    <div class="px-4 py-2">
                        <p class="font-display text-[15px] font-medium text-text">{{ auth()->user()->name }}</p>
                        <p class="truncate text-[12px] text-muted">{{ auth()->user()->email }}</p>
                    </div>
                    <div class="my-1 h-px bg-text/10"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="block w-full px-4 py-2 text-left text-[14px] text-text transition-colors hover:bg-text/5 hover:text-accent">
                            ??ng xu?t
                        </button>
                    </form>
                </div>
            </div>
        @else
            <a href="{{ route('login') }}"
               class="inline-flex items-center rounded-full border border-muted px-6 py-3 text-[14px] font-medium text-text transition-colors duration-200 hover:border-accent hover:text-accent">
                ??ng nh?p
            </a>
        @endauth
    </div>
</nav>

@props([
    'rating' => 0,
    'reviewCount' => null,
    'size' => 'md',
])

@php
    $filled = (int) round($rating);
    $sizeClass = $size === 'sm' ? 'h-4 w-4' : 'h-[18px] w-[18px]';
    $textClass = $size === 'sm' ? 'text-[13px]' : 'text-[14px]';
@endphp

<div {{ $attributes->class('inline-flex items-center gap-2') }}>
    <div class="inline-flex items-center gap-0.5">
        @for ($i = 1; $i <= 5; $i++)
            <svg class="{{ $sizeClass }} {{ $i <= $filled ? 'text-gold' : 'text-text/20' }}"
                 viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 2l2.9 6.9L22 9.8l-5.5 4.8 1.7 7.4L12 18l-6.2 4 1.7-7.4L2 9.8l7.1-.9L12 2z"/>
            </svg>
        @endfor
    </div>
    @if ($reviewCount !== null)
        <span class="{{ $textClass }} text-muted">({{ number_format($reviewCount) }} reviews)</span>
    @endif
</div>

@extends('layouts.app', ['title' => 'H?y tư vấn Â · LegalEase'])

@php
    $consultationStart = \Carbon\Carbon::parse($consultation['date'] . ' ' . $consultation['time']);
    $hoursUntil = (int) now()->diffInHours($consultationStart, false);
    $eligibleForRefund = $hoursUntil > 24;
@endphp

@section('content')
<section class="mx-auto max-w-[640px] px-8 pt-24 pb-24">
    <a href="{{ route('consultations.show', $consultation['booking_code']) }}"
       class="text-[14px] text-muted transition-colors hover:text-accent">
        â† Quay l?i to consultation
    </a>

    <p class="mt-10 text-[12px] font-medium uppercase tracking-[0.1em] text-muted">H?y tư vấn</p>
    <h1 class="mt-3 font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">
        H?y your consultation?
    </h1>
    <p class="mt-4 text-[17px] text-secondary">
        This can't be undone.
        @if ($eligibleForRefund)
            You'll receive a full refund of your deposit within 3 to 5 business days.
        @else
            H?ylations less than 24 hours before the appointment are not eligible for a refund.
        @endif
    </p>

    {{-- Lawyer + when summary --}}
    <div class="mt-10 rounded-2xl border border-text/10 bg-surface p-6">
        <div class="flex items-center gap-4">
            <img src="{{ $lawyer['portrait_url'] }}" alt=""
                 class="h-14 w-14 flex-none rounded-full object-cover object-top grayscale">
            <div class="min-w-0">
                <p class="font-display text-[18px] font-medium tracking-tight">{{ $lawyer['name'] }}</p>
                <p class="text-[13px] text-muted">{{ $lawyer['primary_specialty'] }}</p>
            </div>
        </div>

        <div class="mt-5 border-t border-text/10 pt-5">
            <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">When</p>
            <p class="mt-1 font-display text-[16px] font-medium tracking-tight">
                {{ $consultationStart->format('l, F j, Y') }} Â· {{ $consultationStart->format('g:i A') }}
            </p>
        </div>
    </div>

    <form method="POST" action="{{ route('consultations.cancel.store', $consultation['booking_code']) }}"
          class="mt-10 flex flex-wrap items-center gap-x-6 gap-y-4">
        @csrf
        <x-button variant="primary" type="submit">Có, hủy tư vấn</x-button>
        <a href="{{ route('consultations.show', $consultation['booking_code']) }}"
           class="text-[14px] text-muted transition-colors hover:text-accent">
            Keep my consultation
        </a>
    </form>
</section>
@endsection

@extends('layouts.app', ['title' => 'Tư vấn · LegalEase'])

@section('content')
<section class="mx-auto max-w-[800px] px-8 pt-24 pb-24">
    <a href="{{ route('home') }}" class="text-[14px] text-muted transition-colors hover:text-accent">
        â† Quay l?i to dashboard
    </a>

    <p class="mt-10 text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Consultation</p>
    <h1 class="mt-3 font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">
        Your consultation with {{ $lawyer['name'] }}
    </h1>
    <p class="mt-4 text-[14px] text-muted">{{ $consultation['booking_code'] }}</p>

    {{-- Lawyer card --}}
    <div class="mt-12 rounded-2xl border border-text/10 bg-surface p-6">
        <div class="flex items-center gap-5">
            <img src="{{ $lawyer['portrait_url'] }}" alt=""
                 class="h-20 w-20 flex-none rounded-full object-cover object-top grayscale">
            <div class="min-w-0">
                <p class="font-display text-[22px] font-medium tracking-tight">{{ $lawyer['name'] }}</p>
                <p class="text-[14px] text-muted">
                    {{ $lawyer['primary_specialty'] }} Â· {{ $lawyer['bar_association'] }}
                </p>
            </div>
        </div>
    </div>

    {{-- When + where --}}
    <div class="mt-10 grid gap-10 md:grid-cols-2">
        <div>
            <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">When</p>
            <p class="mt-2 font-display text-[20px] font-medium tracking-tight">
                {{ \Carbon\Carbon::parse($consultation['date'])->format('l, F j, Y') }}
            </p>
            <p class="text-[14px] text-secondary">
                {{ \Carbon\Carbon::createFromFormat('H:i', $consultation['time'])->format('g:i A') }} Â· 60 minutes
            </p>
        </div>
        <div>
            <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Where</p>
            <p class="mt-2 text-[15px] text-text">{{ $lawyer['address']['street_address'] }}</p>
            <p class="text-[14px] text-muted">{{ $lawyer['address']['province'] }}</p>
        </div>
    </div>

    @if ($consultation['status'] === 'cancelled')
        {{-- H?yled --}}
        <div class="mt-16 border-t border-text/10 pt-12">
            <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Status</p>
            <div class="mt-3 inline-flex items-center gap-2 rounded-full border border-error/40 bg-error/10 px-4 py-1.5">
                <span class="block h-2 w-2 rounded-full bg-error"></span>
                <span class="text-[13px] font-medium text-error">h?yled</span>
            </div>
            <p class="mt-6 max-w-[520px] text-[15px] text-secondary">
                You cancelled this consultation on {{ \Carbon\Carbon::parse($consultation['cancelled_at'])->format('M j, Y') }}.
                @if ($consultation['refund_eligible'])
                    Your full deposit will be refunded within 3 to 5 business days.
                @else
                    H?ylations less than 24 hours before the appointment are not eligible for a refund.
                @endif
            </p>
        </div>

        {{-- Book again --}}
        <div class="mt-12 border-t border-text/10 pt-12">
            <a href="{{ route('lawyers.show', $consultation['lawyer_slug']) }}"
               class="inline-flex items-center gap-2 text-[15px] font-medium text-text transition-colors hover:text-secondary">
                Book {{ $lawyer['name'] }} again
                <span aria-hidden="true">â†’</span>
            </a>
        </div>
    @elseif ($consultation['status'] === 'upcoming')
        {{-- Status (upcoming) --}}
        <div class="mt-16 border-t border-text/10 pt-12">
            <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Status</p>
            <div class="mt-3 inline-flex items-center gap-2 rounded-full border border-success/40 bg-success/10 px-4 py-1.5">
                <span class="block h-2 w-2 rounded-full bg-success"></span>
                <span class="text-[13px] font-medium text-success">?? x?c nh?n</span>
            </div>
            <p class="mt-6 max-w-[520px] text-[15px] text-secondary">
                Your consultation is booked. You'll receive a reminder 24 hours before. H?ylations more than 24 hours in advance are fully refunded.
            </p>
        </div>

        {{-- Manage --}}
        <div class="mt-12 border-t border-text/10 pt-12">
            <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Manage</p>
            <div class="mt-4 flex flex-wrap items-center gap-x-6 gap-y-3">
                <a href="{{ route('consultations.cancel', $consultation['booking_code']) }}"
                   class="text-[14px] font-medium text-error transition-colors hover:text-error/80">
                    H?y consultation
                </a>
                <a href="{{ route('contact') }}"
                   class="text-[14px] text-muted transition-colors hover:text-accent">
                    Get in touch with our team â†’
                </a>
            </div>
        </div>
    @else
        {{-- ??nh gi? (past) --}}
        <div class="mt-16 border-t border-text/10 pt-12">
            @if ($consultation['rated'])
                <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Your review</p>
                <div class="mt-3 flex flex-wrap items-center gap-3">
                    <x-rating-stars :rating="$consultation['stars']" size="md" />
                    <span class="text-[13px] text-muted">
                        G?ited {{ \Carbon\Carbon::parse($consultation['reviewed_at'])->format('M j, Y') }}
                    </span>
                </div>
                @if (!empty($consultation['review_text']))
                    <blockquote class="mt-6 border-l-2 border-text/10 pl-5 text-[17px] leading-relaxed text-secondary">
                        â€œ{{ $consultation['review_text'] }}â€
                    </blockquote>
                @endif
            @else
                <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Nó thế nào?</p>
                <h2 class="mt-3 font-display text-[28px] font-medium tracking-[-0.01em] md:text-[32px]">
                    Let other clients know.
                </h2>
                <p class="mt-3 max-w-[520px] text-[15px] text-secondary">
                    Honest reviews help future clients pick the right lawyer.
                </p>
                <div class="mt-8">
                    <x-button variant="primary" :href="route('consultations.rate', $consultation['booking_code'])">
                        Leave a review
                    </x-button>
                </div>
            @endif
        </div>

        {{-- Book again --}}
        <div class="mt-16 border-t border-text/10 pt-12">
            <a href="{{ route('lawyers.show', $consultation['lawyer_slug']) }}"
               class="inline-flex items-center gap-2 text-[15px] font-medium text-text transition-colors hover:text-secondary">
                Book {{ $lawyer['name'] }} again
                <span aria-hidden="true">â†’</span>
            </a>
        </div>
    @endif
</section>
@endsection

@extends('errors._layout', [
    'code'    => 'L?i 404',
    'heading' => "We couldn't find that page",
    'body'    => 'Liên kết có thể bị hỏng hoặc trang có thể đã được di chuyển.',
    'photo'   => 'https://images.unsplash.com/photo-1433574466251-fe1be0d9b3d2?q=80',
])

@section('actions')
    <x-button variant="primary" :href="route('home')">Đưa tôi về nhà</x-button>
@endsection

@extends('errors._layout', [
    'heading' => 'Phiên của bạn đã hết hạn',
    'body'    => 'Để bảo mật cho bạn, biểu mẫu bạn cố gửi đã hết thời gian chờ. Hãy làm mới trang và thử lại.',
    'photo'   => 'https://images.unsplash.com/photo-1501139083538-0139583c060f?q=80',
])

@extends('layouts.app', ['title' => ($heading ?? 'Something went wrong') . ' Â· LegalEase'])

@section('content')
<section class="relative -mt-[72px] flex min-h-screen items-center justify-center overflow-hidden">
    {{-- Photo --}}
    <img src="{{ $photo }}"
         alt=""
         class="absolute inset-0 h-full w-full object-cover grayscale brightness-[0.55]">

    {{-- Scrim --}}
    <div class="absolute inset-0 bg-gradient-to-b from-bg/40 via-bg/20 to-bg"></div>

    {{-- Content --}}
    <div class="relative z-10 mx-auto max-w-[640px] px-6 text-center">
        @if (!empty($code))
            <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">{{ $code }}</p>
        @endif
        <h1 class="@if (!empty($code)) mt-4 @endif font-display text-[44px] font-medium tracking-[-0.02em] md:text-[64px]">{{ $heading }}</h1>
        <p class="mt-6 text-[16px] text-secondary md:text-[17px]">{{ $body }}</p>

        @hasSection('actions')
            <div class="mt-10 flex justify-center">
                @yield('actions')
            </div>
        @endif
    </div>
</section>
@endsection

@extends('layouts.app', ['title' => 'Báo cáo kết quả · LegalEase'])

@section('content')
<section class="mx-auto max-w-[640px] px-8 pt-24 pb-24">
    <a href="{{ route('lawyer.appointments.show', $appointment['booking_code']) }}"
       class="text-[14px] text-muted transition-colors hover:text-accent">
        â† Quay l?i to appointment
    </a>

    <p class="mt-10 text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Report outcome</p>
    <h1 class="mt-3 font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">
        How did it go?
    </h1>
    <p class="mt-4 text-[17px] text-secondary">
        Once you choose, we'll release payment, update the booking, and either unlock the customer's review or process the no-show.
    </p>

    {{-- Customer summary --}}
    <div class="mt-10 flex items-center gap-4 rounded-2xl border border-text/10 bg-surface p-5">
        <div class="flex h-14 w-14 flex-none items-center justify-center rounded-full bg-avatar">
            <span class="font-display text-[15px] font-medium text-text">{{ $appointment['customer_initials'] }}</span>
        </div>
        <div class="min-w-0">
            <p class="font-display text-[18px] font-medium tracking-tight">{{ $appointment['customer_name'] }}</p>
            <p class="text-[13px] text-muted">
                {{ \Carbon\Carbon::parse($appointment['date'])->format('M j, Y') }} Â· {{ \Carbon\Carbon::createFromFormat('H:i', $appointment['time'])->format('g:i A') }}
            </p>
        </div>
    </div>

    <form method="POST" action="{{ route('lawyer.appointments.outcome.store', $appointment['booking_code']) }}"
          class="mt-10 space-y-8" novalidate
          x-data="{ outcome: '{{ old('outcome', '') }}' }">
        @csrf

        <div class="space-y-4">
            {{-- Outcome A --}}
            <label class="block cursor-pointer">
                <input type="radio" name="outcome" value="completed" x-model="outcome" class="sr-only">
                <div class="rounded-2xl border bg-surface p-6 transition-colors"
                     :class="outcome === 'completed' ? 'border-accent' : 'border-text/10 hover:border-text/30'">
                    <div class="flex items-start gap-4">
                        <span class="mt-1 flex h-5 w-5 flex-none items-center justify-center rounded-full border"
                              :class="outcome === 'completed' ? 'border-accent' : 'border-text/30'">
                            <span class="h-2.5 w-2.5 rounded-full bg-accent transition-opacity"
                                  :class="outcome === 'completed' ? 'opacity-100' : 'opacity-0'"></span>
                        </span>
                        <div class="min-w-0">
                            <p class="font-display text-[20px] font-medium tracking-tight">L?ch h?n đã hoàn thành</p>
                            <p class="mt-2 text-[14px] leading-relaxed text-secondary">
                                The customer attended and the consultation took place. The platform retains the full deposit. The customer can now leave a review.
                            </p>
                        </div>
                    </div>
                </div>
            </label>

            {{-- Outcome B --}}
            <label class="block cursor-pointer">
                <input type="radio" name="outcome" value="no_show_customer" x-model="outcome" class="sr-only">
                <div class="rounded-2xl border bg-surface p-6 transition-colors"
                     :class="outcome === 'no_show_customer' ? 'border-accent' : 'border-text/10 hover:border-text/30'">
                    <div class="flex items-start gap-4">
                        <span class="mt-1 flex h-5 w-5 flex-none items-center justify-center rounded-full border"
                              :class="outcome === 'no_show_customer' ? 'border-accent' : 'border-text/30'">
                            <span class="h-2.5 w-2.5 rounded-full bg-accent transition-opacity"
                                  :class="outcome === 'no_show_customer' ? 'opacity-100' : 'opacity-0'"></span>
                        </span>
                        <div class="min-w-0">
                            <p class="font-display text-[20px] font-medium tracking-tight">Khách hàng không xuất hiện</p>
                            <p class="mt-2 text-[14px] leading-relaxed text-secondary">
                                The customer forfeits the deposit. You'll receive 25% of the deposit (5% of the consultation fee) as compensation for the reserved time.
                            </p>
                        </div>
                    </div>
                </div>
            </label>
        </div>

        @error('outcome') <p class="text-[13px] text-error">{{ $message }}</p> @enderror

        <div class="flex flex-wrap items-center gap-x-6 gap-y-4">
            <x-button variant="primary" type="submit" x-bind:disabled="!outcome"
                      x-bind:class="!outcome ? 'opacity-50 cursor-not-allowed' : ''">
                G?i outcome
            </x-button>
            <a href="{{ route('lawyer.appointments.show', $appointment['booking_code']) }}"
               class="text-[14px] text-muted transition-colors hover:text-accent">
                H?y
            </a>
        </div>
    </form>
</section>
@endsection

@extends('layouts.app', ['title' => 'L?ch h?n Â · LegalEase'])

@php
    $start = \Carbon\Carbon::parse($appointment['date'] . ' ' . $appointment['time']);
    $isS?p t?i = $appointment['status'] === 'CONFIRMED' && $start->isFuture();
    $isAwaitingOutcome = $appointment['status'] === 'CONFIRMED' && $start->is?? qua();
    $isHo?n t?t = $appointment['status'] === 'COMPLETED';
    $isNoShow = $appointment['status'] === 'NO_SHOW_BY_CUSTOMER';
@endphp

@section('content')
<section class="mx-auto max-w-[800px] px-8 pt-24 pb-24">
    <a href="{{ route('lawyer.dashboard') }}" class="text-[14px] text-muted transition-colors hover:text-accent">
        â† Quay l?i to dashboard
    </a>

    <p class="mt-10 text-[12px] font-medium uppercase tracking-[0.1em] text-muted">L?ch h?n</p>
    <h1 class="mt-3 font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">
        L?ch h?n with {{ $appointment['customer_name'] }}
    </h1>
    <p class="mt-4 text-[14px] text-muted">{{ $appointment['booking_code'] }}</p>

    {{-- Customer card --}}
    <div class="mt-12 rounded-2xl border border-text/10 bg-surface p-6">
        <div class="flex items-center gap-5">
            <div class="flex h-20 w-20 flex-none items-center justify-center rounded-full bg-avatar">
                <span class="font-display text-[22px] font-medium text-text">{{ $appointment['customer_initials'] }}</span>
            </div>
            <div class="min-w-0">
                <p class="font-display text-[22px] font-medium tracking-tight">{{ $appointment['customer_name'] }}</p>
                <p class="text-[14px] text-muted">
                    <a href="tel:{{ str_replace(' ', '', $appointment['customer_phone']) }}" class="transition-colors hover:text-accent">
                        {{ $appointment['customer_phone'] }}
                    </a>
                </p>
            </div>
        </div>
    </div>

    {{-- When --}}
    <div class="mt-10">
        <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">When</p>
        <p class="mt-2 font-display text-[20px] font-medium tracking-tight">
            {{ $start->format('l, F j, Y') }}
        </p>
        <p class="text-[14px] text-secondary">
            {{ $start->format('g:i A') }} Â· 60 minutes
        </p>
    </div>

    {{-- Status --}}
    <div class="mt-16 border-t border-text/10 pt-12">
        <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Status</p>

        @if ($isS?p t?i)
            <div class="mt-3 inline-flex items-center gap-2 rounded-full border border-success/40 bg-success/10 px-4 py-1.5">
                <span class="block h-2 w-2 rounded-full bg-success"></span>
                <span class="text-[13px] font-medium text-success">?? x?c nh?n</span>
            </div>
            <p class="mt-6 max-w-[520px] text-[15px] text-secondary">
                The customer has paid the deposit. Once the consultation is finished, come back here to report the outcome.
            </p>
        @elseif ($isAwaitingOutcome)
            <div class="mt-3 inline-flex items-center gap-2 rounded-full border border-gold/40 bg-gold/10 px-4 py-1.5">
                <span class="block h-2 w-2 rounded-full bg-gold"></span>
                <span class="text-[13px] font-medium text-gold">Awaiting outcome</span>
            </div>
            <p class="mt-6 max-w-[520px] text-[15px] text-secondary">
                The appointment time has passed. Report whether it took place so we can release payment and unlock the customer's review.
            </p>
            <div class="mt-8">
                <x-button variant="primary" :href="route('lawyer.appointments.outcome', $appointment['booking_code'])">
                    Report outcome
                </x-button>
            </div>
        @elseif ($isHo?n t?t)
            <div class="mt-3 inline-flex items-center gap-2 rounded-full border border-success/40 bg-success/10 px-4 py-1.5">
                <span class="block h-2 w-2 rounded-full bg-success"></span>
                <span class="text-[13px] font-medium text-success">Ho?n t?t</span>
            </div>
            <p class="mt-6 max-w-[520px] text-[15px] text-secondary">
                You reported this consultation as completed on {{ \Carbon\Carbon::parse($appointment['outcome_reported_at'])->format('M j, Y') }}.
            </p>
        @elseif ($isNoShow)
            <div class="mt-3 inline-flex items-center gap-2 rounded-full border border-error/40 bg-error/10 px-4 py-1.5">
                <span class="block h-2 w-2 rounded-full bg-error"></span>
                <span class="text-[13px] font-medium text-error">Customer no-show</span>
            </div>
            <p class="mt-6 max-w-[520px] text-[15px] text-secondary">
                Reported on {{ \Carbon\Carbon::parse($appointment['outcome_reported_at'])->format('M j, Y') }}. The customer forfeited the deposit. Your compensation (25% of the deposit) is processed within 3 to 5 business days.
            </p>
        @endif
    </div>

    {{-- Customer review (if any) --}}
    @if ($isHo?n t?t && !empty($appointment['customer_review']))
        <div class="mt-12 border-t border-text/10 pt-12">
            <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Customer review</p>
            <div class="mt-3 flex flex-wrap items-center gap-3">
                <x-rating-stars :rating="$appointment['customer_review']['stars']" size="md" />
                <span class="text-[13px] text-muted">
                    G?ited {{ \Carbon\Carbon::parse($appointment['customer_review']['reviewed_at'])->format('M j, Y') }}
                </span>
            </div>
            @if (!empty($appointment['customer_review']['review_text']))
                <blockquote class="mt-6 border-l-2 border-text/10 pl-5 text-[17px] leading-relaxed text-secondary">
                    â€œ{{ $appointment['customer_review']['review_text'] }}â€
                </blockquote>
            @endif
            <p class="mt-6 text-[13px] text-muted">
                If this review violates our guidelines, you can
                <a href="{{ route('contact') }}" class="text-text transition-colors hover:text-accent">gắn cờ nó để quản trị viên xem xét â†'</a>
            </p>
        </div>
    @endif
</section>
@endsection

@extends('layouts.app', ['title' => 'Lu?t s? Â · Dễ dàng pháp lý'])

@php
    $allLu?t s? = \App\Data\Lu?t s?::all();

    $specialties = [
        'Family Law', 'Business Law', 'Real Estate', 'Criminal Defense',
        'Labor Law', 'Civil Litigation',
    ];
    $locations = ['Hanoi', 'Ho Chi Minh City', 'Da Nang'];
    $languages = ['Vietnamese', 'Ti?ng Anh'];

    // Minimal slice of lawyer data for client-side filtering â€” keeps the JS payload small.
    $lawyersForFilter = array_map(fn ($l) => [
        'specialty_tags' => $l['specialty_tags'],
        'price_per_hour' => $l['price_per_hour'],
        'languages'      => $l['languages'],
        'province'       => $l['address']['province'] ?? null,
    ], $allLu?t s?);
@endphp

@section('content')
    <section class="mx-auto max-w-[1280px] px-8 pt-24 pb-24"
             x-data="lawyerFilters({{ json_encode($lawyersForFilter) }})">
        {{-- Header --}}
        <nav class="text-[14px] text-muted">
            <a href="/" class="transition-colors hover:text-accent">Trang ch?</a>
            <span class="px-1">/</span>
            <span class="text-text">Lu?t s?</span>
        </nav>

        <h1 class="mt-6 font-display text-[48px] font-medium tracking-[-0.02em] md:text-[56px]">
            Find your lawyer
        </h1>
        <p class="mt-3 text-[17px] text-secondary">Duyệt qua hơn 500 luật sư đã được xác minh trên khắp Việt Nam.</p>

        <div class="mt-10 grid grid-cols-1 gap-12 md:grid-cols-[240px_1fr]">
            {{-- Sidebar filters --}}
            <aside class="self-start md:sticky md:top-[88px]">
                <div class="rounded-2xl border border-text/10 bg-surface p-6">
                    <h3 class="font-display text-[20px] font-medium tracking-tight">Filters</h3>

                    {{-- Specialty --}}
                    <div class="mt-6">
                        <h4 class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Specialty</h4>
                        <div class="mt-3 space-y-2">
                            @foreach ($specialties as $spec)
                                <label class="flex items-center gap-3 text-[14px] text-text">
                                    <input type="checkbox" value="{{ $spec }}" x-model="specialties"
                                           class="h-4 w-4 rounded border border-muted/60 bg-bg text-accent focus:ring-0 focus:ring-offset-0">
                                    <span>{{ $spec }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Location --}}
                    <div class="mt-8">
                        <h4 class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Location</h4>
                        <div class="mt-3 space-y-2">
                            @foreach ($locations as $loc)
                                <label class="flex items-center gap-3 text-[14px] text-text">
                                    <input type="checkbox" value="{{ $loc }}" x-model="locations"
                                           class="h-4 w-4 rounded border border-muted/60 bg-bg text-accent focus:ring-0 focus:ring-offset-0">
                                    <span>{{ $loc }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Price range --}}
                    <div class="mt-8">
                        <h4 class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Price range</h4>
                        <input type="range" min="500000" max="5000000" step="100000"
                               x-model.number="maxPrice"
                               class="mt-4 w-full accent-accent">
                        <p class="mt-2 text-[13px] text-muted">
                            500,000 to <span x-text="Number(maxPrice).toLocaleString('en-US')"></span> VND
                        </p>
                    </div>

                    {{-- Ng?n ng? --}}
                    <div class="mt-8">
                        <h4 class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Cái gì?</h4>
                        <div class="mt-3 space-y-2">
                            @foreach ($languages as $lang)
                                <label class="flex items-center gap-3 text-[14px] text-text">
                                    <input type="checkbox" value="{{ $lang }}" x-model="languages"
                                           class="h-4 w-4 rounded border border-muted/60 bg-bg text-accent focus:ring-0 focus:ring-offset-0">
                                    <span>{{ $lang }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Reset --}}
                    <div class="mt-8 border-t border-text/10 pt-4" x-show="hasActiveFilters" x-cloak>
                        <button type="button" @click="reset()"
                                class="text-[14px] text-muted transition-colors hover:text-accent hover:underline underline-offset-4">
                            Reset filters
                        </button>
                    </div>
                </div>
            </aside>

            {{-- Results --}}
            <div>
                {{-- No results --}}
                <div x-show="visibleCount === 0" x-cloak
                     class="flex flex-col items-center justify-center rounded-2xl border border-text/10 bg-surface px-8 py-20 text-center">
                    <h3 class="font-display text-[28px] font-medium tracking-tight md:text-[32px]">
                        No lawyers match your filters.
                    </h3>
                    <p class="mt-3 max-w-md text-[15px] leading-relaxed text-secondary">
                        Try adjusting or clearing some filters to see more options.
                    </p>
                    <button type="button" @click="reset()"
                            class="mt-8 inline-flex items-center gap-2 text-[14px] font-medium text-text transition-colors hover:text-secondary">
                        Reset filters
                        <span aria-hidden="true">â†’</span>
                    </button>
                </div>

                {{-- Results grid --}}
                <div x-show="visibleCount > 0" class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($allLu?t s? as $i => $lawyer)
                        <div x-show="matches(lawyersForFilter[{{ $i }}])" x-cloak>
                            <x-lawyer-card :lawyer="$lawyer" />
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div x-show="visibleCount > 0"
                     class="mt-16 flex items-center justify-center gap-2 text-[14px]">
                    <a href="#" class="rounded-full px-4 py-2 text-muted transition-colors hover:text-accent">â† Trước đó</a>
                    <a href="#" class="rounded-full bg-surface px-4 py-2 text-accent">1</a>
                    <a href="#" class="rounded-full px-4 py-2 text-muted transition-colors hover:text-accent">2</a>
                    <a href="#" class="rounded-full px-4 py-2 text-muted transition-colors hover:text-accent">3</a>
                    <a href="#" class="rounded-full px-4 py-2 text-muted transition-colors hover:text-accent">Ti?p theo â†’</a>
                </div>
            </div>
        </div>
    </section>

    <script>
        function lawyerFilters(allLu?t s?) {
            return {
                lawyersForFilter: allLu?t s?,
                specialties: [],
                locations: [],
                languages: [],
                maxPrice: 5000000,

                get hasActiveFilters() {
                    return this.specialties.length > 0
                        || this.locations.length > 0
                        || this.languages.length > 0
                        || cái này.maxGiá < 5000000;
                },

                get visibleCount() {
                    return this.lawyersForFilter.filter(l => this.matches(l)).length;
                },

                matches(lawyer) {
                    if (this.specialties.length > 0
                        && !lawyer.specialty_tags.some(s => this.specialties.includes(s))) return false;
                    if (this.locations.length > 0
                        && !this.locations.includes(lawyer.province)) return false;
                    if (this.languages.length > 0
                        && !lawyer.languages.some(l => this.languages.includes(l))) return false;
                    if (lawyer.price_per_hour > this.maxPrice) return false;
                    return true;
                },

                reset() {
                    this.specialties = [];
                    this.locations = [];
                    this.languages = [];
                    this.maxPrice = 5000000;
                },
            };
        }
    </script>
@endsection

@extends('layouts.app', ['title' => '??nh gi? sự tư vấn của bạn · LegalEase'])

@section('content')
<section class="mx-auto max-w-[640px] px-8 pt-24 pb-24">
    <p class="text-[12px] font-medium uppercase tracking-[0.1em] text-muted">Your consultation</p>
    <h1 class="mt-3 font-display text-[36px] font-medium tracking-[-0.02em] md:text-[44px]">
        How did it go?
    </h1>
    <p class="mt-4 text-[17px] text-secondary">
        Honest feedback helps other clients pick the right lawyer.
    </p>

    {{-- Lawyer summary --}}
    <div class="mt-12 flex items-center gap-4 rounded-2xl border border-text/10 bg-surface p-5">
        <img src="{{ $lawyer['portrait_url'] }}"
             alt=""
             class="h-16 w-16 flex-none rounded-full object-cover object-top grayscale">
        <div class="min-w-0">
            <p class="font-display text-[20px] font-medium tracking-tight">{{ $lawyer['name'] }}</p>
            <p class="text-[13px] text-muted">{{ $lawyer['primary_specialty'] }}</p>
        </div>
    </div>

    <form method="POST" action="{{ route('consultations.rate.store', $consultation['booking_code']) }}"
          class="mt-10 space-y-8" novalidate
          x-data="{ stars: {{ (int) old('stars', 0) }}, hover: 0 }"
          @submit="if (!stars) { $event.preventDefault(); }">
        @csrf

        {{-- Stars --}}
        <div>
            <p class="text-[13px] font-medium text-muted">
                How would you rate your experience?
            </p>
            <div class="mt-4 flex items-center gap-2">
                @for ($i = 1; $i <= 5; $i++)
                    <button type="button"
                            @click="stars = {{ $i }}"
                            @mouseover="hover = {{ $i }}"
                            @mouseleave="hover = 0"
                            aria-label="{{ $i }} star{{ $i === 1 ? '' : 's' }}"
                            class="transition-transform duration-150 hover:scale-110 focus:outline-none">
                        <svg class="h-10 w-10 transition-colors duration-150"
                             :class="(hover || stars) >= {{ $i }} ? 'text-gold' : 'text-text/20'"
                             viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2l2.9 6.9L22 9.8l-5.5 4.8 1.7 7.4L12 18l-6.2 4 1.7-7.4L2 9.8l7.1-.9L12 2z"/>
                        </svg>
                    </button>
                @endfor
            </div>
            <input type="hidden" name="stars" :value="stars">
            <p x-show="!stars && {{ $errors->has('stars') ? 'true' : 'false' }}" x-cloak
               class="mt-3 text-[13px] text-error">Vui l?ng ch?n s? sao ??nh gi?.</p>
            @error('stars') <p class="mt-3 text-[13px] text-error">{{ $message }}</p> @enderror
        </div>

        {{-- ??nh gi? text --}}
        <div>
            <label for="review_text" class="block text-[13px] font-medium text-muted">
                Add a review <span class="text-muted/60">(không bắt buộc)</span>
            </label>
            <textarea id="review_text" name="review_text" rows="6" maxlength="2000"
                      placeholder="What stood out? Anything that could have been better?"
                      class="mt-3 block w-full resize-y rounded-xl border border-text/10 bg-surface px-4 py-3 text-[15px] leading-relaxed text-text placeholder:text-muted/60 focus:border-accent focus:outline-none focus:ring-1 focus:ring-accent">{{ old('review_text') }}</textarea>
            @error('review_text') <p class="mt-2 text-[13px] text-error">{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center gap-6">
            <x-button variant="primary" type="submit">G?i xem xét</x-button>
            <a href="{{ route('consultations.show', $consultation['booking_code']) }}" class="text-[14px] text-muted transition-colors hover:text-accent">
                Maybe later
            </a>
        </div>
    </form>
</section>
@endsection

@extends('layouts.app', ['title' => $lawyer['name'] . ' Â· LegalEase'])

@php
    use Carbon\Carbon;

    $today = Carbon::today('Asia/Ho_Chi_Minh');
    $days = [];
    foreach ($lawyer['availability'] as $entry) {
        $date = $today->copy()->addDays($entry['day_offset']);
        $slotList = [];
        foreach ($entry['slots'] as $t) {
            $slotList[] = [
                'time'  => $t,
                'label' => Carbon::createFromFormat('H:i', $t)->format('g:i A'),
            ];
        }
        $days[] = [
            'abbrev'  => strtoupper($date->format('D')),
            'dayNum'  => $date->day,
            'dateStr' => $date->toDateString(),
            'slots'   => $slotList,
        ];
    }
@endphp

@section('content')
    <section class="mx-auto max-w-[1280px] px-8 py-20">
        <nav class="text-[14px] text-muted">
            <a href="/" class="transition-colors hover:text-accent">Trang ch?</a>
            <span class="px-1">/</span>
            <a href="/lawyers" class="transition-colors hover:text-accent">Lu?t s?</a>
            <span class="px-1">/</span>
            <span class="text-text">{{ $lawyer['name'] }}</span>
        </nav>

        <div class="mt-10 grid gap-16 md:grid-cols-3">
            {{-- Left: profile --}}
            <div class="md:col-span-2">
                <div class="overflow-hidden rounded-2xl">
                    <img src="{{ $lawyer['portrait_url'] }}"
                         alt="{{ $lawyer['name'] }}"
                         class="aspect-[4/5] max-h-[560px] w-full object-cover object-top grayscale">
                </div>

                <div class="mt-10 flex items-center gap-3">
                    <h1 class="font-display text-[40px] font-medium tracking-[-0.02em] md:text-[48px]">
                        {{ $lawyer['name'] }}
                    </h1>
                    @if (($lawyer['verification_status'] ?? null) === 'VERIFIED')
                        <span title="Verified" class="inline-flex h-7 w-7 flex-none items-center justify-center rounded-full bg-gold/15 text-gold">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                        </span>
                    @endif
                </div>
                <p class="mt-2 text-[15px] text-muted">
                    Attorney at Law
                    @if (!empty($lawyer['bar_association'])) Â· {{ $lawyer['bar_association'] }} @endif
                    Â· {{ $lawyer['years_of_experience'] }} years experience
                </p>

                <div class="mt-3">
                    <x-rating-stars :rating="$lawyer['rating']" :review-count="$lawyer['review_count']" />
                </div>

                <div class="mt-4 flex flex-wrap gap-2">
                    @foreach ($lawyer['specialty_tags'] as $tag)
                        <span class="inline-flex items-center rounded-full border border-muted/60 px-3 py-1 text-[12px] font-medium text-muted">
                            {{ $tag }}
                        </span>
                    @endforeach
                </div>

                {{-- About --}}
                <div class="mt-12">
                    <h2 class="font-display text-[24px] font-medium tracking-tight">About</h2>
                    <div class="mt-4 space-y-4 text-[16px] leading-relaxed text-secondary">
                        @foreach ($lawyer['bio'] as $paragraph)
                            <p>{{ $paragraph }}</p>
                        @endforeach
                    </div>
                </div>

                {{-- Education --}}
                <div class="mt-12">
                    <h2 class="font-display text-[24px] font-medium tracking-tight">Education</h2>
                    <ul class="mt-4 space-y-3">
                        @foreach ($lawyer['education'] as $edu)
                            <li class="flex items-baseline justify-between gap-6 border-b border-text/10 pb-3">
                                <div>
                                    <p class="text-[15px] text-text">{{ $edu['degree'] }}</p>
                                    <p class="text-[14px] text-muted">{{ $edu['institution'] }}</p>
                                </div>
                                <span class="text-[14px] text-muted">{{ $edu['year'] }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Ng?n ng?s --}}
                <div class="mt-12">
                    <h2 class="font-display text-[24px] font-medium tracking-tight">Ng?n ng?s</h2>
                    <div class="mt-4 flex flex-wrap gap-2">
                        @foreach ($lawyer['languages'] as $lang)
                            <span class="inline-flex items-center rounded-full border border-muted/60 px-3 py-1 text-[13px] text-text">
                                {{ $lang }}
                            </span>
                        @endforeach
                    </div>
                </div>

                {{-- Practice areas --}}
                <div class="mt-12">
                    <h2 class="font-display text-[24px] font-medium tracking-tight">Practice areas</h2>
                    <div class="mt-4 flex flex-wrap gap-2">
                        @foreach ($lawyer['specialty_tags'] as $tag)
                            <span class="inline-flex items-center rounded-full border border-muted/60 px-3 py-1 text-[13px] text-text">
                                {{ $tag }}
                            </span>
                        @endforeach
                    </div>
                </div>

                {{-- ??nh gi?s --}}
                <div class="mt-12">
                    <h2 class="font-display text-[24px] font-medium tracking-tight">Client reviews</h2>
                    <div class="mt-6 space-y-4">
                        @foreach ($lawyer['reviews'] as $review)
                            @php
                                $initial = mb_strtoupper(mb_substr($review['author'], 0, 1));
                                $reviewDate = Carbon::parse($review['date'])->format('M j, Y');
                            @endphp
                            <article class="rounded-2xl border border-text/10 bg-surface p-6">
                                <header class="flex items-start gap-4">
                                    <div class="flex h-11 w-11 flex-none items-center justify-center rounded-full bg-avatar font-display text-[18px] font-medium text-text">
                                        {{ $initial }}
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-baseline justify-between gap-4">
                                            <p class="text-[15px] font-medium text-text">{{ $review['author'] }}</p>
                                            <p class="text-[13px] text-muted">{{ $reviewDate }}</p>
                                        </div>
                                        <div class="mt-1">
                                            <x-rating-stars :rating="$review['stars']" size="sm" />
                                        </div>
                                    </div>
                                </header>
                                <p class="mt-4 text-[15px] leading-relaxed text-text/90">{{ $review['text'] }}</p>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Right: booking panel --}}
            <aside class="md:col-span-1">
                <div class="md:sticky md:top-[88px]"
                     x-data='{
                        selected: 0,
                        days: @json($days),
                        pickSlot(dateStr, time, label) {
                            const params = new URLT?m ki?mParams({
                                lawyer: "{{ $lawyer['slug'] }}",
                                date: dateStr,
                                time: time,
                            });
                            window.location.href = "{{ route('book.start') }}?" + params.toString();
                        }
                    }'>
                    <div class="flex min-h-[560px] flex-col rounded-2xl border border-text/10 bg-surface p-8">
                        <h3 class="font-display text-[24px] font-medium tracking-tight">Đặt lịch tư vấn</h3>

                        <div class="mt-4">
                            <p class="font-display text-[32px] font-medium leading-none tracking-tight text-accent">
                                {{ number_format($lawyer['price_per_hour']) }} VND
                            </p>
                            <p class="mt-2 text-[13px] text-muted">per consultation</p>
                        </div>

                        @if (!empty($lawyer['address']['street_address']))
                            <div class="mt-5 flex items-start gap-2 text-[13px]">
                                <svg class="mt-[2px] h-4 w-4 flex-none text-muted" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                <span class="text-secondary">
                                    {{ $lawyer['address']['street_address'] }}, {{ $lawyer['address']['province'] }}
                                </span>
                            </div>
                        @endif

                        <div class="my-6 h-px bg-text/10"></div>

                        {{-- Date pills --}}
                        <div class="flex gap-1.5 overflow-hidden pb-1">
                            @foreach ($days as $i => $day)
                                <button type="button"
                                        @click="selected = {{ $i }}"
                                        :class="selected === {{ $i }} ? 'bg-text text-bg border-text' : 'border-muted/60 text-text hover:border-accent'"
                                        class="flex min-w-0 flex-1 flex-col items-center rounded-xl border px-1 py-2 transition-colors">
                                    <span class="text-[10px] font-medium uppercase tracking-[0.04em]"
                                          :class="selected === {{ $i }} ? 'text-bg/60' : 'text-muted'">
                                        {{ $day['abbrev'] }}
                                    </span>
                                    <span class="mt-0.5 font-display text-[18px] font-medium leading-none">
                                        {{ $day['dayNum'] }}
                                    </span>
                                </button>
                            @endforeach
                        </div>

                        <div class="mt-6">
                            <h4 class="text-[13px] font-medium uppercase tracking-[0.1em] text-muted">Available times</h4>
                        </div>

                        @foreach ($days as $i => $day)
                            <div x-show="selected === {{ $i }}" x-cloak class="mt-4">
                                @if (count($day['slots']) === 0)
                                    <p class="text-[13px] text-muted">Không có thời gian có sẵn vào ngày này.</p>
                                @else
                                    <div class="grid grid-cols-2 gap-3">
                                        @foreach ($day['slots'] as $slot)
                                            <button type="button"
                                                    @click="pickSlot('{{ $day['dateStr'] }}', '{{ $slot['time'] }}', '{{ $slot['label'] }}')"
                                                    class="rounded-xl border border-muted/60 px-3 py-3 text-center text-[13px] text-text transition-colors hover:border-accent hover:bg-accent/10">
                                                {{ $slot['label'] }}
                                            </button>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endforeach

                        <p class="mt-auto pt-6 text-[13px] leading-relaxed text-muted">
                            You'll confirm details after choosing a time.
                        </p>
                    </div>
                </div>
            </aside>
        </div>
    </section>
@endsection

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'LegalEase' }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gelasio:wght@400;500;600;700&family=IBM+Plex+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script>
      (function () {
        const originalWarn = console.warn;
        console.warn = function (...args) {
          const first = args[0];
          if (typeof first === 'string' && first.includes('cdn.tailwindcss.com should not be used in production')) {
            return;
          }
          originalWarn.apply(console, args);
        };
      })();
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-bg text-text font-sans antialiased">
    <x-nav />

    <main class="pt-[72px]">
        @yield('content')
    </main>

    <x-footer />
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'LegalEase' }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gelasio:wght@400;500;600;700&family=IBM+Plex+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script>
      (function () {
        const originalWarn = console.warn;
        console.warn = function (...args) {
          const first = args[0];
          if (typeof first === 'string' && first.includes('cdn.tailwindcss.com should not be used in production')) {
            return;
          }
          originalWarn.apply(console, args);
        };
      })();
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-bg text-text font-sans antialiased">
    <main class="flex min-h-screen items-center justify-center px-6 py-16">
        @yield('content')
    </main>
</body>
</html>

<article class="flex flex-col rounded-2xl border border-text/10 bg-surface p-8 md:p-10">
    <div class="flex items-center justify-between">
        <x-icon :name="$area['icon']" :size="56" class="text-text" />
        <span class="font-display text-[28px] font-medium text-muted">
            {{ str_pad($number, 2, '0', STR_PAD_LEFT) }}
        </span>
    </div>

    <h2 class="mt-8 font-display text-[26px] font-medium leading-tight tracking-[-0.01em] md:text-[28px]">
        {{ $area['name'] }}
    </h2>

    <p class="mt-3 text-[15px] text-muted">
        {{ $area['description'] }}
    </p>

    @if (!empty($area['scenarios']))
        <p class="mt-8 text-[12px] font-medium uppercase tracking-[0.1em] text-muted">
            You might come here if
        </p>
        <ul class="mt-4 space-y-3 text-[15px] leading-relaxed text-secondary">
            @foreach ($area['scenarios'] as $scenario)
                <li class="flex gap-3">
                    <span class="mt-[10px] block h-px w-3 flex-none bg-text/30"></span>
                    <span>{{ $scenario }}</span>
                </li>
            @endforeach
        </ul>
    @endif

    <div class="mt-auto pt-8">
        <a href="/lawyers"
           class="inline-flex items-center gap-2 text-[14px] font-medium text-text transition-colors hover:text-secondary">
            Browse {{ $area['name'] }} lawyers
            <span aria-hidden="true">â†’</span>
        </a>
    </div>
</article>

