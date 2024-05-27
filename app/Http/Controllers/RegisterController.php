<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    public function index()
    {
        return view('auth.registro');
    }

    public function store(Request $request)
    {
        //dd($request->get('username'));

        //Modificar el request
        //lo cambia antes de hacer la validacion para que pueda comparar contra el valor en la base de datos
        $request->request->add(['username' => Str::slug($request->username)]);

        //Validaion
        $request->validate([
            'nombre' => ['required', 'min:5', 'max:15'],
            'username' => ['required', 'min:5', 'max:10', 'unique:users'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:6'],
            'password_confirmation' => ['required']
        ]);

        User::create([
            'name' => $request->nombre,
            'email' => $request->email,
            'password' => $request->password,
            'username' => $request->username
        ]);

        auth()->attempt($request->only('email','password'));

        return redirect() -> route("posts.index",["user"=>$request->username]);
    }
}
