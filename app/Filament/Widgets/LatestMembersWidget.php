<?php

namespace App\Filament\Widgets;

use App\Models\CommunityMember;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestMembersWidget extends BaseWidget
{
    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 'full';

    protected static ?string $heading = 'તાજેતરના ઉમેરાયેલ સમાજ સભ્યો (Recent Community Members)';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                CommunityMember::latest()->limit(5)
            )
            ->columns([
                ImageColumn::make('photo_path')
                    ->label('Photo')
                    ->circular()
                    ->disk('public'),
                TextColumn::make('gujarati_name')
                    ->label('Name (ગુજરાતી)')
                    ->searchable(),
                TextColumn::make('designation')
                    ->label('Designation'),
                TextColumn::make('mobile_number')
                    ->label('Mobile'),
                IconColumn::make('is_committee_member')
                    ->label('Committee')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->label('Added Date')
                    ->dateTime('d M Y'),
            ]);
    }
}
