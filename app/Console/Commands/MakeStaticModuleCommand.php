<?php

namespace App\Console\Commands;

use App\Services\StaticModuleService;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class MakeStaticModuleCommand extends Command
{
    protected $signature = 'make:static-module';

    protected $description = 'Creates a static module with Filament Resource, Pages, Controller, and Configurations';

    public function handle(StaticModuleService $service)
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

        try {
            $result = $service->createModule($baseName, $prefix, $title, $pages);
            $this->info($result['message']);
        } catch (\Exception $e) {
            $this->error($e->getMessage());
            return 1;
        }

        $this->info("Successfully generated the static module '{$baseName}'!");
    }
}
