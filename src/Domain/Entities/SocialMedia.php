<?php

namespace Fnsc\Domain\Entities;

use Fnsc\Domain\ObjectIdGenerator;
use Fnsc\Domain\ValueObjects\Url;
use MongoDB\BSON\ObjectId;

class SocialMedia
{
    use ObjectIdGenerator;

    private function __construct(
        private readonly ObjectId $id,
        private readonly Url $profileUrl,
        private readonly string $name,
        private readonly string $username,
        private readonly string $iconPath,
    ) {
    }

    public static function getNewSocialMedia(
        string $name,
        string $username,
        string $profileUrl,
        string $iconPath,
        string $id = '',
    ): self {
        return new self(
            id: self::getObjectId($id),
            profileUrl: new Url($profileUrl),
            name: $name,
            username: $username,
            iconPath: $iconPath,
        );
    }

    /**
     * @return Url
     */
    public function getProfileUrl(): Url
    {
        return $this->profileUrl;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getIconPath(): string
    {
        return $this->iconPath;
    }

    /**
     * @return ObjectId
     */
    public function getId(): ObjectId
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }
}
