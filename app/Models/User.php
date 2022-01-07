<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'password',
        'login',
        'registration_date',
        'login_date'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'registration_date' => 'datetime',
        'login_date' => 'datetime',
    ];

    /**
     * @return HasMany
     */
    public function server(): HasMany
    {
        return $this->hasMany("App\Models\Server", "owner_id");
    }

    /**
     * @return HasMany
     */
    public function payments(): HasMany
    {
        return $this->hasMany("App\Models\PaymentHistory", "user_id");
    }

    /**
     * событие удаления
     */
    public static function boot()
    {
        parent::boot();

        // при удалении пользователя, удаляем ссылки на сервера, указанные у пользователя
        static::deleting(function ($user){
            $user->server()->delete();
        });
    }
}
