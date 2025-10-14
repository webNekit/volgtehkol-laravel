<?php

namespace App\Filament\Resources\Articles\Pages;

use App\Filament\Resources\Articles\ArticleResource;
use App\Filament\Resources\Categories\CategoryResource;
use App\Filament\Resources\CategoryStaff\CategoryStaffResource;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListArticles extends ListRecords
{
    protected static string $resource = ArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('categories')
                ->label('Добавить категорию')
                ->url(CategoryResource::getUrl('index'))
                ->button()
                ->color('gray'),
            CreateAction::make(),
        ];
    }
}
