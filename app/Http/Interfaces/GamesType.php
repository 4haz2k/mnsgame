<?php
namespace App\Http\Interfaces;

use App\Http\Services\MinecraftBedrockServerInfoService;
use App\Http\Services\MojangServerInfoService;
use App\Http\Services\SampServerInfoService;
use App\Http\Services\SteamServerInfoService;
use http\Exception\RuntimeException;

final class GamesType
{
    /**
     * Classes of game types
     *
     * @var MojangServerInfoService|SteamServerInfoService|SampServerInfoService|MinecraftBedrockServerInfoService
     */
    const GAME_TYPES = [
        "mojang" => MojangServerInfoService::class,
        "steam" => SteamServerInfoService::class,
        "gta" => SampServerInfoService::class,
        "minecraftpe" => MinecraftBedrockServerInfoService::class,
    ];

    /**
     * @param $name
     * @return MojangServerInfoService|SteamServerInfoService|SampServerInfoService|MinecraftBedrockServerInfoService
     */
    public function __get($name)
    {
        if (array_key_exists($name, self::GAME_TYPES)) {
            return self::GAME_TYPES[$name];
        }

        throw new RuntimeException("Can't get game class by $name");
    }
}
