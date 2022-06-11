<?php

namespace Fnsc\Infra\Models\Eloquent\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use MongoDB\BSON\ObjectId as MongoObjectId;

class ObjectId implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        if (empty($value)) {
            return null;
        }

        return new MongoObjectId($value);
    }

    public function set($model, string $key, $value, array $attributes)
    {
        return (string) $value;
    }
}
