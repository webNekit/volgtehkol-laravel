<?php

namespace App\Filament\Resources\CategoryDocuments\Pages;

use App\Filament\Resources\CategoryDocuments\CategoryDocumentResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCategoryDocument extends EditRecord
{
    protected static string $resource = CategoryDocumentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
