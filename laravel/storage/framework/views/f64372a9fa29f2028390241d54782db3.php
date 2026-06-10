<?php $__env->startSection('title', $store->name . ' - Pasar Desa Digital'); ?>

<?php $__env->startSection('content'); ?>
    <div class="container mx-auto px-4 py-8 max-w-5xl">
        <a href="<?php echo e(route('pasardesa')); ?>" class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium py-2 px-4 rounded transition mb-4">
            ← Kembali ke daftar toko
        </a>

        <!-- Detail Toko -->
        <div class="bg-white rounded-lg shadow-sm mb-6">
            <div class="flex flex-col md:flex-row">
                <?php if($store->img_store): ?>
                    <div class="w-full md:w-1/3">
                        <img src="<?php echo e(asset($store->img_store)); ?>" class="w-full h-64 md:h-full object-cover rounded-t-lg md:rounded-l-lg md:rounded-t-none cursor-pointer" alt="<?php echo e($store->name); ?>"
                            onclick="showImageModal('<?php echo e(asset($store->img_store)); ?>')">
                    </div>
                <?php endif; ?>
                <div class="w-full md:w-2/3 p-6">
                    <h3 class="text-2xl font-bold text-gray-800"><?php echo e($store->name); ?></h3>
                    <p class="text-gray-600 mt-2"><?php echo e($store->desc); ?></p>
                    <?php if($store->whatsapp_no): ?>
                        <p class="mt-3">WhatsApp: <a href="https://wa.me/<?php echo e($store->whatsapp_no); ?>" target="_blank" class="text-blue-600 hover:underline"><?php echo e($store->whatsapp_no); ?></a></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Produk -->
        <h4 class="text-xl font-bold text-gray-800 mb-4">Produk Toko</h4>

        <?php if($store->products->count()): ?>
            <div class="flex flex-wrap -mx-3">
                <?php $__currentLoopData = $store->products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="w-full md:w-1/2 lg:w-1/3 px-3 mb-4 flex">
                        <div class="bg-white rounded-lg shadow-sm w-full flex flex-col card-hover">
                            <?php if($product->img_product): ?>
                                <img src="<?php echo e(asset($product->img_product)); ?>" class="w-full h-48 object-cover rounded-t-lg cursor-pointer" alt="<?php echo e($product->name_product); ?>"
                                    onclick="showImageModal('<?php echo e(asset($product->img_product)); ?>')">
                            <?php endif; ?>
                            <div class="p-4 flex flex-col flex-grow">
                                <h5 class="font-bold text-gray-800"><?php echo e($product->name_product); ?></h5>
                                <p class="text-gray-500 text-sm flex-grow mt-1"><?php echo e(Str::limit($product->desc, 80)); ?></p>
                                <p class="font-bold text-gray-900 mt-2">Rp <?php echo e(number_format($product->price, 0, ',', '.')); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <p class="text-gray-500 text-center py-8">Belum ada produk untuk toko ini.</p>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app_front', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/profilevillage/showpasardesa.blade.php ENDPATH**/ ?>