<?php

namespace App\Filament\Resources\AbiturientsModulePages\Schemas;

use Filament\Forms;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AbiturientsModulePageForm
{
    public static string $modulePrefix = 'abiturients';

    public static function configure(Schema $schema): Schema
    {
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
                                    ['bold', 'italic', 'underline', 'strike', 'subscript', 'superscript', 'link'],
                                    ['h2', 'h3', 'alignStart', 'alignCenter', 'alignEnd'],
                                    ['blockquote', 'codeBlock', 'bulletList', 'orderedList'],
                                    ['table', 'attachFiles'],
                                    ['undo', 'redo'],
                                ])
                                ->columnSpanFull(),
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
                                ->helperText('Выберите страницу, для которой создаётся контент')
                                ->unique(
                                    table: 'module_pages',
                                    column: 'page_key',
                                    ignoreRecord: true,
                                    modifyRuleUsing: fn($rule) =>
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
