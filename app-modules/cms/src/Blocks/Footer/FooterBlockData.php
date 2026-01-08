<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\ValueObjects;

use ClintonRocha\CMS\Contracts\BlockData;

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
            FooterLinkItem::fromArray(...),
            $links
        );

        $this->socials = array_map(
            FooterSocialItem::fromArray(...),
            $socials
        );

        $this->policies = array_map(
            FooterLinkItem::fromArray(...),
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
            'links' => array_map(fn (FooterLinkItem $i) => $i->toArray(), $this->links),
            'socials' => array_map(fn (FooterSocialItem $i) => $i->toArray(), $this->socials),
            'policies' => array_map(fn (FooterLinkItem $i) => $i->toArray(), $this->policies),
            'copyright' => $this->copyright,
        ];
    }
}
