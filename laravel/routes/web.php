<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'MainController@index')-> name('posts-index');
