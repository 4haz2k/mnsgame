<?php

namespace Tests\Feature;

use App\Http\Services\OnlineHandler\GamesType;
use Tests\TestCase;

class ServerInfoTest extends TestCase
{
    /**
     * Try to get online of platforms with port
     *
     * @return void
     */
    public function test_try_get_online_info_with_port()
    {
        $platforms = [
            "mojang" => ["ip" => "play.tanomitopia.ru:25565", "appid" => null],
            "steam" => ["ip" => "46.174.54.188:27015", "appid" => "730"],
            "minecraftpe" => ["ip" => "ultrape.ru:19132", "appid" => null],
            "gta" => ["ip" => "194.67.195.138:7777", "appid" => null],
            "test" => ["ip" => "test", "appid" => null],
        ];

        $this->assertIsArray($this->getOnline($platforms));
    }

    /**
     * Try to get online of platforms without port
     *
     * @return void
     */
    public function test_try_get_online_info_without_port()
    {
        $platforms = [
            "mojang" => ["ip" => "play.tanomitopia.ru", "appid" => null],
            "steam" => ["ip" => "46.174.54.188", "appid" => "730"],
            "minecraftpe" => ["ip" => "ultrape.ru", "appid" => null],
            "gta" => ["ip" => "194.67.195.138", "appid" => null],
            "test" => ["ip" => "test", "appid" => null],
        ];

        $this->assertIsArray($this->getOnline($platforms));
    }

    /**
     * Get online of servers
     *
     * @param $platforms
     * @return array
     */
    private function getOnline($platforms): array
    {
        $result = [];

        foreach ($platforms as $key => $platform) {
            $gameServiceClass = isset(GamesType::GAME_TYPES[$key]) ? GamesType::GAME_TYPES[$key] : null;

            if(is_null($gameServiceClass))
                continue;

            $gameServiceClass = new $gameServiceClass($platform['ip'], $platform['appid']);
            $online = $gameServiceClass->getPlayersCount();

            $result[$key] = [
                "ip" => $platform['ip'],
                "online" => $online,
            ];
        }

        print_r($result);

        return $result;
    }
}
