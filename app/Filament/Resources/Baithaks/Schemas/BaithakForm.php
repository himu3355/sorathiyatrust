<?php

namespace App\Filament\Resources\Baithaks\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class BaithakForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('number')
                    ->label('બેઠક ક્રમાંક (૧ થી ૮૪)')
                    ->required()
                    ->numeric(),
                TextInput::make('city_village_guj')
                    ->label('ગામનું નામ (ગુજરાતી)')
                    ->required(),
                TextInput::make('contact_person_guj')
                    ->label('મુખ્યજી / સંપર્ક વ્યક્તિ')
                    ->default(null),
                TextInput::make('contact_numbers')
                    ->label('ટેલિફોન / મોબાઇલ નંબર')
                    ->default(null),
                Textarea::make('address_guj')
                    ->label('બેઠકજીનું સરનામું (ગુજરાતી)')
                    ->required()
                    ->rows(3)
                    ->columnSpanFull(),
                Toggle::make('is_apragat')
                    ->label('અપ્રગટ બેઠક છે?')
                    ->default(false),
                Toggle::make('is_active')
                    ->label('સક્રિય (Active)')
                    ->default(true),
            ]);
    }
}
