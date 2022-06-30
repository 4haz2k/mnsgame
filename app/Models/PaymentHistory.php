<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentHistory extends Model
{
    use HasFactory;

    public function server(): BelongsTo
    {
        return $this->belongsTo(Server::class, "server_id");
    }
}
