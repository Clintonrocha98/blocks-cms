<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\Blocks\Hero;

use ClintonRocha\CMS\Contracts\BlockSchema;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

final class HeroSchema implements BlockSchema
{
    public static function schema(): array
    {
        return [

            TextInput::make('data.title')
                ->label('Título')
                ->required(),

            Textarea::make('data.subtitle')
                ->label('Subtítulo'),

            TextInput::make('data.cta_label')
                ->label('Texto do botão'),

            TextInput::make('data.cta_url')
                ->label('Link do botão')
                ->url(),

            TextInput::make('data.image')
                ->label('Imagem (URL)')
                ->visible(fn ($get) => $get('data.variant') === 'split'),
        ];
    }
}
