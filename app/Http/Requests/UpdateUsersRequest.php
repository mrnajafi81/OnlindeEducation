<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UpdateUsersRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'fullname' => ['required', 'string', 'min:3', 'max:255'],
            'number' => ['required', 'numeric', 'digits:11'],
            'role' => ['required', 'in:admin,user'],
            'password' => ['nullable', 'min:8', 'confirmed', Password::min(8)->letters()->numbers()],
        ];
    }
}
