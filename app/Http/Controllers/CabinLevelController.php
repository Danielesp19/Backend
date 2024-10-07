<?php

namespace App\Http\Controllers;

use App\Models\CabinLevel;
use Illuminate\Http\Request;

class CabinLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Aquí usamos el modelo User, en lugar de una consulta SQL manual
        $cabinLevel = CabinLevel::all();  // Eloquent se encarga de generar la consulta SQL
        return response()->json($cabinLevel);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CabinLevel $cabinLevel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CabinLevel $cabinLevel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CabinLevel $cabinLevel)
    {
        //
    }
}
