<?php

namespace App\Filament\Schemas;

use App\Contract\BlockSchema;
use Filament\Forms\Components\Textarea;

class CtaBlockSchema implements BlockSchema
{

    public static function schema(): array
    {
        return [
            Textarea::make('data.text')
                ->label('Texto')
                ->required(),
        ];

    }
}
