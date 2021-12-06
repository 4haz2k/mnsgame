<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Game extends Model
{
    use HasFactory;

    /**
     * @return BelongsToMany
     */
    public function filters(): BelongsToMany
    {
        return $this->belongsToMany("App\Models\Filter", "filter_of_game");
    }

    /**
     * @return BelongsTo
     */
    public function servers(): BelongsTo
    {
        return $this->belongsTo("App\Models\Server", "id");
    }

    /**
     * @return BelongsTo
     */
    public function filtersOfGame(): BelongsTo
    {
        return $this->belongsTo("App\Models\FilterOfGame", "id", "game_id");
    }

    /**
     * событие удаления
     */
    public static function boot()
    {
        parent::boot();

        // при удалении игры, удаляем ссылки на фильтры, указанные у игры
        static::deleting(function ($game){
            $game->filtersOfGame()->delete();
        });
    }
}
