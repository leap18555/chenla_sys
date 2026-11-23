@extends('layouts.master')

@section('header_title', 'កែប្រែព័ត៌មាន (Edit Profile)')
@section('title', 'កែប្រែព័ត៌មានគណនី | ' . ($user->name ?? 'Edit Profile'))

@section('content')

@php
    $avatar = $user->avatar_url ?? (!empty($user->avatar) ? asset('storage/' . ltrim($user->avatar, '/')) : asset('images/default-avatar.png'));
    $fallbackAvatar = 'https://ui-avatars.com/api/?name=' . urlencode($user->name ?? 'User') . '&background=0F4C5C&color=ffffff&bold=true';
    $userIdFormatted = '#USR-' . str_pad($user->id ?? 1, 5, '0', STR_PAD_LEFT);
@endphp

<div class="relative min-h-screen py-6 px-3 sm:px-6 lg:px-8 space-y-6">

    {{-- AMBIENT BRAND LIGHTING --}}
    <div class="pointer-events-none fixed -top-24 -left-24 w-96 h-96 rounded-full bg-[#0F4C5C]/10 blur-3xl -z-10"></div>
    <div class="pointer-events-none fixed -bottom-24 -right-24 w-96 h-96 rounded-full bg-[#10B981]/10 blur-3xl -z-10"></div>

    <div class="max-w-5xl mx-auto space-y-6">

        {{-- BREADCRUMB & BACK ACTION --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-white/70 backdrop-blur-md border border-slate-200/80 rounded-2xl px-5 py-3.5 shadow-xs">
            <nav class="flex items-center gap-2 text-xs font-medium text-slate-500">
                <a href="{{ route('home') }}" class="hover:text-[#0B2B40] transition-colors flex items-center gap-1.5">
                    <i class="bi bi-house-door-fill text-slate-400"></i>
                    <span>ទំព័រដើម</span>
                </a>
                <span class="text-slate-300">/</span>
                <a href="{{ route('profile.show') }}" class="hover:text-[#0B2B40] transition-colors">
                    <span>ព័ត៌មានរូបរាងកាយ</span>
                </a>
                <span class="text-slate-300">/</span>
                <span class="font-bold text-[#0F4C5C] flex items-center gap-1">
                    <i class="bi bi-pencil-square"></i>
                    <span>កែប្រែព័ត៌មាន (Edit Profile)</span>
                </span>
            </nav>

            <a
                href="{{ route('profile.show') }}"
                class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl border border-slate-200 bg-white text-xs font-semibold text-slate-700 hover:bg-slate-50 hover:border-slate-300 transition-all shadow-2xs w-fit"
            >
                <i class="bi bi-arrow-left text-xs"></i>
                <span>ត្រឡប់ទៅប្រវត្តិរូប</span>
            </a>
        </div>

        {{-- ERROR ALERT --}}
        @if ($errors->any())
            <div class="bg-red-50/90 border border-red-200 text-red-900 px-5 py-4 rounded-2xl shadow-xs animate-shake">
                <div class="flex items-center gap-2.5 mb-2 font-bold text-xs text-red-800">
                    <i class="bi bi-exclamation-triangle-fill text-red-500 text-sm"></i>
                    <span>សូមពិនិត្យមើលព័ត៌មានខាងក្រោមឡើងវិញ៖</span>
                </div>
                <ul class="text-xs space-y-1 ml-6 list-disc text-red-700/90 font-medium">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- MAIN EDIT FORM CARD --}}
        <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm overflow-hidden">

            {{-- TOP ACCENT GRADIENT BAR --}}
            <div class="h-1.5 w-full bg-gradient-to-r from-[#0B2B40] via-[#0F4C5C] to-[#10B981]"></div>

            {{-- HERO DECORATIVE BANNER --}}
            <div class="h-40 bg-gradient-to-r from-[#0B2B40] via-[#0F4C5C] to-[#134E5E] relative overflow-hidden">
                <div class="absolute inset-0 bg-[radial-gradient(#10B981_1px,transparent_1px)] [background-size:20px_20px] opacity-15"></div>
                <div class="absolute -top-12 -right-12 w-72 h-72 rounded-full bg-[#10B981]/20 blur-3xl pointer-events-none"></div>

                <div class="absolute right-8 top-1/2 -translate-y-1/2 text-white/10 pointer-events-none select-none">
                    <i class="bi bi-pencil-square text-8xl"></i>
                </div>

                <div class="absolute top-4 left-6 hidden sm:flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/15 text-white/90 text-[11px] font-semibold tracking-wider uppercase">
                    <span class="w-2 h-2 rounded-full bg-[#10B981] animate-pulse"></span>
                    <span>ការកំណត់ និងកែប្រែគណនី &bull; Profile Settings</span>
                </div>

                <div class="absolute top-4 right-6 flex items-center gap-2 px-3 py-1.5 rounded-full bg-black/25 backdrop-blur-md border border-white/10 text-white/90 text-xs font-mono font-bold tracking-wider">
                    <i class="bi bi-fingerprint text-amber-400"></i>
                    <span>{{ $userIdFormatted }}</span>
                </div>
            </div>

            <div class="p-6 sm:p-8 lg:p-10 -mt-16 relative">

                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf

                    {{-- TOP SECTION: AVATAR UPLOAD --}}
                    <div class="flex flex-col sm:flex-row items-center sm:items-start gap-6 pb-8 border-b border-slate-100">
                        
                        {{-- PROFILE IMAGE PREVIEW & UPLOAD TRIGGER --}}
                        <div class="relative shrink-0 group cursor-pointer">
                            <div class="w-32 h-32 rounded-3xl overflow-hidden border-4 border-white shadow-xl bg-slate-100 ring-2 ring-[#0F4C5C]/20 relative">
                                <img 
                                    id="avatar-preview"
                                    src="{{ $avatar }}" 
                                    alt="avatar"
                                    class="w-full h-full object-cover transition-all duration-300 group-hover:scale-105 group-hover:opacity-60"
                                    onerror="this.onerror=null; this.src='{{ $fallbackAvatar }}';"
                                >

                                {{-- UPLOAD OVERLAY --}}
                                <label for="avatar-input" class="absolute inset-0 flex flex-col items-center justify-center text-white opacity-0 group-hover:opacity-100 cursor-pointer transition-opacity duration-300 bg-[#0B2B40]/60 backdrop-blur-xs">
                                    <i class="bi bi-camera-fill text-2xl mb-1"></i>
                                    <span class="text-[10px] font-bold uppercase tracking-wider">ប្តូររូបភាព</span>
                                </label>
                            </div>

                            <input 
                                id="avatar-input"
                                type="file" 
                                name="avatar"
                                class="hidden"
                                accept="image/png,image/jpeg,image/jpg,image/webp,image/gif"
                                onchange="previewImage(event)"
                            >

                            {{-- Camera quick trigger button --}}
                            <label for="avatar-input" class="absolute -bottom-1 -right-1 w-9 h-9 rounded-full bg-[#0F4C5C] text-white border-2 border-white flex items-center justify-center cursor-pointer shadow-md hover:bg-[#0B2B40] transition-colors">
                                <i class="bi bi-camera text-sm"></i>
                            </label>
                        </div>

                        <div class="text-center sm:text-left space-y-2 pt-2">
                            <div class="flex items-center justify-center sm:justify-start gap-2">
                                <h2 class="text-lg sm:text-xl font-bold text-[#0B2B40]">
                                    កែប្រែរូបភាពគណនី (Profile Picture)
                                </h2>
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-[#0F4C5C]/10 text-[#0F4C5C]">
                                    PNG, JPG, WEBP, GIF
                                </span>
                            </div>

                            <p class="text-xs font-medium text-slate-500 max-w-lg leading-relaxed">
                                សូមជ្រើសរើសរូបថតផ្ទាល់ខ្លួនដែលមានពន្លឺច្បាស់។ ទំហំរូបភាពមិនត្រូវលើសពី <span class="text-[#0F4C5C] font-bold">10MB</span> ឡើយ។
                            </p>

                            <div id="avatar-notice" class="hidden text-xs font-semibold py-1 px-2.5 rounded-lg"></div>

                            <div class="pt-1">
                                <label for="avatar-input" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-slate-200 bg-white text-xs font-semibold text-slate-700 hover:bg-slate-50 cursor-pointer transition-colors shadow-2xs">
                                    <i class="bi bi-upload text-xs text-[#0F4C5C]"></i>
                                    <span>ជ្រើសរើសឯកសាររូបភាព...</span>
                                </label>
                            </div>
                        </div>

                    </div>

                    {{-- FORM INPUTS GRID --}}
                    <div>
                        <div class="flex items-center gap-2 mb-4 pb-2 border-b border-slate-100">
                            <i class="bi bi-person-lines-fill text-[#0F4C5C] text-sm"></i>
                            <h3 class="text-xs font-bold text-slate-800 uppercase tracking-wider">
                                ព័ត៌មានផ្ទាល់ខ្លួន និងទំនាក់ទំនង
                            </h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                            {{-- NAME --}}
                            <div>
                                <label class="block text-xs font-bold text-slate-600 mb-1.5">
                                    ឈ្មោះពេញ (Full Name) <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                        <i class="bi bi-person text-sm"></i>
                                    </div>
                                    <input 
                                        type="text"
                                        name="name"
                                        value="{{ old('name', $user->name) }}"
                                        class="w-full rounded-xl border border-slate-200 bg-slate-50/50 pl-10 pr-4 py-3 text-sm font-semibold text-slate-800 placeholder:text-slate-400 focus:bg-white focus:border-[#0F4C5C] focus:ring-4 focus:ring-[#0F4C5C]/10 outline-none transition-all"
                                        placeholder="បញ្ចូលឈ្មោះរបស់អ្នក"
                                        required
                                    >
                                </div>
                            </div>

                            {{-- EMAIL --}}
                            <div>
                                <label class="block text-xs font-bold text-slate-600 mb-1.5">
                                    អាសយដ្ឋានអ៊ីមែល (Email Address) <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                        <i class="bi bi-envelope text-sm"></i>
                                    </div>
                                    <input 
                                        type="email"
                                        name="email"
                                        value="{{ old('email', $user->email) }}"
                                        class="w-full rounded-xl border border-slate-200 bg-slate-50/50 pl-10 pr-4 py-3 text-sm font-semibold text-slate-800 placeholder:text-slate-400 focus:bg-white focus:border-[#0F4C5C] focus:ring-4 focus:ring-[#0F4C5C]/10 outline-none transition-all"
                                        placeholder="បញ្ចូលអ៊ីមែល"
                                        required
                                    >
                                </div>
                            </div>

                            {{-- PHONE --}}
                            <div>
                                <label class="block text-xs font-bold text-slate-600 mb-1.5">
                                    លេខទូរស័ព្ទ (Phone Number)
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                        <i class="bi bi-telephone text-sm"></i>
                                    </div>
                                    <input 
                                        type="text"
                                        name="phone"
                                        value="{{ old('phone', $user->phone) }}"
                                        class="w-full rounded-xl border border-slate-200 bg-slate-50/50 pl-10 pr-4 py-3 text-sm font-semibold text-slate-800 placeholder:text-slate-400 focus:bg-white focus:border-[#0F4C5C] focus:ring-4 focus:ring-[#0F4C5C]/10 outline-none transition-all"
                                        placeholder="ឧ. 012 345 678"
                                    >
                                </div>
                            </div>

                            {{-- PASSWORD --}}
                            <div>
                                <label class="block text-xs font-bold text-slate-600 mb-1.5">
                                    ពាក្យសម្ងាត់ថ្មី (New Password)
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                                        <i class="bi bi-shield-lock text-sm"></i>
                                    </div>
                                    <input 
                                        id="new-password-input"
                                        type="password"
                                        name="password"
                                        class="w-full rounded-xl border border-slate-200 bg-slate-50/50 pl-10 pr-10 py-3 text-sm font-semibold text-slate-800 placeholder:text-slate-400 focus:bg-white focus:border-[#0F4C5C] focus:ring-4 focus:ring-[#0F4C5C]/10 outline-none transition-all"
                                        placeholder="ទុកចន្លោះប្រសិនបើមិនចង់ប្តូរ"
                                    >
                                    <button 
                                        type="button" 
                                        onclick="togglePasswordVisibility()" 
                                        class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-slate-400 hover:text-slate-600"
                                        title="Show/Hide Password"
                                    >
                                        <i id="password-toggle-icon" class="bi bi-eye text-sm"></i>
                                    </button>
                                </div>
                                <span class="text-[10px] text-slate-400 mt-1 block">
                                    ទុកទទេ ប្រសិនបើលោកអ្នកមិនមានបំណងផ្លាស់ប្តូរពាក្យសម្ងាត់។
                                </span>
                            </div>

                        </div>
                    </div>

                    {{-- BIO --}}
                    <div>
                        <div class="flex items-center gap-2 mb-2 pb-2 border-b border-slate-100">
                            <i class="bi bi-card-text text-[#0F4C5C] text-sm"></i>
                            <label class="block text-xs font-bold text-slate-800 uppercase tracking-wider">
                                ពិពណ៌នាអំពីអ្នក (Bio & Professional Summary)
                            </label>
                        </div>
                        <textarea 
                            name="bio"
                            rows="4"
                            class="w-full rounded-xl border border-slate-200 bg-slate-50/50 px-4 py-3 text-sm font-medium text-slate-800 placeholder:text-slate-400 focus:bg-white focus:border-[#0F4C5C] focus:ring-4 focus:ring-[#0F4C5C]/10 outline-none transition-all resize-none leading-relaxed"
                            placeholder="សរសេរការពិពណ៌នាសង្ខេបអំពីអ្នក ឬកំណត់ត្រាផ្សេងៗ..."
                        >{{ old('bio', $user->bio) }}</textarea>
                    </div>

                    {{-- ACTION BUTTONS --}}
                    <div class="pt-6 border-t border-slate-100 flex flex-wrap items-center justify-between gap-3">
                        <a 
                            href="{{ route('profile.show') }}"
                            class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-xs font-bold text-slate-700 hover:bg-slate-50 hover:border-slate-300 transition-all shadow-2xs"
                        >
                            <i class="bi bi-x-circle text-sm"></i>
                            <span>បោះបង់ (Cancel)</span>
                        </a>

                        <button 
                            type="submit"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-[#0F4C5C] to-[#0B2B40] px-6 py-2.5 text-xs font-bold text-white shadow-sm hover:shadow-md hover:from-[#0B2B40] hover:to-[#0F4C5C] transition-all active:scale-[0.98]"
                        >
                            <i class="bi bi-check2-circle text-base"></i>
                            <span>រក្សាទុកព័ត៌មាន (Save Changes)</span>
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

{{-- SCRIPT FOR LIVE PREVIEW, CLIENT VALIDATION & PASSWORD TOGGLE --}}
<script>
    function showAvatarNotice(message, isError = true) {
        var notice = document.getElementById('avatar-notice');
        if (!notice) return;
        notice.textContent = message;
        if (isError) {
            notice.className = 'text-xs font-semibold py-1.5 px-3 rounded-xl bg-red-50 text-red-700 border border-red-200 mt-2 block';
        } else {
            notice.className = 'text-xs font-semibold py-1.5 px-3 rounded-xl bg-emerald-50 text-emerald-700 border border-emerald-200 mt-2 block';
        }
    }

    function clearAvatarNotice() {
        var notice = document.getElementById('avatar-notice');
        if (!notice) return;
        notice.textContent = '';
        notice.className = 'hidden';
    }

    function previewImage(event) {
        clearAvatarNotice();
        var input = event.target;
        if (!input.files || !input.files[0]) return;

        var file = input.files[0];
        var allowedTypes = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];

        if (!allowedTypes.includes(file.type)) {
            showAvatarNotice('សូមជ្រើសរើសឯកសាររូបភាពត្រឹមត្រូវ (JPG, PNG, WEBP, GIF)។', true);
            input.value = '';
            return;
        }

        // Limit: 10MB
        var maxBytes = 10 * 1024 * 1024;
        if (file.size > maxBytes) {
            showAvatarNotice('ទំហំរូបភាពធំពេក (' + (file.size / (1024 * 1024)).toFixed(1) + 'MB)។ កម្រិតអនុញ្ញាតខ្ពស់បំផុតគឺ 10MB។', true);
            input.value = '';
            return;
        }

        var reader = new FileReader();
        reader.onload = function(e) {
            var output = document.getElementById('avatar-preview');
            if (output) {
                output.src = e.target.result;
            }

            // If image is larger than 1.5MB, auto-compress it for smooth uploading
            if (file.size > 1.5 * 1024 * 1024 && window.HTMLCanvasElement) {
                var img = new Image();
                img.onload = function() {
                    var maxDim = 1200;
                    var width = img.width;
                    var height = img.height;

                    if (width > maxDim || height > maxDim) {
                        if (width > height) {
                            height = Math.round((height * maxDim) / width);
                            width = maxDim;
                        } else {
                            width = Math.round((width * maxDim) / height);
                            height = maxDim;
                        }
                    }

                    var canvas = document.createElement('canvas');
                    canvas.width = width;
                    canvas.height = height;
                    var ctx = canvas.getContext('2d');
                    ctx.drawImage(img, 0, 0, width, height);

                    canvas.toBlob(function(blob) {
                        if (blob && window.DataTransfer) {
                            var dt = new DataTransfer();
                            var optimizedFile = new File([blob], file.name.replace(/\.[^/.]+$/, "") + ".jpg", {
                                type: "image/jpeg",
                                lastModified: Date.now()
                            });
                            dt.items.add(optimizedFile);
                            input.files = dt.files;
                            showAvatarNotice('រូបភាពត្រូវបានបង្កើនល្បឿន និងសម្រួលទំហំរួចរាល់ (' + (optimizedFile.size / 1024).toFixed(0) + ' KB)។', false);
                        }
                    }, 'image/jpeg', 0.88);
                };
                img.src = e.target.result;
            }
        };
        reader.readAsDataURL(file);
    }

    function togglePasswordVisibility() {
        var input = document.getElementById('new-password-input');
        var icon = document.getElementById('password-toggle-icon');
        if (input && icon) {
            if (input.type === 'password') {
                input.type = 'text';
                icon.className = 'bi bi-eye-slash text-sm';
            } else {
                input.type = 'password';
                icon.className = 'bi bi-eye text-sm';
            }
        }
    }
</script>

@endsection
