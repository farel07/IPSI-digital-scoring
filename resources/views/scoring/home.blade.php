@extends('main.main')

@section('content')
    {{-- navbar --}}
    <nav class="navbar navbar-expand-lg navbar-light ">
        <div class="container-fluid">
            <a class="navbar-brand" href="/home"><img src="{{ asset('assets') }}/img/icon/logo-jawi.png" alt="kocak"
                    style="width: 100px; height: 80px"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item mx-5">
                        <a class="nav-link hover-underline" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item mx-5">
                        <a class="nav-link hover-underline" href="#">About</a>
                    </li>
                    <li class="nav-item mx-5">
                        <a class="nav-link hover-underline" href="#">Contact</a>
                    </li>
                    <li class="nav-item mx-5 dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Register
                        </a>
                        <ul class="dropdown-menu " aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Peserta</a></li>
                            <li><a class="dropdown-item" href="#">Juri</a></li>
                            <li><a class="dropdown-item" href="#">Dewan</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex">
                    <a class="nav-link" href="/operator"><img src="{{ asset('assets') }}/img/icon/logo-profile.png"
                            alt="lah" style="width: 25px"></a>
                    {{-- <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button> --}}
                </form>
            </div>
        </div>
    </nav>
    {{-- end of navbar --}}
    {{-- content --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-6  mt-5">
                <p class="playfair-font" style="font-size: 120px;margin-left:200px ">Title</p>
                <p class="playfair-font" style="margin-left:200px">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Quaerat officia
                    suscipit
                    deleniti cum fugit sequi culpa, fugiat quis magnam amet quos, officiis ad repellat vero fuga laudantium
                    voluptatum ullam rem iusto dicta? Eveniet dignissimos, inventore esse minima sapiente impedit libero.
                </p>
            </div>
            <div class="col-6 text-center mt-5">
                <div class="mx-auto" style="margin-top: 50px;width: 90px; height: 100px"><img style="width: 200px"
                        src="{{ asset('assets') }}/img/icon/logo-jawi.png" alt=""></div>
            </div>
        </div>
    </div>
    {{-- end of content --}}
@endsection
