<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hero;
use App\Models\Weapon;
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
    public function indexGameCharacters($slug)
    {
        try {
            switch ($slug) {
                
                case 'genshin-impact':
                    $characters = $this->apiService->getGenshinImpactCharacters();
                    $game_name = 'Genshin Impact';
                    break;
                case 'honkai-star-rail':
                    $characters = $this->apiService->getHonkaiStarRailCharacters();
                    $game_name = 'Honkai Star Rail';
                    break;
                case 'zenless-zone-zero':
                    $characters = $this->apiService->getZenlessZoneZeroCharacters();
                    $game_name = 'Zenless Zone Zero';
                    break;
                default:
                    throw new \Exception('Đường dẫn không hợp lệ.');
            }
            $date = Hero::select('updated_at')->first();
            return view('admin.character.index', compact('characters', 'game_name','date'));
        } catch (\Exception $e) {
            return back()->withErrors(['message' => $e->getMessage()]);
        }
    }
    


    // WEAPON CONTROLLER
    // public function indexGenshinImpactWeapon(){
    //     try {
    //         $weapons = $this->apiService->getGenshinImpactWeapons();
    //         return response()->json(['success' => true, 'data' => $weapons]);
    //     } catch (\Exception $e) {
    //         return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    //     }
    // }

    // public function indexHonkaiStarRailWeapon(){
    //     try {
    //         $weapons = $this->apiService->getHonkaiStarRailWeapons();
    //         return response()->json(['success' => true, 'data' => $weapons]);
    //     } catch (\Exception $e) {
    //         return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    //     }
    // }

    // public function indexZenlessZoneZeroWeapon(){
    //     try {
    //         $weapons = $this->apiService->getZenlessZoneZeroWeapons();
    //         return response()->json(['success' => true, 'data' => $weapons]);
    //     } catch (\Exception $e) {
    //         return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    //     }
    // }
    public function indexGameWeapons($slug)
{
    try {
        switch ($slug) {
            case 'genshin-impact':
                $weapons = $this->apiService->getGenshinImpactWeapons();
                $game_name = 'Genshin Impact';
                break;
            case 'honkai-star-rail':
                $weapons = $this->apiService->getHonkaiStarRailWeapons();
                $game_name = 'Honkai Star Rail';
                break;
            case 'zenless-zone-zero':
                $weapons = $this->apiService->getZenlessZoneZeroWeapons();
                $game_name = 'Zenless Zone Zero';
                break;
            default:
                return response()->json(['success' => false, 'message' => 'Invalid game slug'], 400);
        }
        $date = Weapon::select('updated_at')->first();
        // Truyền dữ liệu weapons và game_name vào view
        return view('admin.weapon.index', compact('weapons', 'game_name','date'));
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    }
}

}
