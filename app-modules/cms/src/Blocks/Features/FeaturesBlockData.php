<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\ValueObjects;

use ClintonRocha\CMS\Contracts\BlockData;

final readonly class FeaturesBlockData implements BlockData
{
    public function __construct(
        public array $items,
        public string $variant,
        public int $columns,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            items: $data['items'] ?? [],
            variant: $data['variant'] ?? 'grid',
            columns: (int) ($data['columns'] ?? 3),
        );
    }

    public function view(): string
    {
        return 'blocks.features.'.$this->variant;
    }

    public function gridClass(): string
    {
        return match ($this->columns) {
            2 => 'grid-cols-1 sm:grid-cols-2',
            4 => 'grid-cols-1 sm:grid-cols-2 lg:grid-cols-4',
            default => 'grid-cols-1 sm:grid-cols-2 lg:grid-cols-3',
        };
    }

    public function toArray(): array
    {
        return [
            'items' => $this->items,
            'variant' => $this->variant,
            'columns' => $this->columns,
        ];
    }
}
