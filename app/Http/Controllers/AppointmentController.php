<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index(): \Illuminate\Database\Eloquent\Collection
    {
        return Appointment::with(['doctor.specialty', 'patient'])->get();
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'doctor_id' => ['required', 'integer', 'exists:doctors,id'],
            'patient_id' => ['required', 'integer', 'exists:patients,id'],
            'appointment_date' => ['required', 'date'],
            'status' => ['sometimes', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
        ]);

        $appointment = Appointment::create($validated);

        return response()->json($appointment->load(['doctor.specialty', 'patient']), 201);
    }

    public function show(Appointment $appointment): Appointment
    {
        return $appointment->load(['doctor.specialty', 'patient']);
    }

    public function update(Request $request, Appointment $appointment): Appointment
    {
        $validated = $request->validate([
            'doctor_id' => ['sometimes', 'integer', 'exists:doctors,id'],
            'patient_id' => ['sometimes', 'integer', 'exists:patients,id'],
            'appointment_date' => ['sometimes', 'date'],
            'status' => ['sometimes', 'string', 'max:255'],
            'notes' => ['sometimes', 'nullable', 'string'],
        ]);

        $appointment->update($validated);

        return $appointment->fresh()->load(['doctor.specialty', 'patient']);
    }

    public function destroy(Appointment $appointment): JsonResponse
    {
        $appointment->delete();

        return response()->json(null, 204);
    }
}
