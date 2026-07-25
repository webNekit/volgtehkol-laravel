<?php

namespace App\Enums;

enum EducationLevel: string
{
    case Spo = 'spo';
    case Vocational = 'vocational';
    case Additional = 'additional';

    public function label(): string
    {
        return match ($this) {
            self::Spo => 'Среднее профессиональное образование',
            self::Vocational => 'Профессиональное обучение',
            self::Additional => 'Дополнительное образование',
        };
    }

    /**
     * Порядок вывода разделов на сайте: СПО всегда первый.
     */
    public function sort(): int
    {
        return array_search($this, self::cases(), true);
    }

    /**
     * @return array<string, string>
     */
    public static function options(): array
    {
        $options = [];
        foreach (self::cases() as $case) {
            $options[$case->value] = $case->label();
        }

        return $options;
    }
}
