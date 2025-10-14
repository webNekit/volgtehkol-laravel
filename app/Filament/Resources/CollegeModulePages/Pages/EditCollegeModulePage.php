<?php

namespace App\Filament\Resources\CollegeModulePages\Pages;

use App\Filament\Resources\CollegeModulePages\CollegeModulePageResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCollegeModulePage extends EditRecord
{
    protected static string $resource = CollegeModulePageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
