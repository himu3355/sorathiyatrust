<?php

namespace App\Filament\Resources\CommitteeMembers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class CommitteeMembersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo_path')
                    ->label('તસવીર')
                    ->disk('public')
                    ->circular(),
                TextColumn::make('name_guj')
                    ->label('ગુજરાતી નામ')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('designation_guj')
                    ->label('હોદ્દો')
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color(fn ($record) => $record->category === 'office_bearer' ? 'amber' : 'gray'),
                TextColumn::make('category')
                    ->label('શ્રેણી')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'office_bearer' => 'amber',
                        'executive_member' => 'info',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'office_bearer' => '👑 હોદ્દેદાર',
                        'executive_member' => '👔 કારોબારી સભ્ય',
                        default => $state,
                    })
                    ->sortable(),
                TextColumn::make('mobile')
                    ->label('મોબાઇલ')
                    ->searchable(),
                TextColumn::make('term')
                    ->label('મુદ્દત')
                    ->sortable(),
                TextColumn::make('sort_order')
                    ->label('ક્રમાંક')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('is_active')
                    ->label('સક્રિય')
                    ->boolean()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->label('શ્રેણી ફિલ્ટર')
                    ->options([
                        'office_bearer' => '👑 હોદ્દેદાર (Office Bearers)',
                        'executive_member' => '👔 કારોબારી સભ્યો (Executive Members)',
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
