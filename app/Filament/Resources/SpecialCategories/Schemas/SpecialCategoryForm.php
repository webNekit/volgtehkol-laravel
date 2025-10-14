<?php

namespace App\Filament\Resources\SpecialCategories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SpecialCategoryForm
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
                    ])->columnSpan(4),
                    Section::make()->schema([
                        Toggle::make('is_active')->label('Отображать на сайте')->default(false),
                    ])->columnSpan(2),
                ])->columns(6)->columnSpanFull()
            ]);
    }
}
