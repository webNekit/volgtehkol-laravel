<?php

namespace App\Filament\Resources\CategoryDocuments\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CategoryDocumentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()->schema([
                    Section::make('Основная информация')->schema([
                        TextInput::make('title')
                            ->label('Название')
                            ->required(),
                        TextInput::make('order')
                            ->label('Порядковый номер')
                            ->numeric()
                            ->helperText('Если указать существующий номер, остальные сдвинутся вниз.'),
                    ])->columnSpan(4),
                    Section::make()->schema([
                        Toggle::make('is_active')->label('Отображать на сайте')->default(false),
                    ])->columnSpan(2),
                ])->columns(6)->columnSpanFull()
            ]);
    }
}
