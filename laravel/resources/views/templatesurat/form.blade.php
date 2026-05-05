<form action="{{ isset($templateSurat) ? route("templatesuratupdate") : route("templatesuratstore") }}" method="post"
    enctype="multipart/form-data" id="formTemplateSurat">

    <div class="card-body padding-0-important">
        @if (session("status"))
            <div class="alert alert-success" role="alert">
                {{ session("status") }}
            </div>
        @endif
        @csrf
        <input type="hidden" name="id" value="{{ $templateSurat->id ?? "" }}">

        <div class="card mb-0" style="margin-bottom: 0px !important;">
            <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                    <button class="btn btn-block text-left pl-0" type="button" data-toggle="collapse"
                        data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <Label>Main Info Surat</Label>
                    </button>
                </h2>
            </div>

            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne">
                <div class="card-body">
                    @if (session("status"))
                        <div class="alert alert-success" role="alert">
                            {{ session("status") }}
                        </div>
                    @endif
                    @csrf
                    <div class="form-group">
                        <label>Tipe Header Surat</label>
                        <select name="type_header" class="custom-select required" id="type_header">
                            <option>Pilih...</option>
                            @foreach ($tempHeaderType as $key => $value)
                                <option value="{{ $value }}" @if (old("type_header", $templateSurat->type_header ?? "1") == $value) selected @endif>
                                    {{ $key }}
                                </option>
                            @endforeach
                            @if ($errors->has("type_header"))
                                <span class="text-danger">{{ $errors->first("type_header") }}</span>
                            @endif
                        </select>
                    </div>
                    <div id="additional_option">

                    </div>

                    <div class="form-group">
                        <label>Ukuran Kertas Surat</label>
                        <select name="letter_size" class="custom-select required" id="letter_size">
                            <option>Pilih...</option>s
                            @foreach ($letterSize as $key => $value)
                                <option value="{{ $value }}" @if (old("letter_size", $templateSurat->letter_size ?? "Legal") == $value) selected @endif>
                                    {{ $key }}
                                </option>
                            @endforeach
                            @if ($errors->has("letter_size"))
                                <span class="text-danger">{{ $errors->first("letter_size") }}</span>
                            @endif
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Tipe Surat</label>
                        <input type="text" name="type_surat" id="type_surat"
                            placeholder="Masukan Type Surat, contoh : Surat Keterangan Usaha"
                            class="form-control uppercase mandatory" data-label="Tipe Surat"
                            value="{{ $templateSurat->type_surat ?? "" }}">
                        @if ($errors->has("type_surat"))
                            <span class="text-danger">{{ $errors->first("type_surat") }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Code Surat</label> <br>
                        <span>Gunakan Tag berikut agar nomor surat terus berjalan
                            <br> [TAHUN] =
                            tahun surat &emsp; [BULAN] = Bulan surat &emsp;
                            [URUTAN] = urutan nomor surat</span>
                        <input type="text" name="code_surat" id="code_surat" data-label="Code Surat"
                            placeholder="Masukan Code Surat, contoh : UK.06.02" class="form-control mandatory"
                            value="{{ $templateSurat->code_surat ?? "" }}">
                        @if ($errors->has("code_surat"))
                            <span class="text-danger">{{ $errors->first("code_surat") }}</span>
                        @endif
                    </div>

                </div>
            </div>

        </div>
        <div class="card mb-0" style="margin-bottom: 0px !important;">
            <div class="card-header" id="headingTwo">
                <h2 class="mb-0">
                    <button class="btn btn-block text-left pl-0" type="button" data-toggle="collapse"
                        data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        <label for="">Data Untuk Surat</label>
                    </button>
                </h2>
            </div>

            <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo">
                <div class="card-body">
                    <div class="form-group" id="inputan">
                        <div class="row">
                            <div class="col-md-3">Label</div>
                            <div class="col-md-3">Tag</div>
                            <div class="col-md-3">Type</div>
                            <div class="col-md-3"><button type="button" id="btnAddInput"
                                    class="btn btn-outline-dark"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                        @foreach ($templateSuratDetail as $key => $detail)
                            <div class="row row-inputan my-1" data-id="{{ $key }}">
                                <div class="col-md-3">
                                    <input type="text" name="TemplateSuratdetail[{{ $key }}][label]"
                                        placeholder="Masukan Label" class="form-control" maxlength="500"
                                        value="{{ $detail->label }}">
                                </div>
                                <div class="col-md-3">
                                    <input type="text" name="TemplateSuratdetail[{{ $key }}][tag]"
                                        placeholder="Masukan tag (tanpa spasi)"
                                        class="form-control mandatory tag-template-surat uppercase unique"
                                        value="{{ $detail->tag }}">
                                </div>
                                <div class="col-md-3">
                                    <select name="TemplateSuratdetail[{{ $key }}][input_type]"
                                        class="custom-select">
                                        <option>Pilih...</option>
                                        @foreach ($options as $key => $value)
                                            <option value="{{ $value }}"
                                                @if ($detail->input_type === $value) selected @endif>
                                                {{ $key }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3"><button data-id="{{ $key }}" type="button"
                                        class="btn btn-hapus btn-outline-dark"><i class="fas fa-trash"></i></button>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
        <div class="card mb-0" style="margin-bottom: 0px !important;">
            <div class="card-header" id="headingThere">
                <h2 class="mb-0">
                    <button class="btn btn-block text-left pl-0" type="button" data-toggle="collapse"
                        data-target="#collapseThere" aria-expanded="true" aria-controls="collapseThere">
                        <label for="">Kondisi Surat</label>
                    </button>
                </h2>
            </div>

            <div id="collapseThere" class="collapse show" aria-labelledby="headingThere">
                <div class="card-body">
                    <div class="form-group" id="inputan-kondisi">
                        <div class="row">
                            <div class="col-md-4">Tag Kondisi</div>
                            <div class="col-md-4">Nama</div>
                            <div class="col-md-4">
                                <button type="button" id="btnCondition" class="btn btn-outline-dark"
                                    data-toggle="modal" data-target="#dataModal">Tambah Kondisi</button>
                            </div>
                        </div>

                        @foreach ($conditions as $key => $condition)
                            <div class="row row-inputan row-kondisi my-1" data-id="{{ $key }}">
                                <div class="col-md-4" id="tag-condition-{{ $key }}">
                                    <span>{{ $condition->code }}</span>
                                </div>
                                <div class="col-md-4" id="name-condition-{{ $key }}">
                                    <span>{{ $condition->name }}</span>
                                </div>
                                <div class="col-md-4">
                                    <button data-id="{{ $key }}" type="button"
                                        class="btn btn-edit-condition btn-outline-dark"><i
                                            class="fas fa-edit"></i></button>
                                    <button data-id="{{ $key }}" type="button"
                                        class="btn btn-hapus btn-outline-dark"><i class="fas fa-trash"></i></button>
                                </div>
                                <input type="hidden" name="condition[{{ $key }}][code]"
                                    value="{{ $condition->code }}">
                                <input type="hidden" name="condition[{{ $key }}][name]"
                                    value="{{ $condition->name }}">
                                <input type="hidden" name="condition[{{ $key }}][logical_operator]"
                                    value="{{ $condition->logical_operator }}">

                                @foreach ($condition->kondisiSuratDetails as $detailKey => $detail)
                                    <input type="hidden"
                                        name="condition[{{ $key }}][list_condition][{{ $detailKey }}][tag_template_surat]"
                                        value="{{ $detail->tag_surat_detail }}">
                                    <input type="hidden"
                                        name="condition[{{ $key }}][list_condition][{{ $detailKey }}][kondisi]"
                                        value="{{ $detail->kondisi }}">
                                    <input type="hidden"
                                        name="condition[{{ $key }}][list_condition][{{ $detailKey }}][value]"
                                        value="{{ $detail->value }}">
                                @endforeach

                                <input type="hidden" name="condition[{{ $key }}][desc]"
                                    value="{{ $condition->desc }}">

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
        <div class="card mb-0" style="margin-bottom: 0px !important;">
            <div class="card-header" id="headingFour">
                <h2 class="mb-0">
                    <button class="btn btn-block text-left " type="button" data-toggle="collapse"
                        data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                        <label for="">Isi Surat</label>
                    </button>
                </h2>
            </div>

            <div id="collapseFour" class="collapse show" aria-labelledby="headingFour">
                <div class="card-body">
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
                    <div class="form-group editor-wrapper">

                        <div class="text-center">
                            <span>Gunakan Tag berikut <br>
                                [TANGGALCETAK] = Tanggal cetak surat</span>
                            {{-- <div class="form-group">
                                <label for="Import Surat">Import Surat</label>
                                <input type="file" id="wordInput" accept=".doc,.docx">
                            </div> --}}
                        </div>
                        <div class="d-flex justify-content-center paper-size" id="editorContainer">
                            {{-- <div id="editor"></div> --}}
                            <textarea class="form-control editor editor-tiny" id="editor_tiny" name="body_surat_tiny">{!! $templateSurat->body_surat ?? "" !!}</textarea>
                            <input type="hidden" name="body_surat" value='{!! $templateSurat->body_surat ?? "" !!}'>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="text-right p-4">
        <div class="btn btn-primary btn-preview cursor-pointer">Download Preview</div>
        <div class="btn btn-primary btn-submit cursor-pointer">Submit</div>
        <input class="btn btn-primary" type="submit" name="submit" value="submit" hidden id="btn-submit">
    </div>
</form>

<div class="modal fade" id="dataModal" tabindex="-1" role="dialog" aria-labelledby="dataModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dataModalLabel">Tambah Kondisi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="dataContainerCondition">
                    <!-- Rows of data will be appended here -->

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-cancel-condition" class="btn btn-secondary"
                    data-dismiss="modal">Batal</button>
                <button type="button" data-id="0" id="btn-submit-condition" class="btn btn-primary">Simpan
                    Data</button>
            </div>
        </div>
    </div>
</div>

@php
    $modelN = isset($templateSuratAttr) ? $templateSuratAttr->attr_value : "";
@endphp

<script type="text/javascript">
    $(document).ready(function() {
        var i = "{{ $templateSuratDetail->count() }}" + 1;
        var isNew = "{{ $isNew }}";
        var routeSubmit = isNew ? "{{ route("templatesuratstore") }}" : "{{ route("templatesuratupdate") }}";
        console.log('lognya', routeSubmit);
        var j = 0;
        var countCondition = "{{ $conditions->count() }}";
        var countDetailCondition = "{{ $totalDetails }}";
        var modelN = "{{ $modelN }}";
        var options = @json($options);
        var conditionOption = @json($conditionOptions);
        var logicalOption = @json($logicalOptions);
        var modelSeqOption = @json($modelSeqOption);

        var isAddCondition = true;

        // function replaceEmsp(content) {
        //     return content.replace(/&emsp;|&#8195;|&\#x2003;/g, '&nbsp;&nbsp;&nbsp;&nbsp;');
        // }

        // Proses konten awal
        // $('#editor').val(replaceEmsp($('#editor').val()));

        // Jika menggunakan Trumbowyg
        // if ($('#editor').hasClass('trumbowyg-box')) {
        //     $('#editor').trumbowyg({
        //         // Konfigurasi Trumbowyg
        //     }).on('tbwinit', function() {
        //         const content = $(this).trumbowyg('html');
        //         $(this).trumbowyg('html', replaceEmsp(content));
        //     });
        // }

        // Handle paste event
        // $('#editor').on('paste', function(e) {
        //     e.preventDefault();
        //     const text = e.originalEvent || e.clipboardData.getData('text/plain');
        //     document.execCommand('insertText', false, replaceEmsp(text));
        // });


        $('#wordInput').on('change', function(event) {
            const file = event.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function(e) {
                const arrayBuffer = e.target.result;

                // Konversi Word ke HTML
                mammoth.convertToHtml({
                        arrayBuffer: arrayBuffer
                    })
                    .then(function(result) {
                        let cleanedHtml = result.value;
                        console.log('testing', cleanedHtml);
                        cleanedHtml = removeParagraphFromSurat(cleanedHtml);
                        $('#editor').trumbowyg('html', cleanedHtml);
                    })
                    .catch(function(err) {
                        console.error("Gagal memuat Word:", err);
                    });
            };

            reader.readAsArrayBu
            fer(file);
        });

        function removeParagraphFromSurat(bodySurat) {
            // Hapus text-align:center
            bodySurat = bodySurat.replace(/text-align:\s*center;/g, '');

            // Jika ada <center> tag, ubah ke <div style="text-align:left;">
            bodySurat = bodySurat.replace(/<center>/gi,
                '<div style="text-align:left;">');
            bodySurat = bodySurat.replace(/<\/center>/gi, '</div>');
            console.log('testing2', bodySurat);

            // Masukkan ke Trumbowyg
            bodySurat = `${bodySurat}`.replace(/\t/g, '&nbsp;&nbsp;&nbsp;&nbsp;');
            // Bersihkan tag <o:p>
            bodySurat = bodySurat.replace(/<o:p>/g, '').replace(/<\/o:p>/g, '');

            // Ganti <p> jadi <div> (opsional, jika ingin kontrol penuh via CSS)
            bodySurat = bodySurat.replace(/<p>/g, '<div>').replace(/<\/p>/g, '</div>');
            bodySurat = bodySurat.replace(/<br><br>/g, '');

            // Handle cases with attributes in <p> tags
            bodySurat = bodySurat.replace(/<p([^>]*)>/g, '<br><div$1>');
            bodySurat = bodySurat.replace(/\/p>/g, '/div>');

            return bodySurat;
        }

        console.log('model nnya', modelN);
        if (modelN) {
            // Do something
            appendAdditionalOption(modelN);
        }

        function setOption(valueCode = "") {
            let optionsHtmls = "";

            $.each(options, function(key, value) {
                let isSelected = valueCode === value ? "selected" : "";
                optionsHtmls += `<option value="${value}" ${isSelected}>${key}</option>`;
            });

            return optionsHtmls;
        }

        function setConditionOption(valueCode = "") {
            let conditionOptionHtmls = "";

            $.each(conditionOption, function(key, value) {
                let isSelected = valueCode === value ? "selected" : "";
                conditionOptionHtmls +=
                    `<option value="${value}" ${isSelected}>${key}</option>`;
            });

            return conditionOptionHtmls;
        }

        function setLogicalOption(valueCode = "") {
            let logicalOptionHtmls = "";

            $.each(logicalOption, function(key, value) {
                let isSelected = valueCode === value ? "selected" : "";
                logicalOptionHtmls += `<option value="${value}" ${isSelected}>${key}</option>`;
            });

            return logicalOptionHtmls;
        }

        function setModelSeqOption(valueCode = "") {
            let modelSetOptionHtml = "";

            $.each(modelSeqOption, function(key, value) {
                let isSelected = valueCode === value ? "selected" : "";
                modelSetOptionHtml += `<option value="${value}" ${isSelected}>${key}</option>`;
            });

            return modelSetOptionHtml;
        }

        function removeAdditionalOption() {
            $('#additional_option').empty(); // Menghapus elemen tambahan jika ada
        }

        // Fungsi untuk menambah elemen tambahan
        function appendAdditionalOption(valueCode = "") {
            var additionalHtml = `
            <label>Model N-</label>
            <select id="model_seq" name="model_seq" data-label="Type" class="custom-select">
                ${setModelSeqOption(valueCode)}
            </select>`;
            $('#additional_option').append(
                additionalHtml); // Menambahkan elemen tambahan setelah dropdown
        }

        // Mengawasi perubahan pada dropdown 'type_header'
        $('#type_header').change(function() {
            var selectedValue = $(this).val();

            // Jika nilai yang dipilih adalah 2, tambahkan elemen tambahan
            if (selectedValue == '2') {
                removeAdditionalOption(); // Hapus elemen jika ada
                appendAdditionalOption(); // Tambah elemen tambahan
            } else {
                removeAdditionalOption(); // Hapus elemen tambahan jika bukan 2
            }
        });

        $("#btnAddInput").click(function() {
            i++;
            $("#inputan").append(`
                <div class="row row-inputan my-1" data-id="${i}">
                    <div class="col-md-3">
                        <input type="text" name="TemplateSuratdetail[${i}][label]"
                            placeholder="Masukan Label" class="form-control" maxlength="500">
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="TemplateSuratdetail[${i}][tag]"
                            placeholder="Masukan tag (tanpa spasi)" class="form-control tag-template-surat uppercase unique">
                    </div>
                    <div class="col-md-3">
                        <select name="TemplateSuratdetail[${i}][input_type]" class="custom-select">
                            <option selected>Pilih...</option>
                            ${setOption("text")}
                        </select>
                    </div>
                    <div class="col-md-3"><button type="button" data-id="${i}" class="btn btn-hapus btn-outline-dark"><i class="fas fa-trash"></i></button>
                    </div>
                </div>`);
        });

        $(document).on('click', '.btn-hapus', function() {
            $(this).parents('.row.row-inputan').remove();
        });

        $("#btnCondition").click(function() {
            isAddCondition = true;
            var optionsTagHtml =
                `<option selected>Pilih...</option>`;
            $.each($(".tag-template-surat"), function(index,
                element) {
                if ($(element)
                    .val() !=
                    '') {
                    optionsTagHtml
                        +=
                        `<option value="${$(element).val()}">${$(element).val()}</option>`;
                }
            });

            $('#dataContainerCondition').html(`
                <div class="data-row data-condition" data-id="${countCondition}">
                    <div class="form-group">
                        <label>Tag Kondisi</label>
                        <input type="text" name="condition[${countCondition}][code]" class="form-control uppercase unique" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Kondisi</label>
                        <input type="text" name="condition[${countCondition}][name]" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Logical Kondisi</label>
                        <select id="conditionLogical" name="condition[${countCondition}][logical_operator]" data-label="Type" class="custom-select mandatory">
                            ${setLogicalOption()}
                        </select>
                    </div>
                    <div class="form-group" id="inputan-condition">
                        <div class="row">
                            <div class="col-md-3">Tag</div>
                            <div class="col-md-3">Operator</div>
                            <div class="col-md-3">Value</div>
                            <div class="col-md-3"><button type="button" id="btnAddCondition"
                                    class="btn btn-outline-dark"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="row row-inputan-condition my-1" data-id="0">
                            <div class="col-md-3">
                                <select name="condition[${countCondition}][list_condition][${countDetailCondition}][tag_template_surat]" data-label="Type" class="custom-select mandatory">
                                ${optionsTagHtml}
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="condition[${countCondition}][list_condition][${countDetailCondition}][kondisi]" data-label="Type" class="custom-select mandatory">
                                ${setConditionOption()}
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="condition[${countCondition}][list_condition][${countDetailCondition}][value]"
                                    placeholder="""
                                    class="form-control mandatory">
                            </div>
                            <div class="col-md-3">
                                <button data-id="${countCondition}" type="button" class="btn btn-hapus-condition btn-outline-dark"><i class="fas fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Isi</label>
                        <textarea class="form-control editor mandatory" id="bodyconditionletter" data-label="Surat" name="condition[${countCondition}][desc]"></textarea>
                    </div>
                </div>`);

            $('#conditionTag').html(optionsTagHtml);
            $('#conditionLogical').html(setLogicalOption());

            generateInputHtml('#bodyconditionletter');
            countDetailCondition++;
        })

        $('#btn-submit-condition').click(function() {
            const dataId = $('.data-condition').data(
                'id'
            );
            let name = $('#dataContainerCondition').find(
                `[name="condition[${dataId}][name]"]`
            ).val();
            let code = $('#dataContainerCondition').find(
                `[name="condition[${dataId}][code]"]`
            ).val();

            if (!isAddCondition) {
                $(`.row-kondisi[data-id="${dataId}"]`).find('input[type="hidden"]').remove();
                $(`#tag-condition-${dataId}`).html(`<span>${code}</span>`);
                $(`#name-condition-${dataId}`).html(`<span>${name}</span>`);
            }

            if (isAddCondition) {
                $('#inputan-kondisi').append(`
                    <div class="row row-inputan row-kondisi my-1" data-id="${dataId}">
                        <div class="col-md-4" id="tag-condition-${dataId}">
                            <span>${code}</span>
                        </div>
                        <div class="col-md-4" id="name-condition-${dataId}">
                            <span>${name}</span>
                        </div>
                        <div class="col-md-4">
                            <button data-id="${dataId}" type="button" class="btn btn-edit-condition btn-outline-dark"><i class="fas fa-edit"></i></button>
                            <button data-id="${dataId}" type="button" class="btn btn-hapus btn-outline-dark"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                `);
            }

            $('#dataContainerCondition')
                .find('input, select, textarea')
                .each(function() {
                    // Create a hidden input with same name and value
                    const name = $(this)
                        .attr(
                            'name'
                        );
                    const value = $(
                            this
                        )
                        .val();

                    // Remove any existing hidden inputs with the same name to avoid duplicates
                    $(`input[type="hidden"][name="${name}"]`)
                        .remove();

                    // Append hidden input to the parent form
                    const hiddenInput =
                        $(
                            '<input>'
                        )
                        .attr({
                            type: 'hidden',
                            name: name,
                            value: value
                        });

                    $(`.row-kondisi[data-id="${dataId}"]`)
                        .append(
                            hiddenInput
                        ); // Adjust selector to your form if needed
                });

            // Get the data-id attribute value
            $('#dataContainerCondition').empty();
            $('#btn-cancel-condition').click();
            countCondition++;
        });

        $('#btn-cancel-condition').click(function() {
            $('#dataModal').modal('hide');
        })

        $('.close').click(function() {
            $('#dataModal').modal('hide');
        })

        $(document).on('click', '#btnAddCondition', function() {
            countDetailCondition++;
            const dataId = $('.data-condition').data(
                'id'
            );
            var seqNo = countCondition;
            if (!isAddCondition) {
                seqNo = dataId;
            }
            var optionsTagHtml =
                `<option selected>Pilih...</option>`;
            $.each($(".tag-template-surat"), function(index,
                element) {
                optionsTagHtml +=
                    `<option value="${$(element).val()}">${$(element).val()}</option>`;
            });

            $("#inputan-condition").append(`
                <div class="row row-inputan-condition my-1" data-id="${countDetailCondition}">
                    <div class="col-md-3">
                        <select name="condition[${seqNo}][list_condition][${countDetailCondition}][tag_template_surat]" data-label="Type" class="custom-select mandatory">
                        ${optionsTagHtml}
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="condition[${seqNo}][list_condition][${countDetailCondition}][kondisi]" data-label="Type" class="custom-select mandatory">
                        ${setConditionOption()}
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="text" name="condition[${seqNo}][list_condition][${countDetailCondition}][value]"
                            placeholder=""
                            class="form-control mandatory">
                    </div>
                    <div class="col-md-3"><button data-id="${countDetailCondition}" type="button"
                            class="btn btn-hapus-condition btn-outline-dark"><i class="fas fa-trash"></i></button>
                    </div>
                </div>`);
        });

        $(document).on('click', '.btn-edit-condition', function() {
            // Get the data-id from the clicked button
            isAddCondition = false;
            const dataId = $(this).data('id');

            // Select the hidden inputs inside the specific .row-kondisi with the matching data-id
            const hiddenInputs = $(`.row-kondisi[data-id="${dataId}"]`).find(
                'input[type="hidden"]');

            // Retrieve single values
            var code = hiddenInputs.filter(`[name="condition[${dataId}][code]"]`).val();
            var name = hiddenInputs.filter(`[name="condition[${dataId}][name]"]`).val();
            var logicalOperator = hiddenInputs.filter(
                `[name="condition[${dataId}][logical_operator]"]`).val();
            var desc = hiddenInputs.filter(`[name="condition[${dataId}][desc]"]`).val();

            // Retrieve multiple values for tag_template_surat, kondisi, and value
            var tagTemplateSurats = [];
            hiddenInputs.filter(`[name*="tag_template_surat"]`).each(function() {
                tagTemplateSurats.push($(this).val());
            });

            var kondisi = [];
            hiddenInputs.filter(`[name*="kondisi"]`).each(function() {
                kondisi.push($(this).val());
            });

            var values = [];
            hiddenInputs.filter(`[name*="value"]`).each(function() {
                values.push($(this).val());
            });

            let logicalOpttion = setLogicalOption(logicalOperator);

            var optionsTagHtmls = [];
            var conditionTagHtmls = [];

            tagTemplateSurats.forEach(function(tag) {
                // Initialize optionsTagHtml inside the loop to avoid scope issues
                var optionsTagHtml =
                    `<option selected>Pilih...</option>`; // Place this once outside the loop for each tag
                console.log('tagnya', tag);
                // Loop through each element with the class .tag-template-surat
                $.each($(".tag-template-surat"), function(index, element) {
                    var elementValue = $(element).val();
                    console.log('valuenya', elementValue);
                    // Check if the value is not empty
                    if (elementValue != '') {
                        // Add the selected attribute if the tag matches the current element value
                        var selectedAttribute = tag == elementValue ? 'selected' :
                            '';
                        optionsTagHtml +=
                            `<option value="${elementValue}" ${selectedAttribute}>${elementValue}</option>`;
                    }
                });

                // After processing all elements for this tag, push the generated HTML to optionsTagHtmls
                optionsTagHtmls.push(optionsTagHtml);
            });

            console.log('option tag', optionsTagHtmls);


            kondisi.forEach(function(value) {
                conditionTagHtmls.push(setConditionOption(value));
            });

            var conditionDetails = '';
            values.forEach(function(value, index) {
                conditionDetails += `<div class="col-md-3">
                                <select name="condition[${dataId}][list_condition][${countDetailCondition}][tag_template_surat]" data-label="Type" class="custom-select mandatory">
                                ${optionsTagHtmls[index]}
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="condition[${dataId}][list_condition][${countDetailCondition}][kondisi]" data-label="Type" class="custom-select mandatory">
                                ${conditionTagHtmls[index]}
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="condition[${dataId}][list_condition][${countDetailCondition}][value]"
                                    placeholder="""
                                    class="form-control mandatory" value="${value}">
                            </div>
                            <div class="col-md-3">
                                <button data-id="${dataId}" type="button" class="btn btn-hapus-condition btn-outline-dark"><i class="fas fa-trash"></i></button>
                            </div>`;
                countDetailCondition++;
            });

            $('#dataContainerCondition').html(`
                <div class="data-row data-condition" data-id="${dataId}">
                    <div class="form-group">
                        <label>Tag Kondisi</label>
                        <input type="text" name="condition[${dataId}][code]" value="${code}" class="form-control uppercase unique" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Kondisi</label>
                        <input type="text" name="condition[${dataId}][name]" value="${name}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Logical Kondisi</label>
                        <select id="conditionLogical" name="condition[${dataId}][logical_operator]" data-label="Type" class="custom-select mandatory">
                            ${setLogicalOption(logicalOperator)}
                        </select>
                    </div>
                    <div class="form-group" id="inputan-condition">
                        <div class="row">
                            <div class="col-md-3">Tag</div>
                            <div class="col-md-3">Operator</div>
                            <div class="col-md-3">Value</div>
                            <div class="col-md-3"><button type="button" id="btnAddCondition"
                                    class="btn btn-outline-dark"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="row row-inputan-condition my-1" data-id="0">
                        ${conditionDetails}
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Isi</label>
                        <textarea class="form-control editor mandatory" id="bodyconditionletter" data-label="Surat" name="condition[${dataId}][desc]">${desc}</textarea>
                    </div>
                </div>`);

            // $('#conditionTag').html(optionsTagHtml);
            // $('#conditionLogical').html(setLogicalOption(logicalOperator));

            generateInputHtml('#bodyconditionletter');

            $('#dataModal').modal('show');
        });

        $(document).on('click', '.btn-preview', function() {
            // e.preventDefault(); // Prevent default form submission

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                method: "post",
                url: "{{ route("previewLetter") }}",
                data: $('#formTemplateSurat').serialize(),
                xhrFields: {
                    responseType: 'blob' // Important for binary response
                },
                success: function(blob, status, xhr) {
                    // Get filename from Content-Disposition
                    let filename = "";
                    const disposition = xhr.getResponseHeader('Content-Disposition');
                    if (disposition && disposition.indexOf('attachment') !== -1) {
                        const match = disposition.match(
                            /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/);
                        if (match != null && match[1]) filename = match[1].replace(
                            /['"]/g,
                            '');
                    }
                    filename = 'PreviewSurat';
                    // Create blob link and click to download
                    const link = document.createElement('a');
                    const url = window.URL.createObjectURL(blob);
                    link.href = url;
                    link.download = filename || 'document.pdf';
                    document.body.appendChild(link);
                    link.click();
                    link.remove();
                    window.URL.revokeObjectURL(url);
                },
                error: function(xhr) {
                    console.error("Download error", xhr);
                }
            });

        });

        $('#dataModal').on('hidden.bs.modal', function() {
            // Your custom function goes here
            // Example: Clear the modal content
            $('#dataContainerCondition').empty();
            countCondition++;
        });

        $(document).on('click', '.btn-hapus-condition', function() {
            $(this).parents('.row.row-inputan-condition')
                .remove();
        });


        generateInputHtml('#editor');

        const validate = function() {
            let typeSurat = $('#type_surat').val();
            let codeSurat = $('#code_surat').val();
            let bodySurat = $('#editor').val();

            let textError = '';
            if (typeSurat === '') textError += 'Type Surat wajib diisi ! <br/>'
            if (codeSurat === '') textError += 'Code Surat wajib diisi ! <br/>'
            if (bodySurat === '') textError += 'Body Surat wajib diisi ! <br/>'

            return textError;

        }

        $(document).on('click', '.btn-submit', function() {
            let msgError = '';
            $('.mandatory').each(function(i, obj) {
                let data = $(this);
                console.log('data', data);
                console.log('labelnya', data
                    .attr(
                        'data-label'
                    ));
                if (data.val() ===
                    null ||
                    data
                    .val() ===
                    '' ||
                    data
                    .val() ===
                    undefined
                ) {
                    msgError +=
                        data
                        .attr(
                            'data-label'
                        ) +
                        ' Wajib Diisi <br/>';
                }
            });

            if (msgError === '') {
                Swal.fire({
                    title: "Apakah anda yakin?",
                    text: "Melakukan perubahan pada template surat ini?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, Ubah!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#btn-submit').click();
                    }
                });
            } else {
                showValidateionError(msgError)
            }

        });

        $('#btn-submit').click(function(e) {
            e.preventDefault();

            $('#loading').show();
            $('#messageBox').html('');
            $('#btn-submit').prop('disabled', true);

            $.ajax({
                url: routeSubmit, // or use route('templatesurat.store') if you're using named routes
                type: "POST",
                data: $('#formTemplateSurat').serialize(),
                success: function(response) {
                    showSuccess(response.message,
                        "{{ route("templatesurat") }}")
                },
                error: function(xhr) {

                    let errorMsg = '<div style="color:red;">Gagal menyimpan data.</div>';
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        errorMsg = '';
                        $.each(xhr.responseJSON.errors, function(key, value) {
                            errorMsg += '<div style="color:red;">' + value +
                                '</div>';
                        });
                    } else if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMsg = '<div style="color:red;">' + xhr.responseJSON.message +
                            '</div>';
                    }
                    showError(errorMsg);
                }
            });
        });
    });
</script>
