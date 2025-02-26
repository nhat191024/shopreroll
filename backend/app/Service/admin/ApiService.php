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
    // function get Characters
    public function getCharacters(int $gameId, string $url, string $nameSelector, string $imageSelector): array
    {
        try {
            $response = $this->client->get($url, ['verify' => false]);
            $html = $response->getBody()->getContents();
            $crawler = new Crawler($html);


            $crawler->filter($nameSelector)->each(function (Crawler $node) use (&$characters, $gameId, $imageSelector) {
                $characterName = $node->filter('h2.character-name')->text();
                $characterImage = $node->filter($imageSelector)->attr('src');

                // $characters[] = [
                //     'name' => trim($characterName),
                //     'image' => trim($characterImage),
                // ];
                // Add character to database
                Hero::firstOrCreate(
                    ['name' => trim($characterName)],
                    [
                        'game_id' => $gameId,
                        'image' => trim($characterImage),
                    ]
                );
            });
            return Hero::where('game_id', $gameId)
                ->get(['name', 'image'])
                ->toArray();
        } catch (\Exception $e) {
            throw new \Exception('Error fetching characters: ' . $e->getMessage());
        }
    }
    // function get Weapons
    public function getWeapons(int $gameId, string $url, string $nameSelector, string $imageSelector): array
    {
        try {
            $response = $this->client->get($url, ['verify' => false]);
            $html = $response->getBody()->getContents();
            $crawler = new Crawler($html);

            // $weapons = [];

            $crawler->filter($nameSelector)->each(function (Crawler $node) use (&$weapons, $gameId, $imageSelector) {
                $weaponName = $node->filter('img')->attr('alt');
                $weaponImage = $node->filter($imageSelector)->attr('src');

                if (!empty($weaponName) && !empty($weaponImage)) {
                    // $weapons[] = [
                    //     'name' => trim($weaponName),
                    //     'image' => trim($weaponImage),
                    // ];
                    // Add waepon to database
                    Weapon::firstOrCreate(
                        ['name' => trim($weaponName)],
                        [
                            'game_id' => $gameId,
                            'image' => trim($weaponImage),
                        ]
                    );
                }
            });

            return Weapon::where('game_id', $gameId)
                ->get(['name', 'image'])
                ->toArray();
        } catch (\Exception $e) {
            throw new \Exception('Error fetching weapons: ' . $e->getMessage());
        }
    }

    // Call this function with the appropriate parameters
    // // Update in there
    // public function get_Sth()
    // {
    //     return $this->get_Sth(game_id, 'crawl url', 'tag', 'img-tag');
    // }
    public function getGenshinImpactCharacters()
    {
        return $this->getCharacters(1, 'https://genshin.gg/characters', 'a.character-portrait', 'img.character-icon');
    }

    public function getHonkaiStarRailCharacters()
    {
        return $this->getCharacters(2, 'https://genshin.gg/star-rail', 'a.character-portrait', 'img.character-icon');
    }

    public function getZenlessZoneZeroCharacters()
    {
        return $this->getCharacters(3, 'https://genshin.gg/zzz', 'a.character-portrait', 'img.character-icon');
    }

    public function getGenshinImpactWeapons()
    {
        return $this->getWeapons(1, 'https://genshin-builds.com/vi/weapons', 'div.flex.flex-row.justify-center.rounded-t-lg', 'img');
    }

    public function getHonkaiStarRailWeapons()
    {
        return $this->getWeapons(2, 'https://genshin.gg/star-rail/light-cones', 'div.light-cones-item', 'img');
    }

    public function getZenlessZoneZeroWeapons()
    {
        return $this->getWeapons(3, 'https://genshin.gg/zzz/w-engines', 'div.light-cones-item', 'img');
    }
}
