<?php

namespace App\Filament\Resources\SpecialCategories\Pages;

use App\Filament\Resources\SpecialCategories\SpecialCategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSpecialCategories extends ListRecords
{
    protected static string $resource = SpecialCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
