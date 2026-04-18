<?php

namespace App\Filament\Resources\InfoModulePages\Schemas;

use Filament\Forms;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class InfoModulePageForm
{
    public static string $modulePrefix = 'info';

    public static function configure(Schema $schema): Schema
    {
        $pageOptions = [
            'basics' => 'Основные сведения',
            'education' => 'Образование',
            'structure' => 'Структура и органы управления образовательного процесса',
            'mtResources' => 'Материально-техническое обеспечение и оснащённость образовательного процесса',
            'paidServices' => 'Платные образовательные услуги',
            'finance' => 'Финансово-хозяйственная деятельность',
            'vacancies' => 'Вакантные места для приема (перевода) обучающихся',
            'scholarships' => 'Стипендии и меры поддержки обучающихся',
            'catering' => 'Организация питания в образовательной организации',
            'standards' => 'Образовательные стандарты и требования',
            'accessibleEnvironment' => 'Доступная среда',
            'internationalCooperation' => 'Международное сотрудничество',
            'sredneahtubinskBranch' => 'Среднеахтубинский филиал ГБПОУ "Волгоградский технический колледж"',
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
