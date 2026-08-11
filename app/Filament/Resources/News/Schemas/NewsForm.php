<?php

namespace App\Filament\Resources\News\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class NewsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Title / શીર્ષક')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state ?? ''))),
                TextInput::make('slug')
                    ->label('URL Slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                Textarea::make('summary')
                    ->label('Summary / ટૂંકી વિગત')
                    ->rows(3)
                    ->columnSpanFull(),
                RichEditor::make('content')
                    ->label('Content / સમાચાર વિગત')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('image_path')
                    ->label('Featured Image / સમાચાર ચિત્ર')
                    ->image()
                    ->disk('public')
                    ->directory('news'),
                DateTimePicker::make('published_at')
                    ->label('Publish Date & Time')
                    ->default(now()),
                Toggle::make('is_featured')
                    ->label('Featured News')
                    ->default(false),
                Toggle::make('is_active')
                    ->label('Active Status')
                    ->default(true),
            ]);
    }
}
