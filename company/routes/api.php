<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Validamos y protegemos que no pueda ingresar a ninguna url sin logearse
Route::post('auth/register',[AuthController::class, 'create']);
Route::post('auth/login',[AuthController::class, 'login']);

//Protegemos estas rutas
Route::middleware('auth:sanctum')->group(function (){
    Route::resource('departments', DepartmentController::class);
    Route::resource('empleados', EmpleadoController::class);
    Route::get('empleadosall',[EmpleadoController::class, 'all']);
    Route::get('empleadopordepartamento', [EmpleadoController::class, 'empleadoPorDepartamento']);
    Route::post('auth/logout',[AuthController::class, 'logout']);
});
