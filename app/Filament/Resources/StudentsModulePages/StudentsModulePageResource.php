<?php

namespace App\Filament\Resources\StudentsModulePages;

use App\Enums\NavigationGroup;
use App\Filament\Resources\StudentsModulePages\Pages\CreateStudentsModulePage;
use App\Filament\Resources\StudentsModulePages\Pages\EditStudentsModulePage;
use App\Filament\Resources\StudentsModulePages\Pages\ListStudentsModulePages;
use App\Filament\Resources\StudentsModulePages\Schemas\StudentsModulePageForm;
use App\Filament\Resources\StudentsModulePages\Tables\StudentsModulePagesTable;
use App\Models\ModulePage;
use App\Models\StudentsModulePage;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class StudentsModulePageResource extends Resource
{
    protected static ?string $model = ModulePage::class;

    protected static \UnitEnum|string|null $navigationGroup = NavigationGroup::MainModules->value;
    protected static ?string $modelLabel = 'Студентам';
    protected static ?string $pluralModelLabel = 'Студентам';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return StudentsModulePageForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StudentsModulePagesTable::configure($table);
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
            'index' => ListStudentsModulePages::route('/'),
            'create' => CreateStudentsModulePage::route('/create'),
            'edit' => EditStudentsModulePage::route('/{record}/edit'),
        ];
    }
}
