<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Desa Digital'); ?></title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/js/app.js']); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/tailwind.css')); ?>">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        #map { height: 500px; width: 100%; }
        .chart-container { display: flex; justify-content: space-between; gap: 20px; flex-wrap: wrap; }
        .chart-box { flex: 1; min-width: 300px; text-align: center; margin-bottom: 20px; }
        .chart-small { width: 100%; height: 200px; max-width: 100%; max-height: 100%; }
        @media (max-width: 768px) { .chart-container { flex-direction: column; } }

        /* Smooth scroll */
        html { scroll-behavior: smooth; }

        /* Shimmer untuk skeleton */
        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
        .shimmer {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: shimmer 1.5s infinite;
        }
    </style>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body class="bg-gray-50 text-gray-800 antialiased">

    
    <header x-data="{ open: false, scrolled: false }" x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 20)"
            :class="scrolled ? 'bg-white/95 backdrop-blur-md shadow-sm' : 'bg-transparent'"
            class="fixed top-0 left-0 right-0 z-50 transition-all duration-300">
        <nav class="container mx-auto px-4">
            <div class="flex items-center justify-between h-16 md:h-20">
                
                <a href="<?php echo e(route('profiledesaindex')); ?>" class="flex items-center gap-3 group">
                    <img src="<?php echo e(asset('assets/logo-desadigital.svg')); ?>" alt="logo" class="w-9 h-9 md:w-10 md:h-10 transition-transform group-hover:scale-105">
                    <span :class="scrolled ? 'text-gray-800' : 'text-white'" class="font-bold text-lg md:text-xl transition-colors">Desa Digital</span>
                </a>

                
                <div class="hidden lg:flex items-center gap-1">
                    <?php
                        $menuItems = [
                            ['label' => 'Beranda', 'route' => 'profiledesaindex'],
                            ['label' => 'Profil Desa', 'dropdown' => [
                                ['label' => 'Profil Wilayah', 'route' => 'profilevillage'],
                                ['label' => 'Demografi', 'route' => 'demografi'],
                                ['label' => 'Visi & Misi', 'route' => 'visimisi'],
                                ['label' => 'Sejarah', 'route' => 'sejarah'],
                            ]],
                            ['label' => 'Pelayanan', 'route' => 'pelayanan'],
                            ['label' => 'Berita', 'route' => 'berita'],
                            ['label' => 'Peta Desa', 'route' => 'map'],
                            ['label' => 'Pasar Desa', 'route' => 'pasardesa'],
                            ['label' => 'Kontak', 'route' => 'contact'],
                        ];
                    ?>
                    <?php $__currentLoopData = $menuItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(isset($item['dropdown'])): ?>
                            <div class="relative group/menu" x-data="{ dropdown: false }" 
                                 @mouseenter="dropdown = true" @mouseleave="dropdown = false">
                                <button :class="scrolled ? 'text-gray-700 hover:text-blue-600' : 'text-white/90 hover:text-white'"
                                        class="flex items-center gap-1 px-3 py-2 text-sm font-medium rounded-lg transition">
                                    <?php echo e($item['label']); ?>

                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                </button>
                                <div x-show="dropdown" 
                                     class="absolute top-full left-0 mt-1 w-48 bg-white rounded-xl shadow-lg border border-gray-100 py-2 opacity-0 transition-all duration-200"
                                     x-transition:enter="opacity-100" x-transition:leave="opacity-0"
                                     style="display: none;">
                                    <?php $__currentLoopData = $item['dropdown']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a href="<?php echo e(route($sub['route'])); ?>" 
                                           class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition">
                                            <?php echo e($sub['label']); ?>

                                        </a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        <?php else: ?>
                            <a href="<?php echo e(route($item['route'])); ?>"
                               :class="scrolled ? 'text-gray-700 hover:text-blue-600' : 'text-white/90 hover:text-white'"
                               class="px-3 py-2 text-sm font-medium rounded-lg transition">
                                <?php echo e($item['label']); ?>

                            </a>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                
                <button @click="open = !open" :class="scrolled ? 'text-gray-700' : 'text-white'" class="lg:hidden p-2 rounded-lg hover:bg-white/10 transition">
                    <svg x-show="!open" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    <svg x-show="open" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display:none"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            
            <div x-show="open" x-cloak
                 class="lg:hidden bg-white rounded-2xl shadow-xl border border-gray-100 mb-4 overflow-hidden transition-all"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 -translate-y-4"
                 x-transition:enter-end="opacity-100 translate-y-0">
                <div class="py-2">
                    <?php $__currentLoopData = $menuItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(isset($item['dropdown'])): ?>
                            <div x-data="{ sub: false }">
                                <button @click="sub = !sub" 
                                        class="w-full flex items-center justify-between px-4 py-3 text-sm font-medium text-gray-700 hover:bg-blue-50 transition">
                                    <?php echo e($item['label']); ?>

                                    <svg :class="sub ? 'rotate-180' : ''" class="w-4 h-4 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                </button>
                                <div x-show="sub" x-cloak class="bg-gray-50">
                                    <?php $__currentLoopData = $item['dropdown']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a href="<?php echo e(route($sub['route'])); ?>" @click="open = false"
                                           class="block px-6 py-2.5 text-sm text-gray-600 hover:text-blue-700 hover:bg-blue-50 transition">
                                            <?php echo e($sub['label']); ?>

                                        </a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        <?php else: ?>
                            <a href="<?php echo e(route($item['route'])); ?>" @click="open = false"
                               class="block px-4 py-3 text-sm font-medium text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition">
                                <?php echo e($item['label']); ?>

                            </a>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </nav>
    </header>

    
    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    
    <footer class="bg-gradient-to-br from-slate-900 via-slate-800 to-blue-900 text-white">
        
        <div class="relative -mt-1">
            <svg viewBox="0 0 1440 60" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full"><path d="M0 60V30C240 0 480 0 720 30C960 60 1200 60 1440 30V60H0Z" fill="#f8fafc"/></svg>
        </div>

        <div class="container mx-auto px-4 py-12 md:py-16">
            <div class="grid md:grid-cols-3 gap-8 md:gap-12">
                
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <img src="<?php echo e(asset('assets/logo-desadigital.svg')); ?>" alt="logo" class="w-10 h-10">
                        <h4 class="text-xl font-bold">Desa Digital</h4>
                    </div>
                    <p class="text-slate-300 text-sm leading-relaxed">
                        Portal layanan masyarakat yang terintegrasi — memudahkan akses informasi, administrasi, dan pelayanan desa secara online.
                    </p>
                    <div class="flex gap-3 mt-5">
                        <a href="#" class="w-9 h-9 bg-white/10 rounded-lg flex items-center justify-center hover:bg-blue-500 transition" title="Facebook">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="#" class="w-9 h-9 bg-white/10 rounded-lg flex items-center justify-center hover:bg-pink-500 transition" title="Instagram">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </a>
                        <a href="#" class="w-9 h-9 bg-white/10 rounded-lg flex items-center justify-center hover:bg-blue-400 transition" title="Twitter/X">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        </a>
                    </div>
                </div>

                
                <div>
                    <h6 class="font-semibold text-sm uppercase tracking-wider text-slate-400 mb-4">Navigasi</h6>
                    <ul class="space-y-2.5">
                        <li><a href="<?php echo e(route('profiledesaindex')); ?>" class="text-slate-300 hover:text-white text-sm transition flex items-center gap-2"><span class="w-1 h-1 bg-blue-400 rounded-full"></span>Beranda</a></li>
                        <li><a href="<?php echo e(route('demografi')); ?>" class="text-slate-300 hover:text-white text-sm transition flex items-center gap-2"><span class="w-1 h-1 bg-blue-400 rounded-full"></span>Demografi</a></li>
                        <li><a href="<?php echo e(route('berita')); ?>" class="text-slate-300 hover:text-white text-sm transition flex items-center gap-2"><span class="w-1 h-1 bg-blue-400 rounded-full"></span>Berita</a></li>
                        <li><a href="<?php echo e(route('pelayanan')); ?>" class="text-slate-300 hover:text-white text-sm transition flex items-center gap-2"><span class="w-1 h-1 bg-blue-400 rounded-full"></span>Pelayanan</a></li>
                        <li><a href="<?php echo e(route('map')); ?>" class="text-slate-300 hover:text-white text-sm transition flex items-center gap-2"><span class="w-1 h-1 bg-blue-400 rounded-full"></span>Peta Desa</a></li>
                        <li><a href="<?php echo e(route('pasardesa')); ?>" class="text-slate-300 hover:text-white text-sm transition flex items-center gap-2"><span class="w-1 h-1 bg-blue-400 rounded-full"></span>Pasar Desa</a></li>
                        <li><a href="<?php echo e(route('contact')); ?>" class="text-slate-300 hover:text-white text-sm transition flex items-center gap-2"><span class="w-1 h-1 bg-blue-400 rounded-full"></span>Kontak</a></li>
                    </ul>
                </div>

                
                <div>
                    <h6 class="font-semibold text-sm uppercase tracking-wider text-slate-400 mb-4">Kontak</h6>
                    <ul class="space-y-3 text-sm text-slate-300">
                        <li class="flex items-start gap-3">
                            <svg class="w-5 h-5 mt-0.5 text-blue-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span>Jl. Bojong Koneng, Telagamurni, Cikarang Bar., Kab. Bekasi, Jawa Barat</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-blue-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            <a href="https://wa.me/6281234567890" target="_blank" class="hover:text-white transition">+62 812 3456 7890</a>
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-blue-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <a href="mailto:mgfa9802@gmail.com" class="hover:text-white transition">mgfa9802@gmail.com</a>
                        </li>
                    </ul>
                </div>
            </div>

            <hr class="border-slate-700 my-8">
            <div class="text-center text-sm text-slate-400">
                &copy; <?php echo e(date('Y')); ?> Desa Digital. All rights reserved.
            </div>
        </div>
    </footer>

    
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    
    <div id="ajax-loader" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(255,255,255,0.7); z-index:9999; text-align:center;">
        <div style="position:absolute; top:50%; left:50%; transform:translate(-50%, -50%)">
            <div class="w-10 h-10 border-4 border-blue-200 border-t-blue-600 rounded-full animate-spin mx-auto"></div>
            <p class="mt-3 text-sm text-gray-500">Memuat data...</p>
        </div>
    </div>

    <script>
        // Ajax loader
        document.addEventListener('alpine:init', () => {
            const loader = document.getElementById('ajax-loader');
            if (loader) {
                document.addEventListener('ajaxStart', () => loader.style.display = 'block');
                document.addEventListener('ajaxStop', () => loader.style.display = 'none');
            }
        });

        // Image modal
        function showImageModal(src) {
            const existing = document.getElementById('imgModal');
            if (existing) existing.remove();

            const modal = document.createElement('div');
            modal.id = 'imgModal';
            modal.className = 'fixed inset-0 z-[9999] bg-black/80 flex items-center justify-center p-4';
            modal.onclick = () => modal.remove();
            modal.innerHTML = `
                <img src="${src}" class="max-w-full max-h-[90vh] rounded-lg shadow-2xl">
                <button onclick="this.closest('#imgModal').remove()" class="absolute top-4 right-4 text-white text-2xl">&times;</button>
            `;
            document.body.appendChild(modal);
        }
    </script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH /var/www/html/resources/views/layouts/app_front.blade.php ENDPATH**/ ?>