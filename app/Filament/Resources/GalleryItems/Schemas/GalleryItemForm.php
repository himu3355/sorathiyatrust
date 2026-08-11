<?php

namespace App\Filament\Resources\GalleryItems\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class GalleryItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('🖼️ ગેલેરી વિગત (Gallery Information)')
                    ->schema([
                        TextInput::make('title')
                            ->label('શીર્ષક (Title / Description)')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('દા.ત. વાર્ષિક સ્નેહ મિલન ૨૦૨૬'),
                        Select::make('type')
                            ->label('ગેલેરી પ્રકાર (Media Type)')
                            ->options([
                                'image' => '📷 તસવીર (Photo / Image)',
                                'video' => '🎥 વીડિયો (YouTube Video)',
                            ])
                            ->default('image')
                            ->required()
                            ->reactive(),
                        TextInput::make('category')
                            ->label('કેટેગરી / આલ્બમ (Category / Album)')
                            ->placeholder('દા.ત. સ્નેહ મિલન, કાર્યક્રમ, મહાજન વાડી, સેવા સંસ્કાર')
                            ->maxLength(255)
                            ->default('સમાજ કાર્યક્રમ'),
                    ])->columns(3),

                Section::make('📷 તસવીર અપલોડ (.webp format)')
                    ->schema([
                        FileUpload::make('image_path')
                            ->label('તસવીર ફાઇલ (.webp, .jpg, .png)')
                            ->image()
                            ->disk('public')
                            ->directory('gallery')
                            ->acceptedFileTypes(['image/webp', 'image/jpeg', 'image/png'])
                            ->maxSize(10240)
                            ->helperText('વેબસાઈટ પર ઝડપી લોડિંગ માટે .webp ફોર્મેટ ઉત્તમ છે. (Recommended: .webp images)'),
                    ])
                    ->visible(fn ($get) => $get('type') === 'image'),

                Section::make('🎥 YouTube વીડિયો લિંક')
                    ->schema([
                        TextInput::make('video_url')
                            ->label('YouTube Video URL')
                            ->placeholder('https://www.youtube.com/watch?v=XXXXXXXXXXX અથવા https://youtu.be/XXXXXXXXXXX')
                            ->url()
                            ->helperText('YouTube પરથી વીડિયો લિંક અહિયાં કોપી કરીને પેસ્ટ કરો.'),
                    ])
                    ->visible(fn ($get) => $get('type') === 'video'),

                Section::make('⚙️ ક્રમ અને સ્થિતિ (Sorting & Status)')
                    ->schema([
                        TextInput::make('sort_order')
                            ->label('ક્રમાંક (Sort Order)')
                            ->numeric()
                            ->default(0)
                            ->required(),
                        Toggle::make('is_active')
                            ->label('સક્રિય સ્થિતિ (Active Status)')
                            ->default(true)
                            ->required(),
                    ])->columns(2),
            ]);
    }
}
