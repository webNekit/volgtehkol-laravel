<?php

namespace App\Filament\Resources\ContactDepartaments;

use App\Filament\Resources\ContactDepartaments\Pages\CreateContactDepartament;
use App\Filament\Resources\ContactDepartaments\Pages\EditContactDepartament;
use App\Filament\Resources\ContactDepartaments\Pages\ListContactDepartaments;
use App\Filament\Resources\ContactDepartaments\Schemas\ContactDepartamentForm;
use App\Filament\Resources\ContactDepartaments\Tables\ContactDepartamentsTable;
use App\Models\ContactDepartament;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ContactDepartamentResource extends Resource
{
    protected static ?string $model = ContactDepartament::class;
    protected static bool $shouldRegisterNavigation = false;
    protected static ?string $modelLabel = 'Отдел';
    protected static ?string $pluralModelLabel = 'Отделы';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return ContactDepartamentForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ContactDepartamentsTable::configure($table);
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
            'index' => ListContactDepartaments::route('/'),
            'create' => CreateContactDepartament::route('/create'),
            'edit' => EditContactDepartament::route('/{record}/edit'),
        ];
    }
}
