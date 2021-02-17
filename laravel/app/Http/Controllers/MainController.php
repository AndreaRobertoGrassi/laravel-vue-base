<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(){
        $posts=Post::all();
        return view('pages.post-index', compact('posts'));
    }
}
