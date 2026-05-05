<?php $__env->startSection('title', 'Berita Desa Digital'); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-header">
        <div class="container text-center">
            <h1 class="text-white text-3xl md:text-4xl font-bold">Berita Desa Digital</h1>
            <p class="text-blue-200 mt-2">Informasi dan kabar terbaru dari desa</p>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8 max-w-5xl">

        <?php $__empty_1 = true; $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $berita): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="bg-white rounded-lg shadow-sm mb-6 card-hover overflow-hidden">
                <div class="flex flex-col md:flex-row">
                    <div class="w-full md:w-1/3">
                        <?php if($berita->image): ?>
                            <img src="<?php echo e(Storage::url('news/' . $berita->image)); ?>" class="w-full h-48 md:h-full object-cover" alt="Gambar Berita">
                        <?php else: ?>
                            <img src="<?php echo e(asset('img/default-news.jpg')); ?>" class="w-full h-48 md:h-full object-cover" alt="Default Gambar">
                        <?php endif; ?>
                    </div>
                    <div class="w-full md:w-2/3 p-6">
                        <h5 class="text-xl font-bold text-blue-700"><?php echo e($berita->title); ?></h5>
                        <p class="text-gray-500 text-sm mb-1">Ditulis oleh: <strong><?php echo e($berita->author); ?></strong></p>
                        <p class="text-gray-600 mt-2"><?php echo e(Str::limit(strip_tags($berita->content), 200, '...')); ?></p>
                        <a href="<?php echo e(route('berita.show', $berita->id)); ?>" class="inline-block mt-3 border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white font-medium text-sm py-1.5 px-4 rounded transition">
                            Baca Selengkapnya
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="text-center py-12">
                <p class="text-gray-500 text-lg">Belum ada berita.</p>
            </div>
        <?php endif; ?>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app_front', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/profilevillage/news.blade.php ENDPATH**/ ?>