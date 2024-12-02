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
    public function getAllGameAccounts($categoryId = null, $status = 1)
    {
        // Khởi tạo truy vấn với điều kiện trạng thái mặc định là 1 (Hoạt động)
        $query = GameAccount::with(['gameCategory', 'creator'])
            ->where('status', $status);

        // Nếu có categoryId, thêm điều kiện lọc theo danh mục
        if ($categoryId) {
            $query->where('game_category_id', $categoryId);
        }

        return $query->get();
    }

    public function getAllGameCategories()
    {
        return GameCategory::with(['Game'])->get();
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
                $path = 'image/account_images/' . $fileName;
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


    public function editGameAccount($id, $data, $images)
    {
        try {
            $gameAccount = GameAccount::findOrFail($id);

            // Update game account details
            $gameAccount->title = $data['title'];
            $gameAccount->username = $data['username'];
            $gameAccount->password = bcrypt($data['password']);
            $gameAccount->server = $data['server'];
            $gameAccount->ar = $data['ar'];
            $gameAccount->game_category_id = $data['game_category_id'];
            $gameAccount->price_in = $data['price_in'] ?? 0;
            $gameAccount->price_out = $data['price_out'];
            $gameAccount->note = $data['note'] ?? null;
            // Update image if a new one is uploaded
            if ($images) {
                // Delete old image if it exists
                if ($gameAccount->account_image) {
                    $oldImagePath = public_path($gameAccount->account_image);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                // Save new image
                $fileName = time() . '_' . uniqid() . '.' . $images->getClientOriginalExtension();
                $path = 'account_images/' . $fileName;
                $images->move(public_path('image/account_images'), $fileName);
                $gameAccount->account_image = $path;
            }

            // Save game account
            $gameAccount->save();

            // Update heroes
            AccountHero::where('account_id', $id)->delete();
            foreach ($data['heroes'] as $heroId) {
                AccountHero::create([
                    'account_id' => $gameAccount->id,
                    'hero_id' => $heroId,
                ]);
            }

            // Update weapons
            AccountWeapon::where('account_id', $id)->delete();
            foreach ($data['weapons'] as $weaponId) {
                AccountWeapon::create([
                    'account_id' => $gameAccount->id,
                    'weapon_id' => $weaponId,
                ]);
            }

            return $gameAccount;
        } catch (\Exception $e) {
            throw new \Exception('Không thể cập nhật tài khoản game: ' . $e->getMessage());
        }
    }

    public function getGameAccountById($id)
    {
        return GameAccount::with(['AccountHero', 'AccountWeapon'])->findOrFail($id);
    }

    public function disableGameAccount($id)
    {
        try {
            $gameAccount = GameAccount::findOrFail($id);
            $gameAccount->delete();
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
