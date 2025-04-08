<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGameAccountRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'game_category_id' => 'required|integer',
            'price_in' => 'nullable|integer',
            'price_out' => 'required|integer',
            'note' => 'nullable|string',
            'account_images' => 'nullable|array',
            'account_images.*' => 'nullable|image|mimes:png,jpg,jpeg|max:4096',
            'game_items' => 'required|array',
            'game_items.*' => 'array',
            'game_items.*.*' => 'required|integer',
            'game_attributes' => 'required|array',
            'game_attributes.*' => 'array',
            'game_attributes.*.*' => 'required|string|max:255',
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
            'title.required' => 'Tiêu đề là bắt buộc',
            'title.string' => 'Tiêu đề phải là một chuỗi',
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự',
            'username.required' => 'Tên người dùng là bắt buộc',
            'username.string' => 'Tên người dùng phải là một chuỗi',
            'username.max' => 'Tên người dùng không được vượt quá 255 ký tự',
            'password.required' => 'Mật khẩu là bắt buộc',
            'password.string' => 'Mật khẩu phải là một chuỗi',
            'password.max' => 'Mật khẩu không được vượt quá 255 ký tự',
            'game_category_id.required' => 'ID danh mục trò chơi là bắt buộc',
            'game_category_id.integer' => 'ID danh mục trò chơi phải là một số nguyên',
            'price_in.integer' => 'Giá nhập phải là một số nguyên',
            'price_out.required' => 'Giá bán là bắt buộc',
            'price_out.integer' => 'Giá bán phải là một số nguyên',
            'note.string' => 'Ghi chú phải là một chuỗi',
            'account_images.array' => 'Ảnh tài khoản phải là một mảng',
            'account_images.*.image' => 'Ảnh tài khoản phải là một hình ảnh',
            'account_images.*.mimes' => 'Ảnh tài khoản phải có định dạng png, jpg hoặc jpeg',
            'account_images.*.max' => 'Kích thước ảnh tài khoản không được vượt quá 4096 KB',
            'game_items.required' => 'Vật phẩm trò chơi là bắt buộc',
            'game_items.array' => 'Vật phẩm trò chơi phải là một mảng',
            'game_items.*.array' => 'Vật phẩm trò chơi phải là một mảng',
            'game_items.*.*.required' => 'Vật phẩm trò chơi là bắt buộc',
            'game_items.*.*.integer' => 'Vật phẩm trò chơi phải là một số nguyên',
            'game_attributes.required' => 'Thuộc tính trò chơi là bắt buộc',
        ];
    }
}
