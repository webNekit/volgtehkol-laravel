<?php

namespace App\Filament\Resources\AdditionalEducationModulePages;

use App\Enums\NavigationGroup;
use App\Filament\Resources\AdditionalEducationModulePages\Pages\CreateAdditionalEducationModulePage;
use App\Filament\Resources\AdditionalEducationModulePages\Pages\EditAdditionalEducationModulePage;
use App\Filament\Resources\AdditionalEducationModulePages\Pages\ListAdditionalEducationModulePages;
use App\Filament\Resources\AdditionalEducationModulePages\Schemas\AdditionalEducationModulePageForm;
use App\Filament\Resources\AdditionalEducationModulePages\Tables\AdditionalEducationModulePagesTable;
use App\Models\AdditionalEducationModulePage;
use App\Models\ModulePage;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AdditionalEducationModulePageResource extends Resource
{
    protected static ?string $model = ModulePage::class;

    protected static \UnitEnum|string|null $navigationGroup = NavigationGroup::MainModules->value;
    protected static ?string $modelLabel = 'Дополнительное образование';
    protected static ?string $pluralModelLabel = 'Дополнительное образование';

    public static string $modulePrefix = 'additional_education';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return AdditionalEducationModulePageForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AdditionalEducationModulePagesTable::configure($table);
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
            'index' => ListAdditionalEducationModulePages::route('/'),
            'create' => CreateAdditionalEducationModulePage::route('/create'),
            'edit' => EditAdditionalEducationModulePage::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()
            ->where('module', static::$modulePrefix);
    }
}
