@extends('layouts.app')
@section('titulo')
    Inicio de Sesión
@endsection

@section('contenido')
<div class="flex justify-center">
    <form  action = "{{route('login')}}" method= 'POST' class = "w-8/12 sm:w-5/12 lg:w-4/12 my-7 p-5
     bg-white rounded-lg shadow-lg" novalidate>
     @csrf
        
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
        <div class='flex  text-gray-500 ml-3'>
            <input type="checkbox" name='remember' />
            <label class='ml-3'>Manter la sesión abierta</label>
        </div>
       
        <input
            type="submit"
            value="Iniciar Sesión"
            class="w-full bg-sky-600 rounded-lg text-white font-bold p-3
            uppercase mt-5 cursor-pointer hover:bg-sky-700"
        />
        @if (session('mensaje'))
            <p class="mt-5 text-red-400 text-xs">
                {{session('mensaje')}}
            </p>
        @endif
    </form>
</div>
@endsection