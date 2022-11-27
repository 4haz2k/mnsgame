<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServerViews extends Model
{
    use HasFactory;

    protected $fillable = [
        'server_id',
        'visitor_uuid'
    ];
}
