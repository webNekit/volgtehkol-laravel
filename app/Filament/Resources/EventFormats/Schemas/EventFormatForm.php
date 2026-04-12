<?php

namespace App\Filament\Resources\EventFormats\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class EventFormatForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()->schema([
                    Section::make()->schema([
                        TextInput::make('title')
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                            ->label('Название')
                            ->required(),
                        TextInput::make('slug')
                            ->label('URL - ссылка')
                            ->required(),
                    ])->columns(2)->columnSpanFull()
                ])->columnSpan(4),
                Group::make()->schema([
                    Section::make()->schema([
                        Toggle::make('is_active')
                            ->label('Отображать на сайте')
                            ->default(false)
                    ])->columnSpanFull()
                ])->columnSpan(2),
            ])->columns(6);
    }
}
