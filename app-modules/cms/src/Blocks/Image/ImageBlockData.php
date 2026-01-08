<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\ValueObjects;

use ClintonRocha\CMS\Contracts\BlockData;

final readonly class ImageBlockData implements BlockData
{
    public function __construct(
        public string $src,
        public string $alt,
        public ?string $caption,
        public string $align,
        public string $size,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            src: $data['src'] ?? '',
            alt: $data['alt'] ?? '',
            caption: $data['caption'] ?? null,
            align: $data['align'] ?? 'center',
            size: $data['size'] ?? 'md',
        );
    }

    public function view(): string
    {
        return 'blocks.image.default';
    }

    public function containerWidth(): string
    {
        return match ($this->size) {
            'sm' => 'max-w-sm',
            'lg' => 'max-w-5xl',
            'full' => 'max-w-full',
            default => 'max-w-3xl',
        };
    }

    public function alignClass(): string
    {
        return match ($this->align) {
            'left' => 'text-left',
            'right' => 'text-right',
            default => 'text-center',
        };
    }

    public function imageAlignClass(): string
    {
        return match ($this->align) {
            'left' => 'mr-auto',
            'right' => 'ml-auto',
            default => 'mx-auto',
        };
    }

    public function toArray(): array
    {
        return [
            'src' => $this->src,
            'alt' => $this->alt,
            'caption' => $this->caption,
            'align' => $this->align,
            'size' => $this->size,
        ];
    }
}
