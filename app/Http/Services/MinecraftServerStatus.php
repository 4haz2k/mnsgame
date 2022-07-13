<?php


namespace App\Http\Services;

use App\Http\Services\MinecraftSocketPackets\HandshakePacket;
use App\Http\Services\MinecraftSocketPackets\PingPacket;


class MinecraftServerStatus
{
    /**
     * Queries the server and returns the servers information
     *
     * @param string $host
     * @param int $port
     * @return array|false
     */
    public static function query (string $host, $port = 25565) {
        // check if the host is in ipv4 format
        $host = filter_var($host, FILTER_VALIDATE_IP) ? $host : gethostbyname($host);

        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        if (! @socket_connect($socket, $host, $port)) {
            return false;
        }

        // create the handshake and ping packet
        $handshakePacket = new HandshakePacket($host, $port, 107, 1);
        $pingPacket = new PingPacket();

        $handshakePacket->send($socket);

        // high five
        $start = microtime(true);
        $pingPacket->send($socket);
        $length = self::readVarInt($socket);
        $ping = round((microtime(true) - $start) * 1000);

        // read the requested data
        $data = socket_read($socket, $length, PHP_NORMAL_READ);
        $data = strstr($data, '{');
        $data = json_decode($data);

        return array(
            'hostname' => $host,
            'port' => $port,
            'ping' => $ping,
            'version' => isset($data->version->name) ? $data->version->name : false,
            'protocol' => isset($data->version->protocol) ? $data->version->protocol : false,
            'players' => isset($data->players->online) ? $data->players->online : false,
            'max_players' => isset($data->players->max) ? $data->players->max : false,
        );
    }

    private static function readVarInt ($socket) {
        $a = 0;
        $b = 0;
        while (true) {
            $c = socket_read($socket, 1);
            if (! $c) {
                return 0;
            }
            $c = Ord($c);
            $a |= ($c & 0x7F) << $b ++ * 7;
            if ($b > 5) {
                return false;
            }
            if (($c & 0x80) != 128) {
                break;
            }
        }
        return $a;
    }
}
