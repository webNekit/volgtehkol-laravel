<?php

namespace App\Filament\Resources\ContactDepartaments\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContactDepartamentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()->schema([
                    Section::make('Основная информация')->schema([
                        TextInput::make('title')->required()->label('Название'),
                    ])->columnSpan(4),
                    Section::make('Опции')->schema([
                        Toggle::make('is_active')->label('Отображать на сайте'),
                    ])->columnSpan(2),
                ])->columns(6)->columnSpanFull()
            ]);
    }
}
