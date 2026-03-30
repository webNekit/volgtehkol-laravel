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

class ImageAttachmentsRelationManager extends RelationManager
{
    protected static string $relationship = 'imageAttachments';
    protected static ?string $title = 'Изображения галереи';

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Forms\Components\FileUpload::make('file_path')
                ->label('Файл изображения')
                ->directory('attachments/images') // Папка сохранения
                ->image()
                ->preserveFilenames()
                ->maxSize(20480) // 20 MB
                ->acceptedFileTypes(['image/*'])
                ->required()
                ->columnSpanFull(),

            Forms\Components\TextInput::make('caption')
                ->label('Подпись'),

            Forms\Components\Toggle::make('is_visible')
                ->label('Показывать на сайте (галерея)')
                ->default(true),

            // ВАШЕ ПОЖЕЛАНИЕ: Генератор ссылки для вставки в текст!
            Forms\Components\TextInput::make('generated_url')
                ->label('Скопировать ссылку для вставки в текст (Rich Editor)')
                // Если картинка уже сохранена в БД, выводим полный URL. Иначе просим сохранить.
                ->formatStateUsing(fn($record) => $record ? asset('storage/' . $record->file_path) : 'Сначала сохраните изображение, чтобы получить ссылку')
                ->disabled() // Запрещаем редактировать ссылку
                ->copyable() // Включаем иконку "Скопировать"
                ->columnSpanFull(),
        ]);
    }

    protected function makeTable(): Table
    {
        return parent::makeTable()
            ->modifyQueryUsing(fn(Builder $query) => $query->orderBy('sort'))
            ->columns([
                Tables\Columns\ImageColumn::make('file_path')
                    ->label('Превью')
                    ->getStateUsing(fn($record) => $record ? asset('storage/' . $record->file_path) : null)
                    ->disk('public'),

                Tables\Columns\TextColumn::make('file_path')
                    ->label('Путь к файлу')
                    ->formatStateUsing(fn($record) => $record ? asset('storage/' . $record->file_path) : null)
                    ->copyableState(fn($record) => $record ? asset('storage/' . $record->file_path) : null)
                    ->copyable()
                    ->copyMessage('Ссылка скопирована')
                    ->limit(30)
                    ->searchable(),

                Tables\Columns\TextColumn::make('caption')->label('Подпись'),
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
