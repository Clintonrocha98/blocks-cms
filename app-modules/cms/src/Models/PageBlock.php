<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\Models;

use ClintonRocha\CMS\Contracts\BlockData;
use ClintonRocha\CMS\Contracts\BlockDefinition;
use ClintonRocha\CMS\Database\Factories\PageBlockFactory;
use ClintonRocha\CMS\Registry\BlockRegistry;
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
            'data' => 'array',
        ];
    }

    public function content(): BlockData
    {
        return $this->blockRegistry()::fromModel($this->data);
    }

    public function view(): string
    {
        return $this->blockRegistry()::view($this->content());
    }

    private function blockRegistry(): BlockDefinition
    {
        return BlockRegistry::resolve($this->type);
    }
}
