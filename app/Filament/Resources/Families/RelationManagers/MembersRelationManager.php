<?php

namespace App\Filament\Resources\Families\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MembersRelationManager extends RelationManager
{
    protected static string $relationship = 'members';

    protected static ?string $title = 'Family Members (પરિવારના સભ્યો)';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
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
                    ->label('Marital Status / લગ્ન સ્થિતિ')
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

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('member_name_guj')
            ->columns([
                TextColumn::make('member_name_guj')
                    ->label('Member Name (ગુજરાતી)')
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
                TextColumn::make('maternal_surname')
                    ->label('Mosal Surname')
                    ->searchable(),
                TextColumn::make('education')
                    ->label('Education'),
                TextColumn::make('occupation')
                    ->label('Occupation'),
                TextColumn::make('birth_date')
                    ->label('Birth Date')
                    ->date('d-m-Y')
                    ->sortable(),
                IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
