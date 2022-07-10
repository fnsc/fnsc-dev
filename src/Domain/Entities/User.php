<?php

namespace Fnsc\Domain\Entities;

use Fnsc\Domain\ValueObjects\Email;
use Fnsc\Domain\ValueObjects\Url;
use MongoDB\BSON\ObjectId;

class User
{
    /**
     * @param ObjectId $id
     * @param Email    $email
     * @param Url      $avatarUrl
     * @param string   $name
     * @param string   $location
     * @param string   $bio
     */
    private function __construct(
        private readonly ObjectId $id,
        private readonly Email $email,
        private readonly Url $avatarUrl,
        private readonly string $name,
        private readonly string $location,
        private readonly string $bio,
    ) {
    }

    public static function getNewUser(
        string $name,
        string $avatarUrl,
        string $location,
        string $bio,
        string $email,
        string $id = '',
    ): self {
        $id = empty($id) ? new ObjectId() : new ObjectId($id);

        return new self(
            id: $id,
            email: new Email($email),
            avatarUrl: new Url($avatarUrl),
            name: $name,
            location: $location,
            bio: $bio,
        );
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Email
     */
    public function getEmail(): Email
    {
        return $this->email;
    }

    /**
     * @return Url
     */
    public function getAvatarUrl(): Url
    {
        return $this->avatarUrl;
    }

    /**
     * @return string
     */
    public function getLocation(): string
    {
        return $this->location;
    }

    /**
     * @return string
     */
    public function getBio(): string
    {
        return $this->bio;
    }
}
