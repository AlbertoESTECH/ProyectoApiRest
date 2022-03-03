<?php

use App\Libro;
use App\Usuario;
use App\Prestamo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Libro::truncate();
        Usuario::truncate();
        Prestamo::truncate();


        $cantUsuarios = 100;
        factory(Usuario::class, $cantUsuarios)->create();


        $cantLibros = 200;
        factory(Libro::class, $cantLibros)->create();

        $cantPrestamos = 400;
        factory(Prestamo::class,$cantPrestamos)->create();

        Schema::enableForeignKeyConstraints();
    }
}
