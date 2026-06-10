@extends("layouts.app")

@section("content")
    <div class="max-w-2xl mx-auto">
        <div class="admin-card-header">
            <h5 class="mb-0"><i class="fas fa-plus mr-2"></i> Tambah Referensi</h5>
        </div>
        <div class="p-4">
            <form action="{{ route("refmaster.store") }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tipe Referensi</label>
                    <select name="ref_master_type_code" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white @error("ref_master_type_code") border-red-500 @enderror">
                        <option value="">Pilih Tipe...</option>
                        @foreach ($types as $type)
                            <option value="{{ $type->ref_master_type_code }}" @if(old("ref_master_type_code") == $type->ref_master_type_code) selected @endif>{{ $type->ref_master_type_name }}</option>
                        @endforeach
                    </select>
                    @error("ref_master_type_code") <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                    <input type="text" name="ref_master_name" value="{{ old("ref_master_name") }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error("ref_master_name") border-red-500 @enderror">
                    @error("ref_master_name") <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nilai</label>
                    <input type="text" name="ref_master_value" value="{{ old("ref_master_value") }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="flex justify-end gap-2">
                    <a href="{{ route("refmaster.index") }}" class="inline-flex items-center gap-1 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium py-2 px-4 rounded-lg transition text-sm">Batal</a>
                    <button type="submit" class="inline-flex items-center gap-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition text-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
