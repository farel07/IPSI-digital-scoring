@extends('superadmin.app')

@section('title', 'Kelola Panitia')

@push('styles')
<style>
    .card { border: none; border-radius: 1rem; box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1); }
    .table-custom thead th { border-bottom-width: 1px; }
    .table-custom td, .table-custom th { vertical-align: middle; }
    .invalid-feedback { font-size: 0.875em; }
    .action-buttons .btn { margin-right: 5px; }
</style>
@endpush

@section('content')
<!-- Breadcrumb -->
<nav class="mb-4">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/superadmin"><i class="bi bi-house-door-fill"></i> Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Kelola Panitia</li>
    </ol>
</nav>

{{-- Tampilkan notifikasi --}}
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card">
    <div class="card-body p-4">
        <!-- Card Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex align-items-center">
                <i class="bi bi-people-fill fs-2 text-success me-3"></i>
                <h3 class="mb-0 fw-bold">Kelola Panitia</h3>
            </div>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahPanitiaModal">
                <i class="bi bi-plus-circle-fill me-2"></i> Tambah Panitia
            </button>
        </div>
        
        <!-- Tabel Panitia -->
        <div class="table-responsive">
            <table class="table table-hover table-custom">
                <thead class="table-light">
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th>Nama Panitia</th>
                        <th style="width: 25%;">Arena Penugasan</th>
                        <th style="width: 15%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($daftar_panitia as $panitia)
                    <tr id="panitia-row-{{ $panitia->id }}">
                        <td>{{ $loop->iteration }}</td>
                        <td class="fw-semibold">
                            {{ $panitia->nama_lengkap }}
                            <br>
                            <small class="text-muted">{{ $panitia->role->name }}</small>
                        </td>
                        <td>
                            <select class="form-select arena-dropdown" data-user-id="{{ $panitia->id }}">
                                <option value="" {{ $panitia->user_arena->isEmpty() ? 'selected' : '' }}>-- Pilih Arena --</option>
                                @foreach ($semua_arena as $arena)
                                    <option value="{{ $arena->id }}" {{ $panitia->user_arena->first()?->arena_id == $arena->id ? 'selected' : '' }}>
                                        {{ $arena->arena_name }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td class="action-buttons">
                            <button type="button" class="btn btn-sm btn-primary edit-btn" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editPanitiaModal"
                                    data-user-id="{{ $panitia->id }}"
                                    data-user-json="{{ json_encode($panitia) }}">
                                <i class="bi bi-pencil-square"></i> Edit
                            </button>
                            <button type="button" class="btn btn-sm btn-danger delete-btn"
                                    data-bs-toggle="modal"
                                    data-bs-target="#hapusPanitiaModal"
                                    data-user-id="{{ $panitia->id }}"
                                    data-user-name="{{ $panitia->nama_lengkap }}">
                                <i class="bi bi-trash-fill"></i> Hapus
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-5"><h4>Tidak ada data panitia.</h4></td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Panitia -->
<div class="modal fade" id="tambahPanitiaModal" tabindex="-1" aria-labelledby="tambahPanitiaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="tambahPanitiaModalLabel">Form Tambah Panitia Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('panitia.store') }}" method="POST">
                @csrf
                <input type="hidden" name="form_type" value="store">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3"><label for="nama_lengkap" class="form-label">Nama Lengkap</label><input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required>@error('nama_lengkap')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                        <div class="col-md-6 mb-3"><label for="email" class="form-label">Email</label><input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>@error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                    </div>
                    <div class="mb-3"><label for="password" class="form-label">Password</label><input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>@error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                    <div class="mb-3"><label for="alamat" class="form-label">Alamat</label><textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="2" required>{{ old('alamat') }}</textarea>@error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                    <div class="row">
                        <div class="col-md-6 mb-3"><label for="tempat_lahir" class="form-label">Tempat Lahir</label><input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required>@error('tempat_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                        <div class="col-md-6 mb-3"><label for="tanggal_lahir" class="form-label">Tanggal Lahir</label><input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>@error('tanggal_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3"><label for="jenis_kelamin" class="form-label">Jenis Kelamin</label><select class="form-select @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin" name="jenis_kelamin" required><option value="" disabled selected>Pilih...</option><option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option><option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option></select>@error('jenis_kelamin')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                        <div class="col-md-6 mb-3"><label for="no_telp" class="form-label">Nomor Telepon</label><input type="tel" class="form-control @error('no_telp') is-invalid @enderror" id="no_telp" name="no_telp" value="{{ old('no_telp') }}" required>@error('no_telp')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3"><label for="negara" class="form-label">Negara</label><input type="text" class="form-control @error('negara') is-invalid @enderror" id="negara" name="negara" value="{{ old('negara', 'Indonesia') }}" required>@error('negara')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                        <div class="col-md-4 mb-3"><label for="role_id" class="form-label">Role</label><select class="form-select @error('role_id') is-invalid @enderror" id="role_id" name="role_id" required><option value="" disabled selected>Pilih Role...</option>@foreach ($roles as $role)<option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>@endforeach</select>@error('role_id')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                        <div class="col-md-4 mb-3"><label for="status" class="form-label">Status</label><select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required><option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>Aktif</option><option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Tidak Aktif</option></select>@error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                    </div>
                    <div class="mb-3"><label for="arena_id" class="form-label">Arena Penugasan (Opsional)</label><select class="form-select @error('arena_id') is-invalid @enderror" id="arena_id" name="arena_id"><option value="">Tidak ditugaskan ke arena</option>@foreach ($semua_arena as $arena)<option value="{{ $arena->id }}" {{ old('arena_id') == $arena->id ? 'selected' : '' }}>{{ $arena->arena_name }}</option>@endforeach</select>@error('arena_id')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
                </div>
                <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button><button type="submit" class="btn btn-primary">Simpan Panitia</button></div>
            </form>
        </div>
    </div>
</div>


<!-- Modal Edit Panitia -->
<div class="modal fade" id="editPanitiaModal" tabindex="-1" aria-labelledby="editPanitiaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="editPanitiaModalLabel">Edit Data Panitia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editPanitiaForm" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="form_type" value="update">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3"><label for="edit_nama_lengkap" class="form-label">Nama Lengkap</label><input type="text" class="form-control" id="edit_nama_lengkap" name="nama_lengkap" required></div>
                        <div class="col-md-6 mb-3"><label for="edit_email" class="form-label">Email</label><input type="email" class="form-control" id="edit_email" name="email" required></div>
                    </div>
                    <div class="mb-3"><label for="edit_password" class="form-label">Password Baru (Opsional)</label><input type="password" class="form-control" id="edit_password" name="password" placeholder="Isi hanya jika ingin mengubah password"></div>
                    <div class="mb-3"><label for="edit_alamat" class="form-label">Alamat</label><textarea class="form-control" id="edit_alamat" name="alamat" rows="2" required></textarea></div>
                    <div class="row">
                        <div class="col-md-6 mb-3"><label for="edit_tempat_lahir" class="form-label">Tempat Lahir</label><input type="text" class="form-control" id="edit_tempat_lahir" name="tempat_lahir" required></div>
                        <div class="col-md-6 mb-3"><label for="edit_tanggal_lahir" class="form-label">Tanggal Lahir</label><input type="date" class="form-control" id="edit_tanggal_lahir" name="tanggal_lahir" required></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3"><label for="edit_jenis_kelamin" class="form-label">Jenis Kelamin</label><select class="form-select" id="edit_jenis_kelamin" name="jenis_kelamin" required><option value="Laki-laki">Laki-laki</option><option value="Perempuan">Perempuan</option></select></div>
                        <div class="col-md-6 mb-3"><label for="edit_no_telp" class="form-label">Nomor Telepon</label><input type="tel" class="form-control" id="edit_no_telp" name="no_telp" required></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3"><label for="edit_negara" class="form-label">Negara</label><input type="text" class="form-control" id="edit_negara" name="negara" required></div>
                        <div class="col-md-4 mb-3"><label for="edit_role_id" class="form-label">Role</label><select class="form-select" id="edit_role_id" name="role_id" required>@foreach ($roles as $role)<option value="{{ $role->id }}">{{ $role->name }}</option>@endforeach</select></div>
                        <div class="col-md-4 mb-3"><label for="edit_status" class="form-label">Status</label><select class="form-select" id="edit_status" name="status" required><option value="1">Aktif</option><option value="0">Tidak Aktif</option></select></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="hapusPanitiaModal" tabindex="-1" aria-labelledby="hapusPanitiaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="hapusPanitiaModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus panitia <strong id="panitiaNameToDelete"></strong>? Tindakan ini tidak dapat dibatalkan.
            </div>
            <div class="modal-footer">
                <form id="hapusPanitiaForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // AJAX untuk ubah arena
    const arenaDropdowns = document.querySelectorAll('.arena-dropdown');
    arenaDropdowns.forEach(dropdown => {
        dropdown.dataset.originalArena = dropdown.value;
        dropdown.addEventListener('change', function () {
            const userId = this.dataset.userId;
            const newArenaId = this.value;
            const userName = this.closest('tr').querySelector('td:nth-child(2)').textContent.trim().split('\n')[0];
            const url = `{{ url('/superadmin/update-arena') }}/${userId}`;
            if (newArenaId === "") { this.value = this.dataset.originalArena; return; }
            if (!confirm(`Ubah arena untuk ${userName} menjadi ${this.options[this.selectedIndex].text}?`)) {
                this.value = this.dataset.originalArena; return;
            }
            fetch(url, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
                body: JSON.stringify({ arena_id: newArenaId })
            }).then(response => response.json().then(data => ({ ok: response.ok, data })))
              .then(({ ok, data }) => {
                if (!ok) throw new Error(data.message || 'Gagal.');
                alert(data.message);
                this.dataset.originalArena = newArenaId;
              }).catch(error => {
                alert('Terjadi kesalahan: ' + error.message);
                this.value = this.dataset.originalArena;
              });
        });
    });

    // JavaScript untuk Modal Edit
    const editModal = document.getElementById('editPanitiaModal');
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function() {
            const userData = JSON.parse(this.dataset.userJson);
            const form = editModal.querySelector('#editPanitiaForm');
            
            form.action = `{{ url('/superadmin/update') }}/${userData.id}`;
            
            form.querySelector('#edit_nama_lengkap').value = userData.nama_lengkap;
            form.querySelector('#edit_email').value = userData.email;
            form.querySelector('#edit_alamat').value = userData.alamat;
            form.querySelector('#edit_tempat_lahir').value = userData.tempat_lahir;
            form.querySelector('#edit_tanggal_lahir').value = userData.tanggal_lahir;
            form.querySelector('#edit_jenis_kelamin').value = userData.jenis_kelamin;
            form.querySelector('#edit_no_telp').value = userData.no_telp;
            form.querySelector('#edit_negara').value = userData.negara;
            form.querySelector('#edit_role_id').value = userData.role_id;
            form.querySelector('#edit_status').value = userData.status;
            form.querySelector('#edit_password').value = ''; // Kosongkan password
        });
    });

    // JavaScript untuk Modal Hapus
    const hapusModal = document.getElementById('hapusPanitiaModal');
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.dataset.userId;
            const userName = this.dataset.userName;
            const form = hapusModal.querySelector('#hapusPanitiaForm');
            
            form.action = `{{ url('/superadmin/destroy') }}/${userId}`;
            hapusModal.querySelector('#panitiaNameToDelete').textContent = userName;
        });
    });

    // Script untuk membuka kembali modal jika ada error validasi
    @if($errors->any())
        @if(old('form_type') === 'store')
            var tambahModal = new bootstrap.Modal(document.getElementById('tambahPanitiaModal'));
            tambahModal.show();
        @elseif(old('form_type') === 'update')
            // Untuk membuka modal edit yang benar, kita butuh tahu ID user mana yang error
            // Ini adalah pendekatan yang lebih kompleks. Untuk saat ini, kita bisa tampilkan modal kosong.
            var editModalInstance = new bootstrap.Modal(document.getElementById('editPanitiaModal'));
            // Anda perlu mengisi ulang data modal di sini jika ingin mempertahankan input lama saat error.
            editModalInstance.show();
        @endif
    @endif
});
</script>
@endpush