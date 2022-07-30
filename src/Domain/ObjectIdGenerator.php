<?php

namespace Fnsc\Domain;

use MongoDB\BSON\ObjectId;

trait ObjectIdGenerator
{
    private static function getObjectId(string $id): ObjectId
    {
        return empty($id) ? new ObjectId() : new ObjectId($id);
    }
}
