<?php

namespace App\Service\client;

use App\Models\AccountBill;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountBillService {
    public function getAllByUserId($id)
    {
        if (is_null($id)) {
            // prevent null
            return collect();
        }
        $accountBill = AccountBill::where('user_id', $id)->get();
        return $accountBill;
    }
}
?>
