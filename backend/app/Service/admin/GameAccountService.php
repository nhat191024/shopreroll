<?php

namespace App\Service\admin;

use App\Models\Hero;
use App\Models\Weapon;
use App\Models\GameAccount;
use App\Models\GameCategory;
use App\Models\AccountHero;
use App\Models\AccountWeapon;
use App\Models\AccountImage;
use Illuminate\Support\Facades\Storage;

class GameAccountService
{
    public function getAllGameAccounts()
    {
        return GameAccount::all();
    }

    public function getAllGameCategories()
    {
        return GameCategory::all();
    }

    public function addGameAccount($data, $images)
    {
        try {
            $gameAccount = new GameAccount();
            $gameAccount->title = $data['title'];
            $gameAccount->username = $data['username'];
            $gameAccount->password = bcrypt($data['password']);
            $gameAccount->server = $data['server'];
            $gameAccount->ar = $data['ar'];
            $gameAccount->game_category_id = $data['game_category_id'];
            $gameAccount->price_in = $data['price_in'] ?? 0;
            $gameAccount->price_out = $data['price_out'];
            $gameAccount->note = $data['note'] ?? null;
            $gameAccount->status = $data['status'];
            $gameAccount->save();

            // Save heroes
            foreach ($data['heroes'] as $heroId) {
                $accountHero = new AccountHero();
                $accountHero->account_id = $gameAccount->id;
                $accountHero->hero_id = $heroId;
                $accountHero->save();
            }

            // Save weapons
            foreach ($data['weapons'] as $weaponId) {
                $accountWeapon = new AccountWeapon();
                $accountWeapon->account_id = $gameAccount->id;
                $accountWeapon->weapon_id = $weaponId;
                $accountWeapon->save();
            }

            // Save images
            foreach ($images as $image) {
                $path = $image->store('public/account_images');
                $accountImage = new AccountImage();
                $accountImage->account_id = $gameAccount->id;
                $accountImage->image_path = $path;
                $accountImage->save();
            }

            return $gameAccount;
        } catch (\Exception $e) {
            throw new \Exception('Không thể thêm tài khoản game: ' . $e->getMessage());
        }
    }

    public function editGameAccount($id, $data, $images)
    {
        try {
            $gameAccount = GameAccount::findOrFail($id);
            $gameAccount->title = $data['title'];
            $gameAccount->username = $data['username'];
            $gameAccount->password = bcrypt($data['password']);
            $gameAccount->server = $data['server'];
            $gameAccount->ar = $data['ar'];
            $gameAccount->game_category_id = $data['game_category_id'];
            $gameAccount->price_in = $data['price_in'] ?? 0;
            $gameAccount->price_out = $data['price_out'];
            $gameAccount->note = $data['note'] ?? null;
            $gameAccount->status = $data['status'];
            $gameAccount->save();

            // Update heroes
            AccountHero::where('account_id', $id)->delete();
            foreach ($data['heroes'] as $heroId) {
                $accountHero = new AccountHero();
                $accountHero->account_id = $gameAccount->id;
                $accountHero->hero_id = $heroId;
                $accountHero->save();
            }

            // Update weapons
            AccountWeapon::where('account_id', $id)->delete();
            foreach ($data['weapons'] as $weaponId) {
                $accountWeapon = new AccountWeapon();
                $accountWeapon->account_id = $gameAccount->id;
                $accountWeapon->weapon_id = $weaponId;
                $accountWeapon->save();
            }

            // Update images
            AccountImage::where('account_id', $id)->each(function ($accountImage) {
                Storage::delete($accountImage->image_path);
                $accountImage->delete();
            });

            foreach ($images as $image) {
                $path = $image->store('public/account_images');
                $accountImage = new AccountImage();
                $accountImage->account_id = $gameAccount->id;
                $accountImage->image_path = $path;
                $accountImage->save();
            }

            return $gameAccount;
        } catch (\Exception $e) {
            throw new \Exception('Không thể cập nhật tài khoản game: ' . $e->getMessage());
        }
    }

    public function getGameAccountById($id)
    {
        return GameAccount::findOrFail($id);
    }

    public function disableGameAccount($id)
    {
        try {
            $gameAccount = GameAccount::findOrFail($id);
            $gameAccount->status = false;
            $gameAccount->save();
        } catch (\Exception $e) {
            throw new \Exception('Không thể vô hiệu hóa tài khoản game: ' . $e->getMessage());
        }
    }

    public function storeGameAccount($id)
    {
        try {
            $gameAccount = GameAccount::findOrFail($id);
            $gameAccount->status = true;
            $gameAccount->save();
        } catch (\Exception $e) {
            throw new \Exception('Không thể khôi phục tài khoản game: ' . $e->getMessage());
        }
    }

    public function getGameDetails($categoryId)
    {
        try {
            // Tìm danh mục game
            $gameCategory = GameCategory::findOrFail($categoryId);
            $gameId = $gameCategory->game_id;

            // Lấy danh sách heroes và weapons thuộc danh mục game
            $heroes = Hero::where('game_id', $gameId)->get();
            $weapons = Weapon::where('game_id', $gameId)->get();

            return [
                'heroes' => $heroes,
                'weapons' => $weapons,
            ];
        } catch (\Exception $e) {
            throw new \Exception('Không thể lấy thông tin chi tiết game: ' . $e->getMessage());
        }
    }
}