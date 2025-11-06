<?php

namespace App\Http\Controllers;

use App\Models\Curriculum;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MainController extends Controller
{
    function about(): View {
        return view('curriculum.about');
    }

    public function main()
        {
            // Obtenemos los últimos alumnos (puedes cambiar la cantidad o el orden)
            $curriculums = Curriculum::all();

            // Enviamos la variable a la vista
            return view('curriculum.main', compact('curriculums'));
        }

}


