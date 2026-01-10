<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\Blocks\Anchors;

use ClintonRocha\CMS\Contracts\BlockSchema;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;

final class AnchorsSchema implements BlockSchema
{
    public function schema(): array
    {
        return [

            Repeater::make('data.items')
                ->label('Links')
                ->schema([
                    TextInput::make('label')
                        ->label('Texto')
                        ->required(),

                    TextInput::make('target')
                        ->label('ID do destino (sem #)')
                        ->helperText('Ex: features, pricing, contato')
                        ->required(),
                ])
                ->minItems(1)
                ->required(),
        ];
    }
}
