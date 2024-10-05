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
        return redirect()->route('admin.user.index')->with('success', 'Thêm tài khoản thành công');
    }
    public function showUser($id)
    {
        $user = $this->userService->getById($id);
        return view('admin.user.edit', compact('user'));
    }
    public function editUser($id, Request $request)
    {
        $user = $this->userService->getById($id);
    
        if (!$user) {
            return redirect()->route('admin.user.index')->with('error', 'Không tìm thấy tài khoản');
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
    
        return redirect()->route('admin.user.index')->with('success', 'Cập nhập thành công ');
    }
    public function disableUser($id) {
        $this->userService->disable($id);
        return redirect()->route('admin.user.index')->with('success', 'Vô hiệu tài khoản thành công');
    }
    public function storeUser($id) {
        $this->userService->store($id);
        return redirect()->route('admin.user.index')->with('message', 'Khôi phục thành công');

    }
    
}
