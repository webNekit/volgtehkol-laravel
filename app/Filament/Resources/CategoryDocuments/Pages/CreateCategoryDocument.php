<?php

namespace App\Filament\Resources\CategoryDocuments\Pages;

use App\Filament\Resources\CategoryDocuments\CategoryDocumentResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCategoryDocument extends CreateRecord
{
    protected static string $resource = CategoryDocumentResource::class;
}
