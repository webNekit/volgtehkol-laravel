<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Support\Str;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Grid::make()->schema([
                Section::make('Данные')->schema([
                    TextInput::make('title')
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                        ->label('Название категории')
                        ->placeholder('События')
                        ->required(),
                    TextInput::make('slug')
                        ->label('URL')
                        ->required(),
                ])->columns(2)->columnSpan(4),
                Section::make('Опции')->schema([
                    Toggle::make('is_active')
                        ->label('Отображать на сайте')
                        ->default(false)
                ])->columnSpan(2)
            ])->columns(6)->columnSpanFull(),
        ]);
    }
}
