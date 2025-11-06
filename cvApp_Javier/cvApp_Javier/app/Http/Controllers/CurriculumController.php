<?php

namespace App\Http\Controllers;

use App\Models\Curriculum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CurriculumController extends Controller
{
    public function index(): View
{
    // Usa paginate en lugar de all()
    $curriculums = Curriculum::paginate(10);

    // Envía la variable a la vista
    return view('curriculum.index', compact('curriculums'));
}

    public function create(): View
    {
        return view('curriculum.create');
    }

    public function store(Request $request)
    {
        $data = $request->except(['pdf','fotografia']);

        if($request->hasFile('pdf')){
            $data['pdf'] = $request->file('pdf')->store('pdfs','public');
        }

        if($request->hasFile('fotografia')){
            $data['fotografia'] = $request->file('fotografia')->store('fotos','public');
        }

        Curriculum::create($data);
        return redirect()->route('curriculum.index');
    }

     public function show($id)
    {
        // Usamos el modelo Curriculum, que apunta a la tabla alumnos
        $curriculum = Curriculum::findOrFail($id);

        return view('curriculum.show', compact('curriculum'));
    }

    public function edit($id)
    {
        $curriculum = Curriculum::findOrFail($id);
        return view('curriculum.edit', compact('curriculum'));
    }



    public function update(Request $request, $id)
    {
        $curriculum = Curriculum::findOrFail($id);

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'correo' => 'nullable|email|max:255',
            'fecha_nacimiento' => 'nullable|date',
            'nota_media' => 'nullable|numeric',
            'experiencia' => 'nullable|string',
            'formacion' => 'nullable|string',
            'habilidades' => 'nullable|string',
            'pdf' => 'nullable|file|mimes:pdf|max:2048',
            'fotografia' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);


        if ($request->hasFile('fotografia')) {
            if ($curriculum->fotografia) {
                Storage::disk('public')->delete($curriculum->fotografia);
            }
            $validated['fotografia'] = $request->file('fotografia')->store('fotos', 'public');
        }


        if ($request->hasFile('pdf')) {
            if ($curriculum->pdf) {
                Storage::disk('public')->delete($curriculum->pdf);
            }
            $validated['pdf'] = $request->file('pdf')->store('pdfs', 'public');
        }

        $curriculum->update($validated);

        return redirect()->route('curriculum.index')->with('success', 'Alumno actualizado correctamente.');
    }


    public function destroy($id)
    {
        $curriculum = Curriculum::findOrFail($id);

        if ($curriculum->fotografia) {
            Storage::disk('public')->delete($curriculum->fotografia);
        }
        if ($curriculum->pdf) {
            Storage::disk('public')->delete($curriculum->pdf);
        }

        $curriculum->delete();

        return redirect()->route('curriculum.index')->with('success', 'Alumno eliminado correctamente.');
    }
}
