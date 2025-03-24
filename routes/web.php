<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\UserController;

// ==========================
// Página principal y estáticas
// ==========================
Route::get('/', [HomeController::class, 'index'])->name('home');

// ==========================
// Contacto
// ==========================
Route::get('/contacto', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contacto', [ContactController::class, 'send'])->name('contact.send');

// ==========================
// Autenticación
// ==========================
Auth::routes();

// ==========================
// Perfil de usuario
// ==========================
Route::middleware('auth')->group(function () {
    Route::get('/perfil', fn () => view('profile'))->name('profile');
    Route::post('/perfil/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/perfil/delete-image', [ProfileController::class, 'deleteImage'])->name('profile.deleteImage');
});

// ==========================
// Administración (solo autenticados)
// ==========================
Route::middleware('auth')->group(function () {
    Route::get('/admin/usuarios', [UserController::class, 'index'])->name('admin.users.index');
    Route::post('/admin/usuarios/{user}/toggle-subscription', [UserController::class, 'toggleSubscription'])->name('admin.users.toggleSubscription');
    Route::post('/admin/usuarios/{user}/toggle-admin', [UserController::class, 'toggleAdmin'])->name('admin.users.toggleAdmin');
    Route::delete('/admin/usuarios/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});

// ==========================
// Cursos (protegidos)
// ==========================
Route::middleware('auth')->group(function () {
    Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
    Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
    Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');
    Route::put('/courses/{course}', [CourseController::class, 'update'])->name('courses.update');
    Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');
});

// ==========================
// Cursos públicos
// ==========================
Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');

// ==========================
// Lecciones (protegidas)
// ==========================
Route::middleware('auth')->group(function () {
    Route::get('/lessons/create', [LessonController::class, 'create'])->name('lessons.create');
    Route::post('/lessons', [LessonController::class, 'store'])->name('lessons.store');
    Route::get('/lessons/{lesson}/edit', [LessonController::class, 'edit'])->name('lessons.edit');
    Route::put('/lessons/{lesson}', [LessonController::class, 'update'])->name('lessons.update');
    Route::delete('/lessons/{lesson}', [LessonController::class, 'destroy'])->name('lessons.destroy');
});
