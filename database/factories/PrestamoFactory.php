<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Usuario;
use App\Libro;
use App\Prestamo;
use Faker\Generator as Faker;

$factory->define(Prestamo::class, function (Faker $faker) {
    $usuario = Usuario::all()->random();
    $libro = Libro::all()->random();
    return [
        'usuario_id' => $usuario->id,
        'libro_id' => $libro->id,
    ];
});
