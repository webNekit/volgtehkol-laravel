<?php

namespace App\Filament\Resources\Articles\Schemas;

use App\Models\Category;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Grid::make()->schema([
                Group::make()->schema([
                    Section::make('Основная информация')->schema([
                        TextInput::make('title')
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state)))
                            ->label('Название новости')
                            ->required(),
                        TextInput::make('slug')
                            ->label('URL - адрес')
                            ->required(),
                        Textarea::make('description')
                            ->label("Описание")
                            ->columnSpan(2),
                        RichEditor::make('content')
                            ->label("Контент")
                            ->toolbarButtons([
                                ['bold', 'italic', 'underline', 'strike', 'subscript', 'superscript', 'link'],
                                ['h2', 'h3', 'alignStart', 'alignCenter', 'alignEnd'],
                                ['blockquote', 'codeBlock', 'bulletList', 'orderedList'],
                                ['table', 'attachFiles'],
                                ['undo', 'redo'],
                                ['fullscreen'],
                            ])
                            ->columnSpan(2),
                    ])->columns(2)->columnSpanFull(),
                    Section::make("Медиа")->schema([
                        FileUpload::make('image')
                            ->image()
                            ->label('Изображение')
                            ->disk('public')
                            ->directory('articles')
                    ])->columnSpanFull(),
                ])->columnSpan(4),
                Group::make()->schema([
                    Section::make('Категория')->schema([
                        Select::make('category_id')
                            ->label('Выберите категорию')
                            ->options(function () {
                                return Category::where('is_active', true)->pluck('title', 'id');
                            }),
                    ])->columnSpanFull(),
                    Section::make('Опции')->schema([
                        Toggle::make('is_active')
                            ->label('Отображать на сайте')
                            ->default(false),
                        Toggle::make('is_banner')
                            ->label('Отображать в баннере')
                            ->default(false),
                        Toggle::make('is_slider')
                            ->label('Отображать в слайдере')
                            ->default(false),
                    ])->columnSpanFull()
                ])->columnSpan(2)
            ])->columns(6)->columnSpanFull()
        ]);
    }
}
