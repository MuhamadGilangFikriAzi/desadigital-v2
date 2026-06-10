<?php $__env->startSection('title', 'Visi dan Misi Desa Digital'); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-header">
        <div class="container text-center">
            <h1 class="text-white text-3xl md:text-4xl font-bold">Visi dan Misi Desa Digital</h1>
            <p class="text-blue-200 mt-2">Mewujudkan desa yang maju, mandiri, dan berbudaya</p>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-center">
            <div class="w-full md:w-2/3">
                <div class="bg-white rounded-lg shadow-md p-6">
                    <?php if($villageVision): ?>
                        <div class="mb-6">
                            <h3 class="text-xl font-bold text-blue-700 mb-2">Visi</h3>
                            <div class="text-gray-700 leading-relaxed"><?php echo $villageVision->content; ?></div>
                        </div>
                    <?php endif; ?>
                    <?php if($villageMission): ?>
                        <div>
                            <h3 class="text-xl font-bold text-green-600 mb-2">Misi</h3>
                            <div class="text-gray-700 leading-relaxed"><?php echo $villageMission->content; ?></div>
                        </div>
                    <?php endif; ?>
                    <div class="text-center mt-6">
                        <img src="<?php echo e(asset('img/profilevillage/visimisi.png')); ?>" alt="Visi dan Misi Desa Digital" class="w-full h-auto rounded-lg shadow-sm">
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app_front', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/profilevillage/visimisi.blade.php ENDPATH**/ ?>