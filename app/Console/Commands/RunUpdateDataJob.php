<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Service\admin\ApiService;

class RunUpdateDataJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:run-update-data-job';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch and update character and weapon data every  day';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $apiService = new ApiService();

        // Call function in ApiService
        $apiService->getGenshinImpactCharacters();
        $apiService->getHonkaiStarRailCharacters();
        $apiService->getZenlessZoneZeroCharacters();
        $apiService->getGenshinImpactWeapons();
        $apiService->getHonkaiStarRailWeapons();
        $apiService->getZenlessZoneZeroWeapons();

        $this->info('Data update job has been executed successfully.');
    }
}
