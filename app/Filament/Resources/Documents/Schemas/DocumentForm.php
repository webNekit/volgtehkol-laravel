<?php

namespace App\Filament\Resources\Documents\Schemas;

use App\Models\CategoryDocument;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class DocumentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()->schema([
                    Section::make('Основная информация')->schema([
                        TextInput::make('title')
                            ->label('Название документа')
                            ->required(),

                        FileUpload::make('file')
                            ->disk('public')
                            ->directory('documents')
                            ->label('Документ')
                            ->required()
                            // 1. Указываем кастомное сообщение при ошибке валидации
                            ->validationMessages([
                                'required' => 'Пожалуйста, прикрепите документ перед сохранением.',
                            ])
                            // 2. Указываем конкретные типы файлов (PDF, Word, картинки), чтобы избежать загрузки вредоносных скриптов
                            ->acceptedFileTypes([
                                'application/pdf',
                                'application/msword',
                                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                                'image/*'
                            ])
                            // 3. Ограничиваем размер (например, 15 МБ), иначе Livewire вылетит с ошибкой 500 при загрузке огромного файла
                            ->maxSize(15360),

                    ])->columnSpanFull(),
                ])->columnSpan(4),

                Group::make()->schema([
                    Section::make('')->schema([
                        Select::make('category_document_id')
                            ->options(function () {
                                return CategoryDocument::where('is_active', true)->pluck('title', 'id');
                            })
                            ->label('Категория документа')
                        // Если категория тоже обязательна, раскомментируйте:
                        // ->required(), 
                        ,
                        Toggle::make('is_active')
                            ->default(false)
                            ->label('Отображать на сайте')
                    ])->columnSpanFull()
                ])->columnSpan(2),
            ])->columns(6);
    }
}