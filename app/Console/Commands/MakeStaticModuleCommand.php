<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeStaticModuleCommand extends Command
{
    protected $signature = 'make:static-module';

    protected $description = 'Creates a static module with Filament Resource, Pages, Controller, and Configurations';

    public function handle()
    {
        $this->info('Starting Static Module Wizard...');

        $baseName = $this->ask('Enter module Resource Class name (e.g. Students, About, etc.)');
        if (empty($baseName)) {
            $this->error('Module name cannot be empty');
            return;
        }
        $baseName = Str::studly($baseName);

        $prefix = $this->ask('Enter module route prefix (e.g. students, about)');
        if (empty($prefix)) {
            $this->error('Prefix cannot be empty');
            return;
        }
        $prefix = Str::lower($prefix);

        $title = $this->ask('Enter module title (e.g. Студентам, О нас)');
        if (empty($title)) {
            $this->error('Title cannot be empty');
            return;
        }

        $pages = [];
        $this->info('Now let\'s add pages for this module. (Enter an empty page key to stop)');
        
        while (true) {
            $pageKey = $this->ask('Enter page key (e.g. basics, structure)');
            if (empty($pageKey)) {
                break;
            }

            $pageTitle = $this->ask("Enter title for page '{$pageKey}' (e.g. Основные сведения)");
            if (empty($pageTitle)) {
                $this->error('Page title is required');
                continue;
            }

            $pages[$pageKey] = $pageTitle;
        }

        if (empty($pages)) {
            $this->error('At least one page is required.');
            return;
        }

        $this->info("Creating module '{$baseName}' ({$title})...");

        $this->generateFilamentResource($baseName, $prefix, $title, $pages);
        $this->generateController($baseName, $prefix, $pages);
        $this->generateViews($prefix, $pages);
        
        $this->updateRoutes($baseName, $prefix, $pages);
        $this->updateMenu($baseName, $prefix, $title, $pages);
        $this->updateSidebar($prefix, $pages);
        $this->updateAppServiceProvider($prefix);

        $this->info("Successfully generated the static module '{$baseName}'!");
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
        $this->info("Created blade views in resources/views/web/{$prefix}");
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
            $this->info("Registered view namespace in AppServiceProvider");
        } else {
            // Find boot method if no loadViewsFrom exists
            $pos = strpos($content, 'public function boot(): void');
            if ($pos !== false) {
                $bracePos = strpos($content, '{', $pos);
                $newContent = substr_replace($content, "\n" . $line, $bracePos + 1, 0);
                File::put($path, $newContent);
                $this->info("Registered view namespace in AppServiceProvider");
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

        $this->info("Created Filament Resource files for {$baseName}");
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
        $this->info("Created Controller: {$baseName}Controller");
    }

    protected function updateRoutes($baseName, $prefix, $pages)
    {
        $path = base_path('routes/web.php');
        $content = File::get($path);

        // Check if already exists
        if (strpos($content, "// [MODULE:{$prefix}:START]") !== false) {
            $this->warn("Routes for module '{$prefix}' already exist in routes/web.php");
            return;
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
        $this->info("Appended routes to routes/web.php");
    }

    protected function updateMenu($baseName, $prefix, $title, $pages)
    {
        $path = base_path('config/menu.php');
        if (!File::exists($path)) return;

        $content = File::get($path);

        // Check if already exists
        if (strpos($content, "// [MENU:{$prefix}:START]") !== false) {
            $this->warn("Menu entry for module '{$prefix}' already exists in config/menu.php");
            return;
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
            $this->info("Appended module to config/menu.php");
        } else {
            $this->warn("Could not find array end in config/menu.php, please update manually.");
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
        // We can just find ");\n" or "];\n" depending on syntax, or just locate the start of the array and insert.
        // Easiest is to replace "protected static array \$routes = [" with itself + routesStr
        
        $pos = strpos($content, 'protected static array $routes = [');
        if ($pos !== false) {
            $insertPos = $pos + strlen('protected static array $routes = [') + 1; // +1 for newline probably
            $newContent = substr_replace($content, "\n" . $routesStr, $insertPos, 0);
            File::put($path, $newContent);
            $this->info("Appended routes to app/Support/Sidebar.php");
        } else {
            $this->warn("Could not modify app/Support/Sidebar.php, please update manually.");
        }
    }
}
