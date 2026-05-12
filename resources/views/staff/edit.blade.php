<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Staff | {{ $staff->name }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        sunset: '#FE725D',
                        adventure: '#233d4d',
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

<nav class="sticky top-0 z-50 bg-adventure text-white border-b border-white/10">
    <div class="max-w-5xl mx-auto px-6 py-4 flex justify-between items-center">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 bg-sunset rounded-lg flex items-center justify-center">
                <i class="bi bi-pencil-fill text-white text-xs"></i>
            </div>
            <span class="text-lg font-bold tracking-tight">StaffPortal <span class="text-sunset">/</span> Edit Profile</span>
        </div>
        <a href="{{ route('staff.show', $staff->id) }}" class="text-sm font-medium opacity-80 hover:opacity-100 transition-opacity">
            Cancel
        </a>
    </div>
</nav>

<main class="max-w-3xl mx-auto px-6 py-12">
    
    <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/60 border border-slate-100 overflow-hidden">
        
        <div class="p-8 md:p-12">
            <header class="mb-10">
                <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight">Update Staff Details</h2>
                <p class="text-slate-500 mt-2 font-medium">Manage employment records for <span class="text-adventure font-bold">{{ $staff->name }}</span></p>
            </header>

            {{-- Error Summary --}}
            @if ($errors->any())
                <div class="mb-8 p-4 bg-red-50 border-l-4 border-red-500 rounded-xl">
                    <ul class="list-disc list-inside text-sm text-red-600 font-medium">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('staff.update', $staff->id) }}" method="POST" class="space-y-7">
                @csrf
                @method('PUT')

                {{-- Row 1: Name & Status --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label for="name" class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Full Name</label>
                        <div class="relative group">
                            <i class="bi bi-person absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-sunset transition-colors"></i>
                            <input type="text" name="name" id="name" value="{{ old('name', $staff->name) }}" required
                                class="w-full pl-12 pr-4 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-sunset/10 focus:border-sunset focus:bg-white outline-none transition-all font-bold text-slate-700">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="status" class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Account Status</label>
                        <div class="relative group">
                            <i class="bi bi-shield-check absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-sunset transition-colors"></i>
                            <select name="status" id="status" required
                                class="w-full pl-12 pr-4 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-sunset/10 focus:border-sunset focus:bg-white outline-none transition-all font-bold text-slate-700 appearance-none">
                                <option value="active" {{ (old('status', $staff->status) == 'active') ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ (old('status', $staff->status) == 'inactive') ? 'selected' : '' }}>Inactive</option>
                            </select>
                            <i class="bi bi-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none text-xs"></i>
                        </div>
                    </div>
                </div>

                {{-- Row 2: Position & Department --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label for="position" class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Job Title</label>
                        <div class="relative group">
                            <i class="bi bi-briefcase absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-sunset transition-colors"></i>
                            <input type="text" name="position" id="position" value="{{ old('position', $staff->position) }}" required
                                class="w-full pl-12 pr-4 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-sunset/10 focus:border-sunset focus:bg-white outline-none transition-all font-bold text-slate-700">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label for="department" class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Department</label>
                        <div class="relative group">
                            <i class="bi bi-building absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-sunset transition-colors"></i>
                            <input type="text" name="department" id="department" value="{{ old('department', $staff->department) }}" required
                                class="w-full pl-12 pr-4 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-sunset/10 focus:border-sunset focus:bg-white outline-none transition-all font-bold text-slate-700">
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="pt-10 flex flex-col md:flex-row items-center justify-between gap-6">
                    <a href="{{ route('staff.show', $staff->id) }}" class="text-slate-400 font-bold hover:text-slate-600 transition-colors flex items-center gap-2">
                        <i class="bi bi-arrow-left text-sm"></i> Return without saving
                    </a>
                    
                    <button type="submit" class="w-full md:w-auto px-12 py-5 bg-sunset text-white rounded-[1.5rem] font-black shadow-xl shadow-sunset/30 hover:bg-orange-600 transition-all hover:-translate-y-1 active:scale-95 flex items-center justify-center gap-3">
                        <i class="bi bi-cloud-arrow-up-fill text-xl"></i> Update Profile
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

</body>
</html>