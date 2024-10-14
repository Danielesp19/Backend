<?php

namespace App\Http\Controllers;

use App\Models\CabinService;
use Illuminate\Http\Request;

class CabinServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cabinService = CabinService::orderBy('name', 'asc')->get();
        return response()->json(['data' => $cabinService], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $cabinService = CabinService::create($request->all());
        return response()->json(['data'=>$cabinService],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(CabinService $cabinService)
    {
        return response()->json(['data' => $cabinService], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CabinService $cabinService)
    {
        $cabinService->update($request->all());
        return response()->json(['data' => $cabinService], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CabinService $cabinService)
    {
        //
        $cabinService->delete();
         return response(null, 204);

    }
}
