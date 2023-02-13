<?php

namespace App\Http\Interfaces;

abstract class ServerData
{
    const coefficient = 1;
    const paginate = 15;
    const projectType = [
        "all" => "all",
        "onlyAddresses" => "addresses",
        "onlyLaunchers" => "launchers"
    ];
}
