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
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany("App\Models\Question", "category_of_question");
    }

    protected static function newFactory(): TopicCategoryFactory
    {
        return TopicCategoryFactory::new();
    }
}
