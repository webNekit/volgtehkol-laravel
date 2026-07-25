<?php

namespace App\Filament\Resources\SpecialCategories;

use App\Filament\Resources\SpecialCategories\Pages\CreateSpecialCategory;
use App\Filament\Resources\SpecialCategories\Pages\EditSpecialCategory;
use App\Filament\Resources\SpecialCategories\Pages\ListSpecialCategories;
use App\Filament\Resources\SpecialCategories\Schemas\SpecialCategoryForm;
use App\Filament\Resources\SpecialCategories\Tables\SpecialCategoriesTable;
use App\Enums\NavigationGroup;
use App\Models\SpecialCategory;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class SpecialCategoryResource extends Resource
{
    protected static ?string $model = SpecialCategory::class;
    protected static \UnitEnum|string|null $navigationGroup = NavigationGroup::EducationInfo->value;
    protected static ?string $modelLabel = 'Направление специальности';
    protected static ?string $pluralModelLabel = 'Направления специальностей';
    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return SpecialCategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SpecialCategoriesTable::configure($table);
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
            'index' => ListSpecialCategories::route('/'),
            'create' => CreateSpecialCategory::route('/create'),
            'edit' => EditSpecialCategory::route('/{record}/edit'),
        ];
    }
}
