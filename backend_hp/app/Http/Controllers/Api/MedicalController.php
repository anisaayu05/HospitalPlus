<?php

namespace App\Http\Controllers\Api;

use App\Models\Medical;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MedicalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medicals = Medical::with('patient')->get();

        return response()->json([
            'success' => true,
            'data' => $medicals,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'diagnosis' => 'required|string',
            'treatment' => 'nullable|string',
        ]);

        $medical = Medical::create($validatedData);

        return response()->json([
            'success' => true,
            'data' => $medical,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $medical = Medical::with('patient')->find($id);

        if (!$medical) {
            return response()->json([
                'success' => false,
                'message' => 'Medical record not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $medical,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $medical = Medical::find($id);

        if (!$medical) {
            return response()->json([
                'success' => false,
                'message' => 'Medical record not found',
            ], 404);
        }

        $validatedData = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'diagnosis' => 'required|string',
            'treatment' => 'nullable|string',
        ]);

        $medical->update($validatedData);

        return response()->json([
            'success' => true,
            'data' => $medical,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $medical = Medical::find($id);

        if (!$medical) {
            return response()->json([
                'success' => false,
                'message' => 'Medical record not found',
            ], 404);
        }

        $medical->delete();

        return response()->json([
            'success' => true,
            'message' => 'Medical record deleted successfully',
        ]);
    }
}
