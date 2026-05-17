<?php

namespace App\Filament\Pages;

use App\Services\StaticModuleService;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class AddPageToModule extends Page implements HasActions
{
    use InteractsWithActions;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-document-plus';

    protected static ?string $navigationLabel = 'Привязать страницу';

    protected static ?string $title = 'Привязать страницу к модулю';

    protected static string|\UnitEnum|null $navigationGroup = 'Настройки';

    protected static ?int $navigationSort = 102;

    public function content(Schema $schema): Schema
    {
        $menuConfig = include(base_path('config/menu.php'));
        $moduleOptions = [];
        foreach ($menuConfig as $module) {
            $moduleOptions[$module['prefix']] = $module['title'] . ' (' . $module['prefix'] . ')';
        }

        // Fetch folder options dynamically
        $controllersPath = app_path('Http/Controllers');
        $folders = array_filter(glob($controllersPath . '/*'), 'is_dir');
        $folderOptions = [];
        foreach ($folders as $folder) {
            $name = basename($folder);
            $folderOptions[$name] = $name;
        }

        return $schema
            ->components([
                Actions::make([
                    Action::make('addPage')
                        ->label('Привязать страницу')
                        ->icon('heroicon-o-plus')
                        ->button()
                        ->form([
                            Section::make('Информация о модуле')
                                ->schema([
                                    \Filament\Forms\Components\Select::make('module_prefix')
                                        ->label('Выберите модуль')
                                        ->options($moduleOptions)
                                        ->required()
                                        ->searchable()
                                        ->live()
                                        ->helperText('Выберите модуль из списка'),
                                    \Filament\Forms\Components\Select::make('moduleFolder')
                                        ->label('Папка контроллера')
                                        ->options($folderOptions)
                                        ->required()
                                        ->searchable()
                                        ->helperText('Выберите папку, где лежит контроллер (из app/Http/Controllers)'),
                                    \Filament\Forms\Components\TextInput::make('pageKey')
                                        ->label('Ключ страницы')
                                        ->placeholder('new-page')
                                        ->required(),
                                    \Filament\Forms\Components\TextInput::make('pageTitle')
                                        ->label('Заголовок страницы')
                                        ->placeholder('Новая страница')
                                        ->required(),
                                ]),
                        ])
                        ->action(function (array $data, StaticModuleService $service) {
                            try {
                                $service->addPageToModule(
                                    $data['moduleFolder'],
                                    $data['module_prefix'],
                                    Str::camel($data['pageKey']),
                                    $data['pageTitle']
                                );
                                Notification::make()
                                    ->title('Страница успешно добавлена')
                                    ->success()
                                    ->send();
                            } catch (\Exception $e) {
                                Notification::make()
                                    ->title('Ошибка')
                                    ->body($e->getMessage())
                                    ->danger()
                                    ->send();
                            }
                        })
                        ->modalHeading('Привязать страницу к существующему модулю')
                        ->modalWidth('lg'),
                ]),
            ]);
    }
}
