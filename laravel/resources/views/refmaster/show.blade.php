@extends("layouts.app")

@section("content")
    <div class="max-w-2xl mx-auto">
        <div class="admin-card-header">
            <h5 class="mb-0"><i class="fas fa-eye mr-2"></i> Detail Referensi</h5>
        </div>
        <div class="p-4">
            <table class="w-full">
                <tr>
                    <td class="py-2 font-medium text-gray-700 w-1/3">ID</td>
                    <td class="py-2">{{ $refMaster->id }}</td>
                </tr>
                <tr>
                    <td class="py-2 font-medium text-gray-700">Tipe</td>
                    <td class="py-2">{{ $refMaster->refMasterType->ref_master_type_name ?? $refMaster->ref_master_type_code }}</td>
                </tr>
                <tr>
                    <td class="py-2 font-medium text-gray-700">Nama</td>
                    <td class="py-2">{{ $refMaster->ref_master_name }}</td>
                </tr>
                <tr>
                    <td class="py-2 font-medium text-gray-700">Nilai</td>
                    <td class="py-2">{{ $refMaster->ref_master_value }}</td>
                </tr>
                <tr>
                    <td class="py-2 font-medium text-gray-700">Dibuat</td>
                    <td class="py-2">{{ $refMaster->created_at ? date("d M Y H:i", strtotime($refMaster->created_at)) : "-" }}</td>
                </tr>
            </table>
            <div class="flex justify-end gap-2 mt-6">
                <a href="{{ route("refmaster.edit", $refMaster->id) }}" class="inline-flex items-center gap-1 bg-yellow-100 hover:bg-yellow-200 text-yellow-700 font-medium py-2 px-4 rounded-lg transition text-sm">
                    <i class="fas fa-edit"></i> Edit
                </a>
                <a href="{{ route("refmaster.index") }}" class="inline-flex items-center gap-1 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium py-2 px-4 rounded-lg transition text-sm">Kembali</a>
            </div>
        </div>
    </div>
@endsection
