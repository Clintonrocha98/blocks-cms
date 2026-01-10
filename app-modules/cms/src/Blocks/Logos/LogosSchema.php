<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\Blocks\Logos;

use ClintonRocha\CMS\Contracts\BlockSchema;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

final class LogosSchema implements BlockSchema
{
    public static function schema(): array
    {
        return [

            Select::make('data.columns')
                ->label('Colunas')
                ->options([
                    3 => '3 colunas',
                    4 => '4 colunas',
                    5 => '5 colunas',
                    6 => '6 colunas',
                ])
                ->default(5)
                ->visible(fn ($get) => $get('data.variant') === 'grid'),

            Repeater::make('data.items')
                ->label('Clientes / Logos')
                ->schema([
                    TextInput::make('name')
                        ->label('Nome')
                        ->required(),

                    TextInput::make('logo')
                        ->label('Logo (URL)')
                        ->required(),

                    TextInput::make('url')
                        ->label('Link (opcional)')
                        ->url(),
                ])
                ->minItems(1)
                ->required(),
        ];
    }
}
