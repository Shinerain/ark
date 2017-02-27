<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2016-12-06
 * Time: 21:58
 */
Route::get('/', ['uses' => 'HomeController@index']);

Route::resource('home', 'HomeController');
Route::get('sys-module/pagination', ['uses' => 'SysModuleController@pagination']);
Route::any('sys-module/action', ['uses' => 'SysModuleController@action']);
Route::any('sys-module/gen-code', ['uses' => 'SysModuleController@genCode']);
Route::resource('sys-module', 'SysModuleController');
Route::resource('sys-column', 'SysColumnController');
Route::resource('sys-config', 'SysConfigController');



