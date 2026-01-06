<?php

namespace App\Filament\Resources\Pages\Pages;

use App\Enums\BlockType;
use App\Filament\Resources\Pages\PageResource;
use App\Filament\Schemas\BlockSchemaResolver;
use App\Models\Page as PageModel;
use Filament\Actions\Action;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;

class EditPageContent extends Page implements HasSchemas
{
    use InteractsWithSchemas;

    protected static string $resource = PageResource::class;

    protected string $view = 'filament.pages.edit-page-content';
    public PageModel $record;

    public array $data = [];

    protected function getHeaderActions(): array
    {
        return [
            Action::make('save')
                ->label('Save')
                ->action(fn() => $this->save()),
        ];
    }

    public function mount(PageModel $record): void
    {
        $this->record = $record;

        $this->data = [
            'blocks' => $record->blocks
                ->sortBy('position')
                ->map(fn($block) => [
                    'type' => $block->type,
                    'data' => $block->data,
                ])
                ->values()
                ->toArray(),
        ];
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->schema([
                Repeater::make('blocks')
                    ->schema([
                        Select::make('type')
                            ->options(BlockType::options())
                            ->required()
                            ->reactive(),

                        Group::make(fn ($get) =>
                        BlockType::tryFrom($get('type'))
                            ? BlockSchemaResolver::resolve(
                            BlockType::tryFrom($get('type'))
                        )
                            : []
                        )->reactive(),
                    ])
                    ->orderable()
            ]);
    }

    public function save(): void
    {
        $this->record->blocks()->delete();

        foreach ($this->data['blocks'] as $index => $block) {
            $this->record->blocks()->create([
                'type' => $block['type'],
                'data' => $block['data'] ?? [],
                'position' => $index,
            ]);
        }

        Notification::make()
            ->title('foi caralho')
            ->body('sei la o que porra escrever aqui')
            ->success()
            ->send();
    }
}
