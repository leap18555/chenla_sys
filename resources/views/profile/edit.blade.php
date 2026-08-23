@extends('layouts.master')

@section('header_title', 'កែប្រែព័ត៌មាន (Edit Profile)')

@section('content')

<div class="py-6 px-2 sm:px-4 max-w-5xl mx-auto space-y-6">

    {{-- ERROR MESSAGE --}}
    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-800 px-5 py-4 rounded-2xl shadow-sm mb-6">
            <div class="flex items-center gap-2 mb-2 font-bold text-sm">
                <i class="bi bi-exclamation-triangle-fill text-red-500"></i>
                សូមពិនិត្យមើលព័ត៌មានខាងក្រោមឡើងវិញ៖
            </div>
            <ul class="text-xs space-y-1.5 ml-6 list-disc text-red-600/80 font-medium">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- MAIN EDIT FORM CARD --}}
    <div class="bg-white rounded-3xl border border-slate-200/70 shadow-sm overflow-hidden">

        {{-- HERO DECORATIVE BANNER --}}
        <div class="h-32 bg-gradient-to-r from-slate-900 via-slate-800 to-amber-950 relative overflow-hidden">
            <div class="absolute inset-0 bg-[radial-gradient(#f59e0b_1px,transparent_1px)] [background-size:16px_16px] opacity-10"></div>
            <div class="absolute right-6 top-1/2 -translate-y-1/2 text-white/5 pointer-events-none">
                <i class="bi bi-pencil-square text-8xl"></i>
            </div>
        </div>

        <div class="p-6 sm:p-8 lg:p-10 -mt-16 relative">

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- បានលុប @method('PUT') ចេញនៅទីនេះ ដើម្បីឱ្យត្រូវជាមួយ Route::post --}}

                {{-- TOP SECTION: AVATAR --}}
                <div class="flex flex-col sm:flex-row items-start gap-6 pb-8 border-b border-slate-100 mb-8">
                    
                    {{-- PROFILE IMAGE UPLOAD --}}
                    <div class="relative shrink-0 group">
                        
                        <div class="w-28 h-28 rounded-2xl overflow-hidden border-4 border-white shadow-md bg-slate-100 ring-1 ring-slate-200/80 relative">
                            @php
                                $avatar = $user->avatar_url 
                                    ? asset('storage/customers/' . basename($user->avatar_url)) 
                                    : asset('images/default-avatar.png');
                                $fallbackAvatar = 'https://ui-avatars.com/api/?name=' . urlencode($user->name ?? 'User') . '&background=f59e0b&color=ffffff&bold=true';
                            @endphp

                            <img 
                                id="avatar-preview"
                                src="{{ $avatar }}" 
                                alt="avatar"
                                class="w-full h-full object-cover transition-opacity duration-300 group-hover:opacity-40"
                                onerror="this.onerror=null; this.src='{{ $fallbackAvatar }}';"
                            >

                            {{-- UPLOAD OVERLAY --}}
                            <label class="absolute inset-0 flex flex-col items-center justify-center text-slate-900 opacity-0 group-hover:opacity-100 cursor-pointer transition-opacity duration-300 bg-white/40 backdrop-blur-sm">
                                <i class="bi bi-camera-fill text-2xl mb-1"></i>
                                <span class="text-[10px] font-bold uppercase tracking-wider">Change</span>
                                <input 
                                    type="file" 
                                    name="avatar"
                                    class="hidden"
                                    accept="image/*"
                                    onchange="previewImage(event)"
                                >
                            </label>
                        </div>

                    </div>

                    <div class="pt-16 sm:pt-4 space-y-1">
                        <h2 class="text-xl font-bold text-slate-900 tracking-tight">កែប្រែរូបភាពគណនី</h2>
                        <p class="text-xs font-medium text-slate-500">
                            ទំហំរូបភាពមិនគួរលើសពី 2MB ឡើយ។ (Format: JPG, PNG, WEBP)
                        </p>
                    </div>

                </div>

                {{-- FORM GRID --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- NAME --}}
                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-2">
                            ឈ្មោះពេញ (Full Name) <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text"
                            name="name"
                            value="{{ old('name', $user->name) }}"
                            class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-3 text-sm font-medium text-slate-900 focus:bg-white focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20 outline-none transition-all"
                            placeholder="បញ្ចូលឈ្មោះរបស់អ្នក"
                            required
                        >
                    </div>

                    {{-- EMAIL --}}
                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-2">
                            អ៊ីមែល (Email Address) <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="email"
                            name="email"
                            value="{{ old('email', $user->email) }}"
                            class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-3 text-sm font-medium text-slate-900 focus:bg-white focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20 outline-none transition-all"
                            placeholder="បញ្ចូលអ៊ីមែល"
                            required
                        >
                    </div>

                    {{-- PHONE --}}
                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-2">
                            លេខទូរស័ព្ទ (Phone Number)
                        </label>
                        <input 
                            type="text"
                            name="phone"
                            value="{{ old('phone', $user->phone) }}"
                            class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-3 text-sm font-medium text-slate-900 focus:bg-white focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20 outline-none transition-all"
                            placeholder="បញ្ចូលលេខទូរស័ព្ទ"
                        >
                    </div>

                    {{-- PASSWORD --}}
                    <div>
                        <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-2">
                            ពាក្យសម្ងាត់ថ្មី (New Password)
                        </label>
                        <input 
                            type="password"
                            name="password"
                            class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-3 text-sm font-medium text-slate-900 focus:bg-white focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20 outline-none transition-all placeholder:font-normal"
                            placeholder="ទុកចន្លោះប្រសិនបើមិនចង់ប្តូរ"
                        >
                    </div>

                </div>

                {{-- BIO --}}
                <div class="mt-6">
                    <label class="block text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-2">
                        ពិពណ៌នាអំពីអ្នក (Bio)
                    </label>
                    <textarea 
                        name="bio"
                        rows="4"
                        class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-3 text-sm font-medium text-slate-900 focus:bg-white focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20 outline-none transition-all resize-none"
                        placeholder="សរសេរអ្វីមួយអំពីអ្នក..."
                    >{{ old('bio', $user->bio) }}</textarea>
                </div>

                {{-- ACTION BUTTONS --}}
                <div class="mt-8 pt-6 border-t border-slate-100 flex flex-wrap items-center gap-3">
                    
                    {{-- CANCEL BUTTON --}}
                    <a 
                        href="{{ route('profile.show') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-6 py-2.5 text-xs font-bold text-slate-700 hover:bg-slate-50 hover:border-slate-300 transition-all shadow-sm"
                    >
                        <i class="bi bi-arrow-left text-sm"></i>
                        <span>បោះបង់ (Cancel)</span>
                    </a>

                    {{-- SAVE BUTTON --}}
                    <button 
                        type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-900 px-6 py-2.5 text-xs font-bold text-white hover:bg-slate-800 transition-all shadow-sm"
                    >
                        <i class="bi bi-check2-circle text-sm"></i>
                        <span>រក្សាទុកព័ត៌មាន (Save Changes)</span>
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>

{{-- SCRIPT សម្រាប់ LIVE PREVIEW រូបភាព --}}
<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('avatar-preview');
            output.src = reader.result;
        }
        if(event.target.files[0]) {
            reader.readAsDataURL(event.target.files[0]);
        }
    }
</script>

@endsection