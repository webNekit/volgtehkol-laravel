<?php

namespace App\Filament\Resources\CategoryStaff\Pages;

use App\Filament\Resources\CategoryStaff\CategoryStaffResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCategoryStaff extends ListRecords
{
    protected static string $resource = CategoryStaffResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
