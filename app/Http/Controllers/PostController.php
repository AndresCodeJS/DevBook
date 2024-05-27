<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class PostController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
             /* 'auth', */
            /* new Middleware('auth', only: ['create']), */
            new Middleware('auth', except: ['show', 'index']),
        ];
    }


    public function index(User $user){

        //Metodo convencional
        /* $posts = Post::where('user_id', $user->id)->get(); */

        //Metodo para paginado
        $posts = Post::where('user_id', $user->id)->paginate(20);

        return view('dashboard', [
            "user" => $user,
            'posts' => $posts
        ]);
    }

    public function create(){
       return view('posts.create');
    }

    public function store(Request $request){

         //Validaion
         $request->validate([
            'titulo' => ['required','max:255'],
            'descripcion' => ['required'],
            'imagen' => ['required']
        ]);

        Post::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);

        //Otra forma de crear un registro
        /* $post = new Post;
        $post->titulo =$request->titulo;
        $post->descripcion = $request->descripcion;
        $post->imagen = $request->imagen;
        $post->save(); */

        //Otra forma de crear registros

       /*  $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]); */

        return redirect() -> route("posts.index",["user" =>auth()->user()->username]);
    }

    public function show(User $user, Post $post){

        return view('posts.show', [
            "user" => $user,
            'post' => $post
        ]);
    }

    public function destroy(Post $post){
        
        //Policy usada para evitar que un usuario borre un post del cual no sea propietario
        if (!Gate::allows('delete', $post)) {
            abort(403);
        }
        
        $post->delete();

        //Eliminando la imagen asociada

        $imagen_path = public_path('uploads/' . $post->imagen);

        if(File::exists($imagen_path)){
            unlink($imagen_path);
        }

        return redirect() -> route("posts.index",["user" =>auth()->user()->username]);
    }
}
