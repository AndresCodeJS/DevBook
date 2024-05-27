<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];

     //Opcion 1
     //Relaciones entre tablas
     public function user(){
        return $this->belongsTo(User::class)->select(['name','username']);
     }

    //Opcion 2
    //Tambien podria funcionar de la siguiente manera pero no seguiria las convenciones de laravel
    public function autor(){
        return $this->belongsTo(User::class,"user_id")->select(['name','username']);

        //con user_id le estamos diciendo que se relacione con la tabla user mediante el campo user_id
    }

    //Relacion con comentarios

    public function comentarios(){
        return $this->hasMany(Comentario::class)->select(['comentario','user_id','created_at']);
    }

    //Relacion con likes

    public function likes(){
        return $this->hasMany(Like::class)->select(['user_id','created_at']);
    }

    public function checkLike(User $user){
        return $this->likes->contains("user_id", $user->id);
    }

}
