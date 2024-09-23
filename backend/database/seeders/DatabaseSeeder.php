<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\game_recharge;
use App\Models\recharge_package;
use App\Models\recharge_bill;
use App\Models\reroll_category;
use App\Models\reroll_sub_category;
use App\Models\reroll_package;
use App\Models\reroll_key;
use App\Models\reroll_bill;
use App\Models\game;
use App\Models\game_category;
use App\Models\hero;
use App\Models\weapon;
use App\Models\game_account;
use App\Models\account_hero;
use App\Models\account_weapon;
use App\Models\account_image;
use App\Models\account_bill;
use App\Models\balance_recharge_card_bill;
use App\Models\balance_recharge_bank_bill;

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

        foreach ($dataArray['game_recharge'] as $data) { game_recharge::create($data); }

        foreach ($dataArray['recharge_package'] as $data) { recharge_package::create($data); }

        foreach ($dataArray['recharge_bill'] as $data) { recharge_bill::create($data); }

        foreach ($dataArray['reroll_category'] as $data) { reroll_category::create($data); }

        foreach ($dataArray['reroll_sub_category'] as $data) { reroll_sub_category::create($data); }

        foreach ($dataArray['reroll_package'] as $data) { reroll_package::create($data); }

        foreach ($dataArray['reroll_key'] as $data) { reroll_key::create($data); }

        foreach ($dataArray['reroll_bill'] as $data) { reroll_bill::create($data); }

        foreach ($dataArray['game'] as $data) { game::create($data); }

        foreach ($dataArray['game_category'] as $data) { game_category::create($data); }

        foreach ($dataArray['hero'] as $data) { hero::create($data); }

        foreach ($dataArray['weapon'] as $data) { weapon::create($data); }

        foreach ($dataArray['game_account'] as $data) { game_account::create($data); }

        foreach ($dataArray['account_hero'] as $data) { account_hero::create($data); }

        foreach ($dataArray['account_weapon'] as $data) { account_weapon::create($data); }

        foreach ($dataArray['account_image'] as $data) { account_image::create($data); }

        foreach ($dataArray['account_bill'] as $data) { account_bill::create($data); }

        foreach ($dataArray['balance_recharge_card_bill'] as $data) { balance_recharge_card_bill::create($data); }

        foreach ($dataArray['balance_recharge_bank_bill'] as $data) { balance_recharge_bank_bill::create($data); }
    }
}
