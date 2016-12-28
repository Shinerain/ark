<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2016-12-06
 * Time: 21:58
 */
Route::get('/', ['uses' => 'HomeController@index']);

Route::resource('home', 'HomeController');
Route::resource('user', 'UserController');
Route::resource('permission', 'PermissionController');
Route::get('sys-module/pagination', ['uses' => 'SysModuleController@pagination']);
Route::resource('sys-module', 'SysModuleController');
Route::get('sys-table/pagination', ['uses' => 'SysTableController@pagination']);
Route::resource('sys-table', 'SysTableController');
Route::resource('sys-column', 'SysColumnController');
Route::resource('sys-config', 'SysConfigController');



