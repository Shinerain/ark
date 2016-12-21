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
Route::resource('role', 'RoleController');
Route::resource('permission', 'PermissionController');
Route::resource('sys-module', 'SysModuleController');
Route::resource('sys-table', 'SysTableController');
Route::resource('sys-column', 'SysColumnController');
Route::resource('sys-config', 'SysConfigController');

