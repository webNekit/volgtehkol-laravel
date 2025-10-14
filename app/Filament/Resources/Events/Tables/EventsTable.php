<?php

namespace App\Filament\Resources\Events\Tables;

use App\Models\EventFormat;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class EventsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label('Название мероприятия')
            ])
            ->filters([
                SelectFilter::make('event_format_id')
                    ->label('Формат')
                    ->options(fn() => EventFormat::pluck('title', 'id'))
                    ->searchable(),
                TernaryFilter::make('is_active')
                    ->label('Активные')
                    ->boolean()
                    ->trueLabel('Да')
                    ->falseLabel('Нет'),

                TernaryFilter::make('is_banner')
                    ->label('Баннер')
                    ->boolean()
                    ->trueLabel('Да')
                    ->falseLabel('Нет'),

                TernaryFilter::make('is_slider')
                    ->label('Слайдер')
                    ->boolean()
                    ->trueLabel('Да')
                    ->falseLabel('Нет'),
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
