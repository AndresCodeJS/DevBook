@extends('layouts.app')
@section('titulo')
    Editar Perfil: {{auth()->user()->username}}
@endsection

@section('contenido')
<div class="flex justify-center my-5 ">
    <form action = {{route("perfil.store")}} method="POST" 
         enctype="multipart/form-data"{{--  Se usa para poder enviar un archivo --}}
         class = "w-10/12 sm:w-6/12 lg:w-5/12 my-7 p-5
         bg-white rounded-lg shadow-lg" novalidate>
         @csrf
         <div class = "mb-5 w-full">
            <label for="username" class="text-sm mb-2 block uppercase text-gray-500 font-bold">
                Username
            </label>
            <input
                id="username"
                name="username"
                type="text"
                placeholder="Correo electrónico"
                class="w-full rounded-md border p-2 @error('username')
                border-red-500  @enderror"
                value = "{{auth()->user()->username}}"
            /> 
            @error('username')
            <p class="mt-3 text-red-400 text-xs">{{$message}}</p>  
            @enderror
        </div>
        <div class = "mb-5 w-full">
            <label for="username" class="text-sm mb-2 block uppercase text-gray-500 font-bold">
                Imagen de Perfil
            </label>
            <input
                id="imagen"
                name="imagen"
                type="file"
                class="w-full rounded-md border p-2"
                value = ""
                accept=".png, .jpeg, .jpg"
            /> 
        </div>
        <input
        type="submit"
        value="Guardar Cambios"
        class="w-full bg-sky-600 rounded-lg text-white font-bold p-3
        uppercase mt-5 cursor-pointer hover:bg-sky-700"
        />
    </form>
</div>
@endsection