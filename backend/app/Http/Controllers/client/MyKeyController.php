<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
// use App\Service\client\ProductService;
// use App\Service\client\ShopService;
// use Clockwork\Request\Request;
use Illuminate\Http\Request;

class ShopController extends Controller
{

    public function __construct()
    {
    }
    public function index()
    {
        return view('client.myKey.index');
    }
}