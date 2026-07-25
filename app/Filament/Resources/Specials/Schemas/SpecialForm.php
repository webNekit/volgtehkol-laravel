<?php

namespace App\Filament\Resources\Specials\Schemas;

use App\Enums\EducationLevel;
use App\Models\SpecialCategory;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SpecialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make()->schema([
                    Group::make()->schema([
                        Section::make('Основная информация')->schema([
                            Select::make('form')->options([
                                'очная' => 'Очная форма обучения',
                                'заочная' => 'Заочная форма обучения',
                            ])->columnSpanFull()->label('Форма обучения'),
                            TextInput::make('title')->label('Название')->required(),
                            TextInput::make('code')->label('Код специальности')->required(),
                            TextInput::make('level_middle')->label('Срок обучения на базе 9 классов')->placeholder('3 года 10 месяцев'),
                            TextInput::make('level_max')->label('Срок обучения на базе 11 классов')->placeholder('2 года 10 месяцев'),
                            TextInput::make('cost')->suffix('рублей')->label('Стоимость'),
                            TextInput::make('qualification')->label('Квалификация'),
                            Textarea::make('description')->label('Описание')->columnSpanFull(),
                            RichEditor::make('content')->label('Контент')->columnSpanFull(),
                        ])->columns(2)->columnSpanFull(),
                    ])->columnSpan(4),
                    Group::make()->schema([
                        Section::make('Направление')->schema([
                            Select::make('special_category_id')
                                ->label('Категория')
                                ->options(fn() => SpecialCategory::pluck('title', 'id'))
                                ->required()
                                ->columnSpanFull(),
                            Action::make('createCategory')
                                ->label('Добавить новую категорию?')
                                ->button()
                                ->size('full')
                                ->color('secondary')
                                ->modalHeading('Создать категорию')
                                ->modalButton('Создать')
                                ->form([
                                    TextInput::make('title')->label('Название')->required(),
                                    Select::make('education_level')
                                        ->label('Уровень образования')
                                        ->options(EducationLevel::options())
                                        ->default(EducationLevel::Spo->value)
                                        ->required(),
                                    Toggle::make('is_active')->label('Отображать на сайте')->default(false),
                                ])
                                ->action(function ($data, $set) {
                                    $category = SpecialCategory::create($data);
                                    $set('special_category_id', $category->id); // выбираем сразу новую категорию
                                }),
                        ])->columnSpanFull(),
                        Section::make('Опции')->schema([
                            FileUpload::make('image')
                                ->image()
                                ->label('Фото/логотип')
                                ->disk('public')
                                ->directory('specials'),
                            Toggle::make('is_active')->label('Отображать на сайте')->default(false),
                            Toggle::make('is_banner')->label('Отображать в баннере')->default(false),
                        ])->columnSpanFull(),
                    ])->columnSpan(2)
                ])->columns(6)->columnSpanFull()
            ]);
    }
}
