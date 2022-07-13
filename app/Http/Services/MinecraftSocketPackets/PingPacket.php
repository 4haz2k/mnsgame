<?php


namespace App\Http\Services\MinecraftSocketPackets;


class PingPacket extends Packet
{
    public function __construct () {
        parent::__construct(0);
    }
}
