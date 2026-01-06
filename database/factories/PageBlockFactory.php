<?php

namespace Database\Factories;

use App\Models\Block;
use App\Models\PageBlock;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PageBlockFactory extends Factory
{
    protected $model = PageBlock::class;

    public function definition(): array
    {
        return [
            'page_id' => $this->faker->word(),
            'position' => $this->faker->word(),
            'data' => $this->faker->words(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'block_id' => Block::factory(),
        ];
    }
}
