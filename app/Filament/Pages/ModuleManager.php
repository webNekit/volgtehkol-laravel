<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Services\StaticModuleService;
use Filament\Notifications\Notification;
use Illuminate\Support\Str;

class ModuleManager extends Page
{
    protected static ?string $navigationLabel = 'Менеджер модулей';
    protected static ?string $title = 'Управление модулями';
    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?int $navigationSort = 103;
    protected static string|\UnitEnum|null $navigationGroup = 'Настройки';

    protected string $view = 'filament.pages.module-manager';

    public $modules = [];

    public function mount()
    {
        $this->loadModules();
    }

    public function loadModules()
    {
        $this->modules = include(base_path('config/menu.php'));
    }

    public function deletePage($modulePrefix, $pageRoute, $moduleFolder)
    {
        $parts = explode('::', $pageRoute);
        if (count($parts) < 2) return;
        $pageKey = $parts[1];

        try {
            $service = new StaticModuleService();
            $service->deletePageFromModule($moduleFolder, $modulePrefix, $pageKey);
            $this->loadModules();
            Notification::make()->title('Страница успешно удалена')->success()->send();
        } catch (\Exception $e) {
            Notification::make()->title('Ошибка удаления')->body($e->getMessage())->danger()->send();
        }
    }
}
