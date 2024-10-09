<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Service\admin\RerollPackageService;
use App\Service\admin\RerollSubCategoryService;
use Illuminate\Http\Request;

class RerollPackageController extends Controller
{
    private $rerollPackageService;
    private $rerollSubCategoryService;

    public function __construct(RerollPackageService $rerollPackageService, RerollSubCategoryService $rerollSubCategoryService) {
        $this->rerollSubCategoryService = $rerollSubCategoryService;
        $this->rerollPackageService = $rerollPackageService;
    }

    // Index method to show all reroll packages
    public function index() {
        $allRerollPackagies = $this->rerollPackageService->getAll();
        return view('admin.RerollPackage.RerollPackage', compact('allRerollPackagies'));
    }

    // Show the form for adding a new reroll package
    public function showAddRerollPackage() {
        // Fetch all subcategories to display in the dropdown for package creation
        $allRerollSubCategories = $this->rerollSubCategoryService->getAll()->pluck('name', 'id')->toArray();
        return view('admin.RerollPackage.addRerollPackage', compact('allRerollSubCategories'));
    }

    // Add a new reroll package
    public function addRerollPackage(Request $request) {
        $request->validate([
            'reroll_sub_category_id' => 'required',
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        // Add the new reroll package using the service
        $this->rerollPackageService->add(
            $request->reroll_sub_category_id,
            $request->name,
            $request->price
        );

        return redirect(route('admin.RerollPackage.index'))->with('success', 'Reroll package added successfully.');
    }

    // Show the form for editing an existing reroll package
    public function showEditRerollPackage($id) {
        // Fetch the reroll package and all subcategories for editing
        $rerollPackage = $this->rerollPackageService->getById($id);
        $allRerollSubCategories = $this->rerollSubCategoryService->getAll()->pluck('name', 'id')->toArray();

        if (!$rerollPackage) {
            return redirect(route('admin.RerollPackage.index'))->with('error', 'Package not found');
        }

        return view('admin.RerollPackage.editRerollPackage', compact('rerollPackage', 'allRerollSubCategories'));
    }

    // Edit an existing reroll package
    public function editRerollPackage(Request $request) {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'price' => 'required|numeric',
            'reroll_sub_category_id' => 'required',
        ]);

        $rerollPackage = $this->rerollPackageService->getById($request->id);

        if (!$rerollPackage) {
            return redirect(route('admin.RerollPackage.index'))->with('error', 'Package not found');
        }

        // Update the reroll package using the service
        $this->rerollPackageService->edit(
            $request->id,
            $request->reroll_sub_category_id,
            $request->name,
            $request->price
        );

        return redirect(route('admin.RerollPackage.index'))->with('success', 'Package updated successfully.');
    }

    // Change the visibility status of a package (e.g., toggle between active and inactive)
    public function deleteRerollPackage($id) {
        $rerollPackage = $this->rerollPackageService->getById($id);

        if (!$rerollPackage) {
            return redirect(route('admin.RerollPackage.index'))->with('error', 'Package not found');
        }
        if ($this->rerollPackageService->checkHasChildren($id)){
            return redirect(route('admin.RerollPackage.index'))->with('error', 'Danh mục đang có sản phẩm không thể xóa');
        }else{
            $this->rerollPackageService->delete($id);
            return redirect(route('admin.RerollPackage.index'))->with('success', 'Xóa danh mục thành công');
        }
    }
}
