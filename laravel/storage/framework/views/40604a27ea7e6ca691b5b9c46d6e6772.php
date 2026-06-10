<?php $__env->startSection("content"); ?>
    <!-- content -->
    <div class="w-full px-4">
        <div class="flex flex-wrap -mx-3">
            <?php if (\Illuminate\Support\Facades\Blade::check('role', "Guest")): ?>
                <div class="w-full px-3">
                    <div class="bg-yellow-50 border-l-4 border-yellow-400 text-yellow-800 p-4 rounded-r-lg" role="alert">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-triangle mr-2 text-yellow-600"></i>
                            <span>Akun belum diverifikasi oleh Staff Desa!, silahkan cek secara berkala</span>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Main content -->
    <section class="content mt-6">
        <div class="w-full px-4">
            <div class="flex flex-wrap -mx-3">
                <div class="w-full md:w-1/2 px-3">
                    
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make("layouts.app", array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/home/dashboard.blade.php ENDPATH**/ ?>