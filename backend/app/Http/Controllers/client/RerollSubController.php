<?php

namespace App\Http\Controllers\client;

use App\Models\RerollSubCategory;
use Illuminate\Routing\Controller;

class RerollSubController extends Controller
{
    public function index()
    {
        $subCategories = RerollSubCategory::with('rerollPackages')->get();
        return view('client.RerollSubCategory.index', compact('subCategories'));
    }
}
