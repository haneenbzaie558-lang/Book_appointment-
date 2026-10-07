<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index(): \Illuminate\Database\Eloquent\Collection
    {
        return Patient::all();
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'birth_date' => ['nullable', 'date'],
        ]);

        $patient = Patient::create($validated);

        return response()->json($patient, 201);
    }

    public function show(Patient $patient): Patient
    {
        return $patient;
    }

    public function update(Request $request, Patient $patient): Patient
    {
        $validated = $request->validate([
            'name' => ['sometimes', 'string', 'max:255'],
            'phone' => ['sometimes', 'string', 'max:255'],
            'birth_date' => ['sometimes', 'nullable', 'date'],
        ]);

        $patient->update($validated);

        return $patient->fresh();
    }

    public function destroy(Patient $patient): JsonResponse
    {
        $patient->delete();

        return response()->json(null, 204);
    }
}
