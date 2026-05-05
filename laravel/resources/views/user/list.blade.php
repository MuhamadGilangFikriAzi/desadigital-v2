@extends("layouts.app")

@section("content")
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="admin-card-header flex justify-between items-center pl-2">
            <h5 class="mb-0"><i class="fas fa-user mr-2"></i>User Management</h5>
        </div>

        <div class="p-4 border-b border-gray-200">
            <div class="mb-3">
                <label class="font-semibold text-gray-700">Filter</label>
            </div>
            <form action="{{ route("user") }}" method="get" enctype="multipart/form-data" id="filter">
                <div class="flex flex-wrap -mx-3">
                    <div class="w-full md:w-1/2 px-3 mb-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                        <input type="text" name="name" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ $filter["name"] }}">
                    </div>
                    <div class="w-full md:w-1/2 px-3 mb-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Buat</label>
                        <input type="date" name="created_at" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ $filter["created_at"] }}">
                    </div>
                    <div class="w-full px-3 text-right">
                        <button type="reset" class="inline-flex items-center gap-1 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium py-2 px-4 rounded-lg transition text-sm mr-2">Reset</button>
                        <button type="submit" class="inline-flex items-center gap-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition text-sm">
                            <i class="fas fa-search mr-1"></i> Cari
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="admin-card-body">
            <div class="overflow-x-auto">
                <table class="w-full border-collapse bg-white rounded-lg overflow-hidden shadow-sm">
                    <thead class="bg-gray-50 text-gray-700 text-sm uppercase tracking-wider">
                        <tr>
                            <th class="px-4 py-3 text-center font-semibold">No</th>
                            <th class="px-4 py-3 text-center font-semibold">Nama</th>
                            <th class="px-4 py-3 text-center font-semibold">Role</th>
                            <th class="px-4 py-3 text-center font-semibold">Tanggal Buat</th>
                            <th class="px-4 py-3 text-center font-semibold">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($list as $key => $l)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3 text-center font-medium">{{ $key + 1 }}</td>
                                <td class="px-4 py-3 text-center">{{ $l->name }}</td>
                                <td class="px-4 py-3 text-center">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        {{ $l->roles->pluck('name')[0] == 'Staff Desa' ? 'bg-purple-100 text-purple-800' : ($l->roles->pluck('name')[0] == 'Guest' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800') }}">
                                        {{ $l->roles->pluck("name")[0] }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-center">{{ date("d M Y", strtotime($l->created_at)) }}</td>
                                <td class="px-4 py-3 text-center">
                                    <div class="flex justify-center gap-2">
                                        <button class="inline-flex items-center gap-1 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm py-1.5 px-3 rounded-lg transition btn-show"
                                            data-id="{{ $l->id }}" data-toggle="modal" data-target="#show-user">
                                            <i class="fas fa-eye"></i> Show
                                        </button>
                                        <button class="inline-flex items-center gap-1 bg-red-50 hover:bg-red-100 text-red-600 text-sm py-1.5 px-3 rounded-lg transition btn-remove" data-id="{{ $l->id }}">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-8 text-center text-gray-500">No data available</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot class="bg-gray-50">
                        <tr>
                            <td colspan="4" class="px-4 py-3 text-center">{{ $list->links() }}</td>
                            <td class="px-4 py-3 text-right text-gray-500 text-sm">Total entries: {{ $data }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <!-- Show User Modal -->
    <div class="fixed inset-0 z-50 hidden overflow-y-auto" id="show-user-modal">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" onclick="document.getElementById('show-user-modal').classList.add('hidden')"></div>
            <div class="relative inline-block bg-white rounded-xl shadow-2xl max-w-2xl w-full mx-4 z-10">
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
                    <h5 class="text-lg font-semibold" id="show-title">Detail User</h5>
                    <button type="button" class="text-gray-400 hover:text-gray-600 text-2xl leading-none" onclick="document.getElementById('show-user-modal').classList.add('hidden')">&times;</button>
                </div>
                <div class="px-6 py-4 max-h-[70vh] overflow-y-auto" id="show-body">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                            <input type="text" name="nama" id="nama" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-50" disabled>
                            <input type="hidden" name="" id="userID">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                            <input type="text" name="role" id="role" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-50" disabled>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">NIK</label>
                            <input type="text" name="nik" id="nik" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-50" disabled>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Agama</label>
                            <input type="text" name="agama" id="agama" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-50" disabled>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                            <input type="text" name="jenisKelamin" id="jenisKelamin" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-50" disabled>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                            <textarea name="alamat" id="alamat" cols="30" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-50" disabled></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">KTP</label><br>
                            <img src="" alt="KTP" class="border rounded-lg p-1 w-full max-h-[400px] object-contain" id="ktp">
                        </div>
                        <div class="forguest hidden">
                            <label class="block text-sm font-medium text-gray-700 mb-1">*Alasan Tolak</label>
                            <textarea name="reason" id="reason" cols="30" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg"></textarea>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end gap-3 px-6 py-4 border-t border-gray-200 bg-gray-50 rounded-b-xl">
                    @role("Staff Desa")
                        <div class="flex gap-2 for-footer">
                            <button type="button" class="inline-flex items-center gap-1 bg-red-100 hover:bg-red-200 text-red-700 font-medium py-2 px-4 rounded-lg transition text-sm btn-reject" data-id="">Tolak</button>
                            <button type="button" class="inline-flex items-center gap-1 bg-green-100 hover:bg-green-200 text-green-700 font-medium py-2 px-4 rounded-lg transition text-sm btn-verif" data-id="">Verifikasi User</button>
                            <button type="button" class="inline-flex items-center gap-1 bg-purple-100 hover:bg-purple-200 text-purple-700 font-medium py-2 px-4 rounded-lg transition text-sm btn-staffDesa" data-id="">Jadikan Staff Desa</button>
                        </div>
                    @endrole
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Hook modal
            $('[data-target="#show-user"]').on('click', function() {
                document.getElementById('show-user-modal').classList.remove('hidden');
            });

            $(document).on('click', '.btn-show', function() {
                let id = $(this).attr('data-id');
                $.ajax({
                    headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
                    method: "POST",
                    url: "{{ route("getDataUserByID") }}",
                    data: { 'id': id },
                    success: function(data) {
                        let resp = data.data;
                        let urlImg = "{{ asset("img/ktp/") }}" + "/" + resp.data.ktp;
                        $('#nama').val(resp.data.name);
                        $('#agama').val(resp.data.agama);
                        $('#alamat').val(resp.data.alamat);
                        $('#nik').val(resp.data.nik);
                        $('#jenisKelamin').val(resp.data.jenis_kelamin);
                        $('#ktp').attr("src", urlImg)
                        $('#role').val(resp.role)
                        $('#userID').val(resp.data.id);
                        if (resp.role != 'Guest') {
                            $('.forguest').addClass('hidden');
                        } else {
                            $('.forguest').removeClass('hidden');
                        }
                    }
                });
            })

            $(document).on('click', '.btn-remove', function() {
                let id = $(this).attr('data-id');
                Swal.fire({
                    title: "Apakah anda yakin",
                    text: "Ingin menghapus user ini?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, Hapus!"
                }).then((result) => {
                    $.ajax({
                        headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
                        method: "POST",
                        url: "{{ route("user.destroy") }}",
                        data: { 'id': id },
                        success: function(data) { showSuccess(data.message); },
                        error: function(xhr) { showError(xhr.responseJSON.message) }
                    });
                });
            })

            $(document).on('click', '.btn-verif', function() {
                Swal.fire({
                    title: "Apakah anda yakin?",
                    text: "Melakukan Verifikasi terhadap akun ini?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, Verifikasi!"
                }).then((result) => {
                    if (result.isConfirmed) giveRole("User")
                });
            });

            $(document).on('click', '.btn-staffDesa', function() {
                Swal.fire({
                    title: "Apakah anda yakin?",
                    text: "Memberikan akses akun sebagai Staff Desa?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, Berikan!"
                }).then((result) => {
                    if (result.isConfirmed) giveRole("Staff Desa");
                });
            });

            $(document).on('click', '.btn-reject', function() {
                const reason = $('#reason').val();
                if (reason === '') {
                    showValidateionError('Alasan Tolak harus diisi');
                    return;
                }
                Swal.fire({
                    title: "Apakah anda yakin?",
                    text: "Menolak pendaftaran user ini ?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, Tolak!"
                }).then((result) => {
                    if (result.isConfirmed) rejectUser();
                });
            });

            function giveRole(role) {
                let id = $('#userID').val();
                $.ajax({
                    headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
                    method: "POST",
                    url: "{{ route("giveUserRole") }}",
                    data: { 'id': id, 'role': role },
                    success: function(data) {
                        showSuccess("Akun telah terverifikasi");
                        document.getElementById('show-user-modal').classList.add('hidden');
                    }
                });
            }

            function rejectUser() {
                let id = $('#userID').val();
                let reason = $('#reason').val();
                $.ajax({
                    headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
                    method: "POST",
                    url: "{{ route("rejectUser") }}",
                    data: { 'id': id, 'reason': reason },
                    success: function(data) {
                        showSuccess("Akun telah ditolak");
                        document.getElementById('show-user-modal').classList.add('hidden');
                    }
                });
            }
        });
    </script>
@endsection
