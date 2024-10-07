<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Service\admin\RerollSubCategoryService;
use App\Service\admin\RerollCategoryService;
use Illuminate\Http\Request;

class RerollSubCategoryController extends Controller
{
    private $rerollSubCategoryService;
    private $rerollCategoryService;

    public function __construct(RerollSubCategoryService $rerollSubCategoryService, RerollCategoryService $rerollCategoryService) {
        $this->rerollSubCategoryService = $rerollSubCategoryService;
        $this->rerollCategoryService = $rerollCategoryService;
    }

    public function index() {
        $allRerollSubCategory = $this->rerollSubCategoryService->getAll();
        return view('admin.rerollsubcategory.rerollsubcategory', compact('allRerollSubCategory'));
    }

    public function showAddRerollSubCategory() {
        $allRerollCategories = $this->rerollCategoryService->getAll()->pluck('name', 'id')->toArray();
        return view('admin.rerollsubcategory.add_rerollsubcategory', compact('allRerollCategories'));
    }

    public function addRerollSubCategory(Request $request) {
        $request->validate([
            'name' => 'required',
            'image' => 'required',
            'tutorial' => 'required',
            'reroll_category_id' => 'required', // Assuming this is required
        ]);

        $this->rerollSubCategoryService->add(
            $request->reroll_category_id,
            $request->name,
            $request->tutorial,
            $request->id_youtube,
            $request->file_download_link,
            $request->image
        );
        // dd($request);
        return redirect(route('admin.reroll_sub_category.index'))->with('success', 'Thêm danh mục thành công');
    }

    public function showEditRerollSubCategory(Request $request) {
        $idRerollSubCategory = $request->id;
        $rerollSubCategoryInfo = $this->rerollSubCategoryService->getById($idRerollSubCategory);
        $rerollCategories = $this->rerollCategoryService->getAll()->pluck('name', 'id')->toArray();
        return view('admin.rerollsubcategory.edit_rerollsubcategory', compact('idRerollSubCategory', 'rerollSubCategoryInfo', 'rerollCategories'));
    }

    public function editRerollSubCategory(Request $request) {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'tutorial' => 'required',
            'reroll_category_id' => 'required', // Assuming this is required
        ]);
        // dd($request);
        $rerollSubCategory = $this->rerollSubCategoryService->getById($request->id);

        if (!$rerollSubCategory) {
            return redirect(route('admin.reroll_sub_category.index'))->with('error', 'Danh mục không tìm thấy');
        }

        $this->rerollSubCategoryService->edit(
            $request->id,
            $request->reroll_category_id,
            $request->name,
            $request->tutorial,
            $request->id_youtube,
            $request->file_download_link
        );

        return redirect(route('admin.reroll_sub_category.index'))->with('success', 'Sửa danh mục thành công');
    }
    public function detailRerollSubCategory(Request $request) {
        $idRerollPackage = $request->id;
        $allRerollPackagies = $this->rerollSubCategoryService->getChildren($idRerollPackage);
        return view('admin.RerollPackage.RerollPackage', compact('allRerollPackagies'));}
    public function ChangeCategoryStatus(Request $request) {
        $id = $request->id;
        $subCategoryInfo = $this->rerollSubCategoryService->getById($id);
        if($subCategoryInfo->status==0){
            $this->rerollSubCategoryService->ChangeStatus($id, 1);
            return redirect(route('admin.reroll_sub_category.index'))->with('success', 'Hiện danh mục thành công');
        }
        else if(!$this->rerollSubCategoryService->checkHasChildren($id)) {
            $this->rerollSubCategoryService->ChangeStatus($id, 0);
            return redirect(route('admin.reroll_sub_category.index'))->with('success', 'Ẩn danh mục thành công');
        }else{
            return redirect(route('admin.reroll_sub_category.index'))->with('error', 'Danh mục đang có sản phẩm không thể Ẩn');
        }
        }
}
