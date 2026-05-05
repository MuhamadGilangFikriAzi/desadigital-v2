<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if (isset($method) && $method === "PUT")
        @method("PUT")
    @endif

    <div class="form-group">
        <div class="alert alert-warning border-left border-primary shadow" role="alert">
            <h5 class="mb-2"><i class="fas fa-exclamation-triangle"></i> Penting!</h5>
            <p class="mb-0">
                Untuk membuat <strong>surat terkait keperluan nikah</strong>, klik tombol di bawah untuk melihat daftar
                surat yang harus disiapkan:
            </p>
        </div>

        <div class="text-center mb-3">
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#suratNikahCollapse"
                aria-expanded="false" aria-controls="suratNikahCollapse">
                <i class="fas fa-eye"></i> Tampilkan / Sembunyikan Daftar Surat
            </button>
        </div>

        <div class="collapse" id="suratNikahCollapse">
            <div class="card border-info shadow">
                <div class="card-header bg-info text-white">
                    <strong><i class="fas fa-file-alt"></i> Daftar Surat yang Harus Disiapkan</strong>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            ✅ <strong>Pengantar Nikah</strong>
                        </li>
                        <li class="list-group-item">
                            ✅ <strong>Permohonan Kehendak Nikah</strong>
                        </li>
                        <li class="list-group-item">
                            ✅ <strong>Persetujuan Calon Pengantin</strong>
                        </li>
                        <li class="list-group-item">
                            ✅ <strong>Surat Izin Orang Tua</strong>
                        </li>
                        <li class="list-group-item">
                            ✅ <strong>Surat Pengantar Numpang Nikah</strong>
                            <br><span class="badge badge-warning mt-1">Untuk laki-laki yang menikah di luar wilayah
                                Telagagmurni</span>
                        </li>
                        <li class="list-group-item">
                            ✅ <strong>Surat Pernyataan</strong>
                            <br><span class="badge badge-info mt-1">Apabila umur di atas 20 tahun</span>
                        </li>
                        <li class="list-group-item">
                            ✅ <strong>Surat Keterangan Kematian Suami/Istri</strong>
                            <br><span class="badge badge-danger mt-1">Apabila cerai mati</span>
                        </li>
                        <li class="list-group-item">
                            ✅ <strong>Surat Keterangan Rekomendasi Nikah</strong>
                            <br><span class="badge badge-secondary mt-1">Apabila pihak perempuan sebagai pemohon</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label>Type Surat</label>
        <select name="template_surat_id" class="custom-select" id="type_surat" {{ isset($surat) ? "disabled" : "" }}>
            <option>Pilih...</option>
            @foreach ($listTemplateSurat as $item)
                <option value="{{ $item->id }}" @if (
                    (isset($surat) && $surat->template_surat_id == $item->id) ||
                        (isset($selectedTemplateId) && $selectedTemplateId == $item->id)) selected @endif>
                    {{ $item->type_surat }}
                </option>
            @endforeach
        </select>

        @if (isset($surat))
            <input type="hidden" name="id" value="{{ $surat->id }}">
        @endif
    </div>

    {{-- Dynamic Input Fields --}}
    @if (isset($suratDetail))
        @foreach ($suratDetail as $key => $detail)
            <div class="form-group">
                <label>{{ $detail->label }}</label>
                @if ($detail->input_type == "text")
                    <input type="text" name="detail[{{ $key }}][value]"
                        placeholder="Masukan {{ $detail->label }}" class="form-control inputan"
                        value="{{ $detail->value }}" data-label="{{ $detail->label }}">
                @elseif ($detail->input_type == "date")
                    <input type="text" name="detail[{{ $key }}][value]"
                        placeholder="Masukan {{ $detail->label }}" class="form-control inputan"
                        value="{{ $detail->value }}" data-label="{{ $detail->label }}">
                @elseif ($detail->input_type == "document")
                    <input type="file" accept="application/pdf" name="detail[{{ $key }}][value]"
                        class="form-control">
                    <span>{{ $detail->value }}</span>
                @elseif ($detail->input_type == "nik")
                    <input type="text" name="detail[{{ $key }}][value]"
                        placeholder="Masukan {{ $detail->label }}" class="form-control inputan onlynumber" required
                        maxlength="16" value="{{ $detail->value }}" data-label="{{ $detail->label }}">
                @else
                    @php
                        $options = \App\Models\RefMaster::getOptionsByType($detail->input_type);
                    @endphp
                    <select name="detail[{{ $key }}][value]" data-label="{{ $detail->label }}"
                        class="custom-select inputan">
                        <option value="">Pilih...</option>
                        @foreach ($options as $keyOpt => $valOpt)
                            <option value="{{ $valOpt }}" {{ $detail->value == $valOpt ? "selected" : "" }}>
                                {{ $keyOpt }}
                            </option>
                        @endforeach
                    </select>
                @endif

                <input type="hidden" name="detail[{{ $key }}][tag]" value="{{ $detail->tag }}">
                <input type="hidden" name="detail[{{ $key }}][label]" value="{{ $detail->label }}">
                <input type="hidden" name="detail[{{ $key }}][input_type]"
                    value="{{ $detail->input_type }}">
                <input type="hidden" name="detail[{{ $key }}][id]" value="{{ $detail->id }}">
            </div>
        @endforeach
    @else
        <div class="additional-input"></div>
    @endif

    <div class="text-right">
        <div class="btn btn-primary btn-submit">Submit</div>
        <input class="btn btn-primary" type="submit" name="submit" id="submit" value="submit" hidden>
    </div>
</form>

<script type="text/javascript">
    $(document).ready(function() {

        let validate = () => {
            let inputan = $('.inputan');
            let textError = '';

            inputan.each(function() {
                let value = $(this).val();
                let label = $(this).attr('data-label');

                if (value === undefined || value === '') {
                    textError += label + ' wajib diisi ! <br/>';
                }
            });

            return textError;
        }

        $(document).on('click', '.btn-submit', function() {
            let validasi = validate();
            if (validasi === '') {
                Swal.fire({
                    title: "Apakah anda yakin?",
                    text: "{{ isset($surat) ? "Mengubah surat ini?" : "Mengajukan surat ini?" }}",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#submit').click();
                    }
                });
            } else {
                showValidateionError(validasi)
            }
        });

        @if (!isset($surat))
            // Load dynamic inputs on template change (only in create mode)
            $(document).on('change', '#type_surat', async function() {
                let id = $(this).val();
                let html = '';
                let i = 0;

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    method: "POST",
                    url: "{{ route("onChangeTypeSurat") }}",
                    data: {
                        'id': id
                    },
                    success: async function(data) {
                        const htmlArray = [];

                        const promises = data.data.details.map(async (element, i) => {
                            let inputType = element.input_type;
                            let label = element.label;
                            let block = '';

                            if (inputType === 'text') {
                                block = `
                <div class="form-group">
                    <label>${label}</label>
                    <input type="text" name="detail[${i}][value]" data-label="${label}" placeholder="Masukan ${label}" class="form-control inputan mandatory">
                    <input type="hidden" name="detail[${i}][tag]" value="${element.tag}">
                    <input type="hidden" name="detail[${i}][label]" value="${label}">
                    <input type="hidden" name="detail[${i}][input_type]" value="${inputType}">
                </div>`;
                            } else if (inputType === 'date') {
                                block = `
                <div class="form-group">
                    <label>${label}</label>
                    <input type="date" name="detail[${i}][value]" data-label="${label}" class="form-control inputan mandatory">
                    <input type="hidden" name="detail[${i}][tag]" value="${element.tag}">
                    <input type="hidden" name="detail[${i}][label]" value="${label}">
                    <input type="hidden" name="detail[${i}][input_type]" value="${inputType}">
                </div>`;
                            } else if (inputType === 'nik') {
                                block = `
                <div class="form-group">
                    <label>${label}</label>
                    <input type="txt" name="detail[${i}][value]" data-label="${label}" class="form-control inputan mandatory onlynumber" required
                        maxlength="16">
                    <input type="hidden" name="detail[${i}][tag]" value="${element.tag}">
                    <input type="hidden" name="detail[${i}][label]" value="${label}">
                    <input type="hidden" name="detail[${i}][input_type]" value="${inputType}">
                </div>`;
                            } else if (inputType === 'document') {
                                block = `
                <div class="form-group">
                    <label>${label}</label>
                    <input
                    type="file"
                    accept="application/pdf,image/*"
                    name="detail[${i}][value]"
                    data-label="${label}"
                    class="form-control inputan mandatory">
                      <input type="hidden" name="detail[${i}][tag]" value="${element.tag}">
                    <input type="hidden" name="detail[${i}][label]" value="${label}">
                    <input type="hidden" name="detail[${i}][input_type]" value="${inputType}">
                </div>`;
                            } else {
                                // await dropdown HTML generation
                                block =
                                    await genereateInputOptionByTypeCode(
                                        element, i);
                            }

                            htmlArray[i] =
                                block; // Simpan di index sesuai urutan
                        });

                        await Promise.all(promises);
                        $('.additional-input').html(htmlArray.join(""));
                    }
                });
            });

            async function genereateInputOptionByTypeCode(element, seq) {
                let label = element.label;
                return new Promise((resolve, reject) => {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        method: "POST",
                        url: "{{ route("getRefMasterByTypeCodeReturnJson") }}",
                        data: {
                            'typeCode': element.input_type
                        },
                        success: function(data) {
                            let option = `
                            <div class="form-group">
                                <label>${label}</label>
                                <select name="detail[${seq}][value]" data-label="${label}" class="custom-select inputan">
                        `;

                            $.each(data.options, function(key, value) {
                                option +=
                                    `<option value="${value}">${key}</option>`;
                            });

                            option += `</select>
                            <input type="hidden" name="detail[${seq}][tag]" value="${element.tag}">
                            <input type="hidden" name="detail[${seq}][label]" value="${label}">
                            <input type="hidden" name="detail[${seq}][input_type]" value="${element.input_type}">
                        </div>`;

                            resolve(option);
                        },
                        error: function(xhr) {
                            reject(xhr.responseText);
                        }
                    });
                });
            }
        @endif
    });
</script>
