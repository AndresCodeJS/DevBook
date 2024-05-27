@extends('layouts.app')
@section('titulo')
    Perfil: {{$user->username}}
@endsection

@section('contenido')
    <div class="flex justify-center my-5">
        <div class="w-full md:w-8/12 lg:w-6/12 md:flex md:ml-20  items-center">
            <div class="w-full md:w-8/12 lg:w-6/12 p-5  flex justify-center">
                <img src="{{$user ->imagen? asset('perfiles') . '/' . $user ->imagen
                :asset('img/sin-perfil.jpg')}}" 
                class="rounded-full w-6/12 md:w-full "
                alt='Imagen Usuario'/>
            </div>
            <div class="md:w-8/12 lg:w-6/12 md:py-5 text-2xl flex flex-col items-center md:items-start">
                <div class=" w-2/12">
                    <div class="flex items-center gap-2">
                        <p class="font-bold flex py-2 ">{{$user -> username}}</p>
                        @auth
                            @if ($user->id == auth()->user()->id) 
                                <a href={{route('perfil.index')}}
                                class="cursor-pointer text-gray-700 hover:text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                    <path d="m5.433 13.917 1.262-3.155A4 4 0 0 1 7.58 9.42l6.92-6.918a2.121 2.121 0 0 1 3 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 0 1-.65-.65Z" />
                                    <path d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0 0 10 3H4.75A2.75 2.75 0 0 0 2 5.75v9.5A2.75 2.75 0 0 0 4.75 18h9.5A2.75 2.75 0 0 0 17 15.25V10a.75.75 0 0 0-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5Z" />
                                    </svg>
                                </a>
                            @endif
                        @endauth
                        
                    </div>

                    <p class=" flex  md:justify-start text-sm font-bold">
                        {{$user->followers->count()}}
                        <span class="mx-2">
                            {{-- {{$user->followers->count() == 1?"Seguidor":"Seguidores"}} --}}
                            @choice('Seguidor|Seguidores', $user->followers->count())
                        </span>
                    </p>
                    <p class=" flex  md:justify-start text-sm font-bold">
                        {{$user->following->count()}}
                        <span class="mx-2">
                            Siguiendo
                        </span>
                    </p>
                    <p class=" flex md:justify-start text-sm font-bold">
                        {{$user->posts()->count()}}
                        <span class="mx-2">
                            {{$user->posts->count()>1?"Posts":"Post"}}
                        </span>
                    </p>
                    @auth
                        @if($user->id !== auth()->user()->id)  
                            @if($user->checkFollower(auth()->user()))
                                
                                <form action={{route('users.unfollow', $user)}} method='POST'>
                                    @csrf
                                    @method('DELETE')
                                    <input 
                                    type="submit"
                                    value="Dejar de Seguir"
                                    class = "text-sm font-bold text-white bg-red-600 py-1 
                                            px-3 rounded-lg border cursor-pointer hover:bg-red-700"
                                    />
                                </form>
                            @else

                                <form action={{route('users.follow', $user)}} method='POST'>
                                    @csrf
        
                                    <input 
                                        type="submit"
                                        value="Seguir"
                                        class = "text-sm font-bold text-white bg-blue-600 py-1 
                                                px-3 rounded-lg border cursor-pointer hover:bg-blue-700"
                                    />
                                </form>

                            @endif   
                        @endif 
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <section class="container mx-auto mt-10">
        <h2 class="font-black text-3xl flex justify-center mb-6">
            Publicaciones
        </h2>
        @if($posts -> count())
            <div class = "grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 px-10">
                @foreach ($posts as $post)
                <a href={{route("posts.show",["user"=>$user, "post"=> $post])}}>
                    <img src = "{{asset("uploads") .'/'. $post -> imagen}}" alt = "Imagen del post {{$post -> titulo}}"/>
                </a>
                @endforeach
            </div>
        @else
            <div>
                <p class="uppercase text-sm text-center font-bold text-gray-700
                mb-10">
                    No hay Publicaciones
                </p>
            </div>
        @endif
        <div class = "mt-10 px-10">
            {{$posts ->links()}}
        </div>
    </section>
@endsection