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

    <title>Bảng điều khiển quản trị | LegalEase</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('admin_view/assets') }}/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"
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
                    src="https://res.cloudinary.com/dz8nix01e/image/upload/v1777303837/Logo_LegalEase_plttr6.jpg"
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
                <!-- Search -->
                <li class="nav-item navbar-search-wrapper me-1 me-xl-0">
                  <a class="nav-link search-toggler" href="javascript:void(0);">
                    <i class="ri-search-line ri-22px scaleX-n1-rtl me-2"></i>
                  </a>
                </li>
                <!-- /Search -->
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
                        <span class="align-middle"><i class="ri-sun-line ri-22px me-3"></i>Sáng</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="javascript:void(0);" data-theme="dark">
                        <span class="align-middle"><i class="ri-moon-clear-line ri-22px me-3"></i>Tối</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="javascript:void(0);" data-theme="system">
                        <span class="align-middle"><i class="ri-computer-line ri-22px me-3"></i>Hệ thống</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!-- / Style Switcher-->
<!-- Notification -->
 
                <!--/ Notification -->

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
                            <small class="text-muted">Quản trị viên</small>
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
                        <span class="align-middle">Hồ sơ của tôi</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="javascript:void(0);">
                        <i class="ri-settings-4-line ri-22px me-2"></i>
                        <span class="align-middle">Cài đặt</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="javascript:void(0);">
                        <span class="d-flex align-items-center align-middle">
                          <i class="flex-shrink-0 ri-file-text-line ri-22px me-2"></i>
                          <span class="flex-grow-1 align-middle">Thanh toán</span>
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
                        <span class="align-middle">Bảng giá</span>
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
                          <small class="align-middle">Đăng xuất</small>
                          <i class="ri-logout-box-r-line ms-2 ri-16px"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>

            <!-- Search Small Screens -->
            <div class="navbar-search-wrapper search-input-wrapper container-xxl d-none">
              <input
                type="text"
                class="form-control search-input border-0"
                placeholder="Search..."
                aria-label="Search..." />
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
                      <div>Bảng điều khiển</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link">
                      <i class="menu-icon tf-icons ri-scales-3-line"></i>
                      <div>Luật sư</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link">
                      <i class="menu-icon tf-icons ri-user-3-line"></i>
                      <div>Khách hàng</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link">
                      <i class="menu-icon tf-icons ri-calendar-check-line"></i>
                      <div>Lịch hẹn</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link">
                      <i class="menu-icon tf-icons ri-bank-card-line"></i>
                      <div>Thanh toán</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link">
                      <i class="menu-icon tf-icons ri-file-list-3-line"></i>
                      <div>Nội dung</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link">
                      <i class="menu-icon tf-icons ri-notification-3-line"></i>
                      <div>Thông báo</div>
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
                      <h5 class="card-title mb-1">Bảng điều khiển quản trị LegalEase</h5>
                      <p class="mb-0 text-muted">Tổng quan vận hành hệ thống từ dữ liệu thực tế.</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-xl-3">
                  <div class="card h-100"><div class="card-body"><span class="text-muted">Tổng luật sư</span><h3 class="mb-0">{{ number_format($stats['total_lawyers']) }}</h3></div></div>
                </div>
                <div class="col-md-6 col-xl-3">
                  <div class="card h-100"><div class="card-body"><span class="text-muted">Tổng khách hàng</span><h3 class="mb-0">{{ number_format($stats['total_customers']) }}</h3></div></div>
                </div>
                <div class="col-md-6 col-xl-3">
                  <div class="card h-100"><div class="card-body"><span class="text-muted">Tổng lịch hẹn</span><h3 class="mb-0">{{ number_format($stats['total_appointments']) }}</h3></div></div>
                </div>
                <div class="col-md-6 col-xl-3">
                  <div class="card h-100"><div class="card-body"><span class="text-muted">Doanh thu (VND)</span><h3 class="mb-0">{{ number_format($stats['revenue_vnd'], 0, '.', ',') }}</h3></div></div>
                </div>
                <div class="col-md-6 col-xl-3">
                  <div class="card h-100"><div class="card-body"><span class="text-muted">Lịch hẹn đang chờ</span><h4 class="mb-0">{{ number_format($stats['pending_appointments']) }}</h4></div></div>
                </div>
                <div class="col-md-6 col-xl-3">
                  <div class="card h-100"><div class="card-body"><span class="text-muted">Lịch hẹn hoàn tất</span><h4 class="mb-0">{{ number_format($stats['completed_appointments']) }}</h4></div></div>
                </div>
                <div class="col-md-6 col-xl-3">
                  <div class="card h-100"><div class="card-body"><span class="text-muted">Lịch hẹn đã hủy</span><h4 class="mb-0">{{ number_format($stats['cancelled_appointments']) }}</h4></div></div>
                </div>
                <div class="col-md-6 col-xl-3">
                  <div class="card h-100"><div class="card-body"><span class="text-muted">Thông báo chưa đọc</span><h4 class="mb-0">{{ number_format($stats['unread_notifications']) }}</h4></div></div>
                </div>
                <div class="col-12">
                  <div class="card">
                    <div class="card-body d-flex flex-column flex-md-row justify-content-between gap-3">
                      <div><h6 class="mb-1">Thanh toán thành công</h6><p class="mb-0 text-muted">Số giao dịch đã đối soát thành công.</p></div>
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
                    <a href="javascript:void(0)" class="footer-link">Đội ngũ LegalEase</a>
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








