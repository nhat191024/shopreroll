<?php

namespace App\Imports;

use App\Models\GameAccount;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class GameAccountsImport implements ToModel, WithStartRow
{
    protected $errors = []; // Khai báo biến $errors

    // Bắt đầu đọc từ dòng thứ 2
    public function startRow(): int
    {
        return 2;
    }

    public function model(array $row)
    {
        DB::beginTransaction();
        try {
            $this->validateRow($row);

            $accountImages = json_decode($row[8], true);
            $accountItems = json_decode($row[9], true);
            $accountAttributes = json_decode($row[10], true);

            $gameAccount = GameAccount::create([
                'creator_id' => Auth::id(),
                'game_id' => $row[0],
                'game_category_id' => (int) $row[1],
                'title' => $row[2],
                'username' => $row[3],
                'password' => $row[4],
                'price_in' => isset($row[5]) ? (float) $row[5] : 0,
                'price_out' => (float) $row[6],
                'note' => $row[7] ?? null,
                'status' => 1,
            ]);

            foreach ($accountImages as $image) {
                $gameAccount->images()->create(['image' => $image]);
            }

            foreach ($accountItems as $item) {
                $gameAccount->items()->create([
                    'game_account_id' => $gameAccount->id,
                    'game_item_id' => $item
                ]);
            }
            foreach ($accountAttributes as $id => $attribute) {
                $gameAccount->attributes()->create([
                    'game_account_id' => $gameAccount->id,
                    'game_attribute_id' => $id,
                    'value' => $attribute
                ]);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->errors[] = "Dòng lỗi: " . json_encode($row) . " - " . $e->getMessage();
            return null;
        }
    }

    private function validateRow($row)
    {
        $validator = Validator::make([
            'game_id' => $row[0],
            'game_category_id' => $row[1],
            'title' => $row[2],
            'username' => $row[3],
            'password' => $row[4],
            'price_in' => $row[5],
            'price_out' => $row[6],
            'note' => $row[7],
            'account_image' => $row[8],
            'account_items' => $row[9],
            'account_attributes' => $row[10],
        ], [
            'title' => 'required|string|max:255',
            'game_category_id' => 'required|integer|exists:game_categories,id',
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'price_in' => 'nullable|integer',
            'price_out' => 'required|integer',
            'note' => 'nullable|string',
            'account_image' => 'required|string',
            'account_items' => 'required|string',
            'account_attributes' => 'required|string',
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
