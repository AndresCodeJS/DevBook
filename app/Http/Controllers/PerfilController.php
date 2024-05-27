<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PerfilController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            /* 'auth', */
            /* new Middleware('auth', only: ['create']), */
            new Middleware('auth'),
        ];
    }

    public function index(Request $request)
    {
        return view('perfil.index');
    }

    public function store(Request $request)
    {

        //Modificar el request
        //lo cambia antes de hacer la validacion para que pueda comparar contra el valor en la base de datos
        $request->request->add(['username' => Str::slug($request->username)]);

        $request->validate([
            'username' => [
                'required',
                'min:5',
                'max:10',
                'unique:users,username,' . auth()->user()->id, //si envio mi mi actual nombre de usuario no arroja error
                'not_in:perfil',
                //'in:vendedor,comprador' ->acepta solo los valores en in
            ],
        ]);

        if ($request->imagen) {

            $imagen = $request->file('imagen');

            $nombreImagen = Str::uuid() . "." . $imagen->extension();

            $manager = new ImageManager(new Driver());

            $imagenServidor = $manager::imagick()->read($imagen);
            $imagenServidor->cover(500, 500);

            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;

            $imagenServidor->save($imagenPath);
        }

        $user = User::find(auth()->user()->id);

        $user->username = $request->username;
        $user->imagen = $nombreImagen ?? auth()->user()->imagen ?? null;

        $user -> save();

        return redirect()->route("posts.index", ["user" => $user->username]);
    }
}
