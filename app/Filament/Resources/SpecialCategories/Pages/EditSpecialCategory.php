<?php

namespace App\Filament\Resources\SpecialCategories\Pages;

use App\Filament\Resources\SpecialCategories\SpecialCategoryResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSpecialCategory extends EditRecord
{
    protected static string $resource = SpecialCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
