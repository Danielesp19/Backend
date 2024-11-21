<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Resources\ReservationCollection;
use App\Http\Resources\ReservationResource;

class ReservationController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'start_date');
        $type = $request->input('type', 'asc');

        $validSort = ['start_date', 'end_date', 'user_id', 'cabinservice_id'];
        $validType = ['desc', 'asc'];

        if (!in_array($sort, $validSort)) {
            return response()->json(['error' => "Invalid sort field: $sort"], 400);
        }

        if (!in_array($type, $validType)) {
            return response()->json(['error' => "Invalid sort type: $type"], 400);
        }

        $reservations = Reservation::orderBy($sort, $type)->get();
        return new ReservationCollection($reservations);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
        'cabinservice_id' => 'required',
        'user_id' => 'required',
        'start_date' => 'required|date|after_or_equal:today', // Validación de fecha de inicio
        'end_date' => 'required|date|after:start_date', // Validación de fecha de fin (debe ser después de la fecha de inicio)
    ]);

        $reservation = Reservation::create($validatedData);
        return new ReservationResource($reservation);
    }

    public function show(Reservation $reservation)
    {
        return new ReservationResource($reservation);
    }

    public function update(Request $request, Reservation $reservation)
    {
        $validatedData = $request->validate([
            'cabinservice_id' => 'sometimes|required|exists:cabinservice,id',
            'user_id' => 'sometimes|required|exists:users,id',
            'start_date' => 'sometimes|required|date|after_or_equal:today',
            'end_date' => 'sometimes|required|date|after:start_date',
        ]);

        $reservation->update($validatedData);
        return (new ReservationResource($reservation))->response()->setStatusCode(200);
    }

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return response(null, 204);
    }
}
