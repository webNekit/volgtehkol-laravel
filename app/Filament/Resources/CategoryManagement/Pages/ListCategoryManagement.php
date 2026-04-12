<?php

namespace App\Filament\Resources\CategoryManagement\Pages;

use App\Filament\Resources\CategoryManagement\CategoryManagementResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCategoryManagement extends ListRecords
{
    protected static string $resource = CategoryManagementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
