<?php $__env->startSection('content'); ?>
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <!-- Berita -->
        <div class="bg-white rounded-lg shadow-sm mb-6">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-gray-800"><?php echo e($news->title); ?></h2>
                <p class="text-gray-500 text-sm mb-3">
                    <i class="fas fa-user mr-1"></i> Ditulis oleh: <strong><?php echo e($news->author); ?></strong><br>
                    <i class="fas fa-calendar mr-1"></i> <?php echo e(date('d M Y H:i', strtotime($news->created_at))); ?>

                </p>
                <?php if($news->image): ?>
                    <img src="<?php echo e(Storage::url('news/' . $news->image)); ?>" alt="Gambar Berita" class="w-full h-auto rounded-lg mb-4">
                <?php endif; ?>
                <div class="text-gray-700 leading-relaxed"><?php echo $news->content; ?></div>
            </div>
        </div>

        <!-- Komentar -->
        <div class="bg-white rounded-lg shadow-sm mb-6">
            <div class="p-6">
                <h5 class="text-lg font-semibold mb-4"><i class="fas fa-comments mr-2"></i> Komentar</h5>
                <?php if(session('success')): ?>
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4"><?php echo e(session('success')); ?></div>
                <?php endif; ?>

                <?php $__empty_1 = true; $__currentLoopData = $news->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="flex mb-4 pb-4 border-b border-gray-200">
                        <div class="flex-1">
                            <strong><?php echo e($comment->name); ?></strong>
                            <span class="text-gray-500 text-sm ml-2"><i class="far fa-clock mr-1"></i><?php echo e(date('d M Y, H:i', strtotime($comment->created_at))); ?></span>
                            <p class="mt-1 text-gray-700"><?php echo e($comment->comment); ?></p>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-gray-500">Belum ada komentar untuk berita ini.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Form Komentar -->
        <div class="bg-white rounded-lg shadow-sm">
            <div class="p-6">
                <h5 class="text-lg font-semibold mb-4"><i class="fas fa-edit mr-2"></i> Tinggalkan Komentar</h5>
                <form action="<?php echo e(route('berita.comment')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="news_id" value="<?php echo e($news->id); ?>">

                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                        <input type="text" name="name" id="name"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            value="<?php echo e(old('name')); ?>" placeholder="Masukkan nama Anda">
                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="mb-4">
                        <label for="comment" class="block text-sm font-medium text-gray-700 mb-1">Komentar</label>
                        <textarea name="comment" id="comment" rows="3"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition <?php $__errorArgs = ['comment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            placeholder="Tulis komentar Anda"><?php echo e(old('comment')); ?></textarea>
                        <?php $__errorArgs = ['comment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg transition">
                        <i class="fas fa-paper-plane mr-1"></i> Kirim Komentar
                    </button>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app_front', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/profilevillage/news_detail.blade.php ENDPATH**/ ?>