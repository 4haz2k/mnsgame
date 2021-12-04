<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilterOfGame extends Model
{
    use HasFactory;

    public function game(){
        return $this->belongsTo("App\Models\Game", "game_id");
    }

    public function filter(){
        return $this->belongsTo("App\Models\Filter", "filter_id");
    }
}
