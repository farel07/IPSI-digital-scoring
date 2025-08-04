{{ $user_match->match }}
{{ $user_match->match->playerMatches }}

@extends('main.main')
@section('content')
    <div class="container">
        <div class="container mt-2 mb-2 rounded " style="background-color: rgb(216, 216, 216)">
            <div class="container">
                {{-- title --}}
                <div class="d-flex justify-content-between">
                    <div class="m-2">
                        <p class="text-start m-0">{{ $user_match->match->playerMatches->where('side', 'blue')->first()?->player->contingent ?? '-' }}</p>
                        <h5 class="text-primary">{{ $user_match->match->playerMatches->where('side', 'blue')->first()?->player->name ?? '-' }}</h5>
                    </div>
                    <div class="m-2">
                        {{-- <p class="m-0 fw-bold">PARTAI 2</p> --}}
                        <p class="m-0 fw-bold">{{ $user_match->match->name }}</p>
                        <p class="m-0 fw-bold">{{ $user_match->match->arena->arena_name }}</p>
                    </div>
                    <div class="mt-2 me-2">
                        <p class="text-end m-0">{{ $user_match->match->playerMatches->where('side', 'red')->first()?->player->contingent ?? '-' }}</p>
                        <h5 class="text-end text-danger">{{ $user_match->match->playerMatches->where('side', 'red')->first()?->player->name ?? '-' }}</h5>
                    </div>
                </div>
                {{-- end title --}}

                {{-- score --}}
                <div class="row justify-content-between">

                    {{-- team blue --}}
                    <div class="col-5">
                        <div class="row justify-content-start">
                            <div class="col-3 pe-0">
                                <div class="p-3 border bg-primary text-light text-center"
                                    style="font-size:14px; border-radius: 10px; width: 90px">BINA
                                </div>
                            </div>
                            <div class="col-3 ps-0 pe-0" style="width: 98px">
                                <div class="py-3 border bg-primary text-light text-center"
                                    style="font-size:14px; border-radius: 10px; width: 90px">
                                    TEGURAN
                                </div>
                            </div>
                            <div class="col-3 ps-1 p-0" style="width: 98px">
                                <div class="py-3 border bg-primary text-light text-center"
                                    style="font-size:14px;border-radius: 10px; width: 90px">
                                    PERINGATAN
                                </div>
                            </div>
                            <div class="col-3 ps-2 p-0">
                                <div class="p-3 border bg-primary text-light text-center"
                                    style="font-size:14px; border-radius: 10px; width: 90px">
                                    JATUH
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-3 pe-0">
                                <div class="p-3 border bg-light text-dark text-center"
                                    style="font-size:14px; border-radius: 10px; width: 90px" id="point-bina-blue-1">bina
                                </div>
                            </div>
                            <div class="col-3 ps-0 pe-0" style="width: 98px">
                                <div class="py-3 border bg-light text-dark text-center"
                                    style="font-size:14px; border-radius: 10px; width: 90px" id="point-teguran-blue-1">
                                    teguran
                                </div>
                            </div>
                            <div class="col-3 ps-1 p-0" style="width: 98px">
                                <div class="py-3 border bg-light text-dark text-center"
                                    style="font-size:14px;border-radius: 10px; width: 90px" id="point-peringatan-blue-1">
                                    peringatan
                                </div>
                            </div>
                            <div class="col-3 ps-2 p-0">
                                <div class="p-3 border bg-light text-dark text-center"
                                    style="font-size:14px; border-radius: 10px; width: 90px" id="point-jatuh-blue-1">
                                    jatuh
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-3 pe-0">
                                <div class="p-3 border bg-light text-dark text-center"
                                    style="font-size:14px; border-radius: 10px; width: 90px" id="point-bina-blue-2">bina 2
                                </div>
                            </div>
                            <div class="col-3 ps-0 pe-0" style="width: 98px">
                                <div class="py-3 border bg-light text-dark text-center"
                                    style="font-size:14px; border-radius: 10px; width: 90px" id="point-teguran-blue-2">
                                    teguran 2
                                </div>
                            </div>
                            <div class="col-3 ps-1 p-0" style="width: 98px">
                                <div class="py-3 border bg-light text-dark text-center"
                                    style="font-size:14px;border-radius: 10px; width: 90px" id="point-peringatan-blue-2">
                                    peringatan 2
                                </div>
                            </div>
                            <div class="col-3 ps-2 p-0">
                                <div class="p-3 border bg-light text-dark text-center"
                                    style="font-size:14px; border-radius: 10px; width: 90px" id="point-jatuh-blue-2">
                                    jatuh 2
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-3 pe-0">
                                <div class="p-3 border bg-light text-dark text-center"
                                    style="font-size:14px; border-radius: 10px; width: 90px" id="point-bina-blue-3">bina 3
                                </div>
                            </div>
                            <div class="col-3 ps-0 pe-0" style="width: 98px">
                                <div class="py-3 border bg-light text-dark text-center"
                                    style="font-size:14px; border-radius: 10px; width: 90px" id="point-teguran-blue-3">
                                    teguran 3
                                </div>
                            </div>
                            <div class="col-3 ps-1 p-0" style="width: 98px">
                                <div class="py-3 border bg-light text-dark text-center"
                                    style="font-size:14px;border-radius: 10px; width: 90px" id="point-peringatan-blue-3">
                                    peringatan 3
                                </div>
                            </div>
                            <div class="col-3 ps-2 p-0">
                                <div class="p-3 border bg-light text-dark text-center"
                                    style="font-size:14px; border-radius: 10px; width: 90px" id="point-jatuh-blue-3">
                                    jatuh 3
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-between me-4">
                            <div class="col-6">
                                <button id="btn_jatuh_blue" class="mt-3 btn btn-primary w-100" onclick="kirimJatuh('blue')" type="button"
                                    style="border-radius: 10px; height:100px" value="1">
                                    JATUH</button>
                            </div>
                            <div class="col-6">
                                <button id="btn_binaan_blue" class="mt-3 btn btn-primary w-100" onclick="kirimBinaan('blue')" value="1" type="button"
                                    style="border-radius: 10px; height:100px">
                                    BINA</button>
                            </div>
                            <div class="col-6">
                                <button id="btn_teguran_blue" class="mt-3 btn btn-primary w-100" onclick="kirimTeguran('blue')" value="1" type="button"
                                    style="border-radius: 10px; height:100px">
                                    TEGURAN</button>
                            </div>
                            <div class="col-6">
                                <button id="btn_peringatan_blue" class="mt-3 btn btn-primary w-100" onclick="kirimPeringatan('blue')" value="1" type="button"
                                    style="border-radius: 10px; height:100px">
                                    PERINGATAN</button>
                            </div>
                            <div class="col-6">
                                <button class="mt-3 btn btn-primary w-100 h-75" type="button" id="btn_hapus_jatuhan_blue"
                                    style="border-radius: 10px; background-color:rgb(190, 0, 0)" disabled onclick="kirimHapus('jatuhan', 'blue')">HAPUS
                                    JATUHAN</button>
                            </div>
                            <div class="col-6">
                                <button class="mt-3 btn btn-primary w-100 h-75" type="button" id="btn_hapus_pelanggaran_blue"
                                    style="border-radius: 10px; background-color:rgb(190, 0, 0)" disabled onclick="kirimHapus('pelanggaran', 'blue')" value="0">HAPUS
                                    PELANGGARAN</button>
                            </div>
                        </div>
                    </div>

                    {{-- end team blue --}}

                    {{-- scoring --}}
                    <div class="col-2">
                        <div class="p-3 border bg-success text-light text-center"
                            style="border-radius: 10px; height:55px">
                            SCORE</div>

                        @if($user_match->match->round == 1)
                            <div class="p-3 mt-2 border bg-warning text-center" style="border-radius: 10px; height:55px">I</div>
                        @else
                            <div class="p-3 mt-2 border bg-light text-center" style="border-radius: 10px; height:55px">I</div>
                        @endif

                        @if($user_match->match->round == 2)
                            <div class="p-3 mt-2 border bg-warning text-center" style="border-radius: 10px; height:55px">II</div>
                        @else
                            <div class="p-3 mt-2 border bg-light text-center" style="border-radius: 10px; height:55px">II</div>
                        @endif

                        @if($user_match->match->round == 3)
                            <div class="p-3 mt-2 border bg-warning text-center" style="border-radius: 10px; height:55px">III</div>
                        @else
                            <div class="p-3 mt-2 border bg-light text-center" style="border-radius: 10px; height:55px">III</div>
                        @endif
                        <div class="mt-5">
                            {{-- request validation --}}
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-warning text-light" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                REQUEST VALIDATION
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header justify-content-center">
                                            <h5 class="modal-title text-center" id="exampleModalLabel">PILIH VALIDASI</h5>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="btn btn-light border w-100">
                                                        VALIDASI JATUHAN
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="btn btn-light border w-100">
                                                        VALIDASI PELANGGARAN
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-around" style="margin-top: 50px">
                                                <div class="d-flex flex-column">
                                                    <p class="text-center mb-2">Juri 1</p>
                                                    <div class="border bg-light p-2 rounded" style="width: 100px">
                                                        <p class="text-center m-0">Juri 1</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <p class="text-center mb-2">Juri 2</p>
                                                    <div class="border bg-light p-2 rounded" style="width: 100px">
                                                        <p class="text-center m-0">Juri 2</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <p class="text-center mb-2">Juri 3</p>
                                                    <div class="border bg-light p-2 rounded" style="width: 100px">
                                                        <p class="text-center m-0">Juri 3</p>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-success">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- end of request validation --}}
                            <div class="btn btn-success mt-2">TENTUKAN PEMENANG</div>
                            <div class="border bg-dark p-2 mt-2 rounded-top">
                                <p class="m-0 text-center text-light">
                                    LAST VALIDATION
                                </p>
                            </div>
                            <div class="border bg-light p-2 mb-2 rounded-bottom">
                                <p class="m-0 text-center">
                                    NO RESULT
                                </p>
                            </div>
                        </div>
                    </div>
                    {{-- end scoring --}}

                    {{-- team red --}}
                    <div class="col-5">
                        <div class="row justify-content-end">
                            <div class="col-3 pe-0">
                                <div class="p-3 border bg-danger text-light text-center"
                                    style="font-size:14px; border-radius: 10px; width: 90px">BINA
                                </div>
                            </div>
                            <div class="col-3 ps-0 pe-0" style="width: 98px">
                                <div class="py-3 border bg-danger text-light text-center"
                                    style="font-size:14px; border-radius: 10px; width: 90px">
                                    TEGURAN
                                </div>
                            </div>
                            <div class="col-3 ps-1 p-0" style="width: 98px">
                                <div class="py-3 border bg-danger text-light text-center"
                                    style="font-size:14px;border-radius: 10px; width: 90px">
                                    PERINGATAN
                                </div>
                            </div>
                            <div class="col-3 ps-2 p-0">
                                <div class="p-3 border bg-danger text-light text-center"
                                    style="font-size:14px; border-radius: 10px; width: 90px">
                                    JATUH
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end mt-2">
                            <div class="col-3 pe-0">
                                <div class="p-3 border bg-light text-dark text-center"
                                    style="font-size:14px; border-radius: 10px; width: 90px" id="point-bina-red-1">bina
                                </div>
                            </div>
                            <div class="col-3 ps-0 pe-0" style="width: 98px">
                                <div class="py-3 border bg-light text-dark text-center"
                                    style="font-size:14px; border-radius: 10px; width: 90px" id="point-teguran-red-1">
                                    teguran
                                </div>
                            </div>
                            <div class="col-3 ps-1 p-0" style="width: 98px">
                                <div class="py-3 border bg-light text-dark text-center"
                                    style="font-size:14px;border-radius: 10px; width: 90px" id="point-peringatan-red-1">
                                    peringatan
                                </div>
                            </div>
                            <div class="col-3 ps-2 p-0">
                                <div class="p-3 border bg-light text-dark text-center"
                                    style="font-size:14px; border-radius: 10px; width: 90px" id="point-jatuh-red-1">
                                    jatuh
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end mt-2">
                            <div class="col-3 pe-0">
                                <div class="p-3 border bg-light text-dark text-center"
                                    style="font-size:14px; border-radius: 10px; width: 90px" id="point-bina-red-2">
                                    bina 2
                                </div>
                            </div>
                            <div class="col-3 ps-0 pe-0" style="width: 98px">
                                <div class="py-3 border bg-light text-dark text-center"
                                    style="font-size:14px; border-radius: 10px; width: 90px" id="point-teguran-red-2">
                                    -
                                </div>
                            </div>
                            <div class="col-3 ps-1 p-0" style="width: 98px">
                                <div class="py-3 border bg-light text-dark text-center"
                                    style="font-size:14px;border-radius: 10px; width: 90px" id="point-peringatan-red-2">
                                    -
                                </div>
                            </div>
                            <div class="col-3 ps-2 p-0">
                                <div class="p-3 border bg-light text-dark text-center"
                                    style="font-size:14px; border-radius: 10px; width: 90px" id="point-jatuh-red-2">
                                    -
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end mt-2">
                            <div class="col-3 pe-0">
                                <div class="p-3 border bg-light text-dark text-center"
                                    style="font-size:14px; border-radius: 10px; width: 90px" id="point-bina-red-3">-
                                </div>
                            </div>
                            <div class="col-3 ps-0 pe-0" style="width: 98px">
                                <div class="py-3 border bg-light text-dark text-center"
                                    style="font-size:14px; border-radius: 10px; width: 90px" id="point-teguran-red-3">
                                    -
                                </div>
                            </div>
                            <div class="col-3 ps-1 p-0" style="width: 98px">
                                <div class="py-3 border bg-light text-dark text-center"
                                    style="font-size:14px;border-radius: 10px; width: 90px" id="point-peringatan-red-3">
                                    -
                                </div>
                            </div>
                            <div class="col-3 ps-2 p-0">
                                <div class="p-3 border bg-light text-dark text-center"
                                    style="font-size:14px; border-radius: 10px; width: 90px" id="point-jatuh-red-3">
                                    -
                                </div>
                            </div>
                            <div class="row justify-content-between">
                                <div class="col-6 ps-3">
                                    <button id="btn_jatuh_red" class="mt-3 btn btn-danger w-100" onclick="kirimJatuh('red')" type="button"
                                    style="border-radius: 10px; height:100px" value="1">
                                    JATUH</button>
                                </div>
                                <div class="col-6 pe-3">
                                    <button class="mt-3 btn btn-danger w-100" id="btn_binaan_red" type="button"
                                        style="border-radius: 10px; height:100px" onclick="kirimBinaan('red')" value="1" type="button">
                                        BINA</button>
                                </div>
                                <div class="col-6 ps-3">
                                    <button class="mt-3 btn btn-danger w-100" id="btn_teguran_red" type="button"
                                        style="border-radius: 10px; height:100px" onclick="kirimTeguran('red')" value="1" type="button">
                                        TEGURAN</button>
                                </div>
                                <div class="col-6 pe-3">
                                    <button class="mt-3 btn btn-danger w-100" id="btn_peringatan_red" type="button"
                                        style="border-radius: 10px; height:100px" onclick="kirimPeringatan('red')" value="1" type="button">
                                        PERINGATAN</button>
                                </div>
                                <div class="col-6">
                                    <button class="mt-3 btn btn-primary w-100 h-75" type="button"
                                        style="border-radius: 10px; background-color:rgb(190, 0, 0)" id="btn_hapus_jatuhan_red" onclick="kirimHapus('jatuhan', 'red')" disabled>HAPUS
                                        JATUHAN</button>
                                </div>
                                <div class="col-6">
                                    <button class="mt-3 btn btn-primary w-100 h-75" type="button"
                                        style="border-radius: 10px; background-color:rgb(190, 0, 0)" id="btn_hapus_pelanggaran_red" onclick="kirimHapus('pelanggaran', 'red')" disabled>HAPUS
                                        PELANGGARAN</button>
                                </div>
                            </div>
                        </div>
                        {{-- end team red --}}
                    </div>
                    {{-- end score --}}
                </div>
            </div>
        </div>
    @endsection
