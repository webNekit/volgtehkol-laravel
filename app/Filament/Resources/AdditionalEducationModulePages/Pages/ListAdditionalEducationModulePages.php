<?php

namespace App\Filament\Resources\AdditionalEducationModulePages\Pages;

use App\Filament\Resources\AdditionalEducationModulePages\AdditionalEducationModulePageResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAdditionalEducationModulePages extends ListRecords
{
    protected static string $resource = AdditionalEducationModulePageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
