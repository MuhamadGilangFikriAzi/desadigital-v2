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
                font-size: 14px;
                margin: 0;
                padding: 0 0 30px 0;
            }

            .lampiran {
                position: absolute;
                top: 0px;
                right: 40px;
                font-size: 12px;
                text-align: left;
            }

            .lampiran-2 {
                position: absolute;
                top: 45px;
                right: 40px;
                font-size: 12px;
                text-align: left;
            }

            .model-n1 {
                position: absolute;
                top: 60px;
                right: 40px;
                font-weight: bold;
                font-size: 12px;
            }

            .judul {
                text-align: center;
                margin-top: 40px;
                font-weight: bold;
            }

            .data-instansi {
                margin-top: 20px;
            }

            .data-instansi table {
                width: 100%;
            }

            .judul-surat {
                text-align: center;
                /* font-weight: bold; */
                margin-top: 20px;
            }

            .content {
                margin-top: 20px;
            }

            .model-n1-bawah {
                text-align: right;
                margin-top: 5px;
                font-weight: bold;
                font-size: 13px;
            }

            .footer {
                position: fixed;
                bottom: 0px;
                left: 0px;
                right: 0px;

                @if ($paperSize == "Legal")
                    height: 170px;
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

        @php
            $attrs = collect($templateSuratAttrs);
            $isAttachment = $attrs->firstWhere("attr_code", "is_attachment");
            $modelN = $attrs->firstWhere("attr_code", "model_code");
            $isInstance = $attrs->firstWhere("attr_code", "is_instance");
        @endphp

        @if ($isAttachment && $isAttachment["attr_value"])
            <div class="lampiran">
                Lampiran V<br>
                Kepdirjen Bimas Islam Nomor 473 Tahun 2020
            </div>
        @endif

        @if ($modelN && $modelN["attr_value"])
            @if ($modelN["attr_value"] == "Model N6")
                <div class="lampiran-2">
                    Tentang<br>
                    Petunjuk Teknis Pelaksanaan Pencatatan Nikah
                </div>
            @endif

            @if ($modelN["attr_value"] == "Model N1")
                <div class="judul">
                    FORMULIR SURAT PENGANTAR NIKAH
                </div>
            @endif

            <div class="model-n1-bawah">
                {{ $modelN["attr_value"] }}
            </div>
        @endif

        @if ($isInstance && $isInstance["attr_value"])
            <div class="data-instansi">
                <table>
                    <tr>
                        <td style="width: 35%;">KANTOR DESA/KELURAHAN</td>
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
            </div>
        @endif

        @if ($codeSurat !== "-")
            <div class="judul-surat">
                <u class="text-judul-surat">{{ $jenisSurat ?? "SURAT PENGANTAR PERKAWINAN" }}</u><br>
                <div class="text-12">
                    Nomor : {{ $codeSurat ?? "PM.06.02 / ___ / III / Pem / 2025" }}
                </div>
            </div>
        @else
            <div class="judul-surat">
                <u class="text-judul-surat">{{ $jenisSurat ?? "SURAT PENGANTAR PERKAWINAN" }}</u><br>
            </div>
        @endif

        <div class="content text-12">
            {!! $bodySurat !!}
        </div>

        {{-- Footer --}}
        @include("surat.footerLetter")
        <sethtmlpagefooter name="page-footer" value="on" />

    </body>

</html>
