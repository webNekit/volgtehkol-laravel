<?php

namespace App\Filament\Resources\StudentsModulePages\Pages;

use App\Filament\Resources\StudentsModulePages\StudentsModulePageResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListStudentsModulePages extends ListRecords
{
    protected static string $resource = StudentsModulePageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
