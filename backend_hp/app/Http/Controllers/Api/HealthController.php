<?php

namespace App\Http\Controllers\Api;

use App\Models\HealthRecord;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HealthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $healthRecords = HealthRecord::with('patient')->get();

        return response()->json([
            'success' => true,
            'data' => $healthRecords,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'medical_history' => 'required|string',
            'lab_results' => 'required|string',
            'vaccination' => 'nullable|string',
        ]);

        $healthRecord = HealthRecord::create($validatedData);

        return response()->json([
            'success' => true,
            'data' => $healthRecord,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $healthRecord = HealthRecord::with('patient')->find($id);

        if (!$healthRecord) {
            return response()->json([
                'success' => false,
                'message' => 'Health record not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $healthRecord,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $healthRecord = HealthRecord::find($id);

        if (!$healthRecord) {
            return response()->json([
                'success' => false,
                'message' => 'Health record not found',
            ], 404);
        }

        $validatedData = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'medical_history' => 'required|string',
            'lab_results' => 'required|string',
            'vaccination' => 'nullable|string',
        ]);

        $healthRecord->update($validatedData);

        return response()->json([
            'success' => true,
            'data' => $healthRecord,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $healthRecord = HealthRecord::find($id);

        if (!$healthRecord) {
            return response()->json([
                'success' => false,
                'message' => 'Health record not found',
            ], 404);
        }

        $healthRecord->delete();

        return response()->json([
            'success' => true,
            'message' => 'Health record deleted successfully',
        ]);
    }
}
