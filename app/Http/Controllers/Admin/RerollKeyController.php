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
        $rerollKeys = RerollKey::where('reroll_package_id', $idPackage)->get();
        $rerollPackage = RerollPackage::find($idPackage);
        $packageName = $rerollPackage ? $rerollPackage->name : null;
        $idSubCategory = $rerollPackage ? $rerollPackage->reroll_sub_category_id : null;

        return view('admin.RerollKey.rerollKey', compact('rerollKeys', 'packageName', 'idSubCategory', 'idPackage'));
    }

    public function create($package)
    {
        $rerollPackageName = RerollPackage::find($package)->name;
        return view('admin.RerollKey.addRerollKey', compact('rerollPackageName', 'package'));
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
        $rerollPackageName = $key->RerollPackage->name;
        $rerollPackage = $key->reroll_package_id;
        return view('admin.RerollKey.editRerollKey', compact('key', 'rerollPackage', 'rerollPackageName'));
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
            return redirect()->back()->with('error', 'Key không tồn tại');
        }

        $key->delete();
        return redirect(route('admin.rerollKey.index', $key->reroll_package_id))->with('success', 'Xóa key thành công');
    }
}
