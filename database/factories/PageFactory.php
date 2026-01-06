<?php

namespace Database\Factories;

use App\Models\Page;
use App\Models\PageBlock;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PageFactory extends Factory
{
    protected $model = Page::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'slug' => $this->faker->slug(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'page_block_id' => PageBlock::factory(),
        ];
    }
}
