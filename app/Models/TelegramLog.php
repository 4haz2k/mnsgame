<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelegramLog extends Model
{
    use HasFactory;

    protected $table = "telegram_users_log";

    protected $fillable = [
        "user_id",
        "message",
        "date"
    ];
}
