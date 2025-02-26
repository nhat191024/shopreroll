<?php

namespace App\Imports;

use App\Models\GameAccount;
use App\Models\AccountHero;
use App\Models\AccountWeapon;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Support\Facades\Validator;

class GameAccountsImport implements ToModel, WithStartRow
{
    protected $errors = []; // Khai báo biến $errors

    public function startRow(): int
    {
        return 2; // Bắt đầu đọc từ dòng thứ 2
    }

    public function model(array $row)
    {
        try {
            // Kiểm tra dữ liệu từng dòng
            $this->validateRow($row);

            // Lưu ảnh vào thư mục nếu có

            // Thêm tài khoản game
            $gameAccount = GameAccount::create([
                'title' => $row[0],
                'username' => $row[1],
                'password' => bcrypt($row[2]),
                'server' => $row[3],
                'AR' => (int) $row[4],
                'game_category_id' => (int) $row[5],
                'price_in' => isset($row[6]) ? (float) $row[6] : 0,
                'price_out' => (float) $row[7],
                'note' => $row[8] ?? null,
                'status' => 1,
                'creator_id' => 1, // ID mặc định cho creator
                'account_image' => $row[11] ?? null, // Lưu đường dẫn ảnh vào cột account_image
            ]);

            // Xử lý tướng
            if (!empty($row[9])) {
                $heroIds = explode(',', $row[9]);
                foreach ($heroIds as $heroId) {
                    AccountHero::create([
                        'account_id' => $gameAccount->id,
                        'hero_id' => trim($heroId),
                    ]);
                }
            }

            // Xử lý vũ khí
            if (!empty($row[10])) {
                $weaponIds = explode(',', $row[10]);
                foreach ($weaponIds as $weaponId) {
                    AccountWeapon::create([
                        'account_id' => $gameAccount->id,
                        'weapon_id' => trim($weaponId),
                    ]);
                }
            }

            return $gameAccount;
        } catch (\Exception $e) {
            $this->errors[] = "Dòng lỗi: " . json_encode($row) . " - " . $e->getMessage();
            return null;
        }
    }

    private function validateRow($row)
    {
        $validator = Validator::make([
            'title' => $row[0],
            'username' => $row[1],
            'password' => $row[2],
            'server' => $row[3],
            'ar' => $row[4],
            'game_category_id' => $row[5],
            'price_in' => $row[6],
            'price_out' => $row[7],
        ], [
            'title' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'server' => 'required|string',
            'ar' => 'required|integer|min:0',
            'game_category_id' => 'required|integer|exists:game_categories,id',
            'price_in' => 'nullable|numeric|min:0',
            'price_out' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
