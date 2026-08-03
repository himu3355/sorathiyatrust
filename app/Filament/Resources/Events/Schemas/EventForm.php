<?php

namespace App\Filament\Resources\Events\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class EventForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Event Title / કાર્યક્રમનું નામ')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state ?? ''))),
                TextInput::make('slug')
                    ->label('URL Slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                TextInput::make('location')
                    ->label('Venue / સ્થળ')
                    ->maxLength(255),
                DateTimePicker::make('event_date')
                    ->label('Event Date & Time / તારીખ')
                    ->required()
                    ->default(now()),
                DateTimePicker::make('end_date')
                    ->label('Event End Date & Time'),
                RichEditor::make('description')
                    ->label('Description / વિગત')
                    ->columnSpanFull(),
                FileUpload::make('image_path')
                    ->label('Main Banner / Poster')
                    ->image()
                    ->disk('public')
                    ->directory('events'),
                FileUpload::make('gallery_images')
                    ->label('Event Photo Gallery')
                    ->image()
                    ->multiple()
                    ->disk('public')
                    ->directory('events/gallery')
                    ->columnSpanFull(),
                Toggle::make('is_active')
                    ->label('Active Status')
                    ->default(true),
            ]);
    }
}
