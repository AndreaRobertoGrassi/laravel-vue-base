<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'MainController@index')-> name('posts-index');
Route::post('/post/update/{id}', 'MainController@postUpdate')-> name('post-update');
