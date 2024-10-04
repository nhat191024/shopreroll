<?php

namespace App\Service\admin;

use App\Models\User;
use Illuminate\Http\Request;

class UserService
{
    public function getAll()
    {
        $users = User::get();
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
        $user = User::where('id', $id)->first();
        if (!$user) {
        return redirect()->route('admin.user.index')->with('message', 'User not found');
        }
        $balance = $user->balance;
        $addedBalance = $request->input('addedBalance');
        if (isset($balance) && isset($addedBalance)) {
            $user->balance =  $balance + $addedBalance;
            $user->save();
            return $user;
        }
        return redirect()->route('admin.user.edit')->with('message', 'Invalid data provided');

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
        return redirect()->route('admin.user.index')->with('message', 'User not found');
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
            'username' => 'required|string|unique:users,username',
            'password'=> 'required|string',
            'email'=> 'required|string|unique:users,email',
            'phone'=> 'required|string',
            'role'=> 'required|integer',
        ],
        [
            'username.required' => 'required',
            'username.unique' => 'username already exists',
            'email.unique' => 'Email already exists',
            'phone.required' => 'required',
            'role.required' => 'required',
        ]
        );
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
    
}
