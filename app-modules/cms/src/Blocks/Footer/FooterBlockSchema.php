<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\Filament\Schemas;

use ClintonRocha\CMS\Contracts\BlockSchema;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;

final class FooterBlockSchema implements BlockSchema
{
    public static function schema(): array
    {
        return [
            TextInput::make('data.copyright')
                ->label('Copyright')
                ->placeholder('© 2026 Minha Empresa')
                ->required(),

            Repeater::make('data.links')
                ->label('Links')
                ->schema([
                    TextInput::make('label')
                        ->label('Texto')
                        ->required(),

                    TextInput::make('url')
                        ->label('URL')
                        ->required(),
                ])
                ->defaultItems(0),

            Repeater::make('data.socials')
                ->label('Redes sociais')
                ->schema([
                    TextInput::make('label')
                        ->label('Nome')
                        ->required(),

                    TextInput::make('url')
                        ->label('URL')
                        ->required(),

                    Select::make('icon')
                        ->label('Ícone')
                        ->options([
                            'twitter' => 'Twitter / X',
                            'github' => 'GitHub',
                            'linkedin' => 'LinkedIn',
                            'instagram' => 'Instagram',
                        ])
                        ->required(),
                ])
                ->defaultItems(0),

            Repeater::make('data.policies')
                ->label('Políticas')
                ->schema([
                    TextInput::make('label')
                        ->label('Texto')
                        ->required(),

                    TextInput::make('url')
                        ->label('URL')
                        ->required(),
                ])
                ->defaultItems(0),
        ];
    }
}
