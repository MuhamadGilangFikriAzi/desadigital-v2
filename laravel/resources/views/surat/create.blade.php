@extends("layouts.app")

@section("content")
    <div class="card-header"><b>Tambah Surat</b></div>
    <div class="card-body">
        @if (session("status"))
            <div class="alert alert-success">{{ session("status") }}</div>
        @endif

        @include("surat.form", [
            "action" => route("surat.store"),
            "listTemplateSurat" => $listTemplateSurat,
            "selectedTemplateId" => old("template_surat_id"),
        ])

    </div>
@endsection
