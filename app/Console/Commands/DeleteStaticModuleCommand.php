<?php

namespace App\Console\Commands;

use App\Services\DeleteStaticModuleService;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class DeleteStaticModuleCommand extends Command
{
    protected $signature = 'delete:static-module';

    protected $description = 'Deletes a static module: Filament Resource, Controller, Views, Routes, Menu, Sidebar';

    public function handle(DeleteStaticModuleService $service)
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

        try {
            $result = $service->deleteModule($baseName, $prefix, $deleteDbRecords);

            $this->newLine();
            $this->info("✅ Module '{$baseName}' (prefix: {$prefix}) has been successfully deleted!");

            if (!empty($result['details'])) {
                foreach ($result['details'] as $detail) {
                    $this->line("  ✓ {$detail}");
                }
            }
        } catch (\Exception $e) {
            $this->error($e->getMessage());
            return 1;
        }

        return 0;
    }
}
