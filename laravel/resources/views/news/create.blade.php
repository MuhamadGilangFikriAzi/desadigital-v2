@extends("layouts.app")

@section("content")
    <div class="container">
        <div class="card-header text-left"><b>Tambah Berita</b></div>
        <form action="{{ route("news.store") }}" enctype="multipart/form-data" method="POST">
            @include("news.form")
        </form>
    </div>

    <script>
        $(document).ready(function() {
            generateInputHtml('#editor');
        });
    </script>
@endsection
