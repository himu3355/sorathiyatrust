<?php

namespace App\Filament\Resources\Advertisements\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class AdvertisementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Ad Title / નામ')
                    ->required()
                    ->maxLength(255),
                Select::make('position')
                    ->label('Ad Position / સ્થાન')
                    ->options([
                        'home_hero' => 'Home Hero Banner',
                        'home_content' => 'Home Content Banner',
                        'sidebar' => 'Sidebar Banner',
                        'footer' => 'Footer Banner',
                    ])
                    ->required()
                    ->default('home_hero'),
                FileUpload::make('image_path')
                    ->label('Banner Image / બેનર ચિત્ર')
                    ->image()
                    ->disk('public')
                    ->directory('ads')
                    ->required(),
                TextInput::make('link_url')
                    ->label('Target Link URL')
                    ->url()
                    ->maxLength(255),
                DatePicker::make('start_date')
                    ->label('Start Date (આરંભ તારીખ)'),
                DatePicker::make('end_date')
                    ->label('End Date (અંતિમ તારીખ)'),
                TextInput::make('sort_order')
                    ->label('Sort Order')
                    ->required()
                    ->numeric()
                    ->default(0),
                Toggle::make('is_active')
                    ->label('Active Status')
                    ->default(true),
            ]);
    }
}
