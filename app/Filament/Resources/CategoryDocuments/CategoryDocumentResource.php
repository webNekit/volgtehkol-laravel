<?php

namespace App\Filament\Resources\CategoryDocuments;

use App\Filament\Resources\CategoryDocuments\Pages\CreateCategoryDocument;
use App\Filament\Resources\CategoryDocuments\Pages\EditCategoryDocument;
use App\Filament\Resources\CategoryDocuments\Pages\ListCategoryDocuments;
use App\Filament\Resources\CategoryDocuments\Schemas\CategoryDocumentForm;
use App\Filament\Resources\CategoryDocuments\Tables\CategoryDocumentsTable;
use App\Models\CategoryDocument;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CategoryDocumentResource extends Resource
{
    protected static ?string $model = CategoryDocument::class;

    protected static bool $shouldRegisterNavigation = false;
    protected static ?string $modelLabel = 'Категории документов';
    protected static ?string $pluralModelLabel = 'Категории документов';
    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return CategoryDocumentForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CategoryDocumentsTable::configure($table);
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
            'index' => ListCategoryDocuments::route('/'),
            'create' => CreateCategoryDocument::route('/create'),
            'edit' => EditCategoryDocument::route('/{record}/edit'),
        ];
    }
}
