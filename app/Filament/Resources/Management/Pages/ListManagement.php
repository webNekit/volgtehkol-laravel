<?php

namespace App\Filament\Resources\Management\Pages;

use App\Filament\Resources\CategoryManagement\CategoryManagementResource;
use App\Filament\Resources\Management\ManagementResource;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListManagement extends ListRecords
{
    protected static string $resource = ManagementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('categories')
                ->label('Добавить новый отдел')
                ->url(CategoryManagementResource::getUrl('index'))
                ->button()
                ->color('gray'),
            CreateAction::make(),
        ];
    }
}
