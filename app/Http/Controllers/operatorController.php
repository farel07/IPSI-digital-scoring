<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class operatorController extends Controller
{
    public function index()
    {
        return view('scoring.operator');
    }
}
