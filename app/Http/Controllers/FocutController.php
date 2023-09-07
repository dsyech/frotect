<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FocutController extends Controller
{
    public function index(){
        return view('focut');
    }
}
