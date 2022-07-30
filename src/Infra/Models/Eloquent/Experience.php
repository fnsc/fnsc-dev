<?php

namespace Fnsc\Infra\Models\Eloquent;

use Fnsc\Infra\Models\Eloquent\Casts\Company;
use Fnsc\Infra\Models\Eloquent\Casts\ObjectId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'experiences';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'user_id',
        'title',
        'employment_type',
        'location',
        'description',
        'company',
        'start_date',
        'end_date',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id' => ObjectId::class,
        'user_id' => ObjectId::class,
        'company' => Company::class,
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];
}
