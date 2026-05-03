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

    <title>Admin Dashboard | LegalEase</title>

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
    <style>
      .metric-card {
        position: relative;
        overflow: hidden;
      }

      .metric-card .metric-icon {
        position: absolute;
        top: 14px;
        right: 14px;
        width: 34px;
        height: 34px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
      }

      .metric-card .sparkline {
        margin-top: 8px;
      }

      .trend-up {
        color: #1f9d57;
      }

      .trend-down {
        color: #d14343;
      }

      .card-warn {
        background: linear-gradient(180deg, #fffaf0 0%, #fff 100%);
      }

      .card-danger {
        background: linear-gradient(180deg, #fff5f7 0%, #fff 100%);
      }

      .card-success {
        background: linear-gradient(180deg, #f2fff7 0%, #fff 100%);
      }

      #layout-menu.layout-menu-horizontal {
        box-shadow: 0 8px 18px rgba(67, 89, 113, 0.08);
        border-bottom: 1px solid rgba(67, 89, 113, 0.12);
      }

      #layout-menu .menu-inner {
        gap: 8px;
      }

      #layout-menu .menu-inner .menu-item .menu-link {
        border: 1px solid rgba(67, 89, 113, 0.14);
        border-radius: 999px;
        padding: 0.58rem 1rem;
        color: #4f5d70;
        transition: all 0.2s ease;
      }

      #layout-menu .menu-inner .menu-item .menu-link .menu-icon {
        color: #4f5d70;
      }

      #layout-menu .menu-inner .menu-item:not(.active) .menu-link:hover,
      #layout-menu .menu-inner .menu-item.preview-hover .menu-link {
        background: rgba(115, 103, 240, 0.09);
        border-color: rgba(115, 103, 240, 0.28);
        box-shadow: 0 6px 14px rgba(115, 103, 240, 0.14);
        color: #3d4959;
      }

      #layout-menu .menu-inner .menu-item:not(.active) .menu-link:hover .menu-icon,
      #layout-menu .menu-inner .menu-item.preview-hover .menu-link .menu-icon {
        color: #3d4959;
      }

      #layout-menu .menu-inner .menu-item.active .menu-link {
        border-color: transparent;
      }

      .crud-toolbar .form-control {
        min-width: 140px;
      }

      .crud-toolbar .form-control.form-control-sm {
        height: 34px;
        font-size: 0.86rem;
      }

      .crud-toolbar .btn.btn-sm {
        padding: 0.32rem 0.65rem;
        font-size: 0.84rem;
      }

      .crud-toolbar .btn-primary.btn-sm {
        padding: 0.38rem 0.8rem;
      }

      .crud-toolbar .btn-add-user {
        height: 34px;
        padding: 0.34rem 0.72rem !important;
        font-size: 0.84rem !important;
        align-self: flex-start;
      }
    </style>

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
                        <span class="align-middle"><i class="ri-sun-line ri-22px me-3"></i>Light</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="javascript:void(0);" data-theme="dark">
                        <span class="align-middle"><i class="ri-moon-clear-line ri-22px me-3"></i>Dark</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="javascript:void(0);" data-theme="system">
                        <span class="align-middle"><i class="ri-computer-line ri-22px me-3"></i>System</span>
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
                        <span class="align-middle">My Profile</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="javascript:void(0);">
                        <i class="ri-settings-4-line ri-22px me-2"></i>
                        <span class="align-middle">Settings</span>
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
                      <div>Dashboard</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link">
                      <i class="menu-icon tf-icons ri-scales-3-line"></i>
                      <div>Lawyers</div>
                    </a>
                  </li>
                  <li class="menu-item preview-hover">
                    <a href="javascript:void(0);" class="menu-link">
                      <i class="menu-icon tf-icons ri-user-3-line"></i>
                      <div>Customers</div>
                    </a>
                  </li>
                  <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link">
                      <i class="menu-icon tf-icons ri-calendar-check-line"></i>
                      <div>Appointments</div>
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
                      <div>Notifications</div>
                    </a>
                  </li>
                </ul>
              </div>
            </aside>
            <!-- / Menu -->
<!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              @if ($errors->any())
                <div class="alert alert-danger alert-dismissible mb-4" role="alert">
                  <strong>Vui lòng kiểm tra lại thông tin:</strong>
                  <ul class="mb-0 mt-2 ps-3">
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif
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
                  <div class="card metric-card h-100">
                    <div class="card-body">
                      <span class="text-muted">Tổng luật sư</span>
                      <h3 class="mb-1">{{ number_format($stats['total_lawyers']) }}</h3>
                      <p class="mb-0 small trend-up"><i class="ri-arrow-up-line"></i> +3.2% so với tháng trước</p>
                      <div class="metric-icon bg-label-primary text-primary"><i class="ri-scales-3-line"></i></div>
                    </div>
                  </div>
                </div>

                <div class="col-md-6 col-xl-3">
                  <div class="card metric-card h-100">
                    <div class="card-body">
                      <span class="text-muted">Tổng khách hàng</span>
                      <h3 class="mb-1">{{ number_format($stats['total_customers']) }}</h3>
                      <p class="mb-0 small trend-up"><i class="ri-arrow-up-line"></i> +8.4% so với tháng trước</p>
                      <div class="metric-icon bg-label-info text-info"><i class="ri-user-3-line"></i></div>
                    </div>
                  </div>
                </div>

                <div class="col-md-6 col-xl-3">
                  <div class="card metric-card h-100">
                    <div class="card-body">
                      <span class="text-muted">Tổng lịch hẹn</span>
                      <h3 class="mb-1">{{ number_format($stats['total_appointments']) }}</h3>
                      <p class="mb-0 small trend-up"><i class="ri-arrow-up-line"></i> +4.1% so với tháng trước</p>
                      <div class="metric-icon bg-label-secondary text-secondary"><i class="ri-calendar-check-line"></i></div>
                    </div>
                  </div>
                </div>

                <div class="col-md-6 col-xl-3">
                  <div class="card metric-card h-100 card-success">
                    <div class="card-body">
                      <span class="text-muted">Doanh thu (VND)</span>
                      <h3 class="mb-1">{{ number_format($stats['revenue_vnd'], 0, '.', ',') }}</h3>
                      <p class="mb-0 small trend-up"><i class="ri-arrow-up-line"></i> +5.0% so với tháng trước</p>
                      <svg class="sparkline" width="100%" height="34" viewBox="0 0 220 34" preserveAspectRatio="none">
                        <polyline fill="none" stroke="#28c76f" stroke-width="2.5"
                          points="0,27 30,24 60,25 90,20 120,16 150,12 180,9 220,6"></polyline>
                      </svg>
                      <div class="metric-icon bg-label-success text-success"><i class="ri-money-dollar-circle-line"></i></div>
                    </div>
                  </div>
                </div>

                <div class="col-md-6 col-xl-3">
                  <div class="card metric-card h-100 card-warn">
                    <div class="card-body">
                      <span class="text-muted">Lịch hẹn đang chờ</span>
                      <h4 class="mb-1">{{ number_format($stats['pending_appointments']) }}</h4>
                      <p class="mb-0 small text-warning"><i class="ri-error-warning-line"></i> Cần ưu tiên xác nhận</p>
                      <div class="metric-icon bg-label-warning text-warning"><i class="ri-time-line"></i></div>
                    </div>
                  </div>
                </div>

                <div class="col-md-6 col-xl-3">
                  <div class="card metric-card h-100 card-success">
                    <div class="card-body">
                      <span class="text-muted">Lịch hẹn hoàn tất</span>
                      <h4 class="mb-1">{{ number_format($stats['completed_appointments']) }}</h4>
                      <p class="mb-0 small trend-up"><i class="ri-checkbox-circle-line"></i> Tăng ổn định theo tuần</p>
                      <div class="metric-icon bg-label-success text-success"><i class="ri-check-double-line"></i></div>
                    </div>
                  </div>
                </div>

                <div class="col-md-6 col-xl-3">
                  <div class="card metric-card h-100 card-danger">
                    <div class="card-body">
                      <span class="text-muted">Lịch hẹn đã hủy</span>
                      <h4 class="mb-1">{{ number_format($stats['cancelled_appointments']) }}</h4>
                      <p class="mb-0 small trend-down"><i class="ri-arrow-down-line"></i> +1.1% so với tháng trước</p>
                      <div class="metric-icon bg-label-danger text-danger"><i class="ri-close-circle-line"></i></div>
                    </div>
                  </div>
                </div>

                <div class="col-md-6 col-xl-3">
                  <div class="card metric-card h-100">
                    <div class="card-body">
                      <span class="text-muted">Thông báo chưa đọc</span>
                      <h4 class="mb-1">{{ number_format($stats['unread_notifications']) }}</h4>
                      <p class="mb-0 small text-info"><i class="ri-notification-3-line"></i> Cần xử lý trong ngày</p>
                      <div class="metric-icon bg-label-info text-info"><i class="ri-notification-3-line"></i></div>
                    </div>
                  </div>
                </div>

                <div class="col-12">
                  <div class="card">
                    <div class="card-body d-flex flex-column flex-md-row justify-content-between gap-3">
                      <div>
                        <h6 class="mb-1">Thanh toán thành công</h6>
                        <p class="mb-0 text-muted">Số giao dịch đã đối soát thành công.</p>
                      </div>
                      <div class="text-md-end">
                        <h3 class="mb-0">{{ number_format($stats['paid_payments']) }}</h3>
                        <p class="mb-0 small trend-up"><i class="ri-arrow-up-line"></i> +6.7% so với tháng trước</p>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-xl-8 col-12">
                  <div class="card h-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <div>
                        <h5 class="mb-0">Lịch hẹn sắp tới</h5>
                        <small class="text-muted">Theo dõi nhanh các lịch hẹn gần nhất</small>
                      </div>
                    </div>
                    <div class="card-body pt-2">
                      <div class="table-responsive">
                        <table class="table table-sm align-middle">
                          <thead>
                            <tr>
                              <th>Mã lịch</th>
                              <th>Khách hàng</th>
                              <th>Luật sư</th>
                              <th>Thời gian</th>
                              <th>Trạng thái</th>
                            </tr>
                          </thead>
                          <tbody>
                            @forelse ($recentAppointments as $item)
                              <tr>
                                <td>{{ $item['code'] }}</td>
                                <td>{{ $item['customer'] }}</td>
                                <td>{{ $item['lawyer'] }}</td>
                                <td>{{ $item['time'] }}</td>
                                <td>
                                  @if ($item['status'] === 'Hoàn tất')
                                    <span class="badge bg-label-success">{{ $item['status'] }}</span>
                                  @elseif ($item['status'] === 'Đã hủy')
                                    <span class="badge bg-label-danger">{{ $item['status'] }}</span>
                                  @else
                                    <span class="badge bg-label-warning">{{ $item['status'] }}</span>
                                  @endif
                                </td>
                              </tr>
                            @empty
                              <tr>
                                <td colspan="5" class="text-center text-muted">Chưa có dữ liệu lịch hẹn.</td>
                              </tr>
                            @endforelse
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-xl-4 col-12">
                  <div class="card h-100">
                    <div class="card-header">
                      <h5 class="mb-0">Doanh thu theo tháng</h5>
                      <small class="text-muted">Đơn vị: triệu VND</small>
                    </div>
                    <div class="card-body">
                      <div id="monthlyRevenueChart" style="min-height: 280px;"></div>
                    </div>
                  </div>
                </div>

                <div class="col-12 order-first" id="users-management">
                  <div class="card">
                    <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-3">
                      <div>
                        <h5 class="mb-0">Quản lý người dùng</h5>
                        <small class="text-muted">Danh sách người dùng có lọc theo ID, tên và phân trang</small>
                      </div>
                      <div class="crud-toolbar d-flex flex-wrap gap-2">
                        <form id="usersFilterForm" method="GET" action="{{ route('admin.view.test') }}#users-management" class="d-flex flex-wrap gap-2">
                          <input type="number" name="id" value="{{ $filters['id'] ?? '' }}" class="form-control form-control-sm" placeholder="Lọc theo ID">
                          <input type="text" name="name" value="{{ $filters['name'] ?? '' }}" class="form-control form-control-sm" placeholder="Lọc theo tên">
                          <button type="submit" class="btn btn-sm btn-outline-primary">Lọc</button>
                          <a href="{{ route('admin.view.test') }}#users-management" class="btn btn-sm btn-outline-secondary">Reset</a>
                        </form>
                        <button type="button" class="btn btn-sm btn-primary btn-add-user" data-bs-toggle="modal" data-bs-target="#createUserModal">
                          <i class="ri-add-line me-1"></i> Thêm mới
                        </button>
                      </div>
                    </div>
                    <div class="card-body" id="usersManagementBody">
                      <div class="table-responsive">
                        <table class="table table-sm align-middle">
                          <thead>
                            <tr>
                              <th>ID</th>
                              <th>Tên</th>
                              <th>Email</th>
                              <th>Ngày tạo</th>
                              <th class="text-end">Thao tác</th>
                            </tr>
                          </thead>
                          <tbody>
                            @forelse ($users as $u)
                              <tr>
                                <td>{{ $u->id }}</td>
                                <td>{{ $u->name }}</td>
                                <td>{{ $u->email }}</td>
                                <td>{{ optional($u->created_at)->format('d/m/Y H:i') }}</td>
                                <td class="text-end">
                                  <button
                                    type="button"
                                    class="btn btn-sm btn-outline-primary edit-user-btn"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editUserModal"
                                    data-id="{{ $u->id }}"
                                    data-name="{{ $u->name }}"
                                    data-email="{{ $u->email }}">
                                    Sửa
                                  </button>
                                  <form method="POST" action="{{ route('admin.users.destroy', $u) }}" class="d-inline" onsubmit="return confirm('Bạn có chắc muốn xóa người dùng này?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Xóa</button>
                                  </form>
                                </td>
                              </tr>
                            @empty
                              <tr>
                                <td colspan="5" class="text-center text-muted">Không có dữ liệu người dùng.</td>
                              </tr>
                            @endforelse
                          </tbody>
                        </table>
                      </div>
                      <div class="mt-3">
                        {{ $users->fragment('users-management')->links() }}
                      </div>
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
    <script src="{{ asset('admin_view/assets') }}/vendor/libs/apex-charts/apexcharts.js"></script>
    <script>
      (function () {
        var el = document.querySelector('#monthlyRevenueChart');
        if (!el || typeof ApexCharts === 'undefined') return;

        var options = {
          chart: {
            type: 'line',
            height: 280,
            toolbar: { show: false },
          },
          series: [{
            name: 'Doanh thu',
            data: @json($monthlyRevenue ?? []),
          }],
          stroke: {
            curve: 'smooth',
            width: 3,
          },
          colors: ['#28c76f'],
          xaxis: {
            categories: @json($monthlyLabels ?? []),
          },
          grid: {
            borderColor: '#eceff3',
            strokeDashArray: 4,
          },
          dataLabels: { enabled: false },
          markers: { size: 4 },
        };

        new ApexCharts(el, options).render();
      })();

      @if (session('success') || session('error'))
      window.addEventListener('load', function () {
        var toastEl = document.getElementById('crudToast');
        if (!toastEl || typeof bootstrap === 'undefined') return;
        var toast = new bootstrap.Toast(toastEl, { delay: 3000 });
        toast.show();
      });
      @endif

      (function () {
        var container = document.getElementById('users-management');
        var body = document.getElementById('usersManagementBody');
        var filterForm = document.getElementById('usersFilterForm');
        if (!container || !body || !filterForm) return;

        function bindEditButtons(root) {
          root.querySelectorAll('.edit-user-btn').forEach(function (btn) {
            btn.addEventListener('click', function () {
              var id = btn.getAttribute('data-id');
              var name = btn.getAttribute('data-name');
              var email = btn.getAttribute('data-email');
              var form = document.getElementById('editUserForm');
              form.action = '{{ url('/admin-view-test/users') }}/' + id;
              document.getElementById('edit_user_name').value = name;
              document.getElementById('edit_user_email').value = email;
              document.getElementById('edit_user_password').value = '';
              document.getElementById('edit_user_password_confirmation').value = '';
            });
          });
        }

        function bindPaginationAjax() {
          container.querySelectorAll('.pagination a').forEach(function (link) {
            link.addEventListener('click', function (e) {
              e.preventDefault();
              loadUsers(link.href);
            });
          });
        }

        function bindResetAjax() {
          var resetLink = filterForm.querySelector('a.btn-outline-secondary');
          if (!resetLink) return;
          resetLink.addEventListener('click', function (e) {
            e.preventDefault();
            filterForm.reset();
            loadUsers(resetLink.href);
          });
        }

        function loadUsers(url) {
          fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
            .then(function (res) { return res.text(); })
            .then(function (html) {
              var parser = new DOMParser();
              var doc = parser.parseFromString(html, 'text/html');
              var newBody = doc.getElementById('usersManagementBody');
              var newForm = doc.getElementById('usersFilterForm');
              if (!newBody || !newForm) return;
              body.innerHTML = newBody.innerHTML;
              filterForm.innerHTML = newForm.innerHTML;
              bindPaginationAjax();
              bindResetAjax();
              bindEditButtons(container);
            });
        }

        filterForm.addEventListener('submit', function (e) {
          e.preventDefault();
          var formData = new FormData(filterForm);
          var params = new URLSearchParams(formData);
          loadUsers('{{ route('admin.view.test') }}?' + params.toString() + '#users-management');
        });

        bindPaginationAjax();
        bindResetAjax();
        bindEditButtons(container);
      })();

      @if ($errors->any())
      window.addEventListener('load', function () {
        if (typeof bootstrap === 'undefined') return;
        var createModalEl = document.getElementById('createUserModal');
        if (!createModalEl) return;
        var modal = new bootstrap.Modal(createModalEl);
        modal.show();
      });
      @endif
    </script>

    <div class="modal fade" id="createUserModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
        <form method="POST" action="{{ route('admin.users.store') }}" class="modal-content">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title">Thêm người dùng mới</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Tên</label>
              <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Mật khẩu</label>
              <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Xác nhận mật khẩu</label>
              <input type="password" name="password_confirmation" class="form-control" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Hủy</button>
            <button type="submit" class="btn btn-primary">Lưu</button>
          </div>
        </form>
      </div>
    </div>

    <div class="modal fade" id="editUserModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
        <form method="POST" id="editUserForm" action="#" class="modal-content">
          @csrf
          @method('PUT')
          <div class="modal-header">
            <h5 class="modal-title">Cập nhật người dùng</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Tên</label>
              <input type="text" id="edit_user_name" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" id="edit_user_email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Mật khẩu mới (không bắt buộc)</label>
              <input type="password" id="edit_user_password" name="password" class="form-control">
            </div>
            <div class="mb-3">
              <label class="form-label">Xác nhận mật khẩu mới</label>
              <input type="password" id="edit_user_password_confirmation" name="password_confirmation" class="form-control">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Hủy</button>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
          </div>
        </form>
      </div>
    </div>

    @if (session('success') || session('error'))
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1080;">
      <div id="crudToast" class="toast align-items-center text-bg-{{ session('error') ? 'danger' : 'success' }} border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
          <div class="toast-body">
            {{ session('success') ?? session('error') }}
          </div>
          <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
      </div>
    </div>
    @endif
  </body>
</html>
