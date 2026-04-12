<?php

namespace App\Filament\Resources\ContactDepartaments\Pages;

use App\Filament\Resources\ContactDepartaments\ContactDepartamentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListContactDepartaments extends ListRecords
{
    protected static string $resource = ContactDepartamentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
