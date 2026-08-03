<?php

namespace App\Filament\Resources\MemberPdfSources;

use App\Filament\Resources\MemberPdfSources\Pages\CreateMemberPdfSource;
use App\Filament\Resources\MemberPdfSources\Pages\EditMemberPdfSource;
use App\Filament\Resources\MemberPdfSources\Pages\ListMemberPdfSources;
use App\Filament\Resources\MemberPdfSources\Schemas\MemberPdfSourceForm;
use App\Filament\Resources\MemberPdfSources\Tables\MemberPdfSourcesTable;
use App\Models\MemberPdfSource;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class MemberPdfSourceResource extends Resource
{
    protected static ?string $model = MemberPdfSource::class;

    protected static BackedEnum|string|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static UnitEnum|string|null $navigationGroup = 'Community & Members';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return MemberPdfSourceForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MemberPdfSourcesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMemberPdfSources::route('/'),
            'create' => CreateMemberPdfSource::route('/create'),
            'edit' => EditMemberPdfSource::route('/{record}/edit'),
        ];
    }
}
