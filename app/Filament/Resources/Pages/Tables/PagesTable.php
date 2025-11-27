<?php

namespace App\Filament\Resources\Pages\Tables;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Models\Section;

class PagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Заголовок')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('slug')
                    ->label('URL')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('section.title')
                    ->label('Раздел')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Создано')
                    ->date('d.m.Y H:i')
                    ->sortable(),

            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Статус')
                    ->options([
                        1 => 'Активна',
                        0 => 'Скрыта',
                    ]),
                Tables\Filters\SelectFilter::make('section_id')
                    ->label('Раздел')
                    ->options(
                        Section::pluck('title', 'id')
                    ),

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
