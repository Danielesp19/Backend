<?php

namespace App\Http\Controllers;


use App\Models\Cabin;
use Illuminate\Http\Request;

use App\Http\Resources\CabinCollection;
use App\Http\Requests\CabinStoreRequest;
use App\Http\Requests\CabinUpdateRequest;
use App\Http\Resources\CabinResource;

class CabinController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'name');
        $type = $request->input('type', 'asc');

        $validSort = ["name", "cabinlevel_id", "capacity"];
        $validType = ["desc", "asc"];

        if (!in_array($sort, $validSort)) {
            return response()->json(['error' => "Invalid sort field: $sort"], 400);
        }

        if (!in_array($type, $validType)) {
            return response()->json(['error' => "Invalid sort type: $type"], 400);
        }

        $cabins = Cabin::orderBy($sort, $type)->get();

        return new CabinCollection($cabins);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(CabinStoreRequest $request)
{
    
        $validatedData = $request->validated();
        $validatedData['busy'] = false;
       
        $cabin = Cabin::create($validatedData);

        return new CabinResource($cabin);
        
}


    /**
     * Display the specified resource.
     */
    public function show(Cabin $cabin)
    {
        return new CabinResource($cabin);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CabinUpdateRequest $request, Cabin $cabin)
{
    
    $validatedData = $request->validated();

    $cabin->update($request->all());

    return (new CabinResource($cabin))
        ->response()
        ->setStatusCode(200);
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

    public function index2(Request $request)
    {
        $sort = $request->input('sort', 'name');
        $type = $request->input('type', 'asc');

        $validSort = ["name", "cabinlevel_id", "capacity"];
        $validType = ["desc", "asc"];

        if (!in_array($sort, $validSort)) {
            return response()->json(['error' => "Invalid sort field: $sort"], 400);
        }

        if (!in_array($type, $validType)) {
            return response()->json(['error' => "Invalid sort type: $type"], 400);
        }

        $cabins = Cabin::orderBy($sort, $type)->get();

        return new CabinCollection($cabins);
    }
}
