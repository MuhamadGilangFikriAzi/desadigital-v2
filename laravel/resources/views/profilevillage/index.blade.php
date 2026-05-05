@extends("layouts.app_front")

@section("content")
    <!-- Home Section -->
    <div id="carouselExample" class="carousel slide" data-ride="carousel">
        <!-- Indicators (optional) -->
        <ol class="carousel-indicators">
            <li data-target="#carouselExample" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExample" data-slide-to="1"></li>
            <li data-target="#carouselExample" data-slide-to="2"></li>
        </ol>

        <!-- Carousel Inner (slides) -->
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset("img/profilevillage/administration1.jpg") }}" class="d-block w-100 half-screen-img"
                    alt="Image 1">
                <div class="carousel-caption text-white">
                    <h1>Selamat Datang di website Desa Digital</h1>
                    <p>Perjalanan dimulai dari sini</p>
                    <a href="#profile-desa" class="btn">Pelajari Lebih Lanjut</a>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset("img/profilevillage/administration2.jpg") }}" class="d-block w-100 half-screen-img"
                    alt="Image 2">
                <div class="carousel-caption text-primary">
                    <h1>Pelayanan Desa</h1>
                    <p>Pelayanan Administrasi Desa berbasis Online</p>
                    <a href="{{ route("pelayanan") }}" class="btn">Masuk</a>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset("img/profilevillage/administration3.jpg") }}" class="d-block w-100 half-screen-img"
                    alt="Image 2">
            </div>
            <div class="carousel-item">
                <img src="{{ asset("img/profilevillage/administration4.jpg") }}" class="d-block w-100 half-screen-img"
                    alt="Image 2">
            </div>
        </div>

        <!-- Carousel Controls -->
        <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div id="profile-desa" class="container mt5 content target-section ">
        <div class="section">
            <div class="container mt-5">
                {{-- Judul Halaman --}}
                <div class="text-center mb-4">
                    <h2 class="font-weight-bold text-primary">Selamat Datang di Website Resmi Desa Digital</h2>
                </div>

                {{-- Data Umum Desa --}}
                <div class="container my-5">
                    <div class="card bg-white shadow-sm border-0">
                        <div class="card-body">

                            {{-- Logo Desa --}}
                            <div class="text-center mb-4">

                                <h4 class="text-primary font-weight-bold">Data Umum Desa Digital</h4>
                            </div>

                            <div class="row text-center">

                                {{-- Jumlah Penduduk --}}
                                <div class="col-md-4 mb-4">
                                    <div class="p-4 border rounded shadow-sm h-100 hover-zoom">
                                        <i class="fa fa-users fa-2x text-info mb-2"></i>
                                        <h5 class="text-dark">Penduduk</h5>
                                        <h3 class="font-weight-bold">
                                            {{ number_format($jumlahPenduduk, 0, ",", ".") }}
                                        </h3>
                                        <p class="text-muted small">Jumlah total penduduk desa berdasarkan data terbaru.</p>
                                    </div>
                                </div>

                                {{-- Jumlah KK --}}
                                <div class="col-md-4 mb-4">
                                    <div class="p-4 border rounded shadow-sm h-100 hover-zoom">
                                        <i class="fa fa-home fa-2x text-success mb-2"></i>
                                        <h5 class="text-dark">Kepala Keluarga (KK)</h5>
                                        <h3 class="font-weight-bold">
                                            {{ number_format($jumlahKK, 0, ",", ".") }}
                                        </h3>
                                        <p class="text-muted small">Total rumah tangga atau keluarga terdaftar di desa.</p>
                                    </div>
                                </div>

                                {{-- Luas Wilayah --}}
                                <div class="col-md-4 mb-4">
                                    <div class="p-4 border rounded shadow-sm h-100 hover-zoom">
                                        <i class="fa fa-map fa-2x text-danger mb-2"></i>
                                        <h5 class="text-dark">Sekolah</h5>
                                        <h3 class="font-weight-bold">{{ $jumlahSekolah }} </h3>
                                        <p class="text-muted small">Jumlah sekolah negri maupun swasta yang ada di Desa
                                            desadigital.</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                {{-- Bagian Berita Terbaru --}}
                @foreach ($beritaTerbaru as $berita)
                    <div class="card mb-4 border-0 shadow-sm">
                        <div class="row no-gutters align-items-center">

                            {{-- Gambar --}}
                            <div class="col-md-4">
                                @if ($berita->image)
                                    <img src="{{ Storage::url("news/" . $berita->image) }}"
                                        class="img-fluid rounded-left w-100" alt="Gambar Berita">
                                @else
                                    <img src="{{ asset("img/default-news.jpg") }}" class="img-fluid rounded-left w-100"
                                        alt="Default Gambar">
                                @endif
                            </div>

                            {{-- Konten Berita --}}
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title text-primary">{{ $berita->title }}</h5>
                                    <p class="card-text text-muted mb-1"><small>Ditulis oleh:
                                            <strong>{{ $berita->author }}</strong></small></p>
                                    <p class="card-text">
                                        {{ Str::limit(strip_tags($berita->content), 150, "...") }}
                                    </p>
                                    <a href="{{ route("berita.show", $berita->id) }}"
                                        class="btn btn-outline-primary btn-sm mt-2">
                                        Baca Selengkapnya
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
                {{-- Carousel: Aparatur Desa --}}
                <div class="card bg-light shadow mb-5">
                    <div class="card-body text-center">
                        <h4 class="card-title text-primary mb-4">Aparatur Desa</h4>
                        <div id="aparaturCarousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">

                                @foreach ($aparaturDesa->chunk(4) as $chunkIndex => $chunk)
                                    <div class="carousel-item {{ $chunkIndex == 0 ? "active" : "" }}">
                                        <div class="row justify-content-center">
                                            @foreach ($chunk as $aparatur)
                                                <div class="col-md-3 col-sm-6 mb-4">
                                                    <div class="card h-100 border-0 bg-white">
                                                        @if ($aparatur->photo)
                                                            <img src="{{ asset("img/aparatur/img/" . $aparatur->photo) }}"
                                                                class="rounded-circle mx-auto d-block mt-3"
                                                                style="width: 120px; height: 120px; object-fit: cover;"
                                                                alt="Foto {{ $aparatur->name }}">
                                                        @endif
                                                        <div class="card-body">
                                                            <h6 class="mb-1">{{ $aparatur->name }}</h6>
                                                            <small class="text-muted">{{ $aparatur->position }}</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach

                            </div>

                            {{-- Carousel Controls --}}
                            <a class="carousel-control-prev" href="#aparaturCarousel" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon bg-dark rounded-circle p-2"
                                    aria-hidden="true"></span>
                            </a>
                            <a class="carousel-control-next" href="#aparaturCarousel" role="button" data-slide="next">
                                <span class="carousel-control-next-icon bg-dark rounded-circle p-2"
                                    aria-hidden="true"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
