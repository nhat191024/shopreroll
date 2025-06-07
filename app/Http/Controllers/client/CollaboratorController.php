<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\AccountBill;
use App\Models\CollaboratorCommissionBill;
use App\Models\GameAccount;
use App\Models\SettingConfig;
use App\Models\User;
use App\Service\client\AccountBillService;
use Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CollaboratorController extends Controller
{
    private $commission_fee;

    public function __construct()
    {
        $this->commission_fee = SettingConfig::where('key', 'commission_fee')->first();
    }
    public function collaboratorCommissionConfirm(GameAccount $account)
    {
        // save the bill before updating balance to save the balance_before
        $this->saveCommissionBill($account);
        try {
            DB::beginTransaction();
            $user = $this->getCollaborator($account);

            if (!$user) {
                throw new Error('No collaborator id found');
            }

            $accountPriceOut = (float) $account->price_out;
            if ($accountPriceOut > 0) {
                $finalIncome = $this->getFinalIncome($accountPriceOut);
                $user->balance += $finalIncome;
                $user->save();
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error("Failed to save commission for Account ID: {$account->id}. " . $th->getMessage());
            throw new Error('Error confirming commission: ');
        }
    }

    private function saveCommissionBill(GameAccount $account)
    {
        try {
            DB::beginTransaction();
            $commissionFeePercentage = $this->getCommissionFeePercent();
            $user = $this->getCollaborator($account);

            if (!$user) {
                throw new Error('No collaborator id found');
            }

            $accountPriceOut = (float) $account->price_out;
            if ($accountPriceOut > 0) {
                $finalIncome = $this->getFinalIncome($accountPriceOut);
                CollaboratorCommissionBill::create([
                    'collaborator_id' => $user->id,
                    'account_id' => $account->id,
                    'buyer_id' => Auth::id(),
                    'commission_fee' => $commissionFeePercentage,
                    'price' => $finalIncome,
                    'balance_before' => $user->balance,
                    'balance_after' => $user->balance + $finalIncome
                ]);
                DB::commit();
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error("Failed to save commission bill for GameAccount ID: {$account->id}. " . $th->getMessage());
            throw new Error('Error saving commission: ');
        }
    }

    // get the final money that the collaborator will actually get after each buying success request
    private function getFinalIncome($accountPrice)
    {
        $commissionFeePercentage = $this->getCommissionFeePercent();
        $commissionAmount = $accountPrice * ($commissionFeePercentage / 100);
        return ($accountPrice - $commissionAmount);
    }

    // get the platform fee of the shop
    private function getCommissionFeePercent()
    {
        $commissionFeePercentage = 0;
        if ($this->commission_fee) {
            $commissionFeePercentage = (float) $this->commission_fee->value;
        }
        return $commissionFeePercentage;
    }

    // get the collaborator info that contributed the current account (that is being bought)
    private function getCollaborator(GameAccount $account)
    {
        if (!$account->Creator) {
            return null;
        }

        $collaboratorId = $account->Creator->id;
        $user = User::find($collaboratorId);
        if (!$user) {
            return null;
        }
        return $user;
    }
}
