<?php

namespace App\Models;

use Database\Factories\CategoryOfQuestionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionOfCategoryModel extends Model
{
    use HasFactory;

    protected $table = "category_of_question";
    public $timestamps = false;

    protected static function newFactory(): CategoryOfQuestionFactory
    {
        return CategoryOfQuestionFactory::new();
    }
}
