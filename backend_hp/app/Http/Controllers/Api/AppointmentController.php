<?php

namespace App\Http\Controllers\Api;

use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $appointments = Appointment::with(['patient', 'doctor'])->get();

        return response()->json([
            'success' => true,
            'data' => $appointments,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date',
            'status' => 'nullable|string|in:pending,completed,canceled',
            'notes' => 'nullable|string',
        ]);

        $appointment = Appointment::create($validatedData);

        return response()->json([
            'success' => true,
            'data' => $appointment,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $appointment = Appointment::with(['patient', 'doctor'])->find($id);

        if (!$appointment) {
            return response()->json([
                'success' => false,
                'message' => 'Appointment not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $appointment,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $appointment = Appointment::find($id);

        if (!$appointment) {
            return response()->json([
                'success' => false,
                'message' => 'Appointment not found',
            ], 404);
        }

        $validatedData = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date',
            'status' => 'nullable|string|in:pending,completed,canceled',
            'notes' => 'nullable|string',
        ]);

        $appointment->update($validatedData);

        return response()->json([
            'success' => true,
            'data' => $appointment,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $appointment = Appointment::find($id);

        if (!$appointment) {
            return response()->json([
                'success' => false,
                'message' => 'Appointment not found',
            ], 404);
        }

        $appointment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Appointment deleted successfully',
        ]);
    }
}
