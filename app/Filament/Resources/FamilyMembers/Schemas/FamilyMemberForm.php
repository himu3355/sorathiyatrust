<?php

namespace App\Filament\Resources\FamilyMembers\Schemas;

use App\Models\Family;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class FamilyMemberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('family_id')
                    ->label('Family / પરિવાર')
                    ->relationship('family', 'main_member_name_guj')
                    ->required()
                    ->searchable()
                    ->preload(),
                TextInput::make('member_name_guj')
                    ->label('Member Name (ગુજરાતી)')
                    ->required()
                    ->maxLength(150),
                TextInput::make('member_name_eng')
                    ->label('Member Name (English)')
                    ->maxLength(150),
                TextInput::make('relation')
                    ->label('Relation (સંબંધ e.g. પોતે, પત્ની, પુત્ર)')
                    ->maxLength(100),
                TextInput::make('age')
                    ->label('Age / ઉંમર')
                    ->maxLength(20),
                TextInput::make('birth_place')
                    ->label('Birth Place / જન્મ સ્થળ')
                    ->maxLength(150),
                DatePicker::make('birth_date')
                    ->label('Birth Date / જન્મ તારીખ')
                    ->displayFormat('d-m-Y'),
                Select::make('marital_status')
                    ->label('Marital Status / સ્થિતિ')
                    ->options([
                        'Married' => 'પરિણીત (Married)',
                        'Unmarried' => 'અપરિણીત (Unmarried)',
                        'Widowed' => 'વિધવા/વિધુર (Widowed)',
                        'Divorced' => 'છૂટાછેડા (Divorced)'
                    ]),
                TextInput::make('maternal_surname')
                    ->label('Mosal Surname / મોસાળની અટક')
                    ->maxLength(100),
                TextInput::make('education')
                    ->label('Education / અભ્યાસ')
                    ->maxLength(150),
                TextInput::make('occupation')
                    ->label('Occupation / વ્યવસાય')
                    ->maxLength(150),
                TextInput::make('mobile')
                    ->label('Mobile Number')
                    ->maxLength(100),
                Toggle::make('is_active')
                    ->label('Active Status')
                    ->default(true),
            ]);
    }
}
