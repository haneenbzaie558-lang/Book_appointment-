<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index(): \Illuminate\Database\Eloquent\Collection
    {
        return Doctor::with('specialty')->get();
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'specialty_id' => ['required', 'integer', 'exists:specialties,id'],
        ]);

        $doctor = Doctor::create($validated);

        return response()->json($doctor->load('specialty'), 201);
    }

    public function show(Doctor $doctor): Doctor
    {
        return $doctor->load('specialty');
    }

    public function update(Request $request, Doctor $doctor): Doctor
    {
        $validated = $request->validate([
            'name' => ['sometimes', 'string', 'max:255'],
            'phone' => ['sometimes', 'string', 'max:255'],
            'specialty_id' => ['sometimes', 'integer', 'exists:specialties,id'],
        ]);

        $doctor->update($validated);

        return $doctor->fresh()->load('specialty');
    }

    public function destroy(Doctor $doctor): JsonResponse
    {
        $doctor->delete();

        return response()->json(null, 204);
    }
}
