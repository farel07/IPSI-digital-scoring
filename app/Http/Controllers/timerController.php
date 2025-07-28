<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class timerController extends Controller
{
    public function index()
    {
        return view('scoring.timer');
    }
}
