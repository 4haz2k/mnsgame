<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    public function filters(){
        return $this->belongsToMany("App\Models\Filter", "filter_of_game");
    }

    public function servers(){
        return $this->belongsTo("App\Models\Server", "id");
    }
}
