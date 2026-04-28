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

class FileAttachmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'fileAttachments';
    protected static ?string $title = 'Документы и файлы';

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\FileUpload::make('file_path')
                ->label('Файл (документ)')
                ->disk('public')
                ->directory('attachments/files') // Папка сохранения документов
                ->preserveFilenames()
                ->required()
                ->columnSpanFull(),

            Forms\Components\TextInput::make('caption')
                ->label('Название документа'),

            Forms\Components\Toggle::make('is_visible')
                ->label('Показывать на сайте в блоке документов')
                ->default(true),

            Forms\Components\TextInput::make('generated_url')
                ->label('Скопировать ссылку для вставки в текст (Rich Editor)')
                ->formatStateUsing(fn($record) => $record ? asset('storage/' . $record->file_path) : 'Сначала сохраните файл, чтобы получить ссылку')
                ->disabled()
                ->copyable()
                ->columnSpanFull(),
        ]);
    }

    protected function makeTable(): Table
    {
        return parent::makeTable()
            ->modifyQueryUsing(fn(Builder $query) => $query->orderBy('sort'))
            ->columns([
                Tables\Columns\TextColumn::make('caption')
                    ->label('Название документа')
                    ->searchable(),

                Tables\Columns\TextColumn::make('file_path')
                    ->label('Полная ссылка')
                    ->formatStateUsing(fn($record) => $record ? asset('storage/' . $record->file_path) : null)
                    ->copyableState(fn($record) => $record ? asset('storage/' . $record->file_path) : null)
                    ->copyable()
                    ->copyMessage('Ссылка скопирована')
                    ->limit(30)
                    ->searchable(),

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
