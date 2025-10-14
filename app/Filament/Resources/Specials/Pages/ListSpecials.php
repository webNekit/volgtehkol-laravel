<?php

namespace App\Filament\Resources\Specials\Pages;

use App\Filament\Resources\SpecialCategories\SpecialCategoryResource;
use App\Filament\Resources\Specials\SpecialResource;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSpecials extends ListRecords
{
    protected static string $resource = SpecialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('categories')
                ->label('Добавить новый отдел')
                ->url(SpecialCategoryResource::getUrl('index'))
                ->button()
                ->color('gray'),
            CreateAction::make(),
        ];
    }
}
