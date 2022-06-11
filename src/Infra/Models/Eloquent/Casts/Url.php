<?php

namespace Fnsc\Infra\Models\Eloquent\Casts;

use Fnsc\Domain\ValueObjects\Url as UrlValueObject;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class Url implements CastsAttributes
{
    public function get($model, string $key, $value, array $attributes)
    {
        if (empty($value)) {
            return null;
        }

        return new UrlValueObject($value);
    }

    public function set($model, string $key, $value, array $attributes)
    {
        return (string) $value;
    }
}
