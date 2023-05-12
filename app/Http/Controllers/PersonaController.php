<?php

namespace App\Http\Controllers;

use App\Models\persona;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data=persona::all(); 
        return response()->json($data);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $post = new Persona();
    $post->nombre = $request->nombre;
    $post->codigo = $request->codigo;
    $post->descripcion = $request->descripcion;
    $post->save();
    }


    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
      $persona= persona::all()->find($id);
      return response()-> json($persona);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        
        $request->validate([
            'nombre' => 'required',
            'codigo' => 'required',
            'descripcion' => 'required',
           
        ]);
        $personaActualizar=persona::findOrFail($id);

           $personaActualizar-> nombre=$request->nombre;
            $personaActualizar-> codigo=$request->codigo;
            $personaActualizar-> descripcion=$request->descripcion;

          $personaActualizar-> save();
        return response()->json(['message' => 'Persona actualizada correctamente']);
        
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $persona)
    {
        $personaEliminar=persona::findOrFail($persona);
        $personaEliminar->delete();
        return response()->json(['message'=>'persona fue eliminada']);
    }
}
