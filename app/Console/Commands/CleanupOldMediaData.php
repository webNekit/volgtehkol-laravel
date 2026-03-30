<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Page;
use App\Models\ModulePage;

class CleanupOldMediaData extends Command
{
    protected $signature = 'app:cleanup-old-media-data 
                            {--dry-run : Запустить без записи в БД (проверка)}
                            {--yes : Подтвердить очистку без подтверждения}';
    
    protected $description = 'Очистка старых JSON полей после успешной миграции в relation managers';

    private bool $dryRun = false;
    private int $cleanedCount = 0;

    public function handle()
    {
        $this->dryRun = !$this->option('dry-run');
        $confirmed = $this->option('yes');

        if (!$this->dryRun) {
            $this->warn('=== ВНИМАНИЕ: Будут удалены данные из старых полей ===');
            $this->warn('Поля: images, documents, files, links');
            $this->newLine();
            
            if (!$confirmed) {
                if (!$this->confirm('Вы уверены? Это действие нельзя отменить!')) {
                    $this->info('Операция отменена.');
                    return 1;
                }
            }
        }

        $this->info('Очистка Pages...');
        $this->cleanModel(Page::class, ['images', 'documents', 'links']);

        $this->info('Очистка ModulePages...');
        $this->cleanModel(ModulePage::class, ['images', 'files', 'links']);

        $this->newLine();
        $this->info("Очищено записей: {$this->cleanedCount}");
        
        if ($this->dryRun) {
            $this->warn('Это был сухой запуск. Для реальной очистки добавьте --dry-run');
        } else {
            $this->info('Готово! Старые поля очищены.');
        }
    }

    private function cleanModel($modelClass, array $columns)
    {
        $records = $modelClass::all();
        $bar = $this->output->createProgressBar($records->count());
        $bar->start();

        foreach ($records as $record) {
            $needsUpdate = false;
            
            foreach ($columns as $column) {
                if (!empty($record->$column)) {
                    $needsUpdate = true;
                }
            }

            if ($needsUpdate && !$this->dryRun) {
                foreach ($columns as $column) {
                    $record->$column = null;
                }
                $record->save();
                $this->cleanedCount++;
            }
            
            $bar->advance();
        }
        
        $bar->finish();
        $this->newLine();
    }
}
