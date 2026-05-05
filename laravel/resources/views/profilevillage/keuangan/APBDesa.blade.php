@extends("layouts.app_front")

@section("content")
    <div class="container py-5">
        <h1 class="text-center mb-4">APBDesa Tahun 2025</h1>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark text-center">
                    <tr>
                        <th>Kategori</th>
                        <th>Uraian</th>
                        <th>Jumlah (Rp)</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Pendapatan -->
                    <tr class="table-primary">
                        <td colspan="3"><strong>Pendapatan</strong></td>
                    </tr>
                    <tr>
                        <td>Pendapatan Asli Desa</td>
                        <td>Hasil Usaha Desa</td>
                        <td class="text-end">15.000.000</td>
                    </tr>
                    <tr>
                        <td>Dana Transfer</td>
                        <td>Dana Desa (DD)</td>
                        <td class="text-end">1.200.000.000</td>
                    </tr>
                    <tr>
                        <td>Dana Transfer</td>
                        <td>Alokasi Dana Desa (ADD)</td>
                        <td class="text-end">500.000.000</td>
                    </tr>

                    <!-- Belanja -->
                    <tr class="table-danger">
                        <td colspan="3"><strong>Belanja</strong></td>
                    </tr>
                    <tr>
                        <td>Belanja Pegawai</td>
                        <td>Honor Perangkat Desa</td>
                        <td class="text-end">300.000.000</td>
                    </tr>
                    <tr>
                        <td>Belanja Barang & Jasa</td>
                        <td>Pengadaan Sarana Desa</td>
                        <td class="text-end">200.000.000</td>
                    </tr>
                    <tr>
                        <td>Belanja Modal</td>
                        <td>Pembangunan Infrastruktur Jalan</td>
                        <td class="text-end">600.000.000</td>
                    </tr>

                    <!-- Pembiayaan -->
                    <tr class="table-success">
                        <td colspan="3"><strong>Pembiayaan</strong></td>
                    </tr>
                    <tr>
                        <td>Penerimaan Pembiayaan</td>
                        <td>Sisa Lebih Pembiayaan Anggaran Tahun Lalu (SiLPA)</td>
                        <td class="text-end">50.000.000</td>
                    </tr>
                    <tr>
                        <td>Pengeluaran Pembiayaan</td>
                        <td>Pembentukan Dana Cadangan</td>
                        <td class="text-end">25.000.000</td>
                    </tr>

                    <!-- Total -->
                    <tr class="table-dark">
                        <td colspan="2" class="text-end"><strong>Total Pendapatan</strong></td>
                        <td class="text-end"><strong>1.715.000.000</strong></td>
                    </tr>
                    <tr class="table-dark">
                        <td colspan="2" class="text-end"><strong>Total Belanja</strong></td>
                        <td class="text-end"><strong>1.100.000.000</strong></td>
                    </tr>
                    <tr class="table-dark">
                        <td colspan="2" class="text-end"><strong>Total Pembiayaan Bersih</strong></td>
                        <td class="text-end"><strong>25.000.000</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
