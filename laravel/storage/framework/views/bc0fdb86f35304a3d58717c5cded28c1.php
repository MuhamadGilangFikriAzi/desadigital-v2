<?php $__env->startSection("content"); ?>
    <div class="container">
        <h2>Produk<?php echo e($store ? ' di ' . $store->name : ''); ?></h2>

        <?php if($store): ?>
            <a href="<?php echo e(route("stores.products.create", $store->id)); ?>" class="btn btn-primary mb-3">Tambah Produk</a>
        <?php else: ?>
            <p class="text-gray-500 mb-3">Pilih toko tertentu untuk menambah produk.</p>
        <?php endif; ?>

        <?php if($products->count()): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Gambar</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <?php if($product->img_product): ?>
                                    <img src="<?php echo e(asset("storage/" . $product->img_product)); ?>" width="80">
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($product->name_product); ?></td>
                            <td>Rp <?php echo e(number_format($product->price, 0, ",", ".")); ?></td>
                            <td><?php echo e($product->desc); ?></td>
                            <td>
                                <?php if($store): ?>
                                <a href="<?php echo e(route("stores.products.edit", [$store->id, $product->id])); ?>"
                                    class="btn btn-warning btn-sm">Edit</a>

                                <form action="<?php echo e(route("stores.products.destroy", [$store->id, $product->id])); ?>"
                                    method="POST" style="display:inline-block;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field("DELETE"); ?>
                                    <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin hapus produk ini?')">Hapus</button>
                                </form>
                                <?php else: ?>
                                <a href="<?php echo e(route("products.index", $product->store_id)); ?>" class="btn btn-info btn-sm">Lihat di Toko</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>

            <?php echo e($products->links()); ?>

        <?php else: ?>
            <p>Tidak ada produk.</p>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("layouts.app", array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/products/index.blade.php ENDPATH**/ ?>