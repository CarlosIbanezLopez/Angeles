<?php

use App\Http\Controllers\AvaladorController;
use App\Http\Controllers\EdificioController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\Empresa_de_rmController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResidenteController;
use App\Http\Controllers\ProveedoreController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\Trabajador_de_rmController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\AreaComunController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('/empresas-de-rm', Empresa_de_rmController::class, ['parameters' => ['empresas-de-rm' => 'empresa_de_rm']])->middleware('auth')->except('show');

Route::resource('/empleados', EmpleadoController::class)->middleware('auth')->except('show');
Route::resource('/edificios', EdificioController::class)->middleware('auth')->except('show');

Route::resource('/trabajadores-de-rm', Trabajador_de_rmController::class, ['parameters' => ['trabajadores-de-rm' => 'trabajador_de_rm']])->middleware('auth')->except('show');
Route::resource('/avaladores', AvaladorController::class, ['parameters' => ['avaladores' => 'avalador']])->middleware('auth')->except('show');

Route::resource('/residentes', ResidenteController::class)->middleware('auth')->except('show');
Route::resource('/marcas', MarcaController::class)->middleware('auth')->except('show');
Route::resource('/categorias', CategoriaController::class)->middleware('auth')->except('show');
Route::resource('/proveedores', ProveedoreController::class)->middleware('auth')->except('show');

Route::resource('/areas-comunes', AreaComunController::class, ['parameters' => ['areas-comunes' => 'area_comun']])->middleware('auth')->except('show');



require __DIR__.'/auth.php';
