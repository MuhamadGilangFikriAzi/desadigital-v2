<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if (isset($method) && $method === "PUT")
        @method("PUT")
    @endif

    <div class="mb-3">
        <label for="name_product">Nama Produk</label>
        <input type="text" name="name_product" class="form-control"
            value="{{ old("name_product", $product->name_product ?? "") }}" required>
    </div>

    <div class="mb-3">
        <label for="price">Harga</label>
        <input type="number" name="price" class="form-control" value="{{ old("price", $product->price ?? "") }}"
            required>
    </div>

    <div class="mb-3">
        <label for="desc">Deskripsi</label>
        <textarea name="desc" class="form-control">{{ old("desc", $product->desc ?? "") }}</textarea>
    </div>

    <div class="mb-3">
        <label for="img_product">Gambar Produk</label>
        <input type="file" name="img_product" class="form-control">
        @if (!empty($product->img_product))
            <div class="mt-2">
                <img src="{{ asset("storage/" . $product->img_product) }}" width="100">
            </div>
        @endif
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="{{ route("stores.products.index", $store->id) }}" class="btn btn-secondary">Kembali</a>
</form>
