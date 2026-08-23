<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'PAWNDESK | Dashboard')</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js (Required for x-data and dark mode toggle) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300..800;1,300..800&family=Noto+Sans+Khmer:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Plus Jakarta Sans', 'Noto Sans Khmer', sans-serif;
        }

        body {
            background-color: #f8fafc;
        }

        /* Nav Link Base Styling */
        .sidebar-link {
            transition: all 0.15s ease-in-out;
            color: #64748b; /* slate-500 */
            position: relative;
        }

        .sidebar-link:hover {
            color: #1e293b; /* slate-800 */
            background-color: #f1f5f9;
        }

        /* Active Link Style */
        .sidebar-active {
            background: linear-gradient(to right, rgba(245, 158, 11, 0.08), transparent) !important;
            color: #d97706 !important; /* amber-600 */
            font-weight: 700 !important;
            border-left: 4px solid #d97706 !important;
            border-top-left-radius: 2px !important;
            border-bottom-left-radius: 2px !important;
        }

        .sidebar-active i {
            color: #d97706 !important;
        }

        .dashboard-card {
            background-color: #ffffff;
            border: 1px solid #f1f5f9;
            border-radius: 16px;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.02);
        }

        ::-webkit-scrollbar {
            width: 4px;
            height: 4px;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
    </style>
    @stack('styles')
</head>

<body class="text-slate-800 antialiased overflow-hidden">

<div class="flex h-screen overflow-hidden p-3 gap-4">

    <!-- Mobile Sidebar Backdrop -->
    <div id="sidebar-backdrop" onclick="toggleSidebar()" class="fixed inset-0 bg-slate-900/40 z-20 hidden md:hidden transition-opacity"></div>

    <!-- Sidebar Navigation -->
    <aside id="sidebar" class="fixed md:static inset-y-0 left-0 w-72 bg-white flex flex-col justify-between p-4 rounded-2xl border border-slate-200/60 shadow-sm z-30 transform -translate-x-full md:translate-x-0 transition-transform duration-200 ease-in-out">
        
        <div class="overflow-y-auto pr-1">
            <!-- Brand Logo Header -->
            <div class="flex items-center justify-between mb-6 p-2.5 rounded-2xl bg-slate-50 border border-slate-100">
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-amber-500/10 border border-amber-500/20 flex items-center justify-center text-amber-600">
                        <i class="bi bi-gem text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-sm font-bold tracking-wider text-slate-900 uppercase leading-none">
                            PAWNDESK
                        </h1>
                        <p class="text-[10px] text-amber-600 font-bold tracking-wider mt-1">
                            COLLATERAL CORE v2.0
                        </p>
                    </div>
                </a>
                <!-- Mobile Close Button -->
                <button onclick="toggleSidebar()" class="md:hidden text-slate-400 hover:text-slate-600">
                    <i class="bi bi-x-lg text-lg"></i>
                </button>
            </div>

            <!-- Navigation Links -->
            <nav class="space-y-1">
                <ul class="text-xs">
                    <!-- Dashboard -->
                    <li class="mb-1">
                        <a href="{{ route('user.Home') }}" class="sidebar-link flex items-center gap-3 py-2.5 px-3 rounded-xl font-medium">
                            <i class="bi bi-layout-sidebar-inset text-base"></i>
                            <span>ផ្ទាំងគ្រប់គ្រង <span class="text-slate-400 font-normal">(Dashboard)</span></span>
                        </a>
                    </li>

                    @can('view-borrowers')
                    <li class="mb-1">
                        <a href="{{ route('customers.index') }}" class="sidebar-link flex items-center gap-3 py-2.5 px-3 rounded-xl font-medium">
                            <i class="bi bi-people text-base"></i>
                            <span>អតិថិជន <span class="text-slate-400 font-normal">(Borrowers)</span></span>
                        </a>
                    </li>
                    @endcan

                    @can('manage-loans')
                    <li class="mb-1">
                        <a href="{{ route('loans.index') }}" class="sidebar-link flex items-center gap-3 py-2.5 px-3 rounded-xl font-medium">
                            <i class="bi bi-file-earmark-check text-base"></i>
                            <span>កិច្ចសន្យាបញ្ចាំ <span class="text-slate-400 font-normal">(Pawn Loans)</span></span>
                        </a>
                    </li>

                    <li class="mb-1">
                        <a href="{{ route('collaterals.index') }}" class="sidebar-link flex items-center gap-3 py-2.5 px-3 rounded-xl font-medium">
                            <i class="bi bi-box-seam text-base"></i>
                            <span>ទ្រព្យបញ្ចាំ / ឃ្លាំង <span class="text-slate-400 font-normal">(Collateral Vault)</span></span>
                        </a>
                    </li>

                    <li class="mb-1">
                        <a href="{{ route('repayments.index') }}" class="sidebar-link flex items-center gap-3 py-2.5 px-3 rounded-xl font-medium">
                            <i class="bi bi-wallet2 text-base"></i>
                            <span>ការបង់ប្រាក់ / ការរំលស់ <span class="text-slate-400 font-normal">(Repayments)</span></span>
                        </a>
                    </li>
                    @endcan

                    @can('view-reports')
                    <li class="mb-1">
                        <a href="{{ url('/reports') }}" class="sidebar-link flex items-center gap-3 py-2.5 px-3 rounded-xl font-medium">
                            <i class="bi bi-printer text-base"></i>
                            <span>របាយការណ៍ & បោះពុម្ព <span class="text-slate-400 font-normal">(Reports)</span></span>
                        </a>
                    </li>
                    @endcan

                    <!-- Section: System Logs -->
                    @can('view-audit-logs')
                    <li class="pt-4 pb-1">
                        <span class="px-3 text-[11px] font-semibold text-slate-400 tracking-wide">សកម្មភាពប្រព័ន្ធ</span>
                    </li>

                    <li class="mb-1">
                        <a href="{{ url('/audit-logs') }}" class="sidebar-link flex items-center gap-3 py-2.5 px-3 rounded-xl font-medium">
                            <i class="bi bi-card-heading text-base"></i>
                            <span>កំណត់ត្រាហេតុ <span class="text-slate-400 font-normal">(Audit Logs)</span></span>
                        </a>
                    </li>
                    @endcan

                    <!-- Section: User Management -->
                    @can('view-roles')
                    <li class="pt-4 pb-1">
                        <span class="px-3 text-[11px] font-semibold text-slate-400 tracking-wide">កំណត់ប្រព័ន្ធ</span>
                    </li>

                    <li class="mb-1">
                        <a href="{{ route('staff.index') }}" class="sidebar-link flex items-center gap-3 py-2.5 px-3 rounded-xl font-medium">
                            <i class="bi bi-person-gear text-base"></i>
                            <span>អ្នកប្រើប្រាស់ <span class="text-slate-400 font-normal">(Users)</span></span>
                        </a>
                    </li>

                    <li class="mb-1">
                        <a href="{{ route('roles.index') }}" class="sidebar-link flex items-center gap-3 py-2.5 px-3 rounded-xl font-medium">
                            <i class="bi bi-shield-check text-base"></i>
                            <span>តួនាទី <span class="text-slate-400 font-normal">(Roles & Permissions)</span></span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </nav>
        </div>

        <!-- Sidebar Footer -->
        <div class="space-y-3 pt-3 border-t border-slate-100">
            <div class="flex items-center gap-2 text-xs">
                <button onclick="window.location.reload()" class="flex-1 flex items-center justify-center gap-2 py-2 px-3 rounded-xl bg-slate-100/80 text-slate-700 hover:bg-slate-200/80 transition-colors font-medium">
                    <i class="bi bi-arrow-repeat text-sm"></i>
                    <span>ផ្ទុកឡើងវិញ</span>
                </button>
                <div class="flex items-center gap-1.5 py-2 px-3 rounded-xl bg-amber-500/10 border border-amber-500/20 text-amber-700 font-bold text-[10px]">
                    <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                    <span>VAULT ONLINE</span>
                </div>
            </div>

            <!-- Profile, Actions & Signout -->
            <div class="flex items-center justify-between p-2.5 rounded-2xl bg-slate-50 border border-slate-100 transition-colors">
                <div class="flex items-center gap-2.5 overflow-hidden">
                    <!-- User Avatar / Initials -->
                    <div class="w-9 h-9 rounded-xl bg-amber-500 flex items-center justify-center font-bold text-xs text-white shrink-0 shadow-sm">
                        {{ strtoupper(substr(Auth::user()->name ?? 'AM', 0, 2)) }}
                    </div>
                    
                    <!-- User Info -->
                    <div class="truncate">
                        <h3 class="font-bold text-xs text-slate-800 leading-tight truncate">
                            {{ Auth::user()->name ?? 'Admin Manager' }}
                        </h3>
                        <p class="text-[10px] text-slate-400 truncate mt-0.5">
                            {{ Auth::user()->role ?? 'User' }}
                        </p>
                    </div>
                </div>

                <!-- Actions & Logout -->
                <div class="flex items-center gap-1 shrink-0">
                   <!-- View Profile Button -->
                        <a 
                            href="{{ route('profile.show') }}" 
                            aria-label="View Profile"
                            title="View Profile" 
                            class="p-1.5 text-slate-400 hover:text-amber-500 transition-colors rounded-lg hover:bg-slate-100 flex items-center justify-center">
                            <i class="bi bi-person text-base"></i>
                        </a>

                    <!-- Settings Route -->
                    <a 
                        href="{{ route('profile.edit') }}" 
                        aria-label="Profile Settings"
                        title="Settings" 
                        class="p-1.5 text-slate-400 hover:text-slate-600 transition-colors rounded-lg hover:bg-slate-100">
                        <i class="bi bi-gear text-base"></i>
                    </a>

                    <!-- Sign Out Form -->
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button 
                            type="submit" 
                            aria-label="Sign Out"
                            title="Sign Out" 
                            class="p-1.5 text-slate-400 hover:text-rose-500 transition-colors rounded-lg hover:bg-slate-100">
                            <i class="bi bi-box-arrow-right text-base"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Workspace -->
    <div class="flex-1 flex flex-col overflow-hidden">

        <!-- Top Header Navigation -->
        <header class="h-14 flex items-center justify-between z-10 mb-2 px-1">
            <div class="flex items-center gap-3">
                <button onclick="toggleSidebar()" class="md:hidden text-slate-600 hover:text-slate-900 p-1">
                    <i class="bi bi-list text-2xl"></i>
                </button>
                
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-amber-100/60 border border-amber-200/50 text-amber-800 font-bold text-xs">
                    <span>SYSTEM DASHBOARD</span>
                    <span class="text-amber-500">//</span>
                    <span class="font-normal text-slate-700">@yield('header_title', 'ផ្ទាំងគ្រប់គ្រង')</span>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <div class="relative hidden sm:block">
                    <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input
                        type="text"
                        placeholder="ស្វែងរកកិច្ចសន្យា, អតិថិជន..."
                        class="w-56 lg:w-72 pl-8 pr-4 py-1.5 rounded-xl bg-white border border-slate-200/80 focus:outline-none focus:border-amber-400 text-xs text-slate-800 placeholder:text-slate-400 transition-all shadow-sm"
                    >
                </div>

                <div class="relative">
                    <select class="appearance-none bg-white border border-slate-200/80 text-xs font-semibold text-slate-700 py-1.5 pl-3 pr-7 rounded-xl focus:outline-none focus:border-amber-400 cursor-pointer shadow-sm">
                        <option value="USD">USD ($)</option>
                        <option value="KHR">KHR (៛)</option>
                    </select>
                    <i class="bi bi-chevron-down absolute right-2.5 top-1/2 -translate-y-1/2 text-[10px] text-slate-400 pointer-events-none"></i>
                </div>

                <button title="Toggle Theme" class="w-8 h-8 rounded-xl bg-white border border-slate-200/80 flex items-center justify-center text-slate-500 hover:bg-slate-50 shadow-sm transition-all">
                    <i class="bi bi-moon text-xs"></i>
                </button>

                <button class="flex items-center gap-1 px-2.5 py-1.5 rounded-xl bg-white border border-slate-200/80 text-slate-700 font-semibold text-xs shadow-sm hover:bg-slate-50 transition-colors">
                    <span class="text-[11px]">EN</span>
                </button>

                <button class="w-8 h-8 rounded-xl bg-amber-500 text-white flex items-center justify-center shadow-sm hover:bg-amber-600 transition-all">
                    <i class="bi bi-shield-lock-fill text-xs"></i>
                </button>
            </div>
        </header>

        <!-- Dynamic Page Content -->
        <main class="flex-1 overflow-y-auto pr-1">
            <div class="w-full">
                @yield('content')
            </div>
        </main>

    </div>

</div>

<!-- JavaScript Core -->
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
    });

    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const backdrop = document.getElementById('sidebar-backdrop');
        
        sidebar.classList.toggle('-translate-x-full');
        backdrop.classList.toggle('hidden');
    }
</script>

@stack('scripts')
</body>
</html>