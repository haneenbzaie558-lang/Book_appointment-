<?php

namespace App\Http\Requests\Patient;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePatientRequest extends FormRequest
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
            'name' => ['string', 'max:255'],
            'email' => ['string', 'email', 'max:255',   'unique:patients,email,' . $this->route('patient')->id],            
            //
        ];
    }
}
