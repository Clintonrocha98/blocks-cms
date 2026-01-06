<?php

namespace App\Filament\Schemas;

use App\Contract\BlockSchema;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class HeroBlockSchema implements BlockSchema
{

    public static function schema(): array
    {
        return [
            TextInput::make('data.title')
                ->label('Título')
                ->required(),

            Textarea::make('data.subtitle')
                ->label('Subtítulo'),
        ];
    }
}
