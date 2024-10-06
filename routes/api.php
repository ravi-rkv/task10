<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\EncryptionController;
use App\Http\Controllers\AuthenticationController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/', function (Request $request) {
    echo 'hello';
});



Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/login', [AuthenticationController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/encrypt', [EncryptionController::class, 'encrypt']);
    Route::post('/decrypt', [EncryptionController::class, 'decrypt']);


    Route::resource('articles', ArticleController::class)->except(['create', 'edit']);
});
