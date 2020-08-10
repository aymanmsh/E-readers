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

Route::get('/dashboard', function () {
    return view('index');
});


// Category Routes
Route::group(['prefix' => 'category'], function() {
	Route::get('index', ['as' => 'category.index', 'uses' => 'control\CategoryController@index']);
	Route::get('deleted', ['as' => 'category.deleted', 'uses' => 'control\CategoryController@onlyTrashed']);
	Route::get('create', ['as' => 'category.create', 'uses' => 'control\CategoryController@create']);
	Route::post('create', ['as' => 'category.store', 'uses' => 'control\CategoryController@store']);
	Route::get('edit/{id}', ['as' => 'category.edit', 'uses' => 'control\CategoryController@edit']);
	Route::put('update/{id}', ['as' => 'category.update', 'uses' => 'control\CategoryController@update']);
	Route::get('delete/{id?}', ['as' => 'category.destroy', 'uses' => 'control\CategoryController@destroy']);
	Route::get('restore/{id?}', ['as' => 'category.restore', 'uses' => 'control\CategoryController@restore']);
});

// Library Routes
Route::group(['prefix' => 'library'], function() {
	Route::get('index', ['as' => 'library.index', 'uses' => 'control\LibraryController@index']);
	Route::get('deleted', ['as' => 'library.deleted', 'uses' => 'control\LibraryController@onlyTrashed']);
	Route::get('create', ['as' => 'library.create', 'uses' => 'control\LibraryController@create']);
	Route::post('create', ['as' => 'library.store', 'uses' => 'control\LibraryController@store']);
	Route::get('edit/{id}', ['as' => 'library.edit', 'uses' => 'control\LibraryController@edit']);
	Route::put('update/{id}', ['as' => 'library.update', 'uses' => 'control\LibraryController@update']);
	Route::get('delete/{id?}', ['as' => 'library.destroy', 'uses' => 'control\LibraryController@destroy']);
	Route::get('restore/{id?}', ['as' => 'library.restore', 'uses' => 'control\LibraryController@restore']);
});

// Book Routes
Route::group(['prefix' => 'book'], function() {
	Route::get('index', ['as' => 'book.index', 'uses' => 'control\BookController@index']);
	Route::get('deleted', ['as' => 'book.deleted', 'uses' => 'control\BookController@onlyTrashed']);
	Route::get('create', ['as' => 'book.create', 'uses' => 'control\BookController@create']);
	Route::post('create', ['as' => 'book.store', 'uses' => 'control\BookController@store']);
	Route::get('edit/{id}', ['as' => 'book.edit', 'uses' => 'control\BookController@edit']);
	Route::put('update/{id}', ['as' => 'book.update', 'uses' => 'control\BookController@update']);
	Route::get('delete/{id?}', ['as' => 'book.destroy', 'uses' => 'control\BookController@destroy']);
	Route::get('restore/{id?}', ['as' => 'book.restore', 'uses' => 'control\BookController@restore']);
});


Route::get('local/{lang?}', ['as' => 'local.change', 'uses' => 'LocalizationController@change']);
