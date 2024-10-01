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

    public function add($categoryId, $foodName, $foodPrice, $foodImage)
    {
       
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

    }
