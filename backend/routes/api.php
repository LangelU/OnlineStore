<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//* VIEWS *//
//Route::get('/home', function () {return view('mainhome.home');});

//* Login *//
Route::GET('/login', function () {return view('login.login');});
Route::GET('/loginValidate', 'App\Http\Controllers\LoginController@login')->name('loginValidate');
Route::GET('/home', 'App\Http\Controllers\ProductController@showAllProducts')->name('home');


Route::POST('/newProduct', 'App\Http\Controllers\ProductController@createProduct')->name('newProduct');
Route::GET('/products', 'App\Http\Controllers\ProductController@showAllProducts')->name('products');
Route::PUT('/updateProduct/{idProduct}', 'App\Http\Controllers\ProductController@updateProduct')->name('upProduct');
Route::GET('/productDetails/{idProduct}', 'App\Http\Controllers\ProductController@productDetails')->name('productDetails');
Route::POST('/deleteProduct/{idProduct}', 'App\Http\Controllers\ProductController@deleteProduct')->name('deleteProd');
Route::GET('/prodByCat/{idCategory}', 'App\Http\Controllers\ProductController@productsByCategory');

// ***** Categories Endpoints ***** //
Route::POST('/newCategory', 'App\Http\Controllers\Categorycontroller@createCategory')->name('newCategory');
Route::GET('/categories', 'App\Http\Controllers\CategoryController@showAllCategories')->name('categories');
Route::PUT('/updateCategory/{idCategory}', 'App\Http\Controllers\CategoryController@updateCategory')->name('upCategory');
Route::POST('/deleteCategory/{idCategory}', 'App\Http\Controllers\CategoryController@deleteCategory')->name('deleteCat');

Route::POST('/newRole', 'App\Htpp\Controllers\RoleController@createRole');
Route::POST('/newUser', 'App\Http\Controllers\UserController@newUser');


// ***** ShoppingCart Enpoints ***** //
Route::POST('/addCartProduct/{idUser}/{idProduct}/{productPrice}/{iva}','App\Http\Controllers\ShoppingCartController@addNewProduct');
Route::GET('/cartContent/{idUser}', 'App\Http\Controllers\ShoppingCartController@showCartContent');
Route::POST('/deleteProductCart/{idUser}/{idProduct}','App\Http\Controllers\ShoppingCartController@deleteProduct');
Route::POST('/validateCart/{idUser}', 'App\Http\Controllers\ShoppingCartController@validateCart');



Route::GET('/msprod', 'App\Http\Controllers\StatisticsController@mostSelledProducts');
Route::GET('/saleHist', 'App\Http\Controllers\StatisticsController@saleHistory');
Route::GET('/bestBuy', 'App\Http\Controllers\StatisticsController@bestBuyers');
Route::GET('/unsProd', 'App\Http\Controllers\StatisticsController@unsoldProducts');
