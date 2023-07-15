<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreUsersRequest extends FormRequest
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
            'number' => ['required', 'numeric', 'digits:11', 'unique:users'],
            'role' => ['required', 'in:admin,user'],
            'password' => ['required', 'min:8', 'confirmed', Password::min(8)->letters()->numbers()],
        ];
    }
}
