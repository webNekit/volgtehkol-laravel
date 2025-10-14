<?php

namespace App\Filament\Resources\Documents\Pages;

use App\Filament\Resources\CategoryDocuments\CategoryDocumentResource;
use App\Filament\Resources\Documents\DocumentResource;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDocuments extends ListRecords
{
    protected static string $resource = DocumentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('categories')
                ->label('Добавить новую категорию')
                ->url(CategoryDocumentResource::getUrl('index'))
                ->button()
                ->color('gray'),
            CreateAction::make()
                ->label('Добавить документ'),
        ];
    }
}
