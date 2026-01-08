<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\ValueObjects;

use ClintonRocha\CMS\Contracts\BlockData;

final class CtaBlockData implements BlockData
{
    public function __construct(
        public string $title,
        public ?string $text,
        public string $label,
        public string $url,
        public string $variant,
        public string $align,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            title: $data['title'] ?? '',
            text: $data['text'] ?? null,
            label: $data['label'] ?? '',
            url: $data['url'] ?? '#',
            variant: $data['variant'] ?? 'solid',
            align: $data['align'] ?? 'center',
        );
    }

    public function view(): string
    {
        return 'blocks.cta.'.$this->variant;
    }

    public function alignClass(): string
    {
        return $this->align === 'center'
            ? 'text-center'
            : 'text-left';
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'text' => $this->text,
            'label' => $this->label,
            'url' => $this->url,
            'variant' => $this->variant,
            'align' => $this->align,
        ];
    }
}
