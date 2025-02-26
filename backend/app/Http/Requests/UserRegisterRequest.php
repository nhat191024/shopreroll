<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => 'required|string|min:6|max:255',
            'username' => [
                'required',
                'max:255',
                'min:6',
                'unique:users',
                function ($attribute, $value, $fail) {
                    // avoid the user to enter the same username and name
                    if (strtolower($value) === strtolower(request()->input('name'))) {
                        $fail('Tên đăng nhập không được trùng với tên');
                    }
                    // not allow spaces in username
                    if (strpos($value, ' ') !== false) {
                        $fail('Tên đăng nhập không được chứa khoảng trắng & dấu cách');
                    }
                },
            ],
            'email' => 'required|email|string|unique:users|max:64',
            'phone' => 'required|min:9|max:20',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|same:password'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên không được để trống',
            'name.string' => 'Tên phải là chuỗi',
            'name.max' => 'Tên không được quá 255 ký tự',
            'name.min' => 'Tên phải có ít nhất 6 ký tự',
            'email.string' => 'Email phải là chuỗi',
            'email.max' => 'Email không được quá dài',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
            'username.required' => 'Tên đăng nhập không được để trống',
            'username.min' => 'Tên đăng nhập phải có ít nhất 6 ký tự',
            'username.max' => 'Tên đăng nhập không được quá 255 ký tự',
            'username.unique' => 'Tên đăng nhập đã tồn tại',
            'password.required' => 'Mật khẩu không được để trống',
            'password.string' => 'Mật khẩu phải là chuỗi',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'password.confirmed' => '',
            'phone.string' => 'Số điện thoại phải là chuỗi',
            'phone.required' => 'Số điện thoại không được để trống',
            'phone.min' => 'Số điện thoại phải có ít nhất 9 số',
            'phone.max' => 'Số điện thoại không được quá 20 ký tự',
            'password_confirmation.required' => 'Xác nhận mật khẩu không được để trống',
            'password_confirmation.same' => 'Xác nhận mật khẩu không khớp'
        ];
    }
}
