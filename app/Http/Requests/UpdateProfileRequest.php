<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user = auth()->user();
        return [
            'firstname' => 'required|min:3',
            'lastname' => 'required|min:3',
            'address' => 'required|string|min:10',
            'contact_number' => ['required', 'regex:/(09)[0-9]{9}/', Rule::unique('users')->ignore($user->id)],
            // 'username' => ['required', Rule::unique('users')->ignore($user->id)],
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'password' => 'sometimes|nullable|string|min:6',
            // 'password' => ['required', Rule::unique('users')->ignore($user->id)],
        ];
    }
}
