<?php

namespace App\Service\admin;

use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

class UserService
{
    use SoftDeletes;
    public function getAll()
    {
        $users = User::withTrashed()->get();
        return $users;
    }

    public function getById($id)
    {
        return User::find($id);
    }

    public function editRole($id, Request $request)
    {
        $user = User::where('id', $id)->first();
        if($request->input('role')== ""){
            $user->role = User::find($id)->value('role');
            $user->save();
            return $user;
        }
        $user->role = $request->input('role');
        $user->save();
        return $user;
    }

    public function editBalance($id, Request $request)
    {
        $request->validate([
            'addedBalance' => 'required|numeric|digits_between:1,10', 
        ], [
            'addedBalance.digits_between' => 'Số dư không được vượt quá 10 chữ số',
        ]);
        
        $user = User::where('id', $id)->first();
        if (!$user) {
            return redirect()->route('admin.user.index')->with('message', 'Không tìm thấy tài khoản');
        }
        $balance = $user->balance;
        $addedBalance = $request->input('addedBalance');
        if (isset($balance) && isset($addedBalance)) {
            if($addedBalance + $balance < 0) {
                return redirect()->route('admin.user.edit', ['id' => $id])->with('message', 'Số dư tài khoản không đủ để trừ');
            }
            $user->balance = $balance + $addedBalance;
            $user->save();
            return $user;
        }
        return redirect()->route('admin.user.edit', ['id' => $id])->with('message', 'Dữ liệu không hợp lệ');
    }
    

    public function changePass($id, Request $request)
    {
        $user = User::where('id', $id)->first();
        $request->validate([
            'password'=> 'required',
        ],
        [
            'password.required' => 'required',
        ]
        );
        if (!$user) {
        return redirect()->route('admin.user.index')->with('message', 'Không tìm thấy tài khoản');
        }
        if($request->input('password')==null) {
            $user->password = User::find($id)->value('password');
        }
        $user->password = bcrypt($request->input('password'));
        $user->save();
        return $user;
    }

    public function addAccount(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|string|unique:users,username',
            'password'=> 'required|string',
            'email'=> 'required|string|unique:users,email',
            'phone'=> 'required|numeric|unique:users,phone|digits:10',
            'role'=> 'required|integer',
            'balance'=> 'required|numeric|digits_between:1,10',
        ],
        [
            'username.required' => 'required',
            'username.unique' => 'username already exists',
            'email.unique' => 'Email already exists',
            'phone.required' => 'required',
            'phone.unique' => 'Phone already exists',
            'phone.numeric' => 'Phone should be numeric',
            'phone.digits' => 'Phone should be 10 digits',
            'password.required' => 'required',
            'email.required' => 'required',
            'name.required' => 'required',
            'role.required' => 'required',
            'balance.required' => 'required',
            'balance.numeric' => 'Balance should be numeric',
            'balance.digits_between' => 'Balance should have between 1 and 10 digits',
        ]);
        
        $user = new User();
        $user->username = $request->input('username');
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->password = bcrypt($request->input('password'));
        $user->role = $request->input('role');
        $user->balance = $request->input('balance', 0);
        $user->save();
        return $user;
    }
    public function disable($id){
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect()->route('admin.user.index')->with('message', 'Vô hiệu hoá thành công');
        }
        return redirect()->route('admin.user.index')->with('message', 'Không tìm thấy tài khoản');
    }
    public function store($id){
        $user = User::withTrashed()->find($id);
        if ($user) {
            $user->restore();
            return redirect()->route('admin.user.index')->with('message', 'Khôi phục thành công');
        }
        return redirect()->route('admin.user.index')->with('message', 'Không tìm thấy tài khoản');
    }
}
