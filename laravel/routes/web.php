<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'MainController@index')-> name('posts-index');
Route::post('/post/create','MainController@postCreate')-> name('post-create');
Route::post('/post/update/{id}', 'MainController@postUpdate')-> name('post-update');
Route::get('/post/destroy/{id}', 'MainController@postDestroy')-> name('post-destroy');
