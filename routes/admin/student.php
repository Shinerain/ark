<?php
Route::get('student/pagination', ['uses' => 'StudentController@pagination']);
Route::resource('student', 'StudentController');