<?php

namespace App\ValueObjects;

use App\Contract\BlockData;

final readonly class FooterBlockData implements BlockData
{
    /** @var FooterLinkItem[] */
    public array $links;

    /** @var FooterSocialItem[] */
    public array $socials;

    /** @var FooterLinkItem[] */
    public array $policies;

    public function __construct(
        array $links,
        array $socials,
        array $policies,
        public string $copyright,
    ) {
        $this->links = array_map(
            fn(array $item) => FooterLinkItem::fromArray($item),
            $links
        );

        $this->socials = array_map(
            fn(array $item) => FooterSocialItem::fromArray($item),
            $socials
        );

        $this->policies = array_map(
            fn(array $item) => FooterLinkItem::fromArray($item),
            $policies
        );
    }

    public static function fromArray(array $data): self
    {
        return new self(
            links: $data['links'] ?? [],
            socials: $data['socials'] ?? [],
            policies: $data['policies'] ?? [],
            copyright: $data['copyright'] ?? '',
        );
    }

    public function view(): string
    {
        return 'blocks.footer.default';
    }

    public function toArray(): array
    {
        return [
            'links' => array_map(fn($i) => $i->toArray(), $this->links),
            'socials' => array_map(fn($i) => $i->toArray(), $this->socials),
            'policies' => array_map(fn($i) => $i->toArray(), $this->policies),
            'copyright' => $this->copyright,
        ];
    }
}
