<?php
Route::get('sys-table/pagination', ['uses' => 'SysTableController@pagination']);
Route::match(['get','post'],'sys-table/db', ['uses' => 'SysTableController@db']);
Route::post('sys-table/{id}/build', ['uses' => 'SysTableController@build']);
Route::post('sys-table/{id}/rebuild', ['uses' => 'SysTableController@rebuild']);
Route::get('sys-table/{id}/columns', ['uses' => 'SysColumnController@table']);
Route::get('sys-table/{id}/columns/pagination', ['uses' => 'SysColumnController@pagination']);
Route::resource('sys-table', 'SysTableController');