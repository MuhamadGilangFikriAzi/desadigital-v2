@extends("layouts.app")

@section("content")
    <div class="container">
        <h2>Produk di {{ $store->name }}</h2>

        <a href="{{ route("stores.products.create", $store->id) }}" class="btn btn-primary mb-3">Tambah Produk</a>

        @if ($products->count())
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Gambar</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>
                                @if ($product->img_product)
                                    <img src="{{ asset("storage/" . $product->img_product) }}" width="80">
                                @endif
                            </td>
                            <td>{{ $product->name_product }}</td>
                            <td>Rp {{ number_format($product->price, 0, ",", ".") }}</td>
                            <td>{{ $product->desc }}</td>
                            <td>
                                <a href="{{ route("stores.products.edit", [$store->id, $product->id]) }}"
                                    class="btn btn-warning btn-sm">Edit</a>

                                <form action="{{ route("stores.products.destroy", [$store->id, $product->id]) }}"
                                    method="POST" style="display:inline-block;">
                                    @csrf
                                    @method("DELETE")
                                    <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin hapus produk ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $products->links() }}
        @else
            <p>Tidak ada produk.</p>
        @endif
    </div>
@endsection
