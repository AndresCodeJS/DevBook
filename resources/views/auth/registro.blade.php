@extends('layouts.app')
@section('titulo')
    Crear Cuenta
@endsection

@section('contenido')
<div class="flex justify-center">
    <form action = {{route("register")}} method="POST" class = "w-10/12 sm:w-6/12 lg:w-5/12 my-7 p-5
     bg-white rounded-lg shadow-lg" novalidate>
     @csrf
        <div class = "mb-5 w-full">
            <label for="nombre" class="text-sm mb-2 block uppercase text-gray-500 font-bold">
                Nombre
            </label>
            <input
                id="nombre"
                name="nombre"
                type="text"
                placeholder="Tu Nombre"
                class="w-full rounded-md border p-2 @error('nombre')
                    border-red-500
                @enderror"
                value = "{{old("nombre")}}"
            /> 
            @error('nombre')
              <p class="mt-3 text-red-400 text-xs">{{$message}}</p>  
            @enderror
        </div>
        <div class = "mb-5 w-full">
            <label for="username" class="text-sm mb-2 block uppercase text-gray-500 font-bold">
                Username
            </label>
            <input
                id="username"
                name="username"
                type="text"
                placeholder="Nombre de Usuario"
                class="w-full rounded-md border p-2 @error('username')
                border-red-500 @enderror"  
                value = "{{old("username")}}"
            /> 
            @error('username')
            <p class="mt-3 text-red-400 text-xs">{{$message}}</p>  
            @enderror
        </div>
        <div class = "mb-5 w-full">
            <label for="email" class="text-sm mb-2 block uppercase text-gray-500 font-bold">
                Email
            </label>
            <input
                id="email"
                name="email"
                type="email"
                placeholder="Correo electrónico"
                class="w-full rounded-md border p-2 @error('email')
                border-red-500  @enderror"
                value = "{{old("email")}}"
            /> 
            @error('email')
            <p class="mt-3 text-red-400 text-xs">{{$message}}</p>  
            @enderror
        </div>
        <div class = "mb-5 w-full">
            <label for="password" class="text-sm mb-2 block uppercase text-gray-500 font-bold">
                Password
            </label>
            <input
                id="password"
                name="password"
                type="password"
                placeholder="Introduce una contraseña"
                class="w-full rounded-md border p-2 @error('password')
                border-red-500 @enderror"
                value = "{{old("password")}}"
            /> 
            @error('password')
            <p class="mt-3 text-red-400 text-xs">{{$message}}</p>  
            @enderror
        </div>
        <div class = "mb-5 w-full">
            <label for="password_confirmation" class="text-sm mb-2 block uppercase text-gray-500 font-bold">
                Repetir Password
            </label>
            <input
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                placeholder="Repite la contraseña"
                class="w-full rounded-md border p-2 @error('password_confirmation')
                border-red-500 @enderror"
                value = "{{old("password_confirmation")}}"
            /> 
            @error('password_confirmation')
            <p class="mt-3 text-red-400 text-xs">{{$message}}</p>  
            @enderror
        </div>
        <input
            type="submit"
            value="Crear Cuenta"
            class="w-full bg-sky-600 rounded-lg text-white font-bold p-3
            uppercase mt-5 cursor-pointer hover:bg-sky-700"
        />
    </form>
</div>
@endsection