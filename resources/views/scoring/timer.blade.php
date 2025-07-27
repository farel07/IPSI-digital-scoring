@extends('main.main')

@section('content')
    <div class="container mt-2 mb-2 rounded pb-4" style="background-color: rgb(216, 216, 216)">
        <div class="container">
            {{-- title --}}
            <div class="d-flex justify-content-between">
                <div class="m-2">
                    <p class="text-start m-0">PARTAI 0</p>
                </div>
                <div class="m-2">
                    <p class="m-0 fw-bold">ARENA 1</p>
                </div>
                <div class="mt-2 me-2">
                    <p class="text-end m-0">ROUND 0</p>
                </div>
            </div>
            {{-- end title --}}
            {{-- status --}}
            <div class="row">
                <div class="col-4">
                    <div class="p-3 border bg-light text-dark text-center" style="border-radius: 10px">
                        <h5 class="text-danger">ATHLETE</h5>
                        <p class="m-auto">CONTINGENT</p>
                    </div>
                </div>
                <div class="col-4">
                    <div class="p-3 border bg-light text-dark text-center" style="border-radius: 10px">
                        <h5 class="text-primary">ATHLETE</h5>
                        <p class="m-auto">CONTINGENT</p>
                    </div>
                </div>
                <div class="col-2">
                    <div class="p-3 border bg-light text-dark text-center" style="border-radius: 10px">
                        <h5 class="text-bold">MALE</h5>
                        <p class="m-auto">Kids</p>
                    </div>
                </div>
                <div class="col-2">
                    <div class="p-3 border bg-light text-dark text-center" style="border-radius: 10px">
                        <h5 class="text-bold">1/4</h5>
                        <p class="m-auto">Final</p>
                    </div>
                </div>
            </div>
            {{-- end of status --}}
            {{-- Timer --}}
            <div class="row mt-3">
                <div class="col-12">
                    <div class="p-3 border bg-light text-dark text-center" style="border-radius: 10px">
                        <span class="text-bold libertinus-font" style="font-size: 100px" id="timer">00:00</span>
                    </div>
                </div>
            </div>
            {{-- end of Timer --}}

            {{-- button timer --}}
            <div class="row mt-3">
                <div class="col-4">
                    <div class="btn w-100 pt-4" id="startBtn" style="height: 100px; background-color:rgb(1, 196, 1);">
                        <span class="text-light fs-2">
                            START
                        </span>
                    </div>
                </div>
                <div class="col-4">
                    <div class="btn w-100 pt-4" id="pauseBtn" style="height: 100px; background-color:rgb(194, 0, 0);">
                        <span class="text-light fs-2">
                            STOP
                        </span>
                    </div>
                </div>
                <div class="col-4">
                    <div class="btn w-100 pt-4" id="resetBtn" style="height: 100px; background-color:rgb(255, 136, 0)">
                        <span class="text-light fs-2">
                            RESET
                        </span>
                    </div>
                </div>
            </div>
            {{-- end of button timer --}}

            {{-- round --}}
            <div class="row mt-3">
                <div class="col-4">
                    <div class="btn btn-primary w-100 pt-4" style="height: 100px;">
                        <span class="text-light fs-2">
                            ROUND 1
                        </span>
                    </div>
                </div>
                <div class="col-4">
                    <div class="btn btn-primary w-100 pt-4" style="height: 100px">
                        <span class="text-light fs-2">
                            ROUND 2
                        </span>
                    </div>
                </div>
                <div class="col-4">
                    <div class="btn btn-primary w-100 pt-4" style="height: 100px; ">
                        <span class="text-light fs-2">
                            ROUND 3
                        </span>
                    </div>
                </div>
            </div>
            {{-- end of round --}}
        </div>
    </div>
@endsection
