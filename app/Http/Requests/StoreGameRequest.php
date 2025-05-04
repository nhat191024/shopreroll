<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGameRequest extends FormRequest
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
            'name' => 'required',
            'game_item.*' => 'required|string|max:255',
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
            'name.required' => 'Tên game là bắt buộc',
            'game_item.*.required' => 'Tên loại vật phẩm là bắt buộc',
            'game_item.*.string' => 'Tên loại vật phẩm phải là chuỗi',
            'game_item.*.max' => 'Tên loại vật phẩm không được vượt quá 255 ký tự',
            'game_attribute.*.required' => 'Tên thuộc tính là bắt buộc',
            'game_attribute.*.string' => 'Tên thuộc tính phải là chuỗi',
            'game_attribute.*.max' => 'Tên thuộc tính không được vượt quá 255 ký tự',
        ];
    }
}
