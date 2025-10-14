<?php

namespace App\Filament\Resources\AbiturientsModulePages\Schemas;

use Filament\Forms;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AbiturientsModulePageForm
{
    public static string $modulePrefix = 'abiturients'; // префикс модуля

    public static function configure(Schema $schema): Schema
    {
        // Опции страниц для данного модуля
        $pageOptions = [
            'admissionCommittee' => 'Приемная комиссия',
            'admissionRules' => 'Правила и условия приема',
            'paidEducation' => 'Платное обучение',
            'dormitory' => 'Общежитие',
            'medicalExams' => 'Медицинские осмотры',
            'applicationInfo' => 'Информация о количестве поданных заявлений',
            'documents' => 'Документы',
            'faq' => 'Вопросы-ответы',
            'examSchedule' => 'Расписание вступительных испытаний по Пожарной Безопасности',
            'examResults' => 'Результаты вступительных испытаний абитуриентов',
            'enrollmentOrder' => 'Приказ на зачисление',
            'recommendedList' => 'Список лиц рекомендованных к зачислению',
        ];

        return $schema
            ->components([
                Group::make()->schema([
                    Grid::make()->schema([
                        Section::make('Основная информация')->schema([
                            Forms\Components\RichEditor::make('content')
                                ->label('Контент')
                                ->toolbarButtons([
                                    'bold', 'italic', 'underline', 'strike',
                                    'link', 'bulletList', 'orderedList',
                                    'blockquote', 'codeBlock', 'h2', 'h3',
                                    'undo', 'redo', 'table'
                                ])
                                ->columnSpanFull(),
                        ])->columnSpanFull(),
                        Section::make()->schema([
                            Forms\Components\Repeater::make('images')
                                ->label('Изображения')
                                ->schema([
                                    Forms\Components\FileUpload::make('file')
                                        ->label('Файл')
                                        ->image()
                                        ->directory("module_pages")
                                        ->disk('public'),
                                    Forms\Components\TextInput::make('caption')
                                        ->label('Подпись')
                                        ->nullable(),
                                ])
                                ->collapsible()
                                ->createItemButtonLabel('Добавить изображение'),
                        ])->columnSpanFull(),
                        Section::make()->schema([
                            Forms\Components\Repeater::make('files')
                                ->label('Файлы')
                                ->schema([
                                    Forms\Components\FileUpload::make('file')
                                        ->label('Файл')
                                        ->disk('public')
                                        ->directory("module_pages_docs"),
                                    Forms\Components\TextInput::make('caption')
                                        ->label('Название файла')
                                        ->nullable(),
                                ])
                                ->collapsible()
                                ->createItemButtonLabel('Добавить файл'),
                        ])->columnSpanFull(),
                        Section::make()->schema([
                            Forms\Components\Repeater::make('links')
                                ->label('Ссылки')
                                ->schema([
                                    Forms\Components\TextInput::make('url')
                                        ->label('URL')
                                        ->url(),
                                    Forms\Components\TextInput::make('caption')
                                        ->label('Название ссылки')
                                        ->nullable(),
                                ])
                                ->columns(2)
                                ->collapsible()
                                ->createItemButtonLabel('Добавить ссылку'),
                        ])->columnSpanFull(),
                    ])->columnSpan(4),
                    Grid::make()->schema([
                        Section::make()->schema([
                            Forms\Components\Hidden::make('module')
                                ->default(self::$modulePrefix)
                                ->required(),
                            Forms\Components\TextInput::make('title')
                                ->label('Заголовок')
                                ->placeholder('Информация о колледже')
                                ->required(),
                            Forms\Components\Select::make('page_key')
                                ->label('Страница')
                                ->options($pageOptions)
                                ->required()
                                ->helperText('Выберите страницу, для которой создаётся контент'),
                        ])->columnSpanFull(),
                    ])->columnSpan(2),
                ])->columns(6)->columnSpanFull(),
            ]);
    }
}
