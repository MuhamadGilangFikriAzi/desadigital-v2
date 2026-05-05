<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Desa Digital</title>
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
            <a href="{{ route('profiledesaindex') }}" class="inline-flex items-center gap-3 mb-6">
                <img src="{{ asset('assets/logo-desadigital.svg') }}" alt="Desa Digital" class="w-10 h-10">
                <span class="text-white font-bold text-2xl">Desa Digital</span>
            </a>
        </div>

        {{-- Card --}}
        <div class="bg-white rounded-3xl shadow-2xl shadow-black/20 overflow-hidden">
            {{-- Header --}}
            <div class="bg-gradient-to-r from-blue-600 to-cyan-600 px-8 py-6 text-center">
                <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mx-auto mb-3">
                    <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </div>
                <h2 class="text-white text-xl font-bold">Selamat Datang Kembali</h2>
                <p class="text-blue-100 text-sm mt-1">Masuk ke akun Anda</p>
            </div>

            {{-- Form --}}
            <div class="px-8 py-8">
                <form method="POST" action="{{ route('login') }}">
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

                    {{-- Password --}}
                    <div class="mb-2">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1.5">Password</label>
                        <div class="flex items-stretch border border-gray-300 rounded-xl focus-within:border-blue-500 focus-within:ring-2 focus-within:ring-blue-200 transition">
                            <div class="flex items-center justify-center w-12 text-gray-400 bg-gray-50 rounded-l-xl shrink-0">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            </div>
                            <input id="password" type="password"
                                class="flex-1 px-4 py-3 outline-none"
                                name="password" placeholder="Masukkan password" required>
                            <button type="button" id="togglePassword"
                                class="flex items-center justify-center w-12 text-gray-400 hover:text-blue-600 transition hover:bg-blue-50 rounded-r-xl shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Lupa Password --}}
                    <div class="text-right mb-2">
                        <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium transition hover:underline">
                            Lupa Password?
                        </a>
                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-200 hover:shadow-lg hover:shadow-blue-500/25 active:scale-[0.98] mt-6 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                        Masuk
                    </button>
                </form>

                {{-- Register --}}
                <div class="text-center mt-6 pt-6 border-t border-gray-100">
                    @if (Route::has('register'))
                        <p class="text-gray-500 text-sm">
                            Belum punya akun?
                            <a href="{{ route('register') }}" class="text-blue-600 font-semibold hover:text-blue-800 transition">Daftar Sekarang</a>
                        </p>
                    @endif
                    <a href="{{ route('profiledesaindex') }}" class="inline-flex items-center gap-1 text-gray-400 text-xs mt-3 hover:text-gray-600 transition">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <p class="text-center text-gray-500 text-xs mt-6">
            &copy; {{ date('Y') }} Desa Digital. All rights reserved.
        </p>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle password visibility
            const toggleBtn = document.getElementById('togglePassword');
            const pwInput = document.getElementById('password');
            toggleBtn.addEventListener('click', function() {
                const type = pwInput.getAttribute('type') === 'password' ? 'text' : 'password';
                pwInput.setAttribute('type', type);
                const svg = this.querySelector('svg');
                if (type === 'text') {
                    svg.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>';
                } else {
                    svg.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>';
                }
            });

            // Only numbers for NIK
            document.querySelectorAll('.onlynumber').forEach(el => {
                el.addEventListener('keyup', function() {
                    this.value = this.value.replace(/[^0-9]/g, '');
                });
            });
        });
    </script>
</body>
</html>
