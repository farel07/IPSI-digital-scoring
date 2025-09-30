@extends('main.main')

@section('content')
    <div class="container px-0 mt-2 mb-2 rounded pb-4" style="background-color: rgb(216, 216, 216)">
       
        @if(isset($pertandingan))
            <input type="hidden" name="pertandingan_id" id="pertandingan_id" value="{{ $pertandingan->id ?? '' }}">
        @endif

        {{-- Pengecekan utama: Apakah controller berhasil mengirim objek pertandingan yang valid? --}}
        @if (isset($pertandingan) && $pertandingan)
         <input type="hidden" name="pertandingan_id" id="pertandingan_id" value="{{ $pertandingan->id ?? '' }}">
            {{-- navbar --}}
            <div class="border rounded-top w-100" style="background-color: blueviolet; ">
                <div class="container">
                    <p class="text-light text-center m-0 p-2" style="font-size: 20px">
                        SCORING DIGITAL
                        {{ $pertandingan->kelasPertandingan?->kelas?->nama_kelas ?? 'Kelas Tanding' }} -
                        {{ $pertandingan->kelasPertandingan?->kategoriPertandingan?->nama_kategori ?? 'Kategori' }}
                    </p>
                </div>
            </div>
            {{-- end of navbar --}}

            <div class="container">
                {{-- title --}}
                <div class="d-flex justify-content-between">
                    <div class="m-2">
                        <p class="text-start m-0">
                            {{ $pertandingan->pemain_unit_1->first()?->player?->contingent?->name ?? 'Kontingen Biru' }}
                        </p>
                        <h5 class="text-primary">
                            @forelse ($pertandingan->pemain_unit_1 as $peserta)
                                {{ $peserta->player?->name ?? 'Pemain Biru' }}{{ !$loop->last ? ', ' : '' }}
                            @empty
                                Pemain Biru Belum Ada
                            @endforelse
                        </h5>
                    </div>
                    <div class="m-2">
                        <div class="px-3 pt-5 text-dark text-center" style="border-radius: 10px">
                            <span class="text-bold libertinus-font" style="font-size: 50px" id="timer">00:00</span>
                        </div>
                    </div>
                    <div class="mt-2 me-2 text-end">
                        <p class="m-0">
                            {{ $pertandingan->pemain_unit_2->first()?->player?->contingent?->name ?? 'Kontingen Merah' }}
                        </p>
                        <h5 class="text-danger">
                            @forelse ($pertandingan->pemain_unit_2 as $peserta)
                                {{ $peserta->player?->name ?? 'Pemain Merah' }}{{ !$loop->last ? ', ' : '' }}
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
                        <div class="row">
                            <div class="col-5">
                                <div class="d-flex flex-column">
                                    <div class="d-flex justify-content-around mt-3">
                                        @if ($pertandingan->detailPointTanding?->binaan_point_1 > 0 && $pertandingan->detailPointTanding?->binaan_point_1 < 2)
                                           <img src="{{ asset('assets') }}/img/icon/icon-onefinger.png" alt="Binaan 1" style="width:60px;height:60px;rotate:270deg; filter: brightness(0) saturate(100%) invert(89%) sepia(87%) saturate(375%) hue-rotate(359deg) brightness(104%) contrast(104%)" id="blue-notif-binaan-1">
                                        @elseif ($pertandingan->detailPointTanding?->binaan_point_1 == 0)
                                            <img src="{{ asset('assets/img/icon/icon-onefinger.png') }}" alt="Binaan 1" style="width:60px; height:60px; rotate:270deg;" id="blue-notif-binaan-1">
                                        @else
                                            <img src="{{ asset('assets') }}/img/icon/icon-onefinger.png" alt="Binaan 1" style="width:60px;height:60px;rotate:270deg; filter: brightness(0) saturate(100%) invert(89%) sepia(87%) saturate(375%) hue-rotate(359deg) brightness(104%) contrast(104%)" id="blue-notif-binaan-1">
                                        @endif

                                        @if ($pertandingan->detailPointTanding?->binaan_point_1 > 1 && $pertandingan->detailPointTanding?->binaan_point_1 < 3)
                                            <img src="{{ asset('assets/img/icon/icon-twofinger.png') }}" alt="Binaan 2" style="width:60px;height:60px;rotate:270deg; filter: brightness(0) saturate(100%) invert(89%) sepia(87%) saturate(375%) hue-rotate(359deg) brightness(104%) contrast(104%)" id="blue-notif-binaan-2">
                                        @else
                                            <img src="{{ asset('assets/img/icon/icon-twofinger.png') }}" alt="Binaan 2" style="width:60px;height:60px;rotate:270deg;" id="blue-notif-binaan-2">
                                        @endif
                                    </div>
                                    <div class="d-flex justify-content-around mt-3">
                                        @if ($pertandingan->detailPointTanding?->teguran_1 == 0)
                                            <img src="{{ asset('assets') }}/img/icon/icon-onefinger.png" alt="Teguran 1" style="width:60px ; height: 60px;" id="blue-notif-teguran-1">
                                        @else
                                            <img src="{{ asset('assets') }}/img/icon/icon-onefinger.png" alt="Teguran 1" style="width:60px ; height: 60px; filter: brightness(0) saturate(100%) invert(89%) sepia(87%) saturate(375%) hue-rotate(359deg) brightness(104%) contrast(104%)" id="blue-notif-teguran-1">
                                        @endif

                                        @if ($pertandingan->detailPointTanding?->teguran_1 > 1 && $pertandingan->detailPointTanding?->teguran_1 < 3)
                                            <img src="{{ asset('assets') }}/img/icon/icon-twofinger.png" alt="Teguran 2" style="width:60px ; height: 60px; filter: brightness(0) saturate(100%) invert(89%) sepia(87%) saturate(375%) hue-rotate(359deg) brightness(104%) contrast(104%)" id="blue-notif-teguran-2">
                                        @elseif ($pertandingan->detailPointTanding?->teguran_1 > 0 && $pertandingan->detailPointTanding?->teguran_1 < 2)
                                            <img src="{{ asset('assets') }}/img/icon/icon-twofinger.png" alt="Binaan 1" style="width:60px;height:60px;" id="blue-notif-binaan-1">
                                        @elseif ($pertandingan->detailPointTanding?->teguran_1 == 0)
                                            <img src="{{ asset('assets') }}/img/icon/icon-twofinger.png" alt="Teguran 2" style="width:60px ; height: 60px;" id="blue-notif-teguran-2">
                                        @else 
                                            <img src="{{ asset('assets') }}/img/icon/icon-twofinger.png" alt="Teguran 2" style="width:60px ; height: 60px; filter: brightness(0) saturate(100%) invert(89%) sepia(87%) saturate(375%) hue-rotate(359deg) brightness(104%) contrast(104%)" id="blue-notif-teguran-2">
                                        @endif
                                    </div>
                                    <div class="d-flex justify-content-around mt-3">
                                        @if ($pertandingan->detailPointTanding?->peringatan_1 > 0 && $pertandingan->detailPointTanding?->peringatan_1 < 2)
                                            <img src="{{ asset('assets') }}/img/icon/icon-wasit.png" alt="Peringatan 1" style="width:60px ; height: 60px; filter: brightness(0) saturate(100%) invert(89%) sepia(87%) saturate(375%) hue-rotate(359deg) brightness(104%) contrast(104%)" id="blue-notif-peringatan-1">
                                        @elseif ($pertandingan->detailPointTanding?->peringatan_1 > 2 && $pertandingan->detailPointTanding?->peringatan_1 > 1)
                                            <img src="{{ asset('assets') }}/img/icon/icon-wasit.png" alt="Peringatan 1" style="width:60px ; height: 60px; filter: brightness(0) saturate(100%) invert(89%) sepia(87%) saturate(375%) hue-rotate(359deg) brightness(104%) contrast(104%)" id="blue-notif-peringatan-1">
                                        @elseif($pertandingan->detailPointTanding?->peringatan_1 == 0)
                                            <img src="{{ asset('assets') }}/img/icon/icon-wasit.png" alt="Peringatan 1" style="width:60px ; height: 60px;" id="blue-notif-peringatan-1">
                                        @else
                                            <img src="{{ asset('assets') }}/img/icon/icon-wasit.png" alt="Peringatan 1" style="width:60px ; height: 60px; filter: brightness(0) saturate(100%) invert(89%) sepia(87%) saturate(375%) hue-rotate(359deg) brightness(104%) contrast(104%)" id="blue-notif-peringatan-1">
                                        @endif

                                        @if ($pertandingan->detailPointTanding?->peringatan_1 > 1 && $pertandingan->detailPointTanding?->peringatan_1 < 3)
                                            <img src="{{ asset('assets') }}/img/icon/icon-wasit.png" alt="Peringatan 2" style="width:60px ; height: 60px; filter: brightness(0) saturate(100%) invert(89%) sepia(87%) saturate(375%) hue-rotate(359deg) brightness(104%) contrast(104%)" id="blue-notif-peringatan-2">
                                        @elseif ($pertandingan->detailPointTanding?->peringatan_1 > 2)
                                            <img src="{{ asset('assets') }}/img/icon/icon-wasit.png" alt="Peringatan 2" style="width:60px ; height: 60px; filter: brightness(0) saturate(100%) invert(89%) sepia(87%) saturate(375%) hue-rotate(359deg) brightness(104%) contrast(104%)" id="blue-notif-peringatan-2">
                                        @elseif($pertandingan->detailPointTanding?->peringatan_1 == 0)
                                            <img src="{{ asset('assets') }}/img/icon/icon-wasit.png" alt="Peringatan 2" style="width:60px ; height: 60px;" id="blue-notif-peringatan-2">
                                        @else
                                            <img src="{{ asset('assets') }}/img/icon/icon-wasit.png" alt="Peringatan 2" style="width:60px ; height: 60px;" id="blue-notif-peringatan-2">
                                        @endif 
                                    </div>
                                </div>
                            </div>
                            <div class="col-7 h-100">
                                {{-- [DINAMIS] Total Point Player 1 (Biru) --}}
                                <div class="border bg-primary px-4 pb-3 rounded">
                                    <p id="total-point-blue" class="text-center text-light m-0" style="font-size: 150px">{{ $pertandingan->detailPointTanding?->total_point_1 ?? 0 }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- scoring --}}
                    <div class="col-2 justify-content-center">
                        {{-- [DINAMIS] Round Number --}}
                        {{-- <div class="px-2 pt-2 mx-auto mt-4 mb-4 border bg-warning rounded-circle text-light text-center" style="width: 60px; height:60px; font-size: 25px">
                            {{ $pertandingan->detailPointTanding?->round ?? 1 }}
                        </div> --}}
                        <div class="scoring">
                        {{-- TAMBAHKAN ID UNIK DI SETIAP INDIKATOR --}}
                            <div id="round-box-1" class="p-1 mt-3 border {{ $pertandingan->current_round >= 1 ? 'bg-warning' : 'bg-light' }} text-center" style="border-radius: 10px">I</div>
                            <div id="round-box-2" class="p-1 mt-3 border {{ $pertandingan->current_round >= 2 ? 'bg-warning' : 'bg-light' }} text-center" style="border-radius: 10px">II</div>
                            @if ($pertandingan->kelasPertandingan?->kategoriPertandingan?->nama_kategori != 'Pemasalan')    
                                <div id="round-box-3" class="p-1 mt-3 border {{ $pertandingan->current_round >= 3 ? 'bg-warning' : 'bg-light' }} text-center" style="border-radius: 10px">III</div>
                            @endif
                        </div>
                    </div>

                    {{-- team red --}}
                    <div class="col-5">
                        <div class="row">
                            <div class="col-7 h-100">
                                {{-- [DINAMIS] Total Point Player 2 (Merah) --}}
                                <div class="border bg-danger px-4 pb-3 rounded">
                                    <p id="total-point-red" class="text-center text-light m-0" style="font-size: 150px">{{ $pertandingan->detailPointTanding?->total_point_2 ?? 0 }}</p>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="d-flex flex-column">
                                    <div class="d-flex justify-content-around mt-3">
                                        @if ($pertandingan->detailPointTanding?->binaan_point_2 > 0 && $pertandingan->detailPointTanding?->binaan_point_2 < 2)
                                           <img src="{{ asset('assets') }}/img/icon/icon-onefinger.png" alt="Binaan 1" style="width:60px;height:60px;rotate:270deg; filter: brightness(0) saturate(100%) invert(89%) sepia(87%) saturate(375%) hue-rotate(359deg) brightness(104%) contrast(104%)" id="red-notif-binaan-1">
                                        @elseif ($pertandingan->detailPointTanding?->binaan_point_2 == 0)
                                            <img src="{{ asset('assets/img/icon/icon-onefinger.png') }}" alt="Binaan 1" style="width:60px; height:60px; rotate:270deg;" id="red-notif-binaan-1">
                                        @else
                                            <img src="{{ asset('assets') }}/img/icon/icon-onefinger.png" alt="Binaan 1" style="width:60px;height:60px;rotate:270deg; filter: brightness(0) saturate(100%) invert(89%) sepia(87%) saturate(375%) hue-rotate(359deg) brightness(104%) contrast(104%)" id="red-notif-binaan-1">
                                        @endif

                                        @if ($pertandingan->detailPointTanding?->binaan_point_2 > 1 && $pertandingan->detailPointTanding?->binaan_point_2 < 3)
                                            <img src="{{ asset('assets/img/icon/icon-twofinger.png') }}" alt="Binaan 2" style="width:60px;height:60px;rotate:270deg; filter: brightness(0) saturate(100%) invert(89%) sepia(87%) saturate(375%) hue-rotate(359deg) brightness(104%) contrast(104%)" id="red-notif-binaan-2">
                                        @else
                                            <img src="{{ asset('assets/img/icon/icon-twofinger.png') }}" alt="Binaan 2" style="width:60px;height:60px;rotate:270deg;" id="red-notif-binaan-2">
                                        @endif
                                    </div>
                                    <div class="d-flex justify-content-around mt-3">
                                        @if ($pertandingan->detailPointTanding?->teguran_2 == 0)
                                            <img src="{{ asset('assets') }}/img/icon/icon-onefinger.png" alt="Teguran 1" style="width:60px ; height: 60px;" id="red-notif-teguran-1">
                                        @else
                                            <img src="{{ asset('assets') }}/img/icon/icon-onefinger.png" alt="Teguran 1" style="width:60px ; height: 60px; filter: brightness(0) saturate(100%) invert(89%) sepia(87%) saturate(375%) hue-rotate(359deg) brightness(104%) contrast(104%)" id="red-notif-teguran-1">
                                        @endif
                                        
                                        @if ($pertandingan->detailPointTanding?->teguran_2 > 1 && $pertandingan->detailPointTanding?->teguran_2 < 3)
                                            <img src="{{ asset('assets') }}/img/icon/icon-twofinger.png" alt="Teguran 2" style="width:60px ; height: 60px; filter: brightness(0) saturate(100%) invert(89%) sepia(87%) saturate(375%) hue-rotate(359deg) brightness(104%) contrast(104%)" id="red-notif-teguran-2">
                                        @elseif ($pertandingan->detailPointTanding?->teguran_2 > 0 && $pertandingan->detailPointTanding?->teguran_2 < 2)
                                            <img src="{{ asset('assets') }}/img/icon/icon-twofinger.png" alt="Binaan 1" style="width:60px;height:60px;" id="red-notif-binaan-2">
                                        @elseif ($pertandingan->detailPointTanding?->teguran_2 == 0)
                                            <img src="{{ asset('assets') }}/img/icon/icon-twofinger.png" alt="Teguran 2" style="width:60px ; height: 60px;" id="red-notif-teguran-2">
                                        @else 
                                            <img src="{{ asset('assets') }}/img/icon/icon-twofinger.png" alt="Teguran 2" style="width:60px ; height: 60px; filter: brightness(0) saturate(100%) invert(89%) sepia(87%) saturate(375%) hue-rotate(359deg) brightness(104%) contrast(104%)" id="red-notif-teguran-2">
                                        @endif
                                    </div>
                                    <div class="d-flex justify-content-around mt-3">
                                        @if ($pertandingan->detailPointTanding?->peringatan_2 > 0 && $pertandingan->detailPointTanding?->peringatan_2 < 2)
                                            <img src="{{ asset('assets') }}/img/icon/icon-wasit.png" alt="Peringatan 1" style="width:60px ; height: 60px; filter: brightness(0) saturate(100%) invert(89%) sepia(87%) saturate(375%) hue-rotate(359deg) brightness(104%) contrast(104%)" id="red-notif-peringatan-1">
                                        @elseif ($pertandingan->detailPointTanding?->peringatan_2 > 2 && $pertandingan->detailPointTanding?->peringatan_2 > 1)
                                            <img src="{{ asset('assets') }}/img/icon/icon-wasit.png" alt="Peringatan 1" style="width:60px ; height: 60px; filter: brightness(0) saturate(100%) invert(89%) sepia(87%) saturate(375%) hue-rotate(359deg) brightness(104%) contrast(104%)" id="red-notif-peringatan-1">
                                        @elseif($pertandingan->detailPointTanding?->peringatan_2 == 0)
                                            <img src="{{ asset('assets') }}/img/icon/icon-wasit.png" alt="Peringatan 1" style="width:60px ; height: 60px;" id="red-notif-peringatan-1">
                                        @else
                                            <img src="{{ asset('assets') }}/img/icon/icon-wasit.png" alt="Peringatan 1" style="width:60px ; height: 60px; filter: brightness(0) saturate(100%) invert(89%) sepia(87%) saturate(375%) hue-rotate(359deg) brightness(104%) contrast(104%)" id="red-notif-peringatan-1">
                                        @endif

                                        @if ($pertandingan->detailPointTanding?->peringatan_2 > 1 && $pertandingan->detailPointTanding?->peringatan_2 < 3)
                                            <img src="{{ asset('assets') }}/img/icon/icon-wasit.png" alt="Peringatan 2" style="width:60px ; height: 60px; filter: brightness(0) saturate(100%) invert(89%) sepia(87%) saturate(375%) hue-rotate(359deg) brightness(104%) contrast(104%)" id="red-notif-peringatan-2">
                                        @elseif ($pertandingan->detailPointTanding?->peringatan_2 > 2)
                                            <img src="{{ asset('assets') }}/img/icon/icon-wasit.png" alt="Peringatan 2" style="width:60px ; height: 60px; filter: brightness(0) saturate(100%) invert(89%) sepia(87%) saturate(375%) hue-rotate(359deg) brightness(104%) contrast(104%)" id="red-notif-peringatan-2">
                                        @elseif($pertandingan->detailPointTanding?->peringatan_2 == 0)
                                            <img src="{{ asset('assets') }}/img/icon/icon-wasit.png" alt="Peringatan 2" style="width:60px ; height: 60px;" id="red-notif-peringatan-2">
                                        @else
                                            <img src="{{ asset('assets') }}/img/icon/icon-wasit.png" alt="Peringatan 2" style="width:60px ; height: 60px;" id="red-notif-peringatan-2">
                                        @endif 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end score --}}

                {{-- juri & table bawah --}}
                <div class="row">
                    <div class="col-6 pt-3" style="padding-right: 40px">
                        <div class="d-flex justify-content-end">
                            <div class="kiri">
                                <div class="bg-light mx-2 rounded" id="blue-notif-juri-1-pukul"><p class="px-4 py-2 m-0">Juri 1</p></div>
                                <div class="mt-4 border-dark bg-light mx-2 rounded" id="blue-notif-juri-1-tendang"><p class="px-4 py-2 m-0">Juri 1</p></div>
                            </div>
                            <div class="kiri">
                                <div class="bg-light mx-2 rounded" id="blue-notif-juri-2-pukul"><p class="px-4 py-2 m-0">Juri 2</p></div>
                                <div class="mt-4 border-dark bg-light mx-2 rounded" id="blue-notif-juri-2-tendang"><p class="px-4 py-2 m-0">Juri 2</p></div>
                            </div>
                            <div class="kiri">
                                <div class="bg-light mx-2 rounded" id="blue-notif-juri-3-pukul"><p class="px-4 py-2 m-0">Juri 3</p></div>
                                <div class="mt-4 border-dark bg-light mx-2 rounded" id="blue-notif-juri-3-tendang"><p class="px-4 py-2 m-0">Juri 3</p></div>
                            </div>
                            <div class="d-flex flex-column">
                                <img class="img" src="{{ asset('assets') }}/img/icon/icon-pkl.png" alt="pukul icon" style="width: 60px; height: 60px">
                                <img class="img" src="{{ asset('assets') }}/img/icon/icon-tdg.png" alt="tendang icon" style="width: 50px; height: 50px; transform: scaleX(-1);">
                            </div>
                        </div>
                    </div>
                    <div class="col-6 pt-3" style="padding-left: 40px">
                        <div class="d-flex justify-content-start">
                            <div class="d-flex flex-column">
                                <img class="img" src="{{ asset('assets') }}/img/icon/icon-pkl.png" alt="pukul icon" style="width: 60px; height: 60px;  transform: scaleX(-1);">
                                <img class="img" src="{{ asset('assets') }}/img/icon/icon-tdg.png" alt="tendang icon" style="width: 50px; height: 50px">
                            </div>
                            <div class="kanan">
                                <div class="bg-light mx-2 rounded" id="red-notif-juri-1-pukul"><p class="px-4 py-2 m-0">Juri 1</p></div>
                                <div class="mt-4 border-dark bg-light mx-2 rounded" id="red-notif-juri-1-tendang"><p class="px-4 py-2 m-0">Juri 1</p></div>
                            </div>
                            <div class="kanan">
                                <div class="bg-light mx-2 rounded" id="red-notif-juri-2-pukul"><p class="px-4 py-2 m-0">Juri 2</p></div>
                                <div class="mt-4 border-dark bg-light mx-2 rounded" id="red-notif-juri-2-tendang"><p class="px-4 py-2 m-0">Juri 2</p></div>
                            </div>
                            <div class="kanan">
                                <div class="bg-light mx-2 rounded" id="red-notif-juri-3-pukul"><p class="px-4 py-2 m-0">Juri 3</p></div>
                                <div class="mt-4 border-dark bg-light mx-2 rounded" id="red-notif-juri-3-tendang"><p class="px-4 py-2 m-0">Juri 3</p></div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-4">
                        {{-- [DINAMIS] Bagian Tabel Bawah --}}
                        <div class="d-flex flex-column mx-1">
                            <div class="border border-info bg-info rounded-top py-2 px-1" style="width: 110px"><p class="m-0 text-center text-light">Sudut</p></div>
                            <div class="border border-primary bg-primary py-2 px-1" style="width: 110px"><p class="m-0 text-center text-light">Biru</p></div>
                            <div class="border border-danger bg-danger rounded-bottom py-2 px-1" style="width: 110px"><p class="m-0 text-center text-light">Merah</p></div>
                        </div>
                        <div class="d-flex flex-column mx-1">
                            <div class="border border-info bg-info rounded-top py-2 px-1" style="width: 110px"><p class="m-0 text-center text-light">Peringatan 3</p></div>
                            <div class="border border-primary bg-primary py-2 px-1" style="width: 110px"><p class="m-0 text-center text-light" id="blue-notif-peringatan-3">
                                @if ($pertandingan->detailPointTanding?->peringatan_1 > 2 && $pertandingan->detailPointTanding?->peringatan_1 < 4)
                                    1
                                @elseif($pertandingan->detailPointTanding?->peringatan_1 == 0)
                                    0
                                @else
                                    0
                                @endif     
                            </p></div>
                            <div class="border border-danger bg-danger rounded-bottom py-2 px-1" style="width: 110px"><p class="m-0 text-center text-light" id="red-notif-peringatan-3">
                                @if ($pertandingan->detailPointTanding?->peringatan_2 > 2 && $pertandingan->detailPointTanding?->peringatan_2 < 4)
                                    1
                                @elseif($pertandingan->detailPointTanding?->peringatan_2 == 0)
                                    0
                                @else
                                    0
                                @endif        
                            </p></div>
                        </div>
                        <div class="d-flex flex-column mx-1">
                            <div class="border border-info bg-info rounded-top py-2 px-1" style="width: 110px"><p class="m-0 text-center text-light">Peringatan 2</p></div>
                            <div class="border border-primary bg-primary py-2 px-1" style="width: 110px"><p class="m-0 text-center text-light" id="blue-notif-peringatan-2-table">
                                @if ($pertandingan->detailPointTanding?->peringatan_1 > 1 && $pertandingan->detailPointTanding?->peringatan_1 < 3)
                                    1
                                @elseif ($pertandingan->detailPointTanding?->peringatan_1 > 2)
                                    1
                                @elseif($pertandingan->detailPointTanding?->peringatan_1 == 0)
                                    0
                                @else
                                    0
                                @endif    
                            </p></div>
                            <div class="border border-danger bg-danger rounded-bottom py-2 px-1" style="width: 110px"><p class="m-0 text-center text-light" id="red-notif-peringatan-2-table">
                                @if ($pertandingan->detailPointTanding?->peringatan_2 > 1 && $pertandingan->detailPointTanding?->peringatan_2 < 3)
                                    1
                                @elseif ($pertandingan->detailPointTanding?->peringatan_2 > 2)
                                    1
                                @elseif($pertandingan->detailPointTanding?->peringatan_2 == 0)
                                    0
                                @else
                                    0
                                @endif    
                            </p></div>
                        </div>
                        <div class="d-flex flex-column mx-1">
                            <div class="border border-info bg-info rounded-top py-2 px-1" style="width: 110px"><p class="m-0 text-center text-light">Peringatan 1</p></div>
                            <div class="border border-primary bg-primary py-2 px-1" style="width: 110px"><p class="m-0 text-center text-light" id="blue-notif-peringatan-1-table">
                                @if ($pertandingan->detailPointTanding?->peringatan_1 > 0 && $pertandingan->detailPointTanding?->peringatan_1 < 2)
                                    1
                                @elseif ($pertandingan->detailPointTanding?->peringatan_1 > 2 && $pertandingan->detailPointTanding?->peringatan_1 > 1)
                                    1
                                @elseif($pertandingan->detailPointTanding?->peringatan_1 == 0)
                                    0
                                @else
                                    1
                                @endif
                            </p></div>
                            <div class="border border-danger bg-danger rounded-bottom py-2 px-1" style="width: 110px"><p class="m-0 text-center text-light" id="red-notif-peringatan-1-table">
                                @if ($pertandingan->detailPointTanding?->peringatan_2 > 0 && $pertandingan->detailPointTanding?->peringatan_2 < 2)
                                    1
                                @elseif ($pertandingan->detailPointTanding?->peringatan_2 > 2 && $pertandingan->detailPointTanding?->peringatan_2 > 1)
                                    1
                                @elseif($pertandingan->detailPointTanding?->peringatan_2 == 0)
                                    0
                                @else
                                    1
                                @endif    
                            </p></div>
                        </div>
                        <div class="d-flex flex-column mx-1">
                            <div class="border border-info bg-info rounded-top py-2 px-1" style="width: 110px"><p class="m-0 text-center text-light">Teguran 2</p></div>
                            <div class="border border-primary bg-primary py-2 px-1" style="width: 110px"><p class="m-0 text-center text-light" id="blue-notif-teguran-2-table">
                                @if ($pertandingan->detailPointTanding?->teguran_1 > 1 && $pertandingan->detailPointTanding?->teguran_1 < 3)
                                    1
                                @elseif ($pertandingan->detailPointTanding?->teguran_1 > 0 && $pertandingan->detailPointTanding?->teguran_1 < 2)
                                    0
                                @elseif ($pertandingan->detailPointTanding?->teguran_1 == 0)
                                    0
                                @else 
                                    1
                                @endif    
                            </p></div>
                            <div class="border border-danger bg-danger rounded-bottom py-2 px-1" style="width: 110px"><p class="m-0 text-center text-light" id="red-notif-teguran-2-table">
                                @if ($pertandingan->detailPointTanding?->teguran_2 > 1 && $pertandingan->detailPointTanding?->teguran_2 < 3)
                                    1
                                @elseif ($pertandingan->detailPointTanding?->teguran_2 > 0 && $pertandingan->detailPointTanding?->teguran_2 < 2)
                                    0
                                @elseif ($pertandingan->detailPointTanding?->teguran_2 == 0)
                                    0
                                @else 
                                    1
                                @endif    
                            </p></div>
                        </div>
                        <div class="d-flex flex-column mx-1">
                            <div class="border border-info bg-info rounded-top py-2 px-1" style="width: 110px"><p class="m-0 text-center text-light">Teguran 1</p></div>
                            <div class="border border-primary bg-primary py-2 px-1" style="width: 110px"><p class="m-0 text-center text-light" id="blue-notif-teguran-1-table">
                                @if ($pertandingan->detailPointTanding?->teguran_1 == 0)
                                    0
                                @else
                                    1
                                @endif
                            </p></div>
                            <div class="border border-danger bg-danger rounded-bottom py-2 px-1" style="width: 110px"><p class="m-0 text-center text-light" id="red-notif-teguran-1-table">
                                @if ($pertandingan->detailPointTanding?->teguran_2 == 0)
                                    0
                                @else
                                    1
                                @endif
                            </p></div>
                        </div>
                        <div class="d-flex flex-column mx-1">
                            <div class="border border-info bg-info rounded-top py-2 px-2"><p class="m-0 text-center text-light">Jatuhan</p></div>
                            <div class="border border-primary bg-primary py-2 px-1" style="width: 110px"><p class="m-0 text-center text-light" id="blue-notif-jatuhan-table">{{ $pertandingan->detailPointTanding?->fall_point_1 ?? 0 }}</p></div>
                            <div class="border border-danger bg-danger rounded-bottom py-2 px-1" style="width: 110px"><p class="m-0 text-center text-light" id="red-notif-jatuhan-table">{{ $pertandingan->detailPointTanding?->fall_point_2 ?? 0 }}</p></div>
                        </div>
                        <div class="d-flex flex-column mx-1">
                            <div class="border border-info bg-info rounded-top py-2 px-1" style="width: 110px"><p class="m-0 text-center text-light">Tendangan</p></div>
                            <div class="border border-primary bg-primary py-2 px-1" style="width: 110px"><p class="m-0 text-center text-light" id="blue-notif-tendangan-table">{{ $pertandingan->detailPointTanding?->kick_point_1 / 2 ?? 0 }}</p></div>
                            <div class="border border-danger bg-danger rounded-bottom py-2 px-1" style="width: 110px"><p class="m-0 text-center text-light" id="red-notif-tendangan-table">{{ $pertandingan->detailPointTanding?->kick_point_2 / 2 ?? 0 }}</p></div>
                        </div>
                        <div class="d-flex flex-column mx-1">
                            <div class="border border-info bg-info rounded-top py-2 px-1" style="width: 110px"><p class="m-0 text-center text-light">Pukulan</p></div>
                            <div class="border border-primary bg-primary py-2 px-1" style="width: 110px"><p class="m-0 text-center text-light" id="blue-notif-pukulan-table">{{ $pertandingan->detailPointTanding?->punch_point_1 ?? 0 }}</p></div>
                            <div class="border border-danger bg-danger rounded-bottom py-2 px-1" style="width: 110px"><p class="m-0 text-center text-light" id="red-notif-pukulan-table">{{ $pertandingan->detailPointTanding?->punch_point_2 ?? 0 }}</p></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="d-flex justify-content-center mt-3 mb-5">
            <a href="{{ url('scoring/operator/' . Auth::user()->id) }}" class="btn btn-success btn-lg shadow-sm">
                <i class="fas fa-user-cog me-2"></i>Back to Operator
            </a>
        </div>
        @else
            {{-- Ini akan ditampilkan jika controller tidak menemukan pertandingan aktif --}}
            <div class="text-center p-5">
                <h3>Tidak Ada Pertandingan Aktif</h3>
                <p>Saat ini tidak ada pertandingan yang siap untuk dinilai.</p>
            </div>
        @endif
    </div>

    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.11.2/dist/echo.iife.js"></script>

    {{-- Memuat script Anda yang sudah ada --}}
    <script src="{{ asset('assets') }}/js/listenEvents.js"></script> 

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        // Jalankan listener event skor dari file listenEvents.js

        const pertandinganIdInput = document.getElementById('pertandingan_id');

        if (pertandinganIdInput && pertandinganIdInput.value) {
            const pertandinganId = pertandinganIdInput.value;
            
            // Memanggil fungsi dari listenEvents.js (untuk skor)
            initializeListener(
                "{{ config('broadcasting.connections.pusher.key') }}",    // CARA YANG LEBIH BAIK
                "{{ config('broadcasting.connections.pusher.options.cluster') }}", // CARA YANG LEBIH BAIK
                pertandinganId
            );

                const timerElement = document.getElementById("timer");
                let timerInterval = null;
                let localCurrentSeconds = 0;

                function updateTimerDisplay(time) {
                    if (!timerElement) return; // Tambah pengaman jika elemen timer tidak ada
                    const minutes = Math.floor(time / 60);
                    const seconds = time % 60;
                    timerElement.textContent = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
                }

                function startLocalCountdown() {
                    if (timerInterval) clearInterval(timerInterval);
                    timerInterval = setInterval(() => {
                        if (localCurrentSeconds > 0) {
                            localCurrentSeconds--;
                            updateTimerDisplay(localCurrentSeconds);
                        } else {
                            clearInterval(timerInterval);
                            timerInterval = null;
                        }
                    }, 1000);
                }

                function stopLocalCountdown() {
                    if (timerInterval) clearInterval(timerInterval);
                    timerInterval = null;
                }

                // 1. Inisialisasi Laravel Echo
                 const echo = new window.Echo({
                    broadcaster: 'pusher',
                    key: "{{ config('broadcasting.connections.pusher.key') }}",
                    cluster: "{{ config('broadcasting.connections.pusher.options.cluster') }}",
                    forceTLS: true
                });

                // 2. Dengarkan event di channel privat
                echo.private(`pertandingan.${pertandinganId}`)
                    .listen('TimerUpdated', (e) => {
                        console.log('Event Timer diterima:', e);
                        localCurrentSeconds = e.currentTime;
                        updateTimerDisplay(localCurrentSeconds);
                        if (e.state === 'playing') { startLocalCountdown(); }
                        else if (e.state === 'paused') { stopLocalCountdown(); }
                        else if (e.state === 'reset') {
                            stopLocalCountdown();
                            localCurrentSeconds = e.total_duration;
                            updateTimerDisplay(localCurrentSeconds);
                        }
                    });

                echo.private(`pertandingan.${pertandinganId}`)
                    .listen('RoundUpdated', (e) => {
                        console.log('Event RoundUpdated diterima:', e);
                        
                        const round1Box = document.getElementById('round-box-1');
                        const round2Box = document.getElementById('round-box-2');
                        const round3Box = document.getElementById('round-box-3');
                        
                        if(round1Box) round1Box.classList.replace('bg-warning', 'bg-light');
                        if(round2Box) round2Box.classList.replace('bg-warning', 'bg-light');
                        if(round3Box) round3Box.classList.replace('bg-warning', 'bg-light');

                        if (e.newRoundNumber >= 1 && round1Box) {
                            round1Box.classList.replace('bg-light', 'bg-warning');
                        }
                        if (e.newRoundNumber >= 2 && round2Box) {
                            round2Box.classList.replace('bg-light', 'bg-warning');
                        }
                        if (e.newRoundNumber >= 3 && round3Box) {
                            round3Box.classList.replace('bg-light', 'bg-warning');
                        }
                    });
            } else {
                console.warn("Tidak ada pertandingan aktif untuk didengarkan event-nya.");
            }
        });
    </script>
    
@endsection