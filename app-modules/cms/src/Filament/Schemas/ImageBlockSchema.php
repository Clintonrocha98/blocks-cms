<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\Filament\Schemas;

use ClintonRocha\CMS\Contracts\BlockSchema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

final class ImageBlockSchema implements BlockSchema
{
    public static function schema(): array
    {
        return [
            TextInput::make('data.src')
                ->label('Imagem (URL)')
                ->required(),

            TextInput::make('data.alt')
                ->label('Texto alternativo (alt)')
                ->required(),

            Textarea::make('data.caption')
                ->label('Legenda')
                ->rows(2),

            Select::make('data.align')
                ->label('Alinhamento')
                ->options([
                    'left' => 'Esquerda',
                    'center' => 'Centralizado',
                    'right' => 'Direita',
                ])
                ->default('center'),

            Select::make('data.size')
                ->label('Tamanho')
                ->options([
                    'sm' => 'Pequeno',
                    'md' => 'Médio',
                    'lg' => 'Grande',
                    'full' => 'Largura total',
                ])
                ->default('md'),
        ];

    }
}
