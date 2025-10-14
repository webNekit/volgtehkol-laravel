<?php

namespace App\Filament\Resources\ContactDepartaments\Pages;

use App\Filament\Resources\ContactDepartaments\ContactDepartamentResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditContactDepartament extends EditRecord
{
    protected static string $resource = ContactDepartamentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
