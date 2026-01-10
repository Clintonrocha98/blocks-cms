<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\Blocks\Form;

use ClintonRocha\CMS\Contracts\BlockSchema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

final class FormSchema implements BlockSchema
{
    public function schema(): array
    {
        return [

            Select::make('data.form_id')
                ->label('Formulário')
                ->options([
                    'contact' => 'Contato',
                ])
                ->required(),

            TextInput::make('data.title')
                ->label('Título')
                ->required(),

            Textarea::make('data.description')
                ->label('Descrição'),

            TextInput::make('data.submit_label')
                ->label('Texto do botão')
                ->default('Enviar'),
        ];

    }
}
