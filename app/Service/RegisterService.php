<?php

namespace App\Service;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterService {

    private $FORM_TITLE = 'Đăng ký';
    private $SUCCESS_MESSAGE = 'Đăng ký tài khoản thành công, vui lòng đăng nhập';
    private $SUCCESS_REDIRECT = '/login';

    public function index(){
        if (Auth::check()) {
            return redirect()->intended('/');
        }
        return view('client.auth.register')->with('title', $this->FORM_TITLE);
    }

    public function register(Request $request) {
        // Validate moved to UserRegisterRequest and Controller class
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
?>
