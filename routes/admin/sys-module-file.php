<?php
Route::get('sys-module-file/pagination', ['uses' => 'SysModuleFileController@pagination']);
Route::resource('sys-module-file', 'SysModuleFileController');