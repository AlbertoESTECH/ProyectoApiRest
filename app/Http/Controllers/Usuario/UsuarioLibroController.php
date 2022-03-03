<?php

namespace App\Http\Controllers\Usuario;

use App\Libro;
use App\Usuario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsuarioLibroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function index(Usuario $usuario)
    {
        $libros =  $usuario->prestamos()
        ->with('libro')
        ->get()->pluck('libro');
        return $this->showAll($libros);
    }


}
