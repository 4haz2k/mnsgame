<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Question extends Model
{
    use HasFactory;

    protected $table = "questions";
    public $timestamps = false;

    /**
     * @return HasOne
     */
    public function rate(): HasOne
    {
        return $this->hasOne("App\Models\QuestionRate", "id");
    }
}
