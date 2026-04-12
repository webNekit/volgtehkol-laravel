<?php

namespace App\Filament\Resources\Staff\Pages;

use App\Filament\Resources\CategoryStaff\CategoryStaffResource;
use App\Filament\Resources\Staff\StaffResource;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListStaff extends ListRecords
{
    protected static string $resource = StaffResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('categories')
                ->label('Добавить новый отдел')
                ->url(CategoryStaffResource::getUrl('index'))
                ->button()
                ->color('gray'),
            CreateAction::make(),
        ];
    }
}
