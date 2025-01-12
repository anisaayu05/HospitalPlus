<?php

namespace App\Http\Controllers\Api;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = Patient::all()->map(function ($patient) {
            return [
                'id' => $patient->id,
                'name' => $patient->name,
                'date_of_birth' => $patient->date_of_birth,
                'gender' => $patient->gender,
                'address' => $patient->address,
                'phone' => $patient->phone,
                'email' => $patient->email,
                'photo_url' => $patient->photo_path ? Storage::url($patient->photo_path) : null,
                'medical_history' => $patient->medical_history,
                'created_at' => $patient->created_at,
                'updated_at' => $patient->updated_at,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $patients,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'address' => 'required|string|max:500',
            'phone' => 'required|string|unique:patients,phone',
            'email' => 'required|email|unique:patients,email',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'medical_history' => 'nullable|string',
        ]);

        if ($request->hasFile('photo')) {
            $validatedData['photo_path'] = $request->file('photo')->store('patients', 'public');
        }

        $patient = Patient::create($validatedData);

        return response()->json([
            'success' => true,
            'data' => $patient,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $patient = Patient::find($id);

        if (!$patient) {
            return response()->json(['success' => false, 'message' => 'Patient not found'], 404);
        }

        $patient->photo_url = $patient->photo_path ? Storage::url($patient->photo_path) : null;

        return response()->json([
            'success' => true,
            'data' => $patient,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $patient = Patient::find($id);

        if (!$patient) {
            return response()->json(['success' => false, 'message' => 'Patient not found'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'address' => 'required|string|max:500',
            'phone' => 'required|string|unique:patients,phone,' . $id,
            'email' => 'required|email|unique:patients,email,' . $id,
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'medical_history' => 'nullable|string',
        ]);

        if ($request->hasFile('photo')) {
            if ($patient->photo_path) {
                Storage::disk('public')->delete($patient->photo_path);
            }
            $validatedData['photo_path'] = $request->file('photo')->store('patients', 'public');
        }

        $patient->update($validatedData);

        return response()->json([
            'success' => true,
            'data' => $patient,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $patient = Patient::find($id);

        if (!$patient) {
            return response()->json(['success' => false, 'message' => 'Patient not found'], 404);
        }

        if ($patient->photo_path) {
            Storage::disk('public')->delete($patient->photo_path);
        }

        $patient->delete();

        return response()->json(['success' => true, 'message' => 'Patient deleted successfully']);
    }
}
