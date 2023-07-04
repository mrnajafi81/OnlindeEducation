<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLessonRequest extends FormRequest
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
        //TODO: check for order is unique for each course
        return [
            'title' => ['required', 'string', 'max:255'],
            'order' => ['required', 'integer'],
            'video' => ['nullable', 'file', 'mimes:mp4,ogg'],
            'sound' => ['nullable', 'file', 'mimes:mp3,m4a'],
            'file' => ['nullable', 'file', 'mimes:zip,pdf'],
            'has_test' => ['required', 'boolean'],
            'passing_mark' => ['required_if:has_test,1', 'numeric', 'min:0', 'max:100']
        ];
    }
}
