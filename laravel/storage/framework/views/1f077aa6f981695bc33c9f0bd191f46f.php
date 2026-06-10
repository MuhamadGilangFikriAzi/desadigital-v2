<?php $__env->startSection("content"); ?>
    <?php if (\Illuminate\Support\Facades\Blade::check('role', "Guest")): ?>
        <div class="bg-red-100 border-l-4 border-red-500 text-red-800 p-4 rounded-r-lg mb-4 font-bold text-center">
            <i class="fas fa-exclamation-triangle mr-2"></i> Akun belum diverifikasi oleh Staff Desa!, Silahkan cek secara berkala
        </div>
        <?php if(!empty($user->note_reject)): ?>
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-800 p-4 rounded-r-lg mb-4 text-center">
                <i class="fas fa-ban mr-2"></i> Akun ditolak Staff Desa dengan alasan: <br>
                <em><?php echo e($user->note_reject); ?></em>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <?php if (\Illuminate\Support\Facades\Blade::check('hasanyrole', "User|Staff Desa")): ?>
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="admin-card-header flex justify-between items-center pl-2">
                <h5 class="mb-0"><i class="fas fa-envelope mr-2"></i> Surat</h5>
                <?php if (\Illuminate\Support\Facades\Blade::check('role', "User")): ?>
                    <a href="<?php echo e(route("surat.create")); ?>" class="inline-flex items-center gap-1 bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg transition text-sm ml-auto">
                        <i class="fas fa-plus"></i> Tambah Surat
                    </a>
                <?php endif; ?>
            </div>

            <div class="admin-card-body">
                <form action="<?php echo e(route("surat.index")); ?>" method="get" class="flex flex-wrap -mx-3 mb-4">
                    <div class="w-full md:w-1/3 px-3 mb-3 md:mb-0">
                        <label class="block text-sm font-medium text-gray-700 mb-1">ID</label>
                        <input type="text" name="id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="<?php echo e($filter["id"]); ?>">
                    </div>
                    <div class="w-full md:w-1/3 px-3 mb-3 md:mb-0">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Surat</label>
                        <select name="template_surat_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white" id="type_surat">
                            <option value="">Pilih...</option>
                            <?php $__currentLoopData = $listTemplateSurat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($item->id); ?>" <?php if(isset($filter["template_surat_id"]) && $filter["template_surat_id"] == $item->id): ?> selected <?php endif; ?>>
                                    <?php echo e($item->type_surat); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="w-full md:w-1/3 px-3 mb-3 md:mb-0">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Buat</label>
                        <input type="date" name="created_at" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="<?php echo e($filter["created_at"]); ?>">
                    </div>

                    <div class="w-full px-3 mt-3 flex flex-wrap gap-2 justify-end">
                        <?php if (\Illuminate\Support\Facades\Blade::check('role', "Staff Desa")): ?>
                            <button type="button" class="inline-flex items-center gap-1 bg-green-50 hover:bg-green-100 text-green-700 font-medium py-2 px-4 rounded-lg transition text-sm" data-toggle="modal" data-target="#report">
                                <i class="fas fa-download"></i> Download Laporan Surat
                            </button>
                        <?php endif; ?>
                        <button type="reset" class="inline-flex items-center gap-1 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium py-2 px-4 rounded-lg transition text-sm">Reset</button>
                        <button type="submit" class="inline-flex items-center gap-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition text-sm">
                            <i class="fas fa-search"></i> Cari
                        </button>
                    </div>
                </form>

                <div class="overflow-x-auto">
                    <table class="w-full border-collapse bg-white rounded-lg overflow-hidden shadow-sm">
                        <thead class="bg-gray-50 text-gray-700 text-sm uppercase tracking-wider">
                            <tr>
                                <th class="px-4 py-3 text-center">ID</th>
                                <th class="px-4 py-3 text-center">Jenis Surat</th>
                                <th class="px-4 py-3 text-center">Tanggal Buat</th>
                                <?php if (\Illuminate\Support\Facades\Blade::check('role', "Staff Desa")): ?>
                                    <th class="px-4 py-3 text-center">Dibuat Oleh</th>
                                <?php endif; ?>
                                <th class="px-4 py-3 text-center">Kode Surat Diprint</th>
                                <th class="px-4 py-3 text-center">Tanggal Surat Diprint Terakhir</th>
                                <th class="px-4 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php $__empty_1 = true; $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-3 text-center font-medium"><?php echo e($data->id); ?></td>
                                    <td class="px-4 py-3 text-center"><?php echo e($data->template_surat->type_surat); ?></td>
                                    <td class="px-4 py-3 text-center"><?php echo e(date("d M Y", strtotime($data->created_at))); ?></td>
                                    <?php if (\Illuminate\Support\Facades\Blade::check('role', "Staff Desa")): ?>
                                        <td class="px-4 py-3 text-center"><?php echo e($data->user->name); ?></td>
                                    <?php endif; ?>
                                    <td class="px-4 py-3 text-center"><?php echo e($data->code_surat_printed ?? "-"); ?></td>
                                    <td class="px-4 py-3 text-center"><?php echo e($data->printed_at ? date("d M Y H:i", strtotime($data->printed_at)) : "-"); ?></td>
                                    <td class="px-4 py-3 text-center">
                                        <div class="flex justify-center gap-1">
                                            <?php if (\Illuminate\Support\Facades\Blade::check('role', "User")): ?>
                                                <?php if(!$data->code_surat_printed): ?>
                                                    <a href="<?php echo e(url("/surat/edit/" . $data->id)); ?>" class="inline-flex items-center gap-1 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm py-1.5 px-3 rounded-lg transition">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php if (\Illuminate\Support\Facades\Blade::check('role', "Staff Desa")): ?>
                                                <button class="inline-flex items-center gap-1 bg-blue-50 hover:bg-blue-100 text-blue-600 text-sm py-1.5 px-3 rounded-lg transition btn-print"
                                                    data-id="<?php echo e($data->id); ?>" data-toggle="modal" data-target="#print">
                                                    <i class="fas fa-print"></i>
                                                </button>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="7" class="px-4 py-8 text-center text-gray-500">Tidak Ada Surat</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                        <tfoot class="bg-gray-50">
                            <tr>
                                <td colspan="3" class="px-4 py-3"><?php echo e($list->links()); ?></td>
                                <td colspan="4" class="px-4 py-3 text-right text-gray-500 text-sm">Total entries: <?php echo e($count); ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Print Modal -->
    <div class="fixed inset-0 z-50 hidden overflow-y-auto" id="print-modal" x-data="{ open: false }" x-show="open" x-transition>
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="open = false"></div>
            <div class="relative inline-block bg-white rounded-xl shadow-2xl max-w-4xl w-full mx-4 z-10">
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
                    <h5 class="text-lg font-semibold" id="print-title">Print Surat</h5>
                    <button type="button" class="text-gray-400 hover:text-gray-600 text-2xl leading-none" onclick="document.getElementById('print-modal').classList.add('hidden')">&times;</button>
                </div>
                <div class="px-6 py-4" id="print-body">
                    <form id="generatePDF" action="#" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Surat</label>
                            <input type="text" name="jenis" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-50 jenisSurat" disabled>
                            <input type="hidden" name="jenisSurat" class="jenisSurat">
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Kode Surat</label>
                            <input type="text" name="codeSurat" id="codeSurat" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div class="documents mb-4"></div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Body Surat</label>
                            <textarea class="w-full px-3 py-2 border border-gray-300 rounded-lg" id="editor" name="bodySurat"></textarea>
                            <input type="hidden" name="id" class="hidden-id">
                        </div>
                        <button type="submit" id="form-submit" style="opacity: 0; position: absolute;"></button>
                    </form>
                </div>
                <div class="flex justify-end gap-3 px-6 py-4 border-t border-gray-200 bg-gray-50 rounded-b-xl">
                    <button type="button" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg transition text-sm btn-generate-pdf">Print</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Report Modal -->
    <div class="fixed inset-0 z-50 hidden overflow-y-auto" id="report-modal" x-data="{ open: false }" x-show="open" x-transition>
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="open = false"></div>
            <div class="relative inline-block bg-white rounded-xl shadow-2xl max-w-2xl w-full mx-4 z-10">
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
                    <h5 class="text-lg font-semibold" id="report-title">Download Laporan Surat</h5>
                    <button type="button" class="text-gray-400 hover:text-gray-600 text-2xl leading-none" onclick="document.getElementById('report-modal').classList.add('hidden')">&times;</button>
                </div>
                <div class="px-6 py-4">
                    <form id="generateReport" action="<?php echo e(url("/admin/surat/export/0")); ?>" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Surat</label>
                            <select name="template_surat_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-white report-input" data-label="Jenis Surat" id="type_surat_report">
                                <option selected value="all">Semua</option>
                                <?php $__currentLoopData = $listTemplateSurat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($item->id); ?>"><?php echo e($item->type_surat); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Print Surat</label>
                            <div class="flex flex-wrap items-center gap-3">
                                <input type="date" name="date_start" data-label="Tanggal Awal" id="tanggal_awal_report" class="flex-1 px-3 py-2 border border-gray-300 rounded-lg report-input">
                                <span class="text-gray-500 text-sm">Sampai dengan</span>
                                <input type="date" name="date_end" data-label="Tanggal Akhir" id="tanggal_akhir_report" class="flex-1 px-3 py-2 border border-gray-300 rounded-lg report-input">
                            </div>
                        </div>
                        <button type="submit" id="btn-generate-report" hidden></button>
                    </form>
                </div>
                <div class="flex justify-end gap-3 px-6 py-4 border-t border-gray-200 bg-gray-50 rounded-b-xl">
                    <button type="button" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg transition text-sm btn-generate-report">Download Laporan</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Hook modal toggles for Bootstrap → Tailwind modal
            $('[data-target="#print"]').on('click', function() {
                document.getElementById('print-modal').classList.remove('hidden');
            });
            $('[data-target="#report"]').on('click', function() {
                document.getElementById('report-modal').classList.remove('hidden');
            });

            let validateReport = () => {
                let inputan = $('.report-input');
                let textError = '';
                inputan.each(function() {
                    let value = $(this).val();
                    let label = $(this).attr('data-label');
                    if (value === undefined || value === '') textError += label + ' wajib diisi ! <br/>';
                });
                if (textError === '') {
                    let tanggalAwal = $('#tanggal_awal_report').val();
                    let tanggalAkhir = $('#tanggal_akhir_report').val();
                    if (tanggalAwal > tanggalAkhir) {
                        textError += 'Tanggal Awal tidak boleh lebih besar dari tanggal akhir ! <br/>';
                    }
                }
                return textError;
            }

            $(document).on('click', '.reset-filter', function() {
                $('.filter').val("");
                var url = '<?php echo e(url("/surat/" . ":id")); ?>';
                url = url.replace(':id', '');
            });

            $(document).on('click', '.btn-print', function() {
                let id = $(this).attr('data-id');
                $('.hidden-id').val(id);
                $.ajax({
                    headers: { 'X-CSRF-TOKEN': "<?php echo e(csrf_token()); ?>" },
                    method: "POST",
                    url: "<?php echo e(route("surat.index")); ?>",
                    data: { 'id': id },
                    success: function(data) {
                        console.log(data)
                        $('#editor').val(data.data.bodySurat);
                        $('.jenisSurat').val(data.data.jenisSurat);
                        $('#codeSurat').val(data.data.codeSurat);
                        if (data.data.isRePrint) {
                            $('.btn-generate-pdf').html('Print Ulang')
                        } else {
                            $('.btn-generate-pdf').html('Print');
                        }
                        if (data.data.document !== undefined && data.data.document.length > 0) {
                            $('.documents').html("");
                            data.data.document.forEach(doc => {
                                let url = doc.value;
                                $('.documents').append(`<div class="mb-3">
                                    <a href="${url}" target="_blank" class="text-blue-600 hover:text-blue-800 underline text-sm">Lihat ${doc.label}</a>
                                </div>`);
                            });
                        } else {
                            $('.documents').html("");
                        }
                        $('#editor').val(data.data.bodySurat);
                        generateTextareaReport();
                    }
                });
            });

            $(document).on('click', '.btn-generate-pdf', function() {
                $("#form-submit").click();
            })

            $(document).on('click', '.close, button[x-data]', function() {
                $('#editor').trumbowyg('destroy');
                $('#editor').val('');
            });

            $(document).on('click', '.btn-generate-report', function() {
                let tipeSurat = $('#type_surat_report').val();
                let tanggalAwal = $('#tanggal_awal_report').val();
                let tanggalAkhir = $('#tanggal_akhir_report').val();
                let validasi = validateReport()
                if (validasi === '') {
                    Swal.fire({
                        title: "Apakah anda yakin?",
                        text: "Download Laporan Ini?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Ya, Download!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#btn-generate-report').click();
                        }
                    });
                } else {
                    showValidateionError(validasi)
                }
            });

            function generateTextareaReport() {
                $('#editor').trumbowyg({
                    btns: [
                        ['fontsize', 'fontfamily'],
                        ['bold', 'italic', 'underline', 'strikethrough'],
                        ['link'], ['insertImage'],
                        ['unorderedList', 'orderedList'],
                        ['horizontalRule'],
                        ['table', 'tableCellBackgroundColor', 'tableBorderColor'],
                        ['foreColor', 'backColor'],
                        ['alignLeft', 'alignCenter', 'alignRight'],
                        ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
                        ['emoticons'], ['fontAwesome'],
                    ],
                    plugins: {
                        fontsize: {
                            sizeList: ['8px', '10px', '12px', '14px', '16px', '18px', '20px', '24px', '30px', '36px', '48px']
                        }
                    },
                    resetCss: false,
                });
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("layouts.app", array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/surat/index.blade.php ENDPATH**/ ?>