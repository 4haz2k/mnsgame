<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServerRconHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        "server_id",
        "log",
        "by_user",
        "deleted"
    ];
}
