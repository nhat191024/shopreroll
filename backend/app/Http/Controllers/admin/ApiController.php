<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Service\admin\ApiService;  
use Illuminate\Http\Request;

class ApiController extends Controller
{
    protected ApiService $apiService; 

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService; 
    }

    // CHARACTER CONTROLLER
    public function indexGenshinImpactChar()
    {
        try {
            $characters = $this->apiService->getGenshinImpactCharacters();
            return response()->json(['success' => true, 'data' => $characters]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function indexHonkaiStarRailChar()
    {
        try {
            $characters = $this->apiService->getHonkaiStarRailCharacters();
            return response()->json(['success' => true, 'data' => $characters]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function indexZenlessZoneZeroChar()
    {
        try {
            $characters = $this->apiService->getZenlessZoneZeroCharacters();
            return response()->json(['success' => true, 'data' => $characters]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    // WEAPON CONTROLLER
    public function indexGenshinImpactWeapon(){
        try {
            $weapons = $this->apiService->getGenshinImpactWeapons();
            return response()->json(['success' => true, 'data' => $weapons]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function indexHonkaiStarRailWeapon(){
        try {
            $weapons = $this->apiService->getHonkaiStarRailWeapons();
            return response()->json(['success' => true, 'data' => $weapons]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function indexZenlessZoneZeroWeapon(){
        try {
            $weapons = $this->apiService->getZenlessZoneZeroWeapons();
            return response()->json(['success' => true, 'data' => $weapons]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
