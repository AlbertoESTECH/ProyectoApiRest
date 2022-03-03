<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Transformers\PrestamoTransformer;

class Prestamo extends Model
{
    public $transformer = PrestamoTransformer::class;

    protected $table = 'prestamos';
    
    protected $fillable = [
        'usuario_id', 'libro_id',
    ];

    protected $hidden = ['pivot'];

    public function usuario(){
        return $this->belongsTo(Usuario::class);
    }

    public function libro(){
        return $this->belongsTo(Libro::class);
    }

}
