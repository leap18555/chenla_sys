<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Staff Member | Coastal Academic</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { brand: { 50: '#f5f7ff', 100: '#ebf0ff', 600: '#4f46e5', 700: '#4338ca', 900: '#1e1b4b' }, surface: '#f8fafc' },
                    fontFamily: { sans: ['Inter', 'sans-serif'] }
                }
            }
        }
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-surface font-sans text-slate-900 antialiased">

<header class="bg-white border-b border-slate-200 sticky top-0 z-30 shadow-sm shadow-slate-100/30">
    <div class="max-w-4xl mx-auto px-6 h-16 flex justify-between items-center">
        <a href="{{ route('staff.index') }}" class="group flex items-center gap-2 text-slate-500 hover:text-brand-600 transition-all">
            <div class="w-8 h-8 rounded-full flex items-center justify-center group-hover:bg-brand-50 transition-colors">
                <i class="bi bi-chevron-left text-lg"></i>
            </div>
            <span class="text-sm font-bold">Back</span>
        </a>
        <h1 class="text-sm font-black text-slate-300 uppercase tracking-[0.2em]">New Personnel Enrollment</h1>
        <div class="w-8"></div> </div>
</header>

<main class="max-w-2xl mx-auto px-6 py-12">
    <div class="bg-white border border-slate-200 rounded-[2rem] shadow-xl shadow-slate-200/40 overflow-hidden">
        
        <div class="p-10 border-b border-slate-50 bg-gradient-to-b from-slate-50/50 to-white">
            <h2 class="text-2xl font-black text-slate-900 tracking-tight">Personnel Details</h2>
            <p class="text-slate-500 text-sm mt-1">Fill in the fields below to add a member to the directory.</p>
        </div>

        <form method="POST" action="{{ route('staff.store') }}" class="p-10 space-y-8">
            @csrf

            <div class="space-y-2">
                <label class="block text-[11px] font-bold uppercase tracking-widest text-slate-400">Legal Full Name</label>
                <input type="text" name="name" value="{{ old('name') }}"
                    class="w-full px-5 py-4 rounded-2xl bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-4 focus:ring-brand-600/5 focus:border-brand-600 transition-all outline-none text-sm font-semibold"
                    placeholder="e.g. Julian Blackwood" required>
                @error('name') <p class="text-red-500 text-xs font-medium">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-2">
                    <label class="block text-[11px] font-bold uppercase tracking-widest text-slate-400">Position Title</label>
                    <div class="relative">
                        <i class="bi bi-briefcase absolute left-5 top-1/2 -translate-y-1/2 text-slate-300"></i>
                        <input type="text" name="position" value="{{ old('position') }}"
                            class="w-full pl-12 pr-5 py-4 rounded-2xl bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-4 focus:ring-brand-600/5 focus:border-brand-600 transition-all outline-none text-sm font-semibold"
                            placeholder="e.g. Professor" required>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block text-[11px] font-bold uppercase tracking-widest text-slate-400">Department</label>
                    <div class="relative">
                        <i class="bi bi-building absolute left-5 top-1/2 -translate-y-1/2 text-slate-300"></i>
                        <input type="text" name="department" value="{{ old('department') }}"
                            class="w-full pl-12 pr-5 py-4 rounded-2xl bg-slate-50/50 border border-slate-200 focus:bg-white focus:ring-4 focus:ring-brand-600/5 focus:border-brand-600 transition-all outline-none text-sm font-semibold"
                            placeholder="e.g. Science" required>
                    </div>
                </div>
            </div>

            <div class="space-y-3">
                <label class="block text-[11px] font-bold uppercase tracking-widest text-slate-400">Status Assignment</label>
                <div class="grid grid-cols-2 gap-4">
                    <label class="relative flex items-center gap-4 p-5 border border-slate-200 rounded-2xl cursor-pointer hover:bg-brand-50/50 hover:border-brand-200 transition-all group">
                        <input type="radio" name="status" value="active" class="w-5 h-5 text-brand-600 border-slate-300 focus:ring-brand-600/20" checked>
                        <div class="flex flex-col">
                            <span class="text-sm font-bold text-slate-800">Active</span>
                            <span class="text-[10px] text-slate-400 uppercase font-medium">Full Duty</span>
                        </div>
                    </label>
                    <label class="relative flex items-center gap-4 p-5 border border-slate-200 rounded-2xl cursor-pointer hover:bg-brand-50/50 hover:border-brand-200 transition-all group">
                        <input type="radio" name="status" value="leave" class="w-5 h-5 text-brand-600 border-slate-300 focus:ring-brand-600/20">
                        <div class="flex flex-col">
                            <span class="text-sm font-bold text-slate-800">Leave</span>
                            <span class="text-[10px] text-slate-400 uppercase font-medium">Sabbatical</span>
                        </div>
                    </label>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row items-center justify-between gap-6 pt-10 border-t border-slate-100">
                
                <a href="{{ route('staff.index') }}" 
                   class="flex items-center gap-2 px-5 py-3 rounded-2xl border border-slate-200 text-slate-500 font-bold text-sm hover:bg-slate-50 hover:text-slate-800 transition-all">
                    <i class="bi bi-arrow-left"></i>
                    Return to Directory
                </a>

                <button type="submit" class="w-full sm:w-auto px-10 py-4 bg-brand-600 text-white rounded-2xl font-bold text-sm hover:bg-brand-700 transition-all shadow-xl shadow-brand-200 flex items-center justify-center gap-3">
                    Save Record
                    <i class="bi bi-check-circle-fill"></i>
                </button>
            </div>
        </form>
    </div>
</main>

<footer class="py-12 text-center text-slate-400 text-[10px] tracking-[0.4em] uppercase">
    System Registry &bull; &copy; 2025
</footer>

</body>
</html>