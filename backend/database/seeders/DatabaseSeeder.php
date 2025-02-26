<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\GameRecharge;
use App\Models\RechargePackage;
use App\Models\RechargeBill;
use App\Models\RerollCategory;
use App\Models\RerollSubCategory;
use App\Models\RerollPackage;
use App\Models\RerollKey;
use App\Models\RerollBill;
use App\Models\Game;
use App\Models\GameCategory;
use App\Models\Hero;
use App\Models\Weapon;
use App\Models\GameAccount;
use App\Models\AccountHero;
use App\Models\AccountWeapon;
use App\Models\AccountImage;
use App\Models\AccountBill;
use App\Models\BalanceRechargeCardBill;
use App\Models\BalanceRechargeBankBill;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $jsonFilePath = "./database/seeders/data.json";
        $jsonContent = file_get_contents($jsonFilePath);
        $dataArray = json_decode($jsonContent, true);

        foreach ($dataArray['user'] as $data) {
            User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'username' => $data['username'],
                'password' => Hash::make($data['password']),
                'phone' => $data['phone'],
                'role' => $data['role'],
                'balance' => $data['balance'],
                'avatar' => $data['avatar'],
            ]);
        }

        foreach ($dataArray['game_recharge'] as $data) { GameRecharge::create($data); }

        foreach ($dataArray['recharge_package'] as $data) { RechargePackage::create($data); }

        foreach ($dataArray['recharge_bill'] as $data) { RechargeBill::create($data); }

        foreach ($dataArray['reroll_category'] as $data) { RerollCategory::create($data); }

        foreach ($dataArray['reroll_sub_category'] as $data) { RerollSubCategory::create($data); }

        foreach ($dataArray['reroll_package'] as $data) { RerollPackage::create($data); }

        foreach ($dataArray['reroll_key'] as $data) { RerollKey::create($data); }

        foreach ($dataArray['reroll_bill'] as $data) { RerollBill::create($data); }

        foreach ($dataArray['game'] as $data) { Game::create($data); }

        foreach ($dataArray['game_category'] as $data) { GameCategory::create($data); }

        foreach ($dataArray['hero'] as $data) { Hero::create($data); }

        foreach ($dataArray['weapon'] as $data) { Weapon::create($data); }

        foreach ($dataArray['game_account'] as $data) { GameAccount::create($data); }

        foreach ($dataArray['account_hero'] as $data) { AccountHero::create($data); }

        foreach ($dataArray['account_weapon'] as $data) { AccountWeapon::create($data); }

        foreach ($dataArray['account_image'] as $data) { AccountImage::create($data); }

        foreach ($dataArray['account_bill'] as $data) { AccountBill::create($data); }

        foreach ($dataArray['balance_recharge_card_bill'] as $data) { BalanceRechargeCardBill::create($data); }

        foreach ($dataArray['balance_recharge_bank_bill'] as $data) { BalanceRechargeBankBill::create($data); }
    }
}
