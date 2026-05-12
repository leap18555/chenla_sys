<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Directory | Coastal Academic</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { 
                        brand: { 50: '#f5f7ff', 100: '#ebf0ff', 600: '#4f46e5', 700: '#4338ca', 900: '#1e1b4b' }, 
                        surface: '#f8fafc' 
                    },
                    fontFamily: { sans: ['Inter', 'sans-serif'] }
                }
            }
        }
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-surface font-sans text-slate-900 antialiased">

<nav class="bg-white border-b border-slate-200 sticky top-0 z-30 shadow-sm shadow-slate-100/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-brand-600 rounded-xl flex items-center justify-center text-white shadow-lg shadow-brand-200">
                    <i class="bi bi-people-fill"></i>
                </div>
                <span class="text-xl font-bold tracking-tight text-slate-800">Chhenla<span class="text-brand-600">Staff</span></span>
            </div>
            <a href="{{ route('staff.create') }}" class="inline-flex items-center gap-2 bg-brand-600 hover:bg-brand-700 text-white px-5 py-2.5 rounded-xl text-sm font-bold transition-all shadow-md shadow-brand-100 active:scale-95">
                <i class="bi bi-plus-lg"></i> Add Staff
            </a>
        </div>
    </div>
</nav>

<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <div class="mb-8">
        <a href="{{ route('user.dashboard') }}" class="group inline-flex items-center gap-3 text-slate-500 hover:text-brand-600 transition-all">
            <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-white border border-slate-200 shadow-sm group-hover:shadow-md group-hover:border-brand-100 group-hover:bg-brand-50 transition-all">
                <i class="bi bi-arrow-left transition-transform group-hover:-translate-x-1"></i>
            </div>
            <div class="flex flex-col">
                <span class="text-[10px] font-bold uppercase tracking-widest text-slate-400 group-hover:text-brand-500 transition-colors">Back to</span>
                <span class="text-sm font-bold text-slate-700 group-hover:text-brand-600 transition-colors">Dashboard</span>
            </div>
        </a>
    </div>

    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-10">
        <div>
            <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Team Directory</h2>
            <p class="text-slate-500 mt-1">Manage personnel, positions, and department status.</p>
        </div>
        <form method="GET" class="relative w-full md:w-96">
            <i class="bi bi-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, role, or department..."
                class="w-full pl-12 pr-4 py-3 bg-white border border-slate-200 rounded-2xl focus:ring-4 focus:ring-brand-600/5 focus:border-brand-600 transition-all outline-none text-sm shadow-sm">
        </form>
    </div>

    <div class="bg-white border border-slate-200 rounded-3xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50/50">
                    <tr>
                        <th class="px-6 py-5 text-left text-xs font-bold uppercase tracking-widest text-slate-500">Member</th>
                        <th class="px-6 py-5 text-left text-xs font-bold uppercase tracking-widest text-slate-500">Position</th>
                        <th class="px-6 py-5 text-left text-xs font-bold uppercase tracking-widest text-slate-500">Department</th>
                        <th class="px-6 py-5 text-left text-xs font-bold uppercase tracking-widest text-slate-500">Status</th>
                        <th class="px-6 py-5 text-right text-xs font-bold uppercase tracking-widest text-slate-500">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @foreach($staff as $s)
                    <tr class="hover:bg-brand-50/30 transition-colors group">
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-4">
                                <div class="h-11 w-11 rounded-2xl bg-brand-100 flex items-center justify-center text-brand-700 font-bold text-xs shadow-inner">
                                    {{ substr($s->name, 0, 2) }}
                                </div>
                                <div class="font-bold text-slate-800 text-sm tracking-tight">{{ $s->name }}</div>
                            </div>
                        </td>
                        <td class="px-6 py-5 text-sm text-slate-600 font-medium">
                            {{ $s->position }}
                        </td>
                        <td class="px-6 py-5">
                            <span class="px-3 py-1 rounded-lg bg-slate-100 text-slate-600 text-[11px] font-bold uppercase tracking-tight">{{ $s->department }}</span>
                        </td>
                        <td class="px-6 py-5">
                            @if($s->status == 'active')
                                <span class="inline-flex items-center gap-1.5 py-1 px-3 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span> Active
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 py-1 px-3 rounded-full text-xs font-bold bg-slate-100 text-slate-600">
                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span> Leave
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-5 text-right">
                            <div class="flex justify-end gap-2 opacity-0 group-hover:opacity-100 transition-all transform translate-x-2 group-hover:translate-x-0">
                                <a href="{{ route('staff.show',$s->id) }}" class="p-2.5 text-slate-400 hover:text-brand-600 hover:bg-white rounded-xl shadow-sm transition-all border border-transparent hover:border-slate-100" title="View Profile"><i class="bi bi-eye"></i></a>
                                <a href="{{ route('staff.edit',$s->id) }}" class="p-2.5 text-slate-400 hover:text-brand-600 hover:bg-white rounded-xl shadow-sm transition-all border border-transparent hover:border-slate-100" title="Edit"><i class="bi bi-pencil"></i></a>
                                <form method="POST" action="{{ route('staff.destroy',$s->id) }}" class="inline">
                                    @csrf @method('DELETE')
                                    <button class="p-2.5 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-xl transition-all border border-transparent hover:border-red-100" onclick="return confirm('Delete this record?')" title="Delete"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="px-6 py-5 bg-slate-50/50 border-t border-slate-100">
             {{ $staff->links() }}
        </div>
    </div>

    <div class="mt-12 flex justify-center">
        <a href="{{ route('user.dashboard') }}" class="group flex items-center gap-2 text-slate-400 hover:text-slate-600 transition-all text-sm font-medium">
            <i class="bi bi-grid-fill opacity-50 group-hover:opacity-100 transition-opacity"></i>
            Dashboard Overview
        </a>
    </div>
</main>
</body>
</html>