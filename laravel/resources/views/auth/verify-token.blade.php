<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Token — Desa Digital</title>
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
                    <svg class="w-7 h-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <h2 class="text-white text-xl font-bold">Verifikasi Token</h2>
                <p class="text-blue-100 text-sm mt-1">Masukkan kode OTP 6 digit yang dikirim ke WA Anda</p>
            </div>

            {{-- Form --}}
            <div class="px-8 py-8">
                @if(session('error'))
                    <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-6 flex items-start gap-3">
                        <svg class="w-5 h-5 text-red-600 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <p class="text-sm text-red-700">{{ session('error') }}</p>
                    </div>
                @endif

                <form method="POST" action="{{ route('password.verify') }}">
                    @csrf

                    <div class="mb-5">
                        <label for="token" class="block text-sm font-medium text-gray-700 mb-1.5">Kode Token</label>
                        <input id="token" type="text"
                            class="w-full text-center text-2xl font-bold tracking-[0.5em] py-4 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition onlynumber"
                            name="token" placeholder="• • • • • •" required maxlength="6" inputmode="numeric" autocomplete="one-time-code">
                        @error('token')
                            <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="w-full bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white font-semibold py-3 px-4 rounded-xl transition-all duration-200 hover:shadow-lg hover:shadow-blue-500/25 active:scale-[0.98] flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        Verifikasi Token
                    </button>
                </form>

                {{-- Back --}}
                <div class="text-center mt-6 pt-6 border-t border-gray-100">
                    <a href="{{ route('password.request') }}" class="inline-flex items-center gap-1 text-gray-400 text-sm hover:text-gray-600 transition">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        Kirim Ulang Token
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.onlynumber').forEach(el => {
            el.addEventListener('keyup', function() { this.value = this.value.replace(/[^0-9]/g, ''); });
        });
    </script>
</body>
</html>
