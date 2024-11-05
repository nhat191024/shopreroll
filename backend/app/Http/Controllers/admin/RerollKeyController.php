<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Service\admin\RerollKeyService;
use App\Service\admin\RerollPackageService;
use Illuminate\Http\Request;

class RerollKeyController extends Controller
{
    private $rerollKeyService;
    private $RerollPackageService;

    public function __construct(RerollKeyService $rerollKeyService, RerollPackageService $RerollPackageService)
    {
        $this->rerollKeyService = $rerollKeyService;
        $this->RerollPackageService = $RerollPackageService;
    }

    public function index($idPackage)
    {
        $allRerollKeys = $this->RerollPackageService->getChildren($idPackage);
        return view('admin.RerollKey.RerollKey', compact('allRerollKeys', 'idPackage'));
    }

    public function showAddRerollKey($idPackage)
    {
        $allRerollPackage = $this->RerollPackageService->getAll()->pluck('name', 'id')->toArray();
        return view('admin.RerollKey.AddRerollKey', compact('allRerollPackage', 'idPackage'));
    }

    public function addRerollKey(Request $request, $idPackage)
    {
        $request->validate([
            'key' => 'required',
        ]);

        $this->rerollKeyService->add(
            $request->key,
            $request->idPackage
        );

        return redirect(route('admin.RerollKey.index', ['idPackage' => $idPackage]))->with('success', 'Thêm key thành công');
    }

    public function showEditRerollKey($idPackage, $idKey)
    {
        $rerollKeyInfo = $this->rerollKeyService->getById($idKey);
        // $allRerollPackage = $this->RerollPackageService->getAll()->pluck('name', 'id')->toArray();
        return view('admin.RerollKey.EditRerollKey', compact('idKey', 'rerollKeyInfo', 'idPackage'));
    }

    public function editRerollKey(Request $request, $idPackage)
    {
        $request->validate([
            'idKey' => 'required',
            'key' => 'required',
        ]);

        $rerollKey = $this->rerollKeyService->getById($request->idKey);

        if (!$rerollKey) {
            return redirect(route('admin.RerollKey.index', ['idPackage' => $idPackage]))->with('error', 'Key không tìm thấy');
        }

        $this->rerollKeyService->edit(
            $request->idKey,
            $request->key,
        );

        return redirect(route('admin.RerollKey.index' , ['idPackage' => $idPackage]))->with('success', 'Sửa key thành công');
    }
    public function deleteRerollPackage($idPackage, $idKey) {
        $rerollKeyInfo = $this->rerollKeyService->getById($idKey);

        if (!$rerollKeyInfo) {
            return redirect(route('admin.RerollKey.index' , ['idPackage' => $idPackage]))->with('error', 'Key not found');
        }
        if ($this->rerollKeyService->checkHasChildren($idKey)){
            return redirect(route('admin.RerollKey.index' , ['idPackage' => $idPackage]))->with('error', 'Danh mục đang có sản phẩm không thể xóa');
        }else{
            $this->rerollKeyService->delete($idKey);
            return redirect(route('admin.RerollKey.index' , ['idPackage' => $idPackage]))->with('success', 'Xóa danh mục thành công');
        }
    }
}
