@extends('main.main')
@section('content')
    <div class="container mt-2 mb-0 rounded pb-4 pt-3"
        style="background-color: rgb(216, 216, 216); border-bottom: 1px solid #000000">
        <div class="d-flex justify-content-center">
            <button class="btn btn-danger mx-3 text-light fs-5" type="button"
                style="width: 150px; height:50px;">Tanding</button>
            <button class="btn mx-3 text-light fs-5" type="button"
                style="width: 150px; height:50px; background-color:rgb(19, 226, 0)">Artistics</button>
            <button class="btn mx-3 text-light fs-5" type="button"
                style="width: 150px; height:50px; background-color:rgb(19, 226, 0)">Jurus Baku</button>
        </div>
    </div>
    <div class="container rounded pb-4 pt-3" style="background-color: rgb(216, 216, 216); border-bottom: 1px solid #000000">
        <div class="d-flex justify-content-center">
            <button class="btn btn-light mx-3 fs-5" type="button" style="width: 300px; height:50px;">All Group</button>
            <button class="btn btn-light mx-3 fs-5" type="button" style="width: 300px; height:50px">All Class</button>
            <button class="btn btn-light mx-3 fs-5" type="button" style="width: 300px; height:50px">All Gender</button>
        </div>
        <div class="d-flex justify-content-center mt-3">
            <button class="btn btn-light mx-3 fs-5" type="button" style="width: 300px; height:50px;">Monday, 2000 - 01 -
                01</button>
            <button class="btn btn-light mx-3 fs-5" type="button" style="width: 300px; height:50px">Session</button>
            <button class="btn btn-light mx-3 fs-5" type="button" style="width: 300px; height:50px">Undone</button>
        </div>
    </div>
    <div class="container rounded pb-4 pt-3" style="background-color: rgb(216, 216, 216);">
        <h1 class="text-center" style="font-size: 100px"> Table</h1>
    </div>
@endsection
