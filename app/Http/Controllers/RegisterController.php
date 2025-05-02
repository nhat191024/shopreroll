<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    private $FORM_TITLE = 'Đăng ký';
    private $SUCCESS_MESSAGE = 'Đăng ký tài khoản thành công, vui lòng đăng nhập';
    private $SUCCESS_REDIRECT = '/login';

    public function index()
    {
        if (Auth::check()) {
            return redirect()->intended('/');
        }
        return view('client.auth.register')->with('title', $this->FORM_TITLE);
    }

    public function register(UserRegisterRequest $request)
    {
        $name = $request->input('name');
        $username = $request->input('username');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $password = $request->input('password');

        $user = new User();
        $user->name = $name;
        $user->username = $username;
        $user->phone = $phone;
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->save();

        return redirect($this->SUCCESS_REDIRECT)->with('message', $this->SUCCESS_MESSAGE);
    }
}
