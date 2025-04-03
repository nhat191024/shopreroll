<?php

namespace App\Service;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginService {

    private $FORM_TITLE = 'Đăng nhập';
    private $WRONG_CREDENTIALS_MESSAGE = 'Thông tin đăng nhập không chính xác';
    private $ERROR_REDIRECT = '/login';
    private $SUCCESS_REDIRECT = '/';
    private $LOGOUT_REDIRECT = '/login';

    public function index(){
        if (Auth::check()) {
            return redirect()->intended('/');
        }
        return view('client.auth.login')->with('title', $this->FORM_TITLE);
    }

    public function login(Request $request) {
        // Validate moved to UserLoginRequest and Controller class
        $username = $request->input('username');
        $password = $request->input('password');
        
        // Check if input is email or username
        $account = User::where('username', $username)
                      ->orWhere('email', $username)
                      ->first();
                      
        if (!$account) {
            return redirect($this->ERROR_REDIRECT)->with('error', $this->WRONG_CREDENTIALS_MESSAGE);
        }
        if (!Hash::check($password, $account->password)) {
            return redirect($this->ERROR_REDIRECT)->with('error', $this->WRONG_CREDENTIALS_MESSAGE);
        }
        Auth::login($account);
        return redirect($this->SUCCESS_REDIRECT);
    }

    public function logout() {
        Auth::logout();
        return redirect($this->LOGOUT_REDIRECT);
    }
}

