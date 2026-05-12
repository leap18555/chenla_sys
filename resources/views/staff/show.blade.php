<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Profile | {{ $staff->name }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        sunset: '#FE725D',
                        adventure: '#233d4d',
                        surface: '#f8fafc'
                    },
                    borderRadius: {
                        'xlarge': '2rem',
                    }
                }
            }
        }
    </script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 antialiased text-slate-900">

<nav class="sticky top-0 z-50 bg-adventure/90 backdrop-blur-md text-white border-b border-white/10">
    <div class="max-w-5xl mx-auto px-6 py-4 flex justify-between items-center">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 bg-sunset rounded-lg flex items-center justify-center">
                <i class="bi bi-shield-check text-white"></i>
            </div>
            <span class="text-lg font-bold tracking-tight">StaffPortal</span>
        </div>
        <a href="{{ route('staff.index') }}" class="text-sm font-medium hover:text-sunset transition-colors flex items-center gap-2">
            <i class="bi bi-arrow-left"></i> Back to Directory
        </a>
    </div>
</nav>

<main class="max-w-4xl mx-auto px-6 py-12">
    
    <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/60 border border-slate-100 overflow-hidden">
        
        <div class="relative px-8 pt-10 pb-8 border-b border-slate-50">
            <div class="absolute top-0 right-0 p-8 opacity-5">
                <i class="bi bi-person-bounding-box text-9xl"></i>
            </div>

            <div class="relative flex flex-col md:flex-row items-center md:items-end gap-8">
                <div class="w-32 h-32 bg-gradient-to-br from-adventure to-slate-700 text-white rounded-[2rem] flex items-center justify-center text-5xl font-bold shadow-2xl shadow-adventure/30 border-4 border-white">
                    {{ substr($staff->name, 0, 1) }}
                </div>

                <div class="text-center md:text-left flex-grow pb-2">
                    <div class="flex flex-col md:flex-row md:items-center gap-3 mb-2">
                        <h1 class="text-4xl font-extrabold tracking-tight text-slate-800 leading-none">
                            {{ $staff->name }}
                        </h1>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest {{ $staff->status == 'active' ? 'bg-emerald-100 text-emerald-600' : 'bg-amber-100 text-amber-600' }}">
                            {{ $staff->status }}
                        </span>
                    </div>
                    <p class="text-lg text-slate-500 font-medium">
                        {{ $staff->position }} <span class="mx-2 text-slate-300">|</span> <span class="text-adventure">{{ $staff->department }}</span>
                    </p>
                </div>

                <div class="pb-2">
                    <a href="{{ route('staff.edit', $staff->id) }}" class="inline-flex items-center gap-2 px-6 py-3 bg-sunset hover:bg-orange-600 text-white rounded-2xl font-bold shadow-lg shadow-sunset/30 transition-all hover:scale-105 active:scale-95">
                        <i class="bi bi-pencil-square"></i> Edit Profile
                    </a>
                </div>
            </div>
        </div>

        <div class="p-8 md:p-12">
            <h3 class="text-sm font-bold text-slate-400 uppercase tracking-[0.2em] mb-8">Professional Information</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <div class="group flex items-center gap-5 p-5 rounded-3xl bg-slate-50 hover:bg-white border border-transparent hover:border-slate-100 hover:shadow-md transition-all">
                    <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-adventure shadow-sm group-hover:bg-adventure group-hover:text-white transition-colors">
                        <i class="bi bi-person-vcard text-xl"></i>
                    </div>
                    <div>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Legal Name</p>
                        <p class="text-slate-800 font-bold leading-tight">{{ $staff->name }}</p>
                    </div>
                </div>

                <div class="group flex items-center gap-5 p-5 rounded-3xl bg-slate-50 hover:bg-white border border-transparent hover:border-slate-100 hover:shadow-md transition-all">
                    <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-adventure shadow-sm group-hover:bg-adventure group-hover:text-white transition-colors">
                        <i class="bi bi-briefcase text-xl"></i>
                    </div>
                    <div>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Job Title</p>
                        <p class="text-slate-800 font-bold leading-tight">{{ $staff->position }}</p>
                    </div>
                </div>

                <div class="group flex items-center gap-5 p-5 rounded-3xl bg-slate-50 hover:bg-white border border-transparent hover:border-slate-100 hover:shadow-md transition-all">
                    <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-adventure shadow-sm group-hover:bg-adventure group-hover:text-white transition-colors">
                        <i class="bi bi-diagram-3 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Department</p>
                        <p class="text-slate-800 font-bold leading-tight">{{ $staff->department }}</p>
                    </div>
                </div>

                <div class="group flex items-center gap-5 p-5 rounded-3xl bg-slate-50 hover:bg-white border border-transparent hover:border-slate-100 hover:shadow-md transition-all">
                    <div class="w-12 h-12 bg-white rounded-2xl flex items-center justify-center text-adventure shadow-sm group-hover:bg-adventure group-hover:text-white transition-colors">
                        <i class="bi bi-calendar-event text-xl"></i>
                    </div>
                    <div>
                        <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">Onboarding Date</p>
                        <p class="text-slate-800 font-bold leading-tight">{{ $staff->created_at->format('d M Y') }}</p>
                    </div>
                </div>

            </div>

            <div class="mt-12 pt-8 border-t border-slate-100 flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="flex items-center gap-4 text-xs font-medium text-slate-400">
                    <span class="flex items-center gap-1"><i class="bi bi-fingerprint"></i> ID: {{ str_pad($staff->id, 5, '0', STR_PAD_LEFT) }}</span>
                    <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
                    <span>Last modified: {{ $staff->updated_at->diffForHumans() }}</span>
                </div>
                <div class="flex gap-4">
                    <button class="text-slate-400 hover:text-adventure transition-colors"><i class="bi bi-printer"></i></button>
                    <button class="text-slate-400 hover:text-adventure transition-colors"><i class="bi bi-share"></i></button>
                </div>
            </div>
        </div>
    </div>

    <p class="text-center mt-8 text-slate-400 text-sm">
        Confidential Employee Record — Unauthorized access is prohibited.
    </p>

</main>

</body>
</html>