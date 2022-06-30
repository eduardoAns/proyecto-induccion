<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoMascotaController;

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

// Route::get('/empleado', function () {
//     return view('empleado.index');
// });

// Route::get('/empleado/create', [EmpleadoController::class,'create']);

// Route::get('/empleado/{id}/edit', [EmpleadoController::class,'edit']);

// esta linea remplaza todo lo hecho atras
Route::get('/', function () {
    return view('auth.login');
});

Route::resource('producto', ProductoMascotaController::class)->middleware('auth');

Auth::routes(['register'=>false,'reset'=>false]);

Route::get('/home', [ProductoMascotaController::class, 'index'])->name('home');

Route::group(['middleware'=>'auth'], function(){
    Route::get('/', [ProductoMascotaController::class, 'index'])->name('home');

});
