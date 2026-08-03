<?php

namespace App\Filament\Widgets;

use App\Models\Event;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class UpcomingEventsWidget extends BaseWidget
{
    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = 'full';

    protected static ?string $heading = 'આગામી સમાજ કાર્યક્રમો (Upcoming Events Calendar)';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Event::upcoming()->limit(5)
            )
            ->columns([
                ImageColumn::make('image_path')
                    ->label('Banner')
                    ->disk('public'),
                TextColumn::make('title')
                    ->label('Event Title'),
                TextColumn::make('location')
                    ->label('Location'),
                TextColumn::make('event_date')
                    ->label('Date & Time')
                    ->dateTime('d M Y - h:i A'),
            ]);
    }
}
