<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;

// Página principal
Route::get('/', [HomeController::class, 'index'])->name('home');

// Sobre nosotros
Route::view('/sobre-nosotros', 'about')->name('about');

// Contacto
Route::get('/contacto', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contacto', [ContactController::class, 'send'])->name('contact.send');

// Perfil del usuario (protegido)
Route::middleware('auth')->get('/perfil', function () {
    return view('profile');
})->name('profile');

Route::post('/perfil/update', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/perfil/delete-image', [ProfileController::class, 'deleteImage'])->name('profile.deleteImage');


Route::middleware(['auth'])->group(function () {
    Route::get('/admin/usuarios', [App\Http\Controllers\UserController::class, 'index'])->name('admin.users.index');
    Route::post('/admin/usuarios/{user}/toggle-subscription', [App\Http\Controllers\UserController::class, 'toggleSubscription'])->name('admin.users.toggleSubscription');
    Route::delete('/admin/usuarios/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->name('admin.users.destroy');
});

// Autenticación
Auth::routes();

// Cursos públicos


// Rutas protegidas (usuarios autenticados)
Route::middleware('auth')->group(function () {
    // Cursos
    Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');
    Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
    Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');
    Route::put('/courses/{course}', [CourseController::class, 'update'])->name('courses.update');
    Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');

    // Lecciones
    Route::get('/lessons/create', [LessonController::class, 'create'])->name('lessons.create');
    Route::post('/lessons', [LessonController::class, 'store'])->name('lessons.store');
    Route::get('/lessons/{lesson}/edit', [LessonController::class, 'edit'])->name('lessons.edit');
    Route::put('/lessons/{lesson}', [LessonController::class, 'update'])->name('lessons.update');
    Route::delete('/lessons/{lesson}', [LessonController::class, 'destroy'])->name('lessons.destroy');
});
