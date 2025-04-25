<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\RerollBill;
use App\Service\admin\MyKeyService;
// use Clockwork\Request\Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyKeyController extends Controller
{
    private $myKeyService;

    public function __construct()
    {
        $this->myKeyService = app(MyKeyService::class);
    }

    public function index()
    {
        $this->myKeyService->getKeysHistory(); //! deprecated

        $keys = RerollBill::where('user_id', Auth::user()->id)->get();
        return view('client.myKey.index', compact('keys'));
    }
}
