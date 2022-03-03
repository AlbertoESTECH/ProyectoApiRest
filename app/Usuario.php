<?php

namespace App;


use App\Transformers\UsuarioTransformer;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $table = 'usuarios';

    public $transformer = UsuarioTransformer::class;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 
    ];

    public function prestamos()
    {
        return $this->hasMany(Prestamo::class);
    }

   public function getJWTIdentifier()
   {
       return $this->getKey();
   }

   public function getJWTCustomClaims()
   {
       return [];
   }
    
}
