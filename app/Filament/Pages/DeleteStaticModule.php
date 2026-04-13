<?php

namespace App\Filament\Pages;

use App\Services\DeleteStaticModuleService;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class DeleteStaticModule extends Page implements HasActions
{
    use InteractsWithActions;

    protected static string|\BackedEnum|null $navigationIcon = null;

    protected static ?string $navigationLabel = 'Удалить модуль';

    protected static ?string $title = 'Удалить статический модуль';

    protected static string|\UnitEnum|null $navigationGroup = 'Настройки';

    protected static ?int $navigationSort = 101;

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-trash';
    }

    public function content(Schema $schema): Schema
    {
        return $schema
            ->components([
                Actions::make([
                    Action::make('deleteModule')
                        ->label('Удалить модуль')
                        ->icon('heroicon-o-trash')
                        ->color('danger')
                        ->button()
                        ->form([
                            Fieldset::make('Информация о модуле')
                                ->schema([
                                    TextInput::make('baseName')
                                        ->label('Название ресурса')
                                        ->placeholder('Students, About, Info')
                                        ->required()
                                        ->helperText('Например: Students, About, Info'),

                                    TextInput::make('prefix')
                                        ->label('Префикс маршрута')
                                        ->placeholder('students, about, info')
                                        ->required()
                                        ->helperText('Например: students, about, info'),

                                    Checkbox::make('deleteDbRecords')
                                        ->label('Удалить записи из базы данных')
                                        ->helperText('Удалить все записи для этого модуля из таблицы module_pages'),
                                ]),

                            Fieldset::make('Предупреждение')
                                ->schema([
                                    MarkdownEditor::make('warning')
                                        ->label('')
                                        ->default(<<<'MD'
⚠️ **Внимание:** Это действие удалит следующие файлы и настройки:

- `app/Filament/Resources/{BaseName}ModulePages/`
- `app/Http/Controllers/{BaseName}/`
- `resources/views/web/{prefix}/`
- `routes/web.php` — блок маршрутов
- `config/menu.php` — запись меню
- `app/Support/Sidebar.php` — маршруты боковой панели
- `app/Providers/AppServiceProvider.php` — регистрация представлений
MD
                                        )
                                        ->disabled()
                                        ->hiddenLabel()
                                        ->columnSpanFull(),
                                ]),
                        ])
                        ->action(function (array $data, DeleteStaticModuleService $service) {
                            $baseName = Str::studly($data['baseName']);
                            $prefix = Str::lower($data['prefix']);
                            $deleteDbRecords = $data['deleteDbRecords'] ?? false;

                            try {
                                $result = $service->deleteModule($baseName, $prefix, $deleteDbRecords);

                                Notification::make()
                                    ->title('Модуль удалён')
                                    ->body($result['message'])
                                    ->success()
                                    ->send();
                            } catch (\Exception $e) {
                                Notification::make()
                                    ->title('Ошибка при удалении модуля')
                                    ->body($e->getMessage())
                                    ->danger()
                                    ->send();
                            }
                        })
                        ->modalHeading('Удалить статический модуль')
                        ->modalDescription('Вы уверены, что хотите удалить этот модуль? Это действие необратимо.')
                        ->modalSubmitActionLabel('Удалить')
                        ->modalCancelActionLabel('Отмена')
                        ->requiresConfirmation()
                        ->modalWidth('4xl'),
                ]),
            ]);
    }
}
