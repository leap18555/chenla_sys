<!DOCTYPE html>
<html lang="km">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Staff Directory | PAWNDESK</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Bootstrap Icons -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet"
    >

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300..800;1,300..800&family=Noto+Sans+Khmer:wght@300;400;500;600;700&display=swap"
        rel="stylesheet"
    >

    <style>
        * {
            font-family: 'Plus Jakarta Sans', 'Noto Sans Khmer', sans-serif;
        }

        body {
            background-color: #f6f8fa;
        }

        .sidebar-link {
            transition: all 0.2s ease;
            color: #64748b;
        }

        .sidebar-link:hover {
            color: #1e293b;
            background-color: #f1f5f9;
        }

        .sidebar-active {
            background-color: #fef3c7 !important;
            color: #d97706 !important;
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

        /* Pagination */
        .pagination-wrapper nav {
            display: flex;
            justify-content: center;
        }

        .pagination-wrapper svg {
            width: 18px;
            height: 18px;
        }

        /* Hide default Laravel pagination text */
        .pagination-wrapper .hidden {
            display: none;
        }
    </style>
</head>

<body class="text-slate-800 antialiased overflow-hidden">

<div class="flex h-screen overflow-hidden p-3 gap-4">

    <!-- Mobile Sidebar Backdrop -->
    <div
        id="sidebar-backdrop"
        onclick="toggleSidebar()"
        class="fixed inset-0 bg-slate-900/40 z-20 hidden md:hidden transition-opacity">
    </div>

    <!-- =========================================================
         SIDEBAR
    ========================================================== -->
    <aside
        id="sidebar"
        class="fixed md:static inset-y-0 left-0 w-72 bg-white flex flex-col justify-between p-4 rounded-2xl border border-slate-100 shadow-sm z-30 transform -translate-x-full md:translate-x-0 transition-transform duration-200 ease-in-out"
    >

        <div class="overflow-y-auto pr-1">

            <!-- Brand -->
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

                <!-- Mobile Close -->
                <button
                    onclick="toggleSidebar()"
                    class="md:hidden text-slate-400 hover:text-slate-600"
                >
                    <i class="bi bi-x-lg text-lg"></i>
                </button>

            </div>

            <!-- Navigation -->
            <nav class="space-y-1">

                <ul class="text-xs">

                    <!-- Dashboard -->
                    <li class="mb-1">
                        <a
                            href="{{ url('/') }}"
                            class="sidebar-link flex items-center gap-3 py-2.5 px-3.5 rounded-xl font-medium"
                        >
                            <i class="bi bi-grid-fill text-amber-500"></i>

                            <span>
                                ផ្ទាំងគ្រប់គ្រង
                                <span class="text-slate-400 text-[11px] font-normal">
                                    (Dashboard)
                                </span>
                            </span>
                        </a>
                    </li>

                    <!-- Customers -->
                    <li class="mb-1">
                        <a
                            href="{{ url('/customers') }}"
                            class="sidebar-link flex items-center gap-3 py-2.5 px-3.5 rounded-xl font-medium"
                        >
                            <i class="bi bi-people"></i>

                            <span>
                                អតិថិជន
                                <span class="text-slate-400 text-[11px] font-normal">
                                    (Borrowers)
                                </span>
                            </span>
                        </a>
                    </li>

                    <!-- Loans -->
                    <li class="mb-1">
                        <a
                            href="{{ url('/loans') }}"
                            class="sidebar-link flex items-center gap-3 py-2.5 px-3.5 rounded-xl font-medium"
                        >
                            <i class="bi bi-file-earmark-text"></i>

                            <span>
                                កិច្ចសន្យាបញ្ចាំ
                                <span class="text-slate-400 text-[11px] font-normal">
                                    (Pawn Loans)
                                </span>
                            </span>
                        </a>
                    </li>

                    <!-- Collaterals -->
                    <li class="mb-1">
                        <a
                            href="{{ url('/collaterals') }}"
                            class="sidebar-link flex items-center gap-3 py-2.5 px-3.5 rounded-xl font-medium"
                        >
                            <i class="bi bi-box-seam"></i>

                            <span>
                                ទ្រព្យបញ្ចាំ / ឃ្លាំង
                                <span class="text-slate-400 text-[11px] font-normal">
                                    (Collateral Vault)
                                </span>
                            </span>
                        </a>
                    </li>

                    <!-- Repayments -->
                    <li class="mb-1">
                        <a
                            href="{{ url('/repayments') }}"
                            class="sidebar-link flex items-center gap-3 py-2.5 px-3.5 rounded-xl font-medium"
                        >
                            <i class="bi bi-wallet2"></i>

                            <span>
                                ការបង់ប្រាក់ / ការរំលស់
                                <span class="text-slate-400 text-[11px] font-normal">
                                    (Repayments)
                                </span>
                            </span>
                        </a>
                    </li>

                    <!-- Reports -->
                    <li class="mb-1">
                        <a
                            href="{{ url('/reports') }}"
                            class="sidebar-link flex items-center gap-3 py-2.5 px-3.5 rounded-xl font-medium"
                        >
                            <i class="bi bi-journal-richtext"></i>

                            <span>
                                របាយការណ៍ & បោះពុម្ព
                                <span class="text-slate-400 text-[11px] font-normal">
                                    (Reports)
                                </span>
                            </span>
                        </a>
                    </li>

                    <!-- System Logs -->
                    <li class="pt-3 pb-1">
                        <span class="px-3 text-[10px] uppercase font-bold text-slate-400 tracking-wider">
                            សកម្មភាពប្រព័ន្ធ
                        </span>
                    </li>

                    <li class="mb-1">
                        <a
                            href="{{ url('/audit-logs') }}"
                            class="sidebar-link flex items-center gap-3 py-2 px-3.5 rounded-xl font-medium"
                        >
                            <i class="bi bi-card-list"></i>

                            <span>
                                កំណត់ត្រាហេតុ
                                <span class="text-slate-400 text-[11px] font-normal">
                                    (Audit Logs)
                                </span>
                            </span>
                        </a>
                    </li>

                    <!-- User Management -->
                    <li class="pt-3 pb-1">
                        <span class="px-3 text-[10px] uppercase font-bold text-slate-400 tracking-wider">
                            កំណត់ប្រព័ន្ធ
                        </span>
                    </li>

                    <li class="mb-1">
                        <a
                            href="{{ route('staff.index') }}"
                            class="sidebar-link sidebar-active flex items-center gap-3 py-2 px-3.5 rounded-xl font-medium"
                        >
                            <i class="bi bi-person"></i>

                            <span>
                                អ្នកប្រើប្រាស់
                                <span class="text-slate-400 text-[11px] font-normal">
                                    (Users)
                                </span>
                            </span>
                        </a>
                    </li>

                    <!-- Roles -->
                    <li class="mb-1">
                        <a
                            href="{{ url('/roles') }}"
                            class="sidebar-link flex items-center gap-3 py-2 px-3.5 rounded-xl font-medium"
                        >
                            <i class="bi bi-shield-check"></i>

                            <span>
                                តួនាទី
                                <span class="text-slate-400 text-[11px] font-normal">
                                    (Roles & Permissions)
                                </span>
                            </span>
                        </a>
                    </li>

                </ul>

            </nav>

        </div>

        <!-- Sidebar Footer -->
        <div class="space-y-3 pt-3 border-t border-slate-100">

            <!-- Status -->
            <div class="flex items-center justify-between text-xs">

                <button
                    onclick="window.location.reload()"
                    class="flex items-center gap-2 py-1.5 px-3 rounded-lg bg-slate-100 text-slate-600 hover:bg-slate-200 transition-colors font-medium"
                >
                    <i class="bi bi-arrow-clockwise"></i>
                    <span>ផ្ទុកឡើងវិញ</span>
                </button>

                <div class="flex items-center gap-1.5 py-1.5 px-2.5 rounded-lg bg-amber-100 text-amber-700 font-bold text-[11px]">

                    <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>

                    <span>VAULT ONLINE</span>

                </div>

            </div>

            <!-- Profile -->
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

                <!-- FIXED LOGOUT -->
                <form
                    method="POST"
                    action="{{ route('logout') }}"
                    class="inline shrink-0"
                >
                    @csrf

                    <button
                        type="submit"
                        title="Sign Out"
                        class="text-slate-400 hover:text-rose-500 transition-colors p-1"
                    >
                        <i class="bi bi-box-arrow-right text-base"></i>
                    </button>

                </form>

            </div>

        </div>

    </aside>


    <!-- =========================================================
         MAIN WORKSPACE
    ========================================================== -->

    <div class="flex-1 flex flex-col overflow-hidden">

        <!-- Header -->
        <header class="h-14 flex items-center justify-between z-10 mb-2 px-1">

            <div class="flex items-center gap-3">

                <!-- Mobile Menu -->
                <button
                    onclick="toggleSidebar()"
                    class="md:hidden text-slate-600 hover:text-slate-900 p-1"
                >
                    <i class="bi bi-list text-2xl"></i>
                </button>

                <!-- Page Badge -->
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-amber-100/60 border border-amber-200/50 text-amber-800 font-bold text-xs">

                    <span>SYSTEM DASHBOARD</span>

                    <span class="text-amber-500">//</span>

                    <span class="font-normal text-slate-700">
                        បញ្ជីបុគ្គលិក (Staff)
                    </span>

                </div>

            </div>

            <!-- Header Actions -->
            <div class="flex items-center gap-2">

                <!-- Search -->
                <div class="relative hidden sm:block">

                    <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>

                    <input
                        type="text"
                        placeholder="ស្វែងរកកិច្ចសន្យា, អតិថិជន..."
                        class="w-56 lg:w-72 pl-8 pr-4 py-1.5 rounded-xl bg-white border border-slate-200/80 focus:outline-none focus:border-amber-400 text-xs text-slate-800 placeholder:text-slate-400 transition-all shadow-sm"
                    >

                </div>

                <!-- Currency -->
                <div class="relative hidden sm:block">

                    <select
                        class="appearance-none bg-white border border-slate-200/80 text-xs font-semibold text-slate-700 py-1.5 pl-3 pr-7 rounded-xl focus:outline-none focus:border-amber-400 cursor-pointer shadow-sm"
                    >
                        <option value="USD">USD ($)</option>
                        <option value="KHR">KHR (៛)</option>
                    </select>

                    <i class="bi bi-chevron-down absolute right-2.5 top-1/2 -translate-y-1/2 text-[10px] text-slate-400 pointer-events-none"></i>

                </div>

                <!-- Theme -->
                <button
                    title="Toggle Theme"
                    class="w-8 h-8 rounded-xl bg-white border border-slate-200/80 flex items-center justify-center text-slate-500 hover:bg-slate-50 shadow-sm transition-all"
                >
                    <i class="bi bi-moon text-xs"></i>
                </button>

                <!-- Language -->
                <button
                    class="flex items-center gap-1 px-2.5 py-1.5 rounded-xl bg-white border border-slate-200/80 text-slate-700 font-semibold text-xs shadow-sm hover:bg-slate-50 transition-colors"
                >
                    <span class="text-[11px]">EN</span>
                </button>

                <!-- Security -->
                <button
                    class="w-8 h-8 rounded-xl bg-amber-500 text-white flex items-center justify-center shadow-sm hover:bg-amber-600 transition-all"
                >
                    <i class="bi bi-shield-lock-fill text-xs"></i>
                </button>

            </div>

        </header>


        <!-- =====================================================
             CONTENT
        ====================================================== -->

        <main class="flex-1 overflow-y-auto pr-1">

            <div class="w-full max-w-7xl mx-auto py-4 px-2 sm:px-4">

                <!-- Content Header -->
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">

                    <div>

                        <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">
                            Team Directory
                        </h2>

                        <p class="text-slate-500 text-sm mt-1">
                            Manage system personnel, roles, and department status.
                        </p>

                    </div>

                    <div class="flex flex-col sm:flex-row items-center gap-3">

                        <!-- Search Form -->
                        <form
                            method="GET"
                            action="{{ route('staff.index') }}"
                            class="relative w-full sm:w-72"
                        >

                            <i class="bi bi-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>

                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Search staff members..."
                                class="w-full pl-11 pr-4 py-2.5 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all outline-none text-sm text-slate-800 placeholder-slate-400 shadow-sm"
                            >

                        </form>

                        <!-- Add Staff -->
                        <a
                            href="{{ route('staff.create') }}"
                            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-amber-500 hover:bg-amber-600 text-white px-5 py-2.5 rounded-xl text-sm font-bold transition-all shadow-sm active:scale-95 whitespace-nowrap"
                        >
                            <i class="bi bi-person-plus-fill"></i>
                            Add Staff
                        </a>

                    </div>

                </div>


                <!-- =================================================
                     DATA TABLE
                ================================================== -->

                <div class="dashboard-card overflow-hidden">

                    <div class="overflow-x-auto">

                        <table class="min-w-full divide-y divide-slate-100">

                            <!-- Table Header -->
                            <thead class="bg-slate-50/50">

                                <tr>

                                    <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-wider text-slate-500">
                                        Member
                                    </th>

                                    <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-wider text-slate-500">
                                        Position
                                    </th>

                                    <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-wider text-slate-500">
                                        Department
                                    </th>

                                    <th class="px-6 py-4 text-left text-[11px] font-bold uppercase tracking-wider text-slate-500">
                                        Status
                                    </th>

                                    <th class="px-6 py-4 text-right text-[11px] font-bold uppercase tracking-wider text-slate-500">
                                        Actions
                                    </th>

                                </tr>

                            </thead>


                            <!-- Table Body -->
                            <tbody class="divide-y divide-slate-100/60 bg-white">

                                @forelse($staff as $s)

                                    <tr class="hover:bg-amber-50/40 transition-colors group">

                                        <!-- Member -->
                                        <td class="px-6 py-4 whitespace-nowrap">

                                            <div class="flex items-center gap-3.5">

                                                <div class="h-10 w-10 rounded-xl bg-amber-100/80 border border-amber-200/50 flex items-center justify-center text-amber-700 font-bold text-xs tracking-wider">
                                                    {{ strtoupper(substr($s->name, 0, 2)) }}
                                                </div>

                                                <div>

                                                    <div class="font-bold text-slate-800 text-sm tracking-tight">
                                                        {{ $s->name }}
                                                    </div>

                                                    @if(!empty($s->email))
                                                        <div class="text-[11px] text-slate-400 mt-0.5">
                                                            {{ $s->email }}
                                                        </div>
                                                    @endif

                                                </div>

                                            </div>

                                        </td>


                                        <!-- Position -->
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 font-medium">
                                            {{ $s->position }}
                                        </td>


                                        <!-- Department -->
                                        <td class="px-6 py-4 whitespace-nowrap">

                                            <span class="px-2.5 py-1 rounded-md bg-slate-50 text-slate-600 text-[11px] font-bold uppercase tracking-wider border border-slate-200">
                                                {{ $s->department }}
                                            </span>

                                        </td>


                                        <!-- Status -->
                                        <td class="px-6 py-4 whitespace-nowrap">

                                            @if($s->status === 'active')

                                                <span class="inline-flex items-center gap-1.5 py-1 px-2.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200/60">

                                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>

                                                    Active

                                                </span>

                                            @elseif($s->status === 'leave')

                                                <span class="inline-flex items-center gap-1.5 py-1 px-2.5 rounded-full text-xs font-bold bg-slate-100 text-slate-600 border border-slate-200">

                                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>

                                                    Leave

                                                </span>

                                            @else

                                                <span class="inline-flex items-center gap-1.5 py-1 px-2.5 rounded-full text-xs font-bold bg-rose-50 text-rose-700 border border-rose-200">

                                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>

                                                    {{ ucfirst($s->status) }}

                                                </span>

                                            @endif

                                        </td>


                                        <!-- Actions -->
                                        <td class="px-6 py-4 whitespace-nowrap text-right">

                                            <div class="flex justify-end gap-1.5 opacity-0 group-hover:opacity-100 transition-all transform translate-x-1 group-hover:translate-x-0">

                                                <!-- View -->
                                                <a
                                                    href="{{ route('staff.show', $s->id) }}"
                                                    class="p-2 text-slate-400 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition-all"
                                                    title="View Profile"
                                                >
                                                    <i class="bi bi-eye"></i>
                                                </a>

                                                <!-- Edit -->
                                                <a
                                                    href="{{ route('staff.edit', $s->id) }}"
                                                    class="p-2 text-slate-400 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition-all"
                                                    title="Edit"
                                                >
                                                    <i class="bi bi-pencil"></i>
                                                </a>

                                                <!-- Delete -->
                                                <form
                                                    method="POST"
                                                    action="{{ route('staff.destroy', $s->id) }}"
                                                    class="inline"
                                                >

                                                    @csrf
                                                    @method('DELETE')

                                                    <button
                                                        type="submit"
                                                        class="p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-all"
                                                        onclick="return confirm('Are you sure you want to delete this staff member?')"
                                                        title="Delete"
                                                    >
                                                        <i class="bi bi-trash"></i>
                                                    </button>

                                                </form>

                                            </div>

                                        </td>

                                    </tr>

                                @empty

                                    <!-- Empty State -->
                                    <tr>

                                        <td colspan="5" class="px-6 py-14 text-center">

                                            <div class="flex flex-col items-center justify-center">

                                                <div class="w-16 h-16 rounded-2xl bg-slate-100 flex items-center justify-center mb-4">
                                                    <i class="bi bi-people text-3xl text-slate-400"></i>
                                                </div>

                                                <h3 class="text-sm font-bold text-slate-700">
                                                    No staff members found
                                                </h3>

                                                <p class="text-xs text-slate-400 mt-1 max-w-sm">
                                                    @if(request('search'))
                                                        No staff members match "{{ request('search') }}".
                                                    @else
                                                        There are currently no staff members in the system.
                                                    @endif
                                                </p>

                                                @if(request('search'))

                                                    <a
                                                        href="{{ route('staff.index') }}"
                                                        class="mt-4 inline-flex items-center gap-2 px-4 py-2 rounded-xl border border-slate-200 bg-white text-slate-600 hover:bg-slate-50 text-xs font-bold shadow-sm"
                                                    >
                                                        <i class="bi bi-arrow-counterclockwise"></i>
                                                        Clear Search
                                                    </a>

                                                @else

                                                    <a
                                                        href="{{ route('staff.create') }}"
                                                        class="mt-4 inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-amber-500 hover:bg-amber-600 text-white text-xs font-bold shadow-sm"
                                                    >
                                                        <i class="bi bi-person-plus"></i>
                                                        Add Staff
                                                    </a>

                                                @endif

                                            </div>

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>


                    <!-- Pagination -->
                    @if($staff->hasPages())

                        <div class="px-6 py-4 bg-slate-50/30 border-t border-slate-100 pagination-wrapper">

                            {{ $staff->withQueryString()->links() }}

                        </div>

                    @endif

                </div>


                <!-- Footer -->
                <p class="text-center mt-6 text-slate-400 text-xs font-medium">
                    PAWNDESK System Registry &bull; Authorization level required.
                </p>

            </div>

        </main>

    </div>

</div>


<!-- =============================================================
     JAVASCRIPT
============================================================= -->

<script>

    /* =========================================================
       Sidebar Active Route Highlighter
    ========================================================== */

    document.addEventListener("DOMContentLoaded", function () {

        const currentPath = window.location.pathname;

        const menuLinks = document.querySelectorAll(
            "nav .sidebar-link"
        );

        menuLinks.forEach(function (link) {

            link.classList.remove("sidebar-active");

            const linkHref = link.getAttribute("href");

            if (linkHref && linkHref !== "#") {

                try {

                    // FIXED: new URL()
                    const linkPath = new URL(
                        linkHref,
                        window.location.origin
                    ).pathname;

                    if (
                        currentPath === linkPath ||
                        (
                            linkPath !== '/' &&
                            currentPath.startsWith(linkPath)
                        )
                    ) {

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


    /* =========================================================
       Mobile Sidebar
    ========================================================== */

    function toggleSidebar() {

        const sidebar =
            document.getElementById('sidebar');

        const backdrop =
            document.getElementById('sidebar-backdrop');

        sidebar.classList.toggle('-translate-x-full');

        backdrop.classList.toggle('hidden');

    }


    /* =========================================================
       Close Sidebar When Clicking Backdrop
    ========================================================== */

    document
        .getElementById('sidebar-backdrop')
        ?.addEventListener('click', function () {

            const sidebar =
                document.getElementById('sidebar');

            const backdrop = this;

            sidebar.classList.add('-translate-x-full');

            backdrop.classList.add('hidden');

        });

</script>

</body>
</html>