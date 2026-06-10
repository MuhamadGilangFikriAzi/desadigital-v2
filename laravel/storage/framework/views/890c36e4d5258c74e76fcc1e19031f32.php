<?php $__env->startSection("content"); ?>
    <div class="w-full">
        <div class="admin-card-header flex justify-between items-center pl-1">
            <h5 class="mb-0"><i class="fa fa-store mr-2"></i>Daftar Toko</h5>
        </div>

        <div class="p-4">
            <div class="flex justify-between items-center mb-4">
                <a href="<?php echo e(route("stores.create")); ?>" class="inline-flex items-center gap-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition text-sm">
                    <i class="fas fa-plus"></i> Tambah Toko
                </a>
            </div>

            <?php if(session("success")): ?>
                <div class="bg-green-100 border-l-4 border-green-500 text-green-800 p-4 rounded-r-lg mb-4"><?php echo e(session("success")); ?></div>
            <?php endif; ?>

            <form method="GET" action="<?php echo e(route("stores.index")); ?>" class="mb-4">
                <div class="flex gap-2">
                    <input type="text" name="q" class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Cari Nama Toko..." value="<?php echo e(request("q")); ?>">
                    <button class="inline-flex items-center gap-1 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium py-2 px-4 rounded-lg transition text-sm" type="submit">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </div>
            </form>

            <?php if($stores->count()): ?>
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse bg-white rounded-lg overflow-hidden shadow-sm">
                        <thead class="bg-gray-50 text-gray-700 text-sm uppercase tracking-wider">
                            <tr>
                                <th class="px-4 py-3 text-left">Gambar</th>
                                <th class="px-4 py-3 text-left">Nama Toko</th>
                                <th class="px-4 py-3 text-left">No. WhatsApp</th>
                                <th class="px-4 py-3 text-left">Deskripsi</th>
                                <th class="px-4 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php $__currentLoopData = $stores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $store): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-3">
                                        <?php if($store->img_store): ?>
                                            <img src="<?php echo e(asset($store->img_store)); ?>" width="80" class="rounded-lg cursor-pointer" onclick="showImageModal('<?php echo e(asset($store->img_store)); ?>')">
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-4 py-3 font-medium"><?php echo e($store->name); ?></td>
                                    <td class="px-4 py-3"><?php echo e($store->whatsapp_no); ?></td>
                                    <td class="px-4 py-3 text-sm text-gray-600"><?php echo e($store->desc); ?></td>
                                    <td class="px-4 py-3 text-center">
                                        <div class="flex justify-center gap-2">
                                            <a href="<?php echo e(route("stores.edit", $store->id)); ?>" class="inline-flex items-center gap-1 bg-yellow-100 hover:bg-yellow-200 text-yellow-700 text-sm py-1.5 px-3 rounded-lg transition">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="<?php echo e(route("stores.destroy", $store->id)); ?>" method="POST" class="inline">
                                                <?php echo csrf_field(); ?> <?php echo method_field("DELETE"); ?>
                                                <button onclick="return confirm('Yakin hapus toko ini?')" class="inline-flex items-center gap-1 bg-red-100 hover:bg-red-200 text-red-700 text-sm py-1.5 px-3 rounded-lg transition">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                            <a href="<?php echo e(route("products.index", $store->id)); ?>" class="inline-flex items-center gap-1 bg-blue-50 hover:bg-blue-100 text-blue-600 text-sm py-1.5 px-3 rounded-lg transition">
                                                <i class="fas fa-box"></i> Produk
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <div class="mt-4"><?php echo e($stores->appends(request()->query())->links()); ?></div>
            <?php else: ?>
                <div class="text-center text-gray-500 py-8">Belum ada toko.</div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("layouts.app", array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/stores/index.blade.php ENDPATH**/ ?>