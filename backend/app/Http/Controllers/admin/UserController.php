<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Service\admin\CategoryService;
use App\Service\admin\FoodService;
use App\Service\admin\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userService;
    //
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $allUser = $this->userService->getAll();
        return view('admin.user.user', compact('allUser'));
    }
    public function show($id){
        $user = $this->userService->getById($id);
        return view('admin.user.edit', compact('user'));
    }
    public function edit($id, Request $request){
        if ($request->input('action') === 'editBalance') {
        $this->userService->editbalance($id, $request);
        // dd($request->all());
        return redirect()->route('admin.user.index')->with('success', 'Balance updated successfully');
        }else if($request->input('action') === 'editRole'){
            $this->userService->editRole($id, $request);
            return redirect()->route('admin.user.index')->with('success', 'Role updated successfully');
        }
    }
}
