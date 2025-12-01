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
        try {
            $curriculums = Curriculum::paginate(10);
            return view('curriculum.index', compact('curriculums'));
        } catch (\Exception $e) {
            return back()->withErrors("Error al cargar los currículums.");
        }
    }

    public function create(): View
    {
        return view('curriculum.create');
    }

    public function store(Request $request)
    {
        try {
            $data = $request->all();

            $nombre = $request->input('nombre');
            $apellidos = $request->input('apellidos');
            $nombreCompleto = $nombre . ' ' . $apellidos;
            $timestamp = now()->timestamp;
            $baseFileName = "{$nombreCompleto}_{$timestamp}";

            if($request->hasFile('pdf')){
                $pdf = $request->file('pdf');
                $extensionPDF = $pdf->getClientOriginalExtension();
                $pdfFileName = "{$baseFileName}.{$extensionPDF}";
                
                $data['pdf'] = $pdf->storeAs('pdfs', $pdfFileName, 'public');
            }

            if($request->hasFile('fotografia')){
                $foto = $request->file('fotografia');
                $extensionFoto = $foto->getClientOriginalExtension();
                $fotoFileName = "{$baseFileName}.{$extensionFoto}";

                $data['fotografia'] = $foto->storeAs('fotos', $fotoFileName, 'public');
            }

            Curriculum::create($data);
            return redirect()->route('curriculum.index');

        } catch (\Exception $e) {
            return back()->withErrors("Error al guardar el currículum.")->withInput();
        }
    }

    public function show($id)
    {
        try {
            $curriculum = Curriculum::findOrFail($id);
            return view('curriculum.show', compact('curriculum'));
        } catch (\Exception $e) {
            return back()->withErrors("No se pudo mostrar el currículum.");
        }
    }

    public function edit($id)
    {
        try {
            $curriculum = Curriculum::findOrFail($id);
            return view('curriculum.edit', compact('curriculum'));
        } catch (\Exception $e) {
            return back()->withErrors("No se pudo cargar el currículum para editar.");
        }
    }

    public function update(Request $request, $id)
    {
        try {
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

        } catch (\Exception $e) {
            return back()->withErrors("Error al actualizar el currículum.")->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $curriculum = Curriculum::findOrFail($id);

            if ($curriculum->fotografia) {
                Storage::disk('public')->delete($curriculum->fotografia);
            }
            if ($curriculum->pdf) {
                Storage::disk('public')->delete($curriculum->pdf);
            }

            $curriculum->delete();

            return redirect()->route('curriculum.index')->with('success', 'Alumno eliminado correctamente.');

        } catch (\Exception $e) {
            return back()->withErrors("Error al eliminar el currículum.");
        }
    }
}
