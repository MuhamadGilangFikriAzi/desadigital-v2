<?php $__env->startSection("content"); ?>
    <div class="admin-card-header flex justify-between items-center pl-2">
        <h5 class="mb-0"><i class="fas fa-newspaper mr-2"></i>Daftar Berita</h5>
    </div>

    <div class="mb-4 flex flex-wrap justify-between items-center gap-3 px-3 pt-3">
        <a href="<?php echo e(route("news.create")); ?>" class="inline-flex items-center gap-1 bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg transition text-sm">
            <i class="fas fa-plus"></i> Tambah Berita
        </a>

        <!-- Filter Form -->
        <form action="<?php echo e(route("news.index")); ?>" method="GET" class="flex items-center gap-2">
            <label for="status" class="text-sm text-gray-600">Filter Status:</label>
            <select name="status" class="px-3 py-1.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" onchange="this.form.submit()">
                <option value="">-- Semua Status --</option>
                <option value="1" <?php echo e(request("status") == "1" ? "selected" : ""); ?>>Aktif</option>
                <option value="0" <?php echo e(request("status") == "0" ? "selected" : ""); ?>>Tidak Aktif</option>
            </select>
        </form>
    </div>

    <?php $__empty_1 = true; $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-4 hover:shadow-md transition">
            <div class="p-5">
                <div class="flex justify-between items-start gap-3">
                    <h4 class="text-lg font-semibold text-gray-900"><?php echo e($item->title); ?></h4>
                    <?php if($item->is_active): ?>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 shrink-0">Aktif</span>
                    <?php else: ?>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-200 text-gray-600 shrink-0">Tidak Aktif</span>
                    <?php endif; ?>
                </div>

                <p class="text-gray-600 text-sm mt-2 leading-relaxed"><?php echo Str::limit($item->content, 250); ?></p>

                <?php if($item->image): ?>
                    <img src="<?php echo e(asset("storage/news/" . $item->image)); ?>" width="100" class="mt-2 max-w-full h-auto rounded">
                <?php endif; ?>

                <div class="flex justify-between items-center mt-4 pt-3 border-t border-gray-100">
                    <small class="text-gray-500">Penulis: <?php echo e($item->author); ?></small>
                    <div class="flex gap-2">
                        <a href="<?php echo e(route("news.show", $item->id)); ?>" class="inline-flex items-center gap-1 bg-blue-50 hover:bg-blue-100 text-blue-600 text-sm py-1.5 px-3 rounded-lg transition">
                            <i class="fas fa-eye"></i> Lihat
                        </a>
                        <a href="<?php echo e(route("news.edit", $item->id)); ?>" class="inline-flex items-center gap-1 bg-yellow-50 hover:bg-yellow-100 text-yellow-600 text-sm py-1.5 px-3 rounded-lg transition">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="<?php echo e(route("news.destroy", $item->id)); ?>" method="POST" class="inline">
                            <?php echo csrf_field(); ?> <?php echo method_field("DELETE"); ?>
                            <button onclick="return confirm('Yakin hapus?')" class="inline-flex items-center gap-1 bg-red-50 hover:bg-red-100 text-red-600 text-sm py-1.5 px-3 rounded-lg transition">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="bg-blue-50 text-blue-700 text-center py-4 px-4 rounded-lg">Tidak ada berita ditemukan.</div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("layouts.app", array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/news/index.blade.php ENDPATH**/ ?>