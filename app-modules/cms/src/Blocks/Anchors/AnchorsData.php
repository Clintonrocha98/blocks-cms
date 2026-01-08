<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\ValueObjects;

use ClintonRocha\CMS\Contracts\BlockData;

final class AnchorsData implements BlockData
{
    /** @var AnchorItem[] */
    public array $items;

    public function __construct(
        array $items,
        public string $variant,
    ) {
        $this->items = array_map(
            AnchorItem::fromArray(...),
            $items
        );
    }

    public static function fromArray(array $data): self
    {
        return new self(
            items: $data['items'] ?? [],
            variant: $data['variant'] ?? 'menu',
        );
    }

    public function toArray(): array
    {
        return [
            'items' => array_map(
                fn (AnchorItem $item) => $item->toArray(),
                $this->items
            ),
            'variant' => $this->variant,
        ];
    }
}
