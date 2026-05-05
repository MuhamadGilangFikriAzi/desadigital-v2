@extends('layouts.app_front')

@section('title', 'Profil Wilayah Desa Digital')

@section('content')
    <div class="page-header">
        <div class="container text-center">
            <h1 class="text-white text-3xl md:text-4xl font-bold">Profil Wilayah Desa Digital</h1>
            <p class="text-blue-200 mt-2">Informasi lengkap tentang Desa Digital</p>
        </div>
    </div>

    <div class="container mx-auto py-8 px-4 max-w-4xl">

        <!-- Letak Geografis -->
        <div class="bg-white rounded-lg shadow-sm mb-6 card-hover">
            <div class="p-6">
                <h4 class="text-gray-800 text-xl font-semibold mb-3">
                    <i class="fas fa-globe text-blue-600 mr-2"></i> Letak Geografis
                </h4>
                <p>Desa Digital terletak di Kecamatan Cikarang Barat, Kabupaten Bekasi, Provinsi Jawa Barat.</p>
                <p class="mt-2">Koordinat: <strong>-6.255976, 107.113908</strong></p>
                <p class="text-gray-500 text-sm mt-1">Lokasi yang strategis, dengan akses yang baik ke kota besar seperti Jakarta dan Bekasi.</p>
                <div class="mt-3">
                    <a href="https://www.google.com/maps?q=-6.255976,107.113908" target="_blank" 
                       class="inline-block border border-blue-500 text-blue-600 hover:bg-blue-500 hover:text-white font-medium text-sm py-1.5 px-3 rounded transition">
                        <i class="fas fa-map mr-1"></i> Lihat di Google Maps
                    </a>
                </div>
            </div>
        </div>

        <!-- Batas Wilayah -->
        <div class="bg-white rounded-lg shadow-sm mb-6 card-hover">
            <div class="p-6">
                <h4 class="text-gray-800 text-xl font-semibold mb-3">
                    <i class="fas fa-th-large text-blue-600 mr-2"></i> Batas Wilayah
                </h4>
                <ul class="space-y-2">
                    <li><strong>Utara:</strong> Desa Wanajaya Kec. Cibitung</li>
                    <li><strong>Timur:</strong> Desa Sukadanau Kec. Cikarang Barat</li>
                    <li><strong>Selatan:</strong> Desa Kalijaya Kec. Cikarang Barat</li>
                    <li><strong>Barat:</strong> Kelurahan Telaga Asih Kec. Cikarang Barat</li>
                </ul>
                <p class="text-gray-500 text-sm mt-2">Desa ini berbatasan dengan beberapa desa lain yang memiliki keunggulan ekonomi dan budaya masing-masing.</p>
            </div>
        </div>

        <!-- Luas Wilayah -->
        <div class="bg-white rounded-lg shadow-sm mb-6 card-hover">
            <div class="p-6">
                <h4 class="text-gray-800 text-xl font-semibold mb-3">
                    <i class="fas fa-expand-arrows-alt text-blue-600 mr-2"></i> Luas Wilayah
                </h4>
                <p>± 437.8 Ha</p>
                <p class="text-gray-500 text-sm mt-1">Dengan luas wilayah yang cukup besar, Desa Digital memiliki potensi yang besar dalam hal pertanian, pemukiman, dan sektor industri.</p>
            </div>
        </div>

        <!-- Topografi -->
        <div class="bg-white rounded-lg shadow-sm mb-6 card-hover">
            <div class="p-6">
                <h4 class="text-gray-800 text-xl font-semibold mb-3">
                    <i class="fas fa-chart-line text-blue-600 mr-2"></i> Topografi
                </h4>
                <p>Kondisi wilayah Desa Digital umumnya merupakan dataran rendah dengan ketinggian sekitar 10-25 meter di atas permukaan laut.</p>
                <p class="text-gray-500 text-sm mt-1">Wilayah dataran rendah ini sangat mendukung untuk kegiatan pertanian dan pemukiman yang berkembang pesat.</p>
            </div>
        </div>

        <!-- Pembagian Wilayah Administratif -->
        <div class="bg-white rounded-lg shadow-sm mb-6 card-hover">
            <div class="p-6">
                <h4 class="text-gray-800 text-xl font-semibold mb-3">
                    <i class="fas fa-map-marked-alt text-blue-600 mr-2"></i> Pembagian Wilayah Administratif
                </h4>
                <ul class="space-y-2">
                    <li>Dusun: 5</li>
                    <li>RT: 149</li>
                    <li>RW: 22</li>
                </ul>
                <p class="text-gray-500 text-sm mt-1">Pembagian administrasi yang terstruktur dengan baik mempermudah pengelolaan dan pelayanan masyarakat di Desa Digital.</p>
            </div>
        </div>

        <!-- Jenis Tanah & Penggunaan Lahan -->
        <div class="bg-white rounded-lg shadow-sm mb-6 card-hover">
            <div class="p-6">
                <h4 class="text-gray-800 text-xl font-semibold mb-3">
                    <i class="fas fa-file-alt text-blue-600 mr-2"></i> Jenis Tanah & Penggunaan Lahan
                </h4>
                <p>Sebagian besar wilayah digunakan untuk pemukiman, pertanian, dan kawasan industri ringan.</p>
                <p class="text-gray-500 text-sm mt-1">Tanah yang subur dan luasnya yang memadai membuat desa ini cocok untuk pengembangan sektor pertanian dan pemukiman yang terus berkembang.</p>
            </div>
        </div>

    </div>
@endsection
