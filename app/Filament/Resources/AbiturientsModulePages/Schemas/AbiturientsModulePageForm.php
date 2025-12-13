<?php

namespace App\Filament\Resources\AbiturientsModulePages\Schemas;

use Filament\Forms;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Storage;

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
                            // RichEditor
                            Forms\Components\RichEditor::make('content')
                                ->label('Контент')
                                ->toolbarButtons([
                                    ['bold', 'italic', 'underline', 'strike', 'subscript', 'superscript', 'link'],
                                    ['h2', 'h3', 'alignStart', 'alignCenter', 'alignEnd'],
                                    ['blockquote', 'codeBlock', 'bulletList', 'orderedList'],
                                    ['table', 'attachFiles'],
                                    ['undo', 'redo'],
                                ])
                                ->columnSpanFull(),

                        ])->columnSpanFull(),

                        // Repeater для изображений
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

                        // Repeater для файлов
                        Section::make()->schema([
                            Forms\Components\Repeater::make('files')
                                ->label('Файлы')
                                ->schema([
                                    Forms\Components\FileUpload::make('file')
                                        ->label('Файл')
                                        ->disk('public')
                                        ->directory("module_pages_docs")
                                        ->enableOpen()
                                        ->afterStateUpdated(function ($state, $set, $record, $component) {
                                            if ($state) {
                                                // Если пришёл объект UploadedFile
                                                if (!is_string($state)) {
                                                    $path = $state->store('module_pages_docs', 'public');
                                                } else {
                                                    $path = $state;
                                                }

                                                $url = asset("storage/$path");

                                                // Автоматически ставим ссылку в поле 'link'
                                                $set('link', $url);
                                            }
                                        }),

                                    Forms\Components\TextInput::make('caption')
                                        ->label('Название файла')
                                        ->nullable(),

                                    Forms\Components\TextInput::make('link')
                                        ->label('Ссылка на файл')
                                        ->url()
                                        ->disabled()
                                        ->copyable(copyMessage: 'Скопировано!', copyMessageDuration: 1500)
                                        ->columnSpanFull(),
                                ])
                                ->collapsible()
                                ->createItemButtonLabel('Добавить файл'),
                        ])->columnSpanFull(),

                        // Repeater для ссылок
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

                    // Основные поля страницы
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
                                ->helperText('Выберите страницу, для которой создаётся контент')
                                ->unique(
                                    table: 'module_pages',
                                    column: 'page_key',
                                    ignoreRecord: true,
                                    modifyRuleUsing: fn ($rule) =>
                                    $rule->where('module', self::$modulePrefix)
                                )
                                ->validationMessages([
                                    'unique' => 'Страница для данного модуля уже существует.',
                                ]),
                        ])->columnSpanFull(),
                    ])->columnSpan(2),
                ])->columns(6)->columnSpanFull(),
            ]);
    }
}
