<?php

namespace App\Service;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginService {
    public function index(){
    return view('/');
    }
    public function login(Request $request) {
        $email = $request->input('email');
        $password = $request->input('password');
        $account = User::where('email', $email)->first();
        if (!$account) {
            return redirect('/login')->with('error', 'Không tìm thấy tài khoản');
        }
        if (!Hash::check($password, $account->password)) {
            return redirect('/login')->with('error', 'Thông tin đăng nhập không chính xác');
        }
        return redirect('/')->with('message', 'Đăng nhập thành công');
    }
    public function logout() {
        Auth::logout();
        return redirect('/login')->with('message', 'Đăng xuất thành công');
    }
}
?>