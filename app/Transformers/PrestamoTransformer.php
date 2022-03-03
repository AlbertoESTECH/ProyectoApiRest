<?php

namespace App\Transformers;

use App\Prestamo;
use League\Fractal\TransformerAbstract;

class PrestamoTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        //
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Prestamo $prestamo)
    {
        return [
            'identificador' => (int)$prestamo->id,
            'usuario' => (string)$prestamo->usuario_id,
            'libro' => (string)$prestamo->libro_id,
            'fechaCreacion' => (string)$prestamo->created_at,
            'fechaActualizacion' => (string)$prestamo->updated_at,
            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('prestamos.show', $prestamo->id),
                ],
                [
                    'rel' => 'usuarios',
                    'href' => route('usuarios.show', $prestamo->usuario_id),
                ],
                [
                    'rel' => 'libros',
                    'href' => route('libros.show', $prestamo->libro_id),
                ],
            ],
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            'identificador' => 'id',
            'usuario' => 'usuario_id',
            'libro' => 'libro_id',
            'fechaCreacion' => 'created_at',
            'fechaActualizacion' => 'updated_at',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    public static function transformedAttribute($index)
    {
        $attributes = [
            'id' => 'identificador',
            'usuario_id' => 'usuario',
            'libro_id' => 'libro',
            'created_at' => 'fechaCreacion',
            'updated_at' => 'fechaActualizacion',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
