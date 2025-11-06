<?php

namespace App\Http\Controllers;

use App\Models\Curriculum;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MainController extends Controller
{
    function about(): View {
        return view('main.about');
    }

    function main(): View {
        $alumnos = Curriculum::all();
        return view('main.main', ['alumnos' => $alumnos]);
    }
}

