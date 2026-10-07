<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SpecialtyController extends Controller
{
    public function index(): \Illuminate\Database\Eloquent\Collection
    {
        return Specialty::all();
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $specialty = Specialty::create($validated);

        return response()->json($specialty, 201);
    }

    public function show(Specialty $specialty): Specialty
    {
        return $specialty;
    }

    public function update(Request $request, Specialty $specialty): Specialty
    {
        $validated = $request->validate([
            'name' => ['sometimes', 'string', 'max:255'],
        ]);

        $specialty->update($validated);

        return $specialty->fresh();
    }

    public function destroy(Specialty $specialty): JsonResponse
    {
        $specialty->delete();

        return response()->json(null, 204);
    }
}
