<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class MainController extends Controller
{
    public function index(){
        $posts=Post::all();
        return view('pages.posts-index', compact('posts'));
    }
    public function postUpdate(Request $request, $id){
        $post =Post::findOrFail($id);
        $post-> update($request-> all());
        return response()-> json('post ' . $id . ' was updated ' . 200);       //il 200 rappresenta il risultato e significa che è tutto ok     
    }
}

 