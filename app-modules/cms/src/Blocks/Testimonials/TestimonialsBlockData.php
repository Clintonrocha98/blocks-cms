<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\ValueObjects;

use ClintonRocha\CMS\Contracts\BlockData;

final readonly class TestimonialsBlockData implements BlockData
{
    /** @var TestimonialItem[] */
    public array $items;

    public function __construct(
        array $items,
        public string $variant,
        public int $columns,
    ) {
        $this->items = array_map(
            TestimonialItem::fromArray(...),
            $items
        );
    }

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
        return 'blocks.testimonials.'.$this->variant;
    }

    public function gridClass(): string
    {
        return match ($this->columns) {
            2 => 'grid-cols-1 sm:grid-cols-2',
            default => 'grid-cols-1 sm:grid-cols-2 lg:grid-cols-3',
        };
    }

    public function toArray(): array
    {
        return [
            'items' => array_map(
                fn (TestimonialItem $item) => $item->toArray(),
                $this->items
            ),
            'variant' => $this->variant,
            'columns' => $this->columns,
        ];
    }
}
