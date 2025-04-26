<?php

namespace App\Http\Controllers\Admin;

use App\Models\RerollKey;
use App\Models\RerollPackage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RerollKeyController extends Controller
{
    public function index($idPackage)
    {
        $rerollKeys = $idPackage == 0 ? RerollKey::all() : RerollKey::where('reroll_package_id', $idPackage)->get();
        $packageName = $idPackage == 0 ? "" : RerollPackage::find($idPackage)->name;
        return view('admin.RerollKey.rerollKey', compact('rerollKeys', 'packageName', 'idPackage'));
    }

    public function create($package)
    {
        $rerollPackage = RerollPackage::all()->pluck('name', 'id')->toArray();
        return view('admin.RerollKey.addRerollKey', compact('rerollPackage', 'package'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'key' => 'required',
            'package_id' => 'required',
        ]);

        RerollKey::create([
            'key' => $request->key,
            'reroll_package_id' => $request->package_id,
        ]);

        return redirect(route('admin.rerollKey.index', $request->package_id))->with('success', 'Thêm key thành công');
    }

    public function edit($id)
    {
        $key = RerollKey::find($id);
        $rerollPackage = RerollPackage::all()->pluck('name', 'id')->toArray();
        return view('admin.RerollKey.editRerollKey', compact('key', 'rerollPackage'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'key' => 'required',
            'package_id' => 'required',
        ]);

        $key = RerollKey::find($id);

        $key->update([
            'key' => $request->key,
            'reroll_package_id' => $request->package_id,
        ]);

        return redirect(route('admin.rerollKey.index', $request->package_id))->with('success', 'Cập nhập key thành công');
    }

    public function destroy($id)
    {
        $key = RerollKey::find($id);
        if (!$key) {
            return redirect(route('admin.rerollKey.index', $key->reroll_package_id))->with('error', 'Key không tồn tại');
        }

        $key->delete();
        return redirect(route('admin.rerollKey.index', $key->reroll_package_id))->with('success', 'Xóa key thành công');
    }
}
