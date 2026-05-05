@extends("layouts.app")

@section("content")
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Edit Store</h4>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("stores.update", $store->id) }}" enctype="multipart/form-data">
                @csrf
                @method("PUT")

                @include("stores.form")

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route("stores.index") }}" class="btn btn-outline-secondary">← Kembali</a>
                    <button type="submit" class="btn btn-primary">Perbarui Store</button>
                </div>
            </form>
        </div>
    </div>
@endsection
