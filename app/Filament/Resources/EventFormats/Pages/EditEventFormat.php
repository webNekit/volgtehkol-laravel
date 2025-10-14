<?php

namespace App\Filament\Resources\EventFormats\Pages;

use App\Filament\Resources\EventFormats\EventFormatResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditEventFormat extends EditRecord
{
    protected static string $resource = EventFormatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
