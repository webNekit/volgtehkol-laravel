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

use Filament\Forms\Components\Repeater;

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
                            ->prefix('8')
                            ->tel(),
                        TextInput::make('email')
                            ->label('E-mail')
                            ->email(),
                        TagsInput::make('disciplines')
                            ->label('Дисциплины')
                            ->placeholder('Добавьте дисциплину'),
                        TextInput::make('general_works')
                            ->label('Общий стаж работы'),
                        TextInput::make('current_works')
                            ->label('Стаж работы по специальности'),
                        TextInput::make('order')
                            ->label('Позиция')
                            ->numeric()
                            ->default(0),
                    ])->columns(2)->columnSpanFull(),

                    Section::make('Дополнительная информация')->schema([
                        Repeater::make('education')
                            ->label('Образование')
                            ->helperText('Укажите данные об образовании: учебное заведение, специальность, год окончания.')
                            ->addActionLabel('Добавить запись об образовании')
                            ->defaultItems(1)
                            ->simple(
                                TextInput::make('value')
                                    ->label('Образование')
                                    ->placeholder('Например: Высшее, ФГБОУ ВО "Волгоградский государственный университет", 2015')
                                    ->required(),
                            )
                            ->columnSpanFull(),
                        Repeater::make('work_experience')
                            ->label('Сведения об опыте работы')
                            ->helperText('Укажите стаж работы в годах или детализированный опыт.')
                            ->addActionLabel('Добавить информацию об опыте')
                            ->defaultItems(1)
                            ->simple(
                                TextInput::make('value')
                                    ->label('Опыт работы')
                                    ->placeholder('Например: 15 лет в сфере образования')
                                    ->required(),
                            )
                            ->columnSpanFull(),
                        Repeater::make('professional_development')
                            ->label('Предподготовка и повышение квалификации')
                            ->helperText('Сведения о курсах повышения квалификации, профессиональной переподготовке.')
                            ->addActionLabel('Добавить курс/программу')
                            ->defaultItems(1)
                            ->simple(
                                TextInput::make('value')
                                    ->label('Повышение квалификации')
                                    ->placeholder('Например: Программа "Цифровые технологии в обучении", 72 часа, 2023')
                                    ->required(),
                            )
                            ->columnSpanFull(),
                        Repeater::make('honors')
                            ->label('Достижения и знаки отличия')
                            ->helperText('Укажите грамоты, медали, звания и другие награды.')
                            ->addActionLabel('Добавить достижение/награду')
                            ->defaultItems(1)
                            ->simple(
                                TextInput::make('value')
                                    ->label('Достижение')
                                    ->placeholder('Например: Почетная грамота Министерства образования РФ')
                                    ->required(),
                            )
                            ->columnSpanFull(),
                    ])->columns(1)->columnSpanFull(),
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
