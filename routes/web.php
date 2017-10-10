<?php

// import / export excel to db('workers')
Route::get('/', 'ParserXlsToDbController@index');
Route::post('import', 'ParserXlsToDbController@importExcel');
Route::get('export/{type}', 'ParserXlsToDbController@exportExcel');
Route::get('export/{type}/{deleteTable}', 'ParserXlsToDbController@exportExcel');
// CRUD workers
Route::resource('workers', 'WorkerCrudController');
