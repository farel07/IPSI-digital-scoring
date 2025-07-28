<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class juriController extends Controller
{
    public function index()
    {
        return view('scoring.juri');
    }
}
