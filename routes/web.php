<?php

use App\Http\Controllers\LandingPublicController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Mail\EnviarCorreo;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});



Route::group(['middleware' => ['auth']], function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard', [App\Http\Controllers\LandingPublicController::class, 'eventos'])->name('dashboard');
    Route::get('/usuarios', [App\Http\Controllers\LandingPublicController::class, 'administradores'])->name('usuarios');
});

//nuevaLading
Route::group(['middleware' => ['auth']], function () {
    Route::get('/public', [App\Http\Controllers\LandingPublicController::class, 'publica'])->name('publica.publica');
    // Route::get('/public/obtener-estilos/{id}', [App\Http\Controllers\LandingPublicController::class, 'obtenerEstilos'])->name('obtener-estilos');
    Route::post('/createLading', [App\Http\Controllers\LandingPublicController::class, 'nuevaLading'])->name('lading.nueva');
    Route::get('/dashboard/json/', [App\Http\Controllers\LandingPublicController::class,'obtenerEventos'])->name('dashboard');
    Route::get('/editar/evento/{id}',[App\Http\Controllers\LandingPublicController::class,'editarLanding'])->name('editar.evento');
    // Route::post('/editar/evento/{id}',[App\Http\Controllers\LandingPublicController::class,'Actualizar'])->name('editar.evento');
    // Route::get('/editar/form/{id}',[App\Http\Controllers\LandingPublicController::class,'editarForm'])->name('editar.form');
    Route::post('/actualizar/landing/{id}', [App\Http\Controllers\LandingPublicController::class,'Actualizar'])->name('actualizar.landing');
    Route::post('/eliminar/landing/{id}',[App\Http\Controllers\LandingPublicController::class,'eliminarLanding'])->name('eliminar.landing');
    // Route::get('/dashboard', [App\Http\Controllers\LandingPublicController::class,'eventos'])->name('dashboard');
})->middleware(['auth'])->name('lading');


//vista public
Route::get('/evento', [App\Http\Controllers\LandingPublicController::class, 'ladingPublica'])->name('evento.evento');
Route::post('/evento/inscripcion', [App\Http\Controllers\inscripcionesController::class, 'nuevaInscripcionYCorreo'])->name('evento.inscripcion');

require __DIR__.'/auth.php';
