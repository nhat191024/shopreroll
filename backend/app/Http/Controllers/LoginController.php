<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Service\LoginService;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    private $loginService;
    public function __construct(LoginService $loginService){
        $this->loginService = $loginService;
    }
    public function index(){
        return $this->loginService->index();
    }
    public function login(UserLoginRequest $request){
        return $this->loginService->login($request);
    }
    public function logout(){
        return $this->loginService->logout();
    }
}
