<?php

namespace App;

use App\Transformers\LibroTransformer;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    public $transformer = LibroTransformer::class;

    protected $table = 'libros';

    protected $fillable = [
        'title', 'description',
    ];

    public function prestamos()
    {
        return $this->hasMany(Prestamo::class);
    }
}
