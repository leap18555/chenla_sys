<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'ធនាគារ ចេនឡា | ប្រព័ន្ធគ្រប់គ្រង')</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            navy: '#0B2B40',
                            teal: '#0F4C5C',
                            green: '#10B981',
                            greenDark: '#059669',
                            greenSoft: '#EEF7F0',
                            surface: '#F4F7F9',
                        },
                        // Backward compatibility aliases
                        bank: {
                            navy: '#0B2B40',
                            navyLight: '#173B57',
                            teal: '#0F4C5C',
                            tealLight: '#EAF6F5',
                            green: '#10B981',
                            greenDark: '#059669',
                            greenSoft: '#EEF7F0',
                            gold: '#c59b27',
                            surface: '#F4F7F9',
                        }
                    }
                }
            }
        }
    </script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Khmer Font (Kantumruy Pro) -->
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@300;400;500;600;700&family=Noto+Sans+Khmer:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        [x-cloak] {
            display: none !important;
        }

        * {
            font-family: 'Kantumruy Pro', 'Noto Sans Khmer', sans-serif;
        }

        body {
            background-color: #F4F7F9;
            color: #1e293b;
        }

        /* Subtle Khmer Kbach Diamond Lattice Pattern */
        .khmer-pattern-bg {
            background-image: url("data:image/svg+xml,%3Csvg width='56' height='56' viewBox='0 0 56 56' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' stroke='%230F4C5C' stroke-width='1' stroke-opacity='0.04'%3E%3Cpath d='M28 4 L52 28 L28 52 L4 28 Z'/%3E%3Cpath d='M28 14 L42 28 L28 42 L14 28 Z'/%3E%3Ccircle cx='28' cy='28' r='3' fill='%230F4C5C' fill-opacity='0.04'/%3E%3C/g%3E%3C/svg%3E");
        }

        /* Nav Link Base Styling */
        .sidebar-link {
            transition: all 0.15s ease-in-out;
            color: #64748b;
            position: relative;
            border-left: 3px solid transparent;
        }

        .sidebar-link:hover {
            color: #0B2B40;
            background-color: #F1F5F7;
        }

        .sidebar-link:hover i {
            color: #10B981;
        }

        /* Active Nav Link (Emerald highlight matching screenshot) */
        .sidebar-active {
            background-color: #EEF7F0 !important;
            color: #0F4C5C !important;
            font-weight: 600 !important;
            border-left: 3px solid #10B981 !important;
        }

        .sidebar-active i {
            color: #10B981 !important;
        }

        /* Khmer Decorative Divider */
        .khmer-divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, #E2E8F0, #10B981, #E2E8F0, transparent);
        }

        /* Standard White Dashboard Card with Top Emerald Accent */
        .dashboard-card {
            background-color: #FFFFFF;
            border: 1px solid #E2E8F0;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(11, 43, 64, 0.04);
            overflow: hidden;
            position: relative;
        }

        .card-accent-top {
            position: relative;
        }
        .card-accent-top::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: #10B981;
        }

        /* Primary Green Action Button matching Login button */
        .btn-chhenla-primary {
            background-color: #10B981;
            color: #ffffff;
            font-weight: 600;
            transition: all 0.2s ease;
        }
        .btn-chhenla-primary:hover {
            background-color: #059669;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #F1F5F9;
        }
        ::-webkit-scrollbar-thumb {
            background: #CBD5E1;
            border-radius: 9999px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94A3B8;
        }
    </style>
    @stack('styles')
</head>

<body class="khmer-pattern-bg text-slate-800 antialiased min-h-screen selection:bg-[#10B981] selection:text-white">

<!-- Sidebar Backdrop (Click outside to close) -->
<div id="sidebar-backdrop" onclick="toggleSidebar()" class="fixed inset-0 bg-slate-900/50 backdrop-blur-xs z-40 hidden transition-opacity duration-300"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!-- NORMAL STANDARD ADMIN LAYOUT (Full-Height Edge-to-Edge) -->
<!-- ═══════════════════════════════════════════════════════ -->
<div class="flex min-h-screen">

    <!-- ═══════════════════════════════════════════════════ -->
    <!-- SIDEBAR (Off-canvas Drawer: Click to show/hide)    -->
    <!-- ═══════════════════════════════════════════════════ -->
    <aside id="sidebar" class="fixed top-0 inset-y-0 left-0 w-72 h-screen bg-white border-r border-slate-200/90 flex flex-col justify-between shrink-0 z-50 transform -translate-x-full transition-transform duration-300 ease-in-out shadow-2xl select-none" aria-label="ផ្ទាំងម៉ឺនុយ">

        <!-- Top: Logo + Navigation Links -->
        <div class="flex-1 overflow-y-auto">

            <!-- Brand Logo Header (Matches the screenshot identity) -->
            <div class="h-16 px-5 border-b border-slate-200/90 flex items-center justify-between bg-slate-50/50">
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <!-- CH Logo Square Badge -->
                    <div class="w-10 h-10 rounded-lg bg-[#0F4C5C] text-white flex items-center justify-center font-bold text-base shadow-sm shrink-0">
                        CH
                    </div>
                    <div class="text-left">
                        <div class="text-sm font-bold text-[#0B2B40] leading-tight">
                            ធនាគារ ចេនឡា
                        </div>
                        <div class="text-[11px] text-slate-500 font-medium">
                            Chhenla Bank PLC.
                        </div>
                    </div>
                </a>

                <!-- Close Button (Visible on all screen sizes) -->
                <button onclick="toggleSidebar()" type="button" aria-label="បិទម៉ឺនុយ" title="បិទម៉ឺនុយ (Esc)" class="text-slate-400 hover:text-slate-700 hover:bg-slate-200/70 p-1.5 rounded-lg transition-colors cursor-pointer">
                    <i class="bi bi-x-lg text-base"></i>
                </button>
            </div>

            <!-- Navigation Links -->
            <nav class="p-3 space-y-6">

                <!-- Section: Main Menu -->
                <div>
                    <span class="px-3 text-[10px] font-bold uppercase text-slate-400 tracking-wider">ម៉ឺនុយគោល</span>
                    <ul class="mt-2 space-y-1 text-xs">
                        <!-- Dashboard -->
                        <li>
                            <a href="{{ route('user.Home') }}" class="sidebar-link flex items-center gap-3 py-2.5 px-3 rounded-lg font-medium">
                                <i class="bi bi-grid-1x2-fill text-base"></i>
                                <span>ផ្ទាំងគ្រប់គ្រង</span>
                            </a>
                        </li>

                        @can('view-borrowers')
                        <li>
                            <a href="{{ route('customers.index') }}" class="sidebar-link flex items-center gap-3 py-2.5 px-3 rounded-lg font-medium">
                                <i class="bi bi-people-fill text-base"></i>
                                <span>អតិថិជន</span>
                            </a>
                        </li>
                        @endcan

                        @can('manage-loans')
                        <li>
                            <a href="{{ route('loans.index') }}" class="sidebar-link flex items-center gap-3 py-2.5 px-3 rounded-lg font-medium">
                                <i class="bi bi-file-earmark-check text-base"></i>
                                <span>កិច្ចសន្យាកម្ចី</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('collaterals.index') }}" class="sidebar-link flex items-center gap-3 py-2.5 px-3 rounded-lg font-medium {{ request()->is('collaterals*') ? 'sidebar-active' : '' }}">
                                <i class="bi bi-safe2 text-base"></i>
                                <span>ទ្រព្យបញ្ចាំ / ឃ្លាំង</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('repayments.index') }}" class="sidebar-link flex items-center justify-between py-2.5 px-3 rounded-lg font-medium {{ request()->is('repayments*') ? 'sidebar-active' : '' }}">
                                <div class="flex items-center gap-3">
                                    <i class="bi bi-cash-coin text-base"></i>
                                    <span>ការបង់ប្រាក់សង</span>
                                </div>
                                <span class="w-2 h-2 rounded-full bg-[#10B981]" title="សកម្មភាពវិជ្ជមាន"></span>
                            </a>
                        </li>
                        @endcan

                        @can('view-reports')
                        <li>
                            <a href="{{ url('/reports') }}" class="sidebar-link flex items-center gap-3 py-2.5 px-3 rounded-lg font-medium {{ request()->is('reports*') ? 'sidebar-active' : '' }}">
                                <i class="bi bi-bar-chart-line text-base"></i>
                                <span>របាយការណ៍ហិរញ្ញវត្ថុ</span>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </div>

                <!-- Section: Security & System Logs -->
                @can('view-audit-logs')
                <div>
                    <span class="px-3 text-[10px] font-bold uppercase text-slate-400 tracking-wider">សុវត្ថិភាព និងសកម្មភាព</span>
                    <ul class="mt-2 space-y-1 text-xs">
                        <li>
                            <a href="{{ url('/audit-logs') }}" class="sidebar-link flex items-center gap-3 py-2.5 px-3 rounded-lg font-medium {{ request()->is('audit-logs*') ? 'sidebar-active' : '' }}">
                                <i class="bi bi-shield-lock text-base"></i>
                                <span>កំណត់ហេតុប្រព័ន្ធ</span>
                            </a>
                        </li>
                    </ul>
                </div>
                @endcan

                <!-- Section: Administration -->
                @can('view-roles')
                <div>
                    <span class="px-3 text-[10px] font-bold uppercase text-slate-400 tracking-wider">ការគ្រប់គ្រងរដ្ឋបាល</span>
                    <ul class="mt-2 space-y-1 text-xs">
                        <li>
                            <a href="{{ route('staff.index') }}" class="sidebar-link flex items-center gap-3 py-2.5 px-3 rounded-lg font-medium">
                                <i class="bi bi-person-badge text-base"></i>
                                <span>អ្នកប្រើប្រាស់</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('roles.index') }}" class="sidebar-link flex items-center gap-3 py-2.5 px-3 rounded-lg font-medium">
                                <i class="bi bi-shield-check text-base"></i>
                                <span>តួនាទី និងសិទ្ធិអនុញ្ញាត</span>
                            </a>
                        </li>
                    </ul>
                </div>
                @endcan

            </nav>
        </div>

        <!-- ── Bottom: User Card & Status ── -->
        <div class="p-4 border-t border-slate-200/90 bg-slate-50/50 space-y-3">
            <!-- System Status Indicator -->
            <div class="flex items-center justify-between text-xs px-1">
                <span class="text-slate-500 text-[11px]">ស្ថានភាពប្រព័ន្ធ</span>
                <div class="flex items-center gap-1.5 text-[11px] font-semibold text-[#10B981]">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#10B981] opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-[#10B981]"></span>
                    </span>
                    <span>ដំណើរការល្អ</span>
                </div>
            </div>

            <!-- User Profile Box -->
            <div class="flex items-center justify-between p-2 rounded-xl bg-white border border-slate-200 shadow-2xs">
                <div class="flex items-center gap-2.5 overflow-hidden">
                    <!-- User Avatar Badge -->
                    @if(Auth::user()->avatar)
                        <img src="{{ Auth::user()->avatar_url }}" alt="avatar" class="w-8 h-8 rounded-lg object-cover border border-slate-200 shrink-0" onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'User') }}&background=0F4C5C&color=ffffff&bold=true';">
                    @else
                        <div class="w-8 h-8 rounded-lg bg-[#0F4C5C] text-white flex items-center justify-center font-bold text-xs shrink-0">
                            {{ strtoupper(substr(Auth::user()->name ?? 'SU', 0, 2)) }}
                        </div>
                    @endif

                    <!-- User Information -->
                    <div class="truncate">
                        <h3 class="font-bold text-xs text-[#0B2B40] leading-tight truncate">
                            {{ Auth::user()->name ?? 'SuperAdmin' }}
                        </h3>
                        <p class="text-[10px] text-slate-500 font-medium truncate">
                            {{ Auth::user()->role ?? 'អ្នកគ្រប់គ្រង' }}
                        </p>
                    </div>
                </div>

                <!-- Profile & Logout Action Buttons -->
                <div class="flex items-center gap-0.5 shrink-0">
                    <a href="{{ route('profile.show') }}" aria-label="មើលប្រវត្តិរូប" title="មើលប្រវត្តិរូប"
                       class="p-1.5 text-slate-400 hover:text-[#0B2B40] hover:bg-slate-100 rounded-lg transition-colors">
                        <i class="bi bi-person text-sm"></i>
                    </a>

                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" aria-label="ចាកចេញ" title="ចាកចេញ"
                                class="p-1.5 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors">
                            <i class="bi bi-box-arrow-right text-sm"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </aside>

    <!-- ═══════════════════════════════════════════════════ -->
    <!-- MAIN COLUMN (Header + Content Workspace + Footer)   -->
    <!-- ═══════════════════════════════════════════════════ -->
    <div class="flex-1 flex flex-col min-w-0 min-h-screen">

        <!-- ── Top Navbar (Edge-to-Edge Normal Style) ── -->
        <header class="h-16 bg-white border-b border-slate-200/90 px-4 sm:px-6 flex items-center justify-between sticky top-0 z-30">
            <div class="flex items-center gap-2 sm:gap-3">
                <!-- Sidebar Menu Toggle Button (Click to show menu) -->
                <button onclick="toggleSidebar()" type="button" aria-label="បើកម៉ឺនុយ" title="ចុចដើម្បីបើកម៉ឺនុយ (Menu)"
                        class="flex items-center gap-2 text-[#0B2B40] hover:text-[#0F4C5C] hover:bg-slate-100 active:bg-slate-200 px-3 py-2 rounded-xl border border-slate-200 transition-all cursor-pointer shadow-xs group">
                    <i class="bi bi-list text-2xl group-hover:scale-110 transition-transform text-[#0F4C5C]"></i>
                    <span class="text-xs font-bold text-[#0B2B40]">ម៉ឺនុយ</span>
                </button>

                <!-- Brand Logo in Top Navbar -->
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 group pl-1">
                    <div class="w-9 h-9 rounded-lg bg-[#0F4C5C] text-white flex items-center justify-center font-bold text-sm shadow-xs shrink-0 group-hover:bg-[#0B2B40] transition-colors">
                        CH
                    </div>
                    <div class="hidden md:block text-left">
                        <div class="text-xs font-bold text-[#0B2B40] leading-tight">
                            ធនាគារ ចេនឡា
                        </div>
                        <div class="text-[10px] text-slate-500 font-medium">
                            Chhenla Bank PLC.
                        </div>
                    </div>
                </a>

                <!-- Divider -->
                <div class="hidden sm:block h-6 w-px bg-slate-200"></div>

                <!-- Quick Action Button (Positive Green matching Screenshot button) -->
                <a href="{{ route('customers.create') }}"
                   class="btn-chhenla-primary hidden sm:inline-flex items-center gap-2 px-3.5 py-2 rounded-lg text-xs shadow-xs">
                    <i class="bi bi-plus-lg text-xs"></i>
                    <span>ចុះឈ្មោះអតិថិជនថ្មី</span>
                </a>

                <!-- Security Trust Badge -->
                <div class="hidden xl:inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-[#EEF7F0] border border-emerald-200 text-[#059669] text-xs font-medium">
                    <i class="bi bi-patch-check-fill text-[#10B981]"></i>
                    <span>ប្រព័ន្ធធនាគារមានសុវត្ថិភាពខ្ពស់</span>
                </div>
            </div>

            <!-- Right Controls -->
            <div class="flex items-center gap-2.5">
                <!-- Search Bar -->
                <div class="relative hidden sm:block">
                    <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="text" placeholder="ស្វែងរកអតិថិជន ឬកិច្ចសន្យា..."
                        class="w-56 lg:w-64 pl-8 pr-3 py-1.5 rounded-lg bg-slate-50 border border-slate-200 focus:bg-white focus:outline-none focus:border-[#0F4C5C] focus:ring-2 focus:ring-[#0F4C5C]/15 text-xs text-slate-800 placeholder:text-slate-400 transition-all">
                </div>

                <!-- Currency Selector -->
                <div class="relative">
                    <select aria-label="រូបិយប័ណ្ណ" class="appearance-none bg-slate-50 hover:bg-white border border-slate-200 text-xs font-semibold text-[#0B2B40] py-1.5 pl-3 pr-7 rounded-lg focus:outline-none focus:border-[#0F4C5C] cursor-pointer transition-colors">
                        <option value="KHR">KHR (រៀល)</option>
                        <option value="USD">USD (ដុល្លារ)</option>
                    </select>
                    <i class="bi bi-chevron-down absolute right-2 top-1/2 -translate-y-1/2 text-[10px] text-slate-400 pointer-events-none"></i>
                </div>

                <!-- Language Switcher -->
                <div class="flex border border-slate-200 bg-slate-50 p-0.5 rounded-lg text-xs font-semibold">
                    <button class="px-2 py-1 text-slate-500 hover:text-[#0B2B40] transition-colors rounded">EN</button>
                    <button class="px-2 py-1 rounded bg-[#0F4C5C] text-white shadow-xs">ខ្មែរ</button>
                </div>

                <!-- Notification Bell -->
                <button title="ការជូនដំណឹង" class="relative w-8 h-8 rounded-lg bg-slate-50 border border-slate-200 flex items-center justify-center text-[#0B2B40] hover:bg-slate-100 transition-all">
                    <i class="bi bi-bell text-sm"></i>
                    <span class="absolute -top-1 -right-1 w-4 h-4 rounded-full bg-rose-500 text-white text-[9px] font-bold flex items-center justify-center shadow-xs">3</span>
                </button>
            </div>
        </header>

        <!-- ── Main Content Workspace ── -->
        <main class="flex-1 p-4 sm:p-6 lg:p-8">
            @yield('content')
        </main>

        <!-- ── Footer (Matching screenshot bottom bar) ── -->
        <footer class="mt-auto py-4 px-6 border-t border-slate-200/80 bg-white/80 text-center text-xs text-slate-500 flex items-center justify-center gap-1.5">
            <i class="bi bi-shield-check text-base text-[#10B981]"></i>
            <span>© {{ date('Y') }} ធនាគារ ចេនឡា • ប្រព័ន្ធធនាគារមានសុវត្ថិភាព</span>
        </footer>

    </div>

</div>

<!-- ═══════════════════════════════════════════════════════ -->
<!-- JavaScript Core                                        -->
<!-- ═══════════════════════════════════════════════════════ -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const currentPath = window.location.pathname;
        const menuLinks = document.querySelectorAll("nav .sidebar-link");

        menuLinks.forEach(link => {
            link.classList.remove("sidebar-active");
            const linkHref = link.getAttribute("href");

            if (linkHref && linkHref !== "#") {
                try {
                    const linkPath = new URL(linkHref, window.location.origin).pathname;
                    if (currentPath === linkPath || (linkPath !== '/' && currentPath.startsWith(linkPath))) {
                        link.classList.add("sidebar-active");
                    }
                } catch (e) {
                    if (currentPath === linkHref) {
                        link.classList.add("sidebar-active");
                    }
                }
            }
        });

        if (window.lucide) {
            lucide.createIcons();
        }
    });

    function toggleSidebar(forceOpen = null) {
        const sidebar = document.getElementById('sidebar');
        const backdrop = document.getElementById('sidebar-backdrop');
        if (!sidebar || !backdrop) return;

        const isCurrentlyHidden = sidebar.classList.contains('-translate-x-full');
        const shouldOpen = (forceOpen !== null) ? forceOpen : isCurrentlyHidden;

        if (shouldOpen) {
            sidebar.classList.remove('-translate-x-full');
            backdrop.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        } else {
            sidebar.classList.add('-translate-x-full');
            backdrop.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
    }

    // Close on Escape key press
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') {
            const sidebar = document.getElementById('sidebar');
            if (sidebar && !sidebar.classList.contains('-translate-x-full')) {
                toggleSidebar(false);
            }
        }
    });
</script>

@stack('scripts')
</body>
</html>
