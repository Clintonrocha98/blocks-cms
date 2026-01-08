<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\Filament\Resources\Pages\Pages;

use ClintonRocha\CMS\Filament\Resources\Pages\PageResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPage extends EditRecord
{
    protected static string $resource = PageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('content')
                ->label('Editar conteúdo')
                ->url(fn () => static::getResource()::getUrl(
                    'content',
                    ['record' => $this->record]
                )),
            DeleteAction::make(),
        ];
    }
}
