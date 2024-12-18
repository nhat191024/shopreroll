<?php

namespace App\Service;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginService {
    public function index(){
    return view('client.layouts.login');
    }
    public function login(Request $request) {
        $username = $request->input(key: 'username');
        $password = $request->input('password');
        $account = User::where('username', $username)->first();
        if (!$account) {
            return redirect('/login')->with('error', 'Không tìm thấy tài khoản');
        }
        if (!Hash::check($password, $account->password)) {
            return redirect('/login')->with('error', 'Thông tin đăng nhập không chính xác');
        }
        // return redirect('/')->with('message', 'Đăng nhập thành công');
        return ('đăng nhập thành công');
    }
    public function logout() {
        Auth::logout();
        return redirect('/login')->with('message', 'Đăng xuất thành công');
    }
}
?>