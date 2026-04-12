<?php

namespace App\Filament\Resources\Addresses\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AddressForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()->schema([
                    Section::make('Основная информация')->schema([
                        TextInput::make('title')
                            ->label('Название корпуса')
                            ->placeholder('Главный корпус')
                            ->required(),
                        TextInput::make('address')
                            ->label('Адрес')
                            ->required(),
                        TextInput::make('url')->label('URL-ссылка на карту')->url()->placeholder('https://yandex.ru/maps/-/CLFoyTIs')->columnSpanFull()
                    ])->columns(2)->columnSpan(4),
                    Section::make('Опции')->schema([
                        Select::make('type')->label('Тип')->options([
                            'actual' => 'Фактический адрес',
                            'juridical' => 'Юридический адрес',
                        ]),
                        Toggle::make('is_active')->label('Отображать на сайте')->default(false),
                    ])->columnSpan(2),
                ])->columns(6)->columnSpanFull()
            ]);
    }
}
