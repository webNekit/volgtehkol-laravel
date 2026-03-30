<?php

namespace App\Filament\RelationManagers;

use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkActionGroup;
use Illuminate\Database\Eloquent\Builder;

class RelatedLinksRelationManager extends RelationManager
{
    protected static string $relationship = 'relatedLinks';
    protected static ?string $title = 'Полезные ссылки';

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\TextInput::make('url')
                ->label('URL адрес')
                ->url()
                ->required()
                ->columnSpanFull(),

            Forms\Components\TextInput::make('caption')
                ->label('Название ссылки (текст)'),

            Forms\Components\Toggle::make('is_visible')
                ->label('Показывать на сайте')
                ->default(true)
                ->columnSpanFull(),
        ]);
    }

    protected function makeTable(): Table
    {
        return parent::makeTable()
            ->modifyQueryUsing(fn(Builder $query) => $query->orderBy('sort'))
            ->columns([
                Tables\Columns\TextColumn::make('caption')
                    ->label('Название')
                    ->searchable(),

                Tables\Columns\TextColumn::make('url')
                    ->label('URL')
                    ->copyableState(fn($record) => $record?->url)
                    ->copyable()
                    ->copyMessage('Ссылка скопирована')
                    ->limit(30),

                Tables\Columns\ToggleColumn::make('is_visible')->label('На сайте'),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->headerActions([CreateAction::make()]);
    }
}
