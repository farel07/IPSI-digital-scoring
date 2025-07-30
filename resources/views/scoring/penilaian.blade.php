
@extends('main.main')

@section('content')
    <div class="container px-0 mt-2 mb-2 rounded pb-4" style="background-color: rgb(216, 216, 216)">
        {{-- navbar --}}
        <div class="border rounded-top w-100" style="background-color: blueviolet; ">
            <div class="container">
                <p class="text-light text-center m-0 p-2" style="font-size: 20px">
                    SCORING DIGITAL {{ $user_match->match->name }}
                    {{ $user_match->match->bracket->playerCategory->classCategory->name }}
                    {{ $user_match->match->bracket->playerCategory->category }}
                    {{ $user_match->match->bracket->playerCategory->range }}
                </p>
            </div>
        </div>
        {{-- end of navbar --}}
        <div class="container">
            {{-- title --}}
            <div class="d-flex justify-content-between">
                <div class="m-2">
                    {{ $user_match }}
                    <p></p>
                    <p class="text-start m-0">CONTINGENT</p>
                    <h5 class="text-primary">ATHLETE</h5>
                </div>
                <div class="m-2">
                    <div class="px-3 pt-5 text-dark text-center" style="border-radius: 10px">
                        <span class="text-bold libertinus-font" style="font-size: 50px" id="timer">00:00</span>
                    </div>
                </div>
                <div class="mt-2 me-2">
                    <p class="text-end m-0">CONTINGENT</p>
                    <h5 class="text-end text-danger">ATHLETE</h5>
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
                                    <img src="{{ asset('assets') }}/img/icon/icon-onefinger.png" alt="lah"
                                        style="width:60px; height:60px; rotate:90deg;" id="notif-binaan">
                                    <img src="{{ asset('assets') }}/img/icon/icon-twofinger.png" alt="lah"
                                        style="width:60px;height: 60px;rotate:90deg">
                                </div>
                                <div class="d-flex justify-content-around mt-3">
                                    <img src="{{ asset('assets') }}/img/icon/icon-onefinger.png" alt="lah"
                                        style="width:60px ; height: 60px;">
                                    <img src="{{ asset('assets') }}/img/icon/icon-twofinger.png" alt="lah"
                                        style="width:60px ; height: 60px;">
                                </div>
                                <div class="d-flex justify-content-around mt-3">
                                    <img src="{{ asset('assets') }}/img/icon/icon-wasit.png" alt="lah"
                                        style="width:60px ; height: 60px;">
                                    <img src="{{ asset('assets') }}/img/icon/icon-wasit.png" alt="lah"
                                        style="width:60px ; height: 60px;">
                                </div>
                            </div>
                        </div>
                        <div class="col-7 h-100">
                            <div class="border bg-primary px-4 pb-3 rounded">
                                <p class="text-center text-light m-0" style="font-size: 150px">
                                    0
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- end team blue --}}

                {{-- scoring --}}
                <div class="col-2 justify-content-center">
                    <div class="px-2 pt-2 mx-auto mt-4 mb-4 border bg-warning rounded-circle text-light text-center"
                        style="width: 60px; height:60px; font-size: 25px">0
                    </div>
                    <div class="p-1 mt-3 border bg-light text-center" style="border-radius: 10px">I
                    </div>
                    <div class="p-1 mt-3 border bg-light text-center" style="border-radius: 10px">II</div>
                    <div class="p-1 mt-3 border bg-light text-center" style="border-radius: 10px">III</div>
                </div>
                {{-- end scoring --}}

                {{-- team red --}}
                <div class="col-5">
                    <div class="row">
                        <div class="col-7 h-100">
                            <div class="border bg-danger px-4 pb-3 rounded">
                                <p class="text-center text-light m-0" style="font-size: 150px">
                                    0
                                </p>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="d-flex flex-column">
                                <div class="d-flex justify-content-around mt-3">
                                    <img src="{{ asset('assets') }}/img/icon/icon-onefinger.png" alt="lah"
                                        style="width:60px;height:60px;rotate:270deg">
                                    <img src="{{ asset('assets') }}/img/icon/icon-twofinger.png" alt="lah"
                                        style="width:60px;height: 60px;rotate:270deg">

                                </div>
                                <div class="d-flex justify-content-around mt-3">
                                    <img src="{{ asset('assets') }}/img/icon/icon-onefinger.png" alt="lah"
                                        style="width:60px ; height: 60px;">
                                    <img src="{{ asset('assets') }}/img/icon/icon-twofinger.png" alt="lah"
                                        style="width:60px ; height: 60px;">
                                </div>
                                <div class="d-flex justify-content-around mt-3">
                                    <img src="{{ asset('assets') }}/img/icon/icon-wasit.png" alt="lah"
                                        style="width:60px ; height: 60px;">
                                    <img src="{{ asset('assets') }}/img/icon/icon-wasit.png" alt="lah"
                                        style="width:60px ; height: 60px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end team red --}}
            </div>
            {{-- end score --}}

            {{-- juri --}}
            <div class="row">
                <div class="col-6 pt-3" style="padding-right: 40px">
                    <div class="d-flex justify-content-end">
                        <div class="kiri">
                            <div class="bg-light mx-2 rounded">
                                <p class="px-4 py-2 m-0">Juri 1</p>
                            </div>
                            <div class="mt-4 border-dark bg-light mx-2 rounded">
                                <p class="px-4 py-2 m-0">Juri 1</p>
                            </div>
                        </div>
                        <div class="kiri">
                            <div class="bg-light mx-2 rounded">
                                <p class="px-4 py-2 m-0">Juri 2</p>
                            </div>
                            <div class="mt-4 border-dark bg-light mx-2 rounded">
                                <p class="px-4 py-2 m-0">Juri 2</p>
                            </div>
                        </div>
                        <div class="kiri">
                            <div class="bg-light mx-2 rounded">
                                <p class="px-4 py-2 m-0">Juri 3</p>
                            </div>
                            <div class="mt-4 border-dark bg-light mx-2 rounded">
                                <p class="px-4 py-2 m-0">Juri 3</p>
                            </div>
                        </div>
                        <div class="d-flex flex-column">
                            <img class="img" src="{{ asset('assets') }}/img/icon/icon-pkl.png" alt="lah"
                                style="width: 60px; height: 60px">
                            <img class="img" src="{{ asset('assets') }}/img/icon/icon-tdg.png" alt="lah"
                                style="width: 50px; height: 50px; transform: scaleX(-1);">
                        </div>
                    </div>
                </div>
                <div class="col-6 pt-3" style="padding-left: 40px">
                    <div class="d-flex justify-content-start">
                        <div class="d-flex flex-column">
                            <img class="img" src="{{ asset('assets') }}/img/icon/icon-pkl.png" alt="lah"
                                style="width: 60px; height: 60px;  transform: scaleX(-1);">
                            <img class="img" src="{{ asset('assets') }}/img/icon/icon-tdg.png" alt="lah"
                                style="width: 50px; height: 50px">
                        </div>
                        <div class="kanan">
                            <div class="bg-light mx-2 rounded">
                                <p class="px-4 py-2 m-0">Juri 1</p>
                            </div>
                            <div class="mt-4 border-dark bg-light mx-2 rounded">
                                <p class="px-4 py-2 m-0">Juri 1</p>
                            </div>
                        </div>
                        <div class="kanan">
                            <div class="bg-light mx-2 rounded">
                                <p class="px-4 py-2 m-0">Juri 2</p>
                            </div>
                            <div class="mt-4 border-dark bg-light mx-2 rounded">
                                <p class="px-4 py-2 m-0">Juri 2</p>
                            </div>
                        </div>
                        <div class="kanan">
                            <div class="bg-light mx-2 rounded">
                                <p class="px-4 py-2 m-0">Juri 3</p>
                            </div>
                            <div class="mt-4 border-dark bg-light mx-2 rounded">
                                <p class="px-4 py-2 m-0">Juri 3</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    <div class="d-flex flex-column mx-1">
                        <div class="border border-info bg-info rounded-top py-2 px-1" style="width: 110px">
                            <p class="m-0 text-center text-light">Sudut</p>
                        </div>
                        <div class="border border-primary bg-primary py-2 px-1" style="width: 110px">
                            <p class="m-0 text-center text-light">Biru</p>
                        </div>
                        <div class="border border-danger bg-danger rounded-bottom py-2 px-1" style="width: 110px">
                            <p class="m-0 text-center text-light">Merah</p>
                        </div>
                    </div>
                    <div class="d-flex flex-column mx-1">
                        <div class="border border-info bg-info rounded-top py-2 px-1" style="width: 110px">
                            <p class="m-0 text-center text-light">Peringatan 3</p>
                        </div>
                        <div class="border border-primary bg-primary py-2 px-1" style="width: 110px">
                            <p class="m-0 text-center text-light">0</p>
                        </div>
                        <div class="border border-danger bg-danger rounded-bottom py-2 px-1" style="width: 110px">
                            <p class="m-0 text-center text-light">0</p>
                        </div>
                    </div>
                    <div class="d-flex flex-column mx-1">
                        <div class="border border-info bg-info rounded-top py-2 px-1" style="width: 110px">
                            <p class="m-0 text-center text-light">Peringatan 2</p>
                        </div>
                        <div class="border border-primary bg-primary py-2 px-1" style="width: 110px">
                            <p class="m-0 text-center text-light">0</p>
                        </div>
                        <div class="border border-danger bg-danger rounded-bottom py-2 px-1" style="width: 110px">
                            <p class="m-0 text-center text-light">0</p>
                        </div>
                    </div>
                    <div class="d-flex flex-column mx-1">
                        <div class="border border-info bg-info rounded-top py-2 px-1" style="width: 110px">
                            <p class="m-0 text-center text-light">Peringatan 1</p>
                        </div>
                        <div class="border border-primary bg-primary py-2 px-1" style="width: 110px">
                            <p class="m-0 text-center text-light">0</p>
                        </div>
                        <div class="border border-danger bg-danger rounded-bottom py-2 px-1" style="width: 110px">
                            <p class="m-0 text-center text-light">0</p>
                        </div>
                    </div>
                    <div class="d-flex flex-column mx-1">
                        <div class="border border-info bg-info rounded-top py-2 px-1" style="width: 110px">
                            <p class="m-0 text-center text-light">Teguran 2</p>
                        </div>
                        <div class="border border-primary bg-primary py-2 px-1" style="width: 110px">
                            <p class="m-0 text-center text-light">0</p>
                        </div>
                        <div class="border border-danger bg-danger rounded-bottom py-2 px-1" style="width: 110px">
                            <p class="m-0 text-center text-light">0</p>
                        </div>
                    </div>
                    <div class="d-flex flex-column mx-1">
                        <div class="border border-info bg-info rounded-top py-2 px-1" style="width: 110px">
                            <p class="m-0 text-center text-light">Teguran 1</p>
                        </div>
                        <div class="border border-primary bg-primary py-2 px-1" style="width: 110px">
                            <p class="m-0 text-center text-light">0</p>
                        </div>
                        <div class="border border-danger bg-danger rounded-bottom py-2 px-1" style="width: 110px">
                            <p class="m-0 text-center text-light">0</p>
                        </div>
                    </div>
                    <div class="d-flex flex-column mx-1">
                        <div class="border border-info bg-info rounded-top py-2 px-2">
                            <p class="m-0 text-center text-light">Jatuhan</p>
                        </div>
                        <div class="border border-primary bg-primary py-2 px-1" style="width: 110px">
                            <p class="m-0 text-center text-light">0</p>
                        </div>
                        <div class="border border-danger bg-danger rounded-bottom py-2 px-1" style="width: 110px">
                            <p class="m-0 text-center text-light">0</p>
                        </div>
                    </div>
                    <div class="d-flex flex-column mx-1">
                        <div class="border border-info bg-info rounded-top py-2 px-1" style="width: 110px">
                            <p class="m-0 text-center text-light">Tendangan</p>
                        </div>
                        <div class="border border-primary bg-primary py-2 px-1" style="width: 110px">
                            <p class="m-0 text-center text-light">0</p>
                        </div>
                        <div class="border border-danger bg-danger rounded-bottom py-2 px-1" style="width: 110px">
                            <p class="m-0 text-center text-light">0</p>
                        </div>
                    </div>
                    <div class="d-flex flex-column mx-1">
                        <div class="border border-info bg-info rounded-top py-2 px-1" style="width: 110px">
                            <p class="m-0 text-center text-light">Pukulan</p>
                        </div>
                        <div class="border border-primary bg-primary py-2 px-1" style="width: 110px">
                            <p class="m-0 text-center text-light">0</p>
                        </div>
                        <div class="border border-danger bg-danger rounded-bottom py-2 px-1" style="width: 110px">
                            <p class="m-0 text-center text-light">0</p>
                        </div>
                    </div>

                </div>
            </div>
            {{-- end of juri --}}
        </div>
    </div>

    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script src="{{ asset('assets') }}/js/listenEvents.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        initializeListener(
            "{{ env('PUSHER_APP_KEY') }}",
            "{{ env('PUSHER_APP_CLUSTER') }}"
        );
    });
</script>
@endsection
