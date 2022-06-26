<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int|mixed|string|null voter_id
 * @property mixed server_id
 * @property mixed|string vote_time
 */
class ServerRates extends Model
{
    use HasFactory;

    public $timestamps = false;
}
