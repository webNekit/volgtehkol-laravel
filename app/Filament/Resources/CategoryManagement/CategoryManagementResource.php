<?php

namespace App\Filament\Resources\CategoryManagement;

use App\Filament\Resources\CategoryManagement\Pages\CreateCategoryManagement;
use App\Filament\Resources\CategoryManagement\Pages\EditCategoryManagement;
use App\Filament\Resources\CategoryManagement\Pages\ListCategoryManagement;
use App\Filament\Resources\CategoryManagement\Schemas\CategoryManagementForm;
use App\Filament\Resources\CategoryManagement\Tables\CategoryManagementTable;
use App\Models\CategoryManagement;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CategoryManagementResource extends Resource
{
    protected static ?string $model = CategoryManagement::class;

    protected static bool $shouldRegisterNavigation = false;
    protected static ?string $modelLabel = 'Отдел';
    protected static ?string $pluralModelLabel = 'Отделы';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return CategoryManagementForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CategoryManagementTable::configure($table);
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
            'index' => ListCategoryManagement::route('/'),
            'create' => CreateCategoryManagement::route('/create'),
            'edit' => EditCategoryManagement::route('/{record}/edit'),
        ];
    }
}
