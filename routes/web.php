<?php

/*
 * Excel Workers table
 */
// import / export excel to db('workers')
Route::get('/', 'ParserExcelDb\ParserExcelDbController@index');
Route::post('import', 'ParserExcelDb\ParserExcelDbController@importExcel');
Route::get('export/{deleteTable?}', 'ParserExcelDb\ParserExcelDbController@exportExcel');
// CRUD workers
Route::resource('workers', 'ParserExcelDb\WorkerCrudController');

