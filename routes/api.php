<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CentreController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ReservationController;




/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/test',[TestController::class,'testDbConnection']);
Route::get('/login',[UserController::class,'Login']);
Route::get('/getcentre',[CentreController::class,'Getcentres']);
Route::get('/getcategories',[CategorieController::class,'Get_Categories']);
Route::get('/getorganismes',[CategorieController::class,'Get_Organismes']);

Route::get('/getpublication',[PublicationController::class,'Get_Publication']);
Route::post('/adduser',[UserController::class,'AddUtilisateur']);
Route::post('/addreservation',[ReservationController::class,'Addreservation']);

