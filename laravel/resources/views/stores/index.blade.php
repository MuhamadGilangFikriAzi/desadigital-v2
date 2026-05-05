@extends("layouts.app")

@section("content")
    <div class="w-full">
        <div class="admin-card-header flex justify-between items-center pl-1">
            <h5 class="mb-0"><i class="fa fa-store mr-2"></i>Daftar Toko</h5>
        </div>

        <div class="p-4">
            <div class="flex justify-between items-center mb-4">
                <a href="{{ route("stores.create") }}" class="inline-flex items-center gap-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition text-sm">
                    <i class="fas fa-plus"></i> Tambah Toko
                </a>
            </div>

            @if (session("success"))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-800 p-4 rounded-r-lg mb-4">{{ session("success") }}</div>
            @endif

            <form method="GET" action="{{ route("stores.index") }}" class="mb-4">
                <div class="flex gap-2">
                    <input type="text" name="q" class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Cari Nama Toko..." value="{{ request("q") }}">
                    <button class="inline-flex items-center gap-1 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium py-2 px-4 rounded-lg transition text-sm" type="submit">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </div>
            </form>

            @if ($stores->count())
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse bg-white rounded-lg overflow-hidden shadow-sm">
                        <thead class="bg-gray-50 text-gray-700 text-sm uppercase tracking-wider">
                            <tr>
                                <th class="px-4 py-3 text-left">Gambar</th>
                                <th class="px-4 py-3 text-left">Nama Toko</th>
                                <th class="px-4 py-3 text-left">No. WhatsApp</th>
                                <th class="px-4 py-3 text-left">Deskripsi</th>
                                <th class="px-4 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($stores as $store)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-3">
                                        @if ($store->img_store)
                                            <img src="{{ asset($store->img_store) }}" width="80" class="rounded-lg cursor-pointer" onclick="showImageModal('{{ asset($store->img_store) }}')">
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 font-medium">{{ $store->name }}</td>
                                    <td class="px-4 py-3">{{ $store->whatsapp_no }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600">{{ $store->desc }}</td>
                                    <td class="px-4 py-3 text-center">
                                        <div class="flex justify-center gap-2">
                                            <a href="{{ route("stores.edit", $store->id) }}" class="inline-flex items-center gap-1 bg-yellow-100 hover:bg-yellow-200 text-yellow-700 text-sm py-1.5 px-3 rounded-lg transition">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="{{ route("stores.destroy", $store->id) }}" method="POST" class="inline">
                                                @csrf @method("DELETE")
                                                <button onclick="return confirm('Yakin hapus toko ini?')" class="inline-flex items-center gap-1 bg-red-100 hover:bg-red-200 text-red-700 text-sm py-1.5 px-3 rounded-lg transition">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                            <a href="{{ route("stores.products.index", $store->id) }}" class="inline-flex items-center gap-1 bg-blue-50 hover:bg-blue-100 text-blue-600 text-sm py-1.5 px-3 rounded-lg transition">
                                                <i class="fas fa-box"></i> Produk
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">{{ $stores->appends(request()->query())->links() }}</div>
            @else
                <div class="text-center text-gray-500 py-8">Belum ada toko.</div>
            @endif
        </div>
    </div>
@endsection
