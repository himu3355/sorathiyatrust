<?php

namespace App\Filament\Resources\Families\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class FamiliesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('family_code')
                    ->label('Family Code')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('main_member_name_guj')
                    ->label('Main Member (ગુજરાતી)')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('surname_guj')
                    ->label('Surname')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('village')
                    ->label('Village')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('members_count')
                    ->label('Members')
                    ->counts('members'),
                TextColumn::make('mobile')
                    ->label('Mobile')
                    ->searchable(),
                IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->sortable(),
            ])
            ->filters([
                TernaryFilter::make('is_active')
                    ->label('Active Status'),
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
