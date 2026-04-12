<?php

namespace App\Filament\Resources\CategoryStaff\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CategoryStaffForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()->schema([
                    TextInput::make('title')->label('Название')->required(),
                ])->columnSpanFull()
            ]);
    }
}
