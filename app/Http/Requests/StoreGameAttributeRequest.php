<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGameAttributeRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'game_id' => 'required|integer',
            'game_attribute' => 'required|array',
            'game_attribute.*' => 'required|string|max:255',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'game_id.required' => 'Game ID is required',
            'game_id.integer' => 'Game ID must be an integer',
            'game_attribute.required' => 'Game Attribute is required',
            'game_attribute.array' => 'Game Attribute must be an array',
            'game_attribute.*.required' => 'Game Attribute is required',
            'game_attribute.*.string' => 'Game Attribute must be a string',
            'game_attribute.*.max' => 'Game Attribute must not be greater than 255 characters',
        ];
    }
}
