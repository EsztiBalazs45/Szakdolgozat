<?php

namespace App\Http\Controllers;

use App\Models\appointment;
use App\Http\Requests\StoreappointmentRequest;
use App\Http\Requests\UpdateappointmentRequest;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $appointments = Appointment::all();

        if ($appointments->isEmpty()) {
            return response()->json(['message' => 'No appointments found'], 404);
        }

        return response()->json($appointments);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreappointmentRequest $request)
    {
        try {
            $appointment = Appointment::create($request->validated());
            return response()->json($appointment, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create appointment'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(appointment $appointment)
    {
        return response()->json($appointment, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateappointmentRequest $request, appointment $appointment)
    {
        try {
            $appointment->update($request->validated());
            return response()->json($appointment, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update appointment'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(appointment $appointment)
    {
        try {
            $appointment->delete();
            return response()->json(['message' => 'Appointment deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete appointment'], 500);
        }
    }


    public function bookingPage(StoreAppointmentRequest $request)
    {
        return inertia('Appointment/Booking'); // A Vue komponens neve

        // Ellenőrizzük, hogy az időpont foglalt-e
        $existingAppointment = Appointment::where('date', $request->date)
            ->where('timeline', $request->timeline)
            ->first();

        if ($existingAppointment) {
            return response()->json(['error' => 'This time slot is already booked'], 409);
        }

        // Ha szabad az időpont, létrehozzuk a foglalást
        try {
            $appointment = Appointment::create($request->validated());
            return response()->json(['message' => 'Appointment successfully booked', 'appointment' => $appointment], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create appointment'], 500);
        }
    }
}
