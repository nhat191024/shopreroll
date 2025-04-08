<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegisterRequest as UserRegisterRequest;
use App\Service\RegisterService;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    private $registerService;

    public function __construct(RegisterService $registerService){
        $this->registerService = $registerService;
    }
    public function index(){
        return $this->registerService->index();
    }

    public function register(UserRegisterRequest $request){
        return $this->registerService->register($request);
    }

}
