<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Film>
 */
class FilmFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(2),
            'synopsis' => $this->faker->paragraph(),
            'release_year' => $this->faker->year(),
            'trailer_url' => 'https://www.youtube.com/watch?v=BUfSen2rYQs',
            'poster' => 'https://m.media-amazon.com/images/M/MV5BOWUyNDFjOWUtNGM5MS00YTUzLWFhYzYtZDg5NDNjMWJiY2MyXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg',
            'slug' => $this->faker->slug(),
            'user_id' => 1,
            'genre_id' => 1,

        ];
    }
}
