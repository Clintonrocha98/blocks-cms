<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\Filament\Schemas;

use ClintonRocha\CMS\Contracts\BlockSchema;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;

final class TextBlockSchema implements BlockSchema
{
    public static function schema(): array
    {
        return [
            Select::make('data.variant')
                ->label('Tipo de texto')
                ->options([
                    'simple' => 'Texto simples',
                    'rich' => 'Texto rico',
                ])
                ->required(),

            Select::make('data.width')
                ->label('Largura')
                ->options([
                    'narrow' => 'Estreita',
                    'normal' => 'Normal',
                    'wide' => 'Larga',
                ])
                ->default('normal'),

            Select::make('data.align')
                ->label('Alinhamento')
                ->options([
                    'left' => 'Esquerda',
                    'center' => 'Centralizado',
                ])
                ->default('left'),

            Textarea::make('data.text')
                ->label('Conteúdo')
                ->rows(6)
                ->required()
                ->visible(fn ($get) => $get('data.variant') === 'simple'),

            RichEditor::make('data.text')
                ->label('Conteúdo')
                ->required()
                ->visible(fn ($get) => $get('data.variant') === 'rich'),
        ];

    }
}
