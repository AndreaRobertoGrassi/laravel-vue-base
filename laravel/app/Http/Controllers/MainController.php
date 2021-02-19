<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class MainController extends Controller
{
    public function index(){
        $posts=Post::orderBy('id','desc')-> get();
        return view('pages.posts-index', compact('posts'));
    }

    public function postCreate(Request $request){
        $post=Post::create($request -> all());
        return response()-> json($post, 200);
    }

    public function postUpdate(Request $request, $id){       //aggiorna il testo modificato
        $post =Post::findOrFail($id);
        $post-> update($request-> all());
        return response()-> json('post ' . $id . ' was updated ' . 200);       //il 200 rappresenta il risultato e significa che è tutto ok     
    }

    public function postDestroy($id){          //cancella la card
        $post =Post::findOrFail($id);
        $post-> delete();
        return response()-> json('post ' . $id . ' was deleted ' . 200);
    }
   
}

 