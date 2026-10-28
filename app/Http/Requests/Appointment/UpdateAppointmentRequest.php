<?php

namespace App\Http\Requests\Appointment;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return ['accepted_terms' => ['accepted'],
            'doctor_id' => ['exists:doctors,id'],
            'patient_id' => ['exists:patients,id'],
            'appointment_date' => ['date', 'after_or_equal:today'],     
            //
        ];
    }
}
