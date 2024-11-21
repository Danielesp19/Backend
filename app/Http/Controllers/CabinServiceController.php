<?php

namespace App\Http\Controllers;

use App\Http\Resources\CabinServiceCollection;
use App\Http\Resources\CabinServiceResource;
use App\Models\CabinService;
use Illuminate\Http\Request;

class CabinServiceController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'cabin_id');
        $type = $request->input('type', 'asc');

        $validSort = ['cabin_id', 'service_id'];
        $validType = ['desc', 'asc'];

        if (! in_array($sort, $validSort)) {
            return response()->json(['error' => "Invalid sort field: $sort"], 400);
        }

        if (! in_array($type, $validType)) {
            return response()->json(['error' => "Invalid sort type: $type"], 400);
        }

        $cabinServices = CabinService::orderBy($sort, $type)->get();

        return new CabinServiceCollection($cabinServices);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'cabin_id' => 'required|exists:cabins,id',
            'service_id' => 'required|exists:services,id',
        ]);

        $cabinService = CabinService::create($validatedData);

        return new CabinServiceResource($cabinService);
    }

    public function show(CabinService $cabinService)
    {
        return new CabinServiceResource($cabinService);
    }

    public function update(Request $request, CabinService $cabinService)
    {
        $validatedData = $request->validate([
            'cabin_id' => 'sometimes|required|exists:cabins,id',
            'service_id' => 'sometimes|required|exists:services,id',
        ]);

        $cabinService->update($validatedData);

        return (new CabinServiceResource($cabinService))->response()->setStatusCode(200);
    }

    public function destroy(CabinService $cabinService)
    {
        $cabinService->delete();

        return response(null, 204);
    }
}
