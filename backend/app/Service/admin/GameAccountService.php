<?php

namespace App\Service\admin;

use App\Models\AccountHero;
use App\Models\AccountImage;
use App\Models\AccountWeapon;
use App\Models\Hero;
use App\Models\Weapon;
use App\Models\GameAccount;
use App\Models\GameCategory;
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
            $gameAccount->creator_id = 1;
            $gameAccount->save();

            // Save heroes
            foreach ($data['heroes'] as $heroId) {
                AccountHero::create([
                    'account_id' => $gameAccount->id,
                    'hero_id' => $heroId,
                ]);
            }

            // Save weapons
            foreach ($data['weapons'] as $weaponId) {
                AccountWeapon::create([
                    'account_id' => $gameAccount->id,
                    'weapon_id' => $weaponId,
                ]);
            }

            if ($images) {
                // Đổi tên ảnh để đảm bảo tính duy nhất
                $fileName = time() . '_' . uniqid() . '.' . $images->getClientOriginalExtension();
                $path = 'account_images/' . $fileName;
                // Lưu ảnh vào public/account_images
                $images->move(public_path('image/account_images'), $fileName);
                // Cập nhật đường dẫn ảnh vào trường account_image của gameAccount
                $gameAccount->account_image = $path;
                $gameAccount->save();  // Lưu thay đổi vào cơ sở dữ liệu
            }
            return $gameAccount;
        } catch (\Exception $e) {
            throw new \Exception('Không thể thêm tài khoản game: ' . $e->getMessage());
        }
    }


    public function editGameAccount($id, $data)
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