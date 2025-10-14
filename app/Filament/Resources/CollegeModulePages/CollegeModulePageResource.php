<?php

namespace App\Filament\Resources\CollegeModulePages;

use App\Enums\NavigationGroup;
use App\Filament\Resources\CollegeModulePages\Pages\CreateCollegeModulePage;
use App\Filament\Resources\CollegeModulePages\Pages\EditCollegeModulePage;
use App\Filament\Resources\CollegeModulePages\Pages\ListCollegeModulePages;
use App\Filament\Resources\CollegeModulePages\Schemas\CollegeModulePageForm;
use App\Filament\Resources\CollegeModulePages\Tables\CollegeModulePagesTable;
use App\Models\CollegeModulePage;
use App\Models\ModulePage;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CollegeModulePageResource extends Resource
{
    protected static ?string $model = ModulePage::class;

    protected static \UnitEnum|string|null $navigationGroup = NavigationGroup::MainModules->value;
    protected static ?string $modelLabel = 'О колледже';
    protected static ?string $pluralModelLabel = 'О колледже';

    public static string $modulePrefix = 'college';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return CollegeModulePageForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CollegeModulePagesTable::configure($table);
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
            'index' => ListCollegeModulePages::route('/'),
            'create' => CreateCollegeModulePage::route('/create'),
            'edit' => EditCollegeModulePage::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()
            ->where('module', static::$modulePrefix);
    }
}
