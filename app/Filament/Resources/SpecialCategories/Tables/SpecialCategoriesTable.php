<?php

namespace App\Filament\Resources\SpecialCategories\Tables;

use App\Enums\EducationLevel;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SpecialCategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('#')->searchable()->sortable(),
                TextColumn::make('title')->label('Название')->searchable()->sortable(),
                TextColumn::make('education_level')
                    ->label('Уровень образования')
                    ->formatStateUsing(fn(EducationLevel $state) => $state->label())
                    ->sortable(),
                IconColumn::make('is_active')->boolean()->label('Отображать на сайте'),
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
