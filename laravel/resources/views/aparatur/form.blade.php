<!-- resources/views/aparatur/form.blade.php -->
<form action="{{ isset($aparatur) ? route("aparatur.update", $aparatur->id) : route("aparatur.store") }}" method="POST"
    enctype="multipart/form-data">
    @csrf
    @if (isset($aparatur))
        @method("PUT")
    @endif

    <div class="mb-4">
        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
        <input type="text" name="name" id="name" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            value="{{ old("name", isset($aparatur) ? $aparatur->name : "") }}" required>
        @if ($errors->has("name"))
            <span class="text-red-500 text-sm mt-1 block">{{ $errors->first("name") }}</span>
        @endif
    </div>

    <div class="mb-4">
        <label for="photo" class="block text-sm font-medium text-gray-700 mb-1">Foto</label>
        <input type="file" name="photo" id="photo" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
        @if (isset($aparatur) && $aparatur->photo)
            <div class="mt-3">
                <label class="block text-sm font-medium text-gray-600 mb-1">Foto Saat Ini:</label>
                <img src="{{ asset("img/aparatur/img/" . $aparatur->photo) }}" width="50" alt="Foto" class="rounded-lg"
                    onclick="showImageModal('{{ asset("img/aparatur/img/" . $aparatur->photo) }}')">
            </div>
        @endif
        @if ($errors->has("photo"))
            <span class="text-red-500 text-sm mt-1 block">{{ $errors->first("photo") }}</span>
        @endif
    </div>

    <div class="mb-4">
        <label for="position" class="block text-sm font-medium text-gray-700 mb-1">Jabatan</label>
        <input type="text" name="position" id="position" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
            value="{{ old("position", isset($aparatur) ? $aparatur->position : "") }}" required>
        @if ($errors->has("position"))
            <span class="text-red-500 text-sm mt-1 block">{{ $errors->first("position") }}</span>
        @endif
    </div>

    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
        <label class="inline-flex items-center gap-2 cursor-pointer">
            <input type="checkbox" class="toggle-status sr-only peer" id="is_active" name="is_active"
                {{ old("is_active", $aparatur->is_active ?? true) ? "checked" : "" }}>
            <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
            <span id="statusLabel" class="text-sm text-gray-700">{{ old("is_active", $aparatur->is_active ?? true) ? "Aktif" : "Tidak Aktif" }}</span>
        </label>
        @if ($errors->has("is_active"))
            <span class="text-red-500 text-sm mt-1 block">{{ $errors->first("is_active") }}</span>
        @endif
    </div>

    <div class="flex justify-between items-center mt-6 pt-4 border-t border-gray-200">
        <a href="{{ route("aparatur.index") }}" class="inline-flex items-center gap-1 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium py-2 px-4 rounded-lg transition text-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <button type="submit" class="inline-flex items-center gap-1 bg-gray-800 hover:bg-gray-900 text-white font-medium py-2 px-6 rounded-lg transition text-sm">
            <i class="fas fa-save"></i> {{ isset($aparatur) ? "Perbarui" : "Simpan" }}
        </button>
    </div>
</form>

<script type="text/javascript">
    $(document).ready(function() {
        $('#is_active').on('change', function() {
            if ($(this).is(':checked')) {
                $('#statusLabel').text('Aktif');
            } else {
                $('#statusLabel').text('Tidak Aktif');
            }
        });
    });
</script>
