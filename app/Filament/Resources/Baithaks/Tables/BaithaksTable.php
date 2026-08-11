<?php

namespace App\Filament\Resources\Baithaks\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BaithaksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('number')
                    ->label('નંબર')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('city_village_guj')
                    ->label('ગામનું નામ')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('address_guj')
                    ->label('સરનામું')
                    ->limit(50)
                    ->searchable(),
                TextColumn::make('contact_person_guj')
                    ->label('મુખ્યજી')
                    ->searchable(),
                TextColumn::make('contact_numbers')
                    ->label('સંપર્ક નંબર')
                    ->searchable(),
                IconColumn::make('is_apragat')
                    ->label('અપ્રગટ')
                    ->boolean(),
                IconColumn::make('is_active')
                    ->label('સક્રિય')
                    ->boolean(),
            ])
            ->defaultSort('number', 'asc')
            ->filters([
                //
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
