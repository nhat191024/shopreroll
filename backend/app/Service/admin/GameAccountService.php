<?php

namespace App\Service\admin;

use App\Models\GameAccount;

class GameAccountService
{
    public function getAll()
    {
        $accounts = GameAccount::all();
        return $accounts;
    }

    public function getById($id)
    {
        return GameAccount::where('id', $id)->first();
    }

    public function store($data)
    {
        $account = GameAccount::create($data->except(['_token']));
        return $account;
    }

    public function edit($id, $data)
    {
        $account = GameAccount::findOrFail($id);
        $account->update($data->except(['_token', 'id']));
        return $account;
    }

    public function delete($id)
    {
        $account = GameAccount::findOrFail($id);
        $account->status = 2;
        $account->save();
        return $account;
    }
}
