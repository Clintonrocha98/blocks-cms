<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\ValueObjects;

use ClintonRocha\CMS\Contracts\BlockData;

final readonly class TextBlockData implements BlockData
{
    public function __construct(
        public string $text,
        public string $variant,
        public string $width,
        public string $align,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            text: $data['text'] ?? '',
            variant: $data['variant'] ?? 'simple',
            width: $data['width'] ?? 'normal',
            align: $data['align'] ?? 'left',
        );
    }

    public function view(): string
    {
        return 'blocks.text.'.$this->variant;
    }

    public function containerWidth(): string
    {
        return match ($this->width) {
            'narrow' => 'max-w-2xl',
            'wide' => 'max-w-6xl',
            default => 'max-w-4xl',
        };
    }

    public function textAlign(): string
    {
        return $this->align === 'center'
            ? 'text-center'
            : 'text-left';
    }

    public function toArray(): array
    {
        return [
            'text' => $this->text,
            'variant' => $this->variant,
            'width' => $this->width,
            'align' => $this->align,
        ];
    }
}
