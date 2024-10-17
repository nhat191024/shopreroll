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
    // CHARACTER CRAWL DATA
    // Lấy nhân vật từ Genshin Impact (ID = 1)
    public function getGenshinImpactCharacters(): array
    {
        $url = 'https://genshin.gg/characters';
        $gameId = 1; // ID cho Genshin Impact
    
        try {
            $response = $this->client->get($url, ['verify' => false]);
            $html = $response->getBody()->getContents();
            $crawler = new Crawler($html);
    
            $characters = [];
    
            $crawler->filter('a.character-portrait')->each(function (Crawler $node) use (&$characters, $gameId) {
                $characterName = $node->filter('h2.character-name')->text();
                $characterImage = $node->filter('img.character-icon')->attr('src');
    
                $characters[] = [
                    'name' => trim($characterName),
                    'image' => trim($characterImage),
                ];
    
                Hero::firstOrCreate(
                    ['name' => trim($characterName)], 
                    [
                        'game_id' => $gameId, 
                        'image' => trim($characterImage),
                    ]
                );
            });
    
            return $characters;
        } catch (\Exception $e) {
            throw new \Exception('Error fetching Genshin Impact characters: ' . $e->getMessage());
        }
    }

    // Lấy nhân vật từ Honkai Star Rail (ID = 2)
    public function getHonkaiStarRailCharacters(): array
    {
        $url = 'https://genshin.gg/star-rail';
        $gameId = 2; // ID cho Honkai Star Rail
    
        try {
            $response = $this->client->get($url, ['verify' => false]);
            $html = $response->getBody()->getContents();
            $crawler = new Crawler($html);
    
            $characters = [];
    
            $crawler->filter('a.character-portrait')->each(function (Crawler $node) use (&$characters, $gameId) {
                $characterName = $node->filter('h2.character-name')->text();
                $characterImage = $node->filter('img.character-icon')->attr('src');
    
                $characters[] = [
                    'name' => trim($characterName),
                    'image' => trim($characterImage),
                ];
    
                Hero::firstOrCreate(
                    ['name' => trim($characterName)], 
                    [
                        'game_id' => $gameId, 
                        'image' => trim($characterImage),
                    ]
                );
            });
    
            return $characters;
        } catch (\Exception $e) {
            throw new \Exception('Error fetching Honkai Star Rail characters: ' . $e->getMessage());
        }
    }

    // Lấy nhân vật từ Zenless Zone Zero (ID = 3)
    public function getZenlessZoneZeroCharacters(): array
    {
        $url = 'https://genshin.gg/zzz';
        $gameId = 3; // ID cho Zenless Zone Zero
    
        try {
            $response = $this->client->get($url, ['verify' => false]);
            $html = $response->getBody()->getContents();
            $crawler = new Crawler($html);
    
            $characters = [];
    
            $crawler->filter('a.character-portrait')->each(function (Crawler $node) use (&$characters, $gameId) {
                $characterName = $node->filter('h2.character-name')->text();
                $characterImage = $node->filter('img.character-icon')->attr('src');
    
                $characters[] = [
                    'name' => trim($characterName),
                    'image' => trim($characterImage),
                ];
    
                Hero::firstOrCreate(
                    ['name' => trim($characterName)], 
                    [
                        'game_id' => $gameId, 
                        'image' => trim($characterImage),
                    ]
                );
            });
    
            return $characters;
        } catch (\Exception $e) {
            throw new \Exception('Error fetching Zenless Zone Zero characters: ' . $e->getMessage());
        }
    }
    // WEAPON CRAWL DATA
public function getGenshinImpactWeapons(): array
{
    $url = 'https://genshin-builds.com/vi/weapons';  // URL chứa thông tin vũ khí
    $gameId = 1; // ID cho Genshin Impact

    try {
        $response = $this->client->get($url, ['verify' => false]);
        $html = $response->getBody()->getContents();
        $crawler = new Crawler($html);

        $weapons = [];

        // Lọc dữ liệu trong div chứa ảnh và tên
        $crawler->filter('div.flex.flex-row.justify-center.rounded-t-lg')->each(function (Crawler $node) use (&$weapons, $gameId) {
            // Lấy URL ảnh từ thẻ img
            $weaponImage = $node->filter('img')->attr('src');

            // Lấy tên vũ khí từ thẻ h3
            $weaponName = $node->nextAll()->filter('h3')->text();

            $weapons[] = [
                'name' => trim($weaponName),
                'image' => trim($weaponImage),
            ];

            // Lưu vào database nếu cần
            Weapon::firstOrCreate(
                ['name' => trim($weaponName)],
                [
                    'game_id' => $gameId,
                    'image' => trim($weaponImage),
                ]
            );
        });

        return $weapons;
    } catch (\Exception $e) {
        throw new \Exception('Error fetching Genshin Impact weapons: ' . $e->getMessage());
    }
}

public function getHonkaiStarRailWeapons(): array
{
    $url = 'https://genshin.gg/star-rail/light-cones'; // URL chứa thông tin Light Cones Honkai: Star Rail
    $gameId = 2; // ID cho game Honkai: Star Rail

    try {
        $response = $this->client->get($url, ['verify' => false]);
        $html = $response->getBody()->getContents();
        $crawler = new Crawler($html);

        $lightCones = [];

        $crawler->filter('div.light-cones-item')->each(function (Crawler $node) use (&$lightCones, $gameId) {
            // Lấy tên Light Cone từ thẻ alt của ảnh
            $lightConeName = $node->filter('img')->attr('alt');
            // Lấy URL ảnh của Light Cone
            $lightConeImage = $node->filter('img')->attr('src');

            if (!empty($lightConeName) && !empty($lightConeImage)) { // Kiểm tra xem dữ liệu có hợp lệ không
                $lightCones[] = [
                    'name' => trim($lightConeName),
                    'image' => trim($lightConeImage),
                ];

                // Lưu vào database nếu cần
                Weapon::firstOrCreate(
                    ['name' => trim($lightConeName)],
                    [
                        'game_id' => $gameId,
                        'image' => trim($lightConeImage),
                    ]
                );
            }
        });

        return $lightCones;
    } catch (\Exception $e) {
        throw new \Exception('Error fetching Honkai: Star Rail light cones: ' . $e->getMessage());
    }
}
public function getZenlessZoneZeroWeapons(): array
{
    $url = 'https://genshin.gg/zzz/w-engines'; // URL chứa thông tin vũ khí
    $gameId = 3; // ID cho Genshin Impact

    try {
        $response = $this->client->get($url, ['verify' => false]);
        $html = $response->getBody()->getContents();
        $crawler = new Crawler($html);

        $weapons = [];

        $crawler->filter('div.light-cones-item')->each(function (Crawler $node) use (&$weapons, $gameId) {
            // Lấy tên vũ khí từ thẻ alt của ảnh
            $weaponName = $node->filter('img')->attr('alt');
            // Hoặc lấy tên vũ khí từ văn bản bên trong div (nếu cần)
            $weaponNameText = $node->text();

            // Lấy URL ảnh của vũ khí
            $weaponImage = $node->filter('img')->attr('src');

            $weapons[] = [
                'name' => trim($weaponName),
                'image' => trim($weaponImage),
            ];

            // Lưu vào database nếu cần
            Weapon::firstOrCreate(
                ['name' => trim($weaponName)],
                [
                    'game_id' => $gameId,
                    'image' => trim($weaponImage),
                ]
            );
        });

        return $weapons;
    } catch (\Exception $e) {
        throw new \Exception('Error fetching Genshin Impact weapons: ' . $e->getMessage());
    }
}





}
