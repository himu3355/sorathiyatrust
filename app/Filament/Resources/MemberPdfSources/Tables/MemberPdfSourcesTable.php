<?php

namespace App\Filament\Resources\MemberPdfSources\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class MemberPdfSourcesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('document_title')
                    ->label('Document Title')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('communityMember.name')
                    ->label('Linked Member')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('source_page_number')
                    ->label('Page No.')
                    ->sortable(),
                TextColumn::make('reference_info')
                    ->label('Reference')
                    ->searchable(),
                TextColumn::make('pdf_path')
                    ->label('PDF File')
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->label('Uploaded At')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('community_member_id')
                    ->label('Filter by Member')
                    ->relationship('communityMember', 'name')
                    ->searchable()
                    ->preload(),
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
