<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Edition;

class EditionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Edition::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'edition_number' => $this->faker->regexify('[A-Za-z0-9]{120}'),
            'year' => $this->faker->year(),
            'details' => $this->faker->word(),
        ];
    }
}
