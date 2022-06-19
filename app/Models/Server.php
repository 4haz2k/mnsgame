<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Server extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        "title",
        "description",
        "is_launcher",
        "server_data",
        "banner_img",
        "logo_img",
        "callback",
        "owner_id",
        "game_id"
    ];

    public static function rules(): array
    {
        return [
            'title' => 'required|string|max:60',
            'description' => 'required|string|max:255',
            'is_launcher' => 'bool|max:255',
            'banner_img' => 'image|mimes:jpg,png,jpeg,gif|max:2048|dimensions:min_width=468,min_height=80,max_width=468,max_height=80',
            'logo_img' => 'image|mimes:jpg,png,jpeg,gif|max:2048|dimensions:min_width=128,min_height=128,max_width=128,max_height=128',
            'server_data' => 'required|string|unique:servers,server_data',
            'callback' => 'string',
            "owner_id" => "required|integer",
            'game_id' => 'required|integer|exists:games,id'
        ];
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo("App\Models\User", "owner_id");
    }

    /**
     * @return BelongsTo
     */
    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }

    /**
     * @return BelongsToMany
     */
    public function filters(): BelongsToMany
    {
        return $this->belongsToMany("App\Models\Filter", "filter_of_servers");
    }

    /**
     * @return BelongsTo
     */
    public function filterOfServer(): BelongsTo
    {
        return $this->belongsTo("App\Models\FilterOfServer", "id", "server_id");
    }

    /**
     * @return BelongsTo
     */
    public function serverVotes(): BelongsTo
    {
        return $this->belongsTo(ServerRates::class, "id", "server_id");
    }

    /**
     * @return BelongsTo
     */
    public function serverRating(): BelongsTo
    {
        return $this->belongsTo(ServerRating::class, "id", "server_id");
    }

    /**
     * событие удаления
     */
    public static function boot()
    {
        parent::boot();

        // при удалении сервера, удаляем ссылки на фильтры, указанные у сервера
        static::deleting(function ($server){
            $server->filterOfServer()->delete();
        });
    }
}
