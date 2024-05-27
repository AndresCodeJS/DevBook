@extends('layouts.app')
@section('titulo')
    {{$post ->titulo}}
@endsection

{{-- Se puede usar tanto {{$post ->user->username }} , como $user->username
con {{$post ->user->username }} estamos enviando una consulta a la base de datos
con {{$user->username}} estamos usando la variable $user que mandamos por parametro --}}

@section('contenido')
{{-- seccion global --}}
<div class = "my-5 md:flex gap-6 p-10">
    {{-- imagen y datros de publicacion--}}
    <div class="w-full md:w-6/12 mb-10 flex flex-col ">
        <img style="border-radius: 2%" src = "{{asset("uploads") .'/'. $post -> imagen}}" alt = "Imagen del post {{$post -> titulo}}"/>
        <div class = "mt-5 flex gap-2">
            @auth
                {{-- @if ($post->checkLike(auth()->user())) --}}
                    <livewire:like-post :post="$post"/>
                    {{-- <form method="POST" action={{route('posts.likes.destroy', $post)}}>
                        @method('DELETE')
                        @csrf
                        <button type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                            </svg>
                        </button>
                    </form> --}}
                {{-- @else --}}
                  {{--   <form method="POST" action={{route('posts.likes.store', $post)}}>
                        @csrf
                        <button type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                            </svg>
                        </button>
                    </form> --}}
                {{-- @endif --}}
            @endauth

            {{-- <p class =" text-gray-600">{{$post->likes()->count()}}  <span>{{$post->likes()->count() > 1?'Likes':'Like'}}</span></p> --}}
        </div>
        
        
        <a href={{route("posts.index",$user)}} class = "mt-3 text-gray-700 font-bold text-lg">{{$user->username}}</a>
        <p class = "text-gray-700  text-xs ">{{$post->created_at->diffForHumans()}}</p>
        <p class = "text-gray-700  text-sm mt-3 ">{{$post->descripcion}}</p>
        @auth
            @if ($post->user_id == auth()->user()->id)
                <form action={{route('posts.destroy',$post)}} method='POST'>
                    @method('DELETE')
                    @csrf
                    <input
                        type="submit"
                        value="Eliminar"
                        class="font-bold bg-red-600 rounded text-white py-1 px-4 mt-6 mb-3 hover:bg-red-700 "
                    />
                
                </form>
            @endif
        @endauth

    </div>
    {{-- panel de comentarios --}}
    <div class="w-full md:w-6/12 mb-10  bg-white rounded shadow-lg flex flex-col 
    @auth justify-between @endauth justify-center">
        <div class = "flex flex-col max-h-[40rem] mt-5 items-center">
            {{-- @if ($post->comentarios->count())  --}}               
                <div class = "w-full p-5 @if ($post->comentarios->count())
                    overflow-y-scroll
                @endif  ">
                    @foreach ($post->comentarios as $comentario)
                        <div class =" border border-gray-200 rounded-xl mb-5 p-3">
                            <a href = {{route("posts.index",$comentario->user)}} class = "font-bold text-gray-600">
                                {{$comentario->user->username}}
                            </a>
                            <p>
                                {{$comentario->comentario}}
                            </p>
                            
                            <p class="text-xs mt-3 text-gray-700">
                                {{$comentario->created_at->diffForHumans()}}
                            </p>
                        </div>
                    
                    @endforeach
                </div>
           {{--  @endif --}}
        </div>
            @if (!$post->comentarios->count())
                <div class = "flex self-center">
                    <p class="p-5 text-gray-600">
                        Todavia no hay comentarios
                    </p>
                </div>
            @endif
        
        @auth   
            <form action = {{route("comentarios.store",["user"=>$user, "post"=> $post])}} method="POST" 
            class = " w-full lg:w-10/12  p-5  flex flex-col mt-5 " novalidate>
                @csrf
              
               <div class = "mb-5 w-full">
                   <label for="comentario" class="text-xs mb-2 block uppercase text-gray-500 font-bold">
                       Realiza un comentario
                   </label>
                   <textarea
                       id="comentario"
                       name="comentario"
                       placeholder="Añade un comentario"
                       class="w-full rounded-md border p-2 text-sm text-gray-700 @error('comentario')
                           border-red-500
                       @enderror" 
                   ></textarea>
                   
                   @error('comentario')
                     <p class="mt-3 text-red-400 text-xs">{{$message}}</p>  
                   @enderror
               </div>
               <div class="mb-5">
                   <input
                       name="imagen"
                       type ="hidden"
                       value = {{old("imagen")}}
                   />
                   @error('imagen')
                   <p class="mt-3 text-red-400 text-xs">{{$message}}</p>  
                    @enderror                                 
               </div>
               <input
                   type="submit"
                   value="Comentar"
                   class="w-full bg-sky-600 rounded-lg text-white text-sm font-bold p-3
                   uppercase cursor-pointer hover:bg-sky-700 "
               />
               @if (session('mensaje'))
                    <p class="mt-5 text-green-400 text-xs">
                        {{session('mensaje')}}
                    </p>
               @endif
           </form>
        @endauth  
    </div>
</div>
@endsection