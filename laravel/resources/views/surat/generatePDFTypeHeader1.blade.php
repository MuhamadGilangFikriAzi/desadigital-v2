<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>{{ $jenisSurat }}</title>
        <style>
            @page {
                margin: 50px 50px 0px 50px;
            }

            body {
                font-family: "Times New Roman", Times, serif;
                font-size: 12px;
                margin: 0;
                padding: 0;
            }

            .kop-surat {
                display: table;
                width: 100%;
                border-bottom: 3px double black;
                padding-bottom: 10px;
                margin-bottom: 20px;
            }

            .kop-logo {
                display: table-cell;
                width: 100px;
                vertical-align: middle;
                /* Biar sejajar */
            }

            .kop-logo img {
                height: 110px;
                /* 💥 Perbesar sesuai keinginan */
                width: auto;
                /* Biar nggak gepeng */
            }

            .kop-text {
                display: table-cell;
                text-align: center;
                vertical-align: middle;
                /* Pastikan tengah */
            }

            .kop-text h1 {
                font-size: 18pt;
                margin: 0;
                text-transform: uppercase;
            }

            .kop-text h2 {
                font-size: 14pt;
                margin: 0;
            }

            .kop-text p {
                margin: 0;
                font-size: 11pt;
            }

            .content {
                margin-bottom: 100px;
                text-align: justify;
            }

            .signature {
                margin-top: 60px;
                text-align: right;
            }

            @media print {
                .no-print {
                    display: none;
                }
            }

            .footer {
                position: fixed;
                bottom: 0px;
                left: 0px;
                right: 0px;

                @if ($paperSize == "Legal")
                    height: 200px;
                @else
                    height: 100px;
                @endif
                font-family: "Times New Roman",
                Times,
                serif;
                font-size: 14px;
                text-align: center;
                border-top: 1px solid #000;
                padding-top: 5px;
                /* padding-bottom: 40px; */
            }

            .text-12 {
                font-size: 16px !important;
            }

            .text-16 {
                font-size: 21.33px;
            }

            .text-judul-surat {
                font-size: 18.67px;
                font-weight: bold;
            }
        </style>

    </head>

    <body>

        <!-- Kop Surat -->
        <div class="kop-surat">
            <div class="kop-logo">
                <img src="{{ public_path("/img/kab-logo.png") }}" alt="Logo">
            </div>
            <div class="kop-text">
                <h1>PEMERINTAHAN KABUPATEN BEKASI</h1>
                <h2>KECAMATAN CIKARANG BARAT</h2>
                <h2>Desa Digital</h2>
                <p>Jl. Bojong Koneng No. 01 Telp ............... Kode Pos 17530</p>
            </div>
        </div>
        <!-- Isi Surat -->
        <div class="content">
            <div class="text-judul-surat" style="text-align: center; text-decoration: underline; margin: 0; padding: 0;">
                {{ $jenisSurat }}
            </div>
            <div class="text-12" style="text-align: center; margin: 0 0 20px 0; padding: 0;">
                No : {{ $codeSurat }}
            </div>
            <div class="text-12">
                {!! $bodySurat !!}
            </div>

        </div>
        {{-- Footer HTML yang akan muncul di setiap halaman --}}
        @include("surat.footerLetter")
        <sethtmlpagefooter name="page-footer" value="on" />
    </body>

</html>
