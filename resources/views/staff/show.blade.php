<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Staff Profile | {{ $staff->name ?? 'Staff Details' }}</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300..800;1,300..800&family=Noto+Sans+Khmer:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            font-family: 'Plus Jakarta Sans', 'Noto Sans Khmer', sans-serif;
        }

        body {
            background-color: #f6f8fa;
        }

        /* Nav Link Styling */
        .sidebar-link {
            transition: all 0.2s ease;
            color: #64748b; /* slate-500 */
        }

        .sidebar-link:hover {
            color: #1e293b; /* slate-800 */
            background-color: #f1f5f9;
        }

        /* Active Link Style - Soft Amber / Orange */
        .sidebar-active {
            background-color: #fef3c7 !important; /* amber-100 */
            color: #d97706 !important; /* amber-600 */
            font-weight: 700 !important;
        }

        .dashboard-card {
            background-color: #ffffff;
            border: 1px solid #f1f5f9;
            border-radius: 16px;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.02);
        }

        ::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
    </style>
</head>

<body class="text-slate-800 antialiased overflow-hidden">

<div class="flex h-screen overflow-hidden p-3 gap-4">

    <!-- Mobile Sidebar Backdrop -->
    <div id="sidebar-backdrop" onclick="toggleSidebar()" class="fixed inset-0 bg-slate-900/40 z-20 hidden md:hidden transition-opacity"></div>

    <!-- Sidebar Navigation -->
    <aside id="sidebar" class="fixed md:static inset-y-0 left-0 w-72 bg-white flex flex-col justify-between p-4 rounded-2xl border border-slate-100 shadow-sm z-30 transform -translate-x-full md:translate-x-0 transition-transform duration-200 ease-in-out">
        
        <div class="overflow-y-auto pr-1">
            <!-- Brand Logo Header -->
            <div class="flex items-center justify-between mb-6 p-2 rounded-xl bg-orange-50/50 border border-orange-100/60">
                <a href="{{ url('/') }}" class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-amber-500 to-orange-400 flex items-center justify-center text-white shadow-sm">
                        <i class="bi bi-gem text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-sm font-black tracking-wider text-slate-800 uppercase leading-none">
                            PAWNDESK
                        </h1>
                        <p class="text-[10px] text-amber-600 font-semibold tracking-wider mt-0.5">
                            COLLATERAL CORE v2.0
                        </p>
                    </div>
                </a>
                <button onclick="toggleSidebar()" class="md:hidden text-slate-400 hover:text-slate-600">
                    <i class="bi bi-x-lg text-lg"></i>
                </button>
            </div>

            <!-- Navigation Links -->
            <nav class="space-y-1">
                <ul class="text-xs">
                    <li class="mb-1">
                        <a href="{{ url('/') }}" class="sidebar-link flex items-center gap-3 py-2.5 px-3.5 rounded-xl font-medium">
                            <i class="bi bi-grid-fill text-amber-500"></i>
                            <span>ផ្ទាំងគ្រប់គ្រង <span class="text-slate-400 text-[11px] font-normal">(Dashboard)</span></span>
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ url('/customers') }}" class="sidebar-link flex items-center gap-3 py-2.5 px-3.5 rounded-xl font-medium">
                            <i class="bi bi-people"></i>
                            <span>អតិថិជន <span class="text-slate-400 text-[11px] font-normal">(Borrowers)</span></span>
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ url('/loans') }}" class="sidebar-link flex items-center gap-3 py-2.5 px-3.5 rounded-xl font-medium">
                            <i class="bi bi-file-earmark-text"></i>
                            <span>កិច្ចសន្យាបញ្ចាំ <span class="text-slate-400 text-[11px] font-normal">(Pawn Loans)</span></span>
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ url('/collaterals') }}" class="sidebar-link flex items-center gap-3 py-2.5 px-3.5 rounded-xl font-medium">
                            <i class="bi bi-box-seam"></i>
                            <span>ទ្រព្យបញ្ចាំ / ឃ្លាំង <span class="text-slate-400 text-[11px] font-normal">(Collateral Vault)</span></span>
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ url('/repayments') }}" class="sidebar-link flex items-center gap-3 py-2.5 px-3.5 rounded-xl font-medium">
                            <i class="bi bi-wallet2"></i>
                            <span>ការបង់ប្រាក់ / ការរំលស់ <span class="text-slate-400 text-[11px] font-normal">(Repayments)</span></span>
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ url('/reports') }}" class="sidebar-link flex items-center gap-3 py-2.5 px-3.5 rounded-xl font-medium">
                            <i class="bi bi-journal-richtext"></i>
                            <span>របាយការណ៍ & បោះពុម្ព <span class="text-slate-400 text-[11px] font-normal">(Reports)</span></span>
                        </a>
                    </li>

                    <li class="pt-3 pb-1">
                        <span class="px-3 text-[10px] uppercase font-bold text-slate-400 tracking-wider">សកម្មភាពប្រព័ន្ធ</span>
                    </li>
                    <li class="mb-1">
                        <a href="{{ url('/audit-logs') }}" class="sidebar-link flex items-center gap-3 py-2 px-3.5 rounded-xl font-medium">
                            <i class="bi bi-card-list"></i>
                            <span>កំណត់ត្រាហេតុ <span class="text-slate-400 text-[11px] font-normal">(Audit Logs)</span></span>
                        </a>
                    </li>

                    <li class="pt-3 pb-1">
                        <span class="px-3 text-[10px] uppercase font-bold text-slate-400 tracking-wider">កំណត់ប្រព័ន្ធ</span>
                    </li>
                    <li class="mb-1">
                        <a href="{{ route('staff.index') }}" class="sidebar-link sidebar-active flex items-center gap-3 py-2 px-3.5 rounded-xl font-medium">
                            <i class="bi bi-person"></i>
                            <span>អ្នកប្រើប្រាស់ <span class="text-slate-400 text-[11px] font-normal">(Users)</span></span>
                        </a>
                    </li>
                    <li class="mb-1">
                        <a href="{{ url('/roles') }}" class="sidebar-link flex items-center gap-3 py-2 px-3.5 rounded-xl font-medium">
                            <i class="bi bi-shield-check"></i>
                            <span>តួនាទី <span class="text-slate-400 text-[11px] font-normal">(Roles & Permissions)</span></span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="space-y-3 pt-3 border-t border-slate-100">
            <div class="flex items-center justify-between text-xs">
                <button onclick="window.location.reload()" class="flex items-center gap-2 py-1.5 px-3 rounded-lg bg-slate-100 text-slate-600 hover:bg-slate-200 transition-colors font-medium">
                    <i class="bi bi-arrow-clockwise"></i>
                    <span>ផ្ទុកឡើងវិញ</span>
                </button>
                <div class="flex items-center gap-1.5 py-1.5 px-2.5 rounded-lg bg-amber-100 text-amber-700 font-bold text-[11px]">
                    <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                    <span>VAULT ONLINE</span>
                </div>
            </div>

            <div class="flex items-center justify-between p-2 rounded-xl bg-slate-50 border border-slate-100">
                <div class="flex items-center gap-2.5 overflow-hidden">
                    <div class="w-8 h-8 rounded-lg bg-amber-500 flex items-center justify-center font-bold text-xs text-white shrink-0">
                        {{ strtoupper(substr(Auth::user()->name ?? 'AM', 0, 2)) }}
                    </div>
                    <div class="truncate">
                        <h3 class="font-bold text-xs text-slate-800 leading-tight truncate">
                            {{ Auth::user()->name ?? 'Admin Manager' }}
                        </h3>
                        <p class="text-[10px] text-slate-400 truncate">
                            {{ Auth::user()->role ?? 'Super Administrator' }}
                        </p>
                    </div>
                </div>
                <form method="POST" action="{{ route('login') }}" class="inline shrink-0">
                    @csrf
                    <button type="submit" title="Sign Out" class="text-slate-400 hover:text-rose-500 transition-colors p-1">
                        <i class="bi bi-box-arrow-right text-base"></i>
                    </button>
                </form>
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
                
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-amber-100/60 border border-amber-200/50 text-amber-800 font-bold text-xs tracking-wider uppercase">
                    <span>SYSTEM DASHBOARD</span>
                    <span class="text-amber-500">//</span>
                    <span class="font-normal text-slate-700">ព័ត៌មានបុគ្គលិក (Staff Details)</span>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <div class="relative hidden sm:block">
                    <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                    <input type="text" placeholder="ស្វែងរកកិច្ចសន្យា, អតិថិជន..." class="w-56 lg:w-72 pl-8 pr-4 py-1.5 rounded-xl bg-white border border-slate-200/80 focus:outline-none focus:border-amber-400 text-xs text-slate-800 placeholder:text-slate-400 transition-all shadow-sm">
                </div>
                <div class="relative hidden sm:block">
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
        <main class="flex-1 overflow-y-auto pr-1 pb-6">
            <div class="w-full max-w-4xl mx-auto py-2 px-2 sm:px-4">
                
                <!-- Back Link & Action Bar -->
                <div class="flex items-center justify-between mb-6">
                    <a href="{{ route('staff.index') }}" class="group inline-flex items-center gap-3 text-slate-500 hover:text-amber-600 transition-all">
                        <div class="flex items-center justify-center w-9 h-9 rounded-xl bg-white border border-slate-200 shadow-sm group-hover:shadow group-hover:border-amber-200 group-hover:bg-amber-50 transition-all">
                            <i class="bi bi-arrow-left transition-transform group-hover:-translate-x-0.5 text-slate-600 group-hover:text-amber-600"></i>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 group-hover:text-amber-500 transition-colors">Back to</span>
                            <span class="text-xs font-bold text-slate-700 group-hover:text-amber-600 transition-colors">Staff Directory</span>
                        </div>
                    </a>

                    <div class="flex items-center gap-2">
                        <a href="{{ route('staff.edit', $staff->id ?? 1) }}" class="flex items-center gap-2 px-4 py-2 rounded-xl bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 hover:text-amber-600 font-bold text-xs transition-all shadow-sm">
                            <i class="bi bi-pencil"></i>
                            <span>Edit Profile</span>
                        </a>
                        <form method="POST" action="{{ route('staff.destroy', $staff->id ?? 1) }}" onsubmit="return confirm('Are you sure you want to delete this staff record?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="flex items-center gap-2 px-4 py-2 rounded-xl bg-rose-50 border border-rose-100 text-rose-600 hover:bg-rose-100 font-bold text-xs transition-all shadow-sm">
                                <i class="bi bi-trash"></i>
                                <span>Delete</span>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Main Staff Profile Card -->
                <div class="dashboard-card overflow-hidden mb-6">
                    <!-- Profile Banner Header -->
                    <div class="p-6 sm:p-8 bg-gradient-to-r from-amber-500/10 via-orange-500/5 to-transparent border-b border-slate-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
                        <div class="flex items-center gap-5">
                            <div class="w-20 h-20 rounded-2xl bg-gradient-to-tr from-amber-500 to-orange-400 flex items-center justify-center font-black text-2xl text-white shadow-md border-2 border-white shrink-0">
                                {{ strtoupper(substr($staff->name ?? 'John Doe', 0, 2)) }}
                            </div>
                            <div>
                                <div class="flex items-center gap-3">
                                    <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight">{{ $staff->name ?? 'John Doe' }}</h2>
                                    @if(($staff->status ?? 'active') === 'active')
                                        <span class="px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-700 font-bold text-[10px] uppercase tracking-wider border border-emerald-200">Active</span>
                                    @else
                                        <span class="px-2.5 py-0.5 rounded-full bg-amber-100 text-amber-700 font-bold text-[10px] uppercase tracking-wider border border-amber-200">On Leave</span>
                                    @endif
                                </div>
                                <p class="text-slate-500 font-semibold text-xs sm:text-sm mt-0.5">{{ $staff->position ?? 'Senior Loan Officer' }} &bull; <span class="text-amber-600">{{ $staff->department ?? 'Operations & Risk' }}</span></p>
                                <p class="text-slate-400 text-xs mt-1"><i class="bi bi-envelope text-slate-400 mr-1"></i> {{ $staff->email ?? 'johndoe@pawndesk.com' }}</p>
                            </div>
                        </div>

                        <div class="w-full sm:w-auto flex sm:flex-col justify-between items-end border-t sm:border-t-0 pt-4 sm:pt-0 border-slate-200/60">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">System Role</span>
                            <span class="px-3 py-1 rounded-xl bg-amber-50 text-amber-700 font-extrabold text-xs border border-amber-200 uppercase tracking-wide mt-1">
                                {{ $staff->role ?? 'Administrator' }}
                            </span>
                        </div>
                    </div>

                    <!-- Detail Information Grid -->
                    <div class="p-6 sm:p-8 grid grid-cols-1 md:grid-cols-2 gap-6 bg-white">
                        <div class="space-y-4">
                            <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">Employment Details</h3>
                            
                            <div class="flex items-center justify-between p-3.5 rounded-xl bg-slate-50 border border-slate-100">
                                <span class="text-xs font-semibold text-slate-500">Position Title</span>
                                <span class="text-xs font-bold text-slate-800">{{ $staff->position ?? 'Senior Loan Officer' }}</span>
                            </div>

                            <div class="flex items-center justify-between p-3.5 rounded-xl bg-slate-50 border border-slate-100">
                                <span class="text-xs font-semibold text-slate-500">Department</span>
                                <span class="text-xs font-bold text-slate-800">{{ $staff->department ?? 'Operations & Risk' }}</span>
                            </div>

                            <div class="flex items-center justify-between p-3.5 rounded-xl bg-slate-50 border border-slate-100">
                                <span class="text-xs font-semibold text-slate-500">Authorization Status</span>
                                <span class="text-xs font-bold text-slate-800 uppercase">{{ $staff->status ?? 'Active' }}</span>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">System Account</h3>
                            
                            <div class="flex items-center justify-between p-3.5 rounded-xl bg-slate-50 border border-slate-100">
                                <span class="text-xs font-semibold text-slate-500">Email Address</span>
                                <span class="text-xs font-bold text-slate-800">{{ $staff->email ?? 'johndoe@pawndesk.com' }}</span>
                            </div>

                            <div class="flex items-center justify-between p-3.5 rounded-xl bg-slate-50 border border-slate-100">
                                <span class="text-xs font-semibold text-slate-500">Assigned Access Level</span>
                                <span class="text-xs font-bold text-amber-600 capitalize">{{ $staff->role ?? 'Admin' }}</span>
                            </div>

                            <div class="flex items-center justify-between p-3.5 rounded-xl bg-slate-50 border border-slate-100">
                                <span class="text-xs font-semibold text-slate-500">Enrolled On</span>
                                <span class="text-xs font-bold text-slate-800">{{ isset($staff->created_at) ? $staff->created_at->format('M d, Y') : 'Aug 23, 2026' }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <p class="text-center mt-6 text-slate-400 text-xs font-medium">
                    PAWNDESK System Registry &bull; Authorization level required.
                </p>

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

</body>
</html>