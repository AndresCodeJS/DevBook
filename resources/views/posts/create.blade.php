@extends('layouts.app')
@section('titulo')
    Crear Nueva Publicación
@endsection

 <!-- Push es usado para para que una hoja de estilos sea usada unicamente en el archivo que se necesita
    En este caso es usada en este archivo y fue stackeada en el archivo app.blade-->
@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('contenido')

    <div class="flex justify-center my-5 ">
        <div class="w-full md:w-8/12 lg:w-6/12 flex items-center flex-col md:flex-row md:ml-20 gap-5">
            <div class="h-full flex justify-center items-center w-full md:w-8/12 lg:w-6/12   ">
                <form action={{route("imagen.store")}} method = "POST" id="dropzone" class = "dropzone border-2 border-dashed h-56 md:h-72 w-6/12 md:w-full rounded
                flex flex-col justify-center items-center" >
                @csrf
                </form>
            </div>
            <div class="w-full md:w-8/12 lg:w-6/12 md:py-5 text-2xl flex flex-col items-center ">
                    <form action = {{route("posts.store")}} method="POST" class = " w-6/12 md:w-full p-5 bg-white rounded shadow-lg" novalidate>
                     @csrf
                        <div class = "mb-5 w-full">
                            <label for="titulo" class="text-xs mb-2 block uppercase text-gray-500 font-bold">
                                Titulo
                            </label>
                            <input
                                id="titulo"
                                name="titulo"
                                type="text"
                                placeholder="Título de la Publicación"
                                class="w-full rounded-md border p-2 text-sm text-gray-700 @error('nombre')
                                    border-red-500
                                @enderror"
                                value = "{{old("titulo")}}"
                            /> 
                            @error('titulo')
                              <p class="mt-3 text-red-400 text-xs">{{$message}}</p>  
                            @enderror
                        </div>
                        <div class = "mb-5 w-full">
                            <label for="descripcion" class="text-xs mb-2 block uppercase text-gray-500 font-bold">
                                Descripcion
                            </label>
                            <textarea
                                id="descripcion"
                                name="descripcion"
                                placeholder="Descripción de la Publicación"
                                class="w-full rounded-md border p-2 text-sm text-gray-700 @error('nombre')
                                    border-red-500
                                @enderror" 
                            >{{old("descripcion")}}</textarea>
                            
                            @error('descripcion')
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
                            value="Publicar"
                            class="w-full bg-sky-600 rounded-lg text-white text-sm font-bold p-3
                            uppercase cursor-pointer hover:bg-sky-700"
                        />
                    </form>
            </div>
        </div>
    </div>
@endsection