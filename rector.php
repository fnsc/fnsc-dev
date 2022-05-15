<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Php74\Rector\Property\TypedPropertyRector;
use Rector\PSR4\Rector\FileWithoutNamespace\NormalizeNamespaceByPSR4ComposerAutoloadRector;
use Rector\Set\ValueObject\LevelSetList;

return static function (RectorConfig $rectorConfig): void {
    // get parameters
    $rectorConfig->paths([
        __DIR__ . '/tests',
    ]);

    // Define what rule sets will be applied
    $rectorConfig->import(LevelSetList::UP_TO_PHP_81);

    // get services (needed for register a single rule)
     $services = $rectorConfig->services();

    // register a single rule
     $services->set(TypedPropertyRector::class);
     $services->set(NormalizeNamespaceByPSR4ComposerAutoloadRector::class);
};
