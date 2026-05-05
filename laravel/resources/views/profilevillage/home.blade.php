@extends('layouts.app_front')

@section('content')
{{-- ===== HERO SECTION ===== --}}
<section class="relative bg-gradient-to-br from-blue-900 via-blue-800 to-cyan-700 text-white overflow-hidden">
    {{-- Decorative elements --}}
    <div class="absolute inset-0 overflow-hidden opacity-20">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-white rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-cyan-300 rounded-full blur-3xl"></div>
    </div>
    <div class="relative container mx-auto px-4 py-20 md:py-32">
        <div class="max-w-3xl mx-auto text-center">
            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm rounded-full px-4 py-1.5 text-sm mb-6 border border-white/20">
                <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                Sistem Informasi Desa
            </div>
            <h1 class="text-4xl md:text-6xl font-bold leading-tight mb-6">
                Selamat Datang di
                <span class="bg-gradient-to-r from-cyan-300 to-blue-200 text-transparent bg-clip-text">Desa Digital</span>
            </h1>
            <p class="text-lg md:text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                Portal layanan masyarakat yang terintegrasi — memudahkan akses informasi, administrasi, dan pelayanan desa secara online.
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="#layanan" class="inline-flex items-center gap-2 bg-white text-blue-900 font-semibold px-6 py-3 rounded-xl hover:bg-blue-50 transition shadow-lg hover:shadow-xl">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    Layanan Desa
                </a>
                <a href="#berita" class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/30 text-white font-semibold px-6 py-3 rounded-xl hover:bg-white/20 transition">
                    Berita Terbaru
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </a>
            </div>
        </div>
    </div>
    {{-- Wave divider --}}
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 60V30C240 0 480 0 720 30C960 60 1200 60 1440 30V60H0Z" fill="#f9fafb"/></svg>
    </div>
</section>

{{-- ===== STATISTIK ===== --}}
<section class="bg-gray-50 py-12 md:py-16 -mt-1">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
            <div class="bg-white rounded-2xl p-6 text-center shadow-sm hover:shadow-md transition border border-gray-100">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <div class="text-3xl font-bold text-gray-800">{{ number_format($jumlahPenduduk, 0, ',', '.') }}</div>
                <div class="text-sm text-gray-500 mt-1">Penduduk</div>
            </div>
            <div class="bg-white rounded-2xl p-6 text-center shadow-sm hover:shadow-md transition border border-gray-100">
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                </div>
                <div class="text-3xl font-bold text-gray-800">{{ number_format($jumlahKK, 0, ',', '.') }}</div>
                <div class="text-sm text-gray-500 mt-1">Kepala Keluarga</div>
            </div>
            <div class="bg-white rounded-2xl p-6 text-center shadow-sm hover:shadow-md transition border border-gray-100">
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                <div class="text-3xl font-bold text-gray-800">{{ $jumlahSekolahNegri + $jumlahSekolahSwasta }}</div>
                <div class="text-sm text-gray-500 mt-1">Sekolah</div>
            </div>
            <div class="bg-white rounded-2xl p-6 text-center shadow-sm hover:shadow-md transition border border-gray-100">
                <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <div class="text-3xl font-bold text-gray-800">{{ $jumlahAparatur }}</div>
                <div class="text-sm text-gray-500 mt-1">Aparatur</div>
            </div>
        </div>
    </div>
</section>

{{-- ===== LAYANAN ===== --}}
<section id="layanan" class="py-16 md:py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <span class="inline-block bg-blue-100 text-blue-700 text-sm font-semibold px-4 py-1 rounded-full mb-4">Layanan</span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Layanan Desa</h2>
            <p class="text-gray-500">Berbagai layanan administrasi desa yang dapat diakses secara online untuk kemudahan masyarakat.</p>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            {{-- Pelayanan --}}
            <a href="{{ route('pelayanan') }}" class="group bg-white rounded-2xl p-6 border border-gray-200 hover:border-blue-300 hover:shadow-lg transition text-center">
                <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-200 transition">
                    <svg class="w-8 h-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <h3 class="font-semibold text-gray-800 mb-2">Pelayanan Administrasi</h3>
                <p class="text-sm text-gray-500">Ajukan surat keterangan, izin, dan dokumen administrasi desa lainnya.</p>
            </a>

            {{-- Berita --}}
            <a href="{{ route('berita') }}" class="group bg-white rounded-2xl p-6 border border-gray-200 hover:border-blue-300 hover:shadow-lg transition text-center">
                <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:bg-green-200 transition">
                    <svg class="w-8 h-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                </div>
                <h3 class="font-semibold text-gray-800 mb-2">Berita Desa</h3>
                <p class="text-sm text-gray-500">Informasi terbaru seputar kegiatan dan pembangunan desa.</p>
            </a>

            {{-- Pasar Desa --}}
            <a href="{{ route('pasardesa') }}" class="group bg-white rounded-2xl p-6 border border-gray-200 hover:border-blue-300 hover:shadow-lg transition text-center">
                <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:bg-purple-200 transition">
                    <svg class="w-8 h-8 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                </div>
                <h3 class="font-semibold text-gray-800 mb-2">Pasar Desa</h3>
                <p class="text-sm text-gray-500">Direktori UMKM dan produk unggulan masyarakat desa.</p>
            </a>
        </div>
    </div>
</section>

{{-- ===== BERITA TERBARU ===== --}}
<section id="berita" class="py-16 md:py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <span class="inline-block bg-green-100 text-green-700 text-sm font-semibold px-4 py-1 rounded-full mb-4">Berita</span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Berita Terbaru</h2>
            <p class="text-gray-500">Ikuti perkembangan dan kegiatan terbaru di desa.</p>
        </div>

        @forelse($news as $berita)
            <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-md transition mb-6 border border-gray-100">
                <div class="flex flex-col md:flex-row">
                    <div class="md:w-1/3 bg-gray-200 min-h-[200px] relative overflow-hidden">
                        @if($berita->image)
                            <img src="{{ Storage::url('news/' . $berita->image) }}" class="w-full h-full absolute inset-0 object-cover" alt="{{ $berita->title }}">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                <svg class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                        @endif
                    </div>
                    <div class="md:w-2/3 p-6 flex flex-col justify-center">
                        <div class="flex items-center gap-2 text-xs text-gray-400 mb-2">
                            <span class="bg-blue-100 text-blue-700 px-2 py-0.5 rounded font-medium">{{ $berita->category ?? 'Berita' }}</span>
                            <span>{{ $berita->created_at->format('d M Y') }}</span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $berita->title }}</h3>
                        <p class="text-gray-500 text-sm mb-4">{{ Str::limit(strip_tags($berita->content), 150, '...') }}</p>
                        <a href="{{ route('berita.show', $berita->id) }}" class="inline-flex items-center gap-1 text-blue-600 font-medium text-sm hover:text-blue-800 transition">
                            Baca Selengkapnya
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-12 text-gray-400">
                <svg class="w-16 h-16 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                <p>Belum ada berita.</p>
            </div>
        @endforelse

        <div class="text-center mt-8">
            <a href="{{ route('berita') }}" class="inline-flex items-center gap-2 bg-blue-600 text-white font-semibold px-6 py-3 rounded-xl hover:bg-blue-700 transition shadow">
                Lihat Semua Berita
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
    </div>
</section>

{{-- ===== APARATUR ===== --}}
<section class="py-16 md:py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <span class="inline-block bg-amber-100 text-amber-700 text-sm font-semibold px-4 py-1 rounded-full mb-4">Aparatur</span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Aparatur Desa</h2>
            <p class="text-gray-500">Perangkat desa yang siap melayani masyarakat.</p>
        </div>

        <div class="inline-block bg-gradient-to-br from-blue-50 to-cyan-50 rounded-2xl p-8 shadow-sm border border-blue-100 text-center w-full max-w-md mx-auto">
            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <p class="text-gray-500">Jumlah Aparatur Desa</p>
            <div class="text-5xl font-bold text-blue-700 mt-2">{{ $jumlahAparatur }}</div>
            <p class="text-gray-500 text-sm mt-2">Aparatur yang bertugas melayani masyarakat</p>
        </div>
    </div>
</section>

{{-- ===== CTA / KONTAK ===== --}}
<section class="py-16 md:py-20 bg-gradient-to-br from-blue-800 via-blue-700 to-cyan-600 text-white">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Butuh Bantuan?</h2>
            <p class="text-blue-100 mb-8 text-lg">Hubungi kami untuk informasi lebih lanjut atau kunjungi kantor desa.</p>
            <div class="flex flex-wrap justify-center gap-6">
                <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 bg-white text-blue-800 font-semibold px-6 py-3 rounded-xl hover:bg-blue-50 transition shadow-lg">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    Hubungi Kami
                </a>
                <a href="{{ route('map') }}" class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/30 text-white font-semibold px-6 py-3 rounded-xl hover:bg-white/20 transition">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Lihat Peta
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
