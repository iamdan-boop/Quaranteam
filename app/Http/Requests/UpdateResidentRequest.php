<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateResidentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'firstname' => 'required|string|min:3',
            'lastname' => 'required|string|min:3',
            'username' => ['required', 'string', 'min:6', Rule::unique('users')->ignore($this->route('manage_resident'))],
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->route('manage_resident'))],
            'password' => 'sometimes|nullable|string|min:6',
        ];
    }
}
