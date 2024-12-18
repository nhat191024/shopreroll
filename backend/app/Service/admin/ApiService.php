<?php

namespace App\Service\admin;

use App\Models\Hero;
use App\Models\Weapon;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class ApiService
{
    protected Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function hero(): array
    {
        $games = [
            [
                'gameId' => 1,
                'url' => 'https://genshin.gg/characters',
                'itemSelector' => 'a.character-portrait',
                'nameSelector' => 'h2.character-name',
                'imageSelector' => 'img.character-icon',
            ],
            [
                'gameId' => 2,
                'url' => 'https://genshin.gg/star-rail',
                'itemSelector' => 'a.character-portrait',
                'nameSelector' => 'h2.character-name',
                'imageSelector' => 'img.character-icon',
            ],
            [
                'gameId' => 3,
                'url' => 'https://genshin.gg/zzz',
                'itemSelector' => 'a.character-portrait',
                'nameSelector' => 'h2.character-name',
                'imageSelector' => 'img.character-icon',
            ],
        ];

        $allHeroes = [];

        foreach ($games as $game) {
            try {
                $response = $this->client->get($game['url'], ['verify' => false]);
                $html = $response->getBody()->getContents();
                $crawler = new Crawler($html);

                $crawler->filter($game['itemSelector'])->each(function (Crawler $node) use (&$allHeroes, $game) {
                    $heroName = $node->filter($game['nameSelector'])->text();
                    $heroImage = $node->filter($game['imageSelector'])->attr('src');

                    $allHeroes[] = [
                        'name' => trim($heroName),
                        'image' => trim($heroImage),
                        'game_id' => $game['gameId'],
                    ];

                    Hero::firstOrCreate(
                        ['name' => trim($heroName)],
                        [
                            'game_id' => $game['gameId'],
                            'image' => trim($heroImage),
                        ]
                    );
                });
            } catch (\Exception $e) {
                throw new \Exception('Error fetching heroes for game ID ' . $game['gameId'] . ': ' . $e->getMessage());
            }
        }

        return $allHeroes;
    }

    public function weapon(): array
    {
        $games = [
            [
                'gameId' => 1,
                'url' => 'https://genshin-builds.com/vi/weapons',
                'itemSelector' => 'div.flex flex-row justify-center rounded-t-lg rounded-br-3xl bg-cover genshin-bg-rarity-5',
                'nameSelector' => 'h3',
                'imageSelector' => 'img',
            ],
            [
                'gameId' => 2,
                'url' => 'https://genshin.gg/star-rail/light-cones',
                'itemSelector' => 'div.light-cones-item',
                'nameSelector' => 'img[alt]', 
                'imageSelector' => 'img',
            ],
            [
                'gameId' => 3,
                'url' => 'https://genshin.gg/zzz/w-engines',
                'itemSelector' => 'div.light-cones-item',
                'nameSelector' => 'img[alt]', 
                'imageSelector' => 'img',
            ],
        ];

        $allWeapons = [];

        foreach ($games as $game) {
            try {
                $response = $this->client->get($game['url'], ['verify' => false]);
                $html = $response->getBody()->getContents();
                $crawler = new Crawler($html);

                $crawler->filter($game['itemSelector'])->each(function (Crawler $node) use (&$allWeapons, $game) {
                    $weaponName = $node->filter($game['nameSelector'])->attr('alt') ?? $node->filter($game['nameSelector'])->text();
                    $weaponImage = $node->filter($game['imageSelector'])->attr('src');

                    $allWeapons[] = [
                        'name' => trim($weaponName),
                        'image' => trim($weaponImage),
                        'game_id' => $game['gameId'],
                    ];

                    Weapon::firstOrCreate(
                        ['name' => trim($weaponName)],
                        [
                            'game_id' => $game['gameId'],
                            'image' => trim($weaponImage),
                        ]
                    );
                });
            } catch (\Exception $e) {
                throw new \Exception('Error fetching weapons for game ID ' . $game['gameId'] . ': ' . $e->getMessage());
            }
        }

        return $allWeapons;
    }
    public function getGenshinImpactCharacters(){
        return Hero::where('game_id', 1)->get();
    }
    public function getHonkaiStarRailCharacters(){
        return Hero::where('game_id', 2)->get();
    }
    public function getZenlessZoneZeroCharacters(){
        return Hero::where('game_id', 3)->get();
    }
    public function getGenshinImpactWeapons(){
        return Weapon::where('game_id', 1)->get();
    }
    public function getHonkaiStarRailWeapons(){
        return Weapon::where('game_id', 2)->get();
    }
    public function getZenlessZoneZeroWeapons(){
        return Weapon::where('game_id', 3)->get();
    }
    public function syncHeroData()
    {
        $this->hero();
        $this->getGenshinImpactCharacters();
        $this->getHonkaiStarRailCharacters();
        $this->getZenlessZoneZeroCharacters();
    }
    public function syncWeaponData(){
        $this->weapon();
        $this->getGenshinImpactWeapons();
        $this->getHonkaiStarRailWeapons();
        $this->getZenlessZoneZeroWeapons();
    }
    
}
