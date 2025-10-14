<?php

namespace App\Filament\Resources\InfoModulePages;

use App\Enums\NavigationGroup;
use App\Filament\Resources\InfoModulePages\Pages\CreateInfoModulePage;
use App\Filament\Resources\InfoModulePages\Pages\EditInfoModulePage;
use App\Filament\Resources\InfoModulePages\Pages\ListInfoModulePages;
use App\Filament\Resources\InfoModulePages\Schemas\InfoModulePageForm;
use App\Filament\Resources\InfoModulePages\Tables\InfoModulePagesTable;
use App\Models\ModulePage;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class InfoModulePageResource extends Resource
{
    protected static ?string $model = ModulePage::class;

    protected static \UnitEnum|string|null $navigationGroup = NavigationGroup::MainModules->value;
    protected static ?string $modelLabel = 'Сведения об образовательной организации';
    protected static ?string $pluralModelLabel = 'Сведения об образовательной организации';

    public static string $modulePrefix = 'info';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return InfoModulePageForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return InfoModulePagesTable::configure($table);
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
            'index' => ListInfoModulePages::route('/'),
            'create' => CreateInfoModulePage::route('/create'),
            'edit' => EditInfoModulePage::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()
            ->where('module', static::$modulePrefix);
    }
}
