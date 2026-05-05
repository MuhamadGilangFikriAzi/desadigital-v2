@extends('layouts.app_front')

@section('title', 'Pasar Desa Digital')

@section('content')
    <div class="page-header">
        <div class="container text-center">
            <h1 class="text-white text-3xl md:text-4xl font-bold">Daftar Pasar Desa</h1>
            <p class="text-blue-200 mt-2">Temukan informasi pasar desa yang tersedia di desadigital</p>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-wrap -mx-3">
            @foreach ($stores as $store)
                <div class="w-full md:w-1/2 lg:w-1/3 px-3 mb-4 flex">
                    <div class="bg-white rounded-lg shadow-sm w-full flex flex-col card-hover">
                        @if ($store->img_store)
                            <img src="{{ asset($store->img_store) }}" class="w-full h-48 object-cover rounded-t-lg cursor-pointer" alt="{{ $store->name }}"
                                onclick="showImageModal('{{ asset($store->img_store) }}')">
                        @endif
                        <div class="p-4 flex flex-col flex-grow">
                            <h5 class="font-bold text-gray-800">{{ $store->name }}</h5>
                            <p class="text-gray-500 text-sm flex-grow mt-1">{{ Str::limit($store->desc, 100) }}</p>
                            <a href="{{ route('pasardesa.show', $store->id) }}" class="inline-block mt-3 border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white text-center font-medium py-2 px-4 rounded transition">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
