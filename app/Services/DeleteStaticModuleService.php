<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class DeleteStaticModuleService
{
    public function deleteModule(string $baseName, string $prefix, bool $deleteDbRecords = false): array
    {
        $baseName = Str::studly($baseName);
        $prefix = Str::lower($prefix);

        $deleted = [];

        $deleted[] = $this->deleteFilamentResource($baseName);
        $deleted[] = $this->deleteController($baseName);
        $deleted[] = $this->deleteViews($prefix);

        $deleted[] = $this->cleanRoutes($prefix);
        $deleted[] = $this->cleanMenu($prefix);
        $deleted[] = $this->cleanSidebar($prefix);
        $deleted[] = $this->cleanAppServiceProvider($prefix);

        if ($deleteDbRecords) {
            $deleted[] = $this->deleteDbRecords($prefix);
        }

        return [
            'success' => true,
            'message' => "Module '{$baseName}' (prefix: {$prefix}) has been successfully deleted!",
            'details' => array_filter($deleted),
        ];
    }

    protected function deleteFilamentResource($baseName)
    {
        $dir = app_path("Filament/Resources/{$baseName}ModulePages");

        if (File::exists($dir)) {
            File::deleteDirectory($dir);
            return "Deleted Filament resource: {$baseName}ModulePages/";
        }
        return null;
    }

    protected function deleteController($baseName)
    {
        $dir = app_path("Http/Controllers/{$baseName}");

        if (File::exists($dir)) {
            File::deleteDirectory($dir);
            return "Deleted controller: {$baseName}/";
        }
        return null;
    }

    protected function deleteViews($prefix)
    {
        $dir = resource_path("views/web/{$prefix}");

        if (File::exists($dir)) {
            File::deleteDirectory($dir);
            return "Deleted views: {$prefix}/";
        }
        return null;
    }

    protected function cleanRoutes($prefix)
    {
        $path = base_path('routes/web.php');
        if (!File::exists($path)) return null;

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
            return "Removed route block from routes/web.php";
        }

        // Fallback: regex for legacy (pre-marker) modules
        $escapedPrefix = preg_quote($prefix, '/');
        $pattern = '/\n*Route::prefix\(\'' . $escapedPrefix . '\'\)->group\(function \(\) \{\n.*?\n\}\);\n?/s';
        $new = preg_replace($pattern, "\n", $content);

        if ($new !== $content) {
            File::put($path, $new);
            return "Removed route block from routes/web.php (legacy format)";
        }
        return null;
    }

    protected function cleanMenu($prefix)
    {
        $path = base_path('config/menu.php');
        if (!File::exists($path)) return null;

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
            return "Removed entry from config/menu.php";
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
            return "Removed entry from config/menu.php (legacy format)";
        }
        return null;
    }

    protected function cleanSidebar($prefix)
    {
        $path = app_path('Support/Sidebar.php');
        if (!File::exists($path)) return null;

        $content = File::get($path);

        // Remove all lines like: 'prefix::anything',
        $pattern = '/\s*\'' . preg_quote($prefix, '/') . '::[^\']+\',\n?/';

        $new = preg_replace($pattern, '', $content);

        if ($new !== $content) {
            File::put($path, $new);
            return "Removed routes from app/Support/Sidebar.php";
        }
        return null;
    }

    protected function cleanAppServiceProvider($prefix)
    {
        $path = app_path('Providers/AppServiceProvider.php');
        if (!File::exists($path)) return null;

        $content = File::get($path);

        // Remove line: $this->loadViewsFrom(..., 'prefix');
        $pattern = '/\s*\$this->loadViewsFrom\(base_path\(\'resources\/views\/web\/' . preg_quote($prefix, '/') . '\'\),\s*\'' . preg_quote($prefix, '/') . '\'\);\n?/';

        $new = preg_replace($pattern, "\n", $content);

        if ($new !== $content) {
            File::put($path, $new);
            return "Removed loadViewsFrom from AppServiceProvider";
        }
        return null;
    }

    protected function deleteDbRecords($prefix)
    {
        $count = DB::table('module_pages')->where('module', $prefix)->count();

        if ($count === 0) {
            return "No database records found for module '{$prefix}'";
        }

        DB::table('module_pages')->where('module', $prefix)->delete();
        return "Deleted {$count} database record(s) from module_pages for module '{$prefix}'";
    }
}
