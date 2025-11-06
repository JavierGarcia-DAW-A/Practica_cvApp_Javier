<?php

use App\Http\Controllers\CurriculumController;
use App\Http\Controllers\MainController;

Route::get('/', [MainController::class, 'main'])->name('main');
Route::get('about', [MainController::class, 'about'])->name('about');

Route::get('curriculum', [CurriculumController::class, 'index'])->name('curriculum.index');
Route::get('curriculum/create', [CurriculumController::class, 'create'])->name('curriculum.create');
Route::post('curriculum', [CurriculumController::class, 'store'])->name('curriculum.store');
Route::get('curriculum/{id}', [CurriculumController::class, 'show'])->name('curriculum.show');
Route::get('curriculum/{id}/edit', [CurriculumController::class, 'edit'])->name('curriculum.edit');
Route::put('curriculum/{id}', [CurriculumController::class, 'update'])->name('curriculum.update');
Route::delete('curriculum/{id}', [CurriculumController::class, 'destroy'])->name('curriculum.destroy');

