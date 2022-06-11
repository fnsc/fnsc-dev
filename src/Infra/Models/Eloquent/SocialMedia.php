<?php

namespace Fnsc\Infra\Models\Eloquent;

use Fnsc\Infra\Models\Eloquent\Casts\ObjectId;
use Fnsc\Infra\Models\Eloquent\Casts\Url;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SocialMedia extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'profile_url',
        'username',
        'icon_path',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id' => ObjectId::class,
        'user_id' => ObjectId::class,
        'profile_url' => Url::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
