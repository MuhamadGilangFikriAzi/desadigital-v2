@extends("layouts.app")

@section("content")
    <div class="container">
        <h2>Tambah Produk untuk {{ $store->name }}</h2>
        @include("products.form", [
            "action" => route("stores.products.store", $store->id),
            "method" => "POST",
            "store" => $store,
        ])
    </div>
@endsection
