

<?php $__env->startSection("content"); ?>
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center pl-2">
            <h5 class="mb-0"><i class="fas fa-envelope mr-2"></i>Template Surat</h5>

        </div>
        <a href="<?php echo e(route("templatesurat.create")); ?>" class="btn btn-outline-primary ml-auto float-right my-2">
            <i class="fas fa-plus"></i> Tambah Template
        </a>
        <div class="card-body">
            <form action="<?php echo e(route("templatesurat.index")); ?>" method="get" class="mb-4">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label>ID</label>
                        <input type="text" name="id" class="form-control" value="<?php echo e($filter["id"] ?? ""); ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Jenis Surat</label>
                        <input type="text" name="type_surat" class="form-control"
                            value="<?php echo e($filter["type_surat"] ?? ""); ?>">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Status</label>
                        <select name="is_active" class="form-control">
                            <option value="">Semua</option>
                            <option value="1"
                                <?php echo e(isset($filter["is_active"]) && $filter["is_active"] == "1" ? "selected" : ""); ?>>Aktif
                            </option>
                            <option value="0"
                                <?php echo e(isset($filter["is_active"]) && $filter["is_active"] == "0" ? "selected" : ""); ?>>Tidak
                                Aktif</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2 d-flex align-items-end justify-content-end">
                        <button type="submit" class="btn btn-outline-primary mr-2">Cari</button>
                        <a href="<?php echo e(route("templatesurat.index")); ?>" class="btn btn-outline-secondary">Reset</a>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="thead-light">
                        <tr class="text-center">
                            <th>ID</th>
                            <th>Jenis Surat</th>
                            <th>Tanggal Buat</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="text-center">
                                <td><strong><?php echo e($data->id); ?></strong></td>
                                <td><?php echo e($data->type_surat); ?></td>
                                <td><?php echo e(date("d M Y", strtotime($data->created_at))); ?></td>
                                <td>
                                    <?php if($data->is_active): ?>
                                        <span class="badge badge-success">Aktif</span>
                                    <?php else: ?>
                                        <span class="badge badge-secondary">Tidak Aktif</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?php echo e(url("/templatesurat/edit/" . $data->id)); ?>"
                                        class="btn btn-sm btn-outline-dark">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr class="text-center">
                                <td colspan="5">Tidak ada data ditemukan.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <div><?php echo e($list->links()); ?></div>
                <div class="text-muted">Total entries: <?php echo e($count); ?></div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("layouts.app", array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/templatesurat/index.blade.php ENDPATH**/ ?>