<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function store(User $user, Post $post, Request $request){
        
         //Validaion
         $request->validate([
            'comentario' => ['required'],
        ]);

        //Almacenar comentario 

        Comentario::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post -> id,
            'comentario' =>  $request -> comentario,
        ]);

        //Mensaje
        return back()->with('mensaje', 'Se Ha guardado el comentario');
    }
}
