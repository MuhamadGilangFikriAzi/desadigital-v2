@csrf
<div class="mb-3">
    <label for="title">Judul</label>
    <input type="text" name="title" class="form-control" value="{{ old("title", $news->title ?? "") }}" required>
    @error("title")
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
<div class="mb-3">
    <label for="image">Gambar Headline</label>
    @error("image")
        <small class="text-danger">{{ $message }}</small>
    @enderror
    <input type="file" name="image" class="form-control">
    @if (isset($news) && $news->image)
        <img src="{{ asset("storage/news/" . $news->image) }}" alt="thumbnail" width="150" class="mt-2"
            onclick="showImageModal('{{ asset("storage/news/" . $news->image) }}')">
    @endif

</div>

<div class="card mb-0" style="margin-bottom: 0px !important;">
    <div class="card-header" id="headingTwo">
        <h2 class="mb-0">
            <button class="btn btn-block text-left pl-0" type="button" data-toggle="collapse"
                data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                <label for="">Gambar untuk berita</label>
            </button>
        </h2>
    </div>

    <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo">
        <div class="card-body">
            <div class="form-group" id="inputan">
                <div class="row">
                    <div class="col-md-3">Deskripsi Foto</div>
                    <div class="col-md-3">Tag</div>
                    <div class="col-md-3">Foto</div>
                    <div class="col-md-3"><button type="button" id="btnAddInput" class="btn btn-outline-dark"><i
                                class="fas fa-plus"></i></button>
                    </div>
                </div>
                @foreach ($newsImages as $key => $image)
                    <div class="row row-inputan my-1" data-id="{{ $key }}">
                        <div class="col-md-3">
                            <input type="text" name="images[{{ $key }}][desc]" placeholder="Masukan Label"
                                class="form-control" value="{{ $image->desc }}">
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="images[{{ $key }}][tag]"
                                placeholder="Masukan tag (tanpa spasi). contoh : GAMBAR1"
                                class="form-control mandatory tag-template-surat uppercase unique"
                                value="{{ $image->tag }}">
                        </div>
                        <div class="col-md-3">
                            @if ($image->img)
                                <img src="{{ asset("img/news/" . $image->img) }}" class="rounded-circle" width="50"
                                    height="50" alt="Foto"
                                    onclick="showImageModal('{{ asset("img/news/" . $image->img) }}')">
                                <input type="hidden" name="images[{{ $key }}][oldImg]"
                                    value="{{ $image->img }}">
                            @endif
                            <input id="img-{{ $key }}" type="file" accept="image/jpeg" class="form-control"
                                name="images[{{ $key }}][img]" value="{{ $image->img }}">
                        </div>
                        <div class="col-md-3"><button data-id="{{ $key }}" type="button"
                                class="btn btn-hapus btn-outline-dark"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</div>

<div class="mb-3">
    <label for="content">Konten</label>
    @error("content")
        <small class="text-danger">{{ $message }}</small>
    @enderror
    <textarea class="form-control editor mandatory" id="editor" data-label="Surat" name="content">{{ old("content", $news->content ?? "") }}</textarea>

</div>
<div class="mb-3">
    <label>
        <input type="checkbox" name="is_active" value="1" {{ isset($news) && $news->is_active ? "checked" : "" }}>
        Tampilkan berita ini
    </label>
</div>
<div class="d-flex justify-content-between mt-4">
    <a href="{{ route("news.index") }}" class="btn btn-secondary">← Kembali</a>
    <button type="submit" class="btn btn-success">Simpan</button>
</div>

<script>
    $(document).ready(function() {
        var i = "{{ $newsImages->count() }}" + 1;
        $("#btnAddInput").click(function() {
            i++;
            $("#inputan").append(`
                <div class="row row-inputan my-1" data-id="${i}">
                        <div class="col-md-3">
                            <input type="text" name="images[${i}][desc]" placeholder="Masukan Label"
                                class="form-control">
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="images[${i}][tag]"
                                placeholder="Masukan tag (tanpa spasi). contoh : GAMBAR1"
                                class="form-control mandatory tag-template-surat uppercase unique"
                                >
                        </div>
                        <div class="col-md-3">
                            <input id="img-${i}" type="file" accept="image/jpeg" class="form-control"
                                name="images[${i}][img]">
                        </div>
                        <div class="col-md-3"><button data-id="${i}" type="button"
                                class="btn btn-hapus btn-outline-dark"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>`);
        });

        $(document).on('click', '.btn-hapus', function() {
            $(this).parents('.row.row-inputan').remove();
        });
    });
</script>
