<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class FollowerController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
             /* 'auth', */
            /* new Middleware('auth', only: ['create']), */
            new Middleware('auth')
        ];
    }


    public function store(User $user){

        $user->followers()->attach( auth()->user()->id);

        return back();
    }

    public function destroy(User $user){
        $user->followers()->detach(auth()->user()->id);

        return back();
    }
}
