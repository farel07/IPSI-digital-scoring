<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dewanController extends Controller
{
    public function index()
    {
        return view("scoring.dewan");
    }
}
