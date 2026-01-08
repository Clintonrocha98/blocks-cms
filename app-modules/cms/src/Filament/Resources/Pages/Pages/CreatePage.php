<?php

declare(strict_types=1);

namespace ClintonRocha\CMS\Filament\Resources\Pages\Pages;

use ClintonRocha\CMS\Filament\Resources\Pages\PageResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePage extends CreateRecord
{
    protected static string $resource = PageResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
