<?php

namespace App\Filament\Resources\Sliders\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SliderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Title / શીર્ષક')
                    ->maxLength(255)
                    ->default(null),
                Textarea::make('description')
                    ->label('Description / વિગત')
                    ->rows(3)
                    ->default(null)
                    ->columnSpanFull(),
                FileUpload::make('image_path')
                    ->label('Slide Image / સ્લાઇડ ચિત્ર')
                    ->image()
                    ->disk('public')
                    ->directory('sliders')
                    ->required(),
                TextInput::make('link_url')
                    ->label('Link URL')
                    ->url()
                    ->maxLength(255)
                    ->default(null),
                TextInput::make('sort_order')
                    ->label('Sort Order')
                    ->required()
                    ->numeric()
                    ->default(0),
                Toggle::make('is_active')
                    ->label('Active Status')
                    ->default(true)
                    ->required(),
            ]);
    }
}
