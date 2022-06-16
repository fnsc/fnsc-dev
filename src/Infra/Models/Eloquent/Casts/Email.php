<?php

namespace Fnsc\Infra\Models\Eloquent\Casts;

use Fnsc\Domain\ValueObjects\Email as EmailValueObject;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class Email implements CastsAttributes
{
    /**
     * @phpstan-ignore-next-line
     */
    public function get($model, string $key, $value, array $attributes)
    {
        if (empty($value)) {
            return null;
        }

        return new EmailValueObject($value);
    }

    /**
     * @phpstan-ignore-next-line
     */
    public function set($model, string $key, $value, array $attributes)
    {
        return (string) $value;
    }
}
