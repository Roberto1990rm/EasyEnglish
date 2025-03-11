<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CursoBasicoController;
use App\Http\Controllers\PronounController;
use Illuminate\Support\Facades\Auth;

use App\Models\Leccion;


Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/curso-basico/create', [CursoBasicoController::class, 'create'])->name('curso_basico.create');
Route::post('/curso-basico/store', [CursoBasicoController::class, 'store'])->name('curso_basico.store');
Route::get('/curso-basico', [CursoBasicoController::class, 'index'])->name('curso.basico.index');
Route::get('/curso-basico/{id}', [CursoBasicoController::class, 'show'])->name('curso.basico.show');


Route::get('/curso-basico/{lesson_id}/pronouns/create', [PronounController::class, 'create'])->name('pronouns.create');
Route::post('/curso-basico/{lesson_id}/pronouns/store', [PronounController::class, 'store'])->name('pronouns.store');
