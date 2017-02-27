<?php
Route::get('sys-module-file/pagination', ['uses' => 'SysModuleFileController@pagination']);
Route::get('sys-module-file/edit/{id}', ['uses' => 'SysModuleFileController@open']);
Route::resource('sys-module-file', 'SysModuleFileController');