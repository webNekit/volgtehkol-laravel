<?php

namespace App\Filament\Resources\CategoryStaff;

use App\Filament\Resources\CategoryStaff\Pages\CreateCategoryStaff;
use App\Filament\Resources\CategoryStaff\Pages\EditCategoryStaff;
use App\Filament\Resources\CategoryStaff\Pages\ListCategoryStaff;
use App\Filament\Resources\CategoryStaff\Schemas\CategoryStaffForm;
use App\Filament\Resources\CategoryStaff\Tables\CategoryStaffTable;
use App\Models\CategoryStaff;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CategoryStaffResource extends Resource
{
    protected static ?string $model = CategoryStaff::class;

    protected static bool $shouldRegisterNavigation = false;
    protected static ?string $modelLabel = 'Отдел';
    protected static ?string $pluralModelLabel = 'Отделы';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return CategoryStaffForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CategoryStaffTable::configure($table);
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
            'index' => ListCategoryStaff::route('/'),
            'create' => CreateCategoryStaff::route('/create'),
            'edit' => EditCategoryStaff::route('/{record}/edit'),
        ];
    }
}
