<?php

namespace App\Http\Controllers\Api;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::all()->map(function ($department) {
            return [
                'id' => $department->id,
                'name' => $department->name,
                'description' => $department->description,
                'image_url' => $department->image_path
                    ? Storage::url($department->image_path)
                    : null,
                'created_at' => $department->created_at,
                'updated_at' => $department->updated_at,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $departments,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validatedData['image_path'] = $request->file('image')->store('departments', 'public');
        }

        $department = Department::create($validatedData);

        $data = [
            'id' => $department->id,
            'name' => $department->name,
            'description' => $department->description,
            'image_url' => $department->image_path
                ? Storage::url($department->image_path)
                : null,
            'created_at' => $department->created_at,
            'updated_at' => $department->updated_at,
        ];

        return response()->json([
            'success' => true,
            'data' => $data,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $department = Department::find($id);

        if (!$department) {
            return response()->json([
                'success' => false,
                'message' => 'Department not found',
            ], 404);
        }

        $data = [
            'id' => $department->id,
            'name' => $department->name,
            'description' => $department->description,
            'image_url' => $department->image_path
                ? Storage::url($department->image_path)
                : null,
            'created_at' => $department->created_at,
            'updated_at' => $department->updated_at,
        ];

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $department = Department::find($id);

        if (!$department) {
            return response()->json([
                'success' => false,
                'message' => 'Department not found',
            ], 404);
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($department->image_path) {
                Storage::disk('public')->delete($department->image_path);
            }

            $validatedData['image_path'] = $request->file('image')->store('departments', 'public');
        }

        $department->update($validatedData);

        $data = [
            'id' => $department->id,
            'name' => $department->name,
            'description' => $department->description,
            'image_url' => $department->image_path
                ? Storage::url($department->image_path)
                : null,
            'created_at' => $department->created_at,
            'updated_at' => $department->updated_at,
        ];

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $department = Department::find($id);

        if (!$department) {
            return response()->json([
                'success' => false,
                'message' => 'Department not found',
            ], 404);
        }

        if ($department->image_path) {
            Storage::disk('public')->delete($department->image_path);
        }

        $department->delete();

        return response()->json([
            'success' => true,
            'message' => 'Department deleted successfully',
        ]);
    }
}
