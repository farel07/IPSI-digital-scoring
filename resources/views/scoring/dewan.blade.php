@extends('main.main')
@section('content')
    <div class="container">
        <div class="container mt-2 mb-2 rounded " style="background-color: rgb(216, 216, 216)">
            
            {{-- Lakukan pengecekan utama: Apakah ada pertandingan aktif? --}}
            @if (isset($pertandingan) && $pertandingan)

                <div class="container">
                    {{-- title --}}
                    <div class="d-flex justify-content-between">
                        <div class="m-2">
                            {{-- [FIX] Mengambil data dari accessor pemain_unit_1 (Tim Biru) --}}
                            <p class="text-start m-0">{{ $pertandingan->pemain_unit_1->first()?->player?->contingent?->name ?? 'Kontingen Biru' }}</p>
                            <h5 class="text-primary">
                                @forelse ($pertandingan->pemain_unit_1 as $peserta)
                                    {{ $peserta->player?->name ?? 'Pemain Biru' }}{{ !$loop->last ? ', ' : ''}}
                                @empty
                                    Pemain Biru Belum Ada
                                @endforelse
                            </h5>
                        </div>
                        <div class="m-2">
                            <p class="m-0 fw-bold">{{ $pertandingan->kelasPertandingan?->kelas?->nama_kelas ?? 'Nama Pertandingan' }}</p>
                            <p class="m-0 fw-bold">ARENA {{ $pertandingan->arena_id }}</p>
                        </div>
                        <div class="mt-2 me-2">
                            {{-- [FIX] Mengambil data dari accessor pemain_unit_2 (Tim Merah) --}}
                            <p class="text-end m-0">{{ $pertandingan->pemain_unit_2->first()?->player?->contingent?->name ?? 'Kontingen Merah' }}</p>
                            <h5 class="text-end text-danger">
                                @forelse ($pertandingan->pemain_unit_2 as $peserta)
                                    {{ $peserta->player?->name ?? 'Pemain Merah' }}{{ !$loop->last ? ', ' : ''}}
                                @empty
                                    Pemain Merah Belum Ada
                                @endforelse
                            </h5>
                        </div>
                    </div>
                    {{-- end title --}}

                    {{-- score --}}
                    <div class="row justify-content-between">
                        {{-- team blue --}}
                        <div class="col-5">
                            <div class="row justify-content-start">
                                <div class="col-3 pe-0"><div class="p-3 border bg-primary text-light text-center" style="font-size:14px; border-radius: 10px; width: 90px">BINA</div></div>
                                <div class="col-3 ps-0 pe-0" style="width: 98px"><div class="py-3 border bg-primary text-light text-center" style="font-size:14px; border-radius: 10px; width: 90px">TEGURAN</div></div>
                                <div class="col-3 ps-1 p-0" style="width: 98px"><div class="py-3 border bg-primary text-light text-center" style="font-size:14px;border-radius: 10px; width: 90px">PERINGATAN</div></div>
                                <div class="col-3 ps-2 p-0"><div class="p-3 border bg-primary text-light text-center" style="font-size:14px; border-radius: 10px; width: 90px">JATUH</div></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-3 pe-0"><div class="p-3 border bg-light text-dark text-center" style="font-size:14px; border-radius: 10px; width: 90px" id="point-bina-blue-1">bina</div></div>
                                <div class="col-3 ps-0 pe-0" style="width: 98px"><div class="py-3 border bg-light text-dark text-center" style="font-size:14px; border-radius: 10px; width: 90px" id="point-teguran-blue-1">teguran</div></div>
                                <div class="col-3 ps-1 p-0" style="width: 98px"><div class="py-3 border bg-light text-dark text-center" style="font-size:14px;border-radius: 10px; width: 90px" id="point-peringatan-blue-1">peringatan</div></div>
                                <div class="col-3 ps-2 p-0"><div class="p-3 border bg-light text-dark text-center" style="font-size:14px; border-radius: 10px; width: 90px" id="point-jatuh-blue-1">jatuh</div></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-3 pe-0"><div class="p-3 border bg-light text-dark text-center" style="font-size:14px; border-radius: 10px; width: 90px" id="point-bina-blue-2">bina 2</div></div>
                                <div class="col-3 ps-0 pe-0" style="width: 98px"><div class="py-3 border bg-light text-dark text-center" style="font-size:14px; border-radius: 10px; width: 90px" id="point-teguran-blue-2">teguran 2</div></div>
                                <div class="col-3 ps-1 p-0" style="width: 98px"><div class="py-3 border bg-light text-dark text-center" style="font-size:14px;border-radius: 10px; width: 90px" id="point-peringatan-blue-2">peringatan 2</div></div>
                                <div class="col-3 ps-2 p-0"><div class="p-3 border bg-light text-dark text-center" style="font-size:14px; border-radius: 10px; width: 90px" id="point-jatuh-blue-2">jatuh 2</div></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-3 pe-0"><div class="p-3 border bg-light text-dark text-center" style="font-size:14px; border-radius: 10px; width: 90px" id="point-bina-blue-3">bina 3</div></div>
                                <div class="col-3 ps-0 pe-0" style="width: 98px"><div class="py-3 border bg-light text-dark text-center" style="font-size:14px; border-radius: 10px; width: 90px" id="point-teguran-blue-3">teguran 3</div></div>
                                <div class="col-3 ps-1 p-0" style="width: 98px"><div class="py-3 border bg-light text-dark text-center" style="font-size:14px;border-radius: 10px; width: 90px" id="point-peringatan-blue-3">peringatan 3</div></div>
                                <div class="col-3 ps-2 p-0"><div class="p-3 border bg-light text-dark text-center" style="font-size:14px; border-radius: 10px; width: 90px" id="point-jatuh-blue-3">jatuh 3</div></div>
                            </div>

                            <div class="row justify-content-between me-4">
                                <div class="col-6"><button id="btn_jatuh_blue" class="mt-3 btn btn-primary w-100" onclick="kirimJatuh('blue')" type="button" style="border-radius: 10px; height:100px" value="1">JATUH</button></div>
                                <div class="col-6"><button id="btn_binaan_blue" class="mt-3 btn btn-primary w-100" onclick="kirimBinaan('blue')" value="1" type="button" style="border-radius: 10px; height:100px">BINA</button></div>
                                <div class="col-6"><button id="btn_teguran_blue" class="mt-3 btn btn-primary w-100" onclick="kirimTeguran('blue')" value="1" type="button" style="border-radius: 10px; height:100px">TEGURAN</button></div>
                                <div class="col-6"><button id="btn_peringatan_blue" class="mt-3 btn btn-primary w-100" onclick="kirimPeringatan('blue')" value="1" type="button" style="border-radius: 10px; height:100px">PERINGATAN</button></div>
                                <div class="col-6"><button class="mt-3 btn btn-primary w-100 h-75" type="button" id="btn_hapus_jatuhan_blue" style="border-radius: 10px; background-color:rgb(190, 0, 0)" disabled onclick="kirimHapus('jatuhan', 'blue')">HAPUS JATUHAN</button></div>
                                <div class="col-6"><button class="mt-3 btn btn-primary w-100 h-75" type="button" id="btn_hapus_pelanggaran_blue" style="border-radius: 10px; background-color:rgb(190, 0, 0)" disabled onclick="kirimHapus('pelanggaran', 'blue')" value="0">HAPUS PELANGGARAN</button></div>
                            </div>
                        </div>
                        
                        {{-- scoring --}}
                        <div class="col-2">
                            <div class="p-3 border bg-success text-light text-center" style="border-radius: 10px; height:55px">SCORE</div>
                            @php $currentRound = $pertandingan->round_number ?? 1; @endphp
                            <div class="p-3 mt-2 border {{ $currentRound == 1 ? 'bg-warning' : 'bg-light' }} text-center" style="border-radius: 10px; height:55px">I</div>
                            <div class="p-3 mt-2 border {{ $currentRound == 2 ? 'bg-warning' : 'bg-light' }} text-center" style="border-radius: 10px; height:55px">II</div>
                            <div class="p-3 mt-2 border {{ $currentRound == 3 ? 'bg-warning' : 'bg-light' }} text-center" style="border-radius: 10px; height:55px">III</div>
                            
                            <div class="mt-5">
                                <button type="button" class="btn btn-warning text-light" data-bs-toggle="modal" data-bs-target="#exampleModal">REQUEST VALIDATION</button>
                                {{-- Modal Content Here --}}
                                <div class="btn btn-success mt-2">TENTUKAN PEMENANG</div>
                                <div class="border bg-dark p-2 mt-2 rounded-top"><p class="m-0 text-center text-light">LAST VALIDATION</p></div>
                                <div class="border bg-light p-2 mb-2 rounded-bottom"><p class="m-0 text-center">NO RESULT</p></div>
                            </div>
                        </div>

                        {{-- team red --}}
                        <div class="col-5">
                            <div class="row justify-content-end">
                                <div class="col-3 pe-0"><div class="p-3 border bg-danger text-light text-center" style="font-size:14px; border-radius: 10px; width: 90px">BINA</div></div>
                                <div class="col-3 ps-0 pe-0" style="width: 98px"><div class="py-3 border bg-danger text-light text-center" style="font-size:14px; border-radius: 10px; width: 90px">TEGURAN</div></div>
                                <div class="col-3 ps-1 p-0" style="width: 98px"><div class="py-3 border bg-danger text-light text-center" style="font-size:14px;border-radius: 10px; width: 90px">PERINGATAN</div></div>
                                <div class="col-3 ps-2 p-0"><div class="p-3 border bg-danger text-light text-center" style="font-size:14px; border-radius: 10px; width: 90px">JATUH</div></div>
                            </div>
                            <div class="row justify-content-end mt-2">
                                <div class="col-3 pe-0"><div class="p-3 border bg-light text-dark text-center" style="font-size:14px; border-radius: 10px; width: 90px" id="point-bina-red-1">bina</div></div>
                                <div class="col-3 ps-0 pe-0" style="width: 98px"><div class="py-3 border bg-light text-dark text-center" style="font-size:14px; border-radius: 10px; width: 90px" id="point-teguran-red-1">teguran</div></div>
                                <div class="col-3 ps-1 p-0" style="width: 98px"><div class="py-3 border bg-light text-dark text-center" style="font-size:14px;border-radius: 10px; width: 90px" id="point-peringatan-red-1">peringatan</div></div>
                                <div class="col-3 ps-2 p-0"><div class="p-3 border bg-light text-dark text-center" style="font-size:14px; border-radius: 10px; width: 90px" id="point-jatuh-red-1">jatuh</div></div>
                            </div>
                            {{-- Baris point 2 & 3 untuk Merah --}}
                            <div class="row justify-content-end mt-2">
                                <div class="col-3 pe-0"><div class="p-3 border bg-light text-dark text-center" style="font-size:14px; border-radius: 10px; width: 90px" id="point-bina-red-2">-</div></div>
                                <div class="col-3 ps-0 pe-0" style="width: 98px"><div class="py-3 border bg-light text-dark text-center" style="font-size:14px; border-radius: 10px; width: 90px" id="point-teguran-red-2">-</div></div>
                                <div class="col-3 ps-1 p-0" style="width: 98px"><div class="py-3 border bg-light text-dark text-center" style="font-size:14px;border-radius: 10px; width: 90px" id="point-peringatan-red-2">-</div></div>
                                <div class="col-3 ps-2 p-0"><div class="p-3 border bg-light text-dark text-center" style="font-size:14px; border-radius: 10px; width: 90px" id="point-jatuh-red-2">-</div></div>
                            </div>
                            <div class="row justify-content-end mt-2">
                                <div class="col-3 pe-0"><div class="p-3 border bg-light text-dark text-center" style="font-size:14px; border-radius: 10px; width: 90px" id="point-bina-red-3">-</div></div>
                                <div class="col-3 ps-0 pe-0" style="width: 98px"><div class="py-3 border bg-light text-dark text-center" style="font-size:14px; border-radius: 10px; width: 90px" id="point-teguran-red-3">-</div></div>
                                <div class="col-3 ps-1 p-0" style="width: 98px"><div class="py-3 border bg-light text-dark text-center" style="font-size:14px;border-radius: 10px; width: 90px" id="point-peringatan-red-3">-</div></div>
                                <div class="col-3 ps-2 p-0"><div class="p-3 border bg-light text-dark text-center" style="font-size:14px; border-radius: 10px; width: 90px" id="point-jatuh-red-3">-</div></div>
                            </div>
                            <div class="row justify-content-between">
                                <div class="col-6 ps-3"><button id="btn_jatuh_red" class="mt-3 btn btn-danger w-100" onclick="kirimJatuh('red')" type="button" style="border-radius: 10px; height:100px" value="1">JATUH</button></div>
                                <div class="col-6 pe-3"><button class="mt-3 btn btn-danger w-100" id="btn_binaan_red" type="button" style="border-radius: 10px; height:100px" onclick="kirimBinaan('red')" value="1" type="button">BINA</button></div>
                                <div class="col-6 ps-3"><button class="mt-3 btn btn-danger w-100" id="btn_teguran_red" type="button" style="border-radius: 10px; height:100px" onclick="kirimTeguran('red')" value="1" type="button">TEGURAN</button></div>
                                <div class="col-6 pe-3"><button class="mt-3 btn btn-danger w-100" id="btn_peringatan_red" type="button" style="border-radius: 10px; height:100px" onclick="kirimPeringatan('red')" value="1" type="button">PERINGATAN</button></div>
                                <div class="col-6"><button class="mt-3 btn btn-primary w-100 h-75" type="button" style="border-radius: 10px; background-color:rgb(190, 0, 0)" id="btn_hapus_jatuhan_red" onclick="kirimHapus('jatuhan', 'red')" disabled>HAPUS JATUHAN</button></div>
                                <div class="col-6"><button class="mt-3 btn btn-primary w-100 h-75" type="button" style="border-radius: 10px; background-color:rgb(190, 0, 0)" id="btn_hapus_pelanggaran_red" onclick="kirimHapus('pelanggaran', 'red')" disabled>HAPUS PELANGGARAN</button></div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                {{-- Ini akan ditampilkan jika controller tidak menemukan pertandingan aktif --}}
                <div class="text-center p-5"><h3>Tidak Ada Pertandingan Aktif</h3><p>Saat ini tidak ada pertandingan aktif yang ditugaskan kepada Dewan di Arena ini.</p></div>
            @endif
        </div>
    </div>
@endsection 