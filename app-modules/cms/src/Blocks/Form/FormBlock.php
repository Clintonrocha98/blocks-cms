<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\Blocks\Form;

use ClintonRocha\CMS\Contracts\BlockData;
use ClintonRocha\CMS\Contracts\BlockDefinition;

class FormBlock implements BlockDefinition
{
    public function type(): string
    {
        return 'form';
    }

    public function label(): string
    {
        return 'Formulário';
    }

    public function schema(): array
    {
        return FormSchema::schema();
    }

    public function fromModel(array $data): BlockData
    {
        return FormData::fromArray($data);
    }

    public function view(string $variant): string
    {
        return 'cms::blocks.form.'.$variant;
    }
}
