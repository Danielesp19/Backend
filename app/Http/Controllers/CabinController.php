<?php

namespace App\Http\Controllers;


use App\Models\Cabin;
use Illuminate\Http\Request;

class CabinController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->input('sort','name');
        $type = $request->input('type','asc');
        
        $validSort = ["name","cabinlevel_id","capacity"];
        $validType = ["desc","asc"];

        if(! in_array($sort,$validSort)){
            $message="invalid sort field: $sort";
            return response()->json((['error'=>$message]),400);
        }

        if(! in_array($type,$validType)){
            $message="invalid sort field: $type";
            return response()->json((['error'=>$message]),400);
        }

        $cabin = Cabin::orderBy($sort, $type)->get();
        return response()->json(['data' => $cabin], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CabinStoreRequest $request)
{
    
       // Crear la cabina con los datos validados
       $cabin = Cabin::create($validatedData);

       // Retornar respuesta exitosa en JSON
       return response()->json(['data' => $cabin], 201);
        
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
