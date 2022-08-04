<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilterOfGame extends Model
{
    use HasFactory;

    protected $table = "filter_of_game";

    public $timestamps = false;
}
