@extends("layouts.app")

@section("content")
    <div class="card-header">
        <h4 class="mb-4">Ubah Data Desa</h4>
    </div>
    @include("villagedata.form")

    @include("villagedata.script")
@endsection
