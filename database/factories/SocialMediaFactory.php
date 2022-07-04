<?php

namespace Database\Factories;

use Fnsc\Application\Contracts\Config;
use Fnsc\Infra\Models\Eloquent\SocialMedia;
use Fnsc\Infra\Models\Eloquent\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use MongoDB\BSON\ObjectId;

class SocialMediaFactory extends Factory
{
    protected $model = SocialMedia::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $user = User::factory()->create()->first();

        return [
            'id' => (string) new ObjectId(),
            'user_id' => (string) $user->getAttribute('id'),
            'name' => $this->faker->name,
            'profile_url' => $this->faker->url,
            'username' => $this->faker->word,
            'icon_path' => $this->faker->randomElement($this->getIconPaths()),
        ];
    }

    private function getIconPaths(): array
    {
        $config = app(Config::class);

        return [
            $config->get('user.social_media.dev.icon_path'),
            $config->get('user.social_media.github.icon_path'),
            $config->get('user.social_media.linkedin.icon_path'),
            $config->get('user.social_media.twitter.icon_path'),
        ];
    }
}
