@extends("layouts.app")

@section("content")
    <div class="card-header d-flex justify-content-between align-items-center pl-2">
        <h5 class="mb-0"><i class="fas fa-database mr-2"></i>Data Desa</h5>

    </div>
    <div class="card-body">
        <!-- Add Button Aligned Right -->
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route("villagedata.create") }}" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Tambah Data Desa
            </a>
        </div>

        <!-- Filter Form -->
        <form method="GET" action="{{ route("villagedata.index") }}" class="mb-3">
            <div class="row">
                <div class="col-md-3">
                    <input type="text" name="title" class="form-control" placeholder="Search Title"
                        value="{{ request("title") }}">
                </div>
                <div class="col-md-3">
                    <select name="type_chart" class="form-control">
                        <option value="">--Tipe Chart --</option>
                        @foreach ($chartType as $key => $value)
                            <option value="{{ $value }}" @if (request("type_chart") == $value) selected @endif>
                                {{ $key }}
                            </option>
                        @endforeach

                        <!-- Add more options if needed -->
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="is_active" class="form-control">
                        <option value="">-- Status --</option>
                        <option value="1" {{ request("is_active") === "1" ? "selected" : "" }}>Aktif</option>
                        <option value="0" {{ request("is_active") === "0" ? "selected" : "" }}>Tidak Aktif</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-filter"></i> Filter
                    </button>
                    <a href="{{ route("villagedata.index") }}" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>

        <!-- Data Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Tipe Chart</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $item)
                    <tr>
                        <td>{{ $item->title }}</td>
                        <td>{{ $item->type_chart }}</td>
                        <td>
                            <span class="badge {{ $item->is_active ? "badge-success" : "badge-danger" }}">
                                {{ $item->is_active ? "Aktif" : "Tidak Aktif" }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ url("/villagedata/edit/" . $item->id) }}" class="btn btn-sm btn-primary">Ubah</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        {{ $data->links() }}
    </div>
@endsection
