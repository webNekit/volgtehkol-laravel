<?php

namespace App\Filament\Resources\InfoModulePages\Pages;

use App\Filament\Resources\InfoModulePages\InfoModulePageResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListInfoModulePages extends ListRecords
{
    protected static string $resource = InfoModulePageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
