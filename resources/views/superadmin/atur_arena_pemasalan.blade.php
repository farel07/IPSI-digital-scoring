@extends('superadmin.app')

@section('title', 'Atur Pertandingan Pemasalan Manual')

@push('styles')
{{-- Library untuk dropdown multi-select yang canggih --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<style>
    .card { border: none; border-radius: 1rem; box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1); }
    .select2-container--bootstrap-5 .select2-selection {
        min-height: calc(1.5em + 1rem + 2px);
        padding: 0.5rem 1rem;
    }
    .form-info {
        background-color: #e9ecef;
        padding: 1rem;
        border-radius: 0.5rem;
        border: 1px solid #dee2e6;
    }
</style>
@endpush

@section('content')
<div class="card">
    <div class="card-body p-4">
        <h3 class="fw-bold mb-4">Buat Pertandingan Manual (Pemasalan)</h3>
        
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form action="{{ route('pertandingan.manual.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="kelas_pertandingan_id" class="form-label fw-semibold">1. Pilih Kelas Pertandingan</label>
                    <select class="form-select" id="kelas_pertandingan_id" name="kelas_pertandingan_id" required>
                        <option value="" disabled selected>-- Pilih Kelas yang Memiliki Peserta --</option>
                        @foreach ($daftar_kelas as $kelas)
                            <option value="{{ $kelas->id }}" data-jumlah-pemain="{{ $kelas->kelas->jumlah_pemain }}">
                                {{ $kelas->kelas->nama_kelas }} ({{ $kelas->gender }}) - {{ $kelas->jenisPertandingan->nama_jenis }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="unit_1_pemain" class="form-label fw-semibold">2. Pilih Peserta Sudut Biru (Unit 1)</label>
                    <select class="form-select multi-select" id="unit_1_pemain" name="unit_1_pemain[]" multiple="multiple" required disabled>
                        {{-- Opsi pemain akan diisi oleh JavaScript --}}
                    </select>
                    <small class="form-text text-muted">Pilih <strong id="unit-1-info" class="text-danger">1</strong> pemain.</small>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="unit_2_pemain" class="form-label fw-semibold">3. Pilih Peserta Sudut Merah (Unit 2)</label>
                    <select class="form-select multi-select" id="unit_2_pemain" name="unit_2_pemain[]" multiple="multiple" required disabled>
                        {{-- Opsi pemain akan diisi oleh JavaScript --}}
                    </select>
                    <small class="form-text text-muted">Pilih <strong id="unit-2-info" class="text-danger">1</strong> pemain.</small>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="round_number" class="form-label fw-semibold">Nomor Babak</label>
                    <input type="number" class="form-control" id="round_number" name="round_number" value="1" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="match_number" class="form-label fw-semibold">Nomor Pertandingan</gabel>
                    <input type="number" class="form-control" id="match_number" name="match_number" value="1" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="arena_id" class="form-label fw-semibold">Arena (Opsional)</label>
                    <select class="form-select" id="arena_id" name="arena_id">
                        <option value="">-- Tidak Ditugaskan --</option>
                        @foreach ($daftar_arena as $arena)
                            <option value="{{ $arena->id }}">{{ $arena->arena_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-3">
                <i class="bi bi-plus-circle-fill me-2"></i> Buat Pertandingan
            </button>
        </form>
    </div>
</div>
@endsection

@push('scripts')
{{-- Gunakan jQuery versi penuh, bukan slim, untuk memastikan semua fungsi tersedia --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    const selectUnit1 = $('#unit_1_pemain');
    const selectUnit2 = $('#unit_2_pemain');
    
    // Inisialisasi awal
    $('.multi-select').select2({
        theme: "bootstrap-5",
        placeholder: 'Pilih kelas terlebih dahulu',
        closeOnSelect: false,
    });

    const pemainPerKelas = @json($daftar_pemain_per_kelas);

    $('#kelas_pertandingan_id').on('change', function() {
        const kelasId = $(this).val();
        const selectedOption = $(this).find('option:selected');
        const jumlahPemain = parseInt(selectedOption.data('jumlah-pemain')) || 1;
        const pemainDiKelasIni = pemainPerKelas[kelasId] || [];
        
        // Kosongkan dan reset
        selectUnit1.empty();
        selectUnit2.empty();
        $('#unit-1-info').text(jumlahPemain);
        $('#unit-2-info').text(jumlahPemain);
        
        selectUnit1.select2('destroy').select2({ theme: "bootstrap-5", placeholder: `Pilih ${jumlahPemain} pemain...`, closeOnSelect: false, maximumSelectionLength: jumlahPemain });
        selectUnit2.select2('destroy').select2({ theme: "bootstrap-5", placeholder: `Pilih ${jumlahPemain} pemain...`, closeOnSelect: false, maximumSelectionLength: jumlahPemain });

        if (pemainDiKelasIni.length > 0) {
            // [FIX] Buat elemen <option> baru untuk setiap dropdown secara terpisah
            $.each(pemainDiKelasIni, function(index, pemain) {
                const optionText = `${pemain.name} (${pemain.contingent_name})`;
                // Buat untuk unit 1
                selectUnit1.append(new Option(optionText, pemain.id, false, false));
                // Buat lagi untuk unit 2
                selectUnit2.append(new Option(optionText, pemain.id, false, false));
            });
            selectUnit1.prop('disabled', false);
            selectUnit2.prop('disabled', false);
        } else {
            selectUnit1.prop('disabled', true);
            selectUnit2.prop('disabled', true);
        }
        
        selectUnit1.trigger('change');
        selectUnit2.trigger('change');
    });

    function filterOpponentOptions() {
        const idsUnit1 = selectUnit1.val() || [];
        const idsUnit2 = selectUnit2.val() || [];

        selectUnit1.find('option').each(function() {
            const isSelf = idsUnit1.includes($(this).val());
            const isInOtherUnit = idsUnit2.includes($(this).val());
            $(this).prop('disabled', !isSelf && isInOtherUnit);
        });

        selectUnit2.find('option').each(function() {
            const isSelf = idsUnit2.includes($(this).val());
            const isInOtherUnit = idsUnit1.includes($(this).val());
            $(this).prop('disabled', !isSelf && isInOtherUnit);
        });
        
        selectUnit1.trigger('change.select2');
        selectUnit2.trigger('change.select2');
    }

    selectUnit1.on('change', filterOpponentOptions);
    selectUnit2.on('change', filterOpponentOptions);
});
</script>
@endpush