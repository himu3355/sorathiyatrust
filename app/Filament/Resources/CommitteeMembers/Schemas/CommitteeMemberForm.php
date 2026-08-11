<?php

namespace App\Filament\Resources\CommitteeMembers\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CommitteeMemberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('👤 સભ્ય અને હોદ્દા વિગત (Member Information)')
                    ->schema([
                        TextInput::make('name_guj')
                            ->label('ગુજરાતી નામ (Gujarati Name)')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('દા.ત. શ્રી જયેશ કનુભાઈ ધ્રુવ'),
                        TextInput::make('name_eng')
                            ->label('અંગ્રેજી નામ (English Name)')
                            ->maxLength(255)
                            ->placeholder('e.g. Shri Jayesh Kanubhai Dhruv'),
                        TextInput::make('designation_guj')
                            ->label('ગુજરાતી હોદ્દો (Gujarati Designation)')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('દા.ત. પ્રમુખ, ઉપપ્રમુખ, મંત્રી, કારોબારી સભ્ય'),
                        TextInput::make('designation_eng')
                            ->label('અંગ્રેજી હોદ્દો (English Designation)')
                            ->maxLength(255)
                            ->placeholder('e.g. President, Vice President, Secretary'),
                        Select::make('category')
                            ->label('સભ્ય શ્રેણી (Category)')
                            ->options([
                                'office_bearer' => '👑 હોદ્દેદાર (Office Bearer)',
                                'executive_member' => '👔 કારોબારી સભ્ય (Executive Committee Member)',
                            ])
                            ->default('office_bearer')
                            ->required(),
                        TextInput::make('term')
                            ->label('મુદ્દત / કાર્યકાળ (Term)')
                            ->default('૨૦૨૫-૨૭')
                            ->required()
                            ->maxLength(100),
                    ])->columns(2),

                Section::make('📷 તસવીર અને સંપર્ક વિગત (Photo & Contact Info)')
                    ->schema([
                        FileUpload::make('photo_path')
                            ->label('સભ્યનો પાસપોર્ટ સાઇઝ ફોટો (.webp, .jpg, .png)')
                            ->image()
                            ->disk('public')
                            ->directory('committee')
                            ->acceptedFileTypes(['image/webp', 'image/jpeg', 'image/png'])
                            ->maxSize(5120)
                            ->helperText('તસવીર ન હોય તો નામનો પ્રથમ અક્ષર ઓટોમેટિક અવતાર તરીકે દર્શાવાશે.'),
                        TextInput::make('mobile')
                            ->label('મોબાઇલ નંબર (Mobile Number)')
                            ->tel()
                            ->maxLength(20)
                            ->placeholder('દા.ત. +91 98765 43210'),
                        TextInput::make('email')
                            ->label('ઈમેલ એડ્રેસ (Email Address)')
                            ->email()
                            ->maxLength(255),
                    ])->columns(3),

                Section::make('⚙️ ક્રમ અને સ્થિતિ (Sorting & Status)')
                    ->schema([
                        TextInput::make('sort_order')
                            ->label('ક્રમાંક (Sort Order)')
                            ->numeric()
                            ->default(0)
                            ->required()
                            ->helperText('નાનો ક્રમાંક આપવાથી યાદીમાં પહેલા દર્શાવાશે.'),
                        Toggle::make('is_active')
                            ->label('સક્રિય સ્થિતિ (Active Status)')
                            ->default(true)
                            ->required(),
                    ])->columns(2),
            ]);
    }
}
