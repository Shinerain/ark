<?php
Route::get('sys-dic/pagination', ['uses' => 'SysDicController@pagination']);
Route::resource('sys-dic', 'SysDicController');