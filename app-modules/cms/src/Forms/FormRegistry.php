<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\Forms;

use ClintonRocha\CMS\Forms\Contracts\FormDefinition;
use ClintonRocha\CMS\Forms\Definitions\ContactFormDefinition;
use InvalidArgumentException;

final class FormRegistry
{
    public static function get(string $formId): FormDefinition
    {
        return match ($formId) {
            'contact' => new ContactFormDefinition(),
            default => throw new InvalidArgumentException('Formulário inválido'),
        };
    }
}
