<?php

namespace App\Filament\Resources\AbiturientsModulePages\Pages;

use App\Filament\Resources\AbiturientsModulePages\AbiturientsModulePageResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAbiturientsModulePages extends ListRecords
{
    protected static string $resource = AbiturientsModulePageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
