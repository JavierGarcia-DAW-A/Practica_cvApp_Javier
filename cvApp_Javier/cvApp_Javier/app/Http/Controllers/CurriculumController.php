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
        $curriculums = Curriculum::orderBy('created_at', 'desc')->get();
        return view('curriculum.index', ['curriculums' => $curriculums]);
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

    public function show(Curriculum $curriculum): View
    {
        return view('curriculum.show', ['curriculum' => $curriculum]);
    }

    public function edit(Curriculum $curriculum): View
    {
        return view('curriculum.edit', ['curriculum' => $curriculum]);
    }

    public function update(Request $request, Curriculum $curriculum)
    {
        $data = $request->except(['pdf','fotografia']);

        if($request->hasFile('pdf')){
            if($curriculum->pdf) Storage::disk('public')->delete($curriculum->pdf);
            $data['pdf'] = $request->file('pdf')->store('pdfs','public');
        }

        if($request->hasFile('fotografia')){
            if($curriculum->fotografia) Storage::disk('public')->delete($curriculum->fotografia);
            $data['fotografia'] = $request->file('fotografia')->store('fotos','public');
        }

        $curriculum->update($data);
        return redirect()->route('curriculum.index');
    }

    public function destroy(Curriculum $curriculum)
    {
        if($curriculum->pdf) Storage::disk('public')->delete($curriculum->pdf);
        if($curriculum->fotografia) Storage::disk('public')->delete($curriculum->fotografia);

        $curriculum->delete();
        return redirect()->route('curriculum.index');
    }
}
