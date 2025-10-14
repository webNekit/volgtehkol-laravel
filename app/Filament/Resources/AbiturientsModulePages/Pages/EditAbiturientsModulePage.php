<?php

namespace App\Filament\Resources\AbiturientsModulePages\Pages;

use App\Filament\Resources\AbiturientsModulePages\AbiturientsModulePageResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAbiturientsModulePage extends EditRecord
{
    protected static string $resource = AbiturientsModulePageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
