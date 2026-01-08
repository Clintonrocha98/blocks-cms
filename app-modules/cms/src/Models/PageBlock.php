<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\Models;

use ClintonRocha\CMS\Casts\BlockDataCast;
use ClintonRocha\CMS\Database\Factories\PageBlockFactory;
use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[UseFactory(PageBlockFactory::class)]
class PageBlock extends Model
{
    use HasFactory;

    protected $fillable = ['page_id', 'type', 'position', 'data'];

    protected function casts(): array
    {
        return [
            'data' => BlockDataCast::class,
        ];
    }
}
