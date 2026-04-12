<?php

namespace App\Filament\Resources\CategoryStaff\Pages;

use App\Filament\Resources\CategoryStaff\CategoryStaffResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCategoryStaff extends EditRecord
{
    protected static string $resource = CategoryStaffResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
