<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use SplFileInfo;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    private static Collection $fixtures;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "title" => fake()->sentence(),
            "body" => Collection::times(
                4,
                fn() => fake()->realText(1200)
            )->join(PHP_EOL . PHP_EOL),
            "user_id" => User::factory(),
        ];
    }

    public function published(): static
    {
        return $this->state(function (array $attributes) {
            return [
                "published_at" => now(),
            ];
        });
    }

    public function withFixture(): static
    {
        $posts = static::getFixtures()
            ->map(fn(string $contents) => str($contents)->explode("\n", 2))
            ->map(
                fn(Collection $parts) => [
                    "title" => str($parts[0])
                        ->trim()
                        ->after("# "),
                    "body" => str($parts[1])->trim(),
                ]
            );

        return $this->sequence(...$posts);
    }

    private static function getFixtures(): Collection
    {
        return self::$fixtures ??= collect(
            File::files(database_path("factories/fixturies/posts"))
        )->map(fn(SplFileInfo $fileInfo) => $fileInfo->getContents());
    }
}
