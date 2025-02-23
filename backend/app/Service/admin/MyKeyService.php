<?php

namespace App\Service\admin;

use Illuminate\Support\Facades\Auth;
use App\Models\RerollKey;
use App\Models\RerollBill;
use App\Service\admin\RerollPackageService;

class MyKeyService
{
    private $rerollPackageService;
    
    public function __construct(RerollPackageService $rerollPackageService)
    {
        $this->rerollPackageService = $rerollPackageService;
    }

    public function getAuthKeys()
    {
        $userId = Auth::id();
        // Fetch the key IDs and their `created_at` timestamps
        $keyDetails = RerollBill::where('user_id', $userId)->select('reroll_key_id', 'created_at', 'price')->get();

        // Fetch all reroll keys in one query
        $rerollKeys = RerollKey::whereIn('id', $keyDetails->pluck('reroll_key_id'))->get();

        // Map `created_at` from the keyDetails to the corresponding reroll key
        $rerollKeys = $rerollKeys->map(function ($key) use ($keyDetails) {
            $keyDetail = $keyDetails->firstWhere('reroll_key_id', $key->id);
            $key->purchased_at = $keyDetail->created_at->format('Y-m-d H:i:s') ?? null;
            $key->price = $keyDetail->price ?? null;
            $key->rerollPackage = $this->rerollPackageService->getById($key->reroll_package_id)->name;
            return $key;
        });
        return $rerollKeys;
    }
}
