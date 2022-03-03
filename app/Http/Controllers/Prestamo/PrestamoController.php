<?php

namespace App\Http\Controllers\Prestamo;

use App\Prestamo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transformers\PrestamoTransformer;

class PrestamoController extends Controller
{

    public function index()
    {
        return $this->showAll(Prestamo::all());
    }

    public function store(Request $request)
    {
        $rules = [
            'usuario_id' => 'required|exists:usuarios,id',
            'libro_id' => 'required|exists:libros,id',
        ];
        $messages = [
            'usuario_id.required' =>  'Es necesario especificar un usuario',
            'libro_id.required' => 'Es necesario especificar un libro',
            'usuario_id.exists' => 'No existe un usuario con ese valor',
            'libro_id.exists' => 'No existe un libro con ese valor',
        ];
        $validatedData = $request->validate($rules, $messages);
        $prestamo = Prestamo::create($validatedData);
        return $this->showOne($prestamo,201);
    }

    public function show(Prestamo $prestamo)
    {
        return $this->showOne($prestamo, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prestamo $prestamo)
    {
        $prestamo->delete();
        return $this->showOne($prestamo);
    }
}
