<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\ValueObjects;

final class FooterSocialItem
{
    public function __construct(
        public string $label,
        public string $url,
        public string $icon,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            label: $data['label'] ?? '',
            url: $data['url'] ?? '',
            icon: $data['icon'] ?? '',
        );
    }

    public function iconClass(): string
    {
        return match ($this->icon) {
            'github' => 'i-simple-icons-github',
            'linkedin' => 'i-simple-icons-linkedin',
            'instagram' => 'i-simple-icons-instagram',
            default => 'i-simple-icons-twitter',
        };
    }

    public function toArray(): array
    {
        return [
            'label' => $this->label,
            'url' => $this->url,
            'icon' => $this->icon,
        ];
    }
}
