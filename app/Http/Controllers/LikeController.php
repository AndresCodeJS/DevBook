<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $request, Post $post){

        Like::create([
            "user_id" => $request->user()->id,
            //o "user_id" => auth()->user()->id
            "post_id" => $post->id
        ]);

        //Otra opcion para guardar el like (borrar de fillable el post_id en el archivo Models/Post.php)
       /*  $post->likes()->create([
            'user_id' => $request->user()->id
        ]); */

        return back();

    }

    public function destroy(Request $request, Post $post){

        $request->user()->likes()->where('post_id',$post->id)->delete();

        //Otra opcion

        /* Like::where('post_id', '=', $post->id )
                 ->where('user_id', '=',  $request->user()->id)
                 ->delete(); */

        return back();
    }
}
