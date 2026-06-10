<?php $__env->startSection('title', 'Sejarah Desa Digital'); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-header">
        <div class="container text-center">
            <h1 class="text-white text-3xl md:text-4xl font-bold">Sejarah Desa Digital</h1>
            <p class="text-blue-200 mt-2">Menggali asal-usul dan perkembangan dari masa ke masa</p>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">

        <!-- Image -->
        <div class="flex justify-center mb-8">
            <div class="w-full md:w-2/3">
                <img src="<?php echo e(asset('img/profilevillage/sejarah.png')); ?>" alt="Sejarah Desa Digital" class="w-full h-auto rounded-lg shadow-md">
            </div>
        </div>

        <!-- Text -->
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <h4 class="text-green-600 font-semibold text-lg mb-3">Asal Usul dan Pemekaran</h4>
                <p class="text-gray-700 leading-relaxed text-justify">
                    Pada awal terbentuknya, Desa Digital merupakan bagian dari <strong>Desa Sukadanau</strong> sebagai desa induk.
                    Tahun <span class="bg-blue-100 text-blue-800 px-2 py-0.5 rounded text-sm font-medium">1975</span>, desa ini dimekarkan menjadi dua yaitu Desa Sukadanau dan Desa Digital.
                    Kemudian sekitar tahun <span class="bg-blue-100 text-blue-800 px-2 py-0.5 rounded text-sm font-medium">1981</span>, Desa Digital kembali dimekarkan menjadi dua desa yaitu
                    <strong>Desa Digital</strong> dan <strong>Desa Telaga Asih</strong>.
                </p>

                <h4 class="text-green-600 font-semibold text-lg mt-6 mb-3">Kondisi Awal</h4>
                <p class="text-gray-700 leading-relaxed text-justify">
                    Pada awalnya, desadigital merupakan wilayah <strong>pertanian yang luas</strong> dengan beberapa sungai untuk pengairan sawah.
                    Beberapa kampung yang ada antara lain:
                </p>
                <ul class="list-disc list-inside text-gray-700 space-y-1 ml-4 mt-2">
                    <li>Kp. Warung Bongkok</li>
                    <li>Kp. Bojong Koneng</li>
                    <li>Kp. Rawa Keting</li>
                    <li>Kp. Warung Bambu</li>
                    <li>Kp. Sribodas</li>
                </ul>

                <h4 class="text-green-600 font-semibold text-lg mt-6 mb-3">Perkembangan Menjadi Permukiman</h4>
                <p class="text-gray-700 leading-relaxed text-justify">
                    Seiring perkembangan zaman, area persawahan berubah menjadi kawasan permukiman dengan dibangunnya perumahan seperti:
                </p>
                <ul class="list-disc list-inside text-gray-700 space-y-1 ml-4 mt-2">
                    <li>Perum desadigital</li>
                    <li>Perum Sakinah</li>
                    <li>Perum Telaga Harapan</li>
                    <li>Perum Telaga Pesona</li>
                    <li>Perum Metland Cibitung</li>
                    <li>Perum Kirana Cikarang</li>
                </ul>
            </div>

            <!-- Timeline -->
            <div class="mt-8">
                <h3 class="text-center text-red-600 font-bold text-xl mb-6">Timeline Perjalanan Desa</h3>
                <div class="relative pl-8 border-l-2 border-gray-300 space-y-8 ml-4">
                    <!-- 1975 -->
                    <div class="relative">
                        <div class="absolute -left-[2.35rem] w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white text-sm shadow">
                            <i class="fas fa-tree"></i>
                        </div>
                        <div class="ml-8 bg-gray-50 p-4 rounded-lg shadow-sm">
                            <h5 class="font-bold text-gray-800">1975</h5>
                            <p class="text-gray-600">Pemekaran dari Desa Sukadanau menjadi Desa Digital.</p>
                        </div>
                    </div>
                    <!-- 1981 -->
                    <div class="relative">
                        <div class="absolute -left-[2.35rem] w-10 h-10 rounded-full bg-green-600 flex items-center justify-center text-white text-sm shadow">
                            <i class="fas fa-map"></i>
                        </div>
                        <div class="ml-8 bg-gray-50 p-4 rounded-lg shadow-sm">
                            <h5 class="font-bold text-gray-800">1981</h5>
                            <p class="text-gray-600">Desa Digital dimekarkan lagi menjadi desadigital dan Telaga Asih.</p>
                        </div>
                    </div>
                    <!-- 2000-an -->
                    <div class="relative">
                        <div class="absolute -left-[2.35rem] w-10 h-10 rounded-full bg-yellow-500 flex items-center justify-center text-white text-sm shadow">
                            <i class="fas fa-home"></i>
                        </div>
                        <div class="ml-8 bg-gray-50 p-4 rounded-lg shadow-sm">
                            <h5 class="font-bold text-gray-800">2000-an</h5>
                            <p class="text-gray-600">Perkembangan permukiman menggantikan area pertanian.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app_front', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/profilevillage/sejarah.blade.php ENDPATH**/ ?>