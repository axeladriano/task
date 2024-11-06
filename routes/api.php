<?php

use App\Http\Controllers\TareasController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// route::controller(UserController::class)->group(function () {
//     route::get('task','index');
//     route::post('task','store');
// });

route::controller(TareasController::class)->group(function () {
    route::get('task','index');
    route::get('task/{id}','show');
    route::post('task','store');
    route::put('task/{id}','update');
    route::delete('task/{id}','destroy');
});