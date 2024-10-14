<?php

namespace App\Http\Controllers;

use App\Models\Cabin;
use Illuminate\Http\Request;

class CabinController extends Controller
{
    public function index()
    {
        $cabin = Cabin::orderBy('name', 'asc')->get();
        return response()->json(['data' => $cabin], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    try {
        // Validar los datos que llegan
        $validatedData = $request->validate([
            'name' => 'required|string|max:50',
            'capacity' => 'required|integer|min:1',
            'cabinlevel_id' => 'required|exists:cabin_levels,id',
        ]);

        // Crear la cabina con los datos validados
        $cabin = Cabin::create($validatedData);

        // Retornar respuesta exitosa en JSON
        return response()->json(['data' => $cabin], 201);
    
    } catch (\Exception $e) {
        // Atrapar cualquier excepción y devolver un JSON con el error
        return response()->json([
            'error' => 'Error al crear la cabina',
            'message' => $e->getMessage(), // Mensaje del error
            'file' => $e->getFile(), // Archivo donde ocurrió
            'line' => $e->getLine(), // Línea donde ocurrió
        ], 500);
    }
}


    /**
     * Display the specified resource.
     */
    public function show(Cabin $cabin)
    {
        return response()->json(['data' => $cabin], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cabin $cabin)
    {
        $cabin->update($request->all());
        return response()->json(['data' => $cabin], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cabin $cabin)
    {
        //
        $cabin->delete();
         return response(null, 204);

    }
}
