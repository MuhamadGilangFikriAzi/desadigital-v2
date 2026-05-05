@extends('layouts.app_front')

@section('content')
    <div class="container mx-auto px-4 py-8 max-w-4xl">
        <!-- Berita -->
        <div class="bg-white rounded-lg shadow-sm mb-6">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-gray-800">{{ $news->title }}</h2>
                <p class="text-gray-500 text-sm mb-3">
                    <i class="fas fa-user mr-1"></i> Ditulis oleh: <strong>{{ $news->author }}</strong><br>
                    <i class="fas fa-calendar mr-1"></i> {{ date('d M Y H:i', strtotime($news->created_at)) }}
                </p>
                @if ($news->image)
                    <img src="{{ Storage::url('news/' . $news->image) }}" alt="Gambar Berita" class="w-full h-auto rounded-lg mb-4">
                @endif
                <div class="text-gray-700 leading-relaxed">{!! $news->content !!}</div>
            </div>
        </div>

        <!-- Komentar -->
        <div class="bg-white rounded-lg shadow-sm mb-6">
            <div class="p-6">
                <h5 class="text-lg font-semibold mb-4"><i class="fas fa-comments mr-2"></i> Komentar</h5>
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
                @endif

                @forelse($news->comments as $comment)
                    <div class="flex mb-4 pb-4 border-b border-gray-200">
                        <div class="flex-1">
                            <strong>{{ $comment->name }}</strong>
                            <span class="text-gray-500 text-sm ml-2"><i class="far fa-clock mr-1"></i>{{ date('d M Y, H:i', strtotime($comment->created_at)) }}</span>
                            <p class="mt-1 text-gray-700">{{ $comment->comment }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-500">Belum ada komentar untuk berita ini.</p>
                @endforelse
            </div>
        </div>

        <!-- Form Komentar -->
        <div class="bg-white rounded-lg shadow-sm">
            <div class="p-6">
                <h5 class="text-lg font-semibold mb-4"><i class="fas fa-edit mr-2"></i> Tinggalkan Komentar</h5>
                <form action="{{ route('berita.comment') }}" method="POST">
                    @csrf
                    <input type="hidden" name="news_id" value="{{ $news->id }}">

                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                        <input type="text" name="name" id="name"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition @error('name') border-red-500 @enderror"
                            value="{{ old('name') }}" placeholder="Masukkan nama Anda">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="comment" class="block text-sm font-medium text-gray-700 mb-1">Komentar</label>
                        <textarea name="comment" id="comment" rows="3"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition @error('comment') border-red-500 @enderror"
                            placeholder="Tulis komentar Anda">{{ old('comment') }}</textarea>
                        @error('comment')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-6 rounded-lg transition">
                        <i class="fas fa-paper-plane mr-1"></i> Kirim Komentar
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
