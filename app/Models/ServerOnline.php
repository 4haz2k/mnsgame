<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServerOnline extends Model
{
    use HasFactory;

    protected $table = "servers_online";

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        "server_id",
        "online",
        "created_at"
    ];
}
