@extends('layouts.app')
@section('titulo')    
        {{$friendsPosts?'Ultimas publicaciones de tus amigos':'Ultimas publicaciones de usuarios'}}   
@endsection
@section('contenido')
    @if($posts -> count())
        <div class = "grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 px-10 mb-20 mt-10">
            @foreach ($posts as $post)
            <div class="flex flex-col gap-5 items-center">
                <p class = "font-bold text-xl text-gray-700 mt-10">
                    {{$post->titulo}}
                    <a class ="text-md font-thin text-gray-800 hover:text-blue-500" 
                       href={{route("posts.index", $post->user)}}>
                        {{' - ' . $post->user->username}}
                    </a>
                </p>

                <a href={{route("posts.show",["user"=>$post->user, "post"=> $post])}}>
                    <img src = "{{asset("uploads") .'/'. $post -> imagen}}" alt = "Imagen del post {{$post -> titulo}}"/>
                </a>
                
            </div>
            @endforeach
        </div>
        @else
        <div>
            <p class="uppercase text-sm text-center font-bold text-gray-700
            mb-10 my-20" >
                No hay Publicaciones - Sigue a mas personas para ver sus publicaciones
            </p>
        </div>
    @endif
@endsection