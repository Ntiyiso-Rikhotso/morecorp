<?php

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

Route::get('/bid_now', 'HomeController@bidNow');
Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/', 'HomeController@products');
Route::get('/view_product/{id}', 'HomeController@show');
Route::post('/bid/{id}', 'HomeController@bid');
Route::get('/sign_out', 'HomeController@logout');

Route::group(['middleware' => 'auth'], function() {
	
	Route::get('/dashboard', 'AdminController@dashboard');
	Route::get('/product', 'AdminController@productManagement');
	Route::get('/manage_product/{id}', 'AdminController@manageProduct');
	Route::post('/update_product/{id}', 'AdminController@update');
});