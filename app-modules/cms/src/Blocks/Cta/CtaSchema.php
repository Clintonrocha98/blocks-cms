<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\Blocks\Cta;

use ClintonRocha\CMS\Contracts\BlockSchema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

final class CtaSchema implements BlockSchema
{
    public static function schema(): array
    {
        return [

            Select::make('data.align')
                ->label('Alinhamento')
                ->options([
                    'left' => 'Esquerda',
                    'center' => 'Centralizado',
                ])
                ->default('center'),

            TextInput::make('data.title')
                ->label('Título')
                ->required(),

            Textarea::make('data.text')
                ->label('Texto complementar'),

            TextInput::make('data.label')
                ->label('Texto do botão')
                ->required(),

            TextInput::make('data.url')
                ->label('Link do botão')
                ->url()
                ->required(),
        ];

    }
}
