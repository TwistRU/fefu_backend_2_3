<?php

namespace Database\Factories;

use App\Models\News;
use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = News::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'text' => $this->faker->realTextBetween(250, 500),
            'is_published' => $this->faker->randomElement([true, true, true, true, true, true, true, false, false, false]),
            'published_at' => $this->faker->dateTimeBetween('-2 months'),
        ];
    }
}
