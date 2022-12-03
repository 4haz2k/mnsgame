<?php


namespace App\Http\Interfaces;


abstract class PaymentTypes
{
    const packets = [
        "rating",
        "packet1",
        "packet2",
        "packet3",
    ];

    const PACKET_RATING = [
        "title" => "rating",
        "price" => 1,
        "rating" => 1,
    ];

    const PACKET_RUBY = [
        "title" => "packet1",
        "price" => 99,
        "rating" => 150,
    ];

    const PACKET_SAPPHIRE = [
        "title" => "packet2",
        "price" => 189,
        "rating" => 200,
    ];

    const PACKET_EMERALD = [
        "title" => "packet3",
        "price" => 249,
        "rating" => 300,
    ];
}
