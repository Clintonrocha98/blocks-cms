<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\Filament\Resources\Pages;

use BackedEnum;
use ClintonRocha\CMS\Filament\Resources\Pages\Pages\CreatePage;
use ClintonRocha\CMS\Filament\Resources\Pages\Pages\EditPage;
use ClintonRocha\CMS\Filament\Resources\Pages\Pages\ListPages;
use ClintonRocha\CMS\Infrastructure\BlockCatalog;
use ClintonRocha\CMS\Infrastructure\BlockFactory;
use ClintonRocha\CMS\Models\Page;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $slug = 'pages';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(
                        fn (?string $state, Set $set) => $set('slug', Str::slug($state))
                    ),

                TextInput::make('slug')
                    ->disabled()
                    ->required()
                    ->dehydrated(),

                Repeater::make('blocks')
                    ->relationship()
                    ->orderable('position')
                    ->schema([
                        Select::make('type')
                            ->options(fn () => BlockCatalog::options())
                            ->required()
                            ->reactive(),

                        Group::make(fn (Get $get) => [
                            Select::make('data.variant')
                                ->label('Components')
                                ->options(fn () => $get('type') ? BlockCatalog::variants($get('type')) : [])
                                ->required(),
                            ...($get('type') ? BlockFactory::make($get('type'))->schema() : []),
                        ])->reactive(),
                    ])
                    ->collapsed()
                    ->cloneable()
                    ->columnSpanFull()
                    ->defaultItems(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('slug')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('blocks_count')
                    ->label('Blocks')
                    ->counts('blocks')
                    ->sortable(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPages::route('/'),
            'create' => CreatePage::route('/create'),
            'edit' => EditPage::route('/{record}/edit'),
        ];
    }
}
