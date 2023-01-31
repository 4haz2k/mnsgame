<?php

namespace App\Models;

use App\Http\Requests\UserEditRequest;
use App\Http\Services\ImageService;
use App\Notifications\PasswordReset;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Request;
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
        'login_date',
        'role'
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
     * Событие удаления
     */
    public static function boot()
    {
        parent::boot();

        // при удалении пользователя, удаляем ссылки на сервера, указанные у пользователя
        static::deleting(function ($user){
            $user->server()->delete();
        });
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordReset($token));
    }

    // Procedures

    /**
     * Update user settings
     *
     * @param UserEditRequest $request
     * @return mixed
     */
    public static function updateUser(UserEditRequest $request)
    {
        $user = Auth::user();

        if($request->has("name") and $request->filled('name'))
            $user->name = $request->name;

        if($request->has("surname") and $request->filled('surname'))
            $user->surname = $request->surname;

        if($request->has("login") and $request->filled('login'))
            $user->login = $request->login;

        if($request->has("password") and $request->filled('password'))
            $user->password = Hash::make($request->password);

        if($request->has("email") and $request->filled('email'))
            $user->email = $request->email;

        if($image = ImageService::handleProfileUploadedImage($request))
            $user->profile_image = $image;

        return $user->save();
    }
}
