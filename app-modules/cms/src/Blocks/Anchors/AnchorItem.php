<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\ValueObjects;

final class AnchorItem
{
    public function __construct(
        public string $label,
        public string $target,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            label: $data['label'] ?? '',
            target: $data['target'] ?? '',
        );
    }

    public function href(): string
    {
        return '#'.$this->target;
    }

    public function toArray(): array
    {
        return [
            'label' => $this->label,
            'target' => $this->target,
        ];
    }
}
