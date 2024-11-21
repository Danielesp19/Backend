<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    public function index(Request $request)
{
    $sort = $request->input('sort', 'name');
    $type = $request->input('type', 'asc');

    $validSort = ['name', 'email', 'user_type'];
    $validType = ['desc', 'asc'];

    if (!in_array($sort, $validSort)) {
        return response()->json(['error' => "Invalid sort field: $sort"], 400);
    }

    if (!in_array($type, $validType)) {
        return response()->json(['error' => "Invalid sort type: $type"], 400);
    }

    // Filtra solo a los usuarios con `user_type = 'employee'`
    $users = User::where('user_type', 'employee')
                ->orderBy($sort, $type)
                ->get();

    return new UserCollection($users);
}

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

    public function show(User $user)
    {
        return new UserResource($user);
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:users,email,' . $user->id,
            'password' => 'sometimes|required|string|min:8',
            'user_type' => 'sometimes|required|string|in:admin,customer',
        ]);

        if (isset($validatedData['password'])) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        }

        $user->update($validatedData);
        return (new UserResource($user))->response()->setStatusCode(200);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response(null, 204);
    }

    
}

