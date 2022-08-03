<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\BrandController;
use App\Http\Controllers\API\ProductCategoryController;

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
Route::post('/register', [App\Http\Controllers\API\AuthController::class, 'register']);
//API route for login user
Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    // Brand
    Route::resource('brands', BrandController::class);
    Route::resource('brands/create', BrandController::class); //view create
    Route::resource('brands', BrandController::class); //save new brand
    Route::resource('brands/{brand_id}/', BrandController::class); //view show
    Route::resource('brands/{brand_id}/edit', BrandController::class); //view edit
    Route::resource('brands/{brand_id}/update', BrandController::class); //update brand
    Route::resource('brands/{brand_id}/delete', BrandController::class); //deactive

    // Product
    Route::resource('products', ProductController::class);
    Route::resource('products/create', ProductController::class); //view create
    Route::resource('products', ProductController::class); //save new brand
    Route::resource('products/{product_id}/', ProductController::class); //view show
    Route::resource('products/{product_id}/edit', ProductController::class); //view edit
    Route::resource('products/{product_id}/update', ProductController::class); //update brand
    Route::resource('products/{product_id}/delete', ProductController::class); //deactive

    // Product category
    Route::resource('product_category', ProductCategoryController::class);
    Route::resource('product_category/create', ProductCategoryController::class); //view create
    Route::resource('product_category', ProductCategoryController::class); //save new brand
    Route::resource('product_category/{product_category_id}/', ProductCategoryController::class); //view show
    Route::resource('product_category/{product_category_id}/edit', ProductCategoryController::class); //view edit
    Route::resource('product_category/{product_category_id}/update', ProductCategoryController::class); //update brand
    Route::resource('product_category/{product_category_id}/delete', ProductCategoryController::class); //deactive

    //Get infomation user
    Route::get('/user', function(Request $request) {
        return auth()->user();
    });

    //Logout
    Route::post('/logout', [App\Http\Controllers\API\AuthController::class, 'logout']);
});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
