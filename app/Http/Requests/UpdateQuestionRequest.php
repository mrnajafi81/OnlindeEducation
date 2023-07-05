<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQuestionRequest extends FormRequest
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
            'question_text' => ['required', 'string', 'max:255'],
            'option1' => ['required', 'string', 'max:255'],
            'option2' => ['required', 'string', 'max:255'],
            'option3' => ['required', 'string', 'max:255'],
            'option4' => ['required', 'string', 'max:255'],
            'answer' => ['required', 'in:1,2,3,4'],
            'score' => ['required', 'integer', 'min:1', 'max:100']
        ];
    }
}
