<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\Filament\Schemas;

use ClintonRocha\CMS\Contracts\BlockSchema;
use Filament\Forms\Components\Select;

final class DividerBlockSchema implements BlockSchema
{
    public static function schema(): array
    {
        return [
            Select::make('data.variant')
                ->label('Estilo')
                ->options([
                    'line' => 'Linha',
                    'space' => 'Espaço',
                    'icon' => 'Ícone',
                ])
                ->default('line')
                ->required(),

            Select::make('data.spacing')
                ->label('Margem vertical')
                ->options([
                    'sm' => 'Pequena',
                    'md' => 'Média',
                    'lg' => 'Grande',
                ])
                ->default('md'),
        ];
    }
}
