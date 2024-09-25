<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Service\admin\RerollCategoryService;
use Illuminate\Http\Request;

class RerollCategoryController extends Controller
{
    private $rerollCategoryService;
    //
    public function __construct(RerollCategoryService $rerollCategoryService) {
        $this->rerollCategoryService = $rerollCategoryService;
    }

    public function index() {
        $allRerollCategory = $this->rerollCategoryService->getAll();
        return view('admin.rerollcategory.rerollcategory',compact('allRerollCategory'));
        // return dd($allRerollCategory);
    }

    public function showAddRerollCategory() {
        return view('admin.rerollcategory.add_rerollcategory');
    }

    public function addRerollCategory(Request $request) {
        $request->validate([
            'name'=> 'required',
            'image'=> 'required',
            'note'=> 'required',
        ]);
        
        // Public Folder
        $this->rerollCategoryService->add($request->name, $request->image, $request->note, 0);
        return redirect(route('admin.reroll_category.index'))->with('success', 'Thêm danh mục thành công');
        // return redirect(route('admin.rerollcategory.rerollcategory'));
    }

    public function showEditCategory(Request $request) {
        $id = $request->id;
        $categoryInfo = $this->rerollCategoryService->getById($id);
        // return view('admin.rerollcategory.index', compact('id', 'categoryInfo'));
    }

    // public function editCategory(Request $request) {
    //     $request->validate([
    //         'name'=> 'required',
    //         'image'=> 'required',
    //         'note'=> 'required',
    //         'status'=> 'required'
    //     ]);
    //     // Public Folder
    //     $this->rerollCategoryService->edit($request->name, $request->image, $request->note, $request->status);
    //     return redirect(route('admin.category.index'))->with('success', 'Sửa danh mục thành công');
    // }

    // public function deleteCategory(Request $request) {
    //     $id = $request->id;
    //     if(!$this->categoryService->checkHasChildren($id)) {
    //         $this->categoryService->delete($id);
    //         return redirect(route('admin.category.index'))->with('success', 'Xóa danh mục thành công') ;
    //     }
    //     return redirect(route('admin.category.index'))->with('error', 'Danh mục đang có sản phẩm không thể xóa');
    // }

}
