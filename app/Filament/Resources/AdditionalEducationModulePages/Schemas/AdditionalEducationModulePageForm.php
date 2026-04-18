<?php

namespace App\Filament\Resources\AdditionalEducationModulePages\Schemas;

use Filament\Forms;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AdditionalEducationModulePageForm
{
    public static string $modulePrefix = 'additional_education';

    public static function configure(Schema $schema): Schema
    {
        $pageOptions = [
            'documents' => 'Документы',
            'qualificationPrograms' => 'Программы повышения квалификации и профессиональной переподготовки',
            'professionalPrograms' => 'Программы профессионального обучения',
            'childrenAndAdults' => 'Дополнительное образование детей и взрослых',
            'covidTraining' => 'Обучение лиц, пострадавших от последствий распространения коронавирусной инфекции',
            'announcements' => 'Объявления',
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
                                    ['fullscreen'],
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
