@extends('layouts.app', ['title' => 'Hồ sơ luật sư · LegalEase'])

@php
    $user = auth()->user();

    // Demo prototype: use the first verified lawyer as the authed lawyer's listing.
    $lawyer = \App\Data\Lawyers::all()[0];

    $fullName = trim($user->name ?? $lawyer['name']);
    $tokens = array_values(array_filter(preg_split('/\s+/', $fullName)));
    $familyName = $tokens[0] ?? '';
    $givenName = count($tokens) > 1 ? implode(' ', array_slice($tokens, 1)) : '';

    $initials = mb_strtoupper(
        mb_substr($tokens[0] ?? '?', 0, 1) . mb_substr($tokens[count($tokens) - 1] ?? '', 0, 1)
    );

    $allSpecialties = [
        'Bào chữa hình sự',
        'Bất động sản',
        'Luật Doanh nghiệp',
        'Luật Hôn nhân & Gia đình',
        'Luật Lao động',
        'Tố tụng dân sự',
    ];

    $allLanguages = ['Tiếng Việt', 'Tiếng Anh'];

    $provinces = ['Hà Nội', 'TP.HCM', 'Đà Nẵng', 'Hải Phòng', 'Cần Thơ', 'Bình Dương', 'Đồng Nai'];

    $tagsForJs = $lawyer['specialty_tags'] ?? [];

    // ── Derived display values ─────────────────────────────────────────────
    $employeeId  = str_pad($lawyer['id'] ?? 1, 6, '0', STR_PAD_LEFT);
    $portraitUrl = $lawyer['portrait_url'] ?? '';

    $metaRows = [
        ['label' => 'Ngày sinh',        'key' => 'date_of_birth',  'val' => ($lawyer['date_of_birth'] ?? '24/12/1987').' ('.($lawyer['age'] ?? '32').' tuổi)', 'bold' => false],
        ['label' => 'Giới tính',        'key' => 'gender',         'val' => $lawyer['gender']        ?? 'Nữ',                   'bold' => false],
        ['label' => 'Nơi sinh',         'key' => 'birthplace',     'val' => $lawyer['birthplace']    ?? 'Tokyo',                'bold' => false],
        ['label' => 'Phòng ban',        'key' => 'department',     'val' => $lawyer['department']    ?? 'Phòng Kinh doanh',     'bold' => true ],
        ['label' => 'Chức vụ',          'key' => 'position',       'val' => $lawyer['position']      ?? 'Trưởng nhóm',          'bold' => true ],
        ['label' => 'Ngày vào công ty', 'key' => 'joined_at',      'val' => $lawyer['joined_at']     ?? '01/04/2009',           'bold' => false],
        ['label' => 'Loại nhân sự',     'key' => 'employee_type',  'val' => $lawyer['employee_type'] ?? 'Nhân viên chính thức', 'bold' => false],
    ];

    $stressRows = $lawyer['stress_checks'] ?? [
        ['date'=>'06/2021','grade'=>'A','mood'=>'good',   'l1'=>'Bạn dường như hiện không gặp nhiều vấn đề về mức độ căng thẳng.','l2'=>'Hãy tiếp tục duy trì như hiện tại.'],
        ['date'=>'06/2019','grade'=>'B','mood'=>'neutral','l1'=>'Có dấu hiệu căng thẳng ở mức trung bình.','l2'=>'Cần chú ý theo dõi tình trạng sức khỏe.'],
        ['date'=>'06/2018','grade'=>'C','mood'=>'bad',    'l1'=>'Có xu hướng mức độ căng thẳng cao.','l2'=>'Khuyến nghị kiểm tra và tư vấn chuyên môn.'],
    ];

    $healthRows = $lawyer['health_checks'] ?? [
        ['date'=>'12/05/2020','cat'=>'Khám sức khỏe định kỳ',   'content'=>'Khám nội khoa, đo chiều cao, cân nặng, đo thị lực, xét nghiệm máu,…','result'=>'Đang xử lý','status'=>'pending'],
        ['date'=>'18/05/2019','cat'=>'Khám sức khỏe định kỳ',   'content'=>'Khám nội khoa, đo chiều cao, cân nặng, đo thị lực, xét nghiệm máu,…','result'=>'Đang xử lý','status'=>'pending'],
        ['date'=>'10/05/2019','cat'=>'Khám sức khỏe định kỳ',   'content'=>'Khám nội khoa, đo chiều cao, cân nặng, đo thị lực, xét nghiệm máu,…','result'=>'Đang xử lý','status'=>'ok'],
        ['date'=>'14/05/2015','cat'=>'Khám sức khỏe tuyển dụng','content'=>'Khám nội khoa, đo chiều cao, cân nặng, đo thị lực, xét nghiệm máu,…','result'=>'Đang xử lý','status'=>'pending'],
    ];

    $selYear = request('year','2020');
    $attendRows = $lawyer['attendance'][$selYear] ?? [
        ['month'=>'05/2020','req'=>'136.00','act'=>'192.50','wpct'=>'54.7%','lpct'=>'62.2%','st'=>'warn','left'=>'0.5'],
    ];

 $emoji = fn($m) => match($m){
    'good' => '<img src="https://images.icon-icons.com/4053/PNG/512/verify_icon_257924.png" style="width:18px;height:18px;vertical-align:middle;">',
    'neutral' => '<img src="https://images.icon-icons.com/4053/PNG/512/verify_icon_257924.png" style="width:18px;height:18px;vertical-align:middle;">',
    default => '<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR8dafeVxXMNrMUhTxim-vRP19YpDsaDNDOMQ&s" style="width:18px;height:18px;vertical-align:middle;">'
};
@endphp

@section('content')

    {{-- ── Tailwind 4 CDN + Alpine ──────────────────────────────────────────── --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    /* Navy sidebar palette */
                    colors: {
                        navy: {
                            900: '#0f1c3f',
                            800: '#162248',
                            700: '#1e3163',
                            600: '#1a3a8f',
                            active: 'rgba(255,255,255,0.92)',
                        },
                        ink:  { DEFAULT:'#1a2332', muted:'#52616b', light:'#8897a4' },
                        page: { bg:'#f0f2f5', border:'#e2e6ea', lt:'#edf0f3' },
                    },
                    /* Use system sans (Tailwind font-sans) */
                    fontFamily: {
                        sans: ['ui-sans-serif','system-ui','-apple-system','BlinkMacSystemFont',
                            '"Segoe UI"','Roboto','"Helvetica Neue"','Arial','"Noto Sans"','sans-serif'],
                    },
                },
            },
        }
    </script>

    <style>
        /* Sidebar navy gradient */
        .sb-bg { background: linear-gradient(180deg,#0f1c3f 0%,#162248 60%,#1a3a8f 100%); }

        /* Nav links */
        .nav-lnk {
            display:flex; align-items:center; gap:10px;
            padding:10px 12px; border-radius:6px;
            color:rgba(255,255,255,.72); font-size:13.5px;
            text-decoration:none; margin-bottom:2px;
            transition:background .15s,color .15s;
        }
        .nav-lnk:hover  { background:rgba(255,255,255,.10); color:#fff; }
        .nav-lnk.active { background:rgba(255,255,255,.92); color:#1a3a8f; font-weight:600; }

        /* Inline form field */
        .f-input {
            display:block; width:100%;
            border:1px solid #e2e6ea; border-radius:8px;
            background:#f5f7fa; padding:8px 12px;
            font-size:13px; color:#1a2332; font-family:inherit; outline:none;
            transition:border-color .15s,box-shadow .15s;
        }
        .f-input:focus { border-color:#1a3a8f; box-shadow:0 0 0 3px rgba(26,58,143,.10); }
        .f-input::placeholder { color:#8897a4; }
        textarea.f-input { resize:vertical; }

        /* Select arrow */
        .sel-w { position:relative; }
        .sel-w select { appearance:none; padding-right:30px; cursor:pointer; }
        .sel-w::after {
            content:''; position:absolute; right:10px; top:50%;
            transform:translateY(-50%);
            border:4px solid transparent; border-top:6px solid #52616b;
            pointer-events:none;
        }

        /* Buttons */
        .btn-save {
            display:inline-flex; align-items:center; gap:6px;
            background:#1a3a8f; color:#fff;
            font-size:13.5px; font-weight:600;
            padding:10px 22px; border-radius:8px; border:none; cursor:pointer;
            transition:background .15s;
        }
        .btn-save:hover { background:#162248; }

        .btn-outline {
            display:inline-flex; align-items:center; gap:6px;
            background:#fff; color:#52616b;
            font-size:13px; font-weight:500;
            padding:6px 14px; border-radius:6px;
            border:1px solid #e2e6ea; cursor:pointer;
            transition:border-color .15s,color .15s;
        }
        .btn-outline:hover { border-color:#1a3a8f; color:#1a3a8f; }

        .btn-sq {
            display:flex; align-items:center; justify-content:center;
            width:32px; height:32px; border-radius:6px;
            border:1px solid #e2e6ea; background:#fff;
            color:#52616b; cursor:pointer; text-decoration:none;
            transition:border-color .15s,color .15s;
        }
        .btn-sq:hover { border-color:#1a3a8f; color:#1a3a8f; }

        /* Table rows */
        .trow:hover { background:#f8f9fb; }

        /* Badges */
        .badge { display:inline-flex;align-items:center;gap:4px;font-size:11.5px;font-weight:500;padding:3px 10px;border-radius:9999px;white-space:nowrap; }
        .b-err  { background:#fee2e2;color:#dc2626; }
        .b-ok   { background:#dcfce7;color:#16a34a; }
        .b-warn { background:#fef3c7;color:#d97706; }

        /* Grade */
        .gA, .gB, .gC {
            color:#14b8a6;
            font-size:17px;
            font-weight:700;
        }

        /* Panel icon box */
        .p-icon { display:flex;align-items:center;justify-content:center;width:32px;height:32px;border-radius:8px;background:#eff3fc;color:#1a3a8f;flex-shrink:0; }

        [x-cloak]{display:none!important;}
    </style>

    {{-- ═══════════════════════════════════════════════════════════════════════
         OUTER WRAPPER
         → Put your <header> before and <footer> after this block in layouts.app
    ═══════════════════════════════════════════════════════════════════════ --}}
    <div class="flex min-h-screen font-sans" style="background:#f0f2f5;color:var(--color-accent);font-size:14px;line-height:1.5;">

        {{-- ══════════════ SIDEBAR ══════════════ --}}
        <aside class="sb-bg flex min-h-screen w-[220px] flex-col">

            {{-- Logo --}}
            <div class="flex items-center gap-3 px-5 pb-5 pt-6">
                {{-- Scales-of-justice SVG icon --}}
                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-white/20">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none"
                         stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 3v18M3 9l9-6 9 6M5 11l-2 6h4L5 11zM19 11l-2 6h4l-2-6zM4 20h16"/>
                    </svg>
                </div>
                <div>
                    <p class="text-[15px] font-bold leading-tight text-white">LegalEase</p>
                    <p class="text-[10px] text-white/50 tracking-widest uppercase">Luật sư</p>
                </div>
            </div>

            {{-- Divider --}}
            <div class="mx-4 mb-2 border-t border-white/10"></div>

            {{-- Nav --}}
            <nav class="flex-1 overflow-y-auto px-3 py-1">

                {{-- Trang chủ --}}
                <a href="#" class="nav-lnk">
                    {{-- House icon (real SVG) --}}
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0">
                        <path d="M3 9.5L12 3l9 6.5V20a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V9.5z"/>
                        <path d="M9 21V12h6v9"/>
                    </svg>
                    <span>Trang chủ</span>
                </a>

                {{-- Nhân viên (active) --}}
                <a href="#" class="nav-lnk active">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                        <circle cx="12" cy="7" r="4"/>
                    </svg>
                    <span>Nhân viên</span>
                </a>

                {{-- Kiểm tra căng thẳng --}}
                <a href="#" class="nav-lnk">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0">
                        <path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2"/>
                        <rect x="9" y="3" width="6" height="4" rx="1"/>
                        <path d="m9 12 2 2 4-4"/>
                    </svg>
                    <span>Kiểm tra căng thẳng</span>
                </a>

                {{-- Chẩn đoán sức khỏe --}}
                <a href="#" class="nav-lnk">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0">
                        <path d="M22 12h-4l-3 9L9 3l-3 9H2"/>
                    </svg>
                    <span>Chẩn đoán sức khỏe</span>
                </a>

                {{-- Chấm công --}}
                <a href="#" class="nav-lnk">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                        <line x1="16" y1="2" x2="16" y2="6"/>
                        <line x1="8" y1="2" x2="8" y2="6"/>
                        <line x1="3" y1="10" x2="21" y2="10"/>
                    </svg>
                    <span>Chấm công / Quản lý đi làm</span>
                </a>

                {{-- Kết quả khám sức khỏe --}}
                <a href="#" class="nav-lnk">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                    </svg>
                    <span>Kết quả khám sức khỏe</span>
                </a>

                {{-- Cài đặt --}}
                <a href="#" class="nav-lnk">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0">
                        <circle cx="12" cy="12" r="3"/>
                        <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/>
                    </svg>
                    <span>Cài đặt</span>
                </a>
            </nav>

            {{-- Company label --}}
            <div class="px-5 py-2 text-[11px] uppercase tracking-widest text-white/40">Thông tin công ty</div>

            {{-- Bottom user strip --}}
            <div class="border-t border-white/10 px-4 py-3.5">
                <div class="flex items-center gap-2.5">
                    @if($portraitUrl)
                        <img src="{{ $portraitUrl }}" alt="{{ $initials }}"
                             class="h-[34px] w-[34px] shrink-0 rounded-full border-2 border-white/30 object-cover object-top">
                    @else
                        <div class="flex h-[34px] w-[34px] shrink-0 items-center justify-center rounded-full
                                bg-white/20 text-[13px] font-bold text-white">{{ $initials }}</div>
                    @endif
                    <div class="leading-tight">
                        <p class="text-[11px] text-white/50">Bộ phận:</p>
                        <p class="text-[13px] font-semibold text-white">Nhân sự</p>
                    </div>
                </div>
            </div>
        </aside>

        {{-- ══════════════ MAIN ══════════════ --}}
        <div class="flex flex-1 flex-col">

            {{-- ── Top bar ── --}}
            <div class="flex h-14 items-center justify-between
                    border-b border-page-border bg-white px-7 shadow-sm">
                <h1 class="text-xl font-bold tracking-tight text-ink">Chi tiết nhân viên</h1>

                <div class="flex items-center gap-2.5">
                    <button class="btn-outline">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/>
                            <line x1="8" y1="18" x2="21" y2="18"/>
                            <line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/>
                            <line x1="3" y1="18" x2="3.01" y2="18"/>
                        </svg>
                        Danh sách
                    </button>
                    <button class="btn-sq">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="15 18 9 12 15 6"/>
                        </svg>
                    </button>
                    <button class="btn-sq">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="9 18 15 12 9 6"/>
                        </svg>
                    </button>
                </div>
            </div>

            {{-- ══════════════ CONTENT GRID ══════════════ --}}
            <div class="grid grid-cols-[280px_1fr] items-start gap-5 p-6">

                {{-- ────────────────────────────────────────
                     LEFT CARD — Profile + inline edit
                ──────────────────────────────────────── --}}
                <div class="overflow-hidden rounded-xl border border-page-border bg-white shadow-sm"
                     x-data="{
                     editing: false,
                     saved: false,
                     photoUrl: '{{ addslashes($portraitUrl) }}',
                     photoErr: '',
                     pickPhoto(e) {
                         const f = e.target.files[0];
                         if (!f) return;
                         if (f.size > 4 * 1024 * 1024) {
                             this.photoErr = 'Ảnh quá lớn. Tối đa 4 MB.';
                             e.target.value = '';
                             return;
                         }
                         this.photoErr = '';
                         this.photoUrl = URL.createObjectURL(f);
                     },
                     submitForm() {
                         /* Pure front-end demo: just show saved toast */
                         this.saved = true;
                         this.editing = false;
                         setTimeout(() => this.saved = false, 3500);
                     }
                 }">

                    {{-- Photo area --}}
                    <div class="relative h-[220px] overflow-hidden"
                         style="background:linear-gradient(135deg,#c8d9f4 0%,#a0b8e8 100%);">
                        <template x-if="photoUrl">
                            <img :src="photoUrl" alt="Portrait"
                                 class="absolute inset-0 h-full w-full object-cover object-top">
                        </template>
                        <template x-if="!photoUrl">
                            <div class="flex h-full w-full items-center justify-center
                                    text-[54px] font-bold text-[#4a72b0]">{{ $initials }}</div>
                        </template>

                        {{-- Alert dot --}}
                        <div class="absolute right-2.5 top-2.5 flex h-[26px] w-[26px] items-center
                                justify-center rounded-full bg-red-600 text-[12px] font-bold
                                text-white shadow">!</div>

                        {{-- Photo edit button --}}
                        <label class="absolute bottom-2.5 right-2.5 flex h-[30px] w-[30px] cursor-pointer
                                  items-center justify-center rounded-full border border-white/60
                                  bg-white text-ink-muted shadow transition
                                  hover:bg-navy-600 hover:text-white hover:border-navy-600">
                            <input type="file" accept="image/jpeg,image/png" class="sr-only"
                                   @change="pickPhoto($event)">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                            </svg>
                        </label>
                        <p x-show="photoErr" x-cloak x-text="photoErr"
                           class="absolute bottom-12 right-2 rounded bg-white px-2 py-0.5
                              text-[11px] text-red-600 shadow"></p>
                    </div>

                    {{-- Info section --}}
                    <div class="px-[18px] py-4">

                        {{-- Saved toast --}}
                        <div x-show="saved" x-cloak
                             class="mb-3 flex items-center gap-1.5 rounded-lg bg-green-50
                                px-3 py-2 text-[12.5px] font-medium text-green-700">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 6 9 17 4 12"/>
                            </svg>
                            Đã lưu thành công.
                        </div>

                        {{-- ID + edit toggle --}}
                        <div class="mb-1 flex items-start justify-between">
                            <div>
                                <p class="text-[11px] text-ink-light">Mã nhân viên</p>
                                <p class="text-[18px] font-bold text-ink">{{ $employeeId }}</p>
                            </div>
                            <button type="button" @click="editing = !editing"
                                    class="text-[12.5px] font-semibold text-navy-600
                                       transition hover:text-navy-900">
                                <span x-text="editing ? 'Hủy' : 'Chỉnh sửa'">Chỉnh sửa</span>
                            </button>
                        </div>

                        {{-- Full name --}}
                        <p class="mb-0.5 text-[11px] text-ink-light">Họ và tên</p>
                        <div x-show="!editing">
                            <p class="mb-4 text-[13px] text-ink-muted">
                                {{ $fullName ?: '(Chữ nhỏ, khó đọc rõ)' }}
                            </p>
                        </div>
                        <div x-show="editing" x-cloak class="mb-4 grid grid-cols-2 gap-2">
                            <input type="text" name="first_name"
                                   value="{{ old('first_name', $givenName) }}"
                                   placeholder="Tên" class="f-input">
                            <input type="text" name="last_name"
                                   value="{{ old('last_name', $familyName) }}"
                                   placeholder="Họ" class="f-input">
                        </div>

                        {{-- Meta rows --}}
                        <div class="flex flex-col gap-[7px]">
                            @foreach($metaRows as $r)
                                <div class="grid grid-cols-[90px_1fr] gap-1 text-[13px]">
                                    <span class="text-ink-light">{{ $r['label'] }}</span>
                                    {{-- View mode --}}
                                    <span x-show="!editing"
                                          class="{{ $r['bold'] ? 'font-semibold' : '' }} text-ink">
                                {{ $r['val'] }}
                            </span>
                                    {{-- Edit mode --}}
                                    <input x-show="editing" x-cloak
                                           type="text" name="{{ $r['key'] }}"
                                           value="{{ old($r['key'], $r['val']) }}"
                                           class="f-input py-1 px-2 text-[12.5px]">
                                </div>
                            @endforeach
                        </div>

                        {{-- Save button (edit mode only) --}}
                        <div x-show="editing" x-cloak class="mt-4">
                            <button type="button" @click="submitForm()" class="btn-save w-full justify-center">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                     stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                                    <polyline points="17 21 17 13 7 13 7 21"/>
                                    <polyline points="7 3 7 8 15 8"/>
                                </svg>
                                Lưu thay đổi
                            </button>
                        </div>
                    </div>
                </div>
                {{-- end left card --}}

                {{-- ────────────────────────────────────────
                     RIGHT — 3 panels
                ──────────────────────────────────────── --}}
                <div class="flex flex-col gap-[18px]">

                    {{-- ══ PANEL 1 — Kiểm tra mức độ căng thẳng ══ --}}
                    <div class="overflow-hidden rounded-xl border border-page-border bg-white shadow-sm">
                        <div class="flex items-center gap-2.5 border-b border-page-lt px-5 py-3">
                            <div class="p-icon">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2"/>
                                    <rect x="9" y="3" width="6" height="4" rx="1"/>
                                    <path d="m9 12 2 2 4-4"/>
                                </svg>
                            </div>
                            <span class="text-[15px] font-semibold text-ink">Kiểm tra mức độ căng thẳng</span>
                        </div>

                        <table class="w-full border-collapse">
                            <thead>
                            <tr class="border-b border-page-border bg-page-bg
                                       text-[12px] font-medium text-ink-light">
                                <th class="px-5 py-2 text-left" style="width:110px">Ngày thực hiện</th>
                                <th class="px-5 py-2 text-left" style="width:130px">Mức độ căng thẳng</th>
                                <th class="px-5 py-2 text-left">Nội dung đánh giá</th>
                                <th style="width:28px"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($stressRows as $row)
                                <tr class="trow border-b border-page-lt last:border-b-0 transition-colors">
                                    <td class="px-5 py-3 text-[13px] text-ink">{{ $row['date'] }}</td>
                                    <td class="px-5 py-3">
                                        <span class="g{{ $row['grade'] }}">{{ $row['grade'] }}</span>
                                    </td>
                                    <td class="px-5 py-3">
                                        <div class="flex items-start gap-2.5">
                                            <span class="mt-0.5 text-lg leading-none">{!! $emoji($row['mood']) !!}</span>
                                            <div class="text-[13px] leading-snug">
                                                <span class="block text-ink">{{ $row['l1'] }}</span>
                                                <span class="block text-ink-muted">{{ $row['l2'] }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="pr-4 text-right text-ink-light">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                             stroke="currentColor" stroke-width="2"
                                             stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="9 18 15 12 9 6"/>
                                        </svg>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- ══ PANEL 2 — Chẩn đoán sức khỏe ══ --}}
                    <div class="overflow-hidden rounded-xl border border-page-border bg-white shadow-sm">
                        <div class="flex items-center gap-2.5 border-b border-page-lt px-5 py-3">
                            <div class="p-icon">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 12h-4l-3 9L9 3l-3 9H2"/>
                                </svg>
                            </div>
                            <span class="text-[15px] font-semibold text-ink">Chẩn đoán sức khỏe</span>
                        </div>

                        <table class="w-full border-collapse">
                            <thead>
                            <tr class="border-b border-page-border bg-page-bg
                                       text-[12px] font-medium text-ink-light">
                                <th class="px-5 py-2 text-left" style="width:110px">Ngày thực hiện</th>
                                <th class="px-4 py-2 text-left" style="width:150px">Khóa / hạng mục kiểm tra</th>
                                <th class="px-4 py-2 text-left">Nội dung kiểm tra</th>
                                <th class="px-4 py-2 text-left" style="width:100px">Kết quả chẩn đoán</th>
                                <th class="px-4 py-2 text-left" style="width:150px">Tình trạng xử lý</th>
                                <th style="width:28px"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($healthRows as $row)
                                <tr class="trow border-b border-page-lt last:border-b-0 transition-colors">
                                    <td class="px-5 py-3 text-[13px] text-ink">{{ $row['date'] }}</td>
                                    <td class="px-4 py-3 text-[12.5px] text-ink-muted">{{ $row['cat'] }}</td>
                                    <td class="px-4 py-3 text-[12.5px] leading-snug text-ink-muted">{{ $row['content'] }}</td>
                                    <td class="px-4 py-3 text-[12.5px] text-ink-muted">{{ $row['result'] }}</td>
                                    <td class="px-4 py-3">
                                        @if($row['status']==='ok')
                                            <span class="badge b-ok">
                                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none"
                                                 stroke="currentColor" stroke-width="2.5"
                                                 stroke-linecap="round" stroke-linejoin="round">
                                                <polyline points="20 6 9 17 4 12"/>
                                            </svg>
                                            Không có bất thường
                                        </span>
                                        @else
                                            <span class="badge b-err">
                                            <svg width="11" height="11" viewBox="0 0 24 24" fill="none"
                                                 stroke="currentColor" stroke-width="2.5"
                                                 stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="12" cy="12" r="10"/>
                                                <line x1="12" y1="8" x2="12" y2="12"/>
                                                <line x1="12" y1="16" x2="12.01" y2="16"/>
                                            </svg>
                                            Đang xử lý
                                        </span>
                                        @endif
                                    </td>
                                    <td class="pr-4 text-right text-ink-light">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                             stroke="currentColor" stroke-width="2"
                                             stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="9 18 15 12 9 6"/>
                                        </svg>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- ══ PANEL 3 — Tình trạng đi làm (Chấm công) ══ --}}
                    <div class="overflow-hidden rounded-xl border border-page-border bg-white shadow-sm">
                        <div class="flex items-center gap-2.5 border-b border-page-lt px-5 py-3">
                            <div class="p-icon">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                     stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"/>
                                    <polyline points="12 6 12 12 16 14"/>
                                </svg>
                            </div>
                            <span class="text-[15px] font-semibold text-ink">Tình trạng đi làm (Chấm công)</span>

                            {{-- Year selector --}}
                            <div class="sel-w ml-auto">
                                <select class="f-input py-1.5 pl-3 pr-8 text-[12.5px]"
                                        style="min-width:110px;"
                                        onchange="window.location.search='?year='+this.value">
                                    @foreach(['2023','2022','2021','2020'] as $yr)
                                        <option value="{{ $yr }}" {{ $selYear===$yr?'selected':'' }}>
                                            Năm {{ $yr }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <table class="w-full border-collapse">
                            <thead>
                            <tr class="border-b border-page-border bg-page-bg
                                       text-[12px] font-medium text-ink-light">
                                <th class="px-5 py-2 text-left" style="width:80px">Tháng</th>
                                <th class="px-3 py-2 text-left">Thời gian làm việc<br>theo quy định (giờ)</th>
                                <th class="px-3 py-2 text-left">Giờ làm thực tế<br>(giờ)</th>
                                <th class="px-3 py-2 text-left">Tỷ lệ làm việc<br>(%)</th>
                                <th class="px-3 py-2 text-left">Tỷ lệ sử dụng<br>nghỉ phép có lương (%)</th>
                                <th class="px-3 py-2 text-left">Tình trạng<br>làm việc</th>
                                <th class="px-3 py-2 text-left">Số ngày nghỉ<br>có lương còn lại (ngày)</th>
                                <th style="width:28px"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($attendRows as $row)
                                <tr class="trow border-b border-page-lt last:border-b-0 transition-colors">
                                    <td class="px-5 py-3 text-[13px] font-medium text-ink">{{ $row['month'] }}</td>
                                    <td class="px-3 py-3 text-[13px] font-medium text-ink">{{ $row['req'] }}</td>
                                    <td class="px-3 py-3 text-[13px] font-medium text-ink">{{ $row['act'] }}</td>
                                    <td class="px-3 py-3 text-[13px] font-medium text-ink">{{ $row['wpct'] }}</td>
                                    <td class="px-3 py-3 text-[13px] font-medium text-ink">{{ $row['lpct'] }}</td>
                                    <td class="px-3 py-3">
                                        @if($row['st']==='ok')
                                            <div class="flex items-center gap-1.5 text-[12.5px]
                                                    font-semibold text-green-600">
                                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none"
                                                     stroke="currentColor" stroke-width="2.5"
                                                     stroke-linecap="round" stroke-linejoin="round">
                                                    <polyline points="20 6 9 17 4 12"/>
                                                </svg>
                                                Bình thường
                                            </div>
                                        @else
                                            <div class="flex items-center gap-1.5 text-[12.5px]
                                                    font-semibold text-amber-600">
                                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none"
                                                     stroke="currentColor" stroke-width="2.5"
                                                     stroke-linecap="round" stroke-linejoin="round">
                                                    <circle cx="12" cy="12" r="10"/>
                                                    <line x1="12" y1="8" x2="12" y2="12"/>
                                                    <line x1="12" y1="16" x2="12.01" y2="16"/>
                                                </svg>
                                                Cần chú ý
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-3 py-3 text-[13px] font-medium text-ink">{{ $row['left'] }}</td>
                                    <td class="pr-4 text-right text-ink-light">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                             stroke="currentColor" stroke-width="2"
                                             stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="9 18 15 12 9 6"/>
                                        </svg>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- end panels --}}

                </div>
                {{-- end right col --}}

            </div>
            {{-- end content grid --}}

        </div>
        {{-- end main --}}

    </div>
    {{-- end shell --}}

@endsection
