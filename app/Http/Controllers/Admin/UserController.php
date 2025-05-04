<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\User;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    public function index()
    {
        $allUser = User::withTrashed()->get();
        return view('admin.user.user', compact('allUser'));
    }

    public function showAddForm()
    {
        return view('admin.user.add');
    }

    public function store(StoreUserRequest $request)
    {
        User::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'name' => $request->name,
            'role' => $request->role,
            'balance' => $request->balance,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);
        return redirect()->route('admin.user.index')->with('success', 'Thêm tài khoản thành công');
    }

    public function showUser($id)
    {
        $user = User::withTrashed()->find($id);
        return view('admin.user.edit', compact('user'));
    }

    public function editUser($id, UpdateUserRequest $request)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('admin.user.index')->with('error', 'Không tìm thấy tài khoản');
        }

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        if ($request->has('role')) {
            $user->role = $request->role;
        }

        if ($request->has('balance')) {
            $user->balance = $request->balance;
        }

        $user->save();

        return redirect()->route('admin.user.index')->with('success', 'Cập nhật tài khoản thành công');
    }

    public function changeStatus($id)
    {
        $user = User::withTrashed()->find($id);
        if (!$user) {
            return redirect()->route('admin.user.index')->with('error', 'Không tìm thấy tài khoản');
        }

        if ($user->trashed()) {
            $user->restore();
            return redirect()->route('admin.user.index')->with('success', 'Khôi phục tài khoản thành công');
        } else {
            $user->delete();
            return redirect()->route('admin.user.index')->with('success', 'Vô hiệu hoá tài khoản thành công');
        }
    }
}
