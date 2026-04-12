<?php

namespace App\Filament\Resources\Contacts\Pages;

use App\Filament\Resources\Addresses\AddressResource;
use App\Filament\Resources\ContactDepartaments\ContactDepartamentResource;
use App\Filament\Resources\Contacts\ContactResource;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListContacts extends ListRecords
{
    protected static string $resource = ContactResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('categories')
                ->label('Добавить адрес')
                ->url(AddressResource::getUrl('index'))
                ->button()
                ->color('gray'),
            Action::make('categories')
                ->label('Добавить отдел')
                ->url(ContactDepartamentResource::getUrl('index'))
                ->button()
                ->color('gray'),
            CreateAction::make(),
        ];
    }
}
