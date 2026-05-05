@extends('layouts.app_front')

@section('title', $store->name . ' - Pasar Desa Digital')

@section('content')
    <div class="container mx-auto px-4 py-8 max-w-5xl">
        <a href="{{ route('pasardesa') }}" class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium py-2 px-4 rounded transition mb-4">
            ← Kembali ke daftar toko
        </a>

        <!-- Detail Toko -->
        <div class="bg-white rounded-lg shadow-sm mb-6">
            <div class="flex flex-col md:flex-row">
                @if ($store->img_store)
                    <div class="w-full md:w-1/3">
                        <img src="{{ asset($store->img_store) }}" class="w-full h-64 md:h-full object-cover rounded-t-lg md:rounded-l-lg md:rounded-t-none cursor-pointer" alt="{{ $store->name }}"
                            onclick="showImageModal('{{ asset($store->img_store) }}')">
                    </div>
                @endif
                <div class="w-full md:w-2/3 p-6">
                    <h3 class="text-2xl font-bold text-gray-800">{{ $store->name }}</h3>
                    <p class="text-gray-600 mt-2">{{ $store->desc }}</p>
                    @if ($store->whatsapp_no)
                        <p class="mt-3">WhatsApp: <a href="https://wa.me/{{ $store->whatsapp_no }}" target="_blank" class="text-blue-600 hover:underline">{{ $store->whatsapp_no }}</a></p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Produk -->
        <h4 class="text-xl font-bold text-gray-800 mb-4">Produk Toko</h4>

        @if ($store->products->count())
            <div class="flex flex-wrap -mx-3">
                @foreach ($store->products as $product)
                    <div class="w-full md:w-1/2 lg:w-1/3 px-3 mb-4 flex">
                        <div class="bg-white rounded-lg shadow-sm w-full flex flex-col card-hover">
                            @if ($product->img_product)
                                <img src="{{ asset($product->img_product) }}" class="w-full h-48 object-cover rounded-t-lg cursor-pointer" alt="{{ $product->name_product }}"
                                    onclick="showImageModal('{{ asset($product->img_product) }}')">
                            @endif
                            <div class="p-4 flex flex-col flex-grow">
                                <h5 class="font-bold text-gray-800">{{ $product->name_product }}</h5>
                                <p class="text-gray-500 text-sm flex-grow mt-1">{{ Str::limit($product->desc, 80) }}</p>
                                <p class="font-bold text-gray-900 mt-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500 text-center py-8">Belum ada produk untuk toko ini.</p>
        @endif
    </div>
@endsection
