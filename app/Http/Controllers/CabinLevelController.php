<?php

namespace App\Http\Controllers;

use App\Http\Resources\CabinLevelCollection;
use App\Http\Resources\CabinLevelResource;
use App\Models\CabinLevel;
use Illuminate\Http\Request;

class CabinLevelController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'name');
        $type = $request->input('type', 'asc');

        $validSort = ['name', 'description'];
        $validType = ['desc', 'asc'];

        if (! in_array($sort, $validSort)) {
            return response()->json(['error' => "Invalid sort field: $sort"], 400);
        }

        if (! in_array($type, $validType)) {
            return response()->json(['error' => "Invalid sort type: $type"], 400);
        }

        $cabinLevels = CabinLevel::orderBy($sort, $type)->get();

        return new CabinLevelCollection($cabinLevels);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
        ]);

        $cabinLevel = CabinLevel::create($validatedData);

        return new CabinLevelResource($cabinLevel);
    }

    public function show(CabinLevel $cabinLevel)
    {
        return new CabinLevelResource($cabinLevel);
    }

    public function update(Request $request, CabinLevel $cabinLevel)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string|max:1000',
        ]);

        $cabinLevel->update($validatedData);

        return (new CabinLevelResource($cabinLevel))->response()->setStatusCode(200);
    }

    public function destroy(CabinLevel $cabinLevel)
    {
        $cabinLevel->delete();

        return response(null, 204);
    }
}
