<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\Models;

use ClintonRocha\CMS\Contracts\BlockData;
use ClintonRocha\CMS\Contracts\BlockDefinition;
use ClintonRocha\CMS\Database\Factories\PageBlockFactory;
use ClintonRocha\CMS\Infrastructure\BlockFactory;
use Illuminate\Database\Eloquent\Attributes\UseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[UseFactory(PageBlockFactory::class)]
class PageBlock extends Model
{
    use HasFactory;

    protected $fillable = ['page_id', 'type', 'position', 'data'];

    public function content(): BlockData
    {
        return $this->block()->fromModel($this->data);
    }

    public function view(): string
    {
        $variant = $this->content()->variant ?? '';

        return $this->block()->view($variant);
    }

    protected function casts(): array
    {
        return [
            'data' => 'array',
        ];
    }

    private function block(): BlockDefinition
    {
        return BlockFactory::make($this->type);
    }
}
