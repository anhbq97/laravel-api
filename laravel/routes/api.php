<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API;

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
//API route for register new user
Route::post('/register', [API\AuthController::class, 'register']);
//API route for login user
Route::post('/login', [API\AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    // Brand
    Route::resource('brands', API\BrandController::class);

    // Product
    Route::resource('products', API\ProductController::class);

    // Product category
    Route::resource('product_category', API\ProductCategoryController::class);

    // Get infomation user
    Route::get('user', function(Request $request) {
        return auth()->user();
    });

    // Logout
    Route::post('/logout', [API\AuthController::class, 'logout']);

    Route::get('/tokens', [API\AuthController::class, 'getTokens']);
});

