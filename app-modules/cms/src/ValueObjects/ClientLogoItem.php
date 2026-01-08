<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\ValueObjects;

final class ClientLogoItem
{
    public function __construct(
        public string $name,
        public string $logo,
        public ?string $url = null,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'] ?? '',
            logo: $data['logo'] ?? '',
            url: $data['url'] ?? null,
        );
    }

    public function hasLink(): bool
    {
        return filled($this->url);
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'logo' => $this->logo,
            'url' => $this->url,
        ];
    }
}
