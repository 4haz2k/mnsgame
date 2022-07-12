<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Yookassa extends Model
{
    use HasFactory;

    protected $table = "yookassa";

    protected $fillable = [
        "server_id",
        "payment_id",
        "status",
        "paid",
        "sum",
        "currency",
        "payment_link",
        "description",
        "paid_at",
        "uniq_id",
        "created_at",
        "updated_at"
    ];
}
