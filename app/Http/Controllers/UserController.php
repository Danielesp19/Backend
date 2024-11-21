<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Validator;

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

    $users = User::where('user_type', 'user')
                ->orderBy($sort, $type)
                ->get();

    return new UserCollection($users);
}

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'user_type' => 'required|in:admin,user', // Validación para que user_type sea admin o user
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => 'Error de validación',
                'message' => $validator->errors()
            ], 422);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->user_type = $request->user_type;
        $user->save();

        return response()->json($user, 201);
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

