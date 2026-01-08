<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\Contracts;

interface BlockData
{
    public static function fromArray(array $data): self;

    public function toArray(): array;
}
