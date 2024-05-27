<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //invoke se usa cuando solo usamos un metodo en el controlador,  entonces invoke se ejecuta por defecto
    //Y en la llamada a la ruta se colca solo el nombre del contrololador, sin especificar metodo
    public function __invoke(){

        $friendsPosts = false;

        if(auth()->user()){
            $ids = auth()->user()->following->pluck('id')->toArray();
            $posts = Post::whereIn('user_id', $ids)->latest()->paginate(20);
        }else{
            $posts = Post::paginate(10);
        }

        if(!$posts->count()){
            //Latest se usa para devolver los registros mas recientes
            $posts = Post::latest()->paginate(10);
        }else{
            $friendsPosts =true;
        }

        return view("home", ['posts' => $posts, 'friendsPosts' => $friendsPosts]);
    }
}
