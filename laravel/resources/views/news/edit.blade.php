@extends("layouts.app")

@section("content")
    <div class="container">
        <div class="card-header text-left"><b>Edit Berita</b></div>

        <form action="{{ route("news.update", $news->id) }}" enctype="multipart/form-data" method="POST">
            @csrf
            @method("PUT")
            @include("news.form")
        </form>
    </div>
    <script>
        $(document).ready(function() {
            generateInputHtml('#editor');
        });
    </script>
@endsection
