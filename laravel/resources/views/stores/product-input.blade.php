@php $product = $product ?? null; @endphp

<div class="card mb-4 shadow-sm">
    <div class="card-header bg-secondary text-white">
        <div class="d-flex justify-content-between">
            <strong>Produk #{{ $index + 1 }}</strong>
            <button type="button" class="btn btn-danger btn-sm btn-delete-product"
                data-id="{{ $product->id ?? "" }}">Hapus</button>
        </div>
    </div>
    <div class="card-body">
        <input type="hidden" name="products[{{ $index }}][id]" value="{{ $product->id ?? "" }}">

        <div class="mb-3">
            <label class="form-label">Nama Produk</label>
            <input type="text" name="products[{{ $index }}][name_product]" class="form-control"
                value="{{ old("products.$index.name_product", $product->name_product ?? "") }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Harga</label>
            <input type="number" name="products[{{ $index }}][price]" class="form-control"
                value="{{ old("products.$index.price", $product->price ?? "") }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="products[{{ $index }}][desc]" rows="3" class="form-control">{{ old("products.$index.desc", $product->desc ?? "") }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Gambar Produk</label>
            <input type="file" name="products[{{ $index }}][img_product]" class="form-control"
                accept="image/*">

            @if (!empty($product) && !empty($product->img_product))
                <div class="mt-3">
                    <label class="form-label d-block">Gambar Saat Ini:</label>
                    {{-- {{ $product->img_product }} --}}
                    <img src="{{ asset($product->img_product) }}" width="80" style="cursor:pointer;"
                        onclick="showImageModal('{{ asset($product->img_product) }}')" alt="Product Image"
                        class="img-thumbnail">
                </div>
            @endif
        </div>
    </div>
</div>
