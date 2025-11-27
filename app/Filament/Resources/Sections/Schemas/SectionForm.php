<?php

namespace App\Filament\Resources\Sections\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Forms;
use Illuminate\Support\Str;

class SectionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()->schema([
                    Grid::make()->schema([
                        Section::make('Основная информация')->schema([
                            Forms\Components\TextInput::make('title')
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn (\Filament\Schemas\Components\Utilities\Set $set, ?string $state) => $set('slug', Str::slug($state)))
                                ->label('Название раздела')
                                ->placeholder('Например: Образование')
                                ->required(),
                            Forms\Components\TextInput::make('slug')
                                ->label('URL')
                                ->placeholder('obrazovanie')
                                ->required()
                                ->unique(ignoreRecord: true),
                            Forms\Components\Toggle::make('status')
                                ->label('Отображать раздел')
                                ->default(true),

                        ])->columns(2)->columnSpanFull(),

                    ])->columnSpan(6),

                ])->columns(6)->columnSpanFull(),
            ]);
    }
}
