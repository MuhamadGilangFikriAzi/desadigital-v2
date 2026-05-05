<script>
    $(document).ready(function() {
        $('#addDetailBtn').click(function() {
            const html = `
                <div class="row mb-2 detail-row">
                    <div class="col-md-3">
                        <label class="form-label">Label</label>
                        <input type="text" class="form-control" placeholder="Label" name="label[]">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Nilai</label>
                        <input type="number" class="form-control" placeholder="Value" name="value[]">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Warna</label>
                        <input type="color" class="form-control" name="color[]">
                    </div>
                    <div class="col-md-3">
                        <button type="button" class="btn btn-danger btn-sm remove-detail">Remove</button>
                    </div>
                </div>`;
            $('#detailContainer').append(html);
        });

        $(document).on('click', '.remove-detail', function() {
            $(this).closest('.detail-row').remove();
        });

        $('#villageForm').submit(function(e) {
            e.preventDefault();

            const villageDetail = [];
            const labels = $("input[name='label[]']");
            const values = $("input[name='value[]']");
            const colors = $("input[name='color[]']");

            labels.each(function(i) {
                villageDetail.push({
                    label: $(this).val(),
                    value: values.eq(i).val(),
                    color: colors.eq(i).val()
                });
            });

            const payload = {
                villagedata: {
                    type_chart: $('[name="type_chart"]').val(),
                    title: $('[name="title"]').val(),
                    is_active: $('#is_active').is(':checked'),
                    villageDetail: villageDetail
                }
            };

            const isEdit = window.location.pathname.includes('edit');
            const id = @json(isset($data) && $data ? $data->id : null);

            let url = '';
            let method = '';

            if (isEdit && id) {
                url = `/villagedata/${id}`;
                method = 'PUT';
            } else {
                url = `/villagedata`;
                method = 'POST';
            }

            $.ajax({
                url: url,
                method: method,
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                data: JSON.stringify(payload),
                contentType: 'application/json',
                success: function(response) {
                    showSuccess("Data berhasil disimpan.",
                        "{{ secure_url(route("villagedata.index", [], false)) }}")
                },
                error: function(err) {
                    let errorMsg = 'Terjadi kesalahan saat menyimpan data.';
                    // Ambil pesan dari server jika ada
                    if (err.responseJSON) {
                        if (err.responseJSON.message) {
                            errorMsg = err.responseJSON.message;
                        }

                        // Jika ada daftar error validasi
                        if (err.responseJSON.errors) {
                            const errors = err.responseJSON.errors;
                            errorMsg += '<ul>';
                            for (const field in errors) {
                                errors[field].forEach(msg => {
                                    errorMsg += `<li>${msg}</li>`;
                                });
                            }
                            errorMsg += '</ul>';
                        }
                    }

                    showError(errorMsg);
                }
            });
        });
    });
</script>
