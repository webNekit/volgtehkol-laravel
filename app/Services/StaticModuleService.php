<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class StaticModuleService
{
    public function createModule(string $baseName, string $prefix, string $title, array $pages): array
    {
        $baseName = Str::studly($baseName);
        $prefix = Str::lower($prefix);

        $this->generateFilamentResource($baseName, $prefix, $title, $pages);
        $this->generateController($baseName, $prefix, $pages);
        $this->generateViews($prefix, $pages);

        $this->updateRoutes($baseName, $prefix, $pages);
        $this->updateMenu($baseName, $prefix, $title, $pages);
        $this->updateSidebar($prefix, $pages);
        $this->updateAppServiceProvider($prefix);

        return [
            'success' => true,
            'message' => "Successfully generated the static module '{$baseName}'!",
        ];
    }

    public function addPageToModule(string $baseName, string $prefix, string $pageKey, string $pageTitle): array
    {
        $this->updateController($baseName, $prefix, $pageKey);
        $this->updateRoutesForPage($baseName, $prefix, $pageKey);
        $this->updateMenuForPage($prefix, $pageKey, $pageTitle);
        $this->updateSidebarForPage($prefix, $pageKey);
        $this->generateViewForPage($prefix, $pageKey, $pageTitle);
        $this->updateFilamentForm($baseName, $pageKey, $pageTitle);

        return [
            'success' => true,
            'message' => "Successfully added page '{$pageTitle}' to module '{$prefix}'!",
        ];
    }

    protected function updateFilamentForm($baseName, $pageKey, $pageTitle)
    {
        $path = app_path("Filament/Resources/{$baseName}ModulePages/Schemas/{$baseName}ModulePageForm.php");
        if (!File::exists($path)) {
            return; // Fail silently if resource form doesn't exist
        }

        $content = File::get($path);
        $newOption = "            '{$pageKey}' => '{$pageTitle}',\n";
        
        // Find the $pageOptions array
        $search = '$pageOptions = [';
        $pos = strpos($content, $search);
        if ($pos !== false) {
            $endPos = strpos($content, '];', $pos);
            $newContent = substr_replace($content, $newOption, $endPos, 0);
            File::put($path, $newContent);
        }
    }

    protected function updateController($baseName, $prefix, $pageKey)
    {
        $path = app_path("Http/Controllers/{$baseName}/{$baseName}Controller.php");
        if (!File::exists($path)) {
            throw new \Exception("Файл контроллера не найден по пути: {$path}. Убедитесь, что название папки модуля указано верно.");
        }
        $content = File::get($path);

        $newMethod = <<<PHP

    public function {$pageKey}()
    {
        return \$this->renderPage('{$pageKey}');
    }

}
PHP;

        // Find the last closing brace
        $pos = strrpos($content, '}');
        if ($pos !== false) {
            $newContent = substr_replace($content, $newMethod, $pos, 1);
            File::put($path, $newContent);
        }
    }

    protected function updateRoutesForPage($baseName, $prefix, $pageKey)
    {
        $path = base_path('routes/web.php');
        $content = File::get($path);

        $route = "        Route::get('/" . Str::kebab($pageKey) . "', [\\App\\Http\\Controllers\\{$baseName}\\{$baseName}Controller::class, '{$pageKey}'])->name('{$pageKey}');\n";

        $search = "// [MODULE:{$prefix}:START]";
        $pos = strpos($content, $search);
        if ($pos !== false) {
            $endOfGroup = strpos($content, "    });", $pos);
            $newContent = substr_replace($content, $route, $endOfGroup, 0);
            File::put($path, $newContent);
        }
    }

    protected function updateMenuForPage($prefix, $pageKey, $pageTitle)
    {
        $path = base_path('config/menu.php');
        $content = File::get($path);

        $item = "            ['name' => '{$pageTitle}', 'route' => '{$prefix}::{$pageKey}'],\n";

        $search = "// [MENU:{$prefix}:START]";
        $pos = strpos($content, $search);
        if ($pos !== false) {
            $endOfItems = strpos($content, "        ],", $pos);
            $newContent = substr_replace($content, $item, $endOfItems, 0);
            File::put($path, $newContent);
        }
    }

    protected function updateSidebarForPage($prefix, $pageKey)
    {
        $path = app_path('Support/Sidebar.php');
        $content = File::get($path);

        $route = "        '{$prefix}::{$pageKey}',\n";

        $pos = strpos($content, 'protected static array $routes = [');
        if ($pos !== false) {
            $newContent = substr_replace($content, $route, $pos + 36, 0);
            File::put($path, $newContent);
        }
    }

    public function deletePageFromModule(string $baseName, string $prefix, string $pageKey): array
    {
        $this->removeControllerMethod($baseName, $pageKey);
        $this->removeRouteForPage($prefix, $pageKey);
        $this->removeMenuEntryForPage($prefix, $pageKey);
        $this->removeSidebarEntryForPage($prefix, $pageKey);
        $this->deleteViewForPage($prefix, $pageKey);

        return [
            'success' => true,
            'message' => "Successfully deleted page '{$pageKey}' from module '{$prefix}'!",
        ];
    }

    protected function removeControllerMethod($baseName, $pageKey)
    {
        $path = app_path("Http/Controllers/{$baseName}/{$baseName}Controller.php");
        $content = File::get($path);

        $pattern = "/\n\n    public function {$pageKey}\(\)\n    \{\n        return \\\$this->renderPage\('{$pageKey}'\);\n    \}\n/";
        $newContent = preg_replace($pattern, '', $content);
        File::put($path, $newContent);
    }

    protected function removeRouteForPage($prefix, $pageKey)
    {
        $path = base_path('routes/web.php');
        $content = File::get($path);

        $routePattern = "/\s+Route::get\('\/" . Str::kebab($pageKey) . "',.*'{$pageKey}'\)->name\('{$pageKey}'\);/";
        $newContent = preg_replace($routePattern, '', $content);
        File::put($path, $newContent);
    }

    protected function removeMenuEntryForPage($prefix, $pageKey)
    {
        $path = base_path('config/menu.php');
        $content = File::get($path);

        $pattern = "/\s+\['name' => '.*', 'route' => '{$prefix}::{$pageKey}'\],\n/";
        $newContent = preg_replace($pattern, '', $content);
        File::put($path, $newContent);
    }

    protected function removeSidebarEntryForPage($prefix, $pageKey)
    {
        $path = app_path('Support/Sidebar.php');
        $content = File::get($path);

        $pattern = "/\s+'{$prefix}::{$pageKey}',\n/";
        $newContent = preg_replace($pattern, '', $content);
        File::put($path, $newContent);
    }

    protected function deleteViewForPage($prefix, $pageKey)
    {
        $path = resource_path("views/web/{$prefix}/" . Str::kebab($pageKey) . ".blade.php");
        if (File::exists($path)) {
            File::delete($path);
        }
    }


    protected function generateViews($prefix, $pages)
    {
        $dir = resource_path("views/web/{$prefix}");

        if (!File::exists($dir)) {
            File::makeDirectory($dir, 0755, true);
        }

        foreach ($pages as $key => $title) {
            $bladeName = Str::kebab($key);
            $content = <<<BLADE
<x-app :title="\$title">
    <x-module-page-content :title="\$title" :content="\$content" :images="\$images" :files="\$files" :links="\$links" />
</x-app>
BLADE;
            File::put("{$dir}/{$bladeName}.blade.php", $content);
        }
    }

    protected function updateAppServiceProvider($prefix)
    {
        $path = app_path('Providers/AppServiceProvider.php');
        if (!File::exists($path)) return;

        $content = File::get($path);
        $line = "        \$this->loadViewsFrom(base_path('resources/views/web/{$prefix}'), '{$prefix}');";

        if (strpos($content, $line) !== false) {
            return;
        }

        // Find the boot method and insert after the last loadViewsFrom
        $pos = strrpos($content, '$this->loadViewsFrom');
        if ($pos !== false) {
            $endOfLine = strpos($content, "\n", $pos);
            $newContent = substr_replace($content, "\n" . $line, $endOfLine, 0);
            File::put($path, $newContent);
        } else {
            // Find boot method if no loadViewsFrom exists
            $pos = strpos($content, 'public function boot(): void');
            if ($pos !== false) {
                $bracePos = strpos($content, '{', $pos);
                $newContent = substr_replace($content, "\n" . $line, $bracePos + 1, 0);
                File::put($path, $newContent);
            }
        }
    }

    protected function generateFilamentResource($baseName, $prefix, $title, $pages)
    {
        $dir = app_path("Filament/Resources/{$baseName}ModulePages");

        if (!File::exists($dir)) {
            File::makeDirectory($dir, 0755, true);
            File::makeDirectory("$dir/Pages", 0755, true);
            File::makeDirectory("$dir/Schemas", 0755, true);
            File::makeDirectory("$dir/Tables", 0755, true);
        }

        // 1. Resource
        $resourceContent = <<<PHP
<?php

namespace App\Filament\Resources\\{$baseName}ModulePages;

use App\Enums\NavigationGroup;
use App\Filament\Resources\\{$baseName}ModulePages\Pages\Create{$baseName}ModulePage;
use App\Filament\Resources\\{$baseName}ModulePages\Pages\Edit{$baseName}ModulePage;
use App\Filament\Resources\\{$baseName}ModulePages\Pages\List{$baseName}ModulePages;
use App\Filament\Resources\\{$baseName}ModulePages\Schemas\\{$baseName}ModulePageForm;
use App\Filament\Resources\\{$baseName}ModulePages\Tables\\{$baseName}ModulePagesTable;
use App\Models\ModulePage;
use App\Filament\RelationManagers\ImageAttachmentsRelationManager;
use App\Filament\RelationManagers\FileAttachmentsRelationManager;
use App\Filament\RelationManagers\RelatedLinksRelationManager;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class {$baseName}ModulePageResource extends Resource
{
    protected static ?string \$model = ModulePage::class;

    protected static \UnitEnum|string|null \$navigationGroup = NavigationGroup::MainModules->value;
    protected static ?string \$modelLabel = '{$title}';
    protected static ?string \$pluralModelLabel = '{$title}';

    public static string \$modulePrefix = '{$prefix}';

    protected static ?string \$recordTitleAttribute = 'title';

    public static function form(Schema \$schema): Schema
    {
        return {$baseName}ModulePageForm::configure(\$schema);
    }

    public static function table(Table \$table): Table
    {
        return {$baseName}ModulePagesTable::configure(\$table);
    }

    public static function getRelations(): array
    {
        return [
            ImageAttachmentsRelationManager::class,
            FileAttachmentsRelationManager::class,
            RelatedLinksRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => List{$baseName}ModulePages::route('/'),
            'create' => Create{$baseName}ModulePage::route('/create'),
            'edit' => Edit{$baseName}ModulePage::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()
            ->where('module', static::\$modulePrefix);
    }
}
PHP;
        File::put("$dir/{$baseName}ModulePageResource.php", $resourceContent);

        // 2. Pages
        $createPageContent = <<<PHP
<?php

namespace App\Filament\Resources\\{$baseName}ModulePages\Pages;

use App\Filament\Resources\\{$baseName}ModulePages\\{$baseName}ModulePageResource;
use Filament\Resources\Pages\CreateRecord;

class Create{$baseName}ModulePage extends CreateRecord
{
    protected static string \$resource = {$baseName}ModulePageResource::class;
}
PHP;
        File::put("$dir/Pages/Create{$baseName}ModulePage.php", $createPageContent);

        $editPageContent = <<<PHP
<?php

namespace App\Filament\Resources\\{$baseName}ModulePages\Pages;

use App\Filament\Resources\\{$baseName}ModulePages\\{$baseName}ModulePageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class Edit{$baseName}ModulePage extends EditRecord
{
    protected static string \$resource = {$baseName}ModulePageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
PHP;
        File::put("$dir/Pages/Edit{$baseName}ModulePage.php", $editPageContent);

        $listPageContent = <<<PHP
<?php

namespace App\Filament\Resources\\{$baseName}ModulePages\Pages;

use App\Filament\Resources\\{$baseName}ModulePages\\{$baseName}ModulePageResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class List{$baseName}ModulePages extends ListRecords
{
    protected static string \$resource = {$baseName}ModulePageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
PHP;
        File::put("$dir/Pages/List{$baseName}ModulePages.php", $listPageContent);

        // 3. Schema
        $pageOptionsStr = "[\n";
        foreach ($pages as $k => $v) {
            $pageOptionsStr .= "            '$k' => '$v',\n";
        }
        $pageOptionsStr .= "        ]";

        $schemaContent = <<<PHP
<?php

namespace App\Filament\Resources\\{$baseName}ModulePages\Schemas;

use Filament\Forms;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class {$baseName}ModulePageForm
{
    public static string \$modulePrefix = '{$prefix}';

    public static function configure(Schema \$schema): Schema
    {
        \$pageOptions = {$pageOptionsStr};

        return \$schema
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
                                ->default(self::\$modulePrefix)
                                ->required(),
                            Forms\Components\TextInput::make('title')
                                ->label('Заголовок')
                                ->placeholder('{$title}')
                                ->required(),
                            Forms\Components\Select::make('page_key')
                                ->label('Страница')
                                ->options(\$pageOptions)
                                ->required()
                                ->helperText('Выберите страницу, для которой создаётся контент')
                                ->unique(
                                    table: 'module_pages',
                                    column: 'page_key',
                                    ignoreRecord: true,
                                    modifyRuleUsing: fn(\$rule) =>
                                    \$rule->where('module', self::\$modulePrefix)
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
PHP;
        File::put("$dir/Schemas/{$baseName}ModulePageForm.php", $schemaContent);

        // 4. Table
        $tableContent = <<<PHP
<?php

namespace App\Filament\Resources\\{$baseName}ModulePages\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class {$baseName}ModulePagesTable
{
    public static function configure(Table \$table): Table
    {
        return \$table
            ->columns([
                TextColumn::make('title')->label('Заголовок'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
PHP;
        File::put("$dir/Tables/{$baseName}ModulePagesTable.php", $tableContent);
    }

    protected function generateController($baseName, $prefix, $pages)
    {
        $dir = app_path("Http/Controllers/{$baseName}");
        if (!File::exists($dir)) {
            File::makeDirectory($dir, 0755, true);
        }

        $methods = "";
        foreach ($pages as $key => $title) {
            $methods .= <<<PHP

    public function {$key}()
    {
        return \$this->renderPage('{$key}');
    }

PHP;
        }

        $controllerContent = <<<PHP
<?php

namespace App\Http\Controllers\\{$baseName};

use App\Http\Controllers\Controller;
use App\Models\ModulePage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class {$baseName}Controller extends Controller
{
    protected function renderPage(string \$pageKey)
    {
        \$page = ModulePage::with(['imageAttachments', 'fileAttachments', 'relatedLinks'])
            ->where('module', '{$prefix}')
            ->where('page_key', \$pageKey)
            ->first();

        if (!\$page) {
            \$page = (object) [
                'title' => 'Страница редактируется',
                'content' => '<p>Информация пока недоступна.</p>',
                'images' => collect([]),
                'files' => collect([]),
                'links' => collect([]),
            ];
        } else {
            \$page->images = \$page->imageAttachments;
            \$page->files = \$page->fileAttachments;
            \$page->links = \$page->relatedLinks;
        }

        \$bladeName = Str::kebab(\$pageKey);

        return view("{$prefix}::{\$bladeName}", [
            'title' => \$page->title,
            'content' => \$page->content,
            'images' => \$page->images,
            'files' => \$page->files,
            'links' => \$page->links,
        ]);
    }
$methods
}
PHP;
        File::put("$dir/{$baseName}Controller.php", $controllerContent);
    }

    protected function updateRoutes($baseName, $prefix, $pages)
    {
        $path = base_path('routes/web.php');
        $content = File::get($path);

        // Check if already exists
        if (strpos($content, "// [MODULE:{$prefix}:START]") !== false) {
            throw new \Exception("Routes for module '{$prefix}' already exist in routes/web.php");
        }

        $routesStr = "";
        foreach ($pages as $key => $title) {
            $kebabKey = Str::kebab($key);
            $routesStr .= "        Route::get('/{$kebabKey}', [\\App\\Http\\Controllers\\{$baseName}\\{$baseName}Controller::class, '{$key}'])->name('{$key}');\n";
        }

        $routeBlock = "\n// [MODULE:{$prefix}:START]\n"
            . "Route::prefix('{$prefix}')->group(function () {\n"
            . "    Route::namespace('{$baseName}')->as('{$prefix}::')->group(function () {\n"
            . $routesStr
            . "    });\n"
            . "});\n"
            . "// [MODULE:{$prefix}:END]\n";

        File::append($path, $routeBlock);
    }

    protected function updateMenu($baseName, $prefix, $title, $pages)
    {
        $path = base_path('config/menu.php');
        if (!File::exists($path)) return;

        $content = File::get($path);

        // Check if already exists
        if (strpos($content, "// [MENU:{$prefix}:START]") !== false) {
            throw new \Exception("Menu entry for module '{$prefix}' already exists in config/menu.php");
        }

        $itemsStr = "";
        foreach ($pages as $key => $pageTitle) {
            $itemsStr .= "            ['name' => '{$pageTitle}', 'route' => '{$prefix}::{$key}'],\n";
        }

        $menuBlock = "    // [MENU:{$prefix}:START]\n"
            . "    [\n"
            . "        'prefix' => '{$prefix}',\n"
            . "        'title' => '{$title}',\n"
            . "        'items' => [\n"
            . $itemsStr
            . "        ],\n"
            . "    ],\n"
            . "    // [MENU:{$prefix}:END]\n";

        // Insert before the closing ];
        $pos = strrpos($content, '];');
        if ($pos !== false) {
            $newContent = substr($content, 0, $pos) . $menuBlock . "];\n";
            File::put($path, $newContent);
        } else {
            throw new \Exception("Could not find array end in config/menu.php, please update manually.");
        }
    }

    protected function updateSidebar($prefix, $pages)
    {
        $path = app_path('Support/Sidebar.php');
        if (!File::exists($path)) return;

        $content = File::get($path);

        $routesStr = "";
        foreach ($pages as $key => $title) {
            $routesStr .= "        '{$prefix}::{$key}',\n";
        }

        // We want to insert the routes into the protected static array $routes = [ ...
        $pos = strpos($content, 'protected static array $routes = [');
        if ($pos !== false) {
            $insertPos = $pos + strlen('protected static array $routes = [') + 1; // +1 for newline probably
            $newContent = substr_replace($content, "\n" . $routesStr, $insertPos, 0);
            File::put($path, $newContent);
        } else {
            throw new \Exception("Could not modify app/Support/Sidebar.php, please update manually.");
        }
    }
}
