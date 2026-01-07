<?php

namespace App\ValueObjects;

use App\Contract\BlockData;

final class DividerBlockData implements BlockData
{
    public function __construct(
        public string $variant,
        public string $spacing,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            variant: $data['variant'] ?? 'line',
            spacing: $data['spacing'] ?? 'md',
        );
    }

    public function view(): string
    {
        return "blocks.divider.{$this->variant}";
    }

    public function spacingClass(): string
    {
        return match ($this->spacing) {
            'sm' => 'my-6',
            'lg' => 'my-20',
            default => 'my-12',
        };
    }

    public function toArray(): array
    {
        return [
            'variant' => $this->variant,
            'spacing' => $this->spacing,
        ];
    }
}
