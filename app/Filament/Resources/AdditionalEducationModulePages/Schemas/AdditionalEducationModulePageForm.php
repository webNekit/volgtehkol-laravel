<?php

namespace App\Filament\Resources\AdditionalEducationModulePages\Schemas;

use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Forms;

class AdditionalEducationModulePageForm
{
    public static string $modulePrefix = 'additional_education'; // префикс модуля

    public static function configure(Schema $schema): Schema
    {
        // Опции страниц для данного модуля
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
                                ->helperText('Выберите страницу, для которой создаётся контент')
                                ->unique(
                                    table: 'module_pages',
                                    column: 'page_key',
                                    ignoreRecord: true, // разрешает редактировать существующую запись
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
