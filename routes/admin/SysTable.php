<?php
Route::get('sys-table/pagination', ['uses' => 'SysTableController@pagination']);
Route::resource('sys-table', 'SysTableController');