<?php

namespace App\Filament\Resources\GalleryItems\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class GalleryItemsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_path')
                    ->label('ચિત્ર / થંબનેલ')
                    ->disk('public')
                    ->defaultImageUrl(fn ($record) => $record && $record->type === 'video' ? $record->youtube_thumbnail_url : null),
                TextColumn::make('title')
                    ->label('શીર્ષક')
                    ->searchable()
                    ->sortable()
                    ->limit(40),
                TextColumn::make('type')
                    ->label('પ્રકાર')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'image' => 'amber',
                        'video' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'image' => '📷 તસવીર',
                        'video' => '🎥 વીડિયો',
                        default => $state,
                    })
                    ->sortable(),
                TextColumn::make('category')
                    ->label('કેટેગરી')
                    ->searchable()
                    ->sortable()
                    ->badge(),
                TextColumn::make('sort_order')
                    ->label('ક્રમાંક')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('is_active')
                    ->label('સક્રિય')
                    ->boolean()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->label('પ્રકાર ફિલ્ટર')
                    ->options([
                        'image' => '📷 તસવીર (Photos)',
                        'video' => '🎥 વીડિયો (Videos)',
                    ]),
                TernaryFilter::make('is_active')
                    ->label('સક્રિય સ્થિતિ'),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
