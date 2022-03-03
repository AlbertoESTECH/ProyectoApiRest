<?php

namespace App\Http\Controllers\Libro;

use App\Libro;
use App\Usuario;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LibroUsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Libro  $libro
     * @return \Illuminate\Http\Response
     */
    public function index(Libro $libro)
    {
        $usuarios =  $libro->prestamos()
        ->with('usuario')
        ->get()
        ->pluck('usuario');
        return $this->showAll($usuarios);
    }

}
