<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password — Desa Digital</title>
    @vite(['resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('assets/tailwind.css') }}">
</head>
<body class="min-h-screen flex items-center justify-center p-4 bg-gradient-to-br from-slate-900 via-blue-950 to-slate-900 relative overflow-hidden">

    {{-- Decorative --}}
    <div class="absolute inset-0 overflow-hidden opacity-10 pointer-events-none">
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-blue-500 rounded-full blur-[120px]"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-cyan-500 rounded-full blur-[120px]"></div>
    </div>

    <div class="w-full max-w-md relative">
        {{-- Brand --}}
        <div class="text-center mb-8">
            <a href="{{ route('profiledesaindex') }}" class="inline-flex items-center gap-3">
                <img src="{{ asset('assets/logo-desadigital.svg') }}" alt="Desa Digital" class="w-10 h-10">
                <span class="text-white font-bold text-2xl">Desa Digital</span>
            </a>
        </div>

        {{-- Card --}}
        <div class="bg-white rounded-3xl shadow-2xl shadow-black/20 overflow-hidden">
            {{-- Header --}}
            <div class="bg-gradient-to-r from-blue-600 to-cyan-600 px-8 py-6 text-center">
                <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mx-auto mb-3">
                    <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/></svg>
                </div>
                <h2 class="text-white text-xl font-bold">Lupa Password</h2>
                <p class="text-blue-100 text-sm mt-1">Masukkan NIK dan No. WA untuk mereset password</p>
            </div>

            {{-- Form --}}
            <div class="px-8 py-8">
                {{-- Success --}}
                @if(session('success'))
                    <div class="bg-green-50 border border-green-200 rounded-xl p-4 mb-6 flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-600 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <p class="text-sm text-green-700">{{ session('success') }}</p>
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    {{-- NIK --}}
                    <div class="mb-5">
                        <label for="nik" class="block text-sm font-medium text-gray-700 mb-1.5">NIK</label>
                        <div class="flex items-stretch border border-gray-300 rounded-xl focus-within:border-blue-500 focus-within:ring-2 focus-within:ring-blue-200 transition">
                            <div class="flex items-center justify-center w-12 text-gray-400 bg-gray-50 rounded-l-xl shrink-0">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0"/></svg>
                            </div>
                            <input id="nik" type="text"
                                class="flex-1 px-4 py-3 outline-none onlynumber"
                                name="nik" placeholder="Masukkan NIK" value="{{ old('nik') }}" required maxlength="16">
                        </div>
                        @error('nik')
                            <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- No WA --}}
                    <div class="mb-2">
                        <label for="no_wa" class="block text-sm font-medium text-gray-700 mb-1.5">No. WhatsApp</label>
                        <div class="flex items-stretch border border-gray-300 rounded-xl focus-within:border-blue-500 focus-within:ring-2 focus-within:ring-blue-200 transition">
                            <div class="flex items-center justify-center w-12 text-gray-400 bg-gray-50 rounded-l-xl shrink-0">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            <input id="no_wa" type="text"
                                class="flex-1 px-4 py-3 outline-none onlynumber"
                                name="no_wa" placeholder="contoh: 6281234567890" value="{{ old('no_wa') }}" required maxlength="16">
                        </div>
                        @error('no_wa')
                            <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-200 hover:shadow-lg hover:shadow-blue-500/25 active:scale-[0.98] mt-6 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                        Kirim Kode OTP
                    </button>
                </form>

                {{-- Back --}}
                <div class="text-center mt-6 pt-6 border-t border-gray-100">
                    <a href="{{ route('login') }}" class="inline-flex items-center gap-1 text-gray-400 text-sm hover:text-gray-600 transition">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        Kembali ke Login
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.onlynumber').forEach(el => {
            el.addEventListener('keyup', function() {
                this.value = this.value.replace(/[^0-9]/g, '');
            });
        });
    </script>
</body>
</html>
