<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Page;
use App\Models\ModulePage;
use App\Models\ImageAttachment;
use App\Models\FileAttachment;
use App\Models\RelatedLink;
use Illuminate\Support\Facades\DB;

class MigrateMediaData extends Command
{
    protected $signature = 'app:migrate-media-data 
                            {--dry-run : Запустить без записи в БД (проверка)}
                            {--force : Подтвердить выполнение без подтверждения}';

    protected $description = 'Безопасный перенос Repeater данных в новые таблицы';

    private bool $dryRun = false;
    private int $createdCount = 0;
    private int $skippedCount = 0;

    public function handle()
    {
        $this->dryRun = $this->option('dry-run');

        if ($this->dryRun) {
            $this->warn('=== СУХОЙ ЗАПУСК (данные не будут записаны) ===');
        }

        $this->info('Миграция Pages...');
        $this->migrateModel(Page::class, 'images', 'documents', 'links');

        $this->info('Миграция ModulePages...');
        $this->migrateModel(ModulePage::class, 'images', 'files', 'links');

        $this->newLine();
        $this->info('=== ИТОГИ ===');
        $this->table(
            ['Действие', 'Количество'],
            [
                ['Создано записей', $this->createdCount],
                ['Пропущено (дубликаты)', $this->skippedCount],
            ]
        );

        if ($this->dryRun) {
            $this->warn('Это был сухой запуск. Для реального переноса запустите без --dry-run');
        } else {
            $this->info('Готово! Данные успешно скопированы.');
        }
    }

    private function migrateModel($modelClass, $imgCol, $fileCol, $linkCol)
    {
        $records = $modelClass::with(['imageAttachments', 'fileAttachments', 'relatedLinks'])->get();
        $bar = $this->output->createProgressBar($records->count());
        $bar->start();

        foreach ($records as $record) {
            // 1. ИЗОБРАЖЕНИЯ
            $images = is_string($record->$imgCol) ? json_decode($record->$imgCol, true) : ($record->$imgCol ?? []);
            if (is_array($images)) {
                foreach ($images as $index => $item) {
                    if (empty($item['file']))
                        continue;
                    $this->createAttachment(
                        $record,
                        'imageAttachments',
                        ImageAttachment::class,
                        $item['file'],
                        $item['caption'] ?? null,
                        $index
                    );
                }
            }

            // 2. ФАЙЛЫ
            $files = is_string($record->$fileCol) ? json_decode($record->$fileCol, true) : ($record->$fileCol ?? []);
            if (is_array($files)) {
                foreach ($files as $index => $item) {
                    if (empty($item['file']))
                        continue;
                    $this->createAttachment(
                        $record,
                        'fileAttachments',
                        FileAttachment::class,
                        $item['file'],
                        $item['caption'] ?? null,
                        $index
                    );
                }
            }

            // 3. ССЫЛКИ
            $links = is_string($record->$linkCol) ? json_decode($record->$linkCol, true) : ($record->$linkCol ?? []);
            if (is_array($links)) {
                foreach ($links as $index => $item) {
                    if (empty($item['url']))
                        continue;
                    $this->createLink(
                        $record,
                        'relatedLinks',
                        RelatedLink::class,
                        $item['url'],
                        $item['caption'] ?? null,
                        $index
                    );
                }
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
    }

    private function createAttachment($record, $relation, $modelClass, $path, $caption, $sort)
    {
        // Проверяем, существует ли уже такая запись
        $exists = $record->$relation()->where('file_path', $path)->exists();

        if ($exists) {
            $this->skippedCount++;
            return;
        }

        if (!$this->dryRun) {
            $record->$relation()->create([
                'file_path' => $path,
                'caption' => $caption,
                'is_visible' => true,
                'sort' => $sort,
            ]);
        }

        $this->createdCount++;
    }

    private function createLink($record, $relation, $modelClass, $url, $caption, $sort)
    {
        // Проверяем, существует ли уже такая запись
        $exists = $record->$relation()->where('url', $url)->exists();

        if ($exists) {
            $this->skippedCount++;
            return;
        }

        if (!$this->dryRun) {
            $record->$relation()->create([
                'url' => $url,
                'caption' => $caption,
                'is_visible' => true,
                'sort' => $sort,
            ]);
        }

        $this->createdCount++;
    }
}
