<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PoemUpdateRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'body' => 'required|string|min:10',
            'is_published' => 'nullable|boolean',
        ];
    }

    /**
     * Get custom error messages.
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Please provide a title for your poem.',
            'title.max' => 'The title must not exceed 255 characters.',
            'body.required' => 'Please write your poem in the body field.',
            'body.min' => 'Your poem must be at least 10 characters long.',
        ];
    }
}
