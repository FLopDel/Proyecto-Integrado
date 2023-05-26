<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ValorationController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\BlogController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return Inertia::render('Home', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/location', function () {
    return Inertia::render('Location');
});

Route::get('/about', function () {
    return Inertia::render('AboutUs');
});

Route::get('/administration', function () {
    return Inertia::render('Administration');
});

Route::get('/menu', function () {
    return Inertia::render('Menu');
});

Route::get('/blog', function () {
    return Inertia::render('Blog');
});



Route::get('/reservation', function () {
    return Inertia::render('Reservation');
});

Route::get('/opinion', function () {
    return Inertia::render('Opinion');
});

// Fuciones para Insertar informacion 

Route::post('/section',[SectionController::class, 'store']);

Route::post('/menu',[MenuController::class, 'store']);

Route::post('/reservation',[ReservationController::class, 'store']);

Route::post('/opinion',[ValorationController::class, 'store']);

Route::post('/blog',[BlogController::class, 'store']);





// Funciones mostrar informacion 

Route::get('/reserva',[ReservationController::class, 'mostrar']);
Route::post('/reserva',[ReservationController::class, 'mostrar']);

Route::get('/numReservas',[ReservationController::class, 'numReservas']);
Route::post('/numReservas',[ReservationController::class, 'numReservas']);

Route::get('/opiniones',[ValorationController::class, 'mostrar']);
Route::post('/opiniones',[ValorationController::class, 'mostrar']);

Route::get('/comentarios',[ValorationController::class, 'mostrarTodos']);
Route::post('/comentarios',[ValorationController::class, 'mostrarTodos']);

Route::get('/secciones',[SectionController::class, 'mostrar']);
Route::post('/secciones',[SectionController::class, 'mostrar']);

Route::get('/tituloSecciones',[SectionController::class, 'secciones']);
Route::post('/tituloSecciones',[SectionController::class, 'secciones']);

Route::get('/datosPlatos',[MenuController::class, 'mostrar']);
Route::post('/datosPlatos',[MenuController::class, 'mostrar']);

Route::get('/numeroPlatos',[MenuController::class, 'numPlatos']);
Route::post('/numeroPlatos',[MenuController::class, 'numPlatos']);

Route::get('/blogs',[BlogController::class, 'mostrar']);
Route::post('/blogs',[BlogController::class, 'mostrar']);

Route::get('/noticias',[BlogController::class, 'mostrar']);
Route::post('/noticias',[BlogController::class, 'mostrar']);


//Funciones eliminar

Route::delete('/comentarios/{id}', [ValorationController::class, 'destroy']);

Route::delete('/recetas/{id}', [MenuController::class, 'destroy']);

Route::delete('/secciones/{id}', [SectionController::class, 'destroy']);

Route::delete('/noticias/{id}', [BlogController::class, 'destroy']);

// Funciones modificar


Route::post('/recetaModificada/{id}', [MenuController::class, 'update']);

Route::post('/seccionModificada/{id}', [SectionController::class, 'update']);

Route::post('/desactivarComentario/{id}', [ValorationController::class, 'desactived']);

require __DIR__.'/auth.php';
