<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check() && auth()->user()->is_admin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'date' => 'required|date',
            'address' => 'required|min:8',
            'slots_allocated' => 'numeric|min:1',
            'contact_number' => 'required|string',
            'dose' => 'required|string',
            'active' => 'required|numeric'
        ];
    }
}
