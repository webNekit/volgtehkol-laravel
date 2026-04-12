<?php

namespace App\Filament\Resources\InfoModulePages\Pages;

use App\Filament\Resources\InfoModulePages\InfoModulePageResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditInfoModulePage extends EditRecord
{
    protected static string $resource = InfoModulePageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
