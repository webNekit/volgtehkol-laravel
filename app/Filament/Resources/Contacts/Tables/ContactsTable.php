<?php

namespace App\Filament\Resources\Contacts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\BooleanColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ContactsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label('Название')->searchable(),
                TextColumn::make('type')->label('Тип'),
                TextColumn::make('value')->label('Значение')->wrap(),
                TextColumn::make('departament.title')->label('Отдел')->sortable(),
                BooleanColumn::make('is_active')->label('Активен'),
                BooleanColumn::make('is_header')->label('В шапке'),
                BooleanColumn::make('is_footer')->label('В подвале'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
