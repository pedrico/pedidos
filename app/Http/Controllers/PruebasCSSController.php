<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PruebasCSSController extends Controller
{
    public function show()
    {
        return view('pruebas.showCSS');
    }

    public function register(){
        return view('pruebas.register');
    }
}
