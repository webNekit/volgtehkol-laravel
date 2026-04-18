<?php

namespace App\Filament\Resources\Events\Schemas;

use App\Models\EventFormat;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class EventForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make()->schema([
                    Group::make()->schema([
                        Section::make('Основная информация')->schema([
                            TextInput::make('title')
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state)))
                                ->label('Название мероприятия')
                                ->required(),
                            TextInput::make('slug')
                                ->label('URL - адрес')
                                ->required(),
                            TextInput::make('organizer')->label("Организатор"),
                            TagsInput::make('direction')->label("Направление"),
                            Textarea::make('description')
                                ->label("Описание")
                                ->columnSpanFull(),
                            RichEditor::make('content')
                                ->toolbarButtons([
                                    ['bold', 'italic', 'underline', 'strike', 'subscript', 'superscript', 'link'],
                                    ['h2', 'h3', 'alignStart', 'alignCenter', 'alignEnd'],
                                    ['blockquote', 'codeBlock', 'bulletList', 'orderedList'],
                                    ['table', 'attachFiles'],
                                    ['undo', 'redo'],
                                    ['fullscreen'],
                                ])
                                ->label('Контент')
                                ->columnSpanFull(),
                        ])->columns(2)->columnSpanFull(),
                        Section::make('Дата')->schema([
                            DatePicker::make('start_date')->label('Начало'),
                            DatePicker::make('end_date')->label('Окончание'),
                        ])->columns(2)->columnSpanFull(),
                    ])->columnSpan(4),
                    Group::make()->schema([
                        Section::make("Формат мероприятия")->schema([
                            Select::make("event_format_id")
                                ->options(function () {
                                    return EventFormat::where('is_active', true)->pluck('title', 'id');
                                })
                                ->label('Выберите формат')
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
                        ])->columnSpanFull(),
                        Section::make("Изображение")->schema([
                            FileUpload::make('image')
                                ->image()
                                ->label('Загрузите изображение')
                                ->disk('public')
                                ->directory('events')
                        ])->columnSpanFull(),
                    ])->columnSpan(2),
                ])->columns(6)->columnSpanFull()
            ]);
    }
}
