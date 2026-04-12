<?php

namespace App\Filament\Resources\EventFormats;

use App\Enums\NavigationGroup;
use App\Filament\Resources\EventFormats\Pages\CreateEventFormat;
use App\Filament\Resources\EventFormats\Pages\EditEventFormat;
use App\Filament\Resources\EventFormats\Pages\ListEventFormats;
use App\Filament\Resources\EventFormats\Schemas\EventFormatForm;
use App\Filament\Resources\EventFormats\Tables\EventFormatsTable;
use App\Models\EventFormat;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class EventFormatResource extends Resource
{
    protected static ?string $model = EventFormat::class;
    protected static bool $shouldRegisterNavigation = false;
    protected static ?string $modelLabel = "Формат";
    protected static ?string $pluralModelLabel = "Формат";
    protected static ?string $recordTitleAttribute = 'EventFormat';

    public static function form(Schema $schema): Schema
    {
        return EventFormatForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EventFormatsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEventFormats::route('/'),
            'create' => CreateEventFormat::route('/create'),
            'edit' => EditEventFormat::route('/{record}/edit'),
        ];
    }
}
