<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoriteServers extends Model
{
    use HasFactory;

    protected $fillable = [
        "server_id",
        "user_id"
    ];
}
