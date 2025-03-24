<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGameItemTypeRequest extends FormRequest
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
            'game_item' => 'required|array',
            'game_item.*' => 'required|string|max:255',
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
            'game_item.required' => 'Game Item is required',
            'game_item.array' => 'Game Item must be an array',
            'game_item.*.required' => 'Game Item is required',
            'game_item.*.string' => 'Game Item must be a string',
            'game_item.*.max' => 'Game Item must not be greater than 255 characters',
        ];
    }
}
