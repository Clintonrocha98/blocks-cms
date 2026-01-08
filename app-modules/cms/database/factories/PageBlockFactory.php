<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\Database\Factories;

use Illuminate\Support\Facades\Date;
use App\Models\Block;
use ClintonRocha\CMS\Models\PageBlock;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PageBlock>
 */
class PageBlockFactory extends Factory
{
    protected $model = PageBlock::class;

    public function definition(): array
    {
        return [
            'page_id' => fake()->word(),
            'position' => fake()->word(),
            'data' => fake()->words(),
            'created_at' => Date::now(),
            'updated_at' => Date::now(),

            'block_id' => Block::factory(),
        ];
    }
}
