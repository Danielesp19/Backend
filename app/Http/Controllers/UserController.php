<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::orderBy('name', 'asc')->get();
        return response()->json(['data' => $user], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $user = User::create($request->all());
            return response()->json(['data'=>$user],201);
        }
        catch (\Exception $e) {
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
    public function show(User $user)
    {
        return response()->json(['data' => $user], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        return response()->json(['data' => $user], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
        $user->delete();
         return response(null, 204);

    }
}
