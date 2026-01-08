<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\Models;

use ClintonRocha\CMS\Database\Factories\PageFactory;
use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[UseFactory(PageFactory::class)]
class Page extends Model
{
    use HasFactory;

    protected $fillable = ['slug', 'title'];

    /**
     * @return HasMany<PageBlock, $this>
     */
    public function blocks(): HasMany
    {
        return $this->hasMany(PageBlock::class);
    }
}
