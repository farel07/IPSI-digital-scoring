@extends('main.main')
@section('content')

<div id="match-data" 
     data-pertandingan-id="{{ $pertandingan->id }}" 
     data-current-round="{{ $pertandingan->current_round }}">
</div>

    <div class="container mt-2 mb-2 rounded pb-4" style="background-color: rgb(216, 216, 216)">
        <div class="container">
            {{-- title --}}
            <div class="d-flex justify-content-between">
                <div class="m-2">
                    {{-- Ganti dengan data dari accessor pemain_unit_1 (Tim Biru) --}}
                    <p class="text-start m-0">{{ $pertandingan->pemain_unit_1->first()?->player?->contingent?->name ?? 'Kontingen Biru' }}</p>
                    <h5 class="text-primary fw-bold">
                        {{-- Loop semua pemain di unit 1 --}}
                        @forelse ($pertandingan->pemain_unit_1 as $peserta)
                            {{ $peserta->player->name ?? '' }}{{ !$loop->last ? ', ' : '' }}
                        @empty
                            Pemain Biru
                        @endforelse
                    </h5>
                </div>
                <div class="m-2">
                    <p class="m-0 fw-bold">{{ $pertandingan->kelasPertandingan?->kelas?->nama_kelas ?? 'Nama Pertandingan' }}</p>
                    <p class="m-0 fw-bold">ARENA {{ $pertandingan->arena_id }}</p>
                </div>
                <div class="mt-2 me-2">
                    {{-- Ganti dengan data dari accessor pemain_unit_2 (Tim Merah) --}}
                    <p class="text-end m-0">{{ $pertandingan->pemain_unit_2->first()?->player?->contingent?->name ?? 'Kontingen Merah' }}</p>
                    <h5 class="text-end text-danger fw-bold">
                        {{-- Loop semua pemain di unit 2 --}}
                         @forelse ($pertandingan->pemain_unit_2 as $peserta)
                            {{ $peserta->player->name ?? '' }}{{ !$loop->last ? ', ' : '' }}
                        @empty
                            Pemain Merah
                        @endforelse
                    </h5>
                </div>
            </div>
            {{-- end title --}}

            <input type="hidden" id="juri_ket" value="{{ $user->role->name }}">

            {{-- score --}}
            <div class="row justify-content-between">

                {{-- team blue --}}
                <div class="col-4">
                    <div class="p-3 border bg-primary text-light text-center" style="border-radius: 10px">TEAM BLUE
                    </div>
                    <div class="p-3 mt-3 border bg-light text-center" id="total-point-blue-1" style="border-radius: 10px">-</div>
                    <div class="p-3 mt-3 border bg-light text-center" id="total-point-blue-2" style="border-radius: 10px">-</div>
                    <div class="p-3 mt-3 border bg-light text-center" id="total-point-blue-3" style="border-radius: 10px">-</div>
                    <div class="row justify-content-between">
                        <div class="col-6 mb-3">
                            <button class="mt-3 btn btn-primary w-100" type="button" value="1" onclick="kirimPukul('blue')"  id="btn_pukul_blue" 
                                style="border-radius: 10px; height: 100px"><img class="w-25 me-2"
                                    src="{{ asset('assets') }}/img/icon/logo-pukul.png" alt="Pukul">PUKUL</button>
                        </div>
                        <div class="col-6">
                            <button class="mt-3 btn w-100 text-light" type="button" onclick="kirimHapusPoint('blue')" id="btn_hapus_point_blue" disabled
                                style="border-radius: 10px; height: 100px; background-color:rgb(190, 0, 0)">HAPUS POINT
                                TERBARU</button>
                        </div>
                        <div class="d-grid gap-2 col-6 me-auto mt-3">
                            <button class="btn btn-primary" id="btn_tendang_blue" type="button" style="border-radius: 10px; height: 100px" onclick="kirimTendang('blue')" value="2"><img
                                    class="w-25 me-1 mb-3" src="{{ asset('assets') }}/img/icon/logo-tendang.png"
                                    alt="Tendang">TENDANG</button>
                        </div>
                    </div>
                </div>
                {{-- end team blue --}}

                {{-- scoring --}}
                <div class="col-3">
                    <div class="p-3 border bg-warning text-light text-center" style="border-radius: 10px">SCORE</div>
                    <div class="p-3 mt-3 border bg-light text-center" style="border-radius: 10px">I</div>
                    <div class="p-3 mt-3 border bg-light text-center" style="border-radius: 10px">II</div>
                    <div class="p-3 mt-3 border bg-light text-center" style="border-radius: 10px">III</div>
                </div>
                {{-- end scoring --}}

                {{-- team red --}}
                <div class="col-4">
                    <div class="p-3 border bg-danger text-light text-center" style="border-radius: 10px">TEAM RED</div>
                    <div class="p-3 mt-3 border bg-light text-center" id="total-point-red-1" style="border-radius: 10px">-</div>
                    <div class="p-3 mt-3 border bg-light text-center" id="total-point-red-2" style="border-radius: 10px">-</div>
                    <div class="p-3 mt-3 border bg-light text-center" id="total-point-red-3" style="border-radius: 10px">-</div>
                    <div class="row justify-content-between">
                        <div class="col-6">
                            <button class="mt-3 btn btn-danger w-100 text-light" type="button" onclick="kirimHapusPoint('red')" id="btn_hapus_point_red" disabled
                                style="border-radius: 10px; background-color:rgb(190, 0, 0); height: 100px">HAPUS POINT
                                TERBARU</button>
                        </div>
                        <div class="col-6"> 
                            <button class="mt-3 btn btn-danger w-100" type="button" onclick="kirimPukul('red')" id="btn_pukul_red"
                                style="border-radius: 10px; height:100px" value="1"><img class="w-25 me-1" 
                                    src="{{ asset('assets') }}/img/icon/logo-pukul.png" alt="Pukul"> PUKUL</button>
                        </div>
                        <div class="d-grid gap-2 col-6 ms-auto mt-3">
                            <button class="btn btn-danger" type="button" style="border-radius: 10px;height: 100px" onclick="kirimTendang('red')" id="btn_tendang_red" value="2"><img
                                    class="w-25 me-1 mb-3" src="{{ asset('assets') }}/img/icon/logo-tendang.png"
                                    alt="Tendang">TENDANG</button>
                        </div>
                    </div>
                </div>
                {{-- end team red --}}
            </div>
            {{-- end score --}}
        </div>
    </div>
@endsection