<?php

namespace App\Http\Controllers\Admin;

use App\Models\Game;
use App\Models\GameAccount;
use App\Models\GameCategory;

use App\Http\Requests\StoreGameAccountRequest;
use App\Http\Requests\UpdateGameAccountRequest;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GameAccountController extends Controller
{
    public function index(Game $game, Request $request)
    {
        $categoryId = $request->get('category_id');
        $status = $request->get('status', 1);

        $categories = $game->GameCategory->pluck('name', 'id');
        $categoryName = $categoryId ? GameCategory::find($categoryId)->name : 'chung';

        $accountsQuery = GameAccount::with(['gameCategory', 'creator'])
            ->where('game_id', $game->id)
            ->where('status', $status);

        if ($categoryId) {
            $accountsQuery->where('game_category_id', $categoryId);
        }

        $accounts = $accountsQuery->get();

        return view('admin.game_accounts.index', compact('game', 'categories', 'categoryName', 'accounts'));
    }

    public function create(Game $game)
    {
        $categories = GameCategory::where('game_id', $game->id)->get();
        $itemTypes = $game->GameItemType;
        $gameAttributes = $game->GameAttribute->pluck('name', 'id');
        return view('admin.game_accounts.add', compact('game', 'categories', 'itemTypes', 'gameAttributes'));
    }

    public function store($game, StoreGameAccountRequest $request)
    {
        DB::beginTransaction();
        try {
            $account = GameAccount::create([
                'creator_id' => Auth::id(),
                'game_id' => $game,
                'game_category_id' => $request->game_category_id,
                'title' => $request->title,
                'username' => $request->username,
                'password' => $request->password,
                'price_in' => $request->price_in ?? 0,
                'price_out' => $request->price_out,
                'note' => $request->note,
                'status' => 1,
            ]);

            foreach ($request->game_items as $itemType) {
                foreach ($itemType as $item) {
                    $account->AccountItem()->create([
                        'game_item_id' => $item,
                    ]);
                }
            }

            foreach ($request->game_attributes as $attributeId => $attribute) {
                $account->AccountAttribute()->create([
                    'game_attribute_id' => $attributeId,
                    'value' => $attribute[0],
                ]);
            }

            if ($request->hasFile('account_images')) {
                $path = 'image/accounts/';
                foreach ($request->file('account_images') as $image) {
                    $filename = uniqid() . '_' . time() . $image->getClientOriginalExtension();
                    $image->move(public_path($path), $filename);

                    $account->AccountImage()->create([
                        'image' => $path . '/' . $filename
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('admin.game_account.index', $game)->with('success', 'Thêm tài khoản game thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Lỗi: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $account = GameAccount::findOrFail($id)->load('AccountItem', 'AccountAttribute', 'AccountImage');
        $game = $account->Game;
        $categories = GameCategory::where('game_id', $game->id)->get();
        $itemTypes = $game->GameItemType;
        $accountItems = $account->AccountItem->pluck('game_item_id')->toArray();
        $gameAttributes = $game->GameAttribute->pluck('name', 'id');
        return view('admin.game_accounts.edit', compact('game', 'account', 'categories', 'itemTypes', 'accountItems', 'gameAttributes'));
    }

    public function update($account, UpdateGameAccountRequest $request)
    {
        DB::beginTransaction();
        try {
            $account = GameAccount::findOrFail($account);

            $account->update([
                'game_category_id' => $request->game_category_id,
                'title' => $request->title,
                'username' => $request->username,
                'password' => $request->password,
                'price_in' => $request->price_in ?? 0,
                'price_out' => $request->price_out,
                'note' => $request->note,
            ]);

            $account->AccountAttribute()->delete();
            $account->AccountItem()->delete();

            foreach ($request->game_items as $itemType) {
                foreach ($itemType as $item) {
                    $account->AccountItem()->create([
                        'game_item_id' => $item,
                    ]);
                }
            }

            foreach ($request->game_attributes as $attributeId => $attribute) {
                $account->AccountAttribute()->create([
                    'game_attribute_id' => $attributeId,
                    'value' => $attribute[0],
                ]);
            }

            if ($request->hasFile('account_images')) {
                foreach ($account->AccountImage as $image) {
                    $path = public_path($image->image);
                    if (file_exists($path)) {
                        unlink($path);
                    }
                }
                $account->AccountImage()->delete();

                $path = 'image/accounts/';
                foreach ($request->file('account_images') as $image) {
                    $filename = uniqid() . '_' . time() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path($path), $filename);

                    $account->AccountImage()->create([
                        'image' => $path . $filename
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('admin.game_account.index', $account->game_id)->with('success', 'Cập nhật tài khoản game thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Lỗi: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $account = GameAccount::findOrFail($id);
            $account->AccountAttribute()->delete();
            $account->AccountItem()->delete();
            foreach ($account->AccountImage as $image) {
                $path = public_path($image->image);
                if (file_exists($path)) {
                    unlink($path);
                }
            }
            $account->AccountImage()->delete();
            $account->delete();
            return redirect()->back()->with('success', 'Xóa tài khoản game thành công');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Lỗi: ' . $e->getMessage());
        }
    }
}
