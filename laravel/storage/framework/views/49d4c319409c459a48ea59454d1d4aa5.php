<?php $__env->startSection("content"); ?>
    <div class="admin-card-header flex justify-between items-center pl-2">
        <h5 class="mb-0"><i class="fas fa-user-tie mr-2"></i>Aparatur Desa</h5>
    </div>

    <div class="admin-card-body">
        <div class="flex justify-between items-center mb-4">
            <h5 class="m-0 text-lg font-semibold">List Aparatur</h5>
            <a href="<?php echo e(route("aparatur.create")); ?>" class="inline-flex items-center gap-1 bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg transition text-sm">
                <i class="fas fa-plus"></i> Tambah Aparatur
            </a>
        </div>

        <?php if(session("success")): ?>
            <div class="bg-green-100 border-l-4 border-green-500 text-green-800 p-4 rounded-r-lg mb-4 flex justify-between items-center" role="alert">
                <span><?php echo e(session("success")); ?></span>
                <button onclick="this.parentElement.remove()" class="text-green-600 hover:text-green-800">&times;</button>
            </div>
        <?php endif; ?>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse bg-white rounded-lg overflow-hidden shadow-sm">
                <thead class="bg-gray-50 text-gray-700 text-sm uppercase tracking-wider">
                    <tr>
                        <th class="px-4 py-3 text-left">Foto</th>
                        <th class="px-4 py-3 text-left">Nama</th>
                        <th class="px-4 py-3 text-left">Jabatan</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php $__currentLoopData = $aparatur; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3">
                                <?php if($data->photo): ?>
                                    <img src="<?php echo e(asset("img/aparatur/img/" . $data->photo)); ?>" class="rounded-full w-12 h-12 object-cover"
                                        alt="Foto" onclick="showImageModal('<?php echo e(asset("img/aparatur/img/" . $data->photo)); ?>')">
                                <?php else: ?>
                                    <img src="<?php echo e(asset("img/default-user.png")); ?>" class="rounded-full w-12 h-12 object-cover" alt="Default Foto">
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-3 font-medium text-gray-900"><?php echo e($data->name); ?></td>
                            <td class="px-4 py-3 text-gray-600"><?php echo e($data->position); ?></td>
                            <td class="px-4 py-3">
                                <?php if($data->is_active): ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Aktif</span>
                                <?php else: ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Tidak Aktif</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-3 text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="<?php echo e(route("aparatur.edit", $data->id)); ?>" class="inline-flex items-center gap-1 bg-blue-500 hover:bg-blue-600 text-white text-sm py-1.5 px-3 rounded-lg transition">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="<?php echo e(route("aparatur.destroy", $data->id)); ?>" method="POST" class="inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field("DELETE"); ?>
                                        <button type="submit" onclick="return confirm('Yakin hapus?')" class="inline-flex items-center gap-1 bg-red-500 hover:bg-red-600 text-white text-sm py-1.5 px-3 rounded-lg transition">
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
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("layouts.app", array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/aparatur/index.blade.php ENDPATH**/ ?>