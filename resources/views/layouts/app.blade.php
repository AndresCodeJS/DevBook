<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('titulo')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

         <!-- stack es usado para para que una hoja de estilos sea usada unicamente en el archivo que se necesita
              En este caso es usada en el archivo create.blade con la directiva Push-->
         @stack('styles')

        <!-- Styles -->
        @vite('resources/css/app.css')
        @vite('resources/js/app.js')

        @livewireStyles
    </head>
    <body class="bg-gray-100">
        <header class="p-5 border-b bg-white shadow">
            <div class = "container mx-auto flex justify-between items-center">
                
                    <a href={{route("home")}} class = " font-black flex text-xl md:text-2xl">
                        DevBook
                    </a>
                
                    <nav class="flex gap-5 items-center">
                        @auth
                            <a class="uppercase border rounded py-1 px-3 ml-5 font-bold text-xs shadow flex items-center gap-2" href={{route("posts.create")}}>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                <span class ="hidden md:block">Crear</span>
                            </a>
                            <a href={{route("posts.index",["user"=>auth()->user()])}} class="font-bold  text-gray-600 text-sm"> 
                                Hola: 
                                <span class='font-bold capitalize text-gray-600 text-sm'> 
                                    {{auth()->user()->username}}
                                </span>
                            </a>
                            <form method="POST" action="{{route('logout')}}">
                                @csrf
                                <button class = "font-bold uppercase text-gray-600 text-xs md:text-sm ">
                                    Cerrar Sesión
                                </button>
                            </form>
                        @endauth

                        @guest
                            <a class = "font-bold uppercase text-gray-600 text-sm" href={{route("login")}} >Login</a>
                            <a class = "font-bold uppercase text-gray-600 text-sm" href={{route("register")}} >Crear cuenta</a>
                        @endguest
                    </nav>              
            </div>
        </header>

        <main class="mt-10 mx-auto">
            <h2 class="font-black text-3xl flex justify-center">
                @yield("titulo")
            </h2>
       
                @yield("contenido")  

            
        </main>

        <footer class ="uppercase text-center text-gray-600 p-5 font-bold">
            DevBook - Todos los derechos reservados {{now()->year}}
        </footer>

        @livewireScripts
    </body>
</html>