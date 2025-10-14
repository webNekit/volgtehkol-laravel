<?php

namespace App\Filament\Resources\AdditionalEducationModulePages\Pages;

use App\Filament\Resources\AdditionalEducationModulePages\AdditionalEducationModulePageResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAdditionalEducationModulePage extends EditRecord
{
    protected static string $resource = AdditionalEducationModulePageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
