<?php

namespace App\Http\Controllers\Admin;

use App\Models\RerollPackage;
use App\Models\RerollSubCategory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RerollPackageController extends Controller
{
    public function index($subCategory)
    {
        $packages = RerollPackage::where('reroll_sub_category_id', $subCategory)->get();
        $subCategory = RerollSubCategory::find($subCategory);
        $subCategoryName = $subCategory ? $subCategory->name : null;
        $subCategoryId = $subCategory ? $subCategory->id : null;
        $categoryId = $subCategory ? $subCategory->reroll_category_id : null;

        return view('admin.RerollPackage.RerollPackage', compact('categoryId', 'subCategoryName', 'packages', 'subCategoryId'));
    }

    public function create($subCategory)
    {
        $subCategoryName = RerollSubCategory::find($subCategory)->name;
        return view('admin.RerollPackage.addRerollPackage', compact('subCategory', 'subCategoryName'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'reroll_sub_category_id' => 'required',
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        RerollPackage::create([
            'reroll_sub_category_id' => $request->reroll_sub_category_id,
            'name' => $request->name,
            'price' => $request->price,
        ]);

        return redirect()->route('admin.rerollPackage.index', $request->reroll_sub_category_id)->with('success', 'Thêm gói reroll thành công');
    }

    public function edit($id)
    {
        $package = RerollPackage::find($id);
        $subCategories = RerollSubCategory::all()->pluck('name', 'id')->toArray();
        return view('admin.RerollPackage.editRerollPackage', compact('package', 'subCategories'));
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'reroll_sub_category_id' => 'required',
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        $package = RerollPackage::find($id);

        $package->update([
            'reroll_sub_category_id' => $request->reroll_sub_category_id,
            'name' => $request->name,
            'price' => $request->price,
        ]);

        return redirect()->route('admin.rerollPackage.index', $request->reroll_sub_category_id)->with('success', 'Cập nhật gói reroll thành công');
    }

    public function destroy($id)
    {
        $package = RerollPackage::find($id);
        if (!$package) {
            return redirect()->back()->with('error', 'Gói reroll không tồn tại');
        }

        $package->delete();
        return redirect(route('admin.rerollPackage.index', $package->reroll_sub_category_id))->with('success', 'Xóa gói reroll thành công');
    }
}
