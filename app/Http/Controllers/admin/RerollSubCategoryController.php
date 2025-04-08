<?php

namespace App\Http\Controllers\admin;

use App\Models\RerollCategory;
use App\Models\RerollSubCategory;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class RerollSubCategoryController extends Controller
{
    public function index($category)
    {
        $rerollSubCategories = $category == 0 ? RerollSubCategory::all() : RerollSubCategory::where('reroll_category_id', $category)->get();
        $categoryName = $category == 0 ? "" : RerollCategory::find($category)->name;
        return view('admin.RerollSubCategory.RerollSubCategory', compact('category', 'categoryName', 'rerollSubCategories'));
    }

    public function create()
    {
        $rerollCategories = RerollCategory::all()->pluck('name', 'id')->toArray();
        return view('admin.RerollSubCategory.AddRerollSubCategory', compact('rerollCategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required',
            'tutorial' => 'required',
            'reroll_category_id' => 'required',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('image/rerollSubCategory'), $imageName);

            $imagePath = 'image/rerollSubCategory/' . $imageName;
        }

        RerollSubCategory::create([
            'reroll_category_id' => $request->reroll_category_id,
            'name' => $request->name,
            'image' => $imagePath,
            'tutorial' => $request->tutorial,
            'id_youtube' => $request->id_youtube ?? null,
            'file_download_link' => $request->file_download_link ?? null,
            'status' => 1,
        ]);

        return redirect()->route('admin.rerollSubCategory.index', $request->reroll_category_id)->with('success', 'Thêm danh mục thành công');
    }

    public function edit($id, Request $request)
    {
        $rerollSubCategory =  RerollSubCategory::find($id);
        $rerollCategories = RerollCategory::all()->pluck('name', 'id')->toArray();
        return view('admin.RerollSubCategory.EditRerollSubCategory', compact('rerollSubCategory', 'rerollCategories'));
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'tutorial' => 'required',
            'reroll_category_id' => 'required',
        ]);

        $rerollSubCategory = RerollSubCategory::find($id);

        $imagePath = $rerollSubCategory->image;
        if ($request->hasFile('image')) {
            if (file_exists(public_path($rerollSubCategory->image))) {
                unlink(public_path($rerollSubCategory->image));
            }

            $image = $request->file('image');

            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('image/rerollSubCategory'), $imageName);

            $imagePath = 'image/rerollSubCategory/' . $imageName;
        }

        $rerollSubCategory->update([
            'reroll_category_id' => $request->reroll_category_id,
            'name' => $request->name,
            'image' => $imagePath,
            'tutorial' => $request->tutorial,
            'id_youtube' => $request->id_youtube ?? null,
            'file_download_link' => $request->file_download_link ?? null,
        ]);

        return redirect()->route('admin.rerollSubCategory.index', $request->reroll_category_id)->with('success', 'Sửa danh mục thành công');
    }

    public function changeCategoryStatus($id)
    {
        $subCategory = RerollSubCategory::find($id);

        if (!$subCategory) {
            return redirect(route('admin.rerollSubCategory.index'))->with('error', 'Danh mục không tồn tại');
        }

        if ($subCategory->status == 0) {
            $subCategory->status = 1;
            $subCategory->save();

            return redirect(route('admin.rerollSubCategory.index'))->with('success', 'Hiện danh mục thành công');
        }

        $hasPackages = $subCategory->RerollPackage()->exists();

        if (!$hasPackages) {
            $subCategory->status = 0;
            $subCategory->save();

            return redirect(route('admin.rerollSubCategory.index'))->with('success', 'Ẩn danh mục thành công');
        }

        return redirect(route('admin.rerollSubCategory.index'))->with('error', 'Danh mục đang có sản phẩm không thể Ẩn');
    }
}
