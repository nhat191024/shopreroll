<?php

use App\Service\admin\ApiService;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();
Artisan::command('game:update-data', function (ApiService $apiService) {
    try {
        // CALL FUNCTION TO GET DATA FROM SERVICE
        $apiService->getGenshinImpactCharacters();
        $apiService->getHonkaiStarRailCharacters();
        $apiService->getZenlessZoneZeroCharacters();
        $apiService->getGenshinImpactWeapons();
        $apiService->getHonkaiStarRailWeapons();
        $apiService->getZenlessZoneZeroWeapons();

        $this->info('Game data updated successfully!');
    } catch (\Exception $e) {
        $this->error('Error updating game data: ' . $e->getMessage());
    }
})->purpose('Update game character and weapon data');

// UPDATE PER 3 DAYS
Artisan::command('schedule:run', function () {
    $this->call('game:update-data');
})->everyThreeDays()->purpose('Schedule the game data update');