<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ShareholderPrivateController;
use App\Http\Controllers\Api\ShareholderCompanyController;


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

Route::post('/shareholder-private', [ShareholderPrivateController::class, 'store']);
Route::post('/shareholder-company', [ShareholderCompanyController::class, 'store']);