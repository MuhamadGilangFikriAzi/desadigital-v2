@extends("layouts.app")

@section("content")
    <div class="card-header"><b>Edit Surat</b></div>
    <div class="card-body">
        @if (session("status"))
            <div class="alert alert-success">{{ session("status") }}</div>
        @endif

        @include("surat.form", [
            "action" => route("surat.update"),
            "method" => "PUT",
            "listTemplateSurat" => $listTemplateSurat,
            "surat" => $surat,
            "suratDetail" => $suratDetail,
        ])
    </div>
@endsection
