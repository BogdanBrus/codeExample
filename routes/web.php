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

Route::get('/', 'ParserXlsToDbController@index');
Route::post('import', 'ParserXlsToDbController@import');
Route::get('export/{type}', 'ParserXlsToDbController@export');
Route::get('export/{type}/{deleteTable}', 'ParserXlsToDbController@export');



Route::resource('workers', 'WorkerCrudController');
