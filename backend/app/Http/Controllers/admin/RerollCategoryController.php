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
        $this->rerollCategoryService->add($request->name, $request->image, $request->note);
        return redirect(route('admin.reroll_category.index'))->with('success', 'Thêm danh mục thành công');
    }

    public function showEditRerollCategory(Request $request) {
        $id = $request->id;
        $rerollCategoryInfo = $this->rerollCategoryService->getById($id);
        return view('admin.rerollcategory.edit_rerollcategory', compact('id', 'rerollCategoryInfo'));
    }

    public function editRerollCategory(Request $request) {
        $request->validate([
            'id'=> 'required',
            'name'=> 'required',
            'note'=> 'required'
        ]);
        // Public Folder
        $this->rerollCategoryService->edit($request->id, $request->name, $request->note);
        return redirect(route('admin.reroll_category.index'))->with('success', 'Sửa danh mục thành công');
    }

    public function deleteRerollCategory(Request $request) {
        $id = $request->id;
        if(!$this->rerollCategoryService->checkHasChildren($id)) {
            $this->rerollCategoryService->delete($id);
            return redirect(route('admin.reroll_category.index'))->with('success', 'Xóa danh mục thành công') ;
        }
        return redirect(route('admin.reroll_category.index'))->with('error', 'Danh mục đang có sản phẩm không thể xóa');
    }

}
