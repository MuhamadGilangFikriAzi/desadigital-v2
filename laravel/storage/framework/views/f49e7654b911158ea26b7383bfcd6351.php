<?php $__env->startSection('title', 'Peta Desa Digital'); ?>

<?php $__env->startSection('content'); ?>
    <div class="page-header">
        <div class="container text-center">
            <h1 class="text-white text-3xl md:text-4xl font-bold">Peta Desa Digital</h1>
            <p class="text-blue-200 mt-2">Peta interaktif batas wilayah dan fasilitas umum</p>
        </div>
    </div>

    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-sm p-4">
            <div id="map" style="height: 500px; width: 100%; border-radius: 8px;"></div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var map = L.map('map').setView([-6.255976490278926, 107.1139076217963], 14);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            L.marker([-6.255976490278926, 107.1139076217963]).addTo(map)
                .bindPopup('<b>Desa Digital</b><br>Lokasi Desa')
                .openPopup();

            var boundaryCoordinates = [
                [-6.252661536741769, 107.11692549198273], [-6.251712606757891, 107.11559406528971],
                [-6.2518374660650124, 107.11462689684254], [-6.251612719291501, 107.11257951428672],
                [-6.251625205225366, 107.11260463554589], [-6.250251750654456, 107.11265487806241],
                [-6.249899269825292, 107.10799006784225], [-6.251456091844247, 107.10690365153499],
                [-6.251820752188223, 107.10616996779476], [-6.255060607921649, 107.10532340963357],
                [-6.255383189860993, 107.10629695151988], [-6.25848277139211, 107.10546450266082],
                [-6.259985789833024, 107.10729715851886], [-6.261500732027457, 107.1065351426883],
                [-6.261792066560673, 107.10735577512088], [-6.263423536945098, 107.10682822569828],
                [-6.263918803731087, 107.10826433245535], [-6.268434449810016, 107.10717992531255],
                [-6.268929711841096, 107.10726785021677], [-6.270032243646554, 107.10704665778303],
                [-6.2699758050271015, 107.10701231265352], [-6.270333533746168, 107.10684621348128],
                [-6.271791963674886, 107.10839647241005], [-6.2726450057043195, 107.1082580564339],
                [-6.271076507993627, 107.11241053570575], [-6.269452970303959, 107.11980194881102],
                [-6.26868247607392, 107.11988499839703], [-6.268572405376062, 107.12093695981139],
                [-6.269012688025853, 107.12162903969181], [-6.2678294275612245, 107.12179513886178],
                [-6.26785694527787, 107.12237648596005], [-6.268214675449059, 107.12243185235008],
                [-6.26774687440583, 107.12442504240101], [-6.267279072943097, 107.12553237020757],
                [-6.266150844158872, 107.12738714428235], [-6.264197076348665, 107.12600298452361],
                [-6.258968647654584, 107.12719336191623], [-6.255418789923027, 107.12843910569666],
                [-6.253657615014902, 107.12821760311743], [-6.24744416558754, 107.1290443404046],
                [-6.24692759165913, 107.12896764275484], [-6.246652403415467, 107.1262546896296],
                [-6.246900072841385, 107.12437223236094], [-6.2466248845832695, 107.11817119664607],
                [-6.252678992839975, 107.11689776966949], [-6.25237628909062, 107.11695313605952]
            ];

            var fasilitas = [
                { nama: 'Stasiun Metland Desa Digital', koordinat: [-6.257018352471253, 107.11120452278651], deskripsi: 'STASIUN, desadigital, Kec. Cikarang Bar., Kabupaten Bekasi, Jawa Barat' },
                { nama: 'Hermina Hospital Metland Cibitung', koordinat: [-6.25379699567561, 107.11512568937857], deskripsi: 'Perumahan Metland Cibitung, desadigital' },
                { nama: 'SDN Desa Digital 02', koordinat: [-6.258663999850249, 107.10868704822703], deskripsi: 'Jl. Kp. Bojong Koneng, desadigital' },
                { nama: 'Kantor Desa Digital', koordinat: [-6.266254538415582, 107.11342078838982], deskripsi: 'Jl. Kp. Bojong Koneng, desadigital' },
                { nama: 'SMPN 2 Cikarang Barat', koordinat: [-6.265275455333193, 107.11475122727009], deskripsi: 'Jl. Kp. Bojong Koneng, desadigital' },
                { nama: 'Water Park H. Abdul Malik', koordinat: [-6.262584199497882, 107.11827859374124], deskripsi: 'desadigital, Cikarang Barat' },
                { nama: 'Yayasan Al-Imaroh', koordinat: [-6.262584199497882, 107.11827859374124], deskripsi: 'desadigital, Cikarang Barat' }
            ];

            fasilitas.forEach(function(item) {
                L.marker(item.koordinat).addTo(map).bindPopup('<b>' + item.nama + '</b><br>' + item.deskripsi);
            });

            L.polygon(boundaryCoordinates, {
                color: '#3b82f6',
                weight: 3,
                fillColor: '#3b82f6',
                fillOpacity: 0.15
            }).addTo(map).bindPopup('Batas Wilayah Desa Digital');
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app_front', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/profilevillage/villagemap.blade.php ENDPATH**/ ?>