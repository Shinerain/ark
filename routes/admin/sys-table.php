<?php
Route::get('sys-table/pagination', ['uses' => 'SysTableController@pagination']);
Route::get('sys-table/{id}/columns', ['uses' => 'SysColumnController@table']);
Route::get('sys-table/{id}/columns/pagination', ['uses' => 'SysColumnController@pagination']);
Route::resource('sys-table', 'SysTableController');