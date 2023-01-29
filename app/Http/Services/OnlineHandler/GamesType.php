<?php

namespace App\Http\Services\OnlineHandler;

use App\Http\Services\OnlineHandler\Platforms\MinecraftBedrockServerInfoService;
use App\Http\Services\OnlineHandler\Platforms\MojangServerInfoService;
use App\Http\Services\OnlineHandler\Platforms\SampServerInfoService;
use App\Http\Services\OnlineHandler\Platforms\SteamServerInfoService;
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
