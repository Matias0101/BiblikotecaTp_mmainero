<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Book;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'type' => $this->faker->regexify('[A-Za-z0-9]{20}'),
            'signature' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'signature2' => $this->faker->regexify('[A-Za-z0-9]{30}'),
            'title' => $this->faker->sentence(4),
            'pages' => $this->faker->regexify('[A-Za-z0-9]{10}'),
            'features' => $this->faker->regexify('[A-Za-z0-9]{150}'),
            'place_of_edition' => $this->faker->regexify('[A-Za-z0-9]{35}'),
            'edition_info' => $this->faker->regexify('[A-Za-z0-9]{120}'),
            'dimensions' => $this->faker->regexify('[A-Za-z0-9]{30}'),
            'year' => $this->faker->date(),
            'isbn' => $this->faker->regexify('[A-Za-z0-9]{120}'),
            'format' => $this->faker->regexify('[A-Za-z0-9]{60}'),
            'language' => $this->faker->regexify('[A-Za-z0-9]{100}'),
            'note' => $this->faker->text(),
            'inventory' => $this->faker->word(),
            'origin' => $this->faker->regexify('[A-Za-z0-9]{120}'),
            'other_authors' => $this->faker->word(),
            'publisher_id' => $this->faker->numberBetween(-10000, 10000),
            'image' => $this->faker->word(),
            'location' => $this->faker->word(),
            'additional_info' => $this->faker->word(),
        ];
    }
}
