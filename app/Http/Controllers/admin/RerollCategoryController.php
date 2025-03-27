<?php

namespace App\Http\Controllers\admin;

use App\Models\RerollCategory;

use App\Http\Controllers\Controller;
use App\Service\admin\RerollCategoryService;

use Illuminate\Http\Request;

class RerollCategoryController extends Controller
{
    private $rerollCategoryService;

    public function __construct(RerollCategoryService $rerollCategoryService)
    {
        $this->rerollCategoryService = $rerollCategoryService;
    }

    public function index()
    {
        $rerollCategories = RerollCategory::all();
        return view('admin.RerollCategory.RerollCategory', compact('rerollCategories'));
    }

    public function create()
    {
        return view('admin.RerollCategory.AddRerollCategory');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required',
            'note' => 'required',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('image/rerollCategory'), $imageName);
            $imagePath = 'image/rerollCategory/' . $imageName;
        }

        RerollCategory::create([
            'name' => $request->name,
            'image' => $imagePath,
            'note' => $request->note,
        ]);

        return redirect(route('admin.rerollCategory.index'))->with('success', 'Thêm danh mục thành công');
    }

    public function edit($id)
    {
        $rerollCategory = RerollCategory::find($id);
        return view('admin.RerollCategory.EditRerollCategory', compact('id', 'rerollCategory'));
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'note' => 'required'
        ]);

        $rerollCategory = RerollCategory::find($id);

        $imagePath = $rerollCategory->image;
        if ($request->hasFile('image')) {
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('image/rerollCategory'), $imageName);
            $imagePath = 'image/rerollCategory/' . $imageName;
        }

        $rerollCategory->update([
            'name' => $request->name,
            'image' => $imagePath,
            'note' => $request->note,
        ]);

        return redirect(route('admin.rerollCategory.index'))->with('success', 'Sửa danh mục thành công');
    }

    public function ChangeCategoryStatus(Request $request)
    {
        $id = $request->id;
        $rerollCategoryInfo = $this->rerollCategoryService->getById($id);
        if ($rerollCategoryInfo->status == 0) {
            $this->rerollCategoryService->ChangeStatus($id, 1);
            return redirect()->back()->with('success', 'Hiện danh mục thành công');
        } else if (!$this->rerollCategoryService->checkHasChildren($id)) {
            $this->rerollCategoryService->ChangeStatus($id, 0);
            return redirect()->back()->with('success', 'Ẩn danh mục thành công');
        } else {
            return redirect()->back()->with('error', 'Danh mục đang có sản phẩm không thể Ẩn');
        }
    }
}
