<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\ValueObjects;

final readonly class TestimonialItem
{
    public function __construct(
        public string $quote,
        public string $name,
        public ?string $role,
        public ?string $avatar,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            quote: $data['quote'] ?? '',
            name: $data['name'] ?? '',
            role: $data['role'] ?? null,
            avatar: $data['avatar'] ?? null,
        );
    }

    public function hasAvatar(): bool
    {
        return filled($this->avatar);
    }

    public function toArray(): array
    {
        return [
            'quote' => $this->quote,
            'name' => $this->name,
            'role' => $this->role,
            'avatar' => $this->avatar,
        ];
    }
}
