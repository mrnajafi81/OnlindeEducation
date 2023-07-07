<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class LoginRequest extends FormRequest
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
        //این سشن برای این ست می شود که در ویو تب مربوط به فرم ورود فعال شود نه ثبت نام
        session()->flash('login', true);

        return [
            'captcha' => ['required'],
            'number' => ['required', 'numeric', 'digits:11'],
            'password' => ['required', 'min:8', Password::min(8)->letters()->numbers()],
        ];
    }
}
