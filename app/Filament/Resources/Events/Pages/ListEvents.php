<?php

namespace App\Filament\Resources\Events\Pages;

use App\Filament\Resources\Categories\CategoryResource;
use App\Filament\Resources\EventFormats\EventFormatResource;
use App\Filament\Resources\Events\EventResource;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListEvents extends ListRecords
{
    protected static string $resource = EventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('categories')
                ->label('Добавить формат')
                ->url(EventFormatResource::getUrl('index'))
                ->button()
                ->color('gray'),
            CreateAction::make(),
        ];
    }
}
