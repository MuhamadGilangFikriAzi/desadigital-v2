@extends("layouts.app")

@section("content")
    <div class="container">
        <h2>Edit Produk - {{ $product->name_product }}</h2>
        @include("products.form", [
            "action" => route("stores.products.update", [$store->id, $product->id]),
            "method" => "PUT",
            "product" => $product,
        ])
    </div>
@endsection
