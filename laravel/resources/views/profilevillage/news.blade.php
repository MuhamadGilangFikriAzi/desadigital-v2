@extends('layouts.app_front')

@section('title', 'Berita Desa Digital')

@section('content')
    <div class="page-header">
        <div class="container text-center">
            <h1 class="text-white text-3xl md:text-4xl font-bold">Berita Desa Digital</h1>
            <p class="text-blue-200 mt-2">Informasi dan kabar terbaru dari desa</p>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8 max-w-5xl">

        @forelse ($news as $berita)
            <div class="bg-white rounded-lg shadow-sm mb-6 card-hover overflow-hidden">
                <div class="flex flex-col md:flex-row">
                    <div class="w-full md:w-1/3">
                        @if ($berita->image)
                            <img src="{{ Storage::url('news/' . $berita->image) }}" class="w-full h-48 md:h-full object-cover" alt="Gambar Berita">
                        @else
                            <img src="{{ asset('img/default-news.jpg') }}" class="w-full h-48 md:h-full object-cover" alt="Default Gambar">
                        @endif
                    </div>
                    <div class="w-full md:w-2/3 p-6">
                        <h5 class="text-xl font-bold text-blue-700">{{ $berita->title }}</h5>
                        <p class="text-gray-500 text-sm mb-1">Ditulis oleh: <strong>{{ $berita->author }}</strong></p>
                        <p class="text-gray-600 mt-2">{{ Str::limit(strip_tags($berita->content), 200, '...') }}</p>
                        <a href="{{ route('berita.show', $berita->id) }}" class="inline-block mt-3 border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white font-medium text-sm py-1.5 px-4 rounded transition">
                            Baca Selengkapnya
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-12">
                <p class="text-gray-500 text-lg">Belum ada berita.</p>
            </div>
        @endforelse

    </div>
@endsection
