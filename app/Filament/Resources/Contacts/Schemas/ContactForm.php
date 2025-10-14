<?php

namespace App\Filament\Resources\Contacts\Schemas;

use App\Models\ContactDepartament;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ContactForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()->schema([
                    Section::make('Основная информация')->schema([
                        Select::make('type')
                            ->label('Тип')
                            ->options([
                                'phone' => 'Телефон',
                                'email' => 'Email',
                                'address' => 'Адрес',
                                'site' => 'Сайт',
                            ])->columnSpanFull()
                            ->required(),
                        TextInput::make('title')
                            ->label('Название')
                            ->placeholder('Например: Приёмная комиссия'),
                        TextInput::make('value')
                            ->label('Значение')
                            ->placeholder('+7 (999) 123-45-67 или info@example.com'),
                    ])->columns(2)->columnSpan(4),
                    Section::make('Отображение')->schema([
                        Select::make('contact_departament_id')
                            ->label('Отдел')
                            ->options(fn() => ContactDepartament::pluck('title', 'id'))
                            ->required(),
                        Toggle::make('is_active')->label('Активен')->default(true),
                        Toggle::make('is_header')->label('Показывать в шапке'),
                        Toggle::make('is_footer')->label('Показывать в подвале'),
                    ])->columnSpan(2),
                ])->columns(6)->columnSpanFull(),
            ]);
    }
}
