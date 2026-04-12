<?php

namespace App\Filament\Resources\StudentsModulePages\Pages;

use App\Filament\Resources\StudentsModulePages\StudentsModulePageResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditStudentsModulePage extends EditRecord
{
    protected static string $resource = StudentsModulePageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
