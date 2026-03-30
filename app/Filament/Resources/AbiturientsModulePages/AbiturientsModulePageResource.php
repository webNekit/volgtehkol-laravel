<?php

namespace App\Filament\Resources\AbiturientsModulePages;

use App\Enums\NavigationGroup;
use App\Filament\Resources\AbiturientsModulePages\Pages\CreateAbiturientsModulePage;
use App\Filament\Resources\AbiturientsModulePages\Pages\EditAbiturientsModulePage;
use App\Filament\Resources\AbiturientsModulePages\Pages\ListAbiturientsModulePages;
use App\Filament\Resources\AbiturientsModulePages\Schemas\AbiturientsModulePageForm;
use App\Filament\Resources\AbiturientsModulePages\Tables\AbiturientsModulePagesTable;
use App\Models\ModulePage;
use App\Filament\RelationManagers\ImageAttachmentsRelationManager;
use App\Filament\RelationManagers\FileAttachmentsRelationManager;
use App\Filament\RelationManagers\RelatedLinksRelationManager;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AbiturientsModulePageResource extends Resource
{
    protected static ?string $model = ModulePage::class;

    protected static \UnitEnum|string|null $navigationGroup = NavigationGroup::MainModules->value;
    protected static ?string $modelLabel = 'Абитуриентам';
    protected static ?string $pluralModelLabel = 'Абитуриентам';

    public static string $modulePrefix = 'abiturients';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return AbiturientsModulePageForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AbiturientsModulePagesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            ImageAttachmentsRelationManager::class,
            FileAttachmentsRelationManager::class,
            RelatedLinksRelationManager::class,
        ];
    }

    public static function getRelationManagers(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListAbiturientsModulePages::route('/'),
            'create' => CreateAbiturientsModulePage::route('/create'),
            'edit' => EditAbiturientsModulePage::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        return parent::getEloquentQuery()
            ->where('module', static::$modulePrefix);
    }
}
