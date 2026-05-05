@csrf
@if (isset($store))
    @method("PUT")
@endif

<!-- Informasi Toko -->
<div class="card mb-4">
    <div class="card-header bg-primary text-white">
        <strong>Informasi Toko</strong>
    </div>
    <div class="card-body">
        <!-- Nama Toko -->
        <div class="mb-3">
            <label for="name" class="form-label">Nama Toko</label>
            <input type="text" id="name" name="name" class="form-control"
                value="{{ old("name", $store->name ?? "") }}" required>
        </div>
        <!-- WhatsApp -->
        <div class="mb-3">
            <label for="whatsapp_no" class="form-label">Nomor WhatsApp</label>
            <input type="text" id="whatsapp_no" name="whatsapp_no" class="form-control"
                value="{{ old("whatsapp_no", $store->whatsapp_no ?? "") }}">
        </div>
        <!-- Deskripsi -->
        <div class="mb-3">
            <label for="desc" class="form-label">Deskripsi</label>
            <textarea id="desc" name="desc" rows="3" class="form-control">{{ old("desc", $store->desc ?? "") }}</textarea>
        </div>
        <!-- Gambar Toko -->
        <div class="mb-3">
            <label for="img_store" class="form-label">Gambar Toko</label>
            <input type="file" id="img_store" name="img_store" class="form-control" accept="image/*">
            @if (isset($store) && $store->img_store)
                <div class="mt-2">
                    <img src="{{ asset($store->img_store) }}" width="80" style="cursor:pointer;"
                        onclick="showImageModal('{{ asset($store->img_store) }}')" alt="Store Image"
                        class="img-thumbnail">
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Produk -->
<div class="card mb-4">
    <div class="card-header bg-success text-white">
        <div class="d-flex justify-content-between align-items-center">
            <span class="h6 mb-0">Produk</span>
            <button type="button" class="btn btn-sm btn-light text-dark" id="add-product">+ Tambah Produk</button>
        </div>
    </div>
    <div class="card-body" id="products-wrapper">
        @if (old("products"))
            @foreach (old("products") as $i => $product)
                @include("stores.product-input", ["index" => $i, "product" => (object) $product])
            @endforeach
        @elseif (isset($store) && $store->products)
            @foreach ($store->products as $i => $product)
                @include("stores.product-input", ["index" => $i, "product" => $product])
            @endforeach
        @else
            @include("stores.product-input", ["index" => 0])
        @endif
    </div>
</div>

<!-- Hidden untuk produk yang dihapus -->
<input type="hidden" name="deleted_products" id="deleted_products">

<script>
    let productIndex = {{ isset($store) ? $store->products->count() : 1 }};
    let deletedProducts = [];

    $('#add-product').on('click', function() {
        $.get(`/product-input/${productIndex}`, function(data) {
            $('#products-wrapper').append(data);
            productIndex++;
        });
    });

    $(document).on('click', '.btn-delete-product', function() {
        let productId = $(this).data('id');
        if (productId) {
            deletedProducts.push(productId);
            $('#deleted_products').val(JSON.stringify(deletedProducts));
        }
        $(this).closest('.card').remove();
    });
</script>
