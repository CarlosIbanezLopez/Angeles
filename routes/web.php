<?php

use App\Models\Bitacora;
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
use App\Http\Controllers\AreacomunController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\ParqueoController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\NotacompraController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\NotaservicioController;
use App\Http\Controllers\NotasalidaController;
use App\Http\Controllers\BitacoraController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\RoleController;
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
//Route::delete('/users', UserController::class)->name('admin.users');
Route::resource('/empleados', EmpleadoController::class)->middleware('auth')->except('show');
Route::resource('/edificios', EdificioController::class)->middleware('auth')->except('show');

Route::get('notacompras/pdf', [App\Http\Controllers\NotacompraController::class, 'pdf'])->name('notacompras.pdf');

Route::get('notasalidas/pdf', [App\Http\Controllers\NotasalidaController::class, 'pdf'])->name('notasalidas.pdf');
Route::get('contratos/pdf', [App\Http\Controllers\ContratoController::class, 'pdf'])->name('contratos.pdf');
Route::get('pagos/pdf', [App\Http\Controllers\PagoController::class, 'pdf'])->name('pagos.pdf');

Route::resource('/usuarios', UsuarioController::class)->middleware('auth')->except('show');
Route::resource('/roles', RoleController::class)->middleware('auth')->except('show');

Route::resource('/trabajadores-de-rm', Trabajador_de_rmController::class, ['parameters' => ['trabajadores-de-rm' => 'trabajador_de_rm']])->middleware('auth')->except('show');
Route::resource('/avaladores', AvaladorController::class, ['parameters' => ['avaladores' => 'avalador']])->middleware('auth')->except('show');

Route::resource('/residentes', ResidenteController::class)->middleware('auth')->except('show');
Route::resource('/marcas', MarcaController::class)->middleware('auth')->except('show');
Route::resource('/categorias', CategoriaController::class)->middleware('auth')->except('show');
Route::resource('/proveedores', ProveedoreController::class)->middleware('auth')->except('show');
Route::resource('/muebles', App\Http\Controllers\MuebleController::class)->middleware('auth')->except('show');
Route::resource('/departamentos', DepartamentoController::class)->middleware('auth')->except('show');
Route::resource('/parqueos', ParqueoController::class)->middleware('auth')->except('show');
Route::resource('/contratos', ContratoController::class)->middleware('auth')->except('show');
Route::resource('/notacompras', NotacompraController::class)->middleware('auth')->except('show');
Route::resource('/bitacoras', BitacoraController::class)->middleware('auth')->except('show');
Route::resource('/inventarios', InventarioController::class)->middleware('auth')->except('show');
Route::resource('/pagos', PagoController::class)->middleware('auth')->except('show');
Route::resource('/notasalidas', NotasalidaController::class)->middleware('auth')->except('show');
Route::resource('/notaservicios', NotaServicioController::class)->middleware('auth')->except('show');
Route::resource('/areacomuns', AreacomunController::class)->middleware('auth')->except('show');




require __DIR__.'/auth.php';
