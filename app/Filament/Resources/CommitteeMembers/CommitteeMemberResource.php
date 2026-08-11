<?php

namespace App\Filament\Resources\CommitteeMembers;

use App\Filament\Resources\CommitteeMembers\Pages\CreateCommitteeMember;
use App\Filament\Resources\CommitteeMembers\Pages\EditCommitteeMember;
use App\Filament\Resources\CommitteeMembers\Pages\ListCommitteeMembers;
use App\Filament\Resources\CommitteeMembers\Schemas\CommitteeMemberForm;
use App\Filament\Resources\CommitteeMembers\Tables\CommitteeMembersTable;
use App\Models\CommitteeMember;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class CommitteeMemberResource extends Resource
{
    protected static ?string $model = CommitteeMember::class;

    protected static BackedEnum|string|null $navigationIcon = Heroicon::OutlinedUserGroup;

    protected static UnitEnum|string|null $navigationGroup = 'Directory & Trust';

    protected static ?string $modelLabel = 'કારોબારી/હોદ્દેદાર સભ્ય';

    protected static ?string $pluralModelLabel = 'હોદ્દેદારો અને કારોબારી સભ્યો';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return CommitteeMemberForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CommitteeMembersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCommitteeMembers::route('/'),
            'create' => CreateCommitteeMember::route('/create'),
            'edit' => EditCommitteeMember::route('/{record}/edit'),
        ];
    }
}
