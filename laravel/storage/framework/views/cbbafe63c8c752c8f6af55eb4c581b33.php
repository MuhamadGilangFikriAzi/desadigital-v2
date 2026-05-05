<?php $__env->startSection('title', 'Pelayanan - Desa Digital'); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-header">
        <div class="container text-center">
            <h1 class="text-white text-3xl md:text-4xl font-bold">Pelayanan Publik</h1>
            <p class="text-blue-200 mt-2">Kemudahan akses layanan administrasi dari Desa Digital</p>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">

        <!-- CTA Administrasi Online -->
        <div class="bg-gray-100 rounded-lg shadow-sm p-6 mb-8">
            <div class="flex flex-col md:flex-row items-center gap-6">
                <div class="w-full md:w-1/2 text-center">
                    <img src="https://img.freepik.com/free-vector/online-application-concept-illustration_114360-5162.jpg"
                        alt="Administrasi Online" class="w-full h-auto rounded-lg max-w-md mx-auto">
                </div>
                <div class="w-full md:w-1/2 text-center md:text-left">
                    <h3 class="text-xl font-bold text-blue-700">Administrasi Lebih Mudah Secara Online</h3>
                    <p class="text-gray-600 mt-2">Tak perlu antre lama atau datang ke kantor desa. Gunakan layanan <strong>Administrasi Online</strong> untuk mengurus dokumen Anda dengan mudah, kapan saja dan di mana saja.</p>
                    <p class="text-green-600 font-semibold mt-1">Cepat, transparan, dan efisien untuk semua warga Desa Digital.</p>
                    <a href="<?php echo e(route('login')); ?>" class="inline-block bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-8 rounded-lg transition mt-4">
                        <i class="fas fa-lock mr-2"></i> Administrasi Online
                    </a>
                </div>
            </div>
        </div>

        <!-- Template Surat -->
        <div class="flex flex-wrap -mx-3">
            <?php $__currentLoopData = $templateSurat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="w-full md:w-1/2 lg:w-1/3 px-3 mb-4">
                    <a href="<?php echo e(route('login')); ?>" class="block no-underline h-full">
                        <div class="bg-white rounded-lg shadow-sm text-center p-6 h-full hover:-translate-y-1 hover:shadow-md transition-all duration-300">
                            <i class="fas fa-file-alt fa-3x text-yellow-500 mb-3"></i>
                            <h5 class="font-semibold text-gray-800"><?php echo e($item->type_surat); ?></h5>
                        </div>
                    </a>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app_front', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/profilevillage/pelayanan.blade.php ENDPATH**/ ?>