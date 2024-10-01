<?php

namespace App\Service\admin;

use App\Models\Food;
use App\Models\User;
use Illuminate\Http\Request;

class UserService
{
    public function getAll()
    {
        $users = User::whereIn('role',[0,2])->get();
        return $users;
    }

    public function getById($id) {
        return User::find($id);
    }
    public function editRole($id, Request $request)
    {
        $user = User::where('id', $id)->first();
        $user->role = $request->input('role');
        $user->save();
        return $user;       
    }
    public function editbalance($id,Request $request){
            $user = User::where('id', $id)->first();
            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }
            $balance = $request->input('balance');
            $plusbalance = $request->input('plusbalance');
            if (isset($balance) && isset($plusbalance)) {
                $user->balance =  $balance + $plusbalance;
                $user->save();
            return response()->json(['message' => 'Balance updated successfully'], 200);
            }
            return response()->json(['message' => 'Invalid data provided'], 400);
    }
    public function addAcount(Request $request)
    {
        $check = User::where('username', $request->input('username'))->first();
    
        if ($check) {
            return response()->json(['message' => 'Username already exists'], 400);
        }
    
        $user = new User();
        $user->username = $request->input('username');
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->password = bcrypt($request->input('password'));
        $user->role = $request->input('role');  
        $user->balance = $request->input('balance', 0); 
        $user->save();
    
        return response()->json(['message' => 'Account created successfully'], 200);
    }
    public function blockUser($id){
        $user = User::where('id', $id)->first();
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        $user->role = 3;
        $user->save();
        return response()->json(['message' => 'User blocked successfully'], 200);
    }
    public function unblockUser($id){
        $user = User::where('id', $id)->first();
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        $user->role = 2;
        $user->save();
        return response()->json(['message' => 'User unblocked successfully'], 200);
    }
    public function changePass( $id,Request $request){

        $user = User::where('id', $id)->first();
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        $user->password = bcrypt($request->input('password'));
        $user->save();
        return response()->json([
            'message' => 'Password updated successfully',
            'password' => $user->password,
    ], 200);
    }
    }
