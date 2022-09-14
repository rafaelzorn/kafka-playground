<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Address\AddressController;

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

Route::prefix('v1/')->group(function () {

    # ADDRESS
    Route::post('address', [AddressController::class, 'handle']);
});
