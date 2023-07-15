<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'max_digits:10'],
            'duration' => ['required', 'string', 'max:100'],
            'type' => ['required', 'string', 'max:100'],
            'teacher_id' => ['required', 'numeric', 'min:1'],
            'support_number' => ['required', 'numeric', 'digits:11'],
            'description' => ['required', 'string'],
            'image' => ['nullable', 'image'],
        ];
    }
}
