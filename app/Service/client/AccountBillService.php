<?php

namespace App\Service\client;

use App\Models\AccountBill;
use App\Models\Game;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountBillService
{
    public function getAllGenshinBillByUserId($id)
    {
        $genshinGameId = Game::where('name', 'LIKE', '%Genshin%')->first()->id;
        if (is_null($id)) {
            // prevent null
            return collect();
        }
        $accountBill = AccountBill::where('user_id', $id)
            ->whereHas('GameAccount', function ($query) use ($genshinGameId) {
                $query->whereHas('GameCategory', function ($query) use ($genshinGameId) {
                    $query->where('game_id', $genshinGameId);
                });
            })->get();
        return $accountBill;
    }
    
    public function getAllBillByUserId($id)
    {
        if (is_null($id)) {
            // prevent null
            return collect();
        }
        $accountBill = AccountBill::where('user_id', $id)->get();
        return $accountBill;
    }
}
