<?php

namespace Fnsc\Infra\Models\Eloquent;

use Database\Factories\UserFactory;
use Fnsc\Infra\Models\Eloquent\Casts\Email;
use Fnsc\Infra\Models\Eloquent\Casts\ObjectId;
use Fnsc\Infra\Models\Eloquent\Casts\Url;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar_url',
        'location',
        'bio',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id' => ObjectId::class,
        'avatar_url' => Url::class,
        'email' => Email::class,
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return HasMany
     */
    public function socialMedia(): HasMany
    {
        return $this->hasMany(SocialMedia::class);
    }

    /**
     * @return UserFactory
     */
    protected static function newFactory(): UserFactory
    {
        return new UserFactory();
    }
}
