@extends("layouts.app")

@section("content")
    <div class="container">
        <h1>{{ $news->title }}</h1>
        <small>Ditulis oleh: {{ $news->author }} | {{ $news->created_at->format("d M Y") }}</small>
        <hr>
        @if ($news->image)
            <img src="{{ asset("storage/news/" . $news->image) }}" class="mb-3" width="100%">
        @endif

        <p>{!! $news->content !!}</p>

        <a href="{{ route("news.index") }}" class="btn btn-secondary mt-3">← Kembali</a>
    </div>
@endsection
