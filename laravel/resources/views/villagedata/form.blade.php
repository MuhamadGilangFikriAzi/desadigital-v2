<div class="card-body">
    <form id="villageForm" class="needs-validation" novalidate>
        <!-- Judul -->
        <div class="mb-3">
            <label for="title" class="form-label fw-bold">Judul</label>
            <input type="text" id="title" class="form-control" name="title" placeholder="Masukkan judul chart"
                value="{{ isset($data) ? $data->title : "" }}" required />
            <div class="invalid-feedback">Judul harus diisi.</div>
        </div>
        <!-- Jenis Chart -->
        <div class="mb-3 form-group">
            <label for="type" class="form-label fw-bold">Jenis Chart</label>
            <select id="type" class="custom-select required" name="type_chart" required>
                <option value="">-- Pilih Jenis Chart --</option>
                @foreach ($chartType as $key => $value)
                    <option value="{{ $value }}" @if (optional($data)->type_chart == $value) selected @endif>
                        {{ $key }}
                    </option>
                @endforeach
                @if ($errors->has("type_chart"))
                    <span class="text-danger">{{ $errors->first("type_chart") }}</span>
                @endif
            </select>
            <div class="invalid-feedback">Silakan pilih jenis chart.</div>
        </div>

        <!-- Status -->
        <div class="mb-3">
            <div class="form-group">
                <label>Status</label><br>
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="is_active" name="is_active"
                        {{ old("is_active", $templateSurat->is_active ?? true) ? "checked" : "" }}>
                    <label class="custom-control-label" for="is_active" id="statusLabel">
                        {{ old("is_active", $templateSurat->is_active ?? true) ? "Aktif" : "Tidak Aktif" }}
                    </label>
                </div>
            </div>
        </div>

        <!-- Bagian Data Detail -->
        <div class="border p-3 rounded-3 bg-light mb-3">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="mb-0 fw-bold">Detail Data Chart</h6>
                <button type="button" class="btn btn-sm btn-outline-secondary" id="addDetailBtn">+ Tambah
                    Detail</button>
            </div>

            <div id="detailContainer">
                @if (isset($data) && isset($data->details))
                    @foreach ($data->details as $detail)
                        <div class="row mb-2 detail-row align-items-end">
                            <div class="col-md-4">
                                <label class="form-label">Label</label>
                                <input type="text" class="form-control" name="label[]" placeholder="Label"
                                    value="{{ $detail->label }}" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Nilai</label>
                                <input type="text" class="form-control number-separator" name="value[]"
                                    placeholder="Nilai" value="{{ number_format($detail->value, 0, ",", ".") }}"
                                    required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Warna</label>
                                <input type="color" class="form-control form-control-color" name="color[]"
                                    value="{{ $detail->color }}" required>
                            </div>
                            <div class="col-md-2 d-grid mt-2 mt-md-0">
                                <button type="button" class="btn btn-outline-danger remove-detail">Hapus</button>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        <!-- Tombol Submit dan Back -->
        <div class="d-flex justify-content-between">
            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary px-4">Kembali</a>
            <button type="submit" class="btn btn-primary px-4">Kirim</button>
        </div>
    </form>
</div>

<script>
    // Fungsi untuk menambahkan pemisah ribuan pada input angka
    function formatNumber(value) {
        return value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    // Menambahkan event listener pada inputan yang memiliki class "number-separator"
    $(document).ready(function() {
        // Format nilai saat input
        $(document).on('input', '.number-separator', function() {
            var value = $(this).val();
            // Hapus semua karakter selain angka
            value = value.replace(/\D/g, "");
            $(this).val(formatNumber(value));
        });

        // Menghapus pemisah ribuan sebelum mengirim data
        $('#villageForm').submit(function(e) {
            $('.number-separator').each(function() {
                var value = $(this).val();
                $(this).val(value.replace(/\./g, '')); // Hapus pemisah ribuan
            });
        });
    });
</script>
