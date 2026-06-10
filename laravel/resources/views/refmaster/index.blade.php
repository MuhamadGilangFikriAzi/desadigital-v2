@extends("layouts.app")

@section("content")
    <div class="w-full">
        <div class="admin-card-header flex justify-between items-center pl-1">
            <h5 class="mb-0"><i class="fas fa-database mr-2"></i> Referensi Master</h5>
        </div>

        <div class="p-4">
            <div class="flex justify-between items-center mb-4">
                <a href="{{ route("refmaster.create") }}" class="inline-flex items-center gap-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition text-sm">
                    <i class="fas fa-plus"></i> Tambah Referensi
                </a>
            </div>

            @if (session("success"))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-800 p-4 rounded-r-lg mb-4">{{ session("success") }}</div>
            @endif

            <form method="GET" action="{{ route("refmaster.index") }}" class="mb-4">
                <div class="flex gap-2">
                    <input type="text" name="q" class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Cari..." value="{{ request("q") }}">
                    <button class="inline-flex items-center gap-1 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium py-2 px-4 rounded-lg transition text-sm" type="submit">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </div>
            </form>

            @if ($refMasters->count())
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse bg-white rounded-lg overflow-hidden shadow-sm">
                        <thead class="bg-gray-50 text-gray-700 text-sm uppercase tracking-wider">
                            <tr>
                                <th class="px-4 py-3 text-left">ID</th>
                                <th class="px-4 py-3 text-left">Tipe</th>
                                <th class="px-4 py-3 text-left">Nama</th>
                                <th class="px-4 py-3 text-left">Nilai</th>
                                <th class="px-4 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($refMasters as $item)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-3 font-mono text-sm">{{ $item->id }}</td>
                                    <td class="px-4 py-3">{{ $item->refMasterType->ref_master_type_name ?? $item->ref_master_type_code }}</td>
                                    <td class="px-4 py-3 font-medium">{{ $item->ref_master_name }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600">{{ Str::limit($item->ref_master_value, 50) }}</td>
                                    <td class="px-4 py-3 text-center">
                                        <div class="flex justify-center gap-2">
                                            <a href="{{ route("refmaster.edit", $item->id) }}" class="inline-flex items-center gap-1 bg-yellow-100 hover:bg-yellow-200 text-yellow-700 text-sm py-1.5 px-3 rounded-lg transition">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="{{ route("refmaster.destroy", $item->id) }}" method="POST" class="inline">
                                                @csrf @method("DELETE")
                                                <button onclick="return confirm('Yakin hapus?')" class="inline-flex items-center gap-1 bg-red-100 hover:bg-red-200 text-red-700 text-sm py-1.5 px-3 rounded-lg transition">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">{{ $refMasters->appends(request()->query())->links() }}</div>
            @else
                <div class="text-center text-gray-500 py-8">Belum ada data referensi master.</div>
            @endif
        </div>
    </div>
@endsection
