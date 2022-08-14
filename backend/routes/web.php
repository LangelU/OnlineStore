<?php

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
})->middleware('auth');


Route::get('/tes', function () {return view('test');});

//***** Views *****/
Route::get('/', function () {return view('welcome');});
//Route::get('/newProd', function () {return view('newProdView')->name('newProdView');});


// ***** Product Endpoints ***** //
//Route::POST('/createProduct', 'App\Http\Controllers\ProductController@createProduct');
Route::GET('/products', 'App\Http\Controllers\ProductController@showAllProducts')->name('products');
Route::PUT('/updateProduct/{idProduct}', 'ProductController@updateProduct')->name('upProduct');
Route::GET('/productDetails', 'ProductController@productDetails')->name('prodDetails');
Route::POST('/deleteProduct/{idProduct}', 'ProductController@deleteProduct')->name('deleteProd');

// ***** Categories Endpoints ***** //
//Route::POST('/newCategory', 'App\Http\Controllers\Categorycontroller@createCategory')->name('newCategory');
Route::GET('/categories/{idUser}', 'App\Http\Controllers\CategoryController@showAllCategories');
//Route::PUT('/updateCategory/{idCategory}', 'CategoryController@updateCategory')->name('upCategory');
//Route::POST('/deleteCategory/{idCategory}', 'CategoryController@deleteCategory')->name('deleteCat');

Route::POST('/newRole', 'App\Http\Controllers\RoleController@newRole')->name('newRole');
Route::POST('/newUser', 'App\Http\Controllers\UserController@newUser');

Auth::routes();

