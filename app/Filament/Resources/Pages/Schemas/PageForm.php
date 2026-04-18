<?php

namespace App\Filament\Resources\Pages\Schemas;

use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Forms;
use Illuminate\Support\Str;

class PageForm
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
                                ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state)))
                                ->label('Заголовок страницы')
                                ->placeholder('Например: О нас')
                                ->required(),

                            Forms\Components\TextInput::make('slug')
                                ->label('URL')
                                ->placeholder('o-nas')
                                ->required()
                                ->unique(ignoreRecord: true),

                            Forms\Components\RichEditor::make('content')
                                ->label('Контент')
                                ->toolbarButtons([
                                    ['bold', 'italic', 'underline', 'strike', 'subscript', 'superscript', 'link'],
                                    ['h2', 'h3', 'alignStart', 'alignCenter', 'alignEnd'],
                                    ['blockquote', 'codeBlock', 'bulletList', 'orderedList'],
                                    ['table', 'attachFiles'],
                                    ['undo', 'redo'],
                                    ['fullscreen'],
                                ])
                                ->columnSpanFull(),

                        ])->columnSpanFull(),
                    ])->columnSpan(4),

                    // Правая колонка: выбор раздела и статус
                    Grid::make()->schema([
                        Section::make()->schema([

                            Forms\Components\Select::make('section_id')
                                ->label('Раздел')
                                ->options(
                                    \App\Models\Section::query()
                                        ->where('status', true)
                                        ->pluck('title', 'id')
                                )
                                ->searchable()
                                ->required(),

                            Forms\Components\Toggle::make('status')
                                ->label('Отображать страницу')
                                ->default(true),

                        ])->columnSpanFull(),
                    ])->columnSpan(2),

                ])->columns(6)->columnSpanFull(),
            ]);
    }
}
