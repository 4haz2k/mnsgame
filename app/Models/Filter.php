<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filter extends Model
{
    use HasFactory;

    protected $fillable = [
      "filter"
    ];

    public function game(){
        return $this->belongsToMany("App\Models\Game", "filter_of_game");
    }

    public function servers(){
        return $this->belongsToMany("App\Models\Server", "filter_of_servers");
    }
}
