<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\Database\Factories;

use ClintonRocha\CMS\Models\Page;
use ClintonRocha\CMS\Models\PageBlock;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Date;

/**
 * @extends Factory<PageBlock>
 */
class PageBlockFactory extends Factory
{
    protected $model = PageBlock::class;

    public function definition(): array
    {
        return [
            'page_id' => Page::factory(),
            'position' => fake()->word(),
            'data' => fake()->words(),
            'created_at' => Date::now(),
            'updated_at' => Date::now(),
        ];
    }
}
