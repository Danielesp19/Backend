<?php

namespace App\Http\Controllers;

use App\Http\Resources\ServiceCollection;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
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

        $services = Service::orderBy($sort, $type)->get();

        return new ServiceCollection($services);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
        ]);

        $service = Service::create($validatedData);

        return new ServiceResource($service);
    }

    public function show(Service $service)
    {
        return new ServiceResource($service);
    }

    public function update(Request $request, Service $service)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string|max:1000',
        ]);

        $service->update($validatedData);

        return (new ServiceResource($service))->response()->setStatusCode(200);
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return response(null, 204);
    }
}
