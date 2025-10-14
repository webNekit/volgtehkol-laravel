<?php

namespace App\Filament\Resources\CollegeModulePages\Pages;

use App\Filament\Resources\CollegeModulePages\CollegeModulePageResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCollegeModulePages extends ListRecords
{
    protected static string $resource = CollegeModulePageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
