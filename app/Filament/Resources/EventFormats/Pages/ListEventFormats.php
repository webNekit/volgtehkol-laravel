<?php

namespace App\Filament\Resources\EventFormats\Pages;

use App\Filament\Resources\EventFormats\EventFormatResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListEventFormats extends ListRecords
{
    protected static string $resource = EventFormatResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
