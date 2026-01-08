<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\Forms\Contracts;

interface FormDefinition
{
    public function fields(): array;

    public function rules(): array;

    public function handle(array $data): void;
}
