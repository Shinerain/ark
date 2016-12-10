<?php
/**
 * Created by PhpStorm.
 * User: john
 * Date: 2016-12-06
 * Time: 21:58
 */

Route::get('/', function () {
	return view('welcome');
});

Route::resource('home', 'HomeController');

