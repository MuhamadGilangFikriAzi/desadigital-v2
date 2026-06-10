

<?php $__env->startSection("content"); ?>
    <div class="card-header d-flex justify-content-between align-items-center pl-2">
        <h5 class="mb-0"><i class="fas fa-database mr-2"></i>Data Desa</h5>

    </div>
    <div class="card-body">
        <!-- Add Button Aligned Right -->
        <div class="d-flex justify-content-end mb-3">
            <a href="<?php echo e(route("villagedata.create")); ?>" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Tambah Data Desa
            </a>
        </div>

        <!-- Filter Form -->
        <form method="GET" action="<?php echo e(route("villagedata.index")); ?>" class="mb-3">
            <div class="row">
                <div class="col-md-3">
                    <input type="text" name="title" class="form-control" placeholder="Search Title"
                        value="<?php echo e(request("title")); ?>">
                </div>
                <div class="col-md-3">
                    <select name="type_chart" class="form-control">
                        <option value="">--Tipe Chart --</option>
                        <?php $__currentLoopData = $chartType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($value); ?>" <?php if(request("type_chart") == $value): ?> selected <?php endif; ?>>
                                <?php echo e($key); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <!-- Add more options if needed -->
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="is_active" class="form-control">
                        <option value="">-- Status --</option>
                        <option value="1" <?php echo e(request("is_active") === "1" ? "selected" : ""); ?>>Aktif</option>
                        <option value="0" <?php echo e(request("is_active") === "0" ? "selected" : ""); ?>>Tidak Aktif</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-filter"></i> Filter
                    </button>
                    <a href="<?php echo e(route("villagedata.index")); ?>" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>

        <!-- Data Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Tipe Chart</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td><?php echo e($item->title); ?></td>
                        <td><?php echo e($item->type_chart); ?></td>
                        <td>
                            <span class="badge <?php echo e($item->is_active ? "badge-success" : "badge-danger"); ?>">
                                <?php echo e($item->is_active ? "Aktif" : "Tidak Aktif"); ?>

                            </span>
                        </td>
                        <td>
                            <a href="<?php echo e(url("/villagedata/edit/" . $item->id)); ?>" class="btn btn-sm btn-primary">Ubah</a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada data</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <?php echo e($data->links()); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("layouts.app", array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/villagedata/index.blade.php ENDPATH**/ ?>