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
                        TextInput::make('title')->label('Название документа')->required(),
                        FileUpload::make('file')
                            ->disk('public')
                            ->directory('documents')
                            ->label('Документ')
                            ->required(),
                    ])->columnSpanFull(),
                ])->columnSpan(4),
                Group::make()->schema([
                    Section::make('')->schema([
                        Select::make('category_document_id')
                            ->options(function () {
                                return CategoryDocument::where('is_active', true)->pluck('title', 'id');
                            })
                            ->label('Категория документа'),
                        Toggle::make('is_active')
                            ->default(false)
                            ->label('Отображать на сайте')
                    ])->columnSpanFull()
                ])->columnSpan(2),
            ])->columns(6);
    }
}
