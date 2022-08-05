<?php

namespace App\Http\Interfaces;

abstract class ServerData
{
    const coefficient = 5;
    const paginate = 20;
    const projectType = [
        "all" => "all",
        "onlyAddresses" => "addresses",
        "onlyLaunchers" => "launchers"
    ];
}
