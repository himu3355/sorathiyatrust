<?php

namespace App\Filament\Resources\Families\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class FamilyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('family_code')
                    ->label('Family Code / પરિવાર કોડ')
                    ->maxLength(50),
                TextInput::make('main_member_name_guj')
                    ->label('Main Member Name (ગુજરાતી)')
                    ->required()
                    ->maxLength(150),
                TextInput::make('main_member_name_eng')
                    ->label('Main Member Name (English)')
                    ->maxLength(150),
                TextInput::make('surname_guj')
                    ->label('Surname (અટક - ગુજરાતી)')
                    ->required()
                    ->maxLength(100),
                TextInput::make('surname_eng')
                    ->label('Surname (English)')
                    ->maxLength(100),
                TextInput::make('village')
                    ->label('Native Village (મૂળ ગામ)')
                    ->maxLength(150),
                TextInput::make('city')
                    ->label('City / શહેર')
                    ->default('રાજકોટ')
                    ->maxLength(100),
                TextInput::make('mobile')
                    ->label('Mobile Number')
                    ->maxLength(100),
                Textarea::make('address')
                    ->label('Address / સરનામું')
                    ->rows(3)
                    ->columnSpanFull(),
                Textarea::make('search_keywords')
                    ->label('Search Keywords')
                    ->rows(2)
                    ->columnSpanFull(),
                Toggle::make('is_active')
                    ->label('Active Status')
                    ->default(true),
            ]);
    }
}
