<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\Blocks\Features;

use ClintonRocha\CMS\Contracts\BlockSchema;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

final class FeaturesSchema implements BlockSchema
{
    public static function schema(): array
    {
        return [

            Select::make('data.columns')
                ->label('Colunas')
                ->options([
                    2 => '2 colunas',
                    3 => '3 colunas',
                    4 => '4 colunas',
                ])
                ->default(3)
                ->visible(fn ($get) => $get('data.variant') === 'grid'),

            Repeater::make('data.items')
                ->label('Benefícios')
                ->schema([
                    TextInput::make('title')
                        ->label('Título')
                        ->required(),

                    Textarea::make('description')
                        ->label('Descrição')
                        ->rows(3)
                        ->required(),
                ])
                ->minItems(1)
                ->required(),
        ];
    }
}
