<?php

namespace App\Http\Controllers\Usuario;

use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Transformers\UsuarioTransformer;
use App\Http\Controllers\Controller;

class UsuarioController extends Controller
{
    public function __construct()
	{
		$this->middleware('transform.input:' . UsuarioTransformer::class)->only(['store', 'update']);
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->showAll(Usuario::all());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required|min:6',
        ];
        $messages = [
            'required' => 'El campo :attribute es obligatorio.',
            'email.required' => 'El campo correo no tiene el formato adecuado.',
            'password' => 'La contraseña es campo obligatorio',
        ];
        $validatedData = $request->validate($rules, $messages);
        $validatedData['password'] = bcrypt($validatedData['password']);
        $usuario = Usuario::create($validatedData);
        return $this->showOne($usuario,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(Usuario $usuario)
    {
        return $this->showOne($usuario);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuario $usuario)
    {
        $rules = [
            'name' => 'min:5|max:255',
            'email' => ['email', Rule::unique('usuarios')->ignore($usuario->id)],
            'password' => 'min:6', // si no hacemos ninguna validacion para este, debemos ponerle '' aunque sea para tenerlo disponible en la vista
        ];

        $messages = [
            'email.unique' => "Ese correo ya está usado",
            'email.email' => "El campo :attribute no tiene el formato correcto",
            'password.min' => "El campo :attribute debe tener un mínimo de 6 carñacteres"
        ];
        $validatedData = $request->validate($rules, $messages);

        if ($request->filled('password')){
            $validatedData['password'] = bcrypt($request->input('password'));
        }

        $usuario->fill($validatedData);

        if(!$usuario->isDirty()){
            return response()->json(['error'=>['code' => 422, 'message' => 'Especifica al menos un valor diferente' ]], 422);
        }
        $usuario->save();
        return $this->showOne($usuario);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuario $usuario)
    {
        $usuario->delete();
        return $this->showOne($usuario);
    }
}
