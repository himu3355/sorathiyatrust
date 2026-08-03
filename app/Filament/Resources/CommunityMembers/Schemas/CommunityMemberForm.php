<?php

namespace App\Filament\Resources\CommunityMembers\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CommunityMemberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Full Name (English) / પૂરું નામ')
                    ->required()
                    ->maxLength(255),
                TextInput::make('gujarati_name')
                    ->label('Full Name (ગુજરાતી નામ)')
                    ->maxLength(255),
                TextInput::make('designation')
                    ->label('Designation / હોદ્દો')
                    ->maxLength(255),
                TextInput::make('mobile_number')
                    ->label('Mobile Number / મોન નંબર')
                    ->tel()
                    ->maxLength(20),
                FileUpload::make('photo_path')
                    ->label('Member Photo')
                    ->image()
                    ->avatar()
                    ->disk('public')
                    ->directory('members')
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/gif'])
                    ->maxSize(5120), // 5MB limit
                TextInput::make('email')
                    ->label('Email Address')
                    ->email()
                    ->maxLength(255),
                TextInput::make('membership_number')
                    ->label('Membership No / સભ્ય ક્રમાંક')
                    ->maxLength(100),
                Textarea::make('address')
                    ->label('Address / સરનામું')
                    ->rows(2)
                    ->columnSpanFull(),
                TextInput::make('sort_order')
                    ->label('Sort Order')
                    ->required()
                    ->numeric()
                    ->default(0),
                Toggle::make('is_committee_member')
                    ->label('Trust Committee Member / ટ્રસ્ટી સભ્ય')
                    ->default(false),
                Toggle::make('is_active')
                    ->label('Active Status')
                    ->default(true),
            ]);
    }
}
