<?php

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;


Route::post('sendcontact', 'App\Http\Controllers\User\UsersController@sendcontact')->name('enquiry');
