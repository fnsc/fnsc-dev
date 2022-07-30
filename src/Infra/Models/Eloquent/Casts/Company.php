<?php

namespace Fnsc\Infra\Models\Eloquent\Casts;

use Fnsc\Domain\ValueObjects\Company as CompanyValueObject;
use Fnsc\Domain\ValueObjects\Url as UrlValueObject;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class Company implements CastsAttributes
{
    /**
     * @phpstan-ignore-next-line
     */
    public function get($model, string $key, $value, array $attributes)
    {
        if (empty($value)) {
            return null;
        }

        $value = json_decode($value, true);
        $url = new UrlValueObject($value['url']);

        return new CompanyValueObject(
            $value['name'],
            $value['industry'],
            $url
        );
    }

    /**
     * @phpstan-ignore-next-line
     */
    public function set($model, string $key, $value, array $attributes)
    {
        return $value;
    }
}
