<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\Blocks\Text;

use ClintonRocha\CMS\Contracts\BlockSchema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;

final class TextSchema implements BlockSchema
{
    public function schema(): array
    {
        return [
            Select::make('data.width')
                ->label('Largura')
                ->options([
                    'narrow' => 'Estreita',
                    'normal' => 'Normal',
                    'wide' => 'Larga',
                ])
                ->required()
                ->default('normal'),

            Select::make('data.align')
                ->label('Alinhamento')
                ->options([
                    'left' => 'Esquerda',
                    'center' => 'Centralizado',
                ])
                ->required()
                ->default('left'),

            Textarea::make('data.text')
                ->label('Conteúdo')
                ->rows(6)
                ->required(),
        ];
    }
}
