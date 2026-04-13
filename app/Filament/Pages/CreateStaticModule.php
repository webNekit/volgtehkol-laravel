<?php

namespace App\Filament\Pages;

use App\Services\StaticModuleService;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CreateStaticModule extends Page implements HasActions
{
    use InteractsWithActions;

    protected static string|\BackedEnum|null $navigationIcon = null;

    protected static ?string $navigationLabel = 'Создать модуль';

    protected static ?string $title = 'Создать статический модуль';

    protected static string|\UnitEnum|null $navigationGroup = 'Настройки';

    protected static ?int $navigationSort = 100;

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-plus-circle';
    }

    public function content(Schema $schema): Schema
    {
        return $schema
            ->components([
                Actions::make([
                    Action::make('createModule')
                        ->label('Создать модуль')
                        ->icon('heroicon-o-plus')
                        ->button()
                        ->form([
                            Fieldset::make('Основная информация')
                                ->schema([
                                    TextInput::make('baseName')
                                        ->label('Название ресурса')
                                        ->placeholder('Students, About, Info')
                                        ->required()
                                        ->helperText('Например: Students, About, Info')
                                        ->live(onBlur: true)
                                        ->afterStateUpdated(function ($state, callable $set) {
                                            if ($state) {
                                                $set('prefix', Str::lower($state));
                                            }
                                        }),
                                    TextInput::make('prefix')
                                        ->label('Префикс маршрута')
                                        ->placeholder('students, about, info')
                                        ->required()
                                        ->helperText('Например: students, about, info'),
                                    TextInput::make('title')
                                        ->label('Заголовок модуля')
                                        ->placeholder('Студентам, О нас, Информация')
                                        ->required()
                                        ->helperText('Например: Студентам, О нас, Информация'),
                                ]),

                            Fieldset::make('Страницы модуля')
                                ->schema([
                                    Repeater::make('pages')
                                        ->label('Страницы')
                                        ->schema([
                                            TextInput::make('key')
                                                ->label('Ключ страницы')
                                                ->placeholder('basics, structure, contacts')
                                                ->required()
                                                ->live(onBlur: true),
                                            TextInput::make('title')
                                                ->label('Заголовок страницы')
                                                ->placeholder('Основные сведения, Структура, Контакты')
                                                ->required(),
                                        ])
                                        ->columns(2)
                                        ->required()
                                        ->minItems(1)
                                        ->addActionLabel('Добавить страницу')
                                        ->helperText('Добавьте хотя бы одну страницу для модуля'),
                                ]),
                        ])
                        ->action(function (array $data, StaticModuleService $service) {
                            $baseName = Str::studly($data['baseName']);
                            $prefix = Str::lower($data['prefix']);
                            $title = $data['title'];

                            $pages = [];
                            foreach ($data['pages'] as $page) {
                                $key = Str::camel($page['key']);
                                $pages[$key] = $page['title'];
                            }

                            if (empty($pages)) {
                                Notification::make()
                                    ->title('Ошибка')
                                    ->body('Необходима хотя бы одна страница.')
                                    ->danger()
                                    ->send();
                                return;
                            }

                            try {
                                $result = $service->createModule($baseName, $prefix, $title, $pages);

                                Notification::make()
                                    ->title('Модуль создан')
                                    ->body($result['message'])
                                    ->success()
                                    ->send();
                            } catch (\Exception $e) {
                                Notification::make()
                                    ->title('Ошибка при создании модуля')
                                    ->body($e->getMessage())
                                    ->danger()
                                    ->send();
                            }
                        })
                        ->modalHeading('Создать новый модуль')
                        ->modalWidth('4xl'),
                ]),
            ]);
    }
}
