<?php $__env->startSection("content"); ?>
    <div class="w-full">
        <div class="admin-card-header flex justify-between items-center pl-1">
            <h5 class="mb-0"><i class="fas fa-database mr-2"></i> Referensi Master</h5>
        </div>

        <div class="p-4">
            <div class="flex justify-between items-center mb-4">
                <a href="<?php echo e(route("refmaster.create")); ?>" class="inline-flex items-center gap-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition text-sm">
                    <i class="fas fa-plus"></i> Tambah Referensi
                </a>
            </div>

            <?php if(session("success")): ?>
                <div class="bg-green-100 border-l-4 border-green-500 text-green-800 p-4 rounded-r-lg mb-4"><?php echo e(session("success")); ?></div>
            <?php endif; ?>

            <form method="GET" action="<?php echo e(route("refmaster.index")); ?>" class="mb-4">
                <div class="flex gap-2">
                    <input type="text" name="q" class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Cari..." value="<?php echo e(request("q")); ?>">
                    <button class="inline-flex items-center gap-1 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium py-2 px-4 rounded-lg transition text-sm" type="submit">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </div>
            </form>

            <?php if($refMasters->count()): ?>
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse bg-white rounded-lg overflow-hidden shadow-sm">
                        <thead class="bg-gray-50 text-gray-700 text-sm uppercase tracking-wider">
                            <tr>
                                <th class="px-4 py-3 text-left">ID</th>
                                <th class="px-4 py-3 text-left">Tipe</th>
                                <th class="px-4 py-3 text-left">Nama</th>
                                <th class="px-4 py-3 text-left">Nilai</th>
                                <th class="px-4 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php $__currentLoopData = $refMasters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-3 font-mono text-sm"><?php echo e($item->id); ?></td>
                                    <td class="px-4 py-3"><?php echo e($item->refMasterType->ref_master_type_name ?? $item->ref_master_type_code); ?></td>
                                    <td class="px-4 py-3 font-medium"><?php echo e($item->ref_master_name); ?></td>
                                    <td class="px-4 py-3 text-sm text-gray-600"><?php echo e(Str::limit($item->ref_master_value, 50)); ?></td>
                                    <td class="px-4 py-3 text-center">
                                        <div class="flex justify-center gap-2">
                                            <a href="<?php echo e(route("refmaster.edit", $item->id)); ?>" class="inline-flex items-center gap-1 bg-yellow-100 hover:bg-yellow-200 text-yellow-700 text-sm py-1.5 px-3 rounded-lg transition">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="<?php echo e(route("refmaster.destroy", $item->id)); ?>" method="POST" class="inline">
                                                <?php echo csrf_field(); ?> <?php echo method_field("DELETE"); ?>
                                                <button onclick="return confirm('Yakin hapus?')" class="inline-flex items-center gap-1 bg-red-100 hover:bg-red-200 text-red-700 text-sm py-1.5 px-3 rounded-lg transition">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <div class="mt-4"><?php echo e($refMasters->appends(request()->query())->links()); ?></div>
            <?php else: ?>
                <div class="text-center text-gray-500 py-8">Belum ada data referensi master.</div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("layouts.app", array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/refmaster/index.blade.php ENDPATH**/ ?>