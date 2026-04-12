<?php

namespace App\Filament\Resources\Management;

use App\Enums\NavigationGroup;
use App\Filament\Resources\Management\Pages\CreateManagement;
use App\Filament\Resources\Management\Pages\EditManagement;
use App\Filament\Resources\Management\Pages\ListManagement;
use App\Filament\Resources\Management\Schemas\ManagementForm;
use App\Filament\Resources\Management\Tables\ManagementTable;
use App\Models\Management;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ManagementResource extends Resource
{
    protected static ?string $model = Management::class;
    protected static \UnitEnum|string|null $navigationGroup = NavigationGroup::EducationInfo->value;
    protected static ?string $modelLabel = 'Сотрудник';
    protected static ?string $pluralModelLabel = 'Педагогический состав';
    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return ManagementForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ManagementTable::configure($table);
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
            'index' => ListManagement::route('/'),
            'create' => CreateManagement::route('/create'),
            'edit' => EditManagement::route('/{record}/edit'),
        ];
    }
}
