<?php

namespace App\Filament\Resources\FamilyMembers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class FamilyMembersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('member_name_guj')
                    ->label('Name (ગુજરાતી)')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('family.main_member_name_guj')
                    ->label('Family Head')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('relation')
                    ->label('Relation')
                    ->searchable(),
                TextColumn::make('age')
                    ->label('Age')
                    ->sortable(),
                TextColumn::make('marital_status')
                    ->label('Marital Status')
                    ->sortable(),
                TextColumn::make('birth_date')
                    ->label('Birth Date')
                    ->date('d-m-Y')
                    ->sortable(),
                TextColumn::make('maternal_surname')
                    ->label('Mosal Surname')
                    ->searchable(),
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
