<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServerRcon extends Model
{
    use HasFactory;

    protected $fillable = [
        "server_id",
        "address",
        "rcon_port",
        "rcon_password",
        "is_connected",
        "activated_time",
    ];
}
