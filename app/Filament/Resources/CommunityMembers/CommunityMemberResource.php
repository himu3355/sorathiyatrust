<?php

namespace App\Filament\Resources\CommunityMembers;

use App\Filament\Resources\CommunityMembers\Pages\CreateCommunityMember;
use App\Filament\Resources\CommunityMembers\Pages\EditCommunityMember;
use App\Filament\Resources\CommunityMembers\Pages\ListCommunityMembers;
use App\Filament\Resources\CommunityMembers\Schemas\CommunityMemberForm;
use App\Filament\Resources\CommunityMembers\Tables\CommunityMembersTable;
use App\Models\CommunityMember;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class CommunityMemberResource extends Resource
{
    protected static ?string $model = CommunityMember::class;

    protected static BackedEnum|string|null $navigationIcon = Heroicon::OutlinedUserGroup;

    protected static UnitEnum|string|null $navigationGroup = 'Community & Members';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return CommunityMemberForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CommunityMembersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCommunityMembers::route('/'),
            'create' => CreateCommunityMember::route('/create'),
            'edit' => EditCommunityMember::route('/{record}/edit'),
        ];
    }
}
