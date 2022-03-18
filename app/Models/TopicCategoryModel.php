<?php

namespace App\Models;

use Database\Factories\TopicCategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class TopicCategoryModel extends Model
{
    use HasFactory;

    protected $table = "topic_category";
    public $timestamps = false;

    /**
     * @return BelongsToMany
     */
    public function questions(): BelongsToMany
    {
        return $this->belongsToMany("App\Models\Question", "category_of_question", "category_id", "question_id");
    }

    protected static function newFactory(): TopicCategoryFactory
    {
        return TopicCategoryFactory::new();
    }
}
