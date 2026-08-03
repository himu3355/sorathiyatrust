<?php

namespace App\Filament\Resources\Events\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class EventsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_path')
                    ->label('Banner')
                    ->disk('public'),
                TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('location')
                    ->label('Venue')
                    ->searchable(),
                TextColumn::make('event_date')
                    ->label('Event Date')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
                TextColumn::make('is_upcoming_status')
                    ->label('Type')
                    ->state(fn ($record) => $record->event_date >= now() ? 'Upcoming' : 'Past')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Upcoming' => 'success',
                        'Past' => 'gray',
                    }),
                IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->sortable(),
            ])
            ->filters([
                TernaryFilter::make('is_active')
                    ->label('Active Status'),
                Filter::make('upcoming')
                    ->label('Upcoming Events')
                    ->query(fn ($query) => $query->where('event_date', '>=', now())),
                Filter::make('past')
                    ->label('Past Events')
                    ->query(fn ($query) => $query->where('event_date', '<', now())),
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
