<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Service\admin\MyKeyService;
// use Clockwork\Request\Request;
use Illuminate\Http\Request;

class MyKeyController extends Controller
{
    private $myKeyService;

    public function __construct()
    {
        $this->myKeyService = app(MyKeyService::class);
    }

    public function index()
    {
        $keys = $this->myKeyService->getKeysHistory();
        return view('client.myKey.index', compact('keys'));
    }
}
