<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class DeleteStaticModuleCommand extends Command
{
    protected $signature = 'delete:static-module';

    protected $description = 'Deletes a static module: Filament Resource, Controller, Views, Routes, Menu, Sidebar';

    public function handle()
    {
        $this->info('Static Module Deletion Wizard');
        $this->warn('WARNING: This will permanently delete files and configuration entries!');
        $this->newLine();

        $baseName = $this->ask('Enter module Resource Class name to delete (e.g. Test, Students)');
        if (empty($baseName)) {
            $this->error('Module name cannot be empty.');
            return 1;
        }
        $baseName = Str::studly($baseName);

        $prefix = $this->ask('Enter module route prefix (e.g. test, students)');
        if (empty($prefix)) {
            $this->error('Prefix cannot be empty.');
            return 1;
        }
        $prefix = Str::lower($prefix);

        $this->newLine();
        $this->line('The following will be deleted:');
        $this->line("  📁 app/Filament/Resources/{$baseName}ModulePages/");
        $this->line("  📁 app/Http/Controllers/{$baseName}/");
        $this->line("  📁 resources/views/web/{$prefix}/");
        $this->line("  ✏️  routes/web.php  → Route::prefix('{$prefix}') block");
        $this->line("  ✏️  config/menu.php → entry with prefix '{$prefix}'");
        $this->line("  ✏️  app/Support/Sidebar.php → all '{$prefix}::*' routes");
        $this->line("  ✏️  app/Providers/AppServiceProvider.php → loadViewsFrom for '{$prefix}'");
        $this->newLine();

        if (!$this->confirm("Are you sure you want to delete the module '{$baseName}' (prefix: {$prefix})?", false)) {
            $this->info('Deletion cancelled.');
            return 0;
        }

        $deleteDbRecords = $this->confirm(
            "Do you also want to delete all database records for module '{$prefix}' from module_pages table?",
            false
        );

        $this->newLine();

        $this->deleteFilamentResource($baseName);
        $this->deleteController($baseName);
        $this->deleteViews($prefix);

        $this->cleanRoutes($prefix);
        $this->cleanMenu($prefix);
        $this->cleanSidebar($prefix);
        $this->cleanAppServiceProvider($prefix);

        if ($deleteDbRecords) {
            $this->deleteDbRecords($prefix);
        }

        $this->newLine();
        $this->info("✅ Module '{$baseName}' (prefix: {$prefix}) has been successfully deleted!");

        return 0;
    }

    protected function deleteFilamentResource($baseName)
    {
        $dir = app_path("Filament/Resources/{$baseName}ModulePages");

        if (File::exists($dir)) {
            File::deleteDirectory($dir);
            $this->line("  ✓ Deleted Filament resource: app/Filament/Resources/{$baseName}ModulePages/");
        } else {
            $this->warn("  ⚠ Filament resource directory not found: {$dir}");
        }
    }

    protected function deleteController($baseName)
    {
        $dir = app_path("Http/Controllers/{$baseName}");

        if (File::exists($dir)) {
            File::deleteDirectory($dir);
            $this->line("  ✓ Deleted controller: app/Http/Controllers/{$baseName}/");
        } else {
            $this->warn("  ⚠ Controller directory not found: {$dir}");
        }
    }

    protected function deleteViews($prefix)
    {
        $dir = resource_path("views/web/{$prefix}");

        if (File::exists($dir)) {
            File::deleteDirectory($dir);
            $this->line("  ✓ Deleted views: resources/views/web/{$prefix}/");
        } else {
            $this->warn("  ⚠ Views directory not found: {$dir}");
        }
    }

    protected function cleanRoutes($prefix)
    {
        $path = base_path('routes/web.php');
        if (!File::exists($path)) return;

        $content = File::get($path);

        // Try marker-based removal first
        $start = "// [MODULE:{$prefix}:START]";
        $end   = "// [MODULE:{$prefix}:END]";

        $startPos = strpos($content, $start);
        $endPos   = strpos($content, $end);

        if ($startPos !== false && $endPos !== false) {
            $removeFrom = $startPos > 0 ? $startPos - 1 : $startPos;
            $removeTo   = $endPos + strlen($end);
            if (isset($content[$removeTo]) && $content[$removeTo] === "\n") {
                $removeTo++;
            }
            $newContent = substr($content, 0, $removeFrom) . substr($content, $removeTo);
            File::put($path, $newContent);
            $this->line("  ✓ Removed route block from routes/web.php");
            return;
        }

        // Fallback: regex for legacy (pre-marker) modules
        $escapedPrefix = preg_quote($prefix, '/');
        $pattern = '/\n*Route::prefix\(\'' . $escapedPrefix . '\'\)->group\(function \(\) \{\n.*?\n\}\);\n?/s';
        $new = preg_replace($pattern, "\n", $content);

        if ($new !== $content) {
            File::put($path, $new);
            $this->line("  ✓ Removed route block from routes/web.php (legacy format)");
        } else {
            $this->warn("  ⚠ Could not find route block for prefix '{$prefix}' in routes/web.php");
        }
    }

    protected function cleanMenu($prefix)
    {
        $path = base_path('config/menu.php');
        if (!File::exists($path)) return;

        $content = File::get($path);

        // Try marker-based removal first
        $start = "    // [MENU:{$prefix}:START]";
        $end   = "    // [MENU:{$prefix}:END]";

        $startPos = strpos($content, $start);
        $endPos   = strpos($content, $end);

        if ($startPos !== false && $endPos !== false) {
            $removeFrom = $startPos > 0 ? $startPos - 1 : $startPos;
            $removeTo   = $endPos + strlen($end);
            if (isset($content[$removeTo]) && $content[$removeTo] === "\n") {
                $removeTo++;
            }
            $newContent = substr($content, 0, $removeFrom) . substr($content, $removeTo);
            File::put($path, $newContent);
            $this->line("  ✓ Removed entry from config/menu.php");
            return;
        }

        // Fallback: find the array block by prefix and remove it line-by-line
        $lines = explode("\n", $content);
        $newLines = [];
        $inBlock = false;
        $bracketDepth = 0;
        $removed = false;

        foreach ($lines as $line) {
            if (!$inBlock && preg_match("/\'prefix\'\s*=>\s*\'" . preg_quote($prefix, '/') . "\'/", $line)) {
                // Found the prefix line — walk back to find the opening bracket
                // Remove the last line added (which should be the '[' opening)
                array_pop($newLines);
                $inBlock = true;
                $bracketDepth = 1; // we already consumed the opening [
                $removed = true;
                continue;
            }

            if ($inBlock) {
                $bracketDepth += substr_count($line, '[') - substr_count($line, ']');
                if ($bracketDepth <= 0) {
                    $inBlock = false;
                }
                continue;
            }

            $newLines[] = $line;
        }

        if ($removed) {
            File::put($path, implode("\n", $newLines));
            $this->line("  ✓ Removed entry from config/menu.php (legacy format)");
        } else {
            $this->warn("  ⚠ Could not find menu entry for prefix '{$prefix}' in config/menu.php");
        }
    }

    protected function cleanSidebar($prefix)
    {
        $path = app_path('Support/Sidebar.php');
        if (!File::exists($path)) return;

        $content = File::get($path);

        // Remove all lines like: 'prefix::anything',
        $pattern = '/\s*\'' . preg_quote($prefix, '/') . '::[^\']+\',\n?/';

        $new = preg_replace($pattern, '', $content);

        if ($new !== $content) {
            File::put($path, $new);
            $this->line("  ✓ Removed routes from app/Support/Sidebar.php");
        } else {
            $this->warn("  ⚠ No sidebar routes found for prefix '{$prefix}'");
        }
    }

    protected function cleanAppServiceProvider($prefix)
    {
        $path = app_path('Providers/AppServiceProvider.php');
        if (!File::exists($path)) return;

        $content = File::get($path);

        // Remove line: $this->loadViewsFrom(..., 'prefix');
        $pattern = '/\s*\$this->loadViewsFrom\(base_path\(\'resources\/views\/web\/' . preg_quote($prefix, '/') . '\'\),\s*\'' . preg_quote($prefix, '/') . '\'\);\n?/';

        $new = preg_replace($pattern, "\n", $content);

        if ($new !== $content) {
            File::put($path, $new);
            $this->line("  ✓ Removed loadViewsFrom from AppServiceProvider");
        } else {
            $this->warn("  ⚠ No loadViewsFrom found for prefix '{$prefix}' in AppServiceProvider");
        }
    }

    protected function deleteDbRecords($prefix)
    {
        $count = DB::table('module_pages')->where('module', $prefix)->count();

        if ($count === 0) {
            $this->line("  ℹ No database records found for module '{$prefix}'");
            return;
        }

        DB::table('module_pages')->where('module', $prefix)->delete();
        $this->line("  ✓ Deleted {$count} database record(s) from module_pages for module '{$prefix}'");
    }
}
