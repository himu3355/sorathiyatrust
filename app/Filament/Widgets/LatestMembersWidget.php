<?php

namespace App\Filament\Widgets;

use App\Models\FamilyMember;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestMembersWidget extends BaseWidget
{
    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = 'full';

    protected static ?string $heading = 'તાજેતરના ઉમેરાયેલ પરિવાર સભ્યો (Recent Family Members)';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                FamilyMember::with('family')->latest()->limit(5)
            )
            ->columns([
                TextColumn::make('member_name_guj')
                    ->label('Name (ગુજરાતી)')
                    ->searchable(),
                TextColumn::make('relation')
                    ->label('Relation'),
                TextColumn::make('family.surname_guj')
                    ->label('Surname'),
                TextColumn::make('family.village')
                    ->label('Village'),
                TextColumn::make('mobile')
                    ->label('Mobile'),
                IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->label('Added Date')
                    ->dateTime('d M Y'),
            ]);
    }
}
