<!DOCTYPE html>
<html lang="id">

    <head>
        <meta charset="UTF-8">
        <title>Surat Pengantar Nikah - Model N1</title>
        <style>
            body {
                font-family: "Times New Roman", Times, serif;
                font-size: 14px;
            }

            .lampiran {
                position: absolute;
                top: 10px;
                right: 10px;
                font-size: 12px;
            }

            .model-n1 {
                position: absolute;
                top: 40px;
                right: 10px;
                font-weight: bold;
            }

            .centered {
                text-align: center;
            }

            table {
                margin-top: 20px;
                width: 100%;
            }

            ol {
                margin-top: 10px;
            }
        </style>
    </head>

    <body>

        <div class="lampiran">
            Lampiran V<br>
            Kepdirjen Bimas Islam Nomor 473 Tahun 2020
        </div>

        <div class="model-n1">Model N1</div>

        <div class="centered">
            <strong>FORMULIR SURAT PENGANTAR NIKAH</strong>
        </div>

        <table>
            <tr>
                <td style="width: 30%;">KANTOR DESA/KELURAHAN</td>
                <td>: {{ $desa ?? "Desa Digital" }}</td>
            </tr>
            <tr>
                <td>KECAMATAN</td>
                <td>: {{ $kecamatan ?? "CIKARANG BARAT" }}</td>
            </tr>
            <tr>
                <td>KABUPATEN/KOTA</td>
                <td>: {{ $kota ?? "BEKASI" }}</td>
            </tr>
        </table>

        <br>

        <div class="centered">
            <strong><u>SURAT PENGANTAR PERKAWINAN</u></strong><br>
            Nomor: {{ $nomor ?? "PM.06.02 / ___ / III / Pem / 2025" }}
        </div>

        <br>

        <table class="table-border">
            <tr>
                <td>PROVINSI</td>
                <td>
                    <div class="box">3</div>
                    <div class="box">2</div>
                </td>
                <td>JAWA BARAT</td>
            </tr>
            <tr>
                <td>KABUPATEN/KOTA</td>
                <td>
                    <div class="box">1</div>
                    <div class="box">6</div>
                </td>
                <td>BEKASI</td>
            </tr>
            <tr>
                <td>KECAMATAN</td>
                <td>
                    <div class="box">0</div>
                    <div class="box">8</div>
                </td>
                <td>CIKARANG BARAT</td>
            </tr>
            <tr>
                <td>DESA/KELURAHAN</td>
                <td>
                    <div class="box">0</div>
                    <div class="box">1</div>
                    <div class="box">0</div>
                    <div class="box">0</div>
                </td>
                <td>Desa Digital</td>
            </tr>
        </table>

        <br>

        <div class="text-center">
            <div class="bold" style="font-size: 14px;">FORMULIR PERMOHONAN PINDAH DATANG WNI</div>
            <div>Antar Kecamatan dalam Satu Kabupaten/Kota</div>
            <div>No. PM.06.02/ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; / III / Pem / 2025</div>
        </div>

    </body>

</html>
