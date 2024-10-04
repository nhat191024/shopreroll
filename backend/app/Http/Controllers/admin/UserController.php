<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
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
    public function showAddForm()
    {
        return view('admin.user.add');
    }
    public function addUser(Request $request)
    {
        $this->userService->addAccount($request);
        // return ($test);
        // dd($request->all());
        return redirect()->route('admin.user.index')->with('success', 'User added successfully');
    }
    public function show($id)
    {
        $user = $this->userService->getById($id);
        return view('admin.user.edit', compact('user'));
    }
    public function edit($id, Request $request)
    {
        $user = $this->userService->getById($id);
    
        if (!$user) {
            return redirect()->route('admin.user.index')->with('error', 'User not found');
        }
    
        if ($request->has('addedBalance')) {
            $this->userService->editBalance($id, $request);
        }
    
        if ($request->has('role')) {
            $this->userService->editRole($id, $request);
        }
    
        if ($request->filled('password')) {
            $this->userService->changePass($id, $request);
        }
    
        return redirect()->route('admin.user.index')->with('success', 'Information updated successfully');
    }
    
}
