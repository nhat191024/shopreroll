<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Service\admin\RerollCategoryService;
use Illuminate\Http\Request;

class RerollCategoryController extends Controller
{
    private $rerollCategoryService;
    //
    public function __construct(RerollCategoryService $rerollCategoryService)
    {
        $this->rerollCategoryService = $rerollCategoryService;
    }

    public function index()
    {
        $allRerollCategory = $this->rerollCategoryService->getAll();
        return view('admin.RerollCategory.RerollCategory', compact('allRerollCategory'));
        // return dd($allRerollCategory);
    }

    public function showAddRerollCategory()
    {
        return view('admin.RerollCategory.AddRerollCategory');
    }

    public function addRerollCategory(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required',
            'note' => 'required',
        ]);

        // Public Folder
        $this->rerollCategoryService->add($request->name, $request->image, $request->note);
        return redirect(route('admin.RerollCategory.index'))->with('success', 'Thêm danh mục thành công');
    }

    public function showEditRerollCategory(Request $request)
    {
        $id = $request->id;
        $rerollCategoryInfo = $this->rerollCategoryService->getById($id);
        return view('admin.RerollCategory.EditRerollCategory', compact('id', 'rerollCategoryInfo'));
    }

    public function detailRerollCategory(Request $request)
    {
        $id = $request->id;
        $allRerollSubCategory = $this->rerollCategoryService->getChildren($id);
        return view('admin.RerollCategory.EditRerollCategory', compact('allRerollSubCategory'));
    }
    public function editRerollCategory(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'note' => 'required'
        ]);
        // Public Folder
        $this->rerollCategoryService->edit($request->id, $request->name, $request->note);
        return redirect(route('admin.RerollCategory.index'))->with('success', 'Sửa danh mục thành công');
    }

    public function ChangeCategoryStatus(Request $request)
    {
        $id = $request->id;
        $rerollCategoryInfo = $this->rerollCategoryService->getById($id);
        if ($rerollCategoryInfo->status == 0) {
            $this->rerollCategoryService->ChangeStatus($id, 1);
            return redirect(route('admin.RerollCategory.index'))->with('success', 'Hiện danh mục thành công');
        } else if (!$this->rerollCategoryService->checkHasChildren($id)) {
            $this->rerollCategoryService->ChangeStatus($id, 0);
            return redirect(route('admin.RerollCategory.index'))->with('success', 'Ẩn danh mục thành công');
        } else {
            return redirect(route('admin.RerollCategory.index'))->with('error', 'Danh mục đang có sản phẩm không thể ẩn');
        }
    }
}
