<?php

namespace App\Filament\Resources\CategoryManagement\Pages;

use App\Filament\Resources\CategoryManagement\CategoryManagementResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCategoryManagement extends EditRecord
{
    protected static string $resource = CategoryManagementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
