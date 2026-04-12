<?php

namespace App\Filament\Resources\CategoryDocuments\Pages;

use App\Filament\Resources\CategoryDocuments\CategoryDocumentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCategoryDocuments extends ListRecords
{
    protected static string $resource = CategoryDocumentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
