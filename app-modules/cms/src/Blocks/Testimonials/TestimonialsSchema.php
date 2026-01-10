<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\Blocks\Testimonials;

use ClintonRocha\CMS\Contracts\BlockSchema;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

final class TestimonialsSchema implements BlockSchema
{
    public function schema(): array
    {
        return [

            Select::make('data.columns')
                ->label('Colunas')
                ->options([
                    2 => '2 colunas',
                    3 => '3 colunas',
                ])
                ->default(3)
                ->visible(fn ($get) => $get('data.variant') === 'grid'),

            Repeater::make('data.items')
                ->label('Depoimentos')
                ->schema([
                    Textarea::make('quote')
                        ->label('Depoimento')
                        ->rows(4)
                        ->required(),

                    TextInput::make('name')
                        ->label('Nome')
                        ->required(),

                    TextInput::make('role')
                        ->label('Cargo / Empresa'),

                    TextInput::make('avatar')
                        ->label('Avatar (URL)'),
                ])
                ->minItems(1)
                ->required(),
        ];

    }
}
