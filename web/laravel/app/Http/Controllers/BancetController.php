<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BancetController extends Controller
{
    function index()
    {
        return view('bancet.index');
    }
}
