<?php

namespace App\Filament\Resources\Staff\Schemas;

use App\Models\CategoryStaff;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class StaffForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Grid::make()->schema([
                Group::make()->schema([
                    Section::make('Основная информация')->schema([
                        Select::make('category_staff_id')
                            ->label('Категория')
                            ->options(function () {
                                return CategoryStaff::pluck('title', 'id');
                            })
                            ->required(),
                        TextInput::make('name')
                            ->label('ФИО сотрудника')
                            ->required(),
                        TextInput::make('position')
                            ->label('Должность')
                            ->required(),
                        TextInput::make('phone')
                            ->placeholder('000-000-00-00')
                            ->mask('999-999-99-99')
                            ->label('Телефон')
                            ->prefix('+7')
                            ->tel(),
                        TextInput::make('email')
                            ->label('E-mail')
                            ->email(),
                        TagsInput::make('disciplines')
                            ->label('Дисциплины')
                            ->placeholder('Добавьте дисциплину'),
                        TextInput::make('general_works')
                            ->label('Общие стаж работы'),
                        TextInput::make('current_works')
                            ->label('Текущие стаж работы'),
                    ])->columns(2)->columnSpanFull(),
                ])->columnSpan(4),
                Group::make()->schema([
                    Section::make('Опции')->schema([
                        FileUpload::make('image')
                            ->image()
                            ->label('Фото сотрудника')
                            ->disk('public')
                            ->directory('staff')
                    ])->columnSpanFull()
                ])->columnSpan(2)
            ])->columns(6)->columnSpanFull()
        ]);
    }
}
