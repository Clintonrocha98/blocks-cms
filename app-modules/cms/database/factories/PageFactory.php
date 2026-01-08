<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\Database\Factories;

use Illuminate\Support\Facades\Date;
use ClintonRocha\CMS\Models\Page;
use ClintonRocha\CMS\Models\PageBlock;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Page>
 */
class PageFactory extends Factory
{
    protected $model = Page::class;

    public function definition(): array
    {
        return [
            'title' => fake()->word(),
            'slug' => fake()->slug(),
            'created_at' => Date::now(),
            'updated_at' => Date::now(),

            'page_block_id' => PageBlock::factory(),
        ];
    }
}
